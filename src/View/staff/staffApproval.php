<?php
$user = $_SESSION['user'] ?? [];
$isPending = (($user['status'] ?? '') === 'pending');

// Pass $isPending into your sidebar component or handle it in the sidebar file
\App\Helpers\View::displayComponent("components/sidebar.php", ['isPending' => $isPending]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Approval Pending | ZEITH Staff Panel</title>
</head>

<body>

    <?php
    // views/Staff/order.php
    \App\Helpers\View::displayComponent("Staff/sidebar.php");
    ?>



    <!-- =====================================================
     APPROVAL PENDING PAGE
====================================================== -->

    <main class="zeith-approval-page">

        <section class="zeith-approval-content">

            <!-- CLOCK ICON -->
            <div class="zeith-approval-icon">

                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="12" cy="12" r="9"></circle>
                    <path d="M12 7v5l3 2"></path>
                </svg>

            </div>


            <!-- TITLE -->

            <h1>
                Approval Pending
            </h1>


            <!-- DESCRIPTION -->

            <p class="zeith-approval-description">

                Hello New Seller, your seller account is currently under review by
                our administration team. Approval usually takes less than 24 hours.
                You’ll gain full dashboard access once verified.

            </p>


            <!-- ACTION BUTTONS -->

            <div class="zeith-approval-actions">

                <a
                    href="/Watch_Collection/user/watch"
                    class="zeith-approval-btn zeith-approval-primary">

                    Browse Watches

                </a>


                <button
                    type="button"
                    class="zeith-approval-btn zeith-approval-secondary"
                    onclick="checkApprovalStatus()">

                    <svg viewBox="0 0 24 24">
                        <path d="M20 11a8.1 8.1 0 0 0-14.8-4.5"></path>
                        <path d="M4 5v4h4"></path>
                        <path d="M4 13a8.1 8.1 0 0 0 14.8 4.5"></path>
                        <path d="M20 19v-4h-4"></path>
                    </svg>

                    Check Status Now

                </button>

            </div>


            <!-- HELP -->

            <div class="zeith-approval-help">

                <span class="zeith-help-icon">

                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="9"></circle>
                        <path d="M9.8 9a2.3 2.3 0 1 1 3.8 1.7c-1 .8-1.6 1.2-1.6 2.5"></path>
                        <circle cx="12" cy="16.5" r=".7"></circle>
                    </svg>

                </span>

                <span>
                    Need help?
                </span>

                <a href="/Watch_Collection/contact">
                    Contact Support
                </a>

            </div>


            <!-- BRAND -->

            <div class="zeith-approval-brand">
                ZEITH
            </div>

        </section>

    </main>




    <!-- =====================================================
     INTERNAL CSS
====================================================== -->

    <style>
        /* =====================================================
   ZEITH STAFF APPROVAL PAGE
   STAFF DASHBOARD COLOR SYSTEM
===================================================== */

        :root {

            --zeith-staff-bg: #F4F6F9;
            --zeith-staff-sidebar: #1E293B;

            --zeith-staff-card: #FFFFFF;

            --zeith-staff-text: #0F172A;
            --zeith-staff-muted: #64748B;
            --zeith-staff-light: #94A3B8;

            --zeith-staff-border: #E2E8F0;

            --zeith-staff-primary: #2563EB;
            --zeith-staff-primary-hover: #1D4ED8;

            --zeith-staff-success: #10B981;
            --zeith-staff-warning: #F59E0B;
            --zeith-staff-danger: #EF4444;

        }


        /* =====================================================
   RESET
===================================================== */

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            min-height: 100%;
        }


        /* =====================================================
   PAGE
===================================================== */

        .zeith-approval-page {

            min-height: 100vh;

            width: calc(100% - 250px);

            margin-left: 250px;

            background: var(--zeith-staff-bg);

            display: flex;

            align-items: center;

            justify-content: center;

            padding: 60px 40px;

            font-family:
                Arial,
                Helvetica,
                sans-serif;

            color: var(--zeith-staff-text);

        }


        /* =====================================================
   CONTENT CARD
===================================================== */

        .zeith-approval-content {

            width: 100%;

            max-width: 680px;

            display: flex;

            flex-direction: column;

            align-items: center;

            text-align: center;

            margin-top: -25px;

            padding: 50px 45px;

            background: var(--zeith-staff-card);

            border: 1px solid var(--zeith-staff-border);

            border-radius: 16px;

            box-shadow:
                0 8px 30px rgba(15, 23, 42, .05);

        }


        /* =====================================================
   CLOCK ICON
===================================================== */

        .zeith-approval-icon {

            width: 58px;

            height: 58px;

            display: flex;

            align-items: center;

            justify-content: center;

            margin-bottom: 24px;

            border-radius: 50%;

            color: var(--zeith-staff-primary);

            background: #EFF6FF;

            border: 1px solid #DBEAFE;

            box-shadow:
                0 8px 22px rgba(37, 99, 235, .08);

        }


        .zeith-approval-icon svg {

            width: 29px;

            height: 29px;

            fill: none;

            stroke: currentColor;

            stroke-width: 1.8;

            stroke-linecap: round;

            stroke-linejoin: round;

        }


        /* =====================================================
   TITLE
===================================================== */

        .zeith-approval-content h1 {

            margin: 0 0 12px;

            color: var(--zeith-staff-text);

            font-size: 31px;

            line-height: 1.2;

            font-weight: 800;

            letter-spacing: -.7px;

        }


        /* =====================================================
   DESCRIPTION
===================================================== */

        .zeith-approval-description {

            width: 100%;

            max-width: 560px;

            margin: 0;

            color: var(--zeith-staff-muted);

            font-size: 14px;

            line-height: 1.7;

            font-weight: 400;

        }


        /* =====================================================
   ACTIONS
===================================================== */

        .zeith-approval-actions {

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 12px;

            margin-top: 32px;

        }


        /* =====================================================
   BUTTON
===================================================== */

        .zeith-approval-btn {

            min-height: 50px;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 9px;

            padding: 0 25px;

            border-radius: 9px;

            font-family: inherit;

            font-size: 12px;

            font-weight: 800;

            text-decoration: none;

            cursor: pointer;

            transition:
                transform .2s ease,
                box-shadow .2s ease,
                background .2s ease,
                border-color .2s ease;

        }


        /* =====================================================
   PRIMARY BUTTON
===================================================== */

        .zeith-approval-primary {

            background: var(--zeith-staff-primary);

            color: #FFFFFF;

            border: 1px solid var(--zeith-staff-primary);

            box-shadow:
                0 7px 18px rgba(37, 99, 235, .18);

        }


        .zeith-approval-primary:hover {

            background: var(--zeith-staff-primary-hover);

            border-color: var(--zeith-staff-primary-hover);

            transform: translateY(-1px);

            box-shadow:
                0 10px 24px rgba(37, 99, 235, .22);

        }


        /* =====================================================
   SECONDARY BUTTON
===================================================== */

        .zeith-approval-secondary {

            background: #FFFFFF;

            color: var(--zeith-staff-text);

            border: 1px solid var(--zeith-staff-border);

        }


        .zeith-approval-secondary:hover {

            background: #F8FAFC;

            border-color: #CBD5E1;

            color: var(--zeith-staff-primary);

            transform: translateY(-1px);

            box-shadow:
                0 5px 15px rgba(15, 23, 42, .06);

        }


        .zeith-approval-secondary:disabled {

            cursor: not-allowed;

            transform: none;

        }


        .zeith-approval-secondary svg {

            width: 17px;

            height: 17px;

            fill: none;

            stroke: currentColor;

            stroke-width: 1.7;

            stroke-linecap: round;

            stroke-linejoin: round;

        }


        /* =====================================================
   HELP
===================================================== */

        .zeith-approval-help {

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 6px;

            margin-top: 48px;

            color: var(--zeith-staff-muted);

            font-size: 12px;

        }


        .zeith-approval-help a {

            color: var(--zeith-staff-primary);

            font-weight: 800;

            text-decoration: none;

            transition: color .2s ease;

        }


        .zeith-approval-help a:hover {

            color: var(--zeith-staff-primary-hover);

        }


        .zeith-help-icon {

            width: 17px;

            height: 17px;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            color: var(--zeith-staff-light);

        }


        .zeith-help-icon svg {

            width: 16px;

            height: 16px;

            fill: none;

            stroke: currentColor;

            stroke-width: 1.6;

            stroke-linecap: round;

            stroke-linejoin: round;

        }


        /* =====================================================
   ZEITH BRAND
===================================================== */

        .zeith-approval-brand {

            margin-top: 35px;

            color: #CBD5E1;

            font-family: Georgia, serif;

            font-size: 13px;

            font-weight: 700;

            letter-spacing: 3px;

        }


        /* =====================================================
   TABLET / IPAD
===================================================== */

        @media (max-width: 1024px) {

            .zeith-approval-page {

                width: 100%;

                margin-left: 0;

                min-height: 100vh;

                padding:
                    80px 30px 50px;

            }


            .zeith-approval-content {

                max-width: 620px;

                margin-top: 0;

            }

        }


        /* =====================================================
   MOBILE
===================================================== */

        @media (max-width: 600px) {

            .zeith-approval-page {

                padding:
                    80px 18px 40px;

                align-items: flex-start;

            }


            .zeith-approval-content {

                margin-top: 35px;

                padding:
                    40px 22px;

                border-radius: 13px;

            }


            .zeith-approval-icon {

                width: 50px;

                height: 50px;

                margin-bottom: 20px;

            }


            .zeith-approval-icon svg {

                width: 25px;

                height: 25px;

            }


            .zeith-approval-content h1 {

                font-size: 26px;

            }


            .zeith-approval-description {

                font-size: 13px;

                line-height: 1.7;

            }


            .zeith-approval-actions {

                width: 100%;

                flex-direction: column;

                gap: 10px;

                margin-top: 27px;

            }


            .zeith-approval-btn {

                width: 100%;

                max-width: 330px;

                min-height: 50px;

            }


            .zeith-approval-help {

                flex-wrap: wrap;

                margin-top: 40px;

            }


            .zeith-approval-brand {

                margin-top: 30px;

            }

        }


        /* =====================================================
   SMALL MOBILE
===================================================== */

        @media (max-width: 380px) {

            .zeith-approval-content {

                padding:
                    35px 18px;

            }


            .zeith-approval-content h1 {

                font-size: 24px;

            }


            .zeith-approval-description {

                font-size: 12px;

            }


            .zeith-approval-help {

                font-size: 11px;

            }

        }
    </style>


    <!-- =====================================================
     JAVASCRIPT
====================================================== -->

    <script>
    function checkApprovalStatus() {
        const button = document.querySelector(".zeith-approval-secondary");

        if (!button) {
            // Fallback if button isn't found, reload directly
            window.location.href = '/Watch_Collection/staff/dashboard';
            return;
        }

        // Apply smooth loading state and spinner icon
        button.disabled = true;
        button.style.opacity = "0.7";
        button.innerHTML = `
            <svg viewBox="0 0 24 24" class="spinner" style="animation: spin 1s linear infinite; width: 18px; height: 18px; margin-right: 8px; vertical-align: middle;">
                <path d="M20 11a8.1 8.1 0 0 0-14.8-4.5" fill="none" stroke="currentColor" stroke-width="2"></path>
                <path d="M4 5v4h4" fill="none" stroke="currentColor" stroke-width="2"></path>
            </svg>
            Checking...
        `;

        // Brief delay to display the loading state, then reload the dashboard route
        setTimeout(function() {
            window.location.href = '/Watch_Collection/staff/dashboard';
        }, 600);
    }
</script>

</body>

</html>