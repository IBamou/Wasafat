<?php include __DIR__ . '/../partials/header.php'; ?>

<style>
    /* ===================== RECIPE DETAIL PAGE ===================== */
    .recipe-detail-page {
        max-width: 820px;
        margin: 0 auto;
        padding: 30px 40px 80px;
        width: 100%;
    }

    /* ===================== HERO BANNER ===================== */
    .recipe-hero {
        background: var(--color-bg-card);
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
        border: 1px solid var(--color-border-light);
        margin-bottom: 24px;
        position: relative;
    }

    .recipe-hero-banner {
        height: 140px;
        background: linear-gradient(135deg, #3d1e1e 0%, #6b1d1d 35%, #a0522d 70%, #c4956a 100%);
        position: relative;
        overflow: hidden;
    }

    .recipe-hero-banner::before {
        content: '';
        position: absolute;
        inset: 0;
        background:
            radial-gradient(circle at 20% 50%, rgba(255,255,255,0.08) 0%, transparent 50%),
            radial-gradient(circle at 80% 30%, rgba(255,255,255,0.05) 0%, transparent 40%);
    }

    .recipe-hero-banner::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50px;
        background: linear-gradient(to top, rgba(0,0,0,0.1), transparent);
    }

    /* Decorative pattern on banner */
    .banner-pattern {
        position: absolute;
        inset: 0;
        opacity: 0.04;
        background-image:
            radial-gradient(circle at 25% 25%, #fff 1px, transparent 1px),
            radial-gradient(circle at 75% 75%, #fff 1px, transparent 1px);
        background-size: 30px 30px;
    }

    .banner-emoji {
        position: absolute;
        right: 40px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 60px;
        opacity: 0.2;
        filter: blur(1px);
    }

    /* Hero Body */
    .recipe-hero-body {
        padding: 24px 32px 28px;
        position: relative;
    }

    /* Category pill - positioned on the banner edge */
    .recipe-category-pill {
        position: absolute;
        top: -16px;
        left: 32px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 18px;
        background: var(--color-bg-card);
        border: 1px solid var(--color-border-light);
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        color: var(--color-brown);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    }

    .recipe-category-pill i {
        font-size: 11px;
        color: var(--color-accent);
    }

    /* Title */
    .recipe-title {
        font-family: var(--font-heading);
        font-size: 30px;
        color: var(--color-primary);
        font-weight: 700;
        line-height: 1.3;
        margin-bottom: 16px;
        margin-top: 8px;
    }

    /* Description */
    .recipe-description {
        font-size: 14.5px;
        color: var(--color-text-light);
        line-height: 1.8;
        margin-bottom: 20px;
        max-width: 600px;
    }

    /* Meta Row */
    .recipe-meta-row {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .meta-tag {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 14px;
        background: var(--color-bg);
        border: 1px solid var(--color-border-light);
        border-radius: 8px;
        font-size: 12px;
        color: var(--color-text-light);
        font-weight: 500;
    }

    .meta-tag i {
        font-size: 12px;
        color: var(--color-brown);
    }

    .meta-tag.difficulty-easy {
        background: #eafaf1;
        border-color: #a9dfbf;
        color: #1e8449;
    }

    .meta-tag.difficulty-easy i { color: #27ae60; }

    .meta-tag.difficulty-medium {
        background: #fef9e7;
        border-color: #f9e79f;
        color: #b7950b;
    }

    .meta-tag.difficulty-medium i { color: #f39c12; }

    .meta-tag.difficulty-hard {
        background: #fdedec;
        border-color: #f5b7b1;
        color: #c0392b;
    }

    .meta-tag.difficulty-hard i { color: #e74c3c; }

    /* ===================== STATS CARDS ===================== */
    .stats-strip {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
        margin-bottom: 24px;
    }

    .stat-box {
        background: var(--color-bg-card);
        border: 1px solid var(--color-border-light);
        border-radius: 14px;
        padding: 20px 16px;
        text-align: center;
        transition: all 0.25s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-box::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        border-radius: 14px 14px 0 0;
    }

    .stat-box:nth-child(1)::before { background: var(--color-accent); }
    .stat-box:nth-child(2)::before { background: #e67e22; }
    .stat-box:nth-child(3)::before { background: #27ae60; }
    .stat-box:nth-child(4)::before { background: #3498db; }

    .stat-box:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06);
    }

    .stat-box-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        margin: 0 auto 10px;
    }

    .stat-box:nth-child(1) .stat-box-icon { background: rgba(192, 57, 43, 0.08); color: var(--color-accent); }
    .stat-box:nth-child(2) .stat-box-icon { background: rgba(230, 126, 34, 0.08); color: #e67e22; }
    .stat-box:nth-child(3) .stat-box-icon { background: rgba(39, 174, 96, 0.08); color: #27ae60; }
    .stat-box:nth-child(4) .stat-box-icon { background: rgba(52, 152, 219, 0.08); color: #3498db; }

    .stat-box-value {
        font-size: 22px;
        font-weight: 700;
        color: var(--color-text);
        margin-bottom: 2px;
        font-family: var(--font-heading);
    }

    .stat-box-label {
        font-size: 10.5px;
        color: var(--color-text-muted);
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
    }

    /* ===================== CONTENT SECTIONS ===================== */
    .recipe-section {
        background: var(--color-bg-card);
        border-radius: 16px;
        padding: 30px 32px;
        box-shadow: 0 1px 6px rgba(0, 0, 0, 0.03);
        border: 1px solid var(--color-border-light);
        margin-bottom: 24px;
        transition: box-shadow 0.25s;
    }

    .recipe-section:hover {
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.05);
    }

    .recipe-section-header {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 24px;
    }

    .recipe-section-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }

    .recipe-section-icon.ingredients-icon {
        background: rgba(39, 174, 96, 0.08);
        color: #27ae60;
    }

    .recipe-section-icon.instructions-icon {
        background: rgba(52, 152, 219, 0.08);
        color: #3498db;
    }

    .recipe-section-title-group {
        flex: 1;
    }

    .recipe-section-title {
        font-family: var(--font-heading);
        font-size: 20px;
        color: var(--color-primary);
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .recipe-section-title .s-line {
        display: inline-block;
        width: 26px;
        height: 3px;
        background: var(--color-accent);
        border-radius: 3px;
    }

    .recipe-section-subtitle {
        font-size: 12px;
        color: var(--color-text-muted);
        margin-top: 3px;
    }

    .recipe-section-count {
        padding: 5px 14px;
        background: var(--color-bg);
        border: 1px solid var(--color-border-light);
        border-radius: 20px;
        font-size: 11.5px;
        font-weight: 600;
        color: var(--color-text-muted);
        white-space: nowrap;
    }

    /* ===================== INGREDIENTS LIST ===================== */
    .ingredients-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px;
    }

    .ingredient-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px;
        background: var(--color-bg);
        border-radius: 10px;
        font-size: 13.5px;
        color: var(--color-text);
        transition: all 0.2s;
        border: 1px solid transparent;
    }

    .ingredient-item:hover {
        background: var(--color-bg-alt, #f0ece6);
        border-color: var(--color-border-light);
        transform: translateX(4px);
    }

    .ingredient-bullet {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: linear-gradient(135deg, #27ae60, #2ecc71);
        flex-shrink: 0;
        box-shadow: 0 0 0 3px rgba(39, 174, 96, 0.1);
    }

    .ingredient-text {
        flex: 1;
        line-height: 1.5;
    }

    .ingredient-check {
        width: 20px;
        height: 20px;
        border-radius: 6px;
        border: 1.5px solid var(--color-border);
        background: var(--color-bg-card);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
        flex-shrink: 0;
        color: transparent;
        font-size: 11px;
    }

    .ingredient-check:hover {
        border-color: #27ae60;
    }

    .ingredient-check.checked {
        background: #27ae60;
        border-color: #27ae60;
        color: #fff;
    }

    .ingredient-item.crossed .ingredient-text {
        text-decoration: line-through;
        color: var(--color-text-muted);
    }

    /* ===================== INSTRUCTIONS / STEPS ===================== */
    .steps-list {
        position: relative;
    }

    /* Vertical connecting line */
    .steps-list::before {
        content: '';
        position: absolute;
        top: 24px;
        bottom: 24px;
        left: 19px;
        width: 2px;
        background: linear-gradient(to bottom, var(--color-accent), rgba(192, 57, 43, 0.1));
        border-radius: 2px;
        z-index: 0;
    }

    .step-card {
        display: flex;
        gap: 20px;
        align-items: flex-start;
        position: relative;
        z-index: 1;
        margin-bottom: 8px;
    }

    .step-card:last-child {
        margin-bottom: 0;
    }

    /* Step number circle */
    .step-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        font-weight: 700;
        font-family: var(--font-heading);
        flex-shrink: 0;
        position: relative;
        z-index: 2;
        transition: all 0.3s;
    }

    .step-card:first-child .step-circle {
        background: linear-gradient(135deg, var(--color-accent), #d44637);
        color: #fff;
        box-shadow: 0 3px 12px rgba(192, 57, 43, 0.25);
    }

    .step-card:not(:first-child) .step-circle {
        background: var(--color-bg-card);
        color: var(--color-text-muted);
        border: 2px solid var(--color-border);
    }

    .step-card:hover .step-circle {
        transform: scale(1.1);
    }

    .step-card:hover:not(:first-child) .step-circle {
        border-color: var(--color-accent);
        color: var(--color-accent);
        background: var(--color-accent-light, rgba(192, 57, 43, 0.05));
    }

    /* Step content box */
    .step-content {
        flex: 1;
        background: var(--color-bg);
        border-radius: 12px;
        padding: 18px 22px;
        font-size: 14px;
        color: var(--color-text);
        line-height: 1.8;
        border: 1px solid transparent;
        transition: all 0.25s;
        position: relative;
    }

    .step-content::before {
        content: '';
        position: absolute;
        left: -8px;
        top: 14px;
        width: 14px;
        height: 14px;
        background: var(--color-bg);
        border-left: 1px solid transparent;
        border-bottom: 1px solid transparent;
        transform: rotate(45deg);
        transition: all 0.25s;
    }

    .step-card:hover .step-content {
        background: #f5f0ea;
        border-color: var(--color-border-light);
        transform: translateX(4px);
    }

    .step-card:hover .step-content::before {
        background: #f5f0ea;
        border-color: var(--color-border-light);
    }

    .step-label {
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: var(--color-text-muted);
        margin-bottom: 6px;
    }

    .step-card:first-child .step-label {
        color: var(--color-accent);
    }

    /* ===================== ACTIONS BAR ===================== */
    .recipe-actions-card {
        background: var(--color-bg-card);
        border-radius: 16px;
        padding: 24px 32px;
        box-shadow: 0 1px 6px rgba(0, 0, 0, 0.03);
        border: 1px solid var(--color-border-light);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
    }

    .actions-left {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .actions-right {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* Buttons */
    .btn-recipe {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 11px 24px;
        font-size: 13px;
        font-weight: 600;
        font-family: var(--font-body);
        border: none;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.25s ease;
        white-space: nowrap;
        position: relative;
        overflow: hidden;
    }

    .btn-recipe::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(255,255,255,0.12), transparent);
        opacity: 0;
        transition: opacity 0.25s;
    }

    .btn-recipe:hover::before { opacity: 1; }

    .btn-recipe i {
        font-size: 14px;
        transition: transform 0.2s;
    }

    .btn-edit {
        background: linear-gradient(135deg, #a0522d, #8b4513);
        color: #fff;
        box-shadow: 0 3px 10px rgba(160, 82, 45, 0.2);
    }

    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(160, 82, 45, 0.3);
    }

    .btn-edit:hover i { transform: rotate(-5deg); }

    .btn-delete {
        background: var(--color-bg);
        color: var(--color-accent);
        border: 1.5px solid rgba(192, 57, 43, 0.2);
    }

    .btn-delete:hover {
        background: #fdedec;
        border-color: rgba(192, 57, 43, 0.35);
        transform: translateY(-2px);
    }

    .btn-delete:hover i { transform: scale(1.1); }

    .btn-back-link {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 11px 22px;
        font-size: 13px;
        font-weight: 500;
        color: var(--color-text-light);
        background: var(--color-bg);
        border: 1px solid var(--color-border-light);
        border-radius: 10px;
        transition: all 0.25s;
    }

    .btn-back-link:hover {
        background: var(--color-bg-alt, #f0ece6);
        color: var(--color-text);
        transform: translateX(-3px);
    }

    .btn-back-link i {
        transition: transform 0.2s;
    }

    .btn-back-link:hover i {
        transform: translateX(-3px);
    }

    .btn-print {
        background: var(--color-bg);
        color: var(--color-text-light);
        border: 1px solid var(--color-border-light);
    }

    .btn-print:hover {
        background: var(--color-bg-alt, #f0ece6);
        color: var(--color-text);
        transform: translateY(-2px);
    }

    /* ===================== RECIPE CREATED BY ===================== */
    .recipe-footer-info {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        margin-top: 32px;
        padding: 20px;
        font-size: 12px;
        color: var(--color-text-muted);
    }

    .recipe-footer-info .dot {
        width: 4px;
        height: 4px;
        border-radius: 50%;
        background: var(--color-border);
    }

    /* ===================== PRINT STYLES ===================== */
    @media print {
        .breadcrumb,
        .sidebar,
        .navbar,
        .recipe-actions-card,
        .recipe-footer-info,
        .ingredient-check,
        .site-footer,
        .toast,
        .modal-overlay { display: none !important; }

        body { background: #fff !important; }
        .recipe-detail-page { padding: 0 !important; max-width: 100% !important; }
        .recipe-hero { box-shadow: none !important; border: none !important; }
        .recipe-hero-banner { height: 8px !important; }
        .recipe-section { box-shadow: none !important; break-inside: avoid; }
        .stats-strip { break-inside: avoid; }
        .stat-box { box-shadow: none !important; border: 1px solid #ddd !important; }

        .steps-list::before { background: #ccc !important; }
        .step-circle { box-shadow: none !important; }
        .step-content { background: #f9f9f9 !important; }

        .ingredient-item:hover { transform: none !important; }
        .step-card:hover .step-content { transform: none !important; }
    }

    /* ===================== RESPONSIVE ===================== */
    @media (max-width: 768px) {
        .recipe-detail-page {
            padding: 20px 16px 60px;
        }

        .recipe-hero-body {
            padding: 20px 20px 24px;
        }

        .recipe-title {
            font-size: 24px;
        }

        .recipe-category-pill {
            left: 20px;
        }

        .stats-strip {
            grid-template-columns: 1fr 1fr;
        }

        .ingredients-grid {
            grid-template-columns: 1fr;
        }

        .recipe-section {
            padding: 22px 20px;
        }

        .recipe-actions-card {
            flex-direction: column;
            padding: 20px;
        }

        .actions-left,
        .actions-right {
            width: 100%;
            justify-content: center;
        }

        .banner-emoji {
            right: 20px;
            font-size: 42px;
        }

        .step-card { gap: 14px; }
        .step-circle { width: 34px; height: 34px; font-size: 13px; }
        .steps-list::before { left: 16px; }
        .step-content { padding: 14px 18px; font-size: 13.5px; }
    }

    @media (max-width: 480px) {
        .recipe-title {
            font-size: 21px;
        }

        .stats-strip {
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .stat-box {
            padding: 14px 12px;
        }

        .stat-box-value {
            font-size: 18px;
        }

        .stat-box-icon {
            width: 36px;
            height: 36px;
            font-size: 15px;
        }

        .recipe-meta-row {
            gap: 6px;
        }

        .meta-tag {
            padding: 5px 10px;
            font-size: 11px;
        }

        .btn-recipe {
            padding: 10px 18px;
            font-size: 12px;
        }

        .actions-left,
        .actions-right {
            flex-direction: column;
        }

        .btn-recipe,
        .btn-back-link {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="breadcrumb">
    <a href="<?= $baseUrl ?>">Home</a>
    <span class="separator">/</span>
    <a href="<?= $baseUrl ?>recipes">Recipes</a>
    <span class="separator">/</span>
    <span><?= htmlspecialchars($recipe['name']) ?></span>
</div>

<div class="recipe-detail-page">

    <!-- Success Message -->
    <?php if (!empty($_SESSION['success'])): ?>
        <div class="alert alert-success animate-in">
            <i class="fas fa-check-circle"></i>
            <?= htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>

    <!-- ==================== HERO CARD ==================== -->
    <div class="recipe-hero animate-in">
        <div class="recipe-hero-banner">
            <div class="banner-pattern"></div>
            <span class="banner-emoji">🍽️</span>
        </div>
        <div class="recipe-hero-body">

            <?php if (!empty($recipe['category_name'])): ?>
                <div class="recipe-category-pill">
                    <i class="fas fa-folder"></i>
                    <?= htmlspecialchars($recipe['category_name']) ?>
                </div>
            <?php endif; ?>

            <h1 class="recipe-title"><?= htmlspecialchars($recipe['name']) ?></h1>

            <?php if (!empty($recipe['description'])): ?>
                <p class="recipe-description"><?= nl2br(htmlspecialchars($recipe['description'])) ?></p>
            <?php endif; ?>

            <div class="recipe-meta-row">
                <?php if (!empty($recipe['difficulty'])): ?>
                    <?php
                        $diffClass = 'difficulty-' . htmlspecialchars($recipe['difficulty']);
                        $diffIcons = ['easy' => 'fa-leaf', 'medium' => 'fa-fire', 'hard' => 'fa-bolt'];
                        $diffIcon = $diffIcons[$recipe['difficulty']] ?? 'fa-signal';
                    ?>
                    <span class="meta-tag <?= $diffClass ?>">
                        <i class="fas <?= $diffIcon ?>"></i>
                        <?= ucfirst(htmlspecialchars($recipe['difficulty'])) ?>
                    </span>
                <?php endif; ?>

                <?php if (!empty($recipe['created_at'])): ?>
                    <span class="meta-tag">
                        <i class="fas fa-calendar-alt"></i>
                        <?= date('M j, Y', strtotime($recipe['created_at'])) ?>
                    </span>
                <?php endif; ?>

                <?php
                    $totalTime = ($recipe['preparation_time'] ?? 0) + ($recipe['cooking_time'] ?? 0);
                    if ($totalTime > 0):
                ?>
                    <span class="meta-tag">
                        <i class="fas fa-hourglass-half"></i>
                        <?= $totalTime ?> min total
                    </span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- ==================== STATS STRIP ==================== -->
    <?php
        $prepTime = $recipe['preparation_time'] ?? 0;
        $cookTime = $recipe['cooking_time'] ?? 0;
        $totalTime = $prepTime + $cookTime;
        $difficulty = $recipe['difficulty'] ?? 'medium';
        $diffLabel = ucfirst($difficulty);

        $ingredientsData = $recipe['ingredients'] ?? '';
        $ingredientItems = is_array($ingredientsData)
            ? $ingredientsData
            : (is_string($ingredientsData) && $ingredientsData ? explode("\n", $ingredientsData) : []);
        $ingredientItems = array_filter($ingredientItems ?? [], fn($item) => !empty(trim($item)));

        $instructionsData = $recipe['instructions'] ?? '';
        $instructionItems = is_array($instructionsData)
            ? $instructionsData
            : (is_string($instructionsData) && $instructionsData ? explode("\n", $instructionsData) : []);
        $instructionItems = array_filter($instructionItems ?? [], fn($item) => !empty(trim($item)));
    ?>

    <div class="stats-strip animate-in-1">
        <div class="stat-box">
            <div class="stat-box-icon"><i class="fas fa-clock"></i></div>
            <div class="stat-box-value"><?= $prepTime ?: '—' ?></div>
            <div class="stat-box-label">Prep (min)</div>
        </div>
        <div class="stat-box">
            <div class="stat-box-icon"><i class="fas fa-fire-burner"></i></div>
            <div class="stat-box-value"><?= $cookTime ?: '—' ?></div>
            <div class="stat-box-label">Cook (min)</div>
        </div>
        <div class="stat-box">
            <div class="stat-box-icon"><i class="fas fa-hourglass-end"></i></div>
            <div class="stat-box-value"><?= $totalTime ?: '—' ?></div>
            <div class="stat-box-label">Total (min)</div>
        </div>
        <div class="stat-box">
            <div class="stat-box-icon"><i class="fas fa-gauge-high"></i></div>
            <div class="stat-box-value"><?= $diffLabel ?></div>
            <div class="stat-box-label">Difficulty</div>
        </div>
    </div>

    <!-- ==================== INGREDIENTS ==================== -->
    <?php if (!empty($ingredientItems)): ?>
    <section class="recipe-section animate-in-2">
        <div class="recipe-section-header">
            <div class="recipe-section-icon ingredients-icon">
                <i class="fas fa-carrot"></i>
            </div>
            <div class="recipe-section-title-group">
                <h2 class="recipe-section-title">
                    <span class="s-line"></span>
                    Ingredients
                </h2>
                <p class="recipe-section-subtitle">Gather these before you begin</p>
            </div>
            <span class="recipe-section-count"><?= count($ingredientItems) ?> items</span>
        </div>

        <div class="ingredients-grid" id="ingredientsGrid">
            <?php foreach ($ingredientItems as $i => $ingredient): ?>
                <div class="ingredient-item" data-index="<?= $i ?>">
                    <div class="ingredient-bullet"></div>
                    <span class="ingredient-text"><?= htmlspecialchars($ingredient) ?></span>
                    <button type="button" class="ingredient-check" onclick="toggleIngredient(this)" title="Mark as done">
                        <i class="fas fa-check"></i>
                    </button>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- ==================== INSTRUCTIONS ==================== -->
    <?php if (!empty($instructionItems)): ?>
    <section class="recipe-section animate-in-3">
        <div class="recipe-section-header">
            <div class="recipe-section-icon instructions-icon">
                <i class="fas fa-list-ol"></i>
            </div>
            <div class="recipe-section-title-group">
                <h2 class="recipe-section-title">
                    <span class="s-line"></span>
                    Instructions
                </h2>
                <p class="recipe-section-subtitle">Follow these steps carefully</p>
            </div>
            <span class="recipe-section-count"><?= count($instructionItems) ?> steps</span>
        </div>

        <div class="steps-list">
            <?php foreach ($instructionItems as $i => $instruction): ?>
                <div class="step-card">
                    <div class="step-circle"><?= $i + 1 ?></div>
                    <div class="step-content">
                        <div class="step-label">Step <?= $i + 1 ?></div>
                        <?= nl2br(htmlspecialchars($instruction)) ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- ==================== NO CONTENT STATES ==================== -->
    <?php if (empty($ingredientItems) && empty($instructionItems)): ?>
        <div class="recipe-section animate-in-2" style="text-align:center; padding: 50px 30px;">
            <div style="font-size: 48px; margin-bottom: 16px; opacity: 0.5;">📝</div>
            <h3 style="font-family: var(--font-heading); font-size: 20px; color: var(--color-primary); margin-bottom: 8px;">
                No Details Yet
            </h3>
            <p style="font-size: 13px; color: var(--color-text-muted); margin-bottom: 20px;">
                This recipe doesn't have ingredients or instructions yet.
            </p>
            <a href="<?= $baseUrl ?>recipes/edit/<?= $recipe['id'] ?>" class="btn-recipe btn-edit">
                <i class="fas fa-pen"></i> Add Details
            </a>
        </div>
    <?php endif; ?>

    <!-- ==================== ACTIONS ==================== -->
    <div class="recipe-actions-card animate-in-4">
        <div class="actions-left">
            <a href="<?= $baseUrl ?>recipes" class="btn-back-link">
                <i class="fas fa-arrow-left"></i>
                All Recipes
            </a>
            <button class="btn-recipe btn-print" onclick="window.print()">
                <i class="fas fa-print"></i>
                Print
            </button>
        </div>
        <div class="actions-right">
            <a href="<?= $baseUrl ?>recipes/edit/<?= $recipe['id'] ?>" class="btn-recipe btn-edit">
                <i class="fas fa-pen"></i>
                Edit Recipe
            </a>
            <button
                type="button"
                class="btn-recipe btn-delete"
                onclick="confirmDelete('<?= $baseUrl ?>recipes/delete/<?= $recipe['id'] ?>', 'This recipe will be permanently deleted. This action cannot be undone.')"
            >
                <i class="fas fa-trash-alt"></i>
                Delete
            </button>
        </div>
    </div>

    <!-- Footer Info -->
    <div class="recipe-footer-info animate-in-4">
        <span><i class="fas fa-calendar-plus" style="margin-right: 4px;"></i> Created <?= date('F j, Y \a\t g:i A', strtotime($recipe['created_at'])) ?></span>
        <span class="dot"></span>
        <span>Recipe #<?= htmlspecialchars($recipe['id']) ?></span>
    </div>

</div>

<script>
// ======================== INGREDIENT CHECKBOX ========================
function toggleIngredient(btn) {
    const item = btn.closest('.ingredient-item');

    btn.classList.toggle('checked');
    item.classList.toggle('crossed');

    // Save state to localStorage
    const recipeId = '<?= $recipe['id'] ?>';
    const index = item.dataset.index;
    const key = `wasafat_recipe_${recipeId}_ingredients`;

    let checked = JSON.parse(localStorage.getItem(key) || '{}');

    if (btn.classList.contains('checked')) {
        checked[index] = true;
    } else {
        delete checked[index];
    }

    localStorage.setItem(key, JSON.stringify(checked));
    updateProgress();
}

// ======================== RESTORE CHECKBOX STATE ========================
function restoreCheckboxState() {
    const recipeId = '<?= $recipe['id'] ?>';
    const key = `wasafat_recipe_${recipeId}_ingredients`;
    const checked = JSON.parse(localStorage.getItem(key) || '{}');

    document.querySelectorAll('.ingredient-item').forEach(item => {
        const index = item.dataset.index;
        if (checked[index]) {
            item.classList.add('crossed');
            item.querySelector('.ingredient-check').classList.add('checked');
        }
    });

    updateProgress();
}

// ======================== PROGRESS INDICATOR ========================
function updateProgress() {
    const total = document.querySelectorAll('.ingredient-item').length;
    const checked = document.querySelectorAll('.ingredient-check.checked').length;

    if (total === 0) return;

    const countEl = document.querySelector('.recipe-section-count');
    if (countEl && document.querySelector('.ingredients-icon')) {
        const section = document.querySelector('.ingredients-icon').closest('.recipe-section');
        const sectionCount = section?.querySelector('.recipe-section-count');
        if (sectionCount) {
            if (checked > 0) {
                sectionCount.innerHTML = `<i class="fas fa-check" style="margin-right:4px;color:#27ae60;font-size:10px;"></i> ${checked}/${total} done`;
                sectionCount.style.color = '#27ae60';
                sectionCount.style.borderColor = '#a9dfbf';
                sectionCount.style.background = '#eafaf1';
            } else {
                sectionCount.textContent = total + ' items';
                sectionCount.style.color = '';
                sectionCount.style.borderColor = '';
                sectionCount.style.background = '';
            }
        }

        // Show toast on completion
        if (checked === total && total > 0) {
            if (typeof showToast === 'function') {
                showToast('🎉 All ingredients checked!');
            }
        }
    }
}

// Initialize on load
document.addEventListener('DOMContentLoaded', restoreCheckboxState);

// ======================== KEYBOARD NAVIGATION ========================
document.addEventListener('keydown', function (e) {
    if (['INPUT', 'TEXTAREA', 'SELECT'].includes(document.activeElement.tagName)) return;

    switch(e.key) {
        case 'e':
        case 'E':
            window.location.href = '<?= $baseUrl ?>recipes/<?= $recipe['id'] ?>/edit';
            break;
        case 'Escape':
            window.location.href = '<?= $baseUrl ?>recipes';
            break;
        case 'p':
        case 'P':
            window.print();
            break;
    }
});
</script>

<?php include __DIR__ . '/../partials/footer.php'; ?>