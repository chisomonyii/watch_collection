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

    public function cartSlip()
    {
        require_once __DIR__ . '/../View/checkout/cart-slip.php';
    }

    public function processCheckout()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fullName = trim($_POST['fullname'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $address = trim($_POST['address'] ?? '');
            $subtotal = floatval($_POST['subtotal'] ?? 0);
            $shippingFee = floatval($_POST['shipping_fee'] ?? 4000);
            $shippingMethodName = trim($_POST['shipping_method_name'] ?? 'Standard Shipping');
            $cartItems = json_decode($_POST['cart_items_json'] ?? '[]', true);

            if (!empty($fullName) && !empty($email) && !empty($phone) && !empty($address) && !empty($cartItems)) {
                $orderData = [
                    'fullname' => $fullName,
                    'email' => $email,
                    'phone' => $phone,
                    'address' => $address,
                    'notes' => trim($_POST['notes'] ?? ''),
                    'subtotal' => $subtotal,
                    'shipping_fee' => $shippingFee,
                    'shipping_method_name' => $shippingMethodName
                ];

                $result = $this->orderModel->createOrder($orderData, $cartItems);

                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }

                $_SESSION['active_order_id'] = $result['order_id'];
                $_SESSION['order_number'] = $result['order_number'];
                $_SESSION['order_subtotal'] = $result['subtotal'];

                header('Location: /Watch_Collection/payment');
                exit;
            }
        }

        header('Location: /Watch_Collection/checkout');
        exit;
    }

    public function paymentPage()
    {
        $shippingMethods = $this->orderModel->getShippingMethods();

        require_once __DIR__ . '/../View/checkout/payment.php';
    }

    public function processPayment()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $orderId = $_POST['order_id'] ?? null;
            $shippingFee = floatval($_POST['shipping_fee'] ?? 0);
            $shippingMethodName = trim($_POST['shipping_method_name'] ?? '');
            $subtotal = floatval($_POST['subtotal'] ?? 0);
            $totalAmount = $subtotal + $shippingFee;

            if ($orderId) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }

                if (method_exists($this->orderModel, 'updateOrderShippingAndTotal')) {
                    $this->orderModel->updateOrderShippingAndTotal($orderId, $shippingFee, $shippingMethodName, $totalAmount);
                }

                // Proceed directly to gateway flow (Paystack handles payment securely online)
                // Session cleanup will happen inside verifyPayment once Paystack confirms success.
                
                header('Location: /Watch_Collection/payment'); // or your Paystack trigger response redirect
                exit;
            }
        }

        header('Location: /Watch_Collection/payment');
        exit;
    }

    public function verifyPayment()
    {
        $reference = $_GET['reference'] ?? null;
        $orderId = $_GET['order_id'] ?? null;

        if (!$reference) {
            header('Location: /Watch_Collection/payment');
            exit;
        }

        $paystackSecretKey = 'sk_test_a4c0f671e16592fdbf71cd5323c238b380e29a2c';

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
            $this->orderModel->markOrderAsPaid($orderId, $reference, $result['data']['amount'] / 100);

            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            unset($_SESSION['active_order_id']);
            unset($_SESSION['order_number']);
            unset($_SESSION['order_subtotal']);

            header('Location: /Watch_Collection/user/order-success?ref=' . $reference);
            exit;
        } else {
            die("Payment verification failed or payment was declined.");
        }
    }

    public function orderSuccess()
    {
        require_once __DIR__ . '/../View/checkout/order-success.php';
    }

    public function trackOrder()
    {
        $ref = trim($_GET['ref'] ?? '');
        $order = null;

        if (!empty($ref)) {
            $order = $this->orderModel->getOrderByReference($ref);
        }

        require_once __DIR__ . '/../View/checkout/track-order.php';
    }
}