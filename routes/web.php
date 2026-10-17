<?php

use App\Controller\ProductController;

$productController = new ProductController();

// Support both local server path variations to prevent 404s
$router->get('/search', function() use ($productController) {
    $productController->search();
});

$router->get('/Watch_Collection/search', function() use ($productController) {
    $productController->search();
});

$router->get('/api/search', function() use ($productController) {
    $productController->liveSearchApi();
});

$router->get('/Watch_Collection/api/search', function() use ($productController) {
    $productController->liveSearchApi();
});