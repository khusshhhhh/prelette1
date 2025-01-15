<?php
require 'db_connection.php';
session_start();

// Check if the host is logged in
if (!isset($_SESSION['host_id'])) {
    header("Location: signup.php");
    exit();
}

// Check if the form data is provided
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['listing_id'])) {
    $listingId = $_POST['listing_id'];
    $hostId = $_SESSION['host_id'];
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $price = trim($_POST['price']);

    // Validate required fields
    if (empty($title) || empty($description) || empty($price)) {
        die("All fields are required.");
    }

    try {
        // Prepare the SQL statement to update the listing
        $stmt = $conn->prepare("
            UPDATE listings
            SET title = :title, description = :description, price = :price, updated_at = NOW()
            WHERE listing_id = :listing_id AND host_id = :host_id
        ");
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_STR);
        $stmt->bindParam(':listing_id', $listingId, PDO::PARAM_INT);
        $stmt->bindParam(':host_id', $hostId, PDO::PARAM_INT);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to the account page after successful update
            header("Location: account.php");
            exit();
        } else {
            die("Failed to update the listing.");
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