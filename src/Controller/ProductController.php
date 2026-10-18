<?php

namespace App\Controller;

use App\Models\Product;
use App\Helpers\View;

class ProductController 
{
    // 1. Handles the JSON live autocomplete fetch requests
    public function liveSearchApi() {
        $query = $_GET['q'] ?? '';
        $productModel = new Product();
        $results = $productModel->searchProducts($query);

        header('Content-Type: application/json');
        echo json_encode($results);
        exit;
    }

    // 2. Handles the full search results page when clicking "View all" or Enter
    public function search() {
        $query = $_GET['q'] ?? '';
        $productModel = new Product();
        $results = $productModel->searchProducts($query);

        // Pass results to your search-result view template
        // Adjust the view path to match where your template lives
        View::displayView('product/search-result.php', [
            'query' => $query,
            'results' => $results
        ]);
    }
}