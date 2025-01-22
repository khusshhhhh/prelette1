<?php
include 'crm_header.php';
include 'db_connection.php';

$result = $conn->query("SELECT * FROM blogs_html ORDER BY date DESC");
?>

<div class="container mt-4">
    <h2>All Blogs</h2>
    <a href="crm_add_blog.php" class="btn btn-primary mb-3">Add Blog</a>

    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                    <td><?php echo htmlspecialchars($row['author']); ?></td>
                    <td><?php echo $row['date']; ?></td>
                    <td>
                        <a href="edit_blog.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete_blog.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                        <a href="blog_detail.php?seo_url=<?php echo urlencode($row['seo_url']); ?>"
                            class="btn btn-info btn-sm" target="_blank">View</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include 'crm_footer.php'; ?>