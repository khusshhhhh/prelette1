<?php
include 'crm_header.php';
include 'db_connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM employees WHERE id = $id");
    $employee = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $conn->query("UPDATE employees SET name='$name', email='$email', phone='$phone' WHERE id=$id");
    header("Location: crm_employees.php");
}
?>

<div class="container mt-4">
    <h2>Edit Employee</h2>
    <form method="POST">
        <input type="text" name="name" class="form-control mb-2" value="<?php echo $employee['name']; ?>" required>
        <input type="email" name="email" class="form-control mb-2" value="<?php echo $employee['email']; ?>" required>
        <input type="text" name="phone" class="form-control mb-2" value="<?php echo $employee['phone']; ?>" required>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>

<?php include 'crm_footer.php'; ?>