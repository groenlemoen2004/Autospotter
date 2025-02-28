<?php
include 'db.php';

$stockNumber = $_GET['stock_number'];
$query = "SELECT 
    make, 
    model, 
    year_model, 
    odometer, 
    selling_price, 
    vehicle_colour AS colour, 
    vehicle_body_style AS body_style, 
    vehicle_fuel_type AS fuel_type, 
    vehicle_transmission AS transmission 
FROM vehicles 
WHERE stock_number = $1";
$result = pg_query_params($conn, $query, [$stockNumber]);
$vehicle = pg_fetch_assoc($result);

header('Content-Type: application/json');
echo json_encode($vehicle);
?>