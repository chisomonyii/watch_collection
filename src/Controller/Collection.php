<?php

namespace App\Controller;

use App\Models\Watch as WatchModel;
use App\Helpers\View;

class Collection
{
    /**
     * Display watches using clean path parameters e.g. /user/watch/collection/hublot
     */
    public static function showByPath($name)
    {
        // Fetch watches belonging to this collection name/slug
        $watches = WatchModel::getByCollectionSlug($name);

        // Render the collection view
        View::displayView('user/collection.php', [
            'collectionName' => ucfirst($name),
            'watches'        => $watches
        ]);
    }
}