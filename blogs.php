<?php
include 'db.php';

$slug = $_GET['slug'];
$query = "SELECT * FROM blog_posts WHERE slug = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $slug);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $blog = $result->fetch_assoc();
} else {
    die("Blog not found.");
}
?>

<div class="blog-detail">
    <h1><?= $blog['title'] ?></h1>
    <p>By <?= $blog['author'] ?> on <?= date('F d, Y', strtotime($blog['date'])) ?></p>
    <img src="<?= $blog['main_image'] ?>" alt="Main Image">
    <p><?= $blog['paragraph1'] ?></p>
    <p><?= $blog['paragraph2'] ?></p>
    <img src="<?= $blog['image1'] ?>" alt="Image 1">
    <p><?= $blog['paragraph3'] ?></p>
    <p><?= $blog['paragraph4'] ?></p>
    <p><?= $blog['paragraph5'] ?></p>
    <img src="<?= $blog['image2'] ?>" alt="Image 2">
    <div class="tags">
        Tags: <?= $blog['tags'] ?>
    </div>
    <div class="related-articles">
        <h3>Related Articles</h3>
        <?php
        $related = explode(',', $blog['related_articles']);
        foreach ($related as $slug) {
            $related_query = "SELECT title FROM blog_posts WHERE slug = ?";
            $stmt = $conn->prepare($related_query);
            $stmt->bind_param('s', trim($slug));
            $stmt->execute();
            $related_result = $stmt->get_result();
            if ($related_result->num_rows > 0) {
                $related_blog = $related_result->fetch_assoc();
                echo "<p><a href='/$slug'>{$related_blog['title']}</a></p>";
            }
        }
        ?>
    </div>
</div>
