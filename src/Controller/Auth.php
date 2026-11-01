<?php

namespace App\Controller;

use App\Helpers\Response;
use App\Helpers\Session;
use App\Helpers\Validation;
use App\Helpers\View;
use App\Middleware\Authentication;

class Auth
{
    public static function showLogin()
    {
        View::displayView("login.php");
        return;
    }

    public static function showRegister()
    {
        View::displayView("register.php");
        return;
    }

    public static function storeRegister()
    {
        // Catch any accidental output/warnings in an output buffer
        ob_start();

        // Support both JSON payloads (from register.js) and standard form-data
        $rawData = file_get_contents("php://input");
        $data = json_decode($rawData, true);
        if (empty($data)) {
            $data = $_POST;
        }

        $errors = [];

        // 1. CSRF Token Verification
        if (!isset($data['csrf_token']) || !Session::checkToken($data['csrf_token'])) {
            if (ob_get_length()) ob_clean();
            Response::json([
                'message' => 'unauthorized request',
                'success' => false,
                'errors' => ['unauthorized request']
            ], 401);
            exit;
        }

        // 2. Validate Empty Inputs
        if (empty(trim($data['firstname'] ?? ''))) {
            $errors[] = "First name is required";
        }
        if (empty(trim($data['lastname'] ?? ''))) {
            $errors[] = "Last name is required";
        }
        if (empty(trim($data['email'] ?? ''))) {
            $errors[] = "Email is required";
        }
        if (empty(trim($data['password'] ?? ''))) {
            $errors[] = "Password is required";
        }

        // 3. Email Format Validation
        if (!empty($data['email']) && !Validation::isEmail($data['email'])) {
            $errors[] = "Invalid email format";
        }

        if (!empty($errors)) {
            if (ob_get_length()) ob_clean();
            Response::json([
                'message' => 'failed validation',
                'success' => false,
                'errors' => $errors
            ], 422);
            exit;
        }

        // 4. Register User by calling Authentication class
        $registered = Authentication::processRegister($data);

        // Wipe output buffer clean before outputting JSON response
        if (ob_get_length()) ob_clean();
        if ($registered) {
            Response::json([
                'message' => 'User registered successfully',
                'success' => true,
                'redirect' => './login.php'
            ], 200);
            exit;
        } else {
            Response::json([
                'message' => 'Registration failed. Email might already exist.',
                'success' => false,
                'errors' => ['Could not register user']
            ], 400);
            exit;
        }
    }

    public static function storeLogin()
    {
        ob_start();

        $rawData = file_get_contents("php://input");
        $data = json_decode($rawData, true) ?? [];

        $errors = [];

        if (!isset($data['csrf_token']) || !Session::checkToken($data['csrf_token'])) {
            if (ob_get_length()) ob_clean();
            Response::json([
                'message' => 'unauthorized request',
                'success' => false,
                'errors' => ['unauthorized request']
            ], 401);
            exit;
        }

        if (empty(trim($data['email'] ?? ''))) {
            $errors[] = "email is required";
        }

        if (empty(trim($data['password'] ?? ''))) {
            $errors[] = "password is required";
        }

        if (!empty($errors)) {
            if (ob_get_length()) ob_clean();
            Response::json([
                'message' => 'failed validation',
                'success' => false,
                'errors' => $errors
            ], 422);
            exit;
        }

        $email = $data['email'];
        $password = $data['password'];

        if (!Validation::isEmail($email)) {
            $errors[] = 'invalid email, please check email and try again';
        }

        if (!empty($errors)) {
            if (ob_get_length()) ob_clean();
            Response::json([
                'message' => 'failed validation',
                'success' => false,
                'errors' => $errors
            ], 422);
            exit;
        }

        if (ob_get_length()) ob_clean();

        if (Authentication::processLogin($email, $password)) {
            // Get the user data from session to check role and status
            $user = Authentication::user();

            // 🛑 CHECK IF USER IS SUSPENDED
            if (isset($user['status']) && strtolower(trim($user['status'])) === 'suspended') {
                Session::start();
                session_unset();
                session_destroy();

                Response::json([
                    'message' => 'Your account has been suspended. Please contact support.',
                    'success' => false,
                    'errors' => ['Your account has been suspended.']
                ], 422);
                exit;
            }

            $role = $user['role'] ?? 'staff';

            $redirectUrl = ($role === 'admin')
                ? '/Watch_Collection/admin/dashboard'
                : '/Watch_Collection/staff/dashboard';

            Response::json([
                'message' => 'User has been logged in successfully',
                'success' => true,
                'redirect' => $redirectUrl
            ], 200);
            exit;
        } else {
            $errorMsg = $_SESSION['login_error'] ?? 'invalid credentials';
            unset($_SESSION['login_error']);

            Response::json([
                'message' => $errorMsg,
                'success' => false,
                'errors' => [$errorMsg]
            ], 422);
            exit;
        }
    }

