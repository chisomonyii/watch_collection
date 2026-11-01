<?php
// Temporary debug check at the top of views/admin/payment.php
// echo "<!-- DEBUG: admin/payment.php view loaded successfully -->";
?>

<style>
    .zeith-payment-page {
        width: calc(100% - 250px);
        margin-left: 250px;
        min-height: 100vh;
        padding: 32px;
        background: #F1F5F9;
        color: #0F172A;
        font-family: "Inter", "Segoe UI", Arial, sans-serif;
        box-sizing: border-box;
    }

    .zeith-payment-page *,
    .zeith-payment-page *::before,
    .zeith-payment-page *::after {
        box-sizing: border-box;
    }

    .zeith-payment-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 24px;
        margin-bottom: 28px;
    }

    .zeith-payment-heading {
        min-width: 0;
    }

    .zeith-payment-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 8px;
        color: #F68B1E;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1.5px;
        text-transform: uppercase;
    }

    .zeith-payment-eyebrow::before {
        content: "";
        width: 24px;
        height: 2px;
        background: #F68B1E;
        border-radius: 2px;
    }

    .zeith-payment-heading h1 {
        margin: 0;
        color: #0F172A;
        font-size: 28px;
        line-height: 1.25;
        font-weight: 750;
        letter-spacing: -0.5px;
    }

    .zeith-payment-heading p {
        margin: 8px 0 0;
        color: #64748B;
        font-size: 14px;
        line-height: 1.6;
    }

    .zeith-payment-back {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        flex-shrink: 0;
        min-height: 42px;
        padding: 0 17px;
        background: #FFFFFF;
        color: #0F172A;
        border: 1px solid #E2E8F0;
        border-radius: 8px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 650;
        transition: all 0.2s ease;
        box-shadow: 0 1px 2px rgba(15, 23, 42, 0.04);
    }

    .zeith-payment-back:hover {
        border-color: #CBD5E1;
        background: #F8FAFC;
        transform: translateY(-1px);
    }

    .zeith-payment-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 14px rgba(15, 23, 42, 0.04);
    }

    .zeith-payment-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        padding: 20px 22px;
        border-bottom: 1px solid #E2E8F0;
        background: #FFFFFF;
    }

    .zeith-payment-card-title {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .zeith-payment-card-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        border-radius: 9px;
        background: #FFF4E8;
        color: #F68B1E;
        font-size: 18px;
    }

    .zeith-payment-card-title h2 {
        margin: 0;
        color: #0F172A;
        font-size: 15px;
        font-weight: 700;
    }

    .zeith-payment-card-title span {
        display: block;
        margin-top: 3px;
        color: #64748B;
        font-size: 12px;
    }

    .zeith-payment-table-wrap {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .zeith-payment-table {
        width: 100%;
        min-width: 980px;
        border-collapse: collapse;
        text-align: left;
        font-size: 13px;
    }

    .zeith-payment-table thead {
        background: #F8FAFC;
    }

    .zeith-payment-table th {
        padding: 14px 18px;
        color: #64748B;
        border-bottom: 1px solid #E2E8F0;
        font-size: 11px;
        font-weight: 750;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .zeith-payment-table th:last-child {
        text-align: center;
    }

    .zeith-payment-table td {
        padding: 17px 18px;
        color: #334155;
        border-bottom: 1px solid #E2E8F0;
        vertical-align: middle;
    }

    .zeith-payment-table tbody tr {
        transition: background 0.2s ease;
    }

    .zeith-payment-table tbody tr:hover {
        background: #F8FAFC;
    }

    .zeith-payment-table tbody tr:last-child td {
        border-bottom: none;
    }

    .zeith-payment-order-id {
        color: #0F172A;
        font-size: 13px;
        font-weight: 700;
    }

    .zeith-payment-order-number {
        display: inline-block;
        margin-top: 5px;
        color: #F68B1E;
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 0.2px;
    }

    .zeith-payment-customer-name {
        color: #0F172A;
        font-size: 13px;
        font-weight: 650;
    }

    .zeith-payment-customer-email {
        display: block;
        margin-top: 4px;
        color: #64748B;
        font-size: 11px;
    }

    .zeith-payment-amount {
        color: #059669;
        font-size: 14px;
        font-weight: 750;
        white-space: nowrap;
    }

    .zeith-payment-reference {
        display: inline-block;
        max-width: 180px;
        padding: 6px 8px;
        background: #F8FAFC;
        color: #475569;
        border: 1px solid #E2E8F0;
        border-radius: 6px;
        font-family: "SFMono-Regular", Consolas, "Liberation Mono", monospace;
        font-size: 11px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .zeith-payment-status-form {
        display: flex;
        align-items: center;
        gap: 7px;
        min-width: 245px;
    }

    .zeith-payment-status-form select {
        min-height: 36px;
        flex: 1;
        padding: 0 30px 0 10px;
        background: #FFFFFF;
        color: #334155;
        border: 1px solid #CBD5E1;
        border-radius: 7px;
        outline: none;
        font-family: inherit;
        font-size: 12px;
        cursor: pointer;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .zeith-payment-status-form select:focus {
        border-color: #2563EB;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .zeith-payment-save {
        min-height: 36px;
        padding: 0 12px;
        border: none;
        border-radius: 7px;
        background: #2563EB;
        color: #FFFFFF;
        font-family: inherit;
        font-size: 11px;
        font-weight: 700;
        cursor: pointer;
        transition: background 0.2s ease, transform 0.2s ease;
    }

    .zeith-payment-save:hover {
        background: #1D4ED8;
        transform: translateY(-1px);
    }

    .zeith-payment-receipt-btn {
        min-height: 36px;
        padding: 0 13px;
        border: 1px solid #CBD5E1;
        border-radius: 7px;
        background: #FFFFFF;
        color: #334155;
        font-family: inherit;
        font-size: 11px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .zeith-payment-receipt-btn:hover {
        background: #FFF4E8;
        color: #F68B1E;
        border-color: #F68B1E;
    }

    .zeith-payment-no-receipt {
        color: #94A3B8;
        font-size: 12px;
    }

    .zeith-payment-empty {
        padding: 60px 25px !important;
        text-align: center;
        color: #64748B !important;
    }

    .zeith-payment-empty-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 52px;
        height: 52px;
        margin: 0 auto 14px;
        border-radius: 50%;
        background: #F1F5F9;
        color: #94A3B8;
        font-size: 21px;
    }

    .zeith-payment-empty strong {
        display: block;
        margin-bottom: 5px;
        color: #334155;
        font-size: 14px;
    }

    .zeith-payment-empty span {
        font-size: 12px;
    }

    .zeith-payment-modal {
        display: none;
        position: fixed;
        inset: 0;
        z-index: 3000;
        align-items: center;
        justify-content: center;
        padding: 20px;
        background: rgba(15, 23, 42, 0.65);
        backdrop-filter: blur(4px);
    }

    .zeith-payment-modal-content {
        width: 520px;
        max-width: 100%;
        max-height: 90vh;
        overflow: hidden;
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        box-shadow: 0 24px 60px rgba(15, 23, 42, 0.2);
        animation: zeithPaymentModalIn 0.2s ease;
    }

    @keyframes zeithPaymentModalIn {
        from {
            opacity: 0;
            transform: translateY(10px) scale(0.98);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .zeith-payment-modal-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 18px 20px;
        border-bottom: 1px solid #E2E8F0;
    }

    .zeith-payment-modal-header h3 {
        margin: 0;
        color: #0F172A;
        font-size: 17px;
        font-weight: 750;
    }

    .zeith-payment-modal-close {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        padding: 0;
        border: none;
        border-radius: 7px;
        background: #F1F5F9;
        color: #64748B;
        font-size: 21px;
        line-height: 1;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .zeith-payment-modal-close:hover {
        background: #FEE2E2;
        color: #EF4444;
    }

    .zeith-payment-receipt-preview {
        margin: 20px;
        padding: 12px;
        max-height: 450px;
        overflow: auto;
        text-align: center;
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 10px;
    }

    .zeith-payment-receipt-preview img {
        display: block;
        max-width: 100%;
        height: auto;
        margin: 0 auto;
        border-radius: 7px;
    }

    .zeith-payment-modal-footer {
        display: flex;
        justify-content: flex-end;
        padding: 0 20px 20px;
    }

    .zeith-payment-close-btn {
        min-height: 38px;
        padding: 0 16px;
        border: none;
        border-radius: 7px;
        background: #475569;
        color: #FFFFFF;
        font-family: inherit;
        font-size: 12px;
        font-weight: 650;
        cursor: pointer;
        transition: background 0.2s ease;
    }

    .zeith-payment-close-btn:hover {
        background: #334155;
    }

    @media (max-width: 1200px) {
        .zeith-payment-page {
            padding: 28px 24px;
        }

        .zeith-payment-table {
            min-width: 920px;
        }
    }

    @media (max-width: 1024px) {
        .zeith-payment-page {
            width: 100%;
            margin-left: 0;
            padding: 28px 22px;
        }
    }

    @media (max-width: 768px) {
        .zeith-payment-page {
            padding: 22px 16px;
        }

        .zeith-payment-header {
            flex-direction: column;
            align-items: stretch;
            margin-bottom: 22px;
        }

        .zeith-payment-heading h1 {
            font-size: 23px;
        }

        .zeith-payment-back {
            align-self: flex-start;
        }

        .zeith-payment-card-header {
            padding: 16px;
        }

        .zeith-payment-table th,
        .zeith-payment-table td {
            padding: 14px;
        }

        .zeith-payment-modal {
            padding: 14px;
        }

        .zeith-payment-receipt-preview {
            margin: 15px;
            max-height: 55vh;
        }

        .zeith-payment-modal-footer {
            padding: 0 15px 15px;
        }
    }

    @media (max-width: 480px) {
        .zeith-payment-page {
            padding: 18px 12px;
        }

        .zeith-payment-heading h1 {
            font-size: 21px;
        }

        .zeith-payment-heading p {
            font-size: 13px;
        }

        .zeith-payment-card-title span {
            display: none;
        }

        .zeith-payment-card-icon {
            width: 34px;
            height: 34px;
        }
    }

    .zeith-payment-card-header {
        display: block;
        padding: 20px 22px;
        border-bottom: 1px solid #E2E8F0;
        background: #FFFFFF;
    }

    .zeith-payment-card-title {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .zeith-payment-search {
        position: relative;
        width: 100%;
        max-width: 520px;
        margin-top: 18px;
    }

    .zeith-payment-search-icon {
        position: absolute;
        top: 50%;
        left: 14px;
        transform: translateY(-50%);
        color: #64748B;
        font-size: 20px;
        line-height: 1;
        pointer-events: none;
    }

    .zeith-payment-search input {
        width: 100%;
        height: 42px;
        padding: 0 14px 0 42px;
        background: #F8FAFC;
        color: #0F172A;
        border: 1px solid #E2E8F0;
        border-radius: 8px;
        outline: none;
        font-family: inherit;
        font-size: 13px;
        transition: all 0.2s ease;
    }

    .zeith-payment-search input::placeholder {
        color: #94A3B8;
    }

    .zeith-payment-search input:focus {
        background: #FFFFFF;
        border-color: #2563EB;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }
</style>

    <?php
// views/Staff/order.php
\App\Helpers\View::displayComponent("admin/sidebar.php");
?>


<div class="zeith-payment-page">
    <header class="zeith-payment-header">
        <div class="zeith-payment-heading">
            <h1>Payment Management &amp; Verification</h1>
            <p>Monitor online transactions and verify order payment statuses.</p>
        </div>
    </header>
<section class="zeith-payment-card">
    <div class="zeith-payment-card-header">
        <div class="zeith-payment-card-title">
            <div class="zeith-payment-card-icon">₦</div>
            <div>
                <h2>Payment Records</h2>
                <span>Review gateway transactions and update payment statuses</span>
                <div class="zeith-payment-search">
                    <span class="zeith-payment-search-icon">⌕</span>
                    <input
                        type="search"
                        id="zeithPaymentSearch"
                        placeholder="Search order number, name..."
                        autocomplete="off">
                </div>
            </div>
        </div>
    </div>

    <div class="zeith-payment-table-wrap">
        <table class="zeith-payment-table">
            <thead>
                <tr>
                    <th>ID / Order #</th>
                    <th>Customer Name</th>
                    <th>Total Amount</th>
                    <th>Reference</th>
                    <th>Payment Status</th>
                    <th>Gateway Info</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($orders)): ?>
                    <?php foreach ($orders as $ord): ?>
                        <tr>
                            <td>
                                <strong class="zeith-payment-order-id">
                                    #<?= $ord['id'] ?>
                                </strong>
                                <span class="zeith-payment-order-number">
                                    <?= htmlspecialchars($ord['order_number'] ?? '') ?>
                                </span>
                            </td>

                            <td>
                                <strong class="zeith-payment-customer-name">
                                    <?= htmlspecialchars($ord['full_name'] ?? '') ?>
                                </strong>
                                <span class="zeith-payment-customer-email">
                                    <?= htmlspecialchars($ord['email'] ?? '') ?>
                                </span>
                            </td>

                            <td>
                                <span class="zeith-payment-amount">
                                    ₦<?= number_format((float)($ord['total_amount'] ?? 0), 0) ?>
                                </span>
                            </td>

                            <td>
                                <span class="zeith-payment-reference">
                                    <?= htmlspecialchars($ord['payment_reference'] ?? 'N/A') ?>
                                </span>
                            </td>

                            <td>
                                <form
                                    action="/Watch_Collection/admin/payments/update/<?= $ord['id'] ?>"
                                    method="POST"
                                    class="zeith-payment-status-form">
                                    <select name="payment_status">
                                        <option value="Pending" <?= strcasecmp($ord['payment_status'] ?? '', 'Pending') === 0 ? 'selected' : '' ?>>
                                            Pending
                                        </option>
                                        <option value="Paid" <?= strcasecmp($ord['payment_status'] ?? '', 'Paid') === 0 ? 'selected' : '' ?>>
                                            Paid / Verified
                                        </option>
                                        <option value="Failed" <?= strcasecmp($ord['payment_status'] ?? '', 'Failed') === 0 ? 'selected' : '' ?>>
                                            Failed
                                        </option>
                                    </select>

                                    <button type="submit" class="zeith-payment-save">
                                        Save
                                    </button>
                                </form>
                            </td>

                            <td>
                                <div style="text-align: center;">
                                    <span style="font-size: 12px; color: var(--text-muted, #666);">
                                        <?= !empty($ord['payment_reference']) ? 'Paystack Online' : 'Pending Gateway' ?>
                                    </span>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="zeith-payment-empty">
                            <div class="zeith-payment-empty-icon">₦</div>
                            <strong>No payment records found</strong>
                            <span>No orders or payment records are currently available.</span>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById("zeithPaymentSearch");
        const tableRows = document.querySelectorAll(".zeith-payment-table tbody tr");

        if (!searchInput) return;

        searchInput.addEventListener("input", function() {
            const searchValue = this.value.toLowerCase().trim();

            tableRows.forEach(function(row) {
                if (row.querySelector(".zeith-payment-empty")) return;

                const rowText = row.textContent.toLowerCase();
                row.style.display = rowText.includes(searchValue) ? "" : "none";
            });
        });
    });
</script>



