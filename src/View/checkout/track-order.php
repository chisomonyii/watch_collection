<?php 
    $orderRef = !empty($order['order_number']) ? $order['order_number'] : 'General Inquiry';
    $whatsappMessage = urlencode("Hi ZEITH, I want to check my order status for reference: " . $orderRef);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZEITH - Track Your Order</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --primary-color: #f68b1e;
            --text-dark: #111111;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --bg-light: #f8fafc;
            --card-bg: #ffffff;
            --success-color: #10b981;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            padding: 40px 20px;
        }

        .tracking-container {
            max-width: 800px;
            margin: 0 auto;
            margin-top: 80px;
        }

        /* SEARCH BOX */
        .search-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 32px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            margin-bottom: 32px;
            text-align: center;
        }

        .search-card h2 {
            font-size: 1.5rem;
            margin-bottom: 8px;
        }

        .search-form {
            display: flex;
            gap: 12px;
            margin-top: 20px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        .search-input {
            flex: 1;
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 0.95rem;
            outline: none;
            width: 100%;
        }

        .search-btn {
            background: var(--text-dark);
            color: #fff;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            white-space: nowrap;
        }

        /* STATUS TRACKER BAR */
        .status-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 40px 32px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        }

        .status-header-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .progress-tracker {
            display: flex;
            justify-content: space-between;
            position: relative;
            margin: 30px 0;
        }

        .progress-tracker::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 0;
            width: 100%;
            height: 4px;
            background: #e2e8f0;
            z-index: 1;
        }

        .progress-line-active {
            position: absolute;
            top: 20px;
            left: 0;
            height: 4px;
            background: var(--primary-color);
            z-index: 2;
            transition: width 0.4s ease;
        }

        .step-item {
            position: relative;
            z-index: 3;
            text-align: center;
            flex: 1;
        }

        .step-icon {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: #ffffff;
            border: 3px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
            font-weight: 700;
            color: var(--text-muted);
            transition: all 0.3s ease;
        }

        .step-item.completed .step-icon {
            background: var(--success-color);
            border-color: var(--success-color);
            color: #ffffff;
        }

        .step-item.active .step-icon {
            background: var(--primary-color);
            border-color: var(--primary-color);
            color: #ffffff;
            box-shadow: 0 0 0 4px rgba(246, 139, 30, 0.2);
        }

        .step-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        .step-date {
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-top: 4px;
        }

        /* SUPPORT FOOTER */
        .support-box {
            margin-top: 32px;
            text-align: center;
            padding: 20px;
            background: #ffffff;
            border-radius: 12px;
            border: 1px solid var(--border-color);
        }

        .whatsapp-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #25d366;
            color: #ffffff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 600;
            margin-top: 10px;
        }

        /* ==========================================================
           RESPONSIVE ADAPTATIONS FOR IPADS AND MOBILE PHONES
           ========================================================== */
        @media (max-width: 768px) {
            body {
                padding: 20px 12px;
            }

            .search-card,
            .status-card {
                padding: 24px 16px;
            }

            .search-form {
                flex-direction: column;
            }

            .search-btn {
                width: 100%;
            }

            /* Convert horizontal tracker to a clean vertical list on mobile */
            .progress-tracker {
                flex-direction: column;
                align-items: flex-start;
                margin: 0;
                padding-left: 20px;
                position: relative;
            }

            .progress-tracker::before {
                top: 0;
                bottom: 0;
                left: 39px;
                width: 4px;
                height: 100%;
            }

            .progress-line-active {
                top: 0;
                left: 39px;
                width: 4px !important; /* Overrides inline percentage width for vertical view */
            }

            .step-item {
                display: flex;
                align-items: center;
                text-align: left;
                margin-bottom: 24px;
                width: 100%;
            }

            .step-item:last-child {
                margin-bottom: 0;
            }

            .step-icon {
                margin: 0 16px 0 0;
                flex-shrink: 0;
            }
        }
    </style>
</head>

