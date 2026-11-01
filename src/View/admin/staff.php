<?php
// Fallback defaults if accessed directly without controller
$staffMembers = $staffMembers ?? [];
$totalStaff = $totalStaff ?? count($staffMembers);
$activeStaff = $activeStaff ?? 0;
$suspendedStaff = $suspendedStaff ?? 0;
$adminCount = $adminCount ?? 0;
?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Staff Management | ZEITH Admin</title>

</head>


<body>


    <?php

    \App\Helpers\View::displayComponent("Admin/sidebar.php");
    ?>



    <!-- =====================================================
     STAFF MANAGEMENT PAGE
===================================================== -->

    <main class="zeith-staff-page">
        <header class="zeith-staff-header">
            <div>
                <span class="zeith-page-eyebrow">ZEITH ADMIN</span>
                <h1>Staff Management</h1>
                <p>Manage staff access, roles and account status.</p>
            </div>

            <div class="zeith-header-badge">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                <span><?= $totalStaff ?> Staff</span>
            </div>
        </header>

        <section class="zeith-staff-summary">
            <div class="zeith-summary-card">
                <div class="zeith-summary-icon total">
                    <svg viewBox="0 0 24 24">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
                <div>
                    <span class="zeith-summary-label">Total Staff</span>
                    <strong><?= $totalStaff ?></strong>
                </div>
            </div>

            <div class="zeith-summary-card">
                <div class="zeith-summary-icon active">
                    <svg viewBox="0 0 24 24">
                        <path d="M20 6L9 17l-5-5"></path>
                    </svg>
                </div>
                <div>
                    <span class="zeith-summary-label">Active</span>
                    <strong><?= $activeStaff ?></strong>
                </div>
            </div>

            <div class="zeith-summary-card">
                <div class="zeith-summary-icon suspended">
                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="9"></circle>
                        <path d="M8 8l8 8"></path>
                    </svg>
                </div>
                <div>
                    <span class="zeith-summary-label">Suspended</span>
                    <strong><?= $suspendedStaff ?></strong>
                </div>
            </div>

            <div class="zeith-summary-card">
                <div class="zeith-summary-icon admin">
                    <svg viewBox="0 0 24 24">
                        <path d="M12 2l8 4v6c0 5-3.5 8.5-8 10-4.5-1.5-8-5-8-10V6l8-4z"></path>
                        <path d="M9 12l2 2 4-4"></path>
                    </svg>
                </div>
                <div>
                    <span class="zeith-summary-label">Administrators</span>
                    <strong><?= $adminCount ?></strong>
                </div>
            </div>
        </section>

        <section class="zeith-staff-card">
            <div class="zeith-staff-card-header">
                <div>
                    <h2>Platform Staff</h2>
                    <p>Manage administrative and operational access.</p>
                </div>

                <div class="zeith-staff-count">
                    Showing
                    <strong><?= $totalStaff ?></strong>
                    staff members
                </div>
            </div>

            <div class="zeith-staff-toolbar">
                <div class="zeith-search-box">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <circle cx="11" cy="11" r="7"></circle>
                        <path d="m20 20-4-4"></path>
                    </svg>
                    <input type="search" id="zeithStaffSearch" placeholder="Search staff..." autocomplete="off">
                </div>

                <select id="zeithRoleFilter" class="zeith-filter-select">
                    <option value="all">All Roles</option>
                    <option value="admin">Admin</option>
                    <option value="staff">Staff</option>
                </select>

                <select id="zeithStatusFilter" class="zeith-filter-select">
                    <option value="all">All Status</option>
                    <option value="active">Active</option>
                    <option value="suspended">Suspended</option>
                </select>
            </div>

            <div class="zeith-table-wrapper">
                <table class="zeith-staff-table">
                    <thead>
                        <tr>
                            <th>STAFF INFO</th>
                            <th>ROLE</th>
                            <th>CONTACT DETAILS</th>
                            <th>ACCOUNT STATUS</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>

                    <tbody id="zeithStaffTableBody">
                        <?php if (!empty($staffMembers)): ?>
                            <?php foreach ($staffMembers as $member): ?>
                                <?php
                                $id = (int)($member['id'] ?? 0);
                                $name = htmlspecialchars($member['name'] ?? 'Unknown Staff', ENT_QUOTES, 'UTF-8');
                                $email = htmlspecialchars($member['email'] ?? '', ENT_QUOTES, 'UTF-8');
                                $role = ucfirst(strtolower($member['role'] ?? 'Staff'));
                                $rawStatus = trim(strtolower($member['status'] ?? 'active'));
                                $status = ($rawStatus === 'suspended') ? 'suspended' : 'active';
                                $statusDisplay = ucfirst($status);
                                $joined = htmlspecialchars($member['joined_at'] ?? '', ENT_QUOTES, 'UTF-8');
                                $initial = strtoupper(substr(trim($name), 0, 1));
                                ?>

                                <tr
                                    class="zeith-staff-row"
                                    data-name="<?= strtolower($name) ?>"
                                    data-email="<?= strtolower($email) ?>"
                                    data-role="<?= strtolower($role) ?>"
                                    data-status="<?= $status ?>">
                                    <td>
                                        <div class="zeith-staff-info">
                                            <div class="zeith-avatar">
                                                <?= htmlspecialchars($initial, ENT_QUOTES, 'UTF-8') ?>
                                            </div>

                                            <div class="zeith-staff-name">
                                                <strong><?= $name ?></strong>
                                                <span>
                                                    ID:
                                                    <?= str_pad((string)$id, 6, '0', STR_PAD_LEFT) ?>
                                                </span>
                                                <small>Joined <?= $joined ?></small>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <span class="zeith-role-badge <?= strtolower($role) ?>">
                                            <?php if ($role === 'Admin'): ?>
                                                <svg viewBox="0 0 24 24">
                                                    <path d="M12 2l8 4v6c0 5-3.5 8.5-8 10-4.5-1.5-8-5-8-10V6l8-4z"></path>
                                                </svg>
                                            <?php else: ?>
                                                <svg viewBox="0 0 24 24">
                                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                                    <circle cx="9" cy="7" r="4"></circle>
                                                </svg>
                                            <?php endif; ?>

                                            <?= htmlspecialchars($role, ENT_QUOTES, 'UTF-8') ?>
                                        </span>
                                    </td>

                                    <td>
                                        <div class="zeith-contact-details">
                                            <div>
                                                <svg viewBox="0 0 24 24">
                                                    <rect x="3" y="5" width="18" height="14" rx="2"></rect>
                                                    <path d="m3 7 9 6 9-6"></path>
                                                </svg>
                                                <span><?= $email ?></span>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <span class="zeith-status-badge <?= $status ?>">
                                            <span class="zeith-status-dot"></span>
                                            <?= htmlspecialchars($statusDisplay, ENT_QUOTES, 'UTF-8') ?>
                                        </span>
                                    </td>

                                    <td>
                                        <div class="zeith-staff-actions">
                                            <button
                                                type="button"
                                                class="zeith-action-btn role"
                                                title="Change role"
                                                onclick="openRoleModal(
                                                <?= $id ?>,
                                                '<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>',
                                                '<?= htmlspecialchars($role, ENT_QUOTES, 'UTF-8') ?>'
                                            )">
                                                <svg viewBox="0 0 24 24">
                                                    <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"></path>
                                                    <path d="M19.4 15a1.7 1.7 0 0 0 .34 1.88l.06.06-1.7 1.7-.06-.06a1.7 1.7 0 0 0-1.88-.34 1.7 1.7 0 0 0-1.03 1.55V20h-2.4v-.21a1.7 1.7 0 0 0-1.03-1.55 1.7 1.7 0 0 0-1.88.34l-.06.06-1.7-1.7.06-.06A1.7 1.7 0 0 0 8.46 15a1.7 1.7 0 0 0-1.55-1.03H6v-2.4h.91A1.7 1.7 0 0 0 8.46 10a1.7 1.7 0 0 0-.34-1.88l-.06-.06 1.7-1.7.06.06a1.7 1.7 0 0 0 1.88.34 1.7 1.7 0 0 0 1.03-1.55V5h2.4v.21a1.7 1.7 0 0 0 1.03 1.55 1.7 1.7 0 0 0 1.88-.34l.06-.06 1.7-1.7.06.06A1.7 1.7 0 0 0 19.4 10c.16.62.71 1.03 1.35 1.03H21v2.4h-.25c-.64 0-1.19.41-1.35 1.03z"></path>
                                                </svg>
                                            </button>

                                            <?php if ($status === 'suspended'): ?>
                                                <button
                                                    type="button"
                                                    class="zeith-action-btn activate"
                                                    title="Activate staff"
                                                    onclick="openStatusModal(
                                                    <?= $id ?>,
                                                    '<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>',
                                                    'activate'
                                                )">
                                                    <svg viewBox="0 0 24 24">
                                                        <path d="M20 6L9 17l-5-5"></path>
                                                    </svg>
                                                </button>
                                            <?php else: ?>
                                                <button
                                                    type="button"
                                                    class="zeith-action-btn suspend"
                                                    title="Suspend staff"
                                                    onclick="openStatusModal(
                                                    <?= $id ?>,
                                                    '<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>',
                                                    'suspend'
                                                )">
                                                    <svg viewBox="0 0 24 24">
                                                        <rect x="3" y="3" width="18" height="18" rx="4"></rect>
                                                        <path d="M9 9v6"></path>
                                                        <path d="M15 9v6"></path>
                                                    </svg>
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>

                <div class="zeith-no-results" id="zeithNoResults">
                    <div class="zeith-no-results-icon">
                        <svg viewBox="0 0 24 24">
                            <circle cx="11" cy="11" r="7"></circle>
                            <path d="m20 20-4-4"></path>
                        </svg>
                    </div>
                    <strong>No staff found</strong>
                    <span>Try changing your search or filters.</span>
                </div>
            </div>
        </section>
    </main>

    <!-- ROLE MODAL FORM -->
    <div class="zeith-modal" id="zeithRoleModal" aria-hidden="true" style="display: none;">
        <div class="zeith-modal-overlay" onclick="closeRoleModal()"></div>

        <div class="zeith-modal-box">
            <button type="button" class="zeith-modal-close" onclick="closeRoleModal()" aria-label="Close">
                <svg viewBox="0 0 24 24">
                    <path d="M6 6l12 12"></path>
                    <path d="M18 6L6 18"></path>
                </svg>
            </button>

            <div class="zeith-modal-icon role-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"></path>
                    <path d="M19.4 15a1.7 1.7 0 0 0 .34 1.88l.06.06-1.7 1.7-.06-.06a1.7 1.7 0 0 0-1.88-.34 1.7 1.7 0 0 0-1.03 1.55V20h-2.4v-.21a1.7 1.7 0 0 0-1.03-1.55 1.7 1.7 0 0 0-1.88.34l-.06.06-1.7-1.7.06-.06A1.7 1.7 0 0 0 8.46 15a1.7 1.7 0 0 0-1.55-1.03H6v-2.4h.91A1.7 1.7 0 0 0 8.46 10a1.7 1.7 0 0 0-.34-1.88l-.06-.06 1.7-1.7.06.06a1.7 1.7 0 0 0 1.88.34 1.7 1.7 0 0 0 1.03-1.55V5h2.4v.21a1.7 1.7 0 0 0 1.03 1.55 1.7 1.7 0 0 0 1.88-.34l.06-.06 1.7-1.7.06-.06A1.7 1.7 0 0 0 19.4 10c.16.62.71 1.03 1.35 1.03H21v2.4h-.25c-.64 0-1.19.41-1.35 1.03z"></path>
                </svg>
            </div>

            <h3>Change Staff Role</h3>

            <p>
                Change the access level for
                <strong id="zeithRoleStaffName">Staff Member</strong>.
            </p>

            <form id="zeithRoleForm" method="POST">
                <div class="zeith-role-options">
                    <label class="zeith-role-option">
                        <input type="radio" name="role" value="admin" id="roleAdmin">
                        <span class="zeith-role-option-content">
                            <strong>Admin</strong>
                            <small>Full control of the ZEITH platform.</small>
                        </span>
                    </label>

                    <label class="zeith-role-option">
                        <input type="radio" name="role" value="staff" id="roleStaff">
                        <span class="zeith-role-option-content">
                            <strong>Staff</strong>
                            <small>Operational and moderation access.</small>
                        </span>
                    </label>
                </div>

                <div class="zeith-modal-actions">
                    <button type="button" class="zeith-modal-cancel" onclick="closeRoleModal()">
                        Cancel
                    </button>

                    <button type="submit" class="zeith-modal-confirm">
                        Update Role
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- STATUS / SUSPEND MODAL FORM -->
    <div class="zeith-modal" id="zeithStatusModal" aria-hidden="true" style="display: none;">
        <div class="zeith-modal-overlay" onclick="closeStatusModal()"></div>

        <div class="zeith-modal-box">
            <button type="button" class="zeith-modal-close" onclick="closeStatusModal()" aria-label="Close">
                <svg viewBox="0 0 24 24">
                    <path d="M6 6l12 12"></path>
                    <path d="M18 6L6 18"></path>
                </svg>
            </button>

            <div class="zeith-modal-icon" id="zeithStatusModalIcon">
                <svg viewBox="0 0 24 24">
                    <rect x="3" y="3" width="18" height="18" rx="4"></rect>
                    <path d="M9 9v6"></path>
                    <path d="M15 9v6"></path>
                </svg>
            </div>

            <h3 id="zeithStatusModalTitle">Suspend Staff</h3>

            <p id="zeithStatusModalText">
                Are you sure you want to suspend this staff member?
            </p>

            <form id="zeithStatusForm" method="POST">
                <input type="hidden" name="status" id="zeithModalStatusInput">
                <div class="zeith-modal-actions">
                    <button type="button" class="zeith-modal-cancel" onclick="closeStatusModal()">
                        Cancel
                    </button>

                    <button
                        type="submit"
                        class="zeith-modal-danger"
                        id="zeithStatusConfirm">
                        Suspend Staff
                    </button>
                </div>
            </form>
        </div>
    </div>



    <!-- =====================================================
     INTERNAL CSS
