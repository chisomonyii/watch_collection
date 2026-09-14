<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <title>login</title>
</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <h2 class="login-title">Welcome back</h2>
            <p class="login-subtitle">Please enter your details to sign in</p>

            <form action="" class="login-form">
                <div>
                    <label for="" class="login-label">Email Address</label>
                    <input type="email" class="login-input" placeholder="name@gmail.com" id="email">
                    <small class="error-message"></small>
                </div>
                <div>
                    <div class="login-password">
                        <label class="login-label">Password</label>
                        <a href="#" class="login-forgot-password">Forgot Password?</a>
                    </div>
                    <input type="password" class="login-input" id="password">
                    <small class="error-message"></small>
                </div>

                <div>
                    <button type="submit" class="login-button">submit</button>
                </div>
            </form>

            <p class="login-no-account">Don't have an Account? <a href="./register.php" class="login-register">Create an account</a></p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script src="javascript/login.js"></script>
</body>

</html>