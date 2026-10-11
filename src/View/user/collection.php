<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/69c405441a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?php assets("css/login.css"); ?>">
    <link rel="stylesheet" href="<?php assets("css/style.css"); ?>">
    <title><?= htmlspecialchars($collectionName ?? 'Collection'); ?> - Zeith</title>

    <style>
        .property-details-body {
            background-color: #fafafa;
            min-height: 100vh;
            padding: 3rem 2rem;
            position: relative;
            overflow-x: hidden;
            background-color: #05070a;
        }

        .property-details-wrapper {
            max-width: 1280px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        /* Header Section */
        .property-details-header {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 3.5rem;
        }

        .property-title {
            border: 1px solid #e2e8f0;
            padding: 0.55rem 2.0rem;
            border-radius: 999px;
            background-color: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
        }

        .property-title h1 {
            font-family: Georgia, 'Times New Roman', serif;
            font-size: 1.2rem;
            font-weight: 600;
            color: #0f172a;
            letter-spacing: 0.02em;
        }

        .property-details-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
        }

        @media (max-width: 1100px) {
            .property-details-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .property-details-grid {
                grid-template-columns: 1fr;
            }

            .property-details-header {
                flex-direction: column;
                gap: 1rem;
            }

            .property-title h1 {
                font-size: 1.5rem;
            }
        }

        /* Card Component */
        .property-card {
            position: relative;
            /* <-- Add this line */
            background: #ffffff;
            border: 1px solid #f1f5f9;
            border-radius: 1.25rem;
            padding: 1rem;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.03);
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .property-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 30px -10px rgba(0, 0, 0, 0.08);
        }

        .property-card-image {
            width: 100%;
            height: 200px;
            background-color: #000000;
            border-radius: 0.85rem;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .property-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .property-card:hover .property-card-image img {
            transform: scale(1.05);
        }

        .property-card-details {
            padding: 1.25rem 0.25rem 0.25rem;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .property-card-title {
            font-size: 1.05rem;
            font-weight: 700;
            color: #fc8b1e;
            margin-bottom: 0.35rem;
        }

        .property-card-desc {
            font-size: 0.825rem;
            color: #64748b;
            line-height: 1.4;
            margin-bottom: 1.5rem;
            font-weight: 300;
        }

        .property-stars {
            color: #fc8b1e;
            font-size: 0.875rem;
        }

        .property-card-footer {
            margin-top: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .property-card-price {
            font-size: 1.05rem;
            font-weight: 700;
            color: #0f172a;
        }

        .property-add-btn {
            padding: 0.45rem 1.25rem;
            background-color: #cbd5e1;
            color: #334155;
            border: none;
            border-radius: 0.5rem;
            font-weight: 600;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .property-add-btn:hover {
            background-color: #fc8b1e;
            color: #ffffff;
        }

        .bg-animated-watch {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: 1;
            pointer-events: none;
            overflow: hidden;
            /* Subtle visibility for dark or light backgrounds */
            perspective: 1000px;
            /* Establishes depth perception */
            background: radial-gradient(circle at center,
                    rgba(15, 23, 42, 0.8) 0%,
                    rgba(5, 7, 10, 0.95) 70%,
                    #05070a 100%);
        }

        .bg-animated-watch img {
            width: 140%;
            height: 140%;
            object-fit: cover;
            position: absolute;
            top: -20%;
            left: -20%;
            transform-style: preserve-3d;
            animation: float3D 22s ease-in-out infinite alternate;
            opacity: 5.12;
        }



        @keyframes float3D {
            0% {
                transform: translate3d(0px, 0px, 0px) rotateX(0deg) rotateY(0deg) rotateZ(0deg) scale(1);
            }

            25% {
                transform: translate3d(40px, -30px, 60px) rotateX(14deg) rotateY(-10deg) rotateZ(5deg) scale(1.05);
            }

            50% {
                transform: translate3d(-30px, 40px, -40px) rotateX(-12deg) rotateY(15deg) rotateZ(-8deg) scale(1.1);
            }

            75% {
                transform: translate3d(20px, -20px, 80px) rotateX(10deg) rotateY(-14deg) rotateZ(6deg) scale(1.05);
            }

            100% {
                transform: translate3d(-40px, -40px, 10px) rotateX(-8deg) rotateY(8deg) rotateZ(-4deg) scale(1.12);
            }
        }

        .wishlist-heart-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #ffffff;
            border: none;
            color: #f68b1e;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.12);
            z-index: 5;
            transition: all 0.3s ease;
        }

        .wishlist-heart-btn:hover,
        .wishlist-heart-btn.active {
            background: #f68b1e;
            color: #ffffff;
            transform: scale(1.08);
        }

        .no-watches-msg {
            grid-column: 1 / -1;
            text-align: center;
            padding: 60px 20px;
            font-size: 1.5rem;
            font-weight: 900;
            color: #f68b1e;
        }

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

<body class="property-details-body">

    <div class="bg-animated-watch">
        <img src="<?php assets("image/pat-taylor-12V36G17IbQ-unsplash (1).jpg"); ?>" alt="Watch Background">
    </div>

    <div class="property-details-wrapper">

        <div class="property-details-header">
            <div class="property-title">
                <h1><?= htmlspecialchars($collectionName ?? 'Watch'); ?> Collections</h1>
            </div>
        </div>

        <div class="property-details-grid" id="collectionGrid">

            <?php if (!empty($watches)): ?>
                <?php foreach ($watches as $watch): ?>
                    <div class="property-card" data-id="<?= htmlspecialchars($watch['id']); ?>">

                        <!-- WISHLIST BUTTON -->
                        <button class="wishlist-heart-btn" data-id="<?= htmlspecialchars($watch['id']); ?>" title="Add to Wishlist">
                            <i class="fa-solid fa-heart"></i>
                        </button>

                        <div class="property-card-image">
                            <img src="<?php assets($watch['image_url'] ?? $watch['image'] ?? 'image/pngwing.com (10).png'); ?>" alt="<?= htmlspecialchars($watch['name']); ?>">
                        </div>

                        <div class="property-card-details">
                            <h3 class="property-card-title"><?= htmlspecialchars($watch['name']); ?></h3>
                            <p class="property-card-desc"><?= htmlspecialchars($watch['description'] ?? 'Exclusive luxury timepiece.'); ?></p>

                            <div class="property-card-rating">
                                <span class="property-stars">★★★★★</span>
                                <span class="property-rating-score">(<?= htmlspecialchars($watch['rating'] ?? '5.0'); ?>)</span>
                            </div>

                            <div class="property-card-footer">
                                <span class="property-card-price">₦<?= number_format($watch['price'] ?? 0, 2); ?></span>
                                <button class="property-add-btn" type="button">Add</button>
                            </div>
                        </div>

                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="no-watches-msg">
                    <p>No watches found in the <?= htmlspecialchars($collectionName ?? 'selected'); ?> collection.</p>
                </div>
            <?php endif; ?>

        </div>
    </div>

    <a href="cart.php" class="floating-cart" title="Shopping Cart">
        <i class="fa-solid fa-cart-shopping"></i>
        <span class="cart-count" id="cart-count">0</span>
    </a>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // WISHLIST TOGGLE LOGIC
            function syncWishlist() {
                const wishlist = JSON.parse(localStorage.getItem('zeith_wishlist')) || [];
                document.querySelectorAll('.wishlist-heart-btn').forEach(btn => {
                    const id = parseInt(btn.getAttribute('data-id'));
                    if (wishlist.includes(id)) {
                        btn.classList.add('active');
                    } else {
                        btn.classList.remove('active');
                    }
                });
            }

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

            const grid = document.getElementById('collectionGrid');
            if (grid) {
                grid.addEventListener('click', (e) => {
                    const wishBtn = e.target.closest('.wishlist-heart-btn');
                    if (!wishBtn) return;

                    const watchId = parseInt(wishBtn.getAttribute('data-id'));
                    let wishlist = JSON.parse(localStorage.getItem('zeith_wishlist')) || [];

                    if (wishlist.includes(watchId)) {
                        wishlist = wishlist.filter(id => id !== watchId);
                    } else {
                        wishlist.push(watchId);
                    }

                    localStorage.setItem('zeith_wishlist', JSON.stringify(wishlist));
                    syncWishlist();
                });
            }

            syncWishlist();
        });
    </script>
</body>

</html>