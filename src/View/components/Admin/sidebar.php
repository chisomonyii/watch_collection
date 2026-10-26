<?php
// views/Staff/sidebar.php

/*
|--------------------------------------------------------------------------
| DETECT CURRENT STAFF PAGE
|--------------------------------------------------------------------------
| This keeps the active blue background on the correct link after
| navigating to another PHP page.
*/

$currentPath = rtrim(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH),
    '/'
);

function zeithIsActive($path)
{
    global $currentPath;

    $path = rtrim($path, '/');

    return $currentPath === $path ? 'active' : '';
}
?>

<!-- =========================================
     MOBILE / TABLET MENU BUTTON
========================================== -->

<button
    type="button"
    class="zeith-mobile-menu-toggle"
    id="zeithMenuToggle"
    aria-label="Open navigation menu"
    aria-expanded="false">
    <span></span>
    <span></span>
    <span></span>
</button>


<!-- =========================================
     SIDEBAR OVERLAY
========================================== -->

<div
    class="zeith-sidebar-overlay"
    id="zeithSidebarOverlay"></div>


<!-- =========================================
     SIDEBAR
========================================== -->

<aside class="zeith-sidebar" id="zeithSidebar">

    <!-- MOBILE CLOSE BUTTON -->

    <button
        type="button"
        class="zeith-sidebar-close"
        id="zeithSidebarClose"
        aria-label="Close navigation menu">
        <span></span>
        <span></span>
    </button>


    <!-- =========================================
         LOGO
    ========================================== -->

    <div class="zeith-sidebar-brand">

        <div class="zeith-brand-mark">
            Z
        </div>

        <div class="zeith-brand-text">
            <strong>ZEITH</strong>
            <span>STAFF PANEL</span>
        </div>

    </div>


    <!-- =========================================
         NAVIGATION
    ========================================== -->

    <nav class="zeith-sidebar-nav">

        <div class="zeith-nav-section-title">
            MAIN MENU
        </div>


        <!-- =====================================
             OVERVIEW
        ====================================== -->

        <a
            href="/Watch_Collection/admin/dashboard"
            class="zeith-nav-item <?= zeithIsActive('/Watch_Collection/admin/dashboard') ?>">

            <span class="zeith-nav-icon">

                <svg viewBox="0 0 24 24">
                    <path d="M3 10.5L12 3l9 7.5"></path>
                    <path d="M5 9.5V21h14V9.5"></path>
                    <path d="M9 21v-7h6v7"></path>
                </svg>

            </span>

            <span class="zeith-nav-label">
                Overview
            </span>

        </a>


        <!-- =====================================
             ORDERS
        ====================================== -->


        <a
            href="/Watch_Collection/admin/watch"
            class="zeith-nav-item <?= zeithIsActive('/Watch_Collection/admin/watch') ?>">

            <span class="zeith-nav-icon">

                <svg viewBox="0 0 24 24">
                    <rect x="3" y="5" width="18" height="14" rx="2"></rect>
                    <path d="M3 10h18"></path>
                    <path d="M7 15h4"></path>
                </svg>

            </span>

            <span class="zeith-nav-label">
                Watch
            </span>

            <span class="zeith-nav-badge warning">
                6
            </span>

        </a>

        <a
            href="/Watch_Collection/admin/staff-requests"
            class="zeith-nav-item <?= zeithIsActive('/Watch_Collection/admin/staff-requests') ?>">

            <span class="zeith-nav-icon">

                <svg viewBox="0 0 24 24">
                    <path d="M3 7l9-4 9 4-9 4-9-4z"></path>
                    <path d="M3 7v10l9 4 9-4V7"></path>
                    <path d="M12 11v10"></path>
                </svg>

            </span>

            <span class="zeith-nav-label">
                Staff Request
            </span>

        </a>

        <a
            href="/Watch_Collection/admin/contact"
            class="zeith-nav-item <?= zeithIsActive('/Watch_Collection/admin/contact') ?>">

            <span class="zeith-nav-icon">

                <svg viewBox="0 0 24 24">
                    <rect x="5" y="3" width="14" height="18" rx="2"></rect>
                    <path d="M9 3v3h6V3"></path>
                    <path d="M8 11h8"></path>
                    <path d="M8 15h6"></path>
                </svg>

            </span>

            <span class="zeith-nav-label">
                contact
            </span>

            <span class="zeith-nav-badge warning">
                2
            </span>

        </a>


        <!-- =====================================
             PAYMENT RECEIPTS
        ====================================== -->




        <!-- =====================================
             CONTACT QUERIES
        ====================================== -->

        <a
            href="/Watch_Collection/admin/news"
            class="zeith-nav-item <?= zeithIsActive('/Watch_Collection/admin/news') ?>">

            <span class="zeith-nav-icon">

                <svg viewBox="0 0 24 24">
                    <circle cx="9" cy="8" r="3"></circle>
                    <path d="M3 19c0-3.3 2.7-5 6-5s6 1.7 6 5"></path>
                    <circle cx="17" cy="9" r="2"></circle>
                    <path d="M15 14c2.8-.2 5 1.2 5 4"></path>
                </svg>

            </span>

            <span class="zeith-nav-label">
                news
            </span>



        </a>


    </nav>


    <!-- =========================================
         BOTTOM NAVIGATION
    ========================================== -->

    <div class="zeith-sidebar-bottom">



        <!-- USER -->

        <div class="zeith-sidebar-user">

            <div class="zeith-user-avatar">
                ZP
            </div>

            <div class="zeith-user-info">

                <strong>
                    ZEITH Pay
                </strong>

                <span>
                    Administrator
                </span>

            </div>

        </div>

    </div>

