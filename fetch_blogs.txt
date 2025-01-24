<?php
include 'db_connection.php';

$blogsPerPage = 10;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $blogsPerPage;

// Fetch blogs with pagination
$stmt = $conn->prepare("SELECT title, seo_url FROM blogs ORDER BY date DESC LIMIT ?, ?");
$stmt->bind_param("ii", $offset, $blogsPerPage);
$stmt->execute();
$result = $stmt->get_result();

$counter = $offset + 1;
while ($blog = $result->fetch_assoc()) {
    echo '<a href="blog/' . htmlspecialchars($blog['seo_url']) . '">
            <div class="blog-box">
                <div class="content">
                    <span class="number">' . $counter . '</span>
                    <h3 class="title">' . htmlspecialchars($blog['title']) . '</h3>
                    <span class="icon"><i class="fa-solid fa-arrow-right"></i></span>
                </div>
            </div>
          </a>';
    $counter++;
}
?>