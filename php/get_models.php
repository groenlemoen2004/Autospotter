<?php
include '../php/db.php';

// Get the make parameter from the GET request
$make = isset($_GET['make']) ? pg_escape_string($conn, $_GET['make']) : '';

if ($make) {
    $modelQuery = "SELECT DISTINCT model FROM vehicle_info WHERE make ILIKE '%$make%'";
    $modelResult = pg_query($conn, $modelQuery);
    
    $models = [];
    while ($modelRow = pg_fetch_assoc($modelResult)) {
        $models[] = $modelRow['model'];
    }

    echo json_encode($models);
} else {
    echo json_encode([]);
}
?>
