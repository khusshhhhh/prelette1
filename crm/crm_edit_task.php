<?php
include 'crm_header.php';
include 'db_connection.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Prevent SQL Injection
    $stmt = $conn->prepare("SELECT * FROM tasks WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $task = $stmt->get_result()->fetch_assoc();
}

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $assigned_employee_id = $_POST['assigned_employee_id'];
    $client_id = $_POST['client_id'];
    $due_date = $_POST['due_date'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE tasks SET title=?, description=?, assigned_employee_id=?, client_id=?, due_date=?, status=? WHERE id=?");
    $stmt->bind_param("ssiiisi", $title, $description, $assigned_employee_id, $client_id, $due_date, $status, $id);

    if ($stmt->execute()) {
        header("Location: crm_tasks.php?msg=Task updated successfully");
    } else {
        $error = "Error updating task!";
    }
}
?>

<div class="container mt-4">
    <h2>Edit Task</h2>
    <?php if (isset($error)) {
        echo "<div class='alert alert-danger'>$error</div>";
    } ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($task['title']); ?>"
                required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control"
                required><?php echo htmlspecialchars($task['description']); ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Assign to Employee</label>
            <select name="assigned_employee_id" class="form-control" required>
                <?php
                $employees = $conn->query("SELECT id, name FROM employees");
                while ($employee = $employees->fetch_assoc()) {
                    $selected = ($employee['id'] == $task['assigned_employee_id']) ? "selected" : "";
                    echo "<option value='{$employee['id']}' $selected>{$employee['name']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Client</label>
            <select name="client_id" class="form-control" required>
                <?php
                $clients = $conn->query("SELECT id, name FROM clients");
                while ($client = $clients->fetch_assoc()) {
                    $selected = ($client['id'] == $task['client_id']) ? "selected" : "";
                    echo "<option value='{$client['id']}' $selected>{$client['name']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Due Date</label>
            <input type="date" name="due_date" class="form-control" value="<?php echo $task['due_date']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control">
                <option value="Pending" <?php if ($task['status'] == "Pending")
                    echo "selected"; ?>>Pending</option>
                <option value="In Progress" <?php if ($task['status'] == "In Progress")
                    echo "selected"; ?>>In Progress
                </option>
                <option value="Completed" <?php if ($task['status'] == "Completed")
                    echo "selected"; ?>>Completed</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update Task</button>
        <a href="crm_tasks.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php include 'crm_footer.php'; ?>