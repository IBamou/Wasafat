<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="breadcrumb">
    <a href="<?= $baseUrl ?>">Home</a>
    <span class="separator">/</span>
    <span>Profile</span>
</div>

<style>
    /* ===================== PROFILE PAGE STYLES ===================== */
    .profile-page {
        max-width: 780px;
        margin: 0 auto;
        padding: 30px 40px 60px;
        width: 100%;
    }

    /* Profile Header Card */
    .profile-card {
        background: var(--color-bg-card);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--color-border-light);
        overflow: hidden;
        transition: box-shadow var(--transition-normal);
    }

    .profile-card:hover {
        box-shadow: var(--shadow-lg);
    }

    .profile-banner {
        height: 100px;
        background: linear-gradient(135deg, #3d1e1e 0%, #6b1d1d 40%, #a0522d 100%);
        position: relative;
    }

    .profile-banner::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 30px;
        background: linear-gradient(to top, rgba(0,0,0,0.08), transparent);
    }

    .profile-card-body {
        padding: 0 32px 30px;
        position: relative;
    }

    .profile-avatar-large {
        width: 90px;
        height: 90px;
        border-radius: var(--radius-full);
        background: linear-gradient(135deg, var(--color-cream), var(--color-gold));
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 36px;
        font-weight: 700;
        color: var(--color-primary);
        font-family: var(--font-heading);
        border: 4px solid var(--color-bg-card);
        margin-top: -45px;
        position: relative;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .profile-card-info {
        margin-top: 14px;
    }

    .profile-card-info h2 {
        font-family: var(--font-heading);
        font-size: 24px;
        color: var(--color-primary);
        font-weight: 700;
        margin-bottom: 6px;
    }

    .profile-card-info .profile-detail {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        color: var(--color-text-muted);
        margin-bottom: 4px;
    }

    .profile-card-info .profile-detail i {
        width: 16px;
        text-align: center;
        color: var(--color-brown);
        font-size: 13px;
    }

    /* Stats Row */
    .profile-stats-row {
        display: flex;
        gap: 28px;
        margin-top: 18px;
        padding-top: 18px;
        border-top: 1px solid var(--color-border-light);
    }

    .profile-stat {
        text-align: center;
    }

    .profile-stat-value {
        font-size: 22px;
        font-weight: 700;
        color: var(--color-text);
    }

    .profile-stat-label {
        font-size: 11px;
        color: var(--color-text-muted);
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin-top: 2px;
    }

    /* Form Sections */
    .profile-form-section {
        background: var(--color-bg-card);
        border-radius: var(--radius-lg);
        padding: 30px 32px;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--color-border-light);
        margin-top: 24px;
        transition: box-shadow var(--transition-normal);
    }

    .profile-form-section:hover {
        box-shadow: var(--shadow-lg);
    }

    .profile-form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px 22px;
    }

    .profile-form-grid .full-width {
        grid-column: 1 / -1;
    }

    .form-footer-actions {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 24px;
        padding-top: 20px;
        border-top: 1px solid var(--color-border-light);
    }

    /* Password Strength */
    .password-strength {
        margin-top: 6px;
    }

    .strength-bar-container {
        height: 4px;
        background: var(--color-border-light);
        border-radius: 4px;
        overflow: hidden;
        margin-bottom: 4px;
    }

    .strength-bar {
        height: 100%;
        border-radius: 4px;
        width: 0%;
        transition: all 0.4s ease;
    }

    .strength-bar.weak { width: 25%; background: var(--color-error); }
    .strength-bar.fair { width: 50%; background: var(--color-warning); }
    .strength-bar.good { width: 75%; background: #3498db; }
    .strength-bar.strong { width: 100%; background: var(--color-success); }

    .strength-text {
        font-size: 10px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .strength-text.weak { color: var(--color-error); }
    .strength-text.fair { color: var(--color-warning); }
    .strength-text.good { color: #3498db; }
    .strength-text.strong { color: var(--color-success); }

    /* Toggle Password */
    .password-wrapper {
        position: relative;
    }

    .password-wrapper input {
        padding-right: 44px !important;
    }

    .toggle-password {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: var(--color-text-muted);
        cursor: pointer;
        padding: 4px;
        font-size: 16px;
        transition: color var(--transition-fast);
        display: flex;
        align-items: center;
    }

    .toggle-password:hover {
        color: var(--color-text-light);
    }

    /* Inline Alert */
    .form-alert {
        padding: 12px 18px;
        border-radius: var(--radius-md);
        font-size: 13px;
        margin-bottom: 18px;
        display: none;
        align-items: center;
        gap: 10px;
        animation: slideIn 0.3s ease;
    }

    .form-alert.show {
        display: flex;
    }

    .form-alert.success {
        background: var(--color-success-bg);
        color: #1e8449;
        border: 1px solid #a9dfbf;
    }

    .form-alert.error {
        background: var(--color-error-bg);
        color: #c0392b;
        border: 1px solid #f5b7b1;
    }

    /* Saving indicator */
    .btn-saving {
        position: relative;
        pointer-events: none;
        opacity: 0.8;
    }

    .btn-saving::after {
        content: '';
        width: 16px;
        height: 16px;
        border: 2px solid transparent;
        border-top-color: #fff;
        border-radius: 50%;
        animation: spin 0.6s linear infinite;
        margin-left: 6px;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    /* Section icon */
    .section-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }

    .section-icon.profile-icon {
        background: rgba(160, 82, 45, 0.1);
        color: var(--color-brown);
    }

    .section-icon.password-icon {
        background: rgba(192, 57, 43, 0.1);
        color: var(--color-accent);
    }

    .section-title-row {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 24px;
    }

    .section-title-row .section-title {
        margin-bottom: 0;
    }

    .section-title-row .section-subtitle {
        font-size: 12px;
        color: var(--color-text-muted);
        margin-top: 2px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .profile-page {
            padding: 20px 16px 60px;
        }

        .profile-form-grid {
            grid-template-columns: 1fr;
        }

        .profile-card-body {
            padding: 0 20px 24px;
        }

        .profile-form-section {
            padding: 22px 20px;
        }

        .profile-stats-row {
            gap: 20px;
        }

        .profile-avatar-large {
            width: 76px;
            height: 76px;
            font-size: 30px;
            margin-top: -38px;
        }
    }
</style>

<div class="profile-page">

    <!-- Page Header -->
    <div class="page-header animate-in">
        <h1>My Profile</h1>
        <p>Manage your account settings and security preferences.</p>
    </div>

    <!-- Profile Card -->
    <div class="profile-card animate-in-1">
        <div class="profile-banner"></div>
        <div class="profile-card-body">
            <div class="profile-avatar-large" id="profileAvatar">
                <?= strtoupper(substr($user['name'] ?? 'U', 0, 1)) ?>
            </div>
            <div class="profile-card-info">
                <h2 id="displayName"><?= htmlspecialchars($user['name'] ?? 'Unknown User') ?></h2>
                <div class="profile-detail">
                    <i class="fas fa-envelope"></i>
                    <span id="displayEmail"><?= htmlspecialchars($user['email'] ?? '') ?></span>
                </div>
                <?php if (!empty($user['created_at'])): ?>
                    <div class="profile-detail">
                        <i class="fas fa-calendar"></i>
                        <span>Member since <?= date('F Y', strtotime($user['created_at'])) ?></span>
                    </div>
                <?php endif; ?>
            </div>

            <div class="profile-stats-row">
                <div class="profile-stat">
                    <div class="profile-stat-value"><?= htmlspecialchars($recipeCount ?? 0) ?></div>
                    <div class="profile-stat-label">Recipes</div>
                </div>
                <div class="profile-stat">
                    <div class="profile-stat-value"><?= htmlspecialchars($categoryCount ?? 0) ?></div>
                    <div class="profile-stat-label">Categories</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Profile Section -->
    <div class="profile-form-section animate-in-2">
        <div class="section-title-row">
            <div class="section-icon profile-icon">
                <i class="fas fa-user-edit"></i>
            </div>
            <div>
                <h2 class="section-title" style="margin-bottom:0;">
                    <span class="section-line"></span>
                    Update Profile
                </h2>
                <p class="section-subtitle">Update your personal information</p>
            </div>
        </div>

        <!-- Inline Alert -->
        <div class="form-alert" id="profileAlert">
            <i class="fas fa-info-circle"></i>
            <span id="profileAlertMessage"></span>
        </div>

        <form id="profileForm" novalidate>
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">

            <div class="profile-form-grid">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" required
                        placeholder="Your full name"
                        value="<?= htmlspecialchars($user['name'] ?? '') ?>"
                        autocomplete="name">
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required
                        placeholder="you@example.com"
                        value="<?= htmlspecialchars($user['email'] ?? '') ?>"
                        autocomplete="email">
                </div>
            </div>

            <div class="form-footer-actions">
                <button type="button" class="btn btn-ghost" id="resetProfileBtn">
                    <i class="fas fa-undo"></i> Reset
                </button>
                <button type="submit" class="btn btn-primary" id="saveProfileBtn">
                    <i class="fas fa-save"></i> Save Changes
                </button>
            </div>
        </form>
    </div>

    <!-- Change Password Section -->
    <div class="profile-form-section animate-in-3">
        <div class="section-title-row">
            <div class="section-icon password-icon">
                <i class="fas fa-lock"></i>
            </div>
            <div>
                <h2 class="section-title" style="margin-bottom:0;">
                    <span class="section-line"></span>
                    Change Password
                </h2>
                <p class="section-subtitle">Ensure your account stays secure</p>
            </div>
        </div>

        <!-- Inline Alert -->
        <div class="form-alert" id="passwordAlert">
            <i class="fas fa-info-circle"></i>
            <span id="passwordAlertMessage"></span>
        </div>

        <form id="passwordForm" novalidate>
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">

            <div class="profile-form-grid">
                <div class="form-group full-width">
                    <label for="current_password">Current Password</label>
                    <div class="password-wrapper">
                        <input type="password" id="current_password" name="current_password" required
                            placeholder="Enter your current password"
                            autocomplete="current-password">
                        <button type="button" class="toggle-password" data-target="current_password" aria-label="Toggle password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <label for="new_password">New Password</label>
                    <div class="password-wrapper">
                        <input type="password" id="new_password" name="new_password" required
                            placeholder="Min. 6 characters"
                            autocomplete="new-password"
                            minlength="6">
                        <button type="button" class="toggle-password" data-target="new_password" aria-label="Toggle password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="password-strength" id="passwordStrength" style="display:none;">
                        <div class="strength-bar-container">
                            <div class="strength-bar" id="strengthBar"></div>
                        </div>
                        <span class="strength-text" id="strengthText"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm New Password</label>
                    <div class="password-wrapper">
                        <input type="password" id="confirm_password" name="confirm_password" required
                            placeholder="Repeat new password"
                            autocomplete="new-password">
                        <button type="button" class="toggle-password" data-target="confirm_password" aria-label="Toggle password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <span class="form-hint" id="matchHint" style="display:none;"></span>
                </div>
            </div>

            <div class="form-footer-actions">
                <button type="button" class="btn btn-ghost" id="resetPasswordBtn">
                    <i class="fas fa-undo"></i> Clear
                </button>
                <button type="submit" class="btn btn-primary" id="changePasswordBtn">
                    <i class="fas fa-shield-alt"></i> Update Password
                </button>
            </div>
        </form>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const BASE_URL = '<?= $baseUrl ?>';

    // ======================== HELPER: Show Alert ========================
    function showFormAlert(containerId, message, type = 'success') {
        const alert = document.getElementById(containerId);
        const msgEl = document.getElementById(containerId + 'Message');
        if (!alert || !msgEl) return;

        alert.className = 'form-alert ' + type + ' show';
        alert.querySelector('i').className = type === 'success'
            ? 'fas fa-check-circle'
            : 'fas fa-exclamation-circle';
        msgEl.textContent = message;

        // Auto hide after 5 seconds
        setTimeout(() => {
            alert.classList.remove('show');
        }, 5000);
    }

    // ======================== HELPER: Set Loading ========================
    function setLoading(btn, loading) {
        if (loading) {
            btn.dataset.originalText = btn.innerHTML;
            btn.classList.add('btn-saving');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
            btn.disabled = true;
        } else {
            btn.classList.remove('btn-saving');
            btn.innerHTML = btn.dataset.originalText || btn.innerHTML;
            btn.disabled = false;
        }
    }

    // ======================== UPDATE PROFILE ========================
    const profileForm = document.getElementById('profileForm');
    const saveProfileBtn = document.getElementById('saveProfileBtn');
    const originalName = '<?= addslashes(htmlspecialchars($user['name'] ?? '')) ?>';
    const originalEmail = '<?= addslashes(htmlspecialchars($user['email'] ?? '')) ?>';

    profileForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();

        // Client-side validation
        if (!name) {
            showFormAlert('profileAlert', 'Name is required.', 'error');
            document.getElementById('name').focus();
            return;
        }

        if (!email || !isValidEmail(email)) {
            showFormAlert('profileAlert', 'Please enter a valid email address.', 'error');
            document.getElementById('email').focus();
            return;
        }

        // Check if anything changed
        if (name === originalName && email === originalEmail) {
            showFormAlert('profileAlert', 'No changes detected.', 'error');
            return;
        }

        setLoading(saveProfileBtn, true);

        const formData = new FormData(profileForm);

        fetch(BASE_URL + 'profile/update', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            setLoading(saveProfileBtn, false);

            if (data.success) {
                showFormAlert('profileAlert', data.message || 'Profile updated successfully!', 'success');

                // Update display
                document.getElementById('displayName').textContent = name;
                document.getElementById('displayEmail').textContent = email;
                document.getElementById('profileAvatar').textContent = name.charAt(0).toUpperCase();

                // Update navbar avatar if exists
                const navAvatar = document.querySelector('.user-avatar');
                if (navAvatar) navAvatar.textContent = name.charAt(0).toUpperCase();

                showToast('✅ Profile updated successfully!');
            } else {
                const errorMsg = data.errors ? data.errors.join(', ') : (data.message || 'Failed to update profile.');
                showFormAlert('profileAlert', errorMsg, 'error');
            }
        })
        .catch(error => {
            setLoading(saveProfileBtn, false);
            showFormAlert('profileAlert', 'Network error. Please try again.', 'error');
            console.error('Profile update error:', error);
        });
    });

    // Reset profile form
    document.getElementById('resetProfileBtn').addEventListener('click', function () {
        document.getElementById('name').value = originalName;
        document.getElementById('email').value = originalEmail;
        document.getElementById('profileAlert').classList.remove('show');
    });

    // ======================== CHANGE PASSWORD ========================
    const passwordForm = document.getElementById('passwordForm');
    const changePasswordBtn = document.getElementById('changePasswordBtn');
    const newPasswordInput = document.getElementById('new_password');
    const confirmPasswordInput = document.getElementById('confirm_password');

    passwordForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const currentPassword = document.getElementById('current_password').value;
        const newPassword = newPasswordInput.value;
        const confirmPassword = confirmPasswordInput.value;

        // Client-side validation
        if (!currentPassword) {
            showFormAlert('passwordAlert', 'Current password is required.', 'error');
            document.getElementById('current_password').focus();
            return;
        }

        if (!newPassword) {
            showFormAlert('passwordAlert', 'New password is required.', 'error');
            newPasswordInput.focus();
            return;
        }

        if (newPassword.length < 6) {
            showFormAlert('passwordAlert', 'New password must be at least 6 characters.', 'error');
            newPasswordInput.focus();
            return;
        }

        if (newPassword !== confirmPassword) {
            showFormAlert('passwordAlert', 'Passwords do not match.', 'error');
            confirmPasswordInput.focus();
            return;
        }

        if (currentPassword === newPassword) {
            showFormAlert('passwordAlert', 'New password must be different from current password.', 'error');
            newPasswordInput.focus();
            return;
        }

        setLoading(changePasswordBtn, true);

        const formData = new FormData(passwordForm);

        fetch(BASE_URL + 'profile/change-password', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            setLoading(changePasswordBtn, false);

            if (data.success) {
                showFormAlert('passwordAlert', data.message || 'Password changed successfully!', 'success');

                // Clear form
                passwordForm.reset();
                document.getElementById('passwordStrength').style.display = 'none';
                document.getElementById('matchHint').style.display = 'none';

                showToast('🔒 Password updated successfully!');
            } else {
                const errorMsg = data.errors ? data.errors.join(', ') : (data.message || 'Failed to change password.');
                showFormAlert('passwordAlert', errorMsg, 'error');
            }
        })
        .catch(error => {
            setLoading(changePasswordBtn, false);
            showFormAlert('passwordAlert', 'Network error. Please try again.', 'error');
            console.error('Password change error:', error);
        });
    });

    // Reset password form
    document.getElementById('resetPasswordBtn').addEventListener('click', function () {
        passwordForm.reset();
        document.getElementById('passwordAlert').classList.remove('show');
        document.getElementById('passwordStrength').style.display = 'none';
        document.getElementById('matchHint').style.display = 'none';
    });

    // ======================== PASSWORD STRENGTH ========================
    newPasswordInput.addEventListener('input', function () {
        const password = this.value;
        const strengthDiv = document.getElementById('passwordStrength');
        const bar = document.getElementById('strengthBar');
        const text = document.getElementById('strengthText');

        if (!password) {
            strengthDiv.style.display = 'none';
            return;
        }

        strengthDiv.style.display = 'block';
        const strength = getPasswordStrength(password);

        bar.className = 'strength-bar ' + strength.level;
        text.className = 'strength-text ' + strength.level;
        text.textContent = strength.label;

        // Also check match if confirm field has value
        checkPasswordMatch();
    });

    // ======================== PASSWORD MATCH ========================
    confirmPasswordInput.addEventListener('input', checkPasswordMatch);

    function checkPasswordMatch() {
        const hint = document.getElementById('matchHint');
        const newPass = newPasswordInput.value;
        const confirmPass = confirmPasswordInput.value;

        if (!confirmPass) {
            hint.style.display = 'none';
            return;
        }

        hint.style.display = 'block';

        if (newPass === confirmPass) {
            hint.textContent = '✓ Passwords match';
            hint.style.color = 'var(--color-success)';
            confirmPasswordInput.style.borderColor = 'var(--color-success)';
        } else {
            hint.textContent = '✗ Passwords do not match';
            hint.style.color = 'var(--color-error)';
            confirmPasswordInput.style.borderColor = 'var(--color-error)';
        }
    }

    // ======================== TOGGLE PASSWORD VISIBILITY ========================
    document.querySelectorAll('.toggle-password').forEach(btn => {
        btn.addEventListener('click', function () {
            const targetId = this.dataset.target;
            const input = document.getElementById(targetId);
            const icon = this.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });

    // ======================== UTILITIES ========================
    function isValidEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    function getPasswordStrength(password) {
        let score = 0;

        if (password.length >= 6) score++;
        if (password.length >= 10) score++;
        if (/[a-z]/.test(password) && /[A-Z]/.test(password)) score++;
        if (/\d/.test(password)) score++;
        if (/[^a-zA-Z0-9]/.test(password)) score++;

        if (score <= 1) return { level: 'weak', label: 'Weak' };
        if (score === 2) return { level: 'fair', label: 'Fair' };
        if (score === 3) return { level: 'good', label: 'Good' };
        return { level: 'strong', label: 'Strong' };
    }
});
</script>

<?php include __DIR__ . '/../partials/footer.php'; ?>