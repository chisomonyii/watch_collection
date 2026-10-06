<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Wishlist</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f8f8f6;
            color: #003b2f;
        }

        /* =========================
           MAIN CONTAINER
        ========================= */

        .wishlist-container {
            width: 100%;
            max-width: 1450px;
            margin: 0 auto;
            padding: 35px 55px 50px;
        }

        /* =========================
           PAGE TITLE
        ========================= */

        .wishlist-title {
            text-align: center;
            font-size: 32px;
            font-weight: 700;
            color: #003b2f;
            margin-bottom: 35px;
        }

        /* =========================
           PRODUCTS GRID
        ========================= */

        .wishlist-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 35px;
        }

        /* =========================
           PRODUCT CARD
        ========================= */

        .watch-card {
            position: relative;
            text-align: center;
            padding: 10px 15px 20px;
            background: transparent;
            transition: transform 0.3s ease;
        }

        .watch-card:hover {
            transform: translateY(-5px);
        }

        /* =========================
           HEART
        ========================= */

        .wishlist-heart {
            position: absolute;
            top: 8px;
            left: 10px;

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

        /* =========================
           WATCH IMAGE
        ========================= */

        .watch-image {
            width: 100%;
            height: 320px;

            display: flex;
            align-items: center;
            justify-content: center;

            margin-bottom: 10px;
        }

        .watch-image img {
            width: 100%;
            height: 100%;

            object-fit: contain;

            display: block;
        }

        /* =========================
           PRODUCT NAME
        ========================= */

        .watch-name {
            font-size: 26px;
            font-weight: 700;
            color: #003b2f;
            margin-top: 5px;
            margin-bottom: 10px;
        }

        /* =========================
           DESCRIPTION
        ========================= */

        .watch-description {
            font-size: 16px;
            color: #c9c9c9;
            margin-bottom: 14px;
            font-weight: 400;
        }

        /* =========================
           PRICE
        ========================= */

        .watch-price {
            font-size: 25px;
            font-weight: 700;
            color: #003b2f;
            margin-bottom: 14px;
        }

        /* =========================
           RATING
        ========================= */

        .rating {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 2px;

            margin-bottom: 15px;
        }

        .stars {
            color: #f68b1e;
            font-size: 17px;
            letter-spacing: 1px;
        }

        .rating-number {
            color: #c5c5c5;
            font-size: 15px;
            margin-left: 4px;
        }

        /* =========================
           BADGE
        ========================= */

        .badge {
            display: inline-block;

            background: #003b2f;
            color: white;

            padding: 9px 17px;

            border-radius: 30px;

            font-size: 12px;
            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: 0.3px;
        }

        /* =========================
           IPAD / TABLET
        ========================= */

        @media (max-width: 1024px) {

            .wishlist-container {
                padding: 30px 30px 45px;
            }

            .wishlist-title {
                font-size: 30px;
                margin-bottom: 30px;
            }

            .wishlist-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 45px 25px;
            }

            .watch-image {
                height: 300px;
            }

            .watch-name {
                font-size: 24px;
            }

            .watch-price {
                font-size: 23px;
            }
        }

        /* =========================
           MOBILE
        ========================= */

        @media (max-width: 600px) {

            .wishlist-container {
                padding: 25px 18px 40px;
            }

            .wishlist-title {
                font-size: 27px;
                margin-bottom: 25px;
            }

            .wishlist-grid {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .watch-card {
                padding: 10px 10px 20px;
            }

            .watch-image {
                height: 300px;
            }

            .watch-name {
                font-size: 24px;
            }

            .watch-description {
                font-size: 15px;
            }

            .watch-price {
                font-size: 23px;
            }

            .wishlist-heart {
                top: 8px;
                left: 5px;
            }
        }

        /* =========================
           SMALL PHONES
        ========================= */

        @media (max-width: 375px) {

            .wishlist-container {
                padding: 20px 12px 35px;
            }

            .wishlist-title {
                font-size: 24px;
            }

            .watch-image {
                height: 260px;
            }

            .watch-name {
                font-size: 22px;
            }

            .watch-price {
                font-size: 21px;
            }

            .badge {
                font-size: 11px;
                padding: 8px 14px;
            }
        }
    </style>
</head>

<body>

    <main class="wishlist-container">

        <!-- PAGE TITLE -->
        <h1 class="wishlist-title">My Wishlist</h1>


        <!-- WATCHES -->
        <section class="wishlist-grid">


            <!-- WATCH 1 -->
            <div class="watch-card">

                <!-- HEART -->
                <div class="wishlist-heart" title="Remove from wishlist">
                    ♥
                </div>

                <div class="watch-image">
                    <img
                        src="images/benken-watch.png"
                        alt="Benken Watch"
                    >
                </div>

                <h2 class="watch-name">Benken</h2>

                <p class="watch-description">
                    Submariner • Automatic
                </p>

                <div class="watch-price">
                    $2,000
                </div>

                <div class="rating">
                    <span class="stars">★★★★★</span>
                    <span class="rating-number">4.9</span>
                </div>

                <span class="badge">
                    Best Seller
                </span>

            </div>


            <!-- WATCH 2 -->
            <div class="watch-card">

                <!-- HEART -->
                <div class="wishlist-heart" title="Remove from wishlist">
                    ♥
                </div>

                <div class="watch-image">
                    <img
                        src="images/u-boat-watch.png"
                        alt="U-Boat Watch"
                    >
                </div>

                <h2 class="watch-name">U-Boat</h2>

                <p class="watch-description">
                    Classic Fusion • Chronograph
                </p>

                <div class="watch-price">
                    $10,000
                </div>

                <div class="rating">
                    <span class="stars">★★★★★</span>
                    <span class="rating-number">4.8</span>
                </div>

                <span class="badge">
                    Limited Edition
                </span>

            </div>


            <!-- WATCH 3 -->
            <div class="watch-card">

                <!-- HEART -->
                <div class="wishlist-heart" title="Remove from wishlist">
                    ♥
                </div>

                <div class="watch-image">
                    <img
                        src="images/tissot-watch.png"
                        alt="Tissot Watch"
                    >
                </div>

                <h2 class="watch-name">Tissot</h2>

                <p class="watch-description">
                    Santos • Luxury Edition
                </p>

                <div class="watch-price">
                    $4,000
                </div>

                <div class="rating">
                    <span class="stars">★★★★★</span>
                    <span class="rating-number">4.9</span>
                </div>

                <span class="badge">
                    New
                </span>

            </div>


            <!-- WATCH 4 -->
            <div class="watch-card">

                <!-- HEART -->
                <div class="wishlist-heart" title="Remove from wishlist">
                    ♥
                </div>

                <div class="watch-image">
                    <img
                        src="images/casio-watch.png"
                        alt="Casio Watch"
                    >
                </div>

                <h2 class="watch-name">Casio</h2>

                <p class="watch-description">
                    Casio • Digital
                </p>

                <div class="watch-price">
                    $2,500
                </div>

                <div class="rating">
                    <span class="stars">★★★★★</span>
                    <span class="rating-number">4.7</span>
                </div>

                <span class="badge">
                    Trending
                </span>

            </div>

        </section>

    </main>

</body>
</html>