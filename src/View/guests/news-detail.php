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
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background: #111111;
            color: #e5e7eb;
            font-family: Arial, Helvetica, sans-serif;
            line-height: 1.7;
        }

        .article-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 60px 20px 80px;
        }

        .back-link {
            display: inline-block;
            color: #f68b1e;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            text-decoration: none;
            margin-bottom: 30px;
            transition: opacity 0.2s;
        }

        .back-link:hover {
            opacity: 0.8;
        }

        .article-category {
            color: #f68b1e;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .article-title {
            font-family: Georgia, "Times New Roman", serif;
            font-size: clamp(32px, 4vw, 52px);
            color: #ffffff;
            line-height: 1.15;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        .article-meta {
            display: flex;
            align-items: center;
            gap: 15px;
            color: #9ca3af;
            font-size: 13px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding-bottom: 25px;
            margin-bottom: 35px;
        }

        .article-hero-image {
            width: 100%;
            max-height: 500px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 40px;
            background: #222;
        }

        .article-content {
            font-size: 18px;
            color: #d1d5db;
            line-height: 1.8;
        }

        .article-content p {
            margin-bottom: 24px;
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