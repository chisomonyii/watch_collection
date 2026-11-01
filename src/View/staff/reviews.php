<?php
\App\Helpers\View::displayComponent("Staff/sidebar.php");

// Default variables if not passed from controller
$reviews = $reviews ?? [];
$totalReviews = $totalReviews ?? count($reviews);
$pendingReviews = $pendingReviews ?? 0;
$approvedReviews = $approvedReviews ?? 0;
$rejectedReviews = $rejectedReviews ?? 0;
?>

<?php
// views/Staff/review.php

\App\Helpers\View::displayComponent("Staff/sidebar.php");
?>

<main class="zeith-reviews-page">

    <header class="zeith-reviews-header">
        <div>
            <span class="zeith-eyebrow">ZEITH MODERATION</span>
            <h1>Reviews Management</h1>
            <p>
                Review customer submissions and approve or reject
                reviews before they appear on the website.
            </p>
        </div>

        <button
            type="button"
            class="zeith-refresh-btn"
            onclick="location.reload()"
        >
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <path
                    d="M20 11a8.1 8.1 0 0 0-15.5-3M4 5v4h4M4 13a8.1 8.1 0 0 0 15.5 3M20 19v-4h-4"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
            </svg>
            Refresh
        </button>
    </header>

    <!-- Stats Cards -->
    <section class="zeith-review-stats">
        <div class="zeith-review-stat-card">
            <div class="zeith-review-stat-icon blue">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M4 5.5A2.5 2.5 0 0 1 6.5 3h11A2.5 2.5 0 0 1 20 5.5v8A2.5 2.5 0 0 1 17.5 16H11l-4.5 4v-4h0A2.5 2.5 0 0 1 4 13.5z" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>
                </svg>
            </div>
            <div>
                <span>Total Reviews</span>
                <strong><?= number_format($totalReviews) ?></strong>
            </div>
        </div>

        <div class="zeith-review-stat-card">
            <div class="zeith-review-stat-icon orange">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="12" cy="12" r="8.5" fill="none" stroke="currentColor" stroke-width="1.8"/>
                    <path d="M12 7v5l3 2" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
            </div>
            <div>
                <span>Pending Reviews</span>
                <strong id="pendingReviewCount"><?= number_format($pendingReviews) ?></strong>
            </div>
        </div>

        <div class="zeith-review-stat-card">
            <div class="zeith-review-stat-icon green">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M5 12.5 9.2 17 19 7" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div>
                <span>Approved</span>
                <strong><?= number_format($approvedReviews) ?></strong>
            </div>
        </div>

        <div class="zeith-review-stat-card">
            <div class="zeith-review-stat-icon red">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M7 7l10 10M17 7 7 17" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round"/>
                </svg>
            </div>
            <div>
                <span>Rejected</span>
                <strong><?= number_format($rejectedReviews) ?></strong>
            </div>
        </div>
    </section>

    <section class="zeith-review-workspace">

        <!-- Reviews List Panel -->
        <div class="zeith-review-list-panel">
            <div class="zeith-review-panel-header">
                <div>
                    <h2>Customer Reviews</h2>
                    <p>Moderate customer submissions before publication.</p>
                </div>

                <div class="zeith-review-tools">
                    <div class="zeith-review-search">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <circle cx="11" cy="11" r="6.5" fill="none" stroke="currentColor" stroke-width="1.8"/>
                            <path d="m16 16 4 4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                        </svg>
                        <input type="search" id="zeithReviewSearch" placeholder="Search reviews..." autocomplete="off">
                    </div>

                    <select id="zeithReviewFilter" class="zeith-review-filter">
                        <option value="all">All Reviews</option>
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
            </div>

            <div class="zeith-review-list" id="zeithReviewList">
                <?php if (empty($reviews)): ?>
                    <p style="padding: 20px; color: #64748B; text-align: center;">No reviews found.</p>
                <?php else: ?>
                    <?php foreach ($reviews as $index => $rev): 
                        $id = $rev['id'] ?? 0;
                        $reviewIdText = 'REV-' . (1000 + $id);
                        $title = htmlspecialchars($rev['title'] ?? 'Untitled Review');
                        $customerName = htmlspecialchars($rev['customer_name'] ?? 'Customer');
                        $email = htmlspecialchars($rev['customer_email'] ?? 'customer@example.com');
                        $comment = htmlspecialchars($rev['comment'] ?? '');
                        $rating = (int)($rev['rating'] ?? 5);
                        $status = strtolower(trim($rev['status'] ?? 'pending'));
                        $createdAt = $rev['created_at'] ?? '';
                        $formattedDate = $createdAt ? date('F j, Y', strtotime($createdAt)) : 'Recent';
                        $imageUrl = !empty($rev['image_url']) ? '/Zeith/assets/image/reviews/' . $rev['image_url'] : '/Zeith/assets/image/reviews/review3.jpg';
                        
                        // Generate star rating string
                        $stars = str_repeat('★', $rating) . str_repeat('☆', 5 - $rating);
                        $initials = strtoupper(substr($customerName, 0, 2));
                        $isActive = ($index === 0) ? 'active' : '';
                    ?>
                        <button
                            type="button"
                            class="zeith-review-row <?= $isActive ?>"
                            data-review-id="<?= $reviewIdText ?>"
                            data-db-id="<?= $id ?>"
                            data-status="<?= $status ?>"
                            data-title="<?= $title ?>"
                            data-customer="<?= $customerName ?>"
                            data-email="<?= $email ?>"
                            data-comment="<?= $comment ?>"
                            data-rating="<?= $rating ?>"
                            data-stars="<?= $stars ?>"
                            data-date="<?= $formattedDate ?>"
                            data-image="<?= $imageUrl ?>"
                            onclick="selectReview(this)"
                        >
                            <div class="zeith-review-thumbnail">
                                <img src="<?= $imageUrl ?>" alt="Customer watch review">
                            </div>

                            <div class="zeith-review-row-content">
                                <strong><?= $title ?></strong>
                                <span><?= $customerName ?></span>
                                <small>Submitted <?= $formattedDate ?></small>
                            </div>

                            <div class="zeith-review-row-side">
                                <div class="zeith-stars"><?= $stars ?></div>
                                <span class="zeith-review-status <?= $status ?>"><?= ucfirst($status) ?></span>
                            </div>
                        </button>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Review Details & Moderation Panel -->
        <aside class="zeith-review-details">
            <?php 
                $first = $reviews[0] ?? null;
                $defaultId = $first ? 'REV-' . (1000 + $first['id']) : 'REV-1001';
                $defaultTitle = $first['title'] ?? 'No Review Selected';
                $defaultStatus = $first['status'] ?? 'pending';
                $defaultImage = !empty($first['image_url']) ? '/Zeith/assets/image/reviews/' . $first['image_url'] : '/Zeith/assets/image/reviews/review3.jpg';
                $defaultName = $first['customer_name'] ?? 'N/A';
                $defaultEmail = $first['customer_email'] ?? 'N/A';
                $defaultRating = (int)($first['rating'] ?? 5);
                $defaultStars = str_repeat('★', $defaultRating) . str_repeat('☆', 5 - $defaultRating);
                $defaultComment = $first['comment'] ?? 'Select a review to inspect details.';
                $defaultDate = isset($first['created_at']) ? date('F j, Y', strtotime($first['created_at'])) : 'N/A';
                $defaultDbId = $first['id'] ?? 0;
            ?>

            <div class="zeith-review-details-header">
                <div>
                    <span class="zeith-details-label">REVIEW MODERATION</span>
                    <h2 id="zeithReviewDetailTitle"><?= htmlspecialchars($defaultTitle) ?></h2>
                </div>
                <span class="zeith-review-status <?= $defaultStatus ?>" id="zeithReviewDetailStatus">
                    <?= ucfirst($defaultStatus) ?>
                </span>
            </div>

            <div class="zeith-review-detail-image">
                <img id="zeithReviewDetailImage" src="<?= $defaultImage ?>" alt="Customer review image">
            </div>

            <div class="zeith-review-detail-section">
                <div class="zeith-review-section-heading">
                    <h3>Customer</h3>
                </div>
                <div class="zeith-review-customer">
                    <div class="zeith-customer-avatar" id="zeithCustomerInitials"><?= strtoupper(substr($defaultName, 0, 2)) ?></div>
                    <div>
                        <strong id="zeithReviewCustomerName"><?= htmlspecialchars($defaultName) ?></strong>
                        <span id="zeithReviewCustomerEmail"><?= htmlspecialchars($defaultEmail) ?></span>
                    </div>
                </div>
            </div>

            <div class="zeith-review-detail-section">
                <div class="zeith-review-section-heading">
                    <h3>Review Content</h3>
                    <div class="zeith-detail-stars" id="zeithDetailStars"><?= $defaultStars ?></div>
                </div>
                <div class="zeith-review-content-box">
                    <h4 id="zeithReviewContentTitle"><?= htmlspecialchars($defaultTitle) ?></h4>
                    <p id="zeithReviewContentText"><?= htmlspecialchars($defaultComment) ?></p>
                </div>
            </div>

            <div class="zeith-review-detail-section">
                <div class="zeith-review-section-heading">
                    <h3>Submission Information</h3>
                </div>
                <div class="zeith-review-meta-grid">
                    <div>
                        <span>Review ID</span>
                        <strong id="zeithReviewId"><?= $defaultId ?></strong>
                    </div>
                    <div>
                        <span>Submitted</span>
                        <strong id="zeithReviewDate"><?= $defaultDate ?></strong>
                    </div>
                    <div>
                        <span>Rating</span>
                        <strong id="zeithReviewRating"><?= $defaultRating ?> / 5</strong>
                    </div>
                </div>
            </div>

            <div class="zeith-review-moderation" id="zeithModerationActions">
                <div>
                    <span>Moderation Access</span>
                    <strong>Approve or reject this review before publication.</strong>
                </div>

                <div class="zeith-moderation-buttons">
                    <a href="/Zeith/staff/reviews/reject/<?= $defaultDbId ?>" class="zeith-reject-btn" id="zeithRejectReviewLink" style="text-decoration:none; display:inline-flex; align-items:center; gap:6px;">
                        <svg viewBox="0 0 24 24" aria-hidden="true" style="width:16px;height:16px;"><path d="M7 7l10 10M17 7 7 17" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round"/></svg>
                        Reject
                    </a>

                    <a href="/Zeith/staff/reviews/approve/<?= $defaultDbId ?>" class="zeith-approve-btn" id="zeithApproveReviewLink" style="text-decoration:none; display:inline-flex; align-items:center; gap:6px;">
                        <svg viewBox="0 0 24 24" aria-hidden="true" style="width:16px;height:16px;"><path d="M5 12.5 9.2 17 19 7" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        Approve
                    </a>
                </div>
            </div>

            <div class="zeith-review-footer">
                <span>Review ID:</span>
                <strong id="zeithReviewFooterId"><?= $defaultId ?></strong>
            </div>

        </aside>

    </section>

