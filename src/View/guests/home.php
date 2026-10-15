<?php

use App\Helpers;
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <style>
        /* =========================================
   ZEITH LUXURY HERO CAROUSEL BANNER
   ========================================= */

        .hero {
            position: relative;
            width: 100%;
            height: 90vh;
            min-height: 650px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background-color: #0d0f12;
            box-sizing: border-box;
            padding-top: 80px;
            /* Accounts for floating header */
        }

        /* Slide Container (PowerPoint sliding effect) */
        .hero-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            transform: translateX(100%);
            transition: transform 1.2s cubic-bezier(0.25, 1, 0.5, 1);
            z-index: 1;
        }

        .hero-slide.active {
            transform: translateX(0);
            z-index: 2;
        }

        .hero-slide.exit {
            transform: translateX(-100%);
            z-index: 1;
        }

        /* Gradient Overlay for Background Contrast */
        .hero-slide::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(180deg, rgba(13, 15, 18, 0.55) 0%, rgba(8, 10, 14, 0.85) 100%);
            z-index: 2;
        }

        /* Two-Column Grid Layout on top of background */
        .hero-content-container {
            position: relative;
            z-index: 3;
            max-width: 1250px;
            width: 100%;
            margin: 0 auto;
            padding: 0 40px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-items: center;
            gap: 60px;
            box-sizing: border-box;
        }

        /* Left Column: Typography & Button */
        .hero-text-column {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            text-align: left;
        }

        .hero-title {
            font-family: Georgia, 'Times New Roman', serif;
            font-size: 52px;
            font-weight: 400;
            line-height: 1.15;
            letter-spacing: 2px;
            color: #ffffff;
            margin: 0 0 20px 0;
            text-transform: uppercase;
        }

        .hero-description {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            font-size: 15px;
            line-height: 1.6;
            color: #d0d0d0;
            margin-bottom: 32px;
            max-width: 440px;
        }

        .hero-btn {
            display: inline-block;
            background-color: #1a1a1a;
            color: #ffffff;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 2px;
            text-decoration: none;
            text-transform: uppercase;
            padding: 16px 36px;
            border-radius: 4px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .hero-btn:hover {
            background-color: #ffffff;
            color: #1a1a1a;
            border-color: #ffffff;
            transform: translateY(-2px);
        }

        /* Right Column: Featured Watch Card */
        .hero-image-column {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .hero-watch-card {
            background: rgba(246, 245, 240, 0.95);
            border-radius: 12px;
            padding: 2px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.2);
            max-width: 300px;
            width: 100%;
            box-sizing: border-box;
            backdrop-filter: blur(10px);
        }

        .hero-watch-card img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            display: block;
            object-fit: cover;
        }

        /* Responsive Rules for Mobile/Tablet */
        @media (max-width: 968px) {
            .hero-content-container {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 40px;
                padding: 0 24px;
            }

            .hero-text-column {
                align-items: center;
                text-align: center;
            }

            .hero-title {
                font-size: 38px;
            }

            .hero-image-column {
                display: none;
                /* Hide card on smaller screens to keep clean hero focus */
            }
        }

        /* =========================================
           NEW ARRIVALS GRID
        ========================================= */

        .new {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 20px;
        }


        /* =========================================
           WATCH CARD
        ========================================= */

        .arrivals {
            position: relative;

            display: flex;
            flex-direction: column;
            justify-content: space-between;

            height: 380px;

            padding: 16px;
            padding-bottom: 50px;

            box-sizing: border-box;

            background: #ffffff;
            border-radius: 12px;
        }


        /* =========================================
           WATCH IMAGE
        ========================================= */

        .arrivals img {
            width: 100%;
            height: 180px;

            object-fit: contain;

            display: block;

            margin: 0 auto 12px;
        }


        /* =========================================
           WISHLIST HEART
        ========================================= */

        .wishlist-heart {
            position: absolute;

            top: 10px;
            right: 10px;

            width: 38px;
            height: 38px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: #ffffff;

            border-radius: 50%;

            color: #f68b1e;

            font-size: 21px;

            cursor: pointer;

            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.12);

            z-index: 5;

            transition: all 0.3s ease;
        }


        .wishlist-heart:hover {
            background: #f68b1e;
            color: white;

            transform: scale(1.08);
        }


        /* =========================================
           ADD BUTTON
        ========================================= */

        .add-button {
            position: absolute;

            bottom: 12px;
            left: 12px;

            background: #f68b1e;
            color: black;

            border: none;

            padding: 6px 18px;

            border-radius: 20px;

            font-weight: 600;
            font-size: 0.85rem;

            cursor: pointer;

            transition:
                background-color 0.2s ease,
                transform 0.1s ease;

            z-index: 5;
        }


        .add-button:hover {
            background: black;
            color: white;

            transform: translateY(-1px);
        }


        /* =========================================
           FIXED SHOPPING CART
        ========================================= */

        /* Floating Cart */
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

            .hero-text-column {
                align-items: center;
                text-align: center;
                margin-top: 36px;
            }
        }
    </style>


    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <script
        src="https://kit.fontawesome.com/69c405441a.js"
        crossorigin="anonymous">
    </script>

    <link rel="stylesheet"
        href="<?php assets("css/login.css"); ?>">

    <link rel="stylesheet"
        href="<?php assets("css/header.css"); ?>">

    <link rel="stylesheet"
        href="<?php assets("css/footer.css"); ?>">

    <title>Watch Collection</title>

