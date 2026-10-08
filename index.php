<?php

require __DIR__ . '/vendor/autoload.php';

use Bramus\Router\Router;
use App\Helpers\View;

$router = new Router();

// Set base path for XAMPP subfolder
$router->setBasePath('/Watch_Collection');

// Set default controller namespace
$router->setNamespace("App\Controller");

// Home Route
$router->get("/", "Home@showLandingpage");

// Route modules
require_once __DIR__ . '/routes/auth.php';
require_once __DIR__ . '/routes/staff.php';
require_once __DIR__ . '/routes/watch.php';

// Wishlist Page Route
$router->get('/user/wishlist', function () {
    View::displayView('user/wishlist.php');
});

// API Endpoint for Wishlist Items Hydration
$router->post('/api/wishlist-items', 'Home@getWishlistItems');

// Mount User Routes Sub-router (if you have additional user routes in routes/user.php)
$router->mount('/user', function () use ($router) {
    require_once __DIR__ . '/routes/user.php';
});

// 404 Fallback
$router->set404(function () {
    View::displayView('404.php');
});

require_once __DIR__ . '/routes/contact.php';

$router->run();