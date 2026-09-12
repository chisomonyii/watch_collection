<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/69c405441a.js" crossorigin="anonymous"></script>
    <title>Zeith - Properties</title>
</head>

<body class="property-body">

    <div class="property-container">

        <!-- Sidebar Section (Visible on Desktop) -->
        <aside class="property-sidebar">

            <div class="property-sidebar-widget">
                <h3 class="property-widget-title">THE ZEITH ASSETS</h3>
                <ul class="property-category-list">
                    <li><a href="#">Hublot </a></li>
                    <li><a href="#">G-SHock</a></li>
                    <li><a href="#">Rolex</a></li>
                    <li><a href="#">Omega</a></li>
                    <li><a href="#">calvin Klein </a></li>
                    <li><a href="#">Cartier Watches</a></li>
                    <li><a href="#">Apple Watches</a></li>
                    <li><a href="#">Patek Philippe</a></li>
                </ul>
            </div>

            <div class="property-sidebar-widget">
                <h3 class="property-widget-title">FILTER BY PRICE</h3>
                <div class="property-price-range">
                    <input type="range" min="6500" max="3951170" value="3951170" class="property-range-slider">
                    <div class="property-price-controls">
                        <span class="property-price-label">PRICE: ₦5,000 — ₦500,000</span>
                        <button class="property-filter-btn">FILTER</button>
                    </div>
                </div>
            </div>

        </aside>

        <main class="property-main-content">

            <div class="property-hero-banner">
                <div class="hero-3d-bg">
                    <img src="./image/pat-taylor-12V36G17IbQ-unsplash.jpg" alt="3D Floating Background Watch">
                </div>

                <div class="property-hero-text">
                    <span class="property-hero-subtitle">OUR CLASSIC</span>
                    <h2 class="property-hero-title">Zeith Collections</h2>
                    <p class="property-hero-desc">Explore Luxury Wrist Watches</p>
                </div>

                <div class="property-hero-images">
                    <img src="./image/pngwing.com (11).png" alt="Featured Watch 1" class="property-hero-img">
                    <img src="./image/pngwing.com (10).png" alt="Featured Watch 2" class="property-hero-img">
                </div>
            </div>

            <div class="property-toolbar">

                <div class="custom-dropdown-container">
                    <details class="custom-dropdown">
                        <summary class="dropdown-summary">
                            <span>Select Category / Asset</span>
                            <span class="chevron">▼</span>
                        </summary>
                        <div class="dropdown-menu">
                            <span class="dropdown-header">THE ZEITH ASSETS</span>
                            <a href="#" class="dropdown-item">Hublot</a>
                            <a href="#" class="dropdown-item">G-Shock</a>
                            <a href="#" class="dropdown-item">Rolex</a>
                            <a href="#" class="dropdown-item">Omega</a>
                            <a href="#" class="dropdown-item">Daniel Klein</a>
                            <a href="#" class="dropdown-item">Asorock</a>
                            <a href="#" class="dropdown-item">Bulova Watches</a>
                            <a href="#" class="dropdown-item">Patek Philippe & Cartier</a>
                        </div>
                    </details>
                </div>

                <div class="property-toolbar-controls">
                    <div class="custom-dropdown-container">
                        <details class="custom-dropdown">
                            <summary class="dropdown-summary">
                                <span>Default sorting</span>
                                <span class="chevron">▼</span>
                            </summary>
                            <div class="dropdown-menu">
                                <a href="#" class="dropdown-item">Default sorting</a>
                                <a href="#" class="dropdown-item">Sort by popularity</a>
                                <a href="#" class="dropdown-item">Sort by price: low to high</a>
                                <a href="#" class="dropdown-item">Sort by price: high to low</a>
                            </div>
                        </details>
                    </div>
                </div>
            </div>

            <div class="property-grid">

                <div class="property-card">
                    <div class="property-card-media">
                        <img src="./image/pngwing.com (1).png" alt="G-STEEL">
                    </div>
                    <div class="property-card-info">
                        <span class="property-card-brand">G-STEEL</span>
                        <h4 class="property-card-name">Combines resin inner cases</h4>
                        <p>★★★★★ (4.9)</p>
                        <p class="property-card-price">₦254,400.00 </p>
                    
                        <span><i class="fa-solid fa-cart-shopping icon"></i></span>
                    </div>
                </div>

                <div class="property-card">
                    <div class="property-card-media">
                        <img src="./image/pngwing.com (10).png" alt="Cross Pen 8511">
                    </div>
                    <div class="property-card-info">
                        <span class="property-card-brand">Spirit of Big Bang</span>
                        <h4 class="property-card-name">recognizable by its curved, barrel-shaped</h4>
                        <p>★★★★☆ (4.6)</p>
                        <p class="property-card-price">₦12,800.00 </p>
                        <span><i class="fa-solid fa-cart-shopping icon"></i></span>

                    </div>
                </div>

                <div class="property-card">
                    <div class="property-card-media">
                        <img src="./image/pngwing.com (11).png" alt="Chronograph Watch">
                    </div>
                    <div class="property-card-info">
                        <span class="property-card-brand">Air-KingBulova</span>
                        <h4 class="property-card-name">distinctive minute-scale track</h4>
                        <p>★★★★☆ (4.8)</p>
                        <p class="property-card-price">₦480,000.00 </p>

                    </div>
                    <span><i class="fa-solid fa-cart-shopping icon"></i></span>
                </div>

            </div>
        </main>

    </div>

</body>

</html>