<?php

/** @var array $shippingMethods */
// ... rest of your code
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$orderNumber = $_SESSION['order_number'] ?? 'ZEITH-UNKNOWN';
$subtotal = floatval($_SESSION['order_subtotal'] ?? 0);
$activeOrderId = $_SESSION['active_order_id'] ?? null;

if (!$activeOrderId) {
    header('Location: /Watch_Collection/');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZEITH - Payment</title>
    <link rel="stylesheet" href="/Watch_Collection/assets/css/header.css">
    <link rel="stylesheet" href="/Watch_Collection/assets/css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

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
            --selected-blue: #0066cc;
            --selected-bg: #f0f7ff;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: var(--card-bg);
            color: var(--text-dark);
            line-height: 1.5;
            min-height: 100vh;
        }

        .checkout-wrapper {
            display: flex;
            flex-direction: row;
            min-height: 100vh;
            width: 100%;
        }

        .summary-section {
            flex: 1;
            background-color: var(--bg-light);
            padding: 50px 60px;
            border-right: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: var(--text-muted);
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 30px;
            transition: color 0.2s ease;
        }

        .back-link:hover {
            color: var(--text-dark);
        }

        .store-badge {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 16px;
        }

        .zeith {
            color: black;
            font-weight: 700;
            letter-spacing: -2px;
            font-size: 1.2rem;
        }

        .store-name {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-muted);
        }

        .total-price-display {
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 30px;
        }

        .itemized-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
            border-top: 1px solid var(--border-color);
            padding-top: 24px;
        }

        .line-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.95rem;
        }

        .item-name {
            font-weight: 600;
            color: var(--text-dark);
        }

        .item-price {
            font-weight: 600;
            color: var(--text-dark);
        }

        .shipping-section {
            margin-top: 32px;
        }

        .shipping-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 12px;
        }

        .shipping-container {
            border: 1px solid var(--border-color);
            border-radius: 12px;
            overflow: hidden;
            background-color: #ffffff;
            box-shadow: var(--shadow-sm);
        }

        .shipping-option {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            padding: 16px;
            border-bottom: 1px solid var(--border-color);
            cursor: pointer;
            transition: background-color 0.2s ease, border-color 0.2s ease;
            position: relative;
        }

        .shipping-option:last-child {
            border-bottom: none;
        }

        .shipping-option.selected {
            background-color: var(--selected-bg);
            border: 2px solid var(--selected-blue);
            margin: -1px;
            z-index: 1;
            border-radius: 10px;
        }

        .shipping-option input[type="radio"] {
            display: none;
        }

        .shipping-details {
            flex: 1;
            padding-right: 16px;
        }

        .shipping-name {
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--text-dark);
            line-height: 1.4;
        }

        .shipping-desc {
            font-size: 0.8rem;
            color: var(--text-muted);
            margin-top: 4px;
        }

        .shipping-price {
            font-weight: 700;
            font-size: 0.95rem;
            color: var(--text-dark);
            white-space: nowrap;
        }

        .payment-section {
            flex: 1.1;
            background-color: var(--card-bg);
            padding: 50px 60px;
            display: flex;
            justify-content: center;
        }

        .form-inner {
            width: 100%;
            max-width: 480px;
        }

        .express-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 24px;
        }

        .btn-express {
            border: none;
            border-radius: var(--radius-md);
            padding: 12px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: opacity 0.2s ease;
        }

        .btn-express:hover {
            opacity: 0.9;
        }

        .btn-apple {
            background-color: #000000;
            color: #ffffff;
            font-size: 1.05rem;
        }

        .btn-link {
            background-color: #00d66c;
            color: #ffffff;
        }

        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            color: var(--text-muted);
            font-size: 0.8rem;
            font-weight: 600;
            margin: 24px 0;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid var(--border-color);
        }

        .divider span {
            padding: 0 12px;
            letter-spacing: 0.5px;
        }

        .section-label {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 8px;
            display: block;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control,
        .form-select {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            font-size: 0.95rem;
            color: var(--text-dark);
            outline: none;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            background-color: #fff;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(246, 139, 30, 0.15);
        }

        .card-input-box {
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        .card-header-tab {
            background-color: #fafafa;
            padding: 12px 16px;
            font-size: 0.85rem;
            font-weight: 600;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-fields-wrapper {
            padding: 16px;
            background-color: #ffffff;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .card-number-wrapper {
            position: relative;
        }

        .card-icons {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 0.9rem;
            color: var(--text-muted);
            display: flex;
            gap: 6px;
        }

        .split-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .transfer-header-row {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-bottom: 12px;
        }

        .transfer-user-email {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-muted);
        }

        .bank-transfer-box {
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            background-color: #f8fafc;
            padding: 24px;
            text-align: center;
            box-shadow: var(--shadow-sm);
            margin-bottom: 20px;
        }

        .bank-transfer-title {
            font-size: 0.95rem;
            color: var(--text-muted);
            margin-bottom: 12px;
        }

        .bank-name {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 4px;
        }

        .bank-account-num {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--primary-color);
            letter-spacing: 1px;
            margin-bottom: 12px;
        }

        .bank-transfer-note {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .btn-sent-money {
            width: 100%;
            background-color: #ffffff;
            color: var(--text-dark);
            border: 1px solid var(--border-color);
            padding: 14px 20px;
            border-radius: 25px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            transition: background-color 0.2s ease;
            margin-bottom: 20px;
        }

        .btn-sent-money:hover {
            background-color: #f1f5f9;
        }

        .save-info-card {
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 14px 16px;
            display: flex;
            gap: 12px;
            align-items: flex-start;
            margin-bottom: 20px;
            cursor: pointer;
        }

        .save-info-card input[type="checkbox"] {
            margin-top: 3px;
            accent-color: var(--primary-color);
            width: 18px;
            height: 18px;
        }

        .save-info-text {
            font-size: 0.85rem;
        }

        .save-info-title {
            font-weight: 600;
            color: var(--text-dark);
        }

        .save-info-sub {
            color: var(--text-muted);
            margin-top: 2px;
        }

        .btn-pay {
            width: 100%;
            background-color: var(--primary-color);
            color: #ffffff;
            border: none;
            padding: 14px 20px;
            border-radius: 25px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: background-color 0.2s ease, transform 0.1s ease;
            box-shadow: 0 4px 12px rgba(246, 139, 30, 0.25);
        }

        .btn-pay:hover {
            background-color: var(--primary-hover);
        }

        .checkout-footer {
            margin-top: 24px;
            text-align: center;
            font-size: 0.75rem;
            color: var(--text-muted);
            display: flex;
            justify-content: center;
            gap: 12px;
        }

        .checkout-footer a {
            color: var(--text-muted);
            text-decoration: none;
        }

        .checkout-footer a:hover {
            text-decoration: underline;
        }

        .terms-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.55);
            backdrop-filter: blur(4px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
            padding: 20px;
        }

        .terms-modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .terms-modal-card {
            position: relative;
            background-color: #ffffff;
            width: 100%;
            max-width: 520px;
            border-radius: var(--radius-lg, 16px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            padding: 32px 28px 28px;
            transform: scale(0.92);
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .terms-modal-overlay.active .terms-modal-card {
            transform: scale(1);
        }

        .terms-modal-close {
            position: absolute;
            top: 16px;
            right: 16px;
            background: transparent;
            border: none;
            font-size: 1.25rem;
            color: #888888;
            cursor: pointer;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        .terms-modal-close:hover {
            background-color: #f1f5f9;
            color: #111111;
        }

        .terms-modal-header h3 {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-dark, #111111);
            margin-bottom: 16px;
        }

        .terms-modal-body p {
            font-size: 0.92rem;
            color: var(--text-muted, #555555);
            line-height: 1.6;
        }

        /* Transfer Section Styling */
        #transferFieldsSection {
            background: #fdfdfd;
            border: 1px solid #eaeaea;
            border-radius: 12px;
            padding: 20px;
            margin-top: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
        }

        .bank-transfer-box {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            text-align: center;
            border: 1px dashed #d1d5db;
        }

        .bank-transfer-title {
            font-size: 13px;
            color: #6b7280;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .bank-name {
            font-size: 18px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 5px;
        }

        .bank-account-num {
            font-size: 22px;
            font-weight: 800;
            color: #f97316;
            /* ZEITH Orange accent */
            letter-spacing: 1px;
            margin-bottom: 8px;
        }

        .bank-transfer-note {
            font-size: 12px;
            color: #4b5563;
        }

        /* File Input Styling */
        #transferFieldsSection .form-label {
            font-weight: 600;
            font-size: 14px;
            color: #374151;
            margin-bottom: 6px;
            display: block;
        }

        #transferFieldsSection input[type="file"] {
            display: block;
            width: 100%;
            padding: 10px;
            font-size: 14px;
            color: #4b5563;
            background: #fff;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            cursor: pointer;
            transition: border-color 0.2s ease;
        }

        #transferFieldsSection input[type="file"]:focus {
            border-color: #f97316;
            outline: none;
            box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1);
        }

        /* Optional secondary button style if needed */
        .btn-sent-money {
            display: block;
            width: 100%;
            background-color: #111827;
            color: #fff;
            font-weight: 600;
            padding: 12px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            margin-top: 15px;
            transition: background 0.2s;
        }

        .btn-sent-money:hover {
            background-color: #1f2937;
        }
    </style>