</main>


<style>

/* =========================================================
   ZEITH REVIEWS MANAGEMENT
========================================================= */

.zeith-reviews-page {
    margin-left: 250px;
    min-height: 100vh;
    padding: 32px;
    background: #F4F6F9;
    color: #0F172A;
    font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
}


/* =========================
   HEADER
========================= */

.zeith-reviews-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 24px;
    margin-bottom: 28px;
}

.zeith-eyebrow {
    display: block;
    margin-bottom: 7px;
    color: #2563EB;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: .14em;
}

.zeith-reviews-header h1 {
    margin: 0;
    font-size: 30px;
    line-height: 1.2;
    letter-spacing: -.03em;
}

.zeith-reviews-header p {
    margin: 8px 0 0;
    color: #64748B;
    font-size: 14px;
}

.zeith-refresh-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-height: 42px;
    padding: 0 16px;
    border: 1px solid #E2E8F0;
    border-radius: 9px;
    background: #FFFFFF;
    color: #334155;
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
    transition: .2s ease;
}

.zeith-refresh-btn:hover {
    border-color: #2563EB;
    color: #2563EB;
}

.zeith-refresh-btn svg {
    width: 17px;
    height: 17px;
}


/* =========================
   STATISTICS
========================= */

.zeith-review-stats {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 18px;
    margin-bottom: 24px;
}

