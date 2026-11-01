<?php

// views/staff/view-details.php

// Ensure $watch exists
$watch = $watch ?? [];

$watchId      = (int)($watch['id'] ?? 0);
$watchName    = htmlspecialchars($watch['name'] ?? 'Unnamed Watch', ENT_QUOTES, 'UTF-8');
$collection   = htmlspecialchars($watch['collection'] ?? 'Luxury Collection', ENT_QUOTES, 'UTF-8');
$rating       = (float)($watch['rating'] ?? 5.0);
$price        = (float)($watch['price'] ?? 0);
$isFeatured   = !empty($watch['is_featured']);
$createdAt    = !empty($watch['created_at']) ? date('M d, Y', strtotime($watch['created_at'])) : 'N/A';
$likesCount   = (int)($watch['likes_count'] ?? 0);
$reviewsCount = (int)($watch['reviews_count'] ?? 0);
$stock        = (int)($watch['stock'] ?? 0);
$inStock      = !empty($watch['in_stock']) && $stock > 0;
$description  = htmlspecialchars($watch['description'] ?? 'No description provided.', ENT_QUOTES, 'UTF-8');
$strap        = htmlspecialchars($watch['strap'] ?? 'Standard Strap', ENT_QUOTES, 'UTF-8');
$images       = $watch['images'] ?? ['/Zeith/assets/images/placeholder.jpg'];
$manual       = $watch['manual_path'] ?? null;
?>

