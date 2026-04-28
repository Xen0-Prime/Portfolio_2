<?php
// ============================================================
//  Handler du formulaire de contact
//  — Envoie un email via mail()
//  — Stocke le message dans Supabase via REST API
// ============================================================

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../config/config.php';

// ---------- Helpers ----------
function json_response(bool $ok, string $message, array $extra = []): void {
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
$email   = trim($_POST['email']   ?? '');
$subject = sanitize($_POST['subject'] ?? 'Message depuis le portfolio');
$message = sanitize($_POST['message'] ?? '');

$errors = [];
if (strlen($name) < 2)               $errors[] = 'Le nom doit contenir au moins 2 caractères.';
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Adresse email invalide.';
if (strlen($message) < 10)           $errors[] = 'Le message doit contenir au moins 10 caractères.';

if (!empty($errors)) {
    json_response(false, implode(' ', $errors));
}

$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$ip    = $_SERVER['REMOTE_ADDR'] ?? 'inconnue';
$date  = date('d/m/Y H:i');

// ============================================================
//  1. Envoi email via mail()
// ============================================================
$email_ok = false;
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
    "From: $name <" . CONTACT_EMAIL_FROM . ">",
    "Reply-To: $email",
    "X-Mailer: PHP/" . phpversion(),
    "MIME-Version: 1.0",
    "Content-Type: text/plain; charset=UTF-8",
]);

try {
    $email_ok = mail(CONTACT_EMAIL, $mail_subject, $mail_body, $headers);
    if (!$email_ok) $email_error = 'mail() a retourné false.';
} catch (Throwable $e) {
    $email_error = $e->getMessage();
}

// ============================================================
//  2. Stockage Supabase via REST API
// ============================================================
$supabase_ok    = false;
$supabase_error = '';

// Ignorer si les credentials ne sont pas configurés
$supabase_configured = (
    SUPABASE_URL !== 'https://VOTRE_PROJECT_REF.supabase.co' &&
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
        'created_at' => date('c'), // ISO 8601
    ]);

    $ch = curl_init($endpoint);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $payload,
        CURLOPT_HTTPHEADER     => [
            'apikey: '        . SUPABASE_ANON_KEY,
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
} else {
    // Supabase non configuré → on ne bloque pas l'envoi
    $supabase_ok    = true;
    $supabase_error = 'Supabase non configuré (ignoré).';
}

// ============================================================
//  Réponse finale
// ============================================================
if ($email_ok) {
    $detail = $supabase_ok ? 'Email envoyé et message sauvegardé.' : 'Email envoyé (sauvegarde base échouée).';
    json_response(true, $detail, DEBUG_MODE ? ['supabase_error' => $supabase_error] : []);
} else {
    // Email échoué → on retourne quand même OK si Supabase a fonctionné
    if ($supabase_ok && $supabase_configured) {
        json_response(true, 'Message sauvegardé (email indisponible sur ce serveur).', DEBUG_MODE ? ['email_error' => $email_error] : []);
    } else {
        $msg = DEBUG_MODE ? "Erreur email : $email_error" : "Une erreur est survenue. Contactez-moi directement par email.";
        json_response(false, $msg);
    }
}
