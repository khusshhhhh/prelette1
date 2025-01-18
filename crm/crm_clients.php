<?php include 'crm_header.php'; ?>
<div class="container mt-4">
    <h2>Client Management</h2>
    <a href="crm_add_client.php" class="btn btn-primary mb-3">Add Client</a>

    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Company</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query("SELECT * FROM clients");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['phone']}</td>
                    <td>{$row['company']}</td>
                    <td>
                        <a href='crm_edit_client.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                        <a href='crm_delete_client.php?id={$row['id']}' class='btn btn-danger btn-sm'>Delete</a>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<?php include 'crm_footer.php'; ?>