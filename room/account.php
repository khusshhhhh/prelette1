<?php
// account.php
require 'db_connection.php';
session_start();

// Check if the host is logged in
if (!isset($_SESSION['host_id'])) {
    header("Location: signup.php");
    exit();
}

$hostId = $_SESSION['host_id'];

// Fetch the host's details
$stmtHost = $conn->prepare("SELECT email, mobile FROM hosts WHERE host_id = :host_id");
$stmtHost->bindParam(':host_id', $hostId, PDO::PARAM_INT);
$stmtHost->execute();
$hostDetails = $stmtHost->fetch(PDO::FETCH_ASSOC);

// Fetch the host's listings
$stmtListings = $conn->prepare("SELECT * FROM listings WHERE host_id = :host_id ORDER BY created_at DESC");
$stmtListings->bindParam(':host_id', $hostId, PDO::PARAM_INT);
$stmtListings->execute();
$listings = $stmtListings->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="favicon" href="../assets/imgs/logo/fav.png" type="image/x-icon">
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

        .profile-section {
            margin-bottom: 2rem;
        }

        .profile-section form {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
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

        .edit-input {
            width: 100%;
            margin-top: 0.5rem;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .save-button {
            background-color: #28a745;
            color: white;
        }

        .delete-button {
            background-color: #dc3545;
            color: white;
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
        <div class="logo">My Account</div>
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
        <!-- Profile Section -->
        <div class="profile-section">
            <h1>Welcome, <?php echo htmlspecialchars($_SESSION['email']); ?></h1>
            <form method="POST" action="update_profile.php">
                <label for="email">Email</label>
                <input type="email" id="email" name="email"
                    value="<?php echo htmlspecialchars($hostDetails['email']); ?>" required>

                <label for="mobile">Mobile</label>
                <input type="text" id="mobile" name="mobile" pattern="\d{9}"
                    value="<?php echo htmlspecialchars(substr($hostDetails['mobile'], 3)); ?>" placeholder="123 456 789"
                    required>

                <label for="password">New Password</label>
                <input type="password" id="password" name="password" placeholder="Enter new password">

                <button type="submit">Update Profile</button>
            </form>
        </div>

        <!-- Listings Section -->
        <h2>Your Listings</h2>
        <div class="listings">
            <?php if (count($listings) > 0): ?>
                <?php foreach ($listings as $listing): ?>
                    <div class="card">
                        <img src="<?php echo htmlspecialchars($listing['image_1']); ?>"
                            alt="<?php echo htmlspecialchars($listing['title']); ?>">
                        <div class="card-content">
                            <form method="POST" action="update_listing.php">
                                <input type="hidden" name="listing_id" value="<?php echo $listing['listing_id']; ?>">

                                <label for="title">Title</label>
                                <input type="text" name="title" value="<?php echo htmlspecialchars($listing['title']); ?>"
                                    class="edit-input" required>

                                <label for="description">Description</label>
                                <textarea name="description" class="edit-input"
                                    required><?php echo htmlspecialchars($listing['description']); ?></textarea>

                                <label for="price">Price</label>
                                <input type="number" name="price" step="0.01"
                                    value="<?php echo htmlspecialchars($listing['price']); ?>" class="edit-input" required>

                                <button type="submit" class="save-button">Save</button>
                            </form>
                            <form method="POST" action="delete_listing.php">
                                <input type="hidden" name="listing_id" value="<?php echo $listing['listing_id']; ?>">
                                <button type="submit" class="delete-button"
                                    onclick="return confirm('Are you sure you want to delete this listing?');">Delete</button>
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