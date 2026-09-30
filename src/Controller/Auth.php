<?php

namespace App\Controller;

use App\Helpers\View;

class Auth 
{
    public static function showLogin()
    {
        View::displayView("login.php");
        return;
    }

    public static function storeLogin()
    {
        $rawData = file_get_contents("Php://input");
        $data = json_decode($rawData, true);
    }
}