.zeith-review-stat-card {
    display: flex;
    align-items: center;
    gap: 14px;
    min-height: 100px;
    padding: 18px;
    border: 1px solid #E2E8F0;
    border-radius: 13px;
    background: #FFFFFF;
    box-shadow: 0 2px 8px rgba(15, 23, 42, .035);
}

.zeith-review-stat-icon {
    display: grid;
    place-items: center;
    width: 46px;
    height: 46px;
    flex: 0 0 46px;
    border-radius: 11px;
}

.zeith-review-stat-icon svg {
    width: 22px;
    height: 22px;
}

.zeith-review-stat-icon.blue {
    background: #EFF6FF;
    color: #2563EB;
}

.zeith-review-stat-icon.orange {
    background: #FFF7ED;
    color: #F59E0B;
}

.zeith-review-stat-icon.green {
    background: #ECFDF5;
    color: #10B981;
}

.zeith-review-stat-icon.red {
    background: #FEF2F2;
    color: #EF4444;
}

.zeith-review-stat-card span {
    display: block;
    margin-bottom: 5px;
    color: #64748B;
    font-size: 12px;
    font-weight: 600;
}

.zeith-review-stat-card strong {
    display: block;
    color: #0F172A;
    font-size: 23px;
    line-height: 1;
}


