<?php
// Render wishlist view
$router->get('/wishlist', function() {
    \App\Helpers\View::displayView('users/wishlist.php');
});

// API endpoint to fetch details of saved watch IDs
$router->post('/api/watches/batch', function() {
    \App\Controller\Home::getWishlistItems();
});