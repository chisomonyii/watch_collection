<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Zeith</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            min-height: 100%;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            background: #0A090C;
            font-family: Arial, Helvetica, sans-serif;
            color: #FFFFFF;
        }

        /* ================================
           BACKGROUND VIDEO
        ================================= */

        #forgot-bg-video {
            position: fixed;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -3;
        }

        .video-overlay {
            position: fixed;
            inset: 0;
            z-index: -2;
            background:
                linear-gradient(
                    135deg,
                    rgba(10, 8, 14, 0.82),
                    rgba(16, 13, 21, 0.72)
                );
        }

        /* ================================
           MAIN CONTAINER
        ================================= */

        .forgot-container {
            width: 100%;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 20px;
            position: relative;
            z-index: 1;
        }

        /* ================================
           RESET CARD
        ================================= */

        .forgot-card {
            width: 100%;
            max-width: 430px;
            padding: 42px 38px 40px;

            background:
                linear-gradient(
                    145deg,
                    rgba(38, 32, 48, 0.78),
                    rgba(17, 15, 22, 0.86)
                );

            border: 1px solid rgba(255, 255, 255, 0.10);
            border-radius: 18px;

            box-shadow:
                0 25px 70px rgba(0, 0, 0, 0.55),
                inset 0 1px 0 rgba(255, 255, 255, 0.05);

            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
        }

        /* ================================
           TITLE
        ================================= */

        .forgot-title {
            margin-bottom: 10px;
            color: #FFFFFF;
            font-size: 29px;
            font-weight: 600;
            line-height: 1.2;
            letter-spacing: -0.4px;
        }

        .forgot-subtitle {
            margin-bottom: 32px;
            color: rgba(255, 255, 255, 0.58);
            font-size: 14px;
            line-height: 1.6;
        }

        /* ================================
           FORM
        ================================= */

        .forgot-form {
            width: 100%;
        }

        .forgot-field {
            width: 100%;
            margin-bottom: 20px;
        }

        .forgot-label {
            display: block;
            margin-bottom: 9px;
            color: rgba(255, 255, 255, 0.82);
            font-size: 13px;
            font-weight: 500;
            letter-spacing: 0.1px;
        }

        .forgot-input {
            width: 100%;
            height: 50px;
            padding: 0 15px;

            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 9px;

            background: rgba(0, 0, 0, 0.28);
            color: #FFFFFF;

            outline: none;
            font-family: inherit;
            font-size: 14px;

            transition:
                border-color 0.25s ease,
                background 0.25s ease,
                box-shadow 0.25s ease;
        }

        .forgot-input::placeholder {
            color: rgba(255, 255, 255, 0.28);
        }

        .forgot-input:hover {
            border-color: rgba(255, 255, 255, 0.18);
        }

        .forgot-input:focus {
            border-color: rgba(255, 255, 255, 0.38);
            background: rgba(0, 0, 0, 0.38);
            box-shadow:
                0 0 0 3px rgba(255, 255, 255, 0.05);
        }

        /* ================================
           BUTTON
        ================================= */

        .forgot-button {
            width: 100%;
            height: 50px;
            margin-top: 8px;

            border: 1px solid rgba(255, 255, 255, 0.14);
            border-radius: 9px;

            background: rgba(255, 255, 255, 0.92);
            color: #17131D;

            font-family: inherit;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 0.2px;

            cursor: pointer;

            transition:
                background 0.25s ease,
                color 0.25s ease,
                transform 0.25s ease,
                box-shadow 0.25s ease;
        }

        .forgot-button:hover {
            background: #FFFFFF;
            color: #0D0A10;
            transform: translateY(-1px);
            box-shadow:
                0 8px 24px rgba(0, 0, 0, 0.30);
        }

        .forgot-button:active {
            transform: translateY(0);
        }

        .forgot-button:focus-visible {
            outline: 2px solid rgba(255, 255, 255, 0.65);
            outline-offset: 3px;
        }

        /* ================================
           RESPONSIVE
        ================================= */

        @media (max-width: 600px) {
            .forgot-container {
                padding: 20px 16px;
            }

            .forgot-card {
                max-width: 100%;
                padding: 34px 25px 32px;
                border-radius: 15px;
            }

            .forgot-title {
                font-size: 25px;
            }

            .forgot-subtitle {
                margin-bottom: 27px;
                font-size: 13px;
            }

            .forgot-input,
            .forgot-button {
                height: 48px;
            }
        }

        @media (max-width: 380px) {
            .forgot-card {
                padding: 30px 20px;
            }

            .forgot-title {
                font-size: 23px;
            }
        }
    </style>
</head>

<body>

    <video autoplay muted loop playsinline id="forgot-bg-video">
       <source src="<?php assets("video/property-details-background-video.mp4"); ?>" type="video/mp4">
    </video>

    <div class="video-overlay"></div>

    <div class="forgot-container">
        <div class="forgot-card">

            <h2 class="forgot-title">
                Reset Password
            </h2>

            <p class="forgot-subtitle">
                Enter your new password below
            </p>

            <form
    action="/Watch_Collection/auth/reset-password"
    method="POST"
    class="forgot-form">

                <input
                    type="hidden"
                    name="token"
                    value="<?= htmlspecialchars($_GET['token'] ?? '') ?>">

                <div class="forgot-field">
                    <label class="forgot-label">
                        New Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="forgot-input"
                        placeholder="••••••••"
                        required>
                </div>

                <div class="forgot-field">
                    <label class="forgot-label">
                        Confirm Password
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        class="forgot-input"
                        placeholder="••••••••"
                        required>
                </div>

                <button
                    type="submit"
                    class="forgot-button">
                    Update Password
                </button>

            </form>

        </div>
    </div>

</body>
</html>