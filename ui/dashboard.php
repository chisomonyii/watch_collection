<?php
// Set current active navigation page
$activePage = 'overview';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZEITH - User Dashboard</title>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../footer.css">

    <style>
        :root {
            /* Brand Accent Color */
            --primary-color: #f68b1e;
            --primary-hover: #e07a16;

            /* Light Theme Color Palette */
            --bg-main: #f8fafc;
            --card-bg: #ffffff;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --hover-bg: #f1f5f9;
            --sidebar-bg: #ffffff;
            --shadow-color: rgba(0, 0, 0, 0.05);
        }

        /* Dark Theme Override Class */
        body.dark-theme {
            --bg-main: #0f172a;
            --card-bg: #1e293b;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --border-color: #334155;
            --hover-bg: #334155;
            --sidebar-bg: #1e293b;
            --shadow-color: rgba(0, 0, 0, 0.3);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease, transform 0.3s ease;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: var(--bg-main);
            color: var(--text-main);
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 260px;
            background-color: var(--sidebar-bg);
            border-right: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            padding: 24px 16px;
            position: fixed;
            height: 100vh;
            z-index: 100;
        }

        .sidebar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 24px;
        }

        .brand-logo {
            font-size: 1.5rem;
            font-weight: 800;
            letter-spacing: 1px;
        }

        .brand-logo span {
            color: var(--primary-color);
        }

        .close-sidebar-btn {
            display: none;
            background: none;
            border: none;
            color: var(--text-main);
            font-size: 1.2rem;
            cursor: pointer;
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 8px;
            flex: 1;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: var(--text-muted);
            text-decoration: none;
            border-radius: 10px;
            font-size: 0.92rem;
            font-weight: 600;
        }

        .nav-item:hover,
        .nav-item.active {
            background-color: var(--hover-bg);
            color: var(--primary-color);
        }

        .sidebar-footer {
            border-top: 1px solid var(--border-color);
            padding-top: 16px;
        }

        .logout-btn {
            color: #e53e3e;
        }

        /* Main Content Layout */
        .main-content {
            margin-left: 260px;
            flex: 1;
            padding: 30px;
            max-width: 1300px;
        }

        /* Header Bar */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .left-bar {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .menu-toggle-btn {
            display: none;
            background: none;
            border: none;
            color: var(--text-main);
            font-size: 1.3rem;
            cursor: pointer;
        }

        .welcome-text h1 {
            font-size: 1.5rem;
            font-weight: 700;
        }

        .welcome-text p {
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .right-bar {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        /* Toggle Theme Switcher */
        .theme-toggle-btn {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            color: var(--primary-color);
            font-size: 1.1rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px var(--shadow-color);
        }

        .theme-toggle-btn:hover {
            transform: scale(1.05);
        }

        .user-avatar img {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            object-fit: cover;
        }

        /* Stats Section Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            box-shadow: 0 4px 15px var(--shadow-color);
            animation: slideUp 0.4s ease-out forwards;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(12px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .icon-orange {
            background: rgba(246, 139, 30, 0.15);
            color: #f68b1e;
        }

        .icon-blue {
            background: rgba(59, 130, 246, 0.15);
            color: #3b82f6;
        }

        .icon-green {
            background: rgba(34, 197, 94, 0.15);
            color: #22c55e;
        }

        .icon-purple {
            background: rgba(168, 85, 247, 0.15);
            color: #a855f7;
        }

        .stat-details h3 {
            font-size: 0.8rem;
            color: var(--text-muted);
            font-weight: 600;
        }

        .stat-details .stat-value {
            font-size: 1.25rem;
            font-weight: 800;
        }

        /* Inner Content Split */
        .dashboard-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
        }

        .content-card {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 15px var(--shadow-color);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .card-header h2 {
            font-size: 1.1rem;
            font-weight: 700;
        }

        .view-all {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
        }

        /* Responsive Table */
        .table-responsive {
            overflow-x: auto;
        }

        .orders-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .orders-table th,
        .orders-table td {
            padding: 12px 14px;
            border-bottom: 1px solid var(--border-color);
            font-size: 0.88rem;
        }

        .orders-table th {
            color: var(--text-muted);
            font-weight: 600;
        }

        .item-cell {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 600;
        }

        .item-cell img {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            object-fit: cover;
        }

        .badge {
            padding: 4px 10px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
        }

        .badge-success {
            background: rgba(34, 197, 94, 0.15);
            color: #22c55e;
        }

        .badge-warning {
            background: rgba(246, 139, 30, 0.15);
            color: #f68b1e;
        }

        /* Quick Action Items */
        .actions-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .action-btn {
            background: var(--hover-bg);
            border: 1px solid var(--border-color);
            padding: 14px;
            border-radius: 10px;
            color: var(--text-main);
            font-size: 0.88rem;
            font-weight: 600;
            cursor: pointer;
            text-align: left;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .action-btn:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

         .view-more-container {
            grid-column: 1 / -1;
            text-align: center;
            padding: 20px 0 10px;
        }

        .view-more-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--primary-color);
            font-weight: 700;
            font-size: 0.95rem;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 8px;
            border: 1px dashed var(--primary-color);
        }

        .view-more-link:hover {
            background-color: var(--hover-bg);
            color: var(--primary-hover);
        }

        /* RESPONSIVE MEDIA QUERIES FOR IPAD & PHONE */
        @media (max-width: 1024px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {

            /* 1. Make sidebar slide in smoothly OVER the content */
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                width: 280px;
                height: 100vh;
                z-index: 1000;
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .close-sidebar-btn,
            .menu-toggle-btn {
                display: block;
            }

            /* 2. Stop the dashboard from overflowing sideways */
            .main-content {
                margin-left: 0;
                width: 100%;
                padding: 16px;
                overflow-x: hidden;
            }
        }
    </style>
</head>

<body>

    <!-- Sidebar Navigation -->
    <?php include __DIR__ . '/user-sidebar.php'; ?>

    <!-- Main Content Panel -->
    <main class="main-content">

        <!-- Top Header Navigation -->
        <header class="top-bar">
            <div class="left-bar">
                <button class="menu-toggle-btn" id="menuToggleBtn">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div class="welcome-text">
                    <h1>Welcome back, Cisco 👋</h1>
                    <p>Here is what's happening with your account today.</p>
                </div>
            </div>

            <div class="right-bar">
                <!-- Theme Toggle Button (Light/Dark Switch) -->
                <button class="theme-toggle-btn" id="themeToggleBtn" title="Toggle Theme">
                    <i class="fa-solid fa-moon" id="themeIcon"></i>
                </button>

                <!-- Profile Avatar -->
                <div class="user-avatar">
                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150" alt="User Avatar">
                </div>
            </div>
        </header>

        <!-- Dynamic Overview Cards -->
        <section class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon icon-orange">
                    <i class="fa-solid fa-box"></i>
                </div>
                <div class="stat-details">
                    <h3>Total Orders</h3>
                    <p class="stat-value">12</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon icon-blue">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                </div>
                <div class="stat-details">
                    <h3>In Transit</h3>
                    <p class="stat-value">2</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon icon-purple">
                    <i class="fa-solid fa-heart"></i>
                </div>
                <div class="stat-details">
                    <h3>Saved Watches</h3>
                    <p class="stat-value">8</p>
                </div>
            </div>
        </section>

        <!-- Main Dashboard Section -->
        <section class="dashboard-grid">

            <!-- Orders Table Section -->
            <div class="content-card recent-orders">
                <div class="card-header">
                    <h2>Recent Orders</h2>
                    <a href="#" class="view-all">View All</a>
                </div>

                <div class="table-responsive">
                    <table class="orders-table">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="item-cell">
                                    <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=80" alt="Watch">
                                    <span>H. MOSER & CIE.</span>
                                </td>
                                <td>Sep 14, 2026</td>
                                <td>₦756,000.00</td>
                                <td><span class="badge badge-success">Delivered</span></td>
                            </tr>
                            <tr>
                                <td class="item-cell">
                                    <img src="https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?w=80" alt="Watch">
                                    <span>ROLEX SUBMARINER</span>
                                </td>
                                <td>Sep 10, 2026</td>
                                <td>₦2,100,000.00</td>
                                <td><span class="badge badge-warning">In Transit</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Quick Action Options -->
            <div class="content-card quick-actions">
                <div class="card-header">
                    <h2>Quick Actions</h2>
                </div>
                <div class="actions-list">
                    <button class="action-btn">
                        <i class="fa-solid fa-plus"></i> Add Delivery Address
                    </button>
                    <button class="action-btn">
                        <i class="fa-solid fa-shield-halved"></i> Security & Password
                    </button>
                    <button class="action-btn">
                        <i class="fa-solid fa-headset"></i> Concierge Support
                    </button>
                </div>
            </div>
             <div class="view-more-container">
                <a href="/catalog" class="view-more-link">
                    View More Watches <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

        </section>
        

    </main>
    

    <!-- JavaScript Script Section -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const themeToggleBtn = document.getElementById("themeToggleBtn");
            const themeIcon = document.getElementById("themeIcon");
            const menuToggleBtn = document.getElementById("menuToggleBtn");
            const closeSidebarBtn = document.getElementById("closeSidebarBtn");
            const sidebar = document.getElementById("sidebar");

            // Check and load saved theme preferences from LocalStorage
            const savedTheme = localStorage.getItem("zeith_theme");
            if (savedTheme === "dark") {
                document.body.classList.add("dark-theme");
                themeIcon.classList.replace("fa-moon", "fa-sun");
            }

            // Theme Switcher Click Handler
            themeToggleBtn.addEventListener("click", () => {
                document.body.classList.toggle("dark-theme");
                const isDark = document.body.classList.contains("dark-theme");

                if (isDark) {
                    themeIcon.classList.replace("fa-moon", "fa-sun");
                    localStorage.setItem("zeith_theme", "dark");
                } else {
                    themeIcon.classList.replace("fa-sun", "fa-moon");
                    localStorage.setItem("zeith_theme", "light");
                }
            });

            // Responsive Sidebar Drawer for Mobile Devices
            if (menuToggleBtn && closeSidebarBtn && sidebar) {
                menuToggleBtn.addEventListener("click", () => sidebar.classList.add("active"));
                closeSidebarBtn.addEventListener("click", () => sidebar.classList.remove("active"));
            }
        });
    </script>
</body>

</html>