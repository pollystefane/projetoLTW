<?php
session_start();
require_once 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $price = $_POST['price'];
    $category = $_POST['category'];

    //verificação simples
    if (!$title || !$description || !$price || !$category) {
        $_SESSION['error'] = "Please fill in all fields.";
        header('Location: create_service.php');
        exit;
    }

    $stmt = $db->prepare("INSERT INTO services (user_id, title, description, price, category) VALUES (:user_id, :title, :description, :price, :category)");
    $stmt->bindValue(':user_id', $user_id);
    $stmt->bindValue(':title', $title);
    $stmt->bindValue(':description', $description);
    $stmt->bindValue(':price', $price);
    $stmt->bindValue(':category', $category);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Service published successfully.";
        header('Location: dashboard.php');
        exit;
    } else {
        $_SESSION['error'] = "Error saving service.";
        header('Location: create_service.php');
        exit;
    }
} else {
    header('Location: create_service.php');
    exit;
}
