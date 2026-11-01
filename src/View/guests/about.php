<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ZEITH — Our Story</title>

    <style>
        /* =========================================================
           ZEITH — OUR STORY PAGE
        ========================================================= */

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

        img {
            display: block;
            width: 100%;
        }

        a {
            color: inherit;
            text-decoration: none;
        }


        /* =========================================================
           MAIN WRAPPER
        ========================================================= */

        .zeith-story-page {
            width: 100%;
            min-height: 100vh;
            background: #111111;
            overflow: hidden;
        }

        .zeith-story-container {
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 58px;
        }


        /* =========================================================
           HEADER
        ========================================================= */

        .zeith-story-header {
            height: 75px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            border-top: 1px solid rgba(255, 255, 255, .08);
            border-bottom: 1px solid rgba(255, 255, 255, .10);
        }


        /* LOGO */

        .zeith-story-logo {
            display: flex;
            flex-direction: column;

            line-height: 1;
        }

        .zeith-story-logo-small {
            color: #d0d0d0;

            font-size: 9px;
            font-weight: 600;

            letter-spacing: 1.8px;
            text-transform: uppercase;

            margin-bottom: 4px;
        }

        .zeith-story-logo-main {
            color: #ffffff;

            font-family: Georgia, "Times New Roman", serif;

            font-size: 22px;
            font-weight: 700;

            letter-spacing: -0.7px;
        }


        /* NAVIGATION */

        .zeith-story-nav {
            display: flex;
            align-items: center;
            gap: 27px;
        }

        .zeith-story-nav a {
            position: relative;

            color: #bdbdbd;

            font-size: 11px;
            font-weight: 400;

            transition: color .25s ease;
        }

        .zeith-story-nav a::after {
            content: "";

            position: absolute;

            left: 0;
            bottom: -14px;

            width: 0;
            height: 1px;

            background: #f68b1e;

            transition: width .25s ease;
        }

        .zeith-story-nav a:hover,
        .zeith-story-nav a.active {
            color: #ffffff;
        }

        .zeith-story-nav a:hover::after,
        .zeith-story-nav a.active::after {
            width: 100%;
        }


        /* HEADER ICONS */

        .zeith-story-actions {
            display: flex;
            align-items: center;
            gap: 17px;
        }

        .zeith-story-action {
            width: 18px;
            height: 18px;

            display: flex;
            align-items: center;
            justify-content: center;

            color: #ffffff;
        }

        .zeith-story-action svg {
            width: 18px;
            height: 18px;

            fill: none;
            stroke: currentColor;
            stroke-width: 1.5;
        }


        /* =========================================================
           BREADCRUMB
        ========================================================= */

        .zeith-story-breadcrumb {
            height: 35px;

            display: flex;
            align-items: center;

            border-bottom: 1px solid rgba(255, 255, 255, .07);

            color: #777777;

            font-size: 8px;
        }

        .zeith-story-breadcrumb span {
            color: #b5b5b5;
        }


        /* =========================================================
           HERO
        ========================================================= */

        .zeith-story-hero {
            position: relative;

            height: 155px;

            display: flex;
            align-items: center;
            justify-content: center;

            overflow: hidden;

            background: #151515;
        }

        .zeith-story-hero-image {
            position: absolute;
            inset: 0;

            width: 100%;
            height: 100%;

            object-fit: cover;

            opacity: .65;
        }

        .zeith-story-hero::after {
            content: "";

            position: absolute;
            inset: 0;

            background:
                linear-gradient(90deg,
                    rgba(17, 17, 17, .98) 0%,
                    rgba(17, 17, 17, .72) 35%,
                    rgba(17, 17, 17, .15) 100%);
        }

        .zeith-story-hero-content {
            position: relative;
            z-index: 2;

            text-align: center;
        }


        /* ZEITH MARK */

        .zeith-story-mark {
            margin-bottom: 8px;

            color: #e6e1d4;

            font-family: Georgia, "Times New Roman", serif;

            font-size: 26px;
            line-height: 1;
        }

        .zeith-story-hero-title {
            color: #e8e3d8;

            font-family: Georgia, "Times New Roman", serif;

            font-size: 32px;
            font-weight: 400;

            letter-spacing: -.8px;
            text-transform: uppercase;
        }


        /* =========================================================
           MAIN STORY AREA
        ========================================================= */

        .zeith-story-main {
            display: grid;

            grid-template-columns: 47% 26% 27%;

            gap: 12px;

            padding: 15px 0 20px;

            border-bottom: 1px solid rgba(255, 255, 255, .10);
        }


        /* =========================================================
           FOUNDER IMAGE
        ========================================================= */

        .zeith-founder-image {
            position: relative;

            height: 190px;

            overflow: hidden;

            background: #202020;
        }

        .zeith-founder-image img {
            width: 100%;
            height: 100%;

            object-fit: cover;
        }

        .zeith-founder-caption {
            position: absolute;

            left: 8px;
            bottom: 5px;

            color: #e6e0d2;

            font-family: Georgia, "Times New Roman", serif;

            font-size: 21px;
            font-weight: 400;

            text-transform: uppercase;
        }


        /* =========================================================
           FOUNDATION
        ========================================================= */

        .zeith-foundation {
            padding: 2px 5px;
        }

        .zeith-section-title {
            margin-bottom: 9px;

            color: #dcd5c7;

            font-family: Georgia, "Times New Roman", serif;

            font-size: 19px;
            font-weight: 400;
        }

        .zeith-foundation p {
            margin-bottom: 8px;

            color: #a8a8a8;

            font-size: 10px;
            line-height: 1.48;
        }


        /* =========================================================
           SOCIAL / SMALL ICONS
        ========================================================= */

        .zeith-small-icons {
            display: flex;
            gap: 12px;

            margin-top: 13px;
        }

        .zeith-small-icons span {
            width: 17px;
            height: 17px;

            display: flex;
            align-items: center;
            justify-content: center;

            border: 1px solid #777777;
            border-radius: 3px;

            color: #bcbcbc;

            font-size: 8px;
        }


        /* =========================================================
           TEAM
        ========================================================= */

        .zeith-team {
            padding-left: 4px;
        }

        .zeith-team-title {
            margin-bottom: 8px;

            color: #dcd5c7;

            font-family: Georgia, "Times New Roman", serif;

            font-size: 19px;
            font-weight: 400;
        }

        .zeith-team-member {
            display: grid;

            grid-template-columns: 60px 1fr;

            gap: 9px;

            margin-bottom: 8px;
        }

        .zeith-team-image {
            width: 60px;
            height: 57px;

            overflow: hidden;

            background: #222222;
        }

        .zeith-team-image img {
            width: 100%;
            height: 100%;

            object-fit: cover;
        }

        .zeith-team-role {
            margin-bottom: 2px;

            color: #b89b63;

            font-size: 8px;
            font-weight: 600;

            text-transform: uppercase;
        }

        .zeith-team-name {
            margin-bottom: 3px;

            color: #e1e1e1;

            font-family: Georgia, "Times New Roman", serif;

            font-size: 12px;
        }

        .zeith-team-description {
            color: #858585;

            font-size: 7.5px;
            line-height: 1.35;

            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;

            overflow: hidden;
        }


        /* =========================================================
           CONTACT / INFORMATION STRIP
        ========================================================= */

        .zeith-info-strip {
            display: grid;

            grid-template-columns: 1fr 1fr 1fr 1.25fr;

            gap: 35px;

            padding: 17px 0;

            border-bottom: 1px solid rgba(255, 255, 255, .10);
        }

        .zeith-info-item h4 {
            margin-bottom: 7px;

            color: #b89b63;

            font-family: Georgia, "Times New Roman", serif;

            font-size: 10px;
            font-weight: 400;

            text-transform: uppercase;
        }

        .zeith-info-item p {
            color: #9b9b9b;

            font-size: 8.5px;
            line-height: 1.45;
        }


        /* =========================================================
           NEWSLETTER
        ========================================================= */

        .zeith-newsletter {
            display: flex;
            align-items: center;

            width: 100%;
            height: 27px;

            border: 1px solid #303030;
            background: #191919;
        }

        .zeith-newsletter input {
            flex: 1;

            min-width: 0;

            height: 100%;

            padding: 0 9px;

            border: none;
            outline: none;

            background: transparent;

            color: #ffffff;

            font-size: 8px;
        }

        .zeith-newsletter input::placeholder {
            color: #686868;
        }

        .zeith-newsletter button {
            width: 30px;
            height: 100%;

            border: none;
            background: transparent;

            color: #a7a7a7;

            cursor: pointer;

            font-size: 13px;
        }

        .zeith-newsletter button:hover {
            color: #f68b1e;
        }


        /* =========================================================
           FOOTER
        ========================================================= */

        .zeith-story-footer {
            padding: 17px 0 18px;
        }

        .zeith-footer-top {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
        }

        .zeith-footer-brand {
            color: #e2e2e2;

            font-family: Georgia, "Times New Roman", serif;

            font-size: 17px;
        }

        .zeith-footer-links {
            display: flex;
            gap: 17px;

            margin-top: 9px;
        }

        .zeith-footer-links a {
            color: #858585;

            font-size: 7.5px;

            transition: color .2s ease;
        }

        .zeith-footer-links a:hover {
            color: #f68b1e;
        }


        /* SOCIALS */

        .zeith-footer-right {
            text-align: right;
        }

        .zeith-socials {
            display: flex;
            justify-content: flex-end;

            gap: 13px;

            margin-bottom: 8px;
        }

        .zeith-socials a {
            color: #a6a6a6;

            font-size: 10px;
            font-weight: 600;
        }

        .zeith-socials a:hover {
            color: #f68b1e;
        }

        .zeith-copyright {
            color: #737373;

            font-size: 7.5px;
        }


        /* =========================================================
           TABLET
        ========================================================= */

        @media (max-width: 950px) {

            .zeith-story-container {
                padding: 0 30px;
            }

            .zeith-story-nav {
                gap: 16px;
            }

            .zeith-story-main {
                grid-template-columns: 1fr 1fr;
            }

            .zeith-founder-image {
                grid-column: 1 / 2;
            }

            .zeith-foundation {
                grid-column: 2 / 3;
            }

            .zeith-team {
                grid-column: 1 / -1;
            }

            .zeith-team-member {
                max-width: 400px;
            }

            .zeith-info-strip {
                grid-template-columns: 1fr 1fr;
                row-gap: 20px;
            }
        }


        /* =========================================================
           MOBILE
        ========================================================= */

        @media (max-width: 700px) {

            .zeith-story-container {
                padding: 0 18px;
            }

            .zeith-story-header {
                height: auto;

                padding: 18px 0;

                flex-wrap: wrap;
                gap: 16px;
            }

            .zeith-story-nav {
                order: 3;

                width: 100%;

                overflow-x: auto;

                justify-content: flex-start;

                padding-bottom: 4px;
            }

            .zeith-story-nav a {
                white-space: nowrap;
            }

            .zeith-story-hero {
                height: 210px;
            }

            .zeith-story-hero-title {
                font-size: 29px;
            }

            .zeith-story-main {
                grid-template-columns: 1fr;
            }

            .zeith-founder-image,
            .zeith-foundation,
            .zeith-team {
                grid-column: auto;
            }

            .zeith-founder-image {
                height: 260px;
            }

            .zeith-section-title,
            .zeith-team-title {
                font-size: 23px;
            }

            .zeith-foundation p {
                font-size: 12px;
            }

            .zeith-team-member {
                max-width: none;
            }

            .zeith-info-strip {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .zeith-footer-top {
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


        /* =========================================================
           SMALL MOBILE
        ========================================================= */

        @media (max-width: 450px) {

            .zeith-story-hero {
                height: 180px;
            }

            .zeith-story-hero-title {
                font-size: 25px;
            }

            .zeith-founder-image {
                height: 220px;
            }

            .zeith-founder-caption {
                font-size: 18px;
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



    <section class="zeith-story-page">

        <div class="zeith-story-container">

            <section class="zeith-story-hero">

                <img
                    class="zeith-story-hero-image"
                    src="assets/image/banner/banner1.jpg"
                    alt="Zeith luxury watch">

                <div class="zeith-story-hero-content">

                    <div class="zeith-story-mark">
                        ZEITH
                    </div>

                    <h1 class="zeith-story-hero-title">
                        Our Mission
                    </h1>

                </div>

            </section>


            <!-- =====================================================
             MAIN STORY
        ====================================================== -->

            <section class="zeith-story-main">


                <!-- FOUNDER / CRAFTSMAN -->

                <div class="zeith-founder-image">

                    <img
                        src="assets/image/banner/banner2.jpg"
                        alt="Zeith watchmaker crafting a timepiece">

                    <div class="zeith-founder-caption">
                        Crafting Tradition
                    </div>

                </div>


                <!-- FOUNDATION -->

                <div class="zeith-foundation">

                    <h2 class="zeith-section-title">
                        Our Foundation
                    </h2>

                    <p>
                        Our legacy is a desire to create watches that
                        combine timeless design, precision and appreciation
                        for the art of horology.
                    </p>

                    <p>
                        We believe every timepiece should represent
                        craftsmanship, reliability and an enduring sense
                        of sophistication.
                    </p>

                    <p>
                        From carefully selected materials to the smallest
                        detail, every Zeith watch is created with purpose.
                    </p>


                    <div class="zeith-small-icons">

                        <span>◎</span>
                        <span>♜</span>

                    </div>

                </div>


                <!-- TEAM -->

                <div class="zeith-team">

                    <h2 class="zeith-team-title">
                        Our Team
                    </h2>


                    <!-- MEMBER 1 -->

                    <div class="zeith-team-member">

                        <div class="zeith-team-image">

                            <img
                                src="assets/image/banner/banner3.jpg"
                                alt="Zeith founder">

                        </div>

                        <div>

                            <div class="zeith-team-role">
                                Founder
                            </div>

                            <div class="zeith-team-name">
                                Nweze Chibuikem
                            </div>

                            <p class="zeith-team-description">
                                Founder and creative director of Zeith,
                                responsible for the vision behind our
                                watch collections.
                            </p>

                        </div>

                    </div>


                    <!-- MEMBER 2 -->

                    <div class="zeith-team-member">

                        <div class="zeith-team-image">

                            <img
                                src="assets/image/banner/banner4.jpg"
                                alt="Zeith creative director">

                        </div>

                        <div>

                            <div class="zeith-team-role">
                                Head of Curation
                            </div>

                            <div class="zeith-team-name">
                                Mr. Chisom
                            </div>

                            <p class="zeith-team-description">
                                Curating collections that bring together
                                timeless aesthetics and modern watchmaking.
                            </p>

                        </div>

                    </div>

                </div>

            </section>


            <!-- =====================================================
             INFORMATION STRIP
        ====================================================== -->

            <section class="zeith-info-strip">


                <!-- CONTACT -->

                <div class="zeith-info-item">

                    <h4>
                        Contact Us
                    </h4>

                    <p>
                        The Zeith Watch Company<br>
                        The Zeith Watch Culture
                    </p>

                </div>


                <!-- ADDRESS -->

                <div class="zeith-info-item">

                    <h4>
                        Contact Us
                    </h4>

                    <p>
                        23 Statement Street<br>
                        Benin City, Nigeria
                    </p>

                </div>


                <!-- HERITAGE -->

                <div class="zeith-info-item">

                    <h4>
                        Heritages
                    </h4>

                    <p>
                        zeithwatches.com<br>
                        email@zeithwatches.com
                    </p>

                </div>


                <!-- NEWSLETTER -->

                <div class="zeith-info-item">

                    <h4>
                        Newsletter Signup
                    </h4>

                    <form class="zeith-newsletter">

                        <input
                            type="email"
                            placeholder="Enter your email">

                        <button type="submit">
                            →
                        </button>

                    </form>

                </div>

            </section>


            <!-- =====================================================
             FOOTER
        ====================================================== -->

            <footer class="zeith-story-footer">

                <div class="zeith-footer-top">


                    <div>

                        <div class="zeith-footer-brand">
                            THE ZEITH CHRONICLE
                        </div>

                        <div class="zeith-footer-links">
                            <a href="/Zeith/contact">Contact Us</a>
                        </div>

                    </div>


                    <div class="zeith-footer-right">

                        <div class="zeith-socials">

                            <a href="#">IG</a>
                            <a href="#">IN</a>
                            <a href="#">FB</a>

                        </div>

                        <div class="zeith-copyright">
                            © 2026 Zeith Watches. All Rights Reserved.
                        </div>

                    </div>

                </div>

            </footer>

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