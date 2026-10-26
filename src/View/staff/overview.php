<?php
/**
 * ZEITH STAFF DASHBOARD
 * Staff has operational + moderation access only.
 *
 * Staff can:
 * - View and update order status
 * - View payment/order information
 * - Moderate reviews
 * - View inventory
 * - View customer inquiries
 *
 * Staff cannot:
 * - Edit/delete watches
 * - Manage customers
 * - Manage shipping
 * - Manage newsletters
 * - Manage sellers
 * - Manage financial configuration
 */
?>

<?php
// views/Staff/order.php
\App\Helpers\View::displayComponent("Staff/sidebar.php");
?>


<link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">



<main class="zeith-staff-overview">

    <!-- =====================================================
         PAGE HEADER
    ====================================================== -->

    <header class="staff-overview-header">

        <div class="staff-header-content">

            <div class="staff-header-title">

                <span class="staff-eyebrow">
                    ZEITH STAFF PORTAL
                </span>

                <h1>
                    Staff Overview
                </h1>

                <p>
                    Monitor daily operations, orders, reviews and inventory.
                </p>

            </div>

            <div class="staff-header-date">

                <div class="staff-date-icon">
                    <i class="fa-regular fa-calendar"></i>
                </div>

                <div>
                    <span>Today</span>
                    <strong id="staffCurrentDate">
                        October 23, 2026
                    </strong>
                </div>

            </div>

        </div>

    </header>


    <!-- =====================================================
         OPERATIONAL STAT CARDS
    ====================================================== -->

    <section class="staff-stat-grid">

        <!-- Pending Verification -->

        <article class="staff-stat-card pending">

            <div class="staff-stat-top">

                <div class="staff-stat-icon">
                    <i class="fa-solid fa-clock"></i>
                </div>

                <span class="staff-stat-label">
                    Needs Attention
                </span>

            </div>

            <div class="staff-stat-number">
                12
            </div>

            <div class="staff-stat-bottom">

                <strong>
                    Pending Verification
                </strong>

                <a href="order.php?status=pending">
                    View Orders
                    <i class="fa-solid fa-arrow-right"></i>
                </a>

            </div>

        </article>


        <!-- Processing -->

        <article class="staff-stat-card processing">

            <div class="staff-stat-top">

                <div class="staff-stat-icon">
                    <i class="fa-solid fa-box"></i>
                </div>

                <span class="staff-stat-label">
                    In Progress
                </span>

            </div>

            <div class="staff-stat-number">
                24
            </div>

            <div class="staff-stat-bottom">

                <strong>
                    Processing Orders
                </strong>

                <a href="order.php?status=processing">
                    View Orders
                    <i class="fa-solid fa-arrow-right"></i>
                </a>

            </div>

        </article>


        <!-- Dispatched -->

        <article class="staff-stat-card dispatched">

            <div class="staff-stat-top">

                <div class="staff-stat-icon">
                    <i class="fa-solid fa-truck"></i>
                </div>

                <span class="staff-stat-label">
                    On The Way
                </span>

            </div>

            <div class="staff-stat-number">
                18
            </div>

            <div class="staff-stat-bottom">

                <strong>
                    Dispatched Orders
                </strong>

                <a href="order.php?status=dispatched">
                    View Orders
                    <i class="fa-solid fa-arrow-right"></i>
                </a>

            </div>

        </article>


        <!-- Delivered -->

        <article class="staff-stat-card delivered">

            <div class="staff-stat-top">

                <div class="staff-stat-icon">
                    <i class="fa-solid fa-circle-check"></i>
                </div>

                <span class="staff-stat-label">
                    Completed
                </span>

            </div>

            <div class="staff-stat-number">
                96
            </div>

            <div class="staff-stat-bottom">

                <strong>
                    Delivered Orders
                </strong>

                <a href="order.php?status=delivered">
                    View Orders
                    <i class="fa-solid fa-arrow-right"></i>
                </a>

            </div>

        </article>

    </section>


    <!-- =====================================================
         MAIN OPERATIONAL GRID
    ====================================================== -->

    <section class="staff-main-grid">


        <!-- =================================================
             ORDER STATUS
        ================================================== -->

        <article class="staff-panel">

            <div class="staff-panel-header">

                <div>

                    <span class="staff-panel-eyebrow">
                        ORDERS
                    </span>

                    <h2>
                        Order Status
                    </h2>

                    <p>
                        Current operational order breakdown.
                    </p>

                </div>

                <a
                    href="order.php"
                    class="staff-panel-link"
                >
                    View All
                    <i class="fa-solid fa-arrow-right"></i>
                </a>

            </div>


            <div class="order-status-list">

                <!-- Pending -->

                <div class="order-status-row">

                    <div class="order-status-name">

                        <span class="status-dot pending-dot"></span>

                        <span>
                            Pending Verification
                        </span>

                    </div>

                    <strong>
                        12
                    </strong>

                </div>


                <!-- Processing -->

                <div class="order-status-row">

                    <div class="order-status-name">

                        <span class="status-dot processing-dot"></span>

                        <span>
                            Processing
                        </span>

                    </div>

                    <strong>
                        24
                    </strong>

                </div>


                <!-- Dispatched -->

                <div class="order-status-row">

                    <div class="order-status-name">

                        <span class="status-dot dispatched-dot"></span>

                        <span>
                            Dispatched
                        </span>

                    </div>

                    <strong>
                        18
                    </strong>

                </div>


                <!-- Delivered -->

                <div class="order-status-row">

                    <div class="order-status-name">

                        <span class="status-dot delivered-dot"></span>

                        <span>
                            Delivered
                        </span>

                    </div>

                    <strong>
                        96
                    </strong>

                </div>

            </div>


            <div class="order-total-box">

                <div>

                    <span>
                        Total Orders
                    </span>

                    <strong>
                        150
                    </strong>

                </div>

                <i class="fa-solid fa-chart-simple"></i>

            </div>

        </article>


        <!-- =================================================
             STAFF ACTIONS
        ================================================== -->

        <article class="staff-panel">

            <div class="staff-panel-header">

                <div>

                    <span class="staff-panel-eyebrow">
                        QUICK ACCESS
                    </span>

                    <h2>
                        Staff Actions
                    </h2>

                    <p>
                        Access your operational tools.
                    </p>

                </div>

            </div>


            <div class="staff-actions-list">


                <!-- Orders -->

                <a
                    href="order.php"
                    class="staff-action-item"
                >

                    <span class="staff-action-icon blue">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </span>

                    <span class="staff-action-text">

                        <strong>
                            Orders Management
                        </strong>

                        <small>
                            View and update order status
                        </small>

                    </span>

                    <i class="fa-solid fa-chevron-right"></i>

                </a>


                <!-- Reviews -->

                <a
                    href="review.php"
                    class="staff-action-item"
                >

                    <span class="staff-action-icon orange">
                        <i class="fa-solid fa-star"></i>
                    </span>

                    <span class="staff-action-text">

                        <strong>
                            Review Moderation
                        </strong>

                        <small>
                            Approve or reject reviews
                        </small>

                    </span>

                    <i class="fa-solid fa-chevron-right"></i>

                </a>


                <!-- Inventory -->

                <a
                    href="watch.php"
                    class="staff-action-item"
                >

                    <span class="staff-action-icon green">
                        <i class="fa-solid fa-boxes-stacked"></i>
                    </span>

                    <span class="staff-action-text">

                        <strong>
                            Inventory Overview
                        </strong>

                        <small>
                            View current watch inventory
                        </small>

                    </span>

                    <i class="fa-solid fa-chevron-right"></i>

                </a>


                <!-- Contact -->

                <a
                    href="contact.php"
                    class="staff-action-item"
                >

                    <span class="staff-action-icon purple">
                        <i class="fa-solid fa-envelope"></i>
                    </span>

                    <span class="staff-action-text">

                        <strong>
                            Customer Inquiries
                        </strong>

                        <small>
                            View customer messages
                        </small>

                    </span>

                    <i class="fa-solid fa-chevron-right"></i>

                </a>

            </div>

        </article>

    </section>


    <!-- =====================================================
         RECENT ORDERS
    ====================================================== -->

    <section class="staff-panel staff-orders-panel">

        <div class="staff-panel-header">

            <div>

                <span class="staff-panel-eyebrow">
                    ORDER ACTIVITY
                </span>

                <h2>
                    Recent Orders
                </h2>

                <p>
                    Latest orders requiring operational attention.
                </p>

            </div>

            <a
                href="order.php"
                class="staff-panel-link"
            >
                View All Orders
                <i class="fa-solid fa-arrow-right"></i>
            </a>

        </div>


        <div class="staff-table-wrapper">

            <table class="staff-orders-table">

                <thead>

                    <tr>

                        <th>
                            Order
                        </th>

                        <th>
                            Customer
                        </th>

                        <th>
                            Amount
                        </th>

                        <th>
                            Payment
                        </th>

                        <th>
                            Status
                        </th>

                    </tr>

                </thead>


                <tbody>

                    <tr>

                        <td>
                            <strong class="order-number">
                                ZEITH-6ACD66CA826C
                            </strong>
                        </td>

                        <td>

                            <div class="customer-cell">

                                <span class="customer-avatar">
                                    CO
                                </span>

                                <div>

                                    <strong>
                                        Chibuikem Ogbonna
                                    </strong>

                                    <small>
                                        chibuikem@example.com
                                    </small>

                                </div>

                            </div>

                        </td>

                        <td>
                            <strong>
                                ₦95,000
                            </strong>
                        </td>

                        <td>
                            <span class="payment-paid">
                                Paid
                            </span>
                        </td>

                        <td>
                            <span class="order-badge pending">
                                Pending Verification
                            </span>
                        </td>

                    </tr>


                    <tr>

                        <td>
                            <strong class="order-number">
                                ZEITH-92FBD8214A77
                            </strong>
                        </td>

                        <td>

                            <div class="customer-cell">

                                <span class="customer-avatar">
                                    DE
                                </span>

                                <div>

                                    <strong>
                                        Daniel Eze
                                    </strong>

                                    <small>
                                        daniel@example.com
                                    </small>

                                </div>

                            </div>

                        </td>

                        <td>
                            <strong>
                                ₦82,500
                            </strong>
                        </td>

                        <td>
                            <span class="payment-paid">
                                Paid
                            </span>
                        </td>

                        <td>
                            <span class="order-badge processing">
                                Processing
                            </span>
                        </td>

                    </tr>


                    <tr>

                        <td>
                            <strong class="order-number">
                                ZEITH-4D8A2F91BC20
                            </strong>
                        </td>

                        <td>

                            <div class="customer-cell">

                                <span class="customer-avatar">
                                    AN
                                </span>

                                <div>

                                    <strong>
                                        Amaka Nwosu
                                    </strong>

                                    <small>
                                        amaka@example.com
                                    </small>

                                </div>

                            </div>

                        </td>

                        <td>
                            <strong>
                                ₦87,000
                            </strong>
                        </td>

                        <td>
                            <span class="payment-paid">
                                Paid
                            </span>
                        </td>

                        <td>
                            <span class="order-badge dispatched">
                                Dispatched
                            </span>
                        </td>

                    </tr>


                    <tr>

                        <td>
                            <strong class="order-number">
                                ZEITH-B72D6E93FA12
                            </strong>
                        </td>

                        <td>

                            <div class="customer-cell">

                                <span class="customer-avatar">
                                    MO
                                </span>

                                <div>

                                    <strong>
                                        Michael Okoro
                                    </strong>

                                    <small>
                                        michael@example.com
                                    </small>

                                </div>

                            </div>

                        </td>

                        <td>
                            <strong>
                                ₦72,000
                            </strong>
                        </td>

                        <td>
                            <span class="payment-paid">
                                Paid
                            </span>
                        </td>

                        <td>
                            <span class="order-badge delivered">
                                Delivered
                            </span>
                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </section>


    <!-- =====================================================
         LOWER INFORMATION GRID
    ====================================================== -->

    <section class="staff-lower-grid">


        <!-- =================================================
             INVENTORY
        ================================================== -->

        <article class="staff-panel">

            <div class="staff-panel-header">

                <div>

                    <span class="staff-panel-eyebrow">
                        INVENTORY
                    </span>

                    <h2>
                        Inventory Snapshot
                    </h2>

                    <p>
                        Current watch availability.
                    </p>

                </div>

                <a
                    href="watch.php"
                    class="staff-panel-link"
                >
                    View Inventory
                    <i class="fa-solid fa-arrow-right"></i>
                </a>

            </div>


            <div class="inventory-number">

                <strong>
                    42
                </strong>

                <span>
                    Watches in Catalog
                </span>

            </div>


            <div class="inventory-progress">

                <div class="inventory-progress-header">

                    <span>
                        Available
                    </span>

                    <strong>
                        36 / 42
                    </strong>

                </div>

                <div class="inventory-progress-track">

                    <span
                        style="width:85.7%;"
                    ></span>

                </div>

            </div>


            <div class="inventory-mini-grid">

                <div>

                    <span class="inventory-mini-icon available">
                        <i class="fa-solid fa-check"></i>
                    </span>

                    <div>

                        <strong>
                            36
                        </strong>

                        <span>
                            Available
                        </span>

                    </div>

                </div>


                <div>

                    <span class="inventory-mini-icon sold">
                        <i class="fa-solid fa-xmark"></i>
                    </span>

                    <div>

                        <strong>
                            6
                        </strong>

                        <span>
                            Sold Out
                        </span>

                    </div>

                </div>

            </div>

        </article>

    </section>


    <!-- =====================================================
         RECENT ACTIVITY
    ====================================================== -->

    <section class="staff-panel staff-activity-panel">

        <div class="staff-panel-header">

            <div>

                <span class="staff-panel-eyebrow">
                    SYSTEM ACTIVITY
                </span>

                <h2>
                    Recent Activity
                </h2>

                <p>
                    Latest operational events across the staff portal.
                </p>

            </div>

        </div>


        <div class="staff-activity-list">


            <div class="staff-activity-item">

                <span class="activity-icon order">
                    <i class="fa-solid fa-cart-plus"></i>
                </span>

                <div class="activity-content">

                    <strong>
                        New order received
                    </strong>

                    <p>
                        Order ZEITH-6ACD66CA826C was placed by Chibuikem Ogbonna.
                    </p>

                    <span>
                        8 minutes ago
                    </span>

                </div>

            </div>


            <div class="staff-activity-item">

                <span class="activity-icon review">
                    <i class="fa-solid fa-star"></i>
                </span>

                <div class="activity-content">

                    <strong>
                        New review awaiting approval
                    </strong>

                    <p>
                        A customer submitted a new watch review for moderation.
                    </p>

                    <span>
                        34 minutes ago
                    </span>

                </div>

            </div>


            <div class="staff-activity-item">

                <span class="activity-icon dispatch">
                    <i class="fa-solid fa-truck"></i>
                </span>

                <div class="activity-content">

                    <strong>
                        Order dispatched
                    </strong>

                    <p>
                        Order ZEITH-4D8A2F91BC20 has been marked as dispatched.
                    </p>

                    <span>
                        1 hour ago
                    </span>

                </div>

            </div>


            <div class="staff-activity-item">

                <span class="activity-icon contact">
                    <i class="fa-solid fa-envelope"></i>
                </span>

                <div class="activity-content">

                    <strong>
                        Customer inquiry received
                    </strong>

                    <p>
                        A new customer message is available in Contact Queries.
                    </p>

                    <span>
                        2 hours ago
                    </span>

                </div>

            </div>

        </div>

    </section>

