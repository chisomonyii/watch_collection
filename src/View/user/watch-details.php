<?php
// Ensure $watch and $shippingMethods are always defined to prevent linter/runtime warnings
$watch = $watch ?? [
    'id' => 1,
    'name' => 'Nautilus 5711',
    'description' => 'Porthole construction case with horizontally embossed blue dial.',
    'price' => 85000,
    'strap' => 'Interchangeable soft silicone sport strap.',
    'manual_file' => 'default-watch-manual.pdf',
    'attributes' => '[]',
    'image_url_1' => 'Nautilus_5711-removebg-preview.png',
    'image_url_2' => 'Nautilus_5711-removebg-preview.png',
    'image_url_3' => 'Nautilus_5711-removebg-preview.png',
    'image_url_4' => 'Nautilus_5711-removebg-preview.png'
];

$shippingMethods = $shippingMethods ?? [];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($watch['name'] ?? 'Watch Details') ?> - Watch Collection</title>

    <style>
        /* Base Setup */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }

        body {
            background-color: #f5f5f7;
            color: #1d1d1f;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 40px 20px;
        }

        /* Outer Layout Grid */
        .details-wrapper {
            max-width: 1200px;
            width: 100%;
            display: grid;
            grid-template-columns: 1.1fr 1fr 0.9fr;
            gap: 30px;
            align-items: start;
        }

        /* 1. Left Showcase Area */
        .showcase-column {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
        }

        .main-image-box {
            width: 100%;
            height: 380px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .main-image-box img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            filter: drop-shadow(0 20px 30px rgba(0, 0, 0, 0.15));
            transition: opacity 0.25s ease, transform 0.25s ease;
        }

        /* Thumbnail Navigation Carousel */
        .carousel-wrapper {
            display: flex;
            align-items: center;
            gap: 12px;
            width: 100%;
            justify-content: center;
            margin-bottom: 20px;
        }

        .arrow-btn {
            background: none;
            border: none;
            font-size: 1.2rem;
            color: #86868b;
            cursor: pointer;
            padding: 6px;
            transition: color 0.2s ease;
        }

        .arrow-btn:hover {
            color: #1d1d1f;
        }

        .thumbnails-container {
            display: flex;
            gap: 12px;
        }

        .thumb-card {
            width: 72px;
            height: 72px;
            background-color: #e8e8ed;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            padding: 8px;
            border: 2px solid transparent;
            transition: all 0.2s ease;
        }

        .thumb-card:hover,
        .thumb-card.active {
            background-color: #e2e2e7;
            border-color: #1d1d1f;
        }

        .thumb-card img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .pagination-dots {
            display: flex;
            gap: 6px;
            justify-content: center;
        }

        .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #d2d2d7;
            cursor: pointer;
            transition: background-color 0.2s ease, width 0.2s ease;
        }

        .dot.active {
            background-color: #1d1d1f;
            width: 10px;
        }

        /* 2. Middle Product Header Column */
        .center-column {
            display: flex;
            flex-direction: column;
            padding-top: 10px;
            width: 100%;
        }

        .title-primary {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 0.95;
            color: #1d1d1f;
            letter-spacing: -1.5px;
            text-transform: uppercase;
            margin-bottom: 24px;
        }

        .subtitle-text {
            font-size: 1.1rem;
            color: #86868b;
            line-height: 1.4;
            margin-bottom: 28px;
        }

        .price-container {
            display: flex;
            flex-direction: column;
            margin-bottom: 30px;
        }

        .price-tag {
            font-size: 3.2rem;
            font-weight: 700;
            color: #1d1d1f;
            display: flex;
            align-items: flex-start;
            line-height: 1;
        }

        .price-tag .currency {
            font-size: 1.8rem;
            font-weight: 600;
            margin-left: 4px;
            margin-top: 4px;
        }

        .shipping-note {
            font-size: 0.85rem;
            color: #86868b;
            margin-top: 6px;
            font-weight: 500;
        }

        .cta-row {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .btn-add-cart {
            background-color: #222222;
            color: #ffffff;
            border: none;
            padding: 16px 32px;
            border-radius: 30px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            text-decoration: none;
            transition: transform 0.2s ease, background-color 0.2s ease;
        }

        .btn-add-cart:hover {
            background-color: #000000;
            transform: translateY(-2px);
        }

        .wishlist-circle {
            background: none;
            border: none;
            cursor: pointer;
            color: #1d1d1f;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 8px;
            transition: transform 0.2s ease;
            flex-shrink: 0;
        }

        .wishlist-circle:hover {
            transform: scale(1.15);
        }

        .wishlist-circle.active svg {
            fill: #e67e22;
            stroke: #e67e22;
        }

        /* 3. Right Side Information Cards */
        .right-column {
            display: flex;
            flex-direction: column;
            gap: 20px;
            width: 100%;
        }

        .info-card {
            background-color: #ffffff;
            border-radius: 28px;
            padding: 28px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
        }

        /* Rating Header */
        .rating-label {
            font-size: 0.85rem;
            color: #86868b;
            margin-bottom: 4px;
        }

        .rating-score {
            font-size: 2.4rem;
            font-weight: 700;
            color: #1d1d1f;
            margin-bottom: 6px;
            line-height: 1;
        }

        .stars-row {
            color: #1d1d1f;
            font-size: 0.9rem;
            margin-bottom: 6px;
        }

        .reviews-count {
            font-size: 0.85rem;
            color: #86868b;
        }

        .divider {
            height: 1px;
            background-color: #e8e8ed;
            margin: 20px 0;
        }

        /* Feature List */
        .feature-item {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 18px;
        }

        .feature-item:last-child {
            margin-bottom: 0;
        }

        .feature-icon {
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1d1d1f;
        }

        .feature-text .title {
            font-size: 0.95rem;
            font-weight: 600;
            color: #1d1d1f;
        }

        .feature-text .sub {
            font-size: 0.8rem;
            color: #86868b;
        }

        .accordion-item {
            border-bottom: 1px solid #f0f0f2;
        }

        .accordion-item:last-child {
            border-bottom: none;
        }

        .accordion-header {
            width: 100%;
            background: none;
            border: none;
            padding: 16px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.95rem;
            font-weight: 600;
            text-align: left;
            cursor: pointer;
            color: #1d1d1f;
        }

        .accordion-icon {
            font-size: 1.1rem;
            font-weight: 400;
            color: #86868b;
            transition: transform 0.3s ease;
        }

        .chevron-right {
            font-size: 1.1rem;
            color: #86868b;
        }

        .accordion-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease, padding 0.3s ease;
            color: #6e6e73;
            font-size: 0.85rem;
            line-height: 1.5;
        }

        .accordion-item.open .accordion-content {
            max-height: 200px;
            padding-bottom: 14px;
        }

        .accordion-item.open .accordion-icon {
            transform: rotate(45deg);
        }

        /* --- SIDE DRAWER / OFF-CANVAS OVERLAY --- */
        .drawer-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.55);
            z-index: 9998;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .drawer-backdrop.active {
            opacity: 1;
            visibility: visible;
        }

        .side-drawer {
            position: fixed;
            top: 0;
            right: -450px;
            width: 420px;
            max-width: 85vw;
            height: 100vh;
            background-color: #ffffff;
            z-index: 9999;
            box-shadow: -4px 0 25px rgba(0, 0, 0, 0.15);
            transition: right 0.35s cubic-bezier(0.25, 1, 0.5, 1);
            display: flex;
            flex-direction: column;
        }

        .side-drawer.active {
            right: 0;
        }

        .drawer-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 24px 28px;
            border-bottom: 1px solid #f0f0f2;
        }

        .drawer-header h2 {
            font-size: 1.2rem;
            font-weight: 700;
            color: #1d1d1f;
        }

        .drawer-close-btn {
            background: none;
            border: 1px solid #e2e2e7;
            border-radius: 6px;
            width: 36px;
            height: 36px;
            font-size: 1.4rem;
            line-height: 1;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1d1d1f;
            transition: background-color 0.2s ease;
        }

        .drawer-close-btn:hover {
            background-color: #f5f5f7;
        }

        .drawer-body {
            padding: 28px;
            overflow-y: auto;
            flex-grow: 1;
        }

        .shipping-card {
            border: 2px solid #e2e2e7;
            border-radius: 16px;
            padding: 18px;
            margin-bottom: 16px;
            cursor: pointer;
            transition: all 0.2s ease;
            position: relative;
        }

        .shipping-card:hover {
            border-color: #86868b;
        }

        .shipping-card.selected {
            border-color: #1d1d1f;
            background-color: #f5f5f7;
        }

        .shipping-title {
            font-size: 1rem;
            font-weight: 700;
            color: #1d1d1f;
            margin-bottom: 4px;
        }

        .shipping-desc {
            font-size: 0.85rem;
            color: #86868b;
            line-height: 1.4;
            margin-bottom: 10px;
        }

        .shipping-cost {
            font-size: 0.95rem;
            font-weight: 700;
            color: #1d1d1f;
        }

        /* --- RESPONSIVE MEDIA QUERIES --- */
        @media (max-width: 1024px) {
            body {
                padding: 30px 20px;
            }

            .details-wrapper {
                grid-template-columns: 1fr 1fr;
                gap: 25px;
            }

            .showcase-column {
                grid-column: 1 / 2;
            }

            .center-column {
                grid-column: 2 / 3;
            }

            .right-column {
                grid-column: 1 / -1;
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 20px;
                margin-top: 10px;
            }

            .title-primary {
                font-size: 2.8rem;
            }

            .price-tag {
                font-size: 2.6rem;
            }
        }

        @media (max-width: 768px) {
            body {
                padding: 20px 12px;
            }

            .details-wrapper {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .showcase-column,
            .center-column,
            .right-column {
                grid-column: 1 / -1;
            }

            .right-column {
                display: flex;
                flex-direction: column;
            }

            .main-image-box {
                height: 280px;
                margin-bottom: 15px;
            }

            .thumb-card {
                width: 60px;
                height: 60px;
                border-radius: 12px;
                padding: 5px;
            }

            .carousel-wrapper {
                gap: 8px;
            }

            .title-primary {
                font-size: 2.3rem;
                letter-spacing: -1px;
                margin-bottom: 16px;
            }

            .subtitle-text {
                font-size: 0.95rem;
                margin-bottom: 20px;
            }

            .price-tag {
                font-size: 2.2rem;
            }

            .cta-row {
                width: 100%;
            }

            .btn-add-cart {
                flex-grow: 1;
                padding: 14px 20px;
                font-size: 0.95rem;
            }

            .info-card {
                padding: 20px;
                border-radius: 20px;
            }

            .side-drawer {
                width: 100vw;
                max-width: 100vw;
            }
        }
    </style>
</head>

<body>

    <div class="details-wrapper">

        <!-- 1. Left Showcase Area -->
        <div class="showcase-column">
            <div class="main-image-box">
                <img id="mainWatch" src="/Watch_Collection/assets/image/<?= htmlspecialchars($watch['image_url_1'] ?? 'Nautilus_5711-removebg-preview.png') ?>" alt="<?= htmlspecialchars($watch['name']) ?>">
            </div>

            <div class="carousel-wrapper">
                <button class="arrow-btn" id="prevSlideBtn" type="button">&lsaquo;</button>
                <div class="thumbnails-container">
                    <div class="thumb-card active" data-index="0" onclick="goToSlide(0)">
                        <img src="/Watch_Collection/assets/image/<?= htmlspecialchars($watch['image_url_1'] ?? 'Nautilus_5711-removebg-preview.png') ?>" alt="Watch view 1">
                    </div>
                    <div class="thumb-card" data-index="1" onclick="goToSlide(1)">
                        <img src="/Watch_Collection/assets/image/<?= htmlspecialchars($watch['image_url_2'] ?? $watch['image_url_1']) ?>" alt="Watch view 2">
                    </div>
                    <div class="thumb-card" data-index="2" onclick="goToSlide(2)">
                        <img src="/Watch_Collection/assets/image/<?= htmlspecialchars($watch['image_url_3'] ?? $watch['image_url_1']) ?>" alt="Watch view 3">
                    </div>
                    <div class="thumb-card" data-index="3" onclick="goToSlide(3)">
                        <img src="/Watch_Collection/assets/image/<?= htmlspecialchars($watch['image_url_4'] ?? $watch['image_url_1']) ?>" alt="Watch view 4">
                    </div>
                </div>
                <button class="arrow-btn" id="nextSlideBtn" type="button">&rsaquo;</button>
            </div>

            <div class="pagination-dots">
                <span class="dot active" onclick="goToSlide(0)"></span>
                <span class="dot" onclick="goToSlide(1)"></span>
                <span class="dot" onclick="goToSlide(2)"></span>
                <span class="dot" onclick="goToSlide(3)"></span>
            </div>
        </div>

        <!-- 2. Center Column -->
        <div class="center-column">
            <h1 class="title-primary"><?= htmlspecialchars($watch['name']) ?></h1>

            <p class="subtitle-text">
                <?php
                $fullDesc = $watch['description'] ?? '';
                // Truncate to 115 characters safely and append ellipsis if it's longer
                $shortDesc = mb_strlen($fullDesc) > 115 ? mb_substr($fullDesc, 0, 115) . '...' : $fullDesc;
                echo nl2br(htmlspecialchars($shortDesc));
                ?>
            </p>

            <div class="price-container">
                <div class="price-tag">
                    <span class="currency">₦</span><span id="displayPrice"><?= number_format($watch['price']) ?></span>
                </div>
                <div class="shipping-note" id="shippingNote">Base price (Select shipping option to update)</div>
            </div>

            <div class="cta-row">
                <button class="btn-add-cart" id="purchaseBtn" type="button">
                    Purchase this product
                </button>

                <button class="wishlist-circle" type="button" id="wishlistToggle">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- 3. Right Column -->
        <div class="right-column">

            <div class="info-card">
                <div class="rating-label">Rating</div>
                <div class="rating-score">4.8</div>
                <div class="stars-row">&#9733; &#9733; &#9733; &#9733; &#9733;</div>
                <div class="reviews-count">(1.2k reviews)</div>

                <div class="divider"></div>

                <!-- Collection Attributes Dynamic Rendering -->
                <?php
                $attributes = json_decode($watch['attributes'] ?? '[]', true);
                if (empty($attributes)) {
                    $attributes = [
                        ['title' => 'Perpetual Movement', 'sub' => 'Self-winding power'],
                        ['title' => 'Oystersteel Case', 'sub' => 'Superior scratch resistance'],
                        ['title' => 'Superlative Chronometer', 'sub' => 'Maximum precision timing']
                    ];
                }
                foreach ($attributes as $attr):
                ?>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                            </svg>
                        </div>
                        <div class="feature-text">
                            <div class="title"><?= htmlspecialchars($attr['title']) ?></div>
                            <div class="sub"><?= htmlspecialchars($attr['sub']) ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Accordions Card -->
            <div class="info-card">

                <div class="accordion-item">
                    <button class="accordion-header">
                        <span>Description</span>
                        <span class="accordion-icon">+</span>
                    </button>
                    <div class="accordion-content">
                        <p><?= htmlspecialchars($watch['description'] ?? 'Porthole construction case with horizontally embossed blue dial.') ?></p>
                    </div>
                </div>

                <div class="accordion-item">
                    <button class="accordion-header">
                        <span>Strap</span>
                        <span class="accordion-icon">+</span>
                    </button>
                    <div class="accordion-content">
                        <p><?= htmlspecialchars($watch['strap'] ?? 'Interchangeable soft silicone sport strap with secure pin-and-tuck closure mechanism.') ?></p>
                    </div>
                </div>

                <div class="accordion-item">
                    <button class="accordion-header" id="openShippingDrawer">
                        <span>Shipping</span>
                        <span class="chevron-right">&rsaquo;</span>
                    </button>
                </div>

                <div class="accordion-item">
                    <a href="/Watch_Collection/assets/manuals/<?= htmlspecialchars($watch['manual_file'] ?? 'default-watch-manual.pdf') ?>"
                        class="accordion-header"
                        download style="text-decoration: none;">
                        <span>download user manual</span>
                        <span class="chevron-right">&rsaquo;</span>
                    </a>
                </div>

            </div>

        </div>

    </div>

    <!-- Backdrop Overlay -->
    <div class="drawer-backdrop" id="shippingBackdrop"></div>

    <!-- Slide-out Side Panel -->
    <div class="side-drawer" id="shippingDrawer">
        <div class="drawer-header">
            <h2>Shipping Options</h2>
            <button class="drawer-close-btn" id="closeShippingDrawer">&times;</button>
        </div>
        <div class="drawer-body">
            <?php if (!empty($shippingMethods)): ?>
                <?php foreach ($shippingMethods as $method): ?>
                    <div class="shipping-card"
                        data-id="<?= $method['id'] ?>"
                        data-cost="<?= $method['cost'] ?? $method['price'] ?? 0 ?>"
                        data-name="<?= htmlspecialchars($method['name'] ?? 'Standard Courier') ?>"
                        onclick="selectShipping(this)">
                        <div class="shipping-title"><?= htmlspecialchars($method['name'] ?? 'Courier Shipping') ?></div>
                        <div class="shipping-desc"><?= htmlspecialchars($method['description'] ?? 'Standard delivery timeline.') ?></div>
                        <div class="shipping-cost">+ ₦<?= number_format($method['cost'] ?? $method['price'] ?? 0) ?></div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Fallback shipping options if DB table empty -->
                <div class="shipping-card" data-id="1" data-cost="2500" data-name="Standard Express Delivery" onclick="selectShipping(this)">
                    <div class="shipping-title">Standard Express Delivery</div>
                    <div class="shipping-desc">Delivered in 2-3 business days</div>
                    <div class="shipping-cost">+ ₦2,500</div>
                </div>
                <div class="shipping-card" data-id="2" data-cost="5000" data-name="VIP Same Day Courier" onclick="selectShipping(this)">
                    <div class="shipping-title">VIP Same Day Courier</div>
                    <div class="shipping-desc">Delivered within 24 hours directly</div>
                    <div class="shipping-cost">+ ₦5,000</div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // Watch and Shipping State Parameters
        const watchId = <?= json_encode($watch['id'] ?? 1) ?>;
        const basePrice = <?= json_encode((float)($watch['price'] ?? 85000)) ?>;
        let selectedShippingCost = 0;
        let selectedShippingId = null;

        // Dynamic Shipping Selection & Price Update
        function selectShipping(element) {
            document.querySelectorAll('.shipping-card').forEach(card => card.classList.remove('selected'));
            element.classList.add('selected');

            selectedShippingCost = parseFloat(element.getAttribute('data-cost')) || 0;
            selectedShippingId = element.getAttribute('data-id');
            const shippingName = element.getAttribute('data-name');

            const totalPrice = basePrice + selectedShippingCost;

            // Format number with commas
            document.getElementById('displayPrice').innerText = totalPrice.toLocaleString();
            document.getElementById('shippingNote').innerText = `Includes ${shippingName} (+₦${selectedShippingCost.toLocaleString()})`;

            // Close side panel after selection
            closeShippingPanel();
        }

        // Purchase Button Checkout Handler
        document.getElementById('purchaseBtn').addEventListener('click', function() {
            let checkoutUrl = `http://localhost/Watch_Collection/checkout?watch_id=${watchId}`;
            if (selectedShippingId) {
                checkoutUrl += `&shipping_id=${selectedShippingId}`;
            }
            window.location.href = checkoutUrl;
        });

        // Image Slideshow Carousel
        const slides = [
            "/Watch_Collection/assets/image/<?= htmlspecialchars($watch['image_url_1'] ?? 'Nautilus_5711-removebg-preview.png') ?>",
            "/Watch_Collection/assets/image/<?= htmlspecialchars($watch['image_url_2'] ?? $watch['image_url_1']) ?>",
            "/Watch_Collection/assets/image/<?= htmlspecialchars($watch['image_url_3'] ?? $watch['image_url_1']) ?>",
            "/Watch_Collection/assets/image/<?= htmlspecialchars($watch['image_url_4'] ?? $watch['image_url_1']) ?>"
        ];
        let currentIndex = 0;

        function updateSlider(index) {
            currentIndex = index;
            const mainImg = document.getElementById('mainWatch');

            mainImg.style.opacity = '0';

            setTimeout(() => {
                mainImg.src = slides[currentIndex];
                mainImg.style.opacity = '1';
            }, 150);

            const thumbCards = document.querySelectorAll('.thumb-card');
            thumbCards.forEach((card, idx) => {
                if (idx === currentIndex) {
                    card.classList.add('active');
                } else {
                    card.classList.remove('active');
                }
            });

            const dots = document.querySelectorAll('.pagination-dots .dot');
            dots.forEach((dot, idx) => {
                if (idx === currentIndex) {
                    dot.classList.add('active');
                } else {
                    dot.classList.remove('active');
                }
            });
        }

        function goToSlide(index) {
            updateSlider(index);
        }

        document.getElementById('prevSlideBtn').addEventListener('click', () => {
            let newIndex = currentIndex - 1;
            if (newIndex < 0) {
                newIndex = slides.length - 1;
            }
            updateSlider(newIndex);
        });

        document.getElementById('nextSlideBtn').addEventListener('click', () => {
            let newIndex = currentIndex + 1;
            if (newIndex >= slides.length) {
                newIndex = 0;
            }
            updateSlider(newIndex);
        });

        // Wishlist Toggle
        document.getElementById('wishlistToggle').addEventListener('click', function() {
            this.classList.toggle('active');
        });

        // Accordion Toggle
        document.querySelectorAll('.accordion-header').forEach(header => {
            header.addEventListener('click', (e) => {
                if (header.id === 'openShippingDrawer') return;

                const item = header.parentElement;
                const content = item.querySelector('.accordion-content');
                if (!content) return;

                const isOpen = item.classList.contains('open');
                item.closest('.info-card').querySelectorAll('.accordion-item').forEach(i => i.classList.remove('open'));

                if (!isOpen) {
                    item.classList.add('open');
                }
            });
        });

        // Side Drawer Controls
        const openShippingBtn = document.getElementById('openShippingDrawer');
        const closeShippingBtn = document.getElementById('closeShippingDrawer');
        const shippingDrawer = document.getElementById('shippingDrawer');
        const shippingBackdrop = document.getElementById('shippingBackdrop');

        function openShippingPanel() {
            shippingDrawer.classList.add('active');
            shippingBackdrop.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeShippingPanel() {
            shippingDrawer.classList.remove('active');
            shippingBackdrop.classList.remove('active');
            document.body.style.overflow = '';
        }

        openShippingBtn.addEventListener('click', openShippingPanel);
        closeShippingBtn.addEventListener('click', closeShippingPanel);
        shippingBackdrop.addEventListener('click', closeShippingPanel);
    </script>

</body>

</html>