</head>


<body>


    <?php require_once __DIR__ . '/../components/header.php'; ?>


    <!-- =========================================
         HERO SECTION
    ========================================= -->

    <section class="hero">
        <!-- Slide 1 -->
        <div class="hero-slide active" style="background-image: url('<?php assets("image/banner/banner1.jpg"); ?>');"></div>

        <!-- Slide 2 (Replace with your 2nd watch image filename) -->
        <div class="hero-slide" style="background-image: url('<?php assets("image/banner/banner2.jpg"); ?>');"></div>

        <!-- Slide 3 (Replace with your 3rd watch image filename) -->
        <div class="hero-slide" style="background-image: url('<?php assets("image/banner/banner3.jpg"); ?>');"></div>

        <!-- Slide 4 (Replace with your 4th watch image filename) -->
        <div class="hero-slide" style="background-image: url('<?php assets("image/banner/banner4.jpg"); ?>');"></div>

        <!-- Slide 5 (Replace with your 5th watch image filename) -->
        <div class="hero-slide" style="background-image: url('<?php assets("image/banner/Zeith2.png"); ?>');"></div>

        <div class="hero-content-container">

            <!-- Left Column: Text & Button -->
            <div class="hero-text-column">
                <h1 class="hero-title">Watch<br>Collection</h1>
                <p class="hero-description">Discover precision timepieces crafted with exceptional luxury, sophisticated engineering, and timeless style.</p>
                <a href="/Watch_Collection/collection" class="hero-btn">See Products</a>
            </div>

            <!-- Right Column: Watch Showcase Card -->
            <div class="hero-image-column">
                <div class="hero-watch-card">
                    <img src="<?php assets("image/banner/Zeith2.png"); ?>" alt="Featured Zeith Watch">
                </div>
            </div>

        </div>
    </section>



    <!-- =========================================
         NEW ARRIVALS
    ========================================= -->

    <section class="new-arrivals">

        <h1 class="new-arrhead">
            New Arrivals!!
        </h1>

        <div class="new">
            <?php if (!empty($newArrivals)): ?>

                <?php foreach ($newArrivals as $product): ?>

                    <?php
                    // 1. Fetch image string from database
                    $imgVal = trim($product['image_url'] ?? $product['image'] ?? '');

                    // 2. Dual Option Logic (Option A: Web URL | Option B: Local VS Code Assets)
                    if (strpos($imgVal, 'http://') === 0 || strpos($imgVal, 'https://') === 0) {
                        // OPTION A: Online Web Link
                        $imagePath = $imgVal;
                    } elseif (!empty($imgVal)) {
                        // OPTION B: Downloaded Image in Watch_Collection/assets/image
                        $imagePath = '/Watch_Collection/assets/image/' . ltrim($imgVal, '/');
                    } else {
                        // Fallback default placeholder
                        $imagePath = '/Watch_Collection/assets/image/placeholder.jpg';
                    }
                    ?>

                    <div class="arrivals watch-card"
                        data-id="<?= htmlspecialchars($product['id'] ?? ''); ?>"
                        data-brand="<?= htmlspecialchars($product['collection_name'] ?? $product['brand'] ?? 'ZEITH'); ?>"
                        data-price="<?= htmlspecialchars((string)($product['price'] ?? 0)); ?>"
                        data-stock="<?= (int)($product['stock'] ?? 10); ?>">

                        <!-- WISHLIST HEART -->
                        <div class="wishlist-heart" title="Add to wishlist">
                            <i class="fa-regular fa-heart"></i>
                        </div>

                        <!-- WATCH IMAGE (Supports both Web URLs & Local Files) -->
                        <img src="<?= htmlspecialchars($imagePath); ?>"
                            alt="<?= htmlspecialchars($product['name'] ?? 'Watch'); ?>"
                            onerror="this.src='/Watch_Collection/assets/image/placeholder.jpg';" />

                        <!-- WATCH INFORMATION -->
                        <span class="watch-info">
                            <h2>
                                <?= htmlspecialchars($product['brand'] ?? $product['collection_name'] ?? 'ZEITH'); ?>
                            </h2>

                            <p class="watch-name">
                                <?= htmlspecialchars($product['name'] ?? ''); ?>
                            </p>

                            <p class="watch-price">
                                &#8358;<?= number_format((float)($product['price'] ?? 0)); ?>
                            </p>

                            <!-- ADD BUTTON -->
                            <button class="add-button" type="button">Add</button>
                        </span>

                    </div>

                <?php endforeach; ?>

            <?php endif; ?>
        </div>


        <button class="arrive-btn search-btn">
            View all
        </button>

    </section>



    <!-- =========================================
         COLLECTIONS
    ========================================= -->

    <section class="collections">

        <div class="section-heading">

            <p>
                EXPLORE ZEITH
            </p>

            <h2>
                Find Your Timepiece
            </h2>

        </div>


        <div class="collection-grid">


            <div class="collection-card">

                <img
                    src="<?php assets("Images/picture11.png"); ?>"
                    alt="Classic Watch">

                <div class="collection-content">

                    <p>
                        01
                    </p>

                    <h3>
                        The Classic
                    </h3>

                    <span>
                        Timeless elegance
                    </span>

                    <a
                        href="#"
                        class="search-btn exp">
                        Explore
                    </a>

                </div>

            </div>



            <div class="collection-card">

                <img
                    src="<?php assets("Images/picture12.png"); ?>"
                    alt="Chronograph Watch">

                <div class="collection-content">

                    <p>
                        02
                    </p>

                    <h3>
                        The Chrono
                    </h3>

                    <span>
                        Built for precision
                    </span>

                    <a
                        href="#"
                        class="search-btn exp">
                        Explore
                    </a>

                </div>

            </div>



            <div class="collection-card">

                <img
                    src="<?php assets("Images/picture13.png"); ?>"
                    alt="Executive Watch">

                <div class="collection-content">

                    <p>
                        03
                    </p>

                    <h3>
                        The Executive
                    </h3>

                    <span>
                        Made to impress
                    </span>

                    <a
                        href="#"
                        class="search-btn exp">
                        Explore
                    </a>

                </div>

            </div>


        </div>

    </section>



    <!-- =========================================
         BEST SELLERS
    ========================================= -->

    <section class="best-sellers">

        <div class="section-heading">

            <p>
                MOST WANTED
            </p>

            <h2>
                Best Sellers
            </h2>

        </div>


        <div class="product-grid">


            <article class="product-card">

                <div class="product-image">

                    <img
                        src="<?php assets("Images/picture6.png"); ?>"
                        alt="Zeith Classic">

                </div>


                <div class="product-info">

                    <p>
                        ZEITH
                    </p>

                    <h3>
                        Classic Black
                    </h3>

                    <span>
                        ₦85,000
                    </span>

                    <a
                        href="#"
                        class="btn-view search-btn exp">
                        View Watch
                    </a>

                </div>

            </article>



            <article class="product-card">

                <div class="product-image">

                    <img
                        src="<?php assets("Images/picture11.png"); ?>"
                        alt="Zeith Chrono">

                </div>


                <div class="product-info">

                    <p>
                        ZEITH
                    </p>

                    <h3>
                        Chrono Silver
                    </h3>

                    <span>
                        ₦95,000
                    </span>

                    <a
                        href="#"
                        class="btn-view search-btn exp">
                        View Watch
                    </a>

                </div>

            </article>



            <article class="product-card">

                <div class="product-image">

                    <img
                        src="<?php assets("Images/picture4.png"); ?>"
                        alt="Zeith Executive">

                </div>


                <div class="product-info">

                    <p>
                        ZEITH
                    </p>

                    <h3>
                        Executive Gold
                    </h3>

                    <span>
                        ₦110,000
                    </span>

                    <a
                        href="#"
                        class="btn-view search-btn exp">
                        View Watch
                    </a>

                </div>

            </article>


        </div>

    </section>



    <!-- =========================================
         ZEITH STORY
    ========================================= -->

    <section class="story">

        <div class="story-image">

            <img
                src="<?php assets("Images/picture2.png"); ?>"
                alt="Zeith Watch">

        </div>


        <div class="story-text">

            <p class="story-pp">
                THE ZEITH STORY
            </p>

            <h2>
                More Than A Watch.
                <span>
                    A Statement.
                </span>
            </h2>

            <p class="story-p">

                At Zeith, we believe a watch should be
                more than something that tells time.
                It should represent your style, ambition
                and the moments that matter.

            </p>

            <a
                href="#"
                class="btn-view exp search-btn">
                Discover Zeith
            </a>

        </div>

    </section>



    <!-- =========================================
         WHY ZEITH
    ========================================= -->

    <section class="why-zeith">

        <div class="section-heading">

            <p>
                THE ZEITH STANDARD
            </p>

            <h2>
                Why Choose Zeith ?
            </h2>

        </div>


        <div class="features">


            <div class="feature">

                <i class="fa-regular fa-clock icon"></i>

                <h3>
                    Precision
                </h3>

                <p>
                    Designed with attention to every detail.
                </p>

            </div>



            <div class="feature">

                <i class="fa-solid fa-shield-halved icon"></i>

                <h3>
                    Warranty
                </h3>

                <p>
                    Confidence comes standard with every watch
                    <span class="featuree">
                        comes with a 2yr guarantee
                    </span>.
                </p>

            </div>



            <div class="feature">

                <i class="fa-solid fa-truck-fast icon"></i>

                <h3>
                    Fast Delivery
                </h3>

                <p>
                    Your timepiece delivered safely to you
                    anywhere in Nigeria.
                </p>

            </div>



            <div class="feature">

                <i class="fa-solid fa-lock icon"></i>

                <h3>
                    Secure Payment
                </h3>

                <p>
                    Shop with confidence through secure checkout.
                </p>

            </div>


        </div>

    </section>



    <!-- =========================================
         PROMO
    ========================================= -->

    <section class="promo">

        <div class="promo-content">

            <p class="story-pp">
                THE ZEITH EXPERIENCE
            </p>

            <h2>
                TIME
                <span>
                    IS YOURS.
                </span>
            </h2>

            <p class="promp">
                Wear every moment with confidence.
            </p>

            <a
                href="#"
                class="btn-shop exp search-btn">
                Shop Now
            </a>

        </div>

    </section>



    <!-- =========================================
         REVIEWS
    ========================================= -->

    <section class="reviews">

        <div class="section-heading">

            <p>
                FROM OUR CUSTOMERS
            </p>

            <h2>
                What They Say
            </h2>

        </div>


        <div class="review-grid">


            <div class="review">

                <div class="stars">
                    ★★★★★
                </div>

                <p>
                    "The watch looks even better in person.
                    Really clean design."
                </p>

                <h4>
                    — David O.
                </h4>

            </div>



            <div class="review">

                <div class="stars">
                    ★★★★★
                </div>

                <p>
                    "Simple, elegant and exactly what I wanted."
                </p>

                <h4>
                    — Michael A.
                </h4>

            </div>



            <div class="review">

                <div class="stars">
                    ★★★★★
                </div>

                <p>
                    "The quality for the price is impressive."
                </p>

                <h4>
                    — Daniel K.
                </h4>

            </div>


        </div>

    </section>



    <?php View::displayComponent('footer.php'); ?>



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





    <!-- =========================================
         JAVASCRIPT
    ========================================= -->


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const $ = (selector) => document.querySelector(selector);

            const drawer = $('#cart-drawer');
            const overlay = $('#cart-overlay');
            const openButton = $('#open-cart');
            const closeButton = $('#close-cart');
            const continueButton = $('#continue-shopping');
            const itemsContainer = $('#cart-items');
            const subtotalElement = $('#cart-subtotal');
            const badge = $('#cart-count');
            const drawerCount = $('#drawer-item-count');
            const checkoutButton = $('#checkout-button');

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

            function updateWishlistBadge() {
                const wishlistBadge = $('#wishlist-count');
                if (!wishlistBadge) return;

                const wishlist = readStorage('zeith_wishlist').map(String);
                wishlistBadge.textContent = wishlist.length;
                wishlistBadge.style.display =
                    wishlist.length ? 'inline-block' : 'none';
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
                if (!drawer || !overlay) return;
                drawer.classList.add('open');
                overlay.classList.add('open');
                document.body.classList.add('cart-open');

                drawer.setAttribute('aria-hidden', 'false');
                openButton?.setAttribute('aria-expanded', 'true');

                renderCart();
                closeButton?.focus();
            }

            function closeCart() {
                if (!drawer || !overlay) return;
                drawer.classList.remove('open');
                overlay.classList.remove('open');
                document.body.classList.remove('cart-open');

                drawer.setAttribute('aria-hidden', 'true');
                openButton?.setAttribute('aria-expanded', 'false');
                openButton?.focus();
            }

            function renderCart() {
                const cart = readCart();
                const count = cart.reduce((sum, item) => sum + item.quantity, 0);
                const subtotal = cart.reduce(
                    (sum, item) => sum + item.price * item.quantity,
                    0
                );

                updateCartBadge(cart);

                if (cart.length === 0) {
                    if (itemsContainer) {
                        itemsContainer.innerHTML = `
                            <div class="cart-empty">
                                <i class="fa-solid fa-bag-shopping"></i>
                                <h3>Your bag is waiting</h3>
                                <p>Add a luxury timepiece to get started.</p>
                            </div>
                        `;
                    }
                } else if (itemsContainer) {
                    itemsContainer.innerHTML = cart.map((item, index) => `
                        <article class="cart-item" data-index="${index}">
                            <div class="cart-item-image">
                                ${
                                    item.image
                                        ? `<img src="${escapeHTML(item.image)}" alt="${escapeHTML(item.name)}">`
                                        : '<i class="fa-regular fa-clock"></i>'
                                }
                            </div>
                            <div>
                                <span class="cart-item-brand">
                                    ${escapeHTML(item.brand || 'ZEITH')}
                                </span>
                                <h3 class="cart-item-name">
                                    ${escapeHTML(item.name)}
                                </h3>
                                <div class="cart-item-price">
                                    ${money(item.price)}
                                </div>
                                <div class="cart-item-bottom">
                                    <div class="cart-quantity">
                                        <button type="button"
                                                data-action="decrease"
                                                aria-label="Decrease quantity">−</button>
                                        <span>${item.quantity}</span>
                                        <button type="button"
                                                data-action="increase"
                                                aria-label="Increase quantity">+</button>
                                    </div>
                                    <button type="button"
                                            class="cart-remove"
                                            data-action="remove">Remove</button>
                                </div>
                            </div>
                        </article>
                    `).join('');
                }

                if (subtotalElement) subtotalElement.textContent = money(subtotal);
                if (drawerCount) drawerCount.textContent = `(${count})`;
                if (checkoutButton) checkoutButton.disabled = cart.length === 0;
            }

            /* Open and close drawer listeners */
            openButton?.addEventListener('click', openCart);
            closeButton?.addEventListener('click', closeCart);
            continueButton?.addEventListener('click', closeCart);
            overlay?.addEventListener('click', closeCart);

            document.addEventListener('keydown', event => {
                if (event.key === 'Escape' && drawer?.classList.contains('open')) {
                    closeCart();
                }
            });

            /* Wishlist listeners */
            document.querySelectorAll('.arrivals, .watch-card, .property-card').forEach(card => {
                const id = String(card.dataset.id || card.getAttribute('data-id') || '');
                const heart = card.querySelector('.wishlist-heart, .wishlist-heart-btn');

                if (!heart || !id) return;

                const wishlist = readStorage('zeith_wishlist').map(String);
                if (wishlist.includes(id)) {
                    heart.classList.add('active');
                    heart.style.color = '#e74c3c';
                }

                heart.addEventListener('click', event => {
                    event.stopPropagation();
                    let saved = readStorage('zeith_wishlist').map(String);

                    if (saved.includes(id)) {
                        saved = saved.filter(savedId => savedId !== id);
                        heart.classList.remove('active');
                        heart.style.color = '#f68b1e';
                    } else {
                        saved.push(id);
                        heart.classList.add('active');
                        heart.style.color = '#e74c3c';
                    }

                    localStorage.setItem('zeith_wishlist', JSON.stringify(saved));
                    updateWishlistBadge();
                });
            });

            const slides = document.querySelectorAll('.hero-slide');
            let currentSlide = 0;
            const slideInterval = 5000; // Changes background slide every 5 seconds

            function nextSlide() {
                slides[currentSlide].classList.remove('active');
                slides[currentSlide].classList.add('exit');

                let previousSlide = currentSlide;
                currentSlide = (currentSlide + 1) % slides.length;

                setTimeout(() => {
                    slides[previousSlide].classList.remove('exit');
                }, 1200);

                slides[currentSlide].classList.add('active');
            }

            if (slides.length > 0) {
                setInterval(nextSlide, slideInterval);
            }

            /* Add to Bag handler with Stock limit check */
            document.querySelectorAll('.add-button, .property-add-btn').forEach(button => {
                button.addEventListener('click', event => {
                    event.preventDefault();
                    event.stopPropagation();

                    const card = button.closest('.arrivals, .watch-card, .property-card');
                    if (!card) return;

                    const stock = Number(card.dataset.stock) || 10;
                    const id = String(card.dataset.id || card.getAttribute('data-id') || '');

                    const nameElement = card.querySelector(
                        '.property-card-title, .property-card-name, .watch-name, .arrivals-name, h3, h4'
                    );
                    const brandElement = card.querySelector(
                        '.watch-info h2, .property-card-brand, .watch-brand, .arrivals-brand, .brand'
                    );
                    const imageElement = card.querySelector('img');
                    const priceElement = card.querySelector(
                        '.property-card-price, .watch-price, .price'
                    );

                    const rawPrice = card.dataset.price || (priceElement ? priceElement.textContent : '');
                    const price = Number(String(rawPrice).replace(/[^\d.]/g, '')) || 0;
                    const name = nameElement ? nameElement.textContent.trim() : 'Watch';
                    const brand = card.dataset.brand || (brandElement ? brandElement.textContent.trim() : 'ZEITH');
                    const image = imageElement ? imageElement.getAttribute('src') || '' : '';

                    if (!id || id === 'null' || id === 'undefined') return;

                    const cart = readCart();
                    const existing = cart.find(item => item.id === id);
                    const currentQty = existing ? Number(existing.quantity) : 0;

                    // STOCK CHECK
                    if (currentQty + 1 > stock) {
                        alert(`Sorry, we only have ${stock} of this item in stock.`);
                        return;
                    }

                    if (existing) {
                        existing.quantity = currentQty + 1;
                        existing.name = name;
                        existing.brand = brand;
                        existing.price = price;
                        existing.image = image;
                        existing.stock = stock;
                    } else {
                        cart.push({
                            id,
                            name,
                            brand,
                            price,
                            image,
                            stock,
                            quantity: 1
                        });
                    }

                    saveCart(cart);

                    const oldText = button.textContent;
                    button.textContent = 'Added!';
                    window.setTimeout(() => {
                        button.textContent = oldText;
                    }, 900);
                });
            });

            /* Cart Quantity controls inside drawer (+ / - / Remove) */
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
                            alert(`Sorry, only ${stockLimit} available in stock.`);
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

                    default:
                        return;
                }

                saveCart(cart);
            });

            /* Checkout handler */
            checkoutButton?.addEventListener('click', () => {
                if (readCart().length === 0) return;
                window.location.href = '/Watch_Collection/checkout';
            });

            /* Cross-tab storage listener */
            window.addEventListener('storage', event => {
                if (event.key === 'zeith_cart') renderCart();
                if (event.key === 'zeith_wishlist') updateWishlistBadge();
            });

            /* Initial Setup */
            updateWishlistBadge();
            renderCart();
        });
    </script>



</body>

</html>