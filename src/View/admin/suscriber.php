<?php
/**
 * ZEITH STAFF DASHBOARD
 * subscriber.php
 *
 * Newsletter Subscriber Management
 *
 * Access:
 * FULL CONTROL
 *
 * Features:
 * - View subscribers
 * - Search subscribers
 * - Filter by interest
 * - Select subscribers
 * - Export CSV
 * - Delete subscribers
 */


/*
|--------------------------------------------------------------------------
| DEMO / DATABASE DATA
|--------------------------------------------------------------------------
|
| Replace this section with your actual database query.
|
| Expected columns:
|
| name
| email
| interest
| created_at
|
*/

$subscribers = $subscribers ?? [];

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
            'name' => 'Sarah Williams',
            'email' => 'sarah@example.com',
            'interest' => 'Watch Culture',
            'created_at' => '2026-10-19 11:05:00'
        ],

        [
            'id' => 6,
            'name' => 'David Johnson',
            'email' => 'david@example.com',
            'interest' => 'New Releases',
            'created_at' => '2026-10-18 13:30:00'
        ]

    ];
}


/*
|--------------------------------------------------------------------------
| Helper
|--------------------------------------------------------------------------
*/

function zeithSubscriberValue($value)
{
    return htmlspecialchars(
        (string)$value,
        ENT_QUOTES,
        'UTF-8'
    );
}


/*
|--------------------------------------------------------------------------
| CSV EXPORT
|--------------------------------------------------------------------------
|
| Export selected subscribers:
|
| subscriber.php?export=csv&ids=1,2,3
|
| Export all:
|
| subscriber.php?export=csv&all=1
|
*/

if (
    isset($_GET['export']) &&
    $_GET['export'] === 'csv'
) {

    $exportSubscribers = [];

    /*
     * Export all subscribers
     */
    if (
        isset($_GET['all']) &&
        $_GET['all'] === '1'
    ) {

        $exportSubscribers = $subscribers;

    }

    /*
     * Export selected subscribers
     */
    elseif (!empty($_GET['ids'])) {

        $ids = array_filter(
            array_map(
                'intval',
                explode(',', $_GET['ids'])
            )
        );

        foreach ($subscribers as $subscriber) {

            if (
                in_array(
                    (int)($subscriber['id'] ?? 0),
                    $ids,
                    true
                )
            ) {

                $exportSubscribers[] = $subscriber;

            }
        }
    }


    /*
     * Download CSV
     */

    header('Content-Type: text/csv; charset=utf-8');

    header(
        'Content-Disposition: attachment; filename="zeith-subscribers-' .
        date('Y-m-d') .
        '.csv"'
    );

    $output = fopen('php://output', 'w');


    /*
     * CSV heading
     */

    fputcsv(
        $output,
        [
            'Name',
            'Email',
            'Interest',
            'Created At'
        ]
    );


    /*
     * CSV rows
     */

    foreach ($exportSubscribers as $subscriber) {

        fputcsv(
            $output,
            [
                $subscriber['name'] ?? '',
                $subscriber['email'] ?? '',
                $subscriber['interest'] ?? '',
                $subscriber['created_at'] ?? ''
            ]
        );
    }


    fclose($output);

    exit;
}


/*
|--------------------------------------------------------------------------
| Delete subscriber
|--------------------------------------------------------------------------
|
| This is ready for your database DELETE query.
|
*/

$deleteMessage = '';

if (
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_POST['delete_subscriber'])
) {

    $subscriberId = (int)(
        $_POST['subscriber_id'] ?? 0
    );

    if ($subscriberId > 0) {

        /*
         * DATABASE QUERY GOES HERE
         *
         * Example:
         *
         * $stmt = $pdo->prepare(
         *     "DELETE FROM subscribers WHERE id = ?"
         * );
         *
         * $stmt->execute([$subscriberId]);
         */

        $deleteMessage =
            'Subscriber management action completed.';
    }
}


/*
|--------------------------------------------------------------------------
| Statistics
|--------------------------------------------------------------------------
*/

$totalSubscribers = count($subscribers);

$today = date('Y-m-d');

$newToday = 0;

foreach ($subscribers as $subscriber) {

    if (
        !empty($subscriber['created_at']) &&
        substr(
            $subscriber['created_at'],
            0,
            10
        ) === $today
    ) {

        $newToday++;

    }
}


/*
|--------------------------------------------------------------------------
| Interests
|--------------------------------------------------------------------------
*/

