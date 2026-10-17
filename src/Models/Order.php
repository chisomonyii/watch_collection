<?php

namespace App\Models;

class Order
{
    private ?\PDO $pdo;

    public function __construct()
    {
        $host = 'localhost';
        $db   = 'Watch_Collection';
        $user = 'root';
        $pass = '';

        try {
            $this->pdo = new \PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            die("Database Connection Error: " . $e->getMessage());
        }
    }

    public function createOrder(array $data, array $items)
    {
        $orderNumber = 'ZEITH-' . strtoupper(uniqid());

        // Insert into orders table
        $stmt = $this->pdo->prepare("INSERT INTO orders (order_number, full_name, email, phone, address, delivery_instructions, subtotal, total_amount) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $orderNumber,
            $data['fullname'],
            $data['email'],
            $data['phone'],
            $data['address'],
            $data['notes'] ?? '',
            $data['subtotal'],
            $data['subtotal']
        ]);

        $orderId = $this->pdo->lastInsertId();

        // Insert each watch item into order_items table
        $itemStmt = $this->pdo->prepare("INSERT INTO order_items (order_id, watch_id, watch_name, brand, price, quantity, strap_variant) VALUES (?, ?, ?, ?, ?, ?, ?)");

        foreach ($items as $item) {
            $itemStmt->execute([
                $orderId,
                $item['id'] ?? '',
                $item['name'] ?? 'Luxury Watch',
                $item['brand'] ?? 'ZEITH',
                $item['price'] ?? 0,
                $item['quantity'] ?? 1,
                $item['strap'] ?? 'Steel'
            ]);
        }

        return [
            'order_id' => $orderId,
            'order_number' => $orderNumber,
            'subtotal' => $data['subtotal']
        ];
    }
    public function getShippingMethods()
    {
        $stmt = $this->pdo->query("SELECT * FROM shipping_methods WHERE is_active = 1");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function markOrderAsPaid(int|string $orderId, string $reference, float $amountPaid)
    {
        // 1. Update orders table status, reference, and amount
        $stmt = $this->pdo->prepare("UPDATE orders SET payment_status = 'Paid', payment_reference = ?, total_amount = ? WHERE id = ?");
        $stmt->execute([$reference, $amountPaid, $orderId]);

        // 2. Insert record into payments table (if table exists)
        try {
            $payStmt = $this->pdo->prepare("INSERT INTO payments (order_id, payment_reference, amount, payment_status) VALUES (?, ?, ?, 'success')");
            $payStmt->execute([$orderId, $reference, $amountPaid]);
        } catch (\PDOException $e) {
            // Ignore if payments table is optional or doesn't exist yet
        }
    }

    public function markOrderAsPendingTransfer(int|string $orderId, ?string $receiptPath, float $totalAmount)
    {
        $stmt = $this->pdo->prepare("UPDATE orders SET order_status = 'Pending', payment_status = 'Pending Verification', payment_receipt = ?, total_amount = ? WHERE id = ?");
        $stmt->execute([$receiptPath, $totalAmount, $orderId]);
    }

    public function updateOrderReceipt(int|string $orderId, string $receiptPath)
    {
        $stmt = $this->pdo->prepare("UPDATE orders SET payment_receipt = ? WHERE id = ?");
        $stmt->execute([$receiptPath, $orderId]);
    }
    public function getOrderByReference(string $searchTerm)
    {
        $searchTerm = trim($searchTerm);
        $stmt = $this->pdo->prepare("
        SELECT * FROM orders 
        WHERE order_number = ? 
           OR payment_reference = ? 
           OR email = ? 
           OR phone = ? 
        ORDER BY id DESC 
        LIMIT 1
    ");
        $stmt->execute([$searchTerm, $searchTerm, $searchTerm, $searchTerm]);
        return $stmt->fetch(\PDO::FETCH_ASSOC) ?: null;
    }
}