/* =========================
   WORKSPACE
========================= */

.zeith-review-workspace {
    display: grid;
    grid-template-columns: minmax(390px, .9fr) minmax(450px, 1.1fr);
    gap: 20px;
    align-items: start;
}


/* =========================
   PANELS
========================= */

.zeith-review-list-panel,
.zeith-review-details {
    border: 1px solid #E2E8F0;
    border-radius: 14px;
    background: #FFFFFF;
    box-shadow: 0 2px 10px rgba(15, 23, 42, .035);
}

.zeith-review-list-panel {
    overflow: hidden;
}


/* =========================
   LIST HEADER
========================= */

.zeith-review-panel-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 18px;
    padding: 21px;
    border-bottom: 1px solid #E2E8F0;
}

.zeith-review-panel-header h2 {
    margin: 0;
    font-size: 17px;
}

.zeith-review-panel-header p {
    margin: 5px 0 0;
    color: #64748B;
    font-size: 12px;
}

.zeith-review-tools {
    display: flex;
    align-items: center;
    gap: 8px;
}


/* =========================
   SEARCH
========================= */

.zeith-review-search {
    position: relative;
}

.zeith-review-search svg {
    position: absolute;
    top: 50%;
    left: 11px;
    width: 16px;
    height: 16px;
    color: #94A3B8;
    transform: translateY(-50%);
    pointer-events: none;
}

.zeith-review-search input {
    width: 165px;
    height: 38px;
    padding: 0 10px 0 34px;
    border: 1px solid #E2E8F0;
    border-radius: 8px;
    outline: none;
    color: #0F172A;
    background: #FFFFFF;
    font-size: 12px;
}

.zeith-review-search input:focus {
    border-color: #2563EB;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, .08);
}


/* =========================
   FILTER
========================= */

.zeith-review-filter {
    height: 38px;
    padding: 0 30px 0 10px;
    border: 1px solid #E2E8F0;
    border-radius: 8px;
    outline: none;
    color: #334155;
    background: #FFFFFF;
    font-size: 12px;
    cursor: pointer;
}


/* =========================
   REVIEW LIST
========================= */

