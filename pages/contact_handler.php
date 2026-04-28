<?php
// ============================================================
//  Handler du formulaire de contact
//  — Envoie un email via mail()
//  — Stocke le message dans Supabase via REST API
// ============================================================

// Buffer de sortie : capture tout output parasite (warnings PHP, notices)
// pour garantir une réponse JSON propre
ob_start();
error_reporting(0);
ini_set('display_errors', '0');

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../config/config.php';

// ---------- Helpers ----------
function json_response(bool $ok, string $message, array $extra = []): void {
    ob_end_clean(); // Vide le buffer avant d'écrire le JSON
    echo json_encode(array_merge(['success' => $ok, 'message' => $message], $extra));
    exit;
}

function sanitize(string $v): string {
    return htmlspecialchars(strip_tags(trim($v)), ENT_QUOTES, 'UTF-8');
}

// ---------- Vérification méthode ----------
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_response(false, 'Méthode non autorisée.');
}

// ---------- Récupération & validation ----------
$name    = sanitize($_POST['name']    ?? '');
$email   = trim($_POST['email']       ?? '');
$subject = sanitize($_POST['subject'] ?? 'Message depuis le portfolio');
$message = sanitize($_POST['message'] ?? '');

$errors = [];
if (strlen($name) < 2)                             $errors[] = 'Le nom doit contenir au moins 2 caractères.';
if (!filter_var($email, FILTER_VALIDATE_EMAIL))    $errors[] = 'Adresse email invalide.';
if (strlen($message) < 10)                         $errors[] = 'Le message doit contenir au moins 10 caractères.';

if (!empty($errors)) {
    json_response(false, implode(' ', $errors));
}

$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$ip    = $_SERVER['REMOTE_ADDR'] ?? 'inconnue';
$date  = date('d/m/Y H:i');

// ============================================================
//  1. Envoi email via mail()
// ============================================================
$email_ok    = false;
$email_error = '';

$mail_subject = "[Portfolio] $subject";
$mail_body    = "Nouveau message reçu depuis le portfolio.\n\n"
              . "Date     : $date\n"
              . "Nom      : $name\n"
              . "Email    : $email\n"
              . "IP       : $ip\n"
              . "Sujet    : $subject\n\n"
              . "Message :\n"
              . str_repeat('-', 40) . "\n"
              . $message . "\n"
              . str_repeat('-', 40) . "\n";

$headers = implode("\r\n", [
    'From: ' . CONTACT_EMAIL_FROM,
    'Reply-To: ' . $email,
    'X-Mailer: PHP/' . phpversion(),
    'MIME-Version: 1.0',
    'Content-Type: text/plain; charset=UTF-8',
]);

try {
    $email_ok = @mail(CONTACT_EMAIL, $mail_subject, $mail_body, $headers);
    if (!$email_ok) $email_error = 'mail() indisponible sur ce serveur.';
} catch (Throwable $e) {
    $email_error = $e->getMessage();
}

// ============================================================
//  2. Stockage Supabase via REST API
// ============================================================
$supabase_ok         = false;
$supabase_error      = '';
$supabase_configured = (
    defined('SUPABASE_URL') &&
    SUPABASE_URL      !== 'https://VOTRE_PROJECT_REF.supabase.co' &&
    SUPABASE_ANON_KEY !== 'VOTRE_ANON_KEY'
);

if ($supabase_configured) {
    $endpoint = rtrim(SUPABASE_URL, '/') . '/rest/v1/' . SUPABASE_TABLE;

    $payload = json_encode([
        'name'       => $name,
        'email'      => $email,
        'subject'    => $subject,
        'message'    => $message,
        'ip_address' => $ip,
        'created_at' => date('c'),
    ]);

    $ch = curl_init($endpoint);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $payload,
        CURLOPT_HTTPHEADER     => [
            'apikey: '               . SUPABASE_ANON_KEY,
            'Authorization: Bearer ' . SUPABASE_ANON_KEY,
            'Content-Type: application/json',
            'Prefer: return=minimal',
        ],
        CURLOPT_TIMEOUT        => 10,
        CURLOPT_SSL_VERIFYPEER => true,
    ]);

    $response  = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curl_err  = curl_error($ch);
    curl_close($ch);

    if ($curl_err) {
        $supabase_error = "cURL : $curl_err";
    } elseif ($http_code >= 200 && $http_code < 300) {
        $supabase_ok = true;
    } else {
        $supabase_error = "HTTP $http_code — $response";
    }
}

// ============================================================
//  Réponse finale
// ============================================================

// Cas 1 : email OK
if ($email_ok) {
    $msg = $supabase_ok ? 'Message envoyé et sauvegardé.' : 'Message envoyé avec succès !';
    json_response(true, $msg);
}

// Cas 2 : email KO mais Supabase OK
if ($supabase_ok && $supabase_configured) {
    json_response(true, 'Message reçu et sauvegardé (email indisponible sur ce serveur).');
}

// Cas 3 : rien de configuré (environnement local / test)
if (!$supabase_configured) {
    json_response(true, 'Message bien reçu ! (Mode local — email et base de données non configurés)');
}

// Cas 4 : tout a échoué
$msg = DEBUG_MODE
    ? "Erreurs — email: $email_error | supabase: $supabase_error"
    : "Une erreur est survenue. Contactez-moi directement : " . CONTACT_EMAIL;
json_response(false, $msg);
