<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Wishlist - Zeith</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }

        body {
            background: #f8f8f6;
            color: #111111;
        }

        /* CONTAINER */
        .wishlist-container {
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px 30px 80px;
            margin-top: 40px;
        }

        .wishlist-title {
            text-align: center;
            font-size: 32px;
            font-weight: 800;
            color: #111111;
            letter-spacing: -0.5px;
            margin-bottom: 40px;
        }

        /* GRID */
        .wishlist-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
        }

        .empty-wishlist {
            grid-column: 1 / -1;
            text-align: center;
            font-size: 18px;
            color: #888888;
            padding: 80px 0;
            display: none;
        }

        /* --- EXACT HOME CARD STYLING --- */
        .watch-card {
            background: #ffffff;
            border-radius: 36px;
            padding: 24px;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.03);
            display: flex;
            flex-direction: column;
            position: relative;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .watch-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.07);
        }

        /* TOP BADGES */
        .card-top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: absolute;
            top: 24px;
            left: 24px;
            right: 24px;
            z-index: 10;
        }

        .status-badge {
            background: #e2f0d9;
            color: #2b6118;
            font-size: 12px;
            font-weight: 700;
            padding: 8px 16px;
            border-radius: 20px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .wishlist-heart {
            width: 44px;
            height: 44px;
            background: #ffffff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            transition: transform 0.2s ease;
            color: #ff5252;
        }

        .wishlist-heart:hover {
            transform: scale(1.1);
        }

        .wishlist-heart svg {
            width: 20px;
            height: 20px;
            fill: #ff5252;
        }

        /* HERO IMAGE CONTAINER */
        .watch-image-container {
            width: 100%;
            height: 290px;
            border-radius: 28px;
            background: linear-gradient(180deg, #ffffff 0%, #f3f3f5 100%);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
            overflow: hidden;
        }

        .watch-image-container img {
            max-width: 78%;
            max-height: 78%;
            object-fit: contain;
            transition: opacity 0.25s ease, transform 0.25s ease;
        }

        /* CAROUSEL ARROWS */
        .carousel-arrow {
            width: 38px;
            height: 38px;
            background: #ffffff;
            border-radius: 50%;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: #111111;
            z-index: 5;
            transition: background-color 0.2s ease, transform 0.2s ease;
        }

        .carousel-arrow:hover {
            background-color: #f8f8f8;
            transform: translateY(-50%) scale(1.1);
        }

        .carousel-arrow.prev {
            left: 14px;
        }

        .carousel-arrow.next {
            right: 14px;
        }

        /* DARK GRADIENT & PRICE OVERLAY */
        .price-overlay-bar {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 20px 20px 14px;
            background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.75) 100%);
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .price-display {
            color: #ffffff;
            font-size: 26px;
            font-weight: 800;
            text-align: right;
            letter-spacing: -0.5px;
        }

        .progress-indicators {
            display: flex;
            gap: 8px;
            width: 100%;
        }

        .progress-bar-segment {
            height: 4px;
            flex-grow: 1;
            background: rgba(255, 255, 255, 0.35);
            border-radius: 2px;
            transition: background-color 0.25s ease;
        }

        .progress-bar-segment.active {
            background: #ffffff;
        }

        /* CARD DETAILS */
        .watch-details-content {
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 24px;
        }

        .watch-title-text {
            font-size: 24px;
            font-weight: 800;
            color: #111111;
            margin-bottom: 10px;
            letter-spacing: -0.3px;
        }

        .watch-desc-text {
            font-size: 14px;
            color: #999999;
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            max-width: 90%;
            font-weight: 400;
        }

        /* FOOTER ACTIONS */
        .card-footer-actions {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: auto;
        }

        .btn-add-cart-orange {
            background: #ff8a00;
            color: #000000;
            border: none;
            border-radius: 24px;
            padding: 12px 32px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s ease, transform 0.2s ease;
        }

        .btn-add-cart-orange:hover {
            background: #e57c00;
            transform: translateY(-2px);
        }

        .view-details-link {
            color: #ff8a00;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .view-details-link:hover {
            color: #e57c00;
            text-decoration: underline;
        }

        /* RESPONSIVE */
        @media (max-width: 1200px) {
            .wishlist-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 900px) {
            .wishlist-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .wishlist-container {
                padding: 25px 16px 50px;
            }

            .wishlist-grid {
                grid-template-columns: 1fr;
                gap: 24px;
            }
        }
    </style>
</head>

<body>

    <?php require_once __DIR__ . '/../components/header.php'; ?>

    <main class="wishlist-container">

        <h1 class="wishlist-title">My Wishlist</h1>

        <section class="wishlist-grid" id="wishlist-grid">

            <?php if (!empty($wishlistItems)): ?>
                <?php foreach ($wishlistItems as $item): ?>
                    <?php
                    $img1 = "/Watch_Collection/assets/image/" . ($item['image_url_1'] ?? $item['image_url'] ?? 'Nautilus_5711-removebg-preview.png');
                    $img2 = "/Watch_Collection/assets/image/" . ($item['image_url_2'] ?? $item['image_url_1'] ?? 'Nautilus_5711-removebg-preview.png');
                    $img3 = "/Watch_Collection/assets/image/" . ($item['image_url_3'] ?? $item['image_url_1'] ?? 'Nautilus_5711-removebg-preview.png');
                    $img4 = "/Watch_Collection/assets/image/" . ($item['image_url_4'] ?? $item['image_url_1'] ?? 'Nautilus_5711-removebg-preview.png');

                    $watchPrice = "₦" . number_format($item['price'] ?? 85000);
                    $watchId = htmlspecialchars($item['id']);
                    $watchName = htmlspecialchars($item['name'] ?? 'Luxury Watch');
                    $watchDesc = htmlspecialchars($item['description'] ?? 'Exclusive luxury craftsmanship with precision movement.');
                    ?>
                    <div class="watch-card" data-id="<?= $watchId; ?>"
                        data-images='["<?= $img1 ?>", "<?= $img2 ?>", "<?= $img3 ?>", "<?= $img4 ?>"]'>

                        <!-- TOP BAR -->
                        <div class="card-top-bar">
                            <span class="status-badge"><?= htmlspecialchars($item['tag'] ?? 'AVAILABLE'); ?></span>
                            <div class="wishlist-heart" title="Remove from wishlist">
                                <svg viewBox="0 0 24 24">
                                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                </svg>
                            </div>
                        </div>

                        <!-- HERO IMAGE CONTAINER -->
                        <div class="watch-image-container">
                            <button class="carousel-arrow prev" type="button">&lsaquo;</button>
                            <img class="card-main-img" src="<?= $img1; ?>" alt="<?= $watchName; ?>">
                            <button class="carousel-arrow next" type="button">&rsaquo;</button>

                            <div class="price-overlay-bar">
                                <div class="price-display"><?= $watchPrice; ?></div>
                                <div class="progress-indicators">
                                    <div class="progress-bar-segment active"></div>
                                    <div class="progress-bar-segment"></div>
                                    <div class="progress-bar-segment"></div>
                                    <div class="progress-bar-segment"></div>
                                </div>
                            </div>
                        </div>

                        <!-- DETAILS -->
                        <div class="watch-details-content">
                            <h2 class="watch-title-text"><?= $watchName; ?></h2>
                            <p class="watch-desc-text"><?= $watchDesc; ?></p>
                        </div>

                        <!-- FOOTER -->
                        <div class="card-footer-actions">
                            <button class="btn-add-cart-orange" type="button">Add</button>
                            <a href="/Watch_Collection/watch/details/<?= $watchId; ?>" class="view-details-link">View details &rarr;</a>
                        </div>

                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </section>

        <div id="empty-wishlist-msg" class="empty-wishlist">
            Your wishlist is currently empty.
        </div>

    </main>

    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const grid = document.getElementById('wishlist-grid');
            const emptyMsg = document.getElementById('empty-wishlist-msg');

            const savedIds = JSON.parse(localStorage.getItem('zeith_wishlist')) || [];

            if (savedIds.length === 0) {
                if (grid) grid.innerHTML = '';
                if (emptyMsg) emptyMsg.style.display = 'block';
                updateWishlistBadge();
                return;
            }

            if (emptyMsg) emptyMsg.style.display = 'none';

            const hasPhpItems = grid && grid.querySelectorAll('.watch-card').length > 0;

            if (!hasPhpItems && grid) {
                try {
                    const response = await fetch('/Watch_Collection/api/wishlist-items', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            ids: savedIds
                        })
                    });

                    const result = await response.json();

                    if (result.success && result.data && result.data.length > 0) {
                        if (emptyMsg) emptyMsg.style.display = 'none';

                        grid.innerHTML = result.data.map(item => {
                            const img1 = `/Watch_Collection/assets/image/${item.image_url_1 || item.image || item.image_url || 'Nautilus_5711-removebg-preview.png'}`;
                            const img2 = `/Watch_Collection/assets/image/${item.image_url_2 || item.image_url_1 || 'Nautilus_5711-removebg-preview.png'}`;
                            const img3 = `/Watch_Collection/assets/image/${item.image_url_3 || item.image_url_1 || 'Nautilus_5711-removebg-preview.png'}`;
                            const img4 = `/Watch_Collection/assets/image/${item.image_url_4 || item.image_url_1 || 'Nautilus_5711-removebg-preview.png'}`;

                            const watchPrice = `₦${Number(item.price || 0).toLocaleString()}`;

                            return `
                                <div class="watch-card" data-id="${item.id}" 
                                     data-images='["${img1}", "${img2}", "${img3}", "${img4}"]'>
                                     
                                    <div class="card-top-bar">
                                        <span class="status-badge">${item.tag || 'AVAILABLE'}</span>
                                        <div class="wishlist-heart" title="Remove from wishlist">
                                            <svg viewBox="0 0 24 24">
                                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                            </svg>
                                        </div>
                                    </div>

                                    <div class="watch-image-container">
                                        <button class="carousel-arrow prev" type="button">&lsaquo;</button>
                                        <img class="card-main-img" src="${img1}" alt="${item.name}">
                                        <button class="carousel-arrow next" type="button">&rsaquo;</button>

                                        <div class="price-overlay-bar">
                                            <div class="price-display">${watchPrice}</div>
                                            <div class="progress-indicators">
                                                <div class="progress-bar-segment active"></div>
                                                <div class="progress-bar-segment"></div>
                                                <div class="progress-bar-segment"></div>
                                                <div class="progress-bar-segment"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="watch-details-content">
                                        <h2 class="watch-title-text">${item.name || ''}</h2>
                                        <p class="watch-desc-text">${item.description || 'Exclusive luxury craftsmanship with precision movement.'}</p>
                                    </div>

                                    <div class="card-footer-actions">
                                        <button class="btn-add-cart-orange" type="button">Add</button>
                                        <a href="/Watch_Collection/watch/details/${item.id}" class="view-details-link">View details &rarr;</a>
                                    </div>
                                </div>
                            `;
                        }).join('');
                    } else {
                        if (emptyMsg) emptyMsg.style.display = 'block';
                    }
                } catch (err) {
                    console.error('Error fetching wishlist products:', err);
                    if (emptyMsg) emptyMsg.style.display = 'block';
                }
            }

            updateWishlistBadge();
        });

        /* --- CAROUSEL SLIDE ARROWS LOGIC --- */
        document.addEventListener('click', (e) => {
            const arrow = e.target.closest('.carousel-arrow');
            if (!arrow) return;

            e.stopPropagation();

            const card = arrow.closest('.watch-card');
            if (!card) return;

            const imgEl = card.querySelector('.card-main-img');
            const bars = card.querySelectorAll('.progress-bar-segment');
            const images = JSON.parse(card.getAttribute('data-images') || '[]');

            if (!images.length) return;

            let currentIndex = parseInt(card.getAttribute('data-current-index') || '0');

            if (arrow.classList.contains('next')) {
                currentIndex = (currentIndex + 1) % images.length;
            } else if (arrow.classList.contains('prev')) {
                currentIndex = (currentIndex - 1 + images.length) % images.length;
            }

            card.setAttribute('data-current-index', currentIndex);

            // Smooth opacity transition
            imgEl.style.opacity = '0';
            setTimeout(() => {
                imgEl.src = images[currentIndex];
                imgEl.style.opacity = '1';
            }, 150);

            // Update Progress Bar Indicators
            bars.forEach((bar, idx) => {
                if (idx === currentIndex) {
                    bar.classList.add('active');
                } else {
                    bar.classList.remove('active');
                }
            });
        });

        /* --- WISHLIST REMOVAL HANDLER --- */
        document.addEventListener('click', (e) => {
            const heartBtn = e.target.closest('.wishlist-heart');
            if (!heartBtn) return;

            e.stopPropagation();

            const card = heartBtn.closest('.watch-card');
            if (!card) return;

            const watchId = String(card.getAttribute('data-id'));
            let wishlist = JSON.parse(localStorage.getItem('zeith_wishlist')) || [];

            wishlist = wishlist.filter(id => String(id) !== String(watchId));
            localStorage.setItem('zeith_wishlist', JSON.stringify(wishlist));

            updateWishlistBadge();

            card.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
            card.style.opacity = '0';
            card.style.transform = 'scale(0.9)';

            setTimeout(() => {
                card.remove();

                const remainingCards = document.querySelectorAll('.watch-card');
                if (remainingCards.length === 0) {
                    const emptyMsg = document.getElementById('empty-wishlist-msg');
                    if (emptyMsg) {
                        emptyMsg.style.display = 'block';
                    }
                }
            }, 300);
        });

        function updateWishlistBadge() {
            const badge = document.getElementById('wishlist-count');
            if (badge) {
                const wishlist = JSON.parse(localStorage.getItem('zeith_wishlist')) || [];
                badge.textContent = wishlist.length;
                badge.style.display = wishlist.length > 0 ? 'inline-block' : 'none';
            }
        }

        /* --- WISHLIST REMOVAL HANDLER --- */
        document.addEventListener('click', (e) => {
            const heartBtn = e.target.closest('.wishlist-heart');
            if (!heartBtn) return;

            e.stopPropagation();

            const card = heartBtn.closest('.watch-card');
            if (!card) return;

            const watchId = String(card.getAttribute('data-id'));

            // 1. DECLARE AND FETCH WISHLIST
            let wishlist = JSON.parse(localStorage.getItem('zeith_wishlist')) || [];

            // 2. FILTER OUT THE WATCH ID
            wishlist = wishlist.filter(id => String(id) !== String(watchId));

            // 3. SAVE BACK TO LOCALSTORAGE
            localStorage.setItem('zeith_wishlist', JSON.stringify(wishlist));

            // 4. DISPATCH EVENT FOR REAL-TIME SYNC
            window.dispatchEvent(new Event('storage'));

            // 5. UPDATE BADGE
            updateWishlistBadge();

            // 6. ANIMATE AND REMOVE CARD FROM UI
            card.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
            card.style.opacity = '0';
            card.style.transform = 'scale(0.9)';

            setTimeout(() => {
                card.remove();

                const remainingCards = document.querySelectorAll('.watch-card');
                if (remainingCards.length === 0) {
                    const emptyMsg = document.getElementById('empty-wishlist-msg');
                    if (emptyMsg) {
                        emptyMsg.style.display = 'block';
                    }
                }
            }, 300);
        });
    </script>
</body>

</html>