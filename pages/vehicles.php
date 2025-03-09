<?php
// Start session (for theme handling)
session_start();

// Include your PDO database connection file (which should define $pdo)
include '../php/db.php';
$conn = $pdo;  // $conn now holds the PDO connection

// Retrieve filter values (using null coalescing operator for brevity)
$filters = [
    'make'         => $_GET['make']         ?? '',
    'model'        => $_GET['model']        ?? '',
    'colour'       => $_GET['colour']       ?? '',
    'year_model'   => $_GET['year_model']   ?? '',
    'mileage'      => $_GET['mileage']      ?? '',
    'price'        => $_GET['price']        ?? '',
    'body_style'   => $_GET['body_style']   ?? '',
    'fuel_type'    => $_GET['fuel_type']    ?? '',
    'interior'     => $_GET['interior']     ?? '',
    'transmission' => $_GET['transmission'] ?? ''
];

// Build an array of conditions based on filters that have values
$conditions = [];
foreach ($filters as $key => $value) {
    if ($value !== '' && $value !== '0') {
        switch ($key) {
            case 'make':
            case 'model':
            case 'colour':
            case 'body_style':
            case 'fuel_type':
            case 'interior':
            case 'transmission':
                // Incorporate wildcards inside the quote so the entire pattern is quoted
                $conditions[] = "$key ILIKE " . $conn->quote("%$value%");
                break;
            case 'year_model':
                // Numeric field: cast to int
                $conditions[] = "$key = " . (int)$value;
                break;
            case 'mileage':
                // Assuming "mileage" means "odometer reading less than or equal to" the given value
                $conditions[] = "odometer <= " . (int)$value;
                break;
            case 'price':
                // Assuming "price" means "selling_price less than or equal to" the given value
                $conditions[] = "selling_price <= " . (int)$value;
                break;
        }
    }
}

// Create the query using the conditions array.
// If no condition is present, all vehicles will be returned.
$query = "SELECT * FROM vehicles";
if (!empty($conditions)) {
    $query .= " WHERE " . implode(" AND ", $conditions);
}

// Execute the query
$vehicleResult = $conn->query($query);

// Handle theme switching via the URL parameter
if (isset($_GET['theme'])) {
    $_SESSION['theme'] = $_GET['theme'];
}
$theme = isset($_SESSION['theme']) ? $_SESSION['theme'] : 'light';
?>
<!DOCTYPE html>
<html lang="en" data-theme="<?php echo $theme; ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vehicles - Auto Spotter</title>
  <link rel="stylesheet" href="../css/root.css">
  <link rel="stylesheet" href="../css/sidebar.css">
  <link rel="stylesheet" href="../css/header.css">
  <link rel="stylesheet" href="../css/vehicles.css">
  <link rel="stylesheet" href="../css/modal.css">
  <link rel="stylesheet" href="../css/financeModal.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script src="../js/sidebar.js" defer></script>
  <script src="../js/Finance.js" defer></script>
  <script src="../js/financeModal.js" defer></script>
  <script src="../js/modal.js" defer></script>
  <link rel="stylesheet" href="../css/Finance.css">