<body>
       <?php require_once __DIR__ . '/../components/header.php'; ?>

    <div class="tracking-container">

        <!-- SEARCH BOX -->
        <div class="search-card">
            <h2>Track Your Timepiece</h2>
            <p style="color: var(--text-muted); font-size: 0.9rem;">Enter your ZEITH order reference, email, or phone number below.</p>
            <form class="search-form" method="GET" action="/Watch_Collection/track">
                <input type="text" name="ref" class="search-input" placeholder="e.g. ZEITH-XXXXX or Email / Phone" value="<?= htmlspecialchars($_GET['ref'] ?? '') ?>" required>
                <button type="submit" class="search-btn">Search</button>
            </form>
        </div>

        <?php if (!empty($order)): ?>
            <!-- STATUS PROGRESS BAR -->
            <div class="status-card">
                <div class="status-header-row">
                    <div>
                        <h3 style="font-size: 1.1rem;">Order Reference: <?= htmlspecialchars($order['order_number']) ?></h3>
                        <p style="color: var(--text-muted); font-size: 0.85rem; margin-top: 2px;">Status: <strong><?= htmlspecialchars($order['order_status']) ?></strong></p>
                    </div>
                    <span style="background: #f0fdf4; color: #166534; padding: 6px 12px; border-radius: 20px; font-weight: 600; font-size: 0.8rem;">
                        Verified Purchase
                    </span>
                </div>

                <div class="progress-tracker">
                    <!-- Active Progress Line Width based on status -->
                    <?php
                    $status = $order['order_status'] ?? 'Pending Verification';
                    $progressWidth = '0%';
                    if ($status === 'Pending Verification' || $status === 'Processing') $progressWidth = '33%';
                    if ($status === 'Dispatched') $progressWidth = '66%';
                    if ($status === 'Delivered') $progressWidth = '100%';
                    ?>
                    <div class="progress-line-active" style="height: <?= $progressWidth ?>;"></div>

                    <!-- STEP 1: ORDER PLACED -->
                    <div class="step-item completed">
                        <div class="step-icon"><i class="fa-solid fa-check"></i></div>
                        <div>
                            <div class="step-label">Order Placed</div>
                            <div class="step-date">Verified</div>
                        </div>
                    </div>

                    <!-- STEP 2: PROCESSING / VERIFICATION -->
                    <div class="step-item <?= in_array($status, ['Processing', 'Dispatched', 'Delivered']) ? 'completed' : 'active' ?>">
                        <div class="step-icon">
                            <?= in_array($status, ['Processing', 'Dispatched', 'Delivered']) ? '<i class="fa-solid fa-check"></i>' : '2' ?>
                        </div>
                        <div>
                            <div class="step-label">Processing</div>
                            <div class="step-date">Inspection & Packing</div>
                        </div>
                    </div>

                    <!-- STEP 3: DISPATCHED -->
                    <div class="step-item <?= in_array($status, ['Dispatched', 'Delivered']) ? 'completed' : ($status === 'Processing' ? 'active' : '') ?>">
                        <div class="step-icon">
                            <?= in_array($status, ['Dispatched', 'Delivered']) ? '<i class="fa-solid fa-check"></i>' : '3' ?>
                        </div>
                        <div>
                            <div class="step-label">Dispatched</div>
                            <div class="step-date">In Transit</div>
                        </div>
                    </div>

                    <!-- STEP 4: DELIVERED -->
                    <div class="step-item <?= $status === 'Delivered' ? 'completed' : '' ?>">
                        <div class="step-icon">4</div>
                        <div>
                            <div class="step-label">Delivered</div>
                            <div class="step-date">Completed</div>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif (isset($_GET['ref'])): ?>
            <div class="search-card" style="padding: 20px; color: #dc2626; font-weight: 600;">
                No order found matching "<?= htmlspecialchars($_GET['ref']) ?>". Please check your reference number, email, or phone number.
            </div>
        <?php endif; ?>

        <!-- DIRECT WHATSAPP ASSISTANCE -->
        <div class="support-box">
            <p style="font-size: 0.9rem; color: var(--text-dark); font-weight: 600;">Need immediate delivery updates?</p>
            <p style="font-size: 0.8rem; color: var(--text-muted);">Speak directly with your ZEITH fulfillment concierge on WhatsApp.</p>
            <a href="https://wa.me/2349161426400?text=<?= $whatsappMessage ?>" target="_blank" class="whatsapp-btn">
                <i class="fa-brands fa-whatsapp"></i> Chat on WhatsApp
            </a>
        </div>

    </div>

    

</body>

</html>