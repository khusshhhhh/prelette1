<?php
include 'crm_header.php';
include 'db_connection.php';

// Fetch contact form submissions
$result = $conn->query("SELECT * FROM contact_us ORDER BY date DESC");
?>

<div class="container mt-4">
    <h2>Contact Us Submissions</h2>
    <?php if (isset($_GET['msg'])) {
        echo "<div class='alert alert-success'>{$_GET['msg']}</div>";
    } ?>
    <?php if (isset($_GET['error'])) {
        echo "<div class='alert alert-danger'>{$_GET['error']}</div>";
    } ?>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Admin Notes</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['phone']); ?></td>
                        <td><?php echo htmlspecialchars($row['subject']); ?></td>
                        <td><?php echo nl2br(htmlspecialchars($row['message'])); ?></td>
                        <td><?php echo $row['date']; ?></td>
                        <td>
                            <input type="text" class="form-control note-input" data-id="<?php echo $row['id']; ?>"
                                value="<?php echo htmlspecialchars($row['note']); ?>">
                        </td>
                        <td>
                            <a href="crm_delete_contact.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this message?');">
                                Delete
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $(".note-input").on("blur", function () {
            var note = $(this).val();
            var id = $(this).data("id");

            $.ajax({
                url: "crm_update_note.php",
                type: "POST",
                data: { id: id, note: note },
                success: function (response) {
                    console.log("Note updated successfully!");
                },
                error: function () {
                    alert("Failed to update note.");
                }
            });
        });
    });
</script>

<?php include 'crm_footer.php'; ?>