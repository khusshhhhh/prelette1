<?php
$servername = "localhost";
$username = "khush"; // Change this if needed
$password = "Khush@3160"; // Change this if needed
$dbname = "prelette_customer"; // Ensure this database exists

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}
?>