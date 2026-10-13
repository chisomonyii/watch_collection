<?php

namespace App\Controller;

require_once __DIR__ . '/../Models/Order.php';

use App\Models\Order;

use App\Helpers\MailHelper;

class CheckoutController
{
    private Order $orderModel;

    public function __construct()
    {
        $this->orderModel = new Order();
    }

    // Display Frame 2: cart-slip.php
    public function cartSlip()
    {
        require_once __DIR__ . '/../View/checkout/cart-slip.php';
    }

    // Handle Form Submission & Save Order to Database
    public function processCheckout()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fullName = trim($_POST['fullname'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $address = trim($_POST['address'] ?? '');
            $subtotal = floatval($_POST['subtotal'] ?? 0);
            $cartItems = json_decode($_POST['cart_items_json'] ?? '[]', true);

            if (!empty($fullName) && !empty($email) && !empty($phone) && !empty($address) && !empty($cartItems)) {

                $orderData = [
                    'fullname' => $fullName,
                    'email' => $email,
                    'phone' => $phone,
                    'address' => $address,
                    'notes' => trim($_POST['notes'] ?? ''),
                    'subtotal' => $subtotal
                ];

                $result = $this->orderModel->createOrder($orderData, $cartItems);

                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['active_order_id'] = $result['order_id'];
                $_SESSION['order_number'] = $result['order_number'];
                $_SESSION['order_subtotal'] = $result['subtotal'];

                // Redirect to Frame 3 (payment.php)
                header('Location: /Watch_Collection/payment');
                exit;
            }
        }

        header('Location: /Watch_Collection/checkout');
        exit;
    }

    // Display Frame 3: payment.php
    public function paymentPage()
    {
        // Fetch shipping options from the database model
        $shippingMethods = $this->orderModel->getShippingMethods();

        require_once __DIR__ . '/../View/checkout/payment.php';
    }

    // Handle Final Payment Submission & Clear Cart
    public function processPayment()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $orderId = $_POST['order_id'] ?? null;
            $gateway = $_POST['gateway'] ?? 'card';
            $shippingFee = floatval($_POST['shipping_fee'] ?? 0);
            $subtotal = floatval($_POST['subtotal'] ?? 0);
            $totalAmount = $subtotal + $shippingFee;

            if ($orderId) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }

                // If user selected Manual Bank Transfer, handle receipt upload
                $receiptPath = null;
                if ($gateway === 'transfer' && isset($_FILES['payment_receipt']) && $_FILES['payment_receipt']['error'] === UPLOAD_ERR_OK) {
                    $fileTmpPath = $_FILES['payment_receipt']['tmp_name'];
                    $fileName = $_FILES['payment_receipt']['name'];
                    $uploadFileDir = './uploads/receipts/';

                    // Ensure directory exists
                    if (!is_dir($uploadFileDir)) {
                        mkdir($uploadFileDir, 0o755, true);
                    }

                    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
                    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                    $dest_path = $uploadFileDir . $newFileName;

                    if (move_uploaded_file($fileTmpPath, $dest_path)) {
                        $receiptPath = $dest_path;
                    }
                }

                // Update order status or record manual payment
                // Update order status or record manual payment
                if ($gateway === 'transfer') {
                    $this->orderModel->markOrderAsPendingTransfer($orderId, $receiptPath, $totalAmount);

                    $customerEmail = $_SESSION['customer_email'] ?? 'customer@zeith.com';
                    $customerName = $_SESSION['customer_name'] ?? 'Valued Customer';

                    MailHelper::sendOrderConfirmation($customerEmail, $customerName, $orderId, 'Pending Verification');
                }

                // Clear checkout session data
                unset($_SESSION['active_order_id']);
                unset($_SESSION['order_number']);
                unset($_SESSION['order_subtotal']);

                // Redirect to Success / Order Confirmation Page
                header('Location: /Watch_Collection/user/order-success');
                exit;
            }
        }

        header('Location: /Watch_Collection/payment');
        exit;
    }

    // Verify Paystack Payment Callback
    public function verifyPayment()
    {
        $reference = $_GET['reference'] ?? null;
        $orderId = $_GET['order_id'] ?? null;

        if (!$reference) {
            header('Location: /Watch_Collection/payment');
            exit;
        }

        // Secret key from Paystack Dashboard
        $paystackSecretKey = 'sk_test_a4c0f671e16592fdbf71cd5323c238b380e29a2c';

        // Call Paystack API to verify transaction status
        $url = "https://api.paystack.co/transaction/verify/" . rawurlencode($reference);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer $paystackSecretKey",
            "Cache-Control: no-cache"
        ]);

        $response = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($response, true);

        if ($result && isset($result['data']) && $result['data']['status'] === 'success') {
            // Update order status in MySQL DB to 'Paid'
            $this->orderModel->markOrderAsPaid($orderId, $reference, $result['data']['amount'] / 100);

            // Clear Cart Session
            if (session_status() === PHP_SESSION_NONE) session_start();
            unset($_SESSION['active_order_id']);
            unset($_SESSION['order_number']);
            unset($_SESSION['order_subtotal']);

            // Redirect to Thank You / Receipt Page
            header('Location: /Watch_Collection/user/order-success?ref=' . $reference);
            exit;
        } else {
            die("Payment verification failed or payment was declined.");
        }
    }

    // Display Order Success View
    public function orderSuccess()
    {
        require_once __DIR__ . '/../View/checkout/order-success.php';
    }
}
