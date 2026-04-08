<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="auth-container">
    <div class="auth-card animate-in">

        <div class="auth-header">
            <div class="auth-icon">🔐</div>
            <h1>Welcome Back</h1>
            <p>Sign in to your Wasafat kitchen</p>
        </div>

        <!-- Success Message -->
        <?php if (!empty($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <?= htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <!-- Error Messages -->
        <?php if (!empty($errors)): ?>
            <?php foreach ($errors as $error): ?>
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <form action="<?= $baseUrl ?>login" method="POST" class="auth-form">
            <!-- CSRF Token -->
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">

            <div class="form-group">
                <label for="email">Email Address</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    required
                    placeholder="you@example.com"
                    value="<?= htmlspecialchars($post['email'] ?? '') ?>"
                    autocomplete="email"
                >
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    placeholder="Enter your password"
                    autocomplete="current-password"
                >
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-sign-in-alt"></i> Sign In
            </button>
        </form>

        <div class="auth-footer">
            Don't have an account? <a href="<?= $baseUrl ?>signup">Create one</a>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>