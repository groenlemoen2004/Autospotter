<?php
session_start();
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
    <link rel="stylesheet" href="../css/search.css"> <!-- Include search.css -->
    <link rel="stylesheet" href="../css/floating-tab.css"> <!-- Include floating-tab.css -->
</head>
<body>
    <header class="header">
        <img src="../img/Logo.jpg" alt="Logo" class="logo"> <!-- Logo image -->
        <h1 class="title">Auto Spotter</h1> <!-- Title -->
    </header>
    <?php include '../php/sidebar.php';?>

    <div class="main-content">
        <div class="content-header">
            <h1>Our Vehicles</h1>
            <p class="intro-text">Discover our wide range of vehicles. Whether you're looking for a family car, a sports car, or an SUV, we have something for everyone.</p>
        </div>
        <div class="filter-container">
            <form id="searchForm" method="GET" action="">
                <input type="text" id="makeInput" name="make" placeholder="Make" list="makeList">
                <datalist id="makeList">
                    <?php
                    $makeQuery = "SELECT DISTINCT make FROM vehicle_info";
                    $makeResult = $conn->query($makeQuery);
                    while ($makeRow = $makeResult->fetch_assoc()) {
                        echo '<option value="' . htmlspecialchars($makeRow['make']) . '">';
                    }
                    ?>
                </datalist>
                <input type="text" id="modelInput" name="model" placeholder="Model" list="modelList">
                <datalist id="modelList">
                    <?php
                    $modelQuery = "SELECT DISTINCT model FROM vehicle_info";
                    $modelResult = $conn->query($modelQuery);
                    while ($modelRow = $modelResult->fetch_assoc()) {
                        echo '<option value="' . htmlspecialchars($modelRow['model']) . '">';
                    }
                    ?>
                </datalist>
                <input type="number" id="yearInput" name="year" placeholder="Year" min="1900" max="<?php echo date('Y'); ?>">
                <label for="priceRange">Max Price: <span id="priceValue">R 500000</span></label>
                <input type="range" id="priceRange" name="price" min="0" max="1000000" step="1000" value="500000" oninput="document.getElementById('priceValue').innerText = 'R ' + this.value">
                
                <label for="mileageRange">Max Mileage: <span id="mileageValue">50000 km</span></label>
                <input type="range" id="mileageRange" name="mileage" min="0" max="1000000" step="1000" value="50000" oninput="document.getElementById('mileageValue').innerText = this.value + ' km'">
                <button type="submit" id="searchButton">Search</button>
            </form>
        </div>

        <div id="vehicleResults">
            <?php
            $make = isset($_GET['make']) ? $_GET['make'] : '';
            $model = isset($_GET['model']) ? $_GET['model'] : '';
            $year = isset($_GET['year']) ? $_GET['year'] : '';
            $price = isset($_GET['price']) ? $_GET['price'] : '';
            $mileage = isset($_GET['mileage']) ? $_GET['mileage'] : '';

            $query = "SELECT * FROM vehicle_info WHERE 1=1";
            if ($make) {
                $query .= " AND make LIKE '%" . $conn->real_escape_string($make) . "%'";
            }
            if ($model) {
                $query .= " AND model LIKE '%" . $conn->real_escape_string($model) . "%'";
            }
            if ($year) {
                $query .= " AND year = " . $conn->real_escape_string($year);
            }
            if ($price) {
                $query .= " AND price <= " . $conn->real_escape_string($price);
            }
            if ($mileage) {
                $query .= " AND mileage <= " . $conn->real_escape_string($mileage);
            }

            $vehicleResult = $conn->query($query);
            if ($vehicleResult->num_rows > 0) {
                while ($vehicleRow = $vehicleResult->fetch_assoc()) {
                    $vehicleId = isset($vehicleRow['id']) ? htmlspecialchars($vehicleRow['id']) : '';
                    $vehicleImage = isset($vehicleRow['image']) ? htmlspecialchars($vehicleRow['image']) : 'default.jpg';
                    $vehicleMake = isset($vehicleRow['make']) ? htmlspecialchars($vehicleRow['make']) : 'Unknown';
                    $vehicleModel = isset($vehicleRow['model']) ? htmlspecialchars($vehicleRow['model']) : 'Unknown';
                    $vehicleYear = isset($vehicleRow['year']) ? htmlspecialchars($vehicleRow['year']) : 'Unknown';
                    $vehiclePrice = isset($vehicleRow['price']) ? number_format((float)$vehicleRow['price'], 2) : '0.00';
                    $vehicleMileage = isset($vehicleRow['mileage']) ? number_format((float)$vehicleRow['mileage']) : '0';

                    echo '<div class="vehicle-card" data-id="' . $vehicleId . '">';
                    echo '<img src="../img/vehicles/' . ($vehicleImage !== 'default.jpg' ? $vehicleImage : 'Logo.jpg') . '" alt="' . $vehicleMake . ' ' . $vehicleModel . '" class="vehicle-image">';
                    echo '<div class="vehicle-details">';
                    echo '<h2>' . $vehicleMake . ' ' . $vehicleModel . '</h2>';
                    echo '<p>Year: ' . $vehicleYear . '</p>';
                    echo '<p>Price: R ' . $vehiclePrice . '</p>';
                    echo '<p>Mileage: ' . $vehicleMileage . ' km</p>';
                    echo '</div>';
                    echo '<button class="view-button">View</button>';
                    echo '</div>';
                }
            } else {
                echo '<p>No vehicles found.</p>';
            }
            ?>
        </div>
    </div>

    <!-- Floating Tab -->
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
    <script src="../js/search.js"></script>
    <script src="../js/floating-tab.js"></script>
</body>
</html>