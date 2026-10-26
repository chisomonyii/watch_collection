<section class="collections">

    <style>
        /* ===============================
           ZEITH COLLECTIONS SECTION
        =============================== */

        .collections {
            width: 100%;
            padding: 80px 5.5%;
            background: #f5f4f0;
            overflow: hidden;
        }

        .collections,
        .collections * {
            box-sizing: border-box;
        }

        /* SECTION HEADING */

        .collections .section-heading {
            text-align: center;
            margin-bottom: 75px;
        }

        .collections .section-heading p {
            color: #003b2f;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 4px;
            margin-bottom: 24px;
        }

        .collections .section-heading h2 {
            color: #003b2f;
            font-size: clamp(32px, 4vw, 49px);
            font-weight: 300;
            letter-spacing: -1.5px;
            line-height: 1.2;
        }

        /* COLLECTION GRID */

        .collections .collection-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 28px;
            align-items: stretch;
            perspective: 1000px;
        }

        /* COLLECTION CARD */

        .collections .collection-card {
            position: relative;
            height: 560px;
            min-width: 0;
            overflow: hidden;
            border-radius: 5px;
            background: #dcdcdc;
            isolation: isolate;

            transform: perspective(1000px) rotate(-6deg);
            transform-style: preserve-3d;
            transform-origin: center center;

            transition:
                transform 0.65s cubic-bezier(0.2, 0.75, 0.25, 1),
                box-shadow 0.65s ease;

            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.04);
        }

        /* Alternate tilt for a more editorial appearance */

        .collections .collection-card:nth-child(2) {
            transform: perspective(1000px) rotate(0deg);
            z-index: 2;
        }

        .collections .collection-card:nth-child(3) {
            transform: perspective(1000px) rotate(6deg);
        }

        /* STRAIGHTEN AND LIFT ON HOVER */

        .collections .collection-card:hover {
            transform: perspective(1000px) rotate(0deg) translateY(-10px);
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.16);
            z-index: 5;
        }

        /* WATCH IMAGE */

        .collections .collection-card>img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            display: block;
            object-fit: cover;
            object-position: center;
            transition: transform 0.8s ease;
            z-index: -2;
        }

        .collections .collection-card:hover>img {
            transform: scale(1.055);
        }

        /* BOTTOM GRADIENT OVERLAY */

        .collections .collection-card::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom,
                    rgba(0, 0, 0, 0) 25%,
                    rgba(0, 0, 0, 0.12) 45%,
                    rgba(0, 0, 0, 0.60) 72%,
                    rgba(0, 0, 0, 0.85) 100%);
            z-index: -1;
            pointer-events: none;
        }

        /* CARD CONTENT */

        .collections .collection-content {
            position: absolute;
            left: 32px;
            right: 25px;
            bottom: 34px;
            color: #ffffff;
            transform: translateZ(25px);
        }

        .collections .collection-content p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 14px;
            font-weight: 400;
            margin-bottom: 25px;
        }

        .collections .collection-content h3 {
            font-size: clamp(25px, 2.2vw, 34px);
            font-weight: 300;
            line-height: 1.2;
            margin-bottom: 14px;
            color: #ffffff;
        }

        .collections .collection-content span {
            display: block;
            color: rgba(255, 255, 255, 0.78);
            font-size: 15px;
            font-weight: 300;
            margin-bottom: 25px;
        }

        /* EXPLORE BUTTON */

        .collections .collection-content .search-btn.exp {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            min-width: 135px;
            padding: 8px 25px;
            border-radius: 30px;
            background: #f68b1e;
            color: #003b2f;
            text-decoration: none;
            font-size: 15px;
            font-weight: 700;
            line-height: 1.2;
            border: 1px solid #f68b1e;
            transition:
                background 0.3s ease,
                color 0.3s ease,
                transform 0.3s ease;
        }

        .collections .collection-content .search-btn.exp:hover {
            background: #003b2f;
            color: #ffffff;
            border-color: #003b2f;
            transform: translateY(-3px);
        }

        /* ===============================
           TABLET / IPAD
        =============================== */

        @media (max-width: 1024px) {
            .collections {
                padding: 65px 5%;
            }

            .collections .section-heading {
                margin-bottom: 55px;
            }

            .collections .collection-grid {
                gap: 22px;
            }

            .collections .collection-card {
                height: 450px;
            }

            .collections .collection-content {
                left: 22px;
                right: 18px;
                bottom: 25px;
            }

            .collections .collection-content p {
                margin-bottom: 18px;
            }

            .collections .collection-content span {
                font-size: 13px;
                margin-bottom: 20px;
            }

            .collections .collection-content .search-btn.exp {
                min-width: 115px;
                padding: 8px 20px;
                font-size: 13px;
            }
        }

        /* ===============================
           SMALL TABLETS
        =============================== */

        @media (max-width: 768px) {
            .collections {
                padding: 55px 6%;
            }

            .collections .section-heading {
                margin-bottom: 45px;
            }

            .collections .collection-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 28px 20px;
            }

            .collections .collection-card {
                height: 420px;
            }

            /* Keep the third card centered on the second row */

            .collections .collection-card:nth-child(3) {
                grid-column: 1 / -1;
                width: 65%;
                justify-self: center;
                transform: perspective(1000px) rotate(-3deg);
            }

            .collections .collection-card:nth-child(3):hover {
                transform: perspective(1000px) rotate(0deg) translateY(-8px);
            }

            .collections .collection-content h3 {
                font-size: 27px;
            }
        }

        /* ===============================
           MOBILE PHONES
        =============================== */

        @media (max-width: 520px) {
            .collections {
                padding: 45px 22px 60px;
            }

            .collections .section-heading {
                margin-bottom: 38px;
            }

            .collections .section-heading p {
                font-size: 10px;
                letter-spacing: 3px;
                margin-bottom: 17px;
            }

            .collections .section-heading h2 {
                font-size: 32px;
                letter-spacing: -1px;
            }

            .collections .collection-grid {
                grid-template-columns: 1fr;
                gap: 35px;
                perspective: 1000px;
            }

            .collections .collection-card,
            .collections .collection-card:nth-child(2),
            .collections .collection-card:nth-child(3) {
                grid-column: auto;
                width: 100%;
                height: 440px;
                justify-self: stretch;
                transform: perspective(1000px) rotate(-3deg);
            }

            .collections .collection-card:hover,
            .collections .collection-card:nth-child(2):hover,
            .collections .collection-card:nth-child(3):hover {
                transform: perspective(1000px) rotate(0deg) translateY(-6px);
            }

            .collections .collection-content {
                left: 25px;
                right: 20px;
                bottom: 27px;
            }

            .collections .collection-content h3 {
                font-size: 29px;
            }

            .collections .collection-content span {
                font-size: 14px;
            }
        }

        /* ACCESSIBILITY: REDUCE MOTION */

        @media (prefers-reduced-motion: reduce) {

            .collections .collection-card,
            .collections .collection-card>img,
            .collections .collection-content .search-btn.exp {
                transition: none;
            }
        }

        /* ===============================
   LAPTOPS & SMALL DESKTOPS
================================ */

        @media (max-width: 1200px) {
            .collections {
                padding: 70px 4%;
            }

            .collections .collection-grid {
                gap: 24px;
            }

            .collections .collection-card {
                height: 480px;
            }

            .collections .collection-content {
                left: 22px;
                right: 18px;
                bottom: 25px;
            }

            .collections .collection-content h3 {
                font-size: 28px;
            }
        }

        /* ===============================
   IPAD / TABLETS — LANDSCAPE
================================ */

        @media (max-width: 1024px) {
            .collections {
                padding: 60px 5%;
                overflow: hidden;
            }

            .collections .section-heading {
                margin-bottom: 50px;
            }

            .collections .section-heading h2 {
                font-size: 42px;
            }

            .collections .collection-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 35px 24px;
            }

            .collections .collection-card,
            .collections .collection-card:nth-child(2),
            .collections .collection-card:nth-child(3) {
                width: 100%;
                height: 440px;
                grid-column: auto;
                transform: perspective(1000px) rotate(-3deg);
            }

            .collections .collection-card:nth-child(2) {
                transform: perspective(1000px) rotate(3deg);
            }

            .collections .collection-card:nth-child(3) {
                grid-column: 1 / -1;
                width: 65%;
                justify-self: center;
                transform: perspective(1000px) rotate(-2deg);
            }

            .collections .collection-card:hover,
            .collections .collection-card:nth-child(2):hover,
            .collections .collection-card:nth-child(3):hover {
                transform: perspective(1000px) rotate(0deg) translateY(-7px);
            }

            .collections .collection-content h3 {
                font-size: 27px;
            }

            .collections .collection-content span {
                font-size: 14px;
            }
        }

        /* ===============================
   IPAD PORTRAIT / SMALL TABLETS
================================ */

        @media (max-width: 768px) {
            .collections {
                padding: 50px 5%;
            }

            .collections .section-heading {
                margin-bottom: 40px;
            }

            .collections .section-heading p {
                font-size: 11px;
                letter-spacing: 3px;
            }

            .collections .section-heading h2 {
                font-size: 36px;
            }

            .collections .collection-grid {
                gap: 28px 18px;
            }

            .collections .collection-card,
            .collections .collection-card:nth-child(2) {
                height: 390px;
            }

            .collections .collection-card:nth-child(3) {
                height: 410px;
                width: 75%;
            }

            .collections .collection-content {
                left: 18px;
                right: 15px;
                bottom: 22px;
            }

            .collections .collection-content p {
                margin-bottom: 16px;
                font-size: 12px;
            }

            .collections .collection-content h3 {
                font-size: 24px;
                margin-bottom: 10px;
            }

            .collections .collection-content span {
                font-size: 13px;
                margin-bottom: 18px;
            }

            .collections .collection-content .search-btn.exp {
                min-width: 105px;
                padding: 8px 16px;
                font-size: 13px;
            }
        }

        /* ===============================
   MOBILE PHONES
================================ */

        @media (max-width: 560px) {
            .collections {
                padding: 45px 22px 55px;
            }

            .collections .section-heading {
                margin-bottom: 35px;
            }

            .collections .section-heading p {
                font-size: 10px;
                letter-spacing: 2.5px;
                margin-bottom: 15px;
            }

            .collections .section-heading h2 {
                font-size: clamp(29px, 8vw, 35px);
                line-height: 1.25;
            }

            .collections .collection-grid {
                grid-template-columns: minmax(0, 1fr);
                gap: 30px;
            }

            .collections .collection-card,
            .collections .collection-card:nth-child(2),
            .collections .collection-card:nth-child(3) {
                grid-column: auto;
                justify-self: stretch;
                width: 100%;
                height: 420px;
                transform: perspective(1000px) rotate(-2deg);
            }

            .collections .collection-card:nth-child(2) {
                transform: perspective(1000px) rotate(2deg);
            }

            .collections .collection-card:hover,
            .collections .collection-card:nth-child(2):hover,
            .collections .collection-card:nth-child(3):hover {
                transform: perspective(1000px) rotate(0deg) translateY(-5px);
            }

            .collections .collection-content {
                left: 23px;
                right: 20px;
                bottom: 25px;
            }

            .collections .collection-content p {
                font-size: 13px;
                margin-bottom: 18px;
            }

            .collections .collection-content h3 {
                font-size: 29px;
                margin-bottom: 12px;
            }

            .collections .collection-content span {
                font-size: 14px;
                margin-bottom: 20px;
            }

            .collections .collection-content .search-btn.exp {
                min-width: 125px;
                padding: 9px 22px;
                font-size: 14px;
            }
        }

        /* ===============================
   VERY SMALL PHONES
================================ */

        @media (max-width: 360px) {
            .collections {
                padding-left: 17px;
                padding-right: 17px;
            }

            .collections .section-heading h2 {
                font-size: 28px;
            }

            .collections .collection-card,
            .collections .collection-card:nth-child(2),
            .collections .collection-card:nth-child(3) {
                height: 370px;
            }

            .collections .collection-content {
                left: 18px;
                right: 15px;
                bottom: 20px;
            }

            .collections .collection-content h3 {
                font-size: 25px;
            }
        }

        /* ===============================
   TOUCHSCREEN DEVICES
================================ */

        @media (hover: none) {
            .collections .collection-card:hover>img {
                transform: none;
            }

            .collections .collection-card:hover,
            .collections .collection-card:nth-child(2):hover,
            .collections .collection-card:nth-child(3):hover {
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            }
        }

        /* ACCESSIBILITY */

        @media (prefers-reduced-motion: reduce) {

            .collections .collection-card,
            .collections .collection-card>img,
            .collections .collection-content .search-btn.exp {
                transition: none;
            }
        }
    </style>

    <div class="section-heading">
        <p>EXPLORE ZEITH</p>
        <h2>Find Your Timepiece</h2>
    </div>

    <div class="collection-grid">

        <div class="collection-card">
            <img
                src="<?php assets("Images/picture11.png"); ?>"
                alt="Classic Watch">

            <div class="collection-content">
                <p>01</p>
                <h3>The Classic</h3>
                <span>Timeless elegance</span>

                <a href="#" class="search-btn exp">Explore</a>
            </div>
        </div>

        <div class="collection-card">
            <img
                src="<?php assets("Images/picture11.png"); ?>"
                alt="Chronograph Watch">

            <div class="collection-content">
                <p>02</p>
                <h3>The Chrono</h3>
                <span>Built for precision</span>

                <a href="#" class="search-btn exp">Explore</a>
            </div>
        </div>

        <div class="collection-card">
            <img
                src="<?php assets("Images/picture1.png"); ?>"
                alt="Executive Watch">

            <div class="collection-content">
                <p>03</p>
                <h3>The Executive</h3>
                <span>Made to impress</span>

                <a href="#" class="search-btn exp">Explore</a>
            </div>
        </div>

    </div>
</section>