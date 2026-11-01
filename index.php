<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/vendor/autoload.php';

use Bramus\Router\Router;
use App\Helpers\View;

$router = new Router();

// Set base path for XAMPP subfolder
$router->setBasePath('/Watch_Collection');

$router->setNamespace("App\Controller");

$router->get("/", "Home@showLandingpage");

// Route modules
// Route modules
require_once __DIR__ . '/routes/auth.php';
require_once __DIR__ . '/routes/staff.php';
require_once __DIR__ . '/routes/watch.php';
require_once __DIR__ . '/routes/checkout.php';
require_once __DIR__ . '/routes/contact.php';
require_once __DIR__ . '/routes/admin.php'; // Fixed path

// Wishlist Page Route
$router->get('/user/wishlist', function () {
    View::displayView('user/wishlist.php');
});

// API Endpoint for Wishlist Items Hydration
$router->post('/api/wishlist-items', 'Home@getWishlistItems');

// Mount User Routes Sub-router
$router->mount('/user', function () use ($router) {
    require_once('./routes/user.php');
});

$router->set404(function () {
    View::displayView('404.php');
});

// View route for watch catalog
$router->get('/user/watch', 'Watch@showWatchPage');

// View route for brand/collection pages
$router->get('/user/watch/collection/{name}', 'Collection@showByPath');

// API route to get watch details for saved items
$router->post('/api/watch-items', 'Watch@getCartItems');

// Live Search API Route for Autocomplete Dropdown
$router->get('/api/search', 'ProductController@liveSearchApi');

// Full Search Results Page Route (Frame 2 / View All)
$router->get('/product/search', 'ProductController@search');

$router->get('/review/submit', 'Home@displayReviewForm');
$router->post('/review/store', 'Home@storeReview');

$router->get('/news', 'Home@displayNewsPage');
$router->get('/news/{slug}', 'Home@displayArticle');

$router->get('/about', 'Home@displayAboutPage');
$router->post('/api/subscribe', 'Home@subscribeNewsletter');

$router->get('/admin/dashboard', 'AdminController@dashboard');


$router->run();