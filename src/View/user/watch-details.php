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

// Read stock count from database record (stock > 0 means available, 0 means sold out)[cite: 8]
$stockCount = (int)($watch['stock'] ?? 0);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script
        src="https://kit.fontawesome.com/69c405441a.js"
        crossorigin="anonymous">
    </script>
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
            margin-top: 30px;
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
            background: transparent;
            border: 1px solid #ddd;
            border-radius: 50%;
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .wishlist-circle svg {
            fill: none;
            stroke: #333;
        }

        .wishlist-circle.active {
            border-color: #f97316;
            background-color: #fff;
        }

        .wishlist-circle.active svg {
            fill: #f97316;
            stroke: #f97316;
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

        /* ======================================================
   CTA Action Buttons
   ====================================================== */
        .cta-row {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 24px;
        }

        .btn-add-cart-outline {
            flex: 1;
            background: transparent;
            color: #111;
            border: 1.5px solid #111;
            padding: 14px 24px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-add-cart-outline:hover {
            background: #111;
            color: #fff;
        }

        .btn-add-cart-disabled {
            flex: 1;
            background: #f1f5f9;
            color: #94a3b8;
            border: 1px solid #e2e8f0;
            padding: 14px 24px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 14px;
            cursor: not-allowed;
        }

        /* ======================================================
   Floating Cart Button
   ====================================================== */
        .floating-cart {
            position: fixed;
            bottom: 24px;
            right: 24px;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: #f97316;
            color: #ffffff;
            border: none;
            box-shadow: 0 4px 14px rgba(249, 115, 22, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            cursor: pointer;
            z-index: 999;
            transition: transform 0.2s ease, background-color 0.2s ease;
        }

        .floating-cart:hover {
            transform: scale(1.05);
            background: #ea580c;
        }

        .floating-cart .cart-count {
            position: absolute;
            top: -4px;
            right: -4px;
            background: #111827;
            color: #ffffff;
            font-size: 11px;
            font-weight: 700;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #ffffff;
        }

        /* ======================================================
   Slide-Out Cart Drawer Overlay & Panel
   ====================================================== */
        .cart-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(2px);
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
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
            max-width: 100vw;
            height: 100vh;
            background: #ffffff;
            z-index: 1001;
            display: flex;
            flex-direction: column;
            transform: translateX(100%);
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: -8px 0 24px rgba(0, 0, 0, 0.12);
        }

        .cart-drawer.open {
            transform: translateX(0);
        }

        /* Header */
        .cart-drawer-header {
            padding: 24px 28px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
        }

        .cart-drawer-header .brand-tag {
            color: #f97316;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            display: block;
            margin-bottom: 4px;
        }

        .cart-drawer-header h2 {
            font-size: 22px;
            font-weight: 300;
            color: #64748b;
            margin: 0;
        }

        .cart-drawer-header h2 span {
            font-size: 16px;
            color: #94a3b8;
        }

        .cart-close {
            background: #f1f5f9;
            border: none;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #0f172a;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .cart-close:hover {
            background: #e2e8f0;
        }

        /* Items List */
        .cart-items {
            flex: 1;
            overflow-y: auto;
            padding: 24px 28px;
        }

        .cart-empty {
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #94a3b8;
            text-align: center;
        }

        .cart-empty i {
            font-size: 32px;
            margin-bottom: 16px;
            color: #cbd5e1;
        }

        .cart-empty h3 {
            font-size: 18px;
            font-weight: 300;
            color: #64748b;
            margin: 0 0 6px 0;
        }

        .cart-empty p {
            font-size: 13px;
            color: #94a3b8;
            margin: 0;
        }

        /* Cart Article Item */
        .cart-item {
            display: flex;
            gap: 16px;
            padding-bottom: 20px;
            margin-bottom: 20px;
            border-bottom: 1px solid #f1f5f9;
        }

        .cart-item-image {
            width: 80px;
            height: 80px;
            background: #f8fafc;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 6px;
            flex-shrink: 0;
        }

        .cart-item-image img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .cart-item-details {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .cart-item-brand {
            font-size: 10px;
            font-weight: 700;
            color: #cbd5e1;
            letter-spacing: 0.8px;
            text-transform: uppercase;
        }

        .cart-item-name {
            font-size: 15px;
            font-weight: 300;
            color: #475569;
            margin: 2px 0 6px 0;
        }

        .cart-item-price {
            font-size: 16px;
            font-weight: 800;
            color: #f97316;
            margin-bottom: 12px;
        }

        .cart-item-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .cart-quantity {
            display: inline-flex;
            align-items: center;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            background: #ffffff;
        }

        .cart-quantity button {
            width: 28px;
            height: 28px;
            background: none;
            border: none;
            color: #64748b;
            font-size: 14px;
            cursor: pointer;
        }

        .cart-quantity span {
            padding: 0 10px;
            font-size: 12px;
            font-weight: 600;
            color: #334155;
        }

        .cart-remove {
            background: none;
            border: none;
            color: #cbd5e1;
            font-size: 12px;
            text-decoration: underline;
            cursor: pointer;
        }

        .cart-remove:hover {
            color: #ef4444;
        }

        /* Footer */
        .cart-drawer-footer {
            padding: 24px 28px 28px 28px;
            border-top: 1px solid #f1f5f9;
            background: #ffffff;
        }

        .cart-subtotal-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .cart-subtotal-row span {
            font-size: 16px;
            color: #94a3b8;
            font-weight: 300;
        }

        .cart-subtotal-row strong {
            font-size: 22px;
            color: #102a43;
            font-weight: 400;
        }

        .footer-note {
            font-size: 12px;
            color: #cbd5e1;
            margin: 0 0 20px 0;
        }

        .checkout-button {
            width: 100%;
            height: 52px;
            background: #f97316;
            color: #ffffff;
            border: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .checkout-button:hover {
            background: #ea580c;
        }

        .checkout-button.disabled {
            background: #fed7aa;
            cursor: not-allowed;
        }

        .continue-shopping {
            width: 100%;
            background: none;
            border: none;
            color: #94a3b8;
            font-size: 13px;
            margin-top: 14px;
            cursor: pointer;
            text-align: center;
        }

        .continue-shopping:hover {
            color: #64748b;
        }

        /* Responsive Adaptations for iPad and Mobile */
        @media (max-width: 768px) {
            .cart-drawer {
                width: 100vw;
            }

            .cta-row {
                flex-wrap: wrap;
            }

            .btn-add-cart-outline,
            .btn-add-cart-disabled {
                width: 100%;
            }
        }

        .wishlist-circle {
            background: transparent;
            border: 1px solid #ddd;
            border-radius: 50%;
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .wishlist-circle.active {
            border-color: #f97316;
        }

        .wishlist-circle.active svg {
            fill: #f97316;
            stroke: #f97316;
        }
    </style>
</head>

<body>
    <?php require_once __DIR__ . '/../components/header.php'; ?>

    <?php
    // Read stock count from database record (stock > 0 means available, 0 means sold out)
    $stockCount = (int)($watch['stock'] ?? 0);
    $isAvailable = $stockCount > 0;
    ?>

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

            <!-- Action Buttons Row -->
            <!-- Action Buttons Row -->
            <div class="cta-row">
                <!-- Add to Cart Button -->
                <?php if ($isAvailable): ?>
                    <button class="btn-add-cart-outline" id="addToCartBtn" type="button">
                        Add to Cart
                    </button>
                    <button class="btn-add-cart" id="purchaseBtn" type="button">
                        Purchase only this product
                    </button>
                <?php else: ?>
                    <button class="btn-add-cart-disabled" type="button" disabled>
                        Sold Out
                    </button>
                    <button class="btn-add-cart-disabled" type="button" disabled style="cursor: not-allowed;">
                        Sold Out
                    </button>
                <?php endif; ?>

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

    <!-- Backdrop Overlay for Shipping Panel -->
    <div class="drawer-backdrop" id="shippingBackdrop"></div>

    <!-- Slide-out Side Panel for Shipping -->
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

    <!-- Floating Cart Button -->
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

    <!-- Cart Backdrop Overlay -->
    <div class="cart-overlay" id="cart-overlay"></div>

    <!-- Shopping Bag Drawer Panel -->
    <aside class="cart-drawer"
        id="cart-drawer"
        aria-hidden="true"
        aria-label="Shopping cart">

        <div class="cart-drawer-header">
            <div>
                <small class="brand-tag">THE ZEITH EXPERIENCE</small>
                <h2>Shopping Bag <span id="drawer-item-count">(0)</span></h2>
            </div>

            <button type="button" id="close-cart" class="cart-close" aria-label="Close cart">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <div class="cart-items" id="cart-items"></div>

        <div class="cart-drawer-footer">
            <div class="cart-subtotal-row">
                <span>Subtotal</span>
                <strong id="cart-subtotal">₦0.00</strong>
            </div>

            <p class="footer-note">Shipping and applicable fees are calculated at checkout.</p>

            <button type="button" id="checkout-button" class="checkout-button">
                Proceed to Checkout <i class="fa-solid fa-arrow-right"></i>
            </button>

            <button type="button" id="continue-shopping" class="continue-shopping">
                Continue Shopping
            </button>
        </div>
    </aside>

    <script>
        // State Variables
        const watchId = <?= json_encode($watch['id'] ?? 1) ?>;
        const basePrice = <?= json_encode((float)($watch['price'] ?? 85000)) ?>;
        const watchStock = <?= json_encode((int)($watch['stock'] ?? 0)) ?>; // Stock count (0 = Sold Out, >0 = Available)[cite: 8]
        let selectedShippingCost = 0;
        let selectedShippingId = null;

        // Utilities
        function money(amount) {
            return '₦' + parseFloat(amount).toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }

        function escapeHTML(str) {
            return str ? String(str).replace(/[&<>'"]/g,
                tag => ({
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    "'": '&#39;',
                    '"': '&quot;'
                } [tag] || tag)
            ) : '';
        }

        // Cart Drawer DOM Handles
        const drawer = document.getElementById('cart-drawer');
        const overlay = document.getElementById('cart-overlay');
        const openButton = document.getElementById('open-cart');
        const closeButton = document.getElementById('close-cart');
        const itemsContainer = document.getElementById('cart-items');
        const subtotalElement = document.getElementById('cart-subtotal');
        const drawerCount = document.getElementById('drawer-item-count');
        const checkoutButton = document.getElementById('checkout-button');
        const continueShoppingBtn = document.getElementById('continue-shopping');

        function readCart() {
            return JSON.parse(localStorage.getItem('zeith_cart')) || [];
        }

        function updateCartBadge(cart) {
            const count = cart.reduce((sum, item) => sum + item.quantity, 0);
            const badge = document.getElementById('cart-count');
            if (badge) badge.textContent = count;
        }

        // Shipping selection logic
        function selectShipping(element) {
            document.querySelectorAll('.shipping-card').forEach(card => card.classList.remove('selected'));
            element.classList.add('selected');

            selectedShippingCost = parseFloat(element.getAttribute('data-cost')) || 0;
            selectedShippingId = element.getAttribute('data-id');
            const shippingName = element.getAttribute('data-name');

            const totalPrice = basePrice + selectedShippingCost;

            document.getElementById('displayPrice').innerText = totalPrice.toLocaleString();
            document.getElementById('shippingNote').innerText = `Includes ${shippingName} (+₦${selectedShippingCost.toLocaleString()})`;

            closeShippingPanel();
        }

        // --- 1. ADD TO CART LOGIC ---
        const addToCartBtn = document.getElementById('addToCartBtn');
        if (addToCartBtn) {
            addToCartBtn.addEventListener('click', function() {
                if (Number(watchStock) <= 0) {
                    alert("This watch is currently Sold Out and cannot be added to your cart.");
                    return;
                }

                const cartItem = {
                    id: watchId,
                    name: <?= json_encode($watch['name'] ?? 'Watch') ?>,
                    price: basePrice,
                    image: "/Watch_Collection/assets/image/" + <?= json_encode($watch['image_url_1'] ?? 'Nautilus_5711-removebg-preview.png') ?>,
                    quantity: 1
                };

                let cart = readCart();
                const existingIndex = cart.findIndex(item => String(item.id) === String(watchId));

                if (existingIndex > -1) {
                    cart[existingIndex].quantity += 1;
                } else {
                    cart.push(cartItem);
                }

                localStorage.setItem('zeith_cart', JSON.stringify(cart));
                renderCart();
                openCart();
            });
        }

        // --- 2. PURCHASE BUTTON LOGIC (STOCK GUARDED) ---
        const purchaseBtn = document.getElementById('purchaseBtn');
        if (purchaseBtn) {
            purchaseBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();

                // Strict check: Block checkout for sold out items
                if (Number(watchStock) <= 0) {
                    alert("This watch is currently Sold Out and cannot be added to your cart.");
                    return false;
                }

                // Available product flow -> Save and go to checkout
                const directItem = {
                    id: watchId,
                    name: <?= json_encode($watch['name'] ?? 'Watch') ?>,
                    price: basePrice,
                    image: "/Watch_Collection/assets/image/" + <?= json_encode($watch['image_url_1'] ?? 'Nautilus_5711-removebg-preview.png') ?>,
                    quantity: 1,
                    shippingCost: selectedShippingCost,
                    shippingId: selectedShippingId
                };

                let cart = readCart();
                const existingIndex = cart.findIndex(item => String(item.id) === String(watchId));

                if (existingIndex > -1) {
                    cart[existingIndex].quantity = (cart[existingIndex].quantity || 1);
                } else {
                    cart.push(directItem);
                }

                localStorage.setItem('zeith_cart', JSON.stringify(cart));

                let checkoutUrl = `http://localhost/Watch_Collection/checkout?watch_id=${watchId}`;
                if (selectedShippingId) {
                    checkoutUrl += `&shipping_id=${selectedShippingId}`;
                }
                window.location.href = checkoutUrl;
            });
        }

        // --- 3. WISHLIST SYNCHRONIZATION LOGIC ---
        function readWishlist() {
            return JSON.parse(localStorage.getItem('zeith_wishlist')) || [];
        }

        const wishlistToggleBtn = document.getElementById('wishlistToggle');

        // Function to sync heart visual state with localStorage
        function updateWishlistUI() {
            if (!wishlistToggleBtn) return;

            const wishlist = readWishlist();
            const isWishlisted = wishlist.some(item => String(item.id) === String(watchId));

            if (isWishlisted) {
                wishlistToggleBtn.classList.add('active');
            } else {
                wishlistToggleBtn.classList.remove('active');
            }
        }

        // Check state on initial page load
        document.addEventListener('DOMContentLoaded', () => {
            updateWishlistUI();
            updateCartBadge(readCart());
        });

        // Re-check state when navigating back/forward between pages (BFCache support)
        window.addEventListener('pageshow', () => {
            updateWishlistUI();
        });

        // Toggle add/remove on click
        if (wishlistToggleBtn) {
            wishlistToggleBtn.addEventListener('click', function() {
                let wishlist = readWishlist();
                const isWishlisted = wishlist.some(item => String(item.id) === String(watchId));

                if (!isWishlisted) {
                    const watchItem = {
                        id: watchId,
                        name: <?= json_encode($watch['name'] ?? 'Watch') ?>,
                        price: basePrice,
                        image: "/Watch_Collection/assets/image/" + <?= json_encode($watch['image_url_1'] ?? 'Nautilus_5711-removebg-preview.png') ?>,
                        description: <?= json_encode($watch['description'] ?? '') ?>,
                        stock: watchStock
                    };
                    wishlist.push(watchItem);

                    // 👉 Send API fetch to update likes_count in database
                    fetch('/Watch_Collection/api/like-watch.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            id: watchId
                        })
                    }).catch(err => console.error('Error updating likes:', err));

                } else {
                    wishlist = wishlist.filter(item => String(item.id) !== String(watchId));
                }

                localStorage.setItem('zeith_wishlist', JSON.stringify(wishlist));
                updateWishlistUI();
            });
        }

        // --- 4. CAROUSEL SLIDER ---
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
            if (mainImg) {
                mainImg.style.opacity = '0';
                setTimeout(() => {
                    mainImg.src = slides[currentIndex];
                    mainImg.style.opacity = '1';
                }, 150);
            }

            document.querySelectorAll('.thumb-card').forEach((card, idx) => {
                card.classList.toggle('active', idx === currentIndex);
            });

            document.querySelectorAll('.pagination-dots .dot').forEach((dot, idx) => {
                dot.classList.toggle('active', idx === currentIndex);
            });
        }

        function goToSlide(index) {
            updateSlider(index);
        }

        document.getElementById('prevSlideBtn')?.addEventListener('click', () => {
            let newIndex = currentIndex - 1 < 0 ? slides.length - 1 : currentIndex - 1;
            updateSlider(newIndex);
        });

        document.getElementById('nextSlideBtn')?.addEventListener('click', () => {
            let newIndex = currentIndex + 1 >= slides.length ? 0 : currentIndex + 1;
            updateSlider(newIndex);
        });

        // --- 5. ACCORDION CONTROLS ---
        document.querySelectorAll('.accordion-header').forEach(header => {
            header.addEventListener('click', () => {
                if (header.id === 'openShippingDrawer') return;
                const item = header.parentElement;
                const content = item.querySelector('.accordion-content');
                if (!content) return;

                const isOpen = item.classList.contains('open');
                item.closest('.info-card').querySelectorAll('.accordion-item').forEach(i => i.classList.remove('open'));

                if (!isOpen) item.classList.add('open');
            });
        });

        // --- 6. SHIPPING SIDE DRAWER CONTROLS ---
        const openShippingBtn = document.getElementById('openShippingDrawer');
        const closeShippingBtn = document.getElementById('closeShippingDrawer');
        const shippingDrawer = document.getElementById('shippingDrawer');
        const shippingBackdrop = document.getElementById('shippingBackdrop');

        function openShippingPanel() {
            shippingDrawer?.classList.add('active');
            shippingBackdrop?.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeShippingPanel() {
            shippingDrawer?.classList.remove('active');
            shippingBackdrop?.classList.remove('active');
            document.body.style.overflow = '';
        }

        openShippingBtn?.addEventListener('click', openShippingPanel);
        closeShippingBtn?.addEventListener('click', closeShippingPanel);
        shippingBackdrop?.addEventListener('click', closeShippingPanel);

        // --- 7. SHOPPING BAG DRAWER FUNCTIONS ---
        function openCart() {
            if (!drawer || !overlay) return;
            drawer.classList.add('open');
            overlay.classList.add('open');
            document.body.classList.add('cart-open');

            drawer.setAttribute('aria-hidden', 'false');
            openButton?.setAttribute('aria-expanded', 'true');

            renderCart();
        }

        function closeCart() {
            if (!drawer || !overlay) return;
            drawer.classList.remove('open');
            overlay.classList.remove('open');
            document.body.classList.remove('cart-open');

            drawer.setAttribute('aria-hidden', 'true');
            openButton?.setAttribute('aria-expanded', 'false');
        }

        openButton?.addEventListener('click', openCart);
        closeButton?.addEventListener('click', closeCart);
        overlay?.addEventListener('click', closeCart);
        continueShoppingBtn?.addEventListener('click', closeCart);

        // Item quantity controls inside drawer
        if (itemsContainer) {
            itemsContainer.addEventListener('click', function(e) {
                const target = e.target;
                const article = target.closest('.cart-item');
                if (!article) return;

                const index = parseInt(article.getAttribute('data-index'));
                let cart = readCart();

                if (target.getAttribute('data-action') === 'increase') {
                    cart[index].quantity += 1;
                } else if (target.getAttribute('data-action') === 'decrease') {
                    if (cart[index].quantity > 1) {
                        cart[index].quantity -= 1;
                    } else {
                        cart.splice(index, 1);
                    }
                } else if (target.getAttribute('data-action') === 'remove') {
                    cart.splice(index, 1);
                }

                localStorage.setItem('zeith_cart', JSON.stringify(cart));
                renderCart();
            });
        }

        // Render Cart items
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
                    ${item.image ? `<img src="${escapeHTML(item.image)}" alt="${escapeHTML(item.name)}">` : `<i class="fa-regular fa-clock"></i>`}
                </div>
                <div class="cart-item-details">
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

            if (checkoutButton) {
                if (cart.length === 0) {
                    checkoutButton.classList.add('disabled');
                    checkoutButton.onclick = null;
                } else {
                    checkoutButton.classList.remove('disabled');
                    checkoutButton.onclick = function() {
                        window.location.href = '/Watch_Collection/checkout';
                    };
                }
            }
        }
    </script>
</body>

</html>