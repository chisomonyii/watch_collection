<?php

namespace App\Controller;

use App\Helpers\Response;
use App\Models\Watch;
use App\Helpers\View;
use App\Models\News;

class Home
{
    /**
     * Renders the home / landing page with products and approved reviews from the database
     */
    public static function showLandingpage()
    {
        $products = Watch::getNewArrivals(8);

        // Fetch Best Sellers and Trending watches
        $bestSellers = Watch::getBestSellers(5);
        $trendingWatches = Watch::getTrending(5);

        try {
            $db = \App\Models\Db::connect();
            
            // Fetch only approved reviews for the landing page review section
            $stmt = $db->query("SELECT * FROM reviews WHERE status = 'approved' ORDER BY id DESC");
            $approvedReviews = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            // Fetch Featured Reviews for the homepage (Max 2)
            $featuredStmt = $db->query("SELECT * FROM reviews WHERE is_featured = 1 AND status = 'approved' ORDER BY created_at DESC LIMIT 2");
            $featuredReviews = $featuredStmt->fetchAll(\PDO::FETCH_ASSOC);

        } catch (\Exception $e) {
            $approvedReviews = [];
            $featuredReviews = [];
        }

        View::displayView('guests/home.php', [
            'newArrivals' => $products,
            'watches' => $products,
            'bestSellers' => $bestSellers,
            'trendingWatches' => $trendingWatches,
            'approvedReviews' => $approvedReviews,
            'featuredReviews' => $featuredReviews
        ]);
    }

    public static function index()
    {
        self::showLandingpage();
    }

    public function displaywishlist()
    {
        View::displayView('wishlist.php');
    }

    public static function getWishlistItems()
    {
        if (ob_get_length()) {
            ob_clean();
        }

        header('Content-Type: application/json');

        $rawData = file_get_contents("php://input");
        $data = json_decode($rawData, true) ?? [];
        $ids = $data['ids'] ?? [];

        if (empty($ids) || !is_array($ids)) {
            Response::json([
                'success' => true,
                'data' => []
            ]);
            exit;
        }

        try {
            $watches = Watch::getByIds($ids);

            Response::json([
                'success' => true,
                'data' => $watches
            ]);
        } catch (\PDOException $error) {
            Response::json([
                'success' => false,
                'message' => 'Database error: ' . $error->getMessage()
            ], 500);
        }
        exit;
    }

    public static function storeReview()
    {
        $db = \App\Models\Db::connect();

        $orderId = $_POST['order_id'] ?? null;
        $name = $_POST['customer_name'] ?? '';
        $title = $_POST['title'] ?? '';
        $rating = $_POST['rating'] ?? 5;
        $comment = $_POST['comment'] ?? '';
        $imageName = null;

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['image']['tmp_name'];
            $originalName = $_FILES['image']['name'];
            $extension = pathinfo($originalName, PATHINFO_EXTENSION);
            $imageName = 'review_' . time() . '.' . $extension;

            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/Watch_Collection/assets/image/reviews/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            move_uploaded_file($fileTmpPath, $uploadDir . $imageName);
        }

        $stmt = $db->prepare("
            INSERT INTO reviews (order_id, customer_name, title, comment, rating, image_url, status, is_featured) 
            VALUES (?, ?, ?, ?, ?, ?, 'pending', 0)
        ");
        $stmt->execute([$orderId, $name, $title, $comment, $rating, $imageName]);

        header("Location: /Watch_Collection/review/submit?success=1");
        exit;
    }

    public static function displayNewsPage()
    {
        $featured = News::getFeaturedStory();
        $sideStories = News::getSideStories(3);

        View::displayView('guests/news.php', [
            'featured' => $featured,
            'sideStories' => $sideStories
        ]);
    }

    public static function displayArticle($slug)
    {
        $article = \App\Models\News::getBySlug($slug);

        if (!$article) {
            View::displayView('404.php');
            return;
        }

        View::displayView('guests/news-detail.php', [
            'article' => $article
        ]);
    }

    public static function displayAboutPage()
    {
        View::displayView('guests/about.php');
    }

    public static function subscribeNewsletter()
    {
        if (ob_get_length()) {
            ob_clean();
        }
        header('Content-Type: application/json');

        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $interest = $_POST['interest'] ?? 'All Watches';

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'message' => 'Please enter a valid email address.']);
            exit;
        }

        try {
            $db = \App\Models\Db::connect();
            $stmt = $db->prepare("INSERT INTO subscribers (name, email, interest) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE name = VALUES(name), interest = VALUES(interest)");
            $stmt->execute([$name, $email, $interest]);

            echo json_encode(['success' => true]);
        } catch (\PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Database error.']);
        }
        exit;
    }
}