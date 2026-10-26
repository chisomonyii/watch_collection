<?php
/**
 * ============================================================
 * ZEITH STAFF DASHBOARD
 * subscriber.php
 * ============================================================
 *
 * FULL CONTROL
 *
 * - View subscribers
 * - Search subscribers
 * - Filter by interest
 * - Select subscribers
 * - Export selected subscribers to CSV
 * - Export all subscribers to CSV
 * - Manage newsletter
 *
 * Expected subscribers table:
 *
 * id
 * name
 * email
 * interest
 * created_at
 *
 * ============================================================
 */


/*
|--------------------------------------------------------------------------
| DATABASE
|--------------------------------------------------------------------------
|
| If your project already creates $pdo, this page will use it.
|
| Example:
| require_once __DIR__ . '/../../config/database.php';
|
*/


/*
|--------------------------------------------------------------------------
| HELPER
|--------------------------------------------------------------------------
*/

function zeithSubscriberEscape($value)
{
    return htmlspecialchars(
        (string)$value,
        ENT_QUOTES,
        'UTF-8'
    );
}


/*
|--------------------------------------------------------------------------
| LOAD SUBSCRIBERS
|--------------------------------------------------------------------------
*/

$subscribers = [];


/*
|--------------------------------------------------------------------------
| DATABASE QUERY
|--------------------------------------------------------------------------
*/

