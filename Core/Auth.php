<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Check if the logged-in user has Admin privileges.
 */
function checkAdmin() {
    if (!isset($_SESSION['user_id']) || ($_SESSION['user_role'] ?? '') !== 'admin') {
        header('Location: /Zeith/login?error=unauthorized');
        exit;
    }
}

/**
 * Check if the logged-in user has Staff or Admin privileges (Staff workspace).
 */
function checkStaff() {
    $role = $_SESSION['user_role'] ?? '';
    if (!isset($_SESSION['user_id']) || ($role !== 'staff' && $role !== 'admin')) {
        header('Location: /Zeith/login?error=unauthorized');
        exit;
    }
}