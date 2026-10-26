<?php
// components/best-seller.php
$bestSellers = $bestSellers ?? [];
$trendingWatches = $trendingWatches ?? [];
?>

<style>
    /* =========================================
   ZEITH — BEST SELLERS
========================================= */

    .zeith-best-sellers {
        width: 100%;
        padding: 58px 3% 70px;
        background: #ffffff;
        color: #111111;
        font-family: Arial, Helvetica, sans-serif;
        overflow: hidden;
    }

    .zeith-best-sellers *,
    .zeith-best-sellers *::before,
    .zeith-best-sellers *::after {
        box-sizing: border-box;
    }


    /* =========================================
   CONTAINER
========================================= */

    .best-sellers-container {
        width: 100%;
        max-width: 1460px;
        margin: 0 auto;
    }


    /* =========================================
   SECTION HEADING
========================================= */

    .best-sellers-heading {
        text-align: center;
        margin-bottom: 38px;
    }

    .best-sellers-label {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 16px;

        margin-bottom: 10px;

        color: #a8947b;

        font-size: 12px;
        font-weight: 700;

        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .best-sellers-label::before,
    .best-sellers-label::after {
        content: "";

        width: 70px;
        height: 1px;

        background: #dedbd5;
    }

    .best-sellers-heading h2 {
        margin: 0;

        color: #111111;

        font-family: Georgia, "Times New Roman", serif;

        font-size: clamp(40px, 4vw, 58px);
        font-weight: 400;

        line-height: 1.05;
        letter-spacing: -1.5px;
    }

    .best-sellers-heading p {
        margin: 12px 0 0;

        color: #555555;

        font-size: 14px;
        line-height: 1.5;
    }


    /* =========================================
   PRODUCTS GRID
========================================= */

    .best-sellers-grid {
        display: grid;

        gap: 18px;

        width: 100%;
    }


    /* =========================================
   PRODUCT CARD
========================================= */

    .best-product-card {
        position: relative;

        min-width: 0;

        display: flex;
        flex-direction: column;

        padding: 10px 10px 12px;

        background: #ffffff;

        border: 1px solid #dedede;

        border-radius: 14px;

        overflow: hidden;

        box-shadow:
            0 5px 16px rgba(0, 0, 0, 0.07);

        transition:
            transform 0.3s ease,
            box-shadow 0.3s ease;
    }

    .best-product-card:hover {
        transform: translateY(-5px);

        box-shadow:
            0 14px 28px rgba(0, 0, 0, 0.13);
    }


    /* =========================================
   IMAGE AREA
========================================= */

    .best-product-image {
        position: relative;

        width: 100%;
        height: 240px;

        overflow: hidden;

        border-radius: 9px;

        background: #f3f3f1;
    }

    .best-product-image img {
        display: block;

        width: 100%;
        height: 100%;

        object-fit: cover;
        object-position: center;

        transition: transform 0.45s ease;
    }

    .best-product-card:hover .best-product-image img {
        transform: scale(1.035);
    }


    /* =========================================
   BADGE
========================================= */

    .best-product-badge {
        position: absolute;

        top: 12px;
        left: 12px;

        z-index: 3;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        min-height: 27px;

        padding: 0 12px;

        border-radius: 20px;

        background: #f68b1e;
        color: #ffffff;

        font-size: 10px;
        font-weight: 800;

        letter-spacing: 0.3px;
        text-transform: uppercase;

        box-shadow:
            0 4px 10px rgba(246, 139, 30, 0.22);
    }

    .best-product-badge.trending {
        background: #111111;
        color: #ffffff;
    }

    .best-product-badge span {
        margin-right: 5px;

        font-size: 12px;
    }


    /* =========================================
   PRODUCT INFORMATION
========================================= */

    .best-product-info {
        display: flex;
        flex-direction: column;

        flex: 1;

        padding: 12px 7px 0;
    }


    /* BRAND */

    .best-product-brand {
        margin: 0 0 3px;

        color: #555555;

        font-size: 12px;
        font-weight: 700;

        letter-spacing: 0.5px;
        text-transform: uppercase;
    }


    /* PRODUCT NAME */

    .best-product-name {
        margin: 0;

        min-height: 42px;

        color: #111111;

        font-family: Georgia, "Times New Roman", serif;

        font-size: 24px;
        font-weight: 400;

        line-height: 1.08;
    }


    /* =========================================
   PRICE
========================================= */

    .best-product-price {
        margin: 8px 0 5px;

        color: #d88314;

        font-size: 21px;
        font-weight: 800;

        line-height: 1.2;
    }


    /* =========================================
   RATING
========================================= */

    .best-product-rating {
        display: flex;
        align-items: center;
        gap: 7px;

        margin-bottom: 10px;
    }

    .best-product-stars {
        color: #d59a3c;

        font-size: 15px;

        letter-spacing: 0.5px;
    }

    .best-product-count {
        color: #555555;

        font-size: 11px;
    }


    /* =========================================
   BUTTON
========================================= */

    .best-product-button {
        width: 100%;

        min-height: 42px;

        display: flex;
        align-items: center;
        justify-content: center;

        gap: 8px;

        border: 0;
        border-radius: 22px;

        background: #f68b1e;
        color: #ffffff;

        font-size: 13px;
        font-weight: 700;

        letter-spacing: 0.4px;

        text-decoration: none;

        cursor: pointer;

        transition:
            background 0.25s ease,
            transform 0.25s ease,
            box-shadow 0.25s ease;
    }

    .best-product-button:hover {
        background: #000000;

        transform: translateY(-2px);

        box-shadow:
            0 7px 15px rgba(0, 0, 0, 0.16);
    }


    /* SEARCH ICON */

    .best-product-button .search-icon {
        position: relative;

        width: 14px;
        height: 14px;

        display: inline-block;

        border: 1.5px solid rgba(255, 255, 255, 0.85);

        border-radius: 50%;
    }

    .best-product-button .search-icon::after {
        content: "";

        position: absolute;

        width: 6px;
        height: 1.5px;

        right: -4px;
        bottom: -2px;

        background: rgba(255, 255, 255, 0.85);

        transform: rotate(45deg);

        transform-origin: left center;
    }


    /* =========================================
   TABLET
========================================= */

    @media (max-width: 1200px) {

        .zeith-best-sellers {
            padding: 50px 3% 60px;
        }

        .best-sellers-grid {
            grid-template-columns:
                repeat(3, minmax(0, 1fr));

            gap: 18px;
        }

        .best-product-image {
            height: 250px;
        }

        .best-product-name {
            font-size: 22px;
        }
    }


    /* =========================================
   SMALL TABLET
========================================= */

    @media (max-width: 800px) {

        .best-sellers-grid {
            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap: 18px;
        }

        .best-product-image {
            height: 260px;
        }
    }


    /* =========================================
   MOBILE
========================================= */

    @media (max-width: 550px) {

        .zeith-best-sellers {
            padding: 45px 15px 55px;
        }

        .best-sellers-heading {
            margin-bottom: 30px;
        }

        .best-sellers-label {
            gap: 10px;

            font-size: 10px;
        }

        .best-sellers-label::before,
        .best-sellers-label::after {
            width: 35px;
        }

        .best-sellers-heading h2 {
            font-size: 39px;
        }

        .best-sellers-heading p {
            font-size: 12px;
        }

        .best-sellers-grid {
            grid-template-columns: 1fr 1fr;

            gap: 12px;
        }

        .best-product-card {
            padding: 7px 7px 9px;

            border-radius: 11px;
        }

        .best-product-image {
            height: 190px;

            border-radius: 7px;
        }

        .best-product-badge {
            top: 8px;
            left: 8px;

            min-height: 23px;

            padding: 0 8px;

            font-size: 8px;
        }

        .best-product-badge span {
            font-size: 9px;
        }

        .best-product-info {
            padding: 9px 4px 0;
        }

        .best-product-brand {
            font-size: 9px;
        }

        .best-product-name {
            min-height: 35px;

            font-size: 18px;
        }

        .best-product-price {
            margin-top: 6px;

            font-size: 17px;
        }

        .best-product-rating {
            gap: 4px;
            margin-bottom: 8px;
        }

        .best-product-stars {
            font-size: 12px;
        }

        .best-product-count {
            font-size: 9px;
        }

        .best-product-button {
            min-height: 38px;

            font-size: 10px;

            border-radius: 20px;
        }

        .best-product-button .search-icon {
            width: 11px;
            height: 11px;
        }
    }


    /* =========================================
   VERY SMALL MOBILE
========================================= */

    @media (max-width: 380px) {

        .best-sellers-grid {
            grid-template-columns: 1fr;
        }

        .best-product-image {
            height: 250px;
        }

        .best-product-name {
            font-size: 22px;
        }

        .best-product-price {
            font-size: 19px;
        }
    }


    /* =========================================
   REDUCED MOTION
========================================= */

    @media (prefers-reduced-motion: reduce) {

        .best-product-card,
        .best-product-image img,
        .best-product-button {
            transition: none;
        }
    }

    /* =========================================
   INFINITE CAROUSEL
========================================= */

    .best-sellers-carousel {
        width: 100%;
        overflow: hidden;

        position: relative;
    }


    /*
   The track is twice as wide because
   we have two identical sets of products.
*/

    .best-sellers-track {
        display: flex;
        width: max-content;

        gap: 18px;

        animation: zeithInfiniteCarousel 32s linear infinite;

        will-change: transform;
    }


    /*
   Move exactly one complete set of cards.
   Because the second set is identical,
   the reset is invisible.
*/

    @keyframes zeithInfiniteCarousel {

        from {
            transform: translateX(0);
        }

        to {
            transform: translateX(calc(-50% - 9px));
        }

    }


    /*
   Pause when user hovers.
*/

    .best-sellers-carousel:hover .best-sellers-track {
        animation-play-state: paused;
    }


    /*
   Important:
   The cards must have a fixed width
   when inside the moving carousel.
*/

    .best-sellers-track .best-product-card {

        width: 280px;
        flex: 0 0 280px;
    }


    /* =========================================
   DESKTOP
========================================= */

    @media (min-width: 1400px) {

        .best-sellers-track .best-product-card {

            width: 280px;
            flex-basis: 280px;
        }

    }


    /* =========================================
   TABLET
========================================= */

    @media (max-width: 1000px) {

        .best-sellers-track {
            gap: 15px;

            animation-duration: 28s;
        }

        .best-sellers-track .best-product-card {

            width: 260px;
            flex-basis: 260px;
        }

    }


    /* =========================================
   MOBILE
========================================= */

    @media (max-width: 600px) {

        .best-sellers-track {

            gap: 12px;

            animation-duration: 24s;
        }

        .best-sellers-track .best-product-card {

            width: 245px;
            flex-basis: 245px;
        }

    }


    /* =========================================
   REDUCED MOTION
========================================= */

    @media (prefers-reduced-motion: reduce) {

        .best-sellers-track {
            animation: none;
        }

    }
</style>
<section class="zeith-best-sellers" id="best-sellers">
    <div class="best-sellers-container">

        <!-- SECTION HEADING: BEST SELLERS -->
        <div class="best-sellers-heading">
            <div class="best-sellers-label"><span>MOST WANTED</span></div>
            <h2>Best Sellers</h2>
            <p>Our top-performing timepieces loved and purchased by customers</p>
        </div>

        <!-- BEST SELLERS CAROUSEL -->
        <div class="best-sellers-carousel">
            <div class="best-sellers-track">
                <?php
                for ($i = 0; $i < 2; $i++):
                    foreach ($bestSellers as $watch):
                        $imagePath = !empty($watch['image_url_1'])
                            ? "/Watch_Collection/assets/image/" . htmlspecialchars($watch['image_url_1'])
                            : "assets/image/banner/banner1.jpg";
                ?>
                        <article class="best-product-card" data-id="<?= $watch['id'] ?>" data-price="<?= $watch['price'] ?>" data-stock="<?= $watch['stock'] ?? 10 ?>">
                            <div class="best-product-image">
                                <div class="best-product-badge">
                                    <span>♛</span> BEST SELLER
                                </div>
                                <img src="<?= $imagePath ?>" alt="<?= htmlspecialchars($watch['name']) ?>">
                            </div>
                            <div class="best-product-info">
                                <p class="best-product-brand">ZEITH</p>
                                <h3 class="best-product-name"><?= htmlspecialchars($watch['name']) ?></h3>
                                <div class="best-product-price">₦<?= number_format($watch['price'], 2) ?></div>
                                <div class="best-product-rating">
                                    <span class="best-product-stars">★★★★★</span>
                                    <span class="best-product-count">(<?= htmlspecialchars($watch['rating'] ?? '5.0') ?>)</span>
                                </div>
                                <a href="/Watch_Collection/watch/details/<?= $watch['id'] ?>" class="best-product-button">VIEW DETAILS</a>
                            </div>
                        </article>
                <?php endforeach;
                endfor; ?>
            </div>
        </div>

        <!-- SECTION HEADING: TRENDING -->
        <div class="best-sellers-heading" style="margin-top: 70px;">
            <div class="best-sellers-label"><span>HOTTEST PICKS</span></div>
            <h2>Trending Favorites</h2>
            <p>The timepieces generating the most excitement and heart saves right now</p>
        </div>

        <!-- TRENDING CAROUSEL -->
        <div class="best-sellers-carousel">
            <div class="best-sellers-track">
                <?php
                for ($i = 0; $i < 2; $i++):
                    foreach ($trendingWatches as $watch):
                        $imagePath = !empty($watch['image_url_1'])
                            ? "/Watch_Collection/assets/image/" . htmlspecialchars($watch['image_url_1'])
                            : "assets/image/banner/banner1.jpg";
                ?>
                        <article class="best-product-card" data-id="<?= $watch['id'] ?>" data-price="<?= $watch['price'] ?>" data-stock="<?= $watch['stock'] ?? 10 ?>">
                            <div class="best-product-image">
                                <div class="best-product-badge trending">
                                    <span>🔥</span> TRENDING
                                </div>
                                <img src="<?= $imagePath ?>" alt="<?= htmlspecialchars($watch['name']) ?>">
                            </div>
                            <div class="best-product-info">
                                <p class="best-product-brand">ZEITH</p>
                                <h3 class="best-product-name"><?= htmlspecialchars($watch['name']) ?></h3>
                                <div class="best-product-price">₦<?= number_format($watch['price'], 2) ?></div>
                                <div class="best-product-rating">
                                    <span class="best-product-stars">★★★★★</span>
                                    <span class="best-product-count">(<?= htmlspecialchars($watch['rating'] ?? '5.0') ?>)</span>
                                </div>
                               <a href="/Watch_Collection/watch/details/<?= $watch['id'] ?>" class="best-product-button">VIEW DETAILS</a>
                            </div>
                        </article>
                <?php endforeach;
                endfor; ?>
            </div>
        </div>

    </div>
</section>