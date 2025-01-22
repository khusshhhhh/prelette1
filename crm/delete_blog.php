<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("DELETE FROM blogs_html WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: view_blog.php?msg=Blog deleted successfully");
    } else {
        header("Location: view_blog.php?error=Error deleting blog");
    }
}
?>