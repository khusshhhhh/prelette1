<?php
$host = 'localhost';
$username = "khush";
$password = "Khush@3160"; // Use your database password
$dbname = "prelette_customer"; // Replace with your database name

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
