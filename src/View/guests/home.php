<?php

use App\Helpers\View;
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
        /* New Arrivals Section Layout */
        .new-arrivals {
            width: 100%;
            padding: 40px 5%;
            background-color: #f9f9f9;
            /* Adjust background if you use a dark theme */
        }

        .new-arrhead {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 30px;
            font-weight: bold;
        }

        .new {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 25px;
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
        }

        @media (max-width: 768px) {

            /* Ensure 2 items per row with a tighter gap */
            .new {
                display: grid;
                grid-template-columns: repeat(1, 1fr) !important;
                gap: 10px !important;
                padding: 0 8px;
            }
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
            background: black;
            color: white;

            transform: scale(1.08);
        }

        /* Base unselected state for wishlist buttons */
        .wishlist-heart-btn,
        .wishlist-heart,
        .wishlist-btn {
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
            color: #94a3b8;
            /* Neutral grey when NOT highlighted */
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.12);
            z-index: 10;
            transition: all 0.3s ease;
        }

        .wishlist-heart-btn svg,
        .wishlist-heart svg,
        .wishlist-btn svg {
            width: 18px;
            height: 18px;
            fill: currentColor;
        }

        /* Hover state */
        .wishlist-heart-btn:hover,
        .wishlist-heart:hover,
        .wishlist-btn:hover {
            color: #f68b1e;
            transform: scale(1.08);
        }

        /* ACTIVE HIGHLIGHTED STATE ONLY */
        .wishlist-heart-btn.active,
        .wishlist-heart.active,
        .wishlist-btn.active {
            background: #f68b1e !important;
            color: #ffffff !important;
            transform: scale(1.05);
        }

        .wishlist-heart-btn.active svg path,
        .wishlist-heart.active svg path,
        .wishlist-btn.active svg path {
            fill: #ffffff !important;
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
                margin-top: 166px;
            }
        }

        .review-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            padding: 40px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .review {
            background: #ffffff;
            padding: 35px 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            position: relative;
            border: 1px solid rgba(0, 0, 0, 0.04);
        }

        /* Give each card a slight organic tilt/bend vibe matching your layout */
        .review-grid .review:nth-child(1) {
            transform: rotate(-2deg) translateY(10px);
        }

        .review-grid .review:nth-child(2) {
            transform: rotate(1deg) translateY(-5px);
        }

        .review-grid .review:nth-child(3) {
            transform: rotate(2deg) translateY(12px);
        }

        /* Interactive hover state to lift and straighten the card */
        .review-grid .review:hover {
            transform: rotate(0deg) translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
            border-color: rgba(212, 143, 56, 0.3);
            /* subtle accent glow on hover */
        }

        .review .stars {
            color: #d48f38;
            font-size: 1.1rem;
            margin-bottom: 15px;
            letter-spacing: 2px;
        }

        .review p {
            font-size: 1.05rem;
            line-height: 1.6;
            color: #2c2c2c;
            margin-bottom: 20px;
            font-style: italic;
        }

        .review h4 {
            font-size: 0.95rem;
            font-weight: 600;
            color: #555555;
            text-align: right;
        }

        .watch-card {
            background: #fdfbf7;
            border-radius: 4px;
            overflow: hidden;
            position: relative;
            display: flex;
            flex-direction: column;
        }

        .watch-image-container {
            position: relative;
            width: 100%;
            height: 380px;
            /* background: #f4f0eb; */
            overflow: hidden;
            border-radius: 12px;
        }

        .watch-image-container img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            display: block;
            position: relative;
            z-index: 0;
        }

        .watch-image-container::after {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            height: 23%;
            background: linear-gradient(to bottom,
                    rgba(0, 0, 0, 0) 0%,
                    rgba(0, 0, 0, 0.025) 30%,
                    rgba(0, 0, 0, 0.12) 65%,
                    rgba(0, 0, 0, 0.48) 100%);
            z-index: 1;
            pointer-events: none;
        }

        .watch-image-container .watch-price-overlay {
            position: absolute;
            right: 16px;
            bottom: 16px;
            z-index: 2;
            color: #fff;
            font-weight: 800;
            text-shadow: 0 2px 5px rgba(0, 0, 0, 0.35);
        }

        .image-price-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 65px;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.75) 0%, rgba(0, 0, 0, 0) 100%);
            display: flex;
            align-items: flex-end;
            justify-content: flex-start;
            padding: 0 15px 12px 15px;
            z-index: 3;
            pointer-events: none;
            /* Lets clicks pass through to container/dots */
        }

        /* Price text styling inside the image overlay */
        .image-price-overlay .price {
            color: #ffffff !important;
            font-size: 1.15rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-shadow: 0 2px 5px rgba(0, 0, 0, 0.35);
        }

        .price {
            position: absolute;
            right: 15px;
            bottom: 20px;
        }

        /* Top Right Actions (Badge + Heart) */
        .watch-top-actions {
            position: absolute;
            left: 15px;
            right: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
            z-index: 10;
        }

        .stock-badge {
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            padding: 5px 10px;
            letter-spacing: 1px;
            border-radius: 20px;
            margin-top: 5px;
        }

        .stock-badge.available {
            background-color: rgba(46, 125, 50, 0.15);
            color: #2e7d32;
        }

        .stock-badge.sold-out {
            background-color: rgba(198, 40, 40, 0.15);
            color: #c62828;
        }

        /* Wishlist Heart Active / Highlighted State */
        .wishlist-btn.active svg {
            fill: #e67e22;
            /* Matches your accent/button orange */
            stroke: #ffff;
        }

        .wishlist-btn {
            background: transparent;
            border: none;
            cursor: pointer;
            padding: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.2s ease;
        }

        .wishlist-btn:hover {
            transform: scale(1.1);
        }

        /* Slider Track & Images */
        .slider-track {
            width: 100%;
            height: 100%;
            position: relative;
        }

        .slider-track img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 30px;
            opacity: 0;
            transition: opacity 0.4s ease-in-out;
        }

        .slider-track img.active {
            opacity: 1;
        }

        /* Navigation Arrows */
        .slider-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: #ffffff;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            opacity: 0;
            transition: opacity 0.3s ease, background 0.2s ease;
            z-index: 5;
        }

        .slider-arrow.active {
            background: white;
        }

        .watch-image-container:hover .slider-arrow {
            opacity: 1;
        }

        .prev-arrow {
            left: 15px;
        }

        .next-arrow {
            right: 15px;
        }

        .slider-arrow:hover {
            background: #222;
            color: #fff;
        }

        /* Bottom Segmented Pagination Bar */
        .slider-pagination {
            position: absolute;
            bottom: 12px;
            left: 20px;
            right: 20px;
            display: flex;
            gap: 6px;
            z-index: 5;
        }

        .slider-pagination .dot {
            flex: 1;
            height: 3px;
            background: rgba(0, 0, 0, 0.2);
            border-radius: 2px;
            transition: background 0.3s ease;
        }

        .slider-pagination .dot.active {
            background: #ffff;
        }

        .watch-info {
            padding: 20px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
        }

        .watch-info h3 {
            font-size: 1.1rem;
            font-weight: 500;
            color: #111;
            letter-spacing: 0.5px;
        }

        .watch-info p {
            font-size: 0.85rem;
            color: #666;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .watch-info {
            font-size: 1rem;
            font-weight: 600;
            color: #111;
            margin-top: 4px;
        }

        .view-details-link {
            display: inline-block;
            font-size: 0.8rem;
            color: #e67e22;
            /* Matches accent orange */
            text-decoration: none;
            font-weight: 500;
            margin-bottom: 10px;
            transition: color 0.2s ease;
        }

        .view-details-link:hover {
            text-decoration: underline;
        }

        .view-all {
            text-decoration: none;
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
                <a href="/Watch_Collection/user/watch" class="hero-btn">See Products</a>
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
                <?php foreach ($newArrivals as $watch): ?>
                    <?php
                    // Helper function to resolve whether image is in uploads/ or assets/image/
                    $resolveImagePath = function ($imgName) {
                        $imgVal = trim($imgName ?? '');
                        if (empty($imgVal)) {
                            return '/Watch_Collection/assets/image/placeholder.jpg';
                        }
                        if (strpos($imgVal, 'http://') === 0 || strpos($imgVal, 'https://') === 0 || strpos($imgVal, '/') === 0) {
                            return $imgVal;
                        }

                        // Check if file exists in public/uploads, otherwise fallback to assets/image
                        $uploadPath = $_SERVER['DOCUMENT_ROOT'] . '/Watch_Collection/public/uploads/' . $imgVal;
                        if (file_exists($uploadPath)) {
                            return '/Watch_Collection/public/uploads/' . $imgVal;
                        }
                        return '/Watch_Collection/assets/image/' . $imgVal;
                    };

                    // Resolve all 4 images dynamically
                    $img1 = $resolveImagePath($watch['image_url_1'] ?? '');
                    $img2 = $resolveImagePath($watch['image_url_2'] ?? $watch['image_url_1']);
                    $img3 = $resolveImagePath($watch['image_url_3'] ?? $watch['image_url_1']);
                    $img4 = $resolveImagePath($watch['image_url_4'] ?? $watch['image_url_1']);
                    ?>

                    <!-- data-stock added here so JavaScript can read the stock limit -->
                    <div class="watch-card" data-id="<?= $watch['id'] ?>" data-stock="<?= $watch['stock'] ?>" data-price="<?= $watch['price'] ?>">
                        <div class="watch-image-container">
                            <!-- Top Right Actions: Wishlist Heart & Stock Badge -->
                            <div class="watch-top-actions">
                                <?php if ($watch['stock'] == 0): ?>
                                    <span class="stock-badge sold-out">Sold Out</span>
                                <?php else: ?>
                                    <span class="stock-badge available">Available</span>
                                <?php endif; ?>

                                <button class="wishlist-btn wishlist-heart" title="Add to Wishlist">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                    </svg>
                                </button>
                            </div>

                            <!-- Images Carousel Slides using dynamically resolved paths -->
                            <div class="slider-track">
                                <img src="<?= htmlspecialchars($img1) ?>" class="slide active" alt="<?= htmlspecialchars($watch['name']) ?>" data-index="0">
                                <img src="<?= htmlspecialchars($img2) ?>" class="slide" alt="<?= htmlspecialchars($watch['name']) ?>" data-index="1">
                                <img src="<?= htmlspecialchars($img3) ?>" class="slide" alt="<?= htmlspecialchars($watch['name']) ?>" data-index="2">
                                <img src="<?= htmlspecialchars($img4) ?>" class="slide" alt="<?= htmlspecialchars($watch['name']) ?>" data-index="3">
                            </div>

                            <!-- Navigation Arrows -->
                            <button class="slider-arrow prev-arrow">&#10094;</button>
                            <button class="slider-arrow next-arrow">&#10095;</button>

                            <div class="image-price-overlay">
                                <span class="price">$<?= number_format($watch['price']) ?></span>
                            </div>

                            <!-- Bottom Segmented Slide Indicator Bar -->
                            <div class="slider-pagination">
                                <span class="dot active" data-index="0"></span>
                                <span class="dot" data-index="1"></span>
                                <span class="dot" data-index="2"></span>
                                <span class="dot" data-index="3"></span>
                            </div>
                        </div>

                        <!-- Product Info -->
                        <div class="watch-info">
                            <h3><?= htmlspecialchars($watch['name']) ?></h3>
                            <p><?= htmlspecialchars($watch['description']) ?></p>

                            <a href="/Watch_Collection/watch/details/<?= $watch['id'] ?>" class="view-details-link">
                                View details &rarr;
                            </a>

                            <!-- Add to Cart Button -->
                            <button type="button" class="add-button">Add</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <a href="/Watch_Collection/user/watch" class="view-all"> <button class="arrive-btn search-btn">
                View all
            </button>
        </a>

    </section>



    <!-- =========================================
         COLLECTIONS
    ========================================= -->

    <?php require_once __DIR__ . '/../components/collection.php'; ?>



    <!-- =========================================
         BEST SELLERS
    ========================================= -->
    <?php require_once __DIR__ . '/../components/best-seller.php'; ?>



    <!-- =========================================
         ZEITH STORY
    ========================================= -->

    <?php require_once __DIR__ . '/../components/story.php'; ?>


    <!-- =========================================
         WHY ZEITH
    ========================================= -->

    <?php require_once __DIR__ . '/../components/trust.php'; ?>


    <!-- =========================================
         PROMO
    ========================================= -->

    <?php require_once __DIR__ . '/../components/promo.php'; ?>



    <!-- =========================================
         REVIEWS
    ========================================= -->
    <?php require_once __DIR__ . '/../components/reviews.php'; ?>





    <!-- =========================================
         FIXED SHOPPING CART
    ========================================= -->


    



    <!-- =========================================
         JAVASCRIPT
    ========================================= -->

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // ----------------------------------------------------
            // 1. SELECTORS & HELPER ALIAS
            // ----------------------------------------------------
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

            // ----------------------------------------------------
            // 2. STORAGE & HELPER FUNCTIONS
            // ----------------------------------------------------
            function readstorage(key) {
                try {
                    const value = JSON.parse(localStorage.getItem(key) || '[]');
                    return Array.isArray(value) ? value : [];
                } catch {
                    return [];
                }
            }

            function readCart() {
                return readstorage('zeith_cart').map(item => {
                    if (item && typeof item === 'object') {
                        // Grab the image from whichever property name might have been used
                        const imgUrl = item.image_url_1 || item.image || '';
                        return {
                            ...item,
                            id: String(item.id ?? ''),
                            price: Number(item.price) || 0,
                            quantity: Math.max(1, Number(item.quantity) || 1),
                            stock: Number(item.stock) || 10,
                            strap: item.strap || 'Steel',
                            image_url_1: imgUrl, // Ensure both are populated
                            image: imgUrl
                        };
                    }
                    return {
                        id: String(item ?? ''),
                        name: 'Watch details unavailable',
                        brand: 'ZEITH',
                        price: 0,
                        image: '',
                        image_url_1: '',
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

            // ----------------------------------------------------
            // 3. BADGES & UI UPDATES
            // ----------------------------------------------------
            function updateWishlistBadge() {
                const wishlistBadge = $('#wishlist-count');
                if (!wishlistBadge) return;

                const wishlist = readstorage('zeith_wishlist').map(String);
                wishlistBadge.textContent = wishlist.length;
                wishlistBadge.style.display = wishlist.length > 0 ? 'inline-block' : 'none';
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

            // ----------------------------------------------------
            // 4. CART DRAWER CONTROLS
            // ----------------------------------------------------
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
                const subtotal = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);

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
                        ${(item.image_url_1 || item.image) ? `<img src="${escapeHTML(item.image_url_1 || item.image)}" alt="${escapeHTML(item.name)}">` : `<i class="fa-regular fa-clock"></i>`}
                    </div>
                    <div>
                        <span class="cart-item-brand">${escapeHTML(item.brand || 'ZEITH')}</span>
                        <h4 class="cart-item-name">${escapeHTML(item.name)}</h4>
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

                if (subtotalElement) subtotalElement.textContent = money(subtotal);
                if (drawerCount) drawerCount.textContent = `(${count})`;
                if (checkoutButton) checkoutButton.disabled = cart.length === 0;
            }

            // Event Listeners for Cart Drawer
            openButton?.addEventListener('click', openCart);
            closeButton?.addEventListener('click', closeCart);
            continueButton?.addEventListener('click', closeCart);
            overlay?.addEventListener('click', closeCart);

            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape' && drawer?.classList.contains('open')) {
                    closeCart();
                }
            });

            // ----------------------------------------------------
            // 5. UNIFIED WISHLIST CONTROLLER & REAL-TIME HEART SYNC
            // ----------------------------------------------------
            window.syncHomeWishlistHearts = function() {
                const savedWishlist = readstorage('zeith_wishlist').map(String);
                const allCards = document.querySelectorAll('.watch-card, .arrivals, .product-card, .property-card');

                allCards.forEach(card => {
                    const heartBtn = card.querySelector('.wishlist-btn, .wishlist-heart, .wishlist-heart-btn');
                    const watchId = String(heartBtn?.getAttribute('data-id') || heartBtn?.dataset.id || card.getAttribute('data-id') || card.dataset.id || '');

                    if (heartBtn && watchId) {
                        const isSaved = savedWishlist.includes(watchId);
                        heartBtn.classList.toggle('active', isSaved);

                        const svgPath = heartBtn.querySelector('svg path, path');
                        if (isSaved) {
                            heartBtn.style.color = '#ff5252';
                            if (svgPath) svgPath.style.fill = '#ff5252';
                        } else {
                            heartBtn.style.color = '';
                            if (svgPath) svgPath.style.fill = 'currentColor';
                        }
                    }
                });

                updateWishlistBadge();
            };
            // --- Wishlist Heart Toggle Listener ---
            document.addEventListener('click', function(e) {
                const wishlistBtn = e.target.closest('.wishlist-btn, .wishlist-heart, .wishlist-heart-btn');
                if (!wishlistBtn) return;

                e.preventDefault();
                e.stopPropagation();

                const watchCard = wishlistBtn.closest('.watch-card, .arrivals, .product-card, .property-card');
                const watchId = String(wishlistBtn.getAttribute('data-id') || wishlistBtn.dataset.id || watchCard?.getAttribute('data-id') || watchCard?.dataset.id || '');

                if (!watchId) return;

                let wishlist = readstorage('zeith_wishlist').map(String);

                if (wishlist.includes(watchId)) {
                    // Remove from wishlist
                    wishlist = wishlist.filter(id => id !== watchId);
                } else {
                    // Add to wishlist
                    wishlist.push(watchId);

                    // 👉 ADD THE FETCH REQUEST HERE:
                    // This fires only when a user likes/favorites the watch, incrementing likes_count in the DB
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
                window.syncHomeWishlistHearts();
            });

            // ----------------------------------------------------
            // 6. HERO SLIDER CONTROLLER
            // ----------------------------------------------------
            const heroSlides = document.querySelectorAll('.hero-slide');
            if (heroSlides.length > 0) {
                let currentHeroSlide = 0;
                const heroInterval = 5000;

                function nextHeroSlide() {
                    heroSlides[currentHeroSlide].classList.remove('active');
                    heroSlides[currentHeroSlide].classList.add('exit');

                    let previousSlide = currentHeroSlide;
                    currentHeroSlide = (currentHeroSlide + 1) % heroSlides.length;

                    setTimeout(() => {
                        heroSlides[previousSlide].classList.remove('exit');
                    }, 1200);

                    heroSlides[currentHeroSlide].classList.add('active');
                }

                setInterval(nextHeroSlide, heroInterval);
            }

            // ----------------------------------------------------
            // 7. NEW ARRIVALS CAROUSEL CONTROLLER
            // ----------------------------------------------------
            document.querySelectorAll('.watch-card').forEach(card => {
                const slides = card.querySelectorAll('.slide');
                const dots = card.querySelectorAll('.dot');
                const prevBtn = card.querySelector('.prev-arrow');
                const nextBtn = card.querySelector('.next-arrow');
                let currentIndex = 0;

                if (slides.length === 0) return;

                function updateSlide(index) {
                    slides.forEach(s => s.classList.remove('active'));
                    dots.forEach(d => d.classList.remove('active'));

                    slides[index].classList.add('active');
                    if (dots[index]) dots[index].classList.add('active');
                    currentIndex = index;
                }

                nextBtn?.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    let nextIndex = (currentIndex + 1) % slides.length;
                    updateSlide(nextIndex);
                });

                prevBtn?.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    let prevIndex = (currentIndex - 1 + slides.length) % slides.length;
                    updateSlide(prevIndex);
                });
            });

            // ----------------------------------------------------
            // 8. ADD TO CART & SOLD OUT VALIDATION
            // ----------------------------------------------------
            document.querySelectorAll('.add-button, .property-add-btn, .add-to-cart-btn').forEach(button => {
                button.addEventListener('click', (event) => {
                    event.preventDefault();
                    event.stopPropagation();

                    const card = button.closest('.watch-card, .property-card, .arrivals');
                    if (!card) return;

                    // Sold out check
                    const soldOutBadge = card.querySelector('.stock-badge.sold-out, .status-badge.sold-out');
                    if (soldOutBadge) {
                        alert('This watch is currently Sold Out and cannot be added to your cart.');
                        return;
                    }

                    const rawPrice = card.dataset.price || card.querySelector('.price, .price-display, .property-card-price')?.textContent || '';
                    const price = Number(String(rawPrice).replace(/[^\d.]/g, '')) || 0;
                    const id = String(card.dataset.id || card.getAttribute('data-id') || '');
                    const nameElement = card.querySelector('.property-card-title, .watch-info h3, .watch-card h3');
                    const brandElement = card.querySelector('.property-card-brand, .watch-info span, .brand');
                    const imageElement = card.querySelector('.slide.active img, .slide img, .card-main-img, .property-card-image img, img');


                    const name = nameElement ? nameElement.textContent.trim() : 'Watch';
                    const brand = brandElement ? brandElement.textContent.trim() : 'ZEITH';
                    const image = imageElement ? (imageElement.currentSrc || imageElement.src || imageElement.getAttribute('src')) : '';
                    const stockLimit = Number(card.dataset.stock) || 10;

                    if (!id) return;

                    const cart = readCart();
                    const existing = cart.find(item => item.id === id);
                    const currentQty = existing ? Number(existing.quantity) : 0;

                    // Stock Limit check
                    if (currentQty + 1 > stockLimit) {
                        alert(`Sorry, we only have ${stockLimit} of this item in stock.`);
                        return;
                    }

                    if (existing) {
                        existing.quantity = currentQty + 1;
                        existing.name = name;
                        existing.brand = brand;
                        existing.price = price;
                        existing.image = image;
                        existing.image_url_1 = image; // <--- Ensure this is populated
                        existing.stock = stockLimit;
                    } else {
                        cart.push({
                            id,
                            name,
                            brand,
                            price,
                            image: image,
                            image_url_1: image, // <--- Ensure this is populated
                            stock: stockLimit,
                            quantity: 1
                        });
                    }

                    saveCart(cart);
                    openCart();

                    const oldText = button.textContent;
                    button.textContent = 'Added!';
                    setTimeout(() => {
                        button.textContent = oldText;
                    }, 900);
                });
            });

            // ----------------------------------------------------
            // 9. CART QUANTITY CONTROLS (+ / - / Remove)
            // ----------------------------------------------------
            itemsContainer?.addEventListener('click', (event) => {
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
                        if (item.quantity + 1 > item.stock) {
                            alert(`Sorry, only ${item.stock} available in stock.`);
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

            // ----------------------------------------------------
            // 10. CHECKOUT & REAL-TIME CROSS-TAB SYNCHRONIZATION
            // ----------------------------------------------------
            checkoutButton?.addEventListener('click', () => {
                if (readCart().length === 0) return;
                window.location.href = '/Watch_Collection/checkout';
            });

            // Initial Setup
            window.syncHomeWishlistHearts();
            renderCart();
        });

        // ----------------------------------------------------
        // 11. BCACHE & HISTORY NAVIGATION LISTENERS
        // ----------------------------------------------------
        window.addEventListener('storage', (event) => {
            if (!event.key || event.key === 'zeith_cart') {
                if (typeof renderCart === 'function') renderCart();
            }
            if (!event.key || event.key === 'zeith_wishlist') {
                if (typeof window.syncHomeWishlistHearts === 'function') window.syncHomeWishlistHearts();
            }
        });

        window.addEventListener('focus', () => {
            if (typeof window.syncHomeWishlistHearts === 'function') window.syncHomeWishlistHearts();
        });

        window.addEventListener('pageshow', (event) => {
            if (typeof window.syncHomeWishlistHearts === 'function') window.syncHomeWishlistHearts();
        });
    </script>

    <?php include_once __DIR__ . '/../components/cart-drawer.php'; ?>

    <?php include __DIR__ . '/../components/footer.php'; ?>

    <?php include_once __DIR__ . '/../components/cookie-banner.php'; ?>

    <?php include_once __DIR__ . '/../components/newsletter-modal.php'; ?>
    
</body>

</html>