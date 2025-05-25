<?php
require_once 'includes/db.php';
include('includes/header.php');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<p style='padding: 20px;'>Invalid service ID.</p>";
    include('includes/footer.php');
    exit;
}

$id = (int) $_GET['id'];

$stmt = $db->prepare("
    SELECT services.*, users.name AS freelancer_name
    FROM services
    JOIN users ON services.user_id = users.id
    WHERE services.id = :id
");
$stmt->bindValue(':id', $id);
$result = $stmt->execute();
$service = $result->fetchArray(SQLITE3_ASSOC);

if (!$service) {
    echo "<p style='padding: 20px;'>Service not found.</p>";
    include('includes/footer.php');
    exit;
}
?>

<main class="services-container">
    <div class="service-card">
        <h2><?= htmlspecialchars($service['title']) ?></h2>
        <p><strong>Category:</strong> <?= htmlspecialchars($service['category']) ?></p>
        <p><strong>Price:</strong> $<?= number_format($service['price'], 2) ?></p>
        <p><strong>Freelancer:</strong> <?= htmlspecialchars($service['freelancer_name']) ?></p>
        <p><strong>Description:</strong><br><?= nl2br(htmlspecialchars($service['description'])) ?></p>
        <p><em>Published on: <?= date('d/m/Y H:i', strtotime($service['created_at'])) ?></em></p>
    </div>

    <!-- Botão voltar para a lista de serviços -->
    <a href="services.php" class="back-button">← Back to Services</a>
</main>


<?php include('includes/footer.php'); ?>
