<?php

namespace App\Helpers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../../vendor/autoload.php';

class MailHelper
{
    public static function sendOrderConfirmation($toEmail, $customerName, $orderId, $orderStatus)
    {
        $mail = new PHPMailer(true);

        try {
            // Gmail SMTP Server Settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username = $_ENV['GMAIL_USERNAME'] ?? '';
            $mail->Password = $_ENV['GMAIL_APP_PASSWORD'] ?? '';           // <-- Paste your 16-character App Password here
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Recipients (Must match or use an alias of your Gmail username)
            $mail->setFrom('chibuikemnweze2020@gmail.com', 'ZEITH Luxury Watches');
            $mail->addAddress($toEmail, $customerName);

            // Content
            $mail->isHTML(true);
            $mail->Subject = "ZEITH Order #" . $orderId . " - Payment " . $orderStatus;

            // Styled Luxury HTML Template matching ZEITH's theme
            $mail->Body = "
                <div style='background-color: #0b0b0b; color: #ffffff; padding: 30px; font-family: sans-serif;'>
                    <h2 style='color: #d4af37; text-transform: uppercase; letter-spacing: 2px;'>ZEITH</h2>
                    <p>Dear {$customerName},</p>
                    <p>Thank you for choosing ZEITH. We have received your order (<strong>#" . $orderId . "</strong>).</p>
                    <p>Current Status: <strong style='color: #d4af37;'>" . $orderStatus . "</strong></p>
                    <p>We will notify you once your luxury timepiece has been carefully packaged and dispatched.</p>
                    <hr style='border: 0; border-top: 1px solid #333; margin: 20px 0;'>
                    <p style='font-size: 12px; color: #888;'>&copy; " . date('Y') . " ZEITH Watch Collection. All rights reserved.</p>
                </div>
            ";

            return $mail->send();
        } catch (Exception $e) {
            return false;
        }
    }
}
