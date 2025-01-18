<?php
include 'crm_header.php';
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $amount = $_POST['amount'];
    $expense_date = $_POST['expense_date'];
    $note = $_POST['note'];
    $details = $_POST['details'];

    $stmt = $conn->prepare("INSERT INTO expenses (amount, expense_date, note, details) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("dsss", $amount, $expense_date, $note, $details);

    if ($stmt->execute()) {
        header("Location: crm_expenses.php?msg=Expense added successfully");
    } else {
        $error = "Error adding expense!";
    }
}
?>

<div class="container mt-4">
    <h2>Add Expense</h2>
    <?php if (isset($error)) {
        echo "<div class='alert alert-danger'>$error</div>";
    } ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Amount ($)</label>
            <input type="number" step="0.01" name="amount" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" name="expense_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Note</label>
            <input type="text" name="note" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Details</label>
            <textarea name="details" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Add Expense</button>
        <a href="crm_expenses.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php include 'crm_footer.php'; ?>