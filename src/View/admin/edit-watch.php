<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Watch | ZEITH</title>

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


    <!-- =====================================================
     EDIT PAGE
===================================================== -->

    <main class="zeith-edit-page">

        <div class="zeith-edit-container">


            <!-- =================================================
             HEADER
        ================================================= -->

            <div class="zeith-edit-header">

                <h1>Edit Watch</h1>

                <p>
                    Update your watch details, images and product information.
                </p>

            </div>


            <!-- =================================================
             MAIN GRID
        ================================================= -->

            <div class="zeith-edit-grid">


                <!-- =================================================
                 LEFT — FORM
            ================================================= -->

                <form
                    class="zeith-edit-form-card"
                    id="zeithEditForm">


                    <!-- =================================================
                     IMAGES
                ================================================= -->

                    <section class="zeith-form-section">

                        <h2 class="zeith-form-section-title">
                            Watch Images
                        </h2>


                        <div class="zeith-image-upload-box">

                            <div class="zeith-image-upload-top">

                                <div class="zeith-image-upload-info">

                                    <strong>
                                        Upload 4 Watch Images
                                    </strong>

                                    Select exactly 4 images.
                                    These images will appear in the preview.

                                </div>


                                <label class="zeith-image-upload-btn">

                                    Choose Images

                                    <input
                                        type="file"
                                        id="zeithImageInput"
                                        accept="image/png,image/jpeg,image/webp"
                                        multiple>

                                </label>

                            </div>


                            <!-- THUMBNAILS -->

                            <div
                                class="zeith-uploaded-images"
                                id="zeithUploadedImages">

                                <div class="zeith-upload-thumb">
                                    <span class="zeith-upload-number">1</span>
                                </div>

                                <div class="zeith-upload-thumb">
                                    <span class="zeith-upload-number">2</span>
                                </div>

                                <div class="zeith-upload-thumb">
                                    <span class="zeith-upload-number">3</span>
                                </div>

                                <div class="zeith-upload-thumb">
                                    <span class="zeith-upload-number">4</span>
                                </div>

                            </div>


                            <div
                                class="zeith-upload-message"
                                id="zeithUploadMessage">
                                Please select exactly 4 images.
                            </div>

                        </div>

                    </section>


                    <!-- =================================================
                     WATCH INFORMATION
                ================================================= -->

                    <section class="zeith-form-section">

                        <h2 class="zeith-form-section-title">
                            Watch Information
                        </h2>


                        <!-- NAME -->

                        <div class="zeith-form-group">

                            <label>
                                Watch Name
                                <span class="zeith-required">*</span>
                            </label>

                            <input
                                type="text"
                                class="zeith-form-input"
                                id="zeithWatchName"
                                value="Nautilus 5711">

                        </div>


                        <!-- COLLECTION -->

                        <div class="zeith-form-group">

                            <label>
                                Collection
                                <span class="zeith-required">*</span>
                            </label>

                            <select
                                class="zeith-form-select"
                                id="zeithCollection">

                                <option>Classic Collection</option>
                                <option selected>Luxury Collection</option>
                                <option>Sport Collection</option>
                                <option>Chronograph Collection</option>

                            </select>

                        </div>


                        <!-- RATING + PRICE -->

                        <div class="zeith-form-row">

                            <div class="zeith-form-group">

                                <label>
                                    Rating
                                    <span class="zeith-required">*</span>
                                </label>

                                <input
                                    type="number"
                                    class="zeith-form-input"
                                    id="zeithRating"
                                    value="4.9"
                                    min="1"
                                    max="5"
                                    step="0.1">

                            </div>


                            <div class="zeith-form-group">

                                <label>
                                    Price ($)
                                    <span class="zeith-required">*</span>
                                </label>

                                <input
                                    type="number"
                                    class="zeith-form-input"
                                    id="zeithPrice"
                                    value="85000">

                            </div>

                        </div>

                        <!-- =================================================
     STOCK / INVENTORY
