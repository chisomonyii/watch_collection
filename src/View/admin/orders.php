<?php
// =========================================================
// ADMIN ORDER MANAGEMENT
// views/Admin/order.php
// =========================================================

// ---------------------------------------------------------
// DEMO DATA
// Replace this section with your database query later.
// ---------------------------------------------------------
$orders = $orders ?? [
    [
        'order_number'          => 'ZEITH-6ACD66CA826C',
        'full_name'             => 'Nweze Chibuikem',
        'email'                 => 'chibuikemnweze2020@gmail.com',
        'phone'                 => '09161426400',
        'address'               => '14 Admiralty Way, Lekki Phase 1, Lagos, Nigeria',
        'delivery_instructions' => 'Please call before delivery. Customer prefers evening delivery after 5:00 PM.',
        'subtotal'              => 20000.00,
        'shipping_fee'          => 0.00,
        'total_amount'          => 20000.00,
        'shipping_method_name'  => null,
        'order_status'          => 'Pending Verification',
        'created_at'            => '2026-10-13 11:58:13',
        'payment_status'        => 'Pending Verification',
        'payment_reference'     => null,
        'payment_receipt'       => '/uploads/receipts/225404b7744cc5ae4e2d35d93bd58999.jpg'
    ],

    [
        'order_number'          => 'ZEITH-92FBD8214A77',
        'full_name'             => 'Daniel Eze',
        'email'                 => 'daniel@example.com',
        'phone'                 => '08012345678',
        'address'               => 'Yaba, Lagos, Nigeria',
        'delivery_instructions' => 'Please call customer before delivery.',
        'subtotal'              => 82500.00,
        'shipping_fee'          => 4500.00,
        'total_amount'          => 87000.00,
        'shipping_method_name'  => 'Lagos Mainland 1',
        'order_status'          => 'Processing',
        'created_at'            => '2026-10-12 15:20:10',
        'payment_status'        => 'Paid',
        'payment_reference'     => 'PAY-92FBD8214A77',
        'payment_receipt'       => '/uploads/receipts/payment-92fbd821.jpg'
    ],

    [
        'order_number'          => 'ZEITH-4D8A2F91BC20',
        'full_name'             => 'Amaka Nwosu',
        'email'                 => 'amaka@example.com',
        'phone'                 => '08123456789',
        'address'               => 'Ajah, Lagos, Nigeria',
        'delivery_instructions' => 'Leave with security if customer is unavailable.',
        'subtotal'              => 85000.00,
        'shipping_fee'          => 5000.00,
        'total_amount'          => 90000.00,
        'shipping_method_name'  => 'Lagos Island 2',
        'order_status'          => 'Dispatched',
        'created_at'            => '2026-10-11 09:42:18',
        'payment_status'        => 'Paid',
        'payment_reference'     => 'PAY-4D8A2F91BC20',
        'payment_receipt'       => '/uploads/receipts/payment-4d8a2f.jpg'
    ],

    [
        'order_number'          => 'ZEITH-B72D6E93FA12',
        'full_name'             => 'Michael Okoro',
        'email'                 => 'michael@example.com',
        'phone'                 => '07098765432',
        'address'               => 'Ikoyi, Lagos, Nigeria',
        'delivery_instructions' => 'Customer is available during business hours.',
        'subtotal'              => 72000.00,
        'shipping_fee'          => 4000.00,
        'total_amount'          => 76000.00,
        'shipping_method_name'  => 'Lagos Island 1',
        'order_status'          => 'Delivered',
        'created_at'            => '2026-10-09 13:15:40',
        'payment_status'        => 'Paid',
        'payment_reference'     => 'PAY-B72D6E93FA12',
        'payment_receipt'       => '/uploads/receipts/payment-b72d6e.jpg'
    ]
];


// ---------------------------------------------------------
// HELPERS
// ---------------------------------------------------------
function adminOrderMoney($amount)
{
    return '₦' . number_format((float)$amount, 2);
}

function adminOrderDate($date)
{
    if (empty($date)) {
        return '—';
    }

    $timestamp = strtotime($date);

    if ($timestamp === false) {
        return htmlspecialchars($date, ENT_QUOTES, 'UTF-8');
    }

    return date('M j, Y • g:i A', $timestamp);
}

function adminOrderStatusClass($status)
{
    return match (strtolower(trim($status))) {
        'pending verification' => 'pending',
        'processing'            => 'processing',
        'dispatched'            => 'dispatched',
        'delivered'             => 'delivered',
        'cancelled'             => 'cancelled',
        default                 => 'default'
    };
}


// ---------------------------------------------------------
// STATISTICS
// ---------------------------------------------------------
$totalOrders = count($orders);

$pendingOrders = 0;
$processingOrders = 0;
$dispatchedOrders = 0;
$deliveredOrders = 0;

$totalRevenue = 0;

