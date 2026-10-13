<?php

namespace App\Middleware;

use App\Helpers\Session;
use App\Helpers\Utilities;
use App\Helpers\View;
use App\Models\Model;

class Authentication
{
    public static function processLogin(string $email, string $password): bool
    {
        Session::start();

        $user = Model::find(['email' => $email], 'users');

        if (!empty($user)) {
            $userHashedPassword = $user['password'];

            if (Utilities::verifyHashpassword($password, $userHashedPassword)) {
                $_SESSION['user'] = $user;
                $_SESSION['user_id'] = $user['id'];

                return true;
            }

            return false;
        }

        return false;
    }

    public static function processRegister(array $data): bool
    {
        // Check if email already exists using the Model class
        $existingUser = Model::find(['email' => $data['email']], 'users');
        if (!empty($existingUser)) {
            return false; // Email already taken
        }

        // Hash password securely
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

        // Prepare user data array for insertion
        $userData = [
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => $hashedPassword,
            'created_at' => date('Y-m-d H:i:s')
        ];

        // Insert user into database using Model
        return (bool) Model::create($userData, 'users');
    }

    public static function user()
    {
        return $_SESSION['user'] ?? null;
    }

    public static function isLoggedIn(): bool
    {
        Session::start();

        if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
            return true;
        }

        return false;
    }
}
