<?php

namespace App\Controller;

use App\Models\Watch;
use App\Helpers\View;

class Home
{
    /**
     * Renders the home / landing page with products from the database
     */
   public static function showLandingpage()
    {
        try {
            $products = Watch::getNewArrivals(8);
        } catch (\PDOException $e) {
            $products = [];
        }

        // Updated path to include the guests subfolder
        View::displayView('guests/home.php', [
            'newArrivals' => $products
        ]);
    }

    public static function getWishlistItems()
    {
        // Clear any previous output buffers to ensure clean JSON output
        if (ob_get_length()) {
            ob_clean();
        }

        header('Content-Type: application/json');

        // Read raw JSON input from request body
        $rawData = file_get_contents("php://input");
        $data = json_decode($rawData, true) ?? [];
        $ids = $data['ids'] ?? [];

        if (empty($ids) || !is_array($ids)) {
            echo json_encode([
                'success' => true,
                'data' => []
            ]);
            exit;
        }

        try {
            $watches = Watch::getByIds($ids);

            echo json_encode([
                'success' => true,
                'data' => $watches
            ]);
        } catch (\PDOException $e) {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Database error: ' . $e->getMessage()
            ]);
        }
        exit;
    }
}