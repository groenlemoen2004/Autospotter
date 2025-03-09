<?php
$host = 'localhost';
$db = 'vehicles_db';
$user = 'Estian';
$password = 'Estian2004';
$port = '5432';

try {
    // Set up DSN (Data Source Name)
    $dsn = "pgsql:host=$host;port=$port;dbname=$db;";
    
    // Create a PDO instance
    $pdo = new PDO($dsn, $user, $password);
    
    // Set error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Return the PDO object (optional, in case you want to return it from the db.php)
    return $pdo;
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}
?>