foreach ($orders as $order) {

    $status = strtolower(trim($order['order_status'] ?? ''));

    if ($status === 'pending verification') {
        $pendingOrders++;
    }

    if ($status === 'processing') {
        $processingOrders++;
    }

    if ($status === 'dispatched') {
        $dispatchedOrders++;
    }

    if ($status === 'delivered') {
        $deliveredOrders++;
    }

    $totalRevenue += (float)($order['total_amount'] ?? 0);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Orders Management | ZEITH Admin</title>

    <style>

        /* =====================================================
           RESET
        ===================================================== */

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            padding: 0;

            background: #F4F6F9;

            color: #0F172A;

            font-family:
                Inter,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                Arial,
                sans-serif;
        }


        /* =====================================================
           PAGE
        ===================================================== */

        .zeith-admin-orders {

            width: calc(100% - 250px);

            margin-left: 250px;

            min-height: 100vh;

            padding: 30px;

            background: #F4F6F9;
        }


        /* =====================================================
           PAGE HEADER
        ===================================================== */

        .orders-page-header {

            display: flex;

            align-items: flex-start;

            justify-content: space-between;

            gap: 20px;

            margin-bottom: 24px;
        }


        .orders-eyebrow {

            display: inline-flex;

            align-items: center;

            gap: 7px;

            margin-bottom: 7px;

            color: #2563EB;

            font-size: 11px;

            font-weight: 800;

            text-transform: uppercase;

            letter-spacing: 1px;
        }


        .orders-eyebrow span {

            width: 6px;

            height: 6px;

            border-radius: 50%;

            background: #2563EB;
        }


        .orders-page-title {

            margin: 0;

            color: #0F172A;

            font-size: 27px;

            font-weight: 800;

            letter-spacing: -.6px;
        }


        .orders-page-description {

            margin: 7px 0 0;

            color: #64748B;

            font-size: 13px;

            line-height: 1.6;
        }


        .orders-refresh {

            display: inline-flex;

            align-items: center;

            gap: 8px;

            height: 38px;

            padding: 0 14px;

            border: 1px solid #E2E8F0;

            border-radius: 8px;

            background: #FFFFFF;

            color: #334155;

            font-size: 12px;

            font-weight: 700;

            cursor: pointer;

            transition: .2s ease;
        }


        .orders-refresh:hover {

            border-color: #2563EB;

            color: #2563EB;

            transform: translateY(-1px);

            box-shadow: 0 5px 15px rgba(15,23,42,.06);
        }


        .orders-refresh svg {

            width: 15px;

            height: 15px;

            fill: none;

            stroke: currentColor;

            stroke-width: 1.8;

            stroke-linecap: round;

            stroke-linejoin: round;
        }


        /* =====================================================
           STAT CARDS
        ===================================================== */

        .orders-stat-grid {

            display: grid;

            grid-template-columns:
                repeat(5, minmax(0, 1fr));

            gap: 14px;

            margin-bottom: 22px;
        }


        .orders-stat-card {

            position: relative;

            overflow: hidden;

            padding: 18px;

            min-height: 112px;

            border: 1px solid #E2E8F0;

            border-radius: 11px;

            background: #FFFFFF;

            box-shadow:
                0 2px 8px rgba(15,23,42,.025);
        }


        .orders-stat-card::after {

            content: "";

            position: absolute;

            right: -20px;

            bottom: -30px;

            width: 85px;

            height: 85px;

            border-radius: 50%;

            background: rgba(37,99,235,.035);
        }


        .orders-stat-top {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 10px;

            margin-bottom: 13px;
        }


        .orders-stat-icon {

            width: 32px;

            height: 32px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 8px;

            background: #EFF6FF;

            color: #2563EB;
        }


        .orders-stat-icon svg {

            width: 16px;

            height: 16px;

            fill: none;

            stroke: currentColor;

            stroke-width: 1.8;

            stroke-linecap: round;

            stroke-linejoin: round;
        }


        .orders-stat-label {

            color: #64748B;

            font-size: 11px;

            font-weight: 700;
        }


        .orders-stat-value {

            color: #0F172A;

            font-size: 21px;

            font-weight: 800;

            letter-spacing: -.4px;
        }


        .orders-stat-revenue .orders-stat-icon {

            background: #ECFDF5;

            color: #10B981;
        }


        .orders-stat-pending .orders-stat-icon {

            background: #FFF7ED;

            color: #F59E0B;
        }


        .orders-stat-processing .orders-stat-icon {

            background: #EFF6FF;

            color: #2563EB;
        }


        .orders-stat-dispatched .orders-stat-icon {

            background: #F5F3FF;

            color: #7C3AED;
        }


        .orders-stat-delivered .orders-stat-icon {

            background: #ECFDF5;

            color: #10B981;
        }


        /* =====================================================
           MAIN WORKSPACE
        ===================================================== */

        .orders-workspace {

            display: grid;

            grid-template-columns:
                minmax(400px, .9fr)
                minmax(600px, 1.5fr);

            gap: 18px;

            align-items: start;
        }


        .orders-panel {

            min-width: 0;

            border: 1px solid #E2E8F0;

            border-radius: 12px;

            background: #FFFFFF;

            box-shadow:
                0 2px 8px rgba(15,23,42,.025);

            overflow: hidden;
        }


        /* =====================================================
           PANEL HEADER
        ===================================================== */

        .orders-panel-header {

            padding: 17px 18px;

            border-bottom: 1px solid #E2E8F0;

            background: #FFFFFF;
        }


        .orders-panel-heading {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 15px;
        }


        .orders-panel-title {

            margin: 0;

            color: #0F172A;

            font-size: 14px;

            font-weight: 800;
        }


        .orders-panel-subtitle {

            margin: 4px 0 0;

            color: #64748B;

            font-size: 11px;
        }


        .orders-count {

            min-width: 27px;

            height: 25px;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            padding: 0 8px;

            border-radius: 6px;

            background: #EFF6FF;

            color: #2563EB;

            font-size: 11px;

            font-weight: 800;
        }


        /* =====================================================
           TOOLBAR
        ===================================================== */

        .orders-toolbar {

            display: flex;

            align-items: center;

            gap: 8px;

            padding: 12px 18px;

            border-bottom: 1px solid #E2E8F0;

            background: #F8FAFC;
        }


        .orders-search {

            position: relative;

            flex: 1;
        }


        .orders-search svg {

            position: absolute;

            left: 11px;

            top: 50%;

            width: 14px;

            height: 14px;

            transform: translateY(-50%);

            fill: none;

            stroke: #94A3B8;

            stroke-width: 1.8;

            stroke-linecap: round;

            stroke-linejoin: round;

            pointer-events: none;
        }


        .orders-search input {

            width: 100%;

            height: 34px;

            padding: 0 10px 0 32px;

            border: 1px solid #E2E8F0;

            border-radius: 7px;

            outline: none;

            background: #FFFFFF;

            color: #0F172A;

            font-size: 11px;
        }


        .orders-search input:focus {

            border-color: #2563EB;

            box-shadow: 0 0 0 3px rgba(37,99,235,.08);
        }


        .orders-filter {

            height: 34px;

            padding: 0 9px;

            border: 1px solid #E2E8F0;

            border-radius: 7px;

            outline: none;

            background: #FFFFFF;

            color: #334155;

            font-size: 11px;

            cursor: pointer;
        }


        /* =====================================================
           ORDER LIST
        ===================================================== */

        .orders-list {

            max-height: 640px;

            overflow-y: auto;
        }


        .orders-list::-webkit-scrollbar {

            width: 5px;
        }


        .orders-list::-webkit-scrollbar-thumb {

            border-radius: 10px;

            background: #CBD5E1;
        }


        .order-list-item {

            width: 100%;

            display: block;

            padding: 16px 18px;

            border: 0;

            border-bottom: 1px solid #E2E8F0;

            background: #FFFFFF;

            text-align: left;

            cursor: pointer;

            transition: .18s ease;
        }


        .order-list-item:hover {

            background: #F8FAFC;
        }


        .order-list-item.active {

            background: #EFF6FF;

            box-shadow:
                inset 3px 0 0 #2563EB;
        }


        .order-list-top {

            display: flex;

            align-items: flex-start;

            justify-content: space-between;

            gap: 15px;
        }


        .order-number {

            display: block;

            color: #0F172A;

            font-size: 11px;

            font-weight: 800;

            letter-spacing: .15px;
        }


        .order-customer {

            display: block;

            margin-top: 4px;

            color: #334155;

            font-size: 12px;

            font-weight: 700;
        }


        .order-email {

            display: block;

            margin-top: 3px;

            color: #94A3B8;

            font-size: 10px;

            white-space: nowrap;

            overflow: hidden;

            text-overflow: ellipsis;

            max-width: 280px;
        }


        .order-list-right {

            text-align: right;

            flex-shrink: 0;
        }


        .order-amount {

            display: block;

            color: #0F172A;

            font-size: 12px;

            font-weight: 800;
        }


        .order-date {

            display: block;

            margin-top: 5px;

            color: #94A3B8;

            font-size: 9px;
        }


        .status-badge {

            display: inline-flex;

            align-items: center;

            gap: 5px;

            margin-top: 7px;

            padding: 4px 7px;

            border-radius: 5px;

            font-size: 9px;

            font-weight: 800;

            white-space: nowrap;
        }


        .status-badge::before {

            content: "";

            width: 5px;

            height: 5px;

            border-radius: 50%;

            background: currentColor;
        }


        .status-badge.pending {

            background: #FFF7ED;

            color: #D97706;
        }


        .status-badge.processing {

            background: #EFF6FF;

            color: #2563EB;
        }


        .status-badge.dispatched {

            background: #F5F3FF;

            color: #7C3AED;
        }


        .status-badge.delivered {

            background: #ECFDF5;

            color: #059669;
        }


        .status-badge.cancelled {

            background: #FEF2F2;

            color: #DC2626;
        }


        .status-badge.default {

            background: #F1F5F9;

            color: #64748B;
        }


        /* =====================================================
           DETAILS PANEL
        ===================================================== */

        .order-details {

            min-height: 600px;
        }


        .order-details-empty {

            min-height: 600px;

            display: flex;

            align-items: center;

            justify-content: center;

            flex-direction: column;

            text-align: center;

            padding: 40px;

            color: #94A3B8;
        }


        .order-details-empty-icon {

            width: 48px;

            height: 48px;

            display: flex;

            align-items: center;

            justify-content: center;

            margin-bottom: 12px;

            border-radius: 50%;

            background: #F1F5F9;

            color: #94A3B8;
        }


        .order-details-empty-icon svg {

            width: 21px;

            height: 21px;

            fill: none;

            stroke: currentColor;

            stroke-width: 1.6;
        }


        .order-details-empty strong {

            color: #334155;

            font-size: 13px;
        }


        .order-details-empty span {

            margin-top: 5px;

            font-size: 11px;
        }


        .detail-header {

            padding: 18px;

            border-bottom: 1px solid #E2E8F0;
        }


        .detail-header-top {

            display: flex;

            align-items: flex-start;

            justify-content: space-between;

            gap: 15px;
        }


        .detail-label {

            margin: 0 0 5px;

            color: #94A3B8;

            font-size: 9px;

            font-weight: 800;

            letter-spacing: .8px;

            text-transform: uppercase;
        }


        .detail-order-number {

            margin: 0;

            color: #0F172A;

            font-size: 16px;

            font-weight: 900;

            letter-spacing: -.2px;
        }


        .detail-date {

            margin: 5px 0 0;

            color: #64748B;

            font-size: 10px;
        }


        /* =====================================================
           DETAIL SECTIONS
        ===================================================== */

        .detail-section {

            padding: 17px 18px;

            border-bottom: 1px solid #E2E8F0;
        }


        .detail-section-title {

            display: flex;

            align-items: center;

            gap: 7px;

            margin: 0 0 13px;

            color: #0F172A;

            font-size: 11px;

            font-weight: 800;
        }


        .detail-section-title svg {

            width: 14px;

            height: 14px;

            fill: none;

            stroke: #2563EB;

            stroke-width: 1.7;

            stroke-linecap: round;

            stroke-linejoin: round;
        }


        /* =====================================================
           CUSTOMER GRID
        ===================================================== */

        .customer-grid {

            display: grid;

            grid-template-columns:
                repeat(3, minmax(0, 1fr));

            gap: 13px;
        }


        .detail-field {

            min-width: 0;
        }


        .detail-field-label {

            display: block;

            margin-bottom: 4px;

            color: #94A3B8;

            font-size: 9px;

            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: .35px;
        }


        .detail-field-value {

            color: #334155;

            font-size: 11px;

            line-height: 1.5;

            word-break: break-word;
        }


        .detail-field-value.strong {

            color: #0F172A;

            font-weight: 700;
        }


        /* =====================================================
           ADDRESS
        ===================================================== */

        .address-box {

            padding: 12px;

            border: 1px solid #E2E8F0;

            border-radius: 8px;

            background: #F8FAFC;
        }


        .address-box p {

            margin: 0;

            color: #475569;

            font-size: 11px;

            line-height: 1.6;
        }


        .instruction-box {

            margin-top: 9px;

            padding: 11px 12px;

            border-left: 3px solid #2563EB;

            border-radius: 0 7px 7px 0;

            background: #EFF6FF;
        }


        .instruction-box strong {

            display: block;

            margin-bottom: 3px;

            color: #1E40AF;

            font-size: 9px;

            text-transform: uppercase;
        }


        .instruction-box span {

            color: #475569;

            font-size: 10px;

            line-height: 1.5;
        }


        /* =====================================================
           PAYMENT
        ===================================================== */

        .payment-grid {

            display: grid;

            grid-template-columns:
                repeat(3, minmax(0, 1fr));

            gap: 13px;
        }


        .payment-value {

            color: #334155;

            font-size: 11px;

            font-weight: 700;

            word-break: break-word;
        }


        .payment-paid {

            color: #059669;
        }


        .payment-pending {

            color: #D97706;
        }


        .payment-failed {

            color: #DC2626;
        }


        .receipt-button {

            display: inline-flex;

            align-items: center;

            gap: 6px;

            height: 30px;

            padding: 0 9px;

            border: 1px solid #BFDBFE;

            border-radius: 6px;

            background: #EFF6FF;

            color: #2563EB;

            font-size: 9px;

            font-weight: 800;

            cursor: pointer;

            transition: .2s ease;
        }


        .receipt-button:hover {

            background: #DBEAFE;

            border-color: #93C5FD;
        }


        .receipt-button svg {

            width: 13px;

            height: 13px;

            fill: none;

            stroke: currentColor;

            stroke-width: 1.7;

            stroke-linecap: round;

            stroke-linejoin: round;
        }


        /* =====================================================
           ORDER SUMMARY
        ===================================================== */

        .summary-rows {

            display: flex;

            flex-direction: column;

            gap: 9px;
        }


        .summary-row {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 20px;

            color: #64748B;

            font-size: 10px;
        }


        .summary-row strong {

            color: #334155;

            font-size: 11px;
        }


        .summary-total {

            display: flex;

            align-items: center;

            justify-content: space-between;

            margin-top: 11px;

            padding-top: 12px;

            border-top: 1px solid #E2E8F0;
        }


        .summary-total span {

            color: #0F172A;

            font-size: 11px;

            font-weight: 800;
        }


        .summary-total strong {

            color: #2563EB;

            font-size: 17px;

            font-weight: 900;
        }


        /* =====================================================
           ADMIN CONTROL
        ===================================================== */

        .admin-control {

            padding: 17px 18px;

            background: #F8FAFC;

            border-bottom: 1px solid #E2E8F0;
        }


        .control-grid {

            display: grid;

            grid-template-columns:
                1fr auto;

            gap: 10px;
        }


        .control-select {

            width: 100%;

            height: 38px;

            padding: 0 11px;

            border: 1px solid #CBD5E1;

            border-radius: 7px;

            outline: none;

            background: #FFFFFF;

            color: #334155;

            font-size: 11px;

            font-weight: 600;
        }


        .control-select:focus {

            border-color: #2563EB;

            box-shadow:
                0 0 0 3px rgba(37,99,235,.08);
        }


        .update-button {

            height: 38px;

            padding: 0 16px;

            border: 1px solid #2563EB;

            border-radius: 7px;

            background: #2563EB;

            color: #FFFFFF;

            font-size: 10px;

            font-weight: 800;

            cursor: pointer;

            transition: .2s ease;
        }


        .update-button:hover {

            background: #1D4ED8;

            transform: translateY(-1px);

            box-shadow:
                0 5px 14px rgba(37,99,235,.18);
        }


        .admin-danger-zone {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 15px;

            padding: 14px 18px;

            background: #FFFFFF;
        }


        .danger-description strong {

            display: block;

            color: #334155;

            font-size: 10px;
        }


        .danger-description span {

            display: block;

            margin-top: 3px;

            color: #94A3B8;

            font-size: 9px;
        }


        .delete-order-button {

            flex-shrink: 0;

            height: 33px;

            padding: 0 12px;

            border: 1px solid #FECACA;

            border-radius: 7px;

            background: #FEF2F2;

            color: #DC2626;

            font-size: 10px;

            font-weight: 800;

            cursor: pointer;

            transition: .2s ease;
        }


        .delete-order-button:hover {

            background: #FEE2E2;

            border-color: #FCA5A5;
        }


        /* =====================================================
           RECEIPT MODAL
        ===================================================== */

        .receipt-modal {

            position: fixed;

            inset: 0;

            z-index: 9999;

            display: none;

            align-items: center;

            justify-content: center;

            padding: 25px;

            background: rgba(15,23,42,.60);

            backdrop-filter: blur(4px);
        }


        .receipt-modal.is-open {

            display: flex;
        }


        .receipt-modal-card {

            width: 100%;

            max-width: 760px;

            max-height: 90vh;

            overflow: hidden;

            border-radius: 14px;

            background: #FFFFFF;

            box-shadow:
                0 25px 70px rgba(15,23,42,.25);
        }


        .receipt-modal-header {

            display: flex;

            align-items: center;

            justify-content: space-between;

            padding: 16px 18px;

            border-bottom: 1px solid #E2E8F0;
        }


        .receipt-modal-header h3 {

            margin: 0;

            color: #0F172A;

            font-size: 14px;
        }


        .receipt-modal-close {

            width: 31px;

            height: 31px;

            display: flex;

            align-items: center;

            justify-content: center;

            border: 0;

            border-radius: 7px;

            background: #F1F5F9;

            color: #64748B;

            cursor: pointer;
        }


        .receipt-modal-close:hover {

            background: #E2E8F0;

            color: #0F172A;
        }


        .receipt-modal-close svg {

            width: 16px;

            height: 16px;

            fill: none;

            stroke: currentColor;

            stroke-width: 1.8;

        }


        .receipt-modal-body {

            max-height: calc(90vh - 70px);

            overflow: auto;

            padding: 20px;

            text-align: center;

            background: #F8FAFC;
        }


        .receipt-image {

            max-width: 100%;

            height: auto;

            border-radius: 8px;

            border: 1px solid #E2E8F0;

            background: #FFFFFF;
        }


        .receipt-empty {

            padding: 60px 20px;

            color: #94A3B8;

            font-size: 12px;
        }


        /* =====================================================
           DELETE MODAL
        ===================================================== */

        .delete-modal {

            position: fixed;

            inset: 0;

            z-index: 10000;

            display: none;

            align-items: center;

            justify-content: center;

            padding: 20px;

            background: rgba(15,23,42,.55);

            backdrop-filter: blur(3px);
        }


        .delete-modal.is-open {

            display: flex;
        }


        .delete-modal-card {

            width: 100%;

            max-width: 410px;

            padding: 25px;

            border-radius: 13px;

            background: #FFFFFF;

            box-shadow:
                0 25px 70px rgba(15,23,42,.20);

            text-align: center;
        }


        .delete-icon {

            width: 48px;

            height: 48px;

            display: flex;

            align-items: center;

            justify-content: center;

            margin: 0 auto 15px;

            border-radius: 50%;

            background: #FEF2F2;

            color: #DC2626;
        }


        .delete-icon svg {

            width: 21px;

            height: 21px;

            fill: none;

            stroke: currentColor;

            stroke-width: 1.7;

            stroke-linecap: round;

            stroke-linejoin: round;
        }


        .delete-modal-card h3 {

            margin: 0;

            color: #0F172A;

            font-size: 17px;
        }


        .delete-modal-card p {

            margin: 8px 0 20px;

            color: #64748B;

            font-size: 11px;

            line-height: 1.6;
        }


        .delete-actions {

            display: flex;

            justify-content: center;

            gap: 8px;
        }


        .delete-cancel,
        .delete-confirm {

            height: 38px;

            padding: 0 17px;

            border-radius: 7px;

            font-size: 10px;

            font-weight: 800;

            cursor: pointer;
        }


        .delete-cancel {

            border: 1px solid #E2E8F0;

            background: #FFFFFF;

            color: #475569;
        }


        .delete-confirm {

            border: 1px solid #DC2626;

            background: #DC2626;

            color: #FFFFFF;
        }


        /* =====================================================
           TOAST
        ===================================================== */

        .admin-toast {

            position: fixed;

            right: 25px;

            bottom: 25px;

            z-index: 11000;

            min-width: 270px;

            padding: 13px 15px;

            border: 1px solid #E2E8F0;

            border-radius: 9px;

            background: #FFFFFF;

            color: #334155;

            font-size: 11px;

            font-weight: 700;

            box-shadow:
                0 12px 30px rgba(15,23,42,.12);

            transform: translateY(20px);

            opacity: 0;

            pointer-events: none;

            transition: .25s ease;
        }


        .admin-toast.show {

            transform: translateY(0);

            opacity: 1;
        }


        /* =====================================================
           NO RESULTS
        ===================================================== */

        .no-orders {

            padding: 45px 20px;

            text-align: center;

            color: #94A3B8;

            font-size: 11px;
        }


        /* =====================================================
           TABLET
        ===================================================== */

        @media (max-width: 1200px) {

            .zeith-admin-orders {

                padding: 25px;
            }

            .orders-stat-grid {

                grid-template-columns:
                    repeat(3, minmax(0, 1fr));
            }

            .orders-workspace {

                grid-template-columns: 1fr;
            }

            .order-details {

                min-height: auto;
            }

            .order-details-empty {

                min-height: 400px;
            }

        }


        /* =====================================================
           TABLET / IPAD
        ===================================================== */

        @media (max-width: 1024px) {

            .zeith-admin-orders {

                width: 100%;

                margin-left: 0;

                padding: 25px 20px 40px;
            }

            .orders-stat-grid {

                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }

        }


        /* =====================================================
           MOBILE
        ===================================================== */

        @media (max-width: 650px) {

            .zeith-admin-orders {

                padding: 20px 14px 35px;
            }

            .orders-page-header {

                flex-direction: column;
            }

            .orders-refresh {

                width: 100%;

                justify-content: center;
            }

            .orders-page-title {

                font-size: 23px;
            }

            .orders-stat-grid {

                grid-template-columns: 1fr;
            }

            .orders-toolbar {

                flex-direction: column;

                align-items: stretch;
            }

            .orders-search {

                width: 100%;
            }

            .orders-filter {

                width: 100%;
            }

            .customer-grid,
            .payment-grid {

                grid-template-columns: 1fr;
            }

            .detail-header-top {

                flex-direction: column;
            }

            .control-grid {

                grid-template-columns: 1fr;
            }

            .update-button {

                width: 100%;
            }

            .admin-danger-zone {

                align-items: stretch;

                flex-direction: column;
            }

            .delete-order-button {

                width: 100%;
            }

        }


        /* =====================================================
           SMALL MOBILE
        ===================================================== */

        @media (max-width: 400px) {

            .orders-page-title {

                font-size: 21px;
            }

            .order-list-top {

                flex-direction: column;
            }

            .order-list-right {

                width: 100%;

                text-align: left;
            }

        }

    </style>

