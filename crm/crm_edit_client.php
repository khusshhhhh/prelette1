<?php
session_start();
include 'crm_header.php';
include 'db_connection.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: crm_clients.php");
    exit();
}

$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM clients WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$client = $result->fetch_assoc();

if (!$client) {
    echo "<div class='container mt-5'><h3 class='text-danger'>Client not found.</h3></div>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("CSRF validation failed!");
    }

    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $company = htmlspecialchars($_POST['company']);
    $address = htmlspecialchars($_POST['address']);
    $note = htmlspecialchars($_POST['note']);

    $update_stmt = $conn->prepare("UPDATE clients SET name=?, email=?, phone=?, company=?, address=?, note=? WHERE id=?");
    $update_stmt->bind_param("ssssssi", $name, $email, $phone, $company, $address, $note, $id);
    if ($update_stmt->execute()) {
        header("Location: crm_clients.php?msg=Client updated successfully");
        exit();
    } else {
        $error = "Error updating client: " . $update_stmt->error;
    }
}

$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
?>

<div class="container mt-4">
    <h2>Edit Client</h2>
    <?php if (isset($error)) {
        echo "<div class='alert alert-danger'>$error</div>";
    } ?>
    <form method="POST">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($client['name']); ?>"
                required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control"
                value="<?php echo htmlspecialchars($client['email']); ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control"
                value="<?php echo htmlspecialchars($client['phone']); ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Company</label>
            <input type="text" name="company" class="form-control"
                value="<?php echo htmlspecialchars($client['company']); ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Address</label>
            <textarea name="address" class="form-control"><?php echo htmlspecialchars($client['address']); ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Note</label>
            <textarea name="note" class="form-control"><?php echo htmlspecialchars($client['note']); ?></textarea>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="crm_clients.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php include 'crm_footer.php'; ?>