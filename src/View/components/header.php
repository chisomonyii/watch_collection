<style>
/* =========================================
   ZEITH FLOATING PILL NAVBAR
   ========================================= */

/* Outer Wrapper for margins & floating position */
.zeith-header-wrapper {
    position: absolute;
    top: 32px;
    left: 0;
    right: 0;
    width: 100%;
    z-index: 1000;
    padding: 0 80px;
    box-sizing: border-box;
    pointer-events: none;
}

/* Floating Off-White Pill Container */
.zeith-header-container {
    pointer-events: auto;
    max-width: 1120px;
    margin: 0 auto;
    background: #f6f5f0;
    border-radius: 50px;
    padding: 6px 22px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12), 0 2px 6px rgba(0, 0, 0, 0.06);
    border: 1px solid rgba(255, 255, 255, 0.5);
    backdrop-filter: blur(10px);
    transition: all 0.3s ease;
}

/* Left Group: Logo & Search Bar together */
.zeith-left-group {
    display: flex;
    align-items: center;
    gap: 16px;
    flex: 1;
}

/* Brand Logo */
.zeith-brand-logo {
    font-family: Georgia, 'Times New Roman', serif;
    font-size: 21px;
    font-weight: 500;
    letter-spacing: 4px;
    color: #1a1a1a;
    text-decoration: none;
    text-transform: uppercase;
    transition: opacity 0.3s ease;
    white-space: nowrap;
}

.zeith-brand-logo:hover {
    opacity: 0.8;
}

/* Search Bar */
.zeith-search-container {
    flex: 1;
    display: flex;
    max-width: 260px;
}

.zeith-search-box {
    width: 100%;
    display: flex;
    align-items: center;
    background: rgba(0, 0, 0, 0.05);
    border: 1px solid rgba(0, 0, 0, 0.08);
    border-radius: 25px;
    padding: 5px 14px;
    transition: all 0.3s ease;
}

.zeith-search-box:focus-within {
    background: #ffffff;
    border-color: #1a1a1a;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
}

.zeith-search-box i {
    font-size: 12px;
    color: #555555;
    margin-right: 8px;
}

.zeith-search-box input {
    width: 100%;
    border: none;
    background: transparent;
    font-size: 12px;
    color: #1a1a1a;
    outline: none;
}

.zeith-search-box input::placeholder {
    color: #888888;
}

/* Right Group: Nav Links & Action Icons */
.zeith-right-group {
    display: flex;
    align-items: center;
    gap: 20px;
}

/* Navigation Links (Desktop) */
.zeith-nav-menu {
    display: flex;
    align-items: center;
    gap: 18px;
    list-style: none;
    margin: 0;
    padding: 0;
}

.zeith-nav-link {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 1.5px;
    color: #333333;
    text-decoration: none;
    text-transform: uppercase;
    transition: color 0.3s ease;
}

.zeith-nav-link:hover {
    color: #8c857b;
}

/* Action Icons */
.zeith-action-icons {
    display: flex;
    align-items: center;
    gap: 10px;
}

.zeith-icon-btn {
    position: relative;
    background: transparent;
    border: none;
    color: #222222;
    font-size: 16px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: transform 0.2s ease, color 0.2s ease;
    padding: 5px;
    border-radius: 50%;
}

.zeith-icon-btn:hover {
    color: #8c857b;
    background: rgba(0, 0, 0, 0.04);
}

/* Mobile Toggle */
.zeith-mobile-toggle {
    display: none;
    background: transparent;
    border: none;
    font-size: 18px;
    color: #1a1a1a;
    cursor: pointer;
    padding: 4px;
}

/* =========================================
   MOBILE / IPAD DRAWER MENU
   ========================================= */
.zeith-mobile-menu {
    pointer-events: auto;
    max-width: 1120px;
    margin: 10px auto 0;
    background: #f6f5f0;
    border-radius: 20px;
    padding: 0;
    max-height: 0;
    overflow: hidden;
    opacity: 0;
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
    border: 1px solid rgba(255, 255, 255, 0.6);
    transition: max-height 0.35s ease-in-out, opacity 0.3s ease, padding 0.3s ease;
}

.zeith-mobile-menu.active {
    max-height: 200px;
    opacity: 1;
    padding: 16px 24px;
}

