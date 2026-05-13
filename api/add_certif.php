<?php
header('Content-Type: application/json');

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

$nom = trim($data['nom'] ?? '');
if ($nom === '') {
    http_response_code(400);
    echo json_encode(['error' => 'Le nom est obligatoire']);
    exit;
}

$allowed_tracks  = ['dev', 'secu', 'culture'];
$allowed_statuts = ['obtenue', 'en_cours', 'prevu'];

$track  = in_array($data['track']  ?? '', $allowed_tracks,  true) ? $data['track']  : 'dev';
$statut = in_array($data['statut'] ?? '', $allowed_statuts, true) ? $data['statut'] : 'prevu';
$prog   = max(0, min(100, (int)($data['progression'] ?? 0)));
$heures = isset($data['heures']) && $data['heures'] !== '' ? (int)$data['heures'] : null;

// Auto-ordre : récupère le max existant et ajoute 1
$existing = supabase_request('GET', '/rest/v1/certifications?select=ordre&order=ordre.desc&limit=1') ?? [];
$max_ordre = isset($existing[0]['ordre']) ? (int)$existing[0]['ordre'] : 0;

$body = [
    'nom'        => $nom,
    'emetteur'   => trim($data['emetteur'] ?? '') ?: null,
    'track'      => $track,
    'statut'     => $statut,
    'progression'=> $statut === 'obtenue' ? 100 : ($statut === 'prevu' ? 0 : $prog),
    'heures'     => $heures,
    'ordre'      => $max_ordre + 1,
];

$result = supabase_request('POST', '/rest/v1/certifications', $body);

if ($result === null) {
    http_response_code(502);
    echo json_encode(['error' => 'Erreur lors de la création Supabase']);
    exit;
}

echo json_encode(['success' => true, 'data' => $result]);