</head>


<body>


<?php
// =========================================================
// ADMIN SIDEBAR
// Keep your existing admin sidebar.
// Change this path if your sidebar lives elsewhere.
// =========================================================
?>

<?php
/*
\App\Helpers\View::displayComponent("Admin/sidebar.php");
*/
?>


<!-- =====================================================
     ADMIN ORDER PAGE
====================================================== -->

<main class="zeith-admin-orders">


    <!-- =================================================
         PAGE HEADER
    ================================================== -->

    <header class="orders-page-header">

        <div>

            <div class="orders-eyebrow">
                <span></span>
                ZEITH ADMINISTRATION
            </div>

            <h1 class="orders-page-title">
                Orders Management
            </h1>

            <p class="orders-page-description">
                View, manage, verify and control every customer order.
            </p>

        </div>


        <button
            type="button"
            class="orders-refresh"
            onclick="refreshOrders()"
        >

            <svg viewBox="0 0 24 24">

                <path d="M20 11a8.1 8.1 0 0 0-14.8-4.5"></path>

                <path d="M4 5v4h4"></path>

                <path d="M4 13a8.1 8.1 0 0 0 14.8 4.5"></path>

                <path d="M20 19v-4h-4"></path>

            </svg>

            Refresh

        </button>

    </header>


    <!-- =================================================
         STATISTICS
    ================================================== -->

    <section class="orders-stat-grid">


        <!-- TOTAL -->

        <article class="orders-stat-card">

            <div class="orders-stat-top">

                <div class="orders-stat-icon">

                    <svg viewBox="0 0 24 24">

                        <rect x="4" y="4" width="16" height="16" rx="2"></rect>

                        <path d="M8 9h8"></path>

                        <path d="M8 13h5"></path>

                    </svg>

                </div>

                <span class="orders-stat-label">
                    Total Orders
                </span>

            </div>

            <div class="orders-stat-value">
                <?= $totalOrders ?>
            </div>

        </article>


        <!-- REVENUE -->

        <article class="orders-stat-card orders-stat-revenue">

            <div class="orders-stat-top">

                <div class="orders-stat-icon">

                    <svg viewBox="0 0 24 24">

                        <path d="M12 3v18"></path>

                        <path d="M17 7.5c0-1.7-2.2-3-5-3s-5 1.3-5 3 2.2 3 5 3 5 1.3 5 3-2.2 3-5 3-5-1.3-5-3"></path>

                    </svg>

                </div>

                <span class="orders-stat-label">
                    Order Value
                </span>

            </div>

            <div class="orders-stat-value">
                <?= adminOrderMoney($totalRevenue) ?>
            </div>

        </article>


        <!-- PENDING -->

        <article class="orders-stat-card orders-stat-pending">

            <div class="orders-stat-top">

                <div class="orders-stat-icon">

                    <svg viewBox="0 0 24 24">

                        <circle cx="12" cy="12" r="8"></circle>

                        <path d="M12 8v4l2.5 2"></path>

                    </svg>

                </div>

                <span class="orders-stat-label">
                    Pending Verification
                </span>

            </div>

            <div class="orders-stat-value">
                <?= $pendingOrders ?>
            </div>

        </article>


        <!-- PROCESSING -->

        <article class="orders-stat-card orders-stat-processing">

            <div class="orders-stat-top">

                <div class="orders-stat-icon">

                    <svg viewBox="0 0 24 24">

                        <path d="M5 12h14"></path>

                        <path d="m13 6 6 6-6 6"></path>

                    </svg>

                </div>

                <span class="orders-stat-label">
                    Processing
                </span>

            </div>

            <div class="orders-stat-value">
                <?= $processingOrders ?>
            </div>

        </article>


        <!-- DELIVERED -->

        <article class="orders-stat-card orders-stat-delivered">

            <div class="orders-stat-top">

                <div class="orders-stat-icon">

                    <svg viewBox="0 0 24 24">

                        <path d="m5 12 4 4L19 6"></path>

                    </svg>

                </div>

                <span class="orders-stat-label">
                    Delivered
                </span>

            </div>

            <div class="orders-stat-value">
                <?= $deliveredOrders ?>
            </div>

        </article>

    </section>


    <!-- =================================================
         WORKSPACE
    ================================================== -->

    <section class="orders-workspace">


        <!-- =================================================
             LEFT: ORDER LIST
        ================================================== -->

        <article class="orders-panel">


            <div class="orders-panel-header">

                <div class="orders-panel-heading">

                    <div>

                        <h2 class="orders-panel-title">
                            Customer Orders
                        </h2>

                        <p class="orders-panel-subtitle">
                            Select an order to view its complete information.
                        </p>

                    </div>

                    <span class="orders-count">
                        <?= $totalOrders ?>
                    </span>

                </div>

            </div>


            <!-- TOOLBAR -->

            <div class="orders-toolbar">


                <div class="orders-search">

                    <svg viewBox="0 0 24 24">

                        <circle cx="11" cy="11" r="6"></circle>

                        <path d="m16 16 4 4"></path>

                    </svg>

                    <input
                        type="search"
                        id="orderSearch"
                        placeholder="Search order, customer or email..."
                        oninput="filterOrders()"
                    >

                </div>


                <select
                    id="orderStatusFilter"
                    class="orders-filter"
                    onchange="filterOrders()"
                >

                    <option value="all">
                        All Status
                    </option>

                    <option value="Pending Verification">
                        Pending Verification
                    </option>

                    <option value="Processing">
                        Processing
                    </option>

                    <option value="Dispatched">
                        Dispatched
                    </option>

                    <option value="Delivered">
                        Delivered
                    </option>

                    <option value="Cancelled">
                        Cancelled
                    </option>

                </select>

            </div>


            <!-- ORDER LIST -->

            <div
                class="orders-list"
                id="ordersList"
            >

                <?php if (!empty($orders)): ?>

                    <?php foreach ($orders as $index => $order): ?>

                        <?php

                        $status =
                            $order['order_status']
                            ?? 'Pending Verification';

                        $statusClass =
                            adminOrderStatusClass($status);

                        ?>

                        <button
                            type="button"
                            class="order-list-item <?= $index === 0 ? 'active' : '' ?>"
                            data-order-index="<?= $index ?>"
                            data-status="<?= htmlspecialchars($status, ENT_QUOTES, 'UTF-8') ?>"
                            data-search="<?= htmlspecialchars(
                                strtolower(
                                    ($order['order_number'] ?? '') . ' ' .
                                    ($order['full_name'] ?? '') . ' ' .
                                    ($order['email'] ?? '')
                                ),
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>"
                            onclick="selectOrder(<?= $index ?>)"
                        >

                            <div class="order-list-top">


                                <div>

                                    <span class="order-number">
                                        <?= htmlspecialchars(
                                            $order['order_number'] ?? '—',
                                            ENT_QUOTES,
                                            'UTF-8'
                                        ) ?>
                                    </span>

                                    <span class="order-customer">
                                        <?= htmlspecialchars(
                                            $order['full_name'] ?? 'Unknown Customer',
                                            ENT_QUOTES,
                                            'UTF-8'
                                        ) ?>
                                    </span>

                                    <span class="order-email">
                                        <?= htmlspecialchars(
                                            $order['email'] ?? '—',
                                            ENT_QUOTES,
                                            'UTF-8'
                                        ) ?>
                                    </span>

                                </div>


                                <div class="order-list-right">

                                    <span class="order-amount">
                                        <?= adminOrderMoney(
                                            $order['total_amount'] ?? 0
                                        ) ?>
                                    </span>

                                    <span class="order-date">
                                        <?= adminOrderDate(
                                            $order['created_at'] ?? ''
                                        ) ?>
                                    </span>

                                    <span
                                        class="status-badge <?= $statusClass ?>"
                                    >
                                        <?= htmlspecialchars(
                                            $status,
                                            ENT_QUOTES,
                                            'UTF-8'
                                        ) ?>
                                    </span>

                                </div>

                            </div>

                        </button>

                    <?php endforeach; ?>

                <?php else: ?>

                    <div class="no-orders">
                        No orders found.
                    </div>

                <?php endif; ?>

            </div>

        </article>


        <!-- =================================================
             RIGHT: ORDER DETAILS
        ================================================== -->

        <article class="orders-panel order-details">

            <div id="orderDetailsContent">

                <!-- JS fills this area -->

            </div>

        </article>

    </section>

