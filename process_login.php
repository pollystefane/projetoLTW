<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require_once 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!$email || !$password) {
        $_SESSION['error'] = "Please fill all fields.";
        header('Location: login.php');
        exit;
    }

    $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindValue(':email', $email);
    $result = $stmt->execute();
    $user = $result->fetchArray(SQLITE3_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['type'] = $user['type'];

        header('Location: dashboard.php');
        exit;
    } else {
        $_SESSION['error'] = "Incorrect email or password.";
        header('Location: login.php');
        exit;
    }
} else {
    header('Location: login.php');
    exit;
}
