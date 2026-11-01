<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php assets("css/login.css"); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <title>Register - Zeith</title>

    <style>
        .form-group {
            margin-top: 16px;
            margin-bottom: 16px;
        }

        .role-selector {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-top: 8px;
        }

        .role-option {
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 8px;
            padding: 12px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s ease;
            background: rgba(11, 15, 25, 0.6);
            backdrop-filter: blur(4px);
            color: #ffffff;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
        }

        .role-option input {
            display: none;
        }

        .role-option.selected {
            border-color: #f68b1e;
            background: rgba(246, 139, 30, 0.15);
        }

        .role-option i {
            font-size: 1.2rem;
            color: #f68b1e;
        }

        .role-option span {
            font-size: 0.85rem;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <!-- Background Video -->
    <video autoplay muted loop playsinline id="bg-video">
        <source src="<?php assets("video/property-details-background-video.mp4"); ?>" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <!-- Optional Dark Overlay to improve card contrast -->
    <div class="video-overlay"></div>

    <div class="register-container">
        <div class="register-card">
            <h1 class="register-title">Zeith</h1>
            <h2 class="register-header">Create Portal Account</h2>
            <p class="register-subheader">Select your access level to join management</p>

            <form id="register-form" class="register-form">
                <div class="register-grid">
                    <div>
                        <label class="register-label">First name</label>
                        <input type="text" name="firstname" placeholder="firstname" class="register-input" required>
                    </div>
                    <div>
                        <label class="register-label">Last name</label>
                        <input type="text" name="lastname" placeholder="lastname" class="register-input" required>
                    </div>
                </div>

                <input type="hidden" name="csrf_token" value="<?= $csrf_token ?? '' ?>">

                <div>
                    <label class="register-label">Email address</label>
                    <input type="email" name="email" placeholder="youremail@gmail.com" class="register-input" required>
                </div>

                <div>
                    <label class="register-label">Password</label>
                    <input type="password" name="password" placeholder="your password" class="register-input" required>
                </div>

             

                <button type="submit" class="register-button" id="register-button">
                    Create Account
                </button>
            </form>

            <p class="register-have-account">
                Already have an account? <a href="/Zeith/auth/login" class="register-link">Sign in here</a>
            </p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="<?php assets('js/register.js'); ?>"></script>

    <script>
        // Handle visual card selection and check the hidden radio buttons
        document.querySelectorAll('.role-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.role-option').forEach(opt => opt.classList.remove('selected'));
                this.classList.add('selected');
                const radio = this.querySelector('input[type="radio"]');
                if (radio) {
                    radio.checked = true;
                }
            });
        });
    </script>
</body>

</html>