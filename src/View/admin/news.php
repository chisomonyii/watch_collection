<?php
// Ensure session is active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Read fresh articles from session set by AdminController
$articles = $_SESSION['admin_news'] ?? [];

// Statistics directly from AdminController
$stats = $_SESSION['news_stats'] ?? [
    'total' => 0,
    'published' => 0,
    'draft' => 0,
    'featured' => 0
];

$totalArticles = $stats['total'];
$publishedArticles = $stats['published'];
$draftArticles = $stats['draft'];
$featuredArticles = $stats['featured'];
?>

<style>
    /* =========================================================
   ZEITH ADMIN — NEWS MANAGEMENT
   ========================================================= */

    .zeith-news-admin {
        margin-left: 250px;
        min-height: 100vh;
        background: #F4F6F9;
        padding: 32px;
        box-sizing: border-box;
    }


    /* =========================================================
   HEADER
   ========================================================= */

    .zeith-news-admin-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 25px;
        margin-bottom: 28px;
    }

    .zeith-news-admin-title h1 {
        margin: 0 0 7px;
        color: #0F172A;
        font-size: 28px;
        font-weight: 800;
        letter-spacing: -0.5px;
    }

    .zeith-news-admin-title p {
        margin: 0;
        color: #64748B;
        font-size: 14px;
    }

    .zeith-news-add-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;

        min-height: 44px;
        padding: 0 18px;

        border: 0;
        border-radius: 9px;

        background: #2563EB;
        color: #FFFFFF;

        font-size: 14px;
        font-weight: 700;

        cursor: pointer;

        box-shadow: 0 5px 14px rgba(37, 99, 235, 0.20);

        transition:
            background 0.2s ease,
            transform 0.2s ease,
            box-shadow 0.2s ease;
    }

    .zeith-news-add-btn:hover {
        background: #1D4ED8;
        transform: translateY(-1px);
        box-shadow: 0 8px 18px rgba(37, 99, 235, 0.25);
    }

    .zeith-news-add-btn svg {
        width: 18px;
        height: 18px;
    }


    /* =========================================================
   STATISTICS
   ========================================================= */

    .zeith-news-stats {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
        margin-bottom: 25px;
    }

    .zeith-news-stat {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        padding: 19px 20px;
        box-shadow: 0 3px 10px rgba(15, 23, 42, 0.04);
    }

    .zeith-news-stat-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .zeith-news-stat-label {
        color: #64748B;
        font-size: 13px;
        font-weight: 600;
    }

    .zeith-news-stat-icon {
        width: 34px;
        height: 34px;
        border-radius: 9px;

        display: flex;
        align-items: center;
        justify-content: center;
    }

    .zeith-news-stat-icon svg {
        width: 18px;
        height: 18px;
    }

    .zeith-news-stat-icon.blue {
        background: #EFF6FF;
        color: #2563EB;
    }

    .zeith-news-stat-icon.green {
        background: #ECFDF5;
        color: #059669;
    }

    .zeith-news-stat-icon.orange {
        background: #FFF7ED;
        color: #EA580C;
    }

    .zeith-news-stat-icon.purple {
        background: #F5F3FF;
        color: #7C3AED;
    }

    .zeith-news-stat-number {
        color: #0F172A;
        font-size: 25px;
        font-weight: 800;
    }


    /* =========================================================
   TOOLBAR
   ========================================================= */

    .zeith-news-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;

        background: #FFFFFF;
        border: 1px solid #E2E8F0;

        padding: 15px;
        border-radius: 14px 14px 0 0;
    }

    .zeith-news-search {
        position: relative;
        width: 310px;
    }

    .zeith-news-search svg {
        position: absolute;
        left: 13px;
        top: 50%;
        width: 17px;
        height: 17px;
        transform: translateY(-50%);
        color: #94A3B8;
        pointer-events: none;
    }

    .zeith-news-search input {
        width: 100%;
        height: 40px;
        box-sizing: border-box;

        padding: 0 13px 0 39px;

        border: 1px solid #E2E8F0;
        border-radius: 8px;

        background: #F8FAFC;
        color: #0F172A;

        outline: none;
        font-size: 13px;
    }

    .zeith-news-search input:focus {
        border-color: #93C5FD;
        background: #FFFFFF;
    }

    .zeith-news-filters {
        display: flex;
        align-items: center;
        gap: 9px;
    }

    .zeith-news-filter {
        height: 40px;
        padding: 0 12px;

        border: 1px solid #E2E8F0;
        border-radius: 8px;

        background: #FFFFFF;
        color: #475569;

        font-size: 13px;
        font-weight: 600;

        outline: none;
        cursor: pointer;
    }

    .zeith-news-filter:focus {
        border-color: #93C5FD;
    }


    /* =========================================================
   TABLE
   ========================================================= */

    .zeith-news-table-wrap {
        overflow-x: auto;

        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-top: 0;

        border-radius: 0 0 14px 14px;
    }

    .zeith-news-table {
        width: 100%;
        min-width: 1050px;
        border-collapse: collapse;
    }

    .zeith-news-table th {
        padding: 13px 16px;

        background: #F8FAFC;

        border-bottom: 1px solid #E2E8F0;

        color: #64748B;

        text-align: left;

        font-size: 11px;
        font-weight: 800;
        letter-spacing: 0.6px;
        text-transform: uppercase;
    }

    .zeith-news-table td {
        padding: 15px 16px;

        border-bottom: 1px solid #F1F5F9;

        color: #334155;
        font-size: 13px;

        vertical-align: middle;
    }

    .zeith-news-table tbody tr {
        transition: background 0.15s ease;
    }

    .zeith-news-table tbody tr:hover {
        background: #FAFCFF;
    }

    .zeith-news-table tbody tr:last-child td {
        border-bottom: 0;
    }


    /* =========================================================
   ARTICLE CELL
   ========================================================= */

    .zeith-news-article-cell {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 290px;
    }

    .zeith-news-thumbnail {
        width: 62px;
        height: 54px;

        flex-shrink: 0;

        border-radius: 8px;

        background: #F1F5F9;

        overflow: hidden;
    }

    .zeith-news-thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .zeith-news-article-info {
        min-width: 0;
    }

    .zeith-news-article-title {
        margin: 0 0 4px;

        color: #0F172A;

        font-size: 14px;
        font-weight: 750;
        line-height: 1.35;

        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 330px;
    }

    .zeith-news-article-slug {
        color: #94A3B8;
        font-size: 11px;

        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 330px;
    }


    /* =========================================================
   CATEGORY
   ========================================================= */

    .zeith-news-category {
        display: inline-flex;

        padding: 5px 9px;

        border-radius: 999px;

        background: #F1F5F9;
        color: #475569;

        font-size: 11px;
        font-weight: 700;
    }


    /* =========================================================
   STATUS
   ========================================================= */

    .zeith-news-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;

        padding: 6px 9px;

        border-radius: 999px;

        font-size: 11px;
        font-weight: 800;
    }

    .zeith-news-status-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
    }

    .zeith-news-status.published {
        background: #ECFDF5;
        color: #047857;
    }

    .zeith-news-status.published .zeith-news-status-dot {
        background: #10B981;
    }

    .zeith-news-status.draft {
        background: #FFF7ED;
        color: #C2410C;
    }

    .zeith-news-status.draft .zeith-news-status-dot {
        background: #F59E0B;
    }


    /* =========================================================
   FEATURE
   ========================================================= */

    .zeith-news-feature {
        display: inline-flex;
        align-items: center;
        gap: 5px;

        border: 0;
        background: transparent;

        cursor: pointer;

        color: #94A3B8;

        font-size: 12px;
        font-weight: 700;
    }

    .zeith-news-feature svg {
        width: 16px;
        height: 16px;
    }

    .zeith-news-feature.active {
        color: #2563EB;
    }


    /* =========================================================
   ACTION BUTTONS
   ========================================================= */

    .zeith-news-actions {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 6px;
    }

    .zeith-news-action {
        width: 34px;
        height: 34px;

        display: flex;
        align-items: center;
        justify-content: center;

        border: 1px solid #E2E8F0;
        border-radius: 7px;

        background: #FFFFFF;
        color: #64748B;

        cursor: pointer;

        transition:
            background 0.2s ease,
            color 0.2s ease,
            border-color 0.2s ease;
    }

    .zeith-news-action:hover {
        background: #F8FAFC;
    }

    .zeith-news-action svg {
        width: 16px;
        height: 16px;
    }

    .zeith-news-action.edit:hover {
        color: #2563EB;
        border-color: #BFDBFE;
        background: #EFF6FF;
    }

    .zeith-news-action.publish:hover {
        color: #059669;
        border-color: #A7F3D0;
        background: #ECFDF5;
    }

    .zeith-news-action.delete:hover {
        color: #DC2626;
        border-color: #FECACA;
        background: #FEF2F2;
    }


    /* =========================================================
   MODAL
   ========================================================= */


    .zeith-news-modal {
        display: none;
        /* MUST be none by default */
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.65);
        z-index: 1000;
        align-items: center;
        justify-content: center;
    }

    .zeith-news-modal.active {
        display: flex;
        /* Only show when active class is added */
    }

    .zeith-news-modal-card {
        width: 100%;
        max-width: 850px;

        max-height: calc(100vh - 60px);

        display: flex;
        flex-direction: column;

        background: #FFFFFF;

        border: 1px solid #E2E8F0;

        border-radius: 16px;

        box-shadow:
            0 25px 70px rgba(15, 23, 42, 0.20);

        overflow: hidden;

        margin: auto;
    }


    .zeith-news-modal-header {
        display: flex;
        flex: 0 0 auto;
        align-items: center;
        justify-content: space-between;

        padding: 20px 24px;

        border-bottom: 1px solid #E2E8F0;
    }

    .zeith-news-modal-header h2 {
        margin: 0;

        color: #0F172A;

        font-size: 20px;
        font-weight: 800;
    }

    .zeith-news-modal-close {
        width: 36px;
        height: 36px;

        display: flex;
        align-items: center;
        justify-content: center;

        border: 1px solid #E2E8F0;
        border-radius: 8px;

        background: #F8FAFC;

        color: #64748B;

        font-size: 17px;

        cursor: pointer;

        transition: all .2s ease;
    }

    .zeith-news-modal-close:hover {
        background: #F1F5F9;
        color: #0F172A;
        border-color: #CBD5E1;
    }

    #zeithArticleForm {
        min-height: 0;

        display: flex;
        flex-direction: column;

        flex: 1;
    }


    .zeith-news-modal-body {
        flex: 1 1 auto;

        min-height: 0;

        overflow-y: auto;
        overflow-x: hidden;

        padding: 26px;

        -webkit-overflow-scrolling: touch;

        scrollbar-width: thin;
        scrollbar-color: #CBD5E1 transparent;
    }

    .zeith-news-modal-body::-webkit-scrollbar {
        width: 7px;
    }

    .zeith-news-modal-body::-webkit-scrollbar-track {
        background: transparent;
    }

    .zeith-news-modal-body::-webkit-scrollbar-thumb {
        background: #CBD5E1;

        border-radius: 20px;
    }

    .zeith-news-modal-body::-webkit-scrollbar-thumb:hover {
        background: #94A3B8;
    }


    .zeith-news-form-grid {
        display: grid;

        grid-template-columns:
            repeat(2, minmax(0, 1fr));

        gap: 20px;
    }


    .zeith-news-form-group {
        min-width: 0;
    }


    .zeith-news-form-group.full {
        grid-column: 1 / -1;
    }

    .zeith-news-form-group label {
        display: block;

        margin-bottom: 8px;

        color: #0F172A;

        font-size: 13px;
        font-weight: 700;
    }

    .zeith-news-form-group input,
    .zeith-news-form-group select,
    .zeith-news-form-group textarea {
        width: 100%;

        padding: 12px 14px;

        border: 1px solid #E2E8F0;

        border-radius: 9px;

        background: #FFFFFF;

        color: #0F172A;

        font-family: inherit;

        font-size: 13px;

        outline: none;

        transition:
            border-color .2s ease,
            box-shadow .2s ease;
    }

    .zeith-news-form-group input,
    .zeith-news-form-group select {
        height: 46px;
    }

    .zeith-news-form-group textarea {
        min-height: 120px;

        resize: vertical;

        line-height: 1.6;
    }

    .zeith-news-form-group input::placeholder,
    .zeith-news-form-group textarea::placeholder {
        color: #94A3B8;
    }

    .zeith-news-form-group input:focus,
    .zeith-news-form-group select:focus,
    .zeith-news-form-group textarea:focus {
        border-color: #93C5FD;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.08);
    }

    .zeith-news-checkbox {
        min-height: 46px;

        display: flex !important;

        align-items: center;

        gap: 10px;

        margin: 0 !important;

        padding: 12px 14px;

        border: 1px solid #E2E8F0;

        border-radius: 9px;

        background: #F8FAFC;

        color: #475569 !important;

        font-size: 13px !important;
        font-weight: 600 !important;

        cursor: pointer;
    }

    .zeith-news-checkbox input {
        width: 17px !important;
        height: 17px !important;

        margin: 0;

        accent-color: #2563EB;

        cursor: pointer;
    }

    .zeith-news-modal-footer {
        flex: 0 0 auto;

        display: flex;
        align-items: center;
        justify-content: flex-end;

        gap: 10px;

        padding: 17px 24px;

        background: #FFFFFF;

        border-top: 1px solid #E2E8F0;

        box-shadow:
            0 -4px 12px rgba(15, 23, 42, 0.03);
    }

    .zeith-news-cancel-btn,
    .zeith-news-save-btn {
        min-height: 40px;
        padding: 0 16px;

        border-radius: 8px;

        font-size: 13px;
        font-weight: 700;

        cursor: pointer;
    }

    .zeith-news-cancel-btn {
        min-height: 42px;

        padding: 0 18px;

        border: 1px solid #E2E8F0;

        border-radius: 8px;

        background: #FFFFFF;

        color: #475569;

        font-family: inherit;

        font-size: 13px;
        font-weight: 700;

        cursor: pointer;

        transition: all .2s ease;
    }

    .zeith-news-cancel-btn:hover {
        background: #F8FAFC;

        border-color: #CBD5E1;

        color: #0F172A;
    }


    .zeith-news-save-btn {
        min-height: 42px;

        padding: 0 22px;

        border: 1px solid #2563EB;

        border-radius: 8px;

        background: #2563EB;

        color: #FFFFFF;

        font-family: inherit;

        font-size: 13px;
        font-weight: 800;

        cursor: pointer;

        box-shadow:
            0 5px 14px rgba(37, 99, 235, 0.18);

        transition: all .2s ease;
    }


    .zeith-news-save-btn:hover {
        background: #1D4ED8;

        border-color: #1D4ED8;

        transform: translateY(-1px);

        box-shadow:
            0 7px 18px rgba(37, 99, 235, 0.25);
    }


    /* =========================================================
   DELETE MODAL
   ========================================================= */

    .zeith-delete-modal-card {
        width: min(430px, 100%);
        background: #FFFFFF;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 25px 70px rgba(15, 23, 42, 0.22);
    }

    .zeith-delete-icon {
        width: 46px;
        height: 46px;

        display: flex;
        align-items: center;
        justify-content: center;

        margin-bottom: 15px;

        border-radius: 11px;

        background: #FEF2F2;
        color: #DC2626;
    }

    .zeith-delete-icon svg {
        width: 23px;
        height: 23px;
    }

    .zeith-delete-modal-card h2 {
        margin: 0 0 8px;
        color: #0F172A;
        font-size: 19px;
    }

    .zeith-delete-modal-card p {
        margin: 0;
        color: #64748B;
        font-size: 13px;
        line-height: 1.6;
    }

    .zeith-delete-actions {
        display: flex;
        justify-content: flex-end;
        gap: 9px;
        margin-top: 22px;
    }

    .zeith-delete-cancel,
    .zeith-delete-confirm {
        min-height: 40px;
        padding: 0 15px;

        border-radius: 8px;

        font-size: 13px;
        font-weight: 700;

        cursor: pointer;
    }

    .zeith-delete-cancel {
        border: 1px solid #E2E8F0;
        background: #FFFFFF;
        color: #475569;
    }

    .zeith-delete-confirm {
        border: 0;
        background: #DC2626;
        color: #FFFFFF;
    }

    .zeith-delete-confirm:hover {
        background: #B91C1C;
    }


    /* =========================================================
   RESPONSIVE
   ========================================================= */

    @media (max-width: 1200px) {

        .zeith-news-stats {
            grid-template-columns: repeat(2, 1fr);
        }

    }

    @media (max-width: 1024px) {

        .zeith-news-admin {
            margin-left: 0;
            padding: 25px;
        }

    }

    @media (max-width: 750px) {

        .zeith-news-modal {
            padding: 20px 15px;
            align-items: center;
        }

        .zeith-news-modal-card {
            max-height: calc(100vh - 40px);

            border-radius: 14px;
        }


        .zeith-news-modal-header {
            padding: 17px 18px;
        }

        .zeith-news-modal-header h2 {
            font-size: 18px;
        }

        .zeith-news-modal-body {
            padding: 20px 18px;
        }

        .zeith-news-form-grid {
            grid-template-columns: 1fr;
            gap: 17px;
        }

        .zeith-news-form-group.full {
            grid-column: auto;
        }

        .zeith-news-modal-footer {
            padding: 14px 18px;
        }

        .zeith-news-admin {
            padding: 18px;
        }

        .zeith-news-admin-header {
            flex-direction: column;
        }

        .zeith-news-add-btn {
            width: 100%;
        }

        .zeith-news-toolbar {
            flex-direction: column;
            align-items: stretch;
        }

        .zeith-news-search {
            width: 100%;
        }

        .zeith-news-filters {
            width: 100%;
        }

        .zeith-news-filter {
            flex: 1;
        }

        .zeith-news-form-group.full {
            grid-column: auto;
        }

    }

    @media (max-width: 500px) {

        .zeith-news-stats {
            grid-template-columns: 1fr;
        }

        .zeith-news-modal {
            padding: 10px;
            align-items: center;
        }

        .zeith-news-modal-card {
            max-height: calc(100vh - 20px);

            border-radius: 12px;
        }

        .zeith-news-modal-header {
            padding: 15px;
        }

        .zeith-news-modal-header h2 {
            font-size: 16px;
        }

        .zeith-news-modal-close {
            width: 32px;
            height: 32px;

            font-size: 15px;
        }

        .zeith-news-modal-body {
            padding: 18px 15px;
        }

        .zeith-news-modal-footer {
            padding: 12px 15px;

            gap: 8px;
        }

        .zeith-news-cancel-btn,
        .zeith-news-save-btn {
            flex: 1;

            padding: 0 12px;
        }

    }
