<?php 
session_start();
include('includes/header.php');
?>

<main class="login-container">
    <?php
    if (isset($_SESSION['error'])) {
        echo '<p class="message error">' . htmlspecialchars($_SESSION['error']) . '</p>';
        unset($_SESSION['error']);
    }
    if (isset($_SESSION['success'])) {
        echo '<p class="message success">' . htmlspecialchars($_SESSION['success']) . '</p>';
        unset($_SESSION['success']);
    }
    ?>

    <h2 class="login-title">Login</h2>
    <form action="process_login.php" method="POST" class="login-form">
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="senha" name="password" required>

        <button type="submit">Login</button>
    </form>
</main>


<?php include('includes/footer.php'); ?>
