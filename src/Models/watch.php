<?php

namespace App\Models;

use PDO;

class Watch extends Model
{
    /**
     * Fetch a batch of watches by IDs along with their collection details & ratings
     */
    public static function getByIds(array $ids)
    {
        if (empty($ids)) {
            return [];
        }

        $cleanIds = array_map('intval', $ids);
        $placeholders = implode(',', array_fill(0, count($cleanIds), '?'));

        $db = parent::connect();

        $sql = "SELECT 
                    w.id, 
                    w.name, 
                    w.price, 
                    w.image_url, 
                    w.image_url AS image, 
                    w.rating,
                    w.reviews_count,
                    w.description,
                    w.in_stock,
                    c.name AS brand,
                    c.name AS collection_name,
                    c.slug AS collection_slug
                FROM watches w
                LEFT JOIN collections c ON w.collection_id = c.id
                WHERE w.id IN ($placeholders)";

        $stmt = $db->prepare($sql);
        $stmt->execute($cleanIds);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Alias for getByIds to support Controller method calls
     */
    public static function findByIds(array $ids): array
    {
        return static::getByIds($ids);
    }

    /**
     * Fetch all watches belonging to a specific collection slug (e.g., 'g-shock', 'rolex')
     */
    public static function getByCollectionSlug(string $slug): array
    {
        $db = parent::connect();

        $sql = "SELECT 
                w.id, 
                w.name, 
                w.price, 
                w.image_url, 
                w.rating,
                w.reviews_count,
                w.description,
                w.in_stock,
                c.name AS brand,
                c.name AS collection_name
            FROM watches w
            INNER JOIN collections c ON w.collection_id = c.id
            WHERE LOWER(c.slug) = LOWER(:slug) OR LOWER(c.name) LIKE LOWER(:brandSearch)";

        $stmt = $db->prepare($sql);
        $stmt->execute([
            'slug'        => $slug,
            'brandSearch' => '%' . $slug . '%'
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Fetch the newest watches ordered by latest ID
     */
    public static function getNewArrivals($limit = 8)
    {
        $db = parent::connect();

        $sql = "SELECT 
                w.id, 
                w.name, 
                w.price, 
                w.image_url, 
                w.rating,
                w.reviews_count,
                w.description,
                w.in_stock,
                c.name AS brand,
                c.name AS collection_name
            FROM watches w
            LEFT JOIN collections c ON w.collection_id = c.id
            ORDER BY w.id DESC 
            LIMIT :limit";

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Fetch all watches from the database with brand details
     */
    public static function getAll(): array
    {
        $db = parent::connect();

        $sql = "SELECT 
                    w.id, 
                    w.name, 
                    w.price, 
                    w.image_url, 
                    w.rating,
                    w.reviews_count,
                    w.description,
                    w.in_stock,
                    c.name AS brand,
                    c.name AS collection_name
                FROM watches w
                LEFT JOIN collections c ON w.collection_id = c.id
                ORDER BY w.id DESC";

        $stmt = $db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