</head>

<body>

    <div class="checkout-wrapper">

        <div class="summary-section">
            <a href="/Watch_Collection/checkout" class="back-link">
                <i class="fa-solid fa-arrow-left"></i> Back to Review
            </a>

            <div class="store-badge">
                <span class="store-name"><span class="zeith">ZEITH</span> Payment Gateway</span>
            </div>

            <!-- Dynamic Subtotal + Shipping Total Display -->
            <div class="total-price-display" id="totalPriceDisplay">
                ₦<?= number_format($subtotal + 4000, 2) ?>
            </div>

            <div class="itemized-list">
                <div class="line-item">
                    <span class="item-name">Order Ref: <?= htmlspecialchars($orderNumber) ?></span>
                    <span class="item-price">₦<?= number_format($subtotal, 2) ?></span>
                </div>
                <div class="line-item" style="color: var(--text-muted);">
                    <span>Shipping</span>
                    <span id="shippingSummaryPrice">₦4,000.00</span>
                </div>
            </div>

            <div class="shipping-section">
                <h3 class="shipping-title">Shipping method</h3>
                <div class="shipping-container" id="shippingOptionsContainer">

                    <?php
                    $isFirst = true;
                    foreach ($shippingMethods as $method):
                    ?>
                        <label class="shipping-option <?= $isFirst ? 'selected' : '' ?>">
                            <input type="radio" name="shipping_method" value="<?= htmlspecialchars($method['price']) ?>" <?= $isFirst ? 'checked' : '' ?>>
                            <div class="shipping-details">
                                <div class="shipping-name">
                                    <?= htmlspecialchars($method['method_name']) ?>
                                    <?php if (!empty($method['description'])): ?>
                                        <div class="shipping-desc"><?= htmlspecialchars($method['description']) ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="shipping-price">₦<?= number_format($method['price'], 2) ?></div>
                        </label>
                    <?php
                        $isFirst = false;
                    endforeach;
                    ?>

                </div>
            </div>

        </div>

        <div class="payment-section">
            <div class="form-inner">
                <form action="/Watch_Collection/payment/process" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="order_id" value="<?= htmlspecialchars($activeOrderId) ?>">
                    <input type="hidden" name="subtotal" value="<?= $subtotal ?>">
                    <input type="hidden" name="shipping_fee" id="hiddenShippingInput" value="4000">

                    <div class="express-buttons">
                        <button type="button" class="btn-express btn-apple">
                            <i class="fa-brands fa-apple"></i> Pay
                        </button>
                        <button type="button" class="btn-express btn-link">
                            <i class="fa-solid fa-bolt"></i> link
                        </button>
                    </div>

                    <div class="divider">
                        <span>OR</span>
                    </div>

                    <div class="form-group">
                        <select name="gateway" id="paymentMethodSelect" class="form-select" required>
                            <option value="card" selected>Credit / Debit Card</option>
                            <option value="transfer">Bank Transfer</option>
                        </select>
                    </div>

                    <!-- CONTAINER FOR TOGGLING PAYMENT METHODS -->
                    <div id="paymentFieldsContainer">

                        <!-- CREDIT CARD FORM -->
                        <div class="form-group" id="cardFieldsSection">
                            <label class="section-label">Payment details</label>

                            <div class="card-input-box">
                                <div class="card-header-tab">
                                    <i class="fa-regular fa-credit-card"></i> Card
                                </div>

                                <div class="card-fields-wrapper">
                                    <div>
                                        <label style="font-size: 0.75rem; color: var(--text-muted); font-weight: 600;">Card information</label>
                                        <div class="card-number-wrapper" style="margin-top: 4px;">
                                            <input type="text" name="card_number" class="form-control" placeholder="1234 1234 1234 1234" maxlength="19">
                                            <span class="card-icons">
                                                <i class="fa-brands fa-cc-visa"></i>
                                                <i class="fa-brands fa-cc-mastercard"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="split-row">
                                        <input type="text" name="card_exp" class="form-control" placeholder="MM / YY" maxlength="5">
                                        <input type="text" name="card_cvc" class="form-control" placeholder="CVC" maxlength="4">
                                    </div>

                                    <div>
                                        <label style="font-size: 0.75rem; color: var(--text-muted); font-weight: 600;">Cardholder name</label>
                                        <input type="text" name="card_name" class="form-control" placeholder="Full name on card" style="margin-top: 4px;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- BANK TRANSFER VIEW -->
                        <div class="form-group" id="transferFieldsSection" style="display: none;">
                            <div class="transfer-header-row">
                                <span class="transfer-user-email">Secure Zeith Pay Transfer</span>
                            </div>
                            <div class="bank-transfer-box">
                                <div class="bank-transfer-title">Transfer to ZEITH Checkout</div>
                                <div class="bank-name">Moniepoint</div>
                                <div class="bank-account-num">9161426400</div>
                                <div class="bank-transfer-note">Use this account for this transaction only. Account expires in 30 minutes.</div>
                            </div>

                            <div class="mb-3">
                                <label for="payment_receipt" class="form-label">Upload Transfer Receipt</label>
                                <input type="file" class="form-control" name="payment_receipt" id="payment_receipt" accept="image/*,.pdf" required>
                            </div>

                            <button type="submit" class="btn-sent-money">
                                I've sent the money
                            </button>
                        </div>

                    </div>

                    <button type="submit" class="btn-pay" id="btnPay">
                        Pay ₦<?= number_format($subtotal + 4000, 2) ?>
                    </button>

                    <div class="checkout-footer">
                        <span>Powered by <strong>ZEITH Pay</strong></span>
                        <span>|</span>
                        <a href="#" id="termsTrigger">Terms</a>
                        <span>|</span>
                        <a href="#" id="privacyTrigger">Privacy</a>
                    </div>

                    <!-- Modals -->
                    <div class="terms-modal-overlay" id="termsModal">
                        <div class="terms-modal-card">
                            <button type="button" class="terms-modal-close" id="closeTermsBtn" aria-label="Close modal">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                            <div class="terms-modal-header">
                                <h3>Terms of Service</h3>
                            </div>
                            <div class="terms-modal-body">
                                <p>Welcome to ZEITH. All transactions processed via ZEITH Pay are encrypted and authorized securely before order dispatch.</p>
                            </div>
                        </div>
                    </div>

                    <div class="terms-modal-overlay" id="privacyModal">
                        <div class="terms-modal-card">
                            <button type="button" class="terms-modal-close" id="closePrivacyBtn" aria-label="Close modal">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                            <div class="terms-modal-header">
                                <h3>Privacy Policy</h3>
                            </div>
                            <div class="terms-modal-body">
                                <p>At ZEITH, we value your privacy and protect your personal checkout information rigorously.</p>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>

    <script src="https://js.paystack.co/v2/inline.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productPrice = <?= floatval($subtotal ?? 0) ?>;
            const shippingOptions = document.querySelectorAll('.shipping-option');
            const totalPriceDisplay = document.getElementById('totalPriceDisplay');
            const shippingSummaryPrice = document.getElementById('shippingSummaryPrice');
            const paymentForm = document.querySelector('form');

            // 1. Create or reference hidden shipping input
            let hiddenShippingInput = document.getElementById('hiddenShippingInput');
            if (!hiddenShippingInput) {
                hiddenShippingInput = document.createElement('input');
                hiddenShippingInput.type = 'hidden';
                hiddenShippingInput.name = 'shipping_fee';
                hiddenShippingInput.id = 'hiddenShippingInput';
                hiddenShippingInput.value = '4000'; // Default first option
                paymentForm.appendChild(hiddenShippingInput);
            }

            function formatCurrency(amount) {
                return '₦' + amount.toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
            }

            // 2. Shipping option click handlers
            shippingOptions.forEach(option => {
                option.addEventListener('click', function() {
                    shippingOptions.forEach(opt => opt.classList.remove('selected'));
                    this.classList.add('selected');

                    const radio = this.querySelector('input[type="radio"]');
                    radio.checked = true;

                    const shippingCost = parseFloat(radio.value);
                    hiddenShippingInput.value = shippingCost;

                    const grandTotal = productPrice + shippingCost;
                    const formattedShipping = formatCurrency(shippingCost);
                    const formattedGrandTotal = formatCurrency(grandTotal);

                    shippingSummaryPrice.textContent = formattedShipping;
                    totalPriceDisplay.textContent = formattedGrandTotal;
                    btnPay.textContent = `Pay ${formattedGrandTotal}`;
                });
            });

            // 3. Payment Method Switch (Card vs Transfer)
            // 3. Payment Method Switch (Card vs Transfer)
            const paymentMethodSelect = document.getElementById('paymentMethodSelect');
            const cardFieldsSection = document.getElementById('cardFieldsSection');
            const transferFieldsSection = document.getElementById('transferFieldsSection');

            if (paymentMethodSelect) {
                paymentMethodSelect.addEventListener('change', function() {
                    if (this.value === 'transfer') {
                        cardFieldsSection.style.display = 'none';
                        transferFieldsSection.style.display = 'block';
                        if (btnPay) btnPay.style.display = 'none'; // Hide bottom Pay button
                    } else {
                        cardFieldsSection.style.display = 'block';
                        transferFieldsSection.style.display = 'none';
                        if (btnPay) btnPay.style.display = 'block'; // Show bottom Pay button
                    }
                });
            }

            // 4. Paystack Popup Trigger on Form Submit
            const paystackPublicKey = 'pk_test_46537c2e2608da34a412e77a7baec683a5097391';

            paymentForm.addEventListener('submit', function(e) {
                // If they chose bank transfer, let the form submit normally to handle the file upload
                if (paymentMethodSelect && paymentMethodSelect.value === 'transfer') {
                    return;
                }

                e.preventDefault();

                const userEmail = "<?= htmlspecialchars($_SESSION['customer_email'] ?? 'customer@zeith.com') ?>";
                const orderId = "<?= $_SESSION['active_order_id'] ?? '' ?>";
                const totalAmountInKobo = Math.round((productPrice + Number(hiddenShippingInput.value)) * 100);

                if (typeof PaystackPop === 'undefined') {
                    alert('Paystack SDK failed to load. Please check your internet connection.');
                    return;
                }

                const paystack = new PaystackPop();
                paystack.newTransaction({
                    key: paystackPublicKey,
                    email: userEmail,
                    amount: totalAmountInKobo,
                    currency: 'NGN',
                    ref: 'ZEITH_' + Math.floor((Math.random() * 1000000000) + 1),
                    onSuccess: function(transaction) {
                        window.location.href = `/Watch_Collection/payment/verify?reference=${transaction.reference}&order_id=${orderId}`;
                    },
                    onCancel: function() {
                        alert('Payment window closed.');
                    }
                });
            });

            // 5. Modals Setup
            function setupModal(triggerId, modalId, closeBtnId) {
                const trigger = document.getElementById(triggerId);
                const modal = document.getElementById(modalId);
                const closeBtn = document.getElementById(closeBtnId);
                if (!trigger || !modal || !closeBtn) return;

                trigger.addEventListener("click", (e) => {
                    e.preventDefault();
                    modal.classList.add("active");
                });
                closeBtn.addEventListener("click", () => modal.classList.remove("active"));
                modal.addEventListener("click", (e) => {
                    if (e.target === modal) modal.classList.remove("active");
                });
            }

            setupModal("termsTrigger", "termsModal", "closeTermsBtn");
            setupModal("privacyTrigger", "privacyModal", "closePrivacyBtn");
        });
    </script>
</body>

</html>