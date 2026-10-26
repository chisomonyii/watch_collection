<?php

namespace App\Controller;

use App\Helpers\View;
use App\Helpers\Session;
use App\Middleware\Authentication;

class AdminController
{
    private static function checkAdminAuth()
    {
        Session::start();
        if (!Authentication::isLoggedIn()) {
            header("Location: /Watch_Collection/auth/login");
            exit;
        }

        // Ensure only admins can access this
        $user = $_SESSION['user'] ?? null;
        if (($user['role'] ?? '') !== 'admin') {
            header("Location: /Watch_Collection/staff/dashboard");
            exit;
        }
    }

    public static function dashboard()
    {
        self::checkAdminAuth();
        View::displayView("admin/overview.php");
    }

    public static function watch()
    {
        self::checkAdminAuth();
        View::displayView("admin/watch.php");
    }



    public static function news()
    {
        self::checkAdminAuth();

        try {
            $pdo = new \PDO("mysql:host=localhost;dbname=watch_collection", "root", "");
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            // Fetch all articles fresh from the database
            $stmt = $pdo->query("SELECT * FROM news ORDER BY created_at DESC");
            $articles = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            // Calculate statistics...
            $totalArticles = count($articles);
            $publishedArticles = 0;
            $draftArticles = 0;
            $featuredArticles = 0;

            foreach ($articles as $article) {
                $status = $article['status'] ?? 'draft';
                if ($status === 'published') {
                    $publishedArticles++;
                } else {
                    $draftArticles++;
                }
                if (!empty($article['is_featured'])) {
                    $featuredArticles++;
                }
            }

            // Store fresh data in session
            $_SESSION['admin_news'] = $articles;
            $_SESSION['news_stats'] = [
                'total' => $totalArticles,
                'published' => $publishedArticles,
                'draft' => $draftArticles,
                'featured' => $featuredArticles
            ];

            View::displayView("admin/news.php");
        } catch (\Exception $e) {
            $_SESSION['admin_news'] = [];
            $_SESSION['news_stats'] = ['total' => 0, 'published' => 0, 'draft' => 0, 'featured' => 0];
            View::displayView("admin/news.php");
        }
    }

    public static function staffRequests()
    {
        self::checkAdminAuth();

        try {
            $pdo = new \PDO("mysql:host=localhost;dbname=watch_collection", "root", "");
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            // Fetch all users who are staff and still pending approval
            $stmt = $pdo->prepare("SELECT * FROM users WHERE role = 'staff' AND status = 'pending' ORDER BY created_at DESC");
            $stmt->execute();
            $pendingStaff = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            // Store in session for the view to loop through
            $_SESSION['pending_staff'] = $pendingStaff;

            View::displayView("admin/staff-request.php");
        } catch (\Exception $e) {
            $_SESSION['admin_error'] = "Could not fetch requests.";
            View::displayView("admin/staff-request.php");
        }
    }