if (isset($pdo)) {

    try {

        $stmt = $pdo->query("
            SELECT
                id,
                name,
                email,
                interest,
                created_at
            FROM subscribers
            ORDER BY created_at DESC
        ");

        $subscribers =
            $stmt->fetchAll(
                PDO::FETCH_ASSOC
            );

    } catch (Throwable $e) {

        $subscribers = [];

    }
}


/*
|--------------------------------------------------------------------------
| DEMO DATA
|--------------------------------------------------------------------------
|
| Remove this section once your database is connected.
|
*/

if (empty($subscribers)) {

    $subscribers = [

        [
            'id' => 1,
            'name' => 'Chibuikem Ogbonna',
            'email' => 'chibuikem@example.com',
            'interest' => 'Luxury Watches',
            'created_at' => '2026-10-23 10:30:00'
        ],

        [
            'id' => 2,
            'name' => 'Daniel Eze',
            'email' => 'daniel@example.com',
            'interest' => 'Watch Culture',
            'created_at' => '2026-10-22 14:20:00'
        ],

        [
            'id' => 3,
            'name' => 'Amaka Nwosu',
            'email' => 'amaka@example.com',
            'interest' => 'New Releases',
            'created_at' => '2026-10-21 09:15:00'
        ],

        [
            'id' => 4,
            'name' => 'Michael Okoro',
            'email' => 'michael@example.com',
            'interest' => 'Luxury Watches',
            'created_at' => '2026-10-20 17:40:00'
        ],

        [
            'id' => 5,
            'name' => 'Grace Okafor',
            'email' => 'grace@example.com',
            'interest' => 'Watch Culture',
            'created_at' => '2026-10-19 12:10:00'
        ],

        [
            'id' => 6,
            'name' => 'Emeka Nnamani',
            'email' => 'emeka@example.com',
            'interest' => 'New Releases',
            'created_at' => '2026-10-18 16:45:00'
        ]

    ];
}


/*
|--------------------------------------------------------------------------
| STATISTICS
|--------------------------------------------------------------------------
*/

$totalSubscribers =
    count($subscribers);

$luxuryCount = 0;
$watchCultureCount = 0;
$newReleasesCount = 0;


foreach ($subscribers as $subscriber) {

    $interest =
        trim(
            $subscriber['interest'] ?? ''
        );


    if (
        strcasecmp(
            $interest,
            'Luxury Watches'
        ) === 0
    ) {

        $luxuryCount++;

    } elseif (
        strcasecmp(
            $interest,
            'Watch Culture'
        ) === 0
    ) {

        $watchCultureCount++;

    } elseif (
        strcasecmp(
            $interest,
            'New Releases'
        ) === 0
    ) {

        $newReleasesCount++;

    }

}


/*
|--------------------------------------------------------------------------
| CURRENT DATE
|--------------------------------------------------------------------------
*/

$currentDate =
    date('F j, Y');


?>

<style>

/* ============================================================
   ZEITH SUBSCRIBER PAGE
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
    font-family: Inter, Arial, sans-serif;
    overflow: hidden;
}


/* ============================================================
   PAGE
============================================================ */

.zeith-subscriber-page {

    margin-left: 250px;

    height: 100vh;

    min-height: 100vh;

    padding: 32px;

    overflow-y: auto;

    scrollbar-width: thin;

    scrollbar-color:
        #94A3B8
        transparent;
}


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


/* ============================================================
   HEADER
============================================================ */

.zeith-subscriber-header {

    display: flex;

    align-items: flex-start;

    justify-content: space-between;

    gap: 20px;

    margin-bottom: 28px;
}


.zeith-subscriber-heading h1 {

    margin: 0 0 7px;

    font-size: 30px;

    font-weight: 800;

    letter-spacing: -.7px;
}


.zeith-subscriber-heading p {

    margin: 0;

    color: #64748B;

    font-size: 14px;
}


/* ============================================================
   HEADER ACTIONS
============================================================ */

.zeith-subscriber-actions {

    display: flex;

    align-items: center;

    gap: 9px;

    flex-wrap: wrap;
}


.zeith-subscriber-button {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    min-height: 42px;

    padding: 0 15px;

    border-radius: 9px;

    border: 1px solid #CBD5E1;

    background: #FFFFFF;

    color: #334155;

    text-decoration: none;

    font-size: 11px;

    font-weight: 800;

    cursor: pointer;

    transition: .2s ease;
}


.zeith-subscriber-button svg {

    width: 16px;

    height: 16px;
}


.zeith-subscriber-button:hover {

    background: #F8FAFC;

    border-color: #94A3B8;
}


.zeith-subscriber-button.primary {

    background: #2563EB;

    border-color: #2563EB;

    color: #FFFFFF;
}


.zeith-subscriber-button.primary:hover {

    background: #1D4ED8;

    border-color: #1D4ED8;

    transform: translateY(-1px);
}


/* ============================================================
   STAT CARDS
============================================================ */

.zeith-subscriber-stats {

    display: grid;

    grid-template-columns:
        repeat(4, minmax(0, 1fr));

    gap: 16px;

    margin-bottom: 22px;
}


.zeith-subscriber-stat {

    min-height: 125px;

    padding: 19px;

    border: 1px solid #E2E8F0;

    border-radius: 13px;

    background: #FFFFFF;

    box-shadow:
        0 4px 18px
        rgba(15, 23, 42, .04);
}


.zeith-subscriber-stat-top {

    display: flex;

    align-items: center;

    justify-content: space-between;

    margin-bottom: 18px;
}


.zeith-subscriber-stat-icon {

    width: 36px;

    height: 36px;

    display: grid;

    place-items: center;

    border-radius: 9px;

    background: #EFF6FF;

    color: #2563EB;
}


.zeith-subscriber-stat-icon.green {

    background: #ECFDF5;

    color: #059669;
}


.zeith-subscriber-stat-icon.orange {

    background: #FFF7ED;

    color: #EA580C;
}


.zeith-subscriber-stat-icon.purple {

    background: #F5F3FF;

    color: #7C3AED;
}


.zeith-subscriber-stat-icon svg {

    width: 18px;

    height: 18px;
}


.zeith-subscriber-stat-label {

    color: #64748B;

    font-size: 10px;

    font-weight: 800;

    text-transform: uppercase;

    letter-spacing: .7px;
}


.zeith-subscriber-stat-number {

    margin: 0;

    color: #0F172A;

    font-size: 25px;

    font-weight: 800;
}


/* ============================================================
   MAIN CARD
============================================================ */

.zeith-subscriber-card {

    background: #FFFFFF;

    border: 1px solid #E2E8F0;

    border-radius: 14px;

    box-shadow:
        0 4px 18px
        rgba(15, 23, 42, .04);

    overflow: hidden;
}


/* ============================================================
   TOOLBAR
============================================================ */

.zeith-subscriber-toolbar {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 15px;

    padding: 17px 20px;

    border-bottom: 1px solid #E2E8F0;

    flex-wrap: wrap;
}


.zeith-subscriber-search {

    position: relative;

    width: min(360px, 100%);
}


.zeith-subscriber-search svg {

    position: absolute;

    left: 12px;

    top: 50%;

    width: 16px;

    height: 16px;

    color: #94A3B8;

    transform: translateY(-50%);
}


.zeith-subscriber-search input {

    width: 100%;

    height: 40px;

    padding:
        0 12px 0 38px;

    border:
        1px solid #CBD5E1;

    border-radius: 8px;

    outline: none;

    background: #FFFFFF;

    color: #0F172A;

    font-size: 12px;
}


.zeith-subscriber-search input:focus {

    border-color: #2563EB;

    box-shadow:
        0 0 0 3px
        rgba(37, 99, 235, .08);
}


.zeith-subscriber-toolbar-right {

    display: flex;

    align-items: center;

    gap: 9px;

    flex-wrap: wrap;
}


.zeith-subscriber-filter {

    height: 40px;

    padding: 0 12px;

    border:
        1px solid #CBD5E1;

    border-radius: 8px;

    background: #FFFFFF;

    color: #334155;

    outline: none;

    font-size: 11px;

    cursor: pointer;
}


.zeith-subscriber-filter:focus {

    border-color: #2563EB;
}


/* ============================================================
   SELECTED BAR
============================================================ */

.zeith-selected-bar {

    display: none;

    align-items: center;

    justify-content: space-between;

    gap: 15px;

    padding: 11px 20px;

    background: #EFF6FF;

    border-bottom: 1px solid #BFDBFE;

    color: #1E40AF;

    font-size: 11px;

    font-weight: 700;
}


.zeith-selected-bar.show {

    display: flex;
}


.zeith-selected-bar button {

    border: 0;

    background: transparent;

    color: #1D4ED8;

    font-size: 11px;

    font-weight: 800;

    cursor: pointer;
}


/* ============================================================
   TABLE WRAPPER
============================================================ */

.zeith-subscriber-table-wrap {

    width: 100%;

    overflow-x: auto;

    scrollbar-width: thin;

    scrollbar-color:
        #CBD5E1
        transparent;
}


.zeith-subscriber-table-wrap::-webkit-scrollbar {

    height: 7px;
}


.zeith-subscriber-table-wrap::-webkit-scrollbar-thumb {

    background: #CBD5E1;

    border-radius: 20px;
}


.zeith-subscriber-table {

    width: 100%;

    min-width: 850px;

    border-collapse: collapse;
}


.zeith-subscriber-table th {

    padding: 13px 18px;

    background: #F8FAFC;

    border-bottom:
        1px solid #E2E8F0;

    color: #64748B;

    font-size: 9px;

    font-weight: 800;

    text-align: left;

    text-transform: uppercase;

    letter-spacing: .7px;

    white-space: nowrap;
}


.zeith-subscriber-table td {

    padding: 15px 18px;

    border-bottom:
        1px solid #F1F5F9;

    color: #334155;

    font-size: 12px;

    vertical-align: middle;
}


.zeith-subscriber-table tbody tr {

    transition: .15s ease;
}


.zeith-subscriber-table tbody tr:hover {

    background: #F8FAFC;
}


.zeith-subscriber-table tbody tr:last-child td {

    border-bottom: 0;
}


/* ============================================================
   CHECKBOX
============================================================ */

.zeith-check {

    width: 16px;

    height: 16px;

    accent-color: #2563EB;

    cursor: pointer;
}


/* ============================================================
   CUSTOMER
============================================================ */

.zeith-subscriber-customer {

    display: flex;

    align-items: center;

    gap: 10px;
}


.zeith-subscriber-avatar {

    width: 35px;

    height: 35px;

    flex: 0 0 35px;

    display: grid;

    place-items: center;

    border-radius: 9px;

    background: #E2E8F0;

    color: #475569;

    font-size: 11px;

    font-weight: 800;
}


.zeith-subscriber-customer-name {

    color: #0F172A;

    font-size: 12px;

    font-weight: 800;
}


.zeith-subscriber-customer-email {

    margin-top: 3px;

    color: #94A3B8;

    font-size: 10px;
}


/* ============================================================
   INTEREST BADGES
============================================================ */

.zeith-interest {

    display: inline-flex;

    align-items: center;

    padding: 6px 9px;

    border-radius: 20px;

    font-size: 9px;

    font-weight: 800;

    white-space: nowrap;
}


.zeith-interest.luxury {

    background: #FFF7ED;

    color: #C2410C;
}


.zeith-interest.culture {

    background: #F5F3FF;

    color: #6D28D9;
}


.zeith-interest.releases {

    background: #ECFDF5;

    color: #047857;
}


.zeith-interest.default {

    background: #F1F5F9;

    color: #475569;
}


/* ============================================================
   DATE
============================================================ */

.zeith-subscriber-date {

    color: #64748B;

    font-size: 11px;
}


/* ============================================================
   EMPTY STATE
============================================================ */

.zeith-subscriber-empty {

    padding: 65px 25px;

    text-align: center;
}


.zeith-subscriber-empty-icon {

    width: 50px;

    height: 50px;

    margin: 0 auto 13px;

    display: grid;

    place-items: center;

    border-radius: 13px;

    background: #F1F5F9;

    color: #64748B;
}


.zeith-subscriber-empty-icon svg {

    width: 24px;

    height: 24px;
}


.zeith-subscriber-empty h3 {

    margin: 0 0 5px;

    color: #334155;

    font-size: 15px;
}


.zeith-subscriber-empty p {

    margin: 0;

    color: #94A3B8;

    font-size: 11px;
}


/* ============================================================
   FOOTER
============================================================ */

.zeith-subscriber-footer {

    display: flex;

    align-items: center;

    justify-content: space-between;

    padding: 14px 20px;

    border-top: 1px solid #E2E8F0;

    color: #94A3B8;

    font-size: 10px;

    gap: 15px;
}


/* ============================================================
   MOBILE
============================================================ */

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


    .zeith-subscriber-actions {

        width: 100%;
    }


    .zeith-subscriber-button {

        flex: 1;

        min-width: 145px;
    }


    .zeith-subscriber-stats {

        grid-template-columns: 1fr;
    }


    .zeith-subscriber-toolbar {

        align-items: stretch;

        flex-direction: column;
    }


    .zeith-subscriber-search {

        width: 100%;
    }


    .zeith-subscriber-toolbar-right {

        width: 100%;
    }


    .zeith-subscriber-filter {

        flex: 1;

        width: 100%;
    }


    .zeith-subscriber-footer {

        flex-direction: column;

        align-items: flex-start;
    }

}