</main>


<style>

/* =========================================================
   ZEITH STAFF OVERVIEW
========================================================= */

:root {

    --staff-bg: #F4F6F9;
    --staff-sidebar: #1E293B;
    --staff-card: #FFFFFF;

    --staff-text: #0F172A;
    --staff-muted: #64748B;
    --staff-light: #94A3B8;

    --staff-border: #E2E8F0;

    --staff-blue: #2563EB;
    --staff-green: #10B981;
    --staff-orange: #F59E0B;
    --staff-red: #EF4444;
    --staff-purple: #8B5CF6;

}


/* =========================================================
   PAGE
========================================================= */

.zeith-staff-overview {

    margin-left: 250px;

    min-height: 100vh;

    background: var(--staff-bg);

    padding: 32px;

    box-sizing: border-box;

    color: var(--staff-text);

}


/* =========================================================
   HEADER
========================================================= */

.staff-overview-header {

    margin-bottom: 28px;

}

.staff-header-content {

    display: flex;

    align-items: flex-end;

    justify-content: space-between;

    gap: 30px;

}

.staff-eyebrow {

    display: block;

    margin-bottom: 7px;

    color: var(--staff-blue);

    font-size: 10px;

    font-weight: 800;

    letter-spacing: .14em;

}

.staff-header-title h1 {

    margin: 0;

    font-size: 29px;

    line-height: 1.15;

    font-weight: 800;

    letter-spacing: -.03em;

}

