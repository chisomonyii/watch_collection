<?php
$orderId = $_GET['order_id'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Your Review — ZEITH</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #0b0f19;
            color: #f3f4f6;
            font-family: Arial, Helvetica, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .review-modal-overlay {
            display: none; 
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(11, 15, 25, 0.85);
            backdrop-filter: blur(4px);
            justify-content: center;
            align-items: center;
            z-index: 9999;
            padding: 20px;
            overflow-y: auto;
        }

        .review-container {
            width: 100%;
            max-width: 600px;
            background: #111827;
            border: 1px solid #1f2937;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.5);
            position: relative;
            max-height: 90vh;
            overflow-y: auto;
        }

        .close-popup-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background: none;
            border: none;
            color: #9ca3af;
            font-size: 24px;
            cursor: pointer;
        }

        .close-popup-btn:hover {
            color: #ffffff;
        }

        .review-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .review-header span {
            color: #f68b1e;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .review-header h2 {
            font-family: Georgia, serif;
            font-size: 32px;
            margin-top: 8px;
            color: #ffffff;
        }

        .review-header p {
            color: #9ca3af;
            font-size: 14px;
            margin-top: 6px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #d1d5db;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="email"],
        select,
        textarea {
            width: 100%;
            padding: 12px 16px;
            background: #1f2937;
            border: 1px solid #374151;
            border-radius: 10px;
            color: #fff;
            font-size: 15px;
            outline: none;
            transition: border-color 0.2s;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        select:focus,
        textarea:focus {
            border-color: #f68b1e;
        }

        textarea {
            resize: vertical;
            height: 120px;
        }

        input[type="file"] {
            color: #9ca3af;
            font-size: 14px;
        }

        .submit-btn {
            width: 100%;
            padding: 14px;
            background: #f68b1e;
            color: #0b0f19;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            font-size: 15px;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: background 0.2s, transform 0.2s;
        }

        .submit-btn:hover {
            background: #e07a14;
            transform: translateY(-2px);
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid #10b981;
            color: #34d399;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            margin-bottom: 20px;
            font-weight: 500;
        }
    </style>
</head>
<body>

<!-- Popup Overlay Container -->
<div class="review-modal-overlay" id="reviewModalOverlay">
    <div class="review-container">
        <button type="button" class="close-popup-btn" id="closePopupBtn">&times;</button>
        
        <div class="review-header">
            <span>ZEITH COMMUNITY</span>
            <h2>Share Your Experience</h2>
            <p>Tell us how your luxury timepiece feels on your wrist.</p>
        </div>

        <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
            <div class="alert-success">
                Thank you! Your review has been submitted successfully and is pending review by our team.
            </div>
        <?php endif; ?>

        <form action="/Watch_Collection/review/store" method="POST" enctype="multipart/form-data" id="reviewForm">
            <input type="hidden" name="order_id" value="<?= htmlspecialchars($orderId) ?>">

            <div class="form-group">
                <label for="customer_name">Your Name</label>
                <input type="text" id="customer_name" name="customer_name" placeholder="e.g., Tunde A." required>
            </div>

            <div class="form-group">
                <label for="title">Review Headline</label>
                <input type="text" id="title" name="title" placeholder="e.g., Flawless and Sophisticated" required>
            </div>

            <div class="form-group">
                <label for="rating">Rating (1 to 5 Stars)</label>
                <select id="rating" name="rating" required>
                    <option value="5">★★★★★ (5 Stars - Exceptional)</option>
                    <option value="4">★★★★☆ (4 Stars - Great)</option>
                    <option value="3">★★★☆☆ (3 Stars - Good)</option>
                    <option value="2">★★☆☆☆ (2 Stars - Fair)</option>
                    <option value="1">★☆☆☆☆ (1 Star - Poor)</option>
                </select>
            </div>

            <div class="form-group">
                <label for="comment">Your Review</label>
                <textarea id="comment" name="comment" placeholder="Describe the quality, look, and fit of your watch..." required></textarea>
            </div>

            <div class="form-group">
                <label for="image">Upload Watch Photo (Optional)</label>
                <input type="file" id="image" name="image" accept="image/*">
            </div>

            <button type="submit" class="submit-btn" id="submitReviewBtn">Submit Review</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const overlay = document.getElementById("reviewModalOverlay");
        const closeBtn = document.getElementById("closePopupBtn");
        const reviewForm = document.getElementById("reviewForm");
        const urlParams = new URLSearchParams(window.location.search);

        // 1. If the user has already submitted a review previously, completely exit
        if (localStorage.getItem("zeith_has_reviewed") === "true") {
            return;
        }

        // 2. If redirected back with a success message, flag that they have reviewed and show the success popup
        if (urlParams.has('success')) {
            localStorage.setItem("zeith_has_reviewed", "true");
            overlay.style.display = "flex";
            return;
        }

        // 3. 4-Day Logic using localStorage for first-time visitors
        const FOUR_DAYS_IN_MS = 4 * 24 * 60 * 60 * 1000;
        const now = new Date().getTime();
        let firstVisit = localStorage.getItem("zeith_first_visit");

        if (!firstVisit) {
            localStorage.setItem("zeith_first_visit", now);
        } else {
            const elapsedTime = now - parseInt(firstVisit, 10);
            if (elapsedTime >= FOUR_DAYS_IN_MS) {
                overlay.style.display = "flex";
            }
        }

        // 4. Mark as reviewed when the submit button is clicked
        if (reviewForm) {
            reviewForm.addEventListener("submit", function () {
                localStorage.setItem("zeith_has_reviewed", "true");
            });
        }

        // 5. Close popup handler
        if (closeBtn) {
            closeBtn.addEventListener("click", function () {
                overlay.style.display = "none";
            });
        }
    });
</script>
</body>
</html>