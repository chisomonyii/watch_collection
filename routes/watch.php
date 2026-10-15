<?php
$router->get('/user-wishlist', 'Home@displaywishlist');

// API endpoint to fetch details of saved watch IDs
$router->post('/api/watches/batch', function() {
    \App\Controller\Home::getWishlistItems();
});

$router->get('/user/collection', 'App\Controller\Collection@show');