.staff-header-title p {

    margin: 8px 0 0;

    color: var(--staff-muted);

    font-size: 13px;

}

.staff-header-date {

    display: flex;

    align-items: center;

    gap: 11px;

    background: #FFFFFF;

    border: 1px solid var(--staff-border);

    border-radius: 11px;

    padding: 10px 14px;

    min-width: 175px;

}

.staff-date-icon {

    width: 35px;

    height: 35px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 9px;

    background: #EFF6FF;

    color: var(--staff-blue);

}

.staff-header-date span {

    display: block;

    color: var(--staff-light);

    font-size: 10px;

    margin-bottom: 2px;

}

.staff-header-date strong {

    display: block;

    color: var(--staff-text);

    font-size: 11px;

}


/* =========================================================
   STAT CARDS
========================================================= */

.staff-stat-grid {

    display: grid;

    grid-template-columns:
        repeat(4, minmax(0, 1fr));

    gap: 18px;

    margin-bottom: 20px;

}

.staff-stat-card {

    position: relative;

    background: var(--staff-card);

    border: 1px solid var(--staff-border);

    border-radius: 13px;

    padding: 19px;

    overflow: hidden;

    transition: transform .2s ease,
                box-shadow .2s ease;

}

.staff-stat-card:hover {

    transform: translateY(-2px);

    box-shadow:
        0 8px 24px rgba(15, 23, 42, .06);

}