====================================================== -->

    <style>
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

        body {
            font-family:
                Inter,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                Arial,
                sans-serif;

            background: #F1F5F9;
            color: #0F172A;
        }


        /* =====================================================
   PAGE
===================================================== */

        .zeith-staff-page {

            width: calc(100% - 250px);

            margin-left: 250px;

            min-height: 100vh;

            padding: 32px;

            background: #F1F5F9;

        }


        /* =====================================================
   HEADER
===================================================== */

        .zeith-staff-header {

            display: flex;

            align-items: flex-start;

            justify-content: space-between;

            gap: 20px;

            margin-bottom: 28px;

        }


        .zeith-page-eyebrow {

            display: block;

            margin-bottom: 6px;

            color: #F68B1E;

            font-size: 10px;

            font-weight: 800;

            letter-spacing: 1.5px;

        }


        .zeith-staff-header h1 {

            margin: 0;

            color: #0F172A;

            font-size: 29px;

            line-height: 1.2;

            font-weight: 800;

            letter-spacing: -.7px;

        }


        .zeith-staff-header p {

            margin: 7px 0 0;

            color: #64748B;

            font-size: 13px;

        }


        .zeith-header-badge {

            display: inline-flex;

            align-items: center;

            gap: 8px;

            padding: 9px 13px;

            border: 1px solid #E2E8F0;

            border-radius: 8px;

            background: #FFFFFF;

            color: #475569;

            font-size: 12px;

            font-weight: 700;

            box-shadow:
                0 2px 7px rgba(15, 23, 42, .03);

        }


        .zeith-header-badge svg {

            width: 16px;
            height: 16px;

            fill: none;

            stroke: #F68B1E;

            stroke-width: 1.7;

            stroke-linecap: round;

            stroke-linejoin: round;

        }


        /* =====================================================
   SUMMARY
===================================================== */

        .zeith-staff-summary {

            display: grid;

            grid-template-columns:
                repeat(4, minmax(0, 1fr));

            gap: 16px;

            margin-bottom: 22px;

        }


        .zeith-summary-card {

            min-height: 92px;

            display: flex;

            align-items: center;

            gap: 14px;

            padding: 18px;

            background: #FFFFFF;

            border: 1px solid #E2E8F0;

            border-radius: 10px;

            box-shadow:
                0 2px 8px rgba(15, 23, 42, .025);

        }


        .zeith-summary-icon {

            width: 42px;

            height: 42px;

            flex: 0 0 42px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 9px;

        }


        .zeith-summary-icon svg {

            width: 19px;
            height: 19px;

            fill: none;

            stroke: currentColor;

            stroke-width: 1.8;

            stroke-linecap: round;

            stroke-linejoin: round;

        }


        .zeith-summary-icon.total {

            color: #F68B1E;

            background: #FFF4E8;

        }


        .zeith-summary-icon.active {

            color: #059669;

            background: #ECFDF5;

        }


        .zeith-summary-icon.suspended {

            color: #DC2626;

            background: #FEF2F2;

        }


        .zeith-summary-icon.admin {

            color: #7C3AED;

            background: #F5F3FF;

        }


        .zeith-summary-label {

            display: block;

            margin-bottom: 4px;

            color: #64748B;

            font-size: 11px;

            font-weight: 600;

        }


        .zeith-summary-card strong {

            display: block;

            color: #0F172A;

            font-size: 22px;

            line-height: 1;

        }


        /* =====================================================
   MAIN CARD
===================================================== */

        .zeith-staff-card {

            overflow: hidden;

            background: #FFFFFF;

            border: 1px solid #E2E8F0;

            border-radius: 12px;

            box-shadow:
                0 3px 12px rgba(15, 23, 42, .035);

        }


        /* =====================================================
   CARD HEADER
===================================================== */

        .zeith-staff-card-header {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 20px;

            padding: 21px 22px;

            border-bottom: 1px solid #E2E8F0;

        }


        .zeith-staff-card-header h2 {

            margin: 0;

            color: #0F172A;

            font-size: 17px;

            font-weight: 800;

        }


        .zeith-staff-card-header p {

            margin: 5px 0 0;

            color: #64748B;

            font-size: 12px;

        }


        .zeith-staff-count {

            color: #64748B;

            font-size: 12px;

        }


        .zeith-staff-count strong {

            color: #0F172A;

        }


        /* =====================================================
   TOOLBAR
===================================================== */

        .zeith-staff-toolbar {

            display: flex;

            align-items: center;

            gap: 10px;

            padding: 15px 22px;

            background: #FAFBFC;

            border-bottom: 1px solid #E2E8F0;

        }


        .zeith-search-box {

            position: relative;

            flex: 1;

            max-width: 420px;

        }


        .zeith-search-box svg {

            position: absolute;

            left: 13px;

            top: 50%;

            width: 16px;
            height: 16px;

            transform: translateY(-50%);

            fill: none;

            stroke: #94A3B8;

            stroke-width: 1.7;

            stroke-linecap: round;

        }


        .zeith-search-box input {

            width: 100%;

            height: 38px;

            padding:
                0 13px 0 38px;

            border: 1px solid #E2E8F0;

            border-radius: 7px;

            outline: none;

            background: #FFFFFF;

            color: #0F172A;

            font-family: inherit;

            font-size: 12px;

            transition: .2s ease;

        }


        .zeith-search-box input:focus {

            border-color: #F68B1E;

            box-shadow:
                0 0 0 3px rgba(246, 139, 30, .08);

        }


        .zeith-filter-select {

            height: 38px;

            min-width: 125px;

            padding: 0 12px;

            border: 1px solid #E2E8F0;

            border-radius: 7px;

            outline: none;

            background: #FFFFFF;

            color: #475569;

            font-family: inherit;

            font-size: 12px;

            cursor: pointer;

        }


        /* =====================================================
   TABLE
===================================================== */

        .zeith-table-wrapper {

            width: 100%;

            overflow-x: auto;

        }


        .zeith-staff-table {

            width: 100%;

            min-width: 900px;

            border-collapse: collapse;

        }


        .zeith-staff-table th {

            padding: 14px 20px;

            background: #F8FAFC;

            color: #64748B;

            border-bottom: 1px solid #E2E8F0;

            font-size: 10px;

            font-weight: 800;

            letter-spacing: .65px;

            text-align: left;

            white-space: nowrap;

        }


        .zeith-staff-table td {

            padding: 17px 20px;

            border-bottom: 1px solid #EEF2F6;

            vertical-align: middle;

        }


        .zeith-staff-table tbody tr {

            transition: background .18s ease;

        }


        .zeith-staff-table tbody tr:hover {

            background: #FFFBF7;

        }


        .zeith-staff-table tbody tr:last-child td {

            border-bottom: 0;

        }


        /* =====================================================
   STAFF INFO
===================================================== */

        .zeith-staff-info {

            display: flex;

            align-items: center;

            gap: 12px;

            min-width: 210px;

        }


        .zeith-avatar {

            width: 42px;

            height: 42px;

            flex: 0 0 42px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 50%;

            background: #FFF3E5;

            color: #C96F0C;

            font-size: 14px;

            font-weight: 800;

        }


        .zeith-staff-name {

            display: flex;

            flex-direction: column;

            gap: 3px;

        }


        .zeith-staff-name strong {

            color: #0F172A;

            font-size: 13px;

            font-weight: 750;

        }


        .zeith-staff-name span {

            color: #94A3B8;

            font-size: 10px;

        }


        .zeith-staff-name small {

            color: #CBD5E1;

            font-size: 9px;

        }


        /* =====================================================
   ROLE BADGE
===================================================== */

        .zeith-role-badge {

            display: inline-flex;

            align-items: center;

            gap: 6px;

            padding: 6px 9px;

            border-radius: 6px;

            font-size: 10px;

            font-weight: 800;

        }


        .zeith-role-badge svg {

            width: 13px;
            height: 13px;

            fill: none;

            stroke: currentColor;

            stroke-width: 1.7;

            stroke-linecap: round;

            stroke-linejoin: round;

        }


        .zeith-role-badge.admin {

            background: #FFF4E8;

            color: #C96F0C;

        }


        .zeith-role-badge.staff {

            background: #EFF6FF;

            color: #2563EB;

        }


        /* =====================================================
   CONTACT
===================================================== */

        .zeith-contact-details {

            display: flex;

            flex-direction: column;

            gap: 7px;

        }


        .zeith-contact-details div {

            display: flex;

            align-items: center;

            gap: 7px;

            color: #475569;

            font-size: 11px;

        }


        .zeith-contact-details svg {

            width: 14px;
            height: 14px;

            flex: 0 0 14px;

            fill: none;

            stroke: #94A3B8;

            stroke-width: 1.6;

            stroke-linecap: round;

            stroke-linejoin: round;

        }


        /* =====================================================
   STATUS
===================================================== */

        .zeith-status-badge {

            display: inline-flex;

            align-items: center;

            gap: 7px;

            padding: 6px 9px;

            border-radius: 6px;

            font-size: 10px;

            font-weight: 800;

        }


        .zeith-status-dot {

            width: 6px;

            height: 6px;

            border-radius: 50%;

        }


        .zeith-status-badge.active {

            color: #047857;

            background: #ECFDF5;

        }


        .zeith-status-badge.active .zeith-status-dot {

            background: #10B981;

        }


        .zeith-status-badge.suspended {

            color: #B91C1C;

            background: #FEF2F2;

        }


        .zeith-status-badge.suspended .zeith-status-dot {

            background: #EF4444;

        }


        /* =====================================================
   ACTIONS
===================================================== */

        .zeith-staff-actions {

            display: flex;

            align-items: center;

            gap: 7px;

        }


        .zeith-action-btn {

            width: 34px;

            height: 34px;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            border: 1px solid #E2E8F0;

            border-radius: 7px;

            background: #FFFFFF;

            cursor: pointer;

            transition:
                background .2s ease,
                border-color .2s ease,
                transform .2s ease;

        }


        .zeith-action-btn:hover {

            transform: translateY(-1px);

        }


        .zeith-action-btn svg {

            width: 15px;
            height: 15px;

            fill: none;

            stroke: currentColor;

            stroke-width: 1.7;

            stroke-linecap: round;

            stroke-linejoin: round;

        }


        .zeith-action-btn.role {

            color: #F68B1E;

        }


        .zeith-action-btn.role:hover {

            background: #FFF4E8;

            border-color: #F8C58F;

        }


        .zeith-action-btn.suspend {

            color: #DC2626;

        }


        .zeith-action-btn.suspend:hover {

            background: #FEF2F2;

            border-color: #FECACA;

        }


        .zeith-action-btn.activate {

            color: #059669;

        }


        .zeith-action-btn.activate:hover {

            background: #ECFDF5;

            border-color: #A7F3D0;

        }


        /* =====================================================
   NO RESULTS
===================================================== */

        .zeith-no-results {

            display: none;

            flex-direction: column;

            align-items: center;

            justify-content: center;

            gap: 5px;

            padding: 60px 20px;

            text-align: center;

        }


        .zeith-no-results-icon {

            width: 42px;

            height: 42px;

            display: flex;

            align-items: center;

            justify-content: center;

            margin-bottom: 7px;

            border-radius: 50%;

            background: #F8FAFC;

            color: #94A3B8;

        }


        .zeith-no-results-icon svg {

            width: 18px;
            height: 18px;

            fill: none;

            stroke: currentColor;

            stroke-width: 1.7;

            stroke-linecap: round;

        }


        .zeith-no-results strong {

            color: #334155;

            font-size: 13px;

        }


        .zeith-no-results span {

            color: #94A3B8;

            font-size: 11px;

        }


        /* =====================================================
   MODAL
===================================================== */

        .zeith-modal {

            position: fixed;

            inset: 0;

            z-index: 9999;

            display: none;

            align-items: center;

            justify-content: center;

            padding: 20px;

        }


        .zeith-modal.is-open {

            display: flex;

        }


        .zeith-modal-overlay {

            position: absolute;

            inset: 0;

            background: rgba(15, 23, 42, .48);

            backdrop-filter: blur(3px);

        }


        .zeith-modal-box {

            position: relative;

            z-index: 2;

            width: 100%;

            max-width: 440px;

            padding: 28px;

            border: 1px solid #E2E8F0;

            border-radius: 13px;

            background: #FFFFFF;

            box-shadow:
                0 25px 70px rgba(15, 23, 42, .18);

            animation:
                zeithModalIn .2s ease;

        }


        @keyframes zeithModalIn {

            from {

                opacity: 0;

                transform: translateY(8px) scale(.98);

            }

            to {

                opacity: 1;

                transform: translateY(0) scale(1);

            }

        }


        .zeith-modal-close {

            position: absolute;

            top: 14px;

            right: 14px;

            width: 32px;

            height: 32px;

            display: flex;

            align-items: center;

            justify-content: center;

            border: 0;

            border-radius: 6px;

            background: transparent;

            color: #94A3B8;

            cursor: pointer;

        }


        .zeith-modal-close:hover {

            background: #F8FAFC;

            color: #334155;

        }


        .zeith-modal-close svg {

            width: 16px;
            height: 16px;

            fill: none;

            stroke: currentColor;

            stroke-width: 1.8;

            stroke-linecap: round;

        }


        .zeith-modal-icon {

            width: 44px;

            height: 44px;

            display: flex;

            align-items: center;

            justify-content: center;

            margin-bottom: 17px;

            border-radius: 10px;

            color: #DC2626;

            background: #FEF2F2;

        }


        .zeith-modal-icon.role-icon {

            color: #F68B1E;

            background: #FFF4E8;

        }


        .zeith-modal-icon svg {

            width: 20px;
            height: 20px;

            fill: none;

            stroke: currentColor;

            stroke-width: 1.7;

            stroke-linecap: round;

            stroke-linejoin: round;

        }


        .zeith-modal-box h3 {

            margin: 0 0 8px;

            color: #0F172A;

            font-size: 18px;

            font-weight: 800;

        }


        .zeith-modal-box>p {

            margin: 0;

            color: #64748B;

            font-size: 13px;

            line-height: 1.6;

        }


        .zeith-modal-box>p strong {

            color: #0F172A;

        }


        /* =====================================================
   ROLE OPTIONS
===================================================== */

        .zeith-role-options {

            display: flex;

            flex-direction: column;

            gap: 9px;

            margin-top: 20px;

        }


        .zeith-role-option {

            position: relative;

            display: flex;

            align-items: center;

            gap: 11px;

            padding: 13px;

            border: 1px solid #E2E8F0;

            border-radius: 8px;

            cursor: pointer;

            transition: .2s ease;

        }


        .zeith-role-option:hover {

            border-color: #F8C58F;

            background: #FFFBF7;

        }


        .zeith-role-option:has(input:checked) {

            border-color: #F68B1E;

            background: #FFF9F2;

        }


        .zeith-role-option input {

            width: 16px;

            height: 16px;

            accent-color: #F68B1E;

        }


        .zeith-role-option-content {

            display: flex;

            flex-direction: column;

            gap: 3px;

        }


        .zeith-role-option-content strong {

            color: #0F172A;

            font-size: 12px;

        }


        .zeith-role-option-content small {

            color: #64748B;

            font-size: 10px;

        }


        /* =====================================================
   MODAL ACTIONS
===================================================== */

        .zeith-modal-actions {

            display: flex;

            justify-content: flex-end;

            gap: 9px;

            margin-top: 24px;

        }


        .zeith-modal-cancel,
        .zeith-modal-confirm,
        .zeith-modal-danger {

            height: 38px;

            padding: 0 15px;

            border-radius: 7px;

            font-family: inherit;

            font-size: 11px;

            font-weight: 750;

            cursor: pointer;

            transition: .2s ease;

        }


        .zeith-modal-cancel {

            border: 1px solid #E2E8F0;

            background: #FFFFFF;

            color: #475569;

        }


        .zeith-modal-cancel:hover {

            background: #F8FAFC;

        }


        .zeith-modal-confirm {

            border: 1px solid #F68B1E;

            background: #F68B1E;

            color: #FFFFFF;

        }


        .zeith-modal-confirm:hover {

            background: #E97D10;

        }


        .zeith-modal-danger {

            border: 1px solid #DC2626;

            background: #DC2626;

            color: #FFFFFF;

        }


        .zeith-modal-danger:hover {

            background: #B91C1C;

        }


        /* =====================================================
   RESPONSIVE
===================================================== */

        @media (max-width: 1100px) {

            .zeith-staff-summary {

                grid-template-columns:
                    repeat(2, minmax(0, 1fr));

            }

        }


        @media (max-width: 1024px) {

            .zeith-staff-page {

                width: 100%;

                margin-left: 0;

                padding: 28px 22px;

            }

        }


        @media (max-width: 700px) {

            .zeith-staff-page {

                padding: 22px 16px;

            }


            .zeith-staff-header {

                flex-direction: column;

            }


            .zeith-staff-header h1 {

                font-size: 25px;

            }


            .zeith-staff-summary {

                grid-template-columns: 1fr;

            }


            .zeith-staff-card-header {

                align-items: flex-start;

                flex-direction: column;

            }


            .zeith-staff-toolbar {

                align-items: stretch;

                flex-direction: column;

            }


            .zeith-search-box {

                max-width: none;

            }


            .zeith-filter-select {

                width: 100%;

            }

        }


        @media (max-width: 480px) {

            .zeith-modal-box {

                padding: 23px 19px;

            }


            .zeith-modal-actions {

                flex-direction: column-reverse;

            }


            .zeith-modal-cancel,
            .zeith-modal-confirm,
            .zeith-modal-danger {

                width: 100%;

            }

        }
    </style>



    <!-- =====================================================
     JAVASCRIPT