</aside>


<style>
    /* =====================================================
   ZEITH STAFF SIDEBAR
===================================================== */

    .zeith-sidebar {

        --sidebar-bg: #1E293B;
        --sidebar-hover: #26364D;
        --sidebar-active: #2563EB;
        --sidebar-text: #CBD5E1;
        --sidebar-muted: #94A3B8;
        --sidebar-white: #FFFFFF;

        position: fixed;

        top: 0;
        left: 0;

        width: 250px;
        height: 100vh;

        display: flex;
        flex-direction: column;

        background: var(--sidebar-bg);

        color: var(--sidebar-text);

        z-index: 2000;

        font-family:
            Arial,
            Helvetica,
            sans-serif;

        overflow-y: auto;

        scrollbar-width: thin;
        scrollbar-color: #475569 transparent;

        transition:
            transform .3s ease,
            box-shadow .3s ease;
    }


    /* =====================================================
   BRAND
===================================================== */

    .zeith-sidebar-brand {

        height: 78px;

        display: flex;
        align-items: center;

        gap: 12px;

        padding: 0 22px;

        border-bottom: 1px solid rgba(255, 255, 255, .07);

        flex-shrink: 0;
    }


    .zeith-brand-mark {

        width: 36px;
        height: 36px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: #2563EB;

        border-radius: 9px;

        color: #FFFFFF;

        font-size: 17px;
        font-weight: 800;

        flex-shrink: 0;
    }


    .zeith-brand-text {

        display: flex;
        flex-direction: column;

        gap: 2px;
    }


    .zeith-brand-text strong {

        color: #FFFFFF;

        font-size: 18px;

        letter-spacing: .4px;
    }


    .zeith-brand-text span {

        color: #94A3B8;

        font-size: 8px;

        letter-spacing: 1.5px;
    }


    /* =====================================================
   NAVIGATION
===================================================== */

    .zeith-sidebar-nav {

        padding: 25px 13px 10px;
    }


    .zeith-nav-section-title {

        padding: 0 12px 9px;

        color: #64748B;

        font-size: 10px;

        font-weight: 700;

        letter-spacing: 1px;
    }


    /* =====================================================
   NAV ITEM
===================================================== */

    .zeith-nav-item {

        position: relative;

        min-height: 44px;

        width: 100%;

        display: flex;
        align-items: center;

        gap: 12px;

        padding: 0 12px;

        margin-bottom: 4px;

        border-radius: 8px;

        color: var(--sidebar-text);

        text-decoration: none;

        font-size: 13px;

        font-weight: 400;

        box-sizing: border-box;

        transition:
            background .2s ease,
            color .2s ease,
            transform .2s ease;
    }


    /* =====================================================
   HOVER
===================================================== */

    .zeith-nav-item:hover {

        background: var(--sidebar-hover);

        color: #FFFFFF;

        transform: translateX(2px);
    }


    /* =====================================================
   ACTIVE ITEM
===================================================== */

    .zeith-nav-item.active {

        background: #2563EB;

        color: #FFFFFF;

        box-shadow:
            0 4px 12px rgba(37, 99, 235, .20);

        transform: none;
    }


    .zeith-nav-item.active:hover {

        background: #2563EB;

        color: #FFFFFF;

        transform: none;
    }


    /* =====================================================
   ICON
===================================================== */

    .zeith-nav-icon {

        width: 21px;
        height: 21px;

        display: flex;
        align-items: center;
        justify-content: center;

        flex-shrink: 0;
    }


    .zeith-nav-icon svg {

        width: 18px;
        height: 18px;

        fill: none;

        stroke: currentColor;

        stroke-width: 1.7;

        stroke-linecap: round;
        stroke-linejoin: round;
    }


    /* =====================================================
   BADGES
===================================================== */

    .zeith-nav-badge {

        margin-left: auto;

        min-width: 20px;
        height: 20px;

        padding: 0 6px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 10px;

        font-size: 10px;

        font-weight: 700;
    }


    .zeith-nav-badge.warning {

        background: #F59E0B;

        color: #FFFFFF;
    }


    /* =====================================================
   BOTTOM
===================================================== */

    .zeith-sidebar-bottom {

        margin-top: auto;

        padding: 12px 13px 18px;

        border-top: 1px solid rgba(255, 255, 255, .07);
    }


    /* =====================================================
   USER
===================================================== */

    .zeith-sidebar-user {

        margin-top: 13px;

        padding: 12px;

        display: flex;
        align-items: center;

        gap: 10px;

        background: rgba(255, 255, 255, .05);

        border-radius: 9px;
    }


    .zeith-user-avatar {

        width: 34px;
        height: 34px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 8px;

        background: #334155;

        color: #FFFFFF;

        font-size: 11px;

        font-weight: 700;

        flex-shrink: 0;
    }


    .zeith-user-info {

        min-width: 0;

        display: flex;
        flex-direction: column;

        gap: 3px;
    }


    .zeith-user-info strong {

        color: #FFFFFF;

        font-size: 12px;
    }


    .zeith-user-info span {

        color: #94A3B8;

        font-size: 10px;
    }


    /* =====================================================
   MOBILE MENU BUTTON
===================================================== */

    .zeith-mobile-menu-toggle {

        display: none;

        position: fixed;

        top: 16px;
        left: 16px;

        width: 44px;
        height: 44px;

        align-items: center;
        justify-content: center;

        flex-direction: column;

        gap: 5px;

        background: #FFFFFF;

        border: 1px solid #E2E8F0;

        border-radius: 10px;

        box-shadow:
            0 5px 20px rgba(15, 23, 42, .12);

        cursor: pointer;

        z-index: 2500;

        padding: 0;
    }


    .zeith-mobile-menu-toggle span {

        display: block;

        width: 20px;
        height: 2px;

        background: #1E293B;

        border-radius: 2px;

        transition: .25s ease;
    }


    /* =====================================================
   MOBILE CLOSE BUTTON
===================================================== */

    .zeith-sidebar-close {

        display: none;

        position: absolute;

        top: 18px;
        right: 16px;

        width: 36px;
        height: 36px;

        border: none;

        background: rgba(255, 255, 255, .08);

        border-radius: 8px;

        cursor: pointer;

        z-index: 5;
    }


    .zeith-sidebar-close span {

        position: absolute;

        left: 9px;

        width: 18px;
        height: 2px;

        background: #FFFFFF;

        border-radius: 2px;
    }


    .zeith-sidebar-close span:first-child {
        transform: rotate(45deg);
    }


    .zeith-sidebar-close span:last-child {
        transform: rotate(-45deg);
    }


    /* =====================================================
   SIDEBAR OVERLAY
===================================================== */

    .zeith-sidebar-overlay {

        position: fixed;

        inset: 0;

        background: rgba(15, 23, 42, .55);

        backdrop-filter: blur(2px);

        z-index: 1900;

        opacity: 0;

        visibility: hidden;

        pointer-events: none;

        transition:
            opacity .3s ease,
            visibility .3s ease;
    }


    /* =====================================================
   TABLET + IPAD
===================================================== */

    @media (max-width: 1024px) {

        .zeith-sidebar {

            width: 280px;

            transform: translateX(-100%);

            box-shadow:
                10px 0 35px rgba(15, 23, 42, .18);
        }


        .zeith-sidebar.mobile-open {

            transform: translateX(0);
        }


        .zeith-mobile-menu-toggle {

            display: flex;
        }


        .zeith-sidebar-close {

            display: block;
        }


        .zeith-sidebar-overlay.mobile-open {

            opacity: 1;

            visibility: visible;

            pointer-events: auto;
        }


        .zeith-sidebar-brand {

            padding-right: 60px;
        }
    }


    /* =====================================================
   SMALL TABLETS
===================================================== */

    @media (max-width: 767px) {

        .zeith-sidebar {

            width: min(285px, 86vw);
        }


        .zeith-mobile-menu-toggle {

            top: 12px;

            left: 12px;

            width: 42px;

            height: 42px;
        }
    }


    /* =====================================================
   SMALL MOBILE
===================================================== */

    @media (max-width: 480px) {

        .zeith-sidebar {

            width: 280px;

            max-width: 88vw;
        }


        .zeith-sidebar-brand {

            height: 70px;

            padding-left: 18px;

            padding-right: 55px;
        }


        .zeith-sidebar-nav {

            padding-top: 20px;
        }


        .zeith-nav-item {

            min-height: 46px;

            font-size: 13px;
        }
    }


    /* =====================================================
   BODY LOCK
===================================================== */

    body.zeith-menu-open {

        overflow: hidden;
    }


    /* =====================================================
   ACCESSIBILITY
===================================================== */

    .zeith-mobile-menu-toggle:focus-visible,
    .zeith-sidebar-close:focus-visible,
    .zeith-nav-item:focus-visible {

        outline: 3px solid rgba(37, 99, 235, .35);

        outline-offset: 2px;
    }
