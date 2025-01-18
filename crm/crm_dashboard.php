<?php
include 'crm_header.php';
include 'db_connection.php';

// Get total employees
$employeeCount = $conn->query("SELECT COUNT(*) AS total FROM employees")->fetch_assoc()['total'];

// Get total clients
$clientCount = $conn->query("SELECT COUNT(*) AS total FROM clients")->fetch_assoc()['total'];

// Get total active tasks (Pending & In Progress)
$activeTaskCount = $conn->query("SELECT COUNT(*) AS total FROM tasks WHERE status IN ('Pending', 'In Progress')")->fetch_assoc()['total'];

// Get total reminders
$reminderCount = $conn->query("SELECT COUNT(*) AS total FROM reminders")->fetch_assoc()['total'];

// Get total revenue from payments
$revenueTotal = $conn->query("SELECT SUM(amount) AS total FROM payments")->fetch_assoc()['total'];
$revenueTotal = $revenueTotal ? $revenueTotal : 0; // Ensure it shows 0 if no payments

//Get total expenses fromexpenses
$expenseTotal = $conn->query("SELECT SUM(amount) AS total FROM expenses")->fetch_assoc()['total'];
$expenseTotal = $expenseTotal ? $expenseTotal : 0; // Ensure it shows 0 if no payments

// Get revenue data for chart
$revenueData = $conn->query("
    SELECT DATE(payment_date) AS date, SUM(amount) AS total 
    FROM payments 
    GROUP BY DATE(payment_date) 
    ORDER BY DATE(payment_date) ASC
");
$dates = [];
$revenues = [];
while ($row = $revenueData->fetch_assoc()) {
    $dates[] = $row['date'];
    $revenues[] = $row['total'];
}
?>

<div class="container mt-4">
    <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>

    <div class="row">
        <div class="col-md-3">
            <div class="card bg-black text-white p-3">
                <h4>Employees</h4>
                <p>Total: <?php echo $employeeCount; ?></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-black text-white p-3">
                <h4>Clients</h4>
                <p>Total: <?php echo $clientCount; ?></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-black text-white p-3">
                <h4>Active Tasks</h4>
                <p>Total: <?php echo $activeTaskCount; ?></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-black text-white p-3">
                <h4>Reminders</h4>
                <p>Total: <?php echo $reminderCount; ?></p>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card bg-black text-white p-3">
                <h4>Total Revenue</h4>
                <p>$<?php echo number_format($revenueTotal, 2); ?></p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-black text-white p-3">
                <h4>Total Expenses</h4>
                <p>$<?php echo number_format($expenseTotal, 2); ?></p>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <h3>Revenue Over Time</h3>
        <canvas id="revenueChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('revenueChart').getContext('2d');
    document.getElementById('revenueChart').width = 600;  // Set width
    document.getElementById('revenueChart').height = 300; // Set height


    var revenueChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($dates); ?>,
            datasets: [{
                label: 'Revenue ($)',
                data: <?php echo json_encode($revenues); ?>,
                borderColor: '#4CAF50',
                backgroundColor: 'rgba(76, 175, 80, 0.2)',
                borderWidth: 2
            }]
        },
        options: {
            responsive: false, // Disable auto-resizing
            maintainAspectRatio: false, // Allows custom size
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<?php include 'crm_footer.php'; ?>