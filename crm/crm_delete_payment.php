<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM payments WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: crm_payments.php?msg=Payment deleted successfully");
    } else {
        header("Location: crm_payments.php?error=Error deleting payment");
    }
}
?>