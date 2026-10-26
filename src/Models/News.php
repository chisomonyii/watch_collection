<?php

namespace App\Models;

use PDO;

class News
{
    public static function getFeaturedStory()
    {
        $db = Db::connect();
        $stmt = $db->query("SELECT * FROM news WHERE is_featured = 1 ORDER BY created_at DESC LIMIT 1");
        $featured = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$featured) {
            $stmt = $db->query("SELECT * FROM news ORDER BY created_at DESC LIMIT 1");
            $featured = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        return $featured ?: null;
    }

    public static function getSideStories($limit = 3)
    {
        $db = Db::connect();
        $query = "SELECT * FROM news WHERE is_featured = 0 ORDER BY created_at DESC LIMIT :limit";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    }

    public static function getBySlug($slug)
{
    try {
        $db = Db::connect();
        $stmt = $db->prepare("SELECT * FROM news WHERE slug = ? LIMIT 1");
        $stmt->execute([$slug]);
        $article = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $article ?: null;
    } catch (\Throwable $e) {
        return null;
    }
}
}