</main>


<!-- =====================================================
     RECEIPT MODAL
====================================================== -->

<div
    class="receipt-modal"
    id="receiptModal"
    onclick="closeReceiptOutside(event)"
>

    <div class="receipt-modal-card">


        <div class="receipt-modal-header">

            <h3>
                Payment Receipt
            </h3>


            <button
                type="button"
                class="receipt-modal-close"
                onclick="closeReceipt()"
                aria-label="Close"
            >

                <svg viewBox="0 0 24 24">

                    <path d="M6 6l12 12"></path>

                    <path d="M18 6 6 18"></path>

                </svg>

            </button>

        </div>


        <div
            class="receipt-modal-body"
            id="receiptModalBody"
        >

        </div>

    </div>

</div>


<!-- =====================================================
     DELETE MODAL
====================================================== -->

<div
    class="delete-modal"
    id="deleteModal"
>

    <div class="delete-modal-card">


        <div class="delete-icon">

            <svg viewBox="0 0 24 24">

                <path d="M4 7h16"></path>

                <path d="M10 11v6"></path>

                <path d="M14 11v6"></path>

                <path d="M6 7l1 13h10l1-13"></path>

                <path d="M9 7V4h6v3"></path>

            </svg>

        </div>


        <h3>
            Delete this order?
        </h3>


        <p>
            This action permanently removes the order record.
            Make sure you have reviewed the order before continuing.
        </p>


        <div class="delete-actions">

            <button
                type="button"
                class="delete-cancel"
                onclick="closeDeleteModal()"
            >
                Cancel
            </button>


            <button
                type="button"
                class="delete-confirm"
                onclick="confirmDeleteOrder()"
            >
                Delete Order
            </button>

        </div>

    </div>

