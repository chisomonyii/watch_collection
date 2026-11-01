

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
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI",
                Roboto, Helvetica, Arial, sans-serif;
        }

        /* 1. Ensure Body Fills Screen and Stacks Elements Vertically */
        html,
        body {
            width: 100%;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        body {
            background: #f8f8f6;
            color: #111;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* PAGE CONTAINER */
        .wishlist-container {
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
            padding: 35px 30px 80px;
            flex: 1;
            /* Pushes footer to the absolute bottom even when wishlist is empty */
        }

        .wishlist-title {
            margin-top: 39px;
            text-align: center;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 35px;
        }

        /* GRID */
        .wishlist-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 24px;
        }

        /* EMPTY STATE */
        .empty-wishlist {
            grid-column: 1 / -1;
            text-align: center;
            color: #888;
            padding: 80px 0;
            display: none;
        }

        .empty-wishlist.active {
            display: block;
        }

        /* CARD */
        .watch-card {
            background: #fdfbf8;
            border-radius: 0;
            padding: 0 0 16px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            position: relative;
            box-shadow: none;
            transition: transform .3s ease;
            min-width: 0;
        }

        .watch-card:hover {
            transform: translateY(-3px);
        }

        /* TOP BADGES */
        .card-top-bar {
            position: absolute;
            top: 16px;
            left: 16px;
            right: 16px;
            z-index: 10;
            display: flex;
            justify-content: space-between;
            align-items: center;
            pointer-events: none;
        }

        .status-badge {
            background: #dce8d7;
            color: #24813c;
            font-size: 12px;
            font-weight: 700;
            padding: 9px 15px;
            border-radius: 25px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .wishlist-heart {
            width: 46px;
            height: 46px;
            background: #fffdfb;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            pointer-events: auto;
            box-shadow: 0 5px 18px rgba(0, 0, 0, .10);
            color: #f68b1e;
            transition: transform .25s ease, background .25s ease;
        }

        .wishlist-heart:hover {
            transform: scale(1.08);
        }

        .wishlist-heart svg {
            width: 23px;
            height: 23px;
            fill: #f68b1e;
        }

        /* IMAGE AREA */
        .watch-image-container {
            position: relative;
            width: 100%;
            height: 380px;
            flex-shrink: 0;
            margin-bottom: 0;
            overflow: hidden;
            border-radius: 0 0 16px 16px;
            background: #fbf9f5;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .watch-image-container .card-main-img {
            display: block;
            width: 100%;
            height: 100%;
            max-width: none;
            max-height: none;
            object-fit: contain;
            padding: 80px 24px 75px;
            position: relative;
            z-index: 0;
            transition: opacity .25s ease, transform .3s ease;
        }

        .watch-card:hover .card-main-img {
            transform: scale(1.025);
        }

        /* SOFT BOTTOM GRADIENT */
        .price-overlay-bar {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 2;
            padding: 48px 20px 13px;
            background: linear-gradient(to bottom,
                    rgba(0, 0, 0, 0) 0%,
                    rgba(0, 0, 0, .035) 20%,
                    rgba(0, 0, 0, .22) 58%,
                    rgba(0, 0, 0, .82) 100%);
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .price-display {
            color: #fff;
            font-size: 26px;
            font-weight: 800;
            text-align: right;
            letter-spacing: .1px;
            text-shadow: 0 2px 5px rgba(0, 0, 0, .3);
        }

        /* IMAGE PROGRESS BARS */
        .progress-indicators {
            display: flex;
            gap: 8px;
            width: 100%;
        }

        .progress-bar-segment {
            height: 4px;
            flex: 1;
            background: rgba(40, 40, 40, .28);
            border-radius: 10px;
            transition: background .25s ease;
        }

        .progress-bar-segment.active {
            background: #171717;
        }

        /* IMAGE ARROWS */
        .carousel-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 48px;
            height: 48px;
            background: #fff;
            color: #012e1d;
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 4;
            font-size: 24px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, .10);
            transition: background .25s ease, color .25s ease;
        }

        .carousel-arrow.prev {
            left: 18px;
        }

        .carousel-arrow.next {
            right: 18px;
        }

        .carousel-arrow:hover {
            background: #012e1d;
            color: #fff;
        }

        /* PRODUCT DETAILS */
        .watch-details-content {
            padding: 0 18px;
            margin: 0;
            min-height: 190px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .watch-title-text {
            font-size: 24px;
            line-height: 1.4;
            font-weight: 600;
            color: #080808;
            letter-spacing: 0;
            margin-top: 32px;
            margin-bottom: 30px;
        }

        .watch-desc-text {
            max-width: 100%;
            font-size: 16px;
            line-height: 1.5;
            font-weight: 300;
            color: #666666;
            /* Improved contrast for light card backgrounds */
            display: -webkit-box;
            -webkit-line-clamp: 2;
            line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* ACTIONS */
        .card-footer-actions {
            width: 100%;
            margin-top: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 14px;
            gap: 8px;
        }

        .btn-add-cart-orange {
            background: #f68b1e;
            color: #080808;
            border: none;
            cursor: pointer;
            transition: background .25s ease, transform .25s ease;
            padding: 10px 22px;
            font-size: 15px;
            font-weight: 700;
            border-radius: 24px;
        }

        .btn-add-cart-orange:hover {
            background: #e77c0b;
            transform: translateY(-2px);
        }

        .view-details-link {
            display: inline-block;
            font-size: 0.8rem;
            color: #e67e22;
            text-decoration: none;
            font-weight: 500;
            margin-bottom: 10px;
            transition: color 0.2s ease;
        }

        .view-details-link:hover {
            text-decoration: underline;
        }

        /* TABLET (4 Columns -> 3 Columns) */
        @media (max-width: 1200px) {
            .wishlist-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        /* SMALLER TABLETS (3 Columns -> 2 Columns) */
        @media (max-width: 900px) {
            .wishlist-container {
                padding: 28px 18px 60px;
            }

            .wishlist-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 20px;
            }

            .watch-image-container {
                height: 340px;
            }

            .watch-details-content {
                min-height: 180px;
            }

            .watch-title-text {
                font-size: 22px;
            }

            .watch-desc-text {
                font-size: 15px;
            }
        }

        /* MOBILE (2 Columns -> 1 Column) */
        @media (max-width: 600px) {
            .wishlist-container {
                padding: 20px 9px 45px;
            }

            .wishlist-title {
                font-size: 27px;
                margin-bottom: 25px;
            }

            .wishlist-grid {
                grid-template-columns: minmax(0, 1fr);
                gap: 20px;
            }

            .watch-card {
                border-radius: 0;
                padding-bottom: 16px;
            }

            .watch-image-container {
                height: 450px;
                border-radius: 0 0 16px 16px;
            }

            .watch-image-container .card-main-img {
                padding: 85px 25px 75px;
            }

            .card-top-bar {
                top: 16px;
                left: 21px;
                right: 21px;
            }

            .status-badge {
                font-size: 12px;
                padding: 9px 15px;
            }

            .wishlist-heart {
                width: 48px;
                height: 48px;
            }

            .carousel-arrow {
                width: 48px;
                height: 48px;
            }

            .carousel-arrow.prev {
                left: 18px;
            }

            .carousel-arrow.next {
                right: 18px;
            }

            .price-overlay-bar {
                padding: 48px 24px 13px;
                gap: 12px;
            }

            .price-display {
                font-size: 27px;
            }

            .watch-details-content {
                min-height: 0;
                padding: 0 20px;
            }

            .watch-title-text {
                font-size: 24px;
                margin-top: 35px;
                margin-bottom: 28px;
            }

            .watch-desc-text {
                font-size: 16px;
                line-height: 1.5;
                margin-bottom: 25px;
            }

            .card-footer-actions {
                padding: 0 16px;
                margin-top: 0;
            }

            .btn-add-cart-orange {
                padding: 11px 25px;
            }

            .view-details-link {
                font-size: 16px;
            }
        }

        /* SMALL PHONES */
        @media (max-width: 380px) {
            .watch-image-container {
                height: 380px;
            }

            .watch-image-container .card-main-img {
                padding: 80px 20px 70px;
            }

            .price-display {
                font-size: 24px;
            }

            .watch-title-text {
                font-size: 22px;
            }

            .watch-desc-text {
                font-size: 14px;
            }

            .view-details-link {
                font-size: 14px;
            }

            .carousel-arrow {
                width: 42px;
                height: 42px;
            }
        }

        /* Full-Bleed Footer Fix */
        footer.zeith-footer {
            position: relative !important;
            width: 100% !important;
            margin-top: auto !important;
            box-sizing: border-box !important;
            clear: both !important;
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
                    // Bulletproof Helper: Cleans pre-attached path strings before checking server
                    $resolveImagePath = function ($imgName) {
    $imgVal = trim($imgName ?? '');

    if (empty($imgVal)) {
        return '/Zeith/assets/image/placeholder.jpg';
    }

    if (strpos($imgVal, 'http://') === 0 || strpos($imgVal, 'https://') === 0) {
        return $imgVal;
    }

    $filename = basename($imgVal);

    // 1. Check direct path inside public/uploads/ using the clean filename
    $uploadPath = $_SERVER['DOCUMENT_ROOT'] . '/Zeith/public/uploads/' . $filename;
    if (file_exists($uploadPath)) {
        return '/Zeith/public/uploads/' . $filename;
    }

    // 2. Check if the raw string already points to uploads or contains uploads path
    if (strpos($imgVal, 'uploads/') !== false || strpos($imgVal, 'public/uploads/') !== false) {
        $fullUploadCheck = $_SERVER['DOCUMENT_ROOT'] . '/Zeith/' . ltrim($imgVal, '/');
        if (file_exists($fullUploadCheck)) {
            return '/Zeith/' . ltrim($imgVal, '/');
        }
    }

    // 3. Check if the file actually exists in assets/image/ before defaulting there
    $assetPath = $_SERVER['DOCUMENT_ROOT'] . '/Zeith/assets/image/' . $filename;
    if (file_exists($assetPath)) {
        return '/Zeith/assets/image/' . $filename;
    }

    // 4. Final safety fallback: if it's an uploaded watch, force public/uploads path anyway
    return '/Zeith/public/uploads/' . $filename;
};

                    // Resolve images dynamically
                    $img1 = $resolveImagePath($item['image_url_1'] ?? $item['image_url'] ?? 'Nautilus_5711-removebg-preview.png');
                    $img2 = $resolveImagePath($item['image_url_2'] ?? $item['image_url_1']);
                    $img3 = $resolveImagePath($item['image_url_3'] ?? $item['image_url_1']);
                    $img4 = $resolveImagePath($item['image_url_4'] ?? $item['image_url_1']);

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
                            <a href="/Zeith/watch/details/<?= $watchId; ?>" class="view-details-link">View details &rarr;</a>
                        </div>

                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </section>

        <div id="empty-wishlist-msg" class="empty-wishlist">
            Your wishlist is currently empty.
        </div>

    </main>

    <?php include __DIR__ . '/../components/footer.php'; ?>

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
                    const response = await fetch('/Zeith/api/wishlist-items', {
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

                        // Client-side image resolver supporting public/uploads/ and assets/image/
                        const resolveJsImage = (imgName) => {
                            const clean = (imgName || '').trim();
                            if (!clean) return '/Zeith/assets/image/Nautilus_5711-removebg-preview.png';
                            if (clean.startsWith('http://') || clean.startsWith('https://') || clean.startsWith('/')) {
                                return clean;
                            }

                            // If the database string already references uploads
                            if (clean.includes('public/uploads/') || clean.includes('uploads/')) {
                                const filename = clean.split('/').pop();
                                return `/Zeith/public/uploads/${filename}`;
                            }

                            // Check if it's likely a device upload (custom names or hashes) or fallback to assets
                            // You can also check if filename has typical user upload patterns or fallback to uploads if assets fail
                            // For safety with your setup, if it's not a known default asset, check uploads or default to uploads if stored via admin form:
                            const filename = clean.split('/').pop();

                            // Let's check if it exists or treat as upload if it doesn't match default asset names
                            return `/Zeith/public/uploads/${filename}`;
                        };

                        grid.innerHTML = result.data.map(item => {
                        const rawImg1 = item.image_url_1 || item.image || item.image_url || 'Nautilus_5711-removebg-preview.png';
                        const rawImg2 = item.image_url_2 || rawImg1;
                        const rawImg3 = item.image_url_3 || rawImg1;
                        const rawImg4 = item.image_url_4 || rawImg1;

                       const formatPath = (p) => {
    const clean = (p || '').trim();

    if (!clean) return '/Zeith/assets/image/Nautilus_5711-removebg-preview.png';

    if (clean.startsWith('http://') || clean.startsWith('https://') || clean.startsWith('/')) {
        return encodeURI(clean);
    }

    const fname = clean.split('/').pop();
    const defaults = ['Nautilus_5711-removebg-preview.png', 'banner1.jpg', 'placeholder.jpg'];

    if (defaults.includes(fname)) {
        return encodeURI(`/Zeith/assets/image/${fname}`);
    }

    return encodeURI(`/Zeith/public/uploads/${fname}`);
};

                        const img1 = formatPath(rawImg1);
                        const img2 = formatPath(rawImg2);
                        const img3 = formatPath(rawImg3);
                        const img4 = formatPath(rawImg4);
                        const watchPrice = `₦${Number(item.price || 0).toLocaleString()}`;

                            return `
                        <div class="watch-card" data-id="${item.id}" data-images='["${img1}", "${img2}", "${img3}", "${img4}"]'>
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
                                <a href="/Zeith/watch/details/${item.id}" class="view-details-link">View details &rarr;</a>
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

        // Carousel & Wishlist interaction listeners remain identical...

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