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
                
                
                $role = $user['role'] ?? 'staff';
                $status = $user['status'] ?? 'approved';

                // NOTE: We removed the check that blocks pending/rejected staff here.
                // This allows them to log in successfully and reach their dashboard,
                // where the Staff controller will dynamically load staffApproval.php!

                // SUCCESSFUL LOGIN SESSION SETUP
                $_SESSION['user'] = $user;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_role'] = $role; // Save role for dashboard role guards

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

        // SECURITY OVERRIDE: Force ALL public registrations to be 'staff' and 'pending'
        // Admins can only be promoted directly inside the database table later!
        $role = 'staff'; 
        $status = 'pending';

        // Prepare user data array for insertion matching your database schema
        $userData = [
            'firstname'  => $data['firstname'],
            'lastname'   => $data['lastname'],
            'email'      => $data['email'],
            'password'   => $hashedPassword,
            'role'       => $role,
            'status'     => $status,
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

    public static function isAdmin(): bool
    {
        Session::start();
        $user = $_SESSION['user'] ?? null;
        return isset($user['role']) && $user['role'] === 'admin';
    }

    public static function isStaff(): bool
    {
        Session::start();
        $user = $_SESSION['user'] ?? null;
        $role = $user['role'] ?? '';
        return isset($user) && ($role === 'staff' || $role === 'admin');
    }
}