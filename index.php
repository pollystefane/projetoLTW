<?php include('includes/header.php'); ?>

<main class="home-container">
    <h1 class="home-title">Welcome to ProFreelance</h1>
    <p class="home-subtitle">The easy way to find or offer services</p>

    <p class="home-button-wrapper">
        <a href="services.php" class="home-button">View Available Services</a>
    </p>

    <form action="services.php" method="GET" class="home-search-form">
        <input type="text" name="q" placeholder="Search Services..." class="search-input">
        <button type="submit" class="search-button">Search</button>
    </form>
</main>

<?php include('includes/footer.php'); ?>
