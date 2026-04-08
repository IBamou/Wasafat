<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="breadcrumb">
    <a href="<?= $baseUrl ?>">Home</a>
    <span class="separator">/</span>
    <a href="<?= $baseUrl ?>categories">Categories</a>
    <span class="separator">/</span>
    <span><?= htmlspecialchars($category['name']) ?></span>
</div>

<div class="page-content">

    <!-- Success Message -->
    <?php if (!empty($_SESSION['success'])): ?>
        <div class="alert alert-success animate-in">
            <i class="fas fa-check-circle"></i>
            <?= htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>

    <!-- Category Detail Card -->
    <div class="section-card animate-in" style="margin-bottom: 28px;">
        <div class="detail-header">
            <h1 class="detail-title">
                <i class="fas fa-folder" style="color: var(--color-brown); margin-right: 8px;"></i>
                <?= htmlspecialchars($category['name']) ?>
            </h1>

            <div class="detail-meta">
                <div class="detail-meta-item">
                    <i class="fas fa-calendar"></i>
                    Created <?= date('F j, Y', strtotime($category['created_at'])) ?>
                </div>
            </div>

            <?php if (!empty($category['description'])): ?>
                <p class="detail-description"><?= nl2br(htmlspecialchars($category['description'])) ?></p>
            <?php endif; ?>

            <div class="detail-actions">
                <a href="<?= $baseUrl ?>categories/edit/<?= $category['id'] ?>" class="btn btn-secondary">
                    <i class="fas fa-pen"></i> Edit Category
                </a>
                <button
                    type="button"
                    class="btn btn-danger"
                    onclick="confirmDelete('<?= $baseUrl ?>categories/delete/<?= $category['id'] ?>', 'This category and its association with recipes will be removed.')"
                >
                    <i class="fas fa-trash"></i> Delete
                </button>
                <a href="<?= $baseUrl ?>categories" class="btn btn-ghost">
                    <i class="fas fa-arrow-left"></i> All Categories
                </a>
            </div>
        </div>
    </div>

    <!-- Recipes in this Category -->
    <div class="section-card animate-in-1">
        <h2 class="section-title">
            <span class="section-line"></span>
            Recipes in this Category
        </h2>

        <?php if (!empty($recipes)): ?>
            <div class="card-grid">
                <?php foreach ($recipes as $recipe): ?>
                    <div class="card">
                        <h3 class="card-title">
                            <a href="<?= $baseUrl ?>recipes/<?= $recipe['id'] ?>">
                                <?= htmlspecialchars($recipe['name']) ?>
                            </a>
                        </h3>
                        <p class="card-description">
                            <?= htmlspecialchars($recipe['description'] ?? 'No description') ?>
                        </p>
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
                        <div class="card-actions">
                            <a href="<?= $baseUrl ?>recipes/<?= $recipe['id'] ?>" class="btn btn-sm btn-secondary">
                                <i class="fas fa-eye"></i> View
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <div class="empty-state-icon">🍽️</div>
                <h3>No Recipes Yet</h3>
                <p>No recipes have been assigned to this category.</p>
                <a href="<?= $baseUrl ?>recipes/create" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Create a Recipe
                </a>
            </div>
        <?php endif; ?>
    </div>

</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>