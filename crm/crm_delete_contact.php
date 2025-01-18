<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("DELETE FROM contact_us WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: crm_view_data.php?msg=Message deleted successfully");
    } else {
        header("Location: crm_view_data.php?error=Error deleting message");
    }
}
?>