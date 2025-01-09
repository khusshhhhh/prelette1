<?php

// Include database connection
include 'db_connection.php';

// Email configuration
$toEmail = "theprelette@gmail.com"; // Replace with your email address
$headers = "From: no-reply@example.com\r\n";

// Check which form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // For Newsletter Subscription Form
    if (isset($_POST['email'])) {
        $email = $conn->real_escape_string($_POST['email']);
        $date = date("Y-m-d H:i:s");

        // Insert data into the newsletter table
        $sql = "INSERT INTO newsletter (email, date) VALUES ('$email', '$date')";
        if ($conn->query($sql) === TRUE) {
            // Send email notification
            $subject = "New Newsletter Subscription";
            $message = "Email: $email\nDate: $date";
            mail($toEmail, $subject, $message, $headers);

            // Redirect to thankyou.html
            header("Location: thankyou.html");
            exit;
        }
    }

    // For Contact Us Form
    if (isset($_POST['Name']) && isset($_POST['Email'])) {
        $name = $conn->real_escape_string($_POST['Name']);
        $email = $conn->real_escape_string($_POST['Email']);
        $phone = $conn->real_escape_string($_POST['Phone']);
        $subject = $conn->real_escape_string($_POST['Subject']);
        $message = $conn->real_escape_string($_POST['Messages']);
        $date = date("Y-m-d H:i:s");

        // Insert data into the contact_us table
        $sql = "INSERT INTO contact_us (name, email, phone, subject, message, date) 
                VALUES ('$name', '$email', '$phone', '$subject', '$message', '$date')";
        if ($conn->query($sql) === TRUE) {
            // Send email notification
            $subjectEmail = "New Contact Form Submission";
            $messageEmail = "Name: $name\nEmail: $email\nPhone: $phone\nSubject: $subject\nMessage: $message\nDate: $date";
            mail($toEmail, $subjectEmail, $messageEmail, $headers);

            // Redirect to contactus.html
            header("Location: contactus.html");
            exit;
        }
    }
}

// Close the database connection
$conn->close();
?>