.staff-stat-top {

    display: flex;

    align-items: center;

    justify-content: space-between;

}

.staff-stat-icon {

    width: 39px;

    height: 39px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 10px;

    font-size: 14px;

}

.staff-stat-card.pending
.staff-stat-icon {

    background: #FFF7ED;

    color: var(--staff-orange);

}

.staff-stat-card.processing
.staff-stat-icon {

    background: #EFF6FF;

    color: var(--staff-blue);

}

.staff-stat-card.dispatched
.staff-stat-icon {

    background: #F5F3FF;

    color: var(--staff-purple);

}

.staff-stat-card.delivered
.staff-stat-icon {

    background: #ECFDF5;

    color: var(--staff-green);

}

.staff-stat-label {

    color: var(--staff-light);

    font-size: 10px;

    font-weight: 700;

}

.staff-stat-number {

    margin-top: 15px;

    font-size: 29px;

    font-weight: 800;

    letter-spacing: -.03em;

}

.staff-stat-bottom {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 8px;

    margin-top: 6px;

}

.staff-stat-bottom strong {

    color: #475569;

    font-size: 11px;

}

.staff-stat-bottom a {

    color: var(--staff-blue);

    font-size: 10px;

    font-weight: 800;

    text-decoration: none;

    white-space: nowrap;

}

