<section class="zeith-story">

    <!-- Decorative background elements -->
    <div class="zeith-story__glow"></div>
    <div class="zeith-story__grid"></div>
    <div class="zeith-story__particles"></div>


    <!-- =====================================================
         LEFT: WATCH
         ===================================================== -->

    <div class="zeith-story__visual">

        <div class="zeith-story__watch-frame"></div>
        <img
            src="assets/image/banner/watch-removebg-preview.png"
            alt="Zeith luxury watch"
            class="zeith-story__watch">

    </div>


    <!-- =====================================================
         RIGHT: STORY
         ===================================================== -->

    <div class="zeith-story__content">

        <p class="zeith-story__eyebrow">
            THE ZEITH STORY
        </p>


        <h2 class="zeith-story__title">
            More Than A Watch.
            <span>A Statement.</span>
        </h2>


        <p class="zeith-story__description">
            At Zeith, we believe a watch should be more than
            something that tells time. It should represent your
            style, ambition, and the moments that matter.
        </p>


        <a
            href="#"
            class="zeith-story__button">

            <span>
                DISCOVER ZEITH
            </span>

            <span class="zeith-story__arrow">
                →
            </span>

        </a>

    </div>


    <!-- =====================================================
         SCROLL INDICATOR
         ===================================================== -->

    <div class="zeith-story__scroll">

        <span class="zeith-story__scroll-icon">
            ↓
        </span>

        <span>
            Scroll to explore collection
        </span>

    </div>

</section>


