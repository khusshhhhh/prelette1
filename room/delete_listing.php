<?php
require 'db_connection.php';
session_start();

// Check if the host is logged in
if (!isset($_SESSION['host_id'])) {
    header("Location: signup.php");
    exit();
}

// Check if the listing ID is provided
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['listing_id'])) {
    $listingId = $_POST['listing_id'];
    $hostId = $_SESSION['host_id'];

    try {
        // Prepare the SQL statement to delete the listing
        $stmt = $conn->prepare("DELETE FROM listings WHERE listing_id = :listing_id AND host_id = :host_id");
        $stmt->bindParam(':listing_id', $listingId, PDO::PARAM_INT);
        $stmt->bindParam(':host_id', $hostId, PDO::PARAM_INT);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to the account page after successful deletion
            header("Location: account.php");
            exit();
        } else {
            die("Failed to delete the listing.");
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
} else {
    // Redirect to the account page if no listing ID is provided
    header("Location: account.php");
    exit();
}
?>