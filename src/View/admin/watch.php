<?php
/*
|--------------------------------------------------------------------------
| ZEITH STAFF - MY LISTINGS
|--------------------------------------------------------------------------
| Replace the sample image filenames with your actual watch images.
|--------------------------------------------------------------------------
*/

$listings = [

    [
        'id' => 1,
        'name' => 'Nautilus 5711',
        'price' => '₦85,000',
        'status' => 'Available',
        'description' => 'The Nautilus 5711 is one of the most coveted elite luxury sports watches in existence.',
        'images' => [
            '/Watch_Collection/assets/images/watches/nautilus-1.jpg',
            '/Watch_Collection/assets/images/watches/nautilus-2.jpg',
            '/Watch_Collection/assets/images/watches/nautilus-3.jpg',
            '/Watch_Collection/assets/images/watches/nautilus-4.jpg',
        ]
    ],

    [
        'id' => 2,
        'name' => 'Precisionist Chronograph',
        'price' => '₦60,000',
        'status' => 'Available',
        'description' => 'Driven by Bulova’s exclusive high-frequency quartz movement, this chronograph delivers exceptional precision.',
        'images' => [
            '/Watch_Collection/assets/images/watches/precisionist-1.jpg',
            '/Watch_Collection/assets/images/watches/precisionist-2.jpg',
            '/Watch_Collection/assets/images/watches/precisionist-3.jpg',
            '/Watch_Collection/assets/images/watches/precisionist-4.jpg',
        ]
    ],

    [
        'id' => 3,
        'name' => 'Transporter Black Gold',
        'price' => '₦30,000',
        'status' => 'Available',
        'description' => 'This bold statement piece merges rich African heritage inspiration with modern luxury.',
        'images' => [
            '/Watch_Collection/assets/images/watches/transporter-1.jpg',
            '/Watch_Collection/assets/images/watches/transporter-2.jpg',
            '/Watch_Collection/assets/images/watches/transporter-3.jpg',
            '/Watch_Collection/assets/images/watches/transporter-4.jpg',
        ]
    ],

    [
        'id' => 4,
        'name' => 'Classic Silver Chronograph',
        'price' => '₦75,000',
        'status' => 'Available',
        'description' => 'A refined chronograph designed for everyday elegance and dependable performance.',
        'images' => [
            '/Watch_Collection/assets/images/watches/classic-1.jpg',
            '/Watch_Collection/assets/images/watches/classic-2.jpg',
            '/Watch_Collection/assets/images/watches/classic-3.jpg',
            '/Watch_Collection/assets/images/watches/classic-4.jpg',
        ]
    ],

];

?>

<?php
// views/Staff/order.php
\App\Helpers\View::displayComponent("admin/sidebar.php");
?>


