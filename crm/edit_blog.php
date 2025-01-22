<?php
include 'crm_header.php';
include 'db_connection.php';

if (!isset($_GET['id'])) {
        header("Location: view_blog.php");
        exit();
}

$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM blogs_html WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$blog = $stmt->get_result()->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $date = $_POST['date'];
        $content = $_POST['content'];
        $image_url1 = !empty($_POST["image_url1"]) ? $_POST["image_url1"] : $blog['image_url1'];
        $seo_url = strtolower(str_replace(" ", "-", preg_replace("/[^a-zA-Z0-9\s]/", "", $title)));

        $stmt = $conn->prepare("UPDATE blogs_html 
                            SET title=?, author=?, date=?, content=?, image_url1=?, seo_url=? 
                            WHERE id=?");
        $stmt->bind_param("ssssssi", $title, $author, $date, $content, $image_url1, $seo_url, $id);

        if ($stmt->execute()) {
                header("Location: blog_detail.php?seo_url=" . urlencode($seo_url) . "&msg=Blog updated successfully");
                exit();
        } else {
                $error = "Error updating blog!";
        }
}
?>

<div class="container mt-4">
        <h2>Edit Blog</h2>
        <?php if (isset($error))
                echo "<div class='alert alert-danger'>$error</div>"; ?>

        <form method="POST">
                <div class="mb-3"><input type="text" name="title" class="form-control"
                                value="<?php echo htmlspecialchars($blog['title']); ?>" required></div>
                <div class="mb-3"><input type="text" name="author" class="form-control"
                                value="<?php echo htmlspecialchars($blog['author']); ?>" required></div>
                <div class="mb-3"><input type="date" name="date" class="form-control"
                                value="<?php echo $blog['date']; ?>" required></div>

                <div class="mb-3">
                        <label>Current Image:</label><br>
                        <img src="<?php echo htmlspecialchars($blog['image_url1']); ?>" width="150"><br>
                        <input type="text" name="image_url1" class="form-control"
                                placeholder="New Image URL (Optional)">
                </div>

                <div class="mb-3">
                        <label>Blog Content (HTML):</label>
                        <textarea name="content" class="form-control"
                                rows="10"><?php echo htmlspecialchars($blog['content']); ?></textarea>
                </div>

                <button type="submit" class="btn btn-success">Update Blog</button>
                <a href="view_blog.php" class="btn btn-secondary">Cancel</a>
        </form>
</div>

<?php include 'crm_footer.php'; ?>