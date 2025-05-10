<?php
session_start();
require 'db_connection.php';

// Get form data
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$message = $_POST['message'] ?? '';

// Validate input
if (empty($name) || empty($email) || empty($message)) {
    $_SESSION['error'] = "All fields are required.";
    header("Location: contact.php");
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = "Please enter a valid email address.";
    header("Location: contact.php");
    exit;
}

try {
    // Insert into database
    $stmt = $pdo->prepare("INSERT INTO contact (name, email, message, created_at) VALUES (?, ?, ?, NOW())");
    $stmt->execute([$name, $email, $message]);

    $_SESSION['message'] = "Thank you! Your message has been sent.";
    header("Location: contact.php");
    exit;
} catch (PDOException $e) {
    $_SESSION['error'] = "Error submitting message: " . $e->getMessage();
    header("Location: contact.php");
    exit;
}
?>