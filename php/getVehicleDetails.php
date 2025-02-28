<?php
header('Content-Type: application/json');

// Enable error reporting during development (remove in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "db.php";

try {
    // Use the proper variable names from db.php; adjust if necessary.
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$db", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Use FILTER_SANITIZE_FULL_SPECIAL_CHARS instead of FILTER_SANITIZE_STRING
    $stockNumber = filter_input(INPUT_GET, 'stockNumber', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if ($stockNumber) {
        // Fetch vehicle details from the database
        $stmt = $conn->prepare("SELECT * FROM vehicles WHERE stock_number = :stockNumber");
        $stmt->bindParam(':stockNumber', $stockNumber);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            // Update the keys based on your database schema
            $vehicle = [
                'make'          => $row['make'],
                'model'         => $row['model'],
                'selling_price' => $row['selling_price'],
                'odometer'      => $row['odometer'],
                'colour'        => $row['colour'],
                'transmission'=> $row['transmission'],
                'fuel_type'=> $row['fuel_type'],
                'year_model'=> $row['year_model'],
                'body_style'=> $row['body_style'],
                'interior'=> $row['interior'],

            ];
            echo json_encode($vehicle);
        } else {
            echo json_encode(["error" => "Vehicle not found"]);
        }
    } else {
        echo json_encode(["error" => "Invalid stock number"]);
    }
} catch (PDOException $e) {
    echo json_encode(["error" => "Connection failed: " . $e->getMessage()]);
}
?>
