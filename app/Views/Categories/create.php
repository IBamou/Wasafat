<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="breadcrumb">
    <a href="<?= $baseUrl ?>">Home</a>
    <span class="separator">/</span>
    <a href="<?= $baseUrl ?>categories">Categories</a>
    <span class="separator">/</span>
    <span>Create New</span>
</div>

<div class="page-content narrow">

    <div class="page-header-actions animate-in">
        <div class="page-header-text">
            <h1>Create Category</h1>
            <p>Add a new category to organize your recipes.</p>
        </div>
        <div class="header-decoration">📁</div>
    </div>

    <!-- Error Messages -->
    <?php if (!empty($errors)): ?>
        <?php foreach ($errors as $error): ?>
            <div class="alert alert-error animate-in">
                <i class="fas fa-exclamation-circle"></i>
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <form action="<?= $baseUrl ?>categories/create" method="POST">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">

        <section class="section-card animate-in-1">
            <h2 class="section-title">
                <span class="section-line"></span>
                Category Details
            </h2>

            <div class="form-group">
                <label for="name">Category Name</label>
                <input type="text" id="name" name="name" required
                    placeholder="e.g., Desserts, Main Courses, Appetizers..."
                    value="<?= htmlspecialchars($post['name'] ?? '') ?>">
            </div>

            <div class="form-group" style="margin-top: 16px;">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4"
                    placeholder="A brief description of this category..."><?= htmlspecialchars($post['description'] ?? '') ?></textarea>
            </div>

            <div style="display: flex; gap: 12px; margin-top: 24px; justify-content: flex-end;">
                <a href="<?= $baseUrl ?>categories" class="btn btn-ghost">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Create Category
                </button>
            </div>
        </section>
    </form>

</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>