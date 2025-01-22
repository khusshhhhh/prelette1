<?php
session_start();
include 'db_connection.php';
include 'crm_header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title']);
    $author = trim($_POST['author']);
    $date = $_POST['date'];
    $content = $_POST['content']; // HTML content
    $image_url1 = $_POST['image_url1'];

    // Generate SEO-friendly URL
    $seo_url = strtolower(str_replace(' ', '-', preg_replace("/[^a-zA-Z0-9\s]/", "", $title)));

    // Check if SEO URL already exists
    $check_stmt = $conn->prepare("SELECT id FROM blogs_html WHERE seo_url = ?");
    $check_stmt->bind_param("s", $seo_url);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        $error = "A blog with this title already exists. Try a different title.";
    } else {
        // Insert blog into blogs_html table
        $stmt = $conn->prepare("INSERT INTO blogs_html (title, author, date, content, seo_url, image_url1) 
                                VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $title, $author, $date, $content, $seo_url, $image_url1);

        if ($stmt->execute()) {
            header("Location: view_blog.php?msg=Blog added successfully");
            exit();
        } else {
            $error = "Error adding blog!";
        }
    }
}
?>

<div class="container mt-4">
    <h2 class="text-center mb-4">Add New Blog</h2>
    <?php if (isset($error))
        echo "<div class='alert alert-danger'>$error</div>"; ?>

    <form method="POST">
        <div class="mb-3"><input type="text" name="title" class="form-control" placeholder="Blog Title" required></div>
        <div class="mb-3"><input type="text" name="author" class="form-control" placeholder="Author Name" required>
        </div>
        <div class="mb-3"><input type="date" name="date" class="form-control" required></div>
        <div class="mb-3"><input type="text" name="image_url1" class="form-control" placeholder="Main Image URL"
                required></div>
        <div class="mb-3"><textarea name="content" class="form-control" rows="20" placeholder="Enter HTML script here"
                required></textarea></div>
        <button type="submit" class="btn btn-success">Add Blog</button>
        <a href="view_blog.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php include 'crm_footer.php'; ?>