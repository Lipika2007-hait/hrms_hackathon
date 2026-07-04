<?php
// Database Connection

$servername = "localhost";
$username = "root";
$password = "";
$database = "hrms_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set character encoding
$conn->set_charset("utf8");
?>