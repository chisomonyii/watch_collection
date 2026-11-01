<?php
// src/View/components/newsletter-modal.php
?>
<style>
    .zeith-modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(4px);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 100000;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.4s ease;
    }

    .zeith-modal-overlay.show {
        opacity: 1;
        pointer-events: auto;
    }

    .zeith-newsletter-card {
        background: #fdfbf7; /* Luxury Milk / Warm Ivory color */
        color: #111111;
        border: 1px solid #e5dfd3;
        border-radius: 16px;
        width: 90%;
        max-width: 440px;
        padding: 40px 32px;
        position: relative;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
        transform: translateY(20px);
        transition: transform 0.4s ease;
    }

    .zeith-modal-overlay.show .zeith-newsletter-card {
        transform: translateY(0);
    }

    .zeith-modal-close {
        position: absolute;
        top: 16px;
        right: 20px;
        background: none;
        border: none;
        color: #6b7280;
        font-size: 24px;
        cursor: pointer;
        transition: color 0.2s;
    }

    .zeith-modal-close:hover {
        color: #111111;
    }

    .zeith-newsletter-title {
        font-family: Georgia, serif;
        font-size: 26px;
        color: #111111;
        margin-bottom: 10px;
        text-align: center;
    }

    .zeith-newsletter-subtitle {
        font-size: 13px;
        color: #555555;
        text-align: center;
        line-height: 1.5;
        margin-bottom: 25px;
    }

    .zeith-form-group {
        margin-bottom: 16px;
    }

    .zeith-input, .zeith-select {
        width: 100%;
        padding: 12px 16px;
        background: #ffffff;
        border: 1px solid #dcd6c8;
        border-radius: 8px;
        color: #111111;
        font-size: 14px;
        outline: none;
        transition: border-color 0.2s;
    }

    .zeith-input:focus, .zeith-select:focus {
        border-color: #f68b1e;
    }

    .zeith-submit-btn {
        width: 100%;
        padding: 14px;
        background: #111111;
        color: #ffffff;
        border: none;
        border-radius: 8px;
        font-weight: 700;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 1px;
        cursor: pointer;
        margin-top: 10px;
        transition: background 0.2s;
    }

    .zeith-submit-btn:hover {
        background: #f68b1e;
        color: #111111;
    }

    .zeith-newsletter-msg {
        margin-top: 12px;
        font-size: 12px;
        text-align: center;
        display: none;
    }
</style>

<div class="zeith-modal-overlay" id="newsletterModalOverlay">
    <div class="zeith-newsletter-card">
        <button class="zeith-modal-close" id="closeNewsletterModal">&times;</button>
        
        <h3 class="zeith-newsletter-title">Sign up to Zeith</h3>
        <p class="zeith-newsletter-subtitle">Stay up to date on re-stocks, new product releases, and exclusive horology insights.</p>

        <form id="zeithNewsletterForm">
            <div class="zeith-form-group">
                <input type="text" name="name" class="zeith-input" placeholder="Your Name" required>
            </div>
            <div class="zeith-form-group">
                <input type="email" name="email" class="zeith-input" placeholder="Email Address" required>
            </div>
            <div class="zeith-form-group">
                <select name="interest" class="zeith-select">
                    <option value="All Watches">Select your interest</option>
                    <option value="Master Chronometers">Master Chronometers</option>
                    <option value="Dive Watches">Dive Watches</option>
                    <option value="Vintage Collectibles">Vintage Collectibles</option>
                </select>
            </div>
            <button type="submit" class="zeith-submit-btn">SIGN UP</button>
        </form>

        <div class="zeith-newsletter-msg" id="newsletterMsg"></div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const overlay = document.getElementById("newsletterModalOverlay");
        const closeBtn = document.getElementById("closeNewsletterModal");
        const form = document.getElementById("zeithNewsletterForm");
        const msg = document.getElementById("newsletterMsg");

        if (!localStorage.getItem("zeith_newsletter_dismissed")) {
            setTimeout(() => {
                overlay.classList.add("show");
            }, 2500);
        }

        closeBtn.addEventListener("click", function () {
            overlay.classList.remove("show");
            localStorage.setItem("zeith_newsletter_dismissed", "true");
        });

        form.addEventListener("submit", function (e) {
            e.preventDefault();
            const formData = new FormData(form);

            fetch('/Zeith/api/subscribe', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                msg.style.display = "block";
                if (data.success) {
                    msg.style.color = "#047857";
                    msg.textContent = "Thank you for subscribing to Zeith!";
                    localStorage.setItem("zeith_newsletter_dismissed", "true");
                    setTimeout(() => {
                        overlay.classList.remove("show");
                    }, 1800);
                } else {
                    msg.style.color = "#b91c1c";
                    msg.textContent = data.message || "Something went wrong.";
                }
            })
            .catch(() => {
                msg.style.display = "block";
                msg.style.color = "#b91c1c";
                msg.textContent = "Error submitting request.";
            });
        });
    });
</script>