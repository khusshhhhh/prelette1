<?php
require 'db_connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Listings</title>
    <link rel="stylesheet" href="styles.css">
    <script defer src="script.js"></script>
    <link rel="shortcut icon" href="../assets/imgs/logo/fav.png" type="image/x-icon">
</head>

<body>
    <!-- Navbar -->
    <header class="navbar">
        <div class="logo"><a href="room.php">MyRoom by Prelette</a></div>
        <button class="host-now-btn"><a href="signup.php">Sign Up | Log In | Host Now</a></button>
    </header>

    <!-- Filters Section -->
    <section class="filters">
        <select id="filter-gender">
            <option value="">Filter by Gender</option>
            <option value="Boy">Boy</option>
            <option value="Girl">Girl</option>
        </select>
        <select id="filter-suburb">
            <option value="">Filter by Suburb</option>
            <?php
            $query = $conn->query("SELECT DISTINCT suburb FROM suburbs ORDER BY suburb ASC");
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='" . htmlspecialchars($row['suburb']) . "'>" . htmlspecialchars($row['suburb']) . "</option>";
            }
            ?>
        </select>
        <select id="sort-price">
            <option value="">Sort by Price</option>
            <option value="asc">Low to High</option>
            <option value="desc">High to Low</option>
        </select>
    </section>

    <!-- Listings Section -->
    <main class="listings" id="listings">
        <?php
        $query = $conn->query("SELECT * FROM listings ORDER BY created_at DESC");
        while ($listing = $query->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='card card-horizontal'>";
            echo "<img src='" . htmlspecialchars($listing['image_1']) . "' alt='" . htmlspecialchars($listing['title']) . "'>";
            echo "<div class='card-content'>";
            echo "<h3 class='card-title'>" . htmlspecialchars($listing['title']) . "</h3>";
            echo "<p class='card-description'>" . htmlspecialchars(substr($listing['description'], 0, 20)) . "...</p>";
            echo "<span class='show-more' onclick='showMore(this, `" . htmlspecialchars($listing['description']) . "`)'>Show more</span>";
            echo "<p>Price: $" . htmlspecialchars($listing['price']) . "</p>";
            echo "</div></div>";
        }
        ?>
    </main>

    <script>
        function showMore(element, fullDescription) {
            const descriptionElem = element.previousElementSibling;
            descriptionElem.textContent = fullDescription;
            element.style.display = 'none';
        }
    </script>
</body>

</html>