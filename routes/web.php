<?php

use App\Controller\ProductController;

$productController = new ProductController();

// API Search route (for the live dropdown)
$router->get('/api/search', function() use ($productController) {
    $productController->liveSearchApi();
});

$router->get('/Watch_Collection/api/search', function() use ($productController) {
    $productController->liveSearchApi();
});

// Full Search Results Page route (when clicking enter or "View all")
$router->get('/product/search', function() use ($productController) {
    $productController->search();
});

$router->get('/Watch_Collection/product/search', function() use ($productController) {
    $productController->search();
});