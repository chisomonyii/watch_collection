<?php
// Define helper function for escaping if not already loaded globally
if (!function_exists('zeithContactEscape')) {
    function zeithContactEscape($value) {
        return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
    }
}

// Fetch inquiries directly if not passed from Controller
if (!isset($inquiries)) {
    try {
        $pdo = new \PDO("mysql:host=localhost;dbname=watch_collection", "root", "");
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->query("SELECT * FROM contact ORDER BY id DESC");
        $rawInquiries = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $inquiries = [];
        foreach ($rawInquiries as $item) {
            // Handle both column naming conventions (createdAt vs created_at)
            if (!isset($item['created_at']) && isset($item['createdAt'])) {
                $item['created_at'] = $item['createdAt'];
            }
            $inquiries[] = $item;
        }
    } catch (\Exception $e) {
        $inquiries = [];
    }
}

$totalInquiries = isset($inquiries) ? count($inquiries) : 0;
?>
<style>
    /* ============================================================
   ZEITH STAFF CONTACT / CUSTOMER INQUIRIES
============================================================ */

    * {
        box-sizing: border-box;
    }


    html {
        height: 100%;
        overflow: hidden;
    }


    body {
        margin: 0;

        height: 100%;

        background: #F4F6F9;

        color: #0F172A;

        font-family:
            Inter,
            -apple-system,
            BlinkMacSystemFont,
            "Segoe UI",
            Arial,
            sans-serif;

        overflow: hidden;
    }


    /* ============================================================
   PAGE
============================================================ */

    .contact-page {

        margin-left: 250px;

        height: 100vh;

        min-height: 100vh;

        padding: 32px;

        overflow-y: auto;

        scrollbar-width: thin;

        scrollbar-color:
            #CBD5E1 transparent;
    }


    .contact-page::-webkit-scrollbar {
        width: 8px;
    }


    .contact-page::-webkit-scrollbar-track {
        background: transparent;
    }


    .contact-page::-webkit-scrollbar-thumb {

        background: #CBD5E1;

        border-radius: 20px;
    }


    .contact-page::-webkit-scrollbar-thumb:hover {

        background: #94A3B8;
    }


    .contact-content {

        width: 100%;

        max-width: 1500px;

        margin: 0 auto;
    }


    /* ============================================================
   PAGE HEADING
============================================================ */

    .contact-heading {

        margin-bottom: 27px;
    }


    .contact-heading h1 {

        margin: 0 0 7px;

        color: #0F172A;

        font-size: 30px;

        line-height: 1.2;

        font-weight: 800;

        letter-spacing: -.7px;
    }


    .contact-heading p {

        margin: 0;

        color: #64748B;

        font-size: 13px;
    }


    /* ============================================================
   OVERVIEW BAR
============================================================ */

    .contact-overview {

        display: grid;

        grid-template-columns:
            repeat(3, minmax(0, 1fr));

        gap: 16px;

        margin-bottom: 22px;
    }


    .contact-stat {

        display: flex;

        align-items: center;

        gap: 13px;

        min-height: 90px;

        padding: 17px 19px;

        background: #FFFFFF;

        border: 1px solid #E2E8F0;

        border-radius: 13px;

        box-shadow:
            0 4px 18px rgba(15, 23, 42, .04);
    }


    .contact-stat-icon {

        width: 40px;

        height: 40px;

        flex: 0 0 40px;

        display: grid;

        place-items: center;

        border-radius: 10px;

        background: #EFF6FF;

        color: #2563EB;
    }


    .contact-stat-icon svg {

        width: 20px;

        height: 20px;
    }


    .contact-stat-content {

        min-width: 0;
    }


    .contact-stat-label {

        display: block;

        margin-bottom: 4px;

        color: #64748B;

        font-size: 9px;

        font-weight: 800;

        text-transform: uppercase;

        letter-spacing: .65px;
    }


    .contact-stat-number {

        margin: 0;

        color: #0F172A;

        font-size: 22px;

        font-weight: 800;
    }


    /* ============================================================
   INQUIRIES SECTION
============================================================ */

    .inquiries {

        display: flex;

        flex-direction: column;

        gap: 15px;
    }


    /* ============================================================
   INQUIRY CARD
============================================================ */

    .inquiry-card {

        display: flex;

        align-items: stretch;

        justify-content: space-between;

        gap: 25px;

        padding: 22px;

        background: #FFFFFF;

        border: 1px solid #E2E8F0;

        border-radius: 14px;

        box-shadow:
            0 4px 18px rgba(15, 23, 42, .04);

        transition:
            border-color .2s ease,
            box-shadow .2s ease;
    }


    .inquiry-card:hover {

        border-color: #CBD5E1;

        box-shadow:
            0 8px 25px rgba(15, 23, 42, .06);
    }


    /* ============================================================
   MAIN INFORMATION
============================================================ */

    .inquiry-main {

        min-width: 0;

        flex: 1;
    }


    /* ============================================================
   CUSTOMER HEADER
============================================================ */

    .property-header {

        display: flex;

        align-items: center;

        gap: 12px;

        margin-bottom: 18px;
    }


    .property-icon {

        width: 45px;

        height: 45px;

        flex: 0 0 45px;

        display: grid;

        place-items: center;

        border-radius: 11px;

        background: #EFF6FF;

        color: #2563EB;
    }


    .property-icon svg {

        width: 21px;

        height: 21px;
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

        margin: 0;

        color: #0F172A;

        font-size: 16px;

        font-weight: 800;
    }


    /* ============================================================
   INQUIRY BADGE
============================================================ */

    .inquiry-badge {

        display: inline-flex;

        align-items: center;

        gap: 5px;

        padding: 5px 8px;

        border-radius: 20px;

        background: #F1F5F9;

        color: #64748B;

        font-size: 8px;

        font-weight: 800;

        text-transform: uppercase;

        letter-spacing: .4px;
    }


    .inquiry-badge-dot {

        width: 5px;

        height: 5px;

        border-radius: 50%;

        background: #94A3B8;
    }


    /* ============================================================
   CUSTOMER DETAILS
============================================================ */

    .customer-details {

        display: grid;

        grid-template-columns:
            repeat(3, minmax(0, 1fr));

        gap: 10px;

        margin-bottom: 16px;
    }


    .customer-detail {

        min-width: 0;

        display: flex;

        align-items: center;

        gap: 8px;

        padding: 10px 11px;

        border-radius: 8px;

        background: #F8FAFC;

        color: #64748B;

        font-size: 10px;
    }


    .customer-detail svg {

        width: 15px;

        height: 15px;

        flex: 0 0 15px;
    }


    .customer-detail strong {

        min-width: 0;

        overflow: hidden;

        color: #334155;

        font-size: 10px;

        font-weight: 700;

        text-overflow: ellipsis;

        white-space: nowrap;
    }


    /* ============================================================
   MESSAGE
============================================================ */

    .inquiry-message {

        margin-bottom: 15px;

        padding: 14px 16px;

        border-left: 3px solid #2563EB;

        border-radius: 0 9px 9px 0;

        background: #F8FAFC;
    }


    .inquiry-message-label {

        display: block;

        margin-bottom: 6px;

        color: #94A3B8;

        font-size: 8px;

        font-weight: 800;

        text-transform: uppercase;

        letter-spacing: .7px;
    }


    .inquiry-message p {

        margin: 0;

        color: #475569;

        font-size: 12px;

        line-height: 1.65;

        font-style: italic;
    }


    /* ============================================================
   DATE
============================================================ */

    .received-date {

        display: flex;

        align-items: center;

        gap: 7px;

        color: #94A3B8;

        font-size: 10px;
    }


    .received-date svg {

        width: 14px;

        height: 14px;

        flex: 0 0 14px;
    }


    /* ============================================================
   VIEW-ONLY PANEL
============================================================ */

    .inquiry-view-only {

        width: 150px;

        flex: 0 0 150px;

        display: flex;

        align-items: center;

        justify-content: center;

        align-self: center;

        min-height: 76px;

        padding: 15px;

        border: 1px solid #E2E8F0;

        border-radius: 11px;

        background: #F8FAFC;

        text-align: center;
    }


    .inquiry-view-only-inner {

        display: flex;

        flex-direction: column;

        align-items: center;

        gap: 7px;
    }


    .inquiry-view-only svg {

        width: 19px;

        height: 19px;

        color: #64748B;
    }


    .inquiry-view-only strong {

        color: #475569;

        font-size: 9px;

        font-weight: 800;

        text-transform: uppercase;

        letter-spacing: .45px;
    }


    .inquiry-view-only span {

        color: #94A3B8;

        font-size: 8px;

        line-height: 1.4;
    }


    /* ============================================================
   EMPTY STATE
============================================================ */

    .contact-empty {

        padding: 70px 25px;

        background: #FFFFFF;

        border: 1px solid #E2E8F0;

        border-radius: 14px;

        text-align: center;

        box-shadow:
            0 4px 18px rgba(15, 23, 42, .04);
    }


    .contact-empty-icon {

        width: 58px;

        height: 58px;

        margin: 0 auto 15px;

        display: grid;

        place-items: center;

        border-radius: 15px;

        background: #F1F5F9;

        color: #64748B;
    }


    .contact-empty-icon svg {

        width: 27px;

        height: 27px;
    }


    .contact-empty h3 {

        margin: 0 0 6px;

        color: #334155;

        font-size: 16px;

        font-weight: 800;
    }


    .contact-empty p {

        margin: 0;

        color: #94A3B8;

        font-size: 11px;
    }


    /* ============================================================
   FOOTER
============================================================ */

    .contact-footer {

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 15px;

        margin-top: 18px;

        padding-bottom: 20px;

        color: #94A3B8;

        font-size: 10px;
    }


    /* ============================================================
   RESPONSIVE
============================================================ */

    @media (max-width: 1100px) {

        .customer-details {

            grid-template-columns:
                1fr 1fr;
        }


        .inquiry-view-only {

            width: 130px;

            flex-basis: 130px;
        }

    }


    @media (max-width: 1024px) {

        .contact-page {

            margin-left: 0;

            padding: 25px;
        }


        .contact-overview {

            grid-template-columns:
                repeat(3, minmax(0, 1fr));
        }

    }


    @media (max-width: 750px) {

        .contact-page {

            padding: 18px 14px;
        }


        .contact-heading h1 {

            font-size: 25px;
        }


        .contact-overview {

            grid-template-columns: 1fr;
        }


        .inquiry-card {

            flex-direction: column;

            padding: 18px;
        }


        .inquiry-view-only {

            width: 100%;

            flex-basis: auto;

            min-height: 60px;
        }


        .inquiry-view-only-inner {

            flex-direction: row;
        }


        .customer-details {

            grid-template-columns: 1fr;
        }


        .contact-footer {

            flex-direction: column;

            align-items: flex-start;
        }

    }