</style>


<div class="zeith-news-admin">

    <?php
// views/Staff/order.php
\App\Helpers\View::displayComponent("admin/sidebar.php");
?>

    <!-- =====================================================
         HEADER
         ====================================================== -->

    <header class="zeith-news-admin-header">

        <div class="zeith-news-admin-title">

            <h1>News & Editorials</h1>

            <p>
                Publish, manage and control all ZEITH editorial content.
            </p>

        </div>


        <button
            type="button"
            class="zeith-news-add-btn"
            id="zeithAddArticle">

            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor">
                <path
                    d="M12 5v14"
                    stroke-linecap="round" />

                <path
                    d="M5 12h14"
                    stroke-linecap="round" />
            </svg>

            New Article

        </button>

    </header>


    <!-- =====================================================
         STATISTICS
         ====================================================== -->

    <section class="zeith-news-stats">

        <!-- Total -->
        <div class="zeith-news-stat">

            <div class="zeith-news-stat-top">

                <span class="zeith-news-stat-label">
                    Total Articles
                </span>

                <span class="zeith-news-stat-icon blue">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor">
                        <path d="M5 4h14v16H5z"></path>
                        <path d="M8 8h8"></path>
                        <path d="M8 12h8"></path>
                        <path d="M8 16h5"></path>
                    </svg>

                </span>

            </div>

            <div class="zeith-news-stat-number">
                <?= $totalArticles ?>
            </div>

        </div>


        <!-- Published -->
        <div class="zeith-news-stat">

            <div class="zeith-news-stat-top">

                <span class="zeith-news-stat-label">
                    Published
                </span>

                <span class="zeith-news-stat-icon green">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor">
                        <path
                            d="M5 12l4 4L19 6"
                            stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>

                </span>

            </div>

            <div class="zeith-news-stat-number">
                <?= $publishedArticles ?>
            </div>

        </div>


        <!-- Drafts -->
        <div class="zeith-news-stat">

            <div class="zeith-news-stat-top">

                <span class="zeith-news-stat-label">
                    Drafts
                </span>

                <span class="zeith-news-stat-icon orange">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor">
                        <path d="M12 8v4l3 2"></path>
                        <circle cx="12" cy="12" r="9"></circle>
                    </svg>

                </span>

            </div>

            <div class="zeith-news-stat-number">
                <?= $draftArticles ?>
            </div>

        </div>


        <!-- Featured -->
        <div class="zeith-news-stat">

            <div class="zeith-news-stat-top">

                <span class="zeith-news-stat-label">
                    Featured
                </span>

                <span class="zeith-news-stat-icon purple">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor">
                        <path
                            d="M12 3l2.8 5.7 6.2.9-4.5 4.4 1.1 6.2-5.6-2.9-5.6 2.9 1.1-6.2L3 9.6l6.2-.9L12 3z"
                            stroke-linejoin="round" />
                    </svg>

                </span>

            </div>

            <div class="zeith-news-stat-number">
                <?= $featuredArticles ?>
            </div>

        </div>

    </section>


    <!-- =====================================================
         TOOLBAR
         ====================================================== -->

    <section class="zeith-news-toolbar">

        <div class="zeith-news-search">

            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor">
                <circle cx="11" cy="11" r="7"></circle>
                <path
                    d="M20 20l-4-4"
                    stroke-linecap="round" />
            </svg>

            <input
                type="search"
                id="zeithNewsSearch"
                placeholder="Search articles..."
                autocomplete="off">

        </div>


        <div class="zeith-news-filters">

            <select
                class="zeith-news-filter"
                id="zeithNewsStatusFilter">

                <option value="all">
                    All Status
                </option>

                <option value="published">
                    Published
                </option>

                <option value="draft">
                    Drafts
                </option>

            </select>


            <select
                class="zeith-news-filter"
                id="zeithNewsCategoryFilter">

                <option value="all">
                    All Categories
                </option>

                <option value="Watch Culture">
                    Watch Culture
                </option>

                <option value="Horology">
                    Horology
                </option>

                <option value="Guides">
                    Guides
                </option>

                <option value="Luxury">
                    Luxury
                </option>

                <option value="ZEITH Editorial">
                    ZEITH Editorial
                </option>

            </select>

        </div>

    </section>


    <!-- =====================================================
         ARTICLES TABLE
         ====================================================== -->

    <section class="zeith-news-table-wrap">

        <table class="zeith-news-table">

            <thead>

                <tr>

                    <th>
                        Article
                    </th>

                    <th>
                        Category
                    </th>

                    <th>
                        Status
                    </th>

                    <th>
                        Feature
                    </th>

                    <th>
                        Published / Created
                    </th>

                    <th style="text-align:right;">
                        Actions
                    </th>

                </tr>

            </thead>


            <tbody id="zeithNewsTableBody">

                <?php foreach ($articles as $article): ?>

                    <?php
                    $articleId = (int)($article['id'] ?? 0);

                    $title = htmlspecialchars(
                        $article['title'] ?? 'Untitled Article',
                        ENT_QUOTES,
                        'UTF-8'
                    );

                    $slug = htmlspecialchars(
                        $article['slug'] ?? '',
                        ENT_QUOTES,
                        'UTF-8'
                    );

                    $category = htmlspecialchars(
                        $article['category'] ?? 'Editorial',
                        ENT_QUOTES,
                        'UTF-8'
                    );

                    $summary = htmlspecialchars(
                        $article['summary'] ?? '',
                        ENT_QUOTES,
                        'UTF-8'
                    );

                    $content = htmlspecialchars(
                        $article['content'] ?? '',
                        ENT_QUOTES,
                        'UTF-8'
                    );

                    $imageUrl = htmlspecialchars(
                        $article['image_url'] ?? '',
                        ENT_QUOTES,
                        'UTF-8'
                    );

                    $status = $article['status'] ?? 'draft';

                    $isFeatured = !empty($article['is_featured']);

                    $createdAt = 'Not available';

                    if (!empty($article['created_at'])) {

                        $timestamp = strtotime(
                            $article['created_at']
                        );

                        if ($timestamp !== false) {
                            $createdAt = date(
                                'M j, Y',
                                $timestamp
                            );
                        }
                    }
                    ?>

                    <tr
                        class="zeith-news-row"
                        data-id="<?= $articleId ?>"
                        data-title="<?= $title ?>"
                        data-category="<?= $category ?>"
                        data-status="<?= htmlspecialchars($status, ENT_QUOTES, 'UTF-8') ?>">

                        <!-- Article -->
                        <td>

                            <div class="zeith-news-article-cell">

                                <div class="zeith-news-thumbnail">

                                    <?php if (!empty($imageUrl)): ?>

                                        <img
                                            src="/Zeith/assets/image/<?= $imageUrl ?>"
                                            alt="<?= $title ?>"
                                            loading="lazy">

                                    <?php endif; ?>

                                </div>


                                <div class="zeith-news-article-info">

                                    <h3 class="zeith-news-article-title">
                                        <?= $title ?>
                                    </h3>

                                    <div class="zeith-news-article-slug">
                                        /news/<?= $slug ?>
                                    </div>

                                </div>

                            </div>

                        </td>


                        <!-- Category -->
                        <td>

                            <span class="zeith-news-category">
                                <?= $category ?>
                            </span>

                        </td>


                        <!-- Status -->
                        <td>

                            <span
                                class="zeith-news-status <?= $status === 'published' ? 'published' : 'draft' ?>">

                                <span class="zeith-news-status-dot"></span>

                                <?= ucfirst(htmlspecialchars($status)) ?>

                            </span>

                        </td>


                        <!-- Featured -->
                        <td>

                            <button
                                type="button"
                                class="zeith-news-feature <?= $isFeatured ? 'active' : '' ?>"
                                data-id="<?= $articleId ?>"
                                title="<?= $isFeatured ? 'Remove from featured' : 'Feature article' ?>">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="<?= $isFeatured ? 'currentColor' : 'none' ?>"
                                    stroke="currentColor">
                                    <path
                                        d="M12 3l2.8 5.7 6.2.9-4.5 4.4 1.1 6.2-5.6-2.9-5.6 2.9 1.1-6.2L3 9.6l6.2-.9L12 3z"
                                        stroke-linejoin="round" />
                                </svg>

                                <?= $isFeatured ? 'Featured' : 'Feature' ?>

                            </button>

                        </td>


                        <!-- Date -->
                        <td>
                            <?= $createdAt ?>
                        </td>


                        <!-- Actions -->
                        <td>

                            <div class="zeith-news-actions">

                                <!-- Edit -->
                                <button type="button"
                                    class="zeith-news-action edit zeith-edit-article"
                                    title="Edit article"
                                    data-id="<?= $articleId ?>"
                                    data-title="<?= $title ?>"
                                    data-slug="<?= $slug ?>"
                                    data-category="<?= $category ?>"
                                    data-summary="<?= $summary ?>"
                                    data-content="<?= $content ?>"
                                    data-image="<?= $imageUrl ?>"
                                    data-status="<?= htmlspecialchars($status, ENT_QUOTES, 'UTF-8') ?>"
                                    data-featured="<?= $isFeatured ? '1' : '0' ?>"
                                    onclick="openEditModal(this)">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor">
                                        <path
                                            d="M12 20h9"
                                            stroke-linecap="round" />

                                        <path
                                            d="M16.5 3.5a2.1 2.1 0 013 3L8 18l-4 1 1-4L16.5 3.5z"
                                            stroke-linejoin="round" />
                                    </svg>

                                </button>


                                <!-- Publish / Unpublish -->
                                <button
                                    type="button"
                                    class="zeith-news-action publish zeith-toggle-publish"
                                    title="<?= $status === 'published' ? 'Unpublish article' : 'Publish article' ?>"
                                    data-id="<?= $articleId ?>"
                                    data-status="<?= htmlspecialchars($status, ENT_QUOTES, 'UTF-8') ?>">

                                    <?php if ($status === 'published'): ?>

                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor">
                                            <path
                                                d="M3 12s3.5-6 9-6 9 6 9 6-3.5 6-9 6-9-6-9-6z" />

                                            <circle
                                                cx="12"
                                                cy="12"
                                                r="2" />
                                        </svg>

                                    <?php else: ?>

                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor">
                                            <path
                                                d="M12 3v12"
                                                stroke-linecap="round" />

                                            <path
                                                d="M7 10l5 5 5-5"
                                                stroke-linecap="round"
                                                stroke-linejoin="round" />

                                            <path
                                                d="M5 21h14"
                                                stroke-linecap="round" />
                                        </svg>

                                    <?php endif; ?>

                                </button>


                                <!-- Delete -->
                                <button
                                    type="button"
                                    class="zeith-news-action delete zeith-delete-article"
                                    title="Delete article"
                                    data-id="<?= $articleId ?>"
                                    data-title="<?= $title ?>">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor">
                                        <path
                                            d="M3 6h18"
                                            stroke-linecap="round" />

                                        <path
                                            d="M8 6V4h8v2"
                                            stroke-linecap="round" />

                                        <path
                                            d="M19 6l-1 14H6L5 6"
                                            stroke-linejoin="round" />

                                        <path
                                            d="M10 11v5M14 11v5"
                                            stroke-linecap="round" />
                                    </svg>

                                </button>

                            </div>

                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    </section>

