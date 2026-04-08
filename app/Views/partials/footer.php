    </main>

    <?php
    $currentUser = $_SESSION['user'] ?? null;
    ?>

    <?php if ($currentUser): ?>
            <!-- Close main-wrapper -->
            <footer class="site-footer">
                <div class="footer-links">
                    <a href="#">About</a>
                    <a href="#">Help</a>
                    <a href="#">Terms</a>
                    <a href="#">Privacy</a>
                </div>
                <p class="footer-copy">© <?= date('Y') ?> Wasafat. Crafted with spice 🌶️</p>
            </footer>
        </div><!-- /.main-wrapper -->
    </div><!-- /.page-layout -->
    <?php else: ?>
        <footer class="site-footer">
            <div class="footer-links">
                <a href="#">About</a>
                <a href="#">Help</a>
                <a href="#">Terms</a>
                <a href="#">Privacy</a>
            </div>
            <p class="footer-copy">© <?= date('Y') ?> Wasafat. Crafted with spice 🌶️</p>
        </footer>
    <?php endif; ?>

    <!-- Toast Notification -->
    <div class="toast" id="toast"></div>

    <!-- Confirm Modal -->
    <div class="modal-overlay" id="confirmModal">
        <div class="modal-box">
            <h3>Are you sure?</h3>
            <p id="confirmMessage">This action cannot be undone.</p>
            <div class="modal-actions">
                <button class="btn btn-secondary" onclick="closeModal()">Cancel</button>
                <form id="confirmForm" method="POST" class="inline-form">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Global JS -->
    <script>
    // ==================== USER DROPDOWN ====================
    const avatarBtn = document.getElementById('userAvatarBtn');
    const dropdown = document.getElementById('userDropdown');

    if (avatarBtn && dropdown) {
        avatarBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            dropdown.classList.toggle('show');
        });
        document.addEventListener('click', () => dropdown.classList.remove('show'));
    }

    // ==================== MOBILE MENU ====================
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const sidebar = document.getElementById('sidebar');

    if (mobileMenuBtn && sidebar) {
        mobileMenuBtn.addEventListener('click', () => {
            sidebar.classList.toggle('mobile-open');
        });
        document.addEventListener('click', (e) => {
            if (!sidebar.contains(e.target) && e.target !== mobileMenuBtn && !mobileMenuBtn.contains(e.target)) {
                sidebar.classList.remove('mobile-open');
            }
        });
    }

    // ==================== TOAST ====================
    function showToast(message, type = 'success') {
        const toast = document.getElementById('toast');
        if (!toast) return;
        toast.textContent = message;
        toast.className = 'toast' + (type === 'error' ? ' error' : '');
        void toast.offsetWidth;
        toast.classList.add('show');
        setTimeout(() => toast.classList.remove('show'), 3000);
    }

    // ==================== CONFIRM DELETE ====================
    function confirmDelete(url, message) {
        const modal = document.getElementById('confirmModal');
        const form = document.getElementById('confirmForm');
        const msg = document.getElementById('confirmMessage');
        if (modal && form) {
            form.action = url;
            if (msg && message) msg.textContent = message;
            modal.classList.add('show');
        }
    }

    function closeModal() {
        const modal = document.getElementById('confirmModal');
        if (modal) modal.classList.remove('show');
    }

    document.getElementById('confirmModal')?.addEventListener('click', (e) => {
        if (e.target === e.currentTarget) closeModal();
    });
    </script>

    <!-- Page-Specific JS -->
    <?php if (!empty($page_js)): ?>
        <?php foreach ($page_js as $js): ?>
            <script src="<?= $baseUrl ?>public/js/<?= $js ?>.js"></script>
        <?php endforeach; ?>
    <?php endif; ?>

</body>
</html>