.staff-stat-bottom a i {

    margin-left: 3px;

    font-size: 8px;

}


/* =========================================================
   PANELS
========================================================= */

.staff-panel {

    background: #FFFFFF;

    border: 1px solid var(--staff-border);

    border-radius: 13px;

    overflow: hidden;

}

.staff-panel-header {

    display: flex;

    align-items: flex-start;

    justify-content: space-between;

    gap: 20px;

    padding: 20px 20px 17px;

    border-bottom: 1px solid var(--staff-border);

}

.staff-panel-eyebrow {

    display: block;

    margin-bottom: 5px;

    color: var(--staff-blue);

    font-size: 9px;

    font-weight: 800;

    letter-spacing: .12em;

}

.staff-panel-header h2 {

    margin: 0;

    font-size: 16px;

    font-weight: 800;

    letter-spacing: -.02em;

}

.staff-panel-header p {

    margin: 5px 0 0;

    color: var(--staff-muted);

    font-size: 11px;

}

.staff-panel-link {

    display: inline-flex;

    align-items: center;

    gap: 6px;

    color: var(--staff-blue);

    font-size: 10px;

    font-weight: 800;

    text-decoration: none;

    white-space: nowrap;

}

.staff-panel-link:hover {

    text-decoration: underline;

}


/* =========================================================
   MAIN GRID
========================================================= */

