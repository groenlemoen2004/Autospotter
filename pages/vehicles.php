<!-- filepath: /c:/xampp/htdocs/Autospotter/pages/vehicles.php -->
<?php
include '../php/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicles - Auto Spotter</title>
    <link rel="stylesheet" href="../css/title.css">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/vehicles.css">
    <link rel="stylesheet" href="../css/search.css">
    <link rel="stylesheet" href="../css/floating-tab.css">
</head>
<body>
    <header class="header">
        <img src="../img/Logo.jpg" alt="Logo" class="logo">
        <h1 class="title">Auto Spotter</h1>
    </header>
    <?php include '../php/sidebar.php'; ?>

    <div class="main-content">
        <div class="content-header">
            <h1>Our Vehicles</h1>
            <p class="intro-text">Discover our wide range of vehicles.</p>
        </div>

        <div class="filter-container">
            <form id="searchForm" method="GET">
                <div class="form-group">
                    <label for="makeSelect">Make</label>
                    <select id="makeSelect" name="make" onchange="updateModels()">
                        <option value="">Select a Make</option>
                        <?php
                        $makeQuery = "SELECT DISTINCT make FROM vehicles ORDER BY make";
                        $makeResult = pg_query($conn, $makeQuery);
                        if ($makeResult) {
                            while ($makeRow = pg_fetch_assoc($makeResult)) {
                                echo '<option value="' . htmlspecialchars($makeRow['make']) . '">' . htmlspecialchars($makeRow['make']) . '</option>';
                            }
                        } else {
                            echo '<option value="">No makes found</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="modelInput">Model</label>
                    <input type="text" id="modelInput" name="model" placeholder="Model" list="modelList">
                    <datalist id="modelList">
                        <?php
                        $selectedMake = htmlspecialchars($_GET['make'] ?? '');
                        $modelQuery = "SELECT DISTINCT model FROM vehicles";
                        if ($selectedMake) {
                            $modelQuery .= " WHERE make = '" . pg_escape_string($conn, $selectedMake) . "'";
                        }
                        $modelResult = pg_query($conn, $modelQuery);
                        if ($modelResult) {
                            while ($modelRow = pg_fetch_assoc($modelResult)) {
                                echo '<option value="' . htmlspecialchars($modelRow['model']) . '">';
                            }
                        }
                        ?>
                    </datalist>
                </div>

                <div class="range-container">
                    <label for="priceRange">Price</label>
                    <input type="range" id="priceRange" name="price" min="0" max="1000000" step="10000" oninput="document.getElementById('priceValue').textContent = 'R' + this.value">
                    <span id="priceValue" class="range-value">R0</span>
                </div>

                <div class="range-container">
                    <label for="mileageRange">Mileage</label>
                    <input type="range" id="mileageRange" name="mileage" min="0" max="500000" step="1000" oninput="document.getElementById('mileageValue').textContent = this.value + ' km'">
                    <span id="mileageValue" class="range-value">0 km</span>
                </div>

                <div class="form-group">
                    <label for="colourInput">Colour</label>
                    <input type="text" id="colourInput" name="colour" placeholder="Colour" list="colourList">
                    <datalist id="colourList">
                        <?php
                        $colourQuery = "SELECT DISTINCT vehicle_colour AS colour FROM vehicle_info";
                        $colourResult = pg_query($conn, $colourQuery);
                        if ($colourResult) {
                            while ($colourRow = pg_fetch_assoc($colourResult)) {
                                echo '<option value="' . htmlspecialchars($colourRow['colour']) . '">';
                            }
                        }
                        ?>
                    </datalist>
                </div>

                <div class="form-group">
                    <label for="transmissionInput">Transmission</label>
                    <input type="text" id="transmissionInput" name="transmission" placeholder="Transmission" list="transmissionList">
                    <datalist id="transmissionList">
                        <?php
                        $transmissionQuery = "SELECT DISTINCT vehicle_transmission AS transmission FROM vehicle_info";
                        $transmissionResult = pg_query($conn, $transmissionQuery);
                        if ($transmissionResult) {
                            while ($transmissionRow = pg_fetch_assoc($transmissionResult)) {
                                echo '<option value="' . htmlspecialchars($transmissionRow['transmission']) . '">';
                            }
                        }
                        ?>
                    </datalist>
                </div>

                <div class="form-group">
                    <label for="fuelTypeInput">Fuel Type</label>
                    <input type="text" id="fuelTypeInput" name="fuel_type" placeholder="Fuel Type" list="fuelTypeList">
                    <datalist id="fuelTypeList">
                        <?php
                        $fuelTypeQuery = "SELECT DISTINCT vehicle_fuel_type AS fuel_type FROM vehicle_info";
                        $fuelTypeResult = pg_query($conn, $fuelTypeQuery);
                        if ($fuelTypeResult) {
                            while ($fuelTypeRow = pg_fetch_assoc($fuelTypeResult)) {
                                echo '<option value="' . htmlspecialchars($fuelTypeRow['fuel_type']) . '">';
                            }
                        }
                        ?>
                    </datalist>
                </div>

                <div class="form-group">
                    <label for="interiorInput">Interior</label>
                    <input type="text" id="interiorInput" name="interior" placeholder="Interior" list="interiorList">
                    <datalist id="interiorList">
                        <?php
                        $interiorQuery = "SELECT DISTINCT vehicle_interior AS interior FROM vehicle_info";
                        $interiorResult = pg_query($conn, $interiorQuery);
                        if ($interiorResult) {
                            while ($interiorRow = pg_fetch_assoc($interiorResult)) {
                                echo '<option value="' . htmlspecialchars($interiorRow['interior']) . '">';
                            }
                        }
                        ?>
                    </datalist>
                </div>

                <div class="form-group">
                    <label for="bodyStyleInput">Body Style</label>
                    <input type="text" id="bodyStyleInput" name="body_style" placeholder="Body Style" list="bodyStyleList">
                    <datalist id="bodyStyleList">
                        <?php
                        $bodyStyleQuery = "SELECT DISTINCT vehicle_body_style AS body_style FROM vehicle_info";
                        $bodyStyleResult = pg_query($conn, $bodyStyleQuery);
                        if ($bodyStyleResult) {
                            while ($bodyStyleRow = pg_fetch_assoc($bodyStyleResult)) {
                                echo '<option value="' . htmlspecialchars($bodyStyleRow['body_style']) . '">';
                            }
                        }
                        ?>
                    </datalist>
                </div>

                <button type="submit" id="searchButton">Search</button>
            </form>
        </div>

        <div id="vehicleResults">
            <?php
            // Filter vehicles based on the form input
            $make = isset($_GET['make']) ? pg_escape_string($conn, $_GET['make']) : '';
            $model = isset($_GET['model']) ? pg_escape_string($conn, $_GET['model']) : '';
            $colour = isset($_GET['colour']) ? pg_escape_string($conn, $_GET['colour']) : '';
            $year_model = isset($_GET['year_model']) ? pg_escape_string($conn, $_GET['year_model']) : '';
            $odometer = isset($_GET['mileage']) ? pg_escape_string($conn, $_GET['mileage']) : '';
            $selling_price = isset($_GET['price']) ? pg_escape_string($conn, $_GET['price']) : '';
            $body_style = isset($_GET['body_style']) ? pg_escape_string($conn, $_GET['body_style']) : '';
            $fuel_type = isset($_GET['fuel_type']) ? pg_escape_string($conn, $_GET['fuel_type']) : '';
            $interior = isset($_GET['interior']) ? pg_escape_string($conn, $_GET['interior']) : '';
            $transmission = isset($_GET['transmission']) ? pg_escape_string($conn, $_GET['transmission']) : '';

            $query = "SELECT * FROM vehicles WHERE true";
            
            if ($make) {
                $query .= " AND make ILIKE '%$make%'";
            }
            if ($model) {
                $query .= " AND model ILIKE '%$model%'";
            }
            if ($colour) {
                $query .= " AND colour ILIKE '%$colour%'";
            }
            if ($year_model) {
                $query .= " AND year_model = $year_model";
            }
            if ($odometer) {
                $query .= " AND odometer <= $odometer";
            }
            if ($selling_price) {
                $query .= " AND selling_price <= $selling_price";
            }
            if ($body_style) {
                $query .= " AND body_style ILIKE '%$body_style%'";
            }
            if ($fuel_type) {
                $query .= " AND fuel_type ILIKE '%$fuel_type%'";
            }
            if ($interior) {
                $query .= " AND interior ILIKE '%$interior%'";
            }
            if ($transmission) {
                $query .= " AND transmission ILIKE '%$transmission%'";
            }

            // Execute query and display results
            $vehicleResult = pg_query($conn, $query);
            if (pg_num_rows($vehicleResult) > 0) {
                while ($vehicleRow = pg_fetch_assoc($vehicleResult)) {
                    echo '<div class="vehicle-card">';
                    $stockNumber = htmlspecialchars($vehicleRow['stock_number']);
                    $imagePath = glob("../images/$stockNumber/{$stockNumber}_*.jpg")[0];
                    echo '<img  class="vehicle-image" src="' . $imagePath . '" alt="' . htmlspecialchars($vehicleRow['make']) . ' ' . htmlspecialchars($vehicleRow['model']) . '">';
                    echo '<h3>' . htmlspecialchars($vehicleRow['make']) . ' ' . htmlspecialchars($vehicleRow['model']) . '</h3>';
                    echo '<p>Year: ' . htmlspecialchars($vehicleRow['year_model']) . '</p>';
                    echo '<p>Odometer: ' . htmlspecialchars($vehicleRow['odometer']) . ' km</p>';
                    echo '<p>Price: R' . htmlspecialchars($vehicleRow['selling_price']) . '</p>';
                    echo '<button class="view-button" onclick="viewDetails(' . htmlspecialchars($vehicleRow['stock_number']) . ')">View Details</button>';
                    echo '</div>';
                }
            } else {
                echo '<p>No vehicles found.</p>';
            }
            ?>
        </div>
    </div>

    <div id="floatingTab" class="floating-tab">
        <div class="floating-tab-content">
            <span class="close-btn" id="closeTab">&times;</span>
            <h2 id="vehicleName" class="vehicle-name"></h2>
            <div id="vehicleImages" class="vehicle-images"></div>
            <div class="tab-container">
                <div class="tab active">Specs</div>
                <div class="tab">Service History</div>
                <div class="tab">Additional Info</div>
            </div>
            <div id="specsContent" class="tab-content active"></div>
            <div id="serviceHistoryContent" class="tab-content"></div>
            <div id="additionalInfoContent" class="tab-content"></div>
            <button id="applyButton">Apply Now</button>
        </div>
    </div>

    <script src="../js/sidebar.js"></script>
    <script src="../js/floating-tab.js"></script>
</body>
<footer>
    <p>&copy; 2025 AutoSpotter.co.za. All Rights Reserved.</p>
</footer>
</html>