    public static function unauthorize_request()
    {
        Session::start();

        if (!Authentication::isLoggedIn()) {
            View::displayView('unauthorize_request.php');
            exit();
        }

        return;
    }

    public static function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
        header("Location: http://localhost/Watch_Collection/auth/login");
        exit;
    }

    public static function sendResetLink()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);

            // Database connection
            $host = 'localhost';
            $db_name = 'watch_collection';
            $username = 'root';
            $password = '';

            try {
                $db = new \PDO("mysql:host=$host;dbname=$db_name;charset=utf8mb4", $username, $password);
                $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }

            $stmt = $db->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
            $stmt->execute([$email]);
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);

            // If user does NOT exist in the database, redirect with error
            if (!$user) {
                header("Location: /Watch_Collection/auth/forgot-password?error=not_found");
                exit;
            }

            // Generate secure token
            $token = bin2hex(random_bytes(32));

            // Save token to password_resets table
            $stmt = $db->prepare("DELETE FROM password_resets WHERE email = ?");
            $stmt->execute([$email]);

            $stmt = $db->prepare("INSERT INTO password_resets (email, token, created_at) VALUES (?, ?, NOW())");
            $stmt->execute([$email, $token]);

            // Build the dynamic reset link
            $resetLink = "http://localhost/Watch_Collection/auth/reset-password?token=" . $token;

            // Send email via PHPMailer & Brevo SMTP
            $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host       = 'smtp-relay.brevo.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = $_ENV['SMTP_USER'] ?? getenv('SMTP_USER');
                $mail->Password   = $_ENV['SMTP_PASS'] ?? getenv('SMTP_PASS');
                $mail->SMTPSecure = \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;

                // Bypass local SSL certificate check on localhost
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer'       => false,
                        'verify_peer_name'  => false,
                        'allow_self_signed' => true
                    )
                );

                // Sender & Recipient
                $mail->setFrom('chibuikemnweze2020@gmail.com', 'Zeith Watch Collection');
                $mail->addAddress($email);

                $mail->isHTML(true);
                $mail->Subject = 'Password Reset Request - Zeith';
                $mail->Body    = "
            <h3>Password Reset Request</h3>
            <p>We received a request to reset your password. Click the button below to proceed:</p>
            <p><a href='{$resetLink}' style='background:#f97316; color:white; padding:10px 20px; text-decoration:none; border-radius:5px; display:inline-block;'>Reset Password</a></p>
            <p>If you didn't request this, you can safely ignore this email.</p>
            ";

                $mail->send();

                // Redirect immediately upon successful dispatch matching view check (?success=sent)
                header("Location: /Watch_Collection/auth/forgot-password?success=sent");
                exit;
            } catch (\Exception $e) {
                echo "Mailer Error: " . $mail->ErrorInfo;
                exit;
            }
        }
    }

    public static function updatePassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['token'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirm = $_POST['password_confirmation'] ?? '';

            if ($password !== $confirm) {
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit;
            }

            $host = 'localhost';
            $db_name = 'watch_collection';
            $username = 'root';
            $password_db = '';

            try {
                $db = new \PDO("mysql:host=$host;dbname=$db_name;charset=utf8mb4", $username, $password_db);
                $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }

            // 1. Verify token exists
            $stmt = $db->prepare("SELECT * FROM password_resets WHERE token = ? LIMIT 1");
            $stmt->execute([$token]);
            $resetRecord = $stmt->fetch(\PDO::FETCH_ASSOC);

            if (!$resetRecord) {
                die("Invalid or expired password reset token.");
            }

            // 2. Hash new password and update the 'users' table
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $updateStmt = $db->prepare("UPDATE users SET password = ? WHERE email = ?");
            $updateStmt->execute([$hashedPassword, $resetRecord['email']]);

            // 3. Delete used token
            $deleteStmt = $db->prepare("DELETE FROM password_resets WHERE email = ?");
            $deleteStmt->execute([$resetRecord['email']]);

            // 4. Redirect to login with success message
            Session::start();
            $_SESSION['flash'] = "Password updated successfully. You can now login.";
            header("Location: /Watch_Collection/auth/login");
            exit;
        }
    }

    public static function showForgotPassword()
    {
        View::displayView("forgot-password.php");
        return;
    }

    public static function showResetPassword()
    {
        View::displayView("reset-password.php");
        return;
    }
}
