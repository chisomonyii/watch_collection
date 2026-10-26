<?php

namespace App\Models;

use PDO;

class Product 
{
    private ?PDO $pdo = null;

    public function __construct() {
        $host = 'localhost';
        $db   = 'watch_collection';
        $user = 'root';
        $pass = '';

        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            die(json_encode(["error" => "Database connection failed: " . $e->getMessage()]));
        }
    }

    public function searchProducts(string $keyword) {
        if (!$this->pdo) return [];

        $searchTerm = "%" . trim($keyword) . "%";

        try {
            // Removed 'brand' column since your watches table uses collection_id
            $stmt = $this->pdo->prepare("
                SELECT * FROM watches 
                WHERE name LIKE ? 
                   OR description LIKE ?
                ORDER BY id DESC
            ");
            
            $stmt->execute([$searchTerm, $searchTerm]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return [];
        }
    }
}