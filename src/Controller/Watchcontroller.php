<?php

namespace App\Controller;

use App\Helpers\Response;
use App\Models\Model;

class Watchcontroller extends Controller
{
    // create new watches 
    public function createWatch()
    {
        $errors = [];
        $rawdata = file_get_contents("Php://input");
        $data = json_decode($rawdata, true);

        $requiredfields = ['collection_id', 'name', 'price', 'image_url', 'ratin', 'reviews_count', 'description', 'in_stock', 'is_featured'];

        foreach ($requiredfields as $fields) {
            if (!isset($data[$fields])) {
                $errors[] = "missing $fields, $fields is required.";
            }
        }

         if (!empty($errors)) {
            Response::json([
                'message' => 'error occured',
                'errors' => $errors,
                'success' => false
            ],400);
            exit;
        }

        $collectionId = $data['collection_id'];
        $name = $data['name'];
        $price = $data['price'];
        $imageUrl = $data['image_url'];
        $rating = $data['ratin'];
        $reviewsCount = $data['reviews_count'];
        $description = $data['description'];
        $inStock = $data['in_stock'];
        $isFeatured = $data['is_featured'];



        $watches = [
            'collection_id' => $collectionId,
            'name' => $name,
            'price' => $price,
            'image_url' => $imageUrl,
            'ratin' => $rating,
            'reviews_count' => $reviewsCount,
            'description' => $description,
            'in_stock' => $inStock,
            'is_featured' => $isFeatured

        ];

        Model::create($watches, 'watches');
        Response::json([
            'message' => 'watch has been created successfully',
            'sucess' => 'true',

        ]);      
    }
}
