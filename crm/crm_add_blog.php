<?php
include 'crm_header.php';
include 'db_connection.php';

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

    // Create SEO-friendly URL
    $seo_url = strtolower(str_replace(" ", "-", preg_replace("/[^a-zA-Z0-9\s]/", "", $title)));

    // Handle image uploads
    $target_dir = "blogimg/";
    $image1 = $target_dir . basename($_FILES["image1"]["name"]);
    $image2 = $target_dir . basename($_FILES["image2"]["name"]);

    move_uploaded_file($_FILES["image1"]["tmp_name"], $image1);
    move_uploaded_file($_FILES["image2"]["tmp_name"], $image2);

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO blogs (title, author, date, paragraph1, paragraph2, paragraph3, paragraph4, paragraph5, tag1, tag2, tag3, image1, image2, seo_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssssssss", $title, $author, $date, $paragraph1, $paragraph2, $paragraph3, $paragraph4, $paragraph5, $tag1, $tag2, $tag3, $image1, $image2, $seo_url);

    if ($stmt->execute()) {
        header("Location: view_blog.php?msg=Blog added successfully");
    } else {
        $error = "Error adding blog!";
    }
}
?>

<div class="container mt-4">
    <h2>Add Blog</h2>
    <?php if (isset($error)) {
        echo "<div class='alert alert-danger'>$error</div>";
    } ?>

    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3"><input type="text" name="title" class="form-control" placeholder="Title" required></div>
        <div class="mb-3"><input type="text" name="author" class="form-control" placeholder="Author" required></div>
        <div class="mb-3"><input type="date" name="date" class="form-control" required></div>
        <div class="mb-3"><textarea name="paragraph1" class="form-control" placeholder="Paragraph 1"
                required></textarea></div>
        <div class="mb-3"><textarea name="paragraph2" class="form-control" placeholder="Paragraph 2"
                required></textarea></div>
        <div class="mb-3"><textarea name="paragraph3" class="form-control" placeholder="Paragraph 3"></textarea></div>
        <div class="mb-3"><textarea name="paragraph4" class="form-control" placeholder="Paragraph 4"></textarea></div>
        <div class="mb-3"><textarea name="paragraph5" class="form-control" placeholder="Paragraph 5"></textarea></div>
        <div class="mb-3"><input type="text" name="tag1" class="form-control" placeholder="Tag 1"></div>
        <div class="mb-3"><input type="text" name="tag2" class="form-control" placeholder="Tag 2"></div>
        <div class="mb-3"><input type="text" name="tag3" class="form-control" placeholder="Tag 3"></div>
        <div class="mb-3"><input type="file" name="image1" class="form-control" required></div>
        <div class="mb-3"><input type="file" name="image2" class="form-control" required></div>
        <button type="submit" class="btn btn-primary">Add Blog</button>
    </form>
</div>

<?php include 'crm_footer.php'; ?>