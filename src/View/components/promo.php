<section class="promo">

    <div class="promo-overlay"></div>

    <div class="promo-content">

        <!-- Small Label -->
        <div class="promo-label">
            <span class="promo-label-line"></span>

            <p class="story-pp">
                THE ZEITH EXPERIENCE
            </p>
        </div>


        <!-- Main Heading -->
        <h2>
            TIME
            <span>
                IS YOURS.
            </span>
        </h2>


        <!-- Divider -->
        <div class="promo-divider"></div>


        <!-- Description -->
        <p class="promp">
            Wear every moment with confidence.
            Experience precision, elegance and timeless design
            crafted for your journey.
        </p>


        <!-- CTA -->
        <a
            href="/Watch_Collection/user/watch"
            class="btn-shop exp search-btn"
        >
            <span>
                Shop Watch
            </span>

            <span class="btn-arrow">
                →
            </span>
        </a>

    </div>

</section>


<style>

    /* =========================================================
       PROMO / EXPERIENCE SECTION
       ========================================================= */

    .promo {

        --promo-orange: #f68b1e;
        --promo-black: #000000;

        position: relative;

        width: 100%;
        min-height: 680px;

        display: flex;
        align-items: flex-end;

        overflow: hidden;

        padding: 80px 6.5% 70px;

        background-color: #111;

        /*
         * Replace this image with your actual watch image.
         */
        background-image: url('<?php assets("image/promo.jpg"); ?>');

        background-size: cover;
        background-position: center;

        color: #ffffff;

        box-sizing: border-box;
    }


    .promo *,
    .promo *::before,
    .promo *::after {
        box-sizing: border-box;
    }


    /* =========================================================
       DARK OVERLAY
       ========================================================= */

    .promo-overlay {

        position: absolute;

        inset: 0;

        z-index: 1;

        background:
            linear-gradient(
                90deg,
                rgba(0, 0, 0, 0.78) 0%,
                rgba(0, 0, 0, 0.55) 32%,
                rgba(0, 0, 0, 0.18) 65%,
                rgba(0, 0, 0, 0.32) 100%
            );

    }


    /* Additional bottom darkness */

    .promo-overlay::after {

        content: "";

        position: absolute;

        left: 0;
        right: 0;
        bottom: 0;

        height: 45%;

        background:
            linear-gradient(
                to top,
                rgba(0, 0, 0, 0.55),
                transparent
            );

    }


    /* =========================================================
       CONTENT
       ========================================================= */

    .promo-content {

        position: relative;

        z-index: 2;

        width: min(620px, 100%);

        margin-bottom: 5px;

    }


    /* =========================================================
       SMALL LABEL
       ========================================================= */

    .promo-label {

        display: flex;

        align-items: center;

        gap: 14px;

        margin-bottom: 20px;

    }


    .promo-label-line {

        display: block;

        width: 62px;

        height: 1px;

        background: rgba(255, 255, 255, 0.65);

    }


    .story-pp {

        margin: 0;

        color: #ffffff;

        font-size: 12px;

        font-weight: 500;

        letter-spacing: 0.3px;

        text-transform: none;

    }


    /* =========================================================
       MAIN HEADING
       ========================================================= */

    .promo h2 {

        max-width: 600px;

        margin: 0;

        color: #ffffff;

        font-family:
            Arial,
            Helvetica,
            sans-serif;

        font-size: clamp(
            48px,
            5.2vw,
            72px
        );

        font-weight: 700;

        line-height: 1.08;

        letter-spacing: -2.5px;

        text-transform: none;

    }


    .promo h2 span {

        display: block;

        color: #ffffff;

    }


    /* Orange accent on period */

    .promo h2 span::after {

        content: "";

        color: var(--promo-orange);

    }


    /* =========================================================
       DIVIDER
       ========================================================= */

    .promo-divider {

        width: 100%;

        height: 1px;

        margin: 27px 0 21px;

        border-top: 1px dashed
            rgba(255, 255, 255, 0.5);

    }


    /* =========================================================
       DESCRIPTION
       ========================================================= */

    .promp {

        max-width: 560px;

        margin: 0 0 20px;

        color: #ffffff;

        font-size: 18px;

        font-weight: 500;

        line-height: 1.45;

    }


    /* =========================================================
       SHOP BUTTON
       ========================================================= */

    .btn-shop {

        display: inline-flex;

        align-items: center;

        justify-content: center;

        gap: 12px;

        min-width: 138px;

        min-height: 46px;

        padding: 0 20px;

        border-radius: 30px;

        background: #ffffff;

        color: #000000;

        font-size: 13px;

        font-weight: 700;

        text-decoration: none;

        transition:
            background 0.25s ease,
            color 0.25s ease,
            transform 0.25s ease,
            box-shadow 0.25s ease;

    }


    .btn-shop:hover {

        background: var(--promo-orange);

        color: #000000;

        transform: translateY(-3px);

        box-shadow:
            0 10px 25px
            rgba(246, 139, 30, 0.25);

    }


    .btn-arrow {

        font-size: 20px;

        line-height: 1;

        transition:
            transform 0.25s ease;

    }


    .btn-shop:hover .btn-arrow {

        transform: translateX(4px);

    }


    /* =========================================================
       SCROLL DOWN
       ========================================================= */

    .promo-scroll {

        position: absolute;

        right: 6.5%;
        bottom: 72px;

        z-index: 2;

        display: flex;

        flex-direction: column;

        align-items: center;

        gap: 5px;

        color: #ffffff;

        font-size: 10px;

        font-weight: 500;

        text-align: center;

    }


    .scroll-icon {

        display: flex;

        align-items: center;

        justify-content: center;

        width: 25px;
        height: 25px;

        font-size: 20px;

        animation:
            promoScroll 1.8s ease-in-out
            infinite;

    }


    @keyframes promoScroll {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(6px);
        }

    }


    /* =========================================================
       TABLET
       ========================================================= */

    @media (max-width: 900px) {

        .promo {

            min-height: 620px;

            padding:
                70px 5%
                60px;

            background-position:
                58% center;

        }


        .promo-content {

            width: min(570px, 100%);

        }


        .promo h2 {

            font-size: clamp(
                44px,
                7vw,
                62px
            );

        }


        .promp {

            font-size: 16px;

        }


        .promo-scroll {

            right: 5%;

            bottom: 55px;

        }

    }


    /* =========================================================
       MOBILE
       ========================================================= */

    @media (max-width: 600px) {

        .promo {

            min-height: 650px;

            align-items: flex-end;

            padding:
                50px 24px
                55px;

            background-position:
                62% center;

        }


        .promo-overlay {

            background:
                linear-gradient(
                    90deg,
                    rgba(0, 0, 0, 0.82) 0%,
                    rgba(0, 0, 0, 0.58) 55%,
                    rgba(0, 0, 0, 0.35) 100%
                );

        }


        .promo-content {

            width: 100%;

            margin-bottom: 0;

        }


        .promo-label {

            margin-bottom: 15px;

        }


        .promo-label-line {

            width: 42px;

        }


        .story-pp {

            font-size: 11px;

        }


        .promo h2 {

            font-size: 44px;

            line-height: 1.05;

            letter-spacing: -1.5px;

        }


        .promo-divider {

            margin:
                22px 0
                18px;

        }


        .promp {

            max-width: 420px;

            font-size: 15px;

            line-height: 1.5;

            margin-bottom: 20px;

        }


        .btn-shop {

            min-height: 45px;

            padding: 0 19px;

            font-size: 12px;

        }


        .promo-scroll {

            display: none;

        }

    }


    /* =========================================================
       SMALL MOBILE
       ========================================================= */

    @media (max-width: 380px) {

        .promo {

            min-height: 600px;

            padding:
                40px 20px
                45px;

        }


        .promo h2 {

            font-size: 38px;

        }


        .promp {

            font-size: 14px;

        }

    }

</style>