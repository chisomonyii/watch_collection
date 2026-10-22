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
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #111111;
            color: #ffffff;
            font-family: Arial, Helvetica, sans-serif;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        img {
            width: 100%;
            display: block;
        }

        .zeith-news {
            width: 100%;
            min-height: 100vh;
            background: #111111;
            color: #ffffff;
            overflow: hidden;
        }

        .zeith-news-container {
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 60px;
        }

        .zeith-news-header {
            height: 88px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid rgba(255, 255, 255, 0.12);
        }

        .zeith-news-logo {
            display: flex;
            flex-direction: column;
            line-height: 1;
        }

        .zeith-news-logo-small {
            color: #bdbdbd;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .zeith-news-logo-main {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 27px;
            font-weight: 700;
            letter-spacing: -1px;
        }

        .zeith-news-hero {
            position: relative;
            display: grid;
            grid-template-columns: 48% 52%;
            min-height: 400px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.12);
        }

        .zeith-news-hero-content {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 55px 45px 55px 0;
        }

        .zeith-news-category {
            display: inline-flex;
            align-items: center;
            width: fit-content;
            margin-bottom: 14px;
            color: #f68b1e;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .zeith-news-date {
            margin-bottom: 10px;
            color: #8d8d8d;
            font-size: 11px;
            letter-spacing: 0.5px;
        }

        .zeith-news-hero-title {
            max-width: 620px;
            margin-bottom: 14px;
            font-family: Georgia, "Times New Roman", serif;
            font-size: clamp(35px, 4vw, 58px);
            font-weight: 400;
            line-height: 0.98;
            letter-spacing: -1.8px;
            text-transform: uppercase;
        }

        .zeith-news-hero-description {
            max-width: 570px;
            margin-bottom: 25px;
            color: #bcbcbc;
            font-size: 14px;
            line-height: 1.65;
        }

        .zeith-news-read-button {
            width: fit-content;
            display: inline-flex;
            align-items: center;
            padding: 11px 17px;
            background: #f68b1e;
            color: #111111;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            transition: background 0.25s ease, transform 0.25s ease;
        }

        .zeith-news-read-button:hover {
            background: #ffffff;
            transform: translateY(-2px);
        }

        .zeith-news-hero-image {
            position: relative;
            min-height: 400px;
            overflow: hidden;
            background: #1a1a1a;
        }

        .zeith-news-hero-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.7s ease;
        }

        .zeith-news-hero:hover .zeith-news-hero-image img {
            transform: scale(1.025);
        }

        .zeith-news-content {
            display: grid;
            grid-template-columns: 47% 53%;
            gap: 30px;
            padding: 28px 0 45px;
        }

        .zeith-feature-story {
            min-width: 0;
        }

        .zeith-feature-image {
            position: relative;
            height: 285px;
            overflow: hidden;
            background: #222222;
        }

        .zeith-feature-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .zeith-feature-story:hover .zeith-feature-image img {
            transform: scale(1.035);
        }

        .zeith-feature-label {
            position: absolute;
            top: 0;
            left: 0;
            padding: 9px 13px;
            background: #f68b1e;
            color: #111111;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            z-index: 2;
        }

        .zeith-story-meta {
            margin-top: 12px;
            margin-bottom: 9px;
            color: #8d8d8d;
            font-size: 10px;
        }

        .zeith-story-title {
            margin-bottom: 9px;
            font-family: Georgia, "Times New Roman", serif;
            font-size: clamp(25px, 2.4vw, 36px);
            font-weight: 400;
            line-height: 1.02;
            text-transform: uppercase;
        }

        .zeith-story-excerpt {
            max-width: 620px;
            margin-bottom: 13px;
            color: #a9a9a9;
            font-size: 12px;
            line-height: 1.55;
        }

        .zeith-story-link {
            display: inline-flex;
            color: #ffffff;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.7px;
            text-transform: uppercase;
            border-bottom: 1px solid #f68b1e;
            padding-bottom: 3px;
            transition: color 0.25s ease;
        }

        .zeith-story-link:hover {
            color: #f68b1e;
        }

        .zeith-side-stories {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .zeith-side-story {
            display: grid;
            grid-template-columns: 36px 145px 1fr;
            gap: 12px;
            min-height: 85px;
            padding-bottom: 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.11);
        }

        .zeith-side-story:last-child {
            border-bottom: none;
        }

        .zeith-story-number {
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f68b1e;
            color: #111111;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 15px;
        }

        .zeith-side-image {
            width: 145px;
            height: 82px;
            overflow: hidden;
            background: #222222;
        }

        .zeith-side-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.45s ease;
        }

        .zeith-side-story:hover .zeith-side-image img {
            transform: scale(1.06);
        }

        .zeith-side-content {
            min-width: 0;
        }

        .zeith-side-category {
            margin-bottom: 4px;
            color: #f68b1e;
            font-size: 8px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .zeith-side-title {
            margin-bottom: 5px;
            color: #ffffff;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 17px;
            font-weight: 400;
            line-height: 1.05;
            text-transform: uppercase;
        }

        .zeith-side-excerpt {
            color: #858585;
            font-size: 10px;
            line-height: 1.35;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .zeith-side-link {
            display: inline-block;
            margin-top: 5px;
            color: #ffffff;
            font-size: 8px;
            font-weight: 700;
            letter-spacing: 0.6px;
            text-transform: uppercase;
        }

        .zeith-side-link:hover {
            color: #f68b1e;
        }

        .zeith-news-footer {
            border-top: 1px solid rgba(255, 255, 255, 0.12);
            padding: 25px 0;
        }

        .zeith-footer-inner {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
        }

        .zeith-footer-brand {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 21px;
            letter-spacing: -0.5px;
        }

        .zeith-footer-links {
            display: flex;
            gap: 20px;
            margin-top: 12px;
        }

        .zeith-footer-links a {
            color: #888888;
            font-size: 9px;
            transition: color 0.25s ease;
        }

        .zeith-footer-links a:hover {
            color: #f68b1e;
        }

        .zeith-footer-right {
            text-align: right;
        }

        .zeith-socials {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-bottom: 10px;
        }

        .zeith-socials a {
            color: #b8b8b8;
            font-size: 12px;
            font-weight: 600;
            transition: color 0.25s ease;
        }

        .zeith-socials a:hover {
            color: #f68b1e;
        }

        .zeith-copyright {
            color: #777777;
            font-size: 9px;
        }

        @media (max-width: 1000px) {
            .zeith-news-container {
                padding: 0 35px;
            }

            .zeith-news-hero {
                grid-template-columns: 1fr 1fr;
            }

            .zeith-news-hero-title {
                font-size: 39px;
            }

            .zeith-news-content {
                grid-template-columns: 1fr;
            }

            .zeith-feature-image {
                height: 360px;
            }
        }

        @media (max-width: 750px) {
            .zeith-news-container {
                padding: 0 20px;
            }

            .zeith-news-header {
                height: auto;
                padding: 18px 0;
            }

            .zeith-news-hero {
                display: flex;
                flex-direction: column-reverse;
            }

            .zeith-news-hero-image {
                height: 280px;
                min-height: 280px;
            }

            .zeith-news-hero-content {
                padding: 35px 0 40px;
            }

            .zeith-news-hero-title {
                font-size: 38px;
            }

            .zeith-feature-image {
                height: 280px;
            }

            .zeith-side-story {
                grid-template-columns: 30px 110px 1fr;
            }

            .zeith-side-image {
                width: 110px;
                height: 75px;
            }

            .zeith-footer-inner {
                flex-direction: column;
                align-items: flex-start;
                gap: 25px;
            }

            .zeith-footer-right {
                text-align: left;
            }

            .zeith-socials {
                justify-content: flex-start;
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