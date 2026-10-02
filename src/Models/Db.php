<?php

namespace App\Models;

use PDO;

abstract class Db
{
    protected static function connect()
    {
        try {
            $dsn = "mysql:host=localhost;dbname=watch_collection;";
            $user = "root";
            $password = "";

            $connection = new PDO($dsn, $user, $password, [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);

            return $connection;

        } catch (\Exception $error) {
            echo $error->getMessage();
            die();
        }
    }
}