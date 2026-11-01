<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Upload Watch | ZEITH</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #F4F6F9;
            color: #0F172A;
        }

        /* =====================================================
           PAGE
        ===================================================== */

        .zeith-edit-page {
            margin-left: 250px;
            min-height: 100vh;
            padding: 32px;
        }

        .zeith-edit-container {
            max-width: 1250px;
            margin: 0 auto;
        }


        /* =====================================================
           PAGE HEADER
        ===================================================== */

        .zeith-edit-header {
            margin-bottom: 26px;
        }

        .zeith-edit-header h1 {
            font-size: 27px;
            font-weight: 750;
            color: #0F172A;
            margin-bottom: 7px;
        }

        .zeith-edit-header p {
            color: #64748B;
            font-size: 14px;
        }


        /* =====================================================
           MAIN GRID
        ===================================================== */

        .zeith-edit-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 390px;
            gap: 24px;
            align-items: start;
        }


        /* =====================================================
           FORM CARD
        ===================================================== */

        .zeith-edit-form-card,
        .zeith-preview-card {
            background: #FFFFFF;
            border: 1px solid #E2E8F0;
            border-radius: 14px;
            box-shadow: 0 4px 16px rgba(15, 23, 42, .05);
        }

        .zeith-edit-form-card {
            padding: 25px;
        }


        /* =====================================================
           SECTION TITLE
        ===================================================== */

        .zeith-form-section {
            margin-bottom: 27px;
        }

        .zeith-form-section:last-child {
            margin-bottom: 0;
        }

        .zeith-form-section-title {
            display: flex;
            align-items: center;
            gap: 9px;

            margin-bottom: 20px;

            font-size: 16px;
            font-weight: 700;
            color: #0F172A;
        }

        .zeith-form-section-title::before {
            content: "";
            width: 4px;
            height: 19px;
            border-radius: 5px;
            background: #2563EB;
        }


        /* =====================================================
           FORM GROUP
        ===================================================== */

        .zeith-form-group {
            margin-bottom: 18px;
        }

        .zeith-form-group:last-child {
            margin-bottom: 0;
        }

        .zeith-form-group label {
            display: block;
            margin-bottom: 7px;

            font-size: 13px;
            font-weight: 650;
            color: #334155;
        }

        .zeith-required {
            color: #EF4444;
        }


        /* =====================================================
           INPUTS
        ===================================================== */

        .zeith-form-input,
        .zeith-form-select,
        .zeith-form-textarea {

            width: 100%;

            border: 1px solid #CBD5E1;
            border-radius: 8px;

            background: #FFFFFF;

            color: #0F172A;

            font-family: inherit;
            font-size: 13px;

            outline: none;

            transition:
                border-color .2s ease,
                box-shadow .2s ease;
        }

        .zeith-form-input,
        .zeith-form-select {
            height: 44px;
            padding: 0 13px;
        }

        .zeith-form-textarea {
            min-height: 120px;
            padding: 12px 13px;
            resize: vertical;
            line-height: 1.6;
        }

        .zeith-form-input:focus,
        .zeith-form-select:focus,
        .zeith-form-textarea:focus {
            border-color: #2563EB;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, .10);
        }


        /* =====================================================
           TWO COLUMN FORM
        ===================================================== */

        .zeith-form-row {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }


        /* =====================================================
           IMAGE UPLOAD
        ===================================================== */

        .zeith-image-upload-box {
            border: 1.5px dashed #CBD5E1;
            border-radius: 10px;
            padding: 16px;
            background: #F8FAFC;
        }

        .zeith-image-upload-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 14px;
        }

        .zeith-image-upload-info {
            color: #64748B;
            font-size: 12px;
            line-height: 1.5;
        }

        .zeith-image-upload-info strong {
            display: block;
            color: #334155;
            font-size: 13px;
            margin-bottom: 3px;
        }

        .zeith-image-upload-btn {
            position: relative;
            overflow: hidden;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            height: 38px;
            padding: 0 15px;

            border: 1px solid #2563EB;
            border-radius: 7px;

            background: #2563EB;
            color: #FFFFFF;

            font-size: 12px;
            font-weight: 700;

            cursor: pointer;
            white-space: nowrap;
        }

        .zeith-image-upload-btn input {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
        }


        /* =====================================================
           FOUR IMAGE THUMBNAILS
        ===================================================== */

        .zeith-uploaded-images {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }

        .zeith-upload-thumb {
            position: relative;
            aspect-ratio: 1 / 1;

            overflow: hidden;

            border: 1px solid #E2E8F0;
            border-radius: 8px;

            background: #F1F5F9;
        }

        .zeith-upload-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .zeith-upload-number {
            position: absolute;
            top: 6px;
            left: 6px;

            min-width: 22px;
            height: 22px;

            padding: 0 5px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 6px;

            background: rgba(15, 23, 42, .75);
            color: #FFFFFF;

            font-size: 10px;
            font-weight: 700;
        }


        /* =====================================================
           PREVIEW CARD
        ===================================================== */

        .zeith-preview-card {
            padding: 20px;
            position: sticky;
            top: 24px;
        }

        .zeith-preview-title {
            font-size: 15px;
            font-weight: 700;
            color: #0F172A;
            margin-bottom: 15px;
        }


        /* =====================================================
           PREVIEW IMAGE
        ===================================================== */

        .zeith-preview-slider {
            position: relative;

            width: 100%;
            aspect-ratio: 1 / 1;

            overflow: hidden;

            border-radius: 11px;

            background: #F8F7F4;
        }

        .zeith-preview-slide {
            width: 100%;
            height: 100%;

            display: none;
            align-items: center;
            justify-content: center;
        }

        .zeith-preview-slide.active {
            display: flex;
        }

        .zeith-preview-slide img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }


        /* =====================================================
           PREVIEW ARROWS
        ===================================================== */

        .zeith-preview-arrow {
            position: absolute;

            top: 50%;
            transform: translateY(-50%);

            width: 38px;
            height: 38px;

            display: flex;
            align-items: center;
            justify-content: center;

            border: none;
            border-radius: 50%;

            background: rgba(255, 255, 255, .94);
            color: #0F172A;

            box-shadow: 0 4px 15px rgba(15, 23, 42, .12);

            font-size: 20px;

            cursor: pointer;

            z-index: 5;

            transition:
                background .2s ease,
                transform .2s ease;
        }

        .zeith-preview-arrow:hover {
            background: #FFFFFF;
        }

        .zeith-preview-arrow.left {
            left: 12px;
        }

        .zeith-preview-arrow.right {
            right: 12px;
        }


        /* =====================================================
           PREVIEW INDICATORS
        ===================================================== */

        .zeith-image-indicators {
            position: absolute;

            left: 18px;
            right: 18px;
            bottom: 12px;

            display: flex;
            gap: 6px;

            z-index: 5;
        }

        .zeith-image-indicator {
            height: 4px;

            flex: 1;

            border: none;
            border-radius: 10px;

            background: rgba(15, 23, 42, .18);

            cursor: pointer;

            transition:
                background .25s ease,
                transform .25s ease;
        }

        .zeith-image-indicator.active {
            background: #2563EB;
        }


        /* =====================================================
           PREVIEW DETAILS
        ===================================================== */

        .zeith-preview-details {
            padding-top: 18px;
        }

        .zeith-preview-details h2 {
            font-size: 19px;
            font-weight: 750;
            color: #0F172A;
            margin-bottom: 7px;
        }

        .zeith-preview-details p {
            color: #64748B;
            font-size: 12px;
            line-height: 1.6;
        }

        .zeith-preview-price {
            display: flex;
            align-items: center;
            justify-content: space-between;

            margin-top: 16px;
            padding-top: 14px;

            border-top: 1px solid #E2E8F0;
        }

        .zeith-preview-price span {
            color: #64748B;
            font-size: 12px;
        }

        .zeith-preview-price strong {
            color: #2563EB;
            font-size: 17px;
        }


        /* =====================================================
           BUTTONS
        ===================================================== */

        .zeith-form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;

            margin-top: 25px;
            padding-top: 20px;

            border-top: 1px solid #E2E8F0;
        }

        .zeith-cancel-btn,
        .zeith-save-btn {
            height: 43px;
            padding: 0 20px;

            border-radius: 8px;

            font-family: inherit;
            font-size: 13px;
            font-weight: 700;

            cursor: pointer;
        }

        .zeith-cancel-btn {
            border: 1px solid #CBD5E1;
            background: #FFFFFF;
            color: #475569;
        }

        .zeith-save-btn {
            border: none;
            background: #2563EB;
            color: #FFFFFF;

            box-shadow: 0 4px 12px rgba(37, 99, 235, .18);
        }

        .zeith-save-btn:hover {
            background: #1D4ED8;
        }


        /* =====================================================
           IMAGE ERROR
        ===================================================== */

        .zeith-upload-message {
            margin-top: 8px;
            color: #EF4444;
            font-size: 11px;
            display: none;
        }


        /* =====================================================
           TABLET
        ===================================================== */

        @media (max-width: 1100px) {

            .zeith-edit-page {
                margin-left: 0;
            }

            .zeith-edit-grid {
                grid-template-columns: minmax(0, 1fr) 340px;
            }

        }


        /* =====================================================
           IPAD / SMALL TABLET
        ===================================================== */

        @media (max-width: 900px) {

            .zeith-edit-page {
                padding: 25px 20px;
            }

            .zeith-edit-grid {
                grid-template-columns: 1fr;
            }

            .zeith-preview-card {
                position: static;
                max-width: 600px;
            }

        }


        /* =====================================================
           MOBILE
        ===================================================== */

        @media (max-width: 600px) {

            .zeith-edit-page {
                padding: 20px 14px;
            }

            .zeith-edit-header h1 {
                font-size: 23px;
            }

            .zeith-edit-form-card,
            .zeith-preview-card {
                padding: 17px;
                border-radius: 11px;
            }

            .zeith-form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .zeith-uploaded-images {
                grid-template-columns: repeat(2, 1fr);
            }

            .zeith-image-upload-top {
                align-items: flex-start;
                flex-direction: column;
            }

            .zeith-image-upload-btn {
                width: 100%;
            }

            .zeith-form-actions {
                flex-direction: column;
            }

            .zeith-cancel-btn,
            .zeith-save-btn {
                width: 100%;
            }

        }

        /* =====================================================
   WATCH MANUAL UPLOAD
===================================================== */

        .zeith-manual-group {
            margin-top: 20px;
        }


        .zeith-manual-upload {

            display: flex;
            align-items: center;

            gap: 14px;

            padding: 15px;

            background: #F8FAFC;

            border: 1px dashed #CBD5E1;

            border-radius: 10px;

            transition:
                border-color .2s ease,
                background .2s ease;
        }


        .zeith-manual-upload:hover {

            border-color: #2563EB;

            background: #F8FAFC;
        }


        /* PDF ICON */

        .zeith-manual-icon {

            width: 46px;
            height: 46px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 9px;

            background: #EFF6FF;

            color: #2563EB;

            font-size: 11px;
            font-weight: 800;

            border: 1px solid #DBEAFE;
        }


        /* CONTENT */

        .zeith-manual-content {

            flex: 1;

            min-width: 0;

            display: flex;
            flex-direction: column;

            gap: 3px;
        }


        .zeith-manual-content strong {

            color: #334155;

            font-size: 13px;

            font-weight: 700;
        }


        .zeith-manual-content span {

            color: #64748B;

            font-size: 11px;

            line-height: 1.4;
        }


        .zeith-manual-content small {

            color: #94A3B8;

            font-size: 10px;

            margin-top: 2px;
        }


        /* CHOOSE PDF BUTTON */

        .zeith-manual-btn {

            position: relative;

            overflow: hidden;

            flex-shrink: 0;

            height: 38px;

            padding: 0 14px;

            display: inline-flex;

            align-items: center;
            justify-content: center;

            border: 1px solid #2563EB;

            border-radius: 7px;

            background: #2563EB;

            color: #FFFFFF;

            font-size: 12px;

            font-weight: 700;

            cursor: pointer;

            white-space: nowrap;

            transition: background .2s ease;
        }


        .zeith-manual-btn:hover {

            background: #1D4ED8;
        }


        .zeith-manual-btn input {

            position: absolute;

            inset: 0;

            width: 100%;
            height: 100%;

            opacity: 0;

            cursor: pointer;
        }


        /* SELECTED FILE */

        .zeith-manual-selected {

            display: none;

            margin-top: 9px;

            padding: 9px 11px;

            border-radius: 7px;

            background: #ECFDF5;

            border: 1px solid #A7F3D0;

            color: #047857;

            font-size: 11px;

            font-weight: 600;
        }


        /* MOBILE */

        @media (max-width: 600px) {

            .zeith-manual-upload {

                align-items: stretch;

                flex-direction: column;

            }

            .zeith-manual-btn {

                width: 100%;

            }

        }

        /* =========================================================
   STOCK / INVENTORY FIELDS
========================================================= */

        .zeith-field-help {
            display: block;
            margin-top: 6px;
            color: #64748B;
            font-size: 11px;
            line-height: 1.5;
        }


        /* LOW STOCK VISUAL STATE */

        #zeithStock.zeith-stock-low {
            border-color: #F59E0B;
            background: #FFFBEB;
        }

        #zeithStock.zeith-stock-empty {
            border-color: #EF4444;
            background: #FEF2F2;
        }


        /* STOCK STATUS */

        #zeithInStock {
            font-weight: 600;
        }

        #zeithInStock.zeith-status-out {
            border-color: #EF4444;
            color: #B91C1C;
            background: #FEF2F2;
        }
    </style>
