<?php
include 'db.php';

$query = "SELECT * FROM blog_posts ORDER BY date DESC";
$result = $conn->query($query);
?>

<div class="blog-list">
    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="blog-item">
            <h2><a href="/<?= $row['slug'] ?>"><?= $row['title'] ?></a></h2>
            <p>By <?= $row['author'] ?> on <?= date('F d, Y', strtotime($row['date'])) ?></p>
        </div>
    <?php endwhile; ?>
</div>
