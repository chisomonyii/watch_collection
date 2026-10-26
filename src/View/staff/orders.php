
<?php
// views/Staff/order.php
\App\Helpers\View::displayComponent("Staff/sidebar.php");
?>

<main class="zeith-orders-page">

    <!-- =========================
         PAGE HEADER
    ========================== -->
    <header class="zeith-orders-header">

        <div>
            <span class="zeith-eyebrow">ZEITH PAY</span>
            <h1>Orders Management</h1>
            <p>Review customer orders and manage operational order status.</p>
        </div>

        <button type="button" class="zeith-refresh-btn" onclick="location.reload()">
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M20 11a8.1 8.1 0 0 0-15.5-3M4 5v4h4M4 13a8.1 8.1 0 0 0 15.5 3M20 19v-4h-4"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="1.8"
                      stroke-linecap="round"
                      stroke-linejoin="round"/>
            </svg>
            Refresh
        </button>

    </header>


    <!-- =========================
         ORDER STATISTICS
    ========================== -->
    <section class="zeith-order-stats">

        <div class="zeith-stat-card">
            <div class="zeith-stat-icon blue">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M6 3h12v18H6zM9 7h6M9 11h6M9 15h4"
                          fill="none"
                          stroke="currentColor"
                          stroke-width="1.8"
                          stroke-linecap="round"
                          stroke-linejoin="round"/>
                </svg>
            </div>

            <div>
                <span>Total Orders</span>
                <strong>128</strong>
            </div>
        </div>


        <div class="zeith-stat-card">
            <div class="zeith-stat-icon orange">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="12" cy="12" r="8.5"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"/>
                    <path d="M12 7v5l3 2"
                          fill="none"
                          stroke="currentColor"
                          stroke-width="1.8"
                          stroke-linecap="round"/>
                </svg>
            </div>

            <div>
                <span>Pending Verification</span>
                <strong>12</strong>
            </div>
        </div>


        <div class="zeith-stat-card">
            <div class="zeith-stat-icon purple">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M5 12h14M13 6l6 6-6 6"
                          fill="none"
                          stroke="currentColor"
                          stroke-width="1.8"
                          stroke-linecap="round"
                          stroke-linejoin="round"/>
                </svg>
            </div>

            <div>
                <span>Processing</span>
                <strong>24</strong>
            </div>
        </div>


        <div class="zeith-stat-card">
            <div class="zeith-stat-icon green">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M5 12.5 9.2 17 19 7"
                          fill="none"
                          stroke="currentColor"
                          stroke-width="2"
                          stroke-linecap="round"
                          stroke-linejoin="round"/>
                </svg>
            </div>

            <div>
                <span>Delivered</span>
                <strong>96</strong>
            </div>
        </div>

    </section>


    <!-- =========================
         ORDERS WORKSPACE
    ========================== -->
    <section class="zeith-orders-workspace">

        <!-- ORDER LIST -->
        <div class="zeith-orders-list-panel">

            <div class="zeith-panel-header">

                <div>
                    <h2>Customer Orders</h2>
                    <p>Select an order to view its operational details.</p>
                </div>

                <div class="zeith-order-tools">

                    <div class="zeith-search">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <circle cx="11" cy="11" r="6.5"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"/>
                            <path d="m16 16 4 4"
                                  fill="none"
                                  stroke="currentColor"
                                  stroke-width="1.8"
                                  stroke-linecap="round"/>
                        </svg>

                        <input
                            type="search"
                            id="zeithOrderSearch"
                            placeholder="Search orders..."
                            autocomplete="off"
                        >
                    </div>


                    <select id="zeithOrderFilter" class="zeith-filter">
                        <option value="all">All Statuses</option>
                        <option value="pending">Pending Verification</option>
                        <option value="processing">Processing</option>
                        <option value="dispatched">Dispatched</option>
                        <option value="delivered">Delivered</option>
                    </select>

                </div>

            </div>


            <div class="zeith-order-list" id="zeithOrderList">

                <!-- ORDER 1 -->
                <button
                    type="button"
                    class="zeith-order-row active"
                    data-order-id="ZEITH-6ACD66CA826C8"
                    data-status="pending"
                    onclick="selectOrder(this)"
                >
                    <div class="zeith-order-main">

                        <strong>ZEITH-6ACD66CA826C8</strong>

                        <span>Chibuikem Ogbonna</span>
                        <small>chibuikem@example.com</small>

                    </div>

                    <div class="zeith-order-side">

                        <strong>₦95,000</strong>

                        <span class="zeith-status pending">
                            Pending Verification
                        </span>

                    </div>
                </button>


                <!-- ORDER 2 -->
                <button
                    type="button"
                    class="zeith-order-row"
                    data-order-id="ZEITH-92FBD8214A77"
                    data-status="processing"
                    onclick="selectOrder(this)"
                >
                    <div class="zeith-order-main">

                        <strong>ZEITH-92FBD8214A77</strong>

                        <span>Daniel Eze</span>
                        <small>daniel@example.com</small>

                    </div>

                    <div class="zeith-order-side">

                        <strong>₦82,500</strong>

                        <span class="zeith-status processing">
                            Processing
                        </span>

                    </div>
                </button>


                <!-- ORDER 3 -->
                <button
                    type="button"
                    class="zeith-order-row"
                    data-order-id="ZEITH-4D8A2F91BC20"
                    data-status="dispatched"
                    onclick="selectOrder(this)"
                >
                    <div class="zeith-order-main">

                        <strong>ZEITH-4D8A2F91BC20</strong>

                        <span>Amaka Nwosu</span>
                        <small>amaka@example.com</small>

                    </div>

                    <div class="zeith-order-side">

                        <strong>₦87,000</strong>

                        <span class="zeith-status dispatched">
                            Dispatched
                        </span>

                    </div>
                </button>


                <!-- ORDER 4 -->
                <button
                    type="button"
                    class="zeith-order-row"
                    data-order-id="ZEITH-B72D6E93FA12"
                    data-status="delivered"
                    onclick="selectOrder(this)"
                >
                    <div class="zeith-order-main">

                        <strong>ZEITH-B72D6E93FA12</strong>

                        <span>Michael Okoro</span>
                        <small>michael@example.com</small>

                    </div>

                    <div class="zeith-order-side">

                        <strong>₦72,000</strong>

                        <span class="zeith-status delivered">
                            Delivered
                        </span>

                    </div>
                </button>

            </div>

        </div>


        <!-- =========================
             ORDER DETAILS
        ========================== -->
        <aside class="zeith-order-details">

            <div class="zeith-details-header">

                <div>
                    <span class="zeith-details-label">ORDER DETAILS</span>
                    <h2 id="zeithDetailOrderNumber">
                        ZEITH-6ACD66CA826C8
                    </h2>
                </div>

                <span class="zeith-status pending" id="zeithDetailStatus">
                    Pending Verification
                </span>

            </div>


            <!-- CUSTOMER INFORMATION -->
            <div class="zeith-detail-section">

                <div class="zeith-section-title">
                    <h3>Customer Information</h3>
                </div>

                <div class="zeith-info-grid">

                    <div>
                        <span>Full Name</span>
                        <strong id="zeithCustomerName">
                            Chibuikem Ogbonna
                        </strong>
                    </div>

                    <div>
                        <span>Email</span>
                        <strong id="zeithCustomerEmail">
                            chibuikem@example.com
                        </strong>
                    </div>

                    <div>
                        <span>Phone</span>
                        <strong id="zeithCustomerPhone">
                            +234 801 234 5678
                        </strong>
                    </div>

                </div>

            </div>


            <!-- DELIVERY INFORMATION -->
            <div class="zeith-detail-section">

                <div class="zeith-section-title">
                    <h3>Delivery Information</h3>
                </div>

                <div class="zeith-delivery-box">

                    <div class="zeith-detail-line">
                        <span>Address</span>
                        <strong>
                            14 Admiralty Way, Lekki Phase 1,
                            Lagos, Nigeria.
                        </strong>
                    </div>

                    <div class="zeith-detail-line">
                        <span>Delivery Instruction</span>
                        <strong>
                            Please call before delivery.
                            Customer prefers evening delivery
                            after 5:00 PM.
                        </strong>
                    </div>

                </div>

            </div>


            <!-- PAYMENT INFORMATION -->
            <div class="zeith-detail-section">

                <div class="zeith-section-title">
                    <h3>Payment Information</h3>
                </div>

                <div class="zeith-payment-grid">

                    <div>
                        <span>Payment Status</span>

                        <strong
                            class="zeith-payment-paid"
                            id="zeithPaymentStatus"
                        >
                            Paid
                        </strong>
                    </div>


                    <div>
                        <span>Payment Reference</span>

                        <strong>
                            PAY-6ACD66CA826C8
                        </strong>
                    </div>


                    <div class="zeith-payment-receipt">

                        <span>Payment Receipt</span>

                        <button
                            type="button"
                            class="zeith-receipt-btn"
                            id="zeithOpenReceipt"
                        >
                            View Receipt
                        </button>

                    </div>

                </div>

            </div>


            <!-- ORDER SUMMARY -->
            <div class="zeith-detail-section">

                <div class="zeith-section-title">
                    <h3>Order Summary</h3>
                </div>

                <div class="zeith-summary">

                    <div>
                        <span>Subtotal</span>
                        <strong>₦85,000</strong>
                    </div>

                    <div>
                        <span>Shipping Fee</span>
                        <strong>₦10,000</strong>
                    </div>

                    <div>
                        <span>Shipping Method</span>
                        <strong>Standard Delivery</strong>
                    </div>

                    <div class="zeith-total-row">
                        <span>Total Amount</span>
                        <strong>₦95,000</strong>
                    </div>

                </div>

            </div>


            <!-- UPDATE ORDER STATUS -->
            <div class="zeith-detail-section">

                <div class="zeith-section-title">
                    <h3>Update Order Status</h3>
                    <span>Operational Access</span>
                </div>

                <div class="zeith-status-update">

                    <select id="zeithStatusSelect">

                        <option value="pending">
                            Pending Verification
                        </option>

                        <option value="processing">
                            Processing
                        </option>

                        <option value="dispatched">
                            Dispatched
                        </option>

                        <option value="delivered">
                            Delivered
                        </option>

                    </select>

                    <button
                        type="button"
                        id="zeithUpdateStatus"
                    >
                        Update Status
                    </button>

                </div>

            </div>


            <!-- STATUS TIMELINE -->
            <div class="zeith-detail-section">

                <div class="zeith-section-title">
                    <h3>Order Progress</h3>
                </div>

                <div class="zeith-timeline">

                    <div class="zeith-timeline-item completed">
                        <span class="zeith-timeline-dot"></span>

                        <div>
                            <strong>Order Received</strong>
                            <small>Order has been received.</small>
                        </div>
                    </div>


                    <div
                        class="zeith-timeline-item"
                        data-timeline="processing"
                    >
                        <span class="zeith-timeline-dot"></span>

                        <div>
                            <strong>Processing</strong>
                            <small>Order is being prepared.</small>
                        </div>
                    </div>


                    <div
                        class="zeith-timeline-item"
                        data-timeline="dispatched"
                    >
                        <span class="zeith-timeline-dot"></span>

                        <div>
                            <strong>Dispatched</strong>
                            <small>Order has left for delivery.</small>
                        </div>
                    </div>


                    <div
                        class="zeith-timeline-item"
                        data-timeline="delivered"
                    >
                        <span class="zeith-timeline-dot"></span>

                        <div>
                            <strong>Delivered</strong>
                            <small>Order successfully delivered.</small>
                        </div>
                    </div>

                </div>

            </div>


            <div class="zeith-order-number-footer">
                Order Number:
                <strong>ZEITH-6ACD66CA826C8</strong>
            </div>

        </aside>

    </section>

