<?php

$router->get('/user-wishlist', 'Home@displaywishlist');

// API endpoint to fetch details of saved watch IDs
$router->post('/api/watches/batch', function() {
    \App\Controller\Home::getWishlistItems();
});

$router->get('/user/collection', 'App\Controller\Collection@show');

// Corrected route pointing directly to the namespaced controller method
// Change this:
// $router->get('/watch/details', 'Watchcontroller@showDetails');

// To this:
$router->get('/watch/details/(\d+)', 'Watchcontroller@showDetails');