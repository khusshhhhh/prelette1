<?php
include 'crm_header.php';
include 'db_connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM clients WHERE id = $id");
    $client = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $company = $_POST['company'];
    $address = $_POST['address'];

    $conn->query("UPDATE clients SET name='$name', email='$email', phone='$phone', company='$company', address='$address' WHERE id=$id");
    header("Location: crm_clients.php");
}
?>

<div class="container mt-4">
    <h2>Edit Client</h2>
    <form method="POST">
        <input type="text" name="name" class="form-control mb-2" value="<?php echo $client['name']; ?>" required>
        <input type="email" name="email" class="form-control mb-2" value="<?php echo $client['email']; ?>" required>
        <input type="text" name="phone" class="form-control mb-2" value="<?php echo $client['phone']; ?>" required>
        <input type="text" name="company" class="form-control mb-2" value="<?php echo $client['company']; ?>" required>
        <textarea name="address" class="form-control mb-2"><?php echo $client['address']; ?></textarea>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>

<?php include 'crm_footer.php'; ?>