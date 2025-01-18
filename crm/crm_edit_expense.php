<?php
include 'crm_header.php';
include 'db_connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM expenses WHERE id = $id");
    $expense = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $amount = $_POST['amount'];
    $expense_date = $_POST['expense_date'];
    $note = $_POST['note'];
    $details = $_POST['details'];

    $stmt = $conn->prepare("UPDATE expenses SET amount=?, expense_date=?, note=?, details=? WHERE id=?");
    $stmt->bind_param("dsssi", $amount, $expense_date, $note, $details, $id);

    if ($stmt->execute()) {
        header("Location: crm_expenses.php?msg=Expense updated successfully");
    } else {
        $error = "Error updating expense!";
    }
}
?>

<div class="container mt-4">
    <h2>Edit Expense</h2>
    <?php if (isset($error)) {
        echo "<div class='alert alert-danger'>$error</div>";
    } ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Amount ($)</label>
            <input type="number" step="0.01" name="amount" class="form-control"
                value="<?php echo $expense['amount']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" name="expense_date" class="form-control" value="<?php echo $expense['expense_date']; ?>"
                required>
        </div>

        <div class="mb-3">
            <label class="form-label">Note</label>
            <input type="text" name="note" class="form-control" value="<?php echo $expense['note']; ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Details</label>
            <textarea name="details" class="form-control"><?php echo $expense['details']; ?></textarea>
        </div>

        <button type="submit" class="btn btn-success">Update Expense</button>
    </form>
</div>

<?php include 'crm_footer.php'; ?>