.zeith-review-list {
    max-height: 700px;
    overflow-y: auto;
}

.zeith-review-row {
    display: grid;
    grid-template-columns: 58px minmax(0, 1fr) auto;
    align-items: center;
    gap: 13px;
    width: 100%;
    min-height: 105px;
    padding: 15px 18px;
    border: 0;
    border-bottom: 1px solid #F1F5F9;
    background: #FFFFFF;
    color: inherit;
    text-align: left;
    cursor: pointer;
    transition: background .2s ease, box-shadow .2s ease;
}

.zeith-review-row:hover {
    background: #F8FAFC;
}

.zeith-review-row.active {
    background: #EFF6FF;
    box-shadow: inset 3px 0 #2563EB;
}


/* THUMBNAIL */

.zeith-review-thumbnail {
    width: 58px;
    height: 58px;
    overflow: hidden;
    border-radius: 9px;
    background: #F1F5F9;
}

.zeith-review-thumbnail img {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
}


/* ROW CONTENT */

.zeith-review-row-content {
    min-width: 0;
}

.zeith-review-row-content strong {
    display: block;
    margin-bottom: 6px;
    overflow: hidden;
    color: #0F172A;
    font-size: 12px;
    font-weight: 800;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.zeith-review-row-content span {
    display: block;
    margin-bottom: 4px;
    color: #334155;
    font-size: 12px;
    font-weight: 700;
}

.zeith-review-row-content small {
    display: block;
    color: #94A3B8;
    font-size: 10px;
}


/* ROW SIDE */

.zeith-review-row-side {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 8px;
}

.zeith-stars,
.zeith-detail-stars {
    color: #F59E0B;
    font-size: 12px;
    letter-spacing: 1px;
}


/* =========================
   REVIEW STATUS
========================= */

.zeith-review-status {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 5px 8px;
    border-radius: 999px;
    font-size: 10px;
    font-weight: 800;
    line-height: 1.2;
    white-space: nowrap;
}

.zeith-review-status.pending {
    background: #FFF7ED;
    color: #C2410C;
}

.zeith-review-status.approved {
    background: #ECFDF5;
    color: #047857;
}

.zeith-review-status.rejected {
    background: #FEF2F2;
    color: #B91C1C;
}


/* =========================
   DETAILS HEADER
========================= */

.zeith-review-details {
    overflow: hidden;
}

.zeith-review-details-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    padding: 22px;
    border-bottom: 1px solid #E2E8F0;
}

.zeith-details-label {
    display: block;
    margin-bottom: 6px;
    color: #94A3B8;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: .12em;
}

.zeith-review-details-header h2 {
    margin: 0;
    color: #0F172A;
    font-size: 17px;
}


/* =========================
   DETAIL IMAGE
========================= */

.zeith-review-detail-image {
    height: 260px;
    padding: 18px;
    background: #F8FAFC;
    border-bottom: 1px solid #E2E8F0;
}

.zeith-review-detail-image img {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 11px;
}


/* =========================
   DETAIL SECTIONS
========================= */

.zeith-review-detail-section {
    padding: 20px 22px;
    border-bottom: 1px solid #E2E8F0;
}

.zeith-review-section-heading {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    margin-bottom: 15px;
}

.zeith-review-section-heading h3 {
    margin: 0;
    color: #0F172A;
    font-size: 13px;
}


/* =========================
   CUSTOMER
========================= */

.zeith-review-customer {
    display: flex;
    align-items: center;
    gap: 12px;
}

.zeith-customer-avatar {
    display: grid;
    place-items: center;
    width: 42px;
    height: 42px;
    flex: 0 0 42px;
    border-radius: 50%;
    background: #EFF6FF;
    color: #2563EB;
    font-size: 12px;
    font-weight: 900;
}

.zeith-review-customer strong {
    display: block;
    margin-bottom: 4px;
    color: #334155;
    font-size: 12px;
}

.zeith-review-customer span {
    display: block;
    color: #94A3B8;
    font-size: 10px;
}


