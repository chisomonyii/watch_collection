
<?php
$orders = $orders ?? [];
?>

<style>
.zeith-orders-page,
.zeith-orders-page * {
    box-sizing: border-box;
}

.zeith-orders-page {
    width: calc(100% - 250px);
    margin-left: 250px;
    min-height: 100vh;
    padding: 32px;
    background: #F1F5F9;
    color: #0F172A;
    font-family: 'Inter', 'Segoe UI', Arial, sans-serif;
}

.zeith-orders-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 24px;
    margin-bottom: 30px;
}

.zeith-orders-eyebrow {
    display: inline-block;
    margin-bottom: 9px;
    color: #F68B1E;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 1.5px;
    text-transform: uppercase;
}

.zeith-orders-heading h1 {
    margin: 0;
    color: #0F172A;
    font-size: 28px;
    font-weight: 750;
    letter-spacing: -0.8px;
}

.zeith-orders-heading p {
    margin: 8px 0 0;
    color: #64748B;
    font-size: 13px;
    line-height: 1.6;
}

.zeith-orders-back {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-height: 43px;
    padding: 0 17px;
    background: #FFFFFF;
    color: #334155;
    border: 1px solid #E2E8F0;
    border-radius: 9px;
    text-decoration: none;
    font-size: 13px;
    font-weight: 650;
    white-space: nowrap;
    transition: all 0.2s ease;
}

.zeith-orders-back:hover {
    background: #F8FAFC;
    border-color: #CBD5E1;
    color: #0F172A;
    transform: translateY(-1px);
}

.zeith-orders-back svg {
    width: 16px;
    height: 16px;
    fill: none;
    stroke: currentColor;
    stroke-width: 2;
}

.zeith-orders-card {
    overflow: hidden;
    background: #FFFFFF;
    border: 1px solid #E2E8F0;
    border-radius: 14px;
    box-shadow: 0 5px 20px rgba(15, 23, 42, 0.035);
}

.zeith-orders-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    padding: 23px 24px;
    border-bottom: 1px solid #E2E8F0;
}

.zeith-orders-card-title h2 {
    margin: 0;
    color: #0F172A;
    font-size: 16px;
    font-weight: 750;
}

.zeith-orders-card-title p {
    margin: 6px 0 0;
    color: #64748B;
    font-size: 12px;
}

.zeith-orders-total {
    padding: 9px 13px;
    background: #FFF7ED;
    border: 1px solid #FFEDD5;
    border-radius: 8px;
    color: #C2410C;
    font-size: 12px;
    white-space: nowrap;
}

.zeith-orders-total strong {
    font-size: 14px;
    font-weight: 800;
}

.zeith-orders-toolbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    padding: 18px 24px;
    background: #FFFFFF;
    border-bottom: 1px solid #E2E8F0;
}

.zeith-orders-search {
    position: relative;
    width: 100%;
    max-width: 480px;
}

.zeith-orders-search svg {
    position: absolute;
    top: 50%;
    left: 14px;
    width: 18px;
    height: 18px;
    transform: translateY(-50%);
    fill: none;
    stroke: #94A3B8;
    stroke-width: 2;
    pointer-events: none;
}

.zeith-orders-search input {
    width: 100%;
    height: 44px;
    padding: 0 115px 0 42px;
    background: #F8FAFC;
    border: 1px solid #E2E8F0;
    border-radius: 9px;
    outline: none;
    color: #0F172A;
    font-family: inherit;
    font-size: 13px;
    transition: all 0.2s ease;
}

.zeith-orders-search input::placeholder {
    color: #94A3B8;
}

.zeith-orders-search input:focus {
    background: #FFFFFF;
    border-color: #2563EB;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.09);
}

.zeith-orders-search-count {
    position: absolute;
    top: 50%;
    right: 13px;
    transform: translateY(-50%);
    color: #64748B;
    font-size: 11px;
    white-space: nowrap;
    pointer-events: none;
}

.zeith-orders-table-wrapper {
    width: 100%;
    overflow-x: auto;
}

.zeith-orders-table {
    width: 100%;
    min-width: 1250px;
    border-collapse: collapse;
    text-align: left;
    font-size: 13px;
}

.zeith-orders-table thead {
    background: #F8FAFC;
}

.zeith-orders-table th {
    padding: 15px 17px;
    color: #64748B;
    border-bottom: 1px solid #E2E8F0;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 0.7px;
    text-transform: uppercase;
    white-space: nowrap;
}

.zeith-orders-table td {
    padding: 17px;
    color: #334155;
    border-bottom: 1px solid #F1F5F9;
    vertical-align: middle;
    line-height: 1.6;
}

.zeith-orders-table tbody tr {
    transition: background 0.2s ease;
}

.zeith-orders-table tbody tr:hover {
    background: #F8FAFC;
}

