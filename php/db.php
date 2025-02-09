<?php
$host = "localhost";
$dbname = "vehicles_db";
$user = "postgres";
$password = "Estian2004";

// Connect to PostgreSQL
$conn = pg_connect("host=$host dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("Connection to the database 'vehicles_db' failed: " . pg_last_error());
}
?>
