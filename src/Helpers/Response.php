<?php

namespace App\Helpers;

class Response{
    

    public static function json($data, $code = 200){
        header("Content-Type:application/json");
        http_response_code($code);
        echo json_encode($data);
    }
}