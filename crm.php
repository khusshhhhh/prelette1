<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['loggedin'])) {
    header("Location: crmlogin.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_client'])) {
        $name = $conn->real_escape_string($_POST['name']);
        $email = $conn->real_escape_string($_POST['email']);
        $hosting_plan = $conn->real_escape_string($_POST['hosting_plan']);

        $conn->query("INSERT INTO clients (name, email, hosting_plan) VALUES ('$name', '$email', '$hosting_plan')");
    }

    if (isset($_POST['add_payment'])) {
        $client_id = $conn->real_escape_string($_POST['client_id']);
        $amount = $conn->real_escape_string($_POST['amount']);
        $date = date("Y-m-d");

        $conn->query("INSERT INTO payments (client_id, amount, payment_date) VALUES ('$client_id', '$amount', '$date')");
    }
}
$clients = $conn->query("SELECT * FROM clients");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM Dashboard</title>
    <link rel="shortcut icon" href="assets/imgs/logo/fav.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="d-flex">
        <div class="bg-dark text-white p-3 vh-100" style="width: 250px;">
            <h4>Prelette | CRM</h4>
            <ul class="nav flex-column">
                <li class="nav-item"><a href="crm.php" class="nav-link text-white">Dashboard</a></li>
                <li class="nav-item"><a href="crmlogout.php" class="nav-link text-white">Logout</a></li>
            </ul>
        </div>

        <div class="container p-4">
            <h3>Client Management</h3>
            <form method="POST">
                <input type="text" name="name" placeholder="Client Name" class="form-control mb-2" required>
                <input type="email" name="email" placeholder="Client Email" class="form-control mb-2" required>
                <input type="text" name="hosting_plan" placeholder="Hosting Plan" class="form-control mb-2" required>
                <button type="submit" name="add_client" class="btn btn-success">Add Client</button>
            </form>

            <h3 class="mt-4">Payments</h3>
            <form method="POST">
                <select name="client_id" class="form-control mb-2">
                    <?php while ($row = $clients->fetch_assoc()) {
                        echo "<option value='{$row['id']}'>{$row['name']}</option>";
                    } ?>
                </select>
                <input type="number" name="amount" placeholder="Amount" class="form-control mb-2" required>
                <button type="submit" name="add_payment" class="btn btn-primary">Add Payment</button>
            </form>

            <h3 class="mt-4">Client List</h3>
            <table class="table">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Hosting Plan</th>
                </tr>
                <?php
                $clients = $conn->query("SELECT * FROM clients");
                while ($row = $clients->fetch_assoc()) {
                    echo "<tr><td>{$row['name']}</td><td>{$row['email']}</td><td>{$row['hosting_plan']}</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>

</html>