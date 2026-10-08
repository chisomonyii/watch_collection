<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZEITH - Checkout</title>
    <link rel="stylesheet" href="../header.css">
    <link rel="stylesheet" href="../footer.css">
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

        /* RIGHT COLUMN: Payment Form */
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

        .btn-apple i {
            font-size: 1.2rem;
            margin-bottom: 2px;
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

        /* Checkbox Box */
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

        .btn-pay:active {
            transform: scale(0.99);
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

        @media (max-width: 1024px) {
            .checkout-wrapper {
                flex-direction: column;
            }

            .summary-section {
                padding: 30px 40px;
                border-right: none;
                border-bottom: 1px solid var(--border-color);
            }

            .payment-section {
                padding: 40px;
            }

            .total-price-display {
                font-size: 2rem;
                margin-bottom: 20px;
            }
        }

        @media (max-width: 600px) {
            .summary-section {
                padding: 24px 20px;
            }

            .payment-section {
                padding: 24px 20px;
            }

            .express-buttons {
                grid-template-columns: 1fr;
            }

            .total-price-display {
                font-size: 1.75rem;
            }

            .back-link {
                margin-bottom: 20px;
            }

            .split-row {
                grid-template-columns: 1fr;
            }

            .form-control,
            .form-select,
            .btn-pay,
            .btn-express {
                padding: 14px;
                font-size: 16px;
            }
        }

        .terms-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.55);
            backdrop-filter: blur(4px);
            /* Smooth background blur */
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
    </style>
</head>

<body>

    <div class="checkout-wrapper">

        <div class="summary-section">
            <a href="cart-slip.php" class="back-link">
                <i class="fa-solid fa-arrow-left"></i> Back to Cart
            </a>

            <div class="store-badge">
                <span class="store-name"><span class="zeith">ZEITH</span> Payment stripe</span>
            </div>

            <div class="total-price-display" id="totalPriceDisplay">
                ₦704,000.00
            </div>

            <div class="itemized-list">
                <div class="line-item">
                    <span class="item-name">Speedmaster (The "Moonwatch")</span>
                    <span class="item-price">₦700,000.00</span>
                </div>
                <div class="line-item" style="color: var(--text-muted);">
                    <span>Shipping</span>
                    <span id="shippingSummaryPrice">₦4,000.00</span>
                </div>
            </div>

            <div class="shipping-section">
                <h3 class="shipping-title">Shipping method</h3>
                <div class="shipping-container">

                    <label class="shipping-option selected">
                        <input type="radio" name="shipping_method" value="4000" checked>
                        <div class="shipping-details">
                            <div class="shipping-name">
                                Lagos Island 1 [Lekki Phase 1, Ikoyi, Victoria Island, Ikate, Lagos Island, etc] Delivered within 1-2 Days (EXCLUDING HOLIDAY)
                            </div>
                        </div>
                        <div class="shipping-price">₦4,000.00</div>
                    </label>

                    <label class="shipping-option">
                        <input type="radio" name="shipping_method" value="4500">
                        <div class="shipping-details">
                            <div class="shipping-name">
                                Lagos Mainland 1 [Yaba, Ikeja, Maryland, Magodo, Shomolu, Ojota, etc]
                            </div>
                        </div>
                        <div class="shipping-price">₦4,500.00</div>
                    </label>

                    <label class="shipping-option">
                        <input type="radio" name="shipping_method" value="5000">
                        <div class="shipping-details">
                            <div class="shipping-name">
                                Lagos Island 2 [Ajah, Osapa, Epe, Orchid, Sangotedo, Lekki Phase 2, etc]
                            </div>
                            <div class="shipping-desc">
                                Orders before 10am will be delivered same day, others the next day
                            </div>
                        </div>
                        <div class="shipping-price">₦5,000.00</div>
                    </label>

                    <label class="shipping-option">
                        <input type="radio" name="shipping_method" value="7500">
                        <div class="shipping-details">
                            <div class="shipping-name">
                                Lagos/Ogun Opic Agbara Sango Arepo (1-2 days delivery)
                            </div>
                        </div>
                        <div class="shipping-price">₦7,500.00</div>
                    </label>

                    <label class="shipping-option">
                        <input type="radio" name="shipping_method" value="7500">
                        <div class="shipping-details">
                            <div class="shipping-name">
                                Mainland Edge: Command/Ajasa, Ikorodu, Igbo Elerin, Apapa,Inside Iju Ishaga
                            </div>
                        </div>
                        <div class="shipping-price">₦7,500.00</div>
                    </label>

                </div>
            </div>

        </div>

        <div class="payment-section">
            <div class="form-inner">
                <form action="process-payment.php" method="POST">

                    <div class="express-buttons">
                        <button type="button" class="btn-express btn-apple">
                            <i class="fa-brands fa-apple"></i> Pay
                        </button>
                        <button type="button" class="btn-express btn-link">
                            <i class="fa-solid fa-arrow-right"></i> link
                        </button>
                    </div>

                    <div class="divider">
                        <span>OR</span>
                    </div>

                    <div class="form-group">
                        <label class="section-label">Contact information</label>
                        <input type="email" name="email" class="form-control" placeholder="Email address" value="chibuikemnweze2020@gmail.com" required>
                    </div>

                    <div class="form-group">
                        <label class="section-label">Payment method</label>

                        <div class="card-input-box">
                            <div class="card-header-tab">
                                <i class="fa-regular fa-credit-card"></i> Card
                            </div>

                            <div class="card-fields-wrapper">
                                <div>
                                    <label style="font-size: 0.75rem; color: var(--text-muted); font-weight: 600;">Card information</label>
                                    <div class="card-number-wrapper" style="margin-top: 4px;">
                                        <input type="text" name="card_number" class="form-control" placeholder="1234 1234 1234 1234" required>
                                        <span class="card-icons">
                                            <i class="fa-brands fa-cc-visa"></i>
                                            <i class="fa-brands fa-cc-mastercard"></i>
                                        </span>
                                    </div>
                                </div>

                                <div class="split-row">
                                    <input type="text" name="card_exp" class="form-control" placeholder="MM / YY" required>
                                    <input type="text" name="card_cvc" class="form-control" placeholder="CVC" required>
                                </div>

                                <div>
                                    <label style="font-size: 0.75rem; color: var(--text-muted); font-weight: 600;">Cardholder name</label>
                                    <input type="text" name="card_name" class="form-control" placeholder="Full name on card" style="margin-top: 4px;" required>
                                </div>

                                <div>
                                    <label style="font-size: 0.75rem; color: var(--text-muted); font-weight: 600;">Country or region</label>
                                    <select name="country" class="form-select" style="margin-top: 4px;">
                                        <option value="Nigeria" selected>Nigeria</option>
                                        <option value="United States">United States</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                        <option value="Canada">Canada</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <label class="save-info-card">
                        <input type="checkbox" name="save_info" checked>
                        <div class="save-info-text">
                            <div class="save-info-title">Save my information for faster checkout</div>
                            <div class="save-info-sub">Pay securely across ZEITH and everywhere Link is accepted.</div>
                        </div>
                    </label>

                    <button type="submit" class="btn-pay" id="btnPay">
                        Pay ₦704,000.00
                    </button>

                    <div class="checkout-footer">
                        <span>Powered by <strong>ZEITH Pay</strong></span>
                        <span>|</span>
                        <a href="#" id="termsTrigger">Terms</a>
                        <span>|</span>
                        <a href="#" id="privacyTrigger">Privacy</a>
                    </div>

                    <div class="terms-modal-overlay" id="termsModal">
                        <div class="terms-modal-card">
                            <button type="button" class="terms-modal-close" id="closeTermsBtn" aria-label="Close modal">
                                <i class="fa-solid fa-xmark"></i>
                            </button>

                            <div class="terms-modal-header">
                                <h3>Terms of Service</h3>
                            </div>

                            <div class="terms-modal-body">
                                <p>
                                    Welcome to ZEITH. By placing an order or using our services, you agree to provide accurate checkout information and comply with our purchase guidelines. All transactions processed via ZEITH Pay are encrypted and authorized securely before order dispatch. Standard local delivery timelines range from 1 to 2 business days depending on your selected location. Eligible items may be returned within 7 days of delivery provided they remain unworn, undamaged, and retain all original packaging and protective seals. We reserve the right to update product pricing and service terms at any time without prior notice.
                                </p>
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
                                <p>
                                    At ZEITH, we value your privacy and are committed to protecting your personal data. The information collected during checkout—including your contact details, shipping address, and payment information—is processed exclusively to fulfill your orders and provide a seamless payment experience via ZEITH Pay. We do not sell, rent, or share your personal information with third parties except as necessary to complete your transaction (such as payment gateways and logistics partners). All payment data is encrypted using industry-standard protocols.
                                </p>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productPrice = 700000;
            const shippingOptions = document.querySelectorAll('.shipping-option');
            const totalPriceDisplay = document.getElementById('totalPriceDisplay');
            const shippingSummaryPrice = document.getElementById('shippingSummaryPrice');
            const btnPay = document.getElementById('btnPay');

            function formatCurrency(amount) {
                return '₦' + amount.toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
            }

            shippingOptions.forEach(option => {
                option.addEventListener('click', function() {
                    // Update active selected class styling
                    shippingOptions.forEach(opt => opt.classList.remove('selected'));
                    this.classList.add('selected');

                    // Check radio button inside clicked block
                    const radio = this.querySelector('input[type="radio"]');
                    radio.checked = true;

                    // Calculate new total
                    const shippingCost = parseFloat(radio.value);
                    const grandTotal = productPrice + shippingCost;

                    // Update UI elements
                    const formattedShipping = formatCurrency(shippingCost);
                    const formattedGrandTotal = formatCurrency(grandTotal);

                    shippingSummaryPrice.textContent = formattedShipping;
                    totalPriceDisplay.textContent = formattedGrandTotal;
                    btnPay.textContent = `Pay ${formattedGrandTotal}`;
                });
            });
        });
        document.addEventListener("DOMContentLoaded", () => {
            const termsModal = document.getElementById("termsModal");
            const closeTermsBtn = document.getElementById("closeTermsBtn");

            const termsTrigger = document.querySelector(".checkout-footer a[href='#']");

            // Open Modal
            if (termsTrigger) {
                termsTrigger.addEventListener("click", (e) => {
                    e.preventDefault();
                    termsModal.classList.add("active");
                });
            }

            closeTermsBtn.addEventListener("click", () => {
                termsModal.classList.remove("active");
            });

            termsModal.addEventListener("click", (e) => {
                if (e.target === termsModal) {
                    termsModal.classList.remove("active");
                }
            });
        });
        document.addEventListener("DOMContentLoaded", () => {
            function setupModal(triggerId, modalId, closeBtnId) {
                const trigger = document.getElementById(triggerId);
                const modal = document.getElementById(modalId);
                const closeBtn = document.getElementById(closeBtnId);

                if (!trigger || !modal || !closeBtn) return;

                trigger.addEventListener("click", (e) => {
                    e.preventDefault();
                    modal.classList.add("active");
                });

                closeBtn.addEventListener("click", () => {
                    modal.classList.remove("active");
                });

                modal.addEventListener("click", (e) => {
                    if (e.target === modal) {
                        modal.classList.remove("active");
                    }
                });
            }

            setupModal("termsTrigger", "termsModal", "closeTermsBtn");
            setupModal("privacyTrigger", "privacyModal", "closePrivacyBtn");
        });
    </script>
    <?php require_once __DIR__ . '../../src/View/components/footer.php'; ?>
</body>

</html>