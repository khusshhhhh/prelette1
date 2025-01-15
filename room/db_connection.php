<?php
// db_connection.php

// Database connection settings for PostgreSQL in pgAdmin
$host = 'localhost';       // Hostname of the PostgreSQL server (use 'localhost' if on the same machine)
$port = '5432';            // Default PostgreSQL port
$dbname = 'room_finder';    // Name of the PostgreSQL database
$username = 'postgres'; // PostgreSQL username
$password = 'khush3160'; // PostgreSQL password

try {
    // Create a new PDO instance for connecting to the PostgreSQL database
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);

    // Set the PDO error mode to exception for better error handling
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Optional: Uncomment the line below to verify the connection during testing
    // echo "Connected to PostgreSQL database successfully!";
} catch (PDOException $e) {
    // If the connection fails, output an error message and stop the script
    die("Database connection failed: " . $e->getMessage());
}
?>