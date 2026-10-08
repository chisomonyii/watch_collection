<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZEITH - Contact Us</title>
    <!-- Font Awesome CDN for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --primary-color: #f68b1e;
            --primary-hover: #e07a16;
            --primary-light-bg: #fff8f0;
            --text-dark: #111111;
            --text-muted: #666666;
            --border-color: #e2e8f0;
            --bg-light: #f8fafc;
            --card-bg: #ffffff;
            --shadow-sm: 0 4px 20px rgba(0, 0, 0, 0.05);
            --radius-lg: 16px;
            --radius-md: 10px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            line-height: 1.5;
            min-height: 100vh;
            padding: 50px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .contact-container {
            width: 100%;
            max-width: 960px;
            margin: 0 auto;
        }

        /* Header Section */
        .contact-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .contact-header h1 {
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 10px;
        }

        .contact-header p {
            font-size: 0.95rem;
            color: var(--text-muted);
            max-width: 500px;
            margin: 0 auto;
        }

        /* Alert Response Box */
        .alert-message {
            display: none;
            padding: 12px 16px;
            border-radius: var(--radius-md);
            font-size: 0.9rem;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 600;
        }

        .alert-message.success {
            display: block;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-message.error {
            display: block;
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* Grid Layout */
        .contact-grid {
            display: grid;
            grid-template-columns: 320px 1fr;
            gap: 24px;
            align-items: start;
        }

        /* LEFT COLUMN */
        .left-column {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* Contact Details Card */
        .info-card {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 24px;
            box-shadow: var(--shadow-sm);
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .icon-box {
            width: 42px;
            height: 42px;
            background-color: var(--primary-light-bg);
            color: var(--primary-color);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .info-text span {
            display: block;
            font-size: 0.88rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .info-text a,
        .info-text p {
            font-size: 0.85rem;
            color: var(--text-muted);
            text-decoration: none;
            word-break: break-all;
        }

        .info-text a:hover {
            color: var(--primary-color);
        }

        /* Quick Support Hero Banner Card */
        .support-card {
            background-color: var(--primary-color);
            color: #ffffff;
            border-radius: var(--radius-lg);
            padding: 36px 24px;
            text-align: center;
            box-shadow: var(--shadow-sm);
        }

        .support-card h3 {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .support-card p {
            font-size: 0.85rem;
            line-height: 1.4;
            opacity: 0.95;
        }

        /* RIGHT COLUMN: Contact Form Card */
        .form-card {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 32px;
            box-shadow: var(--shadow-sm);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-bottom: 20px;
        }

        .form-group.full-width {
            margin-bottom: 24px;
        }

        .input-label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.82rem;
            color: var(--text-muted);
            font-weight: 600;
        }

        .input-label i {
            font-size: 0.85rem;
        }

        .form-input,
        .form-textarea {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            font-size: 0.92rem;
            color: var(--text-dark);
            outline: none;
            background-color: #ffffff;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .form-input:focus,
        .form-textarea:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(246, 139, 30, 0.15);
        }

        .form-textarea {
            resize: vertical;
            min-height: 130px;
            font-family: inherit;
        }

        .btn-send {
            width: 100%;
            background-color: var(--primary-color);
            color: #ffffff;
            border: none;
            padding: 14px 20px;
            border-radius: var(--radius-md);
            font-size: 0.95rem;
            font-weight: 700;
            cursor: pointer;
            transition: background-color 0.2s ease, transform 0.1s ease;
        }

        .btn-send:hover {
            background-color: var(--primary-hover);
        }

        .btn-send:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        /* RESPONSIVE MEDIA QUERIES */
        @media (max-width: 900px) {
            .contact-grid {
                grid-template-columns: 1fr;
            }

            .left-column {
                display: grid;
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 600px) {
            body {
                padding: 30px 16px;
            }

            .contact-header h1 {
                font-size: 1.8rem;
            }

            .left-column {
                grid-template-columns: 1fr;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .form-card {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    <div class="contact-container">

        <!-- Page Header -->
        <div class="contact-header">
            <h1>Get In Touch</h1>
            <p>Have questions or feedback? We'd love to hear from you. Our team is here to help you with anything you need.</p>
        </div>

        <div class="contact-grid">

            <!-- LEFT COLUMN: Information Cards -->
            <div class="left-column">
                <!-- Direct Contact Info -->
                <div class="info-card">
                    <div class="info-item">
                        <div class="icon-box">
                            <i class="fa-regular fa-envelope"></i>
                        </div>
                        <div class="info-text">
                            <span>Email Us</span>
                            <a href="mailto:support@zeith.com">support@zeith.com</a>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="icon-box">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div class="info-text">
                            <span>Call Us</span>
                            <a href="tel:09161426400">09161426400</a>
                        </div>
                    </div>
                </div>

                <div class="support-card">
                    <h3>Quick Support</h3>
                    <p>Available 24/7 for our premium members.<br>Your satisfaction is our priority.</p>
                </div>
            </div>

            <!-- RIGHT COLUMN: Contact Form Card -->
            <div class="form-card">
                <!-- Status Feedback Message -->
                <div id="alertMsg" class="alert-message"></div>

                <form id="contactForm" action="/Watch_Collection/api/contact" method="POST">
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label class="input-label">
                                <i class="fa-regular fa-user"></i> Name
                            </label>
                            <input type="text" name="name" class="form-input" placeholder="Your full name" required>
                        </div>

                        <div class="form-group">
                            <label class="input-label">
                                <i class="fa-regular fa-envelope"></i> Email
                            </label>
                            <input type="email" name="email" class="form-input" placeholder="yourname@gmail.com" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="input-label">
                            <i class="fa-solid fa-phone"></i> Phone
                        </label>
                        <input type="tel" name="phone" class="form-input" placeholder="Your phone number">
                    </div>

                    <div class="form-group full-width">
                        <label class="input-label">
                            <i class="fa-regular fa-comment-dots"></i> Message
                        </label>
                        <textarea name="message" class="form-textarea" placeholder="Write how we can assist you..." required></textarea>
                    </div>

                    <button type="submit" id="btnSubmit" class="btn-send">Send Message</button>
                </form>
            </div>

        </div>

    </div>

    <!-- AJAX HANDLER FOR CONTACT SUBMISSION -->
    <script>
        document.getElementById('contactForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const form = this;
            const btnSubmit = document.getElementById('btnSubmit');
            const alertMsg = document.getElementById('alertMsg');

            btnSubmit.disabled = true;
            btnSubmit.textContent = 'Sending...';
            alertMsg.className = 'alert-message';
            alertMsg.style.display = 'none';

            const formData = new FormData(form);
            const payload = Object.fromEntries(formData.entries());

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(payload)
                });

                const result = await response.json();

                if (result.success) {
                    alertMsg.textContent = result.message;
                    alertMsg.className = 'alert-message success';
                    form.reset();
                } else {
                    alertMsg.textContent = result.message || 'Something went wrong. Please try again.';
                    alertMsg.className = 'alert-message error';
                }
            } catch (error) {
                console.error('Contact submission error:', error);
                alertMsg.textContent = 'Network error. Please check your connection.';
                alertMsg.className = 'alert-message error';
            } finally {
                btnSubmit.disabled = false;
                btnSubmit.textContent = 'Send Message';
            }
        });
    </script>
</body>

</html>