</div>


<!-- =====================================================
     TOAST
====================================================== -->

<div
    class="admin-toast"
    id="adminToast"
></div>


<script>

/* =========================================================
   ORDER DATA
========================================================= */

const zeithOrders =
    <?= json_encode(
        $orders,
        JSON_HEX_TAG |
        JSON_HEX_APOS |
        JSON_HEX_AMP |
        JSON_HEX_QUOT
    ) ?>;


/* =========================================================
   CURRENT ORDER
========================================================= */

let currentOrderIndex = 0;

let orderToDelete = null;


/* =========================================================
   ESCAPE HTML
========================================================= */

function escapeHtml(value) {

    if (value === null || value === undefined) {
        return "—";
    }

    return String(value)
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}


/* =========================================================
   MONEY
========================================================= */

function formatMoney(value) {

    const number =
        Number(value || 0);

    return "₦" +
        number.toLocaleString(
            "en-NG",
            {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }
        );
}


/* =========================================================
   DATE
========================================================= */

function formatDate(value) {

    if (!value) {
        return "—";
    }

    const date =
        new Date(
            String(value).replace(" ", "T")
        );

    if (Number.isNaN(date.getTime())) {
        return escapeHtml(value);
    }

    return date.toLocaleDateString(
        "en-NG",
        {
            day: "numeric",
            month: "short",
            year: "numeric"
        }
    ) +
    " • " +
    date.toLocaleTimeString(
        "en-NG",
        {
            hour: "numeric",
            minute: "2-digit"
        }
    );
}


