<?php
// account.php
require 'db_connection.php';
session_start();

// Check if the host is logged in
if (!isset($_SESSION['host_id'])) {
    header("Location: login.php");
    exit();
}

$hostId = $_SESSION['host_id'];

// Fetch the host's listings
$stmt = $conn->prepare("SELECT * FROM listings WHERE host_id = :host_id ORDER BY created_at DESC");
$stmt->bindParam(':host_id', $hostId, PDO::PARAM_INT);
$stmt->execute();
$listings = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Listings</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            background-color: #007BFF;
            color: white;
        }

        .navbar .logo {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .navbar .nav-buttons {
            display: flex;
            gap: 10px;
        }

        .navbar .nav-buttons button {
            background-color: white;
            color: #007BFF;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
        }

        .navbar .nav-buttons button:hover {
            background-color: #e0e0e0;
        }

        .container {
            padding: 1rem;
        }

        .listings {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .card {
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 10px;
            overflow: hidden;
            width: 100%;
            max-width: 300px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .card-content {
            padding: 1rem;
        }

        .card-content h3 {
            margin: 0;
            font-size: 1.2rem;
        }

        .card-content p {
            margin: 0.5rem 0;
            color: #666;
        }

        .card-actions {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 1rem;
            border-top: 1px solid #ccc;
        }

        .card-actions button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
        }

        .card-actions button.delete {
            background-color: #dc3545;
        }

        @media (max-width: 768px) {
            .listings {
                flex-direction: column;
                align-items: center;
            }

            .card {
                max-width: 100%;
            }
        }
    </style>
</head>

<body>
    <header class="navbar">
        <div class="logo">My Listings</div>
        <div class="nav-buttons">
            <form action="room.php" method="GET" style="display: inline;">
                <button type="submit">Home</button>
            </form>
            <form action="logout.php" method="POST" style="display: inline;">
                <button type="submit">Logout</button>
            </form>
        </div>
    </header>

    <div class="container">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['email']); ?></h1>

        <h2>Your Listings</h2>
        <div class="listings">
            <?php if (count($listings) > 0): ?>
                <?php foreach ($listings as $listing): ?>
                    <div class="card">
                        <img src="<?php echo htmlspecialchars($listing['image_1']); ?>"
                            alt="<?php echo htmlspecialchars($listing['title']); ?>">
                        <div class="card-content">
                            <h3><?php echo htmlspecialchars($listing['title']); ?></h3>
                            <p><?php echo htmlspecialchars($listing['description']); ?></p>
                            <p>Price: $<?php echo htmlspecialchars($listing['price']); ?></p>
                        </div>
                        <div class="card-actions">
                            <form action="edit_listing.php" method="GET" style="margin: 0;">
                                <input type="hidden" name="listing_id" value="<?php echo $listing['listing_id']; ?>">
                                <button type="submit">Edit</button>
                            </form>
                            <form action="delete_listing.php" method="POST" style="margin: 0;">
                                <input type="hidden" name="listing_id" value="<?php echo $listing['listing_id']; ?>">
                                <button type="submit" class="delete">Delete</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>You have no listings yet. <a href="add_listing.php">Add a new listing</a>.</p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>