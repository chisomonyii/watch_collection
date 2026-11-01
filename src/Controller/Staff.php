<?php

namespace App\Controller;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use App\Helpers\View;
use App\Helpers\Session;
use App\Middleware\Authentication;

class Staff
{
    private static function checkAuth()
    {
        Session::start();

        if (!Authentication::isLoggedIn()) {
            header("Location: /Watch_Collection/auth/login");
            exit;
        }
    }

    private static function getCurrentUserId(): int
    {
        $sessionUser = $_SESSION['user'] ?? null;

        if (!$sessionUser || !isset($sessionUser['id'])) {
            header("Location: /Watch_Collection/auth/login");
            exit;
        }

        return (int)$sessionUser['id'];
    }

    public static function dashboard()
    {
        self::checkAuth();
        $userId = self::getCurrentUserId();
        $status = self::fetchUserStatus($userId);

        if ($status === 'pending') {
            View::displayView("staff/staffApproval.php");
            return;
        }

        try {
            $db = \App\Models\Db::connect();
            $pendingCount = $db->query("SELECT COUNT(*) FROM orders WHERE REPLACE(REPLACE(LOWER(order_status), '\r', ''), '\n', '') LIKE '%pending%' OR REPLACE(REPLACE(LOWER(order_status), '\r', ''), '\n', '') LIKE '%verification%'")->fetchColumn() ?: 0;
            $processingCount = $db->query("SELECT COUNT(*) FROM orders WHERE LOWER(order_status) LIKE '%processing%'")->fetchColumn() ?: 0;
            $dispatchedCount = $db->query("SELECT COUNT(*) FROM orders WHERE LOWER(order_status) LIKE '%dispatched%'")->fetchColumn() ?: 0;
            $deliveredCount = $db->query("SELECT COUNT(*) FROM orders WHERE LOWER(order_status) LIKE '%delivered%'")->fetchColumn() ?: 0;
            $totalOrders = $db->query("SELECT COUNT(*) FROM orders")->fetchColumn() ?: 0;
            $recentOrders = $db->query("SELECT * FROM orders ORDER BY created_at DESC LIMIT 4")->fetchAll(\PDO::FETCH_ASSOC);
            $totalWatches = $db->query("SELECT COUNT(*) FROM watches")->fetchColumn() ?: 0;
            $availableWatches = $db->query("SELECT COUNT(*) FROM watches WHERE stock > 0")->fetchColumn() ?: 0;
            $soldOutWatches = $db->query("SELECT COUNT(*) FROM watches WHERE stock <= 0")->fetchColumn() ?: 0;
            $availablePercentage = $totalWatches > 0 ? round(($availableWatches / $totalWatches) * 100, 1) : 0;

            View::displayView("staff/overview.php", [
                'pendingCount' => $pendingCount,
                'processingCount' => $processingCount,
                'dispatchedCount' => $dispatchedCount,
                'deliveredCount' => $deliveredCount,
                'totalOrders' => $totalOrders,
                'recentOrders' => $recentOrders,
                'totalWatches' => $totalWatches,
                'availableWatches' => $availableWatches,
                'soldOutWatches' => $soldOutWatches,
                'availablePercentage' => $availablePercentage
            ]);
        } catch (\Exception $e) {
            View::displayView("staff/overview.php", [
                'pendingCount' => 0,
                'processingCount' => 0,
                'dispatchedCount' => 0,
                'deliveredCount' => 0,
                'totalOrders' => 0,
                'recentOrders' => [],
                'totalWatches' => 0,
                'availableWatches' => 0,
                'soldOutWatches' => 0,
                'availablePercentage' => 0
            ]);
        }
    }

