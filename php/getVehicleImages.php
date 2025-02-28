<?php
header('Content-Type: application/json');

// Use a safe filter for stockNumber (you might adjust based on your needs)
$stockNumber = filter_input(INPUT_GET, 'stockNumber', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$directory = "../img/vehicles/" . $stockNumber;
$images = [];

if (is_dir($directory)) {
    // Scan directory for files
    $files = scandir($directory);
    foreach ($files as $file) {
        // Adjust the regular expression if your naming pattern is different.
        // For example, if images are named like "UP1030_20250124140633_1.jpg":
        if (preg_match('/^' . preg_quote($stockNumber, '/') . '_.*\.jpg$/i', $file)) {
            $images[] = $file;
        }
    }
}

// Return the array of image file names
echo json_encode($images);
?>
