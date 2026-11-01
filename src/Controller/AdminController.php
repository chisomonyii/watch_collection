<?php

namespace App\Controller;

use App\Helpers\View;
use App\Helpers\Session;
use App\Middleware\Authentication;
use App\Models\Db;

class AdminController
{
    private static function checkAdminAuth()
    {
        Session::start();

        if (!Authentication::isLoggedIn()) {
            header("Location: /Watch_Collection/auth/login");
            exit;
        }

        $user = $_SESSION['user'] ?? null;

        if (($user['role'] ?? '') !== 'admin') {
            header("Location: /Watch_Collection/staff/dashboard");
            exit;
        }
    }

    public static function watch()
    {
        self::checkAdminAuth();
        $db = Db::connect();
        $stmt = $db->query("SELECT * FROM watches ORDER BY created_at DESC");
        $watches = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        View::displayView("admin/watch.php", ['watches' => $watches]);
    }

    public static function staff()
    {
        self::showStaffManagement();
    }
    public static function news()
    {
        self::checkAdminAuth();

        try {
            $pdo = new \PDO("mysql:host=localhost;dbname=watch_collection", "root", "");
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->query("SELECT * FROM news ORDER BY created_at DESC");
            $articles = $stmt->fetchAll(\PDO::FETCH_ASSOC);

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
            $_SESSION['news_stats'] = [
                'total' => 0,
                'published' => 0,
                'draft' => 0,
                'featured' => 0
            ];

            View::displayView("admin/news.php");
        }
    }

    public static function staffRequests()
    {
        self::checkAdminAuth();

        try {
            $pdo = new \PDO("mysql:host=localhost;dbname=watch_collection", "root", "");
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare("SELECT * FROM users WHERE role = 'staff' AND status = 'pending' ORDER BY created_at DESC");
            $stmt->execute();

            $pendingStaff = $stmt->fetchAll(\PDO::FETCH_ASSOC);

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

            // Change 'approved' to 'active' to match your ENUM database definition
            $stmt = $pdo->prepare("UPDATE users SET status = 'active', updated_at = NOW() WHERE id = ? AND role = 'staff'");
            $stmt->execute([$id]);

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

                $stmt->execute([
                    $title,
                    $slug,
                    $category,
                    $authorName,
                    $authorAvatar,
                    $summary,
                    $content,
                    $imageUrl,
                    $status,
                    $isFeatured
                ]);

                header("Location: /Watch_Collection/admin/news?success=created");
                exit;
            } catch (\Exception $e) {
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

                $stmt->execute([
                    $title,
                    $slug,
                    $category,
                    $authorName,
                    $summary,
                    $content,
                    $imageUrl,
                    $status,
                    $isFeatured,
                    $id
                ]);

                header("Location: /Watch_Collection/admin/news?success=updated");
                exit;
            } catch (\Exception $e) {
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

    public static function contact()
    {
        self::checkAdminAuth();

        try {
            $pdo = new \PDO("mysql:host=localhost;dbname=watch_collection", "root", "");
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->query("SELECT * FROM contact WHERE status = 'unread' ORDER BY id DESC");
            $contacts = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            $_SESSION['admin_contacts'] = $contacts;

            View::displayView("admin/contact.php");
        } catch (\Exception $e) {
            $_SESSION['admin_contacts'] = [];
            View::displayView("admin/contact.php");
        }
    }

    public static function markContactRead($id)
    {
        self::checkAdminAuth();

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

        $user = $_SESSION['user'] ?? null;

        if (($user['role'] ?? '') !== 'admin') {
            header("Location: /Watch_Collection/admin/contact?error=unauthorized");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $recipientEmail = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
            $messageBody = trim($_POST['message'] ?? '');

            if (!$recipientEmail || empty($messageBody)) {
                header("Location: /Watch_Collection/admin/contact?error=invalid_input");
                exit;
            }

            $apiKey = $_ENV['SENDINBLUE_API_KEY'] ?? getenv('SENDINBLUE_API_KEY');

            $data = [
                "sender" => [
                    "name" => "ZEITH Luxury Timepieces",
                    "email" => "chibuikemnweze2020@gmail.com"
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
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_HTTPHEADER => [
                    'api-key: ' . $apiKey,
                    'Content-Type: application/json',
                    'Accept: application/json'
                ]
            ]);

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode >= 200 && $httpCode < 300) {
                header("Location: /Watch_Collection/admin/contact?success=message_sent");
                exit;
            }

            header("Location: /Watch_Collection/admin/contact?error=send_failed");
            exit;
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
        }

        header("Location: /Watch_Collection/admin/contact");
        exit;
    }

    public static function toggleSuspension($userId)
    {
        self::checkAdminAuth();

        $db = \App\Models\Db::connect();

        $stmt = $db->prepare("SELECT status FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($user) {
            $newStatus = ($user['status'] === 'suspended') ? 'active' : 'suspended';

            $updateStmt = $db->prepare("UPDATE users SET status = ? WHERE id = ?");
            $updateStmt->execute([$newStatus, $userId]);
        }

        header("Location: /Watch_Collection/admin/staff?success=status_updated");
        exit;
    }

    public static function verifyActiveSession()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /Watch_Collection/auth/login");
            exit;
        }

