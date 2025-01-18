<?php
include 'db_connection.php';

function sendEmailNotification($to, $subject, $message)
{
    $headers = "From: crm@yourcompany.com\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    mail($to, $subject, $message, $headers);
}

// Example: Send a task update email
$to = "employee@example.com";
$subject = "New Task Assigned";
$message = "<h2>New Task</h2><p>You have been assigned a new task. Please check your dashboard.</p>";

sendEmailNotification($to, $subject, $message);
?>