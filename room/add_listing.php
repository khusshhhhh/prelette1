<?php
// add_listing.php
require 'db_connection.php';
session_start();

// Check if the host is logged in
if (!isset($_SESSION['host_id'])) {
    header("Location: signup.php");
    exit();
}

$hostId = $_SESSION['host_id'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and validate form data
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $price = trim($_POST['price']);
    $addressLine = trim($_POST['address_line']);
    $suburb = trim($_POST['suburb']);
    $postcode = trim($_POST['postcode']);
    $requirement = trim($_POST['requirement']);

    // Check if all required fields are filled
    if (empty($title) || empty($description) || empty($price) || empty($addressLine) || empty($suburb) || empty($postcode) || empty($requirement)) {
        die("Please fill in all the required fields.");
    }

    // Image compression and save to folder
    function compressAndSaveImage($file, $folder, $filename, $quality = 50)
    {
        $info = getimagesize($file);
        if ($info['mime'] == 'image/jpeg') {
            $image = imagecreatefromjpeg($file);
        } elseif ($info['mime'] == 'image/png') {
            $image = imagecreatefrompng($file);
        } else {
            return false;
        }

        $targetPath = $folder . $filename;
        imagejpeg($image, $targetPath, $quality);
        return $targetPath;
    }

    $folder = 'public_html/room/images/';
    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    $imagePaths = [];
    for ($i = 1; $i <= 4; $i++) {
        $imageKey = "image_" . $i;
        if (!empty($_FILES[$imageKey]['tmp_name'])) {
            $filename = 'image' . str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT) . '.jpg';
            $compressedImagePath = compressAndSaveImage($_FILES[$imageKey]['tmp_name'], $folder, $filename);
            if ($compressedImagePath) {
                $imagePaths[] = $compressedImagePath;
            }
        }
    }

    // Ensure all image paths are set in the correct columns
    $image1 = $imagePaths[0] ?? null;
    $image2 = $imagePaths[1] ?? null;
    $image3 = $imagePaths[2] ?? null;
    $image4 = $imagePaths[3] ?? null;

    // Insert the listing into the database
    $stmt = $conn->prepare("INSERT INTO listings (host_id, title, description, price, address_line, suburb, postcode, requirement, image_1, image_2, image_3, image_4) VALUES (:host_id, :title, :description, :price, :address_line, :suburb, :postcode, :requirement, :image_1, :image_2, :image_3, :image_4)");
    $stmt->bindParam(':host_id', $hostId);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':address_line', $addressLine);
    $stmt->bindParam(':suburb', $suburb);
    $stmt->bindParam(':postcode', $postcode);
    $stmt->bindParam(':requirement', $requirement);
    $stmt->bindParam(':image_1', $image1);
    $stmt->bindParam(':image_2', $image2);
    $stmt->bindParam(':image_3', $image3);
    $stmt->bindParam(':image_4', $image4);

    try {
        $stmt->execute();
        header("Location: account.php");
        exit();
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Listing</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="favicon" href="../assets/imgs/logo/fav.png" type="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.8rem;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        input,
        textarea,
        select {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        button {
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
        }

        button:hover {
            background-color: #0056b3;
        }

        @media (max-width: 768px) {
            .container {
                margin: 20px;
                padding: 15px;
            }

            h1 {
                font-size: 1.5rem;
            }

            input,
            textarea,
            select {
                font-size: 0.9rem;
                padding: 8px;
            }

            button {
                font-size: 0.9rem;
                padding: 8px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Add a New Listing</h1>
        <form method="POST" action="add_listing.php" enctype="multipart/form-data">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" maxlength="30" required>

            <label for="description">Description (150 Words)</label>
            <textarea id="description" name="description" maxlength="150" required></textarea>

            <label for="price">Price (AUD)</label>
            <input type="number" id="price" name="price" step="0.01" required>

            <label for="address_line">Address Line</label>
            <input type="text" id="address_line" name="address_line" required>

            <label for="suburb">Suburb</label>
            <input type="text" id="suburb" name="suburb" required>

            <label for="postcode">Postcode</label>
            <input type="text" id="postcode" name="postcode" required>

            <label for="requirement">Requirement</label>
            <select id="requirement" name="requirement" required>
                <option value="Any">Any</option>
                <option value="Boy">Boy</option>
                <option value="Girl">Girl</option>
            </select>

            <label for="image_1">Image 1</label>
            <input type="file" id="image_1" name="image_1" accept="image/jpeg, image/png">

            <label for="image_2">Image 2</label>
            <input type="file" id="image_2" name="image_2" accept="image/jpeg, image/png">

            <label for="image_3">Image 3</label>
            <input type="file" id="image_3" name="image_3" accept="image/jpeg, image/png">

            <label for="image_4">Image 4</label>
            <input type="file" id="image_4" name="image_4" accept="image/jpeg, image/png">

            <button type="submit">Add Listing</button>
        </form>
    </div>
</body>

</html>