<?php

// GET view for Staff Wishlist

// Other staff pages...
$router->get('/dashboard', function () {
    \App\Helpers\View::displayView('staffs/dashboard.php');
});

$router->get('/orders', function () {
    \App\Helpers\View::displayView('staffs/orders.php');
});

$router->get('/settings', function () {
    \App\Helpers\View::displayView('staffs/settings.php');
});

// API endpoint for batch fetching wishlist items
$router->post('/api/watches/batch', function () {
    \App\Controller\Home::getWishlistItems();
});