<main class="zeith-listings-page">

    <!-- =========================================================
         PAGE HEADER
    ========================================================== -->

    <section class="zeith-listings-header">

        <div class="zeith-listings-heading">

            <span class="zeith-listings-eyebrow">
                INVENTORY
            </span>

            <h1>
                My Listings
            </h1>

            <p>
                Manage your listed watches and their availability.
            </p>

        </div>

        <button
            type="button"
            class="zeith-add-listing-btn">
            <span>+</span>
            Add New Watch
        </button>

    </section>


    <!-- =========================================================
         LISTINGS GRID
    ========================================================== -->

    <section class="zeith-listings-grid">

        <?php foreach ($listings as $listing): ?>

            <article
                class="zeith-listing-card"
                data-listing-id="<?= htmlspecialchars($listing['id']) ?>">

                <!-- =================================================
                     IMAGE AREA
                ================================================== -->

                <div class="zeith-listing-image">

                    <!-- STATUS -->
                    <select
                        class="zeith-status-select"
                        aria-label="Listing status">
                        <option
                            value="Available"
                            <?= $listing['status'] === 'Available' ? 'selected' : '' ?>>
                            Available
                        </option>

                        <option
                            value="Sold"
                            <?= $listing['status'] === 'Sold' ? 'selected' : '' ?>>
                            Sold out
                        </option>
                    </select>


                    <!-- IMAGE TRACK -->

                    <div class="zeith-image-track">

                        <?php foreach ($listing['images'] as $index => $image): ?>

                            <div
                                class="zeith-image-slide <?= $index === 0 ? 'active' : '' ?>">

                                <img
                                    src="<?= htmlspecialchars($image) ?>"
                                    alt="<?= htmlspecialchars($listing['name']) ?>"
                                    loading="lazy">

                            </div>

                        <?php endforeach; ?>

                    </div>


                    <!-- LEFT ARROW -->

                    <button
                        type="button"
                        class="zeith-carousel-arrow zeith-carousel-prev"
                        aria-label="Previous image">
                        <span>‹</span>
                    </button>


                    <!-- RIGHT ARROW -->

                    <button
                        type="button"
                        class="zeith-carousel-arrow zeith-carousel-next"
                        aria-label="Next image">
                        <span>›</span>
                    </button>


                    <!-- PRICE -->

                    <div class="zeith-listing-price">
                        <?= htmlspecialchars($listing['price']) ?>
                    </div>


                    <!-- IMAGE INDICATORS -->

                    <div class="zeith-image-indicators">

                        <?php foreach ($listing['images'] as $index => $image): ?>

                            <span
                                class="zeith-image-indicator <?= $index === 0 ? 'active' : '' ?>"
                                data-index="<?= $index ?>"></span>

                        <?php endforeach; ?>

                    </div>

                </div>


                <!-- =================================================
                     LISTING CONTENT
                ================================================== -->

                <div class="zeith-listing-content">

                    <h2>
                        <?= htmlspecialchars($listing['name']) ?>
                    </h2>

                    <p class="zeith-listing-description">
                        <?= htmlspecialchars($listing['description']) ?>
                    </p>


                    <!-- =================================================
                         BOTTOM ACTIONS
                    ================================================== -->

                    <div class="zeith-listing-actions">

                        <div class="zeith-management-actions">

                            <button
                                type="button"
                                class="zeith-edit-btn">
                                <span class="zeith-edit-icon">✎</span>
                                Edit
                            </button>


                            <button
                                type="button"
                                class="zeith-delete-btn"
                                aria-label="Delete listing">
                                ♲
                            </button>

                        </div>

                    </div>

                </div>

            </article>

        <?php endforeach; ?>

    </section>

</main>