$interests = [];

foreach ($subscribers as $subscriber) {

    $interest = trim(
        $subscriber['interest'] ?? ''
    );

    if (
        $interest !== '' &&
        !in_array(
            $interest,
            $interests,
            true
        )
    ) {

        $interests[] = $interest;

    }
}

sort($interests);


/*
|--------------------------------------------------------------------------
| Escape JSON for JavaScript
|--------------------------------------------------------------------------
*/

$subscriberJson = json_encode(
    $subscribers,
    JSON_HEX_TAG |
    JSON_HEX_APOS |
    JSON_HEX_QUOT |
    JSON_HEX_AMP
);

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


<div class="zeith-subscriber-page">

    <div class="zeith-subscriber-container">


        <!-- =================================================
             HEADER
        ================================================= -->

        <header class="zeith-subscriber-header">

            <div class="zeith-subscriber-heading">

                <h1>
                    Newsletter Subscribers
                </h1>

                <p>
                    Manage and export customers subscribed to the ZEITH newsletter.
                </p>

            </div>


            <a
                href="?export=csv&all=1"
                class="zeith-export-all"
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
                        d="M7 10l5 5 5-5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />

                    <path
                        d="M5 21h14"
                        stroke-linecap="round"
                    />

                </svg>

                Export All

            </a>

        </header>


        <!-- ALERT -->

        <?php if ($deleteMessage): ?>

            <div class="zeith-subscriber-alert">

                <?= zeithSubscriberValue($deleteMessage) ?>

            </div>

        <?php endif; ?>


        <!-- =================================================
             STATISTICS
        ================================================= -->

        <section class="zeith-subscriber-stats">


            <!-- TOTAL -->

            <div class="zeith-subscriber-stat">

                <div class="zeith-stat-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >

                        <path
                            d="M4 6h16v12H4z"
                            stroke-linejoin="round"
                        />

                        <path
                            d="m4 7 8 6 8-6"
                            stroke-linejoin="round"
                        />

                    </svg>

                </div>


                <div class="zeith-stat-content">

                    <span>
                        Total Subscribers
                    </span>

                    <strong>
                        <?= number_format($totalSubscribers) ?>
                    </strong>

                </div>

            </div>


            <!-- NEW TODAY -->

            <div class="zeith-subscriber-stat">

                <div class="zeith-stat-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >

                        <path
                            d="M12 5v14"
                            stroke-linecap="round"
                        />

                        <path
                            d="M5 12h14"
                            stroke-linecap="round"
                        />

                    </svg>

                </div>


                <div class="zeith-stat-content">

                    <span>
                        New Today
                    </span>

                    <strong>
                        <?= number_format($newToday) ?>
                    </strong>

                </div>

            </div>


            <!-- INTERESTS -->

            <div class="zeith-subscriber-stat">

                <div class="zeith-stat-icon">

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
                            d="M8 9h8"
                            stroke-linecap="round"
                        />

                        <path
                            d="M8 13h5"
                            stroke-linecap="round"
                        />

                    </svg>

                </div>


                <div class="zeith-stat-content">

                    <span>
                        Interest Categories
                    </span>

                    <strong>
                        <?= number_format(count($interests)) ?>
                    </strong>

                </div>

            </div>

        </section>


        <!-- =================================================
             TABLE
        ================================================= -->

        <section class="zeith-subscriber-table-card">


            <!-- TOOLBAR -->

            <div class="zeith-subscriber-toolbar">


                <div class="zeith-subscriber-filters">


                    <!-- SEARCH -->

                    <div class="zeith-search-box">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
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
                        >

                    </div>


                    <!-- INTEREST FILTER -->

                    <select
                        id="zeithInterestFilter"
                        class="zeith-filter-select"
                    >

                        <option value="">
                            All Interests
                        </option>


                        <?php foreach ($interests as $interest): ?>

                            <option
                                value="<?= zeithSubscriberValue($interest) ?>"
                            >
                                <?= zeithSubscriberValue($interest) ?>
                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>


                <div class="zeith-toolbar-actions">

                    <button
                        type="button"
                        class="zeith-toolbar-btn"
                        id="zeithClearFilters"
                    >
                        Clear Filters
                    </button>

                    <button
                        type="button"
                        class="zeith-toolbar-btn blue"
                        id="zeithExportSelectedTop"
                    >
                        Export Selected
                    </button>

                </div>

            </div>


            <!-- SELECTION BAR -->

            <div
                class="zeith-selection-bar"
                id="zeithSelectionBar"
            >

                <span id="zeithSelectedCount">
                    0 selected
                </span>


                <div class="zeith-selection-actions">

                    <button
                        type="button"
                        class="zeith-selection-btn"
                        id="zeithExportSelected"
                    >
                        Export CSV
                    </button>

                    <button
                        type="button"
                        class="zeith-selection-btn"
                        id="zeithClearSelection"
                    >
                        Clear Selection
                    </button>

                </div>

            </div>


            <!-- TABLE -->

            <div class="zeith-table-scroll">

                <table class="zeith-subscriber-table">

                    <thead>

                        <tr>

                            <th style="width:45px;">

                                <input
                                    type="checkbox"
                                    id="zeithSelectAll"
                                    title="Select all"
                                >

                            </th>

                            <th>
                                Name
                            </th>

                            <th>
                                Email
                            </th>

                            <th>
                                Interest
                            </th>

                            <th>
                                Created At
                            </th>

                            <th>
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody id="zeithSubscriberBody">

                        <?php foreach ($subscribers as $subscriber): ?>

                            <?php

                            $subscriberId =
                                (int)($subscriber['id'] ?? 0);

                            $subscriberName =
                                $subscriber['name'] ?? 'Unknown';

                            $subscriberEmail =
                                $subscriber['email'] ?? '';

                            $subscriberInterest =
                                $subscriber['interest'] ?? 'General';

                            $subscriberCreated =
                                $subscriber['created_at'] ?? '';

                            $initials = '';

                            $nameParts =
                                preg_split(
                                    '/\s+/',
                                    trim($subscriberName)
                                );

                            if (!empty($nameParts[0])) {

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
                                count($nameParts) > 1
                            ) {

                                $initials .=
                                    strtoupper(
                                        substr(
                                            $nameParts[
                                                count($nameParts) - 1
                                            ],
                                            0,
                                            1
                                        )
                                    );
                            }


                            $formattedDate =
                                'Not available';

                            if (
                                !empty($subscriberCreated)
                            ) {

                                $timestamp =
                                    strtotime(
                                        $subscriberCreated
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

                            ?>


                            <tr
                                data-id="<?= $subscriberId ?>"
                                data-name="<?= zeithSubscriberValue($subscriberName) ?>"
                                data-email="<?= zeithSubscriberValue($subscriberEmail) ?>"
                                data-interest="<?= zeithSubscriberValue($subscriberInterest) ?>"
                            >


                                <!-- CHECKBOX -->

                                <td>

                                    <input
                                        type="checkbox"
                                        class="zeith-subscriber-check"
                                        value="<?= $subscriberId ?>"
                                    >

                                </td>


                                <!-- NAME -->

                                <td>

                                    <div class="zeith-subscriber-name">

                                        <div class="zeith-subscriber-avatar">

                                            <?= zeithSubscriberValue($initials) ?>

                                        </div>


                                        <div>

                                            <strong>
                                                <?= zeithSubscriberValue($subscriberName) ?>
                                            </strong>

                                            <small>
                                                Subscriber #<?= $subscriberId ?>
                                            </small>

                                        </div>

                                    </div>

                                </td>


                                <!-- EMAIL -->

                                <td>

                                    <span class="zeith-subscriber-email">

                                        <?= zeithSubscriberValue($subscriberEmail) ?>

                                    </span>

                                </td>


                                <!-- INTEREST -->

                                <td>

                                    <span class="zeith-interest-badge">

                                        <?= zeithSubscriberValue($subscriberInterest ?: 'General') ?>

                                    </span>

                                </td>


                                <!-- DATE -->

                                <td>

                                    <span class="zeith-subscriber-date">

                                        <?= zeithSubscriberValue($formattedDate) ?>

                                    </span>

                                </td>


                                <!-- ACTION -->

                                <td>

                                    <div class="zeith-subscriber-actions">


                                        <!-- EMAIL -->

                                        <a
                                            href="mailto:<?= zeithSubscriberValue($subscriberEmail) ?>"
                                            class="zeith-action-btn"
                                            title="Send email"
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

                                        </a>


                                        <!-- DELETE -->

                                        <button
                                            type="button"
                                            class="zeith-action-btn delete zeith-delete-subscriber"
                                            title="Delete subscriber"
                                            data-id="<?= $subscriberId ?>"
                                            data-name="<?= zeithSubscriberValue($subscriberName) ?>"
                                        >

                                            <svg
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                            >

                                                <path
                                                    d="M4 7h16"
                                                    stroke-linecap="round"
                                                />

                                                <path
                                                    d="M10 11v6"
                                                    stroke-linecap="round"
                                                />

                                                <path
                                                    d="M14 11v6"
                                                    stroke-linecap="round"
                                                />

                                                <path
                                                    d="M6 7l1 13h10l1-13"
                                                    stroke-linejoin="round"
                                                />

                                                <path
                                                    d="M9 7V4h6v3"
                                                    stroke-linejoin="round"
                                                />

                                            </svg>

                                        </button>

                                    </div>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>


            <!-- EMPTY -->

            <div
                class="zeith-subscriber-empty"
                id="zeithSubscriberEmpty"
            >

                <div class="zeith-empty-icon">

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

                </div>


                <strong>
                    No subscribers found
                </strong>

                <span>
                    Try changing your search or filter.
                </span>

            </div>

        </section>

    </div>

</div>


<!-- =========================================================
     DELETE MODAL
========================================================= -->

<div
    class="zeith-subscriber-modal"
    id="zeithDeleteModal"
>

    <div class="zeith-modal-box">

        <h3>
            Remove Subscriber?
        </h3>

        <p>
            Are you sure you want to remove
            <strong id="zeithDeleteSubscriberName">
                this subscriber
            </strong>
            from the ZEITH newsletter list?
        </p>


        <form
            method="POST"
            id="zeithDeleteForm"
        >

            <input
                type="hidden"
                name="delete_subscriber"
                value="1"
            >

            <input
                type="hidden"
                name="subscriber_id"
                id="zeithDeleteSubscriberId"
                value=""
            >


            <div class="zeith-modal-actions">

                <button
                    type="button"
                    class="zeith-modal-btn zeith-modal-cancel"
                    id="zeithDeleteCancel"
                >
                    Cancel
                </button>


                <button
                    type="submit"
                    class="zeith-modal-btn zeith-modal-delete"
                >
                    Remove Subscriber
                </button>

            </div>

        </form>

    </div>

</div>


<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {


        /* =================================================
           ELEMENTS
        ================================================= */

        const search =
            document.getElementById(
                'zeithSubscriberSearch'
            );


        const interestFilter =
            document.getElementById(
                'zeithInterestFilter'
            );


        const clearFilters =
            document.getElementById(
                'zeithClearFilters'
            );


        const selectAll =
            document.getElementById(
                'zeithSelectAll'
            );


        const checkboxes =
            document.querySelectorAll(
                '.zeith-subscriber-check'
            );


        const selectionBar =
            document.getElementById(
                'zeithSelectionBar'
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


        const exportSelectedTop =
            document.getElementById(
                'zeithExportSelectedTop'
            );


        const tableRows =
            document.querySelectorAll(
                '#zeithSubscriberBody tr'
            );


        const emptyState =
            document.getElementById(
                'zeithSubscriberEmpty'
            );


        const deleteModal =
            document.getElementById(
                'zeithDeleteModal'
            );


        const deleteSubscriberId =
            document.getElementById(
                'zeithDeleteSubscriberId'
            );


        const deleteSubscriberName =
            document.getElementById(
                'zeithDeleteSubscriberName'
            );


        const deleteCancel =
            document.getElementById(
                'zeithDeleteCancel'
            );


        /* =================================================
           FILTER TABLE
        ================================================= */

        function filterSubscribers() {

            const searchValue =
                search.value
                    .toLowerCase()
                    .trim();


            const interestValue =
                interestFilter.value
                    .toLowerCase()
                    .trim();


            let visibleRows = 0;


            tableRows.forEach(
                function (row) {

                    const name =
                        (
                            row.dataset.name || ''
                        ).toLowerCase();


                    const email =
                        (
                            row.dataset.email || ''
                        ).toLowerCase();


                    const interest =
                        (
                            row.dataset.interest || ''
                        ).toLowerCase();


                    const matchesSearch =
                        !searchValue ||
                        name.includes(searchValue) ||
                        email.includes(searchValue);


                    const matchesInterest =
                        !interestValue ||
                        interest === interestValue;


                    if (
                        matchesSearch &&
                        matchesInterest
                    ) {

                        row.style.display = '';

                        visibleRows++;

                    } else {

                        row.style.display = 'none';

                    }

                }
            );


            if (visibleRows === 0) {

                emptyState.classList.add('show');

            } else {

                emptyState.classList.remove('show');

            }

        }


        search.addEventListener(
            'input',
            filterSubscribers
        );


        interestFilter.addEventListener(
            'change',
            filterSubscribers
        );


        clearFilters.addEventListener(
            'click',
            function () {

                search.value = '';

                interestFilter.value = '';

                filterSubscribers();

            }
        );


        /* =================================================
           SELECTION
        ================================================= */

        function getSelectedIds() {

            const selected = [];

            document
                .querySelectorAll(
                    '.zeith-subscriber-check:checked'
                )
                .forEach(
                    function (checkbox) {

                        selected.push(
                            checkbox.value
                        );

                    }
                );

            return selected;
        }


        function updateSelection() {

            const selected =
                getSelectedIds();


            if (selected.length > 0) {

                selectionBar.classList.add(
                    'show'
                );

                selectedCount.textContent =
                    selected.length +
                    (
                        selected.length === 1
                            ? ' subscriber selected'
                            : ' subscribers selected'
                    );

            } else {

                selectionBar.classList.remove(
                    'show'
                );

                selectedCount.textContent =
                    '0 selected';

            }


            const allVisibleCheckboxes =
                Array.from(
                    document.querySelectorAll(
                        '.zeith-subscriber-check'
                    )
                ).filter(
                    function (checkbox) {

                        return checkbox
                            .closest('tr')
                            .style.display !== 'none';

                    }
                );


            const checkedVisible =
                allVisibleCheckboxes.filter(
                    function (checkbox) {

                        return checkbox.checked;

                    }
                );


            selectAll.checked =
                allVisibleCheckboxes.length > 0 &&
                checkedVisible.length ===
                    allVisibleCheckboxes.length;

        }


        checkboxes.forEach(
            function (checkbox) {

                checkbox.addEventListener(
                    'change',
                    updateSelection
                );

            }
        );


        /* =================================================
           SELECT ALL
        ================================================= */

        selectAll.addEventListener(
            'change',
            function () {

                const visibleCheckboxes =
                    Array.from(
                        document.querySelectorAll(
                            '.zeith-subscriber-check'
                        )
                    ).filter(
                        function (checkbox) {

                            return checkbox
                                .closest('tr')
                                .style.display !== 'none';

                        }
                    );


                visibleCheckboxes.forEach(
                    function (checkbox) {

                        checkbox.checked =
                            selectAll.checked;

                    }
                );


                updateSelection();

            }
        );


        /* =================================================
           CLEAR SELECTION
        ================================================= */

        clearSelection.addEventListener(
            'click',
            function () {

                checkboxes.forEach(
                    function (checkbox) {

                        checkbox.checked = false;

                    }
                );


                selectAll.checked = false;

                updateSelection();

            }
        );


        /* =================================================
           EXPORT SELECTED
        ================================================= */

        function exportSelectedSubscribers() {

            const selected =
                getSelectedIds();


            if (!selected.length) {

                alert(
                    'Please select at least one subscriber.'
                );

                return;

            }


            const url =
                '?export=csv&ids=' +
                encodeURIComponent(
                    selected.join(',')
                );


            window.location.href = url;

        }


        exportSelected.addEventListener(
            'click',
            exportSelectedSubscribers
        );


        exportSelectedTop.addEventListener(
            'click',
            exportSelectedSubscribers
        );


        /* =================================================
           DELETE MODAL
        ================================================= */

        document
            .querySelectorAll(
                '.zeith-delete-subscriber'
            )
            .forEach(
                function (button) {

                    button.addEventListener(
                        'click',
                        function () {

                            const id =
                                this.dataset.id;


                            const name =
                                this.dataset.name;


                            deleteSubscriberId.value =
                                id;


                            deleteSubscriberName.textContent =
                                name;


                            deleteModal.classList.add(
                                'show'
                            );

                        }
                    );

                }
            );


        deleteCancel.addEventListener(
            'click',
            function () {

                deleteModal.classList.remove(
                    'show'
                );

            }
        );


        deleteModal.addEventListener(
            'click',
            function (event) {

                if (
                    event.target ===
                    deleteModal
                ) {

                    deleteModal.classList.remove(
                        'show'
                    );

                }

            }
        );


        /* =================================================
           ESCAPE
        ================================================= */

        document.addEventListener(
            'keydown',
            function (event) {

                if (
                    event.key === 'Escape'
                ) {

                    deleteModal.classList.remove(
                        'show'
                    );

                }

            }
        );


    }
);

</script>