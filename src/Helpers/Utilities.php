<?php

namespace App\Helpers;

require_once(__DIR__ . "/../../load_env.php");

class Utilities
{
    public static function hashPassword(string $password)
    {
        // Uses native PHP secure internal salting and hashing
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public static function verifyHashpassword(string $password, string $hashPassword)
    {
        // Safely verifies standard password hashes
        return password_verify($password, $hashPassword);
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