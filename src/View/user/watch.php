<?php
$watches = $watches ?? \App\Models\Watch::getAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/69c405441a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?php assets("css/login.css"); ?>">
    <title>Zeith - Luxury Watch Collections</title>

    <style>
        /* ADD BUTTON */
        .add-button {
            position: absolute;
            bottom: 15px;
            left: 15px;
            background: #f68b1e;
            color: #fff;
            border: none;
            padding: 8px 22px;
            border-radius: 20px;
            font-weight: 600;
            font-size: .9rem;
            cursor: pointer;
            transition: .3s ease;
            z-index: 5;
        }

        .add-button:hover {
            background: #000;
            color: #fff;
            transform: translateY(-1px);
        }

        /* WISHLIST BUTTON */
        .wishlist-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            border: none;
            color: #f68b1e;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0 3px 10px rgba(0, 0, 0, .12);
            z-index: 5;
            transition: .3s ease;
        }

        .wishlist-btn i {
            color: #f68b1e;
            font-size: 1rem;
        }

        .wishlist-btn:hover,
        .wishlist-btn.active {
            background: #f68b1e;
            transform: scale(1.08);
        }

        .wishlist-btn:hover i,
        .wishlist-btn.active i {
            color: #fff;
        }

        /* WATCH CARDS */
        .property-card {
            position: relative;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, .05);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding-bottom: 50px;
            transition: transform .3s ease, opacity .3s ease;
        }

        .property-card.hidden {
            display: none !important;
        }

        .property-card:hover {
            transform: translateY(-5px);
        }

        .property-card-media {
            width: 100%;
            height: 220px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f9f9f9;
            padding: 20px;
            box-sizing: border-box;
        }

        .property-card-media img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .property-card-info {
            padding: 15px 20px;
            text-align: center;
        }

        .property-card-brand {
            display: block;
            font-size: .85rem;
            color: #888;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .property-card-name {
            font-size: 1.1rem;
            color: #003b2f;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .property-card-price {
            font-size: 1.15rem;
            color: #003b2f;
            font-weight: 800;
        }

        .no-results {
            grid-column: 1 / -1;
            text-align: center;
            padding: 50px 20px;
            font-size: 1.1rem;
            color: #666;
            display: none;
        }

        /* FIXED FLOATING CART */

        /* Fixed floating cart icon */
        .floating-cart {
             position: fixed;
            right: 30px;
            bottom: 30px;

            width: 65px;
            height: 65px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: #f68b1e;
            color: #ffffff;

            border-radius: 50%;
            text-decoration: none;
            font-size: 25px;

            box-shadow: 0 5px 18px rgba(0, 0, 0, 0.20);
            z-index: 9999;

            transition: 0.3s ease;
        }

        .floating-cart:hover {
            background: #003b2f;
            color: #ffffff;
            transform: scale(1.08);
        }

        /* Number at the top center of the cart */
        .cart-count {
            position: absolute;
            top: -12px;
            left: 50%;
            transform: translateX(-50%);
            min-width: 26px;
            height: 26px;
            padding: 0 5px;
            border-radius: 50%;
            background: #ffffff;
            color: #f68b1e;
            font-size: 14px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #f68b1e;
        }

        @media (max-width: 768px) {
            .floating-cart {
                width: 75px;
                height: 75px;
                right: 20px;
                bottom: 20px;
                font-size: 28px;
            }
        }


        @media (max-width: 480px) {
            .floating-cart {
                width: 55px;
                height: 55px;
                right: 18px;
                bottom: 18px;
                font-size: 21px;
            }
        }
    </style>
</head>

