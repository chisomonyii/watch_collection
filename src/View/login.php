<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php assets("css/login.css"); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <title>login - Zeith</title>
</head>

<body>
    <video autoplay muted loop playsinline id="bg-video">
        <source src="<?php assets("video/property-details-background-video.mp4"); ?>" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <!-- Optional Dark Overlay to improve card contrast -->
    <div class="video-overlay"></div>
    <div class="login-container">
        <div class="login-card">
            <h2 class="login-title">Welcome back</h2>
            <p class="login-subtitle">Please enter your details to sign in</p>

            <form action="" class="login-form" id="login-form">
                <div>
                    <label for="" class="login-label">Email Address</label>
                    <input type="email" class="login-input" id="email" placeholder="name@gmail.com">
                </div>
                <div>
                    <div class="login-password">
                        <label class="login-label">Password</label>
                        <a href="./forgot-password.php" class="login-forgot-password">Forgot Password?</a>
                    </div>
                    <input type="password" class="login-input" id="password">
                </div>

                <input type="hidden" id="csrf-token" name="csrf_token" value="<?php echo $csrf_token; ?>">

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