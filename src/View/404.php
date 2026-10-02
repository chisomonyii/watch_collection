<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>404 - Page Not Found</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
            background: #111111;
            color: #ffffff;
            padding: 20px;
        }

        .error-container {
            width: 100%;
            max-width: 600px;
            text-align: center;
            padding: 50px 30px;
        }

        .watch-icon {
            width: 85px;
            height: 85px;
            margin: 0 auto 25px;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 2px solid #ff6b00;
            border-radius: 50%;
            font-size: 40px;
        }

        .error-code {
            font-size: 110px;
            line-height: 1;
            font-weight: 800;
            letter-spacing: 5px;
            color: #ff6b00;
            margin-bottom: 15px;
        }

        h1 {
            font-size: 32px;
            margin-bottom: 15px;
        }

        .message {
            max-width: 450px;
            margin: 0 auto 30px;
            color: #aaaaaa;
            line-height: 1.7;
            font-size: 16px;
        }

        .oops {
            font-weight: bold;
            color: #ffffff;
            margin-bottom: 5px;
        }

        .home-button {
            display: inline-block;
            padding: 13px 28px;
            background: #ff6b00;
            color: #ffffff;
            text-decoration: none;
            border-radius: 7px;
            font-size: 15px;
            font-weight: 600;
            transition: 0.3s ease;
        }

        .home-button:hover {
            background: #ffffff;
            color: #111111;
        }

        .small-text {
            margin-top: 25px;
            color: #666666;
            font-size: 13px;
        }

        @media (max-width: 600px) {

            .error-code {
                font-size: 80px;
            }

            h1 {
                font-size: 26px;
            }

            .message {
                font-size: 14px;
            }

            .error-container {
                padding: 30px 15px;
            }
        }
    </style>
</head>

<body>

    <div class="error-container">

        <div class="watch-icon">
            ⌚
        </div>

        <div class="error-code">
            404
        </div>

        <h1>Page Not Found</h1>

        <div class="message">

            <p class="oops">
                Oops!
            </p>

            <p>
                Looks like this page has gone off the clock.
                The page you're looking for doesn't exist or may have been moved.
            </p>

        </div>

        <a href="<?php echo getUrl("/"); ?>" class="home-button">
            Back to Home
        </a>

        <p class="small-text">
            Keep track of time. Find your perfect watch.
        </p>

    </div>

</body>

</html>