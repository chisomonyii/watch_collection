<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php assets("css/login.css"); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <title>Login - Zeith</title>

    <style>
        /* Optional error notice container */
        .login-error-banner {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.4);
            color: #f87171;
            padding: 12px 14px;
            border-radius: 8px;
            font-size: 0.85rem;
            margin-bottom: 20px;
            display: none;
            align-items: center;
            gap: 10px;
        }

        .login-error-banner i {
            font-size: 1rem;
            color: #ef4444;
        }
    </style>
</head>

<body>
    <!-- Background Video -->
    <video autoplay muted loop playsinline id="bg-video">
        <source src="<?php assets("video/property-details-background-video.mp4"); ?>" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <!-- Dark Overlay for Contrast -->
    <div class="video-overlay"></div>

    <div class="login-container">
        <div class="login-card">
            <h2 class="login-title">Welcome Back</h2>
            <p class="login-subtitle">Please enter your portal details to sign in</p>

            <!-- Dynamic Error Message Display -->
            <div class="login-error-banner" id="login-error-banner">
                <i class="fa-solid fa-circle-exclamation"></i>
                <span id="login-error-text">Your account is pending admin approval.</span>
            </div>

            <form action="" method="POST" class="login-form" id="login-form">
                <div>
                    <label for="email" class="login-label">Email Address</label>
                    <input type="email" name="email" class="login-input" id="email" placeholder="name@gmail.com" required>
                </div>

                <div>
                    <div class="login-password">
                        <label for="password" class="login-label">Password</label>
                        <a href="./forgot-password.php" class="login-forgot-password">Forgot Password?</a>
                    </div>
                    <input type="password" name="password" class="login-input" id="password" placeholder="••••••••" required>
                </div>

                <input type="hidden" id="csrf-token" name="csrf_token" value="<?= $csrf_token ?? '' ?>">

                <div>
                    <button type="submit" class="login-button" id="login-button">
                        Login
                    </button>
                </div>
            </form>

            <p class="login-no-account">Don't have an Account? <a href="./register.php" class="login-register">Create an account</a></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="<?php assets("js/login.js"); ?>"></script>
</body>

</html>