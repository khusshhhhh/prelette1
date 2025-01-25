<?php
session_start();
include 'db_connection.php';
include 'crm_header.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: crm_clients.php");
    exit();
}

$client_id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM clients WHERE id = ?");
$stmt->bind_param("i", $client_id);
$stmt->execute();
$result = $stmt->get_result();
$client = $result->fetch_assoc();

if (!$client) {
    echo "<div class='container mt-5'><h3 class='text-danger'>Client not found.</h3></div>";
    exit();
}
?>

<div class="container mt-5">
    <h2 class="mb-4">Client Details</h2>
    <table class="table table-bordered">
        <tr>
            <th>Client ID</th>
            <td><?php echo htmlspecialchars($client['id']); ?></td>
        </tr>
        <tr>
            <th>Name</th>
            <td><?php echo htmlspecialchars($client['name']); ?></td>
        </tr>
        <tr>
            <th>Phone</th>
            <td><?php echo htmlspecialchars($client['phone']); ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?php echo htmlspecialchars($client['email']); ?></td>
        </tr>
        <tr>
            <th>Company</th>
            <td><?php echo htmlspecialchars($client['company']); ?></td>
        </tr>
        <tr>
            <th>Note</th>
            <td><?php echo htmlspecialchars($client['note']); ?></td>
        </tr>
    </table>

    <h4 class="mt-4">Payment History</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Payment ID</th>
                <th>Amount</th>
                <th>Payment Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $payment_stmt = $conn->prepare("SELECT * FROM payments WHERE client_id = ?");
            $payment_stmt->bind_param("i", $client_id);
            $payment_stmt->execute();
            $payment_result = $payment_stmt->get_result();
            if ($payment_result->num_rows > 0) {
                while ($payment = $payment_result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($payment['id']) . "</td>
                            <td>$" . htmlspecialchars($payment['amount']) . "</td>
                            <td>" . htmlspecialchars($payment['payment_date']) . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='3' class='text-center text-muted'>No payment records found.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <h4 class="mt-4">Expense History</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Expense ID</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Note</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $expense_stmt = $conn->prepare("SELECT * FROM expenses WHERE client_id = ?");
            $expense_stmt->bind_param("i", $client_id);
            $expense_stmt->execute();
            $expense_result = $expense_stmt->get_result();
            if ($expense_result->num_rows > 0) {
                while ($expense = $expense_result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($expense['id']) . "</td>
                            <td>$" . htmlspecialchars($expense['amount']) . "</td>
                            <td>" . htmlspecialchars($expense['date']) . "</td>
                            <td>" . htmlspecialchars($expense['note']) . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4' class='text-center text-muted'>No expense records found.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <a href="crm_clients.php" class="btn btn-secondary mt-3">Back to Clients</a>
</div>

<?php include 'crm_footer.php'; ?>