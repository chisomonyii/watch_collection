<?php

namespace App\Controller;

use App\Models\Product;
use App\Helpers\View;

class ProductController 
{
    // 1. Handles the JSON live autocomplete fetch requests
    // 1. Handles the JSON live autocomplete fetch requests
    public function liveSearchApi() {
        $query = $_GET['q'] ?? '';
        $productModel = new Product();
        $results = $productModel->searchProducts($query);

        // Resolve image paths for JSON output
        foreach ($results as &$product) {
            $rawImage = $product['image_url_1'] ?? '';
            $clean = trim($rawImage);

            if (empty($clean)) {
                $product['image_url_1'] = '/Zeith/assets/image/pngwing.com (1).png';
                continue;
            }

            if (str_starts_with($clean, 'http://') || str_starts_with($clean, 'https://') || str_starts_with($clean, '/')) {
                continue;
            }

            $filename = ltrim(str_replace(['/Zeith/assets/image/', 'assets/image/', '/Zeith/public/uploads/', 'public/uploads/'], '', $clean), '/');

            $uploadPath = $_SERVER['DOCUMENT_ROOT'] . '/Zeith/public/uploads/' . $filename;
            if (file_exists($uploadPath)) {
                $product['image_url_1'] = '/Zeith/public/uploads/' . $filename;
            } else {
                $product['image_url_1'] = '/Zeith/assets/image/' . $filename;
            }
        }

        header('Content-Type: application/json');
        echo json_encode($results);
        exit;
    }

    // 2. Handles the full search results page when clicking "View all" or Enter
    public function search() {
        $query = $_GET['q'] ?? '';
        $productModel = new Product();
        $results = $productModel->searchProducts($query);

        // Change 'results' to 'products' to match your view loop
        View::displayView('product/search-result.php', [
            'keyword' => $query,
            'products' => $results
        ]);
    }
}