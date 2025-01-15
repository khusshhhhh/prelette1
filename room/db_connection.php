<?php
// MySQL database connection
$host = 'localhost';         // MySQL hostname
$dbname = 'room_finder';     // Name of the MySQL database
$username = 'khush'; // MySQL database username
$password = 'Khush@3160'; // MySQL database password

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>