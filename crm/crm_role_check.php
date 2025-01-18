<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: crm_login.php");
    exit();
}

// Restrict pages based on roles
function checkRole($allowedRoles)
{
    if (!in_array($_SESSION['role'], $allowedRoles)) {
        echo "<div class='alert alert-danger'>Access Denied</div>";
        exit();
    }
}
?>