/* =========================================================
   PAYMENT STATUS CLASS
========================================================= */

function paymentClass(status) {

    const value =
        String(status || "").toLowerCase();

    if (
        value.includes("paid") ||
        value.includes("verified")
    ) {
        return "payment-paid";
    }

    if (
        value.includes("pending")
    ) {
        return "payment-pending";
    }

    if (
        value.includes("failed") ||
        value.includes("cancel")
    ) {
        return "payment-failed";
    }

    return "";
}


/* =========================================================
   SELECT ORDER
========================================================= */

function selectOrder(index) {

    currentOrderIndex = index;

    const order =
        zeithOrders[index];

    if (!order) {
        return;
    }


    document
        .querySelectorAll(".order-list-item")
        .forEach(item => {

            item.classList.remove("active");

        });


    const selected =
        document.querySelector(
            `.order-list-item[data-order-index="${index}"]`
        );


    if (selected) {
        selected.classList.add("active");
    }


    renderOrderDetails(order);
}


/* =========================================================
   RENDER DETAILS
========================================================= */

function renderOrderDetails(order) {

    const container =
        document.getElementById(
            "orderDetailsContent"
        );


    const paymentStatus =
        order.payment_status || "Pending";


    const status =
        order.order_status ||
        "Pending Verification";


    const receipt =
        order.payment_receipt || "";


    const receiptButton =
        receipt
            ? `
                <button
                    type="button"
                    class="receipt-button"
                    onclick="openReceipt('${escapeHtml(receipt)}')"
                >
                    <svg viewBox="0 0 24 24">
                        <rect
                            x="3"
                            y="4"
                            width="18"
                            height="16"
                            rx="2"
                        ></rect>
                        <path d="M8 8h8"></path>
                        <path d="M8 12h5"></path>
                    </svg>
                    View Receipt
                </button>
            `
            : `
                <span class="payment-value">
                    No receipt uploaded
                </span>
            `;


    container.innerHTML = `

        <!-- DETAIL HEADER -->

        <div class="detail-header">

            <div class="detail-header-top">

                <div>

                    <p class="detail-label">
                        Order Details
                    </p>

                    <h2 class="detail-order-number">
                        ${escapeHtml(order.order_number)}
                    </h2>

                    <p class="detail-date">
                        Placed ${formatDate(order.created_at)}
                    </p>

                </div>

                <span class="status-badge ${getStatusClass(status)}">
                    ${escapeHtml(status)}
                </span>

            </div>

        </div>


        <!-- CUSTOMER INFORMATION -->

        <section class="detail-section">

            <h3 class="detail-section-title">

                <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="8" r="3"></circle>
                    <path d="M5 20c.8-3.4 3.2-5 7-5s6.2 1.6 7 5"></path>
                </svg>

                Customer Information

            </h3>


            <div class="customer-grid">


                <div class="detail-field">

                    <span class="detail-field-label">
                        Full Name
                    </span>

                    <span class="detail-field-value strong">
                        ${escapeHtml(order.full_name)}
                    </span>

                </div>


                <div class="detail-field">

                    <span class="detail-field-label">
                        Email
                    </span>

                    <span class="detail-field-value">
                        ${escapeHtml(order.email)}
                    </span>

                </div>


                <div class="detail-field">

                    <span class="detail-field-label">
                        Phone
                    </span>

                    <span class="detail-field-value">
                        ${escapeHtml(order.phone)}
                    </span>

                </div>

            </div>

        </section>


        <!-- DELIVERY -->

        <section class="detail-section">

            <h3 class="detail-section-title">

                <svg viewBox="0 0 24 24">
                    <path d="M3 7h11v10H3z"></path>
                    <path d="M14 10h4l3 3v4h-7z"></path>
                    <circle cx="7" cy="19" r="1.5"></circle>
                    <circle cx="18" cy="19" r="1.5"></circle>
                </svg>

                Delivery Information

            </h3>


            <div class="address-box">

                <p>
                    ${escapeHtml(order.address || "No delivery address provided.")}
                </p>

            </div>


            ${
                order.delivery_instructions
                ? `
                    <div class="instruction-box">

                        <strong>
                            Delivery Instructions
                        </strong>

                        <span>
                            ${escapeHtml(order.delivery_instructions)}
                        </span>

                    </div>
                `
                : ""
            }

        </section>


        <!-- PAYMENT -->

        <section class="detail-section">

            <h3 class="detail-section-title">

                <svg viewBox="0 0 24 24">
                    <rect
                        x="3"
                        y="5"
                        width="18"
                        height="14"
                        rx="2"
                    ></rect>
                    <path d="M3 10h18"></path>
                </svg>

                Payment Information

            </h3>


            <div class="payment-grid">


                <div class="detail-field">

                    <span class="detail-field-label">
                        Payment Status
                    </span>

                    <span class="payment-value ${paymentClass(paymentStatus)}">
                        ${escapeHtml(paymentStatus)}
                    </span>

                </div>


                <div class="detail-field">

                    <span class="detail-field-label">
                        Payment Reference
                    </span>

                    <span class="payment-value">
                        ${escapeHtml(order.payment_reference || "NULL")}
                    </span>

                </div>


                <div class="detail-field">

                    <span class="detail-field-label">
                        Payment Receipt
                    </span>

                    ${receiptButton}

                </div>

            </div>

        </section>


        <!-- ORDER SUMMARY -->

        <section class="detail-section">

            <h3 class="detail-section-title">

                <svg viewBox="0 0 24 24">
                    <path d="M6 3h12v18H6z"></path>
                    <path d="M9 7h6"></path>
                    <path d="M9 11h6"></path>
                    <path d="M9 15h4"></path>
                </svg>

                Order Summary

            </h3>


            <div class="summary-rows">


                <div class="summary-row">

                    <span>
                        Subtotal
                    </span>

                    <strong>
                        ${formatMoney(order.subtotal)}
                    </strong>

                </div>


                <div class="summary-row">

                    <span>
                        Shipping Fee
                    </span>

                    <strong>
                        ${formatMoney(order.shipping_fee)}
                    </strong>

                </div>


                <div class="summary-row">

                    <span>
                        Shipping Method
                    </span>

                    <strong>
                        ${escapeHtml(
                            order.shipping_method_name || "NULL"
                        )}
                    </strong>

                </div>


                <div class="summary-total">

                    <span>
                        Total Amount
                    </span>

                    <strong>
                        ${formatMoney(order.total_amount)}
                    </strong>

                </div>

            </div>

        </section>


        <!-- ADMIN CONTROL -->

        <section class="admin-control">

            <p class="detail-label">
                Admin Control
            </p>


            <div class="control-grid">

                <select
                    class="control-select"
                    id="orderStatusControl"
                >

                    <option
                        value="Pending Verification"
                        ${status === "Pending Verification" ? "selected" : ""}
                    >
                        Pending Verification
                    </option>

                    <option
                        value="Processing"
                        ${status === "Processing" ? "selected" : ""}
                    >
                        Processing
                    </option>

                    <option
                        value="Dispatched"
                        ${status === "Dispatched" ? "selected" : ""}
                    >
                        Dispatched
                    </option>

                    <option
                        value="Delivered"
                        ${status === "Delivered" ? "selected" : ""}
                    >
                        Delivered
                    </option>

                    <option
                        value="Cancelled"
                        ${status === "Cancelled" ? "selected" : ""}
                    >
                        Cancelled
                    </option>

                </select>


                <button
                    type="button"
                    class="update-button"
                    onclick="updateOrderStatus()"
                >
                    Update Status
                </button>

            </div>

        </section>


        <!-- DELETE -->

        <div class="admin-danger-zone">

            <div class="danger-description">

                <strong>
                    Delete Order
                </strong>

                <span>
                    Permanently remove this order record.
                </span>

            </div>


            <button
                type="button"
                class="delete-order-button"
                onclick="openDeleteModal(${currentOrderIndex})"
            >
                Delete Order
            </button>

        </div>

    `;
}


