<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>

<?php include('includes/header.php'); ?>

<main>
    <h2>Welcome, <?= htmlspecialchars($_SESSION['name']); ?>!</h2>

    <p>
        <a href="create_service.php" class="btn">+ Create New Service</a>
    </p>

    <h3>Your Published Services</h3>

    <?php
    require_once 'includes/db.php';

    $user_id = $_SESSION['user_id'];

    $stmt = $db->prepare("SELECT * FROM services WHERE user_id = :user_id ORDER BY created_at DESC");
    $stmt->bindValue(':user_id', $user_id);
    $result = $stmt->execute();

    $hasServices = false;

    while ($service = $result->fetchArray(SQLITE3_ASSOC)):
        $hasServices = true;
    ?>
        <div class="service-card">
            <h4><?= htmlspecialchars($service['title']) ?></h4>
            <p><?= nl2br(htmlspecialchars($service['description'])) ?></p>
            <p class="price">$<?= number_format($service['price'], 2) ?></p>
            <p class="date">Published on: <?= date('d/m/Y H:i', strtotime($service['created_at'])) ?></p>
        </div>
    <?php endwhile; ?>

    <?php if (!$hasServices): ?>
        <p>You have not published any services yet.</p>
    <?php endif; ?>

    <p>You are logged in as <?= htmlspecialchars($_SESSION['type']); ?>.</p>
</main>

<?php include('includes/footer.php'); ?>
