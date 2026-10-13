<?php

namespace App\Helpers;

require_once(__DIR__ . "/../../load_env.php");

class Utilities
{
    public static function hashPassword(string $password)
    {
        // Safe fallback if 'SALT' is not set in $_ENV
        $salt = $_ENV['SALT'] ?? 'default_secure_salt_string';
        $salted = "$salt+$password";
        return password_hash($salted, PASSWORD_BCRYPT);
    }

    public static function verifyHashpassword(string $password, string $hashPassword)
    {
        $salt = $_ENV['SALT'] ?? 'default_secure_salt_string';
        $salted = "$salt+$password";
        return password_verify($salted, $hashPassword);
    }

    public static function sieve(string $input)
    {
        return htmlspecialchars(htmlentities(trim($input)));
    }

    public static function CSRF_token()
    {
        return bin2hex(random_bytes(32));
    }
}
