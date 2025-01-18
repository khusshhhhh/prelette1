<?php include 'crm_header.php';
include 'db_connection.php'; ?>

<div class="container mt-4">
    <h2>Payments Management</h2>
    <a href="crm_add_payment.php" class="btn btn-primary mb-3">Add Payment</a>

    <!-- Success/Error Messages -->
    <?php if (isset($_GET['msg'])) {
        echo "<div class='alert alert-success'>{$_GET['msg']}</div>";
    } ?>
    <?php if (isset($_GET['error'])) {
        echo "<div class='alert alert-danger'>{$_GET['error']}</div>";
    } ?>

    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Amount ($)</th>
                <th>Payment Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query("
                SELECT payments.id, payments.amount, payments.payment_date, clients.name AS client_name 
                FROM payments 
                JOIN clients ON payments.client_id = clients.id
            ");

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['client_name']}</td>
                    <td>\${$row['amount']}</td>
                    <td>{$row['payment_date']}</td>
                    <td>
                        <a href='crm_edit_payment.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                        <a href='crm_delete_payment.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this payment?\")'>Delete</a>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include 'crm_footer.php'; ?>