</div>


<!-- =========================================================
     ADD / EDIT ARTICLE MODAL
     ========================================================== -->

<div
    class="zeith-news-modal"
    id="zeithArticleModal">

    <div class="zeith-news-modal-card">

        <div class="zeith-news-modal-header">

            <h2 id="zeithArticleModalTitle">
                Create New Article
            </h2>

            <button
                type="button"
                class="zeith-news-modal-close"
                id="zeithCloseArticleModal">
                ✕
            </button>

        </div>


        <form
            id="zeithArticleForm"
            method="post"
            action="">

            <div class="zeith-news-modal-body">

                <div class="zeith-news-form-grid">

                    <!-- Title -->
                    <div class="zeith-news-form-group full">

                        <label for="zeithArticleTitle">
                            Article Title
                        </label>

                        <input
                            type="text"
                            id="zeithArticleTitle"
                            name="title"
                            placeholder="Enter article title"
                            required>

                    </div>


                    <!-- Slug -->
                    <div class="zeith-news-form-group">

                        <label for="zeithArticleSlug">
                            Slug
                        </label>

                        <input
                            type="text"
                            id="zeithArticleSlug"
                            name="slug"
                            placeholder="article-url-slug"
                            required>

                    </div>


                    <!-- Category -->
                    <div class="zeith-news-form-group">

                        <label for="zeithArticleCategory">
                            Category
                        </label>

                        <select
                            id="zeithArticleCategory"
                            name="category">

                            <option value="Watch Culture">
                                Watch Culture
                            </option>

                            <option value="Horology">
                                Horology
                            </option>

                            <option value="Guides">
                                Guides
                            </option>

                            <option value="Luxury">
                                Luxury
                            </option>

                            <option value="ZEITH Editorial">
                                ZEITH Editorial
                            </option>

                        </select>

                    </div>


                    <!-- Image -->
                    <div class="zeith-news-form-group full">

                        <label for="zeithArticleImage">
                            Image Path
                        </label>

                        <input
                            type="text"
                            id="zeithArticleImage"
                            name="image_url"
                            placeholder="news/article-image.jpg">

                    </div>


                    <!-- Summary -->
                    <div class="zeith-news-form-group full">

                        <label for="zeithArticleSummary">
                            Summary / Excerpt
                        </label>

                        <textarea
                            id="zeithArticleSummary"
                            name="summary"
                            placeholder="Write a short editorial summary..."></textarea>

                    </div>


                    <!-- Content -->
                    <div class="zeith-news-form-group full">

                        <label for="zeithArticleContent">
                            Article Content
                        </label>

                        <textarea
                            id="zeithArticleContent"
                            name="content"
                            style="min-height:220px;"
                            placeholder="Write the full article/editorial content..."></textarea>

                    </div>


                    <!-- Status -->
                    <div class="zeith-news-form-group">

                        <label for="zeithArticleStatus">
                            Publication Status
                        </label>

                        <select
                            id="zeithArticleStatus"
                            name="status">

                            <option value="draft">
                                Draft
                            </option>

                            <option value="published">
                                Published
                            </option>

                        </select>

                    </div>


                    <!-- Featured -->
                    <div class="zeith-news-form-group">

                        <label>
                            Article Visibility
                        </label>

                        <label class="zeith-news-checkbox">

                            <input
                                type="checkbox"
                                id="zeithArticleFeatured"
                                name="is_featured"
                                value="1">

                            Feature this article on ZEITH News

                        </label>

                    </div>

                </div>

            </div>


            <div class="zeith-news-modal-footer">

                <button
                    type="button"
                    class="zeith-news-cancel-btn"
                    id="zeithCancelArticle">
                    Cancel
                </button>

                <button
                    type="submit"
                    class="zeith-news-save-btn">
                    Save Article
                </button>

            </div>

        </form>

    </div>

