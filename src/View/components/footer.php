<style>
/* =========================================
   ZEITH LUXURY FOOTER WITH WATCH BACKGROUND
   ========================================= */

/* =========================================
   ZEITH LUXURY FOOTER (RESPONSIVE BACKGROUNDS)
   ========================================= */

/* 1. DESKTOP / LAPTOP MODE (Screens wider than 1024px) */
.zeith-footer {
    position: relative;
    width: 100%;
    padding: 60px 40px 40px;
    color: #a1a1a1;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
    
    /* Desktop Watch Background */
    background-image: 
        linear-gradient(180deg, rgba(15, 17, 21, 0.45) 0%, rgba(8, 10, 14, 0.85) 100%),
        url('<?php assets("image/footer-background.jpg"); ?>');
    background-size: cover;
    background-position: center top;
    background-repeat: no-repeat;
    overflow: hidden;
    box-sizing: border-box;
}

/* 2. PHONE & IPAD / TABLET MODE (Screens 1024px and below) */
@media (max-width: 1024px) {
    .zeith-footer {
        /* Mobile & Tablet Watch Background */
        background-image: 
            linear-gradient(180deg, rgba(15, 17, 21, 0.40) 0%, rgba(8, 10, 14, 0.85) 100%),
            url('<?php assets("image/pat-taylor-12V36G17IbQ-unsplash (1).jpg"); ?>');
        background-size: cover;
        background-position: center center;
    }
}
.zeith-footer-container {
    position: relative;
    z-index: 2;
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1.2fr 1fr 1fr 1.5fr;
    gap: 40px;
}

/* Brand & Column Titles */
.zeith-logo {
    font-family: Georgia, 'Times New Roman', serif;
    font-size: 32px;
    font-weight: 400;
    letter-spacing: 4px;
    color: #e0e0e0;
    margin: 0 0 20px 0;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.8);
}

.zeith-footer-col h3 {
    font-size: 14px;
    font-weight: 600;
    letter-spacing: 1.5px;
    color: #d1d1d1;
    margin-bottom: 22px;
    text-transform: uppercase;
}

/* Navigation Links */
.zeith-footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.zeith-footer-links li {
    margin-bottom: 12px;
}

.zeith-footer-links a {
    color: #8c929a;
    text-decoration: none;
    font-weight: 500;
    font-size: 17px;
    transition: color 0.3s ease;
}

.zeith-footer-links a:hover {
    color: #ffffff;
}

/* Newsletter Subscription Box */
.zeith-newsletter-form {
    display: flex;
    align-items: center;
    background: rgba(255, 255, 255, 0.07);
    border: 1px solid rgba(255, 255, 255, 0.15);
    border-radius: 8px;
    padding: 4px;
    backdrop-filter: blur(5px);
}

.zeith-newsletter-form input {
    flex: 1;
    background: transparent;
    border: none;
    padding: 10px 14px;
    color: #ffffff;
    font-size: 13px;
    outline: none;
}

.zeith-newsletter-form input::placeholder {
    color: #6b7280;
}

.zeith-newsletter-form button {
    background: #25282e;
    color: #e5e7eb;
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 6px;
    padding: 8px 16px;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
}

.zeith-newsletter-form button:hover {
    background: #f68b1e;
    color: #ffffff;
}

/* Social Icons Row */
.zeith-social-links {
    display: flex;
    gap: 18px;
    margin-top: 25px;
    align-items: center;
}

.zeith-social-links a {
    color: #9ca3af;
    font-size: 18px;
    transition: transform 0.2s ease, color 0.2s ease;
}

.zeith-social-links a:hover {
    color: #ffffff;
    transform: translateY(-2px);
}

/* Metallic Bottom Divider */
.zeith-footer-divider {
    position: relative;
    z-index: 2;
    max-width: 1200px;
    height: 6px;
    margin: 50px auto 0;
    background: linear-gradient(
        90deg, 
        rgba(255,255,255,0.05) 0%, 
        #a3a3a3 20%, 
        #ffffff 50%, 
        #a3a3a3 80%, 
        rgba(255,255,255,0.05) 100%
    );
    border-radius: 3px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.8), 0 0 8px rgba(255, 255, 255, 0.3);
}

/* Responsive adjustments */
@media (max-width: 900px) {
    .zeith-footer-container {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 550px) {
    .zeith-footer-container {
        grid-template-columns: 1fr;
    }
}
</style>

<footer class="zeith-footer">
    <div class="zeith-footer-container">
        <!-- Column 1: Brand & Direct Links -->
        <div class="zeith-footer-col">
            <h2 class="zeith-logo">ZEITH</h2>
            <ul class="zeith-footer-links">
                <li><a href="/Watch_Collection/user/watch">Collections</a></li>
                <li><a href="/Watch_Collection/user/watch">New Arrivals</a></li>
                <li><a href="/Watch_Collection/home#best-sellers">Best Sellers</a></li>
            </ul>
        </div>

        <!-- Column 2: About -->
        <div class="zeith-footer-col">
            <h3>ABOUT</h3>
            <ul class="zeith-footer-links">
                <li><a href="#">Brand History</a></li>
                <li><a href="#">Craftsmanship</a></li>
                <li><a href="#">Sustainability</a></li>
            </ul>
        </div>

        <!-- Column 3: Support -->
        <div class="zeith-footer-col">
            <h3>SUPPORT</h3>
            <ul class="zeith-footer-links">
                <li><a href="/Watch_Collection/user/contact">Contact Us</a></li>
                <li><a href="/Watch_Collection/track">Track Your Order</a></li>
                <li><a href="#">Shipping</a></li>
                <li><a href="#">Returns</a></li>
            </ul>
        </div>

        <!-- Column 4: Newsletter & Social -->
        <div class="zeith-footer-col">
            <h3>STAY CONNECTED</h3>
            <form class="zeith-newsletter-form" action="#" method="POST">
                <input type="email" placeholder="Enter email address" required>
                <button type="submit">Subscribe</button>
            </form>

            <div class="zeith-social-links">
                <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#" aria-label="X (Twitter)"><i class="fa-brands fa-x-twitter"></i></a>
                <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" aria-label="Pinterest"><i class="fa-brands fa-pinterest-p"></i></a>
                <a href="#" aria-label="Twitter"><i class="fa-brands fa-twitter"></i></a>
            </div>
        </div>
    </div>

    <!-- Metallic bottom divider bar -->
    <div class="zeith-footer-divider"></div>
</footer>