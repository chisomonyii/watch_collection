<?php

use App\Helpers\View;

// Group all buyer routes under the /user prefix
$router->mount('/user', function () use ($router) {

    $router->get('/wishlist', function () {
        View::displayView('user/wishlist.php');
    });

    $router->get('/profile', function () {
        View::displayView('user/profile.php');
    });

    $router->get('/orders', function () {
        View::displayView('user/orders.php');
    });

});