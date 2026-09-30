<?php
namespace App\Helpers;
require_once "/../../load_env.php";

class Utilities
{
    public static function hashPassword($password)
    {
        $salt = $_ENV['SALT'];
        $salted = "$salt+$password";
        $myPassword = password_hash($salted, PASSWORD_BCRYPT);
        return $myPassword;
        
    }

    public static function verifyHashpassword($password, $hashPassword)
    {
        $salt = $_ENV['SALT'];
        $salted = "$salt+$password";
        $verifyPassey = password_verify($salted, $hashPassword);
        return $verifyPassey;
    }

    public static function sieve($input)
    {
        $sieve = htmlspecialchars(htmlentities(trim($input)));
        return $sieve;
    }

    public static function CSRF_token()
    {
        return bin2hex(random_bytes(32));
    
    }
}
