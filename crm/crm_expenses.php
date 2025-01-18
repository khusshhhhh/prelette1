<?php include 'crm_header.php';
include 'db_connection.php'; ?>

<div class="container mt-4">
    <h2>Expense Management</h2>
    <a href="crm_add_expense.php" class="btn btn-primary mb-3">Add Expense</a>

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
                <th>Amount ($)</th>
                <th>Date</th>
                <th>Note</th>
                <th>Details</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query("SELECT * FROM expenses ORDER BY expense_date DESC");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['id']}</td>
                    <td>\${$row['amount']}</td>
                    <td>{$row['expense_date']}</td>
                    <td>{$row['note']}</td>
                    <td>{$row['details']}</td>
                    <td>
                        <a href='crm_edit_expense.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                        <a href='crm_delete_expense.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this expense?\")'>Delete</a>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include 'crm_footer.php'; ?>