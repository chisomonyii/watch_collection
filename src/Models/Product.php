<?php

namespace App\Models;

use PDO;

class Product 
{
    private ?PDO $pdo = null;

public function __construct() {
       $host = $_ENV['DB_HOST'] ?? 'localhost';
        $port = $_ENV['DB_PORT'] ?? '3306';
        $db   = $_ENV['DB_NAME'] ?? 'watch_collection';
        $user = $_ENV['DB_USER'] ?? 'root';
        $pass = $_ENV['DB_PASS'] ?? '';

        try {
            $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";
            $this->pdo = new \PDO($dsn, $user, $pass);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            die("Database Connection Error: " . $e->getMessage());
        }
    }

    public function searchProducts(string $keyword) {
        if (!$this->pdo) return [];

        $searchTerm = "%" . trim($keyword) . "%";

        try {
            $stmt = $this->pdo->prepare("
                SELECT * FROM watches 
                WHERE name LIKE ? 
                   OR description LIKE ?
                ORDER BY id DESC
            ");
            
            $stmt->execute([$searchTerm, $searchTerm]);
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Automatically resolve image paths for every product returned
            foreach ($products as &$product) {
                $rawImage = $product['image_url_1'] ?? '';
                $clean = trim($rawImage);

                if (empty($clean)) {
                    $product['image_url_1'] = '/Zeith/assets/image/pngwing.com (1).png';
                    continue;
                }

                if (str_starts_with($clean, 'http://') || str_starts_with($clean, 'https://') || str_starts_with($clean, '/')) {
                    continue; // Already a full URL or absolute path
                }

                // Clean up string
                $filename = ltrim(str_replace(['/Zeith/assets/image/', 'assets/image/', '/Zeith/public/uploads/', 'public/uploads/'], '', $clean), '/');

                // Check if file exists in public/uploads/ on server disk
                $uploadPath = $_SERVER['DOCUMENT_ROOT'] . '/Zeith/public/uploads/' . $filename;
                if (file_exists($uploadPath)) {
                    $product['image_url_1'] = '/Zeith/public/uploads/' . $filename;
                } else {
                    // Fallback to assets folder
                    $product['image_url_1'] = '/Zeith/assets/image/' . $filename;
                }
            }

            return $products;
        } catch (\PDOException $e) {
            return [];
        }
    }
}