/* =========================================================
   STATUS CLASS
========================================================= */

function getStatusClass(status) {

    const value =
        String(status || "").toLowerCase();

    if (value === "pending verification") {
        return "pending";
    }

    if (value === "processing") {
        return "processing";
    }

    if (value === "dispatched") {
        return "dispatched";
    }

    if (value === "delivered") {
        return "delivered";
    }

    if (value === "cancelled") {
        return "cancelled";
    }

    return "default";
}


/* =========================================================
   SEARCH / FILTER
========================================================= */

function filterOrders() {

    const search =
        document
            .getElementById("orderSearch")
            .value
            .trim()
            .toLowerCase();


    const status =
        document
            .getElementById("orderStatusFilter")
            .value;


    const items =
        document.querySelectorAll(
            ".order-list-item"
        );


    let visibleCount = 0;


    items.forEach(item => {

        const itemSearch =
            item.dataset.search || "";

        const itemStatus =
            item.dataset.status || "";


        const matchesSearch =
            !search ||
            itemSearch.includes(search);


        const matchesStatus =
            status === "all" ||
            itemStatus === status;


        const visible =
            matchesSearch &&
            matchesStatus;


        item.style.display =
            visible ? "block" : "none";


        if (visible) {
            visibleCount++;
        }

    });


    if (!visibleCount) {

        showToast(
            "No orders match your search."
        );

    }

}


