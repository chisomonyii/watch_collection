<!-- components/sidebar.php -->
<?php $current_page = $activePage ?? ''; ?>

<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <h2 class="brand-logo">ZEITH<span>.</span></h2>
        <button class="close-sidebar-btn" id="closeSidebarBtn">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    <nav class="sidebar-nav">
        <a href="dashboard.php" class="nav-item <?= ($current_page === 'overview') ? 'active' : ''; ?>">
            <i class="fa-solid fa-chart-pie"></i> <span>Overview</span>
        </a>
        <a href="orders.php" class="nav-item <?= ($current_page === 'orders') ? 'active' : ''; ?>">
            <i class="fa-solid fa-bag-shopping"></i> <span>My Orders</span>
        </a>
        <a href="wishlist.php" class="nav-item <?= ($current_page === 'wishlist') ? 'active' : ''; ?>">
            <i class="fa-solid fa-heart"></i> <span>Wishlist</span>
        </a>
        <a href="settings.php" class="nav-item <?= ($current_page === 'settings') ? 'active' : ''; ?>">
            <i class="fa-solid fa-user-gear"></i> <span>Settings</span>
        </a>
    </nav>

    <div class="sidebar-footer">
        <a href="logout.php" class="nav-item logout-btn">
            <i class="fa-solid fa-right-from-bracket"></i> <span>Logout</span>
        </a>
    </div>
</aside>