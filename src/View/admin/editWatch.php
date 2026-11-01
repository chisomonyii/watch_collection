<?php
$watch = $watch ?? [];
$collections = $collections ?? [];

\App\Helpers\View::displayComponent("admin/sidebar.php");

// Prepare existing images array matching your assets/image/ folder structure
$existingImages = [];
for ($i = 1; $i <= 4; $i++) {
    $imgCol = 'image_url_' . $i;
    if (!empty($watch[$imgCol])) {
        $val = trim($watch[$imgCol]);
        if (filter_var($val, FILTER_VALIDATE_URL) || strpos($val, '/') === 0) {
            $existingImages[] = $val;
        } else {
            $existingImages[] = '/Zeith/assets/image/' . $val;
        }
    }
}
?>

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

    <?php
    \App\Helpers\View::displayComponent("admin/sidebar.php");
    ?>



    <main class="zeith-edit-page">
        <div class="zeith-edit-container">
            <div class="zeith-edit-header">
                <h1>Edit Watch</h1>
                <p>Update your watch details, images and product information.</p>
            </div>

            <div class="zeith-edit-grid">
                <!-- Connect form directly to update controller route with multipart encoding for files -->
                <form action="/Zeith/admin/watch/update/<?= htmlspecialchars($watch['id']) ?>"
                    method="POST"
                    enctype="multipart/form-data"
                    class="zeith-edit-form-card"
                    id="zeithEditForm">

                    <section class="zeith-form-section">
                        <h2 class="zeith-form-section-title">Watch Images</h2>

                        <div class="zeith-image-upload-box">
                            <div class="zeith-image-upload-top">
                                <div class="zeith-image-upload-info">
                                    <strong>Upload 4 Watch Images</strong>
                                    Select up to 4 images to update existing product photos.
                                </div>

                                <label class="zeith-image-upload-btn">
                                    Choose Images
                                    <!-- Use individual image input array or standard multi-file uploads -->
                                    <input
                                        type="file"
                                        name="watch_images[]"
                                        id="zeithImageInput"
                                        accept="image/png,image/jpeg,image/webp"
                                        multiple>
                                </label>
                            </div>

                            <div class="zeith-uploaded-images" id="zeithUploadedImages">
                                <?php for ($i = 0; $i < 4; $i++): ?>
                                    <div class="zeith-upload-thumb" style="background-size: cover; background-position: center; <?= isset($existingImages[$i]) ? "background-image: url('{$existingImages[$i]}');" : "" ?>">
                                        <span class="zeith-upload-number"><?= $i + 1 ?></span>
                                    </div>
                                <?php endfor; ?>
                            </div>

                            <div class="zeith-upload-message" id="zeithUploadMessage">
                                Leave empty if you want to keep the current images.
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

                            <input
                                type="text"
                                name="name"
                                class="zeith-form-input"
                                id="zeithWatchName"
                                value="<?= htmlspecialchars($watch['name'] ?? '') ?>"
                                required>
                        </div>

                        <div class="zeith-form-group">
                            <label>
                                Collection
                                <span class="zeith-required">*</span>
                            </label>

                            <select name="collection_id" class="zeith-form-select" id="zeithCollection" required>
                                <?php if (!empty($collections)): ?>
                                    <?php foreach ($collections as $col): ?>
                                        <option value="<?= $col['id'] ?>" <?= (isset($watch['collection_id']) && $watch['collection_id'] == $col['id']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($col['name'] ?? $col['title'] ?? 'Collection #' . $col['id']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option value="1" selected>Default Collection</option>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div class="zeith-form-row">
                            <div class="zeith-form-group">
                                <label>
                                    Rating
                                    <span class="zeith-required">*</span>
                                </label>

                                <input
                                    type="number"
                                    name="rating"
                                    class="zeith-form-input"
                                    id="zeithRating"
                                    value="<?= htmlspecialchars($watch['rating'] ?? '5.0') ?>"
                                    min="1"
                                    max="5"
                                    step="0.1"
                                    required>
                            </div>

                            <div class="zeith-form-group">
                                <label>
                                    Price (₦)
                                    <span class="zeith-required">*</span>
                                </label>

                                <input
                                    type="number"
                                    name="price"
                                    class="zeith-form-input"
                                    id="zeithPrice"
                                    value="<?= htmlspecialchars($watch['price'] ?? '') ?>"
                                    required>
                            </div>
                        </div>

                        <div class="zeith-form-row">
                            <div class="zeith-form-group">
                                <label>
                                    Stock Quantity
                                    <span class="zeith-required">*</span>
                                </label>

                                <input
                                    type="number"
                                    name="stock"
                                    class="zeith-form-input"
                                    id="zeithStock"
                                    value="<?= htmlspecialchars($watch['stock'] ?? '1') ?>"
                                    min="0"
                                    step="1"
                                    placeholder="Enter available quantity"
                                    required>

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
                                    <option value="1" <?= (isset($watch['in_stock']) && $watch['in_stock'] == 1) ? 'selected' : '' ?>>In Stock</option>
                                    <option value="0" <?= (isset($watch['in_stock']) && $watch['in_stock'] == 0) ? 'selected' : '' ?>>Out of Stock</option>
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

                            <textarea name="description" class="zeith-form-textarea" id="zeithDescription" required><?= htmlspecialchars($watch['description'] ?? '') ?></textarea>
                        </div>

                        <div class="zeith-form-group">
                            <label>
                                Strap
                                <span class="zeith-required">*</span>
                            </label>

                            <textarea
                                name="strap"
                                class="zeith-form-textarea"
                                id="zeithStrap"
                                placeholder="Describe the watch strap..."
                                required><?= htmlspecialchars($watch['strap'] ?? '') ?></textarea>
                        </div>

                        <div class="zeith-form-group zeith-manual-group">
                            <label>Watch Manual</label>

                            <div class="zeith-manual-upload">
                                <div class="zeith-manual-icon">PDF</div>

                                <div class="zeith-manual-content">
                                    <strong>Upload Watch Manual</strong>
                                    <span>
                                        <?php if (!empty($watch['manual_file'])): ?>
                                            Current file: <em><?= htmlspecialchars($watch['manual_file']) ?></em>
                                        <?php else: ?>
                                            Upload a PDF guide for customers to learn how to use the watch.
                                        <?php endif; ?>
                                    </span>
                                    <small>PDF only · Maximum size: 5MB</small>
                                </div>

                                <label class="zeith-manual-btn">
                                    Choose PDF
                                    <input
                                        type="file"
                                        name="manual_file"
                                        id="zeithManualInput"
                                        accept="application/pdf,.pdf">
                                </label>
                            </div>

                            <div class="zeith-manual-selected" id="zeithManualSelected"></div>
                        </div>
                    </section>

                    <div class="zeith-form-actions">
                        <a href="/Zeith/admin/watch" class="zeith-cancel-btn" style="text-decoration: none; display: inline-flex; align-items: center; justify-content: center;">
                            Cancel
                        </a>

                        <button type="submit" class="zeith-save-btn">
                            Save Changes
                        </button>
                    </div>
                </form>

                <!-- Live Watch Preview Panel -->
                <aside class="zeith-preview-card">
                    <div class="zeith-preview-title">Watch Preview</div>

                    <div class="zeith-preview-slider" id="zeithPreviewSlider">
                        <?php if (!empty($existingImages)): ?>
                            <?php foreach ($existingImages as $idx => $imgSrc): ?>
                                <div class="zeith-preview-slide <?= $idx === 0 ? 'active' : '' ?>">
                                    <img src="<?= htmlspecialchars($imgSrc) ?>" alt="Watch preview <?= $idx + 1 ?>">
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="zeith-preview-slide active">
                                <img src="/Zeith/assets/images/placeholder.jpg" alt="Watch preview">
                            </div>
                        <?php endif; ?>

                        <button type="button" class="zeith-preview-arrow left" id="zeithPreviewPrev" aria-label="Previous image">‹</button>
                        <button type="button" class="zeith-preview-arrow right" id="zeithPreviewNext" aria-label="Next image">›</button>

                        <div class="zeith-image-indicators">
                            <?php for ($i = 0; $i < count($existingImages ?: [1]); $i++): ?>
                                <button type="button" class="zeith-image-indicator <?= $i === 0 ? 'active' : '' ?>" data-slide="<?= $i ?>"></button>
                            <?php endfor; ?>
                        </div>
                    </div>

                    <div class="zeith-preview-details">
                        <h2 id="zeithPreviewName"><?= htmlspecialchars($watch['name'] ?? 'Watch Name') ?></h2>

                        <p id="zeithPreviewCollection">
                            Collection: Selected Collection
                        </p>

                        <p id="zeithPreviewDesc" style="margin-top: 7px;">
                            <?= htmlspecialchars($watch['description'] ?? 'Watch description will appear here.') ?>
                        </p>

                        <div class="zeith-preview-price">
                            <span>Price</span>
                            <strong id="zeithPreviewPrice">
                                ₦<?= number_format((float)($watch['price'] ?? 0), 2) ?>
                            </strong>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </main>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const slides = document.querySelectorAll(".zeith-preview-slide");
            const indicators = document.querySelectorAll(".zeith-image-indicator");
            const previousButton = document.getElementById("zeithPreviewPrev");
            const nextButton = document.getElementById("zeithPreviewNext");
            let currentSlide = 0;

            function showSlide(index) {
                if (index < 0) {
                    index = slides.length - 1;
                }

                if (index >= slides.length) {
                    index = 0;
                }

                currentSlide = index;

                slides.forEach(function(slide, i) {
                    slide.classList.toggle("active", i === currentSlide);
                });

                indicators.forEach(function(indicator, i) {
                    indicator.classList.toggle("active", i === currentSlide);
                });
            }

            if (previousButton) {
                previousButton.addEventListener("click", function() {
                    showSlide(currentSlide - 1);
                });
            }

            if (nextButton) {
                nextButton.addEventListener("click", function() {
                    showSlide(currentSlide + 1);
                });
            }

            indicators.forEach(function(indicator) {
                indicator.addEventListener("click", function() {
                    showSlide(Number(this.dataset.slide));
                });
            });

            const imageInput = document.getElementById("zeithImageInput");
            const uploadedImages = document.getElementById("zeithUploadedImages");
            const uploadMessage = document.getElementById("zeithUploadMessage");

            if (imageInput) {
                imageInput.addEventListener("change", function() {
                    const files = Array.from(this.files);

                    if (files.length > 0 && files.length !== 4) {
                        uploadMessage.style.display = "block";
                        uploadMessage.textContent = "Please select exactly 4 images if you wish to replace them.";
                        return;
                    } else if (files.length === 0) {
                        return;
                    }

                    uploadMessage.style.display = "none";
                    uploadedImages.innerHTML = "";

                    files.forEach(function(file, index) {
                        const reader = new FileReader();

                        reader.onload = function(event) {
                            const thumbnail = document.createElement("div");
                            thumbnail.className = "zeith-upload-thumb";
                            thumbnail.style.backgroundImage = `url('${event.target.result}')`;
                            thumbnail.style.backgroundSize = "cover";
                            thumbnail.style.backgroundPosition = "center";

                            thumbnail.innerHTML = `
                        <span class="zeith-upload-number">${index + 1}</span>
                    `;

                            uploadedImages.appendChild(thumbnail);
                        };

                        reader.readAsDataURL(file);
                    });

                    const previewSlides = document.querySelectorAll(".zeith-preview-slide");

                    files.forEach(function(file, index) {
                        const reader = new FileReader();

                        reader.onload = function(event) {
                            if (previewSlides[index]) {
                                previewSlides[index].querySelector("img").src = event.target.result;
                            }
                        };

                        reader.readAsDataURL(file);
                    });
                });
            }

            const watchName = document.getElementById("zeithWatchName");
            const previewName = document.getElementById("zeithPreviewName");

            if (watchName && previewName) {
                watchName.addEventListener("input", function() {
                    previewName.textContent = this.value || "Watch Name";
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

                    previewPrice.textContent = "₦" + number.toLocaleString("en-US", {
                        minimumFractionDigits: 0
                    });
                });
            }

            // 🛑 REMOVED event.preventDefault() so the form posts data to your backend controller properly!

            const manualInput = document.getElementById("zeithManualInput");
            const manualSelected = document.getElementById("zeithManualSelected");

            if (manualInput) {
                manualInput.addEventListener("change", function() {
                    const file = this.files[0];

                    if (!file) {
                        manualSelected.style.display = "none";
                        manualSelected.textContent = "";
                        return;
                    }

                    if (
                        file.type !== "application/pdf" &&
                        !file.name.toLowerCase().endsWith(".pdf")
                    ) {
                        alert("Please select a PDF file.");
                        this.value = "";
                        manualSelected.style.display = "none";
                        return;
                    }

                    const maxSize = 5 * 1024 * 1024;

                    if (file.size > maxSize) {
                        alert("The PDF must be smaller than 5MB.");
                        this.value = "";
                        manualSelected.style.display = "none";
                        return;
                    }

                    const fileSize = (file.size / (1024 * 1024)).toFixed(2);

                    manualSelected.textContent = "✓ " + file.name + " (" + fileSize + " MB)";
                    manualSelected.style.display = "block";
                });
            }

            (function() {
                const stockInput = document.getElementById("zeithStock");
                const inStockSelect = document.getElementById("zeithInStock");

                function updateStockVisuals() {
                    if (!stockInput) return;
                    const stock = parseInt(stockInput.value, 10) || 0;

                    stockInput.classList.remove("zeith-stock-low", "zeith-stock-empty");

                    if (stock === 0) {
                        stockInput.classList.add("zeith-stock-empty");
                    } else if (stock <= 5) {
                        stockInput.classList.add("zeith-stock-low");
                    }
                }

                function updateStockStatus() {
                    if (!inStockSelect) return;
                    inStockSelect.classList.remove("zeith-status-out");

                    if (inStockSelect.value === "0") {
                        inStockSelect.classList.add("zeith-status-out");
                    }
                }

                if (stockInput) {
                    stockInput.addEventListener("input", updateStockVisuals);
                    updateStockVisuals();
                }

                if (inStockSelect) {
                    inStockSelect.addEventListener("change", updateStockStatus);
                    updateStockStatus();
                }
            })();
        });
    </script>

</body>

</html>