</main>


<!-- =========================
     PAYMENT RECEIPT MODAL
========================== -->
<div
    class="zeith-receipt-overlay"
    id="zeithReceiptModal"
    aria-hidden="true"
>

    <div
        class="zeith-receipt-modal"
        role="dialog"
        aria-modal="true"
        aria-labelledby="zeithReceiptTitle"
    >

        <div class="zeith-receipt-modal-header">

            <div>
                <span>PAYMENT RECEIPT</span>
                <h2 id="zeithReceiptTitle">Receipt Verification</h2>
            </div>

            <button
                type="button"
                class="zeith-modal-close"
                id="zeithCloseReceipt"
                aria-label="Close receipt"
            >
                &times;
            </button>

        </div>


        <div class="zeith-receipt-body">

            <div class="zeith-receipt-preview">

                <img
                    src="assets/images/receipt.jpg"
                    alt="Customer payment receipt"
                >

            </div>


            <div class="zeith-receipt-status">

                <label for="zeithReceiptPaymentStatus">
                    Payment Status
                </label>

                <textarea
                    id="zeithReceiptPaymentStatus"
                    rows="4"
                    placeholder="Enter payment status..."
                >Paid</textarea>

                <small>
                    Whatever you enter here will immediately update
                    the payment status shown in the order details.
                </small>

            </div>

        </div>


        <div class="zeith-receipt-footer">

            <button
                type="button"
                class="zeith-modal-cancel"
                id="zeithCancelReceipt"
            >
                Close
            </button>

            <button
                type="button"
                class="zeith-modal-save"
                id="zeithSaveReceipt"
            >
                Save Payment Status
            </button>

        </div>

    </div>

