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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prelette | CRM</title>
    <link rel="shortcut icon" href="../assets/imgs/logo/fav.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        /* Ensure the navbar sticks at the top */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        /* Restrict message column width & height */
        .message-column {
            max-width: 300px;
            overflow: hidden;
            word-wrap: break-word;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .message-content {
            max-width: 300px;
            max-height: 120px;
            /* Limit height */
            overflow-y: auto;
            overflow-x: hidden;
            word-wrap: break-word;
            white-space: normal;
        }

        /* Set fixed size for notes */
        .note-input {
            width: 120px;
            height: 80px;
            resize: none;
            /* Prevent manual resizing */
        }

        /* Ensure table remains responsive */
        .table-responsive {
            overflow-x: auto;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-dark bg-dark navbar-expand-lg py-3">
        <div class="container">
            <a class="navbar-brand btn btn-outline-primary text-white" href="crm_dashboard.php">Dashboard</a>
            <a class="navbar-brand btn btn-outline-primary text-white"
                href="https://sg2plzcpnl505644.prod.sin2.secureserver.net:2083/cpsess1725572216/frontend/jupiter/index.html"
                target="_blank" rel="noopener noreferrer">cPanel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link btn btn-outline-info text-white"
                            href="crm_employees.php">Employees</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-outline-info text-white"
                            href="crm_clients.php">Clients</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-outline-info text-white"
                            href="crm_tasks.php">Tasks</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-outline-info text-white"
                            href="crm_reminders.php">Reminders</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-outline-info text-white"
                            href="crm_payments.php">Payments</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-outline-info text-white"
                            href="crm_expenses.php">Expenses</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-outline-info text-white"
                            href="crm_view_data.php">Contact Form</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-outline-info text-white"
                            href="view_blog.php">Blogs</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-danger text-white" href="crm_logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>