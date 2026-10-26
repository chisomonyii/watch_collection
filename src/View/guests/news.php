<?php
// src/View/guests/news.php

// Fallback values if database news table is empty
$featured = $featured ?? [
    'title' => 'Unveiling Excellence: The New Master Chronometer',
    'summary' => 'Discover the latest chapter in Zeith watchmaking — where precision, timeless design and modern craftsmanship come together to redefine the meaning of luxury time.',
    'category' => 'FEATURED STORY',
    'image_url' => 'banner/banner1.jpg',
    'created_at' => date('Y-m-d H:i:s')
];

$sideStories = $sideStories ?? [
    [
        'title' => 'The Art Behind Precision',
        'summary' => 'Inside the details and engineering that make a Zeith timepiece exceptional.',
        'category' => 'Watchmaking',
        'image_url' => 'banner/banner3.jpg'
    ],
    [
        'title' => "Inside Today's Watch Industry",
        'summary' => 'The trends, innovations and ideas shaping the future of mechanical watches.',
        'category' => 'Industry',
        'image_url' => 'banner/banner4.jpg'
    ],
    [
        'title' => 'Vintage Finds Worth Knowing',
        'summary' => 'Exploring timeless pieces and the stories hidden behind collectible watches.',
        'category' => "Collector's Corner",
        'image_url' => 'banner/banner5.jpg'
    ]
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZEITH — Watch Journal</title>

    <style>
        /* =========================================================
   ZEITH NEWS — LUXURY EDITORIAL DESIGN
   ========================================================= */

        :root {
            --zeith-bg: #F7F4EF;
            --zeith-text: #1A202C;
            --zeith-accent: #8C7853;
            --zeith-border: #E5E0D8;

            --zeith-white: #FFFFFF;
            --zeith-muted: #716E68;
            --zeith-soft: #EEE9E0;

            --zeith-max-width: 1440px;
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
   MAIN NEWS SECTION
   ========================================================= */

        .zeith-news {
            width: 100%;
            min-height: 100vh;

            background: var(--zeith-bg);

            padding: 0 32px 100px;
        }

        .zeith-news-container {
            width: 100%;
            max-width: var(--zeith-max-width);

            margin: 0 auto;
        }


        /* =========================================================
   HEADER
   ========================================================= */

        .zeith-news-header {
            min-height: 100px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            border-bottom: 1px solid var(--zeith-border);
        }


        /* =========================================================
   NEWS LOGO
   ========================================================= */

        .zeith-news-logo {
            display: inline-flex;
            align-items: baseline;
            gap: 7px;

            color: var(--zeith-text);

            text-decoration: none;

            line-height: 1;
        }

        .zeith-news-logo-small {
            color: var(--zeith-accent);

            font-family:
                Georgia,
                "Times New Roman",
                serif;

            font-size: 14px;
            font-style: italic;
            letter-spacing: 1px;
        }

        .zeith-news-logo-main {
            color: var(--zeith-text);

            font-family:
                Georgia,
                "Times New Roman",
                serif;

            font-size: 34px;
            font-weight: 600;
            letter-spacing: -1.2px;
        }


        /* =========================================================
   HERO STORY
   ========================================================= */

        .zeith-news-hero {
            display: grid;
            grid-template-columns: minmax(0, .9fr) minmax(0, 1.1fr);

            min-height: 650px;

            border-bottom: 1px solid var(--zeith-border);
        }


        /* =========================================================
   HERO CONTENT
   ========================================================= */

        .zeith-news-hero-content {
            display: flex;
            flex-direction: column;
            justify-content: center;

            padding: 70px 80px 70px 0;

            border-right: 1px solid var(--zeith-border);
        }

        .zeith-news-category {
            margin-bottom: 18px;

            color: var(--zeith-accent);

            font-size: 11px;
            font-weight: 800;

            letter-spacing: 2.2px;
            text-transform: uppercase;
        }

        .zeith-news-date {
            margin-bottom: 25px;

            color: var(--zeith-muted);

            font-size: 12px;
            font-weight: 500;

            letter-spacing: .4px;
        }

        .zeith-news-hero-title {
            max-width: 720px;

            margin: 0;

            color: var(--zeith-text);

            font-family:
                Georgia,
                "Times New Roman",
                serif;

            font-size: clamp(42px, 5vw, 76px);
            font-weight: 500;

            line-height: .98;
            letter-spacing: -2.8px;
        }

        .zeith-news-hero-description {
            max-width: 570px;

            margin: 28px 0 0;

            color: var(--zeith-muted);

            font-size: 16px;
            line-height: 1.8;
        }


        /* =========================================================
   READ STORY BUTTON
   ========================================================= */

        .zeith-news-read-button {
            width: fit-content;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            margin-top: 35px;
            padding: 14px 23px;

            border: 1px solid var(--zeith-accent);

            background: var(--zeith-accent);
            color: var(--zeith-white);

            font-size: 11px;
            font-weight: 800;

            letter-spacing: 1.3px;
            text-transform: uppercase;

            text-decoration: none;

            transition:
                background .25s ease,
                color .25s ease,
                transform .25s ease,
                box-shadow .25s ease;
        }

        .zeith-news-read-button:hover {
            background: transparent;
            color: var(--zeith-accent);

            transform: translateY(-2px);

            box-shadow: 0 8px 20px rgba(140, 120, 83, .12);
        }


        /* =========================================================
   HERO IMAGE
   ========================================================= */

        .zeith-news-hero-image {
            position: relative;

            min-height: 650px;

            padding: 22px 0 22px 22px;

            overflow: hidden;
        }

        .zeith-news-hero-image::after {
            content: "";

            position: absolute;
            inset: 22px 0 22px 22px;

            border: 1px solid rgba(255, 255, 255, .25);

            pointer-events: none;
        }

        .zeith-news-hero-image img {
            width: 100%;
            height: 100%;

            display: block;

            object-fit: cover;

            transition:
                transform .8s cubic-bezier(.2, .7, .2, 1);
        }

        .zeith-news-hero:hover .zeith-news-hero-image img {
            transform: scale(1.025);
        }


        /* =========================================================
   MAIN CONTENT
   ========================================================= */

        .zeith-news-content {
            display: grid;

            grid-template-columns:
                minmax(0, 1fr) minmax(0, 1fr);

            gap: 0;

            margin-top: 70px;
        }


        /* =========================================================
   FEATURE STORY
   ========================================================= */

        .zeith-feature-story {
            padding-right: 50px;

            border-right: 1px solid var(--zeith-border);
        }

        .zeith-feature-image {
            position: relative;

            width: 100%;
            height: 430px;

            overflow: hidden;

            background: var(--zeith-soft);
        }

        .zeith-feature-image img {
            width: 100%;
            height: 100%;

            display: block;

            object-fit: cover;

            transition:
                transform .7s cubic-bezier(.2, .7, .2, 1);
        }

        .zeith-feature-story:hover .zeith-feature-image img {
            transform: scale(1.035);
        }


        /* =========================================================
   FEATURE LABEL
   ========================================================= */

        .zeith-feature-label {
            position: absolute;
            top: 18px;
            left: 18px;

            z-index: 2;

            padding: 8px 12px;

            background: var(--zeith-bg);
            color: var(--zeith-text);

            font-size: 9px;
            font-weight: 800;

            letter-spacing: 1.5px;
            text-transform: uppercase;
        }


        /* =========================================================
   FEATURE META
   ========================================================= */

        .zeith-story-meta {
            margin-top: 22px;

            color: var(--zeith-accent);

            font-size: 10px;
            font-weight: 700;

            letter-spacing: 1.3px;
            text-transform: uppercase;
        }


        /* =========================================================
   FEATURE TITLE
   ========================================================= */

        .zeith-story-title {
            max-width: 720px;

            margin: 12px 0 0;

            color: var(--zeith-text);

            font-family:
                Georgia,
                "Times New Roman",
                serif;

            font-size: clamp(29px, 3vw, 42px);
            font-weight: 500;

            line-height: 1.08;
            letter-spacing: -1.2px;
        }


        /* =========================================================
   FEATURE EXCERPT
   ========================================================= */

        .zeith-story-excerpt {
            max-width: 650px;

            margin: 17px 0 0;

            color: var(--zeith-muted);

            font-size: 14px;
            line-height: 1.8;
        }


        /* =========================================================
   STORY LINK
   ========================================================= */

        .zeith-story-link {
            position: relative;

            display: inline-block;

            margin-top: 22px;

            color: var(--zeith-text);

            font-size: 11px;
            font-weight: 800;

            letter-spacing: 1.2px;
            text-transform: uppercase;

            text-decoration: none;
        }

        .zeith-story-link::after {
            content: "";

            position: absolute;
            left: 0;
            bottom: -5px;

            width: 100%;
            height: 1px;

            background: var(--zeith-accent);

            transform: scaleX(.25);
            transform-origin: left;

            transition: transform .25s ease;
        }

        .zeith-story-link:hover {
            color: var(--zeith-accent);
        }

        .zeith-story-link:hover::after {
            transform: scaleX(1);
        }


        /* =========================================================
   SIDE STORIES
   ========================================================= */

        .zeith-side-stories {
            padding-left: 50px;
        }


        /* =========================================================
   INDIVIDUAL SIDE STORY
   ========================================================= */

        .zeith-side-story {
            display: grid;

            grid-template-columns: 35px 170px minmax(0, 1fr);

            gap: 20px;

            padding: 0 0 30px;
            margin-bottom: 30px;

            border-bottom: 1px solid var(--zeith-border);
        }

        .zeith-side-story:last-child {
            margin-bottom: 0;
        }


        /* =========================================================
   STORY NUMBER
   ========================================================= */

        .zeith-story-number {
            padding-top: 4px;

            color: var(--zeith-accent);

            font-family:
                Georgia,
                "Times New Roman",
                serif;

            font-size: 15px;
            font-weight: 500;
        }


        /* =========================================================
   SIDE IMAGE
   ========================================================= */

        .zeith-side-image {
            width: 170px;
            height: 125px;

            overflow: hidden;

            background: var(--zeith-soft);
        }

        .zeith-side-image img {
            width: 100%;
            height: 100%;

            display: block;

            object-fit: cover;

            transition:
                transform .55s cubic-bezier(.2, .7, .2, 1);
        }

        .zeith-side-story:hover .zeith-side-image img {
            transform: scale(1.06);
        }


        /* =========================================================
   SIDE CONTENT
   ========================================================= */

        .zeith-side-content {
            min-width: 0;
        }

        .zeith-side-category {
            margin-bottom: 8px;

            color: var(--zeith-accent);

            font-size: 9px;
            font-weight: 800;

            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .zeith-side-title {
            margin: 0;

            color: var(--zeith-text);

            font-family:
                Georgia,
                "Times New Roman",
                serif;

            font-size: 22px;
            font-weight: 500;

            line-height: 1.15;
            letter-spacing: -.5px;
        }

        .zeith-side-excerpt {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;

            overflow: hidden;

            margin: 10px 0 0;

            color: var(--zeith-muted);

            font-size: 12px;
            line-height: 1.6;
        }

        .zeith-side-link {
            display: inline-block;

            margin-top: 12px;

            color: var(--zeith-text);

            font-size: 9px;
            font-weight: 800;

            letter-spacing: 1.2px;
            text-transform: uppercase;

            text-decoration: none;

            transition: color .2s ease;
        }

        .zeith-side-link:hover {
            color: var(--zeith-accent);
        }


        /* =========================================================
   TABLET
   ========================================================= */

        @media (max-width: 1100px) {

            .zeith-news {
                padding-left: 24px;
                padding-right: 24px;
            }

            .zeith-news-hero {
                grid-template-columns: 1fr 1fr;
            }

            .zeith-news-hero-content {
                padding-right: 45px;
            }

            .zeith-news-hero-title {
                font-size: clamp(40px, 5vw, 60px);
            }

            .zeith-feature-story {
                padding-right: 30px;
            }

            .zeith-side-stories {
                padding-left: 30px;
            }

            .zeith-side-story {
                grid-template-columns: 25px 130px minmax(0, 1fr);
                gap: 14px;
            }

            .zeith-side-image {
                width: 130px;
                height: 105px;
            }

            .zeith-side-title {
                font-size: 19px;
            }

        }


        /* =========================================================
   TABLET / IPAD PORTRAIT
   ========================================================= */

        @media (max-width: 850px) {

            .zeith-news {
                padding-left: 20px;
                padding-right: 20px;
            }

            .zeith-news-header {
                min-height: 82px;
            }

            .zeith-news-logo-main {
                font-size: 30px;
            }

            .zeith-news-hero {
                grid-template-columns: 1fr;

                min-height: auto;
            }

            .zeith-news-hero-content {
                padding: 55px 0 45px;

                border-right: none;
                border-bottom: 1px solid var(--zeith-border);
            }

            .zeith-news-hero-title {
                max-width: 700px;

                font-size: clamp(42px, 9vw, 64px);
            }

            .zeith-news-hero-description {
                max-width: 650px;
            }

            .zeith-news-hero-image {
                height: 500px;
                min-height: 0;

                padding: 18px 0;
            }

            .zeith-news-hero-image::after {
                inset: 18px 0;
            }

            .zeith-news-content {
                grid-template-columns: 1fr;

                margin-top: 55px;
            }

            .zeith-feature-story {
                padding-right: 0;

                padding-bottom: 50px;

                border-right: none;
                border-bottom: 1px solid var(--zeith-border);
            }

            .zeith-feature-image {
                height: 420px;
            }

            .zeith-side-stories {
                padding-left: 0;
                padding-top: 45px;
            }

        }


        /* =========================================================
   MOBILE
   ========================================================= */

        @media (max-width: 600px) {

            .zeith-news {
                padding:
                    0 16px 65px;
            }

            .zeith-news-header {
                min-height: 72px;
            }

            .zeith-news-logo-small {
                font-size: 11px;
            }

            .zeith-news-logo-main {
                font-size: 26px;
            }

            .zeith-news-hero-content {
                padding:
                    45px 0 38px;
            }

            .zeith-news-category {
                font-size: 9px;
                letter-spacing: 1.7px;
            }

            .zeith-news-date {
                font-size: 10px;
                margin-bottom: 19px;
            }

            .zeith-news-hero-title {
                font-size: 42px;
                line-height: 1;
                letter-spacing: -1.7px;
            }

            .zeith-news-hero-description {
                margin-top: 22px;

                font-size: 13px;
                line-height: 1.75;
            }

            .zeith-news-read-button {
                width: 100%;

                margin-top: 27px;
                padding: 14px 18px;
            }

            .zeith-news-hero-image {
                height: 380px;
            }

            .zeith-news-content {
                margin-top: 42px;
            }

            .zeith-feature-image {
                height: 300px;
            }

            .zeith-story-meta {
                font-size: 9px;
            }

            .zeith-story-title {
                font-size: 29px;
            }

            .zeith-story-excerpt {
                font-size: 13px;
            }

            .zeith-side-stories {
                padding-top: 38px;
            }

            .zeith-side-story {
                grid-template-columns: 25px 105px minmax(0, 1fr);

                gap: 12px;

                padding-bottom: 24px;
                margin-bottom: 24px;
            }

            .zeith-side-image {
                width: 105px;
                height: 92px;
            }

            .zeith-side-category {
                font-size: 8px;
            }

            .zeith-side-title {
                font-size: 17px;
                line-height: 1.15;
            }

            .zeith-side-excerpt {
                font-size: 11px;

                -webkit-line-clamp: 2;
            }

            .zeith-side-link {
                font-size: 8px;
            }

        }


        /* =========================================================
   VERY SMALL MOBILE
   ========================================================= */

        @media (max-width: 400px) {

            .zeith-news-hero-title {
                font-size: 37px;
            }

            .zeith-news-hero-image {
                height: 320px;
            }

            .zeith-feature-image {
                height: 260px;
            }

            .zeith-side-story {
                grid-template-columns: 20px 90px minmax(0, 1fr);

                gap: 9px;
            }

            .zeith-side-image {
                width: 90px;
                height: 82px;
            }

            .zeith-side-title {
                font-size: 15px;
            }

        }


        /* =========================================================
   ACCESSIBILITY / REDUCED MOTION
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

    <section class="zeith-news">
        <div class="zeith-news-container">

            <!-- HEADER -->
            <header class="zeith-news-header">
                <a href="/Watch_Collection/" class="zeith-news-logo">
                    <span class="zeith-news-logo-small">Zeith's</span>
                    <span class="zeith-news-logo-main">News</span>
                </a>
            </header>

            <!-- HERO STORY -->
            <section class="zeith-news-hero">
                <div class="zeith-news-hero-content">
                    <div class="zeith-news-category">
                        <?= htmlspecialchars($featured['category'] ?? 'FEATURED STORY') ?>
                    </div>
                    <div class="zeith-news-date">
                        <?= date('F j, Y', strtotime($featured['created_at'] ?? 'now')) ?> &nbsp;&nbsp; Zeith Editorial
                    </div>
                    <h1 class="zeith-news-hero-title">
                        <?= htmlspecialchars($featured['title']) ?>
                    </h1>
                    <p class="zeith-news-hero-description">
                        <?= htmlspecialchars($featured['summary']) ?>
                    </p>
                    <!-- Hero & Feature Story Links -->
                    <a href="/Watch_Collection/news/<?= htmlspecialchars($featured['slug'] ?? 'fury-vs-usyk') ?>" class="zeith-news-read-button">
                        Read Full Story
                    </a>
                </div>

                <div class="zeith-news-hero-image">
                    <img src="/Watch_Collection/assets/image/<?= htmlspecialchars($featured['image_url']) ?>" alt="Zeith luxury watch editorial">
                </div>
            </section>

            <!-- MAIN CONTENT -->
            <main class="zeith-news-content">

                <!-- FEATURE STORY (Secondary display box) -->
                <article class="zeith-feature-story">
                    <div class="zeith-feature-image">
                        <span class="zeith-feature-label">Feature Story</span>
                        <img src="/Watch_Collection/assets/image/<?= htmlspecialchars($featured['image_url']) ?>" alt="Zeith watch feature">
                    </div>
                    <div class="zeith-story-meta">
                        <?= date('F j, Y', strtotime($featured['created_at'] ?? 'now')) ?> &nbsp;&nbsp; Zeith Editorial
                    </div>
                    <h2 class="zeith-story-title">
                        <?= htmlspecialchars($featured['title']) ?>
                    </h2>
                    <p class="zeith-story-excerpt">
                        <?= htmlspecialchars($featured['summary']) ?>
                    </p>
                    <a href="/Watch_Collection/news/<?= htmlspecialchars($featured['slug'] ?? 'fury-vs-usyk') ?>" class="zeith-story-link">
                        Read Full Story
                    </a>
                </article>

                <!-- SIDE STORIES -->
                <div class="zeith-side-stories">
                    <?php if (!empty($sideStories)): ?>
                        <?php foreach ($sideStories as $index => $story): ?>
                            <article class="zeith-side-story">
                                <div class="zeith-story-number">
                                    <?= $index + 1 ?>
                                </div>
                                <div class="zeith-side-image">
                                    <img src="/Watch_Collection/assets/image/<?= htmlspecialchars($story['image_url']) ?>" alt="Watch story">
                                </div>
                                <div class="zeith-side-content">
                                    <div class="zeith-side-category">
                                        <?= htmlspecialchars($story['category']) ?>
                                    </div>
                                    <h3 class="zeith-side-title">
                                        <?= htmlspecialchars($story['title']) ?>
                                    </h3>
                                    <p class="zeith-side-excerpt">
                                        <?= htmlspecialchars($story['summary']) ?>
                                    </p>
                                    <a href="/Watch_Collection/news/<?= htmlspecialchars($story['slug']) ?>" class="zeith-side-link">
                                        Read Full Story
                                    </a>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

            </main>

        </div>
    </section>

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