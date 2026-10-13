<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/69c405441a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?php assets("css/login.css"); ?>">
    <link rel="stylesheet" href="<?php assets("css/style.css"); ?>">
    <title><?= htmlspecialchars($collectionName ?? 'Collection'); ?> - Zeith</title>

    <style>
        .property-details-body {
            background-color: #fafafa;
            min-height: 100vh;
            padding: 3rem 2rem;
            position: relative;
            overflow-x: hidden;
            background-color: #05070a;
        }

        .property-details-wrapper {
            max-width: 1280px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        /* Header Section */
        .property-details-header {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 3.5rem;
        }

        .property-title {
            border: 1px solid #e2e8f0;
            padding: 0.55rem 2.0rem;
            border-radius: 999px;
            background-color: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
        }

        .property-title h1 {
            font-family: Georgia, 'Times New Roman', serif;
            font-size: 1.2rem;
            font-weight: 600;
            color: #0f172a;
            letter-spacing: 0.02em;
        }

        .property-details-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
        }

        @media (max-width: 1100px) {
            .property-details-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .property-details-grid {
                grid-template-columns: 1fr;
            }

            .property-details-header {
                flex-direction: column;
                gap: 1rem;
            }

            .property-title h1 {
                font-size: 1.5rem;
            }
        }

        /* Card Component */
        .property-card {
            position: relative;
            /* <-- Add this line */
            background: #ffffff;
            border: 1px solid #f1f5f9;
            border-radius: 1.25rem;
            padding: 1rem;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.03);
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .property-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 30px -10px rgba(0, 0, 0, 0.08);
        }

        .property-card-image {
            width: 100%;
            height: 200px;
            background-color: #000000;
            border-radius: 0.85rem;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .property-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .property-card:hover .property-card-image img {
            transform: scale(1.05);
        }

        .property-card-details {
            padding: 1.25rem 0.25rem 0.25rem;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .property-card-title {
            font-size: 1.05rem;
            font-weight: 700;
            color: #fc8b1e;
            margin-bottom: 0.35rem;
        }

        .property-card-desc {
            font-size: 0.825rem;
            color: #64748b;
            line-height: 1.4;
            margin-bottom: 1.5rem;
            font-weight: 300;
        }

        .property-stars {
            color: #fc8b1e;
            font-size: 0.875rem;
        }

        .property-card-footer {
            margin-top: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .property-card-price {
            font-size: 1.05rem;
            font-weight: 700;
            color: #0f172a;
        }

        .property-add-btn {
            padding: 0.45rem 1.25rem;
            background-color: #cbd5e1;
            color: #334155;
            border: none;
            border-radius: 0.5rem;
            font-weight: 600;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .property-add-btn:hover {
            background-color: #fc8b1e;
            color: #ffffff;
        }

        .bg-animated-watch {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: 1;
            pointer-events: none;
            overflow: hidden;
            /* Subtle visibility for dark or light backgrounds */
            perspective: 1000px;
            /* Establishes depth perception */
            background: radial-gradient(circle at center,
                    rgba(15, 23, 42, 0.8) 0%,
                    rgba(5, 7, 10, 0.95) 70%,
                    #05070a 100%);
        }

        .bg-animated-watch img {
            width: 140%;
            height: 140%;
            object-fit: cover;
            position: absolute;
            top: -20%;
            left: -20%;
            transform-style: preserve-3d;
            animation: float3D 22s ease-in-out infinite alternate;
            opacity: 5.12;
        }



        @keyframes float3D {
            0% {
                transform: translate3d(0px, 0px, 0px) rotateX(0deg) rotateY(0deg) rotateZ(0deg) scale(1);
            }

            25% {
                transform: translate3d(40px, -30px, 60px) rotateX(14deg) rotateY(-10deg) rotateZ(5deg) scale(1.05);
            }

            50% {
                transform: translate3d(-30px, 40px, -40px) rotateX(-12deg) rotateY(15deg) rotateZ(-8deg) scale(1.1);
            }

            75% {
                transform: translate3d(20px, -20px, 80px) rotateX(10deg) rotateY(-14deg) rotateZ(6deg) scale(1.05);
            }

            100% {
                transform: translate3d(-40px, -40px, 10px) rotateX(-8deg) rotateY(8deg) rotateZ(-4deg) scale(1.12);
            }
        }

        .wishlist-heart-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #ffffff;
            border: none;
            color: #f68b1e;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.12);
            z-index: 5;
            transition: all 0.3s ease;
        }

        .wishlist-heart-btn:hover,
        .wishlist-heart-btn.active {
            background: #f68b1e;
            color: #ffffff;
            transform: scale(1.08);
        }

        .no-watches-msg {
            grid-column: 1 / -1;
            text-align: center;
            padding: 60px 20px;
            font-size: 1.5rem;
            font-weight: 900;
            color: #f68b1e;
        }

        /* Fixed floating cart icon */
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

<body class="property-details-body">

    <div class="bg-animated-watch">
        <img src="<?php assets("image/pat-taylor-12V36G17IbQ-unsplash (1).jpg"); ?>" alt="Watch Background">
    </div>

    <div class="property-details-wrapper">

        <div class="property-details-header">
            <div class="property-title">
                <h1><?= htmlspecialchars($collectionName ?? 'Watch'); ?> Collections</h1>
            </div>
        </div>

        <div class="property-details-grid" id="collectionGrid">

            <?php if (!empty($watches)): ?>
                <?php foreach ($watches as $watch): ?>
                    <div class="property-card" data-id="<?= htmlspecialchars($watch['id']); ?>">

                        <!-- WISHLIST BUTTON -->
                        <button class="wishlist-heart-btn" data-id="<?= htmlspecialchars($watch['id']); ?>" title="Add to Wishlist">
                            <i class="fa-solid fa-heart"></i>
                        </button>

                        <div class="property-card-image">
                            <img src="<?php assets($watch['image_url'] ?? $watch['image'] ?? 'image/pngwing.com (10).png'); ?>" alt="<?= htmlspecialchars($watch['name']); ?>">
                        </div>

                        <div class="property-card-details">
                            <h3 class="property-card-title"><?= htmlspecialchars($watch['name']); ?></h3>
                            <p class="property-card-desc"><?= htmlspecialchars($watch['description'] ?? 'Exclusive luxury timepiece.'); ?></p>

                            <div class="property-card-rating">
                                <span class="property-stars">★★★★★</span>
                                <span class="property-rating-score">(<?= htmlspecialchars($watch['rating'] ?? '5.0'); ?>)</span>
                            </div>

                            <div class="property-card-footer">
                                <span class="property-card-price">₦<?= number_format($watch['price'] ?? 0, 2); ?></span>
                                <button class="property-add-btn" type="button">Add</button>
                            </div>
                        </div>

                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="no-watches-msg">
                    <p>No watches found in the <?= htmlspecialchars($collectionName ?? 'selected'); ?> collection.</p>
                </div>
            <?php endif; ?>

        </div>
    </div>

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
            const grid = document.getElementById('collectionGrid');

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

            // WISHLIST TOGGLE LOGIC
            function syncWishlist() {
                const wishlist = readStorage('zeith_wishlist').map(String);
                document.querySelectorAll('.wishlist-heart-btn').forEach(btn => {
                    const id = String(btn.getAttribute('data-id'));
                    if (wishlist.includes(id)) {
                        btn.classList.add('active');
                    } else {
                        btn.classList.remove('active');
                    }
                });
            }

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

            // Drawer event listeners
            openButton?.addEventListener('click', openCart);
            closeButton?.addEventListener('click', closeCart);
            continueButton?.addEventListener('click', closeCart);
            overlay?.addEventListener('click', closeCart);

            document.addEventListener('keydown', event => {
                if (event.key === 'Escape' && drawer?.classList.contains('open')) {
                    closeCart();
                }
            });

            // Cart quantity changes & item removal
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
                        item.quantity++;
                        break;
                    case 'decrease':
                        item.quantity--;
                        if (item.quantity <= 0) cart.splice(index, 1);
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

            // GRID INTERACTIONS (Wishlist & Add to Cart)
            if (grid) {
                grid.addEventListener('click', (e) => {
                    const wishBtn = e.target.closest('.wishlist-heart-btn');
                    const addButton = e.target.closest('.property-add-btn');

                    // Wishlist toggle
                    if (wishBtn) {
                        const watchId = String(wishBtn.getAttribute('data-id'));
                        let wishlist = readStorage('zeith_wishlist').map(String);

                        if (wishlist.includes(watchId)) {
                            wishlist = wishlist.filter(id => id !== watchId);
                        } else {
                            wishlist.push(watchId);
                        }

                        localStorage.setItem('zeith_wishlist', JSON.stringify(wishlist));
                        syncWishlist();
                        return;
                    }

                    // Add to bag button
                    if (addButton) {
                        const card = addButton.closest('.property-card');
                        if (!card) return;

                        const nameElement = card.querySelector('.property-card-title');
                        const priceElement = card.querySelector('.property-card-price');
                        const imageElement = card.querySelector('.property-card-image img');

                        const rawPrice = priceElement ? priceElement.textContent : '0';
                        const price = Number(rawPrice.replace(/[^\d.]/g, '')) || 0;

                        const watch = {
                            id: String(card.dataset.id || ''),
                            name: nameElement ? nameElement.textContent.trim() : 'Watch',
                            brand: 'ZEITH',
                            price: price,
                            image: imageElement ? imageElement.getAttribute('src') : '',
                            quantity: 1
                        };

                        let cart = readCart();
                        const existingIndex = cart.findIndex(item => item.id === watch.id);

                        if (existingIndex !== -1) {
                            cart[existingIndex].quantity = (Number(cart[existingIndex].quantity) || 1) + 1;
                            cart[existingIndex].name = watch.name;
                            cart[existingIndex].price = watch.price;
                            cart[existingIndex].image = watch.image;
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
            }

            // Initializations
            syncWishlist();
            updateCartBadge();
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