================================================= -->

                        <div class="zeith-form-row">

                            <!-- STOCK QUANTITY -->
                            <div class="zeith-form-group">

                                <label>
                                    Stock Quantity
                                    <span class="zeith-required">*</span>
                                </label>

                                <input
                                    type="number"
                                    class="zeith-form-input"
                                    id="zeithStock"
                                    value="12"
                                    min="0"
                                    step="1"
                                    placeholder="Enter available quantity">

                                <small class="zeith-field-help">
                                    Number of units currently available in inventory.
                                </small>

                            </div>


                            <!-- IN STOCK -->
                            <div class="zeith-form-group">

                                <label>
                                    Stock Status
                                    <span class="zeith-required">*</span>
                                </label>

                                <select
                                    class="zeith-form-select"
                                    id="zeithInStock">

                                    <option value="1" selected>
                                        In Stock
                                    </option>

                                    <option value="0">
                                        Out of Stock
                                    </option>

                                </select>

                                <small class="zeith-field-help">
                                    Controls whether this watch is available for purchase.
                                </small>

                            </div>

                        </div>


                        <!-- DESCRIPTION -->

                        <div class="zeith-form-group">

                            <label>
                                Description
                                <span class="zeith-required">*</span>
                            </label>

                            <textarea
                                class="zeith-form-textarea"
                                id="zeithDescription">The Nautilus 5711 is one of the most coveted elite luxury sports watches in existence. A timeless piece combining refined craftsmanship, elegant design and exceptional performance.</textarea>

                        </div>


                        <!-- STRAP -->

                        <!-- =================================================
     STRAP
================================================= -->

                        <div class="zeith-form-group">

                            <label>
                                Strap
                                <span class="zeith-required">*</span>
                            </label>

                            <textarea
                                class="zeith-form-textarea"
                                id="zeithStrap"
                                placeholder="Describe the watch strap...">Stainless steel bracelet with a premium polished finish designed for comfort and durability.</textarea>

                        </div>


                        <!-- =================================================
     WATCH MANUAL
