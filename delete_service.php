<?php
session_start();
require_once 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (!isset($_GET['id'])) {
    header('Location: services.php');
    exit;
}

$service_id = (int) $_GET['id'];

// Apaga o serviço apenas se ele pertence ao usuário logado
$stmt = $db->prepare("DELETE FROM services WHERE id = :id AND user_id = :user_id");
$stmt->bindValue(':id', $service_id, SQLITE3_INTEGER);
$stmt->bindValue(':user_id', $_SESSION['user_id'], SQLITE3_INTEGER);
$stmt->execute();

$_SESSION['success'] = "Service deleted successfully.";
header('Location: services.php');
exit;
?>
