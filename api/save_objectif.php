<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../config/supabase.php';

auth_session_start();
if (empty($_SESSION['admin_logged_in'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Non autorisé']);
    exit;
}

$data  = json_decode(file_get_contents('php://input'), true);
$value = trim($data['value'] ?? '');

if ($value === '') {
    http_response_code(400);
    echo json_encode(['error' => 'La valeur est obligatoire']);
    exit;
}

$result = supabase_request('PATCH', '/rest/v1/settings?key=eq.certif_objectif', ['value' => $value]);

if ($result === null) {
    http_response_code(502);
    echo json_encode(['error' => 'Erreur lors de la mise à jour Supabase']);
    exit;
}

echo json_encode(['success' => true, 'data' => $result]);
