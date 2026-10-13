<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ZEITH - Payment Successful</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { font-family: -apple-system, sans-serif; background: #f8fafc; display: flex; align-items: center; justify-content: center; min-height: 100vh; margin: 0; }
        .success-card { background: #fff; padding: 40px; border-radius: 16px; text-align: center; max-width: 450px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); }
        .icon-box { font-size: 3rem; color: #22c55e; margin-bottom: 16px; }
        h2 { margin-bottom: 8px; color: #111; }
        p { color: #666; font-size: 0.95rem; line-height: 1.5; }
        .ref-box { background: #f1f5f9; padding: 12px; border-radius: 8px; font-weight: bold; margin: 20px 0; font-family: monospace; }
        .btn-home { display: inline-block; background: #f68b1e; color: #fff; text-decoration: none; padding: 12px 24px; border-radius: 25px; font-weight: bold; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="success-card">
        <div class="icon-box"><i class="fa-solid fa-circle-check"></i></div>
        <h2>Payment Successful!</h2>
        <p>Thank you for your order with ZEITH. Your payment has been verified and your timepiece is being prepared for dispatch.</p>
        
        <div class="ref-box">Ref: <?= htmlspecialchars($_GET['ref'] ?? 'N/A') ?></div>

        <a href="/Watch_Collection/" class="btn-home">Return to Store</a>
    </div>

    <script>
        // Clear local storage cart items after verified purchase
        localStorage.removeItem('zeith_cart');
    </script>
</body>
</html>