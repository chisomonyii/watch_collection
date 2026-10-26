<?php
// components/why-choose.php
?>

<style>
/* =========================================
   ZEITH — WHY CHOOSE ZEITH
========================================= */

.zeith-why {
    width: 100%;
    padding: 65px 5% 75px;

    /* Background from the original design */
    background: #f5f4f0;

    color: #111827;

    font-family: Arial, Helvetica, sans-serif;

    overflow: hidden;
}

.zeith-why *,
.zeith-why *::before,
.zeith-why *::after {
    box-sizing: border-box;
}

.zeith-why__container {
    width: 100%;
    max-width: 1500px;
    margin: 0 auto;
}


/* =========================================
   HEADING
========================================= */

.zeith-why__heading {
    text-align: center;
    margin-bottom: 50px;
}

.zeith-why__eyebrow {
    margin: 0 0 25px;

    color: #063f2f;

    font-size: 13px;
    font-weight: 800;

    letter-spacing: 4px;
    text-transform: uppercase;
}

.zeith-why__title {
    margin: 0;

    color: #25352f;

    font-family: Arial, Helvetica, sans-serif;

    font-size: clamp(40px, 4vw, 56px);
    font-weight: 300;

    line-height: 1.15;
    letter-spacing: -2px;
}


/* =========================================
   FEATURES GRID
========================================= */

.zeith-why__grid {
    display: grid;

    grid-template-columns:
        repeat(4, 1fr);

    gap: 45px;

    width: 100%;
}


/* =========================================
   FEATURE ITEM
========================================= */

.zeith-why__item {
    min-width: 0;

    text-align: center;
}


/* =========================================
   IMAGE
========================================= */

.zeith-why__image {
    width: 100%;
    height: 185px;

    overflow: hidden;

    border-radius: 10px;

    background: #e8e6e1;

    margin-bottom: 17px;
}

.zeith-why__image img {
    display: block;

    width: 100%;
    height: 100%;

    object-fit: cover;
    object-position: center;

    transition:
        transform 0.45s ease;
}

.zeith-why__item:hover
.zeith-why__image img {
    transform: scale(1.04);
}


/* =========================================
   FEATURE TITLE
========================================= */

.zeith-why__item-title {
    margin: 0 0 14px;

    color: #111111;

    font-size: 22px;
    font-weight: 500;

    line-height: 1.3;
}


/* =========================================
   FEATURE DESCRIPTION
========================================= */

.zeith-why__item-text {
    max-width: 310px;

    margin: 0 auto;

    color: #252525;

    font-size: 17px;
    font-weight: 400;

    line-height: 1.55;
}


/* =========================================
   TABLET
========================================= */

@media (max-width: 1100px) {

    .zeith-why {
        padding: 55px 4% 65px;
    }

    .zeith-why__grid {
        gap: 25px;
    }

    .zeith-why__image {
        height: 165px;
    }

    .zeith-why__item-title {
        font-size: 20px;
    }

    .zeith-why__item-text {
        font-size: 15px;
    }
}


/* =========================================
   SMALL TABLET
========================================= */

@media (max-width: 800px) {

    .zeith-why__grid {
        grid-template-columns: 1fr 1fr;

        row-gap: 40px;
    }

    .zeith-why__image {
        height: 190px;
    }

    .zeith-why__item-text {
        max-width: 330px;
    }
}


/* =========================================
   MOBILE
========================================= */

@media (max-width: 550px) {

    .zeith-why {
        padding: 50px 20px 55px;
    }

    .zeith-why__heading {
        margin-bottom: 35px;
    }

    .zeith-why__eyebrow {
        margin-bottom: 16px;

        font-size: 11px;
        letter-spacing: 3px;
    }

    .zeith-why__title {
        font-size: 35px;
        letter-spacing: -1px;
    }

    .zeith-why__grid {
        grid-template-columns: 1fr;

        gap: 35px;
    }

    .zeith-why__image {
        height: 220px;

        border-radius: 12px;
    }

    .zeith-why__item-title {
        font-size: 21px;
    }

    .zeith-why__item-text {
        max-width: 350px;

        font-size: 15px;
    }
}


/* =========================================
   REDUCED MOTION
========================================= */

@media (prefers-reduced-motion: reduce) {

    .zeith-why__image img {
        transition: none;
    }
}
</style>


<section class="zeith-why" id="why-choose-zeith">

    <div class="zeith-why__container">


        <!-- =================================
             HEADING
        ================================== -->

        <div class="zeith-why__heading">

            <p class="zeith-why__eyebrow">
                THE ZEITH STANDARD
            </p>

            <h2 class="zeith-why__title">
                Why Choose Zeith?
            </h2>

        </div>


        <!-- =================================
             FEATURES
        ================================== -->

        <div class="zeith-why__grid">


            <!-- PRECISION -->

            <article class="zeith-why__item">

                <div class="zeith-why__image">

                    <img
                        src="assets/image/trust/precision.jpg"
                        alt="Precision watch movement"
                        loading="lazy"
                    >

                </div>

                <h3 class="zeith-why__item-title">
                    Precision
                </h3>

                <p class="zeith-why__item-text">
                    Engineered for accuracy with
                    painstaking attention to every
                    component.
                </p>

            </article>


            <!-- WARRANTY -->

            <article class="zeith-why__item">

                <div class="zeith-why__image">

                    <img
                        src="assets/image/trust/warranty.jpg"
                        alt="Zeith warranty"
                        loading="lazy"
                    >

                </div>

                <h3 class="zeith-why__item-title">
                    Warranty
                </h3>

                <p class="zeith-why__item-text">
                    Purchase with peace of mind.
                    Your watch comes with an
                    exclusive 2-year guarantee.
                </p>

            </article>


            <!-- FAST DELIVERY -->

            <article class="zeith-why__item">

                <div class="zeith-why__image">

                    <img
                        src="assets/image/trust/fast_delivery.jpg"
                        alt="Zeith fast delivery"
                        loading="lazy"
                    >

                </div>

                <h3 class="zeith-why__item-title">
                    Fast Delivery
                </h3>

                <p class="zeith-why__item-text">
                    Efficient, safe shipping to any
                    address in Nigeria.
                </p>

            </article>


            <!-- SECURE PAYMENT -->

            <article class="zeith-why__item">

                <div class="zeith-why__image">

                    <img
                        src="assets/image/trust/secure_payment.jpg"
                        alt="Secure payment"
                        loading="lazy"
                    >

                </div>

                <h3 class="zeith-why__item-title">
                    Secure Payment
                </h3>

                <p class="zeith-why__item-text">
                    Your transaction data is safe.
                    Trust in our secure, encrypted
                    checkout process.
                </p>

            </article>


        </div>

    </div>

</section>