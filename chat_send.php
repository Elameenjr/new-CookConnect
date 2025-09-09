<?php
session_start();
if (!isset($_SESSION['user']) || empty($_POST['message'])) exit;

// Use correct Ubuntu local server credentials
$conn = new mysqli("127.0.0.1", "cookconnect_user", "StrongPassword123!", "recipe_app");

// Check connection and handle errors
if ($conn->connect_error) {
    http_response_code(500);
    echo "Database connection failed: " . $conn->connect_error;
    exit;
}

// Set charset to avoid encoding issues
$conn->set_charset("utf8mb4");

$username = $conn->real_escape_string($_SESSION['user']['username']);
$message = $conn->real_escape_string($_POST['message']);

if ($conn->query("INSERT INTO chat_messages (username, message) VALUES ('$username', '$message')")) {
    echo "ok";
} else {
    http_response_code(500);
    echo "Query failed: " . $conn->error;
}

$conn->close();
?>
