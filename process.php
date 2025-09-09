<?php
// File: process.php

session_start();
require 'connection.php'; // Adjust this path if your DB connection file has a different name

$error = '';
$success = '';


if (isset($_POST['signin']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Authenticated
        $_SESSION['user'] = [
            'id' => $user['id'],
            'email' => $user['email'],
            'username' => $user['username']
        ];
        header('Location: index.php');
        exit;
    } else {
        $error = 'Invalid email or password';
    }
}


if (isset($_POST['signup']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Check if email already exists
    $check = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $check->execute([$email]);

    if ($check->fetch()) {
        $error = "Email already exists.";
    } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert new user
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password, status) VALUES (?, ?, ?, ?)");
        $created = $stmt->execute([$username, $email, $hashedPassword, 'Active']);

        if ($created) {
            $success = "Account created successfully. You can now <a href='signin.php'>sign in</a>.";
        } else {
            $error = "Something went wrong. Please try again.";
        }
    }
}

if (isset($_POST['addRecipe']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $prep_time = trim($_POST['prep_time']);
    $cook_time = trim($_POST['cook_time']);
    $servings = trim($_POST['servings']);
    $difficulty_level = trim($_POST['difficulty_level']);
    $ingredients = trim($_POST['ingredients']);
    $instructions = trim($_POST['instructions']);
    $videoPath = trim($_POST['video']);
    $status = 'published';

    $user_id = $_SESSION['user']['id'] ?? null;
    if (!$user_id) {
        $error = "User not logged in.";
        return;
    }

    // Handle image upload
    $picturePath = '';
    if (!empty($_FILES['picture']['name'])) {
        $ext = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);
        $picturePath = 'uploads/pictures/' . uniqid() . '.' . $ext;
        move_uploaded_file($_FILES['picture']['tmp_name'], $picturePath);
    }

    // Insert into DB
    $stmt = $pdo->prepare("
        INSERT INTO recipes 
        (user_id, title, description, prep_time, cook_time, servings, difficulty_level, picture, video, ingredients, instructions, status)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $result = $stmt->execute([
        $user_id, $title, $description, $prep_time, $cook_time, $servings,
        $difficulty_level, $picturePath, $videoPath, $ingredients, $instructions, $status
    ]);

    if ($result) {
        $success = "Recipe added successfully!";
    } else {
        $error = "Failed to save recipe.";
    }
}


?>

