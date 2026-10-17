<?php
// routes/checkout.php

use App\Controller\CheckoutController;

$checkoutController = new CheckoutController();

// 1. Frame 2: Show the checkout/cart-slip page
$router->get('/checkout', function() use ($checkoutController) {
    $checkoutController->cartSlip();
});

// 2. Process form submission from cart-slip.php (Saves order & redirects to payment)
$router->post('/checkout/process', function() use ($checkoutController) {
    $checkoutController->processCheckout();
});

// 3. Frame 3: Show the payment page
$router->get('/payment', function() use ($checkoutController) {
    $checkoutController->paymentPage();
});

// 4. Process Payment Form Submission (Legacy/Transfer fallback)
$router->post('/payment/process', function() use ($checkoutController) {
    $checkoutController->processPayment();
});

// 5. Handle Post-Payment Receipt Upload (Saves receipt to DB and redirects to success)
$router->post('/payment/upload-receipt', function() use ($checkoutController) {
    $checkoutController->uploadPostPaymentReceipt();
});

// 6. Verify Paystack Payment Callback
$router->get('/payment/verify', function() use ($checkoutController) {
    $checkoutController->verifyPayment();
});

// 7. Order Success View (Delegated cleanly to CheckoutController)
$router->get('/user/order-success', function() use ($checkoutController) {
    $checkoutController->orderSuccess();
});

// Order Tracking Lookup Route
$router->get('/track', function() use ($checkoutController) {
    $checkoutController->trackOrder();
});