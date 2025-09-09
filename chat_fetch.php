<?php
// Use correct Ubuntu local server credentials
$conn = new mysqli("127.0.0.1", "cookconnect_user", "StrongPassword123!", "recipe_app");

// Check connection and handle errors
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed: ' . $conn->connect_error]);
    exit;
}

// Set charset to avoid encoding issues
$conn->set_charset("utf8mb4");

// Fetch latest 30 chat messages
$res = $conn->query("SELECT username, message, created_at FROM chat_messages ORDER BY id DESC LIMIT 30");
$messages = [];

if ($res) {
    while ($row = $res->fetch_assoc()) $messages[] = $row;
    echo json_encode(array_reverse($messages));
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Query failed: ' . $conn->error]);
}

// Close the connection
$conn->close();
?>
