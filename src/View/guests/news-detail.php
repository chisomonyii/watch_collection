<?php
// src/View/guests/news-detail.php

// Fallback watch article if variable is not passed
$article = $article ?? [
    'title' => 'Unveiling Excellence: The New Master Chronometer',
    'category' => 'FEATURED STORY',
    'author_name' => 'Zeith Editorial',
    'created_at' => date('Y-m-d H:i:s'),
    'image_url' => 'banner/banner1.jpg',
    'content' => "Watchmaking is an evolving pursuit of perfection. The new Zeith Master Chronometer combines state-of-the-art silicon balance springs with hand-finished bevels.\n\nEach movement undergoes 15 days of rigorous testing under extreme temperatures and magnetic fields to ensure uncompromised accuracy on your wrist."
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($article['title']) ?> — ZEITH Chronicle</title>
    <style>
        /* =========================================================
   ZEITH ARTICLE DETAILS
   LUXURY EDITORIAL / HOROLOGY STYLE
   ========================================================= */

        :root {
            --zeith-bg: #F7F4EF;
            --zeith-text: #1A202C;
            --zeith-accent: #8C7853;
            --zeith-border: #E5E0D8;

            --zeith-white: #FFFFFF;
            --zeith-muted: #716E68;
            --zeith-soft: #EEE9E0;

            --zeith-content-width: 1120px;
        }


        /* =========================================================
   RESET
   ========================================================= */

        * {
            box-sizing: border-box;
        }

        html {
            margin: 0;
            padding: 0;
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            padding: 0;

            background: var(--zeith-bg);
            color: var(--zeith-text);

            font-family:
                Inter,
                "Helvetica Neue",
                Helvetica,
                Arial,
                sans-serif;

            -webkit-font-smoothing: antialiased;
            text-rendering: optimizeLegibility;
        }


        /* ======================================================
   ZEITH MINIMALIST BRAND PRELOADER
   ====================================================== */
    .zeith-preloader {
        position: fixed;
        inset: 0;
        background-color: #0b0d10;
        /* Obsidian dark base */
        z-index: 99999;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: opacity 0.4s ease, visibility 0.4s ease;
    }

    .zeith-preloader.fade-out {
        opacity: 0;
        visibility: hidden;
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


        /* =========================================================
   ARTICLE CONTAINER
   ========================================================= */

        .article-container {
            width: min(calc(100% - 64px),
                    var(--zeith-content-width));

            margin: 0 auto;

            padding:
                45px 0 110px;
        }


        /* =========================================================
   BACK LINK
   ========================================================= */

        .back-link {
            display: inline-flex;
            align-items: center;

            margin-bottom: 65px;

            color: var(--zeith-accent);

            font-size: 11px;
            font-weight: 800;

            letter-spacing: 1.4px;
            text-transform: uppercase;

            text-decoration: none;

            transition:
                color .25s ease,
                transform .25s ease;
        }

        .back-link:hover {
            color: var(--zeith-text);

            transform: translateX(-4px);
        }


        /* =========================================================
   ARTICLE HEADER
   ========================================================= */

        .article-category {
            display: inline-flex;
            align-items: center;

            margin-bottom: 20px;

            color: var(--zeith-accent);

            font-size: 11px;
            font-weight: 800;

            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .article-category::before {
            content: "";

            width: 28px;
            height: 1px;

            margin-right: 12px;

            background: var(--zeith-accent);
        }


        /* =========================================================
   ARTICLE TITLE
   ========================================================= */

        .article-title {
            max-width: 1000px;

            margin: 0;

            color: var(--zeith-text);

            font-family:
                Georgia,
                "Times New Roman",
                serif;

            font-size: clamp(48px,
                    7vw,
                    88px);

            font-weight: 500;

            line-height: .98;

            letter-spacing: -3.5px;
        }


        /* =========================================================
   ARTICLE META
   ========================================================= */

        .article-meta {
            display: flex;
            align-items: center;
            flex-wrap: wrap;

            gap: 10px;

            margin-top: 30px;
            padding-bottom: 32px;

            border-bottom: 1px solid var(--zeith-border);

            color: var(--zeith-muted);

            font-size: 12px;
            font-weight: 500;

            letter-spacing: .35px;
        }

        .article-meta span:nth-child(2) {
            color: var(--zeith-accent);
        }


        /* =========================================================
   HERO IMAGE
   ========================================================= */

        .article-hero-image {
            width: 100%;
            height: 650px;

            display: block;

            margin-top: 42px;

            object-fit: cover;

            background: var(--zeith-soft);

            border-radius: 2px;

            transition:
                transform .7s cubic-bezier(.2, .7, .2, 1);
        }

        .article-hero-image:hover {
            transform: scale(1.008);
        }


        /* =========================================================
   ARTICLE CONTENT
   ========================================================= */

        .article-content {
            width: min(100%, 780px);

            margin:
                70px auto 0;

            color: var(--zeith-text);

            font-family:
                Georgia,
                "Times New Roman",
                serif;

            font-size: 18px;

            line-height: 1.95;

            letter-spacing: .05px;
        }


        /* =========================================================
   FIRST PARAGRAPH — EDITORIAL DROP CAP
   ========================================================= */

        .article-content::first-letter {
            float: left;

            margin:
                7px 12px 0 0;

            color: var(--zeith-accent);

            font-family:
                Georgia,
                "Times New Roman",
                serif;

            font-size: 72px;
            font-weight: 500;

            line-height: .75;
        }


        /* =========================================================
   CONTENT PARAGRAPHS
   ========================================================= */

        .article-content p {
            margin:
                0 0 28px;
        }


        /*
   Because your PHP currently outputs the article through
   nl2br(), line breaks become <br>. Keep them visually
   comfortable.
*/

        .article-content br {
            line-height: 1.9;
        }


        /* =========================================================
   SELECTION
   ========================================================= */

        .article-content ::selection,
        .article-title::selection {
            background: var(--zeith-accent);
            color: var(--zeith-white);
        }


        /* =========================================================
   SUBTLE ARTICLE FOOTER
   ========================================================= */

        .article-content::after {
            content: "";

            display: block;

            width: 100%;

            height: 1px;

            margin-top: 65px;

            background: var(--zeith-border);
        }


        /* =========================================================
   TABLET
   ========================================================= */

        @media (max-width: 1000px) {

            .article-container {
                width: min(calc(100% - 48px),
                        900px);

                padding-top: 35px;
            }

            .back-link {
                margin-bottom: 50px;
            }

            .article-title {
                font-size: clamp(44px,
                        7vw,
                        70px);

                letter-spacing: -2.5px;
            }

            .article-hero-image {
                height: 520px;
            }

            .article-content {
                margin-top: 55px;

                font-size: 17px;

                line-height: 1.85;
            }

        }


        /* =========================================================
   IPAD / TABLET PORTRAIT
   ========================================================= */

        @media (max-width: 768px) {

            .article-container {
                width: calc(100% - 40px);

                padding:
                    28px 0 80px;
            }

            .back-link {
                margin-bottom: 42px;
            }

            .article-category {
                font-size: 10px;
                letter-spacing: 1.7px;
            }

            .article-title {
                font-size: clamp(40px,
                        9vw,
                        62px);

                line-height: 1;

                letter-spacing: -2px;
            }

            .article-meta {
                margin-top: 24px;
                padding-bottom: 25px;

                font-size: 11px;
            }

            .article-hero-image {
                height: 430px;

                margin-top: 30px;
            }

            .article-content {
                width: 100%;

                margin-top: 48px;

                font-size: 16px;

                line-height: 1.85;
            }

            .article-content::first-letter {
                font-size: 62px;
            }

        }


        /* =========================================================
   MOBILE
   ========================================================= */

        @media (max-width: 600px) {

            .article-container {
                width: calc(100% - 32px);

                padding:
                    22px 0 65px;
            }

            .back-link {
                margin-bottom: 38px;

                font-size: 9px;
                letter-spacing: 1.2px;
            }

            .article-category {
                margin-bottom: 16px;

                font-size: 9px;
                letter-spacing: 1.5px;
            }

            .article-category::before {
                width: 20px;

                margin-right: 9px;
            }

            .article-title {
                font-size: 40px;

                line-height: 1;

                letter-spacing: -1.7px;
            }

            .article-meta {
                gap: 7px;

                margin-top: 21px;
                padding-bottom: 21px;

                font-size: 10px;
            }

            .article-hero-image {
                height: 330px;

                margin-top: 24px;
            }

            .article-content {
                margin-top: 40px;

                font-size: 16px;

                line-height: 1.8;
            }

            .article-content::first-letter {
                margin-right: 9px;

                font-size: 56px;
            }

            .article-content::after {
                margin-top: 45px;
            }

        }


        /* =========================================================
   SMALL MOBILE
   ========================================================= */

        @media (max-width: 400px) {

            .article-container {
                width: calc(100% - 28px);
            }

            .article-title {
                font-size: 35px;

                letter-spacing: -1.3px;
            }

            .article-hero-image {
                height: 280px;
            }

            .article-content {
                font-size: 15px;

                line-height: 1.78;
            }

        }


        /* =========================================================
   REDUCED MOTION
   ========================================================= */

        @media (prefers-reduced-motion: reduce) {

            html {
                scroll-behavior: auto;
            }

            *,
            *::before,
            *::after {
                animation-duration: .01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: .01ms !important;
            }

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

    <div class="article-container">
        <a href="/Watch_Collection/news" class="back-link">← Back to Chronicle</a>

        <div class="article-category">
            <?= htmlspecialchars($article['category']) ?>
        </div>

        <h1 class="article-title">
            <?= htmlspecialchars($article['title']) ?>
        </h1>

        <div class="article-meta">
            <span>By <?= htmlspecialchars($article['author_name'] ?? 'Zeith Editorial') ?></span>
            <span>•</span>
            <span><?= date('F j, Y', strtotime($article['created_at'])) ?></span>
        </div>

        <?php if (!empty($article['image_url'])): ?>
            <img src="/Watch_Collection/assets/image/<?= htmlspecialchars($article['image_url']) ?>" alt="Article cover" class="article-hero-image">
        <?php endif; ?>

        <div class="article-content">
            <?= nl2br(htmlspecialchars($article['content'])) ?>
        </div>
    </div>

    <script>
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