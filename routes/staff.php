<?php

$router->before('GET|POST|PATCH|PUT|DELETE', '/.*', 'Auth@unauthorize_request');
$router->get('/dashboard', "User@dashboard");
$router->get('/settings', 'User@Settings');
$router->get('/wishlist', 'User@showWishlist');
$router->get('/orders', 'User@displayOrders');