.zeith-orders-table tbody tr:last-child td {
    border-bottom: none;
}

.zeith-order-id {
    color: #0F172A;
    font-size: 13px;
    font-weight: 800;
}

.zeith-order-number {
    display: inline-block;
    margin-top: 4px;
    color: #EA580C;
    font-size: 11px;
    font-weight: 650;
}

.zeith-customer-name {
    display: block;
    color: #0F172A;
    font-size: 13px;
    font-weight: 700;
}

.zeith-customer-email,
.zeith-contact-address,
.zeith-financial-details {
    display: block;
    margin-top: 4px;
    color: #64748B;
    font-size: 11px;
    overflow-wrap: anywhere;
}

.zeith-contact-phone {
    color: #334155;
    font-size: 12px;
    font-weight: 600;
}

.zeith-order-amount {
    color: #059669;
    font-size: 13px;
    font-weight: 800;
    white-space: nowrap;
}

.zeith-payment-status,
.zeith-order-status {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 6px 10px;
    border-radius: 20px;
    font-size: 10px;
    font-weight: 750;
    white-space: nowrap;
    text-transform: capitalize;
}

.zeith-payment-status {
    background: #FEF3C7;
    color: #B45309;
}

.zeith-payment-status.paid {
    background: #DCFCE7;
    color: #15803D;
}

.zeith-payment-status.failed {
    background: #FEE2E2;
    color: #B91C1C;
}

.zeith-order-status {
    background: #DBEAFE;
    color: #1D4ED8;
}

.zeith-order-status.processing {
    background: #EDE9FE;
    color: #6D28D9;
}

.zeith-order-status.dispatched {
    background: #FFEDD5;
    color: #C2410C;
}

.zeith-order-status.delivered {
    background: #DCFCE7;
    color: #15803D;
}

.zeith-order-date {
    color: #64748B;
    font-size: 11px;
    white-space: nowrap;
}

.zeith-orders-empty,
.zeith-orders-no-results {
    display: none;
    padding: 55px 20px;
    text-align: center;
}

.zeith-orders-empty {
    display: block;
}

.zeith-orders-empty strong,
.zeith-orders-no-results strong {
    display: block;
    margin-bottom: 8px;
    color: #0F172A;
    font-size: 15px;
}

.zeith-orders-empty p,
.zeith-orders-no-results p {
    margin: 0;
    color: #64748B;
    font-size: 13px;
}

.zeith-orders-no-results svg {
    width: 35px;
    height: 35px;
    margin-bottom: 12px;
    fill: none;
    stroke: #94A3B8;
    stroke-width: 1.5;
}

.zeith-orders-row-hidden {
    display: none !important;
}

@media (max-width: 1024px) {
    .zeith-orders-page {
        width: 100%;
        margin-left: 0;
        padding: 28px 22px;
    }
}

@media (max-width: 600px) {
    .zeith-orders-page {
        padding: 22px 14px;
    }

    .zeith-orders-header {
        align-items: flex-start;
        flex-direction: column;
        gap: 16px;
    }

    .zeith-orders-heading h1 {
        font-size: 23px;
    }

    .zeith-orders-back {
        width: 100%;
    }

    .zeith-orders-card-header {
        align-items: flex-start;
        flex-direction: column;
        padding: 19px 16px;
    }

    .zeith-orders-toolbar {
        padding: 15px 16px;
    }

    .zeith-orders-search {
        max-width: 100%;
    }

    .zeith-orders-search input {
        font-size: 12px;
        padding-right: 100px;
    }
}
</style>


    <?php
// views/Staff/order.php
\App\Helpers\View::displayComponent("admin/sidebar.php");
?>



