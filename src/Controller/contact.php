<?php

namespace App\Controller;

use App\Models\Contact as ContactModel;
use App\Helpers\View;

class Contact
{
    /**
     * Display the contact form view
     */
    public static function showContactPage()
    {
        \App\Helpers\View::displayView('user/contact.php');
    }

    /**
     * Handle contact form POST submission
     */
    public static function submitForm()
    {
        header('Content-Type: application/json');

        // Read POST payload (JSON or Form Data)
        $input = json_decode(file_get_contents('php://input'), true) ?? $_POST;

        $name    = trim($input['name'] ?? '');
        $email   = trim($input['email'] ?? '');
        $phone   = trim($input['phone'] ?? '');
        $message = trim($input['message'] ?? '');

        if (empty($name) || empty($email) || empty($message)) {
            echo json_encode([
                'success' => false,
                'message' => 'Please fill in all required fields.'
            ]);
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode([
                'success' => false,
                'message' => 'Please provide a valid email address.'
            ]);
            exit;
        }

        $saved = ContactModel::store([
            'name'    => $name,
            'email'   => $email,
            'phone'   => $phone,
            'message' => $message
        ]);

        if ($saved) {
            echo json_encode([
                'success' => true,
                'message' => 'Thank you for contacting us! We will get back to you shortly.'
            ]);
        } else {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Failed to save message. Please try again later.'
            ]);
        }
        exit;
    }
}
