<?php

namespace App\Controller;

use App\Helpers\Response;
use App\Models\Model;
use App\Models\Watch;
use App\Helpers\Db; // Adjust namespace if your Db helper lives in App\Models\Db or App\Helpers\Db

class Watchcontroller extends Controller
{
    /**
     * Create a new watch
     */
    public function createWatch()
    {
        $errors = [];
        $rawdata = file_get_contents("php://input");
        $data = json_decode($rawdata, true);

        $requiredfields = ['collection_id', 'name', 'price', 'image_url', 'rating', 'reviews_count', 'description', 'in_stock', 'is_featured'];

        foreach ($requiredfields as $field) {
            if (!isset($data[$field])) {
                $errors[] = "Missing $field; $field is required.";
            }
        }

        if (!empty($errors)) {
            Response::json([
                'message' => 'Validation error occurred',
                'errors'  => $errors,
                'success' => false
            ], 400);
            exit;
        }

        $watches = [
            'collection_id' => $data['collection_id'],
            'name'          => $data['name'],
            'price'         => $data['price'],
            'image_url'     => $data['image_url'],
            'rating'        => $data['rating'],
            'reviews_count' => $data['reviews_count'],
            'description'   => $data['description'],
            'in_stock'      => $data['in_stock'],
            'is_featured'   => $data['is_featured']
        ];

        Model::create($watches, 'watches');

        Response::json([
            'message' => 'Watch has been created successfully',
            'success' => true
        ], 201);
    }

    /**
     * Display watch details page
     */
    /**
     * Display watch details page
     */
    /**
     * Display watch details page
     */
    public function showDetails($watchId = null)
    {
        // Fallback to query string if URL parameter isn't passed directly
        if (!$watchId) {
            $watchId = $_GET['id'] ?? 1;
        }

        // Fetch Watch details joined with collection attributes
        $watchModel = new Watch();
        $watch = $watchModel->getWatchById($watchId);

        // Fallback data structure if watch ID does not exist in DB
        if (!$watch) {
            $watch = [
                'id'           => 1,
                'name'         => 'Nautilus 5711',
                'description'  => 'Porthole construction case with horizontally embossed blue dial.',
                'price'        => 85000,
                'strap'        => 'Interchangeable soft silicone sport strap with secure pin-and-tuck closure mechanism.',
                'manual_file'  => 'default-watch-manual.pdf',
                'attributes'   => '[{"title":"Perpetual Movement","sub":"Self-winding power"},{"title":"Oystersteel Case","sub":"Superior scratch resistance"},{"title":"Superlative Chronometer","sub":"Maximum precision timing"}]',
                'image_url_1'  => 'Nautilus_5711-removebg-preview.png',
                'image_url_2'  => 'Precisionist_Chronograph-removebg-preview.png',
                'image_url_3'  => 'Transporter_Black_Gold-removebg-preview.png',
                'image_url_4'  => 'Premium_Dual_Time-removebg-preview.png'
            ];
        }

        // Fetch shipping methods from DB safely
        try {
            $db = Watch::connect();
            $shippingStmt = $db->prepare("SELECT * FROM shipping_methods");
            $shippingStmt->execute();
            $shippingMethods = $shippingStmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            $shippingMethods = [];
        }

       // Load the view file safely using absolute directory paths
        require_once __DIR__ . '/../View/user/watch-details.php';
    }
}
