<?php 
    // Set active page for the sidebar component
    $activePage = 'orders'; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZEITH - My Orders</title>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

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

        /* Main Content Area */
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

        .user-avatar img {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            object-fit: cover;
        }

        /* Orders Filter & Content Card */
        .content-card {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 15px var(--shadow-color);
            animation: slideUp 0.4s ease-out forwards;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .orders-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .filter-tabs {
            display: flex;
            gap: 10px;
        }

        .tab-btn {
            background: var(--hover-bg);
            border: 1px solid var(--border-color);
            color: var(--text-muted);
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
        }

        .tab-btn.active, .tab-btn:hover {
            background: var(--primary-color);
            color: #ffffff;
            border-color: var(--primary-color);
        }

        /* Orders Table */
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
            padding: 16px 14px;
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
            width: 44px;
            height: 44px;
            border-radius: 8px;
            object-fit: cover;
        }

        .badge {
            padding: 6px 12px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
        }

        .badge-success { background: rgba(34, 197, 94, 0.15); color: #22c55e; }
        .badge-warning { background: rgba(246, 139, 30, 0.15); color: #f68b1e; }
        .badge-danger { background: rgba(239, 68, 68, 0.15); color: #ef4444; }

        .action-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.85rem;
        }

        /* Responsive Media Queries */
        /* Responsive Media Queries */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                width: 280px;
                height: 100vh;
                z-index: 1000;
                transform: translateX(-100%);
                box-shadow: 4px 0 20px var(--shadow-color);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .close-sidebar-btn,
            .menu-toggle-btn {
                display: block;
            }

            .main-content {
                margin-left: 0;
                width: 100%;
                padding: 16px;
                overflow-x: hidden;
            }

            .filter-tabs {
                overflow-x: auto;
                width: 100%;
                padding-bottom: 4px;
                white-space: nowrap;
            }

            .tab-btn {
                flex-shrink: 0;
            }
        }
    </style>
</head>

<body>

    <!-- Dynamic PHP Sidebar Component -->
    <?php include __DIR__ . '/user-sidebar.php'; ?>

    <!-- Main Content Area -->
    <main class="main-content">

        <!-- Top Navigation Bar -->
        <header class="top-bar">
            <div class="left-bar">
                <button class="menu-toggle-btn" id="menuToggleBtn">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div class="welcome-text">
                    <h1>Order History</h1>
                    <p>Track your active shipments and view past purchases.</p>
                </div>
            </div>

            <div class="right-bar">
                <button class="theme-toggle-btn" id="themeToggleBtn" title="Toggle Theme">
                    <i class="fa-solid fa-moon" id="themeIcon"></i>
                </button>

                <div class="user-avatar">
                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150" alt="User Avatar">
                </div>
            </div>
        </header>

        <!-- Orders Listing Section -->
        <section class="content-card">
            <div class="orders-header">
                <h2>All Orders</h2>
                <div class="filter-tabs">
                    <button class="tab-btn active">All</button>
                    <button class="tab-btn">In Transit</button>
                    <button class="tab-btn">Delivered</button>
                    <button class="tab-btn">Cancelled</button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Timepiece</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>#ZTH-9021</strong></td>
                            <td class="item-cell">
                                <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=80" alt="Watch">
                                <span>H. MOSER & CIE.</span>
                            </td>
                            <td>Sep 14, 2026</td>
                            <td>₦756,000.00</td>
                            <td><span class="badge badge-success">Delivered</span></td>
                            <td><a href="#" class="action-link">View Details</a></td>
                        </tr>
                        <tr>
                            <td><strong>#ZTH-8810</strong></td>
                            <td class="item-cell">
                                <img src="https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?w=80" alt="Watch">
                                <span>ROLEX SUBMARINER</span>
                            </td>
                            <td>Sep 10, 2026</td>
                            <td>₦2,100,000.00</td>
                            <td><span class="badge badge-warning">In Transit</span></td>
                            <td><a href="#" class="action-link">Track Order</a></td>
                        </tr>
                        <tr>
                            <td><strong>#ZTH-7542</strong></td>
                            <td class="item-cell">
                                <img src="https://images.unsplash.com/photo-1542496658-e33a6d0d50f6?w=80" alt="Watch">
                                <span>OMEGA SPEEDMASTER</span>
                            </td>
                            <td>Aug 28, 2026</td>
                            <td>₦1,450,000.00</td>
                            <td><span class="badge badge-danger">Cancelled</span></td>
                            <td><a href="#" class="action-link">Invoice</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

    </main>

    <!-- Theme & Drawer Script -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const themeToggleBtn = document.getElementById("themeToggleBtn");
            const themeIcon = document.getElementById("themeIcon");
            const menuToggleBtn = document.getElementById("menuToggleBtn");
            const closeSidebarBtn = document.getElementById("closeSidebarBtn");
            const sidebar = document.getElementById("sidebar");

            // Check saved theme
            const savedTheme = localStorage.getItem("zeith_theme");
            if (savedTheme === "dark") {
                document.body.classList.add("dark-theme");
                themeIcon.classList.replace("fa-moon", "fa-sun");
            }

            // Toggle Theme Handler
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

            // Mobile Drawer Toggle
            if (menuToggleBtn && closeSidebarBtn && sidebar) {
                menuToggleBtn.addEventListener("click", () => sidebar.classList.add("active"));
                closeSidebarBtn.addEventListener("click", () => sidebar.classList.remove("active"));
            }
        });
    </script>
</body>

</html>