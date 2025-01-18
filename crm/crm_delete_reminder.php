<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);  // Prevents SQL injection
    $stmt = $conn->prepare("DELETE FROM reminders WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: crm_reminders.php?msg=Reminder deleted successfully");
    } else {
        header("Location: crm_reminders.php?error=Error deleting reminder");
    }
    $stmt->close();
}

$conn->close();
?>