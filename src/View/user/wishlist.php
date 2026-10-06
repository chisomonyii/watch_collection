<?php
// Set active page for the sidebar component
$activePage = 'wishlist';
require_once __DIR__ . '/../components/header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZEITH - Saved Wishlist</title>
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

        /* Wishlist Grid */
        .wishlist-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 24px;
            animation: slideUp 0.4s ease-out forwards;
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

        .empty-wishlist-msg {
            grid-column: 1 / -1;
            text-align: center;
            padding: 40px 20px;
            color: var(--text-muted);
            font-size: 1.1rem;
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

        .wishlist-card {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 15px var(--shadow-color);
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .remove-btn {
            position: absolute;
            top: 12px;
            right: 12px;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: rgba(0, 0, 0, 0.4);
            color: #ffffff;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(4px);
        }

        .remove-btn:hover {
            background: #ef4444;
        }

        .card-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .card-body {
            padding: 18px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .item-brand {
            font-size: 0.75rem;
            color: var(--primary-color);
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .item-title {
            font-size: 1.05rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .item-price {
            font-size: 1.15rem;
            font-weight: 800;
            margin-bottom: 16px;
        }

        .card-actions {
            margin-top: auto;
        }

        .add-cart-btn {
            width: 100%;
            background-color: var(--primary-color);
            color: #ffffff;
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 0.88rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .add-cart-btn:hover {
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
    <?php include __DIR__ . '/../components/sidebar.php'; ?>

    <!-- Main Content Panel -->
    <main class="main-content">

        <!-- Header Bar -->
        <header class="top-bar">
            <div class="left-bar">
                <button class="menu-toggle-btn" id="menuToggleBtn">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div class="welcome-text">
                    <h1>Saved Wishlist</h1>
                    <p>Manage timepieces you are considering for purchase.</p>
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

        <!-- Wishlist Container (Grid target for JS rendering) -->
        <section class="wishlist-grid" id="wishlistContainer">
            <!-- Dynamic Watch Cards Loaded via JS -->
        </section>

    </main>

    <!-- Wishlist Helper Script Link -->
    <script src="<?php assets('js/wishlist.js'); ?>"></script>

    <!-- Dynamic Wishlist Fetch & Theme Script -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const themeToggleBtn = document.getElementById("themeToggleBtn");
            const themeIcon = document.getElementById("themeIcon");
            const menuToggleBtn = document.getElementById("menuToggleBtn");
            const closeSidebarBtn = document.getElementById("closeSidebarBtn");
            const sidebar = document.getElementById("sidebar");

            // Load Saved Theme
            const savedTheme = localStorage.getItem("zeith_theme");
            if (savedTheme === "dark") {
                document.body.classList.add("dark-theme");
                themeIcon.classList.replace("fa-moon", "fa-sun");
            }

            // Theme Switch Handler
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

            // Fetch and render saved wishlist items from API
            loadWishlistItems();
        });

        async function loadWishlistItems() {
            const container = document.getElementById('wishlistContainer');
            const watchIds = getWishlist();

            if (!watchIds || watchIds.length === 0) {
                container.innerHTML = `
                    <div class="empty-wishlist-msg">
                        <i class="fa-regular fa-heart" style="font-size: 2.5rem; margin-bottom: 12px;"></i>
                        <p>Your wishlist is currently empty.</p>
                    </div>
                    <div class="view-more-container">
                        <a href="/catalog" class="view-more-link">
                            Browse Watches <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>`;
                return;
            }

            try {
                const response = await fetch('/Watch_Collection/staff/api/watches/batch', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        ids: watchIds
                    })
                });
                const result = await response.json();

                if (result.success && result.data.length > 0) {
                    const cardsHtml = result.data.map(watch => `
                        <div class="wishlist-card">
                            <button class="remove-btn" title="Remove Item" onclick="removeFromWishlist(${watch.id})">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                            <img src="${watch.image_url}" class="card-img" alt="${watch.name}">
                            <div class="card-body">
                                <span class="item-brand">${watch.brand || 'ZEITH'}</span>
                                <h3 class="item-title">${watch.name}</h3>
                                <div class="item-price">₦${Number(watch.price).toLocaleString('en-NG', {minimumFractionDigits: 2})}</div>
                                <div class="card-actions">
                                    <button class="add-cart-btn"><i class="fa-solid fa-cart-shopping"></i> Move to Cart</button>
                                </div>
                            </div>
                        </div>
                    `).join('');

                    container.innerHTML = cardsHtml + `
                        <div class="view-more-container">
                            <a href="/catalog" class="view-more-link">
                                View More Watches <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>`;
                } else {
                    container.innerHTML = `
                        <div class="empty-wishlist-msg">
                            <p>No saved items found.</p>
                        </div>`;
                }
            } catch (error) {
                console.error("Error loading wishlist items:", error);
            }
        }

        function removeFromWishlist(watchId) {
            toggleWishlist(watchId);
            loadWishlistItems(); // Re-render without full page reload
        }
    </script>

</body>

</html>