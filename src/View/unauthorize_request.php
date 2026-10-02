<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Unauthorized Request</title>

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
            background: #f8f8f8;
            padding: 20px;
        }

        .unauthorized-container {
            width: 100%;
            max-width: 500px;
            text-align: center;
            background: white;
            padding: 50px 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 25px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            background: #fff1e8;
            color: #ff6b00;
            font-size: 40px;
        }

        h1 {
            font-size: 28px;
            margin-bottom: 15px;
            color: #222;
        }

        p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 25px;
        }

        .redirect-text {
            font-size: 14px;
            margin-bottom: 20px;
        }

        #countdown {
            font-weight: bold;
            color: #ff6b00;
        }

        .home-button {
            display: inline-block;
            padding: 12px 25px;
            background: #ff6b00;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: 0.3s;
        }

        .home-button:hover {
            background: #e55d00;
        }
    </style>
</head>

<body>

    <div class="unauthorized-container">

        <div class="icon">
            🔒
        </div>

        <h1>You're not allowed to view this page</h1>

        <p>
            You need to log in before you can access this page.
        </p>

        <p class="redirect-text">
            Taking you back to the landing page in
            <span id="countdown">3</span> seconds...
        </p>

        <a href="<?php echo getUrl("/"); ?>" class="home-button">
            Go to Home
        </a>

    </div>


    <script>
        let countdown = 10;

        const countdownElement = document.querySelector("#countdown");

        const timer = setInterval(() => {

            countdown--;

            countdownElement.textContent = countdown;

            if (countdown <= 0) {

                clearInterval(timer);

                window.location.href = "<?php echo getUrl('/'); ?>";

            }

        }, 1000);
    </script>

</body>

</html>