</head>

<body>
    <?php
    \App\Helpers\View::displayComponent("admin/sidebar.php");
    ?>
    <main class="zeith-edit-page">
        <div class="zeith-edit-container">
            <div class="zeith-edit-header">
                <h1>Upload Watch</h1>
                <p>Upload your watch details, images and product information.</p>
            </div>

            <div class="zeith-edit-grid">
                <!-- Form points to the store route with multipart/form-data encoding -->
                <form action="/Watch_Collection/admin/watch/store" method="POST" enctype="multipart/form-data" class="zeith-edit-form-card" id="zeithEditForm">
                    <section class="zeith-form-section">
                        <h2 class="zeith-form-section-title">Watch Images</h2>

                        <div class="zeith-image-upload-box">
                            <div class="zeith-image-upload-top">
                                <div class="zeith-image-upload-info">
                                    <strong>Upload 4 Watch Images</strong>
                                    Select exactly 4 images. These images will appear in the preview.
                                </div>

                                <label class="zeith-image-upload-btn">
                                    <!-- Single multiple input that captures all 4 images at once -->
                                   <input type="file" name="watch_images[]" id="zeithImageInput" accept="image/png,image/jpeg,image/webp" multiple style="display:none;" required>
                                    <span id="chooseImagesTrigger" style="cursor:pointer;">Choose Images</span>
                                </label>
                            </div>

                            <!-- Hidden fields to hold individual files if your controller reads image_url_1 to 4 -->
                            <div id="hiddenFileInputsContainer"></div>

                            <div class="zeith-uploaded-images" id="zeithUploadedImages">
                                <div class="zeith-upload-thumb"><span class="zeith-upload-number">1</span></div>
                                <div class="zeith-upload-thumb"><span class="zeith-upload-number">2</span></div>
                                <div class="zeith-upload-thumb"><span class="zeith-upload-number">3</span></div>
                                <div class="zeith-upload-thumb"><span class="zeith-upload-number">4</span></div>
                            </div>

                            <div class="zeith-upload-message" id="zeithUploadMessage" style="color: #ef4444; display: none;">
                                Please select exactly 4 images.
                            </div>
                        </div>
                    </section>

                    <section class="zeith-form-section">
                        <h2 class="zeith-form-section-title">Watch Information</h2>

                        <div class="zeith-form-group">
                            <label>
                                Watch Name
                                <span class="zeith-required">*</span>
                            </label>
                            <input type="text" name="name" class="zeith-form-input" id="zeithWatchName" value="" placeholder="Enter watch name" required>
                        </div>

                        <div class="zeith-form-group">
                            <label>
                                Collection
                                <span class="zeith-required">*</span>
                            </label>
                            <select name="collection_id" class="zeith-form-select" id="zeithCollection" required>
                                <option value="" disabled selected>Select a collection</option>
                                <?php if (!empty($collections)): ?>
                                    <?php foreach ($collections as $col): ?>
                                        <option value="<?= $col['id'] ?>"><?= htmlspecialchars($col['name'] ?? $col['title'] ?? 'Collection #' . $col['id']) ?></option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option value="1">Luxury Collection</option>
                                    <option value="2">Classic Collection</option>
                                    <option value="3">Sport Collection</option>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div class="zeith-form-row">
                            <div class="zeith-form-group">
                                <label>
                                    Rating
                                    <span class="zeith-required">*</span>
                                </label>
                                <input type="number" name="rating" class="zeith-form-input" id="zeithRating" value="5.0" min="1" max="5" step="0.1" required>
                            </div>

                            <div class="zeith-form-group">
                                <label>
                                    Price (₦)
                                    <span class="zeith-required">*</span>
                                </label>
                                <input type="number" name="price" class="zeith-form-input" id="zeithPrice" value="" placeholder="0.00" required>
                            </div>
                        </div>

                        <div class="zeith-form-row">
                            <div class="zeith-form-group">
                                <label>
                                    Stock Quantity
                                    <span class="zeith-required">*</span>
                                </label>
                                <input type="number" name="stock" class="zeith-form-input" id="zeithStock" value="1" min="0" step="1" placeholder="Enter available quantity" required>
                                <small class="zeith-field-help">
                                    Number of units currently available in inventory.
                                </small>
                            </div>

                            <div class="zeith-form-group">
                                <label>
                                    Stock Status
                                    <span class="zeith-required">*</span>
                                </label>
                                <select name="in_stock" class="zeith-form-select" id="zeithInStock" required>
                                    <option value="1" selected>In Stock</option>
                                    <option value="0">Out of Stock</option>
                                </select>
                                <small class="zeith-field-help">
                                    Controls whether this watch is available for purchase.
                                </small>
                            </div>
                        </div>

                        <div class="zeith-form-group">
                            <label>
                                Description
                                <span class="zeith-required">*</span>
                            </label>
                            <textarea name="description" class="zeith-form-textarea" id="zeithDescription" placeholder="Enter watch description..." required></textarea>
                        </div>

                        <div class="zeith-form-group">
                            <label>
                                Strap
                                <span class="zeith-required">*</span>
                            </label>
                            <textarea name="strap" class="zeith-form-textarea" id="zeithStrap" placeholder="Describe the watch strap..." required></textarea>
                        </div>

                        <div class="zeith-form-group zeith-manual-group">
                            <label>
                                Watch Manual
                                <span class="zeith-required">*</span>
                            </label>

                            <div class="zeith-manual-upload">
                                <div class="zeith-manual-icon">PDF</div>

                                <div class="zeith-manual-content">
                                    <strong>Upload Watch Manual</strong>
                                    <span>Upload a PDF guide for customers to learn how to use the watch.</span>
                                    <small>PDF only · Maximum size: 5MB</small>
                                </div>

                                <label class="zeith-manual-btn">
                                    Choose PDF
                                    <input type="file" name="manual_file" id="zeithManualInput" accept="application/pdf,.pdf" required>
                                </label>
                            </div>

                            <div class="zeith-manual-selected" id="zeithManualSelected"></div>
                        </div>
                    </section>

                    <div class="zeith-form-actions">
                        <a href="/Watch_Collection/admin/watch" class="zeith-cancel-btn" style="text-decoration: none; display: inline-flex; align-items: center; justify-content: center;">
                            Cancel
                        </a>

                        <button type="submit" class="zeith-save-btn">
                            Upload new watch
                        </button>
                    </div>
                </form>

                <aside class="zeith-preview-card">
                    <div class="zeith-preview-title">
                        Watch Preview
                    </div>

                    <div class="zeith-preview-slider" id="zeithPreviewSlider">
                        <div class="zeith-preview-slide active">
                            <img src="/Watch_Collection/assets/images/placeholder.jpg" alt="Watch preview 1">
                        </div>

                        <div class="zeith-preview-slide">
                            <img src="/Watch_Collection/assets/images/placeholder.jpg" alt="Watch preview 2">
                        </div>

                        <div class="zeith-preview-slide">
                            <img src="/Watch_Collection/assets/images/placeholder.jpg" alt="Watch preview 3">
                        </div>

                        <div class="zeith-preview-slide">
                            <img src="/Watch_Collection/assets/images/placeholder.jpg" alt="Watch preview 4">
                        </div>

                        <button type="button" class="zeith-preview-arrow left" id="zeithPreviewPrev" aria-label="Previous image">
                            ‹
                        </button>

                        <button type="button" class="zeith-preview-arrow right" id="zeithPreviewNext" aria-label="Next image">
                            ›
                        </button>

                        <div class="zeith-image-indicators">
                            <button type="button" class="zeith-image-indicator active" data-slide="0"></button>
                            <button type="button" class="zeith-image-indicator" data-slide="1"></button>
                            <button type="button" class="zeith-image-indicator" data-slide="2"></button>
                            <button type="button" class="zeith-image-indicator" data-slide="3"></button>
                        </div>
                    </div>

                    <div class="zeith-preview-details">
                        <h2 id="zeithPreviewName">
                            Watch Name
                        </h2>

                        <p id="zeithPreviewCollection">
                            Collection: Select a collection
                        </p>

                        <p id="zeithPreviewDesc" style="margin-top: 7px;">
                            Watch description will appear here.
                        </p>

                        <div class="zeith-preview-price">
                            <span>Price</span>

                            <strong id="zeithPreviewPrice">
                                ₦0
                            </strong>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </main>



    <script>
