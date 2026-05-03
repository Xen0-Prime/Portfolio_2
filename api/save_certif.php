<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

require_once __DIR__ . '/../config/supabase.php';

$data = json_decode(file_get_contents('php://input'), true);

$id = isset($data['id']) ? (int)$data['id'] : 0;
if ($id <= 0) {
    http_response_code(400);
    echo json_encode(['error' => 'id invalide ou manquant']);
    exit;
}

$allowed_statuts = ['obtenue', 'en_cours', 'prevu'];
$body = [];

if (isset($data['statut']) && in_array($data['statut'], $allowed_statuts, true)) {
    $body['statut'] = $data['statut'];
}

if (isset($data['progression'])) {
    $prog = (int)$data['progression'];
    $body['progression'] = max(0, min(100, $prog));
}

if (empty($body)) {
    http_response_code(400);
    echo json_encode(['error' => 'Aucun champ valide fourni (statut ou progression)']);
    exit;
}

$result = supabase_request('PATCH', '/rest/v1/certifications?id=eq.' . $id, $body);

if ($result === null) {
    http_response_code(502);
    echo json_encode(['error' => 'Erreur lors de la mise à jour Supabase']);
    exit;
}

echo json_encode(['success' => true, 'data' => $result]);
