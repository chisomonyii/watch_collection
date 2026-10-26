<?php

namespace App\Controller;

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

        // Fetch the live status directly from the database table
        $status = self::fetchUserStatus($userId);

        // Strict comparison check
        if ($status === 'pending') {
            View::displayView("staff/staffApproval.php");
        } else {
            View::displayView("staff/overview.php");
        }
    }

    /**
     * Helper method to query the user's current status from the database
     */
    private static function fetchUserStatus(int $userId): string
    {
        try {
            $pdo = new \PDO("mysql:host=localhost;dbname=watch_collection", "root", "");
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare("SELECT status FROM users WHERE id = ?");
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

    public static function orders()
    {
        self::checkPendingStatus();
        View::displayView("staff/orders.php");
    }

    public static function watch()
    {
        self::checkPendingStatus();
        View::displayView("staff/watch.php");
    }

    public static function contact()
    {
        self::checkPendingStatus();

        try {
            $pdo = new \PDO("mysql:host=localhost;dbname=watch_collection", "root", "");
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            // Fetch inquiries sorted by newest first
            $stmt = $pdo->query("SELECT * FROM contact ORDER BY id DESC");
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
            $pdo = new \PDO("mysql:host=localhost;dbname=watch_collection", "root", "");
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->execute([$userId]);
            $staffUser = $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            $staffUser = $_SESSION['user'];
        }

        View::displayView("staff/profile.php", ['staffUser' => $staffUser]);
    }

    public static function updateProfile()
    {
        self::checkPendingStatus();
        $userId = $_SESSION['user']['id'] ?? null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $firstname = trim($_POST['firstname'] ?? '');
            $lastname  = trim($_POST['lastname'] ?? '');
            $email     = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
            $password  = trim($_POST['password'] ?? '');

            if (!$firstname || !$lastname || !$email) {
                header("Location: /Watch_Collection/staff/profile?error=invalid_input");
                exit;
            }

            try {
                $pdo = new \PDO("mysql:host=localhost;dbname=watch_collection", "root", "");
                $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

                if (!empty($password)) {
                    // Update with new password
                    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                    $stmt = $pdo->prepare("UPDATE users SET firstname = ?, lastname = ?, email = ?, password = ?, updated_at = NOW() WHERE id = ?");
                    $stmt->execute([$firstname, $lastname, $email, $hashedPassword, $userId]);
                } else {
                    // Update without changing password
                    $stmt = $pdo->prepare("UPDATE users SET firstname = ?, lastname = ?, email = ?, updated_at = NOW() WHERE id = ?");
                    $stmt->execute([$firstname, $lastname, $email, $userId]);
                }

                // Refresh session data
                $_SESSION['user']['firstname'] = $firstname;
                $_SESSION['user']['lastname']  = $lastname;
                $_SESSION['user']['email']     = $email;

                header("Location: /Watch_Collection/staff/profile?success=profile_updated");
                exit;
            } catch (\Exception $e) {
                header("Location: /Watch_Collection/staff/profile?error=update_failed");
                exit;
            }
        }
    }

    /**
     * Display Review Moderation Dashboard
     */
    public static function reviews()
    {
        self::checkPendingStatus();

        try {
            $pdo = new \PDO("mysql:host=localhost;dbname=watch_collection", "root", "");
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            // Fetch all reviews sorted newest first
            $stmt = $pdo->query("SELECT * FROM reviews ORDER BY id DESC");
            $reviews = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            // Calculate counts for stats cards
            $totalReviews = count($reviews);
            $pendingReviews = 0;
            $approvedReviews = 0;
            $rejectedReviews = 0;

            foreach ($reviews as $rev) {
                $status = strtolower(trim($rev['status'] ?? 'pending'));
                if ($status === 'pending') $pendingReviews++;
                elseif ($status === 'approved') $approvedReviews++;
                elseif ($status === 'rejected') $rejectedReviews++;
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
    /**
     * Approve a customer review and automatically feature it
     */
    public static function approveReview($id)
    {
        self::checkPendingStatus();

        try {
            $pdo = new \PDO("mysql:host=localhost;dbname=watch_collection", "root", "");
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            // Sets status to approved and automatically sets is_featured to 1
            $stmt = $pdo->prepare("UPDATE reviews SET status = 'approved', is_featured = 1 WHERE id = ?");
            $stmt->execute([$id]);
        } catch (\Exception $e) {
            // handle error
        }

        header("Location: /Watch_Collection/staff/reviews?success=approved");
        exit;
    }

    /**
     * Reject a customer review and automatically unfeature it
     */
    public static function rejectReview($id)
    {
        self::checkPendingStatus();

        try {
            $pdo = new \PDO("mysql:host=localhost;dbname=watch_collection", "root", "");
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            // Sets status to rejected and automatically sets is_featured to 0
            $stmt = $pdo->prepare("UPDATE reviews SET status = 'rejected', is_featured = 0 WHERE id = ?");
            $stmt->execute([$id]);
        } catch (\Exception $e) {
            // handle error
        }

        header("Location: /Watch_Collection/staff/reviews?success=rejected");
        exit;
    }
}
