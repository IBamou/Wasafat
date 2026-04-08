<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="hero-section">
    <div class="hero-decoration left">🍽️</div>
    <div class="hero-decoration right">🌿</div>

    <div class="hero-content">
        <div class="hero-icon">🍲</div>
        <h1>Your Recipes,<br>Your <span>Story</span></h1>
        <p>Organize, create, and share your favorite recipes with Wasafat — your personal digital cookbook crafted with love.</p>

        <div class="hero-actions">
            <?php if (!empty($_SESSION['user'])): ?>
                <a href="<?= $baseUrl ?>recipes" class="btn btn-primary btn-lg">
                    <i class="fas fa-book-open"></i> Browse My Recipes
                </a>
                <a href="<?= $baseUrl ?>recipes/create" class="btn btn-outline btn-lg">
                    <i class="fas fa-plus"></i> New Recipe
                </a>
            <?php else: ?>
                <a href="<?= $baseUrl ?>signup" class="btn btn-primary btn-lg">
                    <i class="fas fa-rocket"></i> Get Started
                </a>
                <a href="<?= $baseUrl ?>login" class="btn btn-secondary btn-lg">
                    <i class="fas fa-sign-in-alt"></i> Login
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>