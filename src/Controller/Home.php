<?php

namespace App\Controller;

use App\Helpers\Response;
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

    public function displaywishlist()
    {
        View::displayView('user/wishlist.php');
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
            Response::json([
                'success' => true,
                'data' => []
            ]);
            exit;
        }

        try {
            $watches = Watch::getByIds($ids);

            Response::json([
                'success' => true,
                'data' => $watches
            ]);
        } catch (\PDOException $error) {
            Response::json([
                'success' => false,
                'message' => 'Database error: ' . $error->getMessage()
            ], 500);
            
        }
        exit;
    }
}