====================================================== -->

    <script>
        function openRoleModal(id, name, currentRole) {
            document.getElementById('zeithRoleStaffName').innerText = name;

            if (currentRole.toLowerCase() === 'admin') {
                document.getElementById('roleAdmin').checked = true;
            } else {
                document.getElementById('roleStaff').checked = true;
            }

            document.getElementById('zeithRoleForm').action = '/Zeith/admin/users/role/' + id;
            document.getElementById('zeithRoleModal').style.display = 'flex';
            document.getElementById('zeithRoleModal').setAttribute('aria-hidden', 'false');
        }

        function closeRoleModal() {
            document.getElementById('zeithRoleModal').style.display = 'none';
            document.getElementById('zeithRoleModal').setAttribute('aria-hidden', 'true');
        }

        function openStatusModal(id, name, actionType) {
            const titleEl = document.getElementById('zeithStatusModalTitle');
            const textEl = document.getElementById('zeithStatusModalText');
            const confirmBtn = document.getElementById('zeithStatusConfirm');
            const statusInput = document.getElementById('zeithModalStatusInput');

            if (actionType === 'suspend') {
                titleEl.innerText = 'Suspend Staff';
                textEl.innerText = `Are you sure you want to suspend ${name}? They will be immediately blocked from logging in.`;
                confirmBtn.innerText = 'Suspend Staff';
                confirmBtn.className = 'zeith-modal-danger';
                statusInput.value = 'suspended';
            } else {
                titleEl.innerText = 'Activate Staff';
                textEl.innerText = `Are you sure you want to activate ${name}? Their login access will be restored.`;
                confirmBtn.innerText = 'Activate Staff';
                confirmBtn.className = 'zeith-modal-confirm';
                statusInput.value = 'active';
            }

            document.getElementById('zeithStatusForm').action = '/Zeith/admin/users/status/' + id;
            document.getElementById('zeithStatusModal').style.display = 'flex';
            document.getElementById('zeithStatusModal').setAttribute('aria-hidden', 'false');
        }

        function closeStatusModal() {
            document.getElementById('zeithStatusModal').style.display = 'none';
            document.getElementById('zeithStatusModal').setAttribute('aria-hidden', 'true');
        }

        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.getElementById("zeithStaffSearch");
            const roleFilter = document.getElementById("zeithRoleFilter");
            const statusFilter = document.getElementById("zeithStatusFilter");
            const tableBody = document.getElementById("zeithStaffTableBody");
            const noResults = document.getElementById("zeithNoResults");

            if (!searchInput || !roleFilter || !statusFilter || !tableBody) {
                return;
            }

            const staffRows = Array.from(
                tableBody.querySelectorAll(".zeith-staff-row")
            );

            function filterStaff() {
                const searchTerm = searchInput.value.trim().toLowerCase();
                const selectedRole = roleFilter.value.toLowerCase();
                const selectedStatus = statusFilter.value.toLowerCase();

                let visibleCount = 0;

                staffRows.forEach(function(row) {
                    const name = (row.dataset.name || "").toLowerCase();
                    const email = (row.dataset.email || "").toLowerCase();
                    const role = (row.dataset.role || "").toLowerCase();
                    const status = (row.dataset.status || "").toLowerCase();

                    const rowText = row.textContent.toLowerCase();

                    const matchesSearch =
                        name.includes(searchTerm) ||
                        email.includes(searchTerm) ||
                        rowText.includes(searchTerm);

                    const matchesRole =
                        selectedRole === "all" || role === selectedRole;

                    const matchesStatus =
                        selectedStatus === "all" || status === selectedStatus;

                    const shouldShow =
                        matchesSearch && matchesRole && matchesStatus;

                    row.style.display = shouldShow ? "" : "none";

                    if (shouldShow) {
                        visibleCount++;
                    }
                });

                if (noResults) {
                    noResults.style.display =
                        staffRows.length > 0 && visibleCount === 0 ? "flex" : "none";
                }
            }

            searchInput.addEventListener("input", filterStaff);
            roleFilter.addEventListener("change", filterStaff);
            statusFilter.addEventListener("change", filterStaff);

            filterStaff();
        });
    </script>



</body>

</html>