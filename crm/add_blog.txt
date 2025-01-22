<?php
include 'crm_header.php';
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $date = $_POST['date'];

    $heading1 = $_POST['heading1'] ?? null;
    $paragraph1 = $_POST['paragraph1'] ?? null;
    $heading2 = $_POST['heading2'] ?? null;
    $paragraph2 = $_POST['paragraph2'] ?? null;
    $heading3 = $_POST['heading3'] ?? null;
    $paragraph3 = $_POST['paragraph3'] ?? null;
    $heading4 = $_POST['heading4'] ?? null;
    $paragraph4 = $_POST['paragraph4'] ?? null;
    $heading5 = $_POST['heading5'] ?? null;
    $paragraph5 = $_POST['paragraph5'] ?? null;

    $tag1 = $_POST['tag1'] ?? null;
    $tag2 = $_POST['tag2'] ?? null;
    $tag3 = $_POST['tag3'] ?? null;

    // Create SEO-friendly URL
    $seo_url = strtolower(str_replace(" ", "-", preg_replace("/[^a-zA-Z0-9\s]/", "", $title)));

    // Get Image URLs from form
    $image1 = $_POST["image1"] ?? null;
    $image2 = $_POST["image2"] ?? null;
    $image3 = $_POST["image3"] ?? null;

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO blogs 
        (title, author, date, heading1, paragraph1, heading2, paragraph2, heading3, paragraph3, heading4, paragraph4, heading5, paragraph5, tag1, tag2, tag3, image_url1, image_url2, image_url3, seo_url) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param(
        "ssssssssssssssssssss",
        $title,
        $author,
        $date,
        $heading1,
        $paragraph1,
        $heading2,
        $paragraph2,
        $heading3,
        $paragraph3,
        $heading4,
        $paragraph4,
        $heading5,
        $paragraph5,
        $tag1,
        $tag2,
        $tag3,
        $image1,
        $image2,
        $image3,
        $seo_url
    );

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

    <form method="POST">
        <div class="mb-3"><input type="text" name="title" class="form-control" placeholder="Title" required></div>
        <div class="mb-3"><input type="text" name="author" class="form-control" placeholder="Author" required></div>
        <div class="mb-3"><input type="date" name="date" class="form-control" required></div>

        <div class="mb-3"><input type="text" name="heading1" class="form-control" placeholder="Heading 1"></div>
        <div class="mb-3"><textarea name="paragraph1" class="form-control" placeholder="Paragraph 1"></textarea></div>
        <div class="mb-3"><input type="text" name="heading2" class="form-control" placeholder="Heading 2"></div>
        <div class="mb-3"><textarea name="paragraph2" class="form-control" placeholder="Paragraph 2"></textarea></div>
        <div class="mb-3"><input type="text" name="heading3" class="form-control" placeholder="Heading 3"></div>
        <div class="mb-3"><textarea name="paragraph3" class="form-control" placeholder="Paragraph 3"></textarea></div>
        <div class="mb-3"><input type="text" name="heading4" class="form-control" placeholder="Heading 4"></div>
        <div class="mb-3"><textarea name="paragraph4" class="form-control" placeholder="Paragraph 4"></textarea></div>
        <div class="mb-3"><input type="text" name="heading5" class="form-control" placeholder="Heading 5"></div>
        <div class="mb-3"><textarea name="paragraph5" class="form-control" placeholder="Paragraph 5"></textarea></div>

        <div class="mb-3"><input type="text" name="tag1" class="form-control" placeholder="Tag 1"></div>
        <div class="mb-3"><input type="text" name="tag2" class="form-control" placeholder="Tag 2"></div>
        <div class="mb-3"><input type="text" name="tag3" class="form-control" placeholder="Tag 3"></div>

        <div class="mb-3"><input type="text" name="image1" class="form-control" placeholder="Image 1 Link"></div>
        <div class="mb-3"><input type="text" name="image2" class="form-control" placeholder="Image 2 Link"></div>
        <div class="mb-3"><input type="text" name="image3" class="form-control" placeholder="Image 3 Link"></div>

        <button type="submit" class="btn btn-primary">Add Blog</button>
    </form>
</div>

<?php include 'crm_footer.php'; ?>