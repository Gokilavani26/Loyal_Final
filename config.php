<?php
// config.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_loyal";

// Define your correct username and password for regular user
$correctUsername = "user";
$correctPassword = "12345";

// Define your admin username and password
$adminUsername = "admin";
$adminPassword = "admin123";

//threshhold for minimum alert
$threshold = 50;

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
