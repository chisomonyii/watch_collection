<?php

use Bramus\Router\Router;

require __DIR__ . '/vendor/autoload.php';

$router = new Router();

$router->setNamespace("App\Controller");

// $router->mount("/auth", function () use ($router) {
//     require_once("./routes/auth.php");
// });

$router->mount("/auth", function () use ($router){
    require_once __DIR__ . "/routes/auth.php";
});
$router->run();