</style>


<script>
    document.addEventListener("DOMContentLoaded", function() {

        const menuToggle =
            document.getElementById("zeithMenuToggle");

        const sidebar =
            document.getElementById("zeithSidebar");

        const overlay =
            document.getElementById("zeithSidebarOverlay");

        const closeButton =
            document.getElementById("zeithSidebarClose");


        if (!menuToggle || !sidebar || !overlay) {
            return;
        }


        /* =================================================
           MOBILE SIDEBAR
        ================================================= */

        function openSidebar() {

            sidebar.classList.add("mobile-open");

            overlay.classList.add("mobile-open");

            document.body.classList.add("zeith-menu-open");

            menuToggle.setAttribute(
                "aria-expanded",
                "true"
            );

            menuToggle.setAttribute(
                "aria-label",
                "Close navigation menu"
            );
        }


        function closeSidebar() {

            sidebar.classList.remove("mobile-open");

            overlay.classList.remove("mobile-open");

            document.body.classList.remove("zeith-menu-open");

            menuToggle.setAttribute(
                "aria-expanded",
                "false"
            );

            menuToggle.setAttribute(
                "aria-label",
                "Open navigation menu"
            );
        }


        menuToggle.addEventListener(
            "click",
            function() {

                if (
                    sidebar.classList.contains(
                        "mobile-open"
                    )
                ) {

                    closeSidebar();

                } else {

                    openSidebar();

                }

            }
        );


        if (closeButton) {

            closeButton.addEventListener(
                "click",
                closeSidebar
            );

        }


        overlay.addEventListener(
            "click",
            closeSidebar
        );


        /* =================================================
           ACTIVE NAVIGATION
           -----------------------------------------------
           This makes the blue background move immediately
           when a menu item is clicked.
        ================================================= */

        const navLinks =
            sidebar.querySelectorAll(
                ".zeith-nav-item"
            );


        navLinks.forEach(function(link) {

            link.addEventListener(
                "click",
                function() {

                    /*
                     * Remove blue background
                     * from every navigation item.
                     */

                    navLinks.forEach(function(item) {

                        item.classList.remove(
                            "active"
                        );

                    });


                    /*
                     * Give blue background
                     * to the clicked item.
                     */

                    this.classList.add("active");


                    /*
                     * Close mobile menu.
                     */

                    if (window.innerWidth <= 1024) {

                        closeSidebar();

                    }

                }
            );

        });


        /* =================================================
           ESC KEY
        ================================================= */

        document.addEventListener(
            "keydown",
            function(event) {

                if (event.key === "Escape") {

                    closeSidebar();

                }

            }
        );


        /* =================================================
           RESET MOBILE MENU ON DESKTOP
        ================================================= */

        window.addEventListener(
            "resize",
            function() {

                if (window.innerWidth > 1024) {

                    sidebar.classList.remove(
                        "mobile-open"
                    );

                    overlay.classList.remove(
                        "mobile-open"
                    );

                    document.body.classList.remove(
                        "zeith-menu-open"
                    );

                    menuToggle.setAttribute(
                        "aria-expanded",
                        "false"
                    );

                }

            }
        );

    });
</script>