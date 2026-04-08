<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="breadcrumb">
    <a href="<?= $baseUrl ?>">Home</a>
    <span class="separator">/</span>
    <span>Recipes</span>
</div>

<div class="page-content">

    <!-- Page Header -->
    <div class="page-header-actions animate-in">
        <div class="page-header-text">
            <h1>My Recipes</h1>
            <p>Your collection of culinary creations, all in one place.</p>
        </div>
        <a href="<?= $baseUrl ?>recipes/create" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Recipe
        </a>
    </div>

    <!-- Success Message -->
    <?php if (!empty($_SESSION['success'])): ?>
        <div class="alert alert-success animate-in">
            <i class="fas fa-check-circle"></i>
            <?= htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>

    <!-- Recipes Grid -->
    <?php if (!empty($recipes)): ?>
        <div class="card-grid">
            <?php foreach ($recipes as $index => $recipe): ?>
                <div class="card animate-in-<?= min($index + 1, 4) ?>">
                    <h3 class="card-title">
                        <a href="<?= $baseUrl ?>recipes/<?= $recipe['id'] ?>">
                            <?= htmlspecialchars($recipe['name']) ?>
                        </a>
                    </h3>

                    <p class="card-description">
                        <?= htmlspecialchars($recipe['description'] ?? 'No description provided.') ?>
                    </p>

                    <div class="card-meta">
                        <?php if (!empty($recipe['preparation_time'])): ?>
                            <span><i class="fas fa-clock"></i> <?= htmlspecialchars($recipe['preparation_time']) ?> min prep</span>
                        <?php endif; ?>
                        <?php if (!empty($recipe['cooking_time'])): ?>
                            <span><i class="fas fa-fire"></i> <?= htmlspecialchars($recipe['cooking_time']) ?> min cook</span>
                        <?php endif; ?>
                        <?php if (!empty($recipe['difficulty'])): ?>
                            <span class="badge badge-<?= htmlspecialchars($recipe['difficulty']) ?>">
                                <?= ucfirst(htmlspecialchars($recipe['difficulty'])) ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="card-meta">
                        <span><i class="fas fa-calendar"></i> <?= date('M j, Y', strtotime($recipe['created_at'])) ?></span>
                    </div>

                    <div class="card-actions">
                        <a href="<?= $baseUrl ?>recipes/<?= $recipe['id'] ?>" class="btn btn-sm btn-secondary">
                            <i class="fas fa-eye"></i> View
                        </a>
                        <a href="<?= $baseUrl ?>recipes/edit/<?= $recipe['id'] ?>" class="btn btn-sm btn-ghost">
                            <i class="fas fa-pen"></i> Edit
                        </a>
                        <button
                            type="button"
                            class="btn btn-sm btn-ghost"
                            style="color: var(--color-error);"
                            onclick="confirmDelete('<?= $baseUrl ?>recipes/delete/<?= $recipe['id'] ?>', 'This recipe will be permanently deleted.')"
                        >
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <!-- Empty State -->
        <div class="card animate-in-1">
            <div class="empty-state">
                <div class="empty-state-icon">📖</div>
                <h3>No Recipes Yet</h3>
                <p>Start your culinary journey by creating your first recipe!</p>
                <a href="<?= $baseUrl ?>recipes/create" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Create Your First Recipe
                </a>
            </div>
        </div>
    <?php endif; ?>

</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>