<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Wishlist</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f8f8f6;
            color: #003b2f;
        }

        /* =========================
           MAIN CONTAINER
        ========================= */

        .wishlist-container {
            width: 100%;
            max-width: 1450px;
            margin: 0 auto;
            padding: 35px 55px 50px;
        }

        /* =========================
           PAGE TITLE
        ========================= */

        .wishlist-title {
            text-align: center;
            font-size: 32px;
            font-weight: 700;
            color: #f68b1e;
            margin-bottom: 35px;
        }

        /* =========================
           PRODUCTS GRID
        ========================= */

        .wishlist-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 35px;
        }

        .empty-wishlist {
            grid-column: 1 / -1;
            text-align: center;
            font-size: 18px;
            color: #666;
            padding: 50px 0;
        }

        /* =========================
           PRODUCT CARD
        ========================= */

        .watch-card {
            position: relative;
            text-align: center;
            padding: 10px 15px 60px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .watch-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        /* =========================
           HEART
        ========================= */

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

            color: #e74c3c;
            font-size: 21px;

            cursor: pointer;

            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.12);

            z-index: 5;

            transition: all 0.3s ease;
        }

        .wishlist-heart:hover {
            background: #e74c3c;
            color: white;
            transform: scale(1.08);
        }

        /* =========================
           WATCH IMAGE
        ========================= */

        .watch-image {
            width: 100%;
            height: 200px;

            display: flex;
            align-items: center;
            justify-content: center;

            margin-bottom: 10px;
        }

        .watch-image img {
            width: 100%;
            height: 100%;

            object-fit: contain;

            display: block;
        }

        /* =========================
           PRODUCT NAME
        ========================= */

        .watch-name {
            font-size: 22px;
            font-weight: 700;
            color: #003b2f;
            margin-top: 5px;
            margin-bottom: 6px;
        }

        /* =========================
           DESCRIPTION
        ========================= */

        .watch-description {
            font-size: 15px;
            color: #888888;
            margin-bottom: 10px;
            font-weight: 400;
        }

        /* =========================
           PRICE
        ========================= */

        .watch-price {
            font-size: 22px;
            font-weight: 700;
            color: #003b2f;
            margin-bottom: 10px;
        }

        /* =========================
           RATING
        ========================= */

        .rating {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 2px;

            margin-bottom: 12px;
        }

        .stars {
            color: #f68b1e;
            font-size: 17px;
            letter-spacing: 1px;
        }

        .rating-number {
            color: #888;
            font-size: 14px;
            margin-left: 4px;
        }

        /* =========================
           BADGE
        ========================= */

        .badge {
            display: inline-block;

            background: #003b2f;
            color: white;

            padding: 6px 14px;

            border-radius: 30px;

            font-size: 11px;
            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: 0.3px;
        }

        /* =========================
           ADD BUTTON
        ========================= */

        .add-button {
            position: absolute;
            bottom: 15px;
            left: 15px;

            background: #f68b1e;
            color: black;

            border: none;
            border-radius: 20px;

            padding: 8px 18px;

            font-size: 13px;
            font-weight: 700;

            cursor: pointer;

            transition: all 0.3s ease;
        }

        .add-button:hover {
            background: black;
            color: white;
            transform: translateY(-2px);
        }

        /* Responsive Breakpoints */
        @media (max-width: 1024px) {
            .wishlist-container {
                padding: 30px 30px 45px;
            }

            .wishlist-title {
                font-size: 30px;
                margin-bottom: 30px;
            }

            .wishlist-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 35px 25px;
            }

            .watch-image {
                height: 240px;
            }

            .watch-name {
                font-size: 20px;
            }

            .watch-price {
                font-size: 20px;
            }
        }

        @media (max-width: 600px) {
            .wishlist-container {
                padding: 25px 18px 40px;
            }

            .wishlist-title {
                font-size: 27px;
                margin-bottom: 25px;
            }

            .wishlist-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .watch-card {
                padding: 10px 10px 55px;
            }

            .watch-image {
                height: 240px;
            }
        }
    </style>
</head>

