<?php
if (!function_exists('zeithSubscriberValue')) {
    function zeithSubscriberValue($val)
    {
        return htmlspecialchars($val ?? '', ENT_QUOTES, 'UTF-8');
    }
}

$subscribers = $subscribers ?? [];
$totalSubscribers = $totalSubscribers ?? 0;
$newToday = $newToday ?? 0;
$interests = $interests ?? [];
$deleteMessage = $deleteMessage ?? null;
?>


<style>
    /* =========================================================
   ZEITH SUBSCRIBER MANAGEMENT
========================================================= */

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
        font-family: Inter, Arial, sans-serif;
        background: #F4F6F9;
        color: #0F172A;
        overflow: hidden;
    }


    /* =========================================================
   PAGE
========================================================= */

    .zeith-subscriber-page {

        min-height: 100vh;
        height: 100vh;

        margin-left: 250px;

        padding: 32px;

        overflow-y: auto;

        scrollbar-width: thin;
        scrollbar-color: #94A3B8 transparent;
    }


    /* Scrollbar */

    .zeith-subscriber-page::-webkit-scrollbar {
        width: 8px;
    }

    .zeith-subscriber-page::-webkit-scrollbar-track {
        background: transparent;
    }

    .zeith-subscriber-page::-webkit-scrollbar-thumb {
        background: #CBD5E1;
        border-radius: 20px;
    }

    .zeith-subscriber-page::-webkit-scrollbar-thumb:hover {
        background: #94A3B8;
    }


    .zeith-subscriber-container {

        max-width: 1500px;

        margin: 0 auto;
    }


    /* =========================================================
   HEADER
========================================================= */

    .zeith-subscriber-header {

        display: flex;

        align-items: flex-start;

        justify-content: space-between;

        gap: 20px;

        margin-bottom: 28px;
    }

    .newsletter-centre-btn {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        padding: 12px 19px;
        background: #003b2f;
        color: #fff;
        border: none;
        border-radius: 7px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: .3s ease;
    }

    .newsletter-centre-btn:hover {
        background: #f68b1e;
    }

    .newsletter-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, .62);
        z-index: 10000;
        display: flex;
        justify-content: flex-end;
        visibility: hidden;
        opacity: 0;
        transition: opacity .3s ease, visibility .3s ease;
    }

    .newsletter-overlay.active {
        visibility: visible;
        opacity: 1;
    }

    .newsletter-centre {
        width: 100%;
        max-width: 560px;
        height: 100%;
        overflow-y: auto;
        background: #fff;
        padding: 35px;
        transform: translateX(100%);
        transition: transform .35s ease;
    }

    .newsletter-overlay.active .newsletter-centre {
        transform: translateX(0);
    }

    .newsletter-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 15px;
        padding-bottom: 25px;
        border-bottom: 1px solid #eee;
        margin-bottom: 25px;
    }

    .newsletter-eyebrow {
        color: #f68b1e;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 2px;
    }

    .newsletter-header h2 {
        color: #003b2f;
        font-size: 25px;
        margin: 9px 0;
    }

    .newsletter-header p {
        color: #777;
        font-size: 13px;
        line-height: 1.6;
        margin: 0;
    }

    .newsletter-close {
        width: 38px;
        height: 38px;
        flex-shrink: 0;
        border: none;
        border-radius: 50%;
        background: #f5f5f5;
        color: #333;
        cursor: pointer;
        font-size: 17px;
    }

    .newsletter-close:hover {
        background: #f68b1e;
        color: #fff;
    }

    .newsletter-field {
        margin-bottom: 23px;
    }

    .newsletter-field>label {
        display: block;
        font-size: 13px;
        font-weight: 700;
        color: #222;
        margin-bottom: 11px;
    }

    .recipient-options {
        display: grid;
        gap: 12px;
    }

    .recipient-option {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        border: 1px solid #e5e5e5;
        padding: 16px;
        border-radius: 9px;
        cursor: pointer;
        transition: .2s ease;
    }

    .recipient-option:has(input:checked) {
        border-color: #f68b1e;
        background: #fffaf4;
    }

    .recipient-option input {
        accent-color: #f68b1e;
        margin-top: 4px;
    }

    .recipient-option span {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .recipient-option span>i {
        color: #f68b1e;
        font-size: 16px;
        margin-bottom: 3px;
    }

    .recipient-option strong {
        color: #003b2f;
        font-size: 13px;
    }

    .recipient-option small {
        color: #777;
        font-size: 11px;
    }

    .recipient-hint {
        color: #888;
        font-size: 11px;
        margin-top: 10px;
    }

    .newsletter-field input,
    .newsletter-field textarea {
        width: 100%;
        padding: 13px 14px;
        border: 1px solid #ddd;
        border-radius: 7px;
        outline: none;
        font-family: inherit;
        font-size: 13px;
        color: #333;
        background: #fff;
    }

    .newsletter-field input:focus,
    .newsletter-field textarea:focus {
        border-color: #f68b1e;
    }

    .newsletter-field textarea {
        resize: vertical;
        min-height: 170px;
        line-height: 1.7;
    }

    .newsletter-footer {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 28px;
    }

    .newsletter-cancel,
    .newsletter-send {
        padding: 12px 19px;
        border: none;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
    }

    .newsletter-cancel {
        background: #eee;
        color: #333;
    }

    .newsletter-send {
        background: #f68b1e;
        color: #fff;
    }

    .newsletter-send:hover {
        background: #003b2f;
    }

    .newsletter-send:disabled {
        opacity: .6;
        cursor: not-allowed;
    }

    .newsletter-status {
        font-size: 12px;
        margin-top: 15px;
        line-height: 1.6;
    }

    @media (max-width: 600px) {
        .newsletter-centre {
            padding: 24px 18px;
        }

        .newsletter-header h2 {
            font-size: 21px;
        }

        .newsletter-footer {
            flex-direction: column-reverse;
        }

        .newsletter-footer button {
            width: 100%;
        }
    }


    .zeith-subscriber-heading h1 {

        margin: 0 0 8px;

        font-size: 30px;

        font-weight: 800;

        letter-spacing: -.7px;
    }


    .zeith-subscriber-heading p {

        margin: 0;

        color: #64748B;

        font-size: 14px;
    }


    /* Export button */

    .zeith-export-all {

        display: inline-flex;

        align-items: center;

        gap: 9px;

        border: 0;

        border-radius: 10px;

        padding: 12px 17px;

        background: #2563EB;

        color: #FFFFFF;

        text-decoration: none;

        font-size: 13px;

        font-weight: 800;

        transition: .2s ease;
    }


    .zeith-export-all:hover {

        background: #1D4ED8;

        transform: translateY(-1px);
    }


    .zeith-export-all svg {

        width: 17px;

        height: 17px;
    }


    /* =========================================================
   ALERT
========================================================= */

    .zeith-subscriber-alert {

        margin-bottom: 20px;

        padding: 14px 17px;

        border-radius: 10px;

        background: #ECFDF5;

        border: 1px solid #A7F3D0;

        color: #047857;

        font-size: 13px;

        font-weight: 700;
    }


    /* =========================================================
   STAT CARDS
========================================================= */

    .zeith-subscriber-stats {

        display: grid;

        grid-template-columns:
            repeat(3, minmax(0, 1fr));

        gap: 18px;

        margin-bottom: 24px;
    }


    .zeith-subscriber-stat {

        background: #FFFFFF;

        border: 1px solid #E2E8F0;

        border-radius: 14px;

        padding: 20px;

        display: flex;

        align-items: center;

        gap: 15px;

        box-shadow:
            0 4px 18px rgba(15, 23, 42, .04);
    }


    .zeith-stat-icon {

        width: 46px;

        height: 46px;

        border-radius: 12px;

        display: grid;

        place-items: center;

        background: #EFF6FF;

        color: #2563EB;

        flex-shrink: 0;
    }


    .zeith-stat-icon svg {

        width: 23px;

        height: 23px;
    }


    .zeith-stat-content span {

        display: block;

        margin-bottom: 4px;

        color: #64748B;

        font-size: 12px;

        font-weight: 600;
    }


    .zeith-stat-content strong {

        display: block;

        color: #0F172A;

        font-size: 24px;

        font-weight: 800;
    }


    /* =========================================================
   TOOLBAR
========================================================= */

    .zeith-subscriber-toolbar {

        background: #FFFFFF;

        border: 1px solid #E2E8F0;

        border-radius: 14px 14px 0 0;

        padding: 18px;

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 15px;

        flex-wrap: wrap;
    }


    .zeith-subscriber-filters {

        display: flex;

        align-items: center;

        gap: 10px;

        flex: 1;

        flex-wrap: wrap;
    }


    .zeith-search-box {

        position: relative;

        min-width: 280px;

        flex: 1;

        max-width: 450px;
    }


    .zeith-search-box svg {

        position: absolute;

        left: 13px;

        top: 50%;

        transform: translateY(-50%);

        width: 17px;

        height: 17px;

        color: #94A3B8;
    }


    .zeith-search-box input {

        width: 100%;

        border: 1px solid #CBD5E1;

        border-radius: 9px;

        padding: 11px 13px 11px 40px;

        outline: none;

        background: #FFFFFF;

        color: #0F172A;

        font: inherit;

        font-size: 13px;
    }


    .zeith-search-box input:focus {

        border-color: #2563EB;

        box-shadow:
            0 0 0 3px rgba(37, 99, 235, .10);
    }


    .zeith-filter-select {

        border: 1px solid #CBD5E1;

        border-radius: 9px;

        padding: 11px 35px 11px 12px;

        background: #FFFFFF;

        color: #334155;

        outline: none;

        font: inherit;

        font-size: 13px;

        cursor: pointer;
    }


    /* Toolbar buttons */

    .zeith-toolbar-actions {

        display: flex;

        gap: 9px;
    }


    .zeith-toolbar-btn {

        border: 1px solid #E2E8F0;

        border-radius: 9px;

        padding: 10px 13px;

        background: #FFFFFF;

        color: #334155;

        font-size: 12px;

        font-weight: 750;

        cursor: pointer;
    }


    .zeith-toolbar-btn:hover {

        background: #F8FAFC;
    }


    .zeith-toolbar-btn.blue {

        border-color: #BFDBFE;

        background: #EFF6FF;

        color: #1D4ED8;
    }


    /* =========================================================
   TABLE CARD
========================================================= */

    .zeith-subscriber-table-card {

        background: #FFFFFF;

        border: 1px solid #E2E8F0;

        border-top: 0;

        border-radius: 0 0 14px 14px;

        overflow: hidden;

        box-shadow:
            0 4px 18px rgba(15, 23, 42, .04);
    }


    /* Table horizontal scroll */

    .zeith-table-scroll {

        width: 100%;

        overflow-x: auto;

        scrollbar-width: thin;

        scrollbar-color: #CBD5E1 transparent;
    }


    .zeith-table-scroll::-webkit-scrollbar {

        height: 7px;
    }


    .zeith-table-scroll::-webkit-scrollbar-thumb {

        background: #CBD5E1;

        border-radius: 20px;
    }


    .zeith-subscriber-table {

        width: 100%;

        min-width: 850px;

        border-collapse: collapse;
    }


    .zeith-subscriber-table thead {

        background: #F8FAFC;
    }


    .zeith-subscriber-table th {

        padding: 14px 16px;

        text-align: left;

        color: #64748B;

        font-size: 11px;

        font-weight: 800;

        letter-spacing: .4px;

        text-transform: uppercase;

        border-bottom: 1px solid #E2E8F0;

        white-space: nowrap;
    }


    .zeith-subscriber-table td {

        padding: 15px 16px;

        border-bottom: 1px solid #F1F5F9;

        color: #334155;

        font-size: 13px;

        vertical-align: middle;
    }


    .zeith-subscriber-table tbody tr:hover {

        background: #FAFCFF;
    }


    .zeith-subscriber-table tbody tr:last-child td {

        border-bottom: 0;
    }


    /* checkbox */

    .zeith-subscriber-table input[type="checkbox"] {

        width: 16px;

        height: 16px;

        accent-color: #2563EB;

        cursor: pointer;
    }


    /* Name */

    .zeith-subscriber-name {

        display: flex;

        align-items: center;

        gap: 11px;

        min-width: 190px;
    }


    .zeith-subscriber-avatar {

        width: 38px;

        height: 38px;

        border-radius: 50%;

        display: grid;

        place-items: center;

        flex-shrink: 0;

        background: #EFF6FF;

        color: #2563EB;

        font-size: 12px;

        font-weight: 800;
    }


    .zeith-subscriber-name strong {

        display: block;

        color: #0F172A;

        font-size: 13px;

        margin-bottom: 2px;
    }


    .zeith-subscriber-name small {

        color: #94A3B8;

        font-size: 10px;
    }


    /* Email */

    .zeith-subscriber-email {

        color: #475569;

        white-space: nowrap;
    }


    /* Interest */

    .zeith-interest-badge {

        display: inline-flex;

        align-items: center;

        padding: 6px 9px;

        border-radius: 7px;

        background: #F1F5F9;

        color: #475569;

        font-size: 11px;

        font-weight: 700;

        white-space: nowrap;
    }


    /* Date */

    .zeith-subscriber-date {

        color: #64748B;

        white-space: nowrap;
    }


    /* =========================================================
   ACTIONS
========================================================= */

    .zeith-subscriber-actions {

        display: flex;

        align-items: center;

        gap: 6px;
    }


    .zeith-action-btn {

        width: 34px;

        height: 34px;

        display: grid;

        place-items: center;

        border-radius: 8px;

        border: 1px solid #E2E8F0;

        background: #FFFFFF;

        color: #64748B;

        cursor: pointer;
    }


    .zeith-action-btn:hover {

        background: #F8FAFC;

        color: #2563EB;
    }


    .zeith-action-btn.delete:hover {

        background: #FEF2F2;

        border-color: #FECACA;

        color: #DC2626;
    }


    .zeith-action-btn svg {

        width: 16px;

        height: 16px;
    }


    /* =========================================================
   EMPTY STATE
========================================================= */

    .zeith-subscriber-empty {

        display: none;

        text-align: center;

        padding: 60px 20px;

        color: #64748B;
    }


    .zeith-subscriber-empty.show {

        display: block;
    }


    .zeith-empty-icon {

        width: 50px;

        height: 50px;

        margin: 0 auto 14px;

        border-radius: 50%;

        display: grid;

        place-items: center;

        background: #F1F5F9;

        color: #94A3B8;
    }


    .zeith-empty-icon svg {

        width: 24px;

        height: 24px;
    }


    .zeith-subscriber-empty strong {

        display: block;

        margin-bottom: 5px;

        color: #334155;

        font-size: 14px;
    }


    .zeith-subscriber-empty span {

        font-size: 12px;
    }


    /* =========================================================
   SELECTION BAR
========================================================= */

    .zeith-selection-bar {

        display: none;

        align-items: center;

        justify-content: space-between;

        gap: 15px;

        padding: 11px 16px;

        background: #EFF6FF;

        border-bottom: 1px solid #BFDBFE;

        color: #1E40AF;

        font-size: 12px;

        font-weight: 700;
    }


    .zeith-selection-bar.show {

        display: flex;
    }


    .zeith-selection-actions {

        display: flex;

        gap: 7px;
    }


    .zeith-selection-btn {

        border: 1px solid #BFDBFE;

        background: #FFFFFF;

        color: #1D4ED8;

        border-radius: 7px;

        padding: 7px 10px;

        cursor: pointer;

        font-size: 11px;

        font-weight: 750;
    }


    /* =========================================================
   MODAL
========================================================= */

    .zeith-subscriber-modal {

        position: fixed;

        inset: 0;

        z-index: 9999;

        display: none;

        align-items: center;

        justify-content: center;

        padding: 20px;

        background: rgba(15, 23, 42, .55);
    }


    .zeith-subscriber-modal.show {

        display: flex;
    }


    .zeith-modal-box {

        width: 100%;

        max-width: 430px;

        background: #FFFFFF;

        border-radius: 16px;

        padding: 25px;

        box-shadow:
            0 25px 70px rgba(15, 23, 42, .25);
    }


    .zeith-modal-box h3 {

        margin: 0 0 8px;

        font-size: 18px;
    }


    .zeith-modal-box p {

        margin: 0 0 22px;

        color: #64748B;

        font-size: 13px;

        line-height: 1.6;
    }


    .zeith-modal-actions {

        display: flex;

        justify-content: flex-end;

        gap: 9px;
    }


    .zeith-modal-btn {

        border: 0;

        border-radius: 9px;

        padding: 10px 15px;

        font-size: 12px;

        font-weight: 800;

        cursor: pointer;
    }


    .zeith-modal-cancel {

        background: #F1F5F9;

        color: #334155;
    }


    .zeith-modal-delete {

        background: #EF4444;

        color: #FFFFFF;
    }


    /* =========================================================
   RESPONSIVE
========================================================= */

    @media (max-width: 1100px) {

        .zeith-subscriber-stats {

            grid-template-columns:
                repeat(2, minmax(0, 1fr));
        }
    }


    @media (max-width: 1024px) {

        .zeith-subscriber-page {

            margin-left: 0;

            padding: 24px;
        }
    }


    @media (max-width: 700px) {

        .zeith-subscriber-page {

            padding: 18px 14px;
        }


        .zeith-subscriber-header {

            flex-direction: column;
        }


        .zeith-subscriber-heading h1 {

            font-size: 24px;
        }


        .zeith-subscriber-stats {

            grid-template-columns: 1fr;
        }


        .zeith-subscriber-toolbar {

            align-items: stretch;

            flex-direction: column;
        }


        .zeith-subscriber-filters {

            width: 100%;

            flex-direction: column;

            align-items: stretch;
        }


        .zeith-search-box {

            max-width: none;

            min-width: 0;
        }


        .zeith-filter-select {

            width: 100%;
        }


        .zeith-toolbar-actions {

            width: 100%;
        }


        .zeith-toolbar-btn {

            flex: 1;
        }


        .zeith-export-all {

            width: 100%;

            justify-content: center;
        }

    }
</style>

<?php
// views/Staff/review.php

\App\Helpers\View::displayComponent("Staff/sidebar.php");
?>


<div class="zeith-subscriber-page">
    <div class="zeith-subscriber-container">
        <header class="zeith-subscriber-header">
            <div class="zeith-subscriber-heading">
                <h1>Newsletter Subscribers</h1>
                <p>Manage and export customers subscribed to the ZEITH newsletter.</p>
            </div>
            <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
                <button type="button" class="newsletter-centre-btn" id="openNewsletterCentre">
                    <i class="fa-solid fa-paper-plane"></i>
                    Newsletter Centre
                </button>
                <a href="/Watch_Collection/staff/subscribers?export=csv" class="zeith-export-all">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M12 3v12" stroke-linecap="round" />
                        <path d="M7 10l5 5 5-5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M5 21h14" stroke-linecap="round" />
                    </svg>
                    Export All CSV
                </a>
            </div>
        </header>

        <?php if ($deleteMessage): ?>
            <div class="zeith-subscriber-alert">
                <?= zeithSubscriberValue($deleteMessage) ?>
            </div>
        <?php endif; ?>

        <div class="zeith-selection-bar" id="zeithSelectionBar" style="display: none;">
            <span><strong id="zeithSelectedCount">0</strong> subscriber(s) selected</span>
            <button type="button" id="zeithClearSelectionBtn" class="zeith-clear-selection">Clear Selection</button>
        </div>

        <section class="zeith-subscriber-stats">
            <div class="zeith-subscriber-stat">
                <div class="zeith-stat-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M4 6h16v12H4z" stroke-linejoin="round" />
                        <path d="m4 7 8 6 8-6" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="zeith-stat-content">
                    <span>Total Subscribers</span>
                    <strong><?= number_format($totalSubscribers) ?></strong>
                </div>
            </div>
            <div class="zeith-subscriber-stat">
                <div class="zeith-stat-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M12 5v14" stroke-linecap="round" />
                        <path d="M5 12h14" stroke-linecap="round" />
                    </svg>
                </div>
                <div class="zeith-stat-content">
                    <span>New Today</span>
                    <strong><?= number_format($newToday) ?></strong>
                </div>
            </div>
            <div class="zeith-subscriber-stat">
                <div class="zeith-stat-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M4 5h16v14H4z" stroke-linejoin="round" />
                        <path d="M8 9h8" stroke-linecap="round" />
                        <path d="M8 13h5" stroke-linecap="round" />
                    </svg>
                </div>
                <div class="zeith-stat-content">
                    <span>Interest Categories</span>
                    <strong><?= number_format(count($interests)) ?></strong>
                </div>
            </div>
        </section>

        <section class="zeith-subscriber-table-card">
            <div class="zeith-subscriber-toolbar">
                <div class="zeith-subscriber-filters">
                    <div class="zeith-search-box">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="7" />
                            <path d="m20 20-4-4" stroke-linecap="round" />
                        </svg>
                        <input type="search" id="zeithSubscriberSearch" placeholder="Search name or email...">
                    </div>
                    <select id="zeithInterestFilter" class="zeith-filter-select">
                        <option value="">All Interests</option>
                        <?php foreach ($interests as $interest): ?>
                            <option value="<?= zeithSubscriberValue($interest) ?>"><?= zeithSubscriberValue($interest) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="zeith-toolbar-actions">
                    <button type="button" class="zeith-toolbar-btn" id="zeithClearFilters">Clear Filters</button>
                </div>
            </div>

            <div class="zeith-table-scroll">
                <table class="zeith-subscriber-table">
                    <thead>
                        <tr>
                            <th style="width: 40px; text-align: center;">
                                <input type="checkbox" id="selectAllSubscribers" title="Select All">
                            </th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Interest</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="zeithSubscriberBody">
                        <?php foreach ($subscribers as $subscriber): ?>
                            <?php
                            $subscriberId = (int)($subscriber['id'] ?? 0);
                            $subscriberName = $subscriber['name'] ?? 'Unknown';
                            $subscriberEmail = $subscriber['email'] ?? '';
                            $subscriberInterest = $subscriber['interest'] ?? 'General';
                            $subscriberCreated = $subscriber['created_at'] ?? '';
                            $initials = '';
                            $nameParts = preg_split('/\s+/', trim($subscriberName));

                            if (!empty($nameParts[0])) {
                                $initials .= strtoupper(substr($nameParts[0], 0, 1));
                            }

                            if (count($nameParts) > 1) {
                                $initials .= strtoupper(substr($nameParts[count($nameParts) - 1], 0, 1));
                            }

                            $formattedDate = 'Not available';

                            if (!empty($subscriberCreated)) {
                                $timestamp = strtotime($subscriberCreated);

                                if ($timestamp !== false) {
                                    $formattedDate = date('M j, Y', $timestamp);
                                }
                            }
                            ?>
                            <tr data-id="<?= $subscriberId ?>" data-name="<?= zeithSubscriberValue($subscriberName) ?>" data-email="<?= zeithSubscriberValue($subscriberEmail) ?>" data-interest="<?= zeithSubscriberValue($subscriberInterest) ?>">
                                <td style="text-align: center;">
                                    <input type="checkbox" class="subscriber-checkbox" value="<?= $subscriberId ?>">
                                </td>
                                <td>
                                    <div class="zeith-subscriber-name">
                                        <div class="zeith-subscriber-avatar"><?= zeithSubscriberValue($initials ?: 'Z') ?></div>
                                        <div>
                                            <strong><?= zeithSubscriberValue($subscriberName) ?></strong>
                                            <small>Subscriber #<?= $subscriberId ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="zeith-subscriber-email"><?= zeithSubscriberValue($subscriberEmail) ?></span>
                                </td>
                                <td>
                                    <span class="zeith-interest-badge"><?= zeithSubscriberValue($subscriberInterest ?: 'General') ?></span>
                                </td>
                                <td>
                                    <span class="zeith-subscriber-date"><?= zeithSubscriberValue($formattedDate) ?></span>
                                </td>
                                <td>
                                    <div class="zeith-subscriber-actions">
                                        <button type="button" class="zeith-action-btn delete zeith-delete-subscriber" title="Delete subscriber" data-id="<?= $subscriberId ?>" data-name="<?= zeithSubscriberValue($subscriberName) ?>">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                                <path d="M4 7h16" stroke-linecap="round" />
                                                <path d="M10 11v6" stroke-linecap="round" />
                                                <path d="M14 11v6" stroke-linecap="round" />
                                                <path d="M6 7l1 13h10l1-13" stroke-linejoin="round" />
                                                <path d="M9 7V4h6v3" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="zeith-subscriber-empty" id="zeithSubscriberEmpty" style="display: none;">
                <div class="zeith-empty-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <circle cx="11" cy="11" r="7" />
                        <path d="m20 20-4-4" stroke-linecap="round" />
                    </svg>
                </div>
                <strong>No subscribers found</strong>
                <span>Try changing your search or filter.</span>
            </div>
        </section>
    </div>
</div>

<div class="zeith-subscriber-modal" id="zeithDeleteModal">
    <div class="zeith-modal-box">
        <h3>Remove Subscriber?</h3>
        <p>Are you sure you want to remove <strong id="zeithDeleteSubscriberName">this subscriber</strong> from the ZEITH newsletter list? This action cannot be undone.</p>
        <form method="POST" action="/Watch_Collection/staff/subscribers/delete" id="zeithDeleteForm">
            <input type="hidden" name="subscriber_id" id="zeithDeleteSubscriberId" value="">
            <div class="zeith-modal-actions">
                <button type="button" class="zeith-modal-btn zeith-modal-cancel" id="zeithDeleteCancel">Cancel</button>
                <button type="submit" class="zeith-modal-btn zeith-modal-delete">Remove Subscriber</button>
            </div>
        </form>
    </div>
</div>

<div class="newsletter-overlay" id="newsletterOverlay">
    <div class="newsletter-centre">
        <div class="newsletter-header">
            <div>
                <span class="newsletter-eyebrow">ZEITH COMMUNICATIONS</span>
                <h2>ZEITH Newsletter Centre</h2>
                <p>Send updates and announcements to your subscribers.</p>
            </div>
            <button type="button" class="newsletter-close" id="closeNewsletterCentre">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <form id="newsletterForm">
            <div class="newsletter-field">
                <label>Choose Recipients</label>
                <div class="recipient-options">
                    <label class="recipient-option">
                        <input type="radio" name="recipient_scope" value="all" checked>
                        <span>
                            <i class="fa-solid fa-users"></i>
                            <strong>All Subscribers</strong>
                            <small>Send to everyone subscribed to ZEITH.</small>
                        </span>
                    </label>
                    <label class="recipient-option">
                        <input type="radio" name="recipient_scope" value="selected">
                        <span>
                            <i class="fa-solid fa-user-check"></i>
                            <strong>Selected Subscribers</strong>
                            <small>Send only to subscribers selected in the table.</small>
                        </span>
                    </label>
                </div>
                <p class="recipient-hint" id="recipientHint">Your update will be sent to all active subscribers.</p>
            </div>
            <div class="newsletter-field">
                <label for="newsletterSubject">Email Subject</label>
                <input type="text" id="newsletterSubject" name="subject" placeholder="Enter your newsletter subject..." required>
            </div>
            <div class="newsletter-field">
                <label for="newsletterMessage">Your Message</label>
                <textarea id="newsletterMessage" name="message" rows="8" placeholder="Write your update to ZEITH subscribers..." required></textarea>
            </div>
            <div class="newsletter-footer">
                <button type="button" class="newsletter-cancel" id="cancelNewsletter">Cancel</button>
                <button type="submit" class="newsletter-send" id="sendNewsletter">
                    <i class="fa-solid fa-paper-plane"></i>
                    Send Newsletter
                </button>
            </div>
            <p class="newsletter-status" id="newsletterStatus" style="margin-top: 15px; font-weight: 600; text-align: center;"></p>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('zeithSubscriberSearch');
    const interestFilter = document.getElementById('zeithInterestFilter');
    const clearFiltersBtn = document.getElementById('zeithClearFilters');
    const rows = document.querySelectorAll('#zeithSubscriberBody tr');
    const emptyState = document.getElementById('zeithSubscriberEmpty');

    function filterTable() {
        const query = searchInput?.value.toLowerCase().trim() || '';
        const selectedInterest = interestFilter?.value.toLowerCase().trim() || '';
        let visibleCount = 0;

        rows.forEach(row => {
            const name = (row.dataset.name || '').toLowerCase();
            const email = (row.dataset.email || '').toLowerCase();
            const interest = (row.dataset.interest || '').toLowerCase();
            const matchesSearch = !query || name.includes(query) || email.includes(query);
            const matchesInterest = !selectedInterest || interest === selectedInterest;

            row.style.display = matchesSearch && matchesInterest ? '' : 'none';

            if (matchesSearch && matchesInterest) visibleCount++;
        });

        if (emptyState) emptyState.style.display = visibleCount === 0 ? 'flex' : 'none';
    }

    searchInput?.addEventListener('input', filterTable);
    interestFilter?.addEventListener('change', filterTable);

    clearFiltersBtn?.addEventListener('click', () => {
        if (searchInput) searchInput.value = '';
        if (interestFilter) interestFilter.value = '';
        filterTable();
    });

    const selectAllBox = document.getElementById('selectAllSubscribers');
    const checkboxes = document.querySelectorAll('.subscriber-checkbox');
    const selectionBar = document.getElementById('zeithSelectionBar');
    const selectedCountEl = document.getElementById('zeithSelectedCount');
    const clearSelectionBtn = document.getElementById('zeithClearSelectionBtn');
    const recipientHint = document.getElementById('recipientHint');

    function updateSelection() {
        const selected = Array.from(checkboxes).filter(cb => cb.checked);
        const count = selected.length;
        const visibleCheckboxes = Array.from(checkboxes).filter(cb => {
            const row = cb.closest('tr');
            return row && row.style.display !== 'none';
        });

        if (selectedCountEl) selectedCountEl.textContent = count;
        if (selectionBar) selectionBar.style.display = count > 0 ? 'flex' : 'none';

        if (selectAllBox) {
            selectAllBox.checked = visibleCheckboxes.length > 0 && visibleCheckboxes.every(cb => cb.checked);
        }

        const selectedRadio = document.querySelector('input[name="recipient_scope"][value="selected"]');

        if (selectedRadio?.checked && recipientHint) {
            recipientHint.textContent = `Your update will be sent to ${count} selected subscriber(s).`;
        }
    }

    selectAllBox?.addEventListener('change', e => {
        checkboxes.forEach(cb => {
            const row = cb.closest('tr');
            if (row && row.style.display !== 'none') cb.checked = e.target.checked;
        });
        updateSelection();
    });

    checkboxes.forEach(cb => cb.addEventListener('change', updateSelection));

    clearSelectionBtn?.addEventListener('click', () => {
        checkboxes.forEach(cb => cb.checked = false);
        updateSelection();
    });

    const deleteModal = document.getElementById('zeithDeleteModal');
    const deleteName = document.getElementById('zeithDeleteSubscriberName');
    const deleteIdInput = document.getElementById('zeithDeleteSubscriberId');
    const cancelDeleteBtn = document.getElementById('zeithDeleteCancel');

    document.querySelectorAll('.zeith-delete-subscriber').forEach(btn => {
        btn.addEventListener('click', () => {
            if (deleteName) deleteName.textContent = btn.dataset.name || '';
            if (deleteIdInput) deleteIdInput.value = btn.dataset.id || '';
            deleteModal?.classList.add('active');
        });
    });

    cancelDeleteBtn?.addEventListener('click', () => {
        deleteModal?.classList.remove('active');
    });

    const openNewsletterBtn = document.getElementById('openNewsletterCentre');
    const closeNewsletterBtn = document.getElementById('closeNewsletterCentre');
    const cancelNewsletterBtn = document.getElementById('cancelNewsletter');
    const newsletterOverlay = document.getElementById('newsletterOverlay');
    const recipientRadios = document.querySelectorAll('input[name="recipient_scope"]');

    function openNewsletter() {
        newsletterOverlay?.classList.add('active');
        updateSelection();
    }

    function closeNewsletter() {
        newsletterOverlay?.classList.remove('active');
    }

    openNewsletterBtn?.addEventListener('click', openNewsletter);
    closeNewsletterBtn?.addEventListener('click', closeNewsletter);
    cancelNewsletterBtn?.addEventListener('click', closeNewsletter);

    recipientRadios.forEach(radio => {
        radio.addEventListener('change', e => {
            if (!recipientHint) return;

            if (e.target.value === 'all') {
                recipientHint.textContent = 'Your update will be sent to all active subscribers.';
            } else {
                const count = Array.from(checkboxes).filter(cb => cb.checked).length;
                recipientHint.textContent = `Your update will be sent to ${count} selected subscriber(s).`;
            }
        });
    });

    const newsletterForm = document.getElementById('newsletterForm');
    const sendBtn = document.getElementById('sendNewsletter');
    const statusText = document.getElementById('newsletterStatus');

    newsletterForm?.addEventListener('submit', async e => {
        e.preventDefault();

        if (!sendBtn || !statusText) return;

        const selectedRadio = document.querySelector('input[name="recipient_scope"]:checked');

        if (!selectedRadio) {
            statusText.style.color = '#e11d48';
            statusText.textContent = 'Please choose your recipients.';
            return;
        }

        const scope = selectedRadio.value;
        const selectedIds = Array.from(checkboxes).filter(cb => cb.checked).map(cb => cb.value);
        const subject = document.getElementById('newsletterSubject')?.value.trim() || '';
        const message = document.getElementById('newsletterMessage')?.value.trim() || '';

        if (!subject || !message) {
            statusText.style.color = '#e11d48';
            statusText.textContent = 'Please enter both an email subject and message.';
            return;
        }

        if (scope === 'selected' && selectedIds.length === 0) {
            statusText.style.color = '#e11d48';
            statusText.textContent = 'Please select at least one subscriber from the table.';
            return;
        }

        sendBtn.disabled = true;
        sendBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Sending Newsletter...';
        statusText.textContent = '';

        try {
            const response = await fetch('/Watch_Collection/staff/send-newsletter', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    subject,
                    message,
                    recipient_scope: scope,
                    selected_ids: selectedIds
                })
            });

            const result = await response.json();

            if (!response.ok || !result.success) {
                throw new Error(result.message || 'Failed to send newsletter.');
            }

            statusText.style.color = '#10b981';
            statusText.textContent = result.message || 'Newsletter sent successfully.';
            newsletterForm.reset();
            updateSelection();

            setTimeout(() => {
                closeNewsletter();
                statusText.textContent = '';
            }, 2000);
        } catch (err) {
            statusText.style.color = '#e11d48';
            statusText.textContent = err.message || 'An unexpected server error occurred.';
        } finally {
            sendBtn.disabled = false;
            sendBtn.innerHTML = '<i class="fa-solid fa-paper-plane"></i> Send Newsletter';
        }
    });

    updateSelection();
});
</script>