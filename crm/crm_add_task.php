<?php
include 'crm_header.php';
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $assigned_employee_id = $_POST['assigned_employee_id'];
    $client_id = $_POST['client_id'];
    $due_date = $_POST['due_date'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("INSERT INTO tasks (title, description, assigned_employee_id, client_id, due_date, status) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiiss", $title, $description, $assigned_employee_id, $client_id, $due_date, $status);

    if ($stmt->execute()) {
        header("Location: crm_tasks.php?msg=Task added successfully");
    } else {
        $error = "Error adding task!";
    }
}
?>

<div class="container mt-4">
    <h2>Add Task</h2>
    <form method="POST">
        <input type="text" name="title" class="form-control mb-2" placeholder="Title" required>
        <textarea name="description" class="form-control mb-2" placeholder="Description" required></textarea>

        <label>Assign to Employee</label>
        <select name="assigned_employee_id" class="form-control mb-2" required>
            <?php
            $employees = $conn->query("SELECT id, name FROM employees");
            while ($employee = $employees->fetch_assoc()) {
                echo "<option value='{$employee['id']}'>{$employee['name']}</option>";
            }
            ?>
        </select>

        <label>Client</label>
        <select name="client_id" class="form-control mb-2" required>
            <?php
            $clients = $conn->query("SELECT id, name FROM clients");
            while ($client = $clients->fetch_assoc()) {
                echo "<option value='{$client['id']}'>{$client['name']}</option>";
            }
            ?>
        </select>

        <input type="date" name="due_date" class="form-control mb-2" required>
        <button type="submit" class="btn btn-primary">Add Task</button>
    </form>
</div>

<?php include 'crm_footer.php'; ?>