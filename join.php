<?php 
session_start();
include('includes/header.php');
?>

<main class="join-container">
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

    <h2 class="form-title">Create an Account</h2>

    <form action="process_join.php" method="POST" class="join-form">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Join</button>
    </form>
</main>


<?php include('includes/footer.php'); ?>
