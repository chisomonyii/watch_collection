<?php 
    // Set active page for the sidebar component
    $activePage = 'settings'; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZEITH - Account Settings</title>
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

        /* Main Content Panel */
        .main-content {
            margin-left: 260px;
            flex: 1;
            padding: 30px;
            max-width: 1100px;
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

        /* Settings Card Sections */
        .settings-container {
            display: flex;
            flex-direction: column;
            gap: 24px;
            animation: slideUp 0.4s ease-out forwards;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .settings-card {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 15px var(--shadow-color);
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--border-color);
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-group label {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-muted);
        }

        .form-control {
            background-color: var(--hover-bg);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            padding: 12px 14px;
            color: var(--text-main);
            font-size: 0.9rem;
            outline: none;
        }

        .form-control:focus {
            border-color: var(--primary-color);
        }

        .btn-save {
            background-color: var(--primary-color);
            color: #ffffff;
            border: none;
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 0.88rem;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            align-self: flex-start;
            margin-top: 10px;
        }

        .btn-save:hover {
            background-color: var(--primary-hover);
        }

        /* Responsive Media Queries */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
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
                padding: 20px 16px;
            }
        }
    </style>
</head>

<body>

    <!-- Dynamic PHP Sidebar Component -->
    <?php include __DIR__ . '/user-sidebar.php'; ?>

    <!-- Main Content Panel -->
    <main class="main-content">

        <!-- Top Navigation Bar -->
        <header class="top-bar">
            <div class="left-bar">
                <button class="menu-toggle-btn" id="menuToggleBtn">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div class="welcome-text">
                    <h1>Account Settings</h1>
                    <p>Update your personal info, security preferences, and details.</p>
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

        <!-- Settings Content Forms -->
        <div class="settings-container">

            <!-- Profile Info Form -->
            <section class="settings-card">
                <h2 class="card-title">Profile Information</h2>
                <form action="#" method="POST">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="fullName">Full Name</label>
                            <input type="text" id="fullName" class="form-control" value="Cisco">
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" class="form-control" value="cisco@zeith.com">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" id="phone" class="form-control" value="+234 800 000 0000">
                        </div>
                        <div class="form-group">
                            <label for="location">Shipping Country</label>
                            <input type="text" id="location" class="form-control" value="Nigeria">
                        </div>
                    </div>
                    <button type="submit" class="btn-save">
                        <i class="fa-solid fa-floppy-disk"></i> Save Changes
                    </button>
                </form>
            </section>

            <!-- Security & Password Form -->
            <section class="settings-card">
                <h2 class="card-title">Security & Password</h2>
                <form action="#" method="POST">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="currentPass">Current Password</label>
                            <input type="password" id="currentPass" class="form-control" placeholder="••••••••">
                        </div>
                        <div class="form-group">
                            <label for="newPass">New Password</label>
                            <input type="password" id="newPass" class="form-control" placeholder="••••••••">
                        </div>
                        <div class="form-group">
                            <label for="confirmPass">Confirm New Password</label>
                            <input type="password" id="confirmPass" class="form-control" placeholder="••••••••">
                        </div>
                    </div>
                    <button type="submit" class="btn-save">
                        <i class="fa-solid fa-lock"></i> Update Password
                    </button>
                </form>
            </section>

        </div>

    </main>

    <!-- Theme & Drawer Script -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const themeToggleBtn = document.getElementById("themeToggleBtn");
            const themeIcon = document.getElementById("themeIcon");
            const menuToggleBtn = document.getElementById("menuToggleBtn");
            const closeSidebarBtn = document.getElementById("closeSidebarBtn");
            const sidebar = document.getElementById("sidebar");

            // Load saved theme
            const savedTheme = localStorage.getItem("zeith_theme");
            if (savedTheme === "dark") {
                document.body.classList.add("dark-theme");
                themeIcon.classList.replace("fa-moon", "fa-sun");
            }

            // Theme switch handler
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

            // Mobile drawer toggle
            if (menuToggleBtn && closeSidebarBtn && sidebar) {
                menuToggleBtn.addEventListener("click", () => sidebar.classList.add("active"));
                closeSidebarBtn.addEventListener("click", () => sidebar.classList.remove("active"));
            }
        });
    </script>
</body>

</html>