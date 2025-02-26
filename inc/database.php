<?php
$host = "localhost";
$dbname = "eightees_ims";
$username = "root";
$password = "";

// Create MySQLi connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
