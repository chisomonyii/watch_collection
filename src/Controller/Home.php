<?php

namespace App\Controller;

use App\Models\Watch;

class Home
{
    // ... your existing methods (e.g., showLandingpage)

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