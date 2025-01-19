<?php
include 'crm_header.php';
include 'db_connection.php';

// Get the blog ID from URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT * FROM blogs WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $blog = $stmt->get_result()->fetch_assoc();
}

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $date = $_POST['date'];
    $paragraph1 = $_POST['paragraph1'];
    $paragraph2 = $_POST['paragraph2'];
    $paragraph3 = $_POST['paragraph3'];
    $paragraph4 = $_POST['paragraph4'];
    $paragraph5 = $_POST['paragraph5'];
    $tag1 = $_POST['tag1'];
    $tag2 = $_POST['tag2'];
    $tag3 = $_POST['tag3'];

    // Generate SEO-friendly URL
    $seo_url = strtolower(str_replace(" ", "-", preg_replace("/[^a-zA-Z0-9\s]/", "", $title)));

    // Use existing image URLs if no new ones are provided
    $image_url1 = !empty($_POST["image_url1"]) ? $_POST["image_url1"] : $blog['image_url1'];
    $image_url2 = !empty($_POST["image_url2"]) ? $_POST["image_url2"] : $blog['image_url2'];

    // Update the blog entry
    $stmt = $conn->prepare("UPDATE blogs 
                            SET title=?, author=?, date=?, paragraph1=?, paragraph2=?, paragraph3=?, paragraph4=?, paragraph5=?, 
                                tag1=?, tag2=?, tag3=?, image_url1=?, image_url2=?, seo_url=? 
                            WHERE id=?");
    $stmt->bind_param(
        "ssssssssssssssi",
        $title,
        $author,
        $date,
        $paragraph1,
        $paragraph2,
        $paragraph3,
        $paragraph4,
        $paragraph5,
        $tag1,
        $tag2,
        $tag3,
        $image_url1,
        $image_url2,
        $seo_url,
        $id
    );

    if ($stmt->execute()) {
        header("Location: view_blog.php?msg=Blog updated successfully");
    } else {
        $error = "Error updating blog!";
    }
}
?>

<div class="container mt-4">
    <h2>Edit Blog</h2>
    <?php if (isset($error)) {
        echo "<div class='alert alert-danger'>$error</div>";
    } ?>

    <form method="POST">
        <div class="mb-3"><input type="text" name="title" class="form-control"
                value="<?php echo htmlspecialchars($blog['title']); ?>" required></div>
        <div class="mb-3"><input type="text" name="author" class="form-control"
                value="<?php echo htmlspecialchars($blog['author']); ?>" required></div>
        <div class="mb-3"><input type="date" name="date" class="form-control" value="<?php echo $blog['date']; ?>"
                required></div>
        <div class="mb-3"><textarea name="paragraph1" class="form-control"
                required><?php echo htmlspecialchars($blog['paragraph1']); ?></textarea></div>
        <div class="mb-3"><textarea name="paragraph2" class="form-control"
                required><?php echo htmlspecialchars($blog['paragraph2']); ?></textarea></div>
        <div class="mb-3"><textarea name="paragraph3"
                class="form-control"><?php echo htmlspecialchars($blog['paragraph3']); ?></textarea></div>
        <div class="mb-3"><textarea name="paragraph4"
                class="form-control"><?php echo htmlspecialchars($blog['paragraph4']); ?></textarea></div>
        <div class="mb-3"><textarea name="paragraph5"
                class="form-control"><?php echo htmlspecialchars($blog['paragraph5']); ?></textarea></div>
        <div class="mb-3"><input type="text" name="tag1" class="form-control"
                value="<?php echo htmlspecialchars($blog['tag1']); ?>"></div>
        <div class="mb-3"><input type="text" name="tag2" class="form-control"
                value="<?php echo htmlspecialchars($blog['tag2']); ?>"></div>
        <div class="mb-3"><input type="text" name="tag3" class="form-control"
                value="<?php echo htmlspecialchars($blog['tag3']); ?>"></div>

        <!-- Image 1 (Current and Input for New) -->
        <div class="mb-3">
            <label>Current Image 1:</label><br>
            <img src="<?php echo htmlspecialchars($blog['image_url1']); ?>" width="150"><br>
            <input type="text" name="image_url1" class="form-control" placeholder="New ImageBB Link (Optional)">
        </div>

        <!-- Image 2 (Current and Input for New) -->
        <div class="mb-3">
            <label>Current Image 2:</label><br>
            <img src="<?php echo htmlspecialchars($blog['image_url2']); ?>" width="150"><br>
            <input type="text" name="image_url2" class="form-control" placeholder="New ImageBB Link (Optional)">
        </div>

        <button type="submit" class="btn btn-success">Update Blog</button>
        <a href="view_blog.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php include 'crm_footer.php'; ?>