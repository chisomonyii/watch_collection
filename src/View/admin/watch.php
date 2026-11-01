<?php
// Note: $watches is passed directly from AdminController::indexWatches()

\App\Helpers\View::displayComponent("admin/sidebar.php");
?>

<main class="zeith-listings-page">
    <section class="zeith-listings-header">
        <div class="zeith-listings-heading">
            <span class="zeith-listings-eyebrow">INVENTORY</span>
            <h1>My Listings</h1>
            <p>Manage your listed watches and their availability.</p>
        </div>

        <!-- Add New Watch Button linked to addWatch.php -->
        <a href="/Zeith/admin/watch/add" class="zeith-add-listing-btn" style="text-decoration: none;">
            <span>+</span>
            Add New Watch
        </a>
    </section>

    <div class="zeith-listings-search">
        <span class="zeith-search-icon">⌕</span>
        <input
            type="search"
            id="zeithListingSearch"
            placeholder="Search watches by name, description or price..."
            autocomplete="off">
        <span class="zeith-search-count" id="zeithSearchCount"></span>
    </div>

    <section class="zeith-listings-grid">
        <?php if (!empty($watches)): ?>
            <?php foreach ($watches as $watch): ?>
                <?php
                // 1. Map the 4 database image columns
                $images = [];
                for ($i = 1; $i <= 4; $i++) {
                    $imgCol = 'image_url_' . $i;
                    if (!empty($watch[$imgCol])) {
                        $val = trim($watch[$imgCol]);

                        if (filter_var($val, FILTER_VALIDATE_URL) || strpos($val, '/') === 0) {
                            $images[] = $val;
                        } else {
                            $uploadPath = $_SERVER['DOCUMENT_ROOT'] . '/Zeith/public/uploads/' . $val;
                            if (file_exists($uploadPath)) {
                                $images[] = '/Zeith/public/uploads/' . $val;
                            } else {
                                $images[] = '/Zeith/assets/image/' . $val;
                            }
                        }
                    }
                }

                while (count($images) < 4) {
                    $images[] = '/Zeith/assets/images/placeholder.jpg';
                }

                // 2. Map database stock column (> 0 = Available, 0 = Sold out)
                $isAvailable = (isset($watch['stock']) && intval($watch['stock']) > 0);

                // 3. Shorten description (maximum 90 characters with ellipsis)
                $fullDesc = $watch['description'] ?? '';
                $shortDesc = mb_strlen($fullDesc) > 90 ? mb_substr($fullDesc, 0, 90) . '...' : $fullDesc;
                ?>
                <article class="zeith-listing-card <?= !$isAvailable ? 'is-sold' : '' ?>" data-listing-id="<?= htmlspecialchars($watch['id']) ?>">
                    <div class="zeith-listing-image">
                        <select class="zeith-status-select" aria-label="Listing status" onchange="updateStockStatus(<?= $watch['id'] ?>, this.value)">
                            <option value="1" <?= $isAvailable ? 'selected' : '' ?>>Available</option>
                            <option value="0" <?= !$isAvailable ? 'selected' : '' ?>>Sold out</option>
                        </select>

                        <div class="zeith-image-track">
                            <?php foreach ($images as $index => $image): ?>
                                <div class="zeith-image-slide <?= $index === 0 ? 'active' : '' ?>">
                                    <img src="<?= htmlspecialchars($image) ?>" alt="<?= htmlspecialchars($watch['name']) ?>" loading="lazy">
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <button type="button" class="zeith-carousel-arrow zeith-carousel-prev" aria-label="Previous image"><span>‹</span></button>
                        <button type="button" class="zeith-carousel-arrow zeith-carousel-next" aria-label="Next image"><span>›</span></button>

                        <div class="zeith-listing-price">
                            ₦<?= number_format((float)$watch['price'], 0) ?>
                        </div>

                        <div class="zeith-image-indicators">
                            <?php foreach ($images as $index => $image): ?>
                                <span class="zeith-image-indicator <?= $index === 0 ? 'active' : '' ?>" data-index="<?= $index ?>"></span>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="zeith-listing-content">
                        <h2><?= htmlspecialchars($watch['name']) ?></h2>
                        <p class="zeith-listing-description"><?= htmlspecialchars($shortDesc) ?></p>

                        <div class="zeith-listing-actions">
                            <div class="zeith-management-actions">
                                <a href="/Zeith/admin/watch/edit/<?= $watch['id'] ?>" class="zeith-edit-btn" style="text-decoration: none; display: inline-flex; align-items: center; gap: 4px;">
                                    <span class="zeith-edit-icon">✎</span> Edit
                                </a>

                                <form action="/Zeith/admin/watch/delete/<?= $watch['id'] ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this watch?');" style="display: inline;">
                                    <button type="submit" class="zeith-delete-btn" aria-label="Delete listing">&#128465;</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="grid-column: 1 / -1; text-align: center; color: #888; padding: 40px;">No watch listings found in the database.</p>
        <?php endif; ?>
    </section>
</main>