        $userId = $_SESSION['user_id'];

        try {
            $db = \App\Models\Db::connect();
            $stmt = $db->prepare("SELECT status, role FROM users WHERE id = ?");
            $stmt->execute([$userId]);
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);

            if (!$user || $user['status'] === 'suspended') {
                session_unset();
                session_destroy();

                header("Location: /Watch_Collection/auth/login?error=suspended");
                exit;
            }
        } catch (\Exception $e) {
        }
    }

    public static function showStaffManagement()
    {
        self::checkAdminAuth();

        $db = \App\Models\Db::connect();

        $totalStaff = $db->query("SELECT COUNT(*) FROM users")->fetchColumn();
        $activeStaff = $db->query("SELECT COUNT(*) FROM users WHERE status = 'active'")->fetchColumn();
        $suspendedStaff = $db->query("SELECT COUNT(*) FROM users WHERE status = 'suspended'")->fetchColumn();
        $adminCount = $db->query("SELECT COUNT(*) FROM users WHERE role = 'admin'")->fetchColumn();

        // Updated query without the phone column
        $stmt = $db->query("SELECT id, CONCAT(firstname, ' ', lastname) AS name, email, role, status, DATE_FORMAT(created_at, '%b %d, %Y') AS joined_at FROM users ORDER BY id DESC");
        $staffMembers = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        View::displayView('admin/staff.php', [
            'totalStaff' => $totalStaff,
            'activeStaff' => $activeStaff,
            'suspendedStaff' => $suspendedStaff,
            'adminCount' => $adminCount,
            'staffMembers' => $staffMembers
        ]);
    }

    public static function updateUserRole($id)
    {
        self::checkAdminAuth();

        $newRole = $_POST['role'] ?? 'staff';

        $db = \App\Models\Db::connect();
        $stmt = $db->prepare("UPDATE users SET role = ? WHERE id = ?");
        $stmt->execute([$newRole, $id]);

        header("Location: /Watch_Collection/admin/staff?success=role_updated");
        exit;
    }

    public static function updateStaffStatus($id)
    {
        self::checkAdminAuth();

        // Get status sent from the modal form ('suspended' or 'active')
        $newStatus = $_POST['status'] ?? 'active';

        $db = \App\Models\Db::connect();
        $stmt = $db->prepare("UPDATE users SET status = ? WHERE id = ?");
        $stmt->execute([$newStatus, $id]);

        header("Location: /Watch_Collection/admin/staff?success=status_updated");
        exit;
    }

    public static function indexWatches()
    {
        self::watch();
    }


    public static function createWatch()
    {
        self::checkAdminAuth();
        // Fetch collections for the dropdown
        $db = Db::connect();
        $collections = $db->query("SELECT * FROM collections")->fetchAll(\PDO::FETCH_ASSOC);

        View::displayView("admin/addWatch.php", ['collections' => $collections]);
    }

    public static function storeWatch()
    {
        self::checkAdminAuth();

        $db = Db::connect();
        $uploadDir = __DIR__ . '/../../public/uploads/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $imagePaths = [
            'image_url_1' => null,
            'image_url_2' => null,
            'image_url_3' => null,
            'image_url_4' => null
        ];

        // Process multiple files uploaded via watch_images[] from addWatch.php
        if (isset($_FILES['watch_images']) && is_array($_FILES['watch_images']['name'])) {
            $fileCount = count($_FILES['watch_images']['name']);
            for ($i = 0; $i < min($fileCount, 4); $i++) {
                if ($_FILES['watch_images']['error'][$i] === UPLOAD_ERR_OK) {
                    $fileTmp = $_FILES['watch_images']['tmp_name'][$i];
                    $fileName = time() . '_' . basename($_FILES['watch_images']['name'][$i]);
                    move_uploaded_file($fileTmp, $uploadDir . $fileName);
                    $imagePaths['image_url_' . ($i + 1)] = $fileName;
                }
            }
        }

        // Fallback check for individual fields if used elsewhere
        $imageFields = ['image_url_1', 'image_url_2', 'image_url_3', 'image_url_4'];
        foreach ($imageFields as $field) {
            if (empty($imagePaths[$field]) && isset($_FILES[$field]) && $_FILES[$field]['error'] === UPLOAD_ERR_OK) {
                $fileTmp = $_FILES[$field]['tmp_name'];
                $fileName = time() . '_' . basename($_FILES[$field]['name']);
                move_uploaded_file($fileTmp, $uploadDir . $fileName);
                $imagePaths[$field] = $fileName;
            }
        }

        // Handle Manual PDF Upload
        $manualFileName = null;
        if (isset($_FILES['manual_file']) && $_FILES['manual_file']['error'] === UPLOAD_ERR_OK) {
            $manualTmp = $_FILES['manual_file']['tmp_name'];
            $manualFileName = time() . '_' . basename($_FILES['manual_file']['name']);
            move_uploaded_file($manualTmp, $uploadDir . $manualFileName);
        }

        $sql = "INSERT INTO watches (collection_id, name, price, rating, reviews_count, likes_count, description, strap, manual_file, in_stock, is_featured, stock, image_url_1, image_url_2, image_url_3, image_url_4, created_at) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

        $stmt = $db->prepare($sql);
        $stmt->execute([
            $_POST['collection_id'] ?? 1,
            $_POST['name'],
            $_POST['price'],
            $_POST['rating'] ?? 5.0,
            $_POST['reviews_count'] ?? 0,
            $_POST['likes_count'] ?? 0,
            $_POST['description'],
            $_POST['strap'],
            $manualFileName,
            $_POST['in_stock'] ?? 1,
            $_POST['is_featured'] ?? 0,
            $_POST['stock'] ?? 1,
            $imagePaths['image_url_1'],
            $imagePaths['image_url_2'],
            $imagePaths['image_url_3'],
            $imagePaths['image_url_4']
        ]);

        header("Location: /Watch_Collection/admin/watch?success=created");
        exit;
    }

    public static function editWatch($id)
    {
        self::checkAdminAuth();
        $db = Db::connect();

        $stmt = $db->prepare("SELECT * FROM watches WHERE id = ?");
        $stmt->execute([$id]);
        $watch = $stmt->fetch(\PDO::FETCH_ASSOC);

        $collections = $db->query("SELECT * FROM collections")->fetchAll(\PDO::FETCH_ASSOC);

        View::displayView("admin/editWatch.php", ['watch' => $watch, 'collections' => $collections]);
    }

    public static function updateWatch($id)
    {
        self::checkAdminAuth();
        $db = Db::connect();

        // Fetch existing record to retain old files if new ones aren't uploaded
        $stmt = $db->prepare("SELECT * FROM watches WHERE id = ?");
        $stmt->execute([$id]);
        $existing = $stmt->fetch(\PDO::FETCH_ASSOC);

        $uploadDir = __DIR__ . '/../../public/uploads/';
        $imageFields = ['image_url_1', 'image_url_2', 'image_url_3', 'image_url_4'];
        $imagePaths = [];

        foreach ($imageFields as $index => $field) {
            if (isset($_FILES[$field]) && $_FILES[$field]['error'] === UPLOAD_ERR_OK) {
                $fileTmp = $_FILES[$field]['tmp_name'];
                $fileName = time() . '_' . basename($_FILES[$field]['name']);
                move_uploaded_file($fileTmp, $uploadDir . $fileName);
                $imagePaths[$field] = $fileName;
            } else {
                $imagePaths[$field] = $existing[$field];
            }
        }

        $manualFileName = $existing['manual_file'];
        if (isset($_FILES['manual_file']) && $_FILES['manual_file']['error'] === UPLOAD_ERR_OK) {
            $manualTmp = $_FILES['manual_file']['tmp_name'];
            $manualFileName = time() . '_' . basename($_FILES['manual_file']['name']);
            move_uploaded_file($manualTmp, $uploadDir . $manualFileName);
        }

        $sql = "UPDATE watches SET collection_id = ?, name = ?, price = ?, rating = ?, description = ?, strap = ?, manual_file = ?, in_stock = ?, stock = ?, image_url_1 = ?, image_url_2 = ?, image_url_3 = ?, image_url_4 = ? WHERE id = ?";

        $stmt = $db->prepare($sql);
        $stmt->execute([
            $_POST['collection_id'],
            $_POST['name'],
            $_POST['price'],
            $_POST['rating'],
            $_POST['description'],
            $_POST['strap'],
            $manualFileName,
            $_POST['in_stock'],
            $_POST['stock'],
            $imagePaths['image_url_1'],
            $imagePaths['image_url_2'],
            $imagePaths['image_url_3'],
            $imagePaths['image_url_4'],
            $id
        ]);

        header("Location: /Watch_Collection/admin/watch?success=updated");
        exit;
    }

    public static function updateWatchStatus($id)
    {
        self::checkAdminAuth();
        $db = Db::connect();

        $newStockStatus = $_POST['stock'] ?? 1; // e.g., 1 for Available, 0 for Sold

        $stmt = $db->prepare("UPDATE watches SET stock = ? WHERE id = ?");
        $stmt->execute([$newStockStatus, $id]);

        header("Location: /Watch_Collection/admin/watch?success=status_updated");
        exit;
    }

    public static function deleteWatch($id)
    {
        self::checkAdminAuth();
        $db = Db::connect();

        $stmt = $db->prepare("DELETE FROM watches WHERE id = ?");
        $stmt->execute([$id]);

        header("Location: /Watch_Collection/admin/watch?success=deleted");
        exit;
    }

   public static function payment()
    {
        self::payments();
    }

    public static function payments()
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        self::checkAdminAuth();

        try {
            $pdo = new \PDO("mysql:host=localhost;dbname=watch_collection", "root", "");
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->query("SELECT * FROM orders ORDER BY created_at DESC");
            $orders = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            // Pass data explicitly to the view renderer
            View::displayView("admin/payment.php", ['orders' => $orders]);
        } catch (\Exception $e) {
            echo "<div style='color: red; padding: 20px; font-family: monospace;'>Database Error: " . $e->getMessage() . "</div>";
            exit;
        }
    }

    public static function updatePaymentStatus($id)
    {
        self::checkAdminAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $paymentStatus = trim($_POST['payment_status'] ?? '');

            if ($id && $paymentStatus) {
                try {
                    $pdo = new \PDO("mysql:host=localhost;dbname=watch_collection", "root", "");
                    $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

                    $stmt = $pdo->prepare("UPDATE orders SET payment_status = ? WHERE id = ?");
                    $stmt->execute([$paymentStatus, $id]);
                } catch (\Exception $e) {
                    // Handle query error
                }
            }
        }

        header("Location: /Watch_Collection/admin/payments?success=updated");
        exit;
    }

    public static function orders()
    {
        self::checkAdminAuth();

        try {
            $db = \App\Models\Db::connect();
            $stmt = $db->query("SELECT * FROM orders ORDER BY created_at DESC");
            $orders = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            View::displayView("admin/orders.php", ['orders' => $orders]);
        } catch (\Exception $e) {
            View::displayView("admin/orders.php", ['orders' => []]);
        }
    }

    public static function dashboard()
    {
        self::checkAdminAuth();

        try {
            $db = \App\Models\Db::connect();

            $totalRevenue    = $db->query("SELECT SUM(total_amount) FROM orders WHERE payment_status = 'Paid'")->fetchColumn() ?: 0;
            $totalOrders     = $db->query("SELECT COUNT(*) FROM orders")->fetchColumn() ?: 0;
            $activeCustomers = $db->query("SELECT COUNT(DISTINCT email) FROM orders")->fetchColumn() ?: 0;
            $watchesInStock  = $db->query("SELECT SUM(stock) FROM watches")->fetchColumn() ?: 0;

            $recentOrders    = $db->query("SELECT * FROM orders ORDER BY created_at DESC LIMIT 5")->fetchAll(\PDO::FETCH_ASSOC);
            $shippingMethods = $db->query("SELECT * FROM shipping_methods ORDER BY id ASC")->fetchAll(\PDO::FETCH_ASSOC);

            View::displayView("admin/overview.php", [
                'totalRevenue'    => $totalRevenue,
                'totalOrders'     => $totalOrders,
                'activeCustomers' => $activeCustomers,
                'watchesInStock'  => $watchesInStock,
                'recentOrders'    => $recentOrders,
                'shippingMethods' => $shippingMethods
            ]);
        } catch (\Exception $e) {
            View::displayView("admin/overview.php", [
                'totalRevenue'    => 0,
                'totalOrders'     => 0,
                'activeCustomers' => 0,
                'watchesInStock'  => 0,
                'recentOrders'    => [],
                'shippingMethods' => []
            ]);
        }
    }

    public static function storeShippingMethod()
    {
        self::checkAdminAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $methodName  = trim($_POST['method_name'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $price       = trim($_POST['price'] ?? 0);

            if ($methodName) {
                $db = \App\Models\Db::connect();
                $stmt = $db->prepare("INSERT INTO shipping_methods (method_name, description, price, is_active) VALUES (?, ?, ?, 1)");
                $stmt->execute([$methodName, $description, $price]);
            }
        }
        header("Location: /Watch_Collection/admin/dashboard?success=shipping_added");
        exit;
    }

    public static function updateShippingMethod($id)
    {
        self::checkAdminAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $methodName  = trim($_POST['method_name'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $price       = trim($_POST['price'] ?? 0);

            if ($id && $methodName) {
                $db = \App\Models\Db::connect();
                $stmt = $db->prepare("UPDATE shipping_methods SET method_name = ?, description = ?, price = ? WHERE id = ?");
                $stmt->execute([$methodName, $description, $price, $id]);
            }
        }
        header("Location: /Watch_Collection/admin/dashboard?success=shipping_updated");
        exit;
    }

    public static function deleteShippingMethod($id)
    {
        self::checkAdminAuth();
        if ($id) {
            $db = \App\Models\Db::connect();
            $stmt = $db->prepare("DELETE FROM shipping_methods WHERE id = ?");
            $stmt->execute([$id]);
        }
        header("Location: /Watch_Collection/admin/dashboard?success=shipping_deleted");
        exit;
    }

    
}
