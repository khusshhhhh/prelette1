<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: crm_login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Prelette | CRM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-dark bg-dark navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="crm_dashboard.php">Ultimate CRM</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="crm_dashboard.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="crm_employees.php">Employees</a></li>
                    <li class="nav-item"><a class="nav-link" href="crm_clients.php">Clients</a></li>
                    <li class="nav-item"><a class="nav-link" href="crm_tasks.php">Tasks</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-danger text-white" href="crm_logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>