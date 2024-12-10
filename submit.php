<?php

// Database credentials
$host = "localhost";
$username = "khush";
$password = "Khush@3160"; // Use your database password
$dbname = "prelette_customer"; // Replace with your database name

// Create a database connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize a flag to determine the status of form submission
$formStatus = "";

// Check which form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // For Newsletter Subscription Form
    if (isset($_POST['email'])) {
        $email = $conn->real_escape_string($_POST['email']);

        // Insert data into the newsletter table
        $sql = "INSERT INTO newsletter (email) VALUES ('$email')";
        if ($conn->query($sql) === TRUE) {
            $formStatus = "Thank you for subscribing!";
        } else {
            $formStatus = "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // For Contact Us Form
    if (isset($_POST['Name']) && isset($_POST['Email'])) {
        $name = $conn->real_escape_string($_POST['Name']);
        $email = $conn->real_escape_string($_POST['Email']);
        $phone = $conn->real_escape_string($_POST['Phone']);
        $subject = $conn->real_escape_string($_POST['Subject']);
        $message = $conn->real_escape_string($_POST['Messages']);

        // Insert data into the contact_us table
        $sql = "INSERT INTO contact_us (name, email, phone, subject, message) 
                VALUES ('$name', '$email', '$phone', '$subject', '$message')";
        if ($conn->query($sql) === TRUE) {
            $formStatus = "Your message has been sent successfully!";
        } else {
            $formStatus = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Close the database connection
$conn->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Submission</title>
    <script>
        // Display success or error dialog if formStatus is set
        function showDialog(message) {
            if (message) {
                alert(message);
                // Clear the form fields after confirmation
                document.querySelectorAll('input[type="text"], input[type="email"], textarea').forEach(field => {
                    field.value = '';
                });
            }
        }
    </script>
</head>
<body onload="showDialog('<?php echo $formStatus; ?>')">
    <!-- Your form HTML remains unchanged -->
</body>
</html>
