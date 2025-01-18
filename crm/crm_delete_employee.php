<?php
include 'db_connection.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn->query("DELETE FROM employees WHERE id = $id");
}
header("Location: crm_employees.php");
?>