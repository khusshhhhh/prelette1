<?php
$host = 'localhost';
$username = "khush";
$password = "Khush@3160"; // Use your database password
$dbname = "prelette_customer"; // Replace with your database name

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
echo "Database connection successful!";
?>