/* =========================
   REVIEW CONTENT
========================= */

.zeith-review-content-box {
    padding: 16px;
    border: 1px solid #E2E8F0;
    border-radius: 10px;
    background: #F8FAFC;
}

.zeith-review-content-box h4 {
    margin: 0 0 9px;
    color: #0F172A;
    font-size: 14px;
}

.zeith-review-content-box p {
    margin: 0;
    color: #64748B;
    font-size: 12px;
    line-height: 1.7;
}


/* =========================
   META
========================= */

.zeith-review-meta-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
}

.zeith-review-meta-grid span {
    display: block;
    margin-bottom: 5px;
    color: #94A3B8;
    font-size: 10px;
    font-weight: 700;
}

.zeith-review-meta-grid strong {
    display: block;
    color: #334155;
    font-size: 12px;
}


/* =========================
   MODERATION
========================= */

.zeith-review-moderation {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 18px;
    padding: 20px 22px;
    background: #F8FAFC;
}

.zeith-review-moderation > div:first-child span {
    display: block;
    margin-bottom: 5px;
    color: #2563EB;
    font-size: 10px;
    font-weight: 900;
    letter-spacing: .08em;
    text-transform: uppercase;
}

.zeith-review-moderation > div:first-child strong {
    display: block;
    color: #475569;
    font-size: 11px;
    font-weight: 600;
}

.zeith-moderation-buttons {
    display: flex;
    gap: 8px;
    flex-shrink: 0;
}

.zeith-reject-btn,
.zeith-approve-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    min-height: 39px;
    padding: 0 14px;
    border-radius: 8px;
    font-size: 11px;
    font-weight: 800;
    cursor: pointer;
    transition: .2s ease;
}

.zeith-reject-btn svg,
.zeith-approve-btn svg {
    width: 15px;
    height: 15px;
}

.zeith-reject-btn {
    border: 1px solid #FECACA;
    background: #FFFFFF;
    color: #DC2626;
}

.zeith-reject-btn:hover {
    border-color: #EF4444;
    background: #FEF2F2;
}

.zeith-approve-btn {
    border: 1px solid #2563EB;
    background: #2563EB;
    color: #FFFFFF;
}

.zeith-approve-btn:hover {
    background: #1D4ED8;
}


/* =========================
   FOOTER
========================= */

.zeith-review-footer {
    display: flex;
    align-items: center;
    gap: 5px;
    padding: 14px 22px;
    color: #94A3B8;
    background: #FFFFFF;
    font-size: 10px;
}

.zeith-review-footer strong {
    color: #475569;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 1250px) {

    .zeith-review-stats {
        grid-template-columns: repeat(2, 1fr);
    }

    .zeith-review-workspace {
        grid-template-columns: 1fr;
    }
}


@media (max-width: 1024px) {

    .zeith-reviews-page {
        margin-left: 0;
        padding: 24px;
    }

    .zeith-review-panel-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .zeith-review-tools {
        width: 100%;
    }

    .zeith-review-search {
        flex: 1;
    }

    .zeith-review-search input {
        width: 100%;
    }

    .zeith-review-filter {
        flex: 0 0 180px;
    }
}


@media (max-width: 700px) {

    .zeith-reviews-page {
        padding: 18px;
    }

    .zeith-reviews-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .zeith-reviews-header h1 {
        font-size: 25px;
    }

    .zeith-refresh-btn {
        width: 100%;
    }

    .zeith-review-stats {
        grid-template-columns: 1fr;
    }

    .zeith-review-tools {
        align-items: stretch;
        flex-direction: column;
    }

    .zeith-review-search,
    .zeith-review-filter {
        width: 100%;
        flex: auto;
    }

    .zeith-review-row {
        grid-template-columns: 48px minmax(0, 1fr);
        min-height: 95px;
    }

    .zeith-review-thumbnail {
        width: 48px;
        height: 48px;
    }

    .zeith-review-row-side {
        display: none;
    }

    .zeith-review-details-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .zeith-review-detail-image {
        height: 230px;
    }

    .zeith-review-meta-grid {
        grid-template-columns: 1fr;
    }

    .zeith-review-moderation {
        align-items: stretch;
        flex-direction: column;
    }

    .zeith-moderation-buttons {
        width: 100%;
    }

    .zeith-reject-btn,
    .zeith-approve-btn {
        flex: 1;
    }
}


