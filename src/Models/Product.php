<?php

namespace App\Models;

use PDO;

class Product 
{
    private ?PDO $pdo = null;

    public function __construct() {
        $host = 'localhost';
        $db   = 'Watch_Collection';
        $user = 'root';
        $pass = '';

        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            die("Database Connection Error: " . $e->getMessage());
        }
    }

    /**
     * Search for products based on a keyword across name, brand, and description
     */
   public function searchProducts(string $keyword) {
        $searchTerm = "%" . trim($keyword) . "%";

        $stmt = $this->pdo->prepare("
            SELECT * FROM watches 
            WHERE name LIKE ? 
               OR brand LIKE ? 
               OR description LIKE ?
            ORDER BY id DESC
        ");
        
        $stmt->execute([$searchTerm, $searchTerm, $searchTerm]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}