<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>login - Zeith</title>
</head>

<body>
    <video autoplay muted loop playsinline id="bg-video">
        <source src="./video/property-details-background-video.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <!-- Optional Dark Overlay to improve card contrast -->
    <div class="video-overlay"></div>
    <div class="login-container">
        <div class="login-card">
            <h2 class="login-title">Welcome back</h2>
            <p class="login-subtitle">Please enter your details to sign in</p>

            <form action="" class="login-form">
                <div>
                    <label for="" class="login-label">Email Address</label>
                    <input type="email" class="login-input" placeholder="name@gmail.com">
                </div>
                <div>
                    <div class="login-password">
                        <label class="login-label">Password</label>
                        <a href="./forgot-password.php" class="login-forgot-password">Forgot Password?</a>
                    </div>
                    <input type="password" class="login-input">
                </div>

                <div>
                    <button class="login-button">submit</button>
                </div>
            </form>

            <p class="login-no-account">Don't have an Account? <a href="./register.php" class="login-register">Create an account</a></p>
        </div>
    </div>
</body>

</html>