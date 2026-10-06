<?php

require __DIR__ . '/vendor/autoload.php';

use Bramus\Router\Router;
use App\Helpers\View;

$router = new Router();

// Set base path for XAMPP subfolder
$router->setBasePath('/Watch_Collection');

$router->setNamespace("App\Controller");

$router->get("/", "Home@showLandingpage");

// Route modules
require_once __DIR__ . '/routes/auth.php';
require_once __DIR__ . '/routes/staff.php';
require_once __DIR__ . '/routes/watch.php';
require_once __DIR__ . '/routes/user.php';

// 404 Fallback
$router->set404(function () {
    View::displayView('404.php');
});

$router->run();