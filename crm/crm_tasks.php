<?php include 'crm_header.php';
include 'db_connection.php'; ?>

<div class="container mt-4">
    <h2>Task Management</h2>
    <a href="crm_add_task.php" class="btn btn-primary mb-3">Add Task</a>

    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Assigned To</th>
                <th>Client</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query("
                SELECT tasks.id, tasks.title, employees.name AS employee, clients.name AS client, tasks.due_date, tasks.status 
                FROM tasks 
                LEFT JOIN employees ON tasks.assigned_employee_id = employees.id 
                LEFT JOIN clients ON tasks.client_id = clients.id");

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['title']}</td>
                    <td>{$row['employee']}</td>
                    <td>{$row['client']}</td>
                    <td>{$row['due_date']}</td>
                    <td>{$row['status']}</td>
                    <td>
                        <a href='crm_edit_task.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                        <a href='crm_delete_task.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include 'crm_footer.php'; ?>