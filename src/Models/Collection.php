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

    /**
     * Fetch watches belonging to a collection by its slug
     */
    public static function getByCollectionSlug(string $slug): array
    {
        $db = parent::connect();
        $stmt = $db->prepare("
            SELECT watches.* FROM watches 
            JOIN collections ON watches.collection_id = collections.id 
            WHERE collections.slug = :slug
        ");
        $stmt->execute(['slug' => $slug]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}