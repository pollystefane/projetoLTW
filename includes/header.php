<?php
session_start();
?>

<!DOCTYPE html>
<html lang="EN">
<head>
    <meta charset="UTF-8">
    <title>ProFreelance</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <h2>ProFreelance</h2>
            <nav>
                <a href="index.php">Home</a>

                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="dashboard.php">Dashboard</a>
                    <a href="create_service.php">Create Service</a>
                    <a href="logout.php">Logout</a>
                <?php else: ?>
                    <a href="login.php">Login</a>
                    <a href="join.php">Join</a>
                <?php endif; ?>

                <a href="services.php">Services</a>
                <a href="about.php">About</a>
            </nav>
        </div>
    </header>
