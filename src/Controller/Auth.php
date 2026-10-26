<?php

namespace App\Controller;

use App\Helpers\Response;
use App\Helpers\Session;
use App\Helpers\Validation;
use App\Helpers\View;
use App\Middleware\Authentication;

class Auth
{
    public static function showLogin()
    {
        View::displayView("login.php");
        return;
    }

    public static function showRegister()
    {
        View::displayView("register.php");
        return;
    }

    public static function storeRegister()
    {
        // Catch any accidental output/warnings in an output buffer
        ob_start();

        // Support both JSON payloads (from register.js) and standard form-data
        $rawData = file_get_contents("php://input");
        $data = json_decode($rawData, true);
        if (empty($data)) {
            $data = $_POST;
        }

        $errors = [];
        // ... rest of your validation logic
        // ... rest of your validation logic

        // 1. CSRF Token Verification
        if (!isset($data['csrf_token']) || !Session::checkToken($data['csrf_token'])) {
            if (ob_get_length()) ob_clean();
            Response::json([
                'message' => 'unauthorized request',
                'success' => false,
                'errors' => ['unauthorized request']
            ], 401);
            exit;
        }

        // 2. Validate Empty Inputs
        if (empty(trim($data['firstname'] ?? ''))) {
            $errors[] = "First name is required";
        }
        if (empty(trim($data['lastname'] ?? ''))) {
            $errors[] = "Last name is required";
        }
        if (empty(trim($data['email'] ?? ''))) {
            $errors[] = "Email is required";
        }
        if (empty(trim($data['password'] ?? ''))) {
            $errors[] = "Password is required";
        }

        // 3. Email Format Validation
        if (!empty($data['email']) && !Validation::isEmail($data['email'])) {
            $errors[] = "Invalid email format";
        }

        if (!empty($errors)) {
            if (ob_get_length()) ob_clean();
            Response::json([
                'message' => 'failed validation',
                'success' => false,
                'errors' => $errors
            ], 422);
            exit;
        }

        // 4. Register User by calling Authentication class
        $registered = Authentication::processRegister($data);

        // Wipe output buffer clean before outputting JSON response
        if (ob_get_length()) ob_clean();
        if ($registered) {
            if (ob_get_length()) ob_clean();

            // Send back a clear JSON success response with a redirect URL
            Response::json([
                'message' => 'User registered successfully',
                'success' => true,
                'redirect' => './login.php' // Tells your JS where to go next
            ], 200);
            exit;
        } else {
            Response::json([
                'message' => 'Registration failed. Email might already exist.',
                'success' => false,
                'errors' => ['Could not register user']
            ], 400);
            exit;
        }
    }

    public static function storeLogin()
    {
        ob_start();

        $rawData = file_get_contents("php://input");
        $data = json_decode($rawData, true) ?? [];

        $errors = [];

        if (!isset($data['csrf_token']) || !Session::checkToken($data['csrf_token'])) {
            if (ob_get_length()) ob_clean();
            Response::json([
                'message' => 'unauthorized request',
                'success' => false,
                'errors' => ['unauthorized request']
            ], 401);
            exit;
        }

        if (empty(trim($data['email'] ?? ''))) {
            $errors[] = "email is required";
        }

        if (empty(trim($data['password'] ?? ''))) {
            $errors[] = "password is required";
        }

        if (!empty($errors)) {
            if (ob_get_length()) ob_clean();
            Response::json([
                'message' => 'failed validation',
                'success' => false,
                'errors' => $errors
            ], 422);
            exit;
        }

        $email = $data['email'];
        $password = $data['password'];

        if (!Validation::isEmail($email)) {
            $errors[] = 'invalid email, please check email and try again';
        }

        if (!empty($errors)) {
            if (ob_get_length()) ob_clean();
            Response::json([
                'message' => 'failed validation',
                'success' => false,
                'errors' => $errors
            ], 422);
            exit;
        }

       if (ob_get_length()) ob_clean();

        if (Authentication::processLogin($email, $password)) {
            
            // Get the user data from session to check role
            $user = Authentication::user();
            $role = $user['role'] ?? 'staff';

            // Determine redirect destination based on database role
            $redirectUrl = ($role === 'admin') 
                ? '/Watch_Collection/admin/dashboard' 
                : '/Watch_Collection/staff/dashboard';

            Response::json([
                'message' => 'User has been logged in successfully',
                'success' => true,
                'redirect' => $redirectUrl // Send the dynamic route back to frontend JS
            ], 200);
            exit;
        } else {
            // ... existing error handling ...
            // Check if there's a specific session login error (e.g. pending staff approval)
            $errorMsg = $_SESSION['login_error'] ?? 'invalid credentials';
            unset($_SESSION['login_error']);

            Response::json([
                'message' => $errorMsg,
                'success' => false,
                'errors' => [$errorMsg]
            ], 422);
            exit;
        }
    }

    public static function unauthorize_request()
    {
        Session::start();

        if (!Authentication::isLoggedIn()) {
            View::displayView('unauthorize_request.php');
            exit();
        }

        return;
    }
}
