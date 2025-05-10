<?php
session_start();
require 'db_connection.php';

$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (!$username || !$email || !$password) {
    $_SESSION['error'] = "All fields are required.";
    header("Location: register.php");
    exit;
}

// Check if user or email already exists
$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
$stmt->execute([$username, $email]);

if ($stmt->rowCount() > 0) {
    $_SESSION['error'] = "Username or Email already taken.";
    header("Location: register.php");
    exit;
}

// Insert new user
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
$stmt->execute([$username, $email, $hashed_password]);

$_SESSION['success'] = "Registration successful! Please log in.";
header("Location: login.php");
exit;
?>