<body>

    <main class="wishlist-container">

        <!-- PAGE TITLE -->
        <h1 class="wishlist-title">My Wishlist</h1>

        <!-- WATCHES GRID -->
        <section class="wishlist-grid" id="wishlist-grid">

            <?php if (!empty($wishlistItems)): ?>
                <?php foreach ($wishlistItems as $item): ?>
                    <div class="watch-card" data-id="<?= htmlspecialchars($item['id']); ?>">

                        <!-- HEART (CLICK TO REMOVE) -->
                        <div class="wishlist-heart active" title="Remove from wishlist" onclick="removeFromWishlist('<?= htmlspecialchars($item['id']); ?>')">
                            ♥
                        </div>

                        <div class="watch-image">
                            <img src="<?php assets("Images/" . ($item['image'] ?? $item['image_url'])); ?>" alt="<?= htmlspecialchars($item['name']); ?>">
                        </div>

                        <h2 class="watch-name"><?= htmlspecialchars($item['brand'] ?? $item['collection_name'] ?? ''); ?></h2>

                        <p class="watch-description">
                            <?= htmlspecialchars($item['name']); ?>
                        </p>

                        <div class="watch-price">
                            ₦<?= number_format($item['price']); ?>
                        </div>

                        <div class="rating">
                            <span class="stars">★★★★★</span>
                            <span class="rating-number"><?= htmlspecialchars($item['rating'] ?? '5.0'); ?></span>
                        </div>

                        <?php if (!empty($item['tag'])): ?>
                            <span class="badge">
                                <?= htmlspecialchars($item['tag']); ?>
                            </span>
                        <?php endif; ?>

                        <button class="add-button">
                            Add
                        </button>

                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- FALLBACK PLACEHOLDER IF PHP ARRAY IS EMPTY -->
                <div class="empty-wishlist" id="empty-wishlist-msg">
                    <p>Your wishlist is currently empty.</p>
                </div>
            <?php endif; ?>

        </section>

    </main>

    <!-- EXTERNAL JS FOR HYDRATION & REMOVAL LOGIC -->
    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const grid = document.getElementById('wishlist-grid');
            const emptyMsg = document.getElementById('empty-wishlist-msg');

            // If PHP already rendered items, don't fetch from API
            const hasPhpItems = grid && grid.querySelectorAll('.watch-card').length > 0;
            if (hasPhpItems) return;

            const savedIds = JSON.parse(localStorage.getItem('zeith_wishlist')) || [];

            if (!grid || savedIds.length === 0) {
                if (emptyMsg) emptyMsg.style.display = 'block';
                return;
            }

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

                    grid.innerHTML = result.data.map(item => `
                <div class="watch-card" data-id="${item.id}">
                    <div class="wishlist-heart active" title="Remove from wishlist" onclick="removeFromWishlist('${item.id}')" style="color: #e74c3c;">
                        ♥
                    </div>
                    <div class="watch-image">
                        <img src="/Watch_Collection/assets/Images/${item.image || item.image_url}" alt="${item.name}">
                    </div>
                    <h2 class="watch-name">${item.brand || item.collection_name || ''}</h2>
                    <p class="watch-description">${item.name || ''}</p>
                    <div class="watch-price">₦${Number(item.price || 0).toLocaleString()}</div>
                    <div class="rating">
                        <span class="stars">★★★★★</span>
                        <span class="rating-number">${item.rating || '5.0'}</span>
                    </div>
                    ${item.tag ? `<span class="badge">${item.tag}</span>` : ''}
                    <button class="add-button">Add</button>
                </div>
            `).join('');
                } else {
                    if (emptyMsg) emptyMsg.style.display = 'block';
                }
            } catch (err) {
                console.error('Error fetching wishlist products:', err);
                if (emptyMsg) emptyMsg.style.display = 'block';
            }
        });

        function removeFromWishlist(id) {
            let wishlist = JSON.parse(localStorage.getItem('zeith_wishlist')) || [];
            wishlist = wishlist.filter(item => String(item) !== String(id));
            localStorage.setItem('zeith_wishlist', JSON.stringify(wishlist));

            const card = document.querySelector(`.watch-card[data-id="${id}"]`);
            if (card) card.remove();

            const remainingCards = document.querySelectorAll('.watch-card');
            if (remainingCards.length === 0) {
                const emptyMsg = document.getElementById('empty-wishlist-msg');
                if (emptyMsg) emptyMsg.style.display = 'block';
            }
        }
    </script>
</body>

</html>