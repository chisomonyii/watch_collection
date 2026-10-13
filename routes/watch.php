<?php
$router->get('/user-wishlist', 'Home@displaywishlist');

$router->post('api/wishlist', 'Home@getWishlistItems');

$router->post('/watches/api', 'Watchcontroller@createWatch');