<?php

namespace App\Models;

use PDO;

class Collection extends Model
{
    /**
     * Fetch all collections for sidebar navigation
     */
    public static function getAll(): array
    {
        $db = parent::connect();
        $stmt = $db->query("SELECT * FROM collections ORDER BY name ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Fetch a single collection by slug
     */
    public static function findBySlug(string $slug): ?array
    {
        $db = parent::connect();
        $stmt = $db->prepare("SELECT * FROM collections WHERE slug = :slug LIMIT 1");
        $stmt->execute(['slug' => $slug]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result ?: null;
    }
}