<?php
session_start();
if (!isset($_SESSION['user']) || empty($_POST['message'])) exit;
$conn = new mysqli("localhost", "root", "", "recipe_app");
$username = $conn->real_escape_string($_SESSION['user']['username']);
$message = $conn->real_escape_string($_POST['message']);
$conn->query("INSERT INTO chat_messages (username, message) VALUES ('$username', '$message')");
echo "ok";
