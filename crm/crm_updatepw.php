<?php
include 'db_connection.php';

$result = $conn->query("SELECT id, password FROM users");
while ($row = $result->fetch_assoc()) {
    $hashed_password = password_hash($row['password'], PASSWORD_DEFAULT);
    $conn->query("UPDATE users SET password = '$hashed_password' WHERE id = {$row['id']}");
}

echo "Passwords updated successfully!";
?>