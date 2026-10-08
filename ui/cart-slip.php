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

        .btn-clear-cart {
            background: none;
            border: none;
            color: var(--danger-color);
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: opacity 0.2s;
        }

        .btn-clear-cart:hover {
            opacity: 0.8;
            text-decoration: underline;
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
            transition: background-color 0.2s ease, transform 0.1s ease;
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
            width: 180px;
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

        .product-price {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin: 6px 0 12px 0;
            font-weight: 600;
        }

        /* Quantity Controls */
        .qty-controls {
            display: flex;
            align-items: center;
            background-color: #f1f5f9;
            border-radius: 6px;
            padding: 2px 6px;
            gap: 8px;
        }

        .qty-btn {
            background: none;
            border: none;
            font-size: 0.85rem;
            color: var(--text-dark);
            cursor: pointer;
            padding: 4px 6px;
        }

        .qty-number {
            font-size: 0.85rem;
            font-weight: 700;
        }

        .btn-remove-item {
            color: var(--danger-color);
            margin-left: 4px;
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


        /* RESPONSIVE MEDIA QUERIES */

        @media (max-width: 1100px) {
            .cart-container {
                max-width: 950px;
            }

            .cart-grid {
                grid-template-columns: 1fr 300px;
                gap: 20px;
            }

            .details-card {
                padding: 26px;
            }
        }

        @media (max-width: 900px) {
            body {
                padding: 24px 16px;
            }

            .cart-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .order-summary-card {
                order: -1;
            }

            .details-card {
                padding: 24px;
            }

            .cart-items-wrapper {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }

            .cart-item-card {
                width: 100%;
            }
        }

        @media (max-width: 650px) {
            body {
                padding: 16px 12px;
            }

            .cart-top-bar {
                margin-bottom: 18px;
            }

            .btn-back {
                padding: 8px 12px;
                font-size: 0.8rem;
            }

            .btn-clear-cart {
                font-size: 0.8rem;
            }

            .page-title {
                font-size: 1.5rem;
                margin-bottom: 22px;
            }

            .details-card {
                padding: 20px 16px;
                border-radius: 12px;
            }

            .details-card h2 {
                font-size: 1.1rem;
            }

            .sub-text {
                margin-bottom: 20px;
            }

            .form-row-split {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .form-group {
                margin-bottom: 14px;
            }

            .form-input,
            .form-select,
            .form-textarea {
                font-size: 0.88rem;
                padding: 11px 13px;
            }

            .cart-actions {
                flex-direction: column;
                gap: 10px;
            }

            .btn-submit-order,
            .btn-continue {
                width: 100%;
                padding: 13px 18px;
            }

            .cart-items-wrapper {
                grid-template-columns: 1fr;
            }

            .cart-item-card {
                width: 100%;
                min-width: 0;
                display: grid;
                grid-template-columns: 65px 1fr auto;
                align-items: center;
                gap: 10px;
                padding: 12px;
            }

            .product-img {
                width: 65px;
                height: 65px;
                margin: 0;
            }

            .cart-item-info {
                min-width: 0;
                padding: 0;
            }

            .product-title {
                font-size: 0.78rem;
                word-break: break-word;
            }

            .product-price {
                font-size: 0.78rem;
                margin: 5px 0 0;
            }

            .qty-controls {
                gap: 3px;
                padding: 2px 4px;
            }

            .qty-btn {
                padding: 4px;
                font-size: 0.75rem;
            }

            .qty-number {
                font-size: 0.78rem;
            }

            .order-summary-card {
                padding: 22px 18px;
                border-radius: 12px;
            }

            .summary-title {
                font-size: 1.05rem;
            }

            .summary-line {
                font-size: 0.85rem;
            }

            .summary-total {
                font-size: 1rem;
            }
        }

        @media (max-width: 400px) {
            body {
                padding: 12px 8px;
            }

            .cart-top-bar {
                align-items: flex-start;
            }

            .btn-back {
                font-size: 0.72rem;
                padding: 7px 10px;
            }

            .btn-clear-cart {
                font-size: 0.72rem;
            }

            .page-title {
                font-size: 1.3rem;
            }

            .details-card {
                padding: 18px 13px;
            }

            .cart-item-card {
                grid-template-columns: 55px 1fr;
                gap: 8px;
            }

            .product-img {
                width: 55px;
                height: 55px;
            }

            .qty-controls {
                grid-column: 2;
                justify-self: start;
                margin-top: 5px;
            }

            .order-summary-card {
                padding: 18px 14px;
            }

            .summary-line {
                gap: 10px;
            }
        }
    </style>
</head>

<body>


    <div class="cart-container">

        <!-- Top Bar Navigation -->
        <div class="cart-top-bar">
            <a href="admin-list.php" class="btn-back">
                <i class="fa-solid fa-arrow-left"></i> Back to Watches
            </a>
            <button type="button" class="btn-clear-cart" id="clearCartBtn">
                <i class="fa-regular fa-trash-can"></i> Clear Cart
            </button>
        </div>

        <h1 class="page-title">Your Shopping Cart</h1>

        <div class="cart-grid">

            <!-- LEFT COLUMN: Forms & Items -->
            <div class="left-column">
                <div class="details-card">
                    <h2>Enter your details</h2>
                    <p class="sub-text">All fields are required.</p>

                    <form id="checkoutForm" action="checkout.php" method="POST">
                        <div class="form-row-split">
                            <input type="text" name="fullname" class="form-input" placeholder="Full name" required>
                            <input type="email" name="email" class="form-input" placeholder="Email address" required>
                        </div>

                        <div class="form-group">
                            <input type="tel" name="phone" class="form-input" placeholder="Mobile number (11 digits)" required>
                        </div>

                        <div class="form-group">
                            <textarea name="address" class="form-textarea" placeholder="Address" required></textarea>
                        </div>

                        <div class="form-group">
                            <select name="payment_method" class="form-select" required>
                                <option value="" disabled selected>Select Payment Method</option>
                                <option value="card">Credit / Debit Card</option>
                                <option value="transfer">Bank Transfer</option>
                                <option value="apple_pay">Apple Pay</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <textarea name="notes" class="form-textarea" placeholder="Message / delivery instructions (optional)"></textarea>
                        </div>

                        <div class="cart-actions">
                            <button type="submit" class="btn-submit-order">Submit Order</button>
                            <a href="admin-list.php" class="btn-continue">Continue Shopping</a>
                        </div>
                    </form>
                </div>

                <!-- Product Thumbnails Container -->
                <div class="cart-items-wrapper">
                    <div class="cart-item-card">
                        <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=300" alt="H. MOSER & CIE" class="product-img">
                        <div class="cart-item-info">
                            <div class="product-title">H. MOSER & CIE.</div>
                            <div class="product-price">₦700,000.00</div>
                        </div>
                        <div class="qty-controls">
                            <button type="button" class="qty-btn">-</button>
                            <span class="qty-number">1</span>
                            <button type="button" class="qty-btn">+</button>
                            <button type="button" class="qty-btn btn-remove-item"><i class="fa-solid fa-trash"></i></button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN: Order Summary -->
            <div class="right-column">
                <div class="order-summary-card">
                    <h3 class="summary-title">Order Summary</h3>

                    <div class="summary-line">
                        <span>Subtotal (1 items)</span>
                        <strong>₦700,000.00</strong>
                    </div>


                    <div class="summary-divider"></div>

                    <div class="summary-total">
                        <span>Total</span>
                        <span>₦700,000.00</span>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <?php require_once __DIR__ . '../../src/View/components/footer.php'; ?>

</body>

</html>