</style>


<div class="zeith-subscriber-page">

    <div class="zeith-subscriber-container">


        <!-- ====================================================
             PAGE HEADER
        ==================================================== -->

        <header class="zeith-subscriber-header">

            <div class="zeith-subscriber-heading">

                <h1>
                    Newsletter Subscribers
                </h1>

                <p>
                    Manage your ZEITH newsletter audience and subscriber list.
                </p>

            </div>


            <div class="zeith-subscriber-actions">


                <!-- MANAGE NEWSLETTER -->

                <a
                    href="newsletter.php"
                    class="zeith-subscriber-button primary"
                    title="Create and send a newsletter"
                >

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >

                        <path
                            d="M4 5h16v14H4z"
                            stroke-linejoin="round"
                        />

                        <path
                            d="m4 7 8 6 8-6"
                            stroke-linejoin="round"
                        />

                    </svg>

                    Manage Newsletter

                </a>


                <!-- EXPORT ALL -->

                <button
                    type="button"
                    class="zeith-subscriber-button"
                    id="zeithExportAll"
                >

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >

                        <path
                            d="M12 3v12"
                            stroke-linecap="round"
                        />

                        <path
                            d="m7 10 5 5 5-5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />

                        <path
                            d="M4 21h16"
                            stroke-linecap="round"
                        />

                    </svg>

                    Export All

                </button>


            </div>

        </header>


        <!-- ====================================================
             STATISTICS
        ==================================================== -->

        <section class="zeith-subscriber-stats">


            <!-- TOTAL -->

            <div class="zeith-subscriber-stat">

                <div class="zeith-subscriber-stat-top">

                    <span class="zeith-subscriber-stat-label">
                        Total Subscribers
                    </span>

                    <div class="zeith-subscriber-stat-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >

                            <path
                                d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"
                                stroke-linecap="round"
                            />

                            <circle
                                cx="9"
                                cy="7"
                                r="4"
                            />

                            <path
                                d="M22 21v-2a4 4 0 0 0-3-3.87"
                                stroke-linecap="round"
                            />

                            <path
                                d="M16 3.13a4 4 0 0 1 0 7.75"
                                stroke-linecap="round"
                            />

                        </svg>

                    </div>

                </div>


                <p class="zeith-subscriber-stat-number">
                    <?= number_format($totalSubscribers) ?>
                </p>

            </div>


            <!-- LUXURY -->

            <div class="zeith-subscriber-stat">

                <div class="zeith-subscriber-stat-top">

                    <span class="zeith-subscriber-stat-label">
                        Luxury Watches
                    </span>

                    <div class="zeith-subscriber-stat-icon orange">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >

                            <circle
                                cx="12"
                                cy="12"
                                r="8"
                            />

                            <path
                                d="M12 8v4l3 2"
                                stroke-linecap="round"
                            />

                        </svg>

                    </div>

                </div>


                <p class="zeith-subscriber-stat-number">
                    <?= number_format($luxuryCount) ?>
                </p>

            </div>


            <!-- WATCH CULTURE -->

            <div class="zeith-subscriber-stat">

                <div class="zeith-subscriber-stat-top">

                    <span class="zeith-subscriber-stat-label">
                        Watch Culture
                    </span>

                    <div class="zeith-subscriber-stat-icon purple">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >

                            <path
                                d="M5 4h14v16H5z"
                                stroke-linejoin="round"
                            />

                            <path
                                d="M8 8h8M8 12h8M8 16h5"
                                stroke-linecap="round"
                            />

                        </svg>

                    </div>

                </div>


                <p class="zeith-subscriber-stat-number">
                    <?= number_format($watchCultureCount) ?>
                </p>

            </div>


            <!-- NEW RELEASES -->

            <div class="zeith-subscriber-stat">

                <div class="zeith-subscriber-stat-top">

                    <span class="zeith-subscriber-stat-label">
                        New Releases
                    </span>

                    <div class="zeith-subscriber-stat-icon green">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >

                            <path
                                d="M12 3l2.8 5.7 6.2.9-4.5 4.4 1.1 6.2L12 17.3 6.4 20.2l1.1-6.2L3 9.6l6.2-.9z"
                                stroke-linejoin="round"
                            />

                        </svg>

                    </div>

                </div>


                <p class="zeith-subscriber-stat-number">
                    <?= number_format($newReleasesCount) ?>
                </p>

            </div>


        </section>


        <!-- ====================================================
             SUBSCRIBER TABLE CARD
        ==================================================== -->

        <section class="zeith-subscriber-card">


            <!-- TOOLBAR -->

            <div class="zeith-subscriber-toolbar">


                <!-- SEARCH -->

                <div class="zeith-subscriber-search">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >

                        <circle
                            cx="11"
                            cy="11"
                            r="7"
                        />

                        <path
                            d="m20 20-4-4"
                            stroke-linecap="round"
                        />

                    </svg>


                    <input
                        type="search"
                        id="zeithSubscriberSearch"
                        placeholder="Search name or email..."
                        autocomplete="off"
                    >

                </div>


                <!-- FILTER -->

                <div class="zeith-subscriber-toolbar-right">

                    <select
                        class="zeith-subscriber-filter"
                        id="zeithInterestFilter"
                    >

                        <option value="all">
                            All Interests
                        </option>

                        <option value="Luxury Watches">
                            Luxury Watches
                        </option>

                        <option value="Watch Culture">
                            Watch Culture
                        </option>

                        <option value="New Releases">
                            New Releases
                        </option>

                    </select>


                    <button
                        type="button"
                        class="zeith-subscriber-button"
                        id="zeithExportSelected"
                    >

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >

                            <path
                                d="M12 3v12"
                                stroke-linecap="round"
                            />

                            <path
                                d="m7 10 5 5 5-5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />

                            <path
                                d="M4 21h16"
                                stroke-linecap="round"
                            />

                        </svg>

                        Export Selected

                    </button>

                </div>


            </div>


            <!-- =================================================
                 SELECTED BAR
            ================================================== -->

            <div
                class="zeith-selected-bar"
                id="zeithSelectedBar"
            >

                <span>

                    <strong id="zeithSelectedCount">
                        0
                    </strong>

                    subscriber(s) selected.

                </span>


                <button
                    type="button"
                    id="zeithClearSelection"
                >
                    Clear Selection
                </button>

            </div>


            <!-- =================================================
                 TABLE
            ================================================== -->

            <div class="zeith-subscriber-table-wrap">

                <?php if (!empty($subscribers)): ?>

                    <table
                        class="zeith-subscriber-table"
                        id="zeithSubscriberTable"
                    >

                        <thead>

                            <tr>

                                <th style="width:45px;">

                                    <input
                                        type="checkbox"
                                        class="zeith-check"
                                        id="zeithSelectAll"
                                        title="Select all visible subscribers"
                                    >

                                </th>


                                <th>
                                    Subscriber
                                </th>


                                <th>
                                    Interest
                                </th>


                                <th>
                                    Subscribed
                                </th>


                                <th>
                                    Subscriber ID
                                </th>

                            </tr>

                        </thead>


                        <tbody id="zeithSubscriberBody">

                            <?php foreach (
                                $subscribers
                                as $subscriber
                            ): ?>


                                <?php

                                $subscriberId =
                                    (int)(
                                        $subscriber['id']
                                        ?? 0
                                    );


                                $subscriberName =
                                    trim(
                                        $subscriber['name']
                                        ?? 'Subscriber'
                                    );


                                $subscriberEmail =
                                    trim(
                                        $subscriber['email']
                                        ?? ''
                                    );


                                $subscriberInterest =
                                    trim(
                                        $subscriber['interest']
                                        ?? 'Not specified'
                                    );


                                $createdAt =
                                    $subscriber['created_at']
                                    ?? '';


                                $formattedDate =
                                    '—';


                                if (
                                    !empty($createdAt)
                                ) {

                                    $timestamp =
                                        strtotime(
                                            $createdAt
                                        );


                                    if (
                                        $timestamp !== false
                                    ) {

                                        $formattedDate =
                                            date(
                                                'M j, Y',
                                                $timestamp
                                            );

                                    }

                                }


                                $initials = '';


                                $nameParts =
                                    preg_split(
                                        '/\s+/',
                                        $subscriberName
                                    );


                                if (
                                    !empty(
                                        $nameParts[0]
                                    )
                                ) {

                                    $initials .=
                                        strtoupper(
                                            substr(
                                                $nameParts[0],
                                                0,
                                                1
                                            )
                                        );

                                }


                                if (
                                    count(
                                        $nameParts
                                    ) > 1
                                ) {

                                    $lastName =
                                        end(
                                            $nameParts
                                        );


                                    $initials .=
                                        strtoupper(
                                            substr(
                                                $lastName,
                                                0,
                                                1
                                            )
                                        );

                                }


                                $interestClass =
                                    'default';


                                if (
                                    stripos(
                                        $subscriberInterest,
                                        'Luxury'
                                    ) !== false
                                ) {

                                    $interestClass =
                                        'luxury';

                                } elseif (
                                    stripos(
                                        $subscriberInterest,
                                        'Culture'
                                    ) !== false
                                ) {

                                    $interestClass =
                                        'culture';

                                } elseif (
                                    stripos(
                                        $subscriberInterest,
                                        'Release'
                                    ) !== false
                                ) {

                                    $interestClass =
                                        'releases';

                                }

                                ?>


                                <tr
                                    data-name="<?= zeithSubscriberEscape(
                                        strtolower(
                                            $subscriberName
                                        )
                                    ) ?>"
                                    data-email="<?= zeithSubscriberEscape(
                                        strtolower(
                                            $subscriberEmail
                                        )
                                    ) ?>"
                                    data-interest="<?= zeithSubscriberEscape(
                                        $subscriberInterest
                                    ) ?>"
                                >


                                    <!-- CHECKBOX -->

                                    <td>

                                        <input
                                            type="checkbox"
                                            class="zeith-check zeith-subscriber-checkbox"
                                            value="<?= $subscriberId ?>"
                                            data-name="<?= zeithSubscriberEscape(
                                                $subscriberName
                                            ) ?>"
                                            data-email="<?= zeithSubscriberEscape(
                                                $subscriberEmail
                                            ) ?>"
                                            data-interest="<?= zeithSubscriberEscape(
                                                $subscriberInterest
                                            ) ?>"
                                            data-created="<?= zeithSubscriberEscape(
                                                $formattedDate
                                            ) ?>"
                                        >

                                    </td>


                                    <!-- CUSTOMER -->

                                    <td>

                                        <div class="zeith-subscriber-customer">


                                            <div class="zeith-subscriber-avatar">

                                                <?= zeithSubscriberEscape(
                                                    $initials
                                                ) ?>

                                            </div>


                                            <div>

                                                <div class="zeith-subscriber-customer-name">

                                                    <?= zeithSubscriberEscape(
                                                        $subscriberName
                                                    ) ?>

                                                </div>


                                                <div class="zeith-subscriber-customer-email">

                                                    <?= zeithSubscriberEscape(
                                                        $subscriberEmail
                                                    ) ?>

                                                </div>

                                            </div>


                                        </div>

                                    </td>


                                    <!-- INTEREST -->

                                    <td>

                                        <span
                                            class="zeith-interest <?= $interestClass ?>"
                                        >

                                            <?= zeithSubscriberEscape(
                                                $subscriberInterest
                                            ) ?>

                                        </span>

                                    </td>


                                    <!-- DATE -->

                                    <td>

                                        <span class="zeith-subscriber-date">

                                            <?= zeithSubscriberEscape(
                                                $formattedDate
                                            ) ?>

                                        </span>

                                    </td>


                                    <!-- ID -->

                                    <td>

                                        <span
                                            style="
                                                color:#94A3B8;
                                                font-family:monospace;
                                                font-size:10px;
                                            "
                                        >

                                            #<?= $subscriberId ?>

                                        </span>

                                    </td>


                                </tr>


                            <?php endforeach; ?>

                        </tbody>

                    </table>


                <?php else: ?>


                    <div class="zeith-subscriber-empty">


                        <div class="zeith-subscriber-empty-icon">

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >

                                <path
                                    d="M4 5h16v14H4z"
                                    stroke-linejoin="round"
                                />

                                <path
                                    d="m4 7 8 6 8-6"
                                    stroke-linejoin="round"
                                />

                            </svg>

                        </div>


                        <h3>
                            No subscribers yet
                        </h3>


                        <p>
                            Newsletter subscribers will appear here.
                        </p>


                    </div>


                <?php endif; ?>

            </div>


            <!-- =================================================
                 FOOTER
            ================================================== -->

            <div class="zeith-subscriber-footer">

                <span>

                    Showing
                    <strong id="zeithVisibleCount">
                        <?= number_format(
                            count($subscribers)
                        ) ?>
                    </strong>
                    subscriber(s)

                </span>


                <span>

                    Updated <?= $currentDate ?>

                </span>

            </div>


        </section>


    </div>

