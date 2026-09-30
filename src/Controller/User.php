<?php
namespace App\Controller;

use App\Helpers\View;

class User 
{
    public static function showRegister()
    {
        View::displayView("register.php");
        return;
    }
}