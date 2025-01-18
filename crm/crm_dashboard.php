<?php include 'crm_header.php'; ?>
<div class="container mt-4">
    <h2 class="mb-4">Admin Dashboard</h2>

    <div class="row">
        <div class="col-md-3">
            <div class="card bg-primary text-white p-3">
                <h4>Employees</h4>
                <p>Total: <strong>5</strong></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white p-3">
                <h4>Clients</h4>
                <p>Total: <strong>20</strong></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-dark p-3">
                <h4>Active Tasks</h4>
                <p>Total: <strong>12</strong></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-danger text-white p-3">
                <h4>Pending Reminders</h4>
                <p>Total: <strong>8</strong></p>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <h3>Task Statistics</h3>
        <canvas id="taskChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('taskChart').getContext('2d');
    var taskChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Pending', 'In Progress', 'Completed'],
            datasets: [{
                data: [5, 4, 3], // Replace with real data from PHP
                backgroundColor: ['#FF5733', '#FFC300', '#28A745']
            }]
        }
    });
</script>
<?php include 'crm_footer.php'; ?>