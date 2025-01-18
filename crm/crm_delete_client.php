<?php
include 'db_connection.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn->query("DELETE FROM clients WHERE id = $id");
}
header("Location: crm_clients.php");
?>