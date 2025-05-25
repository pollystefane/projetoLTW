<?php
require_once 'includes/db.php';
include('includes/header.php');

$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// Consulta com ou sem filtro de busca
if ($search !== '') {
    $stmt = $db->prepare("
        SELECT services.*, users.name AS freelancer_name
        FROM services
        JOIN users ON services.user_id = users.id
        WHERE services.title LIKE :search OR services.description LIKE :search
        ORDER BY services.created_at DESC
    ");
    $stmt->bindValue(':search', '%' . $search . '%');
    $result = $stmt->execute();
} else {
    $result = $db->query("
        SELECT services.*, users.name AS freelancer_name
        FROM services
        JOIN users ON services.user_id = users.id
        ORDER BY services.created_at DESC
    ");
}
?>

<main class="services-container">
    <h2>Available Services</h2>

    <form method="GET" action="services.php" style="margin-bottom: 20px;">
        <input type="text" name="search" placeholder="Search for a service..." value="<?= htmlspecialchars($search) ?>" style="padding: 8px; width: 250px;">
        <button type="submit" style="padding: 8px 12px;">Search</button>
    </form>

    <?php
    $hasResults = false;

    while ($service = $result->fetchArray(SQLITE3_ASSOC)):
        $hasResults = true;
    ?>
        <div class="service-card">
        <h3>
            <a href="service_details.php?id=<?= $service['id'] ?>" style="color: #333; text-decoration: none;">
                <?= htmlspecialchars($service['title']) ?>
            </a>
        </h3>

            <p class="category"><?= htmlspecialchars($service['category']) ?></p>
            <p class="price">$<?= number_format($service['price'], 2) ?></p>
            <p class="description"><?= nl2br(htmlspecialchars($service['description'])) ?></p>
            <p class="freelancer">Posted by: <?= htmlspecialchars($service['freelancer_name']) ?></p>
            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $service['user_id']): ?>
                <a href="delete_service.php?id=<?= $service['id'] ?>"
                    onclick="return confirm('Are you sure you want to delete this service?');"
                    style="color: red; text-decoration: none; font-weight: bold;">
                     Delete
                </a>
            <?php endif; ?>

            <p class="date">Published on: <?= date('d/m/Y H:i', strtotime($service['created_at'])) ?></p>
        </div>
    <?php endwhile; ?>

    <?php if (!$hasResults): ?>
        <p style="color: #555; font-style: italic;">No services found.</p>
    <?php endif; ?>

</main>

<?php include('includes/footer.php'); ?>
