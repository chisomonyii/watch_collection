<?php

namespace App\Helpers;

class Session
{
    public static function start()
    {
        if(session_start() === PHP_SESSION_NONE){
            session_start();
        }
    }

    public static function checkToken($token)
    {
         if(session_start() === PHP_SESSION_NONE){
            session_start();
        }

        if(!isset($_SESSION['csrf_token'])){
            return false;
        }

        if($token !== $_SESSION['csrf_token']){
            return false;
        }

        return true;
    }
   

    
}
