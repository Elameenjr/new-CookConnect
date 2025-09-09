<?php
$host = '127.0.0.1'; // Use 127.0.0.1 for Ubuntu local server
$user = 'cookconnect_user';
$pass = 'StrongPassword123!';
$db = 'recipe_app';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
