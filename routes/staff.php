<?php

$router->get('/dashboard', 'User@dashboard');

$router->get('/orders', 'User@displayOrders');

$router->get('/settings', 'User@showSettings');

// API endpoint for batch fetching wishlist items
// $router->post('/api/watches/batch', function () {
//     \App\Controller\Home::getWishlistItems();
// });