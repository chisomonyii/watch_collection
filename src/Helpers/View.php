<?php

namespace App\Helpers;

use App\Helpers\Helper;

class View extends Helper
{
    public static function displayView($filename, $data = null)
    {
        Session::start();
        $csrf_token = "";
        if (isset($_SESSION['csrf_token']) && !empty($_SESSION['csrf_token'])) {
            $csrf_token = $_SESSION['csrf_token'];
        } else {
            $_SESSION['csrf_token'] = Utilities::CSRF_token();
            $csrf_token = $_SESSION['csrf_token'];
        }

        $filepath = (new self)->root_dir . "/src/View/{$filename}";
        $root_dir = (new self)->root_dir;

        if (file_exists($filepath)) {
            require_once (new self)->root_dir . "/Core/utilities.php";
            
            // Extract BEFORE including the template file
            if (is_array($data)) {
                extract($data);
            }

            include_once("$filepath");
        } else {
            echo "View file not found at: " . $filepath;
        }
        return;
    }

    public static function displayComponent($filename, $data = null)
    {
        $filepath = (new self)->root_dir . "/src/View/component/{$filename}";
        $root_dir = (new self)->root_dir;

        if (file_exists($filepath)) {
            require_once (new self)->root_dir . "/Core/utilities.php";
            
            if (is_array($data)) {
                extract($data);
            }

            include_once("$filepath");
        }
        return;
    }
}