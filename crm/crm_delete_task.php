<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);  // Ensures ID is an integer to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM tasks WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: crm_tasks.php?msg=Task deleted successfully");
    } else {
        header("Location: crm_tasks.php?error=Error deleting task");
    }
    $stmt->close();
}

$conn->close();
?>