<?php
// components/reviews.php
?>

<style>
    /* =========================================
   ZEITH — THE WATCH JOURNAL
========================================= */

    /* =========================================
   ZEITH — CUSTOMER REVIEWS
   COMPACT VERSION
========================================= */

    .zeith-reviews {
        width: 100%;
        padding: 45px 4% 55px;
        background: #ffffff;
        color: #111827;
        font-family: Arial, Helvetica, sans-serif;
        overflow: hidden;
    }

    .zeith-reviews *,
    .zeith-reviews *::before,
    .zeith-reviews *::after {
        box-sizing: border-box;
    }

    .reviews-container {
        width: 100%;
        max-width: 1650px;
        margin: 0 auto;
    }


    /* =========================================
   HEADING
========================================= */

    .reviews-heading {
        text-align: center;
        margin-bottom: 38px;
    }

    .reviews-eyebrow {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;

        margin-bottom: 10px;

        color: #f68b1e;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .reviews-eyebrow span {
        font-size: 16px;
        color: #f68b1e;
    }

    .reviews-heading h2 {
        margin: 0;

        color: #101828;

        font-family: Georgia, "Times New Roman", serif;
        font-size: clamp(36px, 3.5vw, 52px);
        font-weight: 400;
        line-height: 1.1;
        letter-spacing: -1.5px;
    }


    /* =========================================
   REVIEWS GRID
========================================= */

    .reviews-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 32px;
        width: 100%;
    }


    /* =========================================
   REVIEW CARD
========================================= */

    .review-card {
        min-width: 0;
        min-height: 390px;
        height: auto;

        display: grid;
        grid-template-columns: 41% 59%;

        background: #ffffff;

        border: 1px solid #e7e9ed;
        border-radius: 20px;

        overflow: hidden;

        box-shadow:
            0 10px 25px rgba(15, 23, 42, 0.06);

        transition:
            transform 0.3s ease,
            box-shadow 0.3s ease;
    }

    .review-card:hover {
        transform: translateY(-4px);

        box-shadow:
            0 16px 32px rgba(15, 23, 42, 0.10);
    }


    /* =========================================
   IMAGE
========================================= */

    .review-image {
        position: relative;

        min-width: 0;
        height: 100%;

        overflow: hidden;

        background: #111111;
    }


    /* ORANGE TOP STRIP */




    .review-image img {
        width: 100%;
        height: 100%;

        display: block;

        object-fit: cover;
        object-position: center;

        transition: transform 0.5s ease;
    }

    .review-card:hover .review-image img {
        transform: scale(1.035);
    }


    /* =========================================
   CONTENT
========================================= */

    .review-content {
        min-width: 0;

        display: flex;
        flex-direction: column;
        justify-content: center;

        padding: 35px 38px;

        /* Allows the content to determine the card height */
        overflow: visible;
    }


    /* =========================================
   TITLE
========================================= */

    .review-title {
        margin: 0 0 17px;

        color: #111827;

        font-size: clamp(20px, 1.45vw, 26px);
        font-weight: 800;

        line-height: 1.35;

        letter-spacing: -0.5px;
    }


    /* =========================================
   META
========================================= */

    .review-meta {
        margin: 0 0 27px;

        color: #9aa4b5;

        font-size: 15px;
        font-weight: 500;

        line-height: 1.5;
    }


    /* =========================================
   REVIEW TEXT
========================================= */

    .review-text {
        margin: 0;

        color: #566276;

        font-size: 17px;
        font-weight: 400;

        line-height: 1.65;

        /* Important */
        white-space: normal;
        overflow-wrap: break-word;
        word-wrap: break-word;
    }


    /* =========================================
   RATING
========================================= */

    .review-rating {
        display: flex;
        align-items: center;
        gap: 5px;

        margin-top: 20px;

        color: #f68b1e;

        font-size: 16px;
        letter-spacing: 1px;
    }

    .review-number {
        margin-left: 7px;

        color: #8f98a7;

        font-size: 13px;
        letter-spacing: 0;
    }


    /* =========================================
   TABLET
========================================= */

    @media (max-width: 1200px) {

        .zeith-reviews {
            padding: 40px 3% 50px;
        }

        .reviews-grid {
            gap: 24px;
        }

        .review-card {
            height: 360px;
        }

        .review-content {
            padding: 30px;
        }

        .review-title {
            font-size: 21px;
        }

        .review-meta {
            font-size: 14px;
            margin-bottom: 22px;
        }

        .review-text {
            font-size: 15px;
            line-height: 1.6;
        }

        .review-image::before,
        .review-image::after {
            height: 28px;
        }
    }


    /* =========================================
   TABLET / SMALL LAPTOP
========================================= */

    @media (max-width: 900px) {

        .zeith-reviews {
            padding: 40px 4% 50px;
        }

        .reviews-heading {
            margin-bottom: 32px;
        }

        .reviews-grid {
            grid-template-columns: 1fr;
            gap: 25px;
        }

        .review-card {
            height: auto;
            min-height: 360px;
        }

        .review-content {
            padding: 32px 38px;
        }

        .review-title {
            font-size: 24px;
        }

        .review-text {
            font-size: 17px;
        }
    }


    /* =========================================
   MOBILE
========================================= */

    @media (max-width: 650px) {

        .zeith-reviews {
            padding: 35px 16px 45px;
        }

        .reviews-heading {
            margin-bottom: 28px;
        }

        .reviews-eyebrow {
            font-size: 11px;
            letter-spacing: 1.6px;
        }

        .reviews-heading h2 {
            font-size: 34px;
            letter-spacing: -1px;
        }

        .reviews-grid {
            gap: 20px;
        }

        .review-card {
            display: grid;
            grid-template-columns: 1fr;

            height: auto;

            border-radius: 17px;
        }

        .review-image {
            height: 250px;
        }

        .review-image::before,
        .review-image::after {
            height: 22px;
        }

        .review-content {
            padding: 28px 24px 30px;
        }

        .review-title {
            font-size: 21px;
            line-height: 1.35;
            margin-bottom: 14px;
        }

        .review-meta {
            font-size: 14px;
            margin-bottom: 22px;
        }

        .review-text {
            font-size: 15px;
            line-height: 1.65;
        }

        .review-rating {
            margin-top: 18px;
        }
    }


    /* =========================================
   SMALL MOBILE
========================================= */

    @media (max-width: 400px) {

        .zeith-reviews {
            padding-left: 13px;
            padding-right: 13px;
        }

        .reviews-heading h2 {
            font-size: 30px;
        }

        .review-image {
            height: 225px;
        }

        .review-content {
            padding: 25px 20px 28px;
        }

        .review-title {
            font-size: 20px;
        }

        .review-text {
            font-size: 14px;
        }
    }


    /* =========================================
   REDUCED MOTION
========================================= */

    @media (prefers-reduced-motion: reduce) {

        .review-card,
        .review-image img {
            transition: none;
        }
    }
