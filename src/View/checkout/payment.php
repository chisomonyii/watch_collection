<?php

/** @var array $shippingMethods */
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
            transition: opacity 0.3s ease;
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
            word-break: break-word;
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
            gap: 12px;
        }

        .item-name {
            font-weight: 600;
            color: var(--text-dark);
        }

        .item-price {
            font-weight: 600;
            color: var(--text-dark);
            white-space: nowrap;
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
            align-items: center;
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

        /* Post-Payment Receipt Upload Styles */
        .proof-card {
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            background-color: #ffffff;
            padding: 28px;
            box-shadow: var(--shadow-sm);
        }

        .proof-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 16px;
        }

        .success-banner {
            display: flex;
            align-items: center;
            gap: 12px;
            background-color: #f0fdf4;
            border: 1px solid #bbf7d0;
            padding: 14px;
            border-radius: var(--radius-md);
            margin-bottom: 20px;
            color: #166534;
            font-size: 0.9rem;
        }

        .success-banner i {
            font-size: 1.5rem;
            color: #22c55e;
        }

        .success-banner strong {
            display: block;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .success-banner p {
            font-size: 0.8rem;
            color: #15803d;
            margin-top: 2px;
        }

        /* Dropzone & Blurred Preview Styles */
        .dropzone-box {
            border: 2px dashed var(--border-color);
            border-radius: var(--radius-md);
            padding: 24px 16px;
            text-align: center;
            background-color: #fafafa;
            margin-bottom: 20px;
            position: relative;
            cursor: pointer;
            transition: border-color 0.2s ease;
            overflow: hidden;
        }

        .dropzone-box:hover {
            border-color: var(--primary-color);
        }

        .dropzone-icon {
            font-size: 2rem;
            color: var(--text-muted);
            margin-bottom: 8px;
        }

        .dropzone-box p {
            font-size: 0.85rem;
            color: var(--text-muted);
            font-weight: 500;
            margin-bottom: 10px;
        }

        .file-format-note {
            display: block;
            font-size: 0.75rem;
            color: #94a3b8;
            margin-top: 6px;
        }

        /* Blurred Preview Container */
        .preview-wrapper {
            position: relative;
            width: 100%;
            height: 180px;
            border-radius: 8px;
            overflow: hidden;
            background-color: #0b0f19;
        }

        .blurred-preview {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: blur(8px) brightness(0.6);
            transform: scale(1.05);
            transition: filter 0.3s ease;
        }

        .preview-overlay {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            gap: 8px;
            padding: 10px;
        }

        .preview-overlay i.fa-eye-slash {
            font-size: 1.5rem;
            color: var(--primary-color);
        }

        .preview-overlay span {
            font-size: 0.85rem;
            font-weight: 600;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
            word-break: break-all;
        }

        .btn-remove-file {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.4);
            color: #ffffff;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            cursor: pointer;
            backdrop-filter: blur(4px);
            transition: background 0.2s ease;
            margin-top: 4px;
        }

        .btn-remove-file:hover {
            background: rgba(239, 68, 68, 0.9);
            border-color: transparent;
        }

        .btn-submit-proof {
            width: 100%;
            background-color: var(--text-dark);
            color: #ffffff;
            border: none;
            padding: 14px 20px;
            border-radius: 25px;
            font-size: 0.95rem;
            font-weight: 700;
            cursor: pointer;
            transition: background-color 0.2s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .btn-submit-proof:hover {
            background-color: #222222;
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

        /* Responsive Media Queries */
        @media (max-width: 1024px) {
            .checkout-wrapper {
                flex-direction: column;
            }

            .summary-section {
                padding: 30px 24px;
                border-right: none;
                border-bottom: 1px solid var(--border-color);
            }

            .payment-section {
                padding: 30px 24px;
                min-height: auto;
            }
        }

        @media (max-width: 480px) {

            .summary-section,
            .payment-section {
                padding: 20px 16px;
            }

            .total-price-display {
                font-size: 1.8rem;
            }

            .express-buttons {
                grid-template-columns: 1fr;
            }

            .proof-card {
                padding: 20px 16px;
            }
        }

        /* ZEITH BRAND PRELOADER OVERLAY */
        .zeith-preloader {
            position: fixed;
            inset: 0;
            background-color: #0b0d10;
            z-index: 99999;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 1;
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

    <div class="checkout-wrapper">

        <!-- LEFT SIDE: SUMMARY SECTION -->
        <div class="summary-section" id="summarySection">
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

            <!-- SHIPPING OPTIONS LOOP -->
            <div class="shipping-section">
                <h3 class="shipping-title">Shipping method</h3>
                <div class="shipping-container" id="shippingOptionsContainer">
                    <?php
                    $isFirst = true;
                    foreach ($shippingMethods as $method):
                    ?>
                        <label class="shipping-option <?= $isFirst ? 'selected' : '' ?>">
                            <input
                                type="radio"
                                name="shipping_method_choice"
                                data-name="<?= htmlspecialchars($method['method_name']) ?>"
                                data-price="<?= htmlspecialchars($method['price']) ?>"
                                value="<?= htmlspecialchars($method['id']) ?>"
                                <?= $isFirst ? 'checked' : '' ?>>
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

        <!-- RIGHT SIDE: PAYMENT & RECEIPT SECTION -->
        <div class="payment-section">
            <div class="form-inner">

                <!-- STEP 1: INITIAL PAYSTACK PAYMENT VIEW -->
                <div id="paystackCheckoutContainer">
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

                    <!-- MAIN PAYSTACK TRIGGER BUTTON -->
                    <button type="button" class="btn-pay" id="btnPay">
                        Pay ₦<?= number_format($subtotal + 4000, 2) ?>
                    </button>
                </div>

                <!-- STEP 2: POST-PAYMENT RECEIPT UPLOAD VIEW (Hidden until Paystack succeeds) -->
                <div id="postPaymentReceiptSection" style="display: none;">
                    <form action="/Watch_Collection/payment/upload-receipt" method="POST" enctype="multipart/form-data" id="receiptForm">
                        <input type="hidden" name="order_id" value="<?= htmlspecialchars($activeOrderId) ?>">
                        <input type="hidden" name="reference" id="paystackTransactionRef" value="">

                        <!-- HIDDEN FIELDS FOR SHIPPING DATA SUBMISSION -->
                        <input type="hidden" name="shipping_fee" id="selectedShippingFee" value="4000">
                        <input type="hidden" name="shipping_method_name" id="selectedShippingName" value="Standard Shipping">

                        <div class="proof-card">
                            <h3 class="proof-title">Final Step: Provide Proof of Payment</h3>

                            <div class="success-banner">
                                <i class="fa-solid fa-circle-check"></i>
                                <div>
                                    <strong>PAYMENT SUCCESSFUL!</strong>
                                    <p>Finalizing Reconciliation.</p>
                                </div>
                            </div>

                            <!-- DROPZONE WITH BLURRED IMAGE PREVIEW -->
                            <div class="dropzone-box" id="dropzoneBox" onclick="document.getElementById('payment_receipt').click();">

                                <div id="uploadPrompt">
                                    <i class="fa-solid fa-cloud-arrow-up dropzone-icon"></i>
                                    <p>Click to attach bank transfer receipt image</p>
                                    <span class="file-format-note">File format (.jpg, .png, .pdf)</span>
                                </div>

                                <div class="preview-wrapper" id="previewWrapper" style="display: none;">
                                    <img id="receiptPreview" src="" alt="Receipt Preview" class="blurred-preview">
                                    <div class="preview-overlay">
                                        <i class="fa-solid fa-eye-slash"></i>
                                        <span id="previewFileName">Receipt Attached</span>
                                        <button type="button" class="btn-remove-file" id="btnRemoveFile" onclick="event.stopPropagation();">
                                            <i class="fa-solid fa-xmark"></i> Change File
                                        </button>
                                    </div>
                                </div>

                                <input type="file" name="payment_receipt" id="payment_receipt" accept="image/*,.pdf" required style="display: none;">
                            </div>

                            <button type="submit" class="btn-submit-proof">
                                Submit Proof & View Order Success
                            </button>
                        </div>
                    </form>
                </div>

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

            // Fixed ID mappings matching your HTML form
            const selectedShippingFeeInput = document.getElementById('selectedShippingFee');
            const selectedShippingNameInput = document.getElementById('selectedShippingName');
            const btnPay = document.getElementById('btnPay');

            const paystackCheckoutContainer = document.getElementById('paystackCheckoutContainer');
            const postPaymentReceiptSection = document.getElementById('postPaymentReceiptSection');
            const paystackTransactionRef = document.getElementById('paystackTransactionRef');
            const summarySection = document.getElementById('summarySection');

            function formatCurrency(amount) {
                return '₦' + amount.toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
            }

            // 1. Unified Shipping Selection Handler
            shippingOptions.forEach(option => {
                option.addEventListener('click', function() {
                    shippingOptions.forEach(opt => opt.classList.remove('selected'));
                    this.classList.add('selected');

                    const radio = this.querySelector('input[type="radio"]');
                    radio.checked = true;

                    const shippingCost = parseFloat(radio.dataset.price || radio.value);
                    const shippingName = radio.dataset.name || 'Standard Shipping';

                    // Update hidden inputs for backend form submission
                    if (selectedShippingFeeInput) selectedShippingFeeInput.value = shippingCost;
                    if (selectedShippingNameInput) selectedShippingNameInput.value = shippingName;

                    const grandTotal = productPrice + shippingCost;
                    const formattedShipping = formatCurrency(shippingCost);
                    const formattedGrandTotal = formatCurrency(grandTotal);

                    if (shippingSummaryPrice) shippingSummaryPrice.textContent = formattedShipping;
                    if (totalPriceDisplay) totalPriceDisplay.textContent = formattedGrandTotal;
                    if (btnPay) btnPay.textContent = `Pay ${formattedGrandTotal}`;
                });
            });

            // 2. Paystack Inline Payment Trigger
            const paystackPublicKey = 'pk_test_46537c2e2608da34a412e77a7baec683a5097391';

            if (btnPay) {
                btnPay.addEventListener('click', function(e) {
                    e.preventDefault();

                    const userEmail = "<?= htmlspecialchars($_SESSION['customer_email'] ?? 'customer@zeith.com') ?>";
                    const currentShippingFee = selectedShippingFeeInput ? Number(selectedShippingFeeInput.value) : 4000;
                    const totalAmountInKobo = Math.round((productPrice + currentShippingFee) * 100);

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
                            if (paystackTransactionRef) paystackTransactionRef.value = transaction.reference;
                            if (summarySection) summarySection.style.opacity = '0.5';

                            if (paystackCheckoutContainer) paystackCheckoutContainer.style.display = 'none';
                            if (postPaymentReceiptSection) postPaymentReceiptSection.style.display = 'block';
                        },
                        onCancel: function() {
                            alert('Payment window closed.');
                        }
                    });
                });
            }

            // 3. Modals Setup
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

            // 4. Blurred Receipt Preview Logic
            const receiptInput = document.getElementById('payment_receipt');
            const receiptPreview = document.getElementById('receiptPreview');
            const previewWrapper = document.getElementById('previewWrapper');
            const uploadPrompt = document.getElementById('uploadPrompt');
            const previewFileName = document.getElementById('previewFileName');
            const btnRemoveFile = document.getElementById('btnRemoveFile');

            if (receiptInput) {
                receiptInput.addEventListener('change', function() {
                    const file = this.files[0];
                    if (file) {
                        if (file.type.startsWith('image/')) {
                            const reader = new FileReader();
                            reader.onload = function(evt) {
                                if (receiptPreview) receiptPreview.src = evt.target.result;
                                if (previewWrapper) previewWrapper.style.display = 'block';
                                if (uploadPrompt) uploadPrompt.style.display = 'none';
                                if (previewFileName) previewFileName.textContent = file.name;
                            };
                            reader.readAsDataURL(file);
                        } else {
                            if (receiptPreview) receiptPreview.src = '';
                            if (previewWrapper) previewWrapper.style.display = 'block';
                            if (uploadPrompt) uploadPrompt.style.display = 'none';
                            if (previewFileName) previewFileName.textContent = `PDF: ${file.name}`;
                        }
                    }
                });
            }

            if (btnRemoveFile) {
                btnRemoveFile.addEventListener('click', () => {
                    receiptInput.value = '';
                    if (receiptPreview) receiptPreview.src = '';
                    if (previewWrapper) previewWrapper.style.display = 'none';
                    if (uploadPrompt) uploadPrompt.style.display = 'block';
                });
            }

            // 5. Global Brand Preloader & bfcache Fix
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

            hidePreloader();

            window.addEventListener('pageshow', (event) => {
                if (event.persisted) {
                    hidePreloader();
                }
            });

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