document.addEventListener("DOMContentLoaded", function() {
    const chooseTrigger = document.getElementById("chooseImagesTrigger");
    const imageInput = document.getElementById("zeithImageInput");
    const uploadedImages = document.getElementById("zeithUploadedImages");
    const uploadMessage = document.getElementById("zeithUploadMessage");
    const manualInput = document.getElementById("zeithManualInput");
    const manualSelected = document.getElementById("zeithManualSelected");
    const slides = document.querySelectorAll(".zeith-preview-slide");
    const indicators = document.querySelectorAll(".zeith-image-indicator");
    const previousButton = document.getElementById("zeithPreviewPrev");
    const nextButton = document.getElementById("zeithPreviewNext");
    let currentSlide = 0;

    // Trigger file selection dialog
    if (chooseTrigger && imageInput) {
        chooseTrigger.addEventListener("click", function() {
            imageInput.click();
        });
    }

    function showSlide(index) {
        if (!slides.length) return;
        if (index < 0) index = slides.length - 1;
        if (index >= slides.length) index = 0;
        currentSlide = index;
        slides.forEach((slide, i) => slide.classList.toggle("active", i === currentSlide));
        indicators.forEach((indicator, i) => indicator.classList.toggle("active", i === currentSlide));
    }

    if (previousButton) previousButton.addEventListener("click", () => showSlide(currentSlide - 1));
    if (nextButton) nextButton.addEventListener("click", () => showSlide(currentSlide + 1));
    indicators.forEach((indicator, index) => {
        indicator.addEventListener("click", () => showSlide(index));
    });

    // Image Upload & Validation Handler (Must be exactly 4)
    if (imageInput) {
        imageInput.addEventListener("change", function() {
            const files = Array.from(this.files);

            if (files.length !== 4) {
                if (uploadMessage) {
                    uploadMessage.style.display = "block";
                    uploadMessage.textContent = "Please select exactly 4 images (You selected " + files.length + ").";
                }
                this.value = ""; // Reset file input
                return;
            }

            if (!files.every(file => ["image/jpeg", "image/png", "image/webp"].includes(file.type))) {
                if (uploadMessage) {
                    uploadMessage.style.display = "block";
                    uploadMessage.textContent = "Please select only PNG, JPEG, or WEBP images.";
                }
                this.value = "";
                return;
            }

            if (uploadMessage) uploadMessage.style.display = "none";
            if (uploadedImages) uploadedImages.innerHTML = "";

            files.forEach((file, index) => {
                const reader = new FileReader();

                reader.onload = function(event) {
                    if (uploadedImages) {
                        const thumbnail = document.createElement("div");
                        thumbnail.className = "zeith-upload-thumb";
                        thumbnail.style.backgroundImage = `url('${event.target.result}')`;
                        thumbnail.style.backgroundSize = "cover";
                        thumbnail.style.backgroundPosition = "center";

                        const number = document.createElement("span");
                        number.className = "zeith-upload-number";
                        number.textContent = index + 1;
                        thumbnail.appendChild(number);
                        uploadedImages.appendChild(thumbnail);
                    }

                    const image = slides[index] ? slides[index].querySelector("img") : null;
                    if (image) image.src = event.target.result;
                };

                reader.readAsDataURL(file);
            });

            showSlide(0);
        });
    }

    // Live Text Preview Bindings
    const watchName = document.getElementById("zeithWatchName");
    const previewName = document.getElementById("zeithPreviewName");
    if (watchName && previewName) {
        watchName.addEventListener("input", function() {
            previewName.textContent = this.value.trim() || "Watch Name";
        });
    }

    const collection = document.getElementById("zeithCollection");
    const previewCollection = document.getElementById("zeithPreviewCollection");
    if (collection && previewCollection) {
        collection.addEventListener("change", function() {
            const selectedText = this.options[this.selectedIndex].text;
            previewCollection.textContent = "Collection: " + selectedText;
        });
    }

    const price = document.getElementById("zeithPrice");
    const previewPrice = document.getElementById("zeithPreviewPrice");
    if (price && previewPrice) {
        price.addEventListener("input", function() {
            const number = Number(this.value) || 0;
            previewPrice.textContent = "₦" + number.toLocaleString("en-US");
        });
    }

    const description = document.getElementById("zeithDescription");
    const previewDescription = document.getElementById("zeithPreviewDesc");
    if (description && previewDescription) {
        description.addEventListener("input", function() {
            previewDescription.textContent = this.value.trim() || "Watch description will appear here.";
        });
    }

    // Manual PDF Validation Handler
    if (manualInput) {
        manualInput.addEventListener("change", function() {
            const file = this.files[0];

            if (!file) {
                if (manualSelected) {
                    manualSelected.style.display = "none";
                    manualSelected.textContent = "";
                }
                return;
            }

            if (file.type !== "application/pdf" && !file.name.toLowerCase().endsWith(".pdf")) {
                alert("Please select a PDF file.");
                this.value = "";
                if (manualSelected) manualSelected.style.display = "none";
                return;
            }

            if (file.size > 5 * 1024 * 1024) {
                alert("The PDF must be smaller than 5MB.");
                this.value = "";
                if (manualSelected) manualSelected.style.display = "none";
                return;
            }

            if (manualSelected) {
                manualSelected.textContent = "✓ " + file.name + " (" + (file.size / (1024 * 1024)).toFixed(2) + " MB)";
                manualSelected.style.display = "block";
            }
        });
    }

    // Stock Visual State Handlers
    const stockInput = document.getElementById("zeithStock");
    const inStockSelect = document.getElementById("zeithInStock");

    function updateStockVisuals() {
        if (!stockInput) return;
        const stock = parseInt(stockInput.value, 10) || 0;
        stockInput.classList.remove("zeith-stock-low", "zeith-stock-empty");

        if (stock === 0) stockInput.classList.add("zeith-stock-empty");
        else if (stock <= 5) stockInput.classList.add("zeith-stock-low");
    }

    function updateStockStatus() {
        if (!inStockSelect) return;
        inStockSelect.classList.toggle("zeith-status-out", inStockSelect.value === "0");
    }

    if (stockInput) {
        stockInput.addEventListener("input", updateStockVisuals);
        updateStockVisuals();
    }

    if (inStockSelect) {
        inStockSelect.addEventListener("change", updateStockStatus);
        updateStockStatus();
    }
});
</script>

</body>

</html>