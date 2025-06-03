<?php
// db_conn.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "youth_for_survival";

// Create connection using mysqli
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

// Optional: Set character set to utf8mb4 for full Unicode support
if (!$conn->set_charset("utf8mb4")) {
    die("Error setting character set: " . $conn->error);
}

// Optional: Print success message for debugging
// echo "Connected successfully"; // Uncomment if you want to check successful connection
?>
