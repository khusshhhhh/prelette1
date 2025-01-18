<?php
include 'crm_header.php';
include 'db_connection.php';

// Fetch contact form submissions
$result = $conn->query("SELECT * FROM contact_us ORDER BY date DESC");
?>

<div class="container mt-4">
    <h2>Contact Us Submissions</h2>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Subject</th>
                    <th style="width: 250px;">Message</th> <!-- Restrict message width -->
                    <th>Date</th>
                    <th style="width: 150px;">Admin Notes</th> <!-- Adjusted width -->
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
                        <td class="message-column">
                            <div class="message-content"><?php echo nl2br(htmlspecialchars($row['message'])); ?></div>
                        </td>
                        <td><?php echo $row['date']; ?></td>
                        <td>
                            <textarea class="form-control note-input"
                                data-id="<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['note']); ?></textarea>
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

<!-- jQuery & AJAX for auto-saving notes -->
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