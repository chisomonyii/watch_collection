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
            max-width: 1200px;
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
            margin-top: 2.2rem;
        }

        .property-title {
            border: 1px solid #e2e8f0;
            padding: 0.45rem 1.7rem;
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

        /* UPDATED TO 3-COLUMN GRID STANDARD */
        .property-details-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 28px;
            width: 100%;
            margin: 0 auto;
            padding: 10px 0;
        }

        @media (max-width: 1024px) {
            .property-details-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 24px;
            }
        }

        @media (max-width: 650px) {
            .property-details-grid {
                grid-template-columns: 1fr;
                gap: 20px;
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

        /* Top Bar inside Card */
        .card-top-bar {
            position: absolute;
            top: 22px;
            left: 22px;
            right: 22px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 10;
            pointer-events: none;
        }

        .card-top-bar>* {
            pointer-events: auto;
        }

        .status-badge {
            background: #e1f5fe;
            color: #0288d1;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .status-badge.sold-out {
            background: #fde8e8 !important;
            color: #9b1c1c !important;
        }

        /* Wishlist Heart Button */
        .wishlist-heart-btn,
        .wishlist-heart {
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
            transition: all 0.3s ease;
        }

        .wishlist-heart-btn svg,
        .wishlist-heart svg {
            width: 18px;
            height: 18px;
            fill: currentColor;
        }

        .wishlist-heart-btn:hover,
        .wishlist-heart-btn.active,
        .wishlist-heart.active {
            background: #f68b1e;
            color: #ffffff;
            transform: scale(1.08);
        }

        /* Carousel Image Container */
        .watch-image-container,
        .property-card-image {
            position: relative;
            width: 100%;
            height: 260px;
            background-color: #f8fafc;
            border-radius: 0.85rem;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-main-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: opacity 0.2s ease-in-out, transform 0.4s ease;
        }

        .property-card:hover .card-main-img {
            transform: scale(1.05);
        }

        /* Carousel Arrows */
        .carousel-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.85);
            border: none;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
            color: #0f172a;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            z-index: 5;
            opacity: 0;
            transition: opacity 0.3s ease, background 0.2s ease;
        }

        .property-card:hover .carousel-arrow {
            opacity: 1;
        }

        .carousel-arrow:hover {
            background: #ffffff;
            color: #f68b1e;
        }

        .prev-arrow {
            left: 10px;
        }

        .next-arrow {
            right: 10px;
        }

        /* Price Overlay & Progress Bar */
        .price-overlay-bar {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.75) 0%, rgba(0, 0, 0, 0.3) 70%, transparent 100%);
            padding: 20px 16px 12px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .price-display,
        .property-card-price {
            font-size: 1.15rem;
            font-weight: 800;
            color: #ffffff;
            text-align: right;
            /* Aligns the price to the right */
            width: 100%;
        }

        .progress-indicators {
            display: flex;
            gap: 4px;
            width: 100%;
        }

        .progress-bar-segment {
            flex: 1;
            height: 3px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 2px;
            transition: background 0.3s ease;
        }

        .progress-bar-segment.active {
            background: #ffffff;
        }

        /* Details Content */
        .watch-details-content,
        .property-card-details {
            padding: 1.25rem 0.25rem 0.25rem;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .watch-title-text,
        .property-card-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 0.35srem;
        }

        .watch-desc-text,
        .property-card-desc {
            font-size: 0.85rem;
            color: #64748b;
            line-height: 1.4;
            margin-bottom: 1.25rem;
            font-weight: 300;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Card Footer Actions */
        .card-footer-actions,
        .property-card-footer {
            margin-top: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 10px;
            border-top: 1px solid #f1f5f9;
        }

        .add-button,
        .property-add-btn {
            padding: 0.55rem 1.45rem;
            background-color: #f68b1e;
            color: #ffffff;
            border: none;
            border-radius: 0.5rem;
            font-weight: 600;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .add-button:hover,
        .property-add-btn:hover {
            background-color: #003b2f;
        }

        .view-details-link {
            font-size: 0.875rem;
            font-weight: 600;
            color: #f68b1e;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .view-details-link:hover {
            color: #003b2f;
            text-decoration: underline;
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
            perspective: 1000px;
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
            opacity: 0.15;
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

        @media (max-width: 768px) {
            .floating-cart {
                width: 58px;
                height: 58px;
                right: 22px;
                bottom: 22px;
                font-size: 22px;
            }
        }

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

    <?php require_once __DIR__ . '/../components/header.php'; ?>

    <div class="bg-animated-watch">
        <img src="<?php assets("image/pat-taylor-12V36G17IbQ-unsplash (1).jpg"); ?>" alt="Watch Background">
    </div>

    <div class="property-details-wrapper">

        <div class="property-details-header">
            <div class="property-title">
                <h1><?= htmlspecialchars($collectionName ?? 'Watch'); ?> Collections</h1>
            </div>
        </div>

        <div class="property-details-grid property-grid" id="collectionGrid">

            <?php if (!empty($watches)): ?>
                <?php foreach ($watches as $watch): ?>
                    <?php
                    $watchId    = htmlspecialchars((string)$watch['id']);
                    $watchName  = htmlspecialchars($watch['name']);
                    $watchBrand = htmlspecialchars($watch['brand'] ?? 'ZEITH');
                    $watchPrice = "₦" . number_format((float)($watch['price'] ?? 0));
                    $watchDesc  = htmlspecialchars($watch['description'] ?? 'Exclusive luxury timepiece.');

                    // 1. Stock & Sold Out Evaluation
                    $stock = (int)($watch['stock'] ?? 10);
                    $isSoldOut = ($stock <= 0);
                    $tag = $isSoldOut ? 'SOLD OUT' : 'AVAILABLE';
                    $badgeClass = $isSoldOut ? 'status-badge sold-out' : 'status-badge';
                    // 2. Image Path Resolver matching home.php / watch.php standard
                    // 2. Image Path Resolver supporting both public/uploads/ and assets/image/
                    $resolvePath = function ($val) {
                        $clean = trim($val ?? '');
                        if (empty($clean)) {
                            return '/Watch_Collection/assets/image/pngwing.com (1).png';
                        }
                        if (strpos($clean, 'http://') === 0 || strpos($clean, 'https://') === 0 || strpos($clean, '/') === 0) {
                            return $clean;
                        }

                        // Clean up file name string if paths were pre-attached
                        $filename = ltrim(str_replace(['/Watch_Collection/assets/image/', 'assets/image/', '/Watch_Collection/public/uploads/', 'public/uploads/'], '', $clean), '/');

                        // Check if the image exists in public/uploads/
                        $uploadPath = $_SERVER['DOCUMENT_ROOT'] . '/Watch_Collection/public/uploads/' . $filename;
                        if (file_exists($uploadPath)) {
                            return '/Watch_Collection/public/uploads/' . $filename;
                        }

                        // Fallback to assets/image/ for pre-seeded items
                        return '/Watch_Collection/assets/image/' . $filename;
                    };

                    $img1 = $resolvePath($watch['image_url_1'] ?? $watch['image_url'] ?? $watch['image'] ?? '');
                    $img2 = $resolvePath($watch['image_url_2'] ?? $watch['image_url_1'] ?? '');
                    $img3 = $resolvePath($watch['image_url_3'] ?? $watch['image_url_1'] ?? '');
                    $img4 = $resolvePath($watch['image_url_4'] ?? $watch['image_url_1'] ?? '');
                    ?>

                    <div class="property-card watch-card"
                        data-id="<?= $watchId; ?>"
                        data-brand="<?= $watchBrand; ?>"
                        data-price="<?= (float)($watch['price'] ?? 0); ?>"
                        data-stock="<?= $stock; ?>"
                        data-images='["<?= $img1 ?>", "<?= $img2 ?>", "<?= $img3 ?>", "<?= $img4 ?>"]'>

                        <!-- TOP BAR (STATUS BADGE & WISHLIST HEART) -->
                        <div class="card-top-bar">
                            <span class="<?= $badgeClass; ?>"><?= $tag; ?></span>
                            <button type="button" class="wishlist-btn wishlist-heart wishlist-heart-btn"
                                data-id="<?= $watchId; ?>"
                                title="Add to Wishlist" aria-label="Add to wishlist">
                                <svg viewBox="0 0 24 24">
                                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                </svg>
                            </button>
                        </div>

                        <!-- HERO IMAGE CONTAINER WITH CAROUSEL & OVERLAY -->
                        <div class="watch-image-container property-card-image">
                            <button class="carousel-arrow prev-arrow" type="button">&lsaquo;</button>
                            <img class="card-main-img" src="<?= $img1; ?>" alt="<?= $watchName; ?>">
                            <button class="carousel-arrow next-arrow" type="button">&rsaquo;</button>

                            <div class="price-overlay-bar">
                                <div class="price-display property-card-price"><?= $watchPrice; ?></div>
                                <div class="progress-indicators">
                                    <div class="progress-bar-segment active"></div>
                                    <div class="progress-bar-segment"></div>
                                    <div class="progress-bar-segment"></div>
                                    <div class="progress-bar-segment"></div>
                                </div>
                            </div>
                        </div>

                        <!-- CARD DETAILS CONTENT -->
                        <div class="watch-details-content property-card-details">
                            <h2 class="watch-title-text property-card-title"><?= $watchName; ?></h2>
                            <p class="watch-desc-text property-card-desc"><?= $watchDesc; ?></p>
                        </div>

                        <!-- CARD FOOTER ACTIONS -->
                        <div class="card-footer-actions property-card-footer">
                            <button type="button" class="add-button property-add-btn">Add</button>
                            <a href="/Watch_Collection/watch/details/<?= $watchId; ?>" class="view-details-link">View details &rarr;</a>
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

            // WISHLIST TOGGLE LOGIC
            function syncWishlist() {
                const wishlist = readStorage('zeith_wishlist').map(String);
                document.querySelectorAll('.wishlist-heart-btn, .wishlist-heart').forEach(btn => {
                    const card = btn.closest('.watch-card, .property-card');
                    const id = String(btn.getAttribute('data-id') || card?.getAttribute('data-id') || '');

                    const isActive = wishlist.includes(id);
                    btn.classList.toggle('active', isActive);

                    const svgPath = btn.querySelector('svg path, path');
                    if (isActive) {
                        btn.style.color = '#ff5252';
                        if (svgPath) svgPath.style.fill = '#ff5252';
                    } else {
                        btn.style.color = '';
                        if (svgPath) svgPath.style.fill = 'currentColor';
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
                                        <button type="button" data-action="decrease" aria-label="Decrease quantity">&minus;</button>
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
                        const stockLimit = Number(item.stock) || 10;
                        if (item.quantity + 1 > stockLimit) {
                            alert(`Sorry, we only have ${stockLimit} of this item in stock.`);
                            return;
                        }
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

            // 1. CAROUSEL SLIDE ARROWS LOGIC
            document.addEventListener('click', (e) => {
                const arrow = e.target.closest('.carousel-arrow');
                if (!arrow) return;

                e.stopPropagation();

                const card = arrow.closest('.watch-card, .property-card');
                if (!card) return;

                const imgEl = card.querySelector('.card-main-img');
                const bars = card.querySelectorAll('.progress-bar-segment');
                const images = JSON.parse(card.getAttribute('data-images') || '[]');

                if (!images.length) return;

                let currentIndex = parseInt(card.getAttribute('data-current-index') || '0', 10);

                if (arrow.classList.contains('next-arrow')) {
                    currentIndex = (currentIndex + 1) % images.length;
                } else if (arrow.classList.contains('prev-arrow')) {
                    currentIndex = (currentIndex - 1 + images.length) % images.length;
                }

                card.setAttribute('data-current-index', currentIndex);

                if (imgEl) {
                    imgEl.style.opacity = '0';
                    setTimeout(() => {
                        imgEl.src = images[currentIndex];
                        imgEl.style.opacity = '1';
                    }, 150);
                }

                bars.forEach((bar, idx) => {
                    bar.classList.toggle('active', idx === currentIndex);
                });
            });

            // 2. GRID INTERACTIONS (Wishlist, Sold Out Check, & Add to Cart)
            if (grid) {
                grid.addEventListener('click', (e) => {
                    const wishBtn = e.target.closest('.wishlist-heart-btn, .wishlist-heart');
                    const addButton = e.target.closest('.property-add-btn, .add-button');

                    // Wishlist toggle
                    if (wishBtn) {
                        e.preventDefault();
                        e.stopPropagation();
                        const card = wishBtn.closest('.watch-card, .property-card');
                        const watchId = String(wishBtn.getAttribute('data-id') || card?.getAttribute('data-id') || '');
                        if (!watchId) return;

                        let wishlist = readStorage('zeith_wishlist').map(String);

                        if (wishlist.includes(watchId)) {
                            wishlist = wishlist.filter(id => id !== watchId);
                        } else {
                            wishlist.push(watchId);

                            // 👉 Send API fetch to update likes_count in database for Trending section
                            fetch('/Watch_Collection/api/like-watch.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    id: watchId
                                })
                            }).catch(err => console.error('Error updating likes:', err));
                        }

                        localStorage.setItem('zeith_wishlist', JSON.stringify(wishlist));
                        window.dispatchEvent(new Event('storage'));
                        syncWishlist();
                        return;
                    }

                    // Add to bag button
                    if (addButton) {
                        e.preventDefault();
                        e.stopPropagation();

                        const card = addButton.closest('.property-card, .watch-card');
                        if (!card) return;

                        const stock = Number(card.dataset.stock) || 0;
                        const statusBadge = card.querySelector('.status-badge');
                        const isSoldOut = (stock <= 0) || (statusBadge && statusBadge.textContent.trim().toUpperCase() === 'SOLD OUT');

                        // Sold Out alert guard
                        if (isSoldOut) {
                            alert('This watch is currently Sold Out and cannot be added to your cart.');
                            return;
                        }

                        const watch = {
                            id: String(card.dataset.id || ''),
                            name: card.querySelector('.property-card-title, .watch-title-text')?.textContent.trim() || 'Watch',
                            brand: card.dataset.brand || 'ZEITH',
                            price: Number(card.dataset.price || card.querySelector('.property-card-price, .price-display')?.textContent.replace(/[^\d.]/g, '')) || 0,
                            image: card.querySelector('.card-main-img, .property-card-image img')?.getAttribute('src') || '',
                            stock: stock,
                            quantity: 1
                        };

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
                        openCart();

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

            window.addEventListener('focus', syncWishlist);
        });
    </script>

    <?php include_once __DIR__ . '/../components/cart-drawer.php'; ?>
</body>