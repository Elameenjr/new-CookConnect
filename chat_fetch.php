<?php
$conn = new mysqli("localhost", "root", "", "recipe_app");
$res = $conn->query("SELECT username, message, created_at FROM chat_messages ORDER BY id DESC LIMIT 30");
$messages = [];
while ($row = $res->fetch_assoc()) $messages[] = $row;
echo json_encode(array_reverse($messages));