</style>


<!-- ============================================================
     SIDEBAR
============================================================ -->



<!-- ============================================================
     PAGE
============================================================ -->

<div class="contact-page">

    <?php
    \App\Helpers\View::displayComponent("Staff/sidebar.php");
    ?>

    <main class="contact-content">

        <header class="contact-heading">
            <h1>Customer Inquiries</h1>
            <p>Review customer inquiries and contact information.</p>
        </header>

        <section class="contact-overview">

            <div class="contact-stat">
                <div class="contact-stat-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M21 11.5a8.4 8.4 0 0 1-9 8.5 9.4 9.4 0 0 1-4-.9L3 21l1.5-4.5A8.4 8.4 0 0 1 3 11.5a8.4 8.4 0 0 1 9-8.5 8.4 8.4 0 0 1 9 8.5Z" />
                    </svg>
                </div>

                <div class="contact-stat-content">
                    <span class="contact-stat-label">Total Inquiries</span>
                    <p class="contact-stat-number"><?= number_format($totalInquiries) ?></p>
                </div>
            </div>

            <div class="contact-stat">
                <div class="contact-stat-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <circle cx="12" cy="8" r="3" />
                        <path d="M5 21a7 7 0 0 1 14 0" />
                    </svg>
                </div>

                <div class="contact-stat-content">
                    <span class="contact-stat-label">Customer Contacts</span>
                    <p class="contact-stat-number"><?= number_format($totalInquiries) ?></p>
                </div>
            </div>

            <div class="contact-stat">
                <div class="contact-stat-icon" style="background:#F1F5F9;color:#64748B;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6-10-6-10-6Z" />
                        <circle cx="12" cy="12" r="2.5" />
                    </svg>
                </div>

                <div class="contact-stat-content">
                    <span class="contact-stat-label">Access Level</span>
                    <p class="contact-stat-number" style="font-size:16px;">View Only</p>
                </div>
            </div>

        </section>

        <?php if (!empty($inquiries)): ?>

            <section class="inquiries">

                <?php foreach ($inquiries as $inquiry): ?>

                    <?php
                    $inquiryId = (int)($inquiry['id'] ?? 0);
                    $customerName = trim($inquiry['name'] ?? 'Customer');
                    $customerEmail = trim($inquiry['email'] ?? 'No email provided');
                    $customerPhone = trim($inquiry['phone'] ?? 'No phone provided');
                    $message = trim($inquiry['message'] ?? 'No message provided.');
                    $createdAt = $inquiry['created_at'] ?? '';
                    $formattedDate = 'Unknown date';

                    if (!empty($createdAt)) {
                        $timestamp = strtotime($createdAt);

                        if ($timestamp !== false) {
                            $formattedDate = date('F j, Y', $timestamp);
                        }
                    }

                    $initials = '';
                    $nameParts = preg_split('/\s+/', $customerName);

                    if (!empty($nameParts[0])) {
                        $initials .= strtoupper(substr($nameParts[0], 0, 1));
                    }

                    if (count($nameParts) > 1) {
                        $lastName = end($nameParts);
                        $initials .= strtoupper(substr($lastName, 0, 1));
                    }
                    ?>

                    <article class="inquiry-card" data-inquiry-id="<?= $inquiryId ?>">

                        <div class="inquiry-main">

                            <div class="property-header">
                                <div class="property-icon" style="background:#EFF6FF;color:#2563EB;">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                        <circle cx="12" cy="8" r="3" />
                                        <path d="M5 21a7 7 0 0 1 14 0" />
                                    </svg>
                                </div>

                                <div class="property-title">
                                    <div class="property-title-row">
                                        <h2><?= zeithContactEscape($customerName) ?></h2>

                                        <span class="inquiry-badge">
                                            <span class="inquiry-badge-dot"></span>
                                            Inquiry
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="customer-details">

                                <div class="customer-detail">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                        <circle cx="12" cy="8" r="3" />
                                        <path d="M5 21a7 7 0 0 1 14 0" />
                                    </svg>
                                    <strong><?= zeithContactEscape($customerName) ?></strong>
                                </div>

                                <div class="customer-detail">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                        <rect x="3" y="5" width="18" height="14" rx="2" />
                                        <path d="m3 7 9 6 9-6" />
                                    </svg>
                                    <strong><?= zeithContactEscape($customerEmail) ?></strong>
                                </div>

                                <div class="customer-detail">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                        <path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6 19.8 19.8 0 0 1-3.1-8.6A2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 2 .7 2.9a2 2 0 0 1-.5 2.1L8 9.9a16 16 0 0 0 6 6l1.2-1.3a2 2 0 0 1 2.1-.5c.9.3 1.9.6 2.9.7a2 2 0 0 1 1.8 2.1Z" />
                                    </svg>
                                    <strong><?= zeithContactEscape($customerPhone) ?></strong>
                                </div>

                            </div>

                            <div class="inquiry-message">
                                <span class="inquiry-message-label">Customer Message</span>
                                <p>"<?= zeithContactEscape($message) ?>"</p>
                            </div>

                            <div class="received-date">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <rect x="3" y="4" width="18" height="18" rx="2" />
                                    <path d="M16 2v4" />
                                    <path d="M8 2v4" />
                                    <path d="M3 10h18" />
                                </svg>
                                <span>Received on <?= zeithContactEscape($formattedDate) ?></span>
                            </div>

                        </div>

                        <aside class="inquiry-view-only">
                            <div class="inquiry-view-only-inner">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6-10-6-10-6Z" />
                                    <circle cx="12" cy="12" r="2.5" />
                                </svg>

                                <strong>View Only</strong>
                                <span>Staff can review this inquiry.</span>
                            </div>
                        </aside>

                    </article>

                <?php endforeach; ?>

            </section>

        <?php else: ?>

            <div class="contact-empty">

                <div class="contact-empty-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M21 11.5a8.4 8.4 0 0 1-9 8.5 9.4 9.4 0 0 1-4-.9L3 21l1.5-4.5A8.4 8.4 0 0 1 3 11.5a8.4 8.4 0 0 1 9-8.5 8.4 8.4 0 0 1 9 8.5Z" />
                    </svg>
                </div>

                <h3>No Customer Inquiries</h3>

                <p>Customer inquiries will appear here when they are submitted.</p>

            </div>

        <?php endif; ?>

        <footer class="contact-footer">
            <span>ZEITH Customer Inquiries</span>

            <span>
                <?= number_format($totalInquiries) ?>
                inquiry(ies)
            </span>
        </footer>

    </main>

</div>