<?php

use App\Helpers\View;
use Bramus\Router\Router;

require __DIR__ . '/vendor/autoload.php';

$router = new Router();

$router->setNamespace("App\Controller");


$router->get("/", "Home@showLandingpage");

$router->mount("/auth", function () use ($router) {
    require_once("./routes/auth.php");
});

$router->mount('/staff', function () use ($router) {
    require_once('./routes/staff.php');
});

$router->set404(function () {
    View::displayView('404.php');
});

$router->run();
