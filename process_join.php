<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require_once 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!$name || !$email || !$password) {
        $_SESSION['error'] = "Please fill all fields.";
        header('Location: join.php');
        exit;
    }

    // checa se o email está registrado
    $stmtCheck = $db->prepare("SELECT id FROM users WHERE email = :email");
    $stmtCheck->bindValue(':email', $email);
    $resultCheck = $stmtCheck->execute();

    if ($resultCheck->fetchArray()) {
        $_SESSION['error'] = "This email is already registered.";
        header('Location: join.php');
        exit;
    }

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $db->prepare('INSERT INTO users (name, email, password, type) VALUES (:name, :email, :password, "client")');
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':password', $passwordHash);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Account created successfully! You can now log in.";
        header('Location: login.php');
        exit;
    } else {
        $_SESSION['error'] = "Error registering user.";
        header('Location: join.php');
        exit;
    }
} else {
    header('Location: join.php');
    exit;
}
