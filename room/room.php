<?php
require 'db_connection.php';

try {
    $query = $conn->query("SELECT * FROM listings ORDER BY created_at DESC");
    $listings = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching listings: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Listings</title>
    <link rel="stylesheet" href="styles.css">
    <script defer src="script.js"></script>
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
            $query = $conn->query("SELECT DISTINCT suburb FROM listings ORDER BY suburb ASC");
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
        <?php if (!empty($listings)): ?>
            <?php foreach ($listings as $listing): ?>
                <div class="card card-horizontal">
                    <img src="<?php echo htmlspecialchars($listing['image_1']); ?>"
                        alt="<?php echo htmlspecialchars($listing['title']); ?>">
                    <div class="card-content">
                        <h3 class="card-title"><?php echo htmlspecialchars($listing['title']); ?></h3>
                        <p class="card-description"><?php echo htmlspecialchars(substr($listing['description'], 0, 20)); ?>...
                        </p>
                        <span class="show-more"
                            onclick="showMore(this, '<?php echo htmlspecialchars($listing['description']); ?>')">Show
                            more</span>
                        <p>Price: $<?php echo htmlspecialchars($listing['price']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No listings available.</p>
        <?php endif; ?>
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