<style>
    /* =========================================================
   ZEITH STAFF WATCH DETAILS
   ========================================================= */

    .zeith-details-page {

        min-height: 100vh;

        margin-left: 250px;

        background: #F4F6F9;

        color: #0F172A;

        padding: 32px;

        box-sizing: border-box;
    }

    .zeith-details-container {

        width: 100%;

        max-width: 1500px;

        margin: 0 auto;
    }


    /* ---------------------------------------------------------
   HEADER
   --------------------------------------------------------- */

    .zeith-details-header {

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 20px;

        margin-bottom: 24px;
    }

    .zeith-details-heading h1 {

        margin: 0 0 7px;

        font-size: 28px;

        font-weight: 800;

        letter-spacing: -0.5px;
    }

    .zeith-details-heading p {

        margin: 0;

        color: #64748B;

        font-size: 14px;
    }


    /* ---------------------------------------------------------
   BACK BUTTON
   --------------------------------------------------------- */

    .zeith-back-button {

        display: inline-flex;

        align-items: center;

        gap: 8px;

        padding: 10px 15px;

        border-radius: 9px;

        background: #FFFFFF;

        border: 1px solid #E2E8F0;

        color: #0F172A;

        text-decoration: none;

        font-size: 13px;

        font-weight: 700;

        transition: all .2s ease;
    }

    .zeith-back-button:hover {

        color: #2563EB;

        border-color: #BFDBFE;

        background: #EFF6FF;
    }


    /* ---------------------------------------------------------
   VIEW ONLY NOTICE
   --------------------------------------------------------- */

    .zeith-details-notice {

        display: flex;

        align-items: flex-start;

        gap: 12px;

        padding: 15px 18px;

        margin-bottom: 24px;

        background: #EFF6FF;

        border: 1px solid #BFDBFE;

        border-radius: 12px;

        color: #1E40AF;
    }

    .zeith-details-notice-icon {

        width: 30px;

        height: 30px;

        flex: 0 0 30px;

        display: flex;

        align-items: center;

        justify-content: center;

        border-radius: 8px;

        background: #DBEAFE;

        color: #2563EB;

        font-size: 15px;
    }

    .zeith-details-notice strong {

        display: block;

        margin-bottom: 3px;

        font-size: 13px;
    }

    .zeith-details-notice span {

        font-size: 12px;

        line-height: 1.5;
    }


    /* ---------------------------------------------------------
   MAIN GRID
   --------------------------------------------------------- */

    .zeith-details-grid {

        display: grid;

        grid-template-columns: minmax(0, 1.4fr) minmax(320px, .8fr);

        gap: 24px;

        align-items: start;
    }


    /* ---------------------------------------------------------
   CARDS
   --------------------------------------------------------- */

    .zeith-details-card {

        background: #FFFFFF;

        border: 1px solid #E2E8F0;

        border-radius: 16px;

        box-shadow: 0 4px 16px rgba(15, 23, 42, .05);

        overflow: hidden;
    }


    /* ---------------------------------------------------------
   GALLERY
   --------------------------------------------------------- */

    .zeith-gallery {

        padding: 20px;
    }

    .zeith-gallery-main {

        position: relative;

        height: 460px;

        overflow: hidden;

        border-radius: 13px;

        background: #F8FAFC;
    }

    .zeith-gallery-main img {

        width: 100%;

        height: 100%;

        display: block;

        object-fit: cover;
    }


    /* ---------------------------------------------------------
   GALLERY BUTTONS
   --------------------------------------------------------- */

    .zeith-gallery-arrow {

        position: absolute;

        top: 50%;

        transform: translateY(-50%);

        width: 38px;

        height: 38px;

        border: 1px solid #E2E8F0;

        border-radius: 50%;

        background: rgba(255, 255, 255, .95);

        color: #0F172A;

        cursor: pointer;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 18px;

        z-index: 3;
    }

    .zeith-gallery-arrow:hover {

        background: #FFFFFF;

        color: #2563EB;
    }

    .zeith-gallery-prev {

        left: 14px;
    }

    .zeith-gallery-next {

        right: 14px;
    }


    /* ---------------------------------------------------------
   THUMBNAILS
   --------------------------------------------------------- */

    .zeith-gallery-thumbnails {

        display: grid;

        grid-template-columns: repeat(4, 1fr);

        gap: 10px;

        margin-top: 12px;
    }

    .zeith-gallery-thumbnail {

        height: 78px;

        padding: 0;

        border-radius: 9px;

        border: 2px solid transparent;

        overflow: hidden;

        background: #F8FAFC;

        cursor: pointer;
    }

    .zeith-gallery-thumbnail.active {

        border-color: #2563EB;
    }

    .zeith-gallery-thumbnail img {

        width: 100%;

        height: 100%;

        object-fit: cover;
    }


    /* ---------------------------------------------------------
   INFORMATION CARD
   --------------------------------------------------------- */

    .zeith-information {

        padding: 24px;
    }

    .zeith-section-title {

        margin: 0 0 20px;

        font-size: 17px;

        font-weight: 800;

        color: #0F172A;
    }

    .zeith-info-grid {

        display: grid;

        grid-template-columns: repeat(2, minmax(0, 1fr));

        gap: 18px 22px;
    }

    .zeith-info-item {

        padding-bottom: 15px;

        border-bottom: 1px solid #E2E8F0;
    }

    .zeith-info-label {

        margin-bottom: 6px;

        color: #64748B;

        font-size: 11px;

        font-weight: 700;

        text-transform: uppercase;

        letter-spacing: .6px;
    }

    .zeith-info-value {

        color: #0F172A;

        font-size: 14px;

        font-weight: 700;

        line-height: 1.5;
    }


    /* ---------------------------------------------------------
   PRICE
   --------------------------------------------------------- */

    .zeith-price-value {

        font-size: 19px;

        font-weight: 800;
    }


    /* ---------------------------------------------------------
   RATING
   --------------------------------------------------------- */

    .zeith-rating-value {

        color: #F59E0B;
    }

    .zeith-rating-number {

        margin-left: 4px;

        color: #64748B;

        font-size: 12px;
    }


    /* ---------------------------------------------------------
   FEATURED
   --------------------------------------------------------- */

    .zeith-featured-badge {

        display: inline-flex;

        align-items: center;

        gap: 5px;

        padding: 6px 10px;

        border-radius: 999px;

        background: #EFF6FF;

        color: #2563EB;

        border: 1px solid #BFDBFE;

        font-size: 11px;

        font-weight: 700;
    }

    .zeith-not-featured-badge {

        display: inline-flex;

        align-items: center;

        padding: 6px 10px;

        border-radius: 999px;

        background: #F8FAFC;

        color: #64748B;

        border: 1px solid #E2E8F0;

        font-size: 11px;

        font-weight: 700;
    }


    /* ---------------------------------------------------------
   INVENTORY
   --------------------------------------------------------- */

    .zeith-inventory {

        margin-top: 24px;

        padding: 24px;

        border-top: 1px solid #E2E8F0;
    }

    .zeith-inventory-grid {

        display: grid;

        grid-template-columns: repeat(2, 1fr);

        gap: 14px;
    }

    .zeith-inventory-box {

        padding: 16px;

        border: 1px solid #E2E8F0;

        border-radius: 11px;

        background: #F8FAFC;
    }

    .zeith-inventory-box span {

        display: block;

        margin-bottom: 6px;

        color: #64748B;

        font-size: 11px;

        font-weight: 700;

        text-transform: uppercase;
    }

    .zeith-inventory-box strong {

        font-size: 17px;

        color: #0F172A;
    }


    /* ---------------------------------------------------------
   STATUS
   --------------------------------------------------------- */

    .zeith-status {

        display: inline-flex;

        align-items: center;

        gap: 6px;

        padding: 6px 10px;

        border-radius: 999px;

        font-size: 11px;

        font-weight: 700;
    }

    .zeith-status.in-stock {

        color: #047857;

        background: #ECFDF5;

        border: 1px solid #A7F3D0;
    }

    .zeith-status.out-stock {

        color: #B91C1C;

        background: #FEF2F2;

        border: 1px solid #FECACA;
    }


    /* ---------------------------------------------------------
   DESCRIPTION
   --------------------------------------------------------- */

    .zeith-description {

        margin-top: 24px;

        padding: 24px;

        border-top: 1px solid #E2E8F0;
    }

    .zeith-description p {

        margin: 0;

        color: #475569;

        font-size: 14px;

        line-height: 1.8;
    }


    /* ---------------------------------------------------------
   STRAP
   --------------------------------------------------------- */

    .zeith-strap {

        margin-top: 24px;

        padding: 24px;

        border-top: 1px solid #E2E8F0;
    }


    /* ---------------------------------------------------------
   RIGHT SUMMARY
   --------------------------------------------------------- */

    .zeith-summary {

        padding: 24px;
    }

    .zeith-summary-title {

        margin: 0 0 20px;

        font-size: 17px;

        font-weight: 800;
    }

    .zeith-summary-row {

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 15px;

        padding: 13px 0;

        border-bottom: 1px solid #E2E8F0;
    }

    .zeith-summary-row:last-child {

        border-bottom: 0;
    }

    .zeith-summary-label {

        color: #64748B;

        font-size: 12px;
    }

    .zeith-summary-value {

        color: #0F172A;

        font-size: 13px;

        font-weight: 700;

        text-align: right;
    }


    /* ---------------------------------------------------------
   MANUAL
   --------------------------------------------------------- */

    .zeith-manual {

        margin-top: 24px;

        padding: 20px;

        border-radius: 12px;

        background: #F8FAFC;

        border: 1px solid #E2E8F0;
    }

    .zeith-manual-title {

        margin: 0 0 8px;

        font-size: 13px;

        font-weight: 800;
    }

    .zeith-manual p {

        margin: 0 0 13px;

        color: #64748B;

        font-size: 12px;
    }

    .zeith-manual-link {

        display: inline-flex;

        align-items: center;

        justify-content: center;

        width: 100%;

        padding: 10px 13px;

        border-radius: 8px;

        background: #FFFFFF;

        border: 1px solid #CBD5E1;

        color: #2563EB;

        text-decoration: none;

        font-size: 12px;

        font-weight: 700;

        box-sizing: border-box;
    }

    .zeith-manual-link:hover {

        background: #EFF6FF;

        border-color: #93C5FD;
    }


    /* ---------------------------------------------------------
   OPERATIONAL NOTE
   --------------------------------------------------------- */

    .zeith-operational-note {

        margin-top: 20px;

        padding: 15px;

        border-radius: 10px;

        background: #FFFBEB;

        border: 1px solid #FDE68A;

        color: #92400E;

        font-size: 12px;

        line-height: 1.6;
    }


    /* ---------------------------------------------------------
   RESPONSIVE
   --------------------------------------------------------- */

    @media (max-width: 1100px) {

        .zeith-details-grid {

            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 1024px) {

        .zeith-details-page {

            margin-left: 0;

            padding: 24px;
        }
    }

    @media (max-width: 700px) {

        .zeith-details-page {

            padding: 18px;
        }

        .zeith-details-header {

            align-items: flex-start;

            flex-direction: column;
        }

        .zeith-details-heading h1 {

            font-size: 24px;
        }

        .zeith-gallery-main {

            height: 340px;
        }

        .zeith-info-grid {

            grid-template-columns: 1fr;
        }

        .zeith-inventory-grid {

            grid-template-columns: 1fr;
        }
    }
</style>


<?php
// views/staff/view-details.php

// Use lowercase 'staff' to match the directory structure
if (class_exists('App\Helpers\View')) {
    \App\Helpers\View::displayComponent("staff/sidebar.php");
}
?>

<main class="zeith-details-page">
    <div class="zeith-details-container">
        <div class="zeith-details-header">
            <div class="zeith-details-heading">
                <h1>Watch Details</h1>
                <p>View detailed information about this timepiece.</p>
            </div>
            <a href="/Zeith/staff/watch" class="zeith-back-button">&larr; Back to Inventory</a>
        </div>

        <div class="zeith-details-notice">
            <div class="zeith-details-notice-icon">&#128065;</div>
            <div>
                <strong>Staff View-Only Access</strong>
                <span>This page is for operational viewing only. Staff cannot edit, delete, add or modify watch information.</span>
            </div>
        </div>

        <div class="zeith-details-grid">
            <div>
                <section class="zeith-details-card zeith-gallery">
                    <div class="zeith-gallery-main" id="zeithGalleryMain">
                        <img src="<?= htmlspecialchars($images[0], ENT_QUOTES, 'UTF-8') ?>" alt="<?= $watchName ?>" id="zeithMainImage">

                        <?php if (count($images) > 1): ?>
                            <button type="button" class="zeith-gallery-arrow zeith-gallery-prev" id="zeithGalleryPrev" aria-label="Previous image">&#8249;</button>
                            <button type="button" class="zeith-gallery-arrow zeith-gallery-next" id="zeithGalleryNext" aria-label="Next image">&#8250;</button>
                        <?php endif; ?>
                    </div>

                    <?php if (count($images) > 1): ?>
                        <div class="zeith-gallery-thumbnails">
                            <?php foreach ($images as $index => $image): ?>
                                <button type="button" class="zeith-gallery-thumbnail <?= $index === 0 ? 'active' : '' ?>" data-gallery-index="<?= $index ?>">
                                    <img src="<?= htmlspecialchars($image, ENT_QUOTES, 'UTF-8') ?>" alt="<?= $watchName ?> image <?= $index + 1 ?>">
                                </button>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </section>

                <section class="zeith-details-card zeith-information">
                    <h2 class="zeith-section-title">Watch Information</h2>

                    <div class="zeith-info-grid">
                        <div class="zeith-info-item">
                            <div class="zeith-info-label">Watch Name</div>
                            <div class="zeith-info-value"><?= $watchName ?></div>
                        </div>

                        <div class="zeith-info-item">
                            <div class="zeith-info-label">Collection</div>
                            <div class="zeith-info-value"><?= $collection ?></div>
                        </div>

                        <div class="zeith-info-item">
                            <div class="zeith-info-label">Rating</div>
                            <div class="zeith-info-value zeith-rating-value">
                                &#9733; <?= number_format($rating, 1) ?>
                                <span class="zeith-rating-number">/ 5</span>
                            </div>
                        </div>

                        <div class="zeith-info-item">
                            <div class="zeith-info-label">Price</div>
                            <div class="zeith-info-value zeith-price-value">&#8358;<?= number_format($price, 0) ?></div>
                        </div>

                        <div class="zeith-info-item">
                            <div class="zeith-info-label">Featured Status</div>
                            <div class="zeith-info-value">
                                <?php if ($isFeatured): ?>
                                    <span class="zeith-featured-badge">&#9733; Trending</span>
                                <?php else: ?>
                                    <span class="zeith-not-featured-badge">Not Trending</span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="zeith-info-item">
                            <div class="zeith-info-label">Added to Catalog</div>
                            <div class="zeith-info-value"><?= htmlspecialchars($createdAt, ENT_QUOTES, 'UTF-8') ?></div>
                        </div>

                        <div class="zeith-info-item">
                            <div class="zeith-info-label">Customer Likes</div>
                            <div class="zeith-info-value">&#9829; <?= number_format($likesCount) ?></div>
                        </div>

                        <div class="zeith-info-item">
                            <div class="zeith-info-label">Customer Reviews</div>
                            <div class="zeith-info-value">
                                <?= number_format($reviewsCount) ?>
                                <?= $reviewsCount === 1 ? 'Review' : 'Reviews' ?>
                            </div>
                        </div>
                    </div>

                    <div class="zeith-inventory">
                        <h2 class="zeith-section-title">Inventory Status</h2>

                        <div class="zeith-inventory-grid">
                            <div class="zeith-inventory-box">
                                <span>Stock Quantity</span>
                                <strong>
                                    <?= number_format($stock) ?>
                                    <?= $stock === 1 ? 'unit' : 'units' ?>
                                </strong>
                            </div>

                            <div class="zeith-inventory-box">
                                <span>Stock Status</span>

                                <?php if ($inStock): ?>
                                    <div class="zeith-status in-stock">&#9679; In Stock</div>
                                <?php else: ?>
                                    <div class="zeith-status out-stock">&#9679; Out of Stock</div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="zeith-description">
                        <h2 class="zeith-section-title">Description</h2>
                        <p><?= $description ?></p>
                    </div>

                    <div class="zeith-strap">
                        <h2 class="zeith-section-title">Strap</h2>
                        <p style="margin:0;color:#475569;font-size:14px;"><?= $strap ?></p>
                    </div>
                </section>
            </div>

            <aside class="zeith-details-card zeith-summary">
                <h2 class="zeith-summary-title">Watch Summary</h2>

                <div class="zeith-summary-row">
                    <span class="zeith-summary-label">Watch</span>
                    <span class="zeith-summary-value"><?= $watchName ?></span>
                </div>

                <div class="zeith-summary-row">
                    <span class="zeith-summary-label">Collection</span>
                    <span class="zeith-summary-value"><?= $collection ?></span>
                </div>

                <div class="zeith-summary-row">
                    <span class="zeith-summary-label">Price</span>
                    <span class="zeith-summary-value">&#8358;<?= number_format($price, 0) ?></span>
                </div>

                <div class="zeith-summary-row">
                    <span class="zeith-summary-label">Storefront</span>
                    <span class="zeith-summary-value">
                        <?php if ($isFeatured): ?>
                            <span class="zeith-featured-badge">&#9733; Featured</span>
                        <?php else: ?>
                            <span class="zeith-not-featured-badge">Not Featured</span>
                        <?php endif; ?>
                    </span>
                </div>

                <div class="zeith-summary-row">
                    <span class="zeith-summary-label">Added</span>
                    <span class="zeith-summary-value"><?= htmlspecialchars($createdAt, ENT_QUOTES, 'UTF-8') ?></span>
                </div>

                <div class="zeith-summary-row">
                    <span class="zeith-summary-label">Likes</span>
                    <span class="zeith-summary-value">&#9829; <?= number_format($likesCount) ?></span>
                </div>

                <div class="zeith-summary-row">
                    <span class="zeith-summary-label">Reviews</span>
                    <span class="zeith-summary-value"><?= number_format($reviewsCount) ?></span>
                </div>

                <?php if (!empty($manual)): ?>
                    <div class="zeith-manual">
                        <h3 class="zeith-manual-title">Watch Manual</h3>
                        <p>Reference the official watch manual for product information.</p>
                        <a href="<?= htmlspecialchars($manual, ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener noreferrer" class="zeith-manual-link">View Manual</a>
                    </div>
                <?php endif; ?>

                <div class="zeith-operational-note">
                    <strong>Staff Access</strong>
                    <br>
                    This watch record is displayed for inventory, fulfillment and customer-support purposes. Changes to watches are handled by authorized administrators.
                </div>
            </aside>
        </div>
    </div>
</main>


<script>
    (function() {
        const images = <?= json_encode(array_values($images)) ?>;
        const mainImage = document.getElementById('zeithMainImage');
        const thumbnails = document.querySelectorAll('.zeith-gallery-thumbnail');
        const previousButton = document.getElementById('zeithGalleryPrev');
        const nextButton = document.getElementById('zeithGalleryNext');

        if (!mainImage || !images.length) {
            return;
        }

        let currentIndex = 0;

        function showImage(index) {
            if (index < 0) {
                index = images.length - 1;
            }

            if (index >= images.length) {
                index = 0;
            }

            currentIndex = index;
            mainImage.src = images[currentIndex];

            thumbnails.forEach(function(thumbnail, i) {
                thumbnail.classList.toggle('active', i === currentIndex);
            });
        }

        if (previousButton) {
            previousButton.addEventListener('click', function() {
                showImage(currentIndex - 1);
            });
        }

        if (nextButton) {
            nextButton.addEventListener('click', function() {
                showImage(currentIndex + 1);
            });
        }

        thumbnails.forEach(function(thumbnail, index) {
            thumbnail.addEventListener('click', function() {
                showImage(index);
            });
        });

        // Optional: Keyboard Arrow Navigation (Left / Right)
        document.addEventListener('keydown', function(event) {
            if (event.key === 'ArrowLeft') {
                showImage(currentIndex - 1);
            } else if (event.key === 'ArrowRight') {
                showImage(currentIndex + 1);
            }
        });
    })();
</script>