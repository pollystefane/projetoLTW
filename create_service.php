<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

include('includes/header.php');
?>

<main class="create-service-container">
    <h2 class="form-title">Create a New Service</h2>

    <form action="process_service.php" method="POST" class="create-service-form">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="5" required></textarea>

        <label for="price">Price ($):</label>
        <input type="number" id="price" name="price" step="0.01" required>

        <label for="category">Category:</label>
        <select id="category" name="category" required>
            <option value="">-- Select a category --</option>
            <option value="Web Development">Web Development</option>
            <option value="Design">Design</option>
            <option value="Writing">Writing</option>
            <option value="Marketing">Marketing</option>
        </select>

        <button type="submit">Publish Service</button>
    </form>
</main>


<?php include('includes/footer.php'); ?>
