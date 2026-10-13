<?php

namespace App\Helpers;

class Validation
{
    public static function isEmail(string $string)
    {
        return filter_var($string, FILTER_VALIDATE_EMAIL);
    }

    public static function isPassword(string $password)
    {
        if (strlen($password) < 6) {
            return false;
        }

        if (!preg_match('/[A-Z]/', $password)) {
            return false;
        }

        if (!preg_match('/[a-z]/', $password)) {
            return false;
        }

        if (!preg_match('/[!@#$%^&*]/', $password)) {
            return false;
        }

        return true;
    }
}
