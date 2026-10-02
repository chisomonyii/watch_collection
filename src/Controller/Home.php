<?php

namespace App\Controller;

use App\Helpers\View;

class Home
{
    public static function showLandingpage()
    {
        View::displayView("guests/home.php");
        exit;
    }
}