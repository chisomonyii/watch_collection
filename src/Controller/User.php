<?php

namespace App\Controller;

use App\Controller\Controller;
use App\Helpers\Response;
use App\Helpers\Utilities;
use App\Helpers\Validation;
use App\Helpers\View;
use App\Models\Model;

class User extends Controller
{
    public static function showRegister()
    {
        View::displayView("register.php");
        return;
    }

    public function storeRegister()
    {

        $errors = [];

        $rawData = file_get_contents("php://input");
        $datas = json_decode($rawData, true);
        $required_fields = ['email', 'firstname', 'lastname', 'password'];

        // validation for required fields
        foreach ($required_fields as $field) {
            if (!isset($datas[$field])) {
                array_push($errors, "$field is required");
            }
        }

        if (!empty($errors)) {
            Response::json([
                'message' => 'failed validation',
                'errors' => $errors,
                'success' => false
            ]);
            exit;
        }

        // validation for empty fields
        foreach ($datas as $field => $value) {
            if (empty(trim($value)) && in_array($field, $required_fields)) {
                array_push($errors, "$field cannot be empty");
            }
        }

        if (!empty($errors)) {
            Response::json([
                'message' => 'failed validation',
                'errors' => $errors,
                'success' => false
            ], 400);
            exit;
        }

        unset($datas['csrf_token']);


        // validate email
        if (!Validation::isEmail($datas['email'])) {
            $errors[] = "invalid email {$datas['email']}";
        }

        // validate password
        if (!Validation::isPassword($datas['password'])) {
            $errors[] = "invalid password. password must be 6 character long and contain an uppercase, lowerase, number, and special characters";
        }

        // EMAIL ALREADY EXIST
        $result =  Model::find(['email' => $datas['email']], 'users');
        if (count($result) >= 1) {
            $errors[] = "email already exist. please try another email ";
        }

        if (!empty($errors)) {
            Response::json([
                'message' => 'failed validation',
                'errors' => $errors,
                'success' => false
            ], 400);
            exit;
        }

        array_walk($datas, function ($string) {
            Utilities::sieve($string);
        });

        $datas['password'] = Utilities::hashPassword($datas['password']);

        try {
            $result =  Model::create($datas, 'users');
            if ($result) {
                Response::json([
                    'message' => 'created successful',
                    'user' => $datas,
                    'success' => true
                ], 201);
                exit;
            }

            Response::json([
                'message' => 'ooops! something went wrong please try again',
                'user' => null,
                'success' => false
            ], 500);
            exit;
        } catch (\PDOException $error) {
            Response::json([
                'message' => $error->getMessage(),
                'user' => null,
                'success' => false
            ], 500);
            exit;
        }
    }

    public static function dashboard()
    {
        View::displayView('users/dashboard.php');
    }

    public static function Settings()
    {
        View::displayView('users/settings.php');
    }

    public static function showWishlist()
    {
        View::displayView('users/wishlist.php');
    }

    public static function displayOrders()
    {
        View::displayView('users/orders.php');
    }
}