.staff-main-grid {

    display: grid;

    grid-template-columns:
        minmax(0, 1.2fr)
        minmax(0, .8fr);

    gap: 20px;

    margin-bottom: 20px;

}


/* =========================================================
   ORDER STATUS
========================================================= */

.order-status-list {

    padding: 7px 20px;

}

.order-status-row {

    display: flex;

    align-items: center;

    justify-content: space-between;

    padding: 12px 0;

    border-bottom: 1px solid #F1F5F9;

}

.order-status-row:last-child {

    border-bottom: none;

}

.order-status-name {

    display: flex;

    align-items: center;

    gap: 9px;

    color: #475569;

    font-size: 12px;

}

.status-dot {

    width: 8px;

    height: 8px;

    border-radius: 50%;

}

.pending-dot {
    background: var(--staff-orange);
}

.processing-dot {
    background: var(--staff-blue);
}

.dispatched-dot {
    background: var(--staff-purple);
}

.delivered-dot {
    background: var(--staff-green);
}

.order-status-row strong {

    font-size: 13px;

}

.order-total-box {

    margin: 5px 20px 20px;

    padding: 14px;

    display: flex;

    align-items: center;

    justify-content: space-between;

    background: #F8FAFC;

    border-radius: 9px;

}

.order-total-box span {

    display: block;

    color: var(--staff-muted);

    font-size: 10px;

}

.order-total-box strong {

    display: block;

    margin-top: 3px;

    font-size: 18px;

}

.order-total-box > i {

    color: var(--staff-blue);

    font-size: 18px;

}


/* =========================================================
   STAFF ACTIONS
========================================================= */

.staff-actions-list {

    padding: 8px 20px 16px;

}

.staff-action-item {

    display: flex;

    align-items: center;

    gap: 11px;

    padding: 11px 0;

    border-bottom: 1px solid #F1F5F9;

    text-decoration: none;

}

.staff-action-item:last-child {

    border-bottom: none;

}

.staff-action-icon {

    width: 36px;

    height: 36px;

    flex: 0 0 36px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 9px;

    font-size: 12px;

}

.staff-action-icon.blue {
    background: #EFF6FF;
    color: #2563EB;
}

.staff-action-icon.orange {
    background: #FFF7ED;
    color: #F59E0B;
}

.staff-action-icon.green {
    background: #ECFDF5;
    color: #10B981;
}

.staff-action-icon.purple {
    background: #F5F3FF;
    color: #8B5CF6;
}

.staff-action-text {

    flex: 1;

    min-width: 0;

}

.staff-action-text strong {

    display: block;

    color: var(--staff-text);

    font-size: 11px;

}

.staff-action-text small {

    display: block;

    margin-top: 3px;

    color: var(--staff-muted);

    font-size: 9px;

}

.staff-action-item > i {

    color: #CBD5E1;

    font-size: 9px;

}

.staff-action-item:hover .staff-action-text strong {

    color: var(--staff-blue);

}


/* =========================================================
   ORDERS TABLE
========================================================= */

.staff-orders-panel {

    margin-bottom: 20px;

}

.staff-table-wrapper {

    width: 100%;

    overflow-x: auto;

}

.staff-orders-table {

    width: 100%;

    min-width: 750px;

    border-collapse: collapse;

}

.staff-orders-table th {

    padding: 12px 20px;

    background: #F8FAFC;

    color: var(--staff-muted);

    text-align: left;

    font-size: 9px;

    font-weight: 800;

    text-transform: uppercase;

    letter-spacing: .06em;

    border-bottom: 1px solid var(--staff-border);

}

.staff-orders-table td {

    padding: 14px 20px;

    border-bottom: 1px solid #F1F5F9;

    color: #475569;

    font-size: 11px;

}

.staff-orders-table tbody tr:last-child td {

    border-bottom: none;

}

.staff-orders-table tbody tr:hover {

    background: #FAFBFC;

}

