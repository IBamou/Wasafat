<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="breadcrumb">
    <a href="<?= $baseUrl ?>">Home</a>
    <span class="separator">/</span>
    <span>Dashboard</span>
</div>

<div class="page-content">

    <!-- Welcome Section -->
    <div class="dashboard-welcome animate-in">
        <h1>Welcome back, <?= htmlspecialchars($_SESSION['user']['name'] ?? 'Chef') ?>! 👋</h1>
        <p>Here's an overview of your culinary kingdom.</p>
    </div>

    <!-- Stats -->
    <div class="stats-grid animate-in-1">
        <div class="stat-card">
            <div class="stat-icon recipes"><i class="fas fa-book"></i></div>
            <div>
                <div class="stat-value"><?= htmlspecialchars($recipeCount ?? 0) ?></div>
                <div class="stat-label">Recipes</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon categories"><i class="fas fa-layer-group"></i></div>
            <div>
                <div class="stat-value"><?= htmlspecialchars($categoryCount ?? 0) ?></div>
                <div class="stat-label">Categories</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon favorites"><i class="fas fa-clock"></i></div>
            <div>
                <div class="stat-value"><?= htmlspecialchars($recentCount ?? 0) ?></div>
                <div class="stat-label">This Week</div>
            </div>
        </div>
    </div>

    <!-- Quick Links -->
    <div class="section-card animate-in-2" style="margin-top: 30px;">
        <h2 class="section-title">
            <span class="section-line"></span>
            Quick Actions
        </h2>
        <div class="quick-links">
            <a href="<?= $baseUrl ?>recipes" class="quick-link">
                <i class="fas fa-book"></i>
                <span>View All Recipes</span>
            </a>
            <a href="<?= $baseUrl ?>recipes/create" class="quick-link">
                <i class="fas fa-plus-circle"></i>
                <span>Create New Recipe</span>
            </a>
            <a href="<?= $baseUrl ?>categories" class="quick-link">
                <i class="fas fa-layer-group"></i>
                <span>Manage Categories</span>
            </a>
            <a href="<?= $baseUrl ?>profile" class="quick-link">
                <i class="fas fa-user-circle"></i>
                <span>Edit Profile</span>
            </a>
        </div>
    </div>

    <!-- Recent Recipes -->
    <?php if (!empty($recentRecipes)): ?>
    <div class="section-card animate-in-3" style="margin-top: 26px;">
        <div class="section-header">
            <h2 class="section-title">
                <span class="section-line"></span>
                Recent Recipes
            </h2>
            <a href="<?= $baseUrl ?>recipes" class="btn btn-ghost btn-sm">View All →</a>
        </div>
        <div class="card-grid">
            <?php foreach (array_slice($recentRecipes, 0, 3) as $recipe): ?>
                <div class="card">
                    <h3 class="card-title">
                        <a href="<?= $baseUrl ?>recipes/<?= $recipe['id'] ?>"><?= htmlspecialchars($recipe['name']) ?></a>
                    </h3>
                    <p class="card-description"><?= htmlspecialchars($recipe['description'] ?? 'No description') ?></p>
                    <div class="card-meta">
                        <?php if (!empty($recipe['preparation_time'])): ?>
                            <span><i class="fas fa-clock"></i> <?= htmlspecialchars($recipe['preparation_time']) ?> min</span>
                        <?php endif; ?>
                        <?php if (!empty($recipe['difficulty'])): ?>
                            <span class="badge badge-<?= htmlspecialchars($recipe['difficulty']) ?>">
                                <?= ucfirst(htmlspecialchars($recipe['difficulty'])) ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>