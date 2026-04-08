<?php include __DIR__ . '/../partials/header.php'; ?>

<style>
    /* ===================== CREATE RECIPE PAGE ===================== */
    .create-recipe-page {
        max-width: 780px;
        margin: 0 auto;
        padding: 30px 40px 140px;
        width: 100%;
    }

    .recipe-form {
        display: flex;
        flex-direction: column;
        gap: 26px;
    }

    /* Header Decoration */
    .page-header-decoration {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 32px;
    }

    .page-header-decoration .page-header-text h1 {
        font-family: var(--font-heading);
        font-size: 32px;
        color: var(--color-primary);
        font-weight: 700;
        margin-bottom: 8px;
        line-height: 1.25;
    }

    .page-header-decoration .page-header-text p {
        font-size: 14px;
        color: var(--color-text-muted);
        line-height: 1.7;
        max-width: 520px;
    }

    .header-emoji-badge {
        width: 78px;
        height: 78px;
        border-radius: var(--radius-full);
        background: linear-gradient(135deg, #f5e6d3, #e8c9a0);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 36px;
        flex-shrink: 0;
        box-shadow: 0 4px 14px rgba(160, 82, 45, 0.12);
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-6px); }
    }

    /* ===================== FORM SECTION CARD ===================== */
    .form-card {
        background: var(--color-bg-card);
        border-radius: var(--radius-lg);
        padding: 30px 32px;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--color-border-light);
        transition: box-shadow var(--transition-normal);
        position: relative;
    }

    .form-card:hover {
        box-shadow: var(--shadow-lg);
    }

    /* Section Title */
    .form-card .card-section-title {
        display: flex;
        align-items: center;
        gap: 12px;
        font-family: var(--font-heading);
        font-size: 20px;
        color: var(--color-primary);
        font-weight: 700;
        margin-bottom: 24px;
    }

    .card-section-title .title-bar {
        display: inline-block;
        width: 30px;
        height: 3px;
        background-color: var(--color-accent);
        border-radius: 3px;
        flex-shrink: 0;
    }

    .card-section-title .title-icon {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        flex-shrink: 0;
        margin-left: auto;
    }

    .title-icon.essentials { background: rgba(160, 82, 45, 0.08); color: var(--color-brown); }
    .title-icon.ingredients { background: rgba(39, 174, 96, 0.08); color: var(--color-success); }
    .title-icon.instructions { background: rgba(52, 152, 219, 0.08); color: var(--color-info); }

    /* Section Header with Action Button */
    .card-section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 22px;
    }

    .card-section-header .card-section-title {
        margin-bottom: 0;
    }

    /* ===================== FORM GRID ===================== */
    .fields-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px 22px;
        margin-bottom: 18px;
    }

    .fields-grid .span-full {
        grid-column: 1 / -1;
    }

    /* ===================== FORM GROUP ===================== */
    .field-group {
        display: flex;
        flex-direction: column;
        gap: 7px;
    }

    .field-group label {
        font-size: 10.5px;
        font-weight: 600;
        color: var(--color-text-light);
        text-transform: uppercase;
        letter-spacing: 1.3px;
    }

    .field-group label .required-star {
        color: var(--color-accent);
        margin-left: 2px;
    }

    .field-group input[type="text"],
    .field-group input[type="number"],
    .field-group select,
    .field-group textarea {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid var(--color-border-input);
        border-radius: var(--radius-md);
        font-size: 13.5px;
        font-family: var(--font-body);
        color: var(--color-text);
        background: var(--color-bg-input);
        transition: border-color var(--transition-normal), box-shadow var(--transition-normal), background var(--transition-normal);
        outline: none;
    }

    .field-group input:focus,
    .field-group select:focus,
    .field-group textarea:focus {
        border-color: var(--color-accent);
        box-shadow: 0 0 0 3px var(--color-accent-light);
        background: #fff;
    }

    .field-group input::placeholder,
    .field-group textarea::placeholder {
        color: var(--color-text-placeholder);
    }

    .field-group select {
        appearance: none;
        -webkit-appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23888' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 14px center;
        padding-right: 38px;
        cursor: pointer;
    }

    .field-group textarea {
        resize: vertical;
        min-height: 80px;
        line-height: 1.65;
    }

    /* Input with suffix */
    .suffixed-input {
        position: relative;
    }

    .suffixed-input input {
        width: 100%;
        padding-right: 52px !important;
    }

    .suffixed-input .input-suffix {
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 12px;
        color: var(--color-text-muted);
        font-weight: 500;
        pointer-events: none;
    }

    /* Character counter */
    .char-counter {
        font-size: 10px;
        color: var(--color-text-placeholder);
        text-align: right;
        margin-top: 2px;
        transition: color var(--transition-fast);
    }

    .char-counter.warning { color: var(--color-warning); }
    .char-counter.danger { color: var(--color-error); }

    /* ===================== INGREDIENTS LIST ===================== */
    .ingredient-items {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .ingredient-entry {
        display: flex;
        align-items: center;
        gap: 10px;
        animation: slideIn 0.3s ease;
    }

    .ingredient-entry .drag-handle {
        cursor: grab;
        color: var(--color-text-placeholder);
        font-size: 16px;
        padding: 4px;
        transition: color var(--transition-fast);
        flex-shrink: 0;
    }

    .ingredient-entry .drag-handle:hover {
        color: var(--color-text-muted);
    }

    .ingredient-entry input {
        flex: 1;
        padding: 12px 16px;
        border: 1px solid var(--color-border-input);
        border-radius: var(--radius-md);
        font-size: 13.5px;
        font-family: var(--font-body);
        color: var(--color-text);
        background: var(--color-bg-input);
        transition: border-color var(--transition-normal), box-shadow var(--transition-normal), background var(--transition-normal);
        outline: none;
    }

    .ingredient-entry input:focus {
        border-color: var(--color-accent);
        box-shadow: 0 0 0 3px var(--color-accent-light);
        background: #fff;
    }

    .ingredient-entry input::placeholder {
        color: var(--color-text-placeholder);
    }

    .ingredient-count {
        font-size: 11px;
        color: var(--color-text-muted);
        margin-top: 8px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .ingredient-count i {
        font-size: 12px;
    }

    /* ===================== DELETE BUTTON ===================== */
    .remove-btn {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        background: var(--color-accent);
        color: #fff;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: all var(--transition-fast);
        font-size: 14px;
    }

    .remove-btn:hover {
        background: var(--color-accent-hover);
        transform: scale(1.08);
    }

    .remove-btn .material-symbols-outlined {
        font-size: 18px;
    }

    /* ===================== ADD BUTTON ===================== */
    .add-btn-inline {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 8px 18px;
        background: none;
        border: none;
        color: var(--color-accent);
        font-size: 13px;
        font-weight: 600;
        font-family: var(--font-body);
        cursor: pointer;
        border-radius: var(--radius-md);
        transition: background var(--transition-fast), color var(--transition-fast);
    }

    .add-btn-inline:hover {
        background: var(--color-accent-light);
        color: var(--color-accent-hover);
    }

    .add-btn-inline .material-symbols-outlined {
        font-size: 18px;
    }

    .add-step-btn {
        margin-top: 16px;
        padding: 12px 26px;
        background: var(--color-bg-warm);
        border: 1px dashed #d4c9b8;
        border-radius: var(--radius-md);
        color: var(--color-text-muted);
        font-size: 13px;
        font-weight: 500;
        font-family: var(--font-body);
        cursor: pointer;
        transition: all var(--transition-normal);
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .add-step-btn:hover {
        background: #ece5da;
        color: var(--color-text-light);
        border-color: #c0a87c;
    }

    /* ===================== INSTRUCTION STEPS ===================== */
    .step-items {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .step-entry {
        display: flex;
        gap: 14px;
        align-items: flex-start;
        animation: slideIn 0.3s ease;
    }

    .step-badge {
        width: 32px;
        height: 32px;
        border-radius: var(--radius-full);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: 700;
        flex-shrink: 0;
        margin-top: 8px;
        transition: all var(--transition-normal);
        background-color: var(--color-border-light);
        color: var(--color-text-muted);
        border: 1px solid var(--color-border);
    }

    .step-entry:first-child .step-badge {
        background-color: var(--color-accent);
        color: #fff;
        border-color: var(--color-accent);
        box-shadow: 0 2px 8px rgba(192, 57, 43, 0.2);
    }

    .step-entry textarea {
        flex: 1;
        padding: 14px 18px;
        border: 1px solid var(--color-border-input);
        border-radius: var(--radius-md);
        font-size: 13.5px;
        font-family: var(--font-body);
        color: var(--color-text);
        background: var(--color-bg-warm);
        min-height: 92px;
        resize: vertical;
        outline: none;
        line-height: 1.65;
        transition: border-color var(--transition-normal), box-shadow var(--transition-normal), background var(--transition-normal);
    }

    .step-entry textarea:focus {
        border-color: var(--color-accent);
        box-shadow: 0 0 0 3px var(--color-accent-light);
        background: #fff;
    }

    .step-entry textarea::placeholder {
        color: var(--color-text-placeholder);
    }

    .step-entry .remove-btn {
        margin-top: 8px;
    }

    .step-count {
        font-size: 11px;
        color: var(--color-text-muted);
        margin-top: 8px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    /* ===================== BOTTOM BAR ===================== */
    .form-bottom-bar {
        position: fixed;
        bottom: 0;
        left: var(--sidebar-width);
        right: 0;
        background: var(--color-bg-card);
        border-top: 1px solid var(--color-border);
        padding: 14px 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 24px;
        z-index: 99;
        box-shadow: 0 -3px 16px rgba(0, 0, 0, 0.05);
    }

    .draft-indicator {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .draft-indicator .draft-dot {
        width: 36px;
        height: 36px;
        border-radius: var(--radius-full);
        background: linear-gradient(135deg, #2ecc71, #27ae60);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 16px;
        flex-shrink: 0;
        transition: background var(--transition-normal);
    }

    .draft-indicator .draft-dot.unsaved {
        background: linear-gradient(135deg, var(--color-warning), #e67e22);
    }

    .draft-indicator .draft-label {
        font-size: 13px;
        font-weight: 600;
        color: var(--color-text);
    }

    .draft-indicator .draft-time {
        font-size: 11px;
        color: var(--color-text-muted);
        margin-top: 1px;
    }

    .bar-actions {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .btn-bar-cancel {
        padding: 10px 24px;
        background: none;
        border: none;
        font-size: 13.5px;
        color: var(--color-text-light);
        cursor: pointer;
        font-family: var(--font-body);
        font-weight: 500;
        border-radius: var(--radius-md);
        transition: all var(--transition-fast);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-bar-cancel:hover {
        color: var(--color-accent);
        background: var(--color-accent-light);
    }

    .btn-bar-submit {
        padding: 12px 30px;
        background: var(--color-accent);
        color: #fff;
        border: none;
        border-radius: var(--radius-md);
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        font-family: var(--font-body);
        transition: all var(--transition-normal);
        box-shadow: var(--shadow-accent);
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-bar-submit:hover {
        background: var(--color-accent-hover);
        transform: translateY(-1px);
        box-shadow: 0 5px 20px rgba(192, 57, 43, 0.35);
    }

    .btn-bar-submit:active {
        transform: translateY(0);
    }

    .btn-bar-submit.saving {
        pointer-events: none;
        opacity: 0.85;
    }

    /* ===================== DIFFICULTY SELECTOR ===================== */
    .difficulty-options {
        display: flex;
        gap: 8px;
    }

    .difficulty-option {
        flex: 1;
        position: relative;
    }

    .difficulty-option input[type="radio"] {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    .difficulty-option label {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 11px 14px;
        border: 1px solid var(--color-border-input);
        border-radius: var(--radius-md);
        font-size: 12.5px;
        font-weight: 500;
        color: var(--color-text-light);
        cursor: pointer;
        transition: all var(--transition-normal);
        background: var(--color-bg-input);
        text-transform: none;
        letter-spacing: 0;
    }

    .difficulty-option label:hover {
        border-color: var(--color-text-muted);
        background: var(--color-bg-warm);
    }

    .difficulty-option input:checked + label {
        border-color: var(--color-accent);
        background: var(--color-accent-light);
        color: var(--color-accent);
        font-weight: 600;
        box-shadow: 0 0 0 2px var(--color-accent-light);
    }

    .difficulty-option label .diff-emoji {
        font-size: 15px;
    }

    /* ===================== TIPS BOX ===================== */
    .tips-box {
        background: linear-gradient(135deg, #fef9e7, #fdf2e9);
        border: 1px solid #f9e79f;
        border-radius: var(--radius-md);
        padding: 16px 20px;
        margin-top: 20px;
    }

    .tips-box h4 {
        font-size: 12px;
        font-weight: 600;
        color: #b7950b;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .tips-box ul {
        list-style: none;
        padding: 0;
    }

    .tips-box li {
        font-size: 12px;
        color: #7d6608;
        padding: 3px 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .tips-box li::before {
        content: '✦';
        font-size: 8px;
        color: #d4ac0d;
        flex-shrink: 0;
    }

    /* ===================== RESPONSIVE ===================== */
    @media (max-width: 768px) {
        .create-recipe-page {
            padding: 20px 16px 150px;
        }

        .form-card {
            padding: 22px 20px;
        }

        .fields-grid {
            grid-template-columns: 1fr;
        }

        .page-header-decoration {
            flex-direction: column;
        }

        .header-emoji-badge {
            width: 60px;
            height: 60px;
            font-size: 28px;
        }

        .page-header-decoration .page-header-text h1 {
            font-size: 26px;
        }

        .form-bottom-bar {
            left: 0;
            padding: 12px 16px;
            flex-direction: column;
            gap: 12px;
        }

        .draft-indicator {
            width: 100%;
        }

        .bar-actions {
            width: 100%;
            justify-content: flex-end;
        }

        .card-section-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }

        .difficulty-options {
            flex-direction: column;
        }

        .step-entry {
            gap: 10px;
        }

        .step-badge {
            width: 28px;
            height: 28px;
            font-size: 12px;
        }
    }

    @media (max-width: 480px) {
        .page-header-decoration .page-header-text h1 {
            font-size: 22px;
        }

        .card-section-title {
            font-size: 17px;
        }

        .tips-box {
            padding: 14px 16px;
        }
    }
</style>

<div class="breadcrumb">
    <a href="<?= $baseUrl ?>">Home</a>
    <span class="separator">/</span>
    <a href="<?= $baseUrl ?>recipes">Recipes</a>
    <span class="separator">/</span>
    <span>Create New</span>
</div>

<div class="create-recipe-page">

    <!-- Page Header -->
    <div class="page-header-decoration animate-in">
        <div class="page-header-text">
            <h1>Create New Recipe</h1>
            <p>Share your culinary creation with the community. Fill in the details below to immortalize your dish in the Riad Digital.</p>
        </div>
        <div class="header-emoji-badge">🍳</div>
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

    <!-- Recipe Form -->
    <form action="<?= $baseUrl ?>recipes/create" method="POST" class="recipe-form" id="recipeForm" novalidate>
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">

        <!-- ==================== Section 1: Essentials ==================== -->
        <section class="form-card animate-in-1">
            <h2 class="card-section-title">
                <span class="title-bar"></span>
                Recipe Essentials
                <span class="title-icon essentials"><i class="fas fa-utensils"></i></span>
            </h2>

            <div class="fields-grid">
                <!-- Recipe Title -->
                <div class="field-group span-full">
                    <label for="name">
                        Recipe Title <span class="required-star">*</span>
                    </label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        required
                        placeholder="e.g., Lamb Tagine with Prunes"
                        value="<?= htmlspecialchars($_POST['name'] ?? '') ?>"
                        maxlength="150"
                        autocomplete="off"
                    >
                    <span class="char-counter" id="nameCounter">0 / 150</span>
                </div>

                <!-- Category -->
                <div class="field-group">
                    <label for="category_id">Category</label>
                    <select id="category_id" name="category_id">
                        <option value="">Select category</option>
                        <?php if (!empty($categories)): ?>
                            <?php foreach ($categories as $cat): ?>
                                <option
                                    value="<?= $cat['id'] ?>"
                                    <?= (($_POST['category_id'] ?? '') == $cat['id']) ? 'selected' : '' ?>
                                >
                                    <?= htmlspecialchars($cat['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <!-- Difficulty (Custom Radio) -->
                <div class="field-group">
                    <label>Difficulty</label>
                    <div class="difficulty-options">
                        <div class="difficulty-option">
                            <input type="radio" id="diff_easy" name="difficulty" value="easy"
                                <?= (($_POST['difficulty'] ?? '') === 'easy') ? 'checked' : '' ?>>
                            <label for="diff_easy">
                                <span class="diff-emoji">🟢</span> Easy
                            </label>
                        </div>
                        <div class="difficulty-option">
                            <input type="radio" id="diff_medium" name="difficulty" value="medium"
                                <?= (($_POST['difficulty'] ?? 'medium') === 'medium') ? 'checked' : '' ?>>
                            <label for="diff_medium">
                                <span class="diff-emoji">🟡</span> Medium
                            </label>
                        </div>
                        <div class="difficulty-option">
                            <input type="radio" id="diff_hard" name="difficulty" value="hard"
                                <?= (($_POST['difficulty'] ?? '') === 'hard') ? 'checked' : '' ?>>
                            <label for="diff_hard">
                                <span class="diff-emoji">🔴</span> Hard
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Prep Time -->
                <div class="field-group">
                    <label for="preparation_time">Prep Time</label>
                    <div class="suffixed-input">
                        <input
                            type="number"
                            id="preparation_time"
                            name="preparation_time"
                            min="0"
                            max="9999"
                            placeholder="30"
                            value="<?= htmlspecialchars($_POST['preparation_time'] ?? '') ?>"
                        >
                        <span class="input-suffix">min</span>
                    </div>
                </div>

                <!-- Cook Time -->
                <div class="field-group">
                    <label for="cooking_time">Cook Time</label>
                    <div class="suffixed-input">
                        <input
                            type="number"
                            id="cooking_time"
                            name="cooking_time"
                            min="0"
                            max="9999"
                            placeholder="45"
                            value="<?= htmlspecialchars($_POST['cooking_time'] ?? '') ?>"
                        >
                        <span class="input-suffix">min</span>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="field-group" style="margin-top: 4px;">
                <label for="description">Description</label>
                <textarea
                    id="description"
                    name="description"
                    rows="3"
                    placeholder="A brief description of your recipe — its story, flavors, and what makes it special..."
                    maxlength="500"
                ><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
                <span class="char-counter" id="descCounter">0 / 500</span>
            </div>

            <div class="tips-box">
                <h4><i class="fas fa-lightbulb"></i> Quick Tips</h4>
                <ul>
                    <li>A great title helps others find your recipe</li>
                    <li>Be specific with prep and cook times</li>
                    <li>A compelling description tells the story behind the dish</li>
                </ul>
            </div>
        </section>

        <!-- ==================== Section 2: Ingredients ==================== -->
        <section class="form-card animate-in-2">
            <div class="card-section-header">
                <h2 class="card-section-title">
                    <span class="title-bar"></span>
                    Ingredients
                    <span class="title-icon ingredients"><i class="fas fa-carrot"></i></span>
                </h2>
                <button type="button" class="add-btn-inline" id="addIngredientBtn">
                    <span class="material-symbols-outlined">add</span>
                    Add Ingredient
                </button>
            </div>

            <div class="ingredient-items" id="ingredientsList">
                <?php
                $ingredients = $_POST['ingredients'] ?? ['', '', ''];
                if (empty($ingredients)) $ingredients = ['', '', ''];
                $placeholders = [
                    'e.g., 500g semolina',
                    'e.g., 1 sachet pure saffron',
                    'e.g., 2 tbsp olive oil',
                    'e.g., 1 tsp ground cinnamon',
                    'e.g., 3 cloves garlic, minced',
                ];
                foreach ($ingredients as $i => $ingredient):
                ?>
                    <div class="ingredient-entry">
                        <span class="drag-handle" title="Drag to reorder">
                            <i class="fas fa-grip-vertical"></i>
                        </span>
                        <input
                            type="text"
                            name="ingredients[]"
                            placeholder="<?= $placeholders[$i] ?? 'Add another ingredient...' ?>"
                            value="<?= htmlspecialchars($ingredient) ?>"
                            autocomplete="off"
                        >
                        <button type="button" class="remove-btn" onclick="removeIngredient(this)" title="Remove">
                            <span class="material-symbols-outlined">delete</span>
                        </button>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="ingredient-count" id="ingredientCount">
                <i class="fas fa-list"></i>
                <span><?= count($ingredients) ?> ingredient(s)</span>
            </div>
        </section>

        <!-- ==================== Section 3: Instructions ==================== -->
        <section class="form-card animate-in-3">
            <h2 class="card-section-title">
                <span class="title-bar"></span>
                Step by Step Instructions
                <span class="title-icon instructions"><i class="fas fa-list-ol"></i></span>
            </h2>

            <div class="step-items" id="instructionsList">
                <?php
                $instructions = $_POST['instructions'] ?? ['', ''];
                if (empty($instructions)) $instructions = ['', ''];
                $stepPlaceholders = [
                    'Describe the first step of your culinary secret...',
                    'What comes next in the ritual?',
                    'Continue building the flavors...',
                    'Describe the finishing touches...',
                ];
                foreach ($instructions as $i => $instruction):
                ?>
                    <div class="step-entry">
                        <span class="step-badge"><?= $i + 1 ?></span>
                        <textarea
                            name="instructions[]"
                            rows="3"
                            placeholder="<?= $stepPlaceholders[$i] ?? 'Describe step ' . ($i + 1) . '...' ?>"
                        ><?= htmlspecialchars($instruction) ?></textarea>
                        <button type="button" class="remove-btn" onclick="removeStep(this)" title="Remove step">
                            <span class="material-symbols-outlined">delete</span>
                        </button>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="step-count" id="stepCount">
                <i class="fas fa-shoe-prints"></i>
                <span><?= count($instructions) ?> step(s)</span>
            </div>

            <button type="button" class="add-step-btn" id="addStepBtn">
                <i class="fas fa-plus"></i> Add Step
            </button>
        </section>

        <!-- ==================== Bottom Bar ==================== -->
        <div class="form-bottom-bar">
            <div class="draft-indicator">
                <span class="draft-dot" id="draftDot">✨</span>
                <div>
                    <p class="draft-label" id="draftLabel">Draft</p>
                    <p class="draft-time" id="draftTime">Ready to save</p>
                </div>
            </div>
            <div class="bar-actions">
                <a href="<?= $baseUrl ?>recipes" class="btn-bar-cancel">
                    <i class="fas fa-times"></i> Cancel
                </a>
                <button type="submit" class="btn-bar-submit" id="submitBtn">
                    <i class="fas fa-save"></i> Save Recipe
                </button>
            </div>
        </div>
    </form>
</div>

<!-- ==================== JAVASCRIPT ==================== -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    const ingredientsList = document.getElementById('ingredientsList');
    const instructionsList = document.getElementById('instructionsList');
    const form = document.getElementById('recipeForm');
    let hasChanges = false;

    // ======================== CHARACTER COUNTERS ========================
    function initCharCounter(inputId, counterId, max) {
        const input = document.getElementById(inputId);
        const counter = document.getElementById(counterId);
        if (!input || !counter) return;

        function update() {
            const len = input.value.length;
            counter.textContent = len + ' / ' + max;
            counter.classList.remove('warning', 'danger');
            if (len > max * 0.9) counter.classList.add('danger');
            else if (len > max * 0.75) counter.classList.add('warning');
        }

        input.addEventListener('input', update);
        update();
    }

    initCharCounter('name', 'nameCounter', 150);
    initCharCounter('description', 'descCounter', 500);

    // ======================== DRAFT STATUS ========================
    const draftDot = document.getElementById('draftDot');
    const draftLabel = document.getElementById('draftLabel');
    const draftTime = document.getElementById('draftTime');

    function markUnsaved() {
        if (!hasChanges) {
            hasChanges = true;
            draftDot.classList.add('unsaved');
            draftDot.textContent = '✏️';
            draftLabel.textContent = 'Unsaved';
            draftTime.textContent = 'You have unsaved changes';
        }
    }

    form.addEventListener('input', markUnsaved);
    form.addEventListener('change', markUnsaved);

    // ======================== ADD INGREDIENT ========================
    document.getElementById('addIngredientBtn').addEventListener('click', function () {
        addIngredientRow('');
    });

    function addIngredientRow(value) {
        const row = document.createElement('div');
        row.className = 'ingredient-entry';
        row.innerHTML = `
            <span class="drag-handle" title="Drag to reorder">
                <i class="fas fa-grip-vertical"></i>
            </span>
            <input type="text" name="ingredients[]" placeholder="Add another ingredient..." value="${escapeHtml(value)}" autocomplete="off">
            <button type="button" class="remove-btn" onclick="removeIngredient(this)" title="Remove">
                <span class="material-symbols-outlined">delete</span>
            </button>
        `;
        ingredientsList.appendChild(row);
        row.querySelector('input').focus();
        updateIngredientCount();
        markUnsaved();
    }

    // Enter key → add ingredient
    ingredientsList.addEventListener('keypress', function (e) {
        if (e.key === 'Enter' && e.target.tagName === 'INPUT') {
            e.preventDefault();
            addIngredientRow('');
        }
    });

    // ======================== ADD STEP ========================
    document.getElementById('addStepBtn').addEventListener('click', function () {
        addStepRow('');
    });

    function addStepRow(value) {
        const count = instructionsList.querySelectorAll('.step-entry').length + 1;
        const step = document.createElement('div');
        step.className = 'step-entry';
        step.innerHTML = `
            <span class="step-badge">${count}</span>
            <textarea name="instructions[]" rows="3" placeholder="Describe step ${count}...">${escapeHtml(value)}</textarea>
            <button type="button" class="remove-btn" onclick="removeStep(this)" title="Remove step">
                <span class="material-symbols-outlined">delete</span>
            </button>
        `;
        instructionsList.appendChild(step);
        step.querySelector('textarea').focus();
        updateStepCount();
        markUnsaved();
    }

    // ======================== FORM SUBMIT ========================
    form.addEventListener('submit', function (e) {
        const nameVal = document.getElementById('name').value.trim();
        if (!nameVal) {
            e.preventDefault();
            showToast('Please enter a recipe title.', 'error');
            document.getElementById('name').focus();
            return;
        }

        // Remove empty ingredient/instruction fields before submit
        ingredientsList.querySelectorAll('input[name="ingredients[]"]').forEach(input => {
            if (!input.value.trim()) input.removeAttribute('name');
        });

        instructionsList.querySelectorAll('textarea[name="instructions[]"]').forEach(textarea => {
            if (!textarea.value.trim()) textarea.removeAttribute('name');
        });

        // Visual feedback
        const btn = document.getElementById('submitBtn');
        btn.classList.add('saving');
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
    });

    // ======================== UNSAVED CHANGES WARNING ========================
    window.addEventListener('beforeunload', function (e) {
        if (hasChanges) {
            e.preventDefault();
            e.returnValue = '';
        }
    });

    // Don't warn on form submit
    form.addEventListener('submit', function () {
        hasChanges = false;
    });

    // ======================== UPDATE COUNTS ========================
    window.updateIngredientCount = function () {
        const count = ingredientsList.querySelectorAll('.ingredient-entry').length;
        document.getElementById('ingredientCount').querySelector('span').textContent = count + ' ingredient(s)';
    };

    window.updateStepCount = function () {
        const count = instructionsList.querySelectorAll('.step-entry').length;
        document.getElementById('stepCount').querySelector('span').textContent = count + ' step(s)';
    };

    // ======================== UTILITY ========================
    window.escapeHtml = function (text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    };
});

// ======================== REMOVE INGREDIENT ========================
function removeIngredient(btn) {
    const row = btn.closest('.ingredient-entry');
    const list = document.getElementById('ingredientsList');

    if (list.querySelectorAll('.ingredient-entry').length <= 1) {
        showToast('You need at least one ingredient.', 'error');
        row.querySelector('input').focus();
        return;
    }

    row.style.animation = 'fadeOut 0.3s ease forwards';
    setTimeout(() => {
        row.remove();
        updateIngredientCount();
    }, 280);
}

// ======================== REMOVE STEP ========================
function removeStep(btn) {
    const step = btn.closest('.step-entry');
    const list = document.getElementById('instructionsList');

    if (list.querySelectorAll('.step-entry').length <= 1) {
        showToast('You need at least one step.', 'error');
        step.querySelector('textarea').focus();
        return;
    }

    step.style.animation = 'fadeOut 0.3s ease forwards';
    setTimeout(() => {
        step.remove();
        renumberSteps();
        updateStepCount();
    }, 280);
}

// ======================== RENUMBER STEPS ========================
function renumberSteps() {
    document.querySelectorAll('#instructionsList .step-entry').forEach((step, i) => {
        step.querySelector('.step-badge').textContent = i + 1;
    });
}
</script>

<?php include __DIR__ . '/../partials/footer.php'; ?>