    private static function fetchUserStatus(int $userId): string
    {
        try {
            $db = \App\Models\Db::connect();
            $stmt = $db->prepare("SELECT status FROM users WHERE id = ?");
            $stmt->execute([$userId]);
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);

            return $user['status'] ?? 'pending';
        } catch (\Exception $e) {
            return 'pending';
        }
    }

    private static function checkPendingStatus()
    {
        self::checkAuth();
        $userId = self::getCurrentUserId();
        $status = self::fetchUserStatus($userId);

        if ($status === 'pending') {
            header("Location: /Watch_Collection/staff/dashboard");
            exit;
        }
    }

    public static function watch()
    {
        self::checkPendingStatus();

        try {
            $db = \App\Models\Db::connect();
            $stmt = $db->query("SELECT w.*, c.name as collection_name FROM watches w LEFT JOIN collections c ON w.collection_id = c.id ORDER BY w.created_at DESC");
            $rawWatches = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            $watches = [];

            foreach ($rawWatches as $watch) {
                $resolvePath = function ($val) {
                    $clean = trim($val ?? '');

                    if (empty($clean)) {
                        return null;
                    }

                    if (strpos($clean, 'http://') === 0 || strpos($clean, 'https://') === 0 || strpos($clean, '/') === 0) {
                        return $clean;
                    }

                    $filename = ltrim(str_replace([
                        '/Watch_Collection/assets/image/',
                        'assets/image/',
                        '/Watch_Collection/public/uploads/',
                        'public/uploads/'
                    ], '', $clean), '/');

                    $uploadPath = $_SERVER['DOCUMENT_ROOT'] . '/Watch_Collection/public/uploads/' . $filename;

                    if (file_exists($uploadPath)) {
                        return '/Watch_Collection/public/uploads/' . $filename;
                    }

                    return '/Watch_Collection/assets/image/' . $filename;
                };

                $images = [];

                for ($i = 1; $i <= 4; $i++) {
                    $resolved = $resolvePath($watch['image_url_' . $i] ?? null);

                    if ($resolved) {
                        $images[] = $resolved;
                    }
                }

                if (empty($images)) {
                    $images[] = '/Watch_Collection/assets/images/placeholder.jpg';
                }

                $watch['images'] = $images;
                $watch['collection'] = $watch['collection_name'] ?? 'Luxury Collection';
                $watches[] = $watch;
            }

            View::displayView("staff/watch.php", ['watches' => $watches]);
        } catch (\Exception $e) {
            View::displayView("staff/watch.php", ['watches' => []]);
        }
    }

    public static function contact()
    {
        self::checkPendingStatus();

        try {
            $db = \App\Models\Db::connect();
            $stmt = $db->query("SELECT * FROM contact ORDER BY id DESC");
            $contacts = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            $_SESSION['staff_contacts'] = $contacts;
            View::displayView("staff/contact.php");
        } catch (\Exception $e) {
            $_SESSION['staff_contacts'] = [];
            View::displayView("staff/contact.php");
        }
    }

    public static function profile()
    {
        self::checkPendingStatus();
        $userId = $_SESSION['user']['id'] ?? null;
        $staffUser = [];

        try {
            $db = \App\Models\Db::connect();
            $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->execute([$userId]);
            $staffUser = $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            $staffUser = $_SESSION['user'] ?? [];
        }

        View::displayView("staff/profile.php", ['staffUser' => $staffUser]);
    }

    public static function updateProfile()
    {
        self::checkPendingStatus();
        $userId = $_SESSION['user']['id'] ?? null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $firstname = trim($_POST['firstname'] ?? '');
            $lastname = trim($_POST['lastname'] ?? '');
            $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
            $password = trim($_POST['password'] ?? '');

            if (!$firstname || !$lastname || !$email) {
                header("Location: /Watch_Collection/staff/profile?error=invalid_input");
                exit;
            }

            try {
                $db = \App\Models\Db::connect();

                if (!empty($password)) {
                    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                    $stmt = $db->prepare("UPDATE users SET firstname = ?, lastname = ?, email = ?, password = ?, updated_at = NOW() WHERE id = ?");
                    $stmt->execute([$firstname, $lastname, $email, $hashedPassword, $userId]);
                } else {
                    $stmt = $db->prepare("UPDATE users SET firstname = ?, lastname = ?, email = ?, updated_at = NOW() WHERE id = ?");
                    $stmt->execute([$firstname, $lastname, $email, $userId]);
                }

                $_SESSION['user']['firstname'] = $firstname;
                $_SESSION['user']['lastname'] = $lastname;
                $_SESSION['user']['email'] = $email;

                header("Location: /Watch_Collection/staff/profile?success=profile_updated");
                exit;
            } catch (\Exception $e) {
                header("Location: /Watch_Collection/staff/profile?error=update_failed");
                exit;
            }
        }
    }

    public static function reviews()
    {
        self::checkPendingStatus();

        try {
            $db = \App\Models\Db::connect();
            $stmt = $db->query("SELECT * FROM reviews ORDER BY id DESC");
            $reviews = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            $totalReviews = count($reviews);
            $pendingReviews = 0;
            $approvedReviews = 0;
            $rejectedReviews = 0;

            foreach ($reviews as $rev) {
                $status = strtolower(trim($rev['status'] ?? 'pending'));

                if ($status === 'pending') {
                    $pendingReviews++;
                } elseif ($status === 'approved') {
                    $approvedReviews++;
                } elseif ($status === 'rejected') {
                    $rejectedReviews++;
                }
            }

            View::displayView("staff/reviews.php", [
                'reviews' => $reviews,
                'totalReviews' => $totalReviews,
                'pendingReviews' => $pendingReviews,
                'approvedReviews' => $approvedReviews,
                'rejectedReviews' => $rejectedReviews
            ]);
        } catch (\Exception $e) {
            View::displayView("staff/reviews.php", [
                'reviews' => [],
                'totalReviews' => 0,
                'pendingReviews' => 0,
                'approvedReviews' => 0,
                'rejectedReviews' => 0
            ]);
        }
    }

    public static function approveReview($id)
    {
        self::checkPendingStatus();

        try {
            $db = \App\Models\Db::connect();
            $stmt = $db->prepare("UPDATE reviews SET status = 'approved', is_featured = 1 WHERE id = ?");
            $stmt->execute([$id]);
        } catch (\Exception $e) {
        }

        header("Location: /Watch_Collection/staff/reviews?success=approved");
        exit;
    }

    public static function rejectReview($id)
    {
        self::checkPendingStatus();

        try {
            $db = \App\Models\Db::connect();
            $stmt = $db->prepare("UPDATE reviews SET status = 'rejected', is_featured = 0 WHERE id = ?");
            $stmt->execute([$id]);
        } catch (\Exception $e) {
        }

        header("Location: /Watch_Collection/staff/reviews?success=rejected");
        exit;
    }

    public static function viewWatchDetails($id = null)
    {
        self::checkPendingStatus();

        if (!$id || !is_numeric($id)) {
            header("Location: /Watch_Collection/staff/watch?error=invalid_id");
            exit;
        }

        try {
            $db = \App\Models\Db::connect();
            $stmt = $db->prepare("SELECT w.*, c.name as collection_name FROM watches w LEFT JOIN collections c ON w.collection_id = c.id WHERE w.id = ?");
            $stmt->execute([$id]);
            $watch = $stmt->fetch(\PDO::FETCH_ASSOC);

            if (!$watch) {
                header("Location: /Watch_Collection/staff/watch?error=not_found");
                exit;
            }

            $resolvePath = function ($val) {
                $clean = trim($val ?? '');

                if (empty($clean)) {
                    return null;
                }

                if (strpos($clean, 'http://') === 0 || strpos($clean, 'https://') === 0 || strpos($clean, '/') === 0) {
                    return $clean;
                }

                $filename = ltrim(str_replace([
                    '/Watch_Collection/assets/image/',
                    'assets/image/',
                    '/Watch_Collection/public/uploads/',
                    'public/uploads/'
                ], '', $clean), '/');

                $uploadPath = $_SERVER['DOCUMENT_ROOT'] . '/Watch_Collection/public/uploads/' . $filename;

                if (file_exists($uploadPath)) {
                    return '/Watch_Collection/public/uploads/' . $filename;
                }

                return '/Watch_Collection/assets/image/' . $filename;
            };

            $images = [];

            for ($i = 1; $i <= 4; $i++) {
                $resolved = $resolvePath($watch['image_url_' . $i] ?? null);

                if ($resolved) {
                    $images[] = $resolved;
                }
            }

            if (empty($images)) {
                $images[] = '/Watch_Collection/assets/images/placeholder.jpg';
            }

            $manualPath = null;

            if (!empty($watch['manual_file'])) {
                $manualFile = trim($watch['manual_file']);
                $manualUploadPath = $_SERVER['DOCUMENT_ROOT'] . '/Watch_Collection/public/uploads/' . $manualFile;
                $manualPath = file_exists($manualUploadPath)
                    ? '/Watch_Collection/public/uploads/' . $manualFile
                    : '/Watch_Collection/assets/image/' . $manualFile;
            }

            $watch['images'] = $images;
            $watch['manual_path'] = $manualPath;
            $watch['collection'] = $watch['collection_name'] ?? 'Luxury Collection';

            View::displayView("staff/view-details.php", ['watch' => $watch]);
        } catch (\Exception $e) {
            header("Location: /Watch_Collection/staff/watch?error=db_error");
            exit;
        }
    }

    public static function orders($id = null)
    {
        self::checkPendingStatus();

        try {
            $db = \App\Models\Db::connect();
            $stmt = $db->query("SELECT * FROM orders ORDER BY created_at DESC");
            $orders = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            $totalOrders = count($orders);
            $pendingCount = 0;
            $processingCount = 0;
            $deliveredCount = 0;

            foreach ($orders as $ord) {
                $status = strtolower(trim($ord['order_status'] ?? ''));

                if (strpos($status, 'pending') !== false) {
                    $pendingCount++;
                } elseif (strpos($status, 'processing') !== false) {
                    $processingCount++;
                } elseif (strpos($status, 'delivered') !== false) {
                    $deliveredCount++;
                }
            }

            $selectedOrder = null;

            if (!empty($orders)) {
                if ($id) {
                    foreach ($orders as $ord) {
                        if ((int)$ord['id'] === (int)$id) {
                            $selectedOrder = $ord;
                            break;
                        }
                    }
                }

                if (!$selectedOrder) {
                    $selectedOrder = $orders[0];
                }
            }

            View::displayView("staff/orders.php", [
                'orders' => $orders,
                'selectedOrder' => $selectedOrder,
                'totalOrders' => $totalOrders,
                'pendingCount' => $pendingCount,
                'processingCount' => $processingCount,
                'deliveredCount' => $deliveredCount
            ]);
        } catch (\Exception $e) {
            View::displayView("staff/orders.php", [
                'orders' => [],
                'selectedOrder' => null,
                'totalOrders' => 0,
                'pendingCount' => 0,
                'processingCount' => 0,
                'deliveredCount' => 0
            ]);
        }
    }

    public static function updateOrderStatus($id)
    {
        self::checkPendingStatus();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newStatus = trim($_POST['order_status'] ?? '');

            if ($id && $newStatus) {
                try {
                    $db = \App\Models\Db::connect();
                    $stmt = $db->prepare("UPDATE orders SET order_status = ? WHERE id = ?");
                    $stmt->execute([$newStatus, $id]);
                } catch (\Exception $e) {
                }
            }
        }

        header("Location: /Watch_Collection/staff/orders/" . $id);
        exit;
    }

    public static function getSidebarBadgeCounts()
    {
        try {
            $db = \App\Models\Db::connect();
            $ordersCount = $db->query("SELECT COUNT(*) FROM orders WHERE REPLACE(REPLACE(LOWER(order_status), '\r', ''), '\n', '') LIKE '%pending%' OR REPLACE(REPLACE(LOWER(order_status), '\r', ''), '\n', '') LIKE '%verification%'")->fetchColumn() ?: 0;
            $contactCount = $db->query("SELECT COUNT(*) FROM contact WHERE status = 'unread'")->fetchColumn() ?: 0;
            $watchCount = $db->query("SELECT COUNT(*) FROM watches WHERE stock <= 0")->fetchColumn() ?: 0;
            $reviewsCount = 0;

            return [
                'orders' => $ordersCount,
                'watch' => $watchCount,
                'contact' => $contactCount,
                'reviews' => $reviewsCount
            ];
        } catch (\Exception $e) {
            return ['orders' => 0, 'watch' => 0, 'contact' => 0, 'reviews' => 0];
        }
    }

    public static function index()
    {
        self::checkPendingStatus();

        if (isset($_GET['export']) && $_GET['export'] === 'csv') {
            self::exportCsv();
            return;
        }

        $deleteMessage = $_GET['message'] ?? null;

        try {
            $db = \App\Models\Db::connect();
            $stmt = $db->query("SELECT * FROM subscribers ORDER BY created_at DESC");
            $subscribers = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            $totalSubscribers = count($subscribers);
            $todayStmt = $db->query("SELECT COUNT(*) FROM subscribers WHERE DATE(created_at) = CURDATE()");
            $newToday = (int)$todayStmt->fetchColumn();
            $interestStmt = $db->query("SELECT DISTINCT interest FROM subscribers WHERE interest IS NOT NULL AND interest != ''");
            $interests = $interestStmt->fetchAll(\PDO::FETCH_COLUMN);
        } catch (\PDOException $e) {
            $subscribers = [];
            $totalSubscribers = 0;
            $newToday = 0;
            $interests = [];
        }

        View::displayView('staff/subscribers.php', [
            'subscribers' => $subscribers,
            'totalSubscribers' => $totalSubscribers,
            'newToday' => $newToday,
            'interests' => $interests,
            'deleteMessage' => $deleteMessage
        ]);
    }

    public static function exportCsv()
    {
        try {
            $db = \App\Models\Db::connect();
            $stmt = $db->query("SELECT id, name, email, interest, created_at FROM subscribers ORDER BY id DESC");
            $subscribers = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename=ZEITH_Subscribers_' . date('Y-m-d') . '.csv');

            $output = fopen('php://output', 'w');
            fputcsv($output, ['Subscriber ID', 'Full Name', 'Email Address', 'Interest', 'Date Subscribed']);

            foreach ($subscribers as $row) {
                fputcsv($output, [
                    $row['id'],
                    $row['name'],
                    $row['email'],
                    $row['interest'] ?? 'General',
                    $row['created_at']
                ]);
            }

            fclose($output);
            exit;
        } catch (\Exception $e) {
            header("Location: /Watch_Collection/staff/subscribers?error=export_failed");
            exit;
        }
    }

    public static function sendNewsletter()
    {
        @ini_set('display_errors', '0');

        while (ob_get_level()) {
            ob_end_clean();
        }

        header('Content-Type: application/json; charset=utf-8');

        try {
            $rawData = file_get_contents('php://input');
            $data = json_decode($rawData, true) ?? $_POST;

            $subject = trim($data['subject'] ?? '');
            $message = trim($data['message'] ?? '');
            $scope = $data['recipient_scope'] ?? 'all';
            $selectedIds = $data['selected_ids'] ?? [];

            if (empty($subject) || empty($message)) {
                echo json_encode(['success' => false, 'message' => 'Please fill in both subject and message.']);
                exit;
            }

            $db = \App\Models\Db::connect();

            if ($scope === 'selected' && !empty($selectedIds)) {
                $cleanIds = array_map('intval', $selectedIds);
                $placeholders = implode(',', array_fill(0, count($cleanIds), '?'));
                $stmt = $db->prepare("SELECT email, name FROM subscribers WHERE id IN ($placeholders) LIMIT 1");
                $stmt->execute($cleanIds);
            } else {
                // Limit to 1 recipient to prevent rate-limiting during tests
                $stmt = $db->query("SELECT email, name FROM subscribers LIMIT 1");
            }

            $recipients = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            if (empty($recipients)) {
                echo json_encode(['success' => false, 'message' => 'No active subscribers found for the selected scope.']);
                exit;
            }

            // Mailtrap Sandbox Credentials
            $smtpHost = 'sandbox.smtp.mailtrap.io';
            $smtpPort = 2525;
            $smtpUser = '142cac3390e917';
            $smtpPass = '4eddf5374b34f3';
            $sentCount = 0;

            foreach ($recipients as $recipient) {
                $recipientName = !empty($recipient['name']) ? $recipient['name'] : 'Valued Subscriber';

                $htmlContent = "
                    <div style='font-family: Georgia, serif; max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #e5dfd3; background: #fdfbf7;'>
                        <h2 style='color: #003b2f; margin-bottom: 20px;'>ZEITH LUXURY TIMEPIECES</h2>
                        <p style='font-size: 16px; color: #333;'>Hello " . htmlspecialchars($recipientName) . ",</p>
                        <div style='font-size: 15px; color: #555; line-height: 1.6; margin: 20px 0;'>" . nl2br(htmlspecialchars($message)) . "</div>
                        <hr style='border: none; border-top: 1px solid #e5dfd3; margin: 30px 0;'>
                        <small style='color: #888;'>You are receiving this email because you subscribed to ZEITH Updates.</small>
                    </div>
                ";

                $socket = @fsockopen($smtpHost, $smtpPort, $errno, $errstr, 10);
                if (!$socket) {
                    echo json_encode(['success' => false, 'message' => "SMTP Connection Failed: $errstr ($errno)"]);
                    exit;
                }

                $sendCommand = function ($command, $expectedCode) use ($socket) {
                    fputs($socket, $command . "\r\n");
                    fflush($socket);
                    
                    $response = '';
                    while ($line = fgets($socket, 512)) {
                        $response .= $line;
                        if (substr($line, 3, 1) === ' ') {
                            break;
                        }
                    }
                    
                    if (substr($response, 0, 3) !== (string)$expectedCode) {
                        return [false, $response];
                    }
                    return [true, $response];
                };

                fgets($socket, 512);

                list($ok, $res) = $sendCommand("EHLO zeithwatches.local", 250);
                if (!$ok) { fclose($socket); echo json_encode(['success' => false, 'message' => "SMTP EHLO Error: $res"]); exit; }

                list($ok, $res) = $sendCommand("AUTH LOGIN", 334);
                if (!$ok) { fclose($socket); echo json_encode(['success' => false, 'message' => "SMTP AUTH Command Error: $res"]); exit; }

                list($ok, $res) = $sendCommand(base64_encode($smtpUser), 334);
                if (!$ok) { fclose($socket); echo json_encode(['success' => false, 'message' => "SMTP User Error: $res"]); exit; }

                list($ok, $res) = $sendCommand(base64_encode($smtpPass), 235);
                if (!$ok) { fclose($socket); echo json_encode(['success' => false, 'message' => "Mailtrap SMTP Auth Failed: $res"]); exit; }

                list($ok, $res) = $sendCommand("MAIL FROM: <no-reply@zeithwatches.local>", 250);
                if (!$ok) { fclose($socket); echo json_encode(['success' => false, 'message' => "SMTP MAIL FROM Error: $res"]); exit; }

                list($ok, $res) = $sendCommand("RCPT TO: <{$recipient['email']}>", 250);
                if (!$ok) { fclose($socket); echo json_encode(['success' => false, 'message' => "SMTP RCPT TO Error: $res"]); exit; }

                list($ok, $res) = $sendCommand("DATA", 354);
                if (!$ok) { fclose($socket); echo json_encode(['success' => false, 'message' => "SMTP DATA Error: $res"]); exit; }

                $emailData  = "Subject: {$subject}\r\n";
                $emailData .= "To: {$recipientName} <{$recipient['email']}>\r\n";
                $emailData .= "From: ZEITH Luxury Watches <no-reply@zeithwatches.local>\r\n";
                $emailData .= "MIME-Version: 1.0\r\n";
                $emailData .= "Content-Type: text/html; charset=UTF-8\r\n\r\n";
                $emailData .= $htmlContent . "\r\n.";

                list($ok, $res) = $sendCommand($emailData, 250);
                if ($ok) {
                    $sentCount++;
                } else {
                    fclose($socket);
                    echo json_encode(['success' => false, 'message' => "SMTP Send Error: $res"]);
                    exit;
                }

                $sendCommand("QUIT", 221);
                fclose($socket);
            }

            echo json_encode([
                'success' => true,
                'message' => "Successfully sent {$sentCount} test newsletter to Mailtrap Sandbox inbox!"
            ]);
            exit;
        } catch (\Throwable $e) {
            echo json_encode([
                'success' => false,
                'message' => 'PHP Fatal Error: ' . $e->getMessage()
            ]);
            exit;
        }
    }

    public static function delete()
    {
        $subscriberId = (int)($_POST['subscriber_id'] ?? $_GET['id'] ?? 0);

        if ($subscriberId <= 0) {
            header("Location: /Watch_Collection/staff/subscribers");
            exit;
        }

        try {
            $db = \App\Models\Db::connect();
            $stmt = $db->prepare("DELETE FROM subscribers WHERE id = ?");
            $stmt->execute([$subscriberId]);

            header("Location: /Watch_Collection/staff/subscribers?message=" . urlencode("Subscriber removed successfully."));
            exit;
        } catch (\Exception $e) {
            header("Location: /Watch_Collection/staff/subscribers?message=" . urlencode("Failed to delete subscriber."));
            exit;
        }
    }
}