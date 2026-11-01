<?php
\App\Helpers\View::displayComponent("admin/sidebar.php");

// Fetch user and session contacts safely
$user = $_SESSION['user'] ?? [];
$isAdmin = ($user['role'] ?? '') === 'admin';
$contacts = $_SESSION['admin_contacts'] ?? [];
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Customer Inquiries | ZEITH Staff</title>

    <style>
        /* =====================================================
           ZEITH CONTACT / CUSTOMER INQUIRIES
           ===================================================== */

        :root {
            --page-bg: #F4F6F9;
            --card-bg: #FFFFFF;

            --sidebar-bg: #1E293B;

            --primary: #2563EB;
            --primary-dark: #1D4ED8;

            --teal: #0EA5A4;
            --teal-dark: #0F8F8E;
            --teal-light: #DDF8F7;

            --text: #0F172A;
            --text-secondary: #475569;
            --text-muted: #64748B;
            --text-light: #94A3B8;

            --border: #E2E8F0;

            --blue-light: #DBEAFE;

            --shadow:
                0 1px 3px rgba(15, 23, 42, 0.05),
                0 8px 25px rgba(15, 23, 42, 0.045);
        }


        /* =====================================================
           RESET
           ===================================================== */

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }


        html {
            width: 100%;
            overflow-x: hidden;
        }


        body {
            width: 100%;
            min-height: 100vh;

            background: var(--page-bg);

            color: var(--text);

            font-family:
                Inter,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                Roboto,
                Helvetica,
                Arial,
                sans-serif;

            overflow-x: hidden;
        }


        button,
        input,
        textarea {
            font-family: inherit;
        }


        /* =====================================================
           MAIN PAGE
           ===================================================== */

        .contact-page {

            margin-left: 250px;

            width: calc(100% - 250px);

            min-height: 100vh;

            background: var(--page-bg);

            transition:
                margin-left 0.25s ease,
                width 0.25s ease;
        }


        .contact-content {

            width: 100%;

            max-width: 1600px;

            margin: 0 auto;

            padding:
                36px 32px 60px;
        }


        /* =====================================================
           PAGE HEADER
           ===================================================== */

        .contact-heading {

            margin-bottom: 32px;
        }


        .contact-heading h1 {

            color: var(--text);

            font-size: clamp(26px,
                    3vw,
                    34px);

            line-height: 1.15;

            font-weight: 750;

            letter-spacing: -0.035em;

            margin-bottom: 9px;
        }


        .contact-heading p {

            color: var(--text-muted);

            font-size: 14px;

            line-height: 1.6;
        }


        /* =====================================================
           INQUIRIES
           ===================================================== */

        .inquiries {

            width: 100%;

            display: flex;

            flex-direction: column;

            gap: 18px;
        }


        /* =====================================================
           INQUIRY CARD
           ===================================================== */

        .inquiry-card {

            width: 100%;

            background: var(--card-bg);

            border: 1px solid #EEF2F6;

            border-radius: 16px;

            box-shadow: var(--shadow);

            padding: 28px;

            display: grid;

            grid-template-columns:
                minmax(0, 1fr) 160px;

            column-gap: 28px;

            align-items: center;

            overflow: hidden;
        }


        /* =====================================================
           MAIN INFORMATION
           ===================================================== */

        .inquiry-main {

            min-width: 0;

            width: 100%;
        }


        /* =====================================================
           PROPERTY HEADER
           ===================================================== */

        .property-header {

            width: 100%;

            display: flex;

            align-items: center;

            gap: 12px;

            margin-bottom: 16px;
        }


        .property-icon {

            width: 54px;
            height: 54px;

            min-width: 54px;

            border-radius: 9px;

            background: var(--teal-light);

            color: var(--teal);

            display: flex;

            align-items: center;

            justify-content: center;
        }


        .property-icon svg {

            width: 24px;
            height: 24px;
        }


        .property-title {

            min-width: 0;

            flex: 1;
        }


        .property-title-row {

            display: flex;

            align-items: center;

            gap: 9px;

            flex-wrap: wrap;
        }


        .property-title h2 {

            min-width: 0;

            color: var(--text);

            font-size: 18px;

            line-height: 1.35;

            font-weight: 750;

            overflow-wrap: anywhere;
        }


        .new-badge {

            flex-shrink: 0;

            background: var(--blue-light);

            color: var(--primary);

            padding: 4px 8px;

            border-radius: 5px;

            font-size: 9px;

            line-height: 1;

            font-weight: 800;

            text-transform: uppercase;

            letter-spacing: 0.04em;
        }


        /* =====================================================
           CUSTOMER DETAILS
           ===================================================== */

        .customer-details {

            width: 100%;

            background: #F8FAFC;

            border-radius: 8px;

            padding: 12px 15px;

            margin-bottom: 20px;

            display: flex;

            align-items: center;

            gap: 18px;

            flex-wrap: wrap;

            overflow: hidden;
        }


        .customer-detail {

            min-width: 0;

            max-width: 100%;

            display: flex;

            align-items: center;

            gap: 7px;

            color: var(--text-muted);

            font-size: 12px;
        }


        .customer-detail svg {

            width: 14px;
            height: 14px;

            min-width: 14px;

            color: #64748B;
        }


        .customer-detail strong {

            color: var(--text-secondary);

            font-weight: 600;

            overflow-wrap: anywhere;
        }


        /* =====================================================
           MESSAGE
           ===================================================== */

        .inquiry-message {

            position: relative;

            width: 100%;

            padding-left: 14px;

            margin-bottom: 19px;
        }


        .inquiry-message::before {

            content: "";

            position: absolute;

            left: 0;

            top: 2px;

            bottom: 2px;

            width: 2px;

            border-radius: 5px;

            background: #E2E8F0;
        }


        .inquiry-message p {

            color: var(--text-secondary);

            font-size: 13px;

            line-height: 1.65;

            font-style: italic;

            overflow-wrap: anywhere;
        }


        /* =====================================================
           RECEIVED DATE
           ===================================================== */

        .received-date {

            display: flex;

            align-items: center;

            gap: 7px;

            color: var(--text-muted);

            font-size: 11px;

            font-weight: 500;
        }


        .received-date svg {

            width: 14px;
            height: 14px;

            min-width: 14px;
        }


        /* =====================================================
           ACTION AREA
           ===================================================== */

        .inquiry-actions {

            width: 100%;

            display: flex;

            flex-direction: column;

            align-items: stretch;

            gap: 10px;
        }


        /* =====================================================
           VIEW PROPERTY
           ===================================================== */

        .view-property {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 6px;

            min-height: 30px;

            color: var(--text-secondary);

            text-decoration: none;

            font-size: 11px;

            font-weight: 600;

            transition: color 0.2s ease;
        }


        .view-property:hover {

            color: var(--primary);
        }


        .view-property svg {

            width: 13px;
            height: 13px;
        }


        /* =====================================================
           ACTION BUTTON
           ===================================================== */

        .inquiry-btn {

            width: 100%;

            min-height: 44px;

            border: 0;

            border-radius: 9px;

            padding: 10px 12px;

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 7px;

            color: #FFFFFF;

            font-size: 11px;

            font-weight: 700;

            cursor: pointer;

            transition:
                background 0.2s ease,
                transform 0.15s ease,
                box-shadow 0.2s ease;
        }


        .inquiry-btn:active {

            transform: scale(0.98);
        }


        .inquiry-btn svg {

            width: 14px;
            height: 14px;

            flex-shrink: 0;
        }


        /* =====================================================
           MARK READ
           ===================================================== */

        .mark-read {

            background: var(--teal);

            box-shadow:
                0 4px 10px rgba(14, 165, 164, 0.13);
        }


        .mark-read:hover {

            background: var(--teal-dark);

            box-shadow:
                0 6px 14px rgba(14, 165, 164, 0.18);
        }


        /* =====================================================
           MESSAGE BUTTON
           ===================================================== */

        .message-btn {

            background: var(--primary);

            box-shadow:
                0 4px 10px rgba(37, 99, 235, 0.12);
        }


        .message-btn:hover {

            background: var(--primary-dark);

            box-shadow:
                0 6px 14px rgba(37, 99, 235, 0.18);
        }


        /* =====================================================
           EMPTY STATE
           ===================================================== */

        .empty-state {

            display: none;

            width: 100%;

            background: #FFFFFF;

            border: 1px solid var(--border);

            border-radius: 16px;

            padding: 70px 25px;

            text-align: center;
        }


        /* =====================================================
           MESSAGE MODAL
           ===================================================== */

        .message-modal {

            position: fixed;

            inset: 0;

            z-index: 99999;

            display: none;

            align-items: center;

            justify-content: center;

            padding: 20px;

            background:
                rgba(15, 23, 42, 0.58);
        }


        .message-modal.active {

            display: flex;
        }


        .message-modal-box {

            width: min(100%,
                    520px);

            max-height: calc(100vh - 40px);

            overflow-y: auto;

            background: #FFFFFF;

            border-radius: 15px;

            box-shadow:
                0 25px 60px rgba(15, 23, 42, 0.2);
        }


        .message-modal-header {

            padding: 18px 20px;

            border-bottom: 1px solid var(--border);

            display: flex;

            align-items: center;

            justify-content: space-between;
        }


        .message-modal-header h3 {

            font-size: 16px;

            font-weight: 700;
        }


        .close-message {

            width: 32px;
            height: 32px;

            border: 0;

            border-radius: 7px;

            background: #F1F5F9;

            color: #64748B;

            cursor: pointer;
        }


        .message-modal-body {

            padding: 20px;
        }


        .message-recipient {

            background: #F8FAFC;

            border-radius: 8px;

            padding: 12px;

            margin-bottom: 15px;

            color: var(--text-muted);

            font-size: 12px;

            overflow-wrap: anywhere;
        }


        .message-recipient strong {

            color: var(--text);
        }


        .message-input {

            display: block;

            width: 100%;

            min-height: 140px;

            resize: vertical;

            border: 1px solid var(--border);

            border-radius: 9px;

            padding: 12px;

            outline: none;

            color: var(--text);

            font-size: 13px;
        }


        .message-input:focus {

            border-color: var(--primary);

            box-shadow:
                0 0 0 3px rgba(37, 99, 235, 0.08);
        }


        .message-modal-footer {

            padding: 14px 20px;

            border-top: 1px solid var(--border);

            display: flex;

            justify-content: flex-end;

            gap: 8px;
        }


        .modal-btn {

            min-height: 38px;

            padding: 0 15px;

            border-radius: 7px;

            border: 1px solid var(--border);

            background: #FFFFFF;

            color: var(--text);

            font-size: 12px;

            font-weight: 700;

            cursor: pointer;
        }


        .modal-btn.send {

            background: var(--primary);

            border-color: var(--primary);

            color: #FFFFFF;
        }


        /* =====================================================
           TABLET
           768px - 1023px
           ===================================================== */

        @media (min-width: 768px) and (max-width: 1023px) {

            /*
             * Sidebar becomes 72px.
             * This prevents the 250px sidebar from stealing
             * too much iPad space.
             */

            .contact-page {

                margin-left: 72px;

                width: calc(100% - 72px);
            }


            .contact-content {

                padding:
                    30px 24px 50px;
            }


            .contact-heading {

                margin-bottom: 27px;
            }


            .contact-heading h1 {

                font-size: 30px;
            }


            /*
             * IMPORTANT:
             * Tablet gets a single-column inquiry card.
             */

            .inquiry-card {

                grid-template-columns: 1fr;

                gap: 22px;

                padding: 24px;
            }


            /*
             * Put actions beside each other on iPad.
             */

            .inquiry-actions {

                display: grid;

                grid-template-columns:
                    minmax(0, 1fr) minmax(0, 1fr);

                gap: 10px;
            }


            .view-property {

                grid-column: 1 / -1;

                justify-content: flex-start;

                min-height: 28px;
            }


            .inquiry-btn {

                min-height: 46px;
            }


            .customer-details {

                gap: 12px 20px;
            }

        }


        /* =====================================================
           SMALL TABLET / LARGE PHONE
           600px - 767px
           ===================================================== */

        @media (min-width: 600px) and (max-width: 767px) {

            .contact-page {

                margin-left: 0;

                width: 100%;
            }


            .contact-content {

                padding:
                    25px 20px 45px;
            }


            .inquiry-card {

                grid-template-columns: 1fr;

                padding: 22px;

                gap: 20px;
            }


            .inquiry-actions {

                display: grid;

                grid-template-columns: 1fr 1fr;

                gap: 9px;
            }


            .view-property {

                grid-column: 1 / -1;

                justify-content: flex-start;
            }

        }


        /* =====================================================
           MOBILE
           0px - 599px
           ===================================================== */

        @media (max-width: 599px) {

            .contact-page {

                margin-left: 0;

                width: 100%;

                min-width: 0;
            }


            .contact-content {

                width: 100%;

                padding:
                    22px 14px 40px;
            }


            .contact-heading {

                margin-bottom: 22px;
            }


            .contact-heading h1 {

                font-size: 26px;

                letter-spacing: -0.025em;
            }


            .contact-heading p {

                font-size: 13px;

                max-width: 320px;
            }


            .inquiries {

                gap: 14px;
            }


            /*
             * Everything becomes one clean column.
             */

            .inquiry-card {

                display: block;

                width: 100%;

                padding: 18px;

                border-radius: 13px;
            }


            .property-header {

                align-items: flex-start;

                gap: 10px;

                margin-bottom: 15px;
            }


            .property-icon {

                width: 44px;
                height: 44px;

                min-width: 44px;
            }


            .property-icon svg {

                width: 20px;
                height: 20px;
            }


            .property-title h2 {

                font-size: 16px;

                line-height: 1.4;
            }


            .new-badge {

                font-size: 8px;

                padding:
                    4px 7px;
            }


            /*
             * Customer information stacks vertically.
             */

            .customer-details {

                display: flex;

                flex-direction: column;

                align-items: stretch;

                gap: 10px;

                padding: 12px;

                margin-bottom: 18px;
            }


            .customer-detail {

                width: 100%;

                min-width: 0;
            }


            .customer-detail strong {

                min-width: 0;

                overflow-wrap: anywhere;
            }


            .inquiry-message {

                margin-bottom: 17px;
            }


            .inquiry-message p {

                font-size: 12.5px;
            }


            .received-date {

                font-size: 10.5px;

                margin-bottom: 20px;
            }


            /*
             * Buttons become full width.
             */

            .inquiry-actions {

                width: 100%;

                display: flex;

                flex-direction: column;

                gap: 9px;
            }


            .view-property {

                order: 1;

                justify-content: flex-start;

                min-height: 32px;
            }


            .mark-read {

                order: 2;
            }


            .message-btn {

                order: 3;
            }


            .inquiry-btn {

                min-height: 45px;

                width: 100%;
            }


            /* Modal */

            .message-modal {

                padding: 12px;
            }


            .message-modal-box {

                max-height:
                    calc(100vh - 24px);

                border-radius: 12px;
            }


            .message-modal-header {

                padding:
                    15px 16px;
            }


            .message-modal-body {

                padding: 16px;
            }


            .message-modal-footer {

                padding:
                    12px 16px;
            }


            .modal-btn {

                flex: 1;

                min-height: 42px;
            }

        }


        /* =====================================================
           VERY SMALL PHONES
           <= 380px
           ===================================================== */

        @media (max-width: 380px) {

            .contact-content {

                padding-left: 10px;

                padding-right: 10px;
            }


            .inquiry-card {

                padding: 15px;
            }


            .property-title h2 {

                font-size: 15px;
            }


            .customer-details {

                padding: 10px;
            }


            .contact-heading h1 {

                font-size: 24px;
            }

        }


        /* =====================================================
           TOUCH DEVICES
           ===================================================== */

        @media (hover: none) {

            .inquiry-card:hover {

                transform: none;

                box-shadow: var(--shadow);
            }


            .mark-read:hover,
            .message-btn:hover {

                box-shadow: none;
            }

        }


        /* =====================================================
           REDUCED MOTION
           ===================================================== */

        @media (prefers-reduced-motion: reduce) {

            * {

                scroll-behavior: auto !important;

                transition: none !important;

                animation: none !important;
            }

        }
    </style>

