<?php
// signup.php
require 'db_connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['signup'])) {
        // Sign Up Process
        $email = $_POST['signup-email'];
        $password = $_POST['signup-password'];
        $confirmPassword = $_POST['signup-confirm-password'];

        // Validate input
        if ($password !== $confirmPassword) {
            die("Passwords do not match!");
        }

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Insert into database
        $stmt = $conn->prepare("INSERT INTO hosts (email, password) VALUES (:email, :password)");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);

        try {
            $stmt->execute();

            // Get the host ID
            $hostId = $conn->lastInsertId();

            // Start a session for the logged-in host
            $_SESSION['host_id'] = $hostId;
            $_SESSION['email'] = $email;

            // Redirect to account page
            header("Location: account.php");
            exit();
        } catch (PDOException $e) {
            if ($e->getCode() == 23505) { // Unique constraint violation
                die("This email is already registered!");
            } else {
                die("Error: " . $e->getMessage());
            }
        }
    } elseif (isset($_POST['login'])) {
        // Login Process
        $email = $_POST['login-email'];
        $password = $_POST['login-password'];

        // Fetch the host from the database
        $stmt = $conn->prepare("SELECT * FROM hosts WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $host = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($host && password_verify($password, $host['password'])) {
            // Password is correct; log the user in
            $_SESSION['host_id'] = $host['host_id'];
            $_SESSION['email'] = $host['email'];
            header("Location: account.php");
            exit();
        } else {
            die("Invalid email or password!");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up & Login</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="shortcut icon" href="../assets/imgs/logo/fav.png" type="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }

        .container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            width: 100%;
            max-width: 400px;
        }

        .tabs {
            display: flex;
            justify-content: space-between;
            background-color: #007BFF;
            color: white;
        }

        .tabs button {
            flex: 1;
            padding: 1rem;
            cursor: pointer;
            background: none;
            border: none;
            color: white;
            font-size: 1rem;
            font-weight: bold;
        }

        .tabs button.active {
            background-color: #0056b3;
        }

        .form-container {
            padding: 1rem;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 0.5rem;
            font-weight: bold;
        }

        input {
            margin-bottom: 1rem;
            padding: 0.75rem;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 0.75rem;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .form-container p {
            text-align: center;
        }

        @media (max-width: 768px) {
            .container {
                width: 90%;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="tabs">
            <button class="active" onclick="showForm('signup')">Sign Up</button>
            <button onclick="showForm('login')">Login</button>
        </div>
        <div class="form-container">
            <form id="signup-form" method="POST" action="signup.php">
                <input type="hidden" name="signup">
                <label for="signup-email">Email</label>
                <input type="email" id="signup-email" name="signup-email" placeholder="Enter your email" required>

                <label for="signup-password">Password</label>
                <input type="password" id="signup-password" name="signup-password" placeholder="Enter your password"
                    required>

                <label for="signup-confirm-password">Confirm Password</label>
                <input type="password" id="signup-confirm-password" name="signup-confirm-password"
                    placeholder="Confirm your password" required>

                <button type="submit">Sign Up</button>
            </form>

            <form id="login-form" method="POST" action="signup.php" style="display: none;">
                <input type="hidden" name="login">
                <label for="login-email">Email</label>
                <input type="email" id="login-email" name="login-email" placeholder="Enter your email" required>

                <label for="login-password">Password</label>
                <input type="password" id="login-password" name="login-password" placeholder="Enter your password"
                    required>

                <button type="submit">Login</button>
            </form>
        </div>
    </div>

    <script>
        function showForm(form) {
            const signupForm = document.getElementById('signup-form');
            const loginForm = document.getElementById('login-form');
            const tabs = document.querySelectorAll('.tabs button');

            if (form === 'signup') {
                signupForm.style.display = 'block';
                loginForm.style.display = 'none';
                tabs[0].classList.add('active');
                tabs[1].classList.remove('active');
            } else {
                signupForm.style.display = 'none';
                loginForm.style.display = 'block';
                tabs[0].classList.remove('active');
                tabs[1].classList.add('active');
            }
        }
    </script>
</body>

</html>