@media (max-width: 480px) {

    .zeith-reviews-page {
        padding: 14px;
    }

    .zeith-review-panel-header,
    .zeith-review-details-header,
    .zeith-review-detail-section {
        padding-left: 16px;
        padding-right: 16px;
    }

    .zeith-review-moderation {
        padding: 17px 16px;
    }

    .zeith-review-detail-image {
        height: 200px;
        padding: 12px;
    }
}

</style>


<script>
    function selectReview(button) {
        // Remove active class from all rows
        document.querySelectorAll('.zeith-review-row').forEach(row => row.classList.remove('active'));
        button.classList.add('active');

        // Extract dataset values
        const dbId = button.getAttribute('data-db-id');
        const reviewId = button.getAttribute('data-review-id');
        const status = button.getAttribute('data-status');
        const title = button.getAttribute('data-title');
        const customer = button.getAttribute('data-customer');
        const email = button.getAttribute('data-email');
        const comment = button.getAttribute('data-comment');
        const rating = button.getAttribute('data-rating');
        const stars = button.getAttribute('data-stars');
        const date = button.getAttribute('data-date');
        const image = button.getAttribute('data-image');

        // Populate detail pane elements
        document.getElementById('zeithReviewDetailTitle').textContent = title;
        
        const statusBadge = document.getElementById('zeithReviewDetailStatus');
        statusBadge.className = 'zeith-review-status ' + status;
        statusBadge.textContent = status.charAt(0).toUpperCase() + status.slice(1);

        document.getElementById('zeithReviewDetailImage').src = image;
        document.getElementById('zeithReviewCustomerName').textContent = customer;
        document.getElementById('zeithReviewCustomerEmail').textContent = email;
        document.getElementById('zeithCustomerInitials').textContent = customer.substring(0, 2).toUpperCase();
        
        document.getElementById('zeithDetailStars').textContent = stars;
        document.getElementById('zeithReviewContentTitle').textContent = title;
        document.getElementById('zeithReviewContentText').textContent = comment;

        document.getElementById('zeithReviewId').textContent = reviewId;
        document.getElementById('zeithReviewDate').textContent = date;
        document.getElementById('zeithReviewRating').textContent = rating + ' / 5';
        document.getElementById('zeithReviewFooterId').textContent = reviewId;

        // Update action link URLs dynamically
        document.getElementById('zeithRejectReviewLink').href = '/Zeith/staff/reviews/reject/' + dbId;
        document.getElementById('zeithApproveReviewLink').href = '/Zeith/staff/reviews/approve/' + dbId;
    }

    // Search and Filter functionality
    const searchInput = document.getElementById('zeithReviewSearch');
    const filterSelect = document.getElementById('zeithReviewFilter');

    function filterReviews() {
        const query = searchInput.value.toLowerCase();
        const filterVal = filterSelect.value;

        document.querySelectorAll('.zeith-review-row').forEach(row => {
            const title = row.querySelector('.zeith-review-row-content strong').textContent.toLowerCase();
            const customer = row.querySelector('.zeith-review-row-content span').textContent.toLowerCase();
            const status = row.getAttribute('data-status');

            const matchesSearch = title.includes(query) || customer.includes(query);
            const matchesFilter = (filterVal === 'all' || status === filterVal);

            if (matchesSearch && matchesFilter) {
                row.style.display = 'flex';
            } else {
                row.style.display = 'none';
            }
        });
    }

    if (searchInput) searchInput.addEventListener('input', filterReviews);
    if (filterSelect) filterSelect.addEventListener('change', filterReviews);
</script>