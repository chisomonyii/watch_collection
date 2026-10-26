<?php
// api/like-watch.php
require_once __DIR__ . '/../includes/db.php'; // adjust path to your PDO connection

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $watchId = $data['id'] ?? null;

    if ($watchId) {
        $stmt = $pdo->prepare("UPDATE watches SET likes_count = likes_count + 1 WHERE id = ?");
        $stmt->execute([$watchId]);
        echo json_encode(['success' => true]);
        exit;
    }
}
echo json_encode(['success' => false]);