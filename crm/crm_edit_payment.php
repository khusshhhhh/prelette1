<?php
include 'crm_header.php';
include 'db_connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM payments WHERE id = $id");
    $payment = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $client_id = $_POST['client_id'];
    $amount = $_POST['amount'];
    $payment_date = $_POST['payment_date'];

    $stmt = $conn->prepare("UPDATE payments SET client_id=?, amount=?, payment_date=? WHERE id=?");
    $stmt->bind_param("idsi", $client_id, $amount, $payment_date, $id);

    if ($stmt->execute()) {
        header("Location: crm_payments.php?msg=Payment updated successfully");
    } else {
        $error = "Error updating payment!";
    }
}
?>

<div class="container mt-4">
    <h2>Edit Payment</h2>
    <?php if (isset($error)) {
        echo "<div class='alert alert-danger'>$error</div>";
    } ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Client</label>
            <select name="client_id" class="form-control" required>
                <?php
                $clients = $conn->query("SELECT id, name FROM clients");
                while ($client = $clients->fetch_assoc()) {
                    $selected = ($client['id'] == $payment['client_id']) ? "selected" : "";
                    echo "<option value='{$client['id']}' $selected>{$client['name']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Amount ($)</label>
            <input type="number" step="0.01" name="amount" class="form-control"
                value="<?php echo $payment['amount']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Payment Date</label>
            <input type="date" name="payment_date" class="form-control" value="<?php echo $payment['payment_date']; ?>"
                required>
        </div>

        <button type="submit" class="btn btn-success">Update Payment</button>
    </form>
</div>

<?php include 'crm_footer.php'; ?>