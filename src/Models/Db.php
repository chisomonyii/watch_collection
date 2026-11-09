<?php

namespace App\Models;

use PDO;

abstract class Db
{
    public static function connect()
    {
        try {
            // Updated fallbacks to point to local XAMPP by default
            $host = $_ENV['DB_HOST'] ?? 'localhost';
            $port = $_ENV['DB_PORT'] ?? '3306';
            $db   = $_ENV['DB_NAME'] ?? 'Watch_Collection';
            $user = $_ENV['DB_USER'] ?? 'root';
            $password = $_ENV['DB_PASS'] ?? '';

            $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";

            $connection = new PDO($dsn, $user, $password, [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);

            return $connection;

        } catch (\Exception $error) {
            echo "Database Connection Error: " . $error->getMessage();
            die();
        }
    }
}