</div>


<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {


        /* ======================================================
           ELEMENTS
        ====================================================== */

        const searchInput =
            document.getElementById(
                'zeithSubscriberSearch'
            );


        const interestFilter =
            document.getElementById(
                'zeithInterestFilter'
            );


        const selectAll =
            document.getElementById(
                'zeithSelectAll'
            );


        const checkboxes =
            document.querySelectorAll(
                '.zeith-subscriber-checkbox'
            );


        const selectedBar =
            document.getElementById(
                'zeithSelectedBar'
            );


        const selectedCount =
            document.getElementById(
                'zeithSelectedCount'
            );


        const clearSelection =
            document.getElementById(
                'zeithClearSelection'
            );


        const exportSelected =
            document.getElementById(
                'zeithExportSelected'
            );


        const exportAll =
            document.getElementById(
                'zeithExportAll'
            );


        const visibleCount =
            document.getElementById(
                'zeithVisibleCount'
            );


        const rows =
            document.querySelectorAll(
                '#zeithSubscriberBody tr'
            );


        /* ======================================================
           UPDATE SELECTED COUNT
        ====================================================== */

        function updateSelectedCount() {

            const selected =
                document.querySelectorAll(
                    '.zeith-subscriber-checkbox:checked'
                );


            selectedCount.textContent =
                selected.length;


            if (
                selected.length > 0
            ) {

                selectedBar.classList.add(
                    'show'
                );

            } else {

                selectedBar.classList.remove(
                    'show'
                );

            }


            const visibleRows =
                Array.from(rows).filter(
                    function (row) {

                        return (
                            row.style.display !==
                            'none'
                        );

                    }
                );


            const visibleCheckboxes =
                visibleRows.map(
                    function (row) {

                        return row.querySelector(
                            '.zeith-subscriber-checkbox'
                        );

                    }
                );


            const checkedVisible =
                visibleCheckboxes.filter(
                    function (checkbox) {

                        return (
                            checkbox &&
                            checkbox.checked
                        );

                    }
                );


            if (
                visibleCheckboxes.length &&
                checkedVisible.length ===
                visibleCheckboxes.length
            ) {

                selectAll.checked = true;

            } else {

                selectAll.checked = false;

            }

        }


        /* ======================================================
           FILTER TABLE
        ====================================================== */

        function filterSubscribers() {

            const search =
                searchInput.value
                    .trim()
                    .toLowerCase();


            const interest =
                interestFilter.value;


            let count = 0;


            rows.forEach(
                function (row) {

                    const name =
                        row.dataset.name ||
                        '';


                    const email =
                        row.dataset.email ||
                        '';


                    const rowInterest =
                        row.dataset.interest ||
                        '';


                    const matchesSearch =
                        !search ||
                        name.includes(search) ||
                        email.includes(search);


                    const matchesInterest =
                        interest === 'all' ||
                        rowInterest.toLowerCase() ===
                        interest.toLowerCase();


                    if (
                        matchesSearch &&
                        matchesInterest
                    ) {

                        row.style.display =
                            '';

                        count++;

                    } else {

                        row.style.display =
                            'none';

                    }

                }
            );


            visibleCount.textContent =
                count;


            updateSelectedCount();

        }


        /* ======================================================
           SEARCH
        ====================================================== */

        searchInput.addEventListener(
            'input',
            filterSubscribers
        );


        /* ======================================================
           INTEREST FILTER
        ====================================================== */

        interestFilter.addEventListener(
            'change',
            filterSubscribers
        );


        /* ======================================================
           SELECT ALL VISIBLE
        ====================================================== */

        selectAll.addEventListener(
            'change',
            function () {

                rows.forEach(
                    function (row) {

                        if (
                            row.style.display ===
                            'none'
                        ) {

                            return;

                        }


                        const checkbox =
                            row.querySelector(
                                '.zeith-subscriber-checkbox'
                            );


                        if (
                            checkbox
                        ) {

                            checkbox.checked =
                                selectAll.checked;

                        }

                    }
                );


                updateSelectedCount();

            }
        );


        /* ======================================================
           INDIVIDUAL CHECKBOXES
        ====================================================== */

        checkboxes.forEach(
            function (checkbox) {

                checkbox.addEventListener(
                    'change',
                    updateSelectedCount
                );

            }
        );


        /* ======================================================
           CLEAR SELECTION
        ====================================================== */

        clearSelection.addEventListener(
            'click',
            function () {

                checkboxes.forEach(
                    function (checkbox) {

                        checkbox.checked =
                            false;

                    }
                );


                selectAll.checked =
                    false;


                updateSelectedCount();

            }
        );


        /* ======================================================
           CSV ESCAPE
        ====================================================== */

        function csvEscape(value) {

            value =
                String(
                    value ?? ''
                );


            return '"' +
                value.replace(
                    /"/g,
                    '""'
                ) +
                '"';

        }


        /* ======================================================
           DOWNLOAD CSV
        ====================================================== */

        function downloadCSV(
            subscribers,
            filename
        ) {

            if (
                !subscribers.length
            ) {

                alert(
                    'There are no subscribers to export.'
                );

                return;

            }


            const headers = [

                'ID',
                'Name',
                'Email',
                'Interest',
                'Subscribed Date'

            ];


            const lines = [

                headers.map(
                    csvEscape
                ).join(',')

            ];


            subscribers.forEach(
                function (subscriber) {

                    lines.push(

                        [

                            subscriber.id,

                            subscriber.name,

                            subscriber.email,

                            subscriber.interest,

                            subscriber.created

                        ]
                        .map(
                            csvEscape
                        )
                        .join(',')

                    );

                }
            );


            const csv =
                "\uFEFF" +
                lines.join("\r\n");


            const blob =
                new Blob(
                    [csv],
                    {
                        type:
                            'text/csv;charset=utf-8;'
                    }
                );


            const url =
                URL.createObjectURL(
                    blob
                );


            const link =
                document.createElement(
                    'a'
                );


            link.href =
                url;


            link.download =
                filename;


            document.body.appendChild(
                link
            );


            link.click();


            document.body.removeChild(
                link
            );


            URL.revokeObjectURL(
                url
            );

        }


        /* ======================================================
           GET SUBSCRIBER DATA
        ====================================================== */

        function getSubscriberData(
            checkbox
        ) {

            return {

                id:
                    checkbox.value,

                name:
                    checkbox.dataset.name ||
                    '',

                email:
                    checkbox.dataset.email ||
                    '',

                interest:
                    checkbox.dataset.interest ||
                    '',

                created:
                    checkbox.dataset.created ||
                    ''

            };

        }


        /* ======================================================
           EXPORT SELECTED
        ====================================================== */

        exportSelected.addEventListener(
            'click',
            function () {

                const selected =
                    Array.from(
                        document.querySelectorAll(
                            '.zeith-subscriber-checkbox:checked'
                        )
                    );


                if (
                    selected.length === 0
                ) {

                    alert(
                        'Please select at least one subscriber first.'
                    );

                    return;

                }


                const data =
                    selected.map(
                        getSubscriberData
                    );


                downloadCSV(
                    data,
                    'zeith-selected-subscribers.csv'
                );

            }
        );


        /* ======================================================
           EXPORT ALL
        ====================================================== */

        exportAll.addEventListener(
            'click',
            function () {

                const allSubscribers =
                    Array.from(
                        document.querySelectorAll(
                            '.zeith-subscriber-checkbox'
                        )
                    );


                const data =
                    allSubscribers.map(
                        getSubscriberData
                    );


                downloadCSV(
                    data,
                    'zeith-all-subscribers.csv'
                );

            }
        );


        /* ======================================================
           INITIAL STATE
        ====================================================== */

        updateSelectedCount();

    }
);

</script>