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

    public static function storeLogin()
    {
        $rawData = file_get_contents("Php://input");
        $data = json_decode($rawData, true);

        $errors = [];


        if (!isset($data['csrf_token'])) {
            $errors[] = "unauthorized request";

            Response::json([
                'message' => 'unauthorized request',
                'success' => false,
                'errors' => $errors
            ], 401);
            exit;
        }

        if (!Session::checkToken($data['csrf_token'])) {

            $errors[] = "unauthorized request";
            Response::json([
                'message' => 'unauthorized request',
                'success' => false,
                'errors' => $errors
            ], 401);
            exit;
        }

        if (empty($data)) {
            $errors[] = "password and email is required";
        }

        if (isset($data['email']) && empty(trim($data['email']))) {
            $errors[] = "email is required";
        }

        if (isset($data['password']) && empty(trim($data['password']))) {
            $errors[] = "password is required";
        }


        if (!empty($errors)) {
            Response::json([
                'message' => 'failed validation',
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
            Response::json([
                'message' => 'failed validation',
                'errors' => $errors
            ], 422);
            exit;
        }


        if (Authentication::processLogin($email, $password)) {
            Response::json([
                'message' => 'User has been logged in successfully',
                'success' => true
            ], 200);
            exit;
        } else {

            $errors[] = 'invalid credentials';

            Response::json([
                'message' => 'invalid credentials',
                'errors' => $errors
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