<style>
    /* ================================================================
   ZEITH LISTINGS PAGE
================================================================ */

    .zeith-listings-search {
        position: relative;
        width: 100%;
        max-width: 550px;
        margin: 0 0 25px;
    }

    .zeith-listings-search .zeith-search-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #64748B;
        font-size: 22px;
        pointer-events: none;
    }

    .zeith-listings-search input {
        width: 100%;
        height: 46px;
        padding: 0 110px 0 45px;
        background: #FFFFFF;
        color: #0F172A;
        border: 1px solid #E2E8F0;
        border-radius: 9px;
        outline: none;
        font-size: 13px;
        transition: all 0.2s ease;
    }

    .zeith-listings-search input::placeholder {
        color: #94A3B8;
    }

    .zeith-listings-search input:focus {
        border-color: #2563EB;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .zeith-search-count {
        position: absolute;
        right: 13px;
        top: 50%;
        transform: translateY(-50%);
        color: #64748B;
        font-size: 11px;
        font-weight: 600;
    }

    .zeith-listing-card.search-hidden {
        display: none !important;
    }

    .zeith-search-empty {
        grid-column: 1 / -1;
        padding: 45px 20px;
        text-align: center;
        color: #64748B;
        background: #FFFFFF;
        border: 1px dashed #CBD5E1;
        border-radius: 10px;
    }

    .zeith-search-empty strong {
        display: block;
        margin-bottom: 6px;
        color: #0F172A;
        font-size: 15px;
    }

    @media (max-width: 600px) {
        .zeith-listings-search {
            max-width: 100%;
        }

        .zeith-listings-search input {
            font-size: 12px;
        }
    }

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
        const listingCards = document.querySelectorAll(".zeith-listing-card");

        listingCards.forEach(function(card) {
            const slides = card.querySelectorAll(".zeith-image-slide");
            const indicators = card.querySelectorAll(".zeith-image-indicator");
            const previousButton = card.querySelector(".zeith-carousel-prev");
            const nextButton = card.querySelector(".zeith-carousel-next");
            const statusSelect = card.querySelector(".zeith-status-select");

            let currentIndex = 0;

            function showImage(index) {
                if (index < 0) {
                    index = slides.length - 1;
                }

                if (index >= slides.length) {
                    index = 0;
                }

                currentIndex = index;

                slides.forEach(function(slide, i) {
                    slide.classList.toggle("active", i === currentIndex);
                });

                indicators.forEach(function(indicator, i) {
                    indicator.classList.toggle("active", i === currentIndex);
                });
            }

            if (nextButton) {
                nextButton.addEventListener("click", function(event) {
                    event.preventDefault();
                    event.stopPropagation();
                    showImage(currentIndex + 1);
                });
            }

            if (previousButton) {
                previousButton.addEventListener("click", function(event) {
                    event.preventDefault();
                    event.stopPropagation();
                    showImage(currentIndex - 1);
                });
            }

            indicators.forEach(function(indicator, index) {
                indicator.addEventListener("click", function(event) {
                    event.preventDefault();
                    event.stopPropagation();
                    showImage(index);
                });
            });

            // Handle status styling change (0 = Sold out, 1 = Available)
            if (statusSelect) {
                // Set initial state on load
                if (statusSelect.value === "0") {
                    card.classList.add("is-sold");
                }

                statusSelect.addEventListener("change", function() {
                    if (this.value === "0") {
                        card.classList.add("is-sold");
                    } else {
                        card.classList.remove("is-sold");
                    }

                    // Trigger the AJAX request to update database stock status
                    const watchId = card.getAttribute("data-listing-id");
                    updateStockStatus(watchId, this.value);
                });
            }

            // Touch/Swipe navigation for mobile carousels
            let touchStartX = 0;
            let touchEndX = 0;

            card.addEventListener("touchstart", function(event) {
                touchStartX = event.changedTouches[0].screenX;
            }, {
                passive: true
            });

            card.addEventListener("touchend", function(event) {
                touchEndX = event.changedTouches[0].screenX;
                const difference = touchStartX - touchEndX;

                if (difference > 50) {
                    showImage(currentIndex + 1);
                }

                // Fixed syntax typo here:
                if (difference < -50) {
                    showImage(currentIndex - 1);
                }
            }, {
                passive: true
            });

            showImage(0);
        });
    });

    // AJAX function to update database stock status when dropdown changes
    function updateStockStatus(watchId, stockValue) {
        const formData = new FormData();
        formData.append('stock', stockValue);

        fetch('/Zeith/admin/watch/status/' + watchId, {
            method: 'POST',
            body: formData
        }).then(response => {
            if (!response.ok) {
                alert('Failed to update stock status in database.');
            }
        }).catch(error => {
            console.error('Error:', error);
        });
    }
    document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("zeithListingSearch");
    const searchCount = document.getElementById("zeithSearchCount");
    const listingsGrid = document.querySelector(".zeith-listings-grid");

    if (!searchInput || !listingsGrid) return;

    const cards = Array.from(
        listingsGrid.querySelectorAll(".zeith-listing-card")
    );

    const emptyMessage = document.createElement("div");
    emptyMessage.className = "zeith-search-empty";
    emptyMessage.innerHTML = `
        <strong>No watches found</strong>
        Try searching with a different watch name or keyword.
    `;

    function filterListings() {
        const query = searchInput.value.trim().toLowerCase();
        let visibleCount = 0;

        cards.forEach(function (card) {
            const searchableText = card.textContent.toLowerCase();
            const matches = searchableText.includes(query);

            card.classList.toggle("search-hidden", !matches);

            if (matches) {
                visibleCount++;
            }
        });

        if (cards.length > 0 && visibleCount === 0) {
            if (!emptyMessage.isConnected) {
                listingsGrid.appendChild(emptyMessage);
            }
        } else {
            emptyMessage.remove();
        }

        searchCount.textContent = `${visibleCount} of ${cards.length} watches`;
    }

    searchInput.addEventListener("input", filterListings);

    filterListings();
});

</script>


