<?php include 'crm_header.php'; ?>

<div class="container mt-4">
    <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>

    <div class="row">
        <div class="col-md-3">
            <div class="card bg-primary text-white p-3">
                <h4>Employees</h4>
                <p>Total: 5</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white p-3">
                <h4>Clients</h4>
                <p>Total: 20</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-dark p-3">
                <h4>Active Tasks</h4>
                <p>Total: 12</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-danger text-white p-3">
                <h4>Reminders</h4>
                <p>Total: 8</p>
            </div>
        </div>
    </div>
</div>

<?php include 'crm_footer.php'; ?>