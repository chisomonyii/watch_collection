<!DOCTYPE html>
<html lang="en">

<head>

    <style>

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

        .floating-cart {
            position: fixed;

            right: 30px;
            bottom: 30px;

            width: 62px;
            height: 62px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: #f68b1e;
            color: #ffffff;

            border-radius: 50%;

            text-decoration: none;

            font-size: 24px;

            box-shadow: 0 5px 18px rgba(0, 0, 0, 0.20);

            z-index: 9999;

            transition: all 0.3s ease;
        }


        .floating-cart:hover {
            background: #003b2f;
            color: #ffffff;

            transform: scale(1.08);
        }


        /* =========================================
           CART COUNT
        ========================================= */

        .cart-count {
            position: absolute;

            top: -5px;
            right: -5px;

            min-width: 22px;
            height: 22px;

            padding: 2px 6px;

            display: none;
            align-items: center;
            justify-content: center;

            background: #e74c3c;
            color: #ffffff;

            border: 2px solid #ffffff;

            border-radius: 50%;

            font-size: 11px;
            font-weight: 700;
        }


        /* =========================================
           TABLET
        ========================================= */

        @media (max-width: 768px) {

            .floating-cart {
                width: 58px;
                height: 58px;

                right: 22px;
                bottom: 22px;

                font-size: 22px;
            }

        }


        /* =========================================
           MOBILE
        ========================================= */

        @media (max-width: 480px) {

            .floating-cart {
                width: 52px;
                height: 52px;

                right: 18px;
                bottom: 18px;

                font-size: 20px;
            }


            .cart-count {
                min-width: 20px;
                height: 20px;

                font-size: 10px;
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

        <div class="hero-text">

            <h1>
                WATCH<br>
                COLLECTION
            </h1>

            <p>
                Discover premium watches designed
                for style and precision.
            </p>

            <a href="http://google.com">

                <button class="product-btn">
                    SEE PRODUCTS
                </button>

            </a>

        </div>


        <div class="hero-image">

            <img
                src="<?php assets("Images/watch.png"); ?>"
                alt="Premium Watch">

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

                    <div
                        class="arrivals watch-card"
                        data-id="<?= htmlspecialchars($product['id'] ?? ''); ?>"
                    >

                        <!-- WISHLIST HEART -->

                        <div
                            class="wishlist-heart"
                            title="Add to wishlist"
                        >
                            ♥
                        </div>


                        <!-- WATCH IMAGE -->

                        <img
                            src="/Watch_Collection/assets/Images/<?= htmlspecialchars($product['image_url'] ?? $product['image'] ?? ''); ?>"
                            alt="<?= htmlspecialchars($product['name'] ?? 'Watch'); ?>"
                        >


                        <!-- WATCH INFORMATION -->

                        <span class="watch-info">

                            <h2>
                                <?= htmlspecialchars(
                                    $product['brand']
                                    ?? $product['collection_name']
                                    ?? ''
                                ); ?>
                            </h2>


                            <p class="watch-name">
                                <?= htmlspecialchars(
                                    $product['name']
                                    ?? ''
                                ); ?>
                            </p>


                            <p class="watch-price">
                                $<?= number_format(
                                    $product['price']
                                    ?? 0
                                ); ?>
                            </p>


                            <!-- ADD BUTTON -->

                            <button
                                class="add-button"
                                type="button"
                            >
                                Add
                            </button>

                        </span>

                    </div>

                <?php endforeach; ?>

            <?php else: ?>

                <p>
                    No products found.
                </p>

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
                    alt="Classic Watch"
                >

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
                        class="search-btn exp"
                    >
                        Explore
                    </a>

                </div>

            </div>



            <div class="collection-card">

                <img
                    src="<?php assets("Images/picture12.png"); ?>"
                    alt="Chronograph Watch"
                >

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
                        class="search-btn exp"
                    >
                        Explore
                    </a>

                </div>

            </div>



            <div class="collection-card">

                <img
                    src="<?php assets("Images/picture13.png"); ?>"
                    alt="Executive Watch"
                >

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
                        class="search-btn exp"
                    >
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
                        alt="Zeith Classic"
                    >

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
                        class="btn-view search-btn exp"
                    >
                        View Watch
                    </a>

                </div>

            </article>



            <article class="product-card">

                <div class="product-image">

                    <img
                        src="<?php assets("Images/picture11.png"); ?>"
                        alt="Zeith Chrono"
                    >

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
                        class="btn-view search-btn exp"
                    >
                        View Watch
                    </a>

                </div>

            </article>



            <article class="product-card">

                <div class="product-image">

                    <img
                        src="<?php assets("Images/picture4.png"); ?>"
                        alt="Zeith Executive"
                    >

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
                        class="btn-view search-btn exp"
                    >
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
                alt="Zeith Watch"
            >

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
                class="btn-view exp search-btn"
            >
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
                class="btn-shop exp search-btn"
            >
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



    <?php require_once __DIR__ . '/../components/footer.php'; ?>



    <!-- =========================================
         FIXED SHOPPING CART
    ========================================= -->

    <a
        href="cart.php"
        class="floating-cart"
        title="Shopping Cart"
    >

        <i class="fa-solid fa-cart-shopping"></i>

        <span
            class="cart-count"
            id="cart-count"
        >
            0
        </span>

    </a>



    <!-- =========================================
         JAVASCRIPT
    ========================================= -->

    <script>

        document.addEventListener('DOMContentLoaded', () => {


            /* =====================================
               WISHLIST BADGE
            ===================================== */

            updateWishlistBadge();


            /* =====================================
               LOAD SAVED WISHLIST
            ===================================== */

            const saved =
                JSON.parse(
                    localStorage.getItem('zeith_wishlist')
                ) || [];


            document
                .querySelectorAll('.arrivals, .watch-card')
                .forEach(card => {

                    const id =
                        String(
                            card.getAttribute('data-id')
                        );

                    const heart =
                        card.querySelector(
                            '.wishlist-heart'
                        );


                    if (
                        id &&
                        saved.includes(id) &&
                        heart
                    ) {

                        heart.classList.add('active');

                        heart.style.color =
                            '#e74c3c';

                    }

                });



            /* =====================================
               WISHLIST HEART CLICK
            ===================================== */

            document
                .querySelectorAll('.wishlist-heart')
                .forEach(heart => {

                    heart.addEventListener(
                        'click',
                        function (e) {

                            e.stopPropagation();


                            const card =
                                this.closest('.arrivals') ||
                                this.closest('.watch-card');


                            if (!card) return;


                            const watchId =
                                String(
                                    card.getAttribute(
                                        'data-id'
                                    )
                                );


                            let wishlist =
                                JSON.parse(
                                    localStorage.getItem(
                                        'zeith_wishlist'
                                    )
                                ) || [];


                            if (
                                wishlist.includes(
                                    watchId
                                )
                            ) {

                                wishlist =
                                    wishlist.filter(
                                        id =>
                                            id !== watchId
                                    );


                                this.classList.remove(
                                    'active'
                                );


                                this.style.color =
                                    '#f68b1e';

                            }

                            else {

                                wishlist.push(
                                    watchId
                                );


                                this.classList.add(
                                    'active'
                                );


                                this.style.color =
                                    '#e74c3c';

                            }


                            localStorage.setItem(
                                'zeith_wishlist',
                                JSON.stringify(
                                    wishlist
                                )
                            );


                            updateWishlistBadge();

                        }
                    );

                });



            /* =====================================
               ADD TO CART
            ===================================== */

            document
                .querySelectorAll('.add-button')
                .forEach(button => {

                    button.addEventListener(
                        'click',
                        function (e) {

                            e.stopPropagation();


                            const card =
                                this.closest(
                                    '.arrivals'
                                );


                            if (!card) return;


                            const productId =
                                String(
                                    card.getAttribute(
                                        'data-id'
                                    )
                                );


                            let cart =
                                JSON.parse(
                                    localStorage.getItem(
                                        'zeith_cart'
                                    )
                                ) || [];


                            /*
                             * Add the product ID
                             * only if it is not already
                             * inside the cart.
                             */

                            if (
                                productId &&
                                productId !== 'null' &&
                                productId !== 'undefined' &&
                                !cart.includes(productId)
                            ) {

                                cart.push(
                                    productId
                                );

                            }


                            localStorage.setItem(
                                'zeith_cart',
                                JSON.stringify(
                                    cart
                                )
                            );


                            updateCartBadge();


                            /* Button feedback */

                            const originalText =
                                this.textContent;


                            this.textContent =
                                'Added';


                            this.style.background =
                                '#003b2f';


                            this.style.color =
                                '#ffffff';


                            setTimeout(() => {

                                this.textContent =
                                    originalText;

                                this.style.background =
                                    '#f68b1e';

                                this.style.color =
                                    'black';

                            }, 1000);

                        }
                    );

                });



            /* =====================================
               LOAD CART COUNT
            ===================================== */

            updateCartBadge();

        });



        /* =========================================
           UPDATE WISHLIST BADGE
        ========================================= */

        function updateWishlistBadge() {

            const badge =
                document.getElementById(
                    'wishlist-count'
                );


            if (badge) {

                const wishlist =
                    JSON.parse(
                        localStorage.getItem(
                            'zeith_wishlist'
                        )
                    ) || [];


                badge.textContent =
                    wishlist.length;


                badge.style.display =
                    wishlist.length > 0
                        ? 'inline-block'
                        : 'none';

            }

        }



        /* =========================================
           UPDATE CART BADGE
        ========================================= */

        function updateCartBadge() {

            const cartCount =
                document.getElementById(
                    'cart-count'
                );


            if (!cartCount) return;


            const cart =
                JSON.parse(
                    localStorage.getItem(
                        'zeith_cart'
                    )
                ) || [];


            cartCount.textContent =
                cart.length;


            if (cart.length > 0) {

                cartCount.style.display =
                    'flex';

            }

            else {

                cartCount.style.display =
                    'none';

            }

        }

    </script>


</body>

</html>