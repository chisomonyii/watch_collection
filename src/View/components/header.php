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
        overflow: visible !important;
        /* Ensures dropdown isn't clipped */
    }

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
        overflow: visible !important;
        /* Crucial so dropdown can hang outside the pill */
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
        max-width: 280px;
        position: relative;
        overflow: visible !important;
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

    /* SEARCH DROPDOWN STYLING (Matching Nixon Template Exactly) */
    .zeith-dropdown-box {
        position: absolute;
        top: 100%;
        left: 0;
        width: 320px;
        /* Expands to give watch names ample breathing room */
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        margin-top: 12px;
        display: none;
        z-index: 2000;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        overflow: hidden;
    }

    .zeith-dropdown-header {
        padding: 14px 18px;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.85rem;
        color: #64748b;
        font-weight: 500;
        background: #ffffff;
    }

    .zeith-dropdown-list {
        max-height: 380px;
        overflow-y: auto;
    }

    .zeith-dropdown-item {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 12px 18px;
        text-decoration: none;
        border-bottom: 1px solid #f1f5f9;
        transition: background 0.2s ease;
    }

    .zeith-dropdown-item:hover {
        background: #f8fafc;
    }

    .zeith-dropdown-img {
        width: 48px;
        height: 48px;
        object-fit: contain;
        /* Keeps the entire watch nicely centered without cropping */
        border-radius: 8px;
        background: #f8fafc;
        /* Clean light background for transparent watch PNGs */
        padding: 4px;
        border: 1px solid #e2e8f0;
    }

    .zeith-dropdown-info {
        flex: 1;
    }

    .zeith-dropdown-title {
        font-size: 0.88rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 3px;
        line-height: 1.2;
    }

    .zeith-dropdown-price {
        font-size: 0.82rem;
        color: #1a1a1a;
        font-weight: 700;
    }

    .zeith-dropdown-footer {
        padding: 14px;
        text-align: center;
        background: #ffffff;
        border-top: 1px solid #f1f5f9;
    }

    .zeith-dropdown-viewall {
        color: #1a1a1a;
        font-size: 0.9rem;
        font-weight: 700;
        text-decoration: underline;
        transition: color 0.2s ease;
    }

    .zeith-dropdown-viewall:hover {
        color: #8c857b;
    }

    .zeith-no-results {
        padding: 30px 20px;
        text-align: center;
        color: #64748b;
        font-size: 0.9rem;
        background: #ffffff;
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

    /* Mobile / iPad Drawer Menu */
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
            max-width: 140px;
        }

        .zeith-dropdown-box {
            width: 260px;
        }
    }

    /* ======================================================
   ZEITH MINIMALIST BRAND PRELOADER
   ====================================================== */
    .zeith-preloader {
        position: fixed;
        inset: 0;
        background-color: #0b0d10;
        /* Obsidian dark base */
        z-index: 99999;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: opacity 0.4s ease, visibility 0.4s ease;
    }

    .zeith-preloader.fade-out {
        opacity: 0;
        visibility: hidden;
    }

    .preloader-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
    }

    .preloader-content .brand-logo {
        font-size: 2.2rem;
        font-weight: 800;
        letter-spacing: 6px;
        color: #ffffff;
        text-transform: uppercase;
    }

    .preloader-progress-track {
        width: 140px;
        height: 3px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 4px;
        overflow: hidden;
        position: relative;
    }

    .preloader-progress-bar {
        width: 0%;
        height: 100%;
        background: linear-gradient(90deg, #f68b1e, #ffaa42);
        border-radius: 4px;
        transition: width 0.3s ease;
    }
</style>


<!-- ZEITH BRAND PRELOADER OVERLAY -->
<div id="zeith-preloader" class="zeith-preloader">
    <div class="preloader-content">
        <h1 class="brand-logo">ZEITH</h1>
        <div class="preloader-progress-track">
            <div class="preloader-progress-bar"></div>
        </div>
    </div>
</div>
<div class="zeith-header-wrapper">
    <header class="zeith-header-container">

        <!-- Left Group: Logo & Search Bar -->
        <div class="zeith-left-group">
            <a href="/Watch_Collection/" class="zeith-brand-logo">ZEITH</a>

            <div class="zeith-search-container">
                <form action="/Watch_Collection/product/search" method="GET" class="zeith-search-box">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" id="liveSearchInput" name="q" placeholder="Search through 20,000 watches" autocomplete="off">
                    <button type="button" id="clearSearchBtn" style="display: none; background: none; border: none; cursor: pointer; color: #555555; padding: 0 4px;"><i class="fa-solid fa-xmark"></i></button>
                </form>

                <!-- Live Results Dropdown Container (Slides DOWN underneath search bar) -->
                <div id="searchResultsDropdown" class="zeith-dropdown-box"></div>
            </div>
        </div>

        <!-- Right Group: Desktop Links & Action Icons -->
        <div class="zeith-right-group">
            <nav>
                <ul class="zeith-nav-menu">
                    <li><a href="/Watch_Collection/user/watch" class="zeith-nav-link">Watches</a></li>
                    <li><a href="/Watch_Collection/news" class="zeith-nav-link">News</a></li>
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

    <!-- Mobile Drawer -->
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
        // 1. Mobile Menu Toggle Logic
        const toggleBtn = document.getElementById('zeith-mobile-toggle-btn');
        const mobileDropdown = document.getElementById('zeith-mobile-dropdown');
        const toggleIcon = document.getElementById('zeith-toggle-icon');

        if (toggleBtn && mobileDropdown) {
            toggleBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                mobileDropdown.classList.toggle('active');

                if (mobileDropdown.classList.contains('active')) {
                    toggleIcon.classList.remove('fa-bars');
                    toggleIcon.classList.add('fa-xmark');
                } else {
                    toggleIcon.classList.remove('fa-xmark');
                    toggleIcon.classList.add('fa-bars');
                }
            });

            document.addEventListener('click', function(e) {
                if (!mobileDropdown.contains(e.target) && !toggleBtn.contains(e.target)) {
                    mobileDropdown.classList.remove('active');
                    if (toggleIcon) {
                        toggleIcon.classList.remove('fa-xmark');
                        toggleIcon.classList.add('fa-bars');
                    }
                }
            });
        }

        // 2. Live Search Dropdown Logic
        const searchInput = document.getElementById('liveSearchInput');
        const searchDropdown = document.getElementById('searchResultsDropdown');
        const clearBtn = document.getElementById('clearSearchBtn');

        if (searchInput && searchDropdown) {
            searchInput.addEventListener('input', function() {
                let query = this.value.trim();

                if (clearBtn) {
                    clearBtn.style.display = query.length > 0 ? 'block' : 'none';
                }

                if (query.length === 0) {
                    searchDropdown.style.display = 'none';
                    searchDropdown.innerHTML = '';
                    return;
                }

                // FIXED: Absolute path so it never breaks on sub-pages
                fetch(`/Watch_Collection/api/search?q=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        let html = `
                        <div class="zeith-dropdown-header">
                            Results for: "${escapeHtml(query)}"
                        </div>
                    `;

                        if (data.length > 0) {
                            html += `<div class="zeith-dropdown-list">`;
                            data.forEach(product => {
                                let formattedPrice = '₦' + parseFloat(product.price).toLocaleString();

                                // Add your actual image folder path here (e.g., 'assets/images/' or 'uploads/')
                                let imgSrc = product.image_url_1 ? `/Watch_Collection/assets/image/${product.image_url_1}` : '/Watch_Collection/assets/images/placeholder.jpg';
                                html += `
                               <a href="/Watch_Collection/watch/details/${product.id}" class="zeith-dropdown-item">
                                   <img src="${imgSrc}" alt="${escapeHtml(product.name)}" class="zeith-dropdown-img">
                                   <div class="zeith-dropdown-info">
                                       <div class="zeith-dropdown-title">${escapeHtml(product.name)}</div>
                                       <div class="zeith-dropdown-price">${formattedPrice}</div>
                                   </div>
                               </a>
                           `;
                            });
                            html += `</div>`;

                            // FIXED: Point to /product/search instead of /search
                            html += `
                                <div class="zeith-dropdown-footer">
                                    <a href="/Watch_Collection/product/search?q=${encodeURIComponent(query)}" class="zeith-dropdown-viewall">View all</a>
                                </div>
                            `;
                        } else {
                            html += `
                            <div class="zeith-no-results">
                                No products found.
                            </div>
                        `;
                        }

                        searchDropdown.innerHTML = html;
                        searchDropdown.style.display = 'block';
                    })
                    .catch(err => {
                        console.error("Search API Error:", err);
                    });
            });

            if (clearBtn) {
                clearBtn.addEventListener('click', function() {
                    searchInput.value = '';
                    clearBtn.style.display = 'none';
                    searchDropdown.style.display = 'none';
                    searchDropdown.innerHTML = '';
                    searchInput.focus();
                });
            }

            document.addEventListener('click', function(e) {
                if (!e.target.closest('.zeith-search-container')) {
                    searchDropdown.style.display = 'none';
                }
            });
        }

        function escapeHtml(text) {
            return text.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
        }
    });

    // Minimalist Brand Preloader dismissal
    document.addEventListener('DOMContentLoaded', () => {
        const preloader = document.getElementById('zeith-preloader');
        const progressBar = document.querySelector('.preloader-progress-bar');

        function hidePreloader() {
            if (!preloader) return;
            if (progressBar) progressBar.style.width = '100%';
            setTimeout(() => {
                preloader.classList.remove('active');
                preloader.classList.add('fade-out');
            }, 200);
        }

        // Initial load
        hidePreloader();

        // 1. FIX FOR BACK/FORWARD BUTTON (bfcache)
        window.addEventListener('pageshow', (event) => {
            // If restored from back/forward cache or reloaded
            if (event.persisted) {
                hidePreloader();
            }
        });

        // 2. Intercept link clicks to show loader on navigation
        document.addEventListener('click', function(e) {
            const link = e.target.closest('a');
            if (!link) return;

            const href = link.getAttribute('href');
            const target = link.getAttribute('target');

            if (
                !href ||
                href.startsWith('#') ||
                href.startsWith('javascript:') ||
                target === '_blank' ||
                link.hasAttribute('download')
            ) {
                return;
            }

            if (e.ctrlKey || e.metaKey || e.shiftKey || e.button === 1) {
                return;
            }

            if (preloader) {
                preloader.classList.remove('fade-out');
                preloader.classList.add('active');
                if (progressBar) {
                    progressBar.style.width = '60%';
                }
            }
        });
    });
</script>