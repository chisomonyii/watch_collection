<?php
// views/Staff/watch.php

// Ensure $watches is always an array to prevent errors if empty
$watches = $watches ?? [];
?>

<style>
    /* =========================================================
   ZEITH STAFF - WATCH / INVENTORY PAGE
   ========================================================= */

    .zeith-watch-page {
        margin-left: 250px;
        min-height: 100vh;
        background: #F4F6F9;
        padding: 32px;
        box-sizing: border-box;
    }

    /* ---------- Header ---------- */

    .zeith-watch-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 28px;
    }

    .zeith-watch-header-left h1 {
        margin: 0 0 7px;
        color: #0F172A;
        font-size: 28px;
        font-weight: 800;
        letter-spacing: -0.5px;
    }

    .zeith-watch-header-left p {
        margin: 0;
        color: #64748B;
        font-size: 14px;
    }

    .zeith-watch-notice {
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 11px 15px;
        border-radius: 10px;
        background: #EFF6FF;
        border: 1px solid #BFDBFE;
        color: #1D4ED8;
        font-size: 13px;
        font-weight: 600;
    }

    .zeith-watch-notice svg {
        width: 17px;
        height: 17px;
        flex-shrink: 0;
    }

    /* ---------- Inventory Grid ---------- */

    .zeith-watch-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 24px;
    }

    /* ---------- Watch Card ---------- */

    .zeith-watch-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 4px 14px rgba(15, 23, 42, 0.05);
        transition:
            transform 0.25s ease,
            box-shadow 0.25s ease;
    }

    .zeith-watch-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 28px rgba(15, 23, 42, 0.10);
    }

    /* =========================================================
   IMAGE AREA
   ========================================================= */

    .zeith-watch-image {
        position: relative;
        height: 330px;
        background: #F8FAFC;
        overflow: hidden;
    }

    .zeith-watch-image-track {
        width: 100%;
        height: 100%;
        position: relative;
    }

    .zeith-watch-slide {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease;
        display: block;
    }

    .zeith-watch-slide.active {
        opacity: 1;
        visibility: visible;
    }

    /* ---------- Top badges ---------- */

    .zeith-watch-top-badges {
        position: absolute;
        top: 14px;
        left: 14px;
        z-index: 10;
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    /* Likes */

    .zeith-watch-likes {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        min-height: 38px;
        padding: 0 13px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.96);
        border: 1px solid #E2E8F0;
        box-shadow: 0 5px 16px rgba(15, 23, 42, 0.08);
        color: #0F172A;
        font-size: 14px;
        font-weight: 700;
    }

    .zeith-watch-likes .heart {
        color: #EF4444;
        font-size: 18px;
        line-height: 1;
    }

    /* Trending */

    .zeith-watch-trending {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        min-height: 38px;
        padding: 0 13px;
        border-radius: 999px;
        background: rgba(239, 246, 255, 0.96);
        border: 1px solid #BFDBFE;
        box-shadow: 0 5px 16px rgba(15, 23, 42, 0.08);
        color: #2563EB;
        font-size: 14px;
        font-weight: 700;
    }

    .zeith-watch-trending .star {
        font-size: 16px;
        line-height: 1;
        color: #2563EB;
    }

    /* =========================================================
   AVAILABLE / SOLD OUT
   Bottom-right corner of image
   ========================================================= */

    .zeith-watch-stock {
        position: absolute;
        right: 14px;
        bottom: 27px;
        z-index: 12;

        display: inline-flex;
        align-items: center;
        gap: 7px;

        min-height: 38px;
        padding: 0 14px;

        border-radius: 999px;

        font-size: 13px;
        font-weight: 800;

        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);

        box-shadow: 0 5px 16px rgba(15, 23, 42, 0.10);
    }

    .zeith-watch-stock.available {
        background: rgba(236, 253, 245, 0.96);
        border: 1px solid #A7F3D0;
        color: #047857;
    }

    .zeith-watch-stock.soldout {
        background: rgba(254, 242, 242, 0.96);
        border: 1px solid #FECACA;
        color: #B91C1C;
    }

    .zeith-stock-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .available .zeith-stock-dot {
        background: #10B981;
    }

    .soldout .zeith-stock-dot {
        background: #EF4444;
    }

    /* =========================================================
   IMAGE ARROWS
   ========================================================= */

    .zeith-watch-arrow {
        position: absolute;
        top: 50%;
        z-index: 15;

        width: 40px;
        height: 40px;

        transform: translateY(-50%);

        border: 1px solid rgba(255, 255, 255, 0.75);
        border-radius: 50%;

        background: rgba(255, 255, 255, 0.92);
        color: #0F172A;

        display: flex;
        align-items: center;
        justify-content: center;

        cursor: pointer;

        box-shadow: 0 6px 18px rgba(15, 23, 42, 0.12);

        transition:
            background 0.2s ease,
            transform 0.2s ease,
            box-shadow 0.2s ease;
    }

    .zeith-watch-arrow:hover {
        background: #FFFFFF;
        box-shadow: 0 8px 22px rgba(15, 23, 42, 0.18);
    }

    .zeith-watch-arrow:active {
        transform: translateY(-50%) scale(0.94);
    }

    .zeith-watch-arrow.left {
        left: 13px;
    }

    .zeith-watch-arrow.right {
        right: 13px;
    }

    .zeith-watch-arrow svg {
        width: 19px;
        height: 19px;
        stroke-width: 2.5;
    }

    /* ---------- Image indicators ---------- */

    .zeith-watch-indicators {
        position: absolute;
        left: 50%;
        bottom: 18px;
        z-index: 14;

        transform: translateX(-50%);

        display: flex;
        align-items: center;
        gap: 6px;

        padding: 5px 9px;

        border-radius: 999px;
        background: rgba(15, 23, 42, 0.38);
        backdrop-filter: blur(5px);
    }

    .zeith-watch-indicator {
        width: 6px;
        height: 6px;
        padding: 0;

        border: 0;
        border-radius: 50%;

        background: rgba(255, 255, 255, 0.55);

        cursor: pointer;
        transition: all 0.2s ease;
    }

    .zeith-watch-indicator.active {
        width: 18px;
        border-radius: 999px;
        background: #FFFFFF;
    }

    /* =========================================================
   CARD CONTENT
   ========================================================= */

    .zeith-watch-content {
        padding: 20px;
    }

    .zeith-watch-name {
        margin: 0 0 6px;
        color: #0F172A;
        font-size: 19px;
        font-weight: 800;
        line-height: 1.3;
    }

    .zeith-watch-collection {
        margin: 0 0 13px;
        color: #64748B;
        font-size: 13px;
        font-weight: 600;
    }

    .zeith-watch-rating {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 14px;
    }

    .zeith-watch-stars {
        color: #F59E0B;
        font-size: 15px;
        letter-spacing: 1px;
    }

    .zeith-watch-rating-number {
        color: #475569;
        font-size: 13px;
        font-weight: 700;
    }

    .zeith-watch-reviews {
        color: #94A3B8;
        font-weight: 500;
    }

    .zeith-watch-bottom {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding-top: 14px;
        border-top: 1px solid #E2E8F0;
    }

    .zeith-watch-price {
        color: #0F172A;
        font-size: 20px;
        font-weight: 800;
    }

    .zeith-watch-view-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;

        min-height: 40px;
        padding: 0 15px;

        border-radius: 9px;

        background: #2563EB;
        color: #FFFFFF;

        text-decoration: none;

        font-size: 13px;
        font-weight: 700;

        transition:
            background 0.2s ease,
            transform 0.2s ease;
    }

    .zeith-watch-view-btn:hover {
        background: #1D4ED8;
        transform: translateY(-1px);
    }

    .zeith-watch-view-btn svg {
        width: 16px;
        height: 16px;
    }

    /* ---------- Empty state ---------- */

    .zeith-watch-empty {
        grid-column: 1 / -1;
        padding: 60px 25px;
        text-align: center;
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        color: #64748B;
    }

    .zeith-watch-empty h3 {
        margin: 0 0 7px;
        color: #0F172A;
        font-size: 19px;
    }

    .zeith-watch-empty p {
        margin: 0;
        font-size: 14px;
    }

    /* =========================================================
   TABLET
   ========================================================= */

    @media (max-width: 1200px) {
        .zeith-watch-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    /* =========================================================
   MOBILE / IPAD
   ========================================================= */

    @media (max-width: 1024px) {
        .zeith-watch-page {
            margin-left: 0;
            padding: 25px;
        }

        .zeith-watch-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 700px) {
        .zeith-watch-page {
            padding: 18px;
        }

        .zeith-watch-header {
            flex-direction: column;
        }

        .zeith-watch-header-left h1 {
            font-size: 24px;
        }

        .zeith-watch-grid {
            grid-template-columns: 1fr;
        }

        .zeith-watch-image {
            height: 320px;
        }
    }

    @media (max-width: 450px) {
        .zeith-watch-image {
            height: 290px;
        }

        .zeith-watch-top-badges {
            top: 10px;
            left: 10px;
            gap: 5px;
        }

        .zeith-watch-likes,
        .zeith-watch-trending {
            min-height: 34px;
            padding: 0 10px;
            font-size: 12px;
        }

        .zeith-watch-stock {
            right: 10px;
            bottom: 10px;
            min-height: 34px;
            padding: 0 11px;
            font-size: 12px;
        }

        .zeith-watch-arrow {
            width: 36px;
            height: 36px;
        }

        .zeith-watch-arrow.left {
            left: 9px;
        }

        .zeith-watch-arrow.right {
            right: 9px;
        }
    }

    
.zeith-watch-search {
    position: relative;
    width: 100%;
    max-width: 550px;
    margin: 0 0 25px;
}

.zeith-watch-search svg {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    width: 19px;
    height: 19px;
    fill: none;
    stroke: #64748B;
    stroke-width: 2;
    pointer-events: none;
}

.zeith-watch-search input {
    width: 100%;
    height: 46px;
    padding: 0 125px 0 45px;
    background: #FFFFFF;
    border: 1px solid #E2E8F0;
    border-radius: 9px;
    outline: none;
    color: #0F172A;
    font-size: 14px;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}

.zeith-watch-search input:focus {
    border-color: #2563EB;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}

.zeith-watch-search-count {
    position: absolute;
    right: 13px;
    top: 50%;
    transform: translateY(-50%);
    color: #64748B;
    font-size: 12px;
    white-space: nowrap;
    pointer-events: none;
}

.zeith-watch-card.search-hidden {
    display: none !important;
}

.zeith-watch-search-empty {
    grid-column: 1 / -1;
    width: 100%;
    padding: 45px 20px;
    text-align: center;
    background: #FFFFFF;
    border: 1px dashed #CBD5E1;
    border-radius: 12px;
    color: #64748B;
}

.zeith-watch-search-empty strong {
    display: block;
    margin-bottom: 8px;
    color: #0F172A;
    font-size: 16px;
}

@media (max-width: 480px) {
    .zeith-watch-search {
        max-width: 100%;
    }

    .zeith-watch-search input {
        font-size: 13px;
    }
}

</style>

<?php
// views/Staff/review.php

\App\Helpers\View::displayComponent("Staff/sidebar.php");
?>

<div class="zeith-watch-page">
    <div class="zeith-watch-header">
        <div class="zeith-watch-header-left">
            <h1>Inventory Status</h1>
            <p>View available watches and monitor current inventory.</p>
        </div>
        <div class="zeith-watch-notice">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path d="M12 9v4"></path>
                <path d="M12 17h.01"></path>
                <circle cx="12" cy="12" r="9"></circle>
            </svg>
            Staff view only — inventory cannot be edited here.
        </div>
    </div>


    <div class="zeith-watch-search">
        <svg viewBox="0 0 24 24" aria-hidden="true">
            <circle cx="11" cy="11" r="7"></circle>
            <path d="m20 20-4-4"></path>
        </svg>

        <input
            type="search"
            id="zeithWatchSearch"
            placeholder="Search watches by name, collection or price..."
            autocomplete="off">

        <span id="zeithWatchSearchCount" class="zeith-watch-search-count"></span>
    </div>

    <div class="zeith-watch-grid">
        <?php if (!empty($watches)): ?>
            <?php foreach ($watches as $watch): ?>
                <?php
                $watchId = (int)($watch['id'] ?? 0);
                $watchName = htmlspecialchars($watch['name'] ?? 'Unnamed Watch', ENT_QUOTES, 'UTF-8');
                $collection = htmlspecialchars($watch['collection'] ?? 'Collection', ENT_QUOTES, 'UTF-8');
                $rating = (float)($watch['rating'] ?? 5.0);
                $likesCount = (int)($watch['likes_count'] ?? 0);
                $reviewsCount = (int)($watch['reviews_count'] ?? 0);
                $price = (float)($watch['price'] ?? 0);
                $isFeatured = !empty($watch['is_featured']);
                $stock = (int)($watch['stock'] ?? 0);
                $inStock = !empty($watch['in_stock']) && $stock > 0;
                $images = $watch['images'] ?? [];
                if (empty($images)) {
                    $images = ['/Watch_Collection/assets/images/placeholder.jpg'];
                }
                ?>
                <article class="zeith-watch-card" data-watch-id="<?= $watchId ?>">
                    <div class="zeith-watch-image">
                        <div class="zeith-watch-top-badges">
                            <div class="zeith-watch-likes">
                                <span class="heart">♥</span>
                                <span>(<?= $likesCount ?>)</span>
                            </div>
                            <?php if ($isFeatured): ?>
                                <div class="zeith-watch-trending">
                                    <span class="star">★</span>
                                    <span>Trending</span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="zeith-watch-image-track" data-carousel="<?= $watchId ?>">
                            <?php foreach ($images as $index => $image): ?>
                                <?php $image = htmlspecialchars($image, ENT_QUOTES, 'UTF-8'); ?>
                                <img src="<?= $image ?>" alt="<?= $watchName ?>" class="zeith-watch-slide <?= $index === 0 ? 'active' : '' ?>" data-slide="<?= $index ?>" loading="<?= $index === 0 ? 'eager' : 'lazy' ?>">
                            <?php endforeach; ?>
                        </div>
                        <?php if (count($images) > 1): ?>
                            <button type="button" class="zeith-watch-arrow left" data-direction="prev" data-carousel="<?= $watchId ?>" aria-label="Previous image">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path d="M15 18l-6-6 6-6" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                            <button type="button" class="zeith-watch-arrow right" data-direction="next" data-carousel="<?= $watchId ?>" aria-label="Next image">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path d="M9 18l6-6-6-6" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        <?php endif; ?>
                        <?php if (count($images) > 1): ?>
                            <div class="zeith-watch-indicators">
                                <?php foreach ($images as $index => $image): ?>
                                    <button type="button" class="zeith-watch-indicator <?= $index === 0 ? 'active' : '' ?>" data-carousel="<?= $watchId ?>" data-slide="<?= $index ?>" aria-label="View image <?= $index + 1 ?>"></button>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <div class="zeith-watch-stock <?= $inStock ? 'available' : 'soldout' ?>">
                            <span class="zeith-stock-dot"></span>
                            <?php if ($inStock): ?>
                                Available
                            <?php else: ?>
                                Sold Out
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="zeith-watch-content">
                        <h2 class="zeith-watch-name"><?= $watchName ?></h2>
                        <p class="zeith-watch-collection"><?= $collection ?></p>
                        <div class="zeith-watch-rating">
                            <span class="zeith-watch-stars">
                                <?php
                                $fullStars = (int)floor($rating);
                                for ($i = 0; $i < $fullStars; $i++):
                                ?>
                                    ★
                                <?php endfor; ?>
                            </span>
                            <span class="zeith-watch-rating-number"><?= number_format($rating, 1) ?>/5</span>
                            <span class="zeith-watch-reviews">(<?= $reviewsCount ?> reviews)</span>
                        </div>
                        <div class="zeith-watch-bottom">
                            <div class="zeith-watch-price">₦<?= number_format($price, 0) ?></div>
                            <a href="/Watch_Collection/staff/watch/details/<?= $watchId ?>" class="zeith-watch-view-btn">
                                View Details
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path d="M5 12h14" stroke-linecap="round" />
                                    <path d="M13 6l6 6-6 6" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="zeith-watch-empty">
                <h3>No Watches Available</h3>
                <p>There are currently no watches available in the inventory.</p>
            </div>
        <?php endif; ?>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const carousels = {};

        // Initialize all carousels on the staff inventory page
        document.querySelectorAll('.zeith-watch-image-track').forEach(function(track) {
            const carouselId = track.dataset.carousel;
            const slides = Array.from(track.querySelectorAll('.zeith-watch-slide'));

            carousels[carouselId] = {
                track: track,
                slides: slides,
                current: 0
            };
        });

        function showSlide(carouselId, index) {
            const carousel = carousels[carouselId];

            if (!carousel || !carousel.slides.length) {
                return;
            }

            const total = carousel.slides.length;

            if (index < 0) {
                index = total - 1;
            }

            if (index >= total) {
                index = 0;
            }

            carousel.current = index;

            // Toggle active class on slides
            carousel.slides.forEach(function(slide, slideIndex) {
                slide.classList.toggle('active', slideIndex === index);
            });

            // Toggle active class on pagination indicator dots
            document.querySelectorAll(
                '.zeith-watch-indicator[data-carousel="' + carouselId + '"]'
            ).forEach(function(indicator) {
                const indicatorIndex = parseInt(indicator.dataset.slide, 10);
                indicator.classList.toggle('active', indicatorIndex === index);
            });
        }

        // Arrow click handlers (Previous / Next)
        document.querySelectorAll('.zeith-watch-arrow').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                event.stopPropagation();

                const carouselId = button.dataset.carousel;
                const direction = button.dataset.direction;
                const carousel = carousels[carouselId];

                if (!carousel) {
                    return;
                }

                showSlide(
                    carouselId,
                    carousel.current + (direction === 'next' ? 1 : -1)
                );
            });
        });

        // Indicator dot click handlers
        document.querySelectorAll('.zeith-watch-indicator').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                event.stopPropagation();

                const carouselId = button.dataset.carousel;
                const slideIndex = parseInt(button.dataset.slide, 10);

                showSlide(carouselId, slideIndex);
            });
        });

        // Optional keyboard navigation (Arrow Left / Arrow Right when card is focused)
        document.addEventListener('keydown', function(event) {
            if (event.key !== 'ArrowLeft' && event.key !== 'ArrowRight') {
                return;
            }

            const activeElement = document.activeElement;
            const card = activeElement ?
                activeElement.closest('.zeith-watch-card') :
                null;

            if (!card) {
                return;
            }

            const track = card.querySelector('.zeith-watch-image-track');

            if (!track) {
                return;
            }

            const carouselId = track.dataset.carousel;
            const carousel = carousels[carouselId];

            if (!carousel) {
                return;
            }

            showSlide(
                carouselId,
                carousel.current + (event.key === 'ArrowRight' ? 1 : -1)
            );
        });
    });


    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById("zeithWatchSearch");
        const searchCount = document.getElementById("zeithWatchSearchCount");
        const watchGrid = document.querySelector(".zeith-watch-grid");

        if (!searchInput || !watchGrid) return;

        const watchCards = Array.from(
            watchGrid.querySelectorAll(".zeith-watch-card")
        );

        const emptyMessage = document.createElement("div");
        emptyMessage.className = "zeith-watch-search-empty";
        emptyMessage.innerHTML = `
        <strong>No watches found</strong>
        Try searching with a different watch name or keyword.
    `;

        function filterWatches() {
            const searchTerm = searchInput.value.trim().toLowerCase();
            let visibleCount = 0;

            watchCards.forEach(function(card) {
                const watchName = (
                    card.querySelector(".zeith-watch-name")?.textContent || ""
                ).toLowerCase();

                const collection = (
                    card.querySelector(".zeith-watch-collection")?.textContent || ""
                ).toLowerCase();

                const searchableText = card.textContent.toLowerCase();

                const matches =
                    watchName.includes(searchTerm) ||
                    collection.includes(searchTerm) ||
                    searchableText.includes(searchTerm);

                card.classList.toggle("search-hidden", !matches);

                if (matches) {
                    visibleCount++;
                }
            });

            if (watchCards.length > 0 && visibleCount === 0) {
                if (!emptyMessage.isConnected) {
                    watchGrid.appendChild(emptyMessage);
                }
            } else {
                emptyMessage.remove();
            }

            if (searchCount) {
                searchCount.textContent =
                    `${visibleCount} of ${watchCards.length} watches`;
            }
        }

        searchInput.addEventListener("input", filterWatches);

        filterWatches();
    });
</script>