/* =========================================================
   UPDATE STATUS
========================================================= */

function updateOrderStatus() {

    const select =
        document.getElementById(
            "orderStatusControl"
        );


    if (!select) {
        return;
    }


    const newStatus =
        select.value;


    const order =
        zeithOrders[currentOrderIndex];


    if (!order) {
        return;
    }


    /*
     * FRONTEND DEMO ONLY
     *
     * Connect this to your backend using
     * fetch/AJAX or a normal POST request.
     */

    order.order_status =
        newStatus;


    const selectedItem =
        document.querySelector(
            `.order-list-item[data-order-index="${currentOrderIndex}"]`
        );


    if (selectedItem) {

        const badge =
            selectedItem.querySelector(
                ".status-badge"
            );


        if (badge) {

            badge.className =
                "status-badge " +
                getStatusClass(newStatus);

            badge.textContent =
                newStatus;
        }


        selectedItem.dataset.status =
            newStatus;
    }


    renderOrderDetails(order);


    showToast(
        "Order status updated to " +
        newStatus +
        "."
    );
}


/* =========================================================
   RECEIPT
========================================================= */

function openReceipt(receiptPath) {

    const modal =
        document.getElementById(
            "receiptModal"
        );


    const body =
        document.getElementById(
            "receiptModalBody"
        );


    if (!receiptPath) {

        body.innerHTML = `
            <div class="receipt-empty">
                No payment receipt is available for this order.
            </div>
        `;

    } else {

        body.innerHTML = `
            <img
                src="${receiptPath}"
                class="receipt-image"
                alt="Payment receipt"
                onerror="
                    this.style.display='none';
                    this.nextElementSibling.style.display='block';
                "
            >

            <div
                class="receipt-empty"
                style="display:none;"
            >
                Unable to load this receipt image.
            </div>
        `;
    }


    modal.classList.add("is-open");


    document.body.style.overflow =
        "hidden";
}


/* =========================================================
   CLOSE RECEIPT
========================================================= */

function closeReceipt() {

    document
        .getElementById("receiptModal")
        .classList.remove("is-open");


    document.body.style.overflow =
        "";
}


function closeReceiptOutside(event) {

    if (
        event.target.id ===
        "receiptModal"
    ) {

        closeReceipt();
    }
}


/* =========================================================
   DELETE MODAL
========================================================= */

function openDeleteModal(index) {

    orderToDelete =
        index;


    document
        .getElementById("deleteModal")
        .classList.add("is-open");


    document.body.style.overflow =
        "hidden";
}


function closeDeleteModal() {

    orderToDelete =
        null;


    document
        .getElementById("deleteModal")
        .classList.remove("is-open");


    document.body.style.overflow =
        "";
}


/* =========================================================
   CONFIRM DELETE
========================================================= */

function confirmDeleteOrder() {

    if (
        orderToDelete === null
    ) {
        return;
    }


    const order =
        zeithOrders[orderToDelete];


    if (!order) {
        return;
    }


    /*
     * FRONTEND DEMO ONLY.
     *
     * Connect this to your DELETE endpoint
     * when you wire the backend.
     */

    const orderNumber =
        order.order_number;


    const item =
        document.querySelector(
            `.order-list-item[data-order-index="${orderToDelete}"]`
        );


    if (item) {
        item.remove();
    }


    closeDeleteModal();


    showToast(
        "Order " +
        orderNumber +
        " has been removed from the view."
    );


    /*
     * In production:
     *
     * fetch('/admin/orders/delete', {
     *     method: 'POST',
     *     body: JSON.stringify({
     *         order_number: orderNumber
     *     })
     * });
     */
}


/* =========================================================
   REFRESH
========================================================= */

function refreshOrders() {

    const button =
        document.querySelector(
            ".orders-refresh"
        );


    if (!button) {
        return;
    }


    const original =
        button.innerHTML;


    button.disabled =
        true;


    button.innerHTML = `
        <svg viewBox="0 0 24 24">
            <path d="M20 11a8.1 8.1 0 0 0-14.8-4.5"></path>
            <path d="M4 5v4h4"></path>
        </svg>
        Refreshing...
    `;


    setTimeout(() => {

        button.disabled =
            false;

        button.innerHTML =
            original;

        showToast(
            "Orders refreshed."
        );

    }, 700);
}


/* =========================================================
   TOAST
========================================================= */

let toastTimer;


function showToast(message) {

    const toast =
        document.getElementById(
            "adminToast"
        );


    toast.textContent =
        message;


    toast.classList.add(
        "show"
    );


    clearTimeout(
        toastTimer
    );


    toastTimer =
        setTimeout(() => {

            toast.classList.remove(
                "show"
            );

        }, 3000);
}


/* =========================================================
   ESCAPE KEY
========================================================= */

document.addEventListener(
    "keydown",
    function(event) {

        if (
            event.key === "Escape"
        ) {

            closeReceipt();

            closeDeleteModal();

        }

    }
);


/* =========================================================
   INITIAL ORDER
========================================================= */

document.addEventListener(
    "DOMContentLoaded",
    function() {

        if (
            zeithOrders.length
        ) {

            selectOrder(0);

        }

    }
);

</script>

</body>
</html>