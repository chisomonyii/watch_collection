<?php

namespace App\Models;

use PDO;

class Watch extends Model
{
    /**
     * Fetch a single watch by ID along with collection attributes and details
     */
    public static function getWatchById($id)
    {
        $db = parent::connect();

        $sql = "SELECT 
                    w.*, 
                    c.name AS brand,
                    c.name AS collection_name,
                    c.slug AS collection_slug,
                    c.attributes AS attributes
                FROM watches w
                LEFT JOIN collections c ON w.collection_id = c.id
                WHERE w.id = :id 
                LIMIT 1";

        $stmt = $db->prepare($sql);
        $stmt->execute(['id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

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
                    w.image_url_1,
                    w.image_url_2,
                    w.image_url_3,
                    w.image_url_4,
                    w.rating,
                    w.reviews_count,
                    w.description,
                    w.strap,
                    w.manual_file,
                    w.in_stock,
                    w.stock,
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
                w.image_url_1,
                w.image_url_2,
                w.image_url_3,
                w.image_url_4,
                w.rating,
                w.reviews_count,
                w.description,
                w.strap,
                w.manual_file,
                w.in_stock,
                w.stock,
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
                w.image_url_1,
                w.image_url_2,
                w.image_url_3,
                w.image_url_4,
                w.rating,
                w.reviews_count,
                w.description,
                w.strap,
                w.manual_file,
                w.in_stock,
                w.stock,
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
                    w.image_url_1,
                    w.image_url_2,
                    w.image_url_3,
                    w.image_url_4,
                    w.rating,
                    w.reviews_count,
                    w.description,
                    w.strap,
                    w.manual_file,
                    w.in_stock,
                    w.stock,
                    c.name AS brand,
                    c.name AS collection_name
                FROM watches w
                LEFT JOIN collections c ON w.collection_id = c.id
                ORDER BY w.id DESC";

        $stmt = $db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

   public static function getBestSellers($limit = 5)
{
    $db = self::connect(); // Uses your Db::connect() method
    
    $query = "
        SELECT w.*, SUM(oi.quantity) as total_sold 
        FROM watches w
        LEFT JOIN order_items oi ON w.id = oi.watch_id
        GROUP BY w.id
        ORDER BY total_sold DESC, w.created_at DESC
        LIMIT :limit
    ";
    
    $stmt = $db->prepare($query);
    $stmt->bindValue(':limit', (int) $limit, \PDO::PARAM_INT);
    $stmt->execute();
    $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

    // Fallback if no orders exist yet
    if (empty($results)) {
        $stmt = $db->query("SELECT * FROM watches ORDER BY created_at DESC LIMIT " . (int)$limit);
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    return $results;
}

public static function getTrending($limit = 5)
{
    $db = self::connect(); // Uses your Db::connect() method
    
    $query = "
        SELECT * FROM watches 
        ORDER BY likes_count DESC, rating DESC 
        LIMIT :limit
    ";
    
    $stmt = $db->prepare($query);
    $stmt->bindValue(':limit', (int) $limit, \PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}
}