================================================= -->

                        <div class="zeith-form-group zeith-manual-group">

                            <label>
                                Watch Manual
                                <span class="zeith-required">*</span>
                            </label>

                            <div class="zeith-manual-upload">

                                <div class="zeith-manual-icon">
                                    PDF
                                </div>

                                <div class="zeith-manual-content">

                                    <strong>
                                        Upload Watch Manual
                                    </strong>

                                    <span>
                                        Upload a PDF guide for customers to learn how to use the watch.
                                    </span>

                                    <small>
                                        PDF only · Maximum size: 5MB
                                    </small>

                                </div>

                                <label class="zeith-manual-btn">

                                    Choose PDF

                                    <input
                                        type="file"
                                        id="zeithManualInput"
                                        accept="application/pdf,.pdf">

                                </label>

                            </div>

                            <div
                                class="zeith-manual-selected"
                                id="zeithManualSelected"></div>

                        </div>

                    </section>


                    <!-- =================================================
                     ACTIONS
                ================================================= -->

                    <div class="zeith-form-actions">

                        <button
                            type="button"
                            class="zeith-cancel-btn">
                            Cancel
                        </button>

                        <button
                            type="submit"
                            class="zeith-save-btn">
                            Save Changes
                        </button>

                    </div>

                </form>


                <!-- =================================================
                 RIGHT — PREVIEW
            ================================================= -->

                <aside class="zeith-preview-card">

                    <div class="zeith-preview-title">
                        Watch Preview
                    </div>


                    <!-- =================================================
                     IMAGE SLIDER
                ================================================= -->

                    <div
                        class="zeith-preview-slider"
                        id="zeithPreviewSlider">


                        <!-- IMAGE 1 -->

                        <div class="zeith-preview-slide active">

                            <img
                                src="https://images.unsplash.com/photo-1524805444758-089113d48a6d?auto=format&fit=crop&w=900&q=80"
                                alt="Watch preview 1">

                        </div>


                        <!-- IMAGE 2 -->

                        <div class="zeith-preview-slide">

                            <img
                                src="https://images.unsplash.com/photo-1523170335258-f5ed11844a49?auto=format&fit=crop&w=900&q=80"
                                alt="Watch preview 2">

                        </div>


                        <!-- IMAGE 3 -->

                        <div class="zeith-preview-slide">

                            <img
                                src="https://images.unsplash.com/photo-1522312346375-d1a52e2b99b3?auto=format&fit=crop&w=900&q=80"
                                alt="Watch preview 3">

                        </div>


                        <!-- IMAGE 4 -->

                        <div class="zeith-preview-slide">

                            <img
                                src="https://images.unsplash.com/photo-1539874754764-5a96559165b0?auto=format&fit=crop&w=900&q=80"
                                alt="Watch preview 4">

                        </div>


                        <!-- LEFT -->

                        <button
                            type="button"
                            class="zeith-preview-arrow left"
                            id="zeithPreviewPrev"
                            aria-label="Previous image">
                            ‹
                        </button>


                        <!-- RIGHT -->

                        <button
                            type="button"
                            class="zeith-preview-arrow right"
                            id="zeithPreviewNext"
                            aria-label="Next image">
                            ›
                        </button>


                        <!-- INDICATORS -->

                        <div class="zeith-image-indicators">

                            <button
                                type="button"
                                class="zeith-image-indicator active"
                                data-slide="0"></button>

                            <button
                                type="button"
                                class="zeith-image-indicator"
                                data-slide="1"></button>

                            <button
                                type="button"
                                class="zeith-image-indicator"
                                data-slide="2"></button>

                            <button
                                type="button"
                                class="zeith-image-indicator"
                                data-slide="3"></button>

                        </div>

                    </div>


                    <!-- =================================================
                     PREVIEW DETAILS
                ================================================= -->

                    <div class="zeith-preview-details">

                        <h2 id="zeithPreviewName">
                            Nautilus 5711
                        </h2>

                        <p id="zeithPreviewCollection">
                            Collection: Luxury Collection
                        </p>

                        <p style="margin-top: 7px;">
                            Watch description will appear here.
                        </p>


                        <div class="zeith-preview-price">

                            <span>
                                Price
                            </span>

                            <strong id="zeithPreviewPrice">
                                $85,000
                            </strong>

                        </div>

                    </div>

                </aside>

            </div>

        </div>

    </main>



    <script>
        document.addEventListener("DOMContentLoaded", function() {


            /* =====================================================
               IMAGE SLIDER
            ===================================================== */

            const slides = document.querySelectorAll(
                ".zeith-preview-slide"
            );

            const indicators = document.querySelectorAll(
                ".zeith-image-indicator"
            );

            const previousButton = document.getElementById(
                "zeithPreviewPrev"
            );

            const nextButton = document.getElementById(
                "zeithPreviewNext"
            );

            let currentSlide = 0;


            function showSlide(index) {

                if (index < 0) {
                    index = slides.length - 1;
                }

                if (index >= slides.length) {
                    index = 0;
                }

                currentSlide = index;


                /* SHOW CORRECT IMAGE */

                slides.forEach(function(slide, i) {

                    slide.classList.toggle(
                        "active",
                        i === currentSlide
                    );

                });


                /* MOVE INDICATOR */

                indicators.forEach(function(indicator, i) {

                    indicator.classList.toggle(
                        "active",
                        i === currentSlide
                    );

                });

            }


            /* PREVIOUS */

            previousButton.addEventListener(
                "click",
                function() {

                    showSlide(currentSlide - 1);

                }
            );


            /* NEXT */

            nextButton.addEventListener(
                "click",
                function() {

                    showSlide(currentSlide + 1);

                }
            );


            /* INDICATORS */

            indicators.forEach(function(indicator) {

                indicator.addEventListener(
                    "click",
                    function() {

                        showSlide(
                            Number(
                                this.dataset.slide
                            )
                        );

                    }
                );

            });



            /* =====================================================
               IMAGE UPLOAD
            ===================================================== */

            const imageInput = document.getElementById(
                "zeithImageInput"
            );

            const uploadedImages = document.getElementById(
                "zeithUploadedImages"
            );

            const uploadMessage = document.getElementById(
                "zeithUploadMessage"
            );


            imageInput.addEventListener(
                "change",
                function() {

                    const files = Array.from(
                        this.files
                    );


                    /* MUST BE EXACTLY 4 */

                    if (files.length !== 4) {

                        uploadMessage.style.display = "block";

                        uploadedImages.innerHTML = "";

                        for (let i = 1; i <= 4; i++) {

                            uploadedImages.innerHTML += `
                        <div class="zeith-upload-thumb">
                            <span class="zeith-upload-number">
                                ${i}
                            </span>
                        </div>
                    `;

                        }

                        return;

                    }


                    uploadMessage.style.display = "none";


                    /* CLEAR THUMBNAILS */

                    uploadedImages.innerHTML = "";


                    /* CREATE THUMBNAILS */

                    files.forEach(function(file, index) {

                        const reader = new FileReader();


                        reader.onload = function(event) {

                            const thumbnail =
                                document.createElement("div");

                            thumbnail.className =
                                "zeith-upload-thumb";


                            thumbnail.innerHTML = `
                        <img
                            src="${event.target.result}"
                            alt="Watch image ${index + 1}"
                        >

                        <span class="zeith-upload-number">
                            ${index + 1}
                        </span>
                    `;


                            uploadedImages.appendChild(
                                thumbnail
                            );

                        };


                        reader.readAsDataURL(file);

                    });


                    /*
                     * ALSO UPDATE THE PREVIEW
                     */

                    const previewSlides =
                        document.querySelectorAll(
                            ".zeith-preview-slide"
                        );


                    files.forEach(function(file, index) {

                        const reader = new FileReader();


                        reader.onload = function(event) {

                            if (
                                previewSlides[index]
                            ) {

                                previewSlides[index]
                                    .querySelector("img")
                                    .src =
                                    event.target.result;

                            }

                        };


                        reader.readAsDataURL(file);

                    });

                }
            );



            /* =====================================================
               LIVE WATCH NAME
            ===================================================== */

            const watchName =
                document.getElementById(
                    "zeithWatchName"
                );

            const previewName =
                document.getElementById(
                    "zeithPreviewName"
                );


            watchName.addEventListener(
                "input",
                function() {

                    previewName.textContent =
                        this.value || "Watch Name";

                }
            );



            /* =====================================================
               LIVE COLLECTION
            ===================================================== */

            const collection =
                document.getElementById(
                    "zeithCollection"
                );

            const previewCollection =
                document.getElementById(
                    "zeithPreviewCollection"
                );


            collection.addEventListener(
                "change",
                function() {

                    previewCollection.textContent =
                        "Collection: " + this.value;

                }
            );



            /* =====================================================
               LIVE PRICE
            ===================================================== */

            const price =
                document.getElementById(
                    "zeithPrice"
                );

            const previewPrice =
                document.getElementById(
                    "zeithPreviewPrice"
                );


            price.addEventListener(
                "input",
                function() {

                    const number =
                        Number(this.value) || 0;


                    previewPrice.textContent =
                        "$" +
                        number.toLocaleString(
                            "en-US", {
                                minimumFractionDigits: 0
                            }
                        );

                }
            );



            /* =====================================================
               FORM DEMO
            ===================================================== */

            document.getElementById(
                "zeithEditForm"
            ).addEventListener(
                "submit",
                function(event) {

                    event.preventDefault();

                    alert(
                        "Watch changes are ready to be saved."
                    );

                }
            );

        });

        /* =====================================================
   WATCH MANUAL PDF
===================================================== */

        const manualInput = document.getElementById(
            "zeithManualInput"
        );

        const manualSelected = document.getElementById(
            "zeithManualSelected"
        );


        manualInput.addEventListener(
            "change",
            function() {

                const file = this.files[0];

                if (!file) {

                    manualSelected.style.display = "none";

                    manualSelected.textContent = "";

                    return;
                }


                /* MAKE SURE IT IS A PDF */

                if (
                    file.type !== "application/pdf" &&
                    !file.name.toLowerCase().endsWith(".pdf")
                ) {

                    alert("Please select a PDF file.");

                    this.value = "";

                    manualSelected.style.display = "none";

                    return;
                }


                /* 5MB LIMIT */

                const maxSize = 5 * 1024 * 1024;

                if (file.size > maxSize) {

                    alert("The PDF must be smaller than 5MB.");

                    this.value = "";

                    manualSelected.style.display = "none";

                    return;
                }


                /* SHOW SELECTED FILE */

                const fileSize =
                    (file.size / (1024 * 1024))
                    .toFixed(2);


                manualSelected.textContent =
                    "✓ " +
                    file.name +
                    " (" +
                    fileSize +
                    " MB)";


                manualSelected.style.display = "block";

            }
        );

        (function() {

            const stockInput =
                document.getElementById("zeithStock");

            const inStockSelect =
                document.getElementById("zeithInStock");


            function updateStockVisuals() {

                if (!stockInput) {
                    return;
                }

                const stock =
                    parseInt(stockInput.value, 10) || 0;


                stockInput.classList.remove(
                    "zeith-stock-low",
                    "zeith-stock-empty"
                );


                if (stock === 0) {

                    stockInput.classList.add(
                        "zeith-stock-empty"
                    );

                } else if (stock <= 5) {

                    stockInput.classList.add(
                        "zeith-stock-low"
                    );

                }

            }


            function updateStockStatus() {

                if (!inStockSelect) {
                    return;
                }

                inStockSelect.classList.remove(
                    "zeith-status-out"
                );


                if (inStockSelect.value === "0") {

                    inStockSelect.classList.add(
                        "zeith-status-out"
                    );

                }

            }


            if (stockInput) {

                stockInput.addEventListener(
                    "input",
                    updateStockVisuals
                );

                updateStockVisuals();

            }


            if (inStockSelect) {

                inStockSelect.addEventListener(
                    "change",
                    updateStockStatus
                );

                updateStockStatus();

            }

        })();
    </script>

</body>

</html>