.zeith-mobile-nav-list {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.zeith-mobile-nav-link {
    display: block;
    font-size: 13px;
    font-weight: 600;
    letter-spacing: 2px;
    color: #1a1a1a;
    text-decoration: none;
    text-transform: uppercase;
    padding: 8px 12px;
    border-radius: 10px;
    transition: background 0.2s ease, color 0.2s ease;
}

.zeith-mobile-nav-link:hover {
    background: rgba(0, 0, 0, 0.05);
    color: #8c857b;
}

/* Responsive Breakpoints */
@media (max-width: 1024px) {
    .zeith-header-wrapper {
        padding: 0 24px;
        top: 18px;
    }
    
    .zeith-nav-menu {
        display: none;
    }

    .zeith-mobile-toggle {
        display: block;
    }
}

@media (max-width: 600px) {
    .zeith-header-wrapper {
        padding: 0 14px;
        top: 12px;
    }

    .zeith-header-container {
        padding: 6px 14px;
        gap: 10px;
    }

    .zeith-search-container {
        max-width: 140px; /* Shrinks slightly on very small phones to fit alongside logo */
    }
}
</style>

<div class="zeith-header-wrapper">
    <header class="zeith-header-container">
        
        <!-- Left Group: Logo & Search Bar always visible -->
        <div class="zeith-left-group">
            <a href="/Watch_Collection/home" class="zeith-brand-logo">ZEITH</a>

            <div class="zeith-search-container">
                <form action="/Watch_Collection/collection" method="GET" class="zeith-search-box">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" name="search" placeholder="Search watches..." autocomplete="off">
                </form>
            </div>
        </div>

        <!-- Right Group: Desktop Links & Action Icons -->
        <div class="zeith-right-group">
            <nav>
                <ul class="zeith-nav-menu">
                    <li><a href="/Watch_Collection/user/watch" class="zeith-nav-link">Watches</a></li>
                    <li><a href="#" class="zeith-nav-link">News</a></li>
                    <li><a href="/Watch_Collection/user/contact" class="zeith-nav-link">Contact</a></li>
                </ul>
            </nav>

            <div class="zeith-action-icons">
                <!-- Wishlist Heart Icon -->
                <a href="/Watch_Collection/user/wishlist" class="zeith-icon-btn" aria-label="Wishlist">
                    <i class="fa-regular fa-heart"></i>
                </a>

                <!-- Mobile Menu Toggle Button -->
                <button type="button" id="zeith-mobile-toggle-btn" class="zeith-mobile-toggle" aria-label="Toggle Menu">
                    <i class="fa-solid fa-bars" id="zeith-toggle-icon"></i>
                </button>
            </div>
        </div>

    </header>

    <!-- Slide-Down Mobile/Tablet Navigation Drawer (Links Only) -->
    <div class="zeith-mobile-menu" id="zeith-mobile-dropdown">
        <ul class="zeith-mobile-nav-list">
            <li><a href="/Watch_Collection/collection" class="zeith-mobile-nav-link">Watches</a></li>
            <li><a href="/Watch_Collection/home#news" class="zeith-mobile-nav-link">News</a></li>
            <li><a href="/Watch_Collection/home#contact" class="zeith-mobile-nav-link">Contact</a></li>
        </ul>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.getElementById('zeith-mobile-toggle-btn');
    const dropdown = document.getElementById('zeith-mobile-dropdown');
    const toggleIcon = document.getElementById('zeith-toggle-icon');

    if (toggleBtn && dropdown) {
        toggleBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            dropdown.classList.toggle('active');

            if (dropdown.classList.contains('active')) {
                toggleIcon.classList.remove('fa-bars');
                toggleIcon.classList.add('fa-xmark');
            } else {
                toggleIcon.classList.remove('fa-xmark');
                toggleIcon.classList.add('fa-bars');
            }
        });

        document.addEventListener('click', function(e) {
            if (!dropdown.contains(e.target) && !toggleBtn.contains(e.target)) {
                dropdown.classList.remove('active');
                if (toggleIcon) {
                    toggleIcon.classList.remove('fa-xmark');
                    toggleIcon.classList.add('fa-bars');
                }
            }
        });
    }
});
</script>


<!-- <a href="/Watch_Collection/user/wishlist" title="Wishlist" class="nav-link">
    <i class="fa-solid fa-heart"></i>
    <span>Wishlist</span>
</a>


<a href="/Watch_Collection/user/contact" title="Contact Us">
    <i class="fa-solid fa-phone"></i>
    <span>Contact</span>
</a>

<a href="/Watch_Collection/user/watch" title="Cart">
    <i class="fa-solid fa-clock"></i>
    <span>watch</span>
</a> -->