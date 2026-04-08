<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="breadcrumb">
    <a href="<?= $baseUrl ?>">Home</a>
    <span class="separator">/</span>
    <span>Categories</span>
</div>

<div class="page-content">

    <!-- Page Header -->
    <div class="page-header-actions animate-in">
        <div class="page-header-text">
            <h1>Categories</h1>
            <p>Organize your recipes into meaningful collections.</p>
        </div>
        <a href="<?= $baseUrl ?>categories/create" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Category
        </a>
    </div>

    <!-- Success Message -->
    <?php if (!empty($_SESSION['success'])): ?>
        <div class="alert alert-success animate-in">
            <i class="fas fa-check-circle"></i>
            <?= htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>

    <!-- Categories Grid -->
    <?php if (!empty($categories)): ?>
        <div class="card-grid">
            <?php foreach ($categories as $index => $category): ?>
                <div class="card animate-in-<?= min($index + 1, 4) ?>">
                    <h3 class="card-title">
                        <a href="<?= $baseUrl ?>categories/<?= $category['id'] ?>">
                            <i class="fas fa-folder" style="color: var(--color-brown); margin-right: 6px;"></i>
                            <?= htmlspecialchars($category['name']) ?>
                        </a>
                    </h3>

                    <p class="card-description">
                        <?= htmlspecialchars($category['description'] ?? 'No description provided.') ?>
                    </p>

                    <div class="card-meta">
                        <span><i class="fas fa-calendar"></i> <?= date('M j, Y', strtotime($category['created_at'])) ?></span>
                    </div>

                    <div class="card-actions">
                        <a href="<?= $baseUrl ?>categories/<?= $category['id'] ?>" class="btn btn-sm btn-secondary">
                            <i class="fas fa-eye"></i> View
                        </a>
                        <a href="<?= $baseUrl ?>categories/edit/<?= $category['id'] ?>" class="btn btn-sm btn-ghost">
                            <i class="fas fa-pen"></i> Edit
                        </a>
                        <button
                            type="button"
                            class="btn btn-sm btn-ghost"
                            style="color: var(--color-error);"
                            onclick="confirmDelete('<?= $baseUrl ?>categories/delete/<?= $category['id'] ?>', 'This category will be permanently deleted.')"
                        >
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="card animate-in-1">
            <div class="empty-state">
                <div class="empty-state-icon">📁</div>
                <h3>No Categories Yet</h3>
                <p>Create categories to organize your recipes better.</p>
                <a href="<?= $baseUrl ?>categories/create" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Create First Category
                </a>
            </div>
        </div>
    <?php endif; ?>

</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>