</style>





<section class="zeith-reviews" id="customer-reviews">
    <div class="reviews-container">

        <div class="reviews-heading">
            <div class="reviews-eyebrow">
                <span>★</span> FROM OUR CUSTOMERS
            </div>
            <h2>Our Global Watch Community</h2>
        </div>

        <div class="reviews-grid">
            <?php if (!empty($featuredReviews)): ?>
                <?php foreach ($featuredReviews as $review): 
                    $reviewImg = !empty($review['image_url']) 
                        ? "/Zeith/assets/image/reviews/" . htmlspecialchars($review['image_url']) 
                        : "assets/image/reviews/review3.jpg";
                ?>
                    <article class="review-card">
                        <div class="review-image">
                            <img src="<?= $reviewImg ?>" alt="Zeith watch review" loading="lazy">
                        </div>
                        <div class="review-content">
                            <h3 class="review-title">
                                “<?= htmlspecialchars($review['title']) ?>” — <?= htmlspecialchars($review['customer_name']) ?>
                            </h3>
                            <p class="review-meta">
                                <?= htmlspecialchars($review['customer_name']) ?> • <?= date('F j, Y', strtotime($review['created_at'])) ?>
                            </p>
                            <p class="review-text">
                                <?= htmlspecialchars($review['comment']) ?>
                            </p>
                            <div class="review-rating">
                                <?php for($i=0; $i < (int)($review['rating'] ?? 5); $i++): ?>★<?php endfor; ?>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="grid-column: span 2; text-align: center; color: #6b7280;">No featured reviews available at the moment.</p>
            <?php endif; ?>
        </div>

    </div>
</section>