<body class="property-body">
    <div class="property-container">

        <aside class="property-sidebar">
            <div class="property-sidebar-widget">
                <h3 class="property-widget-title">THE <span class="zeith-span">ZEITH</span> ASSETS</h3>
                <ul class="property-category-list">
                    <li><a href="/Watch_Collection/user/watch/collection/hublot">Hublot</a></li>
                    <li><a href="/Watch_Collection/user/watch/collection/g-shock">G-Shock</a></li>
                    <li><a href="/Watch_Collection/user/watch/collection/rolex">Rolex</a></li>
                    <li><a href="/Watch_Collection/user/watch/collection/omega">Omega</a></li>
                    <li><a href="/Watch_Collection/user/watch/collection/daniel-klein">Daniel Klein</a></li>
                    <li><a href="/Watch_Collection/user/watch/collection/asorock">Asorock</a></li>
                    <li><a href="/Watch_Collection/user/watch/collection/bulova-watches">Bulova Watches</a></li>
                    <li><a href="/Watch_Collection/user/watch/collection/patek-philippe">Patek Philippe & Cartier</a></li>
                </ul>
            </div>

            <div class="property-sidebar-widget">
                <h3 class="property-widget-title">FILTER BY PRICE</h3>
                <div class="property-price-range">
                    <input type="range" id="priceRangeSlider" min="3000" max="5000000" value="5000000" step="5000" class="property-range-slider">
                    <div class="property-price-controls">
                        <span class="property-price-label" id="priceRangeLabel">PRICE: ₦3,000 — ₦5,000,000</span>
                        <button class="property-filter-btn" id="btnApplyFilter">FILTER</button>
                    </div>
                </div>
            </div>
        </aside>

        <main class="property-main-content">
            <div class="property-hero-banner">
                <div class="hero-3d-bg">
                    <img src="<?php assets("image/pat-taylor-12V36G17IbQ-unsplash (1).jpg"); ?>" alt="Luxury watch">
                </div>
                <div class="property-hero-text">
                    <span class="property-hero-subtitle">OUR CLASSIC</span>
                    <h2 class="property-hero-title">ZEITH Collections</h2>
                    <p class="property-hero-desc">Explore Luxury Wrist Watches</p>
                </div>
            </div>

            <div class="property-toolbar">
                <div class="custom-dropdown-container">
                    <details class="custom-dropdown">
                        <summary class="dropdown-summary">
                            <span id="selectedCategoryText">All Collections</span>
                            <span class="chevron">▼</span>
                        </summary>
                        <div class="dropdown-menu">
                            <span class="dropdown-header">THE ZEITH ASSETS</span>
                            <a href="#" class="dropdown-item brand-filter-link" data-brand="Hublot">Hublot</a>
                            <a href="#" class="dropdown-item brand-filter-link" data-brand="G-Shock">G-Shock</a>
                            <a href="#" class="dropdown-item brand-filter-link" data-brand="Rolex">Rolex</a>
                            <a href="#" class="dropdown-item brand-filter-link" data-brand="Omega">Omega</a>
                            <a href="#" class="dropdown-item brand-filter-link" data-brand="Daniel Klein">Daniel Klein</a>
                            <a href="#" class="dropdown-item brand-filter-link" data-brand="Asorock">Asorock</a>
                            <a href="#" class="dropdown-item brand-filter-link" data-brand="Bulova Watches">Bulova Watches</a>
                            <a href="#" class="dropdown-item brand-filter-link" data-brand="Patek Philippe">Patek Philippe & Cartier</a>
                        </div>
                    </details>
                </div>
            </div>

            <div class="property-grid" id="watchGrid">
                <?php if (!empty($watches)): ?>
                    <?php foreach ($watches as $watch): ?>
                        <div class="property-card"
                            data-id="<?= htmlspecialchars((string)$watch['id']); ?>"
                            data-brand="<?= htmlspecialchars($watch['brand'] ?? $watch['name']); ?>"
                            data-price="<?= htmlspecialchars((string)$watch['price']); ?>">

                            <button type="button" class="wishlist-btn"
                                data-id="<?= htmlspecialchars((string)$watch['id']); ?>"
                                title="Add to Wishlist" aria-label="Add to wishlist">
                                <i class="fa-solid fa-heart"></i>
                            </button>

                            <div class="property-card-media">
                                <img src="<?php assets($watch['image_url'] ?? 'image/pngwing.com (1).png'); ?>"
                                    alt="<?= htmlspecialchars($watch['name']); ?>">
                            </div>

                            <div class="property-card-info">
                                <span class="property-card-brand"><?= htmlspecialchars($watch['brand'] ?? 'ZEITH'); ?></span>
                                <h4 class="property-card-name"><?= htmlspecialchars($watch['name']); ?></h4>
                                <p class="property-card-price">₦<?= number_format((float)$watch['price'], 2); ?></p>
                            </div>

                            <button type="button" class="add-button">Add</button>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="no-results" style="display:block;">No watch collections available at the moment.</p>
                <?php endif; ?>

                <div class="no-results" id="noResultsMsg">
                    No watches found in this price range or category.
                </div>
            </div>
        </main>
    </div>

    <!-- FIXED CART ICON -->

    <a href="cart.php" class="floating-cart" title="Shopping Cart">
        <i class="fa-solid fa-cart-shopping"></i>
        <span class="cart-count" id="cart-count">0</span>
    </a>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const priceSlider = document.getElementById('priceRangeSlider');
            const priceLabel = document.getElementById('priceRangeLabel');
            const btnFilter = document.getElementById('btnApplyFilter');
            const cards = Array.from(document.querySelectorAll('.property-card'));
            const noResultsMsg = document.getElementById('noResultsMsg');
            const watchGrid = document.getElementById('watchGrid');
            const brandLinks = document.querySelectorAll('.brand-filter-link');
            const selectedCategoryText = document.getElementById('selectedCategoryText');

            let activeBrand = 'all';

            // PRICE FILTER
            function filterWatches() {
                const maxPrice = parseFloat(priceSlider?.value) || 0;
                let visibleCount = 0;

                cards.forEach(card => {
                    const price = parseFloat(card.dataset.price) || 0;
                    const brand = (card.dataset.brand || '').toLowerCase();

                    const matchesPrice = price <= maxPrice;
                    const matchesBrand = activeBrand === 'all' ||
                        brand.includes(activeBrand.toLowerCase());

                    card.classList.toggle('hidden', !(matchesPrice && matchesBrand));

                    if (matchesPrice && matchesBrand) visibleCount++;
                });

                if (noResultsMsg) {
                    noResultsMsg.style.display = visibleCount === 0 ? 'block' : 'none';
                }
            }

            if (priceSlider && priceLabel) {
                priceSlider.addEventListener('input', () => {
                    const value = Number(priceSlider.value);
                    priceLabel.textContent = `PRICE: ₦3,000 — ₦${value.toLocaleString()}`;
                    filterWatches();
                });
            }

            btnFilter?.addEventListener('click', filterWatches);

            // BRAND FILTERING
            brandLinks.forEach(link => {
                link.addEventListener('click', event => {
                    event.preventDefault();

                    activeBrand = link.dataset.brand || 'all';

                    if (selectedCategoryText) {
                        selectedCategoryText.textContent = link.textContent.trim();
                    }

                    filterWatches();
                });
            });

            // WISHLIST
            function syncWishlist() {
                const wishlist = (JSON.parse(localStorage.getItem('zeith_wishlist') || '[]')).map(String);

                document.querySelectorAll('.wishlist-btn').forEach(button => {
                    button.classList.toggle('active', wishlist.includes(String(button.dataset.id)));
                });
            }

            // CART BADGE

            function updateCartBadge() {
                const badge = document.getElementById('cart-count');
                if (!badge) return;

                const cart = JSON.parse(
                    localStorage.getItem('zeith_cart') || '[]'
                );

                badge.textContent = cart.length;
                badge.style.display = 'flex';
            }

            updateCartBadge();


            // WISHLIST AND ADD-TO-CART HANDLERS
            watchGrid?.addEventListener('click', event => {
                const wishlistButton = event.target.closest('.wishlist-btn');
                const addButton = event.target.closest('.add-button');

                if (wishlistButton) {
                    const id = String(wishlistButton.dataset.id);
                    let wishlist = JSON.parse(localStorage.getItem('zeith_wishlist') || '[]').map(String);

                    wishlist = wishlist.includes(id) ?
                        wishlist.filter(savedId => savedId !== id) : [...wishlist, id];

                    localStorage.setItem('zeith_wishlist', JSON.stringify(wishlist));
                    syncWishlist();
                    return;
                }

                if (addButton) {
                    const card = addButton.closest('.property-card');
                    if (!card) return;

                    const watch = {
                        id: String(card.dataset.id),
                        name: card.querySelector('.property-card-name')?.textContent.trim() || 'Watch',
                        brand: card.querySelector('.property-card-brand')?.textContent.trim() || 'ZEITH',
                        price: Number(card.dataset.price) || 0,
                        image: card.querySelector('.property-card-media img')?.getAttribute('src') || '',
                        quantity: 1
                    };

                    let cart = JSON.parse(localStorage.getItem('zeith_cart') || '[]');

                    const existingIndex = cart.findIndex(item =>
                        String(item && typeof item === 'object' ? item.id : item) === watch.id
                    );

                    if (existingIndex !== -1 && typeof cart[existingIndex] === 'object') {
                        cart[existingIndex].quantity = (Number(cart[existingIndex].quantity) || 1) + 1;
                    } else {
                        // Convert an older ID-only entry to a full product entry.
                        if (existingIndex !== -1) cart.splice(existingIndex, 1);
                        cart.push(watch);
                    }

                    localStorage.setItem('zeith_cart', JSON.stringify(cart));
                    updateCartBadge();

                    addButton.textContent = 'Added!';
                    window.setTimeout(() => {
                        addButton.textContent = 'Add';
                    }, 800);
                }
            });

            // INITIALIZE
            syncWishlist();
            filterWatches();
            updateCartBadge();

            // Update the badge if another tab modifies the cart.
            window.addEventListener('storage', event => {
                if (event.key === 'zeith_cart') updateCartBadge();
            });
        });
    </script>
</body>

</html>
```