.order-number {

    color: var(--staff-blue);

    font-size: 10px;

    white-space: nowrap;

}

.customer-cell {

    display: flex;

    align-items: center;

    gap: 9px;

}

.customer-avatar {

    width: 31px;

    height: 31px;

    display: flex;

    align-items: center;

    justify-content: center;

    flex: 0 0 31px;

    border-radius: 50%;

    background: #EFF6FF;

    color: var(--staff-blue);

    font-size: 9px;

    font-weight: 800;

}

.customer-cell strong {

    display: block;

    color: var(--staff-text);

    font-size: 10px;

}

.customer-cell small {

    display: block;

    margin-top: 2px;

    color: var(--staff-light);

    font-size: 9px;

}

.payment-paid {

    display: inline-flex;

    padding: 4px 8px;

    border-radius: 20px;

    background: #ECFDF5;

    color: #059669;

    font-size: 9px;

    font-weight: 800;

}

.order-badge {

    display: inline-flex;

    padding: 5px 9px;

    border-radius: 20px;

    font-size: 9px;

    font-weight: 800;

    white-space: nowrap;

}

.order-badge.pending {

    background: #FFF7ED;

    color: #C2410C;

}

.order-badge.processing {

    background: #EFF6FF;

    color: #1D4ED8;

}

.order-badge.dispatched {

    background: #F5F3FF;

    color: #6D28D9;

}

.order-badge.delivered {

    background: #ECFDF5;

    color: #047857;

}


/* =========================================================
   LOWER GRID
========================================================= */

.staff-lower-grid {

    display: grid;

    grid-template-columns:
        repeat(2, minmax(0, 1fr));

    gap: 20px;

    margin-bottom: 20px;

}


/* =========================================================
   REVIEW MODERATION
========================================================= */

.moderation-summary {

    display: flex;

    align-items: center;

    gap: 14px;

    padding: 22px 20px 15px;

}

.moderation-big-number {

    font-size: 35px;

    line-height: 1;

    font-weight: 800;

    color: var(--staff-orange);

}

.moderation-summary strong {

    display: block;

    color: var(--staff-text);

    font-size: 12px;

}

.moderation-summary span {

    display: block;

    margin-top: 4px;

    color: var(--staff-muted);

    font-size: 10px;

}

.moderation-stats {

    display: grid;

    grid-template-columns: repeat(2, 1fr);

    gap: 10px;

    padding: 0 20px 17px;

}

.moderation-stats > div {

    padding: 12px;

    background: #F8FAFC;

    border-radius: 8px;

}

.moderation-stat-number {

    display: block;

    font-size: 18px;

    font-weight: 800;

}

.moderation-stat-number.approved {
    color: var(--staff-green);
}

.moderation-stat-number.rejected {
    color: var(--staff-red);
}

.moderation-stats > div > span:last-child {

    display: block;

    margin-top: 3px;

    color: var(--staff-muted);

    font-size: 9px;

}

.staff-primary-button {

    display: flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    margin: 0 20px 20px;

    padding: 11px;

    border-radius: 8px;

    background: var(--staff-blue);

    color: #FFFFFF;

    text-decoration: none;

    font-size: 10px;

    font-weight: 800;

    transition: .2s ease;

}

.staff-primary-button:hover {

    background: #1D4ED8;

}


/* =========================================================
   INVENTORY
========================================================= */

.inventory-number {

    padding: 20px 20px 13px;

}

.inventory-number strong {

    display: block;

    font-size: 35px;

    line-height: 1;

}

.inventory-number span {

    display: block;

    margin-top: 5px;

    color: var(--staff-muted);

    font-size: 10px;

}

.inventory-progress {

    padding: 0 20px 18px;

}

.inventory-progress-header {

    display: flex;

    justify-content: space-between;

    margin-bottom: 7px;

    color: var(--staff-muted);

    font-size: 9px;

}

.inventory-progress-header strong {

    color: var(--staff-text);

}

.inventory-progress-track {

    height: 7px;

    overflow: hidden;

    border-radius: 20px;

    background: #E2E8F0;

}

.inventory-progress-track span {

    display: block;

    height: 100%;

    border-radius: inherit;

    background: var(--staff-green);

}