<style>
    /* ================================================================
   ZEITH LISTINGS PAGE
================================================================ */

    .zeith-listings-page {

        width: calc(100% - 250px);

        min-height: 100vh;

        margin-left: 250px;

        padding: 34px 34px 50px;

        background: #F4F6F9;

        box-sizing: border-box;

        font-family:
            Arial,
            Helvetica,
            sans-serif;

        color: #0F172A;

    }


    /* ================================================================
   PAGE HEADER
================================================================ */

    .zeith-listings-header {

        display: flex;

        align-items: flex-end;

        justify-content: space-between;

        gap: 25px;

        margin-bottom: 30px;

    }


    .zeith-listings-heading {

        min-width: 0;

    }


    .zeith-listings-eyebrow {

        display: block;

        margin-bottom: 6px;

        color: #2563EB;

        font-size: 11px;

        font-weight: 700;

        letter-spacing: 1.4px;

    }


    .zeith-listings-heading h1 {

        margin: 0;

        font-size: 28px;

        line-height: 1.15;

        font-weight: 800;

        letter-spacing: -.5px;

    }


    .zeith-listings-heading p {

        margin: 7px 0 0;

        color: #64748B;

        font-size: 14px;

    }


    /* ================================================================
   ADD LISTING BUTTON
================================================================ */

    .zeith-add-listing-btn {

        height: 46px;

        display: inline-flex;

        align-items: center;

        justify-content: center;

        gap: 8px;

        padding: 0 20px;

        border: none;

        border-radius: 9px;

        background: #2563EB;

        color: #FFFFFF;

        font-size: 13px;

        font-weight: 700;

        cursor: pointer;

        white-space: nowrap;

        box-shadow:
            0 5px 15px rgba(37, 99, 235, .18);

        transition:
            transform .2s ease,
            background .2s ease,
            box-shadow .2s ease;

    }


    .zeith-add-listing-btn span {

        font-size: 20px;

        line-height: 1;

    }


    .zeith-add-listing-btn:hover {

        background: #1D4ED8;

        transform: translateY(-1px);

        box-shadow:
            0 8px 20px rgba(37, 99, 235, .23);

    }


    /* ================================================================
   GRID
================================================================ */

    .zeith-listings-grid {

        display: grid;

        grid-template-columns:
            repeat(4, minmax(0, 1fr));

        gap: 24px;

    }


    /* ================================================================
   LISTING CARD
================================================================ */

    .zeith-listing-card {

        position: relative;

        min-width: 0;

        overflow: hidden;

        background: #FFFFFF;

        border: 1px solid #E8EDF3;

        border-radius: 14px;

        box-shadow:
            0 5px 18px rgba(15, 23, 42, .05);

        transition:
            transform .25s ease,
            box-shadow .25s ease;

    }


    .zeith-listing-card:hover {

        transform: translateY(-3px);

        box-shadow:
            0 14px 30px rgba(15, 23, 42, .09);

    }


    /* ================================================================
   IMAGE CONTAINER
================================================================ */

    .zeith-listing-image {

        position: relative;

        width: 100%;

        height: 330px;

        overflow: hidden;

        background: #F8F7F4;

    }


    /* ================================================================
   IMAGE TRACK
================================================================ */

    .zeith-image-track {

        width: 100%;

        height: 100%;

        position: relative;

    }


    /* ================================================================
   INDIVIDUAL IMAGE
================================================================ */

    .zeith-image-slide {

        position: absolute;

        inset: 0;

        width: 100%;

        height: 100%;

        display: flex;

        align-items: center;

        justify-content: center;

        opacity: 0;

        visibility: hidden;

        transform: translateX(18px);

        transition:
            opacity .35s ease,
            transform .35s ease,
            visibility .35s ease;

    }


    .zeith-image-slide.active {

        opacity: 1;

        visibility: visible;

        transform: translateX(0);

    }


    .zeith-image-slide img {

        width: 100%;

        height: 100%;

        object-fit: contain;

        display: block;

    }


    /* ================================================================
   DARK GRADIENT AT IMAGE BOTTOM
================================================================ */

    .zeith-listing-image::after {

        content: "";

        position: absolute;

        left: 0;

        right: 0;

        bottom: 0;

        height: 105px;

        background:
            linear-gradient(to bottom,
                rgba(0, 0, 0, 0),
                rgba(0, 0, 0, .72));

        pointer-events: none;

        z-index: 2;

    }


    /* ================================================================
   STATUS SELECT
================================================================ */

    .zeith-status-select {

        position: absolute;

        top: 14px;
        left: 18px;

        z-index: 10;

        height: 36px;

        min-width: 116px;

        padding: 0 34px 0 14px;

        border: 2px solid #DDE5F3;

        border-radius: 20px;

        background-color: #E8F1E3;

        color: #187A38;

        font-size: 11px;

        font-weight: 800;

        letter-spacing: 1.2px;

        text-transform: uppercase;

        outline: none;

        cursor: pointer;

        appearance: none;
        -webkit-appearance: none;

        background-image:
            url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%23187838' stroke-width='3' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");

        background-repeat: no-repeat;

        background-position:
            right 10px center;

        background-size: 14px 14px;

        box-sizing: border-box;

        transition:
            border-color .2s ease,
            box-shadow .2s ease;



    }

    .zeith-status-select:hover {

        border-color: #BFD2B8;

    }

    .zeith-status-select:focus {

        border-color: #2563EB;

        box-shadow:
            0 0 0 3px rgba(37, 99, 235, .10);

    }


    /* ================================================================
   HEART
================================================================ */

    .zeith-favorite-btn {

        position: absolute;

        top: 14px;

        right: 18px;

        z-index: 10;

        width: 46px;

        height: 46px;

        display: flex;

        align-items: center;

        justify-content: center;

        border: none;

        border-radius: 50%;

        background: rgba(255, 255, 255, .92);

        color: #94A3B8;

        font-size: 22px;

        cursor: pointer;

        box-shadow:
            0 5px 15px rgba(15, 23, 42, .12);

        transition:
            transform .2s ease,
            color .2s ease;

    }


    .zeith-favorite-btn:hover {

        transform: scale(1.06);

        color: #EF4444;

    }


    /* ================================================================
   CAROUSEL ARROWS
================================================================ */

    .zeith-carousel-arrow {

        position: absolute;

        top: 50%;

        z-index: 8;

        width: 46px;

        height: 46px;

        display: flex;

        align-items: center;

        justify-content: center;

        border: none;

        border-radius: 50%;

        background: rgba(255, 255, 255, .94);

        color: #0F172A;

        cursor: pointer;

        box-shadow:
            0 5px 16px rgba(15, 23, 42, .10);

        transform: translateY(-50%);

        transition:
            transform .2s ease,
            background .2s ease;

    }


    .zeith-carousel-arrow:hover {

        background: #FFFFFF;

        transform:
            translateY(-50%) scale(1.05);

    }


    .zeith-carousel-arrow span {

        display: block;

        font-size: 28px;

        line-height: 1;

        font-weight: 400;

    }


    .zeith-carousel-prev {

        left: 18px;

    }


    .zeith-carousel-next {

        right: 18px;

    }


    /* ================================================================
   PRICE
================================================================ */

    .zeith-listing-price {

        position: absolute;

        right: 20px;

        bottom: 26px;

        z-index: 6;

        color: #FFFFFF;

        font-size: 23px;

        font-weight: 800;

        letter-spacing: .2px;

        text-shadow:
            0 2px 5px rgba(0, 0, 0, .3);

    }


    /* ================================================================
   IMAGE INDICATORS
================================================================ */

    .zeith-image-indicators {

        position: absolute;

        left: 24px;

        right: 24px;

        bottom: 12px;

        z-index: 7;

        display: grid;

        grid-template-columns:
            repeat(4, 1fr);

        gap: 7px;

    }


    .zeith-image-indicator {

        display: block;

        height: 4px;

        border-radius: 5px;

        background: rgba(15, 23, 42, .45);

        cursor: pointer;

        transition:
            background .25s ease,
            transform .25s ease;

    }


    .zeith-image-indicator.active {

        background: #FFFFFF;

        transform: scaleY(1.2);

    }


    /* ================================================================
   LISTING CONTENT
================================================================ */

    .zeith-listing-content {

        padding: 25px 27px 22px;

    }

    .zeith-listing-content h2 {

        margin: 0;

        color: #0F172A;

        font-size: 20px;

        line-height: 1.3;

        font-weight: 700;

    }

    .zeith-listing-description {

        min-height: 48px;

        margin: 18px 0 14px;

        color: #94A3B8;

        font-size: 13px;

        line-height: 1.65;

    }


    /* ================================================================
   ACTIONS
================================================================ */

    .zeith-listing-actions {

        width: 100%;

        display: flex;

        align-items: center;

        justify-content: center;

        padding-top: 10px;

    }


    /* ================================================================
   ADD BUTTON
================================================================ */

    .zeith-add-btn {

        min-width: 77px;

        height: 40px;

        padding: 0 18px;

        border: none;

        border-radius: 22px;

        background: #2563EB;

        color: #FFFFFF;

        font-size: 13px;

        font-weight: 700;

        cursor: pointer;

        transition:
            background .2s ease,
            transform .2s ease;

    }


    .zeith-add-btn:hover {

        background: #1D4ED8;

        transform: translateY(-1px);

    }


    /* ================================================================
   DETAILS
================================================================ */

    .zeith-details-btn {

        flex: 1;

        display: flex;

        align-items: center;

        justify-content: center;

        gap: 4px;

        padding: 0;

        border: none;

        background: transparent;

        color: #2563EB;

        font-size: 13px;

        font-weight: 600;

        cursor: pointer;

    }


    .zeith-details-btn span {

        font-size: 17px;

        transition:
            transform .2s ease;

    }


    .zeith-details-btn:hover span {

        transform: translateX(4px);

    }


    /* ================================================================
   MANAGEMENT ACTIONS
================================================================ */

    .zeith-management-actions {

        display: flex;

        align-items: center;

        justify-content: center;

        gap: 22px;

    }

    .zeith-edit-btn {

        height: 42px;

        display: inline-flex;

        align-items: center;

        justify-content: center;

        gap: 7px;

        padding: 0 10px;

        border: none;

        border-radius: 8px;

        background: transparent;

        color: #334155;

        font-size: 13px;

        font-weight: 700;

        cursor: pointer;

        transition:
            background .2s ease,
            color .2s ease,
            transform .2s ease;

    }

    .zeith-edit-btn:hover {

        background: #EFF6FF;

        color: #2563EB;

        transform: translateY(-1px);

    }

    .zeith-edit-icon {

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 15px;

        color: #475569;

    }


    /* ================================================================
   DELETE
================================================================ */

    .zeith-delete-btn {

        width: 46px;

        height: 46px;

        display: flex;

        align-items: center;

        justify-content: center;

        border: none;

        border-radius: 50%;

        background: #FEF0F0;

        color: #EF7777;

        font-size: 18px;

        cursor: pointer;

        transition:
            background .2s ease,
            color .2s ease,
            transform .2s ease;

    }

    .zeith-delete-btn:hover {

        background: #FEE2E2;

        color: #EF4444;

        transform: scale(1.05);

    }

    /* ================================================================
   SOLD STATE
================================================================ */

    .zeith-listing-card.is-sold .zeith-status-select {

        background-color: #FDE8E8;

        border-color: #F5CACA;

        color: #B91C1C;

        background-image:
            url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%23B91C1C' stroke-width='3' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");

    }


    /* ================================================================
   TABLET
================================================================ */

    @media (max-width: 1200px) {

        .zeith-listings-page {

            padding: 30px 25px 45px;

        }


        .zeith-listings-grid {

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

        }

    }


    /* ================================================================
   IPAD / TABLET
================================================================ */

    @media (max-width: 1024px) {

        .zeith-listings-page {

            width: 100%;

            margin-left: 0;

            padding:
                90px 25px 45px;

        }


        .zeith-listings-grid {

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap: 20px;

        }


        .zeith-listing-image {

            height: 310px;

        }

    }


    /* ================================================================
   SMALL TABLET
================================================================ */

    @media (max-width: 767px) {

        .zeith-listings-page {

            padding:
                78px 18px 35px;

        }


        .zeith-listings-header {

            align-items: flex-start;

            flex-direction: column;

            margin-bottom: 25px;

        }


        .zeith-listings-heading h1 {

            font-size: 25px;

        }


        .zeith-add-listing-btn {

            width: 100%;

        }


        .zeith-listings-grid {

            grid-template-columns: 1fr;

        }


        .zeith-listing-image {

            height: 360px;

        }

    }


    /* ================================================================
   MOBILE
================================================================ */

    @media (max-width: 480px) {

        .zeith-listings-page {

            padding:
                72px 12px 30px;

        }


        .zeith-listing-image {

            height: 330px;

        }


        .zeith-listing-content {

            padding:
                21px 17px 17px;

        }


        .zeith-listing-content h2 {

            font-size: 18px;

        }


        .zeith-listing-description {

            font-size: 12px;

            min-height: auto;

            margin:
                14px 0 18px;

        }


        .zeith-listing-actions {

            flex-wrap: wrap;

        }


        .zeith-add-btn {

            order: 1;

        }


        .zeith-details-btn {

            order: 2;

        }


        .zeith-management-actions {

            order: 3;

        }


        .zeith-listing-price {

            right: 17px;

            bottom: 25px;

            font-size: 21px;

        }


        .zeith-carousel-arrow {

            width: 42px;

            height: 42px;

        }


        .zeith-carousel-prev {

            left: 13px;

        }


        .zeith-carousel-next {

            right: 13px;

        }


        .zeith-status-select {

            left: 14px;

            top: 13px;

        }


        .zeith-favorite-btn {

            right: 14px;

            top: 13px;

            width: 42px;

            height: 42px;

        }

    }
