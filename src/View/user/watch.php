<?php
$watches = $watches ?? \App\Models\Watch::getAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/69c405441a.js" crossorigin="anonymous"></script>
    <title>Zeith - Luxury Watch Collections</title>

    <style>
        /* ==========================================
   PROPERTY PAGE STYLES
   ========================================== */
        .property-body {
            background-color: #f8fafc;
            color: #1e293b;
            min-height: 100vh;
            padding: 2rem 1.5rem;
        }

        .property-container {
            max-width: 1320px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 2.5rem;
        }

        .property-sidebar {
            display: flex;
            flex-direction: column;
            gap: 2.5rem;
        }

        .property-sidebar-widget {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            padding: 1.5rem;
            border-radius: 0.85rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
        }

        .property-widget-title {
            font-size: 0.9rem;
            font-weight: 700;
            color: #fc8b1e;
            margin-bottom: 1.25rem;
            border-bottom: 2px solid var(--primary, #e11d48);
            padding-bottom: 0.5rem;
            display: inline-block;
        }

        .zeith-span {
            letter-spacing: -2px;
            font-size: 0.9rem;
            font-weight: 700;
            color: #0f172a;
        }

        .property-category-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 0.85rem;
        }

        .property-price-range {
            accent-color: #fc8b1e;
        }

        .property-category-list li a {
            color: #64748b;
            font-weight: 500;
            text-decoration: none;
            font-size: 0.9rem;
            display: flex;
            justify-content: space-between;
            transition: color 0.2s ease;
        }

        .property-category-list li a:hover {
            color: #e11d48;
        }

        .property-count {
            color: #fc8b1e;
            font-weight: 600;
        }

        .property-range-slider {
            width: 100%;
            accent-color: #fc8b1e;
            margin-bottom: 1rem;
            background-color: #ffffff;
        }

        .property-price-controls {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .property-price-label {
            font-size: 0.8rem;
            color: #64748b;
            font-weight: 500;
        }

        .property-filter-btn {
            background-color: #fc8b1e;
            color: #ffffff;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 0.4rem;
            font-weight: 700;
            font-size: 0.8rem;
            cursor: pointer;
            align-self: flex-start;
            transition: opacity 0.2s ease;
        }

        .property-filter-btn:hover {
            opacity: 0.9;
        }

        .property-hero-banner {
            position: relative;
            background: linear-gradient(135deg, #ffffff 0%, #f1f5f9 100%);
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            padding: 2.5rem 3rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2rem;
            overflow: hidden;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.03);
            perspective: 1000px;
            height: 320px;
        }

        .hero-3d-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            pointer-events: none;
            background: radial-gradient(circle at center,
                    rgba(255, 255, 255, 0.4) 0%,
                    rgba(241, 245, 249, 0.8) 70%,
                    #f1f5f9 100%);
        }

        .hero-3d-bg img {
            width: 160%;
            height: 160%;
            object-fit: cover;
            position: absolute;
            top: -30%;
            left: -30%;
            opacity: 1.14;
            transform-style: preserve-3d;
            animation: heroFullCover3D 20s ease-in-out infinite alternate;
        }

        @keyframes heroFullCover3D {
            0% {
                transform: translate3d(0px, 0px, 0px) rotateX(0deg) rotateY(0deg) rotateZ(0deg) scale(1);
            }

            25% {
                transform: translate3d(35px, -25px, 50px) rotateX(12deg) rotateY(-10deg) rotateZ(4deg) scale(1.05);
            }

            50% {
                transform: translate3d(-25px, 30px, -35px) rotateX(-10deg) rotateY(14deg) rotateZ(-6deg) scale(1.08);
            }

            75% {
                transform: translate3d(20px, -20px, 60px) rotateX(8deg) rotateY(-12deg) rotateZ(5deg) scale(1.04);
            }

            100% {
                transform: translate3d(-30px, -30px, 15px) rotateX(-7deg) rotateY(7deg) rotateZ(-3deg) scale(1.06);
            }
        }

        .property-hero-text,
        .property-hero-images {
            position: relative;
            z-index: 2;
        }

        .property-hero-subtitle {
            color: #fc8b1e;
            font-size: 0.95rem;
            font-weight: 700;
            letter-spacing: 0.1em;
        }

        .property-hero-title {
            font-size: 2.2rem;
            font-weight: 800;
            color: #e9eaee;
            margin: 0.2rem 0;
            letter-spacing: -2px;
            text-shadow: 0px 2px 8px rgba(0, 0, 0, 0.8);
        }

        .property-hero-desc {
            font-weight: 500;
            color: #64748b;
            font-size: 0.95rem;
        }

        /* ==========================================
   RESPONSIVE BREAKPOINTS
   ========================================== */

        /* Max Width 1100px */
        @media (max-width: 1100px) {
            .pg-head {
                padding: 0 20px;
                gap: 12px;
            }

            .logo h1 {
                font-size: 28px;
            }

            .search-container {
                max-width: 500px;
            }

            .search-icon {
                font-size: 40px;
                padding-left: 14px;
            }

            .search-btn {
                padding: 0 20px;
                font-size: 15px;
            }

            .nav-bar {
                gap: 10px;
            }

            .nav-bar a {
                font-size: 14px;
            }

            .hero {
                padding: 60px 6%;
                gap: 30px;
            }

            .hero-text h1 {
                font-size: 40px;
            }

            .new {
                grid-template-columns: repeat(2, 1fr);
                gap: 30px;
            }

            .collection-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .collection-card {
                height: 450px;
            }

            .product-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .features {
                grid-template-columns: repeat(2, 1fr);
            }

            .review-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .story-text {
                padding: 50px 5%;
            }

            .story-text h2 {
                font-size: 45px;
            }

            .promo-content h2 {
                font-size: 70px;
            }
        }

        /* Max Width 992px */
        @media (max-width: 992px) {
            .property-container {
                grid-template-columns: 1fr;
            }
        }

        /* Max Width 800px */
        @media (max-width: 800px) {
            .pg-head {
                height: auto;
                min-height: 80px;
                flex-wrap: wrap;
                padding: 12px 20px;
            }

            .logo {
                order: 1;
            }

            .nav-bar {
                order: 2;
                margin-left: auto;
            }

            .search-container {
                order: 3;
                width: 100%;
                max-width: none;
                height: 52px;
            }

            .search-icon {
                font-size: 32px;
                padding-left: 12px;
            }

            .search-btn {
                height: 42px;
                padding: 0 20px;
            }

            .hero {
                flex-direction: column;
                text-align: center;
                padding: 140px 7% 60px;
            }

            .hero-image {
                width: 80%;
                order: 1;
            }

            .hero-text {
                order: 2;
            }

            .hero-text h1 {
                font-size: 38px;
            }

            .hero-text p {
                max-width: 600px;
                margin: 15px auto 25px;
            }

            .collections,
            .best-sellers,
            .why-zeith,
            .reviews {
                padding: 80px 6%;
            }

            .section-heading {
                margin-bottom: 40px;
            }

            .section-heading h2 {
                font-size: 38px;
            }

            .story {
                flex-direction: column;
            }

            .story-image {
                width: 100%;
                height: 450px;
            }

            .story-text {
                width: 100%;
                padding: 70px 8%;
            }

            .story-text h2 {
                font-size: 48px;
            }

            .promo {
                padding: 80px 20px;
            }

            .promo-content h2 {
                font-size: 65px;
            }
        }

        /* Max Width 600px */
        @media (max-width: 600px) {
            .pg-head {
                position: relative;
                padding: 14px 15px;
                gap: 12px;
            }

            .logo h1 {
                font-size: 27px;
            }

            .nav-bar {
                gap: 12px;
            }

            .nav-bar a {
                font-size: 0;
            }

            .nav-bar .icon {
                font-size: 18px;
            }

            .span {
                gap: 0;
            }

            .search-container {
                height: 50px;
                border-radius: 25px;
            }

            .search-icon {
                font-size: 30px;
                padding-left: 10px;
            }

            .search-bar {
                font-size: 14px;
                padding: 0 8px;
            }

            .search-btn {
                height: 40px;
                padding: 0 17px;
                font-size: 13px;
            }

            .hero {
                padding: 50px 20px 60px;
                margin-bottom: 20px;
            }

            .hero-image {
                width: 100%;
            }

            .hero-text h1 {
                font-size: 34px;
                line-height: 1.1;
            }

            .hero-text p {
                font-size: 14px;
                line-height: 1.6;
            }

            .product-btn {
                display: inline-block;
                padding: 13px 21px;
                font-size: 14px;
            }

            .new-arrivals {
                padding: 20px 10px;
            }

            .new-arrhead {
                font-size: 21px;
                padding: 0 8px;
            }

            .new {
                grid-template-columns: 1fr 1fr;
                gap: 20px 10px;
                padding: 0 8px;
            }

            .watch-info h2 {
                font-size: 16px;
            }

            .watch-name {
                font-size: 11px;
            }

            .watch-price {
                font-size: 15px;
            }

            .watch-rating {
                font-size: 12px;
            }

            .tag {
                font-size: 8px;
                padding: 3px 8px;
            }

            .collections,
            .best-sellers,
            .why-zeith,
            .reviews {
                padding: 70px 20px;
            }

            .section-heading {
                margin-bottom: 35px;
            }

            .section-heading p {
                font-size: 10px;
                letter-spacing: 2px;
            }

            .section-heading h2 {
                font-size: 32px;
                letter-spacing: -1px;
            }

            .collection-grid {
                grid-template-columns: 1fr;
                gap: 18px;
            }

            .collection-card {
                height: 420px;
            }

            .collection-content {
                left: 22px;
                bottom: 22px;
            }

            .collection-content h3 {
                font-size: 25px;
            }

            .product-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .product-card {
                padding: 15px;
            }

            .product-image {
                height: 300px;
            }

            .product-image img {
                width: 80%;
                height: 80%;
            }

            .story-image {
                height: 350px;
            }

            .story-text {
                padding: 60px 20px;
            }

            .story-text h2 {
                font-size: 40px;
            }

            .story-p {
                font-size: 14px;
            }

            .features {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .feature {
                padding: 20px;
            }

            .promo {
                min-height: 400px;
                padding: 60px 20px;
            }

            .promo-content h2 {
                font-size: 50px;
                letter-spacing: -3px;
            }

            .promop {
                font-size: 14px;
            }

            .review-grid {
                grid-template-columns: 1fr;
                gap: 18px;
            }

            .review {
                padding: 25px;
            }
        }

        /* Max Width 400px */
        @media (max-width: 400px) {
            .pg-head {
                padding: 12px;
            }

            .logo h1 {
                font-size: 24px;
            }

            .nav-bar {
                gap: 9px;
            }

            .nav-bar .icon {
                font-size: 16px;
            }

            .search-container {
                height: 46px;
            }

            .search-icon {
                font-size: 27px;
                padding-left: 8px;
            }

            .search-btn {
                height: 36px;
                padding: 0 13px;
                font-size: 12px;
            }

            .hero {
                padding: 40px 15px 50px;
            }

            .hero-text h1 {
                font-size: 29px;
            }

            .new {
                gap: 18px 8px;
            }

            .watch-info h2 {
                font-size: 14px;
            }

            .watch-price {
                font-size: 14px;
            }

            .collections,
            .best-sellers,
            .why-zeith,
            .reviews {
                padding: 60px 15px;
            }

            .section-heading h2 {
                font-size: 28px;
            }

            .collection-card {
                height: 380px;
            }

            .product-image {
                height: 270px;
            }

            .story-text h2 {
                font-size: 34px;
            }

            .promo-content h2 {
                font-size: 42px;
            }
        }

        /* ==========================================
   RESPONSIVE LAYOUT (<= 800px)
   ========================================== */
        @media (max-width: 800px) {
            .pg-head {
                height: auto;
                min-height: 80px;
                flex-wrap: wrap;
                padding: 12px 20px;
            }

            .logo {
                order: 1;
            }

            .nav-bar {
                order: 2;
                margin-left: auto;
            }

            .search-container {
                order: 3;
                width: 100%;
                max-width: none;
                height: 52px;
            }

            .search-icon {
                font-size: 32px;
                padding-left: 12px;
            }

            .search-btn {
                height: 42px;
                padding: 0 20px;
            }

            .hero {
                flex-direction: column;
                text-align: center;
                padding: 140px 7% 60px;
            }

            .hero-image {
                width: 80%;
                order: 1;
            }

            .hero-text {
                order: 2;
            }

            .hero-text h1 {
                font-size: 38px;
            }

            .hero-text p {
                max-width: 600px;
                margin: 15px auto 25px;
            }

            .collections,
            .best-sellers,
            .why-zeith,
            .reviews {
                padding: 80px 6%;
            }

            .section-heading {
                margin-bottom: 40px;
            }

            .section-heading h2 {
                font-size: 38px;
            }

            .story {
                flex-direction: column;
            }

            .story-image {
                width: 100%;
                height: 450px;
            }

            .story-text {
                width: 100%;
                padding: 70px 8%;
            }

            .story-text h2 {
                font-size: 48px;
            }

            .promo {
                padding: 80px 20px;
            }

            .promo-content h2 {
                font-size: 65px;
            }
        }

        /* ==========================================
   RESPONSIVE LAYOUT (<= 600px)
   ========================================== */
        @media (max-width: 600px) {
            .pg-head {
                position: relative;
                padding: 14px 15px;
                gap: 12px;
            }

            .logo h1 {
                font-size: 27px;
            }

            .nav-bar {
                gap: 12px;
            }

            .nav-bar a {
                font-size: 0;
            }

            .nav-bar .icon {
                font-size: 18px;
            }

            .span {
                gap: 0;
            }

            .search-container {
                height: 50px;
                border-radius: 25px;
            }

            .search-icon {
                font-size: 30px;
                padding-left: 10px;
            }

            .search-bar {
                font-size: 14px;
                padding: 0 8px;
            }

            .search-btn {
                height: 40px;
                padding: 0 17px;
                font-size: 13px;
            }

            .hero {
                padding: 50px 20px 60px;
                margin-bottom: 20px;
            }

            .hero-image {
                width: 100%;
            }

            .hero-text h1 {
                font-size: 34px;
                line-height: 1.1;
            }

            .hero-text p {
                font-size: 14px;
                line-height: 1.6;
            }

            .product-btn {
                display: inline-block;
                padding: 13px 21px;
                font-size: 14px;
            }

            .new-arrivals {
                padding: 20px 10px;
            }

            .new-arrhead {
                font-size: 21px;
                padding: 0 8px;
            }

            .new {
                grid-template-columns: 1fr 1fr;
                gap: 20px 10px;
                padding: 0 8px;
            }

            .watch-info h2 {
                font-size: 16px;
            }

            .watch-name {
                font-size: 11px;
            }

            .watch-price {
                font-size: 15px;
            }

            .watch-rating {
                font-size: 12px;
            }

            .tag {
                font-size: 8px;
                padding: 3px 8px;
            }

            .collections,
            .best-sellers,
            .why-zeith,
            .reviews {
                padding: 70px 20px;
            }

            .section-heading {
                margin-bottom: 35px;
            }

            .section-heading p {
                font-size: 10px;
                letter-spacing: 2px;
            }

            .section-heading h2 {
                font-size: 32px;
                letter-spacing: -1px;
            }

            .collection-grid {
                grid-template-columns: 1fr;
                gap: 18px;
            }

            .collection-card {
                height: 420px;
            }

            .collection-content {
                left: 22px;
                bottom: 22px;
            }

            .collection-content h3 {
                font-size: 25px;
            }

            .product-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .product-card {
                padding: 15px;
            }

            .product-image {
                height: 300px;
            }

            .product-image img {
                width: 80%;
                height: 80%;
            }

            .story-image {
                height: 350px;
            }

            .story-text {
                padding: 60px 20px;
            }

            .story-text h2 {
                font-size: 40px;
            }

            .story-p {
                font-size: 14px;
            }

            .features {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .feature {
                padding: 20px;
            }

            .promo {
                min-height: 400px;
                padding: 60px 20px;
            }

            .promo-content h2 {
                font-size: 50px;
                letter-spacing: -3px;
            }

            .promop {
                font-size: 14px;
            }

            .review-grid {
                grid-template-columns: 1fr;
                gap: 18px;
            }

            .review {
                padding: 25px;
            }
        }

        /* ==========================================
   RESPONSIVE LAYOUT (<= 400px)
   ========================================== */
        @media (max-width: 400px) {
            .pg-head {
                padding: 12px;
            }

            .logo h1 {
                font-size: 24px;
            }

            .nav-bar {
                gap: 9px;
            }

            .nav-bar .icon {
                font-size: 16px;
            }

            .search-container {
                height: 46px;
            }

            .search-icon {
                font-size: 27px;
                padding-left: 8px;
            }

            .search-btn {
                height: 36px;
                padding: 0 13px;
                font-size: 12px;
            }

            .hero {
                padding: 40px 15px 50px;
            }

            .hero-text h1 {
                font-size: 29px;
            }

            .new {
                gap: 18px 8px;
            }

            .watch-info h2 {
                font-size: 14px;
            }

            .watch-price {
                font-size: 14px;
            }

            .collections,
            .best-sellers,
            .why-zeith,
            .reviews {
                padding: 60px 15px;
            }

            .section-heading h2 {
                font-size: 28px;
            }

            .collection-card {
                height: 380px;
            }

            .product-image {
                height: 270px;
            }

            .story-text h2 {
                font-size: 34px;
            }

            .promo-content h2 {
                font-size: 42px;
            }
        }

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

        /* =========================================
   WATCHES GRID & LUXURY CARD STYLING
========================================= */
        .property-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            /* Updated to 3-column layout */
            gap: 32px;
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px 0;
        }

        .property-card.watch-card {
            background: #ffffff;
            border-radius: 28px;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            display: flex;
            flex-direction: column;
            position: relative;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .property-card.watch-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.07);
        }

        /* TOP BAR (BADGE & HEART) */
        .card-top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: absolute;
            top: 20px;
            left: 20px;
            right: 20px;
            z-index: 10;
        }

        .status-badge {
            background: #e2f0d9;
            color: #2b6118;
            font-size: 11px;
            font-weight: 700;
            padding: 6px 14px;
            border-radius: 20px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .status-badge.sold-out {
            background: #fde8e8 !important;
            color: #9b1c1c !important;
        }

        .wishlist-heart,
        .wishlist-btn {
            width: 38px;
            height: 38px;
            background: #ffffff;
            border-radius: 50%;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: transform 0.2s ease, background 0.2s ease;
            color: #cccccc;
        }

        .wishlist-heart:hover,
        .wishlist-btn.active {
            transform: scale(1.08);
            color: #ff5252;
        }

        .wishlist-heart svg {
            width: 18px;
            height: 18px;
            fill: currentColor;
        }

        /* HERO IMAGE CONTAINER */
        .watch-image-container {
            width: 100%;
            height: 270px;
            border-radius: 22px;
            background: linear-gradient(180deg, #ffffff 0%, #f3f3f5 100%);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            overflow: hidden;
        }

        .watch-image-container img.card-main-img {
            max-width: 80%;
            max-height: 80%;
            object-fit: contain;
            transition: opacity 0.25s ease, transform 0.25s ease;
        }

        /* CAROUSEL ARROWS */
        .carousel-arrow {
            width: 34px;
            height: 34px;
            background: #ffffff;
            border-radius: 50%;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: #111111;
            z-index: 5;
            transition: background 0.2s ease, transform 0.2s ease;
        }

        .carousel-arrow:hover {
            background: #f8f8f8;
            transform: translateY(-50%) scale(1.08);
        }

        .carousel-arrow.prev-arrow {
            left: 12px;
        }

        .carousel-arrow.next-arrow {
            right: 12px;
        }

        /* PRICE & PROGRESS OVERLAY BAR */
        .price-overlay-bar {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 16px 18px 12px;
            background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.75) 100%);
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .price-display {
            color: #ffffff;
            font-size: 24px;
            font-weight: 800;
            text-align: right;
            letter-spacing: -0.5px;
        }

        .progress-indicators {
            display: flex;
            gap: 6px;
            width: 100%;
        }

        .progress-bar-segment {
            height: 4px;
            flex-grow: 1;
            background: rgba(255, 255, 255, 0.35);
            border-radius: 2px;
            transition: background-color 0.25s ease;
        }

        .progress-bar-segment.active {
            background: #ffffff;
        }

        /* DETAILS CONTENT */
        .watch-details-content {
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }

        .watch-title-text {
            font-size: 20px;
            font-weight: 800;
            color: #111111;
            margin-bottom: 8px;
            letter-spacing: -0.3px;
        }

        .watch-desc-text {
            font-size: 13px;
            color: #999999;
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            max-width: 90%;
            font-weight: 400;
        }

        /* FOOTER ACTIONS */
        .card-footer-actions {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: auto;
        }

        .add-button {
            background: #ff8a00;
            color: #000000;
            border: none;
            border-radius: 24px;
            padding: 10px 28px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s ease, transform 0.2s ease;
        }

        .add-button:hover {
            background: #e57c00;
            transform: translateY(-2px);
        }

        .add-button.disabled,
        .add-button:disabled {
            background: #e0e0e0 !important;
            color: #888888 !important;
            cursor: not-allowed !important;
            transform: none !important;
        }

        .view-details-link {
            color: #ff8a00;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.2s ease;
            margin-left: 130px;
        }

        .view-details-link:hover {
            color: #e57c00;
            text-decoration: underline;
        }

        /* RESPONSIVE LAYOUT */
        @media (max-width: 1200px) {
            .property-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 900px) {
            .property-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .property-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
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

            <div class="property-grid" id="watchGrid">
                <?php if (!empty($watches)): ?>
                    <?php foreach ($watches as $watch): ?>
                        <?php
                        $watchId    = htmlspecialchars((string)$watch['id']);
                        $watchName  = htmlspecialchars($watch['name']);
                        $watchBrand = htmlspecialchars($watch['brand'] ?? 'ZEITH');
                        $watchPrice = "₦" . number_format((float)$watch['price']);
                        $watchDesc  = htmlspecialchars($watch['description'] ?? 'Exclusive luxury craftsmanship with precision movement.');

                        // 1. Stock Evaluation matching home.php ($watch['stock'] == 0)
                        $stock = (int)($watch['stock'] ?? 10);
                        $isSoldOut = ($stock <= 0);

                        // 2. Direct Image Resolution matching home.php
                        $rawImg1 = trim($watch['image_url_1'] ?? $watch['image_url'] ?? 'default.png');
                        $rawImg2 = trim($watch['image_url_2'] ?? $watch['image_url_1'] ?? 'default.png');
                        $rawImg3 = trim($watch['image_url_3'] ?? $watch['image_url_1'] ?? 'default.png');
                        $rawImg4 = trim($watch['image_url_4'] ?? $watch['image_url_1'] ?? 'default.png');

                        $resolvePath = function ($val) {
                            if (strpos($val, 'http://') === 0 || strpos($val, 'https://') === 0) {
                                return $val;
                            }
                            return '/Watch_Collection/assets/image/' . ltrim($val, '/');
                        };

                        $img1 = $resolvePath($rawImg1);
                        $img2 = $resolvePath($rawImg2);
                        $img3 = $resolvePath($rawImg3);
                        $img4 = $resolvePath($rawImg4);
                        ?>

                        <div class="property-card watch-card"
                            data-id="<?= $watchId; ?>"
                            data-brand="<?= $watchBrand; ?>"
                            data-price="<?= (float)$watch['price']; ?>"
                            data-stock="<?= $stock; ?>"
                            data-images='["<?= $img1 ?>", "<?= $img2 ?>", "<?= $img3 ?>", "<?= $img4 ?>"]'>

                            <!-- CARD TOP BAR (STATUS BADGE & WISHLIST HEART) -->
                            <div class="card-top-bar">
                                <?php if ($isSoldOut): ?>
                                    <span class="status-badge sold-out">SOLD OUT</span>
                                <?php else: ?>
                                    <span class="status-badge available">AVAILABLE</span>
                                <?php endif; ?>

                                <button type="button" class="wishlist-btn wishlist-heart"
                                    data-id="<?= $watchId; ?>"
                                    title="Add to Wishlist" aria-label="Add to wishlist">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                    </svg>
                                </button>
                            </div>

                            <!-- HERO IMAGE CONTAINER WITH CAROUSEL & OVERLAY -->
                            <div class="watch-image-container">
                                <button class="carousel-arrow prev-arrow" type="button">&lsaquo;</button>
                                <img class="card-main-img" src="<?= $img1; ?>" alt="<?= $watchName; ?>">
                                <button class="carousel-arrow next-arrow" type="button">&rsaquo;</button>

                                <div class="price-overlay-bar">
                                    <div class="price-display"><?= $watchPrice; ?></div>
                                    <div class="progress-indicators">
                                        <div class="progress-bar-segment active"></div>
                                        <div class="progress-bar-segment"></div>
                                        <div class="progress-bar-segment"></div>
                                        <div class="progress-bar-segment"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- CARD DETAILS CONTENT -->
                            <div class="watch-details-content">
                                <h2 class="watch-title-text"><?= $watchName; ?></h2>
                                <p class="watch-desc-text"><?= $watchDesc; ?></p>
                            </div>

                            <!-- FOOTER ACTIONS (Keeps standard "Add" button visible) -->
                            <div class="card-footer-actions">
                                <button type="button" class="add-button">Add</button>
                                <a href="/Watch_Collection/watch/details/<?= $watchId; ?>" class="view-details-link">View details &rarr;</a>
                            </div>

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

            // 1. SELECTORS & VARIABLES
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
            const itemContainer = document.getElementById('cart-items');
            const subtotalElement = document.getElementById('cart-subtotal');
            const badge = document.getElementById('cart-count');
            const drawerCount = document.getElementById('drawer-item-count');
            const checkoutButton = document.getElementById('checkout-button');

            let activeBrand = 'all';

            // 2. HELPER & LOCALSTORAGE FUNCTIONS
            function readStorage(key) {
                try {
                    const value = JSON.parse(localStorage.getItem(key)) || [];
                    return Array.isArray(value) ? value : [];
                } catch (e) {
                    return [];
                }
            }

            function readCart() {
                return readStorage('zeith_cart').map(item => {
                    if (item && typeof item === 'object') {
                        return {
                            ...item,
                            id: String(item.id || ''),
                            price: Number(item.price) || 0,
                            quantity: Math.max(1, Number(item.quantity) || 1),
                            stock: Number(item.stock) || 10,
                            strap: item.strap || 'Steel'
                        };
                    }
                    return {
                        id: String(item || ''),
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
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                });
            }

            function escapeHTML(value) {
                return String(value || '').replace(/[&<>"']/g, character => ({
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#039;'
                } [character]));
            }

            // 3. PRICE & BRAND FILTERING
            function filterWatches() {
                if (!priceSlider) return;
                const maxPrice = parseFloat(priceSlider.value) || 0;
                let visibleCount = 0;

                cards.forEach(card => {
                    const price = parseFloat(card.dataset.price) || 0;
                    const brand = (card.dataset.brand || '').toLowerCase();

                    const matchesPrice = price <= maxPrice;
                    const matchesBrand = activeBrand === 'all' || brand.includes(activeBrand.toLowerCase());

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
                    priceLabel.textContent = `PRICE: ₦3,000 – ₦${value.toLocaleString()}`;
                    filterWatches();
                });
            }

            btnFilter?.addEventListener('click', filterWatches);

            brandLinks.forEach(link => {
                link.addEventListener('click', (event) => {
                    event.preventDefault();
                    activeBrand = link.dataset.brand || 'all';

                    if (selectedCategoryText) {
                        selectedCategoryText.textContent = link.textContent.trim();
                    }

                    filterWatches();
                });
            });

            // 4. UNIFIED WISHLIST CONTROLLER & HEART HIGHLIGHT SYNC
            function updateWishlistBadge() {
                const wishlistBadge = document.getElementById('wishlist-count');
                if (!wishlistBadge) return;

                const wishlist = readStorage('zeith_wishlist').map(String);
                wishlistBadge.textContent = wishlist.length;
                wishlistBadge.style.display = wishlist.length > 0 ? 'inline-block' : 'none';
            }

            function syncWishlistHearts() {
                const wishlist = readStorage('zeith_wishlist').map(String);
                const buttons = document.querySelectorAll('.wishlist-btn, .wishlist-heart, .wishlist-heart-btn');

                buttons.forEach(button => {
                    const card = button.closest('.property-card, .watch-card, .arrivals, .watch-detail');
                    const id = String(button.dataset.id || button.getAttribute('data-id') || card?.dataset.id || card?.getAttribute('data-id') || '');

                    if (!id) return;

                    const isActive = wishlist.includes(id);
                    button.classList.toggle('active', isActive);

                    const svgPath = button.querySelector('svg path, path');
                    if (isActive) {
                        button.style.color = '#ff5252';
                        if (svgPath) svgPath.style.fill = '#ff5252';
                    } else {
                        button.style.color = '';
                        if (svgPath) svgPath.style.fill = 'currentColor';
                    }
                });

                updateWishlistBadge();
            }

            // Single unified click handler for Wishlist Hearts
            document.addEventListener('click', (e) => {
                const heartBtn = e.target.closest('.wishlist-btn, .wishlist-heart, .wishlist-heart-btn');
                if (!heartBtn) return;

                e.preventDefault();
                e.stopPropagation();

                const card = heartBtn.closest('.property-card, .watch-card, .arrivals, .watch-detail');
                const watchId = String(heartBtn.dataset.id || heartBtn.getAttribute('data-id') || card?.dataset.id || card?.getAttribute('data-id') || '');

                if (!watchId) return;

                let wishlist = readStorage('zeith_wishlist').map(String);

                if (wishlist.includes(watchId)) {
                    wishlist = wishlist.filter(id => id !== watchId);
                } else {
                    wishlist.push(watchId);
                }

                localStorage.setItem('zeith_wishlist', JSON.stringify(wishlist));
                window.dispatchEvent(new Event('storage'));
                syncWishlistHearts();
            });

            // 5. CART DRAWER CONTROLS
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
                if (!itemContainer || !subtotalElement) return;

                const cart = readCart();
                const count = cart.reduce((sum, item) => sum + item.quantity, 0);
                const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);

                updateCartBadge(cart);

                if (cart.length === 0) {
                    itemContainer.innerHTML = `
                <div class="cart-empty">
                    <i class="fa-solid fa-bag-shopping"></i>
                    <h3>Your bag is waiting</h3>
                    <p>Add a luxury timepiece to get started.</p>
                </div>`;
                } else {
                    itemContainer.innerHTML = cart.map((item, index) => `
                <article class="cart-item" data-index="${index}">
                    <div class="cart-item-image">
                        ${item.image ? `<img src="${escapeHTML(item.image)}" alt="${escapeHTML(item.name)}">` : `<i class="fa-regular fa-clock"></i>`}
                    </div>
                    <div>
                        <span class="cart-item-brand">${escapeHTML(item.brand || 'ZEITH')}</span>
                        <h4 class="cart-item-name">${escapeHTML(item.name)}</h4>
                        <div class="cart-item-price">${money(item.price)}</div>
                        <div class="cart-item-bottom">
                            <div class="cart-quantity">
                                <button type="button" data-action="decrease" aria-label="Decrease quantity">-</button>
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

            openButton?.addEventListener('click', openCart);
            closeButton?.addEventListener('click', closeCart);
            continueButton?.addEventListener('click', closeCart);
            overlay?.addEventListener('click', closeCart);

            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape' && drawer?.classList.contains('open')) {
                    closeCart();
                }
            });

            // 6. CAROUSEL SLIDE ARROWS LOGIC
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

            // 7. ADD TO CART & SOLD OUT ALERT
            document.addEventListener('click', (event) => {
                const addButton = event.target.closest('.add-button, .property-add-btn');
                if (!addButton) return;

                const card = addButton.closest('.property-card, .watch-card, .arrivals, .watch-detail');
                if (!card) return;

                const stock = Number(card.dataset.stock);
                const statusBadge = card.querySelector('.status-badge');
                const isSoldOut = (stock <= 0) || (statusBadge && statusBadge.textContent.trim().toUpperCase() === 'SOLD OUT');

                // Trigger alert and stop adding to cart if Sold Out
                if (isSoldOut) {
                    event.preventDefault();
                    event.stopPropagation();
                    alert('This watch is currently Sold Out and cannot be added to your cart.');
                    return;
                }

                const id = String(card.dataset.id || card.getAttribute('data-id') || addButton.getAttribute('data-id') || '');
                if (!id || id === 'null' || id === 'undefined') return;

                const nameElement = card.querySelector('.property-card-title, .property-card-name, .watch-name, .watch-title-text, h2, h3, h1');
                const brandElement = card.querySelector('.property-card-brand, .watch-brand');
                const priceElement = card.querySelector('.property-card-price, .price-display, .watch-price, .price');
                const imgElement = card.querySelector('.card-main-img, .property-card-image img, img');

                const rawPrice = card.dataset.price || priceElement?.textContent || '';
                const price = Number(String(rawPrice).replace(/[^\d.]/g, '')) || 0;

                const watch = {
                    id,
                    name: nameElement ? nameElement.textContent.trim() : 'Watch',
                    brand: brandElement ? brandElement.textContent.trim() : card.dataset.brand || 'ZEITH',
                    price,
                    image: imgElement ? imgElement.getAttribute('src') : '',
                    stock: stock || 10,
                    quantity: 1
                };

                let cart = readCart();
                const existingIndex = cart.findIndex(item => item.id === watch.id);
                const currentQty = existingIndex !== -1 ? Number(cart[existingIndex].quantity) : 0;

                if (currentQty + 1 > watch.stock) {
                    alert(`Sorry, we only have ${watch.stock} of this item in stock.`);
                    return;
                }

                if (existingIndex !== -1) {
                    cart[existingIndex].quantity = currentQty + 1;
                    cart[existingIndex].name = watch.name;
                    cart[existingIndex].brand = watch.brand;
                    cart[existingIndex].price = watch.price;
                    cart[existingIndex].image = watch.image;
                    cart[existingIndex].stock = watch.stock;
                } else {
                    cart.push(watch);
                }

                saveCart(cart);
                openCart();

                const oldText = addButton.textContent;
                addButton.textContent = 'Added!';
                setTimeout(() => {
                    addButton.textContent = oldText;
                }, 900);
            });

            // 8. CART QUANTITY CONTROLS
            itemContainer?.addEventListener('click', (event) => {
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

            // 9. LISTENERS & CROSS-TAB SYNC
            window.addEventListener('storage', (event) => {
                if (event.key === 'zeith_cart') renderCart();
                if (event.key === 'zeith_wishlist') syncWishlistHearts();
            });

            window.addEventListener('focus', syncWishlistHearts);

            // Initial load setup
            syncWishlistHearts();
            filterWatches();
            renderCart();
        });
    </script>
</body>

</html>
```