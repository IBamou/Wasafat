<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="auth-container">
    <div class="auth-card animate-in">

        <div class="auth-header">
            <div class="auth-icon">✨</div>
            <h1>Join Wasafat</h1>
            <p>Create your account and start cooking</p>
        </div>

        <!-- Error Messages -->
        <?php if (!empty($errors)): ?>
            <?php foreach ($errors as $error): ?>
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        
        <form action="<?= $baseUrl ?>signup" method="POST" class="auth-form">
            <!-- CSRF Token -->
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken ?? '') ?>">

            <div class="form-group">
                <label for="name">Full Name</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    required
                    placeholder="Your full name"
                    value="<?= htmlspecialchars($post['name'] ?? '') ?>"
                    autocomplete="name"
                >
            </div>

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
                    placeholder="Min. 6 characters"
                    autocomplete="new-password"
                    minlength="6"
                >
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    required
                    placeholder="Repeat your password"
                    autocomplete="new-password"
                >
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-user-plus"></i> Create Account
            </button>
        </form>

        <div class="auth-footer">
            Already have an account? <a href="<?= $baseUrl ?>login">Sign in</a>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>