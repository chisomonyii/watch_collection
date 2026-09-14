<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <title>Register - Zeith</title>
</head>

<body>
    <div class="register-container">
        <div class="register-card">
            <h1 class="register-title">Zeith</h1>
            <h2 class="register-header">Create Account</h2>
            <p class="register-subheader">Join our community to get the finest watches</p>

            <form action="" method="POST" class="register-form">
                <div class="register-grid">
                    <div>
                        <label class="register-label">First name</label>
                        <input type="text" name="firstname" placeholder="firstname" class="register-input" id="firstname">
                        <small class="error-message"></small>
                    </div>
                    <div>
                        <label class="register-label">Last name</label>
                        <input type="text" name="lastname" placeholder="lastname" class="register-input" id="lastname">
                        <small class="error-message"></small>
                    </div>
                </div>

                <div>
                    <label class="register-label">Email address</label>
                    <input type="email" name="email" placeholder="chibuikemnweze2020@gmail.com" class="register-input" id="email">
                    <small class="error-message"></small>
                </div>

                <div>
                    <label class="register-label">Password</label>
                    <input type="password" name="password" placeholder="your password" class="register-input" id="password">
                    <small class="error-message"></small>
                </div>

                <button type="submit" class="register-button">Create Account</button>
            </form>

            <p class="register-have-account">
                Already have an account? <a href="./login.php" class="register-link">Sign in here</a>
            </p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script src="javascript/register.js"></script>
</body>

</html>