<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="breadcrumb">
    <a href="<?= $baseUrl ?>">Home</a>
    <span class="separator">/</span>
    <a href="<?= $baseUrl ?>categories">Categories</a>
    <span class="separator">/</span>
    <a href="<?= $baseUrl ?>categories/<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></a>
    <span class="separator">/</span>
    <span>Edit</span>
</div>

<div class="page-content narrow">

    <div class="page-header-actions animate-in">
        <div class="page-header-text">
            <h1>Edit Category</h1>
            <p>Update the details for "<?= htmlspecialchars($category['name']) ?>".</p>
        </div>
        <div class="header-decoration">✏️</div>
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

    <form action="<?= $baseUrl ?>categories/edit/<?= $category['id'] ?>" method="POST">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">

        <section class="section-card animate-in-1">
            <h2 class="section-title">
                <span class="section-line"></span>
                Category Details
            </h2>

            <div class="form-group">
                <label for="name">Category Name</label>
                <input type="text" id="name" name="name" required
                    placeholder="Category name"
                    value="<?= htmlspecialchars($post['name'] ?? $category['name'] ?? '') ?>">
            </div>

            <div class="form-group" style="margin-top: 16px;">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4"
                    placeholder="A brief description..."><?= htmlspecialchars($post['description'] ?? $category['description'] ?? '') ?></textarea>
            </div>

            <div style="display: flex; gap: 12px; margin-top: 24px; justify-content: flex-end;">
                <a href="<?= $baseUrl ?>categories/<?= $category['id'] ?>" class="btn btn-ghost">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Category
                </button>
            </div>
        </section>
    </form>

</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>