   <?php
    // views/admin/overview.php
    $totalRevenue     = $totalRevenue ?? 0;
    $totalOrders      = $totalOrders ?? 0;
    $activeCustomers  = $activeCustomers ?? 0;
    $watchesInStock   = $watchesInStock ?? 0;
    $recentOrders     = $recentOrders ?? [];
    $shippingMethods  = $shippingMethods ?? [];
    ?>

   <!DOCTYPE html>
   <html lang="en">

   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">

       <title>ZEITH — Admin Dashboard</title>

       <link
           rel="stylesheet"
           href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

       <style>
           :root {
               --bg-body: #f1f5f9;
               --card-bg: #ffffff;
               --sidebar-bg: #0b0f19;

               --accent: #f68b1e;
               --accent-dark: #d96f0b;

               --text-dark: #0f172a;
               --text-muted: #64748b;
               --text-light: #94a3b8;

               --border: #e2e8f0;

               --success: #10b981;
               --warning: #f59e0b;
               --danger: #ef4444;
               --blue: #2563eb;
               --purple: #7c3aed;

               --radius: 14px;
           }

           * {
               margin: 0;
               padding: 0;
               box-sizing: border-box;
           }

           html {
               scroll-behavior: smooth;
           }

           body {
               font-family:
                   -apple-system,
                   BlinkMacSystemFont,
                   "Segoe UI",
                   Roboto,
                   Helvetica,
                   Arial,
                   sans-serif;

               background: var(--bg-body);
               color: var(--text-dark);
               min-height: 100vh;
           }

           button,
           input,
           select {
               font: inherit;
           }

           button {
               cursor: pointer;
           }

           a {
               text-decoration: none;
               color: inherit;
           }


           /* =========================================================
           MAIN ADMIN AREA
           ========================================================= */

           .admin-main {
               margin-left: 260px;
               min-height: 100vh;
               padding: 30px 36px 50px;
           }


           /* =========================================================
           HEADER
           ========================================================= */

           .dashboard-header {
               display: flex;
               align-items: center;
               justify-content: space-between;
               gap: 20px;
               margin-bottom: 30px;
           }

           .dashboard-heading h1 {
               font-size: 28px;
               line-height: 1.2;
               font-weight: 800;
               letter-spacing: -0.5px;
           }

           .dashboard-heading p {
               margin-top: 7px;
               color: var(--text-muted);
               font-size: 14px;
           }

           .dashboard-header-right {
               display: flex;
               align-items: center;
               gap: 12px;
           }

           .date-selector {
               display: inline-flex;
               align-items: center;
               gap: 8px;
               padding: 10px 14px;
               background: #ffffff;
               border: 1px solid var(--border);
               border-radius: 9px;
               color: var(--text-muted);
               font-size: 13px;
               font-weight: 600;
           }

           .date-selector i {
               color: var(--accent);
           }

           .notification-btn {
               position: relative;
               width: 42px;
               height: 42px;
               border: 1px solid var(--border);
               background: #ffffff;
               border-radius: 9px;
               color: var(--text-muted);
               display: flex;
               align-items: center;
               justify-content: center;
           }

           .notification-btn:hover {
               color: var(--accent);
               border-color: #fed7aa;
           }

           .notification-dot {
               position: absolute;
               top: 8px;
               right: 8px;
               width: 7px;
               height: 7px;
               background: var(--danger);
               border-radius: 50%;
               border: 2px solid #ffffff;
           }


           /* =========================================================
           STATISTICS
           ========================================================= */

           .metrics-grid {
               display: grid;
               grid-template-columns: repeat(4, 1fr);
               gap: 18px;
               margin-bottom: 22px;
           }

           .stat-card {
               background: var(--card-bg);
               border: 1px solid var(--border);
               border-radius: var(--radius);
               padding: 21px;
               min-height: 145px;

               display: flex;
               justify-content: space-between;
               align-items: flex-start;

               transition: transform .2s ease, box-shadow .2s ease;
           }

           .stat-card:hover {
               transform: translateY(-2px);
               box-shadow: 0 8px 25px rgba(15, 23, 42, .06);
           }

           .stat-label {
               color: var(--text-muted);
               font-size: 12px;
               font-weight: 700;
               text-transform: uppercase;
               letter-spacing: .4px;
           }

           .stat-value {
               margin-top: 8px;
               font-size: 25px;
               font-weight: 800;
               color: var(--text-dark);
           }

           .stat-change {
               display: inline-flex;
               align-items: center;
               gap: 4px;
               margin-top: 10px;
               font-size: 11px;
               font-weight: 700;
           }

           .stat-change.up {
               color: var(--success);
           }

           .stat-change.down {
               color: var(--danger);
           }

           .stat-icon {
               width: 45px;
               height: 45px;
               border-radius: 11px;

               display: flex;
               align-items: center;
               justify-content: center;

               font-size: 17px;
           }

           .icon-orange {
               background: #fff7ed;
               color: var(--accent);
           }

           .icon-blue {
               background: #eff6ff;
               color: var(--blue);
           }

           .icon-green {
               background: #ecfdf5;
               color: var(--success);
           }

           .icon-purple {
               background: #f5f3ff;
               color: var(--purple);
           }


           /* =========================================================
           QUICK OVERVIEW CARDS
           ========================================================= */

           .quick-grid {
               display: grid;
               grid-template-columns: repeat(4, 1fr);
               gap: 16px;
               margin-bottom: 24px;
           }

           .quick-card {
               background: #ffffff;
               border: 1px solid var(--border);
               border-radius: 12px;
               padding: 17px 18px;

               display: flex;
               align-items: center;
               gap: 14px;

               transition: .2s ease;
           }

           .quick-card:hover {
               border-color: #cbd5e1;
               transform: translateY(-1px);
           }

           .quick-icon {
               width: 38px;
               height: 38px;
               border-radius: 9px;
               display: flex;
               align-items: center;
               justify-content: center;
               flex-shrink: 0;
           }

           .quick-info {
               min-width: 0;
           }

           .quick-info strong {
               display: block;
               font-size: 17px;
               font-weight: 800;
           }

           .quick-info span {
               display: block;
               margin-top: 3px;
               color: var(--text-muted);
               font-size: 11px;
           }

           .quick-arrow {
               margin-left: auto;
               color: #cbd5e1;
           }


           /* =========================================================
           MAIN DASHBOARD GRID
           ========================================================= */

           .dashboard-grid {
               display: grid;
               grid-template-columns: minmax(0, 1.55fr) minmax(320px, .95fr);
               gap: 22px;
               margin-bottom: 22px;
           }

           .panel-card {
               background: #ffffff;
               border: 1px solid var(--border);
               border-radius: var(--radius);
               padding: 22px;
               min-width: 0;
           }

           .panel-header {
               display: flex;
               align-items: center;
               justify-content: space-between;
               gap: 15px;
               margin-bottom: 20px;
           }

           .panel-title {
               font-size: 15px;
               font-weight: 800;
           }

           .panel-subtitle {
               margin-top: 4px;
               color: var(--text-muted);
               font-size: 11px;
           }

           .panel-link {
               color: var(--accent);
               font-size: 12px;
               font-weight: 700;
           }

           .panel-link:hover {
               color: var(--accent-dark);
           }


           /* =========================================================
           REVENUE CHART
           ========================================================= */

           .chart-wrapper {
               height: 275px;
               display: flex;
               flex-direction: column;
           }

           .chart-area {
               flex: 1;
               display: flex;
               gap: 15px;
               min-height: 0;
           }

           .chart-y-axis {
               width: 45px;
               display: flex;
               flex-direction: column;
               justify-content: space-between;
               padding-bottom: 27px;
           }

           .chart-y-axis span {
               color: var(--text-light);
               font-size: 10px;
               text-align: right;
           }

           .chart-main {
               position: relative;
               flex: 1;
               border-left: 1px solid var(--border);
               border-bottom: 1px solid var(--border);

               display: flex;
               align-items: flex-end;
               justify-content: space-around;

               padding: 0 10px 27px;
           }

           .chart-grid-line {
               position: absolute;
               left: 0;
               right: 0;
               height: 1px;
               background: #f1f5f9;
           }

           .line-1 {
               top: 20%;
           }

           .line-2 {
               top: 40%;
           }

           .line-3 {
               top: 60%;
           }

           .line-4 {
               top: 80%;
           }

           .chart-bar-group {
               position: relative;
               z-index: 2;

               height: 100%;
               flex: 1;

               display: flex;
               align-items: flex-end;
               justify-content: center;
               gap: 5px;
           }

           .chart-bar {
               width: 17px;
               border-radius: 5px 5px 0 0;
               transition: height .5s ease;
           }

           .revenue-bar {
               background: var(--accent);
           }

           .profit-bar {
               background: #0f172a;
           }

           .chart-month {
               position: absolute;
               bottom: -23px;
               color: var(--text-light);
               font-size: 10px;
           }

           .chart-legend {
               display: flex;
               align-items: center;
               gap: 18px;
               margin-top: 12px;
           }

           .legend-item {
               display: flex;
               align-items: center;
               gap: 6px;
               color: var(--text-muted);
               font-size: 11px;
           }

           .legend-dot {
               width: 8px;
               height: 8px;
               border-radius: 50%;
           }

           .legend-revenue {
               background: var(--accent);
           }

           .legend-profit {
               background: #0f172a;
           }


           /* =========================================================
           ORDER STATUS
           ========================================================= */

           .order-status-list {
               display: flex;
               flex-direction: column;
               gap: 17px;
           }

           .order-status-row {
               display: grid;
               grid-template-columns: 1fr auto;
               gap: 12px;
           }

           .status-row-top {
               display: flex;
               justify-content: space-between;
               margin-bottom: 7px;
           }

           .status-name {
               font-size: 12px;
               font-weight: 700;
           }

           .status-count {
               font-size: 12px;
               color: var(--text-muted);
               font-weight: 700;
           }

           .progress {
               height: 7px;
               border-radius: 20px;
               background: #f1f5f9;
               overflow: hidden;
           }

           .progress span {
               display: block;
               height: 100%;
               border-radius: inherit;
           }

           .progress-pending {
               background: var(--warning);
               width: 18%;
           }

           .progress-processing {
               background: var(--blue);
               width: 35%;
           }

           .progress-dispatched {
               background: var(--purple);
               width: 55%;
           }

           .progress-delivered {
               background: var(--success);
               width: 82%;
           }


           /* =========================================================
           RECENT ORDERS
           ========================================================= */

           .orders-panel {
               margin-bottom: 22px;
           }

           .table-wrap {
               overflow-x: auto;
           }

           .orders-table {
               width: 100%;
               border-collapse: collapse;
               min-width: 700px;
           }

           .orders-table th {
               padding: 12px 10px;
               text-align: left;
               font-size: 10px;
               color: var(--text-muted);
               text-transform: uppercase;
               letter-spacing: .5px;
               font-weight: 800;

               border-bottom: 1px solid var(--border);
           }

           .orders-table td {
               padding: 14px 10px;
               font-size: 12px;
               border-bottom: 1px solid #f1f5f9;
           }

           .orders-table tbody tr:hover {
               background: #fafafa;
           }

           .order-number {
               font-weight: 800;
               color: var(--text-dark);
           }

           .customer-name {
               font-weight: 700;
           }

           .customer-email {
               color: var(--text-muted);
               font-size: 10px;
               margin-top: 3px;
           }

           .order-amount {
               font-weight: 800;
           }

           .status-badge {
               display: inline-flex;
               align-items: center;
               padding: 5px 9px;
               border-radius: 20px;
               font-size: 10px;
               font-weight: 800;
           }

           .status-pending {
               background: #fff7ed;
               color: #c2410c;
           }

           .status-processing {
               background: #eff6ff;
               color: #1d4ed8;
           }

           .status-dispatched {
               background: #f5f3ff;
               color: #6d28d9;
           }

           .status-delivered {
               background: #ecfdf5;
               color: #047857;
           }


           /* =========================================================
           BOTTOM GRID
           ========================================================= */

           .bottom-grid {
               display: grid;
               grid-template-columns: 1fr 1fr;
               gap: 22px;
           }


           /* =========================================================
           ACTIVITY
           ========================================================= */

           .activity-list {
               display: flex;
               flex-direction: column;
           }

           .activity-item {
               display: flex;
               gap: 12px;
               padding: 13px 0;
               border-bottom: 1px solid #f1f5f9;
           }

           .activity-item:last-child {
               border-bottom: none;
           }

           .activity-icon {
               width: 34px;
               height: 34px;
               border-radius: 9px;
               display: flex;
               align-items: center;
               justify-content: center;
               flex-shrink: 0;
               font-size: 12px;
           }

           .activity-content {
               min-width: 0;
           }

           .activity-content strong {
               display: block;
               font-size: 12px;
               line-height: 1.4;
           }

           .activity-content span {
               display: block;
               margin-top: 3px;
               color: var(--text-muted);
               font-size: 10px;
           }


           /* =========================================================
           SHIPPING
           ========================================================= */

           .shipping-table {
               width: 100%;
               border-collapse: collapse;
           }

           .shipping-table th,
           .shipping-table td {
               text-align: left;
               padding: 12px 6px;
               border-bottom: 1px solid #f1f5f9;
               font-size: 11px;
           }

           .shipping-table th {
               color: var(--text-muted);
               text-transform: uppercase;
               font-size: 9px;
               letter-spacing: .4px;
           }

           .shipping-active {
               display: inline-flex;
               align-items: center;
               gap: 5px;
               color: var(--success);
               font-size: 10px;
               font-weight: 800;
           }

           .shipping-active i {
               font-size: 7px;
           }


           /* =========================================================
           TOGGLE
           ========================================================= */

           .switch {
               position: relative;
               width: 36px;
               height: 20px;
               display: inline-block;
           }

           .switch input {
               opacity: 0;
               width: 0;
               height: 0;
           }

           .slider {
               position: absolute;
               inset: 0;
               background: #cbd5e1;
               border-radius: 20px;
               transition: .25s ease;
           }

           .slider::before {
               content: "";
               position: absolute;
               width: 14px;
               height: 14px;
               left: 3px;
               top: 3px;
               background: #ffffff;
               border-radius: 50%;
               transition: .25s ease;
               box-shadow: 0 1px 3px rgba(0, 0, 0, .15);
           }

           .switch input:checked+.slider {
               background: var(--success);
           }

           .switch input:checked+.slider::before {
               transform: translateX(16px);
           }


           /* =========================================================
           RESPONSIVE
           ========================================================= */

           @media (max-width: 1200px) {

               .admin-main {
                   padding: 26px;
               }

               .metrics-grid {
                   grid-template-columns: repeat(2, 1fr);
               }

               .quick-grid {
                   grid-template-columns: repeat(2, 1fr);
               }

               .dashboard-grid {
                   grid-template-columns: 1fr;
               }
           }


           @media (max-width: 900px) {

               .admin-main {
                   margin-left: 0;
                   padding: 22px 18px 40px;
               }

               .dashboard-header {
                   align-items: flex-start;
               }

               .dashboard-header-right {
                   gap: 7px;
               }

               .date-selector {
                   display: none;
               }

               .bottom-grid {
                   grid-template-columns: 1fr;
               }
           }


           @media (max-width: 650px) {

               .admin-main {
                   padding: 18px 14px 35px;
               }

               .dashboard-header {
                   flex-direction: column;
                   margin-bottom: 22px;
               }

               .dashboard-header-right {
                   width: 100%;
                   justify-content: flex-end;
               }

               .dashboard-heading h1 {
                   font-size: 23px;
               }

               .metrics-grid {
                   grid-template-columns: 1fr;
               }

               .quick-grid {
                   grid-template-columns: 1fr;
               }

               .panel-card {
                   padding: 17px;
               }

               .stat-card {
                   min-height: 125px;
               }

               .chart-wrapper {
                   height: 240px;
               }
           }


           @media (max-width: 420px) {

               .dashboard-heading h1 {
                   font-size: 21px;
               }

               .stat-value {
                   font-size: 22px;
               }

               .quick-card {
                   padding: 14px;
               }

               .panel-title {
                   font-size: 14px;
               }
           }

           /* =========================================================
   SHIPPING CONFIGURATION
========================================================= */

           .zeith-shipping-panel {
               overflow: hidden;
           }

           .zeith-shipping-header {
               display: flex;
               align-items: center;
               justify-content: space-between;
               gap: 20px;
           }

           .add-shipping-btn {
               display: inline-flex;
               align-items: center;
               justify-content: center;
               gap: 8px;
               border: none;
               background: #2563EB;
               color: #FFFFFF;
               padding: 11px 17px;
               border-radius: 9px;
               font-size: 12px;
               font-weight: 800;
               cursor: pointer;
               transition: all .2s ease;
               white-space: nowrap;
           }

           .add-shipping-btn:hover {
               background: #1D4ED8;
               transform: translateY(-1px);
           }

           .add-shipping-btn i {
               font-size: 12px;
           }


           /* TABLE */

           .shipping-table-wrapper {
               width: 100%;
               overflow-x: auto;
           }

           .shipping-table {
               width: 100%;
               min-width: 780px;
               border-collapse: collapse;
           }

           .shipping-table thead th {
               padding: 14px 16px;
               text-align: left;
               background: #F8FAFC;
               color: #64748B;
               font-size: 11px;
               font-weight: 800;
               text-transform: uppercase;
               letter-spacing: .05em;
               border-bottom: 1px solid #E2E8F0;
           }

           .shipping-table tbody td {
               padding: 17px 16px;
               border-bottom: 1px solid #E2E8F0;
               vertical-align: middle;
           }

           .shipping-table tbody tr:last-child td {
               border-bottom: none;
           }

           .shipping-table tbody tr {
               transition: background .2s ease;
           }

           .shipping-table tbody tr:hover {
               background: #F8FAFC;
           }


           /* METHOD */

           .shipping-method {
               display: flex;
               align-items: center;
               gap: 12px;
               min-width: 190px;
           }

           .shipping-icon {
               width: 38px;
               height: 38px;
               flex: 0 0 38px;
               display: flex;
               align-items: center;
               justify-content: center;
               border-radius: 10px;
               background: #EFF6FF;
               color: #2563EB;
               font-size: 14px;
           }

           .shipping-icon.pickup {
               background: #ECFDF5;
               color: #10B981;
           }

           .shipping-method strong {
               display: block;
               color: #0F172A;
               font-size: 13px;
               font-weight: 800;
               line-height: 1.4;
           }

           .shipping-method small {
               display: block;
               margin-top: 3px;
               color: #94A3B8;
               font-size: 10px;
           }


           /* DESCRIPTION */

           .shipping-description {
               display: block;
               max-width: 380px;
               color: #475569;
               font-size: 12px;
               line-height: 1.6;
           }

           .delivery-days {
               color: #2563EB;
               font-weight: 700;
           }


           /* PRICE */

           .shipping-price {
               color: #0F172A;
               font-size: 13px;
               white-space: nowrap;
           }

           .shipping-price.free {
               color: #10B981;
           }


           /* ACTIONS */

           .shipping-actions {
               display: flex;
               align-items: center;
               gap: 7px;
           }

           .shipping-edit-btn,
           .shipping-delete-btn {
               width: 34px;
               height: 34px;
               border: 1px solid #E2E8F0;
               border-radius: 8px;
               display: inline-flex;
               align-items: center;
               justify-content: center;
               cursor: pointer;
               transition: all .2s ease;
           }

           .shipping-edit-btn {
               background: #FFFFFF;
               color: #2563EB;
           }

           .shipping-edit-btn:hover {
               background: #EFF6FF;
               border-color: #BFDBFE;
           }

           .shipping-delete-btn {
               background: #FFFFFF;
               color: #EF4444;
           }

           .shipping-delete-btn:hover {
               background: #FEF2F2;
               border-color: #FECACA;
           }


           /* =========================================================
   SHIPPING MODAL
========================================================= */

           .shipping-modal {
               position: fixed;
               inset: 0;
               z-index: 9999;
               display: none;
               align-items: center;
               justify-content: center;
               padding: 20px;
           }

           .shipping-modal.is-open {
               display: flex;
           }

           .shipping-modal-overlay {
               position: absolute;
               inset: 0;
               background: rgba(15, 23, 42, .55);
               backdrop-filter: blur(3px);
           }

           .shipping-modal-card {
               position: relative;
               z-index: 2;
               width: min(100%, 500px);
               background: #FFFFFF;
               border-radius: 16px;
               box-shadow: 0 25px 70px rgba(15, 23, 42, .2);
               overflow: hidden;
               animation: shippingModalIn .2s ease;
           }

           @keyframes shippingModalIn {
               from {
                   opacity: 0;
                   transform: translateY(12px) scale(.98);
               }

               to {
                   opacity: 1;
                   transform: translateY(0) scale(1);
               }
           }

           .shipping-modal-header {
               display: flex;
               align-items: flex-start;
               justify-content: space-between;
               gap: 20px;
               padding: 24px;
               border-bottom: 1px solid #E2E8F0;
           }

           .shipping-modal-eyebrow {
               display: block;
               margin-bottom: 7px;
               color: #2563EB;
               font-size: 10px;
               font-weight: 800;
               letter-spacing: .12em;
           }

           .shipping-modal-header h3 {
               margin: 0;
               color: #0F172A;
               font-size: 20px;
               font-weight: 800;
           }

           .shipping-modal-header p {
               margin: 6px 0 0;
               color: #64748B;
               font-size: 12px;
               line-height: 1.5;
           }

           .shipping-modal-close {
               width: 34px;
               height: 34px;
               border: 1px solid #E2E8F0;
               border-radius: 8px;
               background: #FFFFFF;
               color: #64748B;
               cursor: pointer;
               transition: .2s ease;
           }

           .shipping-modal-close:hover {
               background: #F8FAFC;
               color: #0F172A;
           }


           /* FORM */

           #shippingForm {
               padding: 24px;
           }

           .shipping-form-group {
               margin-bottom: 18px;
           }

           .shipping-form-group label {
               display: block;
               margin-bottom: 7px;
               color: #334155;
               font-size: 12px;
               font-weight: 800;
           }

           .shipping-form-group input,
           .shipping-form-group textarea {
               width: 100%;
               box-sizing: border-box;
               border: 1px solid #E2E8F0;
               border-radius: 9px;
               background: #FFFFFF;
               color: #0F172A;
               padding: 11px 12px;
               font-family: inherit;
               font-size: 13px;
               outline: none;
               transition: .2s ease;
           }

           .shipping-form-group textarea {
               resize: vertical;
               min-height: 95px;
           }

           .shipping-form-group input:focus,
           .shipping-form-group textarea:focus {
               border-color: #2563EB;
               box-shadow: 0 0 0 3px rgba(37, 99, 235, .08);
           }


           /* PRICE INPUT */

           .price-input {
               position: relative;
           }

           .price-input span {
               position: absolute;
               left: 12px;
               top: 50%;
               transform: translateY(-50%);
               color: #64748B;
               font-size: 13px;
               font-weight: 700;
           }

           .price-input input {
               padding-left: 30px;
           }


           /* MODAL FOOTER */

           .shipping-modal-footer {
               display: flex;
               align-items: center;
               justify-content: flex-end;
               gap: 10px;
               margin-top: 24px;
               padding-top: 18px;
               border-top: 1px solid #E2E8F0;
           }

           .shipping-cancel-btn,
           .shipping-save-btn {
               min-height: 40px;
               padding: 0 16px;
               border-radius: 8px;
               font-size: 12px;
               font-weight: 800;
               cursor: pointer;
               transition: .2s ease;
           }

           .shipping-cancel-btn {
               border: 1px solid #E2E8F0;
               background: #FFFFFF;
               color: #475569;
           }

           .shipping-cancel-btn:hover {
               background: #F8FAFC;
           }

           .shipping-save-btn {
               border: none;
               background: #2563EB;
               color: #FFFFFF;
           }

           .shipping-save-btn:hover {
               background: #1D4ED8;
           }


           /* =========================================================
   RESPONSIVE
========================================================= */

           @media (max-width: 800px) {

               .zeith-shipping-header {
                   align-items: flex-start;
                   flex-direction: column;
               }

               .add-shipping-btn {
                   width: 100%;
               }

           }

           @media (max-width: 500px) {

               .shipping-modal {
                   padding: 12px;
               }

               .shipping-modal-header {
                   padding: 20px;
               }

               #shippingForm {
                   padding: 20px;
               }

               .shipping-modal-footer {
                   flex-direction: column-reverse;
               }

               .shipping-cancel-btn,
               .shipping-save-btn {
                   width: 100%;
               }

           }
       </style>
   </head>


   <body>
       <?php
        // views/Staff/order.php
        \App\Helpers\View::displayComponent("admin/sidebar.php");
        ?>


       <main class="admin-main">
           <header class="dashboard-header">
               <div class="dashboard-heading">
                   <h1>Admin Dashboard</h1>
                   <p>Overview of your ZEITH store performance and activity.</p>
               </div>
               <div class="dashboard-header-right">
                   <div class="date-selector">
                       <i class="fa-regular fa-calendar"></i>
                       <span id="currentDate"><?= date('F Y') ?></span>
                   </div>
                   <button type="button" class="notification-btn" aria-label="Notifications" onclick="showNotificationMessage()">
                       <i class="fa-regular fa-bell"></i>
                       <span class="notification-dot"></span>
                   </button>
               </div>
           </header>

           <section class="metrics-grid">
               <article class="stat-card">
                   <div>
                       <div class="stat-label">Total Revenue</div>
                       <div class="stat-value">₦<?= number_format((float)$totalRevenue, 2) ?></div>
                   </div>
                   <div class="stat-icon icon-orange">
                       <i class="fa-solid fa-naira-sign"></i>
                   </div>
               </article>

               <article class="stat-card">
                   <div>
                       <div class="stat-label">Total Orders</div>
                       <div class="stat-value"><?= number_format((int)$totalOrders) ?></div>
                   </div>
                   <div class="stat-icon icon-blue">
                       <i class="fa-solid fa-bag-shopping"></i>
                   </div>
               </article>

               <article class="stat-card">
                   <div>
                       <div class="stat-label">Active Customers</div>
                       <div class="stat-value"><?= number_format((int)$activeCustomers) ?></div>
                   </div>
                   <div class="stat-icon icon-green">
                       <i class="fa-solid fa-users"></i>
                   </div>
               </article>

               <article class="stat-card">
                   <div>
                       <div class="stat-label">Watches in Stock</div>
                       <div class="stat-value"><?= number_format((int)$watchesInStock) ?></div>
                   </div>
                   <div class="stat-icon icon-purple">
                       <i class="fa-solid fa-clock"></i>
                   </div>
               </article>
           </section>

           <section class="quick-grid">
               <a href="/Zeith/admin/orders" class="quick-card">
                   <div class="quick-icon icon-orange">
                       <i class="fa-solid fa-clock"></i>
                   </div>
                   <div class="quick-info">
                       <strong>12</strong>
                       <span>Pending Verification</span>
                   </div>
                   <i class="fa-solid fa-chevron-right quick-arrow"></i>
               </a>

               <a href="/Zeith/admin/staff-requests" class="quick-card">
                   <div class="quick-icon icon-purple">
                       <i class="fa-solid fa-user-check"></i>
                   </div>
                   <div class="quick-info">
                       <strong>5</strong>
                       <span>Seller Approvals</span>
                   </div>
                   <i class="fa-solid fa-chevron-right quick-arrow"></i>
               </a>

               <a href="subscriber.php" class="quick-card">
                   <div class="quick-icon icon-green">
                       <i class="fa-regular fa-envelope"></i>
                   </div>
                   <div class="quick-info">
                       <strong>1,248</strong>
                       <span>Newsletter Subscribers</span>
                   </div>
                   <i class="fa-solid fa-chevron-right quick-arrow"></i>
               </a>
           </section>

           <section class="dashboard-grid">
               <article class="panel-card">
                   <div class="panel-header">
                       <div>
                           <h2 class="panel-title">Order Status</h2>
                           <p class="panel-subtitle">Current order distribution.</p>
                       </div>
                       <a href="/Zeith/admin/orders" class="panel-link">View Orders</a>
                   </div>

                   <div class="order-status-list">
                       <div class="order-status-row">
                           <div>
                               <div class="status-row-top">
                                   <span class="status-name">Pending Verification</span>
                                   <span class="status-count">12</span>
                               </div>
                               <div class="progress">
                                   <span class="progress-pending"></span>
                               </div>
                           </div>
                       </div>

                       <div class="order-status-row">
                           <div>
                               <div class="status-row-top">
                                   <span class="status-name">Processing</span>
                                   <span class="status-count">24</span>
                               </div>
                               <div class="progress">
                                   <span class="progress-processing"></span>
                               </div>
                           </div>
                       </div>

                       <div class="order-status-row">
                           <div>
                               <div class="status-row-top">
                                   <span class="status-name">Dispatched</span>
                                   <span class="status-count">16</span>
                               </div>
                               <div class="progress">
                                   <span class="progress-dispatched"></span>
                               </div>
                           </div>
                       </div>

                       <div class="order-status-row">
                           <div>
                               <div class="status-row-top">
                                   <span class="status-name">Delivered</span>
                                   <span class="status-count">96</span>
                               </div>
                               <div class="progress">
                                   <span class="progress-delivered"></span>
                               </div>
                           </div>
                       </div>
                   </div>
               </article>
           </section>

           <section class="panel-card orders-panel">
               <div class="panel-header">
                   <div>
                       <h2 class="panel-title">Recent Orders</h2>
                       <p class="panel-subtitle">Latest customer orders requiring attention.</p>
                   </div>
                   <a href="/Zeith/admin/orders" class="panel-link">View All Orders</a>
               </div>

               <div class="table-wrap">
                   <table class="orders-table">
                       <thead>
                           <tr>
                               <th>Order</th>
                               <th>Customer</th>
                               <th>Amount</th>
                               <th>Payment</th>
                               <th>Status</th>
                               <th>Date</th>
                           </tr>
                       </thead>
                       <tbody>
                           <?php if (!empty($recentOrders)): ?>
                               <?php foreach ($recentOrders as $ro): ?>
                                   <tr>
                                       <td><span class="order-number"><?= htmlspecialchars($ro['order_number'] ?? '') ?></span></td>
                                       <td>
                                           <div class="customer-name"><?= htmlspecialchars($ro['full_name'] ?? '') ?></div>
                                           <div class="customer-email"><?= htmlspecialchars($ro['email'] ?? '') ?></div>
                                       </td>
                                       <td><span class="order-amount">₦<?= number_format((float)($ro['total_amount'] ?? 0), 2) ?></span></td>
                                       <td><span class="status-badge status-delivered"><?= htmlspecialchars($ro['payment_status'] ?? 'Pending') ?></span></td>
                                       <td><span class="status-badge status-processing"><?= htmlspecialchars($ro['order_status'] ?? 'Pending') ?></span></td>
                                       <td><?= date('M d, Y', strtotime($ro['created_at'] ?? 'now')) ?></td>
                                   </tr>
                               <?php endforeach; ?>
                           <?php else: ?>
                               <tr>
                                   <td colspan="6" style="text-align: center; padding: 20px;">No recent orders found.</td>
                               </tr>
                           <?php endif; ?>
                       </tbody>
                   </table>
               </div>
           </section>

           <section class="bottom-grid">
               <article class="panel-card">
                   <div class="panel-header">
                       <div>
                           <h2 class="panel-title">Recent Activity</h2>
                           <p class="panel-subtitle">Latest activity across ZEITH.</p>
                       </div>
                   </div>

                   <div class="activity-list">
                       <div class="activity-item">
                           <div class="activity-icon icon-orange">
                               <i class="fa-solid fa-bag-shopping"></i>
                           </div>
                           <div class="activity-content">
                               <strong>New order received</strong>
                               <span>System activity • Just now</span>
                           </div>
                       </div>
                   </div>
               </article>

               <article class="panel-card zeith-shipping-panel">
                   <div class="panel-header zeith-shipping-header">
                       <div>
                           <h2 class="panel-title">Shipping Configuration</h2>
                           <p class="panel-subtitle">Manage delivery methods, descriptions and shipping prices.</p>
                       </div>
                       <button type="button" class="add-shipping-btn" onclick="openAddShippingModal()">
                           <i class="fa-solid fa-plus"></i>
                           Add Shipping
                       </button>
                   </div>

                   <div class="shipping-table-wrapper">
                       <table class="shipping-table">
                           <thead>
                               <tr>
                                   <th>Method</th>
                                   <th>Description</th>
                                   <th>Price</th>
                                   <th>Actions</th>
                               </tr>
                           </thead>
                           <tbody id="shippingTableBody">
                               <?php if (!empty($shippingMethods)): ?>
                                   <?php foreach ($shippingMethods as $sm): ?>
                                       <tr>
                                           <td>
                                               <div class="shipping-method">
                                                   <span class="shipping-icon <?= stripos($sm['method_name'], 'pickup') !== false ? 'pickup' : '' ?>">
                                                       <i class="fa-solid <?= stripos($sm['method_name'], 'pickup') !== false ? 'fa-store' : 'fa-truck' ?>"></i>
                                                   </span>
                                                   <div>
                                                       <strong><?= htmlspecialchars($sm['method_name']) ?></strong>
                                                       <small><?= stripos($sm['method_name'], 'pickup') !== false ? 'Pickup Method' : 'Delivery Method' ?></small>
                                                   </div>
                                               </div>
                                           </td>
                                           <td>
                                               <span class="shipping-description">
                                                   <?= htmlspecialchars($sm['description']) ?>
                                               </span>
                                           </td>
                                           <td><strong class="shipping-price <?= (float)$sm['price'] <= 0 ? 'free' : '' ?>">₦<?= number_format((float)$sm['price'], 2) ?></strong></td>
                                           <td>
                                               <div class="shipping-actions">
                                                   <button type="button" class="shipping-edit-btn" onclick="openEditShippingModal(<?= $sm['id'] ?>, '<?= htmlspecialchars($sm['method_name'], ENT_QUOTES) ?>', '<?= htmlspecialchars($sm['description'], ENT_QUOTES) ?>', <?= $sm['price'] ?>)" title="Edit shipping">
                                                       <i class="fa-solid fa-pen"></i>
                                                   </button>
                                                   <a href="/Zeith/admin/shipping/delete/<?= $sm['id'] ?>" class="shipping-delete-btn" onclick="return confirm('Are you sure you want to delete this shipping method?');" title="Delete shipping" style="display:inline-flex; align-items:center; justify-content:center; text-decoration:none;">
                                                       <i class="fa-solid fa-trash"></i>
                                                   </a>
                                               </div>
                                           </td>
                                       </tr>
                                   <?php endforeach; ?>
                               <?php else: ?>
                                   <tr>
                                       <td colspan="4" style="text-align: center; padding: 20px;">No shipping methods found.</td>
                                   </tr>
                               <?php endif; ?>
                           </tbody>
                       </table>
                   </div>
               </article>

               <div class="shipping-modal" id="shippingModal" aria-hidden="true">
                   <div class="shipping-modal-overlay" onclick="closeShippingModal()"></div>
                   <div class="shipping-modal-card">
                       <div class="shipping-modal-header">
                           <div>
                               <span class="shipping-modal-eyebrow">SHIPPING SETTINGS</span>
                               <h3 id="shippingModalTitle">Add Shipping Method</h3>
                               <p>Create or update a delivery method for your customers.</p>
                           </div>
                           <button type="button" class="shipping-modal-close" onclick="closeShippingModal()">
                               <i class="fa-solid fa-xmark"></i>
                           </button>
                       </div>

                       <form id="shippingForm" action="/Zeith/admin/shipping/store" method="POST">
                           <div class="shipping-form-group">
                               <label for="shippingMethodName">Method Name</label>
                               <input type="text" name="method_name" id="shippingMethodName" placeholder="e.g. Lagos Island 3" required>
                           </div>

                           <div class="shipping-form-group">
                               <label for="shippingDescription">Description</label>
                               <textarea name="description" id="shippingDescription" rows="4" placeholder="e.g. Lekki, Ikoyi, Victoria Island, etc." required></textarea>
                           </div>

                           <div class="shipping-form-group">
                               <label for="shippingPrice">Shipping Price</label>
                               <div class="price-input">
                                   <span>₦</span>
                                   <input type="number" name="price" id="shippingPrice" min="0" step="0.01" placeholder="4000" required>
                               </div>
                           </div>

                           <div class="shipping-modal-footer">
                               <button type="button" class="shipping-cancel-btn" onclick="closeShippingModal()">Cancel</button>
                               <button type="submit" class="shipping-save-btn">
                                   <i class="fa-solid fa-check"></i>
                                   Save Shipping
                               </button>
                           </div>
                       </form>
                   </div>
               </div>
           </section>
       </main>

       <script>
           function openAddShippingModal() {
               document.getElementById('shippingModalTitle').textContent = 'Add Shipping Method';
               document.getElementById('shippingForm').action = '/Zeith/admin/shipping/store';
               document.getElementById('shippingMethodName').value = '';
               document.getElementById('shippingDescription').value = '';
               document.getElementById('shippingPrice').value = '';
               document.getElementById('shippingModal').style.display = 'flex';
               document.getElementById('shippingModal').setAttribute('aria-hidden', 'false');
           }

           function openEditShippingModal(id, name, description, price) {
               document.getElementById('shippingModalTitle').textContent = 'Edit Shipping Method';
               document.getElementById('shippingForm').action = '/Zeith/admin/shipping/update/' + id;
               document.getElementById('shippingMethodName').value = name;
               document.getElementById('shippingDescription').value = description;
               document.getElementById('shippingPrice').value = price;
               document.getElementById('shippingModal').style.display = 'flex';
               document.getElementById('shippingModal').setAttribute('aria-hidden', 'false');
           }

           function closeShippingModal() {
               document.getElementById('shippingModal').style.display = 'none';
               document.getElementById('shippingModal').setAttribute('aria-hidden', 'true');
           }
           document.addEventListener("DOMContentLoaded", function() {

               /*
                * Automatically display the current month/year
                * in the dashboard header.
                */
               const dateElement = document.getElementById("currentDate");

               if (dateElement) {

                   const currentDate = new Date();

                   dateElement.textContent =
                       currentDate.toLocaleDateString("en-US", {
                           month: "long",
                           year: "numeric"
                       });

               }


               /*
                * Animate dashboard bars when the page loads.
                */
               const bars = document.querySelectorAll(".chart-bar");

               bars.forEach(function(bar) {

                   const originalHeight = bar.style.height;

                   bar.style.height = "0";

                   setTimeout(function() {

                       bar.style.height = originalHeight;

                   }, 150);

               });

           });


           /*
            * Notification button.
            * Replace this later with your actual notification system.
            */
           function showNotificationMessage() {

               alert(
                   "You have new dashboard notifications."
               );

           }


           /*
            * Shipping toggle.
            * This currently only changes the frontend.
            * Your backend can later save the new status.
            */
           function shippingToggle(toggle) {

               const row = toggle.closest("tr");

               if (!row) {
                   return;
               }

               const status = row.querySelector(".shipping-active");

               if (toggle.checked) {

                   if (status) {

                       status.innerHTML =
                           '<i class="fa-solid fa-circle"></i> Active';

                       status.style.color = "#10b981";

                   }

               } else {

                   if (status) {

                       status.innerHTML =
                           '<i class="fa-solid fa-circle"></i> Inactive';

                       status.style.color = "#94a3b8";

                   }

               }

           }

           let editingShippingRow = null;


           /* =========================================================
              OPEN ADD SHIPPING MODAL
           ========================================================= */

           function openShippingModal() {

               editingShippingRow = null;

               document.getElementById("shippingModalTitle").textContent =
                   "Add Shipping Method";

               document.getElementById("shippingMethodName").value = "";
               document.getElementById("shippingDescription").value = "";
               document.getElementById("shippingPrice").value = "";

               document.getElementById("shippingModal").classList.add("is-open");

               document.getElementById("shippingModal").setAttribute(
                   "aria-hidden",
                   "false"
               );

               setTimeout(() => {
                   document.getElementById("shippingMethodName").focus();
               }, 100);
           }


           /* =========================================================
              CLOSE MODAL
           ========================================================= */

           function closeShippingModal() {

               document.getElementById("shippingModal").classList.remove("is-open");

               document.getElementById("shippingModal").setAttribute(
                   "aria-hidden",
                   "true"
               );

               editingShippingRow = null;
           }


           /* =========================================================
              EDIT SHIPPING
           ========================================================= */

           function editShipping(button) {

               const row = button.closest("tr");

               if (!row) return;

               editingShippingRow = row;

               const methodName =
                   row.querySelector(".shipping-method strong").textContent.trim();

               const description =
                   row.querySelector(".shipping-description").textContent.trim();

               const price =
                   row.querySelector(".shipping-price").textContent
                   .replace("₦", "")
                   .replace(/,/g, "")
                   .trim();

               document.getElementById("shippingModalTitle").textContent =
                   "Edit Shipping Method";

               document.getElementById("shippingMethodName").value =
                   methodName;

               document.getElementById("shippingDescription").value =
                   description;

               document.getElementById("shippingPrice").value =
                   parseFloat(price) || 0;

               document.getElementById("shippingModal").classList.add("is-open");

               document.getElementById("shippingModal").setAttribute(
                   "aria-hidden",
                   "false"
               );

           }


           /* =========================================================
              SAVE SHIPPING
           ========================================================= */

           function saveShipping(event) {

               event.preventDefault();

               const methodName =
                   document.getElementById("shippingMethodName").value.trim();

               const description =
                   document.getElementById("shippingDescription").value.trim();

               const price =
                   parseFloat(document.getElementById("shippingPrice").value);

               if (!methodName || !description || isNaN(price) || price < 0) {

                   alert("Please complete all shipping fields correctly.");

                   return;
               }


               /*
                * EDIT EXISTING SHIPPING
                */

               if (editingShippingRow) {

                   editingShippingRow.querySelector(
                       ".shipping-method strong"
                   ).textContent = methodName;

                   editingShippingRow.querySelector(
                       ".shipping-description"
                   ).textContent = description;

                   editingShippingRow.querySelector(
                       ".shipping-price"
                   ).textContent = formatCurrency(price);

                   alert("Shipping method updated successfully.");

                   closeShippingModal();

                   return;
               }


               /*
                * ADD NEW SHIPPING
                */

               const tbody =
                   document.getElementById("shippingTableBody");

               const row =
                   document.createElement("tr");

               row.innerHTML = `

        <td>

            <div class="shipping-method">

                <span class="shipping-icon">

                    <i class="fa-solid fa-truck"></i>

                </span>

                <div>

                    <strong>
                        ${escapeHtml(methodName)}
                    </strong>

                    <small>
                        Delivery Method
                    </small>

                </div>

            </div>

        </td>


        <td>

            <span class="shipping-description">

                ${escapeHtml(description)}

            </span>

        </td>


        <td>

            <strong class="shipping-price">

                ${formatCurrency(price)}

            </strong>

        </td>


        <td>

            <div class="shipping-actions">

                <button
                    type="button"
                    class="shipping-edit-btn"
                    onclick="editShipping(this)"
                    title="Edit shipping"
                >

                    <i class="fa-solid fa-pen"></i>

                </button>


                <button
                    type="button"
                    class="shipping-delete-btn"
                    onclick="deleteShipping(this)"
                    title="Delete shipping"
                >

                    <i class="fa-solid fa-trash"></i>

                </button>

            </div>

        </td>

    `;

               tbody.appendChild(row);

               alert("Shipping method added successfully.");

               closeShippingModal();
           }


           /* =========================================================
              DELETE SHIPPING
           ========================================================= */

           function deleteShipping(button) {

               const row = button.closest("tr");

               if (!row) return;

               const methodName =
                   row.querySelector(".shipping-method strong")
                   .textContent
                   .trim();


               const confirmed = confirm(
                   `Are you sure you want to delete "${methodName}"?`
               );


               if (!confirmed) {
                   return;
               }


               row.remove();

               alert(
                   `"${methodName}" has been removed.`
               );
           }


           /* =========================================================
              FORMAT CURRENCY
           ========================================================= */

           function formatCurrency(amount) {

               return "₦" + Number(amount).toLocaleString(
                   "en-NG", {
                       minimumFractionDigits: 2,
                       maximumFractionDigits: 2
                   }
               );
           }


           /* =========================================================
              BASIC HTML ESCAPING
           ========================================================= */

           function escapeHtml(value) {

               return String(value)
                   .replace(/&/g, "&amp;")
                   .replace(/</g, "&lt;")
                   .replace(/>/g, "&gt;")
                   .replace(/"/g, "&quot;")
                   .replace(/'/g, "&#039;");
           }


           /* =========================================================
              CLOSE WITH ESCAPE
           ========================================================= */

           document.addEventListener("keydown", function(event) {

               if (
                   event.key === "Escape" &&
                   document
                   .getElementById("shippingModal")
                   .classList
                   .contains("is-open")
               ) {

                   closeShippingModal();

               }

           });
       </script>

   </body>

   </html>