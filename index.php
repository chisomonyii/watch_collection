<?php

require __DIR__ . '/vendor/autoload.php';

use Bramus\Router\Router;
use App\Helpers\View;

$router = new Router();

// Set base path for XAMPP subfolder
$router->setBasePath('/Watch_Collection');

$router->setNamespace("App\Controller");

$router->get("/", "Home@showLandingpage");

$router->mount('/watch', function () use ($router) {
    require_once('./routes/watch.php');
});

$router->mount('/auth', function () use ($router) {
    require_once('./routes/auth.php');
});

$router->mount('/staff', function () use ($router) {
    require_once('./routes/staff.php');
});

$router->mount('/contact', function () use ($router) {
    require_once('./routes/contact.php');
});

// API Endpoint for Wishlist Items Hydration
$router->post('/api/wishlist-items', 'Home@getWishlistItems');

$router->mount('/user', function () use ($router) {
    require_once('./routes/user.php');
});

$router->set404(function () {
    View::displayView('404.php');
});

$router->run();
