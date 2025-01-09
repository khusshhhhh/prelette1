<?php
$servername = "localhost"; // Database server (usually localhost)
$username = "khush";
$password = "Khush@3160";
$dbname = "prelette_customer"; // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>