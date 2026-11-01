<?php
// PHP Backend Processing when user clicks "Proceed to Payment"
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $host = 'localhost';
    $db   = 'Watch_Collection'; // Update if your database name is different
    $user = 'root';
    $pass = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Collect form data
        $fullName = trim($_POST['fullname'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $address = trim($_POST['address'] ?? '');
        $notes = trim($_POST['notes'] ?? '');
        $subtotal = floatval($_POST['subtotal'] ?? 0);
        $cartItemsJson = $_POST['cart_items_json'] ?? '[]';
        $cartItems = json_decode($cartItemsJson, true);

        if (!empty($fullName) && !empty($email) && !empty($phone) && !empty($address) && !empty($cartItems)) {

            // Generate unique order reference number
            $orderNumber = 'ZEITH-' . strtoupper(uniqid());

            // 1. Insert into orders table
            $stmt = $pdo->prepare("INSERT INTO orders (order_number, full_name, email, phone, address, delivery_instructions, subtotal, total_amount) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$orderNumber, $fullName, $email, $phone, $address, $notes, $subtotal, $subtotal]);
            $orderId = $pdo->lastInsertId();

            // 2. Insert each item into order_items table
            $itemStmt = $pdo->prepare("INSERT INTO order_items (order_id, watch_id, watch_name, brand, price, quantity, strap_variant) VALUES (?, ?, ?, ?, ?, ?, ?)");

            foreach ($cartItems as $item) {
                $itemStmt->execute([
                    $orderId,
                    $item['id'] ?? '',
                    $item['name'] ?? 'Luxury Watch',
                    $item['brand'] ?? 'ZEITH',
                    $item['price'] ?? 0,
                    $item['quantity'] ?? 1,
                    $item['strap'] ?? 'Steel'
                ]);
            }

            // Save order session for Frame 3 (payment.php)
            session_start();
            $_SESSION['active_order_id'] = $orderId;
            $_SESSION['order_number'] = $orderNumber;
            $_SESSION['order_subtotal'] = $subtotal;

            // Redirect to Frame 3: payment.php
            header('Location: payment.php');
            exit;
        }
    } catch (PDOException $e) {
        $error = "Database Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZEITH - Your Shopping Cart</title>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../header.css">
    <link rel="stylesheet" href="../footer.css">

    <style>
        :root {
            --primary-color: #f68b1e;
            --primary-hover: #e07a16;
            --text-dark: #111111;
            --text-muted: #666666;
            --border-color: #e2e8f0;
            --bg-light: #f8fafc;
            --card-bg: #ffffff;
            --shadow-sm: 0 4px 20px rgba(0, 0, 0, 0.05);
            --radius-lg: 16px;
            --radius-md: 10px;
            --danger-color: #e53e3e;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            line-height: 1.5;
            min-height: 100vh;
            padding: 30px 20px;
        }

        .cart-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Top Navigation Header */
        .cart-top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background-color: #e2e8f0;
            color: var(--text-dark);
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 0.88rem;
            font-weight: 600;
            transition: background-color 0.2s ease;
        }

        .btn-back:hover {
            background-color: #cbd5e1;
        }

        .page-title {
            text-align: center;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 30px;
        }

        /* Layout Grid */
        .cart-grid {
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 24px;
            align-items: start;
        }

        /* LEFT SECTION: Main Details Card */
        .details-card {
            background-color: var(--card-bg);
            border-radius: var(--radius-lg);
            padding: 32px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            margin-bottom: 24px;
        }

        .details-card h2 {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .sub-text {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-bottom: 24px;
        }

        /* Form Inputs */
        .form-row-split {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 16px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            font-size: 0.92rem;
            color: var(--text-dark);
            outline: none;
            background-color: #ffffff;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(246, 139, 30, 0.15);
        }

        .form-textarea {
            resize: vertical;
            min-height: 90px;
        }

        /* Button Group inside Details */
        .cart-actions {
            display: flex;
            gap: 16px;
            margin-top: 24px;
        }

        .btn-submit-order {
            flex: 1;
            background-color: var(--primary-color);
            color: #ffffff;
            border: none;
            padding: 14px 20px;
            border-radius: 50px;
            font-size: 0.95rem;
            font-weight: 700;
            cursor: pointer;
            transition: background-color 0.2s ease;
            box-shadow: 0 4px 12px rgba(246, 139, 30, 0.2);
        }

        .btn-submit-order:hover {
            background-color: var(--primary-hover);
        }

        .btn-continue {
            background-color: #ffffff;
            color: var(--text-dark);
            border: 1px solid var(--text-dark);
            padding: 14px 24px;
            border-radius: 50px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            transition: background-color 0.2s ease;
            white-space: nowrap;
        }

        .btn-continue:hover {
            background-color: var(--bg-light);
        }

        /* Cart Items Display (Thumbnails) */
        .cart-items-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
        }

        .cart-item-card {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 16px;
            width: 200px;
            box-shadow: var(--shadow-sm);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .product-img {
            width: 100px;
            height: 120px;
            object-fit: contain;
            margin-bottom: 12px;
        }

        .product-title {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--text-dark);
            text-transform: uppercase;
            line-height: 1.2;
        }

        .product-subtitle {
            font-size: 0.8rem;
            color: var(--text-muted);
            margin: 4px 0;
            font-weight: 500;
        }

        .product-price {
            font-size: 0.85rem;
            color: var(--text-dark);
            margin: 4px 0 12px 0;
            font-weight: 700;
        }

        .qty-controls {
            display: flex;
            align-items: center;
            background-color: #f1f5f9;
            border-radius: 6px;
            padding: 4px 10px;
        }

        .qty-number {
            font-size: 0.85rem;
            font-weight: 700;
        }

        /* RIGHT SECTION: Order Summary Card */
        .order-summary-card {
            background-color: var(--card-bg);
            border-radius: var(--radius-lg);
            padding: 28px 24px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
        }

        .summary-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--text-dark);
            padding-bottom: 12px;
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 20px;
        }

        .summary-line {
            display: flex;
            justify-content: space-between;
            font-size: 0.92rem;
            color: var(--text-muted);
            margin-bottom: 14px;
        }

        .summary-divider {
            border-bottom: 1px solid var(--border-color);
            margin: 16px 0;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--text-dark);
        }

        /* ==========================================================
           RESPONSIVE MEDIA QUERIES FOR IPAD AND MOBILE DEVICES
           ========================================================== */
        @media (max-width: 1024px) {
            body {
                padding: 16px 12px;
            }

            .cart-grid {
                grid-template-columns: 1fr;
            }

            .order-summary-card {
                order: -1;
                margin-bottom: 24px;
            }

            .details-card {
                padding: 24px 16px;
            }

            .form-row-split {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .cart-actions {
                flex-direction: column;
            }

            .btn-continue {
                text-align: center;
                width: 100%;
            }
        }

        @media (max-width: 600px) {
            .cart-items-wrapper {
                display: grid;
                grid-template-columns: 1fr;
            }

            .cart-item-card {
                width: 100%;
                flex-direction: row;
                text-align: left;
                gap: 16px;
                justify-content: space-between;
            }

            .product-img {
                width: 70px;
                height: 80px;
                margin-bottom: 0;
            }
        }

        /* ZEITH BRAND PRELOADER OVERLAY */
        .zeith-preloader {
            position: fixed;
            inset: 0;
            background-color: #0b0d10;
            /* Obsidian dark base */
            z-index: 99999;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 1;
            /* Visible by default on page load */
            visibility: visible;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .zeith-preloader.fade-out {
            opacity: 0;
            visibility: hidden;
        }

        .zeith-preloader.active {
            opacity: 1;
            visibility: visible;
        }

        .preloader-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .preloader-content .brand-logo {
            font-size: 2.2rem;
            font-weight: 800;
            letter-spacing: 6px;
            color: #ffffff;
            text-transform: uppercase;
        }

        .preloader-progress-track {
            width: 140px;
            height: 3px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
            overflow: hidden;
            position: relative;
        }

        .preloader-progress-bar {
            width: 0%;
            height: 100%;
            background: linear-gradient(90deg, #f68b1e, #ffaa42);
            border-radius: 4px;
            transition: width 0.3s ease;
        }
    </style>
</head>

<body>

    <div id="zeith-preloader" class="zeith-preloader active">
        <div class="preloader-content">
            <h1 class="brand-logo">ZEITH</h1>
            <div class="preloader-progress-track">
                <div class="preloader-progress-bar"></div>
            </div>
        </div>
    </div>

    <div class="cart-container">

        <!-- Top Bar Navigation -->
        <div class="cart-top-bar">
            <a href="/Zeith/watch" class="btn-back">
                <i class="fa-solid fa-arrow-left"></i> Back to Watches
            </a>
        </div>

        <h1 class="page-title">Your Shopping Cart</h1>

        <?php if (isset($error)): ?>
            <div style="background: #ffe6e6; color: #d9534f; padding: 12px; border-radius: 8px; margin-bottom: 20px; text-align: center;">
                <?= htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <div class="cart-grid">

            <!-- LEFT COLUMN: Forms & Items -->
            <div class="left-column">
                <div class="details-card">
                    <h2>Enter your details</h2>
                    <p class="sub-text">All fields are required.</p>

                    <form id="checkoutForm" action="/Zeith/checkout/process" method="POST">
                        <div class="form-row-split">
                            <div class="form-group" style="margin-bottom: 0;">
                                <input type="text" name="fullname" class="form-input" placeholder="Full name" required>
                            </div>
                            <div class="form-group" style="margin-bottom: 0;">
                                <input type="email" name="email" class="form-input" placeholder="Email address" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="tel" name="phone" class="form-input" placeholder="Mobile number (11 digits)" required>
                        </div>

                        <div class="form-group">
                            <textarea name="address" class="form-textarea" placeholder="Address" required></textarea>
                        </div>

                        <div class="form-group">
                            <textarea name="notes" class="form-textarea" placeholder="Message / delivery instructions (optional)"></textarea>
                        </div>

                        <div class="cart-actions">
                            <button type="submit" class="btn-submit-order">Proceed to Payment</button>
                            <a href="admin-list.php" class="btn-continue">Continue Shopping</a>
                        </div>
                    </form>
                </div>

                <!-- Product Thumbnails Container (Populated dynamically via JavaScript) -->
                <div class="cart-items-wrapper">
                    <!-- JS renders items here -->
                </div>
            </div>

            <!-- RIGHT COLUMN: Order Summary -->
            <div class="right-column">
                <div class="order-summary-card">
                    <h3 class="summary-title">Order Summary</h3>

                    <div class="summary-line">
                        <span>Cart (0 items)</span>
                        <strong>₦0.00</strong>
                    </div>

                    <div class="summary-divider"></div>

                    <div class="summary-total">
                        <span>Total</span>
                        <span>₦0.00</span>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- JavaScript to Hydrate Cart Items from localStorage & Pass to Database -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const cart = JSON.parse(localStorage.getItem('zeith_cart')) || [];

            if (cart.length === 0) {
                alert('Your shopping bag is empty.');
                window.location.href = 'admin-list.php';
                return;
            }

            const itemsWrapper = document.querySelector('.cart-items-wrapper');
            const summaryLine = document.querySelector('.summary-line');
            const summaryTotal = document.querySelector('.summary-total');

            // Calculate totals
            const totalItems = cart.reduce((sum, item) => sum + Number(item.quantity || 1), 0);
            const subtotal = cart.reduce((sum, item) => sum + (Number(item.price || 0) * Number(item.quantity || 1)), 0);

            const formatNaira = amount => '₦' + Number(amount || 0).toLocaleString('en-NG', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });

            // 1. Render all cart items dynamically into .cart-items-wrapper
            itemsWrapper.innerHTML = cart.map(item => `
                <div class="cart-item-card" data-id="${item.id}">
                    <img src="${item.image || 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=300'}" alt="${item.name}" class="product-img">
                    <div class="cart-item-info">
                        <div class="product-title">${item.brand || 'ZEITH'}</div>
                        <div class="product-subtitle">${item.name}</div>
                        <div class="product-price">${formatNaira(item.price)}</div>
                    </div>
                    <div class="qty-controls">
                        <span class="qty-number">Qty: ${item.quantity}</span>
                    </div>
                </div>
            `).join('');

            // 2. Update Order Summary Section
            summaryLine.innerHTML = `
                <span>Cart (${totalItems} item${totalItems > 1 ? 's' : ''})</span>
                <strong>${formatNaira(subtotal)}</strong>
            `;
            summaryTotal.innerHTML = `
                <span>Total</span>
                <span>${formatNaira(subtotal)}</span>
            `;

            // 3. Inject hidden inputs into the form so PHP receives the cart data and subtotal on submit
            const form = document.getElementById('checkoutForm');

            const hiddenCart = document.createElement('input');
            hiddenCart.type = 'hidden';
            hiddenCart.name = 'cart_items_json';
            hiddenCart.value = JSON.stringify(cart);
            form.appendChild(hiddenCart);

            const hiddenSubtotal = document.createElement('input');
            hiddenSubtotal.type = 'hidden';
            hiddenSubtotal.name = 'subtotal';
            hiddenSubtotal.value = subtotal;
            form.appendChild(hiddenSubtotal);
        });

        document.addEventListener('DOMContentLoaded', () => {
            const preloader = document.getElementById('zeith-preloader');
            const progressBar = document.querySelector('.preloader-progress-bar');

            function hidePreloader() {
                if (!preloader) return;
                if (progressBar) progressBar.style.width = '100%';
                setTimeout(() => {
                    preloader.classList.remove('active');
                    preloader.classList.add('fade-out');
                }, 200);
            }

            // Initial load
            hidePreloader();

            // 1. FIX FOR BACK/FORWARD BUTTON (bfcache)
            window.addEventListener('pageshow', (event) => {
                // If restored from back/forward cache or reloaded
                if (event.persisted) {
                    hidePreloader();
                }
            });

            // 2. Intercept link clicks to show loader on navigation
            document.addEventListener('click', function(e) {
                const link = e.target.closest('a');
                if (!link) return;

                const href = link.getAttribute('href');
                const target = link.getAttribute('target');

                if (
                    !href ||
                    href.startsWith('#') ||
                    href.startsWith('javascript:') ||
                    target === '_blank' ||
                    link.hasAttribute('download')
                ) {
                    return;
                }

                if (e.ctrlKey || e.metaKey || e.shiftKey || e.button === 1) {
                    return;
                }

                if (preloader) {
                    preloader.classList.remove('fade-out');
                    preloader.classList.add('active');
                    if (progressBar) {
                        progressBar.style.width = '60%';
                    }
                }
            });
        });
    </script>

</body>

</html>