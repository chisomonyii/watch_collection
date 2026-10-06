<?php

namespace App\Models;

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
                    w.rating,
                    w.reviews_count,
                    w.description,
                    w.in_stock,
                    c.name AS collection_name,
                    c.slug AS collection_slug
                FROM watches w
                INNER JOIN collections c ON w.collection_id = c.id
                WHERE w.id IN ($placeholders)";

        $stmt = $db->prepare($sql);
        $stmt->execute($cleanIds);

        return $stmt->fetchAll();
    }

    /**
     * Fetch all watches belonging to a specific collection slug (e.g., 'g-shock', 'rolex')
     */
    public static function getByCollectionSlug(string $slug)
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
                    c.name AS collection_name
                FROM watches w
                INNER JOIN collections c ON w.collection_id = c.id
                WHERE c.slug = :slug";

        $stmt = $db->prepare($sql);
        $stmt->execute(['slug' => $slug]);

        return $stmt->fetchAll();
    }
}