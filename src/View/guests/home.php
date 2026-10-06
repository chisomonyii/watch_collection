<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        /* Container for the arrivals grid */
.new {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 20px;
}

/* Individual Watch Card */
.arrivals {
    position: relative; /* CRITICAL: Serves as the anchor for absolute elements inside */
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 380px; /* Gives enough vertical space for image, text & bottom button */
    padding: 16px;
    padding-bottom: 50px; /* Prevents text from hiding under the bottom-left button */
    box-sizing: border-box;
    background: #ffffff;
    border-radius: 12px;
}

/* Image styling */
.arrivals img {
    width: 100%;
    height: 180px;
    object-fit: contain;
    display: block;
    margin: 0 auto 12px;
}

/* Wishlist Heart Icon - Top Right */
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

/* Add Button - Bottom Left */
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
    transition: background-color 0.2s ease, transform 0.1s ease;
    z-index: 5;
}

.add-button:hover {
    background: black;
    color: white;
    transform: translateY(-1px);
}
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/69c405441a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?php assets("css/login.css"); ?>">
    <link rel="stylesheet" href="<?php assets("css/header.css"); ?>">
    <link rel="stylesheet" href="<?php assets("css/footer.css"); ?>">
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
            <img src="<?php assets("Images/watch.png"); ?>" alt="Premium Watch">
        </div>
    </section>

    <section class="new-arrivals">
        <h1 class="new-arrhead">New Arrivals!!</h1>

        <div class="new">
            <?php if (!empty($newArrivals)): ?>
                <?php foreach ($newArrivals as $product): ?>
                    <div class="arrivals" data-id="<?= htmlspecialchars($product['id'] ?? ''); ?>">
                        <div class="wishlist-heart" title="Add to wishlist">♥</div>
                        <img src="/Watch_Collection/assets/Images/<?= htmlspecialchars($product['image_url'] ?? $product['image'] ?? ''); ?>"
                            alt="<?= htmlspecialchars($product['name'] ?? 'Watch'); ?>">

                        <span class="watch-info">
                            <!-- Null coalescing (??) prevents undefined key warnings -->
                            <h2><?= htmlspecialchars($product['brand'] ?? $product['collection_name'] ?? ''); ?></h2>
                            <p class="watch-name"><?= htmlspecialchars($product['name'] ?? ''); ?></p>
                            <p class="watch-price">$<?= number_format($product['price'] ?? 0); ?></p>
                            <button class="add-button">Add</button>
                        </span>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No products found.</p>
            <?php endif; ?>
        </div>
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

                <img src="<?php assets("Images/picture11.png"); ?>"
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

                <img src="<?php assets("Images/picture12.png"); ?>"
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

                <img src="<?php assets("Images/picture13.png"); ?>"
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

                    <img src="<?php assets("Images/picture6.png"); ?>"
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

                    <img src="<?php assets("Images/picture11.png"); ?>"
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

                    <img src="<?php assets("Images/picture4.png"); ?>"
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

            <img src="<?php assets("Images/picture2.png"); ?>"
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
    <script src="<?php assets("js/home.js"); ?>"></script>
</body>

</html>