<?php
session_start();
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = hash('sha256', $conn->real_escape_string($_POST['password']));

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['loggedin'] = true;
        header("Location: view_data.php");
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prelette | Admin Dashboard</title>
    <link rel="shortcut icon" href="./assets/imgs/logo/favicon.png" type="image/x-icon">
    <style>
        @import url("https://fonts.googleapis.com/css?family=Montserrat:200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i");

        body {
            font-family: "Montserrat", sans-serif;
            background: #ffd89d;
        }

        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: left;
            width: 100%;
            background: #ffd89d;
        }

        .title h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .main form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .main form input,
        .main form button {
            padding: 10px;
            width: 300px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .main form button {
            background-color: #ff9d00;
            color: #fff;
            font-weight: bold;
            border: none;
            margin-top: 20px;
            width: 100%;
            cursor: pointer;
        }

        .main form button:hover {
            background-color: #ff8300;
        }

        @media screen and (max-width: 768px) {
            .title h1 {
                font-size: 20px;
            }

            .main form input,
            .main form button {
                padding: 8px;
                font-size: 14px;
            }
        }

        /* For Mobile Devices */
        @media screen and (max-width: 400px) {
            .title h1 {
                font-size: 18px;
            }

            .main form {
                gap: 8px;
            }

            .main form input,
            .main form button {
                padding: 6px;
                font-size: 12px;
            }

            .main form button {
                background-color: #ff9d00;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="title">
            <h1>Prelette Admin Dashboard</h1>
        </div>
        <div class="main">
            <form method="POST" action="">
                <label>Username:</label>
                <input type="text" name="username" required>
                <label>Password:</label>
                <input type="password" name="password" required>
                <button type="submit">Login</button>
                <?php if (isset($error))
                    echo "<p>$error</p>"; ?>
            </form>
        </div>
    </div>
</body>