<style>
    /* =========================================================
       ZEITH STORY SECTION
       ========================================================= */

    .zeith-story {

        --zeith-orange: #f68b1e;
        --zeith-black: #000000;
        --zeith-dark: #090909;
        --zeith-white: #ffffff;
        --zeith-cream: #f6f0df;

        position: relative;

        width: 100%;

        min-height: 720px;

        display: grid;

        grid-template-columns: 52% 48%;

        align-items: center;

        overflow: hidden;

        background:
            radial-gradient(circle at 30% 50%,
                #1b1b1b 0%,
                #0d0d0d 35%,
                #050505 70%,
                #000000 100%);

        color: var(--zeith-white);

        isolation: isolate;

    }


    /* =========================================================
       BACKGROUND GLOW
       ========================================================= */

    .zeith-story__glow {

        position: absolute;

        z-index: -3;

        width: 650px;
        height: 650px;

        left: 3%;
        top: 50%;

        transform: translateY(-50%);

        border-radius: 50%;

        background:
            radial-gradient(circle,
                rgba(246, 139, 30, 0.10) 0%,
                rgba(246, 139, 30, 0.04) 30%,
                transparent 70%);

        filter: blur(15px);

        pointer-events: none;

    }


    /* =========================================================
       TECHNICAL GRID
       ========================================================= */

    .zeith-story__grid {

        position: absolute;

        z-index: -2;

        left: 8%;

        top: 50%;

        width: 36%;

        height: 72%;

        transform: translateY(-50%);

        opacity: 0.22;

        background-image:
            linear-gradient(rgba(255, 255, 255, 0.15) 1px,
                transparent 1px),
            linear-gradient(90deg,
                rgba(255, 255, 255, 0.15) 1px,
                transparent 1px);

        background-size:
            38px 38px;

        border: 1px solid rgba(255, 255, 255, 0.12);

        pointer-events: none;

    }


    /* =========================================================
       GRID FADE
       ========================================================= */

    .zeith-story__grid::after {

        content: "";

        position: absolute;

        inset: 0;

        background:
            radial-gradient(circle at center,
                transparent 20%,
                rgba(5, 5, 5, 0.35) 65%,
                #050505 100%);

    }


    /* =========================================================
       PARTICLES / STARS
       ========================================================= */

    .zeith-story__particles {

        position: absolute;

        z-index: -1;

        left: 0;

        top: 0;

        width: 55%;

        height: 100%;

        opacity: 0.65;

        pointer-events: none;

        background-image:

            radial-gradient(circle at 7% 40%,
                rgba(255, 255, 255, 0.8) 0 1px,
                transparent 2px),

            radial-gradient(circle at 15% 65%,
                rgba(255, 255, 255, 0.5) 0 1px,
                transparent 2px),

            radial-gradient(circle at 24% 20%,
                rgba(255, 255, 255, 0.6) 0 1px,
                transparent 2px),

            radial-gradient(circle at 34% 75%,
                rgba(246, 139, 30, 0.7) 0 1px,
                transparent 2px),

            radial-gradient(circle at 43% 30%,
                rgba(255, 255, 255, 0.5) 0 1px,
                transparent 2px),

            radial-gradient(circle at 49% 58%,
                rgba(255, 255, 255, 0.7) 0 1px,
                transparent 2px);

        background-size:
            280px 280px,
            350px 350px,
            420px 420px,
            310px 310px,
            500px 500px,
            380px 380px;

    }


    /* =========================================================
       LEFT VISUAL AREA
       ========================================================= */

    .zeith-story__visual {

        position: relative;

        height: 100%;

        min-height: 720px;

        display: flex;

        align-items: center;

        justify-content: center;

        padding: 25px;

    }


    /* =========================================================
       WATCH FRAME
       ========================================================= */

    .zeith-story__watch-frame {

        position: absolute;

        width: 59%;

        aspect-ratio: 1 / 1;

        border: 1px solid rgba(255, 255, 255, 0.14);

        background:
            radial-gradient(circle,
                rgba(255, 255, 255, 0.025),
                transparent 70%);

    }


    /* =========================================================
       WATCH IMAGE
       ========================================================= */

    .zeith-story__watch {

        position: relative;

        z-index: 2;

        display: block;

        width: min(620px, 88%);

        max-height: 760px;

        object-fit: contain;

        object-position: center;

        filter:
            drop-shadow(0 35px 35px rgba(0, 0, 0, 0.65));

        transform:
            translateX(-2%) scale(1.08);

        transition:
            transform 0.6s ease;

    }


    .zeith-story:hover .zeith-story__watch {

        transform:
            translateX(-2%) scale(1.11);

    }


    /* =========================================================
       RIGHT CONTENT
       ========================================================= */

    .zeith-story__content {

        position: relative;

        z-index: 5;

        width: min(620px, 90%);

        padding:
            70px 7vw 70px 20px;

    }


    /* =========================================================
       EYEBROW
       ========================================================= */

    .zeith-story__eyebrow {

        margin: 0 0 27px;

        color: var(--zeith-orange);

        font-size: 15px;

        font-weight: 800;

        letter-spacing: 2px;

        text-transform: uppercase;

    }


    /* =========================================================
       TITLE
       ========================================================= */

    .zeith-story__title {

        margin: 0;

        color: var(--zeith-cream);

        font-family:
            Georgia,
            "Times New Roman",
            serif;

        font-size: clamp(48px,
                4.6vw,
                72px);

        font-weight: 400;

        line-height: 1.05;

        letter-spacing: -2px;

    }


    .zeith-story__title span {

        display: block;

    }


    /* =========================================================
       DESCRIPTION
       ========================================================= */

    .zeith-story__description {

        max-width: 590px;

        margin:
            35px 0 38px;

        color:
            rgba(255, 255, 255, 0.88);

        font-size: 18px;

        font-weight: 400;

        line-height: 1.65;

    }


    /* =========================================================
       CTA BUTTON
       ========================================================= */

    .zeith-story__button {

        display: inline-flex;

        align-items: center;

        justify-content: center;

        gap: 25px;

        min-width: 300px;

        min-height: 68px;

        padding:
            0 28px;

        border-radius: 8px;

        background:
            linear-gradient(135deg,
                #f68b1e,
                #f58a1c);

        color: #ffffff;

        font-size: 18px;

        font-weight: 800;

        letter-spacing: 0.5px;

        text-decoration: none;

        box-shadow:
            0 12px 28px rgba(246, 139, 30, 0.22);

        transition:
            transform 0.25s ease,
            box-shadow 0.25s ease,
            background 0.25s ease;

    }


    .zeith-story__button:hover {

        transform:
            translateY(-4px);

        box-shadow:
            0 18px 38px rgba(246, 139, 30, 0.35);

        background:
            #ff9a32;

    }


    .zeith-story__arrow {

        font-size: 27px;

        font-weight: 300;

        line-height: 1;

        transition:
            transform 0.25s ease;

    }


    .zeith-story__button:hover .zeith-story__arrow {

        transform:
            translateX(5px);

    }


    /* =========================================================
       SCROLL INDICATOR
       ========================================================= */

    .zeith-story__scroll {

        position: absolute;

        z-index: 5;

        left: 50%;

        bottom: 28px;

        transform:
            translateX(-50%);

        display: flex;

        flex-direction: column;

        align-items: center;

        gap: 7px;

        color:
            rgba(255, 255, 255, 0.55);

        font-size: 13px;

    }


    .zeith-story__scroll-icon {

        display: flex;

        align-items: center;

        justify-content: center;

        width: 18px;

        height: 30px;

        border: 1px solid rgba(255, 255, 255, 0.45);

        border-radius: 12px;

        font-size: 13px;

        animation:
            zeithScroll 1.8s ease-in-out infinite;

    }


    @keyframes zeithScroll {

        0%,
        100% {

            transform:
                translateY(0);

        }

        50% {

            transform:
                translateY(5px);

        }

    }


    /* =========================================================
       TABLET
       ========================================================= */

    @media (max-width: 1000px) {

        .zeith-story {

            grid-template-columns:
                48% 52%;

            min-height: 650px;

        }


        .zeith-story__visual {

            min-height: 650px;

        }


        .zeith-story__watch {

            width: 100%;

            transform:
                translateX(-5%) scale(1.05);

        }


        .zeith-story:hover .zeith-story__watch {

            transform:
                translateX(-5%) scale(1.08);

        }


        .zeith-story__content {

            padding:
                60px 5vw 60px 10px;

        }


        .zeith-story__title {

            font-size:
                clamp(42px,
                    5vw,
                    60px);

        }


        .zeith-story__description {

            font-size: 16px;

        }


        .zeith-story__button {

            min-width: 250px;

            min-height: 60px;

            font-size: 16px;

        }

    }


    /* =========================================================
       MOBILE
       ========================================================= */

    @media (max-width: 700px) {

        .zeith-story {

            display: flex;

            flex-direction: column;

            min-height: auto;

            padding-bottom: 70px;

        }


        .zeith-story__visual {

            width: 100%;

            min-height: 430px;

            height: 430px;

            padding: 10px;

        }


        .zeith-story__grid {

            left: 8%;

            top: 48%;

            width: 84%;

            height: 78%;

        }


        .zeith-story__watch-frame {

            width: 72%;

        }


        .zeith-story__watch {

            width: 100%;

            max-height: 450px;

            transform:
                scale(1.02);

        }


        .zeith-story:hover .zeith-story__watch {

            transform:
                scale(1.05);

        }


        .zeith-story__content {

            width: 100%;

            padding:
                35px 25px 50px;

            text-align: left;

        }


        .zeith-story__eyebrow {

            font-size: 12px;

            margin-bottom: 18px;

        }


        .zeith-story__title {

            font-size: 43px;

            letter-spacing:
                -1px;

        }


        .zeith-story__description {

            margin:
                25px 0 30px;

            font-size: 16px;

            line-height: 1.6;

        }


        .zeith-story__button {

            width: 100%;

            min-width: 0;

            min-height: 58px;

            font-size: 15px;

        }


        .zeith-story__scroll {

            display: none;

        }

    }


    /* =========================================================
       SMALL MOBILE
       ========================================================= */

    @media (max-width: 400px) {

        .zeith-story__visual {

            min-height: 370px;

            height: 370px;

        }


        .zeith-story__title {

            font-size: 37px;

        }


        .zeith-story__description {

            font-size: 15px;

        }

    }
</style>