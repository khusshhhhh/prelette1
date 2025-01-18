<?php include 'crm_header.php';
include 'db_connection.php'; ?>

<div class="container mt-4">
    <h2>Employee Management</h2>
    <a href="crm_add_employee.php" class="btn btn-primary mb-3">Add Employee</a>

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
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query("SELECT * FROM employees");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['phone']}</td>
                    <td>
                        <a href='crm_edit_employee.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                        <a href='crm_delete_employee.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include 'crm_footer.php'; ?>