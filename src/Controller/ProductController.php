<?php

namespace App\Controller;

use App\Models\Product;

class ProductController 
{
    public function search() {
        $keyword = trim($_GET['q'] ?? $_GET['search'] ?? '');
        
        $products = [];
        if (!empty($keyword)) {
            // Instantiate the Product model directly
            $productModel = new Product();
            $products = $productModel->searchProducts($keyword);
        }

        require_once __DIR__ . '/../View/product/search-results.php';
    }

    public function liveSearchApi() {
        header('Content-Type: application/json');
        $keyword = trim($_GET['q'] ?? '');
        
        if (strlen($keyword) < 2) {
            echo json_encode([]);
            return;
        }

        // Instantiate the Product model directly
        $productModel = new Product();
        $products = $productModel->searchProducts($keyword);
        $limitedProducts = array_slice($products, 0, 5);
        
        echo json_encode($limitedProducts);
    }
}