<div class="zeith-orders-page">

    <header class="zeith-orders-header">
        <div class="zeith-orders-heading">
            <span class="zeith-orders-eyebrow">Admin Oversight</span>
            <h1>All Customer Orders</h1>
            <p>Monitor customer orders, payment records and fulfillment activity across ZEITH.</p>
        </div>

 
    </header>

    <section class="zeith-orders-card">

        <div class="zeith-orders-card-header">
            <div class="zeith-orders-card-title">
                <h2>Database Order Registry</h2>
                <p>Complete record of customer purchases and fulfillment statuses.</p>
            </div>

            <div class="zeith-orders-total">
                Total Orders:
                <strong><?= count($orders) ?></strong>
            </div>
        </div>

        <div class="zeith-orders-toolbar">
            <div class="zeith-orders-search">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="11" cy="11" r="7"></circle>
                    <path d="m20 20-4-4"></path>
                </svg>

                <input
                    type="search"
                    id="zeithOrdersSearch"
                    placeholder="Search order, customer, email, phone or status..."
                    autocomplete="off"
                >

                <span class="zeith-orders-search-count" id="zeithOrdersSearchCount">
                    <?= count($orders) ?> orders
                </span>
            </div>
        </div>

        <div class="zeith-orders-table-wrapper">

            <table class="zeith-orders-table">
                <thead>
                    <tr>
                        <th>ID / Order #</th>
                        <th>Customer</th>
                        <th>Contact & Address</th>
                        <th>Financials</th>
                        <th>Payment Status</th>
                        <th>Order Status</th>
                        <th>Date</th>
                    </tr>
                </thead>

                <tbody id="zeithOrdersTableBody">

                    <?php if (!empty($orders)): ?>

                        <?php foreach ($orders as $ord): ?>

                            <?php
                            $paymentStatus = trim(strtolower($ord['payment_status'] ?? 'pending'));
                            $orderStatus = trim(strtolower($ord['order_status'] ?? 'pending verification'));

                            $paymentClass = match ($paymentStatus) {
                                'paid' => 'paid',
                                'failed' => 'failed',
                                default => 'pending'
                            };

                            $orderClass = match ($orderStatus) {
                                'processing' => 'processing',
                                'dispatched' => 'dispatched',
                                'delivered' => 'delivered',
                                default => 'pending'
                            };
                            ?>

                            <tr class="zeith-orders-row">

                                <td>
                                    <strong class="zeith-order-id">
                                        #<?= htmlspecialchars((string)($ord['id'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                                    </strong>

                                    <span class="zeith-order-number">
                                        <?= htmlspecialchars($ord['order_number'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                                    </span>
                                </td>

                                <td>
                                    <strong class="zeith-customer-name">
                                        <?= htmlspecialchars($ord['full_name'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                                    </strong>

                                    <span class="zeith-customer-email">
                                        <?= htmlspecialchars($ord['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                                    </span>
                                </td>

                                <td>
                                    <span class="zeith-contact-phone">
                                        <?= htmlspecialchars($ord['phone'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                                    </span>

                                    <span class="zeith-contact-address">
                                        <?= htmlspecialchars($ord['address'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                                    </span>
                                </td>

                                <td>
                                    <strong class="zeith-order-amount">
                                        ₦<?= number_format((float)($ord['total_amount'] ?? 0), 0) ?>
                                    </strong>

                                    <span class="zeith-financial-details">
                                        Sub: ₦<?= number_format((float)($ord['subtotal'] ?? 0), 0) ?>
                                        | Ship: ₦<?= number_format((float)($ord['shipping_fee'] ?? 0), 0) ?>
                                    </span>
                                </td>

                                <td>
                                    <span class="zeith-payment-status <?= $paymentClass ?>">
                                        <?= htmlspecialchars($ord['payment_status'] ?? 'Pending', ENT_QUOTES, 'UTF-8') ?>
                                    </span>
                                </td>

                                <td>
                                    <span class="zeith-order-status <?= $orderClass ?>">
                                        <?= htmlspecialchars($ord['order_status'] ?? 'Pending Verification', ENT_QUOTES, 'UTF-8') ?>
                                    </span>
                                </td>

                                <td>
                                    <span class="zeith-order-date">
                                        <?= htmlspecialchars($ord['created_at'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                                    </span>
                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>
                            <td colspan="7">
                                <div class="zeith-orders-empty">
                                    <strong>No Orders Available</strong>
                                    <p>There are currently no customer orders in the database.</p>
                                </div>
                            </td>
                        </tr>

                    <?php endif; ?>

                </tbody>
            </table>

            <div class="zeith-orders-no-results" id="zeithOrdersNoResults">
                <svg viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="7"></circle>
                    <path d="m20 20-4-4"></path>
                </svg>
                <strong>No matching orders found</strong>
                <p>Try searching with a different order number or customer detail.</p>
            </div>

        </div>
    </section>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("zeithOrdersSearch");
    const searchCount = document.getElementById("zeithOrdersSearchCount");
    const tableBody = document.getElementById("zeithOrdersTableBody");
    const noResults = document.getElementById("zeithOrdersNoResults");

    if (!searchInput || !tableBody) return;

    const orderRows = Array.from(
        tableBody.querySelectorAll(".zeith-orders-row")
    );

    function filterOrders() {
        const searchTerm = searchInput.value.trim().toLowerCase();
        let visibleCount = 0;

        orderRows.forEach(function (row) {
            const rowText = row.textContent.toLowerCase();
            const matches = rowText.includes(searchTerm);

            row.classList.toggle("zeith-orders-row-hidden", !matches);

            if (matches) {
                visibleCount++;
            }
        });

        if (noResults) {
            noResults.style.display =
                orderRows.length > 0 && visibleCount === 0 ? "block" : "none";
        }

        if (searchCount) {
            searchCount.textContent =
                `${visibleCount} of ${orderRows.length} orders`;
        }
    }

    searchInput.addEventListener("input", filterOrders);

    filterOrders();
});
</script>
