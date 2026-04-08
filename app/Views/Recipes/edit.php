<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="breadcrumb">
    <a href="<?= $baseUrl ?>">Home</a>
    <span class="separator">/</span>
    <a href="<?= $baseUrl ?>recipes">Recipes</a>
    <span class="separator">/</span>
    <a href="<?= $baseUrl ?>recipes/<?= $recipe['id'] ?>"><?= htmlspecialchars($recipe['name']) ?></a>
    <span class="separator">/</span>
    <span>Edit</span>
</div>

<div class="page-content narrow bottom-bar-spacing">

    <div class="page-header-actions animate-in">
        <div class="page-header-text">
            <h1>Edit Recipe</h1>
            <p>Update the details of your recipe below.</p>
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

    <form action="<?= $baseUrl ?>recipes/edit/<?= $recipe['id'] ?>" method="POST" class="recipe-form" id="recipeForm">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">

        <!-- ========== Section 1: Essentials ========== -->
        <section class="section-card animate-in-1">
            <h2 class="section-title">
                <span class="section-line"></span>
                Recipe Essentials
            </h2>

            <div class="form-grid">
                <div class="form-group full-width">
                    <label for="name">Recipe Title</label>
                    <input type="text" id="name" name="name" required
                        placeholder="e.g., Lamb Tagine with Prunes"
                        value="<?= htmlspecialchars($post['name'] ?? $recipe['name'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select id="category_id" name="category_id">
                        <option value="">Select category</option>
                        <?php if (!empty($categories)): ?>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>"
                                    <?= (($post['category_id'] ?? $recipe['category_id'] ?? '') == $cat['id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($cat['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="preparation_time">Prep Time</label>
                    <div class="input-with-suffix">
                        <input type="number" id="preparation_time" name="preparation_time" min="0"
                            placeholder="30"
                            value="<?= htmlspecialchars($post['preparation_time'] ?? $recipe['preparation_time'] ?? '') ?>">
                        <span class="suffix">min</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="cooking_time">Cook Time</label>
                    <div class="input-with-suffix">
                        <input type="number" id="cooking_time" name="cooking_time" min="0"
                            placeholder="45"
                            value="<?= htmlspecialchars($post['cooking_time'] ?? $recipe['cooking_time'] ?? '') ?>">
                        <span class="suffix">min</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="difficulty">Difficulty</label>
                    <select id="difficulty" name="difficulty">
                        <option value="easy" <?= ($post['difficulty'] ?? $recipe['difficulty'] ?? '') === 'easy' ? 'selected' : '' ?>>Easy</option>
                        <option value="medium" <?= ($post['difficulty'] ?? $recipe['difficulty'] ?? 'medium') === 'medium' ? 'selected' : '' ?>>Medium</option>
                        <option value="hard" <?= ($post['difficulty'] ?? $recipe['difficulty'] ?? '') === 'hard' ? 'selected' : '' ?>>Hard</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="3"
                    placeholder="A brief description of your recipe..."><?= htmlspecialchars($post['description'] ?? $recipe['description'] ?? '') ?></textarea>
            </div>
        </section>

        <!-- ========== Section 2: Ingredients ========== -->
        <section class="section-card animate-in-2">
            <div class="section-header">
                <h2 class="section-title">
                    <span class="section-line"></span>
                    Ingredients
                </h2>
                <button type="button" class="btn-add-field" id="addIngredient">
                    <span class="material-symbols-outlined">add</span>
                    Add
                </button>
            </div>

            <div class="ingredients-list" id="ingredientsList">
                <?php
                $ingredientsData = $post['ingredients'] ?? $recipe['ingredients'] ?? '';
                $ingredientItems = is_array($ingredientsData)
                    ? $ingredientsData
                    : (is_string($ingredientsData) ? explode("\n", $ingredientsData) : []);
                if (empty($ingredientItems)) $ingredientItems = [''];
                foreach ($ingredientItems as $ingredient):
                ?>
                    <div class="ingredient-row">
                        <input type="text" name="ingredients[]"
                            value="<?= htmlspecialchars($ingredient) ?>"
                            placeholder="Ingredient..."
                            autocomplete="off">
                        <button type="button" class="btn-icon-action" onclick="removeRow(this, 'ingredient')">
                            <span class="material-symbols-outlined">delete</span>
                        </button>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- ========== Section 3: Instructions ========== -->
        <section class="section-card animate-in-3">
            <h2 class="section-title">
                <span class="section-line"></span>
                Step by Step Instructions
            </h2>

            <div class="instructions-list" id="instructionsList">
                <?php
                $instructionsData = $post['instructions'] ?? $recipe['instructions'] ?? '';
                $instructionItems = is_array($instructionsData)
                    ? $instructionsData
                    : (is_string($instructionsData) ? explode("\n", $instructionsData) : []);
                if (empty($instructionItems)) $instructionItems = [''];
                foreach ($instructionItems as $i => $instruction):
                ?>
                    <div class="instruction-step">
                        <span class="step-number"><?= $i + 1 ?></span>
                        <textarea name="instructions[]" rows="3"
                            placeholder="Step <?= $i + 1 ?>..."><?= htmlspecialchars($instruction) ?></textarea>
                        <button type="button" class="btn-icon-action" onclick="removeRow(this, 'step')">
                            <span class="material-symbols-outlined">delete</span>
                        </button>
                    </div>
                <?php endforeach; ?>
            </div>

            <button type="button" class="btn-add-step" id="addStep">
                + Add Step
            </button>
        </section>

        <!-- ========== Bottom Bar ========== -->
        <div class="bottom-bar">
            <div class="save-status">
                <span class="status-icon">✏️</span>
                <div>
                    <p class="status-label">Editing</p>
                    <p class="status-time" id="statusTime">No changes yet</p>
                </div>
            </div>
            <div class="bottom-bar-actions">
                <a href="<?= $baseUrl ?>recipes/<?= $recipe['id'] ?>" class="btn btn-ghost">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Recipe
                </button>
            </div>
        </div>
    </form>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const ingredientsList = document.getElementById('ingredientsList');
    const instructionsList = document.getElementById('instructionsList');

    document.getElementById('addIngredient').addEventListener('click', function () {
        const row = document.createElement('div');
        row.className = 'ingredient-row';
        row.innerHTML = `
            <input type="text" name="ingredients[]" placeholder="New ingredient..." autocomplete="off">
            <button type="button" class="btn-icon-action" onclick="removeRow(this, 'ingredient')">
                <span class="material-symbols-outlined">delete</span>
            </button>
        `;
        ingredientsList.appendChild(row);
        row.querySelector('input').focus();
    });

    ingredientsList.addEventListener('keypress', function (e) {
        if (e.key === 'Enter' && e.target.tagName === 'INPUT') {
            e.preventDefault();
            document.getElementById('addIngredient').click();
        }
    });

    document.getElementById('addStep').addEventListener('click', function () {
        const count = instructionsList.querySelectorAll('.instruction-step').length + 1;
        const step = document.createElement('div');
        step.className = 'instruction-step';
        step.innerHTML = `
            <span class="step-number">${count}</span>
            <textarea name="instructions[]" rows="3" placeholder="Describe step ${count}..."></textarea>
            <button type="button" class="btn-icon-action" onclick="removeRow(this, 'step')">
                <span class="material-symbols-outlined">delete</span>
            </button>
        `;
        instructionsList.appendChild(step);
        step.querySelector('textarea').focus();
    });

    document.getElementById('recipeForm').addEventListener('input', function () {
        document.getElementById('statusTime').textContent = 'Unsaved changes';
    });
});

function removeRow(btn, type) {
    const parent = btn.closest(type === 'step' ? '.instruction-step' : '.ingredient-row');
    const list = parent.parentElement;
    const selector = type === 'step' ? '.instruction-step' : '.ingredient-row';
    if (list.querySelectorAll(selector).length <= 1) {
        alert('You need at least one ' + (type === 'step' ? 'step' : 'ingredient'));
        return;
    }
    parent.remove();
    if (type === 'step') renumberSteps();
}

function renumberSteps() {
    document.querySelectorAll('#instructionsList .instruction-step').forEach((step, i) => {
        step.querySelector('.step-number').textContent = i + 1;
    });
}
</script>

<?php include __DIR__ . '/../partials/footer.php'; ?>