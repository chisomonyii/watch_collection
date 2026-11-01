<?php
// src/View/components/cookie-banner.php
?>
<style>
    /* =========================================
       COOKIE BOTTOM BANNER (Warm Milk Theme)
    ========================================= */
    .zeith-cookie-banner {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: #fdfbf7; /* Milk / Warm Ivory */
        color: #111111;
        border-top: 1px solid #e5dfd3;
        padding: 24px 5%;
        z-index: 99999;
        font-family: Arial, Helvetica, sans-serif;
        box-shadow: 0 -10px 30px rgba(0, 0, 0, 0.15);
        transform: translateY(100%);
        transition: transform 0.4s ease-in-out;
    }

    .zeith-cookie-banner.show {
        transform: translateY(0);
    }

    .cookie-container {
        max-width: 1400px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 30px;
        flex-wrap: wrap;
    }

    .cookie-text {
        flex: 1;
        min-width: 280px;
    }

    .cookie-text h4 {
        font-family: Georgia, serif;
        font-size: 18px;
        color: #111111;
        margin-bottom: 8px;
    }

    .cookie-text p {
        font-size: 14px;
        color: #555555;
        line-height: 1.5;
        margin: 0;
        font-weight: 270;
    }

    .cookie-text a {
        color: #f68b1e;
        text-decoration: underline;
    }

    .cookie-buttons {
        display: flex;
        gap: 12px;
        align-items: center;
        flex-wrap: wrap;
    }

    .cookie-btn {
        padding: 12px 20px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        cursor: pointer;
        transition: all 0.2s ease;
        border: none;
    }

    .cookie-btn-settings {
        background: transparent;
        color: #4b5563;
        border: 1px solid #dcd6c8;
    }

    .cookie-btn-settings:hover {
        background: #f3eee3;
        color: #111111;
    }

    .cookie-btn-reject {
        background: #e5dfd3;
        color: #111111;
    }

    .cookie-btn-reject:hover {
        background: #d8d1c3;
    }

    .cookie-btn-accept {
        background: #111111;
        color: #ffffff;
    }

    .cookie-btn-accept:hover {
        background: #f68b1e;
        color: #111111;
    }

    /* =========================================
       SLIDE-OUT PREFERENCES MODAL (RIGHT SIDE)
    ========================================= */
    .cookie-modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(4px);
        z-index: 100000;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s ease;
    }

    .cookie-modal-overlay.active {
        opacity: 1;
        pointer-events: auto;
    }

    .cookie-modal {
        position: fixed;
        top: 0;
        right: 0;
        width: 100%;
        max-width: 480px;
        height: 100vh;
        background-color: #fdfbf7; /* Milk / Warm Ivory */
        color: #111111;
        border-left: 1px solid #e5dfd3;
        box-shadow: -10px 0 30px rgba(0, 0, 0, 0.2);
        display: flex;
        flex-direction: column;
        transform: translateX(100%);
        transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .cookie-modal-overlay.active .cookie-modal {
        transform: translateX(0);
    }

    /* Modal Header */
    .cookie-modal-header {
        padding: 24px 30px;
        border-bottom: 1px solid #e5dfd3;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .cookie-brand-logo {
        font-family: Georgia, serif;
        font-size: 20px;
        letter-spacing: 2px;
        font-weight: 700;
        color: #111111;
    }

    .cookie-modal-close {
        background: none;
        border: none;
        color: #6b7280;
        font-size: 24px;
        cursor: pointer;
        transition: color 0.2s;
    }

    .cookie-modal-close:hover {
        color: #111111;
    }

    /* Modal Body */
    .cookie-modal-body {
        padding: 30px;
        overflow-y: auto;
        flex: 1;
    }

    .cookie-modal-title {
        font-family: Georgia, serif;
        font-size: 22px;
        color: #111111;
        margin-bottom: 12px;
    }

    .cookie-modal-desc {
        font-size: 14px;
        color: #555555;
        line-height: 1.6;
        margin-bottom: 25px;
    }

    .cookie-btn-allow-all {
        width: 100%;
        padding: 14px;
        background: #111111;
        color: #ffffff;
        border: none;
        border-radius: 8px;
        font-weight: 700;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 1px;
        cursor: pointer;
        margin-bottom: 30px;
        transition: background 0.2s;
    }

    .cookie-btn-allow-all:hover {
        background: #f68b1e;
        color: #111111;
    }

    /* Preference Categories & Toggles */
    .preference-group {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .preference-item {
        background: #ffffff;
        border: 1px solid #e5dfd3;
        border-radius: 10px;
        padding: 18px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .preference-info h5 {
        font-size: 15px;
        color: #111111;
        margin-bottom: 4px;
    }

    .preference-info p {
        font-size: 12px;
        color: #6b7280;
        margin: 0;
    }

    .always-active-badge {
        font-size: 13px;
        font-weight: 700;
        color: #f68b1e;
    }

    /* Custom Switch Toggle */
    .switch {
        position: relative;
        display: inline-block;
        width: 46px;
        height: 24px;
        flex-shrink: 0;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0; left: 0; right: 0; bottom: 0;
        background-color: #dcd6c8;
        transition: .3s;
        border-radius: 24px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 3px;
        bottom: 3px;
        background-color: #ffffff;
        transition: .3s;
        border-radius: 50%;
        box-shadow: 0 1px 3px rgba(0,0,0,0.2);
    }

    input:checked + .slider {
        background-color: #111111;
    }

    input:checked + .slider:before {
        transform: translateX(22px);
    }

    /* Modal Footer */
    .cookie-modal-footer {
        padding: 20px 30px;
        border-top: 1px solid #e5dfd3;
        background: #fdfbf7;
    }

    .cookie-btn-confirm {
        width: 100%;
        padding: 14px;
        background: #f68b1e;
        color: #111111;
        border: none;
        border-radius: 8px;
        font-weight: 700;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 1px;
        cursor: pointer;
        transition: background 0.2s;
    }

    .cookie-btn-confirm:hover {
        background: #e07a14;
    }

    @media (max-width: 768px) {
        .cookie-container {
            flex-direction: column;
            align-items: stretch;
            text-align: center;
        }
        .cookie-buttons {
            justify-content: center;
        }
        .cookie-modal {
            max-width: 100%;
        }
    }
</style>

<!-- BOTTOM COOKIE BANNER -->
<div class="zeith-cookie-banner" id="zeithCookieBanner">
    <div class="cookie-container">
        <div class="cookie-text">
            <h4>Privacy & Cookie Preferences</h4>
            <p>We use cookies to enhance your browsing experience, analyze site traffic, and secure your shopping cart. Read our <a href="/Zeith/privacy-policy">Privacy Notice</a> for details.</p>
        </div>
        <div class="cookie-buttons">
            <button class="cookie-btn cookie-btn-settings" id="cookieSettingsBtn">Preferences</button>
            <button class="cookie-btn cookie-btn-reject" id="cookieRejectBtn">Reject All</button>
            <button class="cookie-btn cookie-btn-accept" id="cookieAcceptBtn">Accept All</button>
        </div>
    </div>
</div>

<!-- RIGHT SLIDE-OUT PREFERENCES MODAL -->
<div class="cookie-modal-overlay" id="cookieModalOverlay">
    <div class="cookie-modal">
        <div class="cookie-modal-header">
            <span class="cookie-brand-logo">ZEITH</span>
            <button class="cookie-modal-close" id="closeCookieModal">&times;</button>
        </div>

        <div class="cookie-modal-body">
            <h3 class="cookie-modal-title">Manage Consent Preferences</h3>
            <p class="cookie-modal-desc">Customize your personal data permissions. Strictly necessary cookies ensure site security and checkout functioning.</p>

            <button class="cookie-btn-allow-all" id="allowAllModalBtn">Allow All</button>

            <div class="preference-group">
                <!-- Strictly Necessary -->
                <div class="preference-item">
                    <div class="preference-info">
                        <h5>Strictly Necessary Cookies</h5>
                        <p>Essential for cart, session & routing.</p>
                    </div>
                    <span class="always-active-badge">Always Active</span>
                </div>

                <!-- Performance -->
                <div class="preference-item">
                    <div class="preference-info">
                        <h5>Performance Cookies</h5>
                        <p>Measures site speed and user interactions.</p>
                    </div>
                    <label class="switch">
                        <input type="checkbox" id="cookiePerf">
                        <span class="slider"></span>
                    </label>
                </div>

                <!-- Functional -->
                <div class="preference-item">
                    <div class="preference-info">
                        <h5>Functional Cookies</h5>
                        <p>Remembers filter preferences & wishlist.</p>
                    </div>
                    <label class="switch">
                        <input type="checkbox" id="cookieFunc">
                        <span class="slider"></span>
                    </label>
                </div>

                <!-- Advertisement -->
                <div class="preference-item">
                    <div class="preference-info">
                        <h5>Advertisement Cookies</h5>
                        <p>Delivers personalized luxury campaigns.</p>
                    </div>
                    <label class="switch">
                        <input type="checkbox" id="cookieAdv">
                        <span class="slider"></span>
                    </label>
                </div>
            </div>
        </div>

        <div class="cookie-modal-footer">
            <button class="cookie-btn-confirm" id="confirmChoicesBtn">Confirm My Choices</button>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const banner = document.getElementById("zeithCookieBanner");
    const settingsBtn = document.getElementById("cookieSettingsBtn");
    const acceptBtn = document.getElementById("cookieAcceptBtn");
    const rejectBtn = document.getElementById("cookieRejectBtn");
    const modalOverlay = document.getElementById("cookieModalOverlay");
    const closeModal = document.getElementById("closeCookieModal");
    const allowAllModalBtn = document.getElementById("allowAllModalBtn");
    const confirmChoicesBtn = document.getElementById("confirmChoicesBtn");

    const ONE_DAY_MS = 24 * 60 * 60 * 1000; // 24 hours in milliseconds
    const lastConsentTime = localStorage.getItem("zeith_cookie_consent_time");
    const now = Date.now();

    // Show banner if 24 hours have passed or if the user has never given consent
    if (!lastConsentTime || (now - Number(lastConsentTime)) > ONE_DAY_MS) {
        setTimeout(() => {
            banner.classList.add("show");
        }, 800);
    }

    function saveConsent(preferences) {
        localStorage.setItem("zeith_cookie_consent", JSON.stringify(preferences));
        localStorage.setItem("zeith_cookie_consent_time", Date.now().toString());
        banner.classList.remove("show");
        modalOverlay.classList.remove("active");
    }

    acceptBtn.addEventListener("click", function () {
        saveConsent({ performance: true, functional: true, advertisement: true });
    });

    rejectBtn.addEventListener("click", function () {
        saveConsent({ performance: false, functional: false, advertisement: false });
    });

    settingsBtn.addEventListener("click", function () {
        modalOverlay.classList.add("active");
    });

    closeModal.addEventListener("click", function () {
        modalOverlay.classList.remove("active");
    });

    allowAllModalBtn.addEventListener("click", function () {
        saveConsent({ performance: true, functional: true, advertisement: true });
    });

    confirmChoicesBtn.addEventListener("click", function () {
        const preferences = {
            performance: document.getElementById("cookiePerf").checked,
            functional: document.getElementById("cookieFunc").checked,
            advertisement: document.getElementById("cookieAdv").checked
        };
        saveConsent(preferences);
    });
});
</script>