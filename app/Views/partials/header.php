<?php
$currentUser = $_SESSION['user'] ?? null;
$currentPage = $page_title ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= !empty($page_title) ? htmlspecialchars($page_title) . ' — ' : '' ?>Wasafat</title>

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@300;400;500" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Base CSS -->
    <link rel="stylesheet" href="<?= $baseUrl ?>/public/css/base.css">

    <!-- Page-Specific CSS
    <?php if (!empty($page_css)): ?>
        <?php foreach ($page_css as $css): ?>
            <link rel="stylesheet" href="<?= $baseUrl ?>public/css/<?= $css ?>.css">
        <?php endforeach; ?>
    <?php endif; ?> -->
</head>
<body>

    <!-- ==================== NAVBAR ==================== -->
    <nav class="navbar">
        <div class="navbar-left">
            <a href="<?= $baseUrl ?>" class="navbar-brand">Wasafat</a>
            <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="Toggle menu">
                <i class="fas fa-bars"></i>
            </button>
            <div class="navbar-links">
                <?php if ($currentUser): ?>
                    <a href="<?= $baseUrl ?>dashboard" class="<?= $currentPage === 'Dashboard' ? 'active' : '' ?>">Dashboard</a>
                    <a href="<?= $baseUrl ?>recipes" class="<?= $currentPage === 'Recipes' ? 'active' : '' ?>">Recipes</a>
                    <a href="<?= $baseUrl ?>categories" class="<?= $currentPage === 'Categories' ? 'active' : '' ?>">Categories</a>
                <?php else: ?>
                    <a href="<?= $baseUrl ?>">Home</a>
                <?php endif; ?>
            </div>
        </div>
        <div class="navbar-right">
            <?php if ($currentUser): ?>
                <div class="user-menu">
                    <div class="user-avatar" id="userAvatarBtn" title="<?= htmlspecialchars($currentUser['name']) ?>">
                        <?= strtoupper(substr($currentUser['name'], 0, 1)) ?>
                    </div>
                    <div class="user-dropdown" id="userDropdown">
                        <a href="<?= $baseUrl ?>profile"><i class="fas fa-user"></i> Profile</a>
                        <a href="<?= $baseUrl ?>recipes"><i class="fas fa-book"></i> My Recipes</a>
                        <div class="divider"></div>
                        <form action="<?= $baseUrl ?>logout" method="POST" class="logout-form">
                            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">
                            <button type="submit" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</button>
                        </form>
                    </div>
                </div>
            <?php else: ?>
                <a href="<?= $baseUrl ?>login">Login</a>
                <a href="<?= $baseUrl ?>signup" class="btn btn-sm btn-primary" style="color:#fff;">Sign Up</a>
            <?php endif; ?>
        </div>
    </nav>

    <?php if ($currentUser): ?>
    <!-- ==================== SIDEBAR LAYOUT ==================== -->
    <div class="page-layout">
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-brand">
                <h2>Wasafat</h2>
                <p>Recipe Manager</p>
            </div>
            <nav class="sidebar-nav">
                <a href="<?= $baseUrl ?>dashboard" class="<?= $currentPage === 'Dashboard' ? 'active' : '' ?>">
                    <i class="fas fa-th-large"></i> Dashboard
                </a>
                <a href="<?= $baseUrl ?>recipes" class="<?= str_contains($currentPage ?? '', 'Recipe') ? 'active' : '' ?>">
                    <i class="fas fa-book"></i> My Recipes
                </a>
                <a href="<?= $baseUrl ?>categories" class="<?= str_contains($currentPage ?? '', 'Categor') ? 'active' : '' ?>">
                    <i class="fas fa-layer-group"></i> Categories
                </a>
                <div class="sidebar-divider"></div>
                <a href="<?= $baseUrl ?>recipes/create" class="<?= $currentPage === 'New Recipe' ? 'active' : '' ?>">
                    <i class="fas fa-plus-circle"></i> New Recipe
                </a>
                <a href="<?= $baseUrl ?>categories/create" class="<?= $currentPage === 'New Category' ? 'active' : '' ?>">
                    <i class="fas fa-folder-plus"></i> New Category
                </a>
                <div class="sidebar-divider"></div>
                <a href="<?= $baseUrl ?>profile" class="<?= $currentPage === 'Profile' ? 'active' : '' ?>">
                    <i class="fas fa-user-circle"></i> Profile
                </a>
                <form action="<?= $baseUrl ?>logout" method="POST" class="sidebar-logout-form">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">
                    <button type="submit" class="sidebar-logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </nav>
        </aside>

        <div class="main-wrapper">
    <?php endif; ?>

    <main>