<?php

use App\Helpers\View;

    $router->get('/wishlist', function () {
        View::displayView('user/wishlist.php');
    });

    $router->get('/profile', function () {
        View::displayView('user/profile.php');
    });

    $router->get('/orders', function () {
        View::displayView('user/orders.php');
    });