</head>
<body id="vehicles" class="vehicles">
  <!-- Include header and sidebar -->
  <?php include '../php/header.php'; ?>
  <?php include '../php/sidebar.php'; ?>

  <div class="vehicles-page">
    <!-- Filter Section -->
    <section class="filter-section">
      <h2>Filter Vehicles</h2>
      <form id="filterForm" method="GET" action="vehicles.php">
        <div class="filter-row">
          <div class="filter-group">
            <label for="makeSelect">Make</label>
            <select id="makeSelect" name="make" onchange="this.form.submit()">
              <option value="">Any Make</option>
              <?php
              // Retrieve distinct makes from the vehicles table
              $makeQuery = "SELECT DISTINCT make FROM vehicles ORDER BY make";
              $makeResult = $conn->query($makeQuery);
              if ($makeResult) {
                while ($row = $makeResult->fetch(PDO::FETCH_ASSOC)) {
                  $selected = ($filters['make'] === $row['make']) ? 'selected' : '';
                  echo '<option value="' . htmlspecialchars($row['make']) . '" ' . $selected . '>' . htmlspecialchars($row['make']) . '</option>';
                }
              }
              ?>
            </select>
          </div>
          <div class="filter-group">
            <label for="modelInput">Model</label>
            <input type="text" id="modelInput" name="model" placeholder="Enter Model" list="modelList" value="<?php echo htmlspecialchars($filters['model']); ?>">
            <datalist id="modelList">
              <?php
              // If a make is selected, use it to filter models; otherwise, show a general list
              if (!empty($filters['make'])) {
                $modelQuery = "SELECT DISTINCT model FROM vehicles WHERE make ILIKE " . $conn->quote("%{$filters['make']}%");
              } else {
                $modelQuery = "SELECT DISTINCT model FROM vehicles";
              }
              $modelResult = $conn->query($modelQuery);
              if ($modelResult) {
                while ($row = $modelResult->fetch(PDO::FETCH_ASSOC)) {
                  echo '<option value="' . htmlspecialchars($row['model']) . '">';
                }
              }
              ?>
            </datalist>
          </div>
          <div class="filter-group">
            <label for="colourInput">Colour</label>
            <input type="text" id="colourInput" name="colour" placeholder="Any Colour" list="colourList" value="<?php echo htmlspecialchars($filters['colour']); ?>">
            <datalist id="colourList">
              <?php
              $colourQuery = "SELECT DISTINCT colour FROM vehicles";
              $colourResult = $conn->query($colourQuery);
              if ($colourResult) {
                while ($row = $colourResult->fetch(PDO::FETCH_ASSOC)) {
                  echo '<option value="' . htmlspecialchars($row['colour']) . '">';
                }
              }
              ?>
            </datalist>
          </div>
        </div>
        <div class="filter-row">
          <div class="filter-group">
            <label for="priceRange">Max Price (R)</label>
            <input type="range" id="priceRange" name="price" min="0" max="1000000" step="10000"
                   value="<?php echo htmlspecialchars($filters['price'] ?: 0); ?>"
                   oninput="document.getElementById('priceValue').textContent = 'R' + this.value">
            <span id="priceValue">R<?php echo htmlspecialchars($filters['price'] ?: 0); ?></span>
          </div>
          <div class="filter-group">
            <label for="mileageRange">Max Mileage (km)</label>
            <input type="range" id="mileageRange" name="mileage" min="0" max="500000" step="1000"
                   value="<?php echo htmlspecialchars($filters['mileage'] ?: 0); ?>"
                   oninput="document.getElementById('mileageValue').textContent = this.value + ' km'">
            <span id="mileageValue"><?php echo htmlspecialchars($filters['mileage'] ?: 0); ?> km</span>
          </div>
        </div>
        <div class="filter-row">
          <div class="filter-group">
            <label for="transmissionInput">Transmission</label>
            <input type="text" id="transmissionInput" name="transmission" placeholder="Any Transmission" list="transmissionList" value="<?php echo htmlspecialchars($filters['transmission']); ?>">
            <datalist id="transmissionList">
              <?php
              $transQuery = "SELECT DISTINCT transmission FROM vehicles";
              $transResult = $conn->query($transQuery);
              if ($transResult) {
                while ($row = $transResult->fetch(PDO::FETCH_ASSOC)) {
                  echo '<option value="' . htmlspecialchars($row['transmission']) . '">';
                }
              }
              ?>
            </datalist>
          </div>
          <div class="filter-group">
            <label for="fuelTypeInput">Fuel Type</label>
            <input type="text" id="fuelTypeInput" name="fuel_type" placeholder="Any Fuel Type" list="fuelTypeList" value="<?php echo htmlspecialchars($filters['fuel_type']); ?>">
            <datalist id="fuelTypeList">
              <?php
              $fuelQuery = "SELECT DISTINCT fuel_type FROM vehicles";
              $fuelResult = $conn->query($fuelQuery);
              if ($fuelResult) {
                while ($row = $fuelResult->fetch(PDO::FETCH_ASSOC)) {
                  echo '<option value="' . htmlspecialchars($row['fuel_type']) . '">';
                }
              }
              ?>
            </datalist>
          </div>
        </div>
        <div class="filter-row">
          <div class="filter-group">
            <label for="interiorInput">Interior</label>
            <input type="text" id="interiorInput" name="interior" placeholder="Any Interior" list="interiorList" value="<?php echo htmlspecialchars($filters['interior']); ?>">
            <datalist id="interiorList">
              <?php
              $interiorQuery = "SELECT DISTINCT interior FROM vehicles";
              $interiorResult = $conn->query($interiorQuery);
              if ($interiorResult) {
                while ($row = $interiorResult->fetch(PDO::FETCH_ASSOC)) {
                  echo '<option value="' . htmlspecialchars($row['interior']) . '">';
                }
              }
              ?>
            </datalist>
          </div>
          <div class="filter-group">
            <label for="bodyStyleInput">Body Style</label>
            <input type="text" id="bodyStyleInput" name="body_style" placeholder="Any Body Style" list="bodyStyleList" value="<?php echo htmlspecialchars($filters['body_style']); ?>">
            <datalist id="bodyStyleList">
              <?php
              $bodyQuery = "SELECT DISTINCT body_style FROM vehicles";
              $bodyResult = $conn->query($bodyQuery);
              if ($bodyResult) {
                while ($row = $bodyResult->fetch(PDO::FETCH_ASSOC)) {
                  echo '<option value="' . htmlspecialchars($row['body_style']) . '">';
                }
              }
              ?>
            </datalist>
          </div>
        </div>
        <button type="submit" class="filter-submit">Apply Filters</button>
      </form>
    </section>

    <!-- Results Section -->
    <section class="results-section">
      <h2>Vehicle Results</h2>
      <div class="vehicle-grid">
        <?php
        if ($vehicleResult && $vehicleResult->rowCount() > 0) {
          while ($vehicle = $vehicleResult->fetch(PDO::FETCH_ASSOC)) {
            $stockNumber = htmlspecialchars($vehicle['stock_number']);
            // Retrieve an image for the vehicle – for example, using a glob pattern
            $imagePath = "";
            $imagePattern = "../img/vehicles/$stockNumber/{$stockNumber}_*.jpg";
            $images = glob($imagePattern);
            if ($images && count($images) > 0) {
              $imagePath = $images[0];
            } else {
              $imagePath = "../img/pages/Logo.jpg"; // Default image path
            }
            ?>
            <div class="vehicle-card">
              <img src="<?php echo $imagePath; ?>" alt="<?php echo htmlspecialchars($vehicle['make']) . ' ' . htmlspecialchars($vehicle['model']); ?>" class="vehicle-image">
              <div class="vehicle-info">
          <h3><?php echo htmlspecialchars($vehicle['make']) . ' ' . htmlspecialchars($vehicle['model']); ?></h3>
          <p>Year: <?php echo htmlspecialchars($vehicle['year_model']); ?></p>
          <p>Mileage: <?php echo htmlspecialchars($vehicle['odometer']); ?> km</p>
            <p>Price: R<?php echo htmlspecialchars($vehicle['selling_price']); ?></p>
            <button class="view-details" onclick="openVehicleModal('<?php echo $stockNumber; ?>')">View Details</button>
            <input type="hidden" id="vehicleStockNumber" value="<?php echo $stockNumber; ?>">
              </div>
            </div>
            <?php
          }
        } else {
          echo '<p class="no-results">No vehicles found matching your criteria.</p>';
        }
        ?>
      </div>
    </section>
  </div>
  <div class="floating-tab collapsed" id="floatingTab">
    <div class="tab-header" onclick="toggleTab()">
      <h2>Vehicle Finance Calculator</h2>
    </div>
    <div class="tab-content">
      <div class="input-group">
        <label for="amount">Amount (R):</label>
        <input type="number" id="amount" placeholder="Enter amount">
      </div>
      <div class="input-group">
        <label for="interest">Interest Rate (%):</label>
        <input type="number" id="interest" placeholder="Enter interest rate">
      </div>
      <div class="input-group">
        <label for="period">Period (months):</label>
        <input type="number" id="period" placeholder="Enter period">
      </div>
      <button class="calculateInstallment" onclick="calculateInstallment()">Calculate Installment</button>
      <div class="results">
        <p>Monthly Installment: <span id="installment">R 0.00</span></p>
      </div>
    </div>
  </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <?php include '../php/vehicleDetailsModal.php'; ?>
    <?php include '../php/financeModal.php'; ?>
    <?php include '../php/loading.php'; ?>
    <script src="../js/finance_form.js"></script>
</body>
<footer>
  <p>&copy; 2025 AutoSpotter. All Rights Reserved.</p>
</footer>
</html>
