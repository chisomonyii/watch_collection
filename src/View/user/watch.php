<?php
$watches = $watches ?? \App\Models\Watch::getAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/69c405441a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?php assets("css/login.css"); ?>">
    <title>Zeith - Luxury Watch Collections</title>

    <style>
        /* ADD BUTTON */
        .add-button {
            position: absolute;
            bottom: 15px;
            left: 15px;
            background: #f68b1e;
            color: #fff;
            border: none;
            padding: 8px 22px;
            border-radius: 20px;
            font-weight: 600;
            font-size: .9rem;
            cursor: pointer;
            transition: .3s ease;
            z-index: 5;
        }

        .add-button:hover {
            background: #000;
            color: #fff;
            transform: translateY(-1px);
        }

        /* WISHLIST BUTTON */
        .wishlist-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            border: none;
            color: #f68b1e;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0 3px 10px rgba(0, 0, 0, .12);
            z-index: 5;
            transition: .3s ease;
        }

        .wishlist-btn i {
            color: #f68b1e;
            font-size: 1rem;
        }

        .wishlist-btn:hover,
        .wishlist-btn.active {
            background: #f68b1e;
            transform: scale(1.08);
        }

        .wishlist-btn:hover i,
        .wishlist-btn.active i {
            color: #fff;
        }

        /* WATCH CARDS */
        .property-card {
            position: relative;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, .05);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding-bottom: 50px;
            transition: transform .3s ease, opacity .3s ease;
        }

        .property-card.hidden {
            display: none !important;
        }

        .property-card:hover {
            transform: translateY(-5px);
        }

        .property-card-media {
            width: 100%;
            height: 220px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f9f9f9;
            padding: 20px;
            box-sizing: border-box;
        }

        .property-card-media img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .property-card-info {
            padding: 15px 20px;
            text-align: center;
        }

        .property-card-brand {
            display: block;
            font-size: .85rem;
            color: #888;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .property-card-name {
            font-size: 1.1rem;
            color: #003b2f;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .property-card-price {
            font-size: 1.15rem;
            color: #003b2f;
            font-weight: 800;
        }

        .no-results {
            grid-column: 1 / -1;
            text-align: center;
            padding: 50px 20px;
            font-size: 1.1rem;
            color: #666;
            display: none;
        }

        /* FIXED FLOATING CART */

        .floating-cart {
            position: fixed;
            right: 30px;
            bottom: 30px;

            width: 65px;
            height: 65px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: #f68b1e;
            color: #ffffff;

            border-radius: 50%;
            text-decoration: none;
            font-size: 25px;

            box-shadow: 0 5px 18px rgba(0, 0, 0, 0.20);
            z-index: 9999;

            transition: 0.3s ease;
        }

        .floating-cart:hover {
            background: #003b2f;
            color: #ffffff;
            transform: scale(1.08);
        }

        /* Quantity badge overlapping the orange circle */
        /* Cart Quantity - Top Center */
        .cart-count {
            position: absolute;
            top: -12px;
            left: 50%;
            transform: translateX(-50%);
            min-width: 26px;
            height: 26px;
            padding: 0 5px;
            border-radius: 50%;
            background: #ffffff;
            color: #f68b1e;
            font-size: 14px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #f68b1e;
        }

        .cart-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .45);
            opacity: 0;
            visibility: hidden;
            transition: .3s ease;
            z-index: 10000;
        }

        .cart-overlay.open {
            opacity: 1;
            visibility: visible;
        }

        .cart-drawer {
            position: fixed;
            top: 0;
            right: 0;
            width: 440px;
            max-width: 100%;
            height: 100vh;
            height: 100dvh;
            background: #fff;
            z-index: 10001;
            display: flex;
            flex-direction: column;
            box-shadow: -8px 0 30px rgba(0, 0, 0, .12);
            transform: translateX(100%);
            visibility: hidden;
            transition: transform .35s ease, visibility .35s ease;
        }

        .cart-drawer.open {
            transform: translateX(0);
            visibility: visible;
        }

        body.cart-open {
            overflow: hidden;
        }

        .cart-drawer-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 24px 22px;
            border-bottom: 1px solid #eee;
        }

        .cart-drawer-header small {
            color: #f68b1e;
            font-weight: 800;
            letter-spacing: 1.5px;
        }

        .cart-drawer-header h2 {
            color: #003b2f;
            font-size: 22px;
            margin: 8px 0 0;
        }

        #drawer-item-count {
            color: #888;
            font-size: 14px;
        }

        .cart-close {
            border: 0;
            background: #f5f5f5;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 20px;
        }

        .cart-close:hover {
            background: #f68b1e;
            color: white;
        }

        .cart-items {
            flex: 1;
            min-height: 0;
            overflow-y: auto;
            padding: 0 22px;
        }

        .cart-empty {
            height: 100%;
            min-height: 250px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #777;
        }

        .cart-empty i {
            color: #f68b1e;
            font-size: 42px;
            margin-bottom: 15px;
        }

        .cart-empty h3 {
            color: #003b2f;
            margin-bottom: 8px;
        }

        .cart-item {
            display: grid;
            grid-template-columns: 90px minmax(0, 1fr);
            gap: 14px;
            padding: 20px 0;
            border-bottom: 1px solid #eee;
        }

        .cart-item-image {
            height: 105px;
            background: #f8f8f8;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .cart-item-image img {
            width: 100%;
            height: 100%;
            padding: 5px;
            object-fit: contain;
        }

        .cart-item-brand {
            color: #888;
            font-size: 11px;
            text-transform: uppercase;
        }

        .cart-item-name {
            color: #003b2f;
            font-size: 14px;
            margin: 5px 0;
        }

        .cart-item-price {
            color: #f68b1e;
            font-weight: 800;
        }

        .cart-variant {
            display: block;
            width: 100%;
            max-width: 180px;
            margin-top: 10px;
            padding: 7px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: white;
        }

        .cart-item-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 8px;
            margin-top: 12px;
        }

        .cart-quantity {
            display: flex;
            align-items: center;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .cart-quantity button {
            width: 28px;
            height: 28px;
            border: 0;
            background: #f8f8f8;
            cursor: pointer;
        }

        .cart-quantity span {
            min-width: 25px;
            text-align: center;
            font-size: 12px;
        }

        .cart-remove {
            border: 0;
            background: transparent;
            color: #888;
            text-decoration: underline;
            cursor: pointer;
        }

        .cart-drawer-footer {
            padding: 20px 22px;
            border-top: 1px solid #eee;
            background: white;
        }

        .cart-subtotal-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cart-subtotal-row strong {
            color: #003b2f;
            font-size: 21px;
        }

        .cart-drawer-footer p {
            color: #888;
            font-size: 11px;
            line-height: 1.5;
        }

        .checkout-button {
            width: 100%;
            padding: 16px;
            border: 0;
            border-radius: 6px;
            background: #f68b1e;
            color: white;
            font-weight: 800;
            cursor: pointer;
        }

        .checkout-button:hover {
            background: #003b2f;
        }

        .checkout-button:disabled {
            opacity: .5;
            cursor: not-allowed;
        }

        .continue-shopping {
            width: 100%;
            margin-top: 12px;
            padding: 8px;
            border: 0;
            background: transparent;
            cursor: pointer;
        }

        /* Tablet */
        @media (max-width: 768px) {
            .floating-cart {
                width: 58px;
                height: 58px;
                right: 22px;
                bottom: 22px;
                font-size: 22px;
            }
        }

        /* Mobile */
        @media (max-width: 480px) {
            .floating-cart {
                width: 55px;
                height: 55px;
                right: 18px;
                bottom: 18px;
                font-size: 21px;
            }

            .cart-count {
                top: -6px;
                right: -5px;
                min-width: 23px;
                height: 23px;
                font-size: 11px;
            }

            .cart-drawer {
                width: 100%;
            }

            .cart-drawer-header,
            .cart-items,
            .cart-drawer-footer {
                padding-left: 17px;
                padding-right: 17px;
            }
        }
    </style>
</head>

<body class="property-body">
    <div class="property-container">

        <aside class="property-sidebar">
            <div class="property-sidebar-widget">
                <h3 class="property-widget-title">THE <span class="zeith-span">ZEITH</span> ASSETS</h3>
                <ul class="property-category-list">
                    <li><a href="/Watch_Collection/user/watch/collection/hublot">Hublot</a></li>
                    <li><a href="/Watch_Collection/user/watch/collection/g-shock">G-Shock</a></li>
                    <li><a href="/Watch_Collection/user/watch/collection/rolex">Rolex</a></li>
                    <li><a href="/Watch_Collection/user/watch/collection/omega">Omega</a></li>
                    <li><a href="/Watch_Collection/user/watch/collection/daniel-klein">Daniel Klein</a></li>
                    <li><a href="/Watch_Collection/user/watch/collection/asorock">Asorock</a></li>
                    <li><a href="/Watch_Collection/user/watch/collection/bulova-watches">Bulova Watches</a></li>
                    <li><a href="/Watch_Collection/user/watch/collection/patek-philippe">Patek Philippe & Cartier</a></li>
                </ul>
            </div>

            <div class="property-sidebar-widget">
                <h3 class="property-widget-title">FILTER BY PRICE</h3>
                <div class="property-price-range">
                    <input type="range" id="priceRangeSlider" min="3000" max="5000000" value="5000000" step="5000" class="property-range-slider">
                    <div class="property-price-controls">
                        <span class="property-price-label" id="priceRangeLabel">PRICE: ₦3,000 — ₦5,000,000</span>
                        <button class="property-filter-btn" id="btnApplyFilter">FILTER</button>
                    </div>
                </div>
            </div>
        </aside>

        <main class="property-main-content">
            <div class="property-hero-banner">
                <div class="hero-3d-bg">
                    <img src="<?php assets("image/pat-taylor-12V36G17IbQ-unsplash (1).jpg"); ?>" alt="Luxury watch">
                </div>
                <div class="property-hero-text">
                    <span class="property-hero-subtitle">OUR CLASSIC</span>
                    <h2 class="property-hero-title">ZEITH Collections</h2>
                    <p class="property-hero-desc">Explore Luxury Wrist Watches</p>
                </div>
            </div>

            <div class="property-toolbar">
                <div class="custom-dropdown-container">
                    <details class="custom-dropdown">
                        <summary class="dropdown-summary">
                            <span id="selectedCategoryText">All Collections</span>
                            <span class="chevron">▼</span>
                        </summary>
                        <div class="dropdown-menu">
                            <span class="dropdown-header">THE ZEITH ASSETS</span>
                            <a href="#" class="dropdown-item brand-filter-link" data-brand="Hublot">Hublot</a>
                            <a href="#" class="dropdown-item brand-filter-link" data-brand="G-Shock">G-Shock</a>
                            <a href="#" class="dropdown-item brand-filter-link" data-brand="Rolex">Rolex</a>
                            <a href="#" class="dropdown-item brand-filter-link" data-brand="Omega">Omega</a>
                            <a href="#" class="dropdown-item brand-filter-link" data-brand="Daniel Klein">Daniel Klein</a>
                            <a href="#" class="dropdown-item brand-filter-link" data-brand="Asorock">Asorock</a>
                            <a href="#" class="dropdown-item brand-filter-link" data-brand="Bulova Watches">Bulova Watches</a>
                            <a href="#" class="dropdown-item brand-filter-link" data-brand="Patek Philippe">Patek Philippe & Cartier</a>
                        </div>
                    </details>
                </div>
            </div>

            <div class="property-grid" id="watchGrid">
                <?php if (!empty($watches)): ?>
                    <?php foreach ($watches as $watch): ?>
                        <div class="property-card"
                            data-id="<?= htmlspecialchars((string)$watch['id']); ?>"
                            data-brand="<?= htmlspecialchars($watch['brand'] ?? $watch['name']); ?>"
                            data-price="<?= htmlspecialchars((string)$watch['price']); ?>">
                            data-stock="<?= (int)($watch['stock'] ?? 10); ?>">

                            <button type="button" class="wishlist-btn"
                                data-id="<?= htmlspecialchars((string)$watch['id']); ?>"
                                title="Add to Wishlist" aria-label="Add to wishlist">
                                <i class="fa-solid fa-heart"></i>
                            </button>

                            <div class="property-card-media">
                                <img src="<?php assets($watch['image_url'] ?? 'image/pngwing.com (1).png'); ?>"
                                    alt="<?= htmlspecialchars($watch['name']); ?>">
                            </div>

                            <div class="property-card-info">
                                <span class="property-card-brand"><?= htmlspecialchars($watch['brand'] ?? 'ZEITH'); ?></span>
                                <h4 class="property-card-name"><?= htmlspecialchars($watch['name']); ?></h4>
                                <p class="property-card-price">₦<?= number_format((float)$watch['price'], 2); ?></p>
                            </div>

                            <button type="button" class="add-button">Add</button>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="no-results" style="display:block;">No watch collections available at the moment.</p>
                <?php endif; ?>

                <div class="no-results" id="noResultsMsg">
                    No watches found in this price range or category.
                </div>
            </div>
        </main>
    </div>

    <!-- =========================================
         FIXED SHOPPING CART
    ========================================= -->


    <button type="button"
        class="floating-cart"
        id="open-cart"
        title="Shopping Cart"
        aria-label="Open shopping cart"
        aria-controls="cart-drawer"
        aria-expanded="false">
        <i class="fa-solid fa-cart-shopping"></i>
        <span class="cart-count" id="cart-count">0</span>
    </button>


    <div class="cart-overlay" id="cart-overlay"></div>

    <aside class="cart-drawer"
        id="cart-drawer"
        aria-hidden="true"
        aria-label="Shopping cart">

        <div class="cart-drawer-header">
            <div>
                <small>THE ZEITH EXPERIENCE</small>
                <h2>Shopping Bag <span id="drawer-item-count">(0)</span></h2>
            </div>

            <button type="button" id="close-cart" class="cart-close"
                aria-label="Close cart">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <div class="cart-items" id="cart-items"></div>

        <div class="cart-drawer-footer">
            <div class="cart-subtotal-row">
                <span>Subtotal</span>
                <strong id="cart-subtotal">₦0.00</strong>
            </div>

            <p>Shipping and applicable fees are calculated at checkout.</p>

            <button type="button" id="checkout-button" class="checkout-button">
                Proceed to Checkout
                <i class="fa-solid fa-arrow-right"></i>
            </button>

            <button type="button" id="continue-shopping" class="continue-shopping">
                Continue Shopping
            </button>
        </div>
    </aside>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const priceSlider = document.getElementById('priceRangeSlider');
            const priceLabel = document.getElementById('priceRangeLabel');
            const btnFilter = document.getElementById('btnApplyFilter');
            const cards = Array.from(document.querySelectorAll('.property-card, .watch-card, .arrivals, .watch-detail'));
            const noResultsMsg = document.getElementById('noResultsMsg');
            const watchGrid = document.getElementById('watchGrid') || document.body;
            const brandLinks = document.querySelectorAll('.brand-filter-link');
            const selectedCategoryText = document.getElementById('selectedCategoryText');

            // Drawer and Cart elements
            const drawer = document.getElementById('cart-drawer');
            const overlay = document.getElementById('cart-overlay');
            const openButton = document.getElementById('open-cart');
            const closeButton = document.getElementById('close-cart');
            const continueButton = document.getElementById('continue-shopping');
            const itemsContainer = document.getElementById('cart-items');
            const subtotalElement = document.getElementById('cart-subtotal');
            const badge = document.getElementById('cart-count');
            const drawerCount = document.getElementById('drawer-item-count');
            const checkoutButton = document.getElementById('checkout-button');

            let activeBrand = 'all';

            function readStorage(key) {
                try {
                    const value = JSON.parse(localStorage.getItem(key) || '[]');
                    return Array.isArray(value) ? value : [];
                } catch {
                    return [];
                }
            }

            function readCart() {
                return readStorage('zeith_cart').map(item => {
                    if (item && typeof item === 'object') {
                        return {
                            ...item,
                            id: String(item.id ?? ''),
                            price: Number(item.price) || 0,
                            quantity: Math.max(1, Number(item.quantity) || 1),
                            stock: Number(item.stock) || 10,
                            strap: item.strap || 'Steel'
                        };
                    }
                    return {
                        id: String(item ?? ''),
                        name: 'Watch details unavailable',
                        brand: 'ZEITH',
                        price: 0,
                        image: '',
                        quantity: 1,
                        stock: 10,
                        strap: 'Steel'
                    };
                });
            }

            function saveCart(cart) {
                localStorage.setItem('zeith_cart', JSON.stringify(cart));
                renderCart();
            }

            function money(value) {
                return '₦' + Number(value || 0).toLocaleString('en-NG', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
            }

            function escapeHTML(value) {
                return String(value ?? '').replace(/[&<>"']/g, character => ({
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#39;'
                })[character]);
            }

            // PRICE FILTER
            function filterWatches() {
                if (!priceSlider) return;
                const maxPrice = parseFloat(priceSlider.value) || 0;
                let visibleCount = 0;

                cards.forEach(card => {
                    const price = parseFloat(card.dataset.price) || 0;
                    const brand = (card.dataset.brand || '').toLowerCase();

                    const matchesPrice = price <= maxPrice;
                    const matchesBrand = activeBrand === 'all' ||
                        brand.includes(activeBrand.toLowerCase());

                    card.classList.toggle('hidden', !(matchesPrice && matchesBrand));

                    if (matchesPrice && matchesBrand) visibleCount++;
                });

                if (noResultsMsg) {
                    noResultsMsg.style.display = visibleCount === 0 ? 'block' : 'none';
                }
            }

            if (priceSlider && priceLabel) {
                priceSlider.addEventListener('input', () => {
                    const value = Number(priceSlider.value);
                    priceLabel.textContent = `PRICE: ₦3,000 — ₦${value.toLocaleString()}`;
                    filterWatches();
                });
            }

            btnFilter?.addEventListener('click', filterWatches);

            // BRAND FILTERING
            brandLinks.forEach(link => {
                link.addEventListener('click', event => {
                    event.preventDefault();

                    activeBrand = link.dataset.brand || 'all';

                    if (selectedCategoryText) {
                        selectedCategoryText.textContent = link.textContent.trim();
                    }

                    filterWatches();
                });
            });

            // WISHLIST
            function syncWishlist() {
                const wishlist = readStorage('zeith_wishlist').map(String);

                document.querySelectorAll('.wishlist-btn, .wishlist-heart, .wishlist-heart-btn').forEach(button => {
                    const id = String(button.dataset.id || button.getAttribute('data-id') || '');
                    const isActive = wishlist.includes(id);
                    button.classList.toggle('active', isActive);
                    if (button.classList.contains('wishlist-heart')) {
                        button.style.color = isActive ? '#e74c3c' : '#f68b1e';
                    }
                });

                const wishlistBadge = document.getElementById('wishlist-count');
                if (wishlistBadge) {
                    wishlistBadge.textContent = wishlist.length;
                    wishlistBadge.style.display = wishlist.length ? 'inline-block' : 'none';
                }
            }

            // CART BADGE
            function updateCartBadge(cart = readCart()) {
                const count = cart.reduce((sum, item) => sum + item.quantity, 0);

                if (badge) {
                    badge.textContent = count;
                    badge.style.display = count > 0 ? 'flex' : 'none';
                }

                if (drawerCount) {
                    drawerCount.textContent = `(${count})`;
                }
            }

            function openCart() {
                if (drawer && overlay) {
                    drawer.classList.add('open');
                    overlay.classList.add('open');
                    document.body.classList.add('cart-open');
                    drawer.setAttribute('aria-hidden', 'false');
                    openButton?.setAttribute('aria-expanded', 'true');
                    renderCart();
                    closeButton?.focus();
                }
            }

            function closeCart() {
                if (drawer && overlay) {
                    drawer.classList.remove('open');
                    overlay.classList.remove('open');
                    document.body.classList.remove('cart-open');
                    drawer.setAttribute('aria-hidden', 'true');
                    openButton?.setAttribute('aria-expanded', 'false');
                    openButton?.focus();
                }
            }

            function renderCart() {
                if (!itemsContainer || !subtotalElement) return;

                const cart = readCart();
                const count = cart.reduce((sum, item) => sum + item.quantity, 0);
                const subtotal = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);

                updateCartBadge(cart);

                if (cart.length === 0) {
                    itemsContainer.innerHTML = `
                        <div class="cart-empty">
                            <i class="fa-solid fa-bag-shopping"></i>
                            <h3>Your bag is waiting</h3>
                            <p>Add a luxury timepiece to get started.</p>
                        </div>
                    `;
                } else {
                    itemsContainer.innerHTML = cart.map((item, index) => `
                        <article class="cart-item" data-index="${index}">
                            <div class="cart-item-image">
                                ${item.image ? `<img src="${escapeHTML(item.image)}" alt="${escapeHTML(item.name)}">` : '<i class="fa-regular fa-clock"></i>'}
                            </div>
                            <div>
                                <span class="cart-item-brand">${escapeHTML(item.brand || 'ZEITH')}</span>
                                <h3 class="cart-item-name">${escapeHTML(item.name)}</h3>
                                <div class="cart-item-price">${money(item.price)}</div>
                                <div class="cart-item-bottom">
                                    <div class="cart-quantity">
                                        <button type="button" data-action="decrease" aria-label="Decrease quantity">−</button>
                                        <span>${item.quantity}</span>
                                        <button type="button" data-action="increase" aria-label="Increase quantity">+</button>
                                    </div>
                                    <button type="button" class="cart-remove" data-action="remove">Remove</button>
                                </div>
                            </div>
                        </article>
                    `).join('');
                }

                subtotalElement.textContent = money(subtotal);
                if (drawerCount) drawerCount.textContent = `(${count})`;
                if (checkoutButton) checkoutButton.disabled = cart.length === 0;
            }

            // Drawer listeners
            openButton?.addEventListener('click', openCart);
            closeButton?.addEventListener('click', closeCart);
            continueButton?.addEventListener('click', closeCart);
            overlay?.addEventListener('click', closeCart);

            document.addEventListener('keydown', event => {
                if (event.key === 'Escape' && drawer?.classList.contains('open')) {
                    closeCart();
                }
            });

            // CART QUANTITY & REMOVE ACTIONS
            itemsContainer?.addEventListener('click', event => {
                const button = event.target.closest('[data-action]');
                if (!button) return;

                const row = button.closest('.cart-item');
                if (!row) return;

                const index = Number(row.dataset.index);
                const cart = readCart();
                const item = cart[index];

                if (!item) return;

                switch (button.dataset.action) {
                    case 'increase':
                        const maxStock = Number(item.stock) || 10;
                        if (item.quantity + 1 > maxStock) {
                            alert(`Sorry, we only have ${maxStock} of this item in stock.`);
                            return;
                        }
                        item.quantity++;
                        break;

                    case 'decrease':
                        item.quantity--;
                        if (item.quantity <= 0) {
                            cart.splice(index, 1);
                        }
                        break;

                    case 'remove':
                        cart.splice(index, 1);
                        break;
                }

                saveCart(cart);
            });

            checkoutButton?.addEventListener('click', () => {
                if (readCart().length === 0) return;
                window.location.href = '/Watch_Collection/checkout';
            });

            // WISHLIST AND ADD-TO-CART HANDLERS
            document.addEventListener('click', event => {
                const wishlistButton = event.target.closest('.wishlist-btn, .wishlist-heart, .wishlist-heart-btn');
                const addButton = event.target.closest('.add-button, .property-add-btn');

                if (wishlistButton) {
                    const id = String(wishlistButton.dataset.id || wishlistButton.getAttribute('data-id') || '');
                    if (!id) return;

                    let wishlist = readStorage('zeith_wishlist').map(String);

                    wishlist = wishlist.includes(id) ?
                        wishlist.filter(savedId => savedId !== id) : [...wishlist, id];

                    localStorage.setItem('zeith_wishlist', JSON.stringify(wishlist));
                    syncWishlist();
                    return;
                }

                if (addButton) {
                    const card = addButton.closest('.property-card, .watch-card, .arrivals, .watch-detail');
                    if (!card) return;

                    const stock = Number(card.dataset.stock) || 10;
                    const id = String(card.dataset.id || card.getAttribute('data-id') || addButton.getAttribute('data-id') || '');

                    const watch = {
                        id,
                        name: card.querySelector('.property-card-title, .property-card-name, .watch-name, h3, h1')?.textContent.trim() || 'Watch',
                        brand: card.dataset.brand || card.querySelector('.property-card-brand, .watch-brand')?.textContent.trim() || 'ZEITH',
                        price: Number(card.dataset.price || String(card.querySelector('.property-card-price, .watch-price, .price')?.textContent || '').replace(/[^\d.]/g, '')) || 0,
                        image: card.querySelector('.property-card-image img, img')?.getAttribute('src') || '',
                        stock,
                        quantity: 1
                    };

                    if (!id || id === 'null' || id === 'undefined') return;

                    let cart = readCart();
                    const existingIndex = cart.findIndex(item => item.id === watch.id);
                    const currentQty = existingIndex !== -1 ? (Number(cart[existingIndex].quantity) || 1) : 0;

                    if (currentQty + 1 > stock) {
                        alert(`Sorry, we only have ${stock} of this item in stock.`);
                        return;
                    }

                    if (existingIndex !== -1) {
                        cart[existingIndex].quantity = currentQty + 1;
                        cart[existingIndex].name = watch.name;
                        cart[existingIndex].brand = watch.brand;
                        cart[existingIndex].price = watch.price;
                        cart[existingIndex].image = watch.image;
                        cart[existingIndex].stock = stock;
                    } else {
                        cart.push(watch);
                    }

                    saveCart(cart);

                    const oldText = addButton.textContent;
                    addButton.textContent = 'Added!';
                    window.setTimeout(() => {
                        addButton.textContent = oldText;
                    }, 900);
                }
            });

            // INITIALIZE
            syncWishlist();
            filterWatches();
            renderCart();

            // Cross-tab synchronization
            window.addEventListener('storage', event => {
                if (event.key === 'zeith_cart') renderCart();
                if (event.key === 'zeith_wishlist') syncWishlist();
            });
        });
    </script>
</body>

</html>
```