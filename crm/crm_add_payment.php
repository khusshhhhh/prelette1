<?php
include 'crm_header.php';
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $client_id = $_POST['client_id'];
    $amount = $_POST['amount'];
    $payment_date = $_POST['payment_date'];

    $stmt = $conn->prepare("INSERT INTO payments (client_id, amount, payment_date) VALUES (?, ?, ?)");
    $stmt->bind_param("ids", $client_id, $amount, $payment_date);

    if ($stmt->execute()) {
        header("Location: crm_payments.php?msg=Payment added successfully");
    } else {
        $error = "Error adding payment!";
    }
}
?>

<div class="container mt-4">
    <h2>Add Payment</h2>
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
                    echo "<option value='{$client['id']}'>{$client['name']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Amount ($)</label>
            <input type="number" step="0.01" name="amount" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Payment Date</label>
            <input type="date" name="payment_date" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Add Payment</button>
        <a href="crm_payments.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php include 'crm_footer.php'; ?>