    public static function approveStaff($id)
    {
        self::checkAdminAuth();

        try {
            $pdo = new \PDO("mysql:host=localhost;dbname=watch_collection", "root", "");
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            // Update user status to approved
            $stmt = $pdo->prepare("UPDATE users SET status = 'approved', updated_at = NOW() WHERE id = ? AND role = 'staff'");
            $stmt->execute([$id]);

            // Redirect back to the staff requests page with success
            header("Location: /Watch_Collection/admin/staff-requests");
            exit;
        } catch (\Exception $e) {
            header("Location: /Watch_Collection/admin/staff-requests?error=approval_failed");
            exit;
        }
    }
    public static function storeNews()
    {
        self::checkAdminAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');
            $slug = trim($_POST['slug'] ?? '');
            if (empty($slug)) {
                $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));
            }
            $category = trim($_POST['category'] ?? 'Watch Culture');
            $authorName = trim($_POST['author_name'] ?? 'Zeith Editorial');
            $authorAvatar = trim($_POST['author_avatar'] ?? 'zeith-editor.jpg');
            $imageUrl = trim($_POST['image_url'] ?? 'banner/banner1.jpg');
            $summary = trim($_POST['summary'] ?? '');
            $content = trim($_POST['content'] ?? '');
            $status = trim($_POST['status'] ?? 'draft');
            $isFeatured = isset($_POST['is_featured']) ? 1 : 0;

            try {
                $pdo = new \PDO("mysql:host=localhost;dbname=watch_collection", "root", "");
                $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

                $stmt = $pdo->prepare("
                    INSERT INTO news (title, slug, category, author_name, author_avatar, summary, content, image_url, status, is_featured, created_at) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())
                ");
                $stmt->execute([$title, $slug, $category, $authorName, $authorAvatar, $summary, $content, $imageUrl, $status, $isFeatured]);

                header("Location: /Watch_Collection/admin/news?success=created");
                exit;
            } catch (\Exception $e) {
                // Keep this commented out unless debugging:
                // die("SQL Error: " . $e->getMessage());

                header("Location: /Watch_Collection/admin/news?error=create_failed");
                exit;
            }
        }
    }

    public static function updateNews($id)
    {
        self::checkAdminAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');
            $slug = trim($_POST['slug'] ?? '');
            if (empty($slug)) {
                $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));
            }
            $category = trim($_POST['category'] ?? '');
            $authorName = trim($_POST['author_name'] ?? 'Zeith Editorial');
            $imageUrl = trim($_POST['image_url'] ?? 'banner/banner1.jpg');
            $summary = trim($_POST['summary'] ?? '');
            $content = trim($_POST['content'] ?? '');
            $status = trim($_POST['status'] ?? 'draft');
            $isFeatured = isset($_POST['is_featured']) ? 1 : 0;

            try {
                $pdo = new \PDO("mysql:host=localhost;dbname=watch_collection", "root", "");
                $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

                $stmt = $pdo->prepare("
                    UPDATE news 
                    SET title = ?, slug = ?, category = ?, author_name = ?, summary = ?, content = ?, image_url = ?, status = ?, is_featured = ?
                    WHERE id = ?
                ");
                $stmt->execute([$title, $slug, $category, $authorName, $summary, $content, $imageUrl, $status, $isFeatured, $id]);

                header("Location: /Watch_Collection/admin/news?success=updated");
                exit;
            } catch (\Exception $e) {
                // TEMPORARY DEBUG: Uncomment line below if it fails again to see the exact SQL error
                // die("Update Error: " . $e->getMessage());
                header("Location: /Watch_Collection/admin/news?error=update_failed");
                exit;
            }
        }
    }

    public static function deleteNews($id)
    {
        self::checkAdminAuth();

        try {
            $pdo = new \PDO("mysql:host=localhost;dbname=watch_collection", "root", "");
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare("DELETE FROM news WHERE id = ?");
            $stmt->execute([$id]);

            header("Location: /Watch_Collection/admin/news?success=deleted");
            exit;
        } catch (\Exception $e) {
            header("Location: /Watch_Collection/admin/news?error=delete_failed");
            exit;
        }
    }

    /**
     * Display contact messages for admins and staff
     */
    /**
     * Display contact messages for admins and staff
     */
    public static function contact()
    {
        self::checkAdminAuth();

        try {
            $pdo = new \PDO("mysql:host=localhost;dbname=watch_collection", "root", "");
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            // Fetch only unread inquiries so read messages disappear from the list
            $stmt = $pdo->query("SELECT * FROM contact WHERE status = 'unread' ORDER BY id DESC");
            $contacts = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            $_SESSION['admin_contacts'] = $contacts;
            View::displayView("admin/contact.php");
        } catch (\Exception $e) {
            $_SESSION['admin_contacts'] = [];
            View::displayView("admin/contact.php");
        }
    }

    /**
     * Mark a contact message as read (Admin only)
     */
    public static function markContactRead($id)
    {
        self::checkAdminAuth();

        // Enforce that only 'admin' role can mark as read/message
        $user = $_SESSION['user'] ?? null;
        if (($user['role'] ?? '') !== 'admin') {
            header("Location: /Watch_Collection/admin/contact?error=unauthorized");
            exit;
        }

        try {
            $pdo = new \PDO("mysql:host=localhost;dbname=watch_collection", "root", "");
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare("UPDATE contact SET status = 'read' WHERE id = ?");
            $stmt->execute([$id]);

            header("Location: /Watch_Collection/admin/contact?success=read");
            exit;
        } catch (\Exception $e) {
            header("Location: /Watch_Collection/admin/contact?error=failed");
            exit;
        }
    }

    public static function sendContactMessage()
    {
        self::checkAdminAuth();

        // Enforce Admin-only permission
        $user = $_SESSION['user'] ?? null;
        if (($user['role'] ?? '') !== 'admin') {
            header("Location: /Watch_Collection/admin/contact?error=unauthorized");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $recipientEmail = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
            $messageBody    = trim($_POST['message'] ?? '');

            if (!$recipientEmail || empty($messageBody)) {
                header("Location: /Watch_Collection/admin/contact?error=invalid_input");
                exit;
            }

            // Replace the hardcoded string with this:
            $apiKey = $_ENV['SENDINBLUE_API_KEY'] ?? getenv('SENDINBLUE_API_KEY');

            $data = [
                "sender" => [
                    "name"  => "ZEITH Luxury Timepieces",
                    "email" => "chibuikemnweze2020@gmail.com" // Replace with your Brevo sender email
                ],
                "to" => [
                    ["email" => $recipientEmail]
                ],
                "subject" => "Response to Your Inquiry - ZEITH",
                "htmlContent" => "<html><body><p>" . nl2br(htmlspecialchars($messageBody)) . "</p></body></html>"
            ];

            $ch = curl_init('https://api.brevo.com/v3/smtp/email');
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST           => true,
                CURLOPT_POSTFIELDS     => json_encode($data),
                CURLOPT_SSL_VERIFYPEER => false, // Bypass local SSL check on XAMPP
                CURLOPT_HTTPHEADER     => [
                    'api-key: ' . $apiKey,
                    'Content-Type: application/json',
                    'Accept: application/json'
                ],
            ]);

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode >= 200 && $httpCode < 300) {
                header("Location: /Watch_Collection/admin/contact?success=message_sent");
                exit;
            } else {
                header("Location: /Watch_Collection/admin/contact?error=send_failed");
                exit;
            }
        }
    }
    public static function markAsRead($id)
    {
        self::checkAdminAuth();

        try {
            $pdo = new \PDO("mysql:host=localhost;dbname=watch_collection", "root", "");
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare("UPDATE contact SET status = 'read' WHERE id = ?");
            $stmt->execute([$id]);
        } catch (\Exception $e) {
            // Log or handle error if needed
        }

        // Redirect back to refresh the contact list
        header("Location: /Watch_Collection/admin/contact");
        exit;
    }
}
