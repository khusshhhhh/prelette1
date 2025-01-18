<?php
include 'crm_header.php';
include 'db_connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM reminders WHERE id = $id");
    $reminder = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $reminder_date = $_POST['reminder_date'];

    $conn->query("UPDATE reminders SET title='$title', description='$description', reminder_date='$reminder_date' WHERE id=$id");
    header("Location: crm_reminders.php");
}
?>

<div class="container mt-4">
    <h2>Edit Reminder</h2>
    <form method="POST">
        <input type="text" name="title" class="form-control mb-2" value="<?php echo $reminder['title']; ?>" required>
        <textarea name="description" class="form-control mb-2"><?php echo $reminder['description']; ?></textarea>
        <input type="date" name="reminder_date" class="form-control mb-2"
            value="<?php echo $reminder['reminder_date']; ?>" required>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>

<?php include 'crm_footer.php'; ?>