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

$data = json_decode(file_get_contents('php://input'), true);

$id = isset($data['id']) ? (int)$data['id'] : 0;
if ($id <= 0) {
    http_response_code(400);
    echo json_encode(['error' => 'id invalide ou manquant']);
    exit;
}

// On revérifie le statut côté serveur : seule une certif "prévue" est supprimable
$existing = supabase_request('GET', '/rest/v1/certifications?id=eq.' . $id . '&select=statut');
if ($existing === null || empty($existing)) {
    http_response_code(404);
    echo json_encode(['error' => 'Certification introuvable']);
    exit;
}

if (($existing[0]['statut'] ?? '') !== 'prevu') {
    http_response_code(409);
    echo json_encode(['error' => 'Seule une certification prévue peut être supprimée']);
    exit;
}

supabase_request('DELETE', '/rest/v1/certifications?id=eq.' . $id);

// supabase_request() ne met pas "Prefer: return=representation" sur DELETE,
// donc PostgREST répond 204 (corps vide) et la fonction renvoie toujours null
// même en cas de succès. On vérifie donc le résultat réel via un GET plutôt
// que de se fier à sa valeur de retour.
$check = supabase_request('GET', '/rest/v1/certifications?id=eq.' . $id . '&select=id');

if ($check === null) {
    http_response_code(502);
    echo json_encode(['error' => 'Suppression envoyée mais impossible de vérifier le résultat']);
    exit;
}

if (!empty($check)) {
    http_response_code(502);
    echo json_encode(['error' => 'La suppression a échoué côté Supabase']);
    exit;
}

echo json_encode(['success' => true]);
