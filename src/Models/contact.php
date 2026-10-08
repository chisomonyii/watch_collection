<?php

namespace App\Models;

use PDO;

class Contact extends Model
{
    /**
     * Store a new contact form submission
     */
    public static function store(array $data): bool
    {
        $db = parent::connect();

        $sql = "INSERT INTO contact (name, email, phone, message) 
                VALUES (:name, :email, :phone, :message)";

        $stmt = $db->prepare($sql);

        return $stmt->execute([
            'name'    => trim($data['name'] ?? ''),
            'email'   => trim($data['email'] ?? ''),
            'phone'   => trim($data['phone'] ?? ''),
            'message' => trim($data['message'] ?? '')
        ]);
    }
}