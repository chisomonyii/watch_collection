<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ZEITH - Payment Successful</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            font-family: -apple-system, sans-serif;
            background: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }

        .success-card {
            background: #fff;
            padding: 40px;
            border-radius: 16px;
            text-align: center;
            max-width: 450px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .icon-box {
            font-size: 3rem;
            color: #22c55e;
            margin-bottom: 16px;
        }

        h2 {
            margin-bottom: 8px;
            color: #111;
        }

        p {
            color: #666;
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .ref-box {
            background: #f1f5f9;
            padding: 12px;
            border-radius: 8px;
            font-weight: bold;
            margin: 20px 0;
            font-family: monospace;
        }

        .btn-home {
            display: inline-block;
            background: #f68b1e;
            color: #fff;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 25px;
            font-weight: bold;
            margin-top: 10px;
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
    <div class="success-card">
        <div class="icon-box"><i class="fa-solid fa-circle-check"></i></div>
        <h2>Payment Successful!</h2>
        <p>Thank you for your order with ZEITH. Your payment has been verified and your timepiece is being prepared for dispatch.</p>

        <div class="tracking-cta-box" style="margin-top: 24px; text-align: center;">
            <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 12px;">Want to check the live status of your timepiece?</p>
            <a href="/Zeith/track?ref=<?= htmlspecialchars($orderNumber ?? '') ?>" class="btn-track-order" style="display: inline-block; background-color: #111; color: #fff; padding: 12px 24px; border-radius: 25px; text-decoration: none; font-weight: 600; font-size: 0.9rem;">
                <i class="fa-solid fa-truck-fast"></i> Track Your Order Now
            </a>
        </div>

        <div class="ref-box">Ref: <?= htmlspecialchars($_GET['ref'] ?? 'N/A') ?></div>

        <a href="/Zeith/" class="btn-home">Return to Store</a>
    </div>

    <script>
        // Clear local storage cart items after verified purchase
        localStorage.removeItem('zeith_cart');

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