</div>


<style>
/* =========================================================
   ZEITH ORDERS MANAGEMENT
========================================================= */

.zeith-orders-page {
    margin-left: 250px;
    min-height: 100vh;
    padding: 32px;
    background: #F4F6F9;
    color: #0F172A;
    font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
}


/* HEADER */

.zeith-orders-header {
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

.zeith-orders-header h1 {
    margin: 0;
    font-size: 30px;
    line-height: 1.2;
    letter-spacing: -.03em;
}

.zeith-orders-header p {
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


/* STATS */

.zeith-order-stats {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 18px;
    margin-bottom: 24px;
}

.zeith-stat-card {
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

.zeith-stat-icon {
    display: grid;
    place-items: center;
    width: 46px;
    height: 46px;
    flex: 0 0 46px;
    border-radius: 11px;
}

.zeith-stat-icon svg {
    width: 22px;
    height: 22px;
}

.zeith-stat-icon.blue {
    background: #EFF6FF;
    color: #2563EB;
}

.zeith-stat-icon.orange {
    background: #FFF7ED;
    color: #F59E0B;
}

.zeith-stat-icon.purple {
    background: #F5F3FF;
    color: #7C3AED;
}

.zeith-stat-icon.green {
    background: #ECFDF5;
    color: #10B981;
}

.zeith-stat-card span {
    display: block;
    margin-bottom: 5px;
    color: #64748B;
    font-size: 12px;
    font-weight: 600;
}

.zeith-stat-card strong {
    display: block;
    color: #0F172A;
    font-size: 23px;
    line-height: 1;
}


/* WORKSPACE */

.zeith-orders-workspace {
    display: grid;
    grid-template-columns: minmax(390px, .9fr) minmax(450px, 1.1fr);
    gap: 20px;
    align-items: start;
}


/* PANELS */

.zeith-orders-list-panel,
.zeith-order-details {
    border: 1px solid #E2E8F0;
    border-radius: 14px;
    background: #FFFFFF;
    box-shadow: 0 2px 10px rgba(15, 23, 42, .035);
}

.zeith-orders-list-panel {
    overflow: hidden;
}

.zeith-panel-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 18px;
    padding: 21px;
    border-bottom: 1px solid #E2E8F0;
}

.zeith-panel-header h2 {
    margin: 0;
    font-size: 17px;
}

.zeith-panel-header p {
    margin: 5px 0 0;
    color: #64748B;
    font-size: 12px;
}

.zeith-order-tools {
    display: flex;
    align-items: center;
    gap: 8px;
}


/* SEARCH */

.zeith-search {
    position: relative;
}

.zeith-search svg {
    position: absolute;
    top: 50%;
    left: 11px;
    width: 16px;
    height: 16px;
    color: #94A3B8;
    transform: translateY(-50%);
    pointer-events: none;
}

.zeith-search input {
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

.zeith-search input:focus {
    border-color: #2563EB;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, .08);
}


/* FILTER */

.zeith-filter {
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


/* ORDER LIST */

.zeith-order-list {
    max-height: 680px;
    overflow-y: auto;
}

.zeith-order-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    min-height: 112px;
    padding: 18px 20px;
    border: 0;
    border-bottom: 1px solid #F1F5F9;
    background: #FFFFFF;
    color: inherit;
    text-align: left;
    cursor: pointer;
    transition: background .2s ease, box-shadow .2s ease;
}

.zeith-order-row:hover {
    background: #F8FAFC;
}

.zeith-order-row.active {
    background: #EFF6FF;
    box-shadow: inset 3px 0 #2563EB;
}

.zeith-order-main {
    min-width: 0;
}

.zeith-order-main strong {
    display: block;
    margin-bottom: 8px;
    color: #0F172A;
    font-size: 12px;
    font-weight: 800;
}

.zeith-order-main span {
    display: block;
    margin-bottom: 4px;
    color: #334155;
    font-size: 13px;
    font-weight: 700;
}

.zeith-order-main small {
    display: block;
    color: #94A3B8;
    font-size: 11px;
}

.zeith-order-side {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 8px;
    margin-left: 15px;
}

.zeith-order-side > strong {
    color: #0F172A;
    font-size: 13px;
}


/* STATUS */

.zeith-status {
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

.zeith-status.pending {
    background: #FFF7ED;
    color: #C2410C;
}

.zeith-status.processing {
    background: #EFF6FF;
    color: #1D4ED8;
}

.zeith-status.dispatched {
    background: #F5F3FF;
    color: #6D28D9;
}

.zeith-status.delivered {
    background: #ECFDF5;
    color: #047857;
}


/* DETAILS */

.zeith-order-details {
    overflow: hidden;
}

.zeith-details-header {
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

.zeith-details-header h2 {
    margin: 0;
    color: #0F172A;
    font-size: 15px;
}


/* DETAIL SECTIONS */

.zeith-detail-section {
    padding: 20px 22px;
    border-bottom: 1px solid #E2E8F0;
}

.zeith-section-title {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    margin-bottom: 15px;
}

.zeith-section-title h3 {
    margin: 0;
    color: #0F172A;
    font-size: 13px;
}

.zeith-section-title > span {
    color: #94A3B8;
    font-size: 10px;
    font-weight: 700;
}


/* CUSTOMER INFO */

.zeith-info-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
}

.zeith-info-grid span,
.zeith-payment-grid span,
.zeith-detail-line span,
.zeith-summary span {
    display: block;
    margin-bottom: 5px;
    color: #94A3B8;
    font-size: 10px;
    font-weight: 700;
}

.zeith-info-grid strong,
.zeith-payment-grid strong,
.zeith-detail-line strong {
    display: block;
    color: #334155;
    font-size: 12px;
    line-height: 1.5;
    word-break: break-word;
}


/* DELIVERY */

.zeith-delivery-box {
    display: grid;
    gap: 15px;
    padding: 15px;
    border: 1px solid #E2E8F0;
    border-radius: 10px;
    background: #F8FAFC;
}

.zeith-detail-line strong {
    font-weight: 600;
}


/* PAYMENT */

.zeith-payment-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 18px;
}

.zeith-payment-paid {
    color: #047857 !important;
}

.zeith-payment-receipt {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 7px;
    grid-column: 1 / -1;
    padding-top: 4px;
}

.zeith-receipt-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 34px;
    padding: 0 12px;
    border: 1px solid #BFDBFE;
    border-radius: 7px;
    background: #EFF6FF;
    color: #2563EB;
    font-size: 11px;
    font-weight: 800;
    cursor: pointer;
    transition: .2s ease;
}

.zeith-receipt-btn:hover {
    border-color: #2563EB;
    background: #2563EB;
    color: #FFFFFF;
}


/* SUMMARY */

.zeith-summary {
    display: grid;
    gap: 10px;
}

.zeith-summary > div {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
}

.zeith-summary strong {
    color: #334155;
    font-size: 12px;
}

.zeith-total-row {
    margin-top: 6px;
    padding-top: 13px;
    border-top: 1px solid #E2E8F0;
}

.zeith-total-row span {
    color: #0F172A;
    font-size: 12px;
    font-weight: 800;
}

.zeith-total-row strong {
    color: #2563EB;
    font-size: 16px;
}


/* STATUS UPDATE */

.zeith-status-update {
    display: flex;
    gap: 10px;
}

.zeith-status-update select {
    flex: 1;
    height: 42px;
    padding: 0 12px;
    border: 1px solid #E2E8F0;
    border-radius: 8px;
    outline: none;
    background: #FFFFFF;
    color: #334155;
    font-size: 12px;
    cursor: pointer;
}

.zeith-status-update select:focus {
    border-color: #2563EB;
}

.zeith-status-update button {
    height: 42px;
    padding: 0 16px;
    border: 0;
    border-radius: 8px;
    background: #2563EB;
    color: #FFFFFF;
    font-size: 12px;
    font-weight: 800;
    cursor: pointer;
    transition: .2s ease;
}

.zeith-status-update button:hover {
    background: #1D4ED8;
}


/* TIMELINE */

.zeith-timeline {
    position: relative;
    display: grid;
    gap: 20px;
}

.zeith-timeline::before {
    position: absolute;
    top: 8px;
    bottom: 8px;
    left: 5px;
    width: 1px;
    background: #E2E8F0;
    content: "";
}

.zeith-timeline-item {
    position: relative;
    display: flex;
    gap: 14px;
    min-height: 34px;
    padding-left: 0;
}

.zeith-timeline-dot {
    position: relative;
    z-index: 2;
    width: 11px;
    height: 11px;
    margin-top: 3px;
    flex: 0 0 11px;
    border: 2px solid #CBD5E1;
    border-radius: 50%;
    background: #FFFFFF;
}

.zeith-timeline-item.completed .zeith-timeline-dot,
.zeith-timeline-item.current .zeith-timeline-dot {
    border-color: #2563EB;
    background: #2563EB;
}

.zeith-timeline-item strong {
    display: block;
    color: #334155;
    font-size: 12px;
}

.zeith-timeline-item small {
    display: block;
    margin-top: 3px;
    color: #94A3B8;
    font-size: 10px;
}


/* ORDER NUMBER */

.zeith-order-number-footer {
    padding: 16px 22px;
    background: #F8FAFC;
    color: #94A3B8;
    font-size: 10px;
}

.zeith-order-number-footer strong {
    color: #475569;
}


/* =========================================================
   RECEIPT MODAL
========================================================= */

.zeith-receipt-overlay {
    position: fixed;
    inset: 0;
    z-index: 9999;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 24px;
    background: rgba(15, 23, 42, .58);
    backdrop-filter: blur(4px);
}

.zeith-receipt-overlay.is-visible {
    display: flex;
}

.zeith-receipt-modal {
    width: min(760px, 100%);
    max-height: 92vh;
    overflow: hidden;
    border: 1px solid #E2E8F0;
    border-radius: 16px;
    background: #FFFFFF;
    box-shadow: 0 25px 70px rgba(15, 23, 42, .22);
}

.zeith-receipt-modal-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    padding: 20px 22px;
    border-bottom: 1px solid #E2E8F0;
}

.zeith-receipt-modal-header > div > span {
    display: block;
    margin-bottom: 5px;
    color: #2563EB;
    font-size: 9px;
    font-weight: 900;
    letter-spacing: .13em;
}

.zeith-receipt-modal-header h2 {
    margin: 0;
    color: #0F172A;
    font-size: 18px;
}

.zeith-modal-close {
    display: grid;
    place-items: center;
    width: 34px;
    height: 34px;
    border: 0;
    border-radius: 8px;
    background: #F1F5F9;
    color: #475569;
    font-size: 23px;
    line-height: 1;
    cursor: pointer;
}

.zeith-modal-close:hover {
    background: #E2E8F0;
}

.zeith-receipt-body {
    display: grid;
    grid-template-columns: 1.15fr .85fr;
    gap: 22px;
    max-height: calc(92vh - 145px);
    padding: 22px;
    overflow-y: auto;
}

.zeith-receipt-preview {
    display: flex;
    align-items: flex-start;
    justify-content: center;
    min-height: 280px;
    padding: 12px;
    border: 1px solid #E2E8F0;
    border-radius: 11px;
    background: #F8FAFC;
}

.zeith-receipt-preview img {
    display: block;
    width: 100%;
    max-height: 510px;
    object-fit: contain;
    border-radius: 8px;
}

.zeith-receipt-status {
    display: flex;
    flex-direction: column;
    align-items: stretch;
}

.zeith-receipt-status label {
    margin-bottom: 8px;
    color: #334155;
    font-size: 12px;
    font-weight: 800;
}

.zeith-receipt-status textarea {
    width: 100%;
    min-height: 125px;
    padding: 12px;
    resize: vertical;
    border: 1px solid #CBD5E1;
    border-radius: 9px;
    outline: none;
    color: #0F172A;
    background: #FFFFFF;
    font: inherit;
    font-size: 12px;
    line-height: 1.5;
}

.zeith-receipt-status textarea:focus {
    border-color: #2563EB;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, .08);
}

.zeith-receipt-status small {
    margin-top: 9px;
    color: #94A3B8;
    font-size: 10px;
    line-height: 1.5;
}

.zeith-receipt-footer {
    display: flex;
    justify-content: flex-end;
    gap: 9px;
    padding: 16px 22px;
    border-top: 1px solid #E2E8F0;
    background: #F8FAFC;
}

.zeith-modal-cancel,
.zeith-modal-save {
    min-height: 38px;
    padding: 0 15px;
    border-radius: 8px;
    font-size: 11px;
    font-weight: 800;
    cursor: pointer;
}

.zeith-modal-cancel {
    border: 1px solid #E2E8F0;
    background: #FFFFFF;
    color: #475569;
}

.zeith-modal-save {
    border: 0;
    background: #2563EB;
    color: #FFFFFF;
}

.zeith-modal-save:hover {
    background: #1D4ED8;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 1250px) {

    .zeith-order-stats {
        grid-template-columns: repeat(2, 1fr);
    }

    .zeith-orders-workspace {
        grid-template-columns: 1fr;
    }

    .zeith-order-details {
        position: relative;
    }
}


@media (max-width: 1024px) {

    .zeith-orders-page {
        margin-left: 0;
        padding: 24px;
    }

    .zeith-panel-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .zeith-order-tools {
        width: 100%;
    }

    .zeith-search {
        flex: 1;
    }

    .zeith-search input {
        width: 100%;
    }

    .zeith-filter {
        flex: 0 0 180px;
    }

    .zeith-receipt-body {
        grid-template-columns: 1fr;
    }
}


@media (max-width: 700px) {

    .zeith-orders-page {
        padding: 18px;
    }

    .zeith-orders-header {
        align-items: flex-start;
        flex-direction: column;
        margin-bottom: 22px;
    }

    .zeith-orders-header h1 {
        font-size: 25px;
    }

    .zeith-refresh-btn {
        width: 100%;
    }

    .zeith-order-stats {
        grid-template-columns: 1fr;
    }

    .zeith-order-tools {
        flex-direction: column;
    }

    .zeith-search,
    .zeith-filter {
        width: 100%;
        flex: auto;
    }

    .zeith-order-row {
        align-items: flex-start;
        gap: 12px;
        padding: 16px;
    }

    .zeith-order-side {
        flex-shrink: 0;
    }

    .zeith-info-grid {
        grid-template-columns: 1fr;
    }

    .zeith-payment-grid {
        grid-template-columns: 1fr;
    }

    .zeith-payment-receipt {
        grid-column: auto;
    }

    .zeith-status-update {
        flex-direction: column;
    }

    .zeith-status-update button {
        width: 100%;
    }

    .zeith-receipt-overlay {
        padding: 12px;
    }

    .zeith-receipt-modal-header,
    .zeith-receipt-body,
    .zeith-receipt-footer {
        padding-left: 16px;
        padding-right: 16px;
    }

    .zeith-receipt-footer {
        flex-direction: column-reverse;
    }

    .zeith-modal-cancel,
    .zeith-modal-save {
        width: 100%;
    }
}


@media (max-width: 480px) {

    .zeith-orders-page {
        padding: 14px;
    }

    .zeith-panel-header,
    .zeith-details-header,
    .zeith-detail-section {
        padding-left: 16px;
        padding-right: 16px;
    }

    .zeith-order-side > strong {
        font-size: 11px;
    }

    .zeith-status {
        font-size: 9px;
    }

    .zeith-details-header {
        align-items: flex-start;
        flex-direction: column;
    }
}
</style>


<script>
/* =========================================================
   ORDER MANAGEMENT JAVASCRIPT
========================================================= */

(function () {

    const searchInput = document.getElementById("zeithOrderSearch");
    const filterSelect = document.getElementById("zeithOrderFilter");

    const orderRows = Array.from(
        document.querySelectorAll(".zeith-order-row")
    );

    const statusSelect = document.getElementById("zeithStatusSelect");
    const updateStatusButton = document.getElementById("zeithUpdateStatus");

    const detailStatus = document.getElementById("zeithDetailStatus");

    const detailOrderNumber =
        document.getElementById("zeithDetailOrderNumber");

    const paymentStatus =
        document.getElementById("zeithPaymentStatus");

    const receiptModal =
        document.getElementById("zeithReceiptModal");

    const openReceiptButton =
        document.getElementById("zeithOpenReceipt");

    const closeReceiptButton =
        document.getElementById("zeithCloseReceipt");

    const cancelReceiptButton =
        document.getElementById("zeithCancelReceipt");

    const saveReceiptButton =
        document.getElementById("zeithSaveReceipt");

    const receiptPaymentStatus =
        document.getElementById("zeithReceiptPaymentStatus");


    let selectedOrder = null;


    /* =========================================
       STATUS LABEL
    ========================================= */

    function getStatusLabel(status) {

        const labels = {
            pending: "Pending Verification",
            processing: "Processing",
            dispatched: "Dispatched",
            delivered: "Delivered"
        };

        return labels[status] || "Pending Verification";
    }


    /* =========================================
       STATUS CLASS
    ========================================= */

    function getStatusClass(status) {

        return [
            "pending",
            "processing",
            "dispatched",
            "delivered"
        ].includes(status)
            ? status
            : "pending";
    }


    /* =========================================
       SELECT ORDER
    ========================================= */

    window.selectOrder = function (row) {

        if (!row) {
            return;
        }

        orderRows.forEach(function (item) {
            item.classList.remove("active");
        });

        row.classList.add("active");

        selectedOrder = row;

        const orderId =
            row.getAttribute("data-order-id");

        const status =
            row.getAttribute("data-status") || "pending";


        if (detailOrderNumber) {
            detailOrderNumber.textContent = orderId;
        }

        if (statusSelect) {
            statusSelect.value = status;
        }

        updateDetailStatus(status);
    };


    /* =========================================
       UPDATE DETAIL STATUS
    ========================================= */

    function updateDetailStatus(status) {

        if (!detailStatus) {
            return;
        }

        detailStatus.className =
            "zeith-status " + getStatusClass(status);

        detailStatus.textContent =
            getStatusLabel(status);


        document.querySelectorAll(
            ".zeith-timeline-item[data-timeline]"
        ).forEach(function (item) {

            item.classList.remove("completed", "current");

            const timelineStatus =
                item.getAttribute("data-timeline");

            const order = [
                "processing",
                "dispatched",
                "delivered"
            ];

            const currentIndex =
                order.indexOf(status);

            const itemIndex =
                order.indexOf(timelineStatus);


            if (status === "pending") {
                return;
            }

            if (itemIndex < currentIndex) {
                item.classList.add("completed");
            }

            if (itemIndex === currentIndex) {
                item.classList.add("current");
            }

            if (status === "delivered" &&
                timelineStatus === "delivered") {

                item.classList.remove("current");
                item.classList.add("completed");
            }

        });
    }


    /* =========================================
       SEARCH + FILTER
    ========================================= */

    function filterOrders() {

        const search =
            searchInput
                ? searchInput.value.trim().toLowerCase()
                : "";

        const filter =
            filterSelect
                ? filterSelect.value
                : "all";


        orderRows.forEach(function (row) {

            const text =
                row.textContent.toLowerCase();

            const status =
                row.getAttribute("data-status");


            const matchesSearch =
                !search || text.includes(search);

            const matchesFilter =
                filter === "all" || status === filter;


            row.style.display =
                matchesSearch && matchesFilter
                    ? ""
                    : "none";

        });
    }


    if (searchInput) {
        searchInput.addEventListener(
            "input",
            filterOrders
        );
    }

    if (filterSelect) {
        filterSelect.addEventListener(
            "change",
            filterOrders
        );
    }


    /* =========================================
       UPDATE ORDER STATUS
    ========================================= */

    if (updateStatusButton) {

        updateStatusButton.addEventListener(
            "click",
            function () {

                if (!selectedOrder || !statusSelect) {
                    return;
                }

                const newStatus =
                    statusSelect.value;


                const allowedStatuses = [
                    "pending",
                    "processing",
                    "dispatched",
                    "delivered"
                ];

                if (!allowedStatuses.includes(newStatus)) {
                    return;
                }


                selectedOrder.setAttribute(
                    "data-status",
                    newStatus
                );


                const statusBadge =
                    selectedOrder.querySelector(
                        ".zeith-status"
                    );


                if (statusBadge) {

                    statusBadge.className =
                        "zeith-status " +
                        getStatusClass(newStatus);

                    statusBadge.textContent =
                        getStatusLabel(newStatus);
                }


                updateDetailStatus(newStatus);


                updateStatusButton.textContent =
                    "Updated";

                setTimeout(function () {

                    updateStatusButton.textContent =
                        "Update Status";

                }, 1200);

            }
        );

    }


    /* =========================================
       RECEIPT MODAL
    ========================================= */

    function openReceiptModal() {

        if (!receiptModal) {
            return;
        }

        if (paymentStatus &&
            receiptPaymentStatus) {

            receiptPaymentStatus.value =
                paymentStatus.textContent.trim();

        }

        receiptModal.classList.add("is-visible");
        receiptModal.setAttribute(
            "aria-hidden",
            "false"
        );

        document.body.style.overflow = "hidden";


        setTimeout(function () {

            if (receiptPaymentStatus) {
                receiptPaymentStatus.focus();
            }

        }, 100);

    }


    function closeReceiptModal() {

        if (!receiptModal) {
            return;
        }

        receiptModal.classList.remove(
            "is-visible"
        );

        receiptModal.setAttribute(
            "aria-hidden",
            "true"
        );

        document.body.style.overflow = "";

    }


    if (openReceiptButton) {

        openReceiptButton.addEventListener(
            "click",
            openReceiptModal
        );

    }


    if (closeReceiptButton) {

        closeReceiptButton.addEventListener(
            "click",
            closeReceiptModal
        );

    }


    if (cancelReceiptButton) {

        cancelReceiptButton.addEventListener(
            "click",
            closeReceiptModal
        );

    }


    /* =========================================
       LIVE PAYMENT STATUS PREVIEW
    ========================================= */

    if (receiptPaymentStatus) {

        receiptPaymentStatus.addEventListener(
            "input",
            function () {

                if (!paymentStatus) {
                    return;
                }

                const value =
                    receiptPaymentStatus.value.trim();


                paymentStatus.textContent =
                    value || "Pending";

                paymentStatus.classList.remove(
                    "zeith-payment-paid"
                );

                if (
                    value.toLowerCase() === "paid" ||
                    value.toLowerCase() === "verified" ||
                    value.toLowerCase() === "successful"
                ) {

                    paymentStatus.classList.add(
                        "zeith-payment-paid"
                    );

                }

            }
        );

    }


    /* =========================================
       SAVE RECEIPT PAYMENT STATUS
    ========================================= */

    if (saveReceiptButton) {

        saveReceiptButton.addEventListener(
            "click",
            function () {

                if (
                    paymentStatus &&
                    receiptPaymentStatus
                ) {

                    const value =
                        receiptPaymentStatus.value.trim();

                    paymentStatus.textContent =
                        value || "Pending";


                    paymentStatus.classList.remove(
                        "zeith-payment-paid"
                    );


                    if (
                        value.toLowerCase() === "paid" ||
                        value.toLowerCase() === "verified" ||
                        value.toLowerCase() === "successful"
                    ) {

                        paymentStatus.classList.add(
                            "zeith-payment-paid"
                        );

                    }

                }


                saveReceiptButton.textContent =
                    "Saved";

                setTimeout(function () {

                    saveReceiptButton.textContent =
                        "Save Payment Status";

                    closeReceiptModal();

                }, 700);

            }
        );

    }


    /* =========================================
       CLOSE MODAL BY CLICKING OUTSIDE
    ========================================= */

    if (receiptModal) {

        receiptModal.addEventListener(
            "click",
            function (event) {

                if (event.target === receiptModal) {
                    closeReceiptModal();
                }

            }
        );

    }


    /* =========================================
       ESCAPE KEY
    ========================================= */

    document.addEventListener(
        "keydown",
        function (event) {

            if (event.key === "Escape") {
                closeReceiptModal();
            }

        }
    );


    /* =========================================
       INITIAL ORDER
    ========================================= */

    if (orderRows.length > 0) {

        selectedOrder =
            document.querySelector(
                ".zeith-order-row.active"
            ) || orderRows[0];

        if (selectedOrder) {
            selectOrder(selectedOrder);
        }

    }

})();
</script>
```