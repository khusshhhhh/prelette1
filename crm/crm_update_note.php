<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']);
    $note = $_POST['note'];

    $stmt = $conn->prepare("UPDATE contact_us SET note=? WHERE id=?");
    $stmt->bind_param("si", $note, $id);

    if ($stmt->execute()) {
        echo "Success";
    } else {
        echo "Error";
    }
}
?>