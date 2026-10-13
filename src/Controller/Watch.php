<?php

namespace App\Controller;

use App\Models\Watch as WatchModel;
use App\Helpers\View;

class Watch
{
    /**
     * Display the Watch catalog page view
     */
    public static function showWatchPage()
    {
        // Fetch all watches from the database to send to the view
        $watches = WatchModel::getAll();
        
        View::displayView('user/watch.php', [
            'watches' => $watches
        ]);
    }

    /**
     * Fetch products by array of IDs (for localStorage hydration)
     */
    public static function getCartItems()
    {
        header('Content-Type: application/json');

        $input = json_decode(file_get_contents('php://input'), true);
        $ids = $input['ids'] ?? [];

        if (empty($ids)) {
            echo json_encode(['success' => true, 'data' => []]);
            exit;
        }

        // Fetch watch details from database using existing Watch model method
        $watches = method_exists(WatchModel::class, 'findByIds') 
            ? WatchModel::findByIds($ids) 
            : [];

        echo json_encode([
            'success' => true,
            'data'    => $watches
        ]);
        exit;
    }
}