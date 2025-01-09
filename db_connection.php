<?php
$conn = new mysqli("localhost", "khush", "Khush@3160", "prelette_customer");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully!";
?>