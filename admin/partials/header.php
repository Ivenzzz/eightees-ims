<nav class="navbar navbar-expand-lg navbar-dark bg-dark header p-2">
    <div class="container-fluid">
        <div class="ms-auto avatar-menu dropdown">
            <span class="me-2">Welcome, <?= htmlspecialchars($account_info['username'] ?? 'User'); ?></span>
            <img src="<?= htmlspecialchars($account_info['profile_pic']); ?>" alt="Avatar" class="dropdown-toggle">  
        </div>
    </div>
</nav>