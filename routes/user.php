<?php

// User / Buyer Routes

$router->get('/wishlist', function () {
    \App\Helpers\View::displayView('user/wishlist.php');
});

// Add other buyer pages here in the future:
// $router->get('/profile', function () {
//     \App\Helpers\View::displayView('user/profile.php');
// });