<?php

/**
 * ============================================================
 * ZEITH STAFF DASHBOARD
 * staff-request.php
 * ============================================================
 */
function zeithSellerEscape(string $value): string
{
    return htmlspecialchars(
        $value,
        ENT_QUOTES,
        'UTF-8'
    );
}

// Retrieve pending staff from session set by AdminController::staffRequests()
$pendingSellers = $_SESSION['pending_staff'] ?? [];
unset($_SESSION['pending_staff']); // Clear after reading

/*
|--------------------------------------------------------------------------
| DATABASE FALLBACK (Direct query if session is empty)
|--------------------------------------------------------------------------
*/
if (empty($pendingSellers)) {
    try {
        $pdo = new \PDO("mysql:host=localhost;dbname=watch_collection", "root", "");
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("
            SELECT id, firstname, lastname, email, created_at, status 
            FROM users 
            WHERE role = 'staff' AND status = 'pending' 
            ORDER BY created_at DESC
        ");
        $stmt->execute();
        $pendingSellers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Throwable $e) {
        $pendingSellers = [];
    }
}

$pendingCount = count($pendingSellers);
$currentDate = date('F j, Y');
?>

<style>
    /* ============================================================
   ZEITH SELLER VERIFICATION
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
   MAIN PAGE
============================================================ */

    .zeith-seller-page {

        margin-left: 250px;

        height: 100vh;

        min-height: 100vh;

        padding: 34px;

        overflow-y: auto;

        scrollbar-width: thin;

        scrollbar-color:
            #CBD5E1 transparent;
    }


    .zeith-seller-page::-webkit-scrollbar {
        width: 8px;
    }


    .zeith-seller-page::-webkit-scrollbar-track {
        background: transparent;
    }


    .zeith-seller-page::-webkit-scrollbar-thumb {

        background: #CBD5E1;

        border-radius: 20px;
    }


    .zeith-seller-page::-webkit-scrollbar-thumb:hover {

        background: #94A3B8;
    }


    .zeith-seller-container {

        width: 100%;

        max-width: 1500px;

        margin: 0 auto;
    }


    /* ============================================================
   PAGE HEADER
============================================================ */

    .zeith-seller-header {

        margin-bottom: 28px;
    }


    .zeith-seller-header h1 {

        margin: 0 0 7px;

        color: #0F172A;

        font-size: 30px;

        line-height: 1.2;

        font-weight: 800;

        letter-spacing: -.7px;
    }


    .zeith-seller-header p {

        margin: 0;

        color: #64748B;

        font-size: 13px;
    }


    /* ============================================================
   PENDING REQUESTS CARD
============================================================ */

    .zeith-pending-card {

        background: #FFFFFF;

        border: 1px solid #E2E8F0;

        border-radius: 16px;

        box-shadow:
            0 4px 20px rgba(15, 23, 42, .045);

        overflow: hidden;
    }


    .zeith-pending-header {

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 20px;

        padding: 25px 24px;

        border-bottom: 1px solid #F1F5F9;
    }


    .zeith-pending-title {

        display: flex;

        align-items: center;

        gap: 10px;
    }


    .zeith-pending-title h2 {

        margin: 0;

        color: #0F172A;

        font-size: 18px;

        font-weight: 800;
    }


    .zeith-pending-count {

        min-width: 27px;

        height: 27px;

        padding: 0 8px;

        display: inline-flex;

        align-items: center;

        justify-content: center;

        border-radius: 50px;

        background: #EFF6FF;

        color: #2563EB;

        font-size: 11px;

        font-weight: 800;
    }


    /* ============================================================
   SELLER GRID
============================================================ */

    .zeith-seller-grid {

        display: grid;

        grid-template-columns:
            repeat(auto-fill,
                minmax(330px, 1fr));

        gap: 18px;

        padding: 24px;
    }


    /* ============================================================
   SELLER REQUEST
============================================================ */

    .zeith-seller-request {

        position: relative;

        padding: 22px;

        border: 1px solid #E2E8F0;

        border-radius: 12px;

        background: #F8FAFC;

        transition:
            transform .2s ease,
            border-color .2s ease,
            box-shadow .2s ease;
    }


    .zeith-seller-request:hover {

        transform: translateY(-2px);

        border-color: #CBD5E1;

        box-shadow:
            0 8px 25px rgba(15, 23, 42, .06);
    }


    /* ============================================================
   SELLER TOP
============================================================ */

    .zeith-seller-top {

        display: flex;

        align-items: flex-start;

        gap: 13px;

        margin-bottom: 18px;
    }


    .zeith-seller-avatar {

        width: 48px;

        height: 48px;

        flex: 0 0 48px;

        display: flex;

        align-items: center;

        justify-content: center;

        border-radius: 50%;

        background: #0EA5A8;

        color: #FFFFFF;

        font-size: 17px;

        font-weight: 800;

        text-transform: uppercase;
    }


    .zeith-seller-main {

        min-width: 0;

        flex: 1;
    }


    .zeith-seller-name {

        margin: 0 0 4px;

        color: #0F172A;

        font-size: 15px;

        font-weight: 800;
    }


    .zeith-seller-joined {

        display: flex;

        align-items: center;

        gap: 5px;

        color: #64748B;

        font-size: 10px;
    }


    .zeith-seller-joined svg {

        width: 12px;

        height: 12px;
    }


    /* ============================================================
   PENDING BADGE
============================================================ */

    .zeith-pending-badge {

        display: inline-flex;

        align-items: center;

        padding: 5px 8px;

        border-radius: 20px;

        background: #FFF7ED;

        color: #C2410C;

        font-size: 8px;

        font-weight: 800;

        text-transform: uppercase;

        letter-spacing: .4px;
    }


    /* ============================================================
   SELLER EMAIL
============================================================ */

    .zeith-seller-email {

        display: flex;

        align-items: center;

        gap: 8px;

        margin-bottom: 20px;

        color: #64748B;

        font-size: 11px;

        word-break: break-word;
    }


    .zeith-seller-email svg {

        width: 16px;

        height: 16px;

        flex: 0 0 16px;

        color: #64748B;
    }


    /* ============================================================
   SELLER PHONE
============================================================ */

    .zeith-seller-phone {

        display: flex;

        align-items: center;

        gap: 8px;

        margin-top: -10px;

        margin-bottom: 20px;

        color: #64748B;

        font-size: 11px;
    }


    .zeith-seller-phone svg {

        width: 15px;

        height: 15px;

        color: #64748B;
    }


    /* ============================================================
   ACTION BUTTONS
============================================================ */

    .zeith-seller-actions {

        display: grid;

        grid-template-columns:
            1fr 1fr;

        gap: 8px;
    }


    .zeith-seller-action {

        height: 43px;

        display: inline-flex;

        align-items: center;

        justify-content: center;

        gap: 7px;

        border: 0;

        border-radius: 9px;

        font-size: 11px;

        font-weight: 800;

        cursor: pointer;

        transition: .2s ease;
    }


    .zeith-seller-action svg {

        width: 16px;

        height: 16px;
    }




    .zeith-btn-approve{
        background: #0EA5A8;

        color: #FFFFFF;

          border: 1px solid #28a92a;

           border-radius: 9px;
           height: 43px;
    }
    .zeith-btn-approve:hover{
        background: #0F8F91;

        transform: translateY(-1px);
    }

    .zeith-btn-approve svg {

        width: 16px;

        height: 16px;
    }



    .zeith-seller-reject {

        background: #FFFFFF;

        color: #DC2626;

        border: 1px solid #FECACA;
    }


    .zeith-seller-reject:hover {

        background: #FEF2F2;

        border-color: #FCA5A5;
    }


    /* ============================================================
   EMPTY STATE
============================================================ */

    .zeith-seller-empty {

        padding: 65px 25px;

        text-align: center;
    }


    .zeith-seller-empty-icon {

        width: 58px;

        height: 58px;

        margin: 0 auto 15px;

        display: grid;

        place-items: center;

        border-radius: 15px;

        background: #ECFDF5;

        color: #059669;
    }


    .zeith-seller-empty-icon svg {

        width: 28px;

        height: 28px;
    }


    .zeith-seller-empty h3 {

        margin: 0 0 6px;

        color: #334155;

        font-size: 16px;

        font-weight: 800;
    }


    .zeith-seller-empty p {

        margin: 0;

        color: #94A3B8;

        font-size: 11px;
    }


    /* ============================================================
   PAGE FOOTER
============================================================ */

    .zeith-seller-footer {

        margin-top: 18px;

        display: flex;

        align-items: center;

        justify-content: space-between;

        color: #94A3B8;

        font-size: 10px;
    }


    /* ============================================================
   CONFIRMATION MODAL
============================================================ */

    .zeith-seller-modal {

        position: fixed;

        inset: 0;

        z-index: 9999;

        display: none;

        align-items: center;

        justify-content: center;

        padding: 20px;

        background:
            rgba(15,
                23,
                42,
                .45);

        backdrop-filter: blur(3px);
    }


    .zeith-seller-modal.show {

        display: flex;
    }


    .zeith-seller-modal-card {

        width: min(430px,
                100%);

        padding: 26px;

        border-radius: 16px;

        background: #FFFFFF;

        box-shadow:
            0 25px 60px rgba(15, 23, 42, .20);

        animation:
            zeithModalIn .2s ease;
    }


    @keyframes zeithModalIn {

        from {

            opacity: 0;

            transform:
                translateY(10px) scale(.98);

        }

        to {

            opacity: 1;

            transform:
                translateY(0) scale(1);

        }

    }


    .zeith-modal-icon {

        width: 45px;

        height: 45px;

        margin-bottom: 15px;

        display: grid;

        place-items: center;

        border-radius: 12px;

        background: #EFF6FF;

        color: #2563EB;
    }


    .zeith-modal-icon.reject {

        background: #FEF2F2;

        color: #DC2626;
    }


    .zeith-modal-icon svg {

        width: 22px;

        height: 22px;
    }


    .zeith-seller-modal-card h3 {

        margin: 0 0 8px;

        color: #0F172A;

        font-size: 18px;

        font-weight: 800;
    }


    .zeith-seller-modal-card p {

        margin: 0 0 22px;

        color: #64748B;

        font-size: 12px;

        line-height: 1.65;
    }


    .zeith-modal-actions {

        display: flex;

        justify-content: flex-end;

        gap: 8px;
    }


    .zeith-modal-btn {

        min-height: 40px;

        padding: 0 15px;

        border-radius: 8px;

        border: 1px solid #CBD5E1;

        background: #FFFFFF;

        color: #475569;

        font-size: 11px;

        font-weight: 800;

        cursor: pointer;
    }


    .zeith-modal-btn.confirm {

        border-color: #0EA5A8;

        background: #0EA5A8;

        color: #FFFFFF;
    }


    .zeith-modal-btn.confirm:hover {

        background: #0F8F91;
    }


    .zeith-modal-btn.confirm.reject {

        border-color: #DC2626;

        background: #DC2626;
    }


    /* ============================================================
   RESPONSIVE
============================================================ */

    @media (max-width: 1024px) {

        .zeith-seller-page {

            margin-left: 0;

            padding: 25px;
        }

    }


    @media (max-width: 700px) {

        .zeith-seller-page {

            padding: 18px 14px;
        }


        .zeith-seller-header h1 {

            font-size: 25px;
        }


        .zeith-seller-grid {

            grid-template-columns: 1fr;

            padding: 15px;
        }


        .zeith-pending-header {

            padding: 19px 17px;
        }


        .zeith-seller-request {

            padding: 18px;
        }


        .zeith-seller-actions {

            grid-template-columns: 1fr;
        }


        .zeith-seller-footer {

            flex-direction: column;

            align-items: flex-start;

            gap: 5px;
        }

    }
</style>


<div class="zeith-seller-page">
    <?php
    \App\Helpers\View::displayComponent("admin/sidebar.php");
    ?>

    <div class="zeith-seller-container">

        <!-- HEADER -->
        <header class="zeith-seller-header">
            <h1>Staff Verification</h1>
            <p>Review and approve new staff registration requests.</p>
        </header>

        <!-- PENDING REQUESTS -->
        <section class="zeith-pending-card">
            <div class="zeith-pending-header">
                <div class="zeith-pending-title">
                    <h2>Pending Requests</h2>
                    <span class="zeith-pending-count"><?= $pendingCount ?></span>
                </div>
                <span class="zeith-pending-badge">
                    <?= $pendingCount > 0 ? 'Action Required' : 'All Clear' ?>
                </span>
            </div>

            <?php if (!empty($pendingSellers)): ?>
                <div class="zeith-seller-grid">
                    <?php foreach ($pendingSellers as $seller): ?>
                        <?php
                        $sellerId = (int)($seller['id'] ?? 0);

                        // Combine firstname and lastname from your users table
                        $firstName = trim($seller['firstname'] ?? '');
                        $lastName = trim($seller['lastname'] ?? '');
                        $sellerName = trim("$firstName $lastName") !== '' ? "$firstName $lastName" : 'New Staff';

                        $sellerEmail = trim($seller['email'] ?? 'No email provided');
                        $sellerPhone = trim($seller['phone'] ?? ''); // Optional if stored
                        $sellerDate = $seller['created_at'] ?? '';
                        $formattedDate = 'Unknown date';

                        if (!empty($sellerDate)) {
                            $timestamp = strtotime($sellerDate);
                            if ($timestamp !== false) {
                                $formattedDate = date('n/j/Y', $timestamp);
                            }
                        }

                        $sellerInitial = strtoupper(substr($sellerName, 0, 1));
                        ?>

                        <article class="zeith-seller-request" data-seller-id="<?= $sellerId ?>" data-seller-name="<?= zeithSellerEscape($sellerName) ?>">

                            <div class="zeith-seller-top">
                                <div class="zeith-seller-avatar">
                                    <?= zeithSellerEscape($sellerInitial) ?>
                                </div>

                                <div class="zeith-seller-main">
                                    <h3 class="zeith-seller-name"><?= zeithSellerEscape($sellerName) ?></h3>
                                    <div class="zeith-seller-joined">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                            <circle cx="12" cy="12" r="9" />
                                            <path d="M12 7v5l3 2" stroke-linecap="round" />
                                        </svg>
                                        Joined <?= zeithSellerEscape($formattedDate) ?>
                                    </div>
                                </div>
                            </div>

                            <!-- EMAIL -->
                            <div class="zeith-seller-email">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <rect x="3" y="5" width="18" height="14" rx="2" />
                                    <path d="m3 7 9 6 9-6" stroke-linejoin="round" />
                                </svg>
                                <span><?= zeithSellerEscape($sellerEmail) ?></span>
                            </div>

                            <?php if (!empty($sellerPhone)): ?>
                                <!-- PHONE -->
                                <div class="zeith-seller-phone">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                        <path d="M6 3h3l2 5-2 1.5a13 13 0 0 0 5.5 5.5L16 13l5 2v3a2 2 0 0 1-2 2C10.7 20 4 13.3 4 5a2 2 0 0 1 2-2z" stroke-linejoin="round" />
                                    </svg>
                                    <span><?= zeithSellerEscape($sellerPhone) ?></span>
                                </div>
                            <?php endif; ?>

                            <!-- ACTIONS -->
                            <!-- ACTIONS -->
                            <div class="zeith-seller-actions">

                                <!-- APPROVE FORM -->
                                <form action="/Watch_Collection/admin/staff/approve/<?= $sellerId ?>" method="POST" style="display:inline;">
                                    <button type="submit" class="zeith-btn-approve" style="/* your preferred button styling */">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                                            <circle cx="12" cy="12" r="9" />
                                            <path d="m8 12 2.5 2.5L16 9" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        Approve Staff
                                    </button>
                                </form>

                                <!-- REJECT BUTTON -->
                                <button
                                    type="button"
                                    class="zeith-seller-action zeith-seller-reject"
                                    data-action="reject"
                                    data-id="<?= $sellerId ?>"
                                    data-name="<?= zeithSellerEscape($sellerName) ?>">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="9" />
                                        <path d="m9 9 6 6M15 9l-6 6" stroke-linecap="round" />
                                    </svg>
                                    Reject
                                </button>

                            </div>

                        </article>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <!-- EMPTY STATE -->
                <div class="zeith-seller-empty">
                    <div class="zeith-seller-empty-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="m5 12 4 4L19 6" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <h3>No Pending Staff Requests</h3>
                    <p>There are currently no staff registrations waiting for approval.</p>
                </div>
            <?php endif; ?>

        </section>

        <!-- FOOTER -->
        <div class="zeith-seller-footer">
            <span>ZEITH Staff Verification</span>
            <span>Last updated <?= zeithSellerEscape($currentDate) ?></span>
        </div>

    </div>
</div>


<script>
    document.addEventListener(
        'DOMContentLoaded',
        function() {

            /* ======================================================
               ELEMENTS
            ====================================================== */

            const modal = document.getElementById('zeithSellerModal');
            const modalTitle = document.getElementById('zeithModalTitle');
            const modalMessage = document.getElementById('zeithModalMessage');
            const modalConfirm = document.getElementById('zeithModalConfirm');
            const modalCancel = document.getElementById('zeithModalCancel');
            const modalIcon = document.getElementById('zeithModalIcon');
            const modalIconSvg = document.getElementById('zeithModalIconSvg');

            let selectedAction = null;
            let selectedSellerId = null;
            let selectedSellerName = '';

            /* ======================================================
               OPEN MODAL
            ====================================================== */

            function openModal(action, sellerId, sellerName) {
                selectedAction = action;
                selectedSellerId = sellerId;
                selectedSellerName = sellerName;

                if (action === 'approve') {
                    modalTitle.textContent = 'Approve Staff?';
                    modalMessage.textContent = 'Are you sure you want to approve ' + sellerName + '? Once approved, the staff member will gain full dashboard access.';
                    modalConfirm.textContent = 'Approve Staff';
                    modalConfirm.classList.remove('reject');
                    modalIcon.classList.remove('reject');
                    modalIconSvg.innerHTML = `
                        <circle cx="12" cy="12" r="9"/>
                        <path d="m8 12 2.5 2.5L16 9" stroke-linecap="round" stroke-linejoin="round"/>
                    `;
                } else {
                    modalTitle.textContent = 'Reject Staff?';
                    modalMessage.textContent = 'Are you sure you want to reject ' + sellerName + '\'s registration request?';
                    modalConfirm.textContent = 'Reject Staff';
                    modalConfirm.classList.add('reject');
                    modalIcon.classList.add('reject');
                    modalIconSvg.innerHTML = `
                        <circle cx="12" cy="12" r="9"/>
                        <path d="m9 9 6 6M15 9l-6 6" stroke-linecap="round"/>
                    `;
                }

                modal.classList.add('show');
                document.body.style.overflow = 'hidden';
            }

            /* ======================================================
               CLOSE MODAL
            ====================================================== */

            function closeModal() {
                modal.classList.remove('show');
                document.body.style.overflow = '';
            }

            /* ======================================================
               APPROVE / REJECT BUTTONS (Trigger Modal)
            ====================================================== */

            document.querySelectorAll('.zeith-seller-action').forEach(function(button) {
                button.addEventListener('click', function(e) {
                    // Prevent form submission if buttons are wrapped in a form
                    e.preventDefault();

                    const action = this.dataset.action;
                    const sellerId = this.dataset.id;
                    const sellerName = this.dataset.name;

                    openModal(action, sellerId, sellerName);
                });
            });

            /* ======================================================
               CANCEL
            ====================================================== */

            modalCancel.addEventListener('click', closeModal);

            /* ======================================================
               CLICK OUTSIDE
            ====================================================== */

            modal.addEventListener('click', function(event) {
                if (event.target === modal) {
                    closeModal();
                }
            });

            /* ======================================================
               ESCAPE
            ====================================================== */

            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape' && modal.classList.contains('show')) {
                    closeModal();
                }
            });

            /* ======================================================
               CONFIRM ACTION (Connected to Backend Database)
            ====================================================== */

            modalConfirm.addEventListener('click', function() {
                if (!selectedSellerId || !selectedAction) {
                    return;
                }

                // Determine route based on action
                let endpoint = '';
                if (selectedAction === 'approve') {
                    endpoint = '/Watch_Collection/admin/staff/approve/' + selectedSellerId;
                } else {
                    // If you add a reject route later, plug it in here
                    endpoint = '/Watch_Collection/admin/staff/reject/' + selectedSellerId;
                }

                // Send request to backend controller to update database
                fetch(endpoint, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => {
                        closeModal();
                        // Reload the page to reflect database changes and update the pending list view
                        window.location.reload();
                    })
                    .catch(error => {
                        console.error('Error processing request:', error);
                        alert('An error occurred while processing the request.');
                        closeModal();
                    });
            });

        }
    );
</script>