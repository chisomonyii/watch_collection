<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/69c405441a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?php assets("css/login.css");?>">
    <link rel="stylesheet" href="<?php assets("css/header.css");?>">
    <link rel="stylesheet" href="<?php assets("css/footer.css");?>">
    <title>Watch Collection</title>
</head>

<body>
    <?php require_once __DIR__ . '/../components/header.php'; ?>

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
            <img src="<?php assets("Images/watch.png");?>" alt="Premium Watch">
        </div>
    </section>

    <section class="new-arrivals">
        <h1 class="new-arrhead">New Arrivals!!</h1>

        <div class="new">
            <div class="arrivals">
                <img src="<?php assets("Images/picture3.png");?>" alt="Rolex Submariner">

                <span class="watch-info">
                    <h2>Benken</h2>
                    <p class="watch-name">Submariner • Automatic</p>
                    <p class="watch-price">$2,000</p>
                    <p class="watch-rating">★★★★★ <small>4.9</small></p>
                    <span class="tag">BEST SELLER</span>
                </span>
            </div>
            <div class="arrivals">
                <img src="<?php assets("Images/picture6.png");?>" alt="Hublot Classic Fusion">

                <span class="watch-info">
                    <h2>U-Boat</h2>
                    <p class="watch-name">Classic Fusion • Chronograph</p>
                    <p class="watch-price">$10,000</p>
                    <p class="watch-rating">★★★★★ <small>4.8</small></p>
                    <span class="tag">LIMITED EDITION</span>
                </span>
            </div>

            <div class="arrivals">
                <img src="<?php assets("Images/picture11.png");?>" alt="Cartier Santos">

                <span class="watch-info">
                    <h2>Tissot</h2>
                    <p class="watch-name">Santos • Luxury Edition</p>
                    <p class="watch-price">$4,000</p>
                    <p class="watch-rating">★★★★★ <small>4.9</small></p>
                    <span class="tag">NEW</span>
                </span>
            </div>

            <div class="arrivals">
                <img src="<?php assets("Images/picture9.png");?>" alt="Casio G-Shock">

                <span class="watch-info">
                    <h2>Casio</h2>
                    <p class="watch-name">Casio • Digital</p>
                    <p class="watch-price">$2,500</p>
                    <p class="watch-rating">★★★★☆ <small>4.7</small></p>
                    <span class="tag">TRENDING</span>
                </span>
            </div>
        </div>
        <div>
            <button class="arrive-btn search-btn">View all</button>
        </div>
    </section>
    <section class="collections">

        <div class="section-heading">

            <p>EXPLORE ZEITH</p>

            <h2>
                Find Your Timepiece
            </h2>

        </div>


        <div class="collection-grid">

            <div class="collection-card">

                <img src="<?php assets("Images/picture11.png");?>"
                    alt="Classic Watch">

                <div class="collection-content">

                    <p>01</p>

                    <h3>
                        The Classic
                    </h3>

                    <span>
                        Timeless elegance
                    </span>

                    <a href="#" class="search-btn exp">
                        Explore
                    </a>

                </div>

            </div>


            <div class="collection-card">

                <img src="<?php assets("Images/picture12.png");?>"
                    alt="Chronograph Watch">

                <div class="collection-content">

                    <p>02</p>

                    <h3>
                        The Chrono
                    </h3>

                    <span>
                        Built for precision
                    </span>

                    <a href="#" class="search-btn exp">
                        Explore
                    </a>

                </div>

            </div>


            <div class="collection-card">

                <img src="<?php assets("Images/picture13.png");?>"
                    alt="Executive Watch">

                <div class="collection-content">

                    <p>03</p>

                    <h3>
                        The Executive
                    </h3>

                    <span>
                        Made to impress
                    </span>

                    <a href="#" class="search-btn exp">
                        Explore
                    </a>

                </div>

            </div>

        </div>

    </section>
    <section class="best-sellers">

        <div class="section-heading">

            <p>MOST WANTED</p>

            <h2>
                Best Sellers
            </h2>

        </div>


        <div class="product-grid">

            <article class="product-card">

                <div class="product-image">

                    <img src="<?php assets("Images/picture6.png");?>"
                        alt="Zeith Classic">

                </div>

                <div class="product-info">

                    <p>ZEITH</p>

                    <h3>
                        Classic Black
                    </h3>

                    <span>
                        ₦85,000
                    </span>

                    <a href="#" class="btn-view search-btn exp">
                        View Watch
                    </a>

                </div>

            </article>


            <article class="product-card">

                <div class="product-image">

                    <img src="<?php assets("Images/picture11.png");?>"
                        alt="Zeith Chrono">

                </div>

                <div class="product-info">

                    <p>ZEITH</p>

                    <h3>
                        Chrono Silver
                    </h3>

                    <span>
                        ₦95,000
                    </span>

                    <a href="#" class="btn-view search-btn exp">
                        View Watch
                    </a>

                </div>

            </article>


            <article class="product-card">

                <div class="product-image">

                    <img src="<?php assets("Images/picture4.png");?>"
                        alt="Zeith Executive">

                </div>

                <div class="product-info">

                    <p>ZEITH</p>

                    <h3>
                        Executive Gold
                    </h3>

                    <span>
                        ₦110,000
                    </span>

                    <a href="#" class="btn-view search-btn exp">
                        View Watch
                    </a>

                </div>

            </article>

        </div>

    </section>
    <section class="story">

        <div class="story-image">

            <img src="<?php assets("Images/picture2.png");?>"
                alt="Zeith Watch">

        </div>


        <div class="story-text">

            <p class="story-pp">THE ZEITH STORY</p>

            <h2>
                More Than A Watch.
                <span>A Statement.</span>
            </h2>

            <p class="story-p">
                At Zeith, we believe a watch should be
                more than something that tells time.
                It should represent your style, ambition
                and the moments that matter.
            </p>

            <a href="#" class="btn-view exp search-btn">
                Discover Zeith
            </a>

        </div>

    </section>
    <section class="why-zeith">

        <div class="section-heading">

            <p>THE ZEITH STANDARD</p>

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
                    Confidence comes standard with every watch <span class="featuree">comes with a 2yr guarantee</span>.
                </p>

            </div>


            <div class="feature">

                <i class="fa-solid fa-truck-fast icon"></i>

                <h3>
                    Fast Delivery
                </h3>

                <p>
                    Your timepiece delivered safely to you anywhere in Nigeria.
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
    <section class="promo">

        <div class="promo-content">

            <p class="story-pp">
                THE ZEITH EXPERIENCE
            </p>

            <h2>
                TIME
                <span>IS YOURS.</span>
            </h2>

            <p class="promp">
                Wear every moment with confidence.
            </p>

            <a href="#" class="btn-shop exp search-btn">
                Shop Now
            </a>

        </div>

    </section>

    <section class="reviews">

        <div class="section-heading">

            <p>FROM OUR CUSTOMERS</p>

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
</body>

</html>