</head>


<body>
    <?php
    \App\Helpers\View::displayComponent("admin/sidebar.php");
    ?>

    <div class="contact-page">
        <main class="contact-content">
            <header class="contact-heading">
                <h1>Customer Inquiries</h1>
                <p>Review and respond to client messages regarding ZEITH luxury timepieces.</p>
            </header>

            <section class="inquiries">
                <?php if (empty($contacts)): ?>
                    <div class="no-inquiries" style="padding: 2rem; background: #fff; border-radius: 12px; text-align: center; color: #64748b;">
                        <p>No customer inquiries found.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($contacts as $contact): ?>
                        <?php
                        $isRead = ($contact['status'] ?? 'unread') === 'read';
                        $createdDate = !empty($contact['createdAt']) ? date('n/j/Y', strtotime($contact['createdAt'])) : (!empty($contact['created_at']) ? date('n/j/Y', strtotime($contact['created_at'])) : 'N/A');
                        ?>
                        <article class="inquiry-card <?= $isRead ? 'read-card' : '' ?>">
                            <div class="inquiry-main">
                                <div class="property-header">
                                    <div class="property-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                        </svg>
                                    </div>

                                    <div class="property-title">
                                        <div class="property-title-row">
                                            <h2><?= htmlspecialchars($contact['name'] ?? 'Unknown Customer') ?></h2>
                                            <?php if (!$isRead): ?>
                                                <span class="new-badge">New</span>
                                            <?php else: ?>
                                                <span class="read-badge" style="background: #e2e8f0; color: #475569; padding: 2px 8px; border-radius: 12px; font-size: 0.75rem;">Read</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="customer-details">
                                    <div class="customer-detail">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <circle cx="12" cy="8" r="3" />
                                            <path d="M5 21a7 7 0 0 1 14 0" />
                                        </svg>
                                        <strong><?= htmlspecialchars($contact['name'] ?? 'N/A') ?></strong>
                                    </div>

                                    <div class="customer-detail">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <rect x="3" y="5" width="18" height="14" rx="2" />
                                            <path d="m3 7 9 6 9-6" />
                                        </svg>
                                        <strong><?= htmlspecialchars($contact['email'] ?? 'N/A') ?></strong>
                                    </div>

                                    <div class="customer-detail">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6 19.8 19.8 0 0 1-3.1-8.6A2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 2 .7 2.9a2 2 0 0 1-.5 2.1L8 9.9a16 16 0 0 0 6 6l1.2-1.3a2 2 0 0 1 2.1-.5c.9.3 1.9.6 2.9.7a2 2 0 0 1 1.8 2.1Z" />
                                        </svg>
                                        <strong><?= htmlspecialchars($contact['phone'] ?? 'N/A') ?></strong>
                                    </div>
                                </div>

                                <div class="inquiry-message">
                                    <p>"<?= htmlspecialchars($contact['message'] ?? '') ?>"</p>
                                </div>

                                <div class="received-date">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="4" width="18" height="18" rx="2" />
                                        <path d="M16 2v4" />
                                        <path d="M8 2v4" />
                                        <path d="M3 10h18" />
                                    </svg>
                                    <span>Received on <?= $createdDate ?></span>
                                </div>
                            </div>

                            <div class="inquiry-actions">
                                <?php if ($isAdmin): ?>
                                    <?php if (!$isRead): ?>
                                        <a href="/Zeith/admin/contact/read/<?= $contact['id'] ?>"
                                            class="inquiry-btn mark-read"
                                            style="text-decoration: none;"
                                            onclick="removeCard(event, this)">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="m5 12 4 4L19 6" />
                                            </svg>
                                            <span>Mark as Read</span>
                                        </a>
                                    <?php endif; ?>

                                    <button type="button" class="inquiry-btn message-btn" onclick="openMessageModal('<?= htmlspecialchars($contact['email']) ?>')">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M21 11.5a8.4 8.4 0 0 1-9 8.5 9.4 9.4 0 0 1-4-.9L3 21l1.5-4.5A8.4 8.4 0 0 1 3 11.5a8.4 8.4 0 0 1 9-8.5 8.4 8.4 0 0 1 9 8.5Z" />
                                        </svg>
                                        <span>Message</span>
                                    </button>
                                <?php else: ?>
                                    <span class="staff-readonly-tag" style="font-size: 0.85rem; color: #94a3b8; font-weight: 500;">View Only</span>
                                <?php endif; ?>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php endif; ?>
            </section>
        </main>
    </div>

    <!-- Message Modal -->
    <!-- Message Modal Form -->
    <div class="message-modal" id="messageModal">
        <div class="message-modal-box">
            <form action="/Zeith/admin/contact/send-message" method="POST" id="sendMessageForm">
                <div class="message-modal-header">
                    <h3>Message Customer</h3>
                    <button type="button" class="close-message" onclick="closeMessageModal()" aria-label="Close">✕</button>
                </div>

                <div class="message-modal-body">
                    <div class="message-recipient">
                        Sending message to:
                        <strong id="modalRecipientEmailText">--</strong>
                    </div>

                    <!-- Hidden Input for Target Email -->
                    <input type="hidden" name="email" id="modalRecipientEmailInput" value="" />

                    <textarea class="message-input" name="message" id="modalMessageBody" placeholder="Write your message to the customer..." required></textarea>
                </div>

                <div class="message-modal-footer">
                    <button type="button" class="modal-btn" onclick="closeMessageModal()">Cancel</button>
                    <button type="submit" class="modal-btn send">Send Message</button>
                </div>
            </form>
        </div>
    </div>

    <!-- =====================================================
         JAVASCRIPT
         ===================================================== -->

    <script>
        let currentRecipientEmail = '';

        function openMessageModal(email) {
            currentRecipientEmail = email;
            const recipientElem = document.getElementById('modalRecipientEmail');
            const bodyElem = document.getElementById('modalMessageBody');
            const modal = document.getElementById('messageModal');

            if (recipientElem) recipientElem.textContent = email;
            if (bodyElem) bodyElem.value = '';
            if (modal) modal.classList.add('active');
        }

        function closeMessageModal() {
            const modal = document.getElementById('messageModal');
            if (modal) modal.classList.remove('active');
        }

        function sendMessage() {
            const bodyElem = document.getElementById('modalMessageBody');
            const messageBody = bodyElem ? bodyElem.value.trim() : '';

            if (!messageBody) {
                alert('Please write a message before sending.');
                return;
            }

            const subject = "ZEITH Luxury Timepieces - Regarding Your Inquiry";
            const mailtoUrl = `mailto:${encodeURIComponent(currentRecipientEmail)}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(messageBody)}`;

            window.location.href = mailtoUrl;
            closeMessageModal();
        }

        function openMessageModal(email) {
            document.getElementById('modalRecipientEmailText').textContent = email;
            document.getElementById('modalRecipientEmailInput').value = email;
            document.getElementById('modalMessageBody').value = '';

            const modal = document.getElementById('messageModal');
            if (modal) modal.classList.add('active');
        }

        function closeMessageModal() {
            const modal = document.getElementById('messageModal');
            if (modal) modal.classList.remove('active');
        }

        function removeCard(event, element) {
            event.preventDefault();
            const targetUrl = element.getAttribute('href');
            const card = element.closest('.inquiry-card');

            // Add smooth fade-out animation
            if (card) {
                card.style.transition = 'all 0.3s ease';
                card.style.opacity = '0';
                card.style.transform = 'scale(0.95)';
            }

            // Navigate after animation completes
            setTimeout(() => {
                window.location.href = targetUrl;
            }, 300);
        }
    </script>


</body>

</html>