</div>


<!-- =========================================================
     DELETE MODAL
     ========================================================== -->

<div
    class="zeith-news-modal"
    id="zeithDeleteModal">

    <div class="zeith-delete-modal-card">

        <div class="zeith-delete-icon">

            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor">
                <path
                    d="M3 6h18"
                    stroke-linecap="round" />

                <path
                    d="M8 6V4h8v2"
                    stroke-linecap="round" />

                <path
                    d="M19 6l-1 14H6L5 6"
                    stroke-linejoin="round" />
            </svg>

        </div>


        <h2>
            Delete Article?
        </h2>

        <p>
            Are you sure you want to delete
            <strong id="zeithDeleteArticleName"></strong>?
            This action cannot be undone.
        </p>


        <div class="zeith-delete-actions">

            <button
                type="button"
                class="zeith-delete-cancel"
                id="zeithDeleteCancel">
                Cancel
            </button>

            <button
                type="button"
                class="zeith-delete-confirm"
                id="zeithDeleteConfirm">
                Delete Article
            </button>

        </div>

    </div>

</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Elements
        const articleModal = document.getElementById('zeithArticleModal');
        const deleteModal = document.getElementById('zeithDeleteModal');
        const addArticleButton = document.getElementById('zeithAddArticle');
        const closeArticleButton = document.getElementById('zeithCloseArticleModal');
        const cancelArticleButton = document.getElementById('zeithCancelArticle');
        const articleForm = document.getElementById('zeithArticleForm');
        const modalTitle = document.getElementById('zeithArticleModalTitle');

        // Form Fields
        const articleTitle = document.getElementById('zeithArticleTitle');
        const articleSlug = document.getElementById('zeithArticleSlug');
        const articleCategory = document.getElementById('zeithArticleCategory');
        const articleImage = document.getElementById('zeithArticleImage');
        const articleSummary = document.getElementById('zeithArticleSummary');
        const articleContent = document.getElementById('zeithArticleContent');
        const articleStatus = document.getElementById('zeithArticleStatus');
        const articleFeatured = document.getElementById('zeithArticleFeatured');

        // Search & Filters
        const searchInput = document.getElementById('zeithNewsSearch');
        const statusFilter = document.getElementById('zeithNewsStatusFilter');
        const categoryFilter = document.getElementById('zeithNewsCategoryFilter');

        // Delete Modal Elements
        const closeDeleteModalBtn = document.getElementById('zeithCloseDeleteModal');
        const cancelDeleteBtn = document.getElementById('zeithCancelDelete');
        const deleteConfirmBtn = document.getElementById('zeithDeleteConfirm');

        let editingArticleId = null;
        let deletingArticleId = null;

        // 1. Open Modal for Creating
        function openAddModal() {
            editingArticleId = null;
            if (modalTitle) modalTitle.textContent = 'Create New Article';
            if (articleForm) {
                articleForm.reset();
                articleForm.action = '/Zeith/admin/news/store';
            }
            if (articleStatus) articleStatus.value = 'draft';
            if (articleFeatured) articleFeatured.checked = false;
            if (articleModal) articleModal.classList.add('active');
            
            setTimeout(() => { if (articleTitle) articleTitle.focus(); }, 100);
        }

        // 2. Global Edit Handler (Reads safe JSON data-article attribute)
        window.openEditModal = function(button) {
            let article = {};
            try {
                article = JSON.parse(button.dataset.article || '{}');
            } catch(e) {
                console.error("Error parsing article JSON:", e);
            }

            editingArticleId = article.id || button.getAttribute('data-id');
            if (modalTitle) modalTitle.textContent = 'Edit Article';

            if (articleForm && editingArticleId) {
                articleForm.action = '/Zeith/admin/news/update/' + editingArticleId;
            }

            if (articleTitle) articleTitle.value = article.title || button.getAttribute('data-title') || '';
            if (articleSlug) articleSlug.value = article.slug || button.getAttribute('data-slug') || '';
            if (articleCategory) articleCategory.value = article.category || 'Watch Culture';
            if (articleImage) articleImage.value = article.image_url || '';
            if (articleSummary) articleSummary.value = article.summary || '';
            if (articleContent) articleContent.value = article.content || '';
            if (articleStatus) articleStatus.value = article.status || 'draft';
            if (articleFeatured) articleFeatured.checked = (String(article.is_featured) === '1');

            if (articleModal) articleModal.classList.add('active');
        };

        // 3. Close Article Modal
        function closeArticleModal() {
            if (articleModal) articleModal.classList.remove('active');
            editingArticleId = null;
        }

        if (addArticleButton) addArticleButton.addEventListener('click', openAddModal);
        if (closeArticleButton) closeArticleButton.addEventListener('click', closeArticleModal);
        if (cancelArticleButton) cancelArticleButton.addEventListener('click', closeArticleModal);

        if (articleModal) {
            articleModal.addEventListener('click', function(event) {
                if (event.target === articleModal) closeArticleModal();
            });
        }

        // 4. Auto-generate Slug on Title input (only when creating)
        if (articleTitle && articleSlug) {
            articleTitle.addEventListener('input', function() {
                if (editingArticleId !== null) return;
                articleSlug.value = articleTitle.value
                    .toLowerCase()
                    .trim()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-');
            });
        }

        // 5. Delete Functionality (Now safely inside DOMContentLoaded)
        document.querySelectorAll('.zeith-delete-article').forEach(btn => {
            btn.addEventListener('click', function() {
                deletingArticleId = this.getAttribute('data-id');
                const title = this.getAttribute('data-title') || 'this article';
                
                const deleteNameElem = document.getElementById('zeithDeleteArticleName');
                if (deleteNameElem) deleteNameElem.textContent = title;
                
                if (deleteModal) deleteModal.classList.add('active');
            });
        });

        function closeDeleteModal() {
            if (deleteModal) deleteModal.classList.remove('active');
            deletingArticleId = null;
        }

        if (closeDeleteModalBtn) closeDeleteModalBtn.addEventListener('click', closeDeleteModal);
        if (cancelDeleteBtn) cancelDeleteBtn.addEventListener('click', closeDeleteModal);

        if (deleteConfirmBtn) {
            deleteConfirmBtn.addEventListener('click', function() {
                if (deletingArticleId) {
                    window.location.href = `/Zeith/admin/news/delete/${deletingArticleId}`;
                }
            });
        }

        // 6. Search & Filters
        function applyFilters() {
            const search = searchInput ? searchInput.value.toLowerCase().trim() : '';
            const selectedStatus = statusFilter ? statusFilter.value : 'all';
            const selectedCategory = categoryFilter ? categoryFilter.value : 'all';

            document.querySelectorAll('.zeith-news-row').forEach(row => {
                const title = (row.dataset.title || '').toLowerCase();
                const category = row.dataset.category || '';
                const status = row.dataset.status || '';

                const matchesSearch = !search || title.includes(search) || category.toLowerCase().includes(search);
                const matchesStatus = selectedStatus === 'all' || status === selectedStatus;
                const matchesCategory = selectedCategory === 'all' || category === selectedCategory;

                row.style.display = (matchesSearch && matchesStatus && matchesCategory) ? '' : 'none';
            });
        }

        if (searchInput) searchInput.addEventListener('input', applyFilters);
        if (statusFilter) statusFilter.addEventListener('change', applyFilters);
        if (categoryFilter) categoryFilter.addEventListener('change', applyFilters);

        // Escape Key Handler for both Modals
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeArticleModal();
                closeDeleteModal();
            }
        });
    });
</script>