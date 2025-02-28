<?php
$host = 'localhost';
$db = 'vehicles_db';
$user = 'Estian';
$password = 'Estian2004';
$port = '5432';

$dsn = "pgsql:host=$host;port=$port;dbname=$db;user=$user;password=$password";

try {
    // Create a PDO instance
    $pdo = new PDO($dsn);

    // Set error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>