.inventory-mini-grid {

    display: grid;

    grid-template-columns: repeat(2, 1fr);

    gap: 10px;

    padding: 0 20px 20px;

}

.inventory-mini-grid > div {

    display: flex;

    align-items: center;

    gap: 9px;

    padding: 11px;

    border: 1px solid var(--staff-border);

    border-radius: 8px;

}

.inventory-mini-icon {

    width: 28px;

    height: 28px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 7px;

    font-size: 10px;

}

.inventory-mini-icon.available {

    background: #ECFDF5;

    color: var(--staff-green);

}

.inventory-mini-icon.sold {

    background: #FEF2F2;

    color: var(--staff-red);

}

.inventory-mini-grid strong {

    display: block;

    font-size: 13px;

}

.inventory-mini-grid span:not(.inventory-mini-icon) {

    display: block;

    margin-top: 2px;

    color: var(--staff-muted);

    font-size: 8px;

}


/* =========================================================
   ACTIVITY
========================================================= */

.staff-activity-panel {

    margin-bottom: 10px;

}

.staff-activity-list {

    padding: 4px 20px 10px;

}

.staff-activity-item {

    display: flex;

    gap: 12px;

    padding: 15px 0;

    border-bottom: 1px solid #F1F5F9;

}

.staff-activity-item:last-child {

    border-bottom: none;

}

.activity-icon {

    width: 34px;

    height: 34px;

    flex: 0 0 34px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 9px;

    font-size: 11px;

}

.activity-icon.order {

    background: #EFF6FF;

    color: var(--staff-blue);

}

.activity-icon.review {

    background: #FFF7ED;

    color: var(--staff-orange);

}

.activity-icon.dispatch {

    background: #F5F3FF;

    color: var(--staff-purple);

}

.activity-icon.contact {

    background: #ECFDF5;

    color: var(--staff-green);

}

.activity-content {

    flex: 1;

}

.activity-content strong {

    display: block;

    color: var(--staff-text);

    font-size: 11px;

}

.activity-content p {

    margin: 3px 0;

    color: var(--staff-muted);

    font-size: 10px;

    line-height: 1.5;

}

.activity-content span {

    color: var(--staff-light);

    font-size: 8px;

}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 1200px) {

    .staff-stat-grid {

        grid-template-columns:
            repeat(2, minmax(0, 1fr));

    }

}


@media (max-width: 1024px) {

    .zeith-staff-overview {

        margin-left: 0;

        padding: 24px;

    }

    .staff-main-grid {

        grid-template-columns: 1fr;

    }

}


@media (max-width: 800px) {

    .staff-header-content {

        align-items: flex-start;

        flex-direction: column;

    }

    .staff-header-date {

        width: 100%;

        box-sizing: border-box;

    }

    .staff-lower-grid {

        grid-template-columns: 1fr;

    }

}


@media (max-width: 600px) {

    .zeith-staff-overview {

        padding: 18px;

    }

    .staff-stat-grid {

        grid-template-columns: 1fr;

    }

    .staff-header-title h1 {

        font-size: 24px;

    }

    .staff-panel-header {

        padding: 17px;

    }

    .order-status-list {

        padding-left: 17px;

        padding-right: 17px;

    }

    .order-total-box {

        margin-left: 17px;

        margin-right: 17px;

    }

    .staff-actions-list {

        padding-left: 17px;

        padding-right: 17px;

    }

    .moderation-summary {

        padding-left: 17px;

        padding-right: 17px;

    }

    .moderation-stats {

        padding-left: 17px;

        padding-right: 17px;

    }

    .staff-primary-button {

        margin-left: 17px;

        margin-right: 17px;

    }

    .inventory-number,
    .inventory-progress,
    .inventory-mini-grid {

        padding-left: 17px;

        padding-right: 17px;

    }

    .staff-activity-list {

        padding-left: 17px;

        padding-right: 17px;

    }

}

</style>


<script>

/* =========================================================
   CURRENT DATE
========================================================= */

(function () {

    const dateElement =
        document.getElementById("staffCurrentDate");

    if (!dateElement) return;

    const now = new Date();

    dateElement.textContent =
        now.toLocaleDateString(
            "en-US",
            {
                month: "long",
                day: "numeric",
                year: "numeric"
            }
        );

})();

</script>