</style>


<script>
    document.addEventListener("DOMContentLoaded", function() {

        /*
        |--------------------------------------------------------------------------
        | EACH LISTING GETS ITS OWN CAROUSEL
        |--------------------------------------------------------------------------
        */

        const listingCards =
            document.querySelectorAll(".zeith-listing-card");


        listingCards.forEach(function(card) {

            const slides =
                card.querySelectorAll(".zeith-image-slide");

            const indicators =
                card.querySelectorAll(".zeith-image-indicator");

            const previousButton =
                card.querySelector(".zeith-carousel-prev");

            const nextButton =
                card.querySelector(".zeith-carousel-next");

            const statusSelect =
                card.querySelector(".zeith-status-select");


            let currentIndex = 0;


            /*
            |--------------------------------------------------------------------------
            | CHANGE IMAGE
            |--------------------------------------------------------------------------
            */

            function showImage(index) {

                /*
                | Keep index inside 0 - 3.
                */

                if (index < 0) {

                    index = slides.length - 1;

                }

                if (index >= slides.length) {

                    index = 0;

                }


                currentIndex = index;


                /*
                | Update images.
                */

                slides.forEach(function(slide, i) {

                    slide.classList.toggle(
                        "active",
                        i === currentIndex
                    );

                });


                /*
                | Update indicator.
                */

                indicators.forEach(function(indicator, i) {

                    indicator.classList.toggle(
                        "active",
                        i === currentIndex
                    );

                });

            }


            /*
            |--------------------------------------------------------------------------
            | NEXT IMAGE
            |--------------------------------------------------------------------------
            */

            if (nextButton) {

                nextButton.addEventListener(
                    "click",
                    function(event) {

                        event.preventDefault();

                        event.stopPropagation();

                        showImage(
                            currentIndex + 1
                        );

                    }
                );

            }


            /*
            |--------------------------------------------------------------------------
            | PREVIOUS IMAGE
            |--------------------------------------------------------------------------
            */

            if (previousButton) {

                previousButton.addEventListener(
                    "click",
                    function(event) {

                        event.preventDefault();

                        event.stopPropagation();

                        showImage(
                            currentIndex - 1
                        );

                    }
                );

            }


            /*
            |--------------------------------------------------------------------------
            | CLICK INDICATOR
            |--------------------------------------------------------------------------
            |
            | Clicking the third indicator, for example, immediately moves
            | to image number 3.
            |
            */

            indicators.forEach(function(indicator, index) {

                indicator.addEventListener(
                    "click",
                    function(event) {

                        event.preventDefault();

                        event.stopPropagation();

                        showImage(index);

                    }
                );

            });


            /*
            |--------------------------------------------------------------------------
            | STATUS
            |--------------------------------------------------------------------------
            */

            if (statusSelect) {

                statusSelect.addEventListener(
                    "change",
                    function() {

                        if (
                            this.value === "Sold"
                        ) {

                            card.classList.add(
                                "is-sold"
                            );

                        } else {

                            card.classList.remove(
                                "is-sold"
                            );

                        }

                    }
                );

            }


            /*
            |--------------------------------------------------------------------------
            | FAVORITE
            |--------------------------------------------------------------------------
            */

            const favoriteButton =
                card.querySelector(
                    ".zeith-favorite-btn"
                );


            if (favoriteButton) {

                favoriteButton.addEventListener(
                    "click",
                    function() {

                        this.classList.toggle(
                            "is-favorite"
                        );


                        if (
                            this.classList.contains(
                                "is-favorite"
                            )
                        ) {

                            this.style.color =
                                "#EF4444";

                        } else {

                            this.style.color =
                                "#94A3B8";

                        }

                    }
                );

            }


            /*
            |--------------------------------------------------------------------------
            | KEYBOARD / SWIPE SUPPORT
            |--------------------------------------------------------------------------
            */

            let touchStartX = 0;

            let touchEndX = 0;


            card.addEventListener(
                "touchstart",
                function(event) {

                    touchStartX =
                        event.changedTouches[0].screenX;

                }, {
                    passive: true
                }
            );


            card.addEventListener(
                "touchend",
                function(event) {

                    touchEndX =
                        event.changedTouches[0].screenX;


                    const difference =
                        touchStartX - touchEndX;


                    /*
                    | Swipe left = next image
                    */

                    if (difference > 50) {

                        showImage(
                            currentIndex + 1
                        );

                    }


                    /*
                    | Swipe right = previous image
                    */

                    if (difference < -50) {

                        showImage(
                            currentIndex - 1
                        );

                    }

                }, {
                    passive: true
                }
            );


            /*
            |--------------------------------------------------------------------------
            | INITIAL IMAGE
            |--------------------------------------------------------------------------
            */

            showImage(0);

        });


        /*
        |--------------------------------------------------------------------------
        | DELETE BUTTON
        |--------------------------------------------------------------------------
        */

        document
            .querySelectorAll(".zeith-delete-btn")
            .forEach(function(button) {

                button.addEventListener(
                    "click",
                    function() {

                        const card =
                            this.closest(
                                ".zeith-listing-card"
                            );


                        const listingName =
                            card.querySelector(
                                ".zeith-listing-content h2"
                            );


                        const confirmed =
                            confirm(
                                "Are you sure you want to delete " +
                                listingName.textContent.trim() +
                                "?"
                            );


                        if (confirmed) {

                            card.style.opacity = "0";

                            card.style.transform =
                                "scale(.96)";


                            setTimeout(
                                function() {

                                    card.remove();

                                },
                                250
                            );

                        }

                    }
                );

            });

    });
</script>