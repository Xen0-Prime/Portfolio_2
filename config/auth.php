<?php
// ── Admin credentials ────────────────────────────────────────────────────────
// Pour changer le mot de passe, génère un nouveau hash :
//   php -r "echo password_hash('NouveauMotDePasse', PASSWORD_BCRYPT);"
// Puis remplace la valeur de ADMIN_PASSWORD_HASH ci-dessous.

define('ADMIN_USERNAME',      'killian');
define('ADMIN_PASSWORD_HASH', '$2y$12$uq9wehaqiNOXRJt.soTrbuIYF7C6ZifEX3a0sPj6rhUW/XK0Klmeq');

// ── Session bootstrap ────────────────────────────────────────────────────────
function auth_session_start(): void
{
    if (session_status() !== PHP_SESSION_NONE) return;

    session_set_cookie_params([
        'lifetime' => 0,          // cookie de session (expire à fermeture du navigateur)
        'path'     => '/',
        'secure'   => isset($_SERVER['HTTPS']),
        'httponly' => true,
        'samesite' => 'Strict',
    ]);
    session_start();
}

// ── Guard : redirige vers login si non connecté ──────────────────────────────
function auth_require(): void
{
    auth_session_start();
    if (empty($_SESSION['admin_logged_in'])) {
        header('Location: login.php');
        exit;
    }
}

// ── Tentative de connexion (retourne true/false) ─────────────────────────────
function auth_attempt(string $username, string $password): bool
{
    if (!hash_equals(ADMIN_USERNAME, $username)) return false;
    return password_verify($password, ADMIN_PASSWORD_HASH);
}

// ── Ouvre une session admin ──────────────────────────────────────────────────
function auth_login(): void
{
    session_regenerate_id(true);         // prévient la fixation de session
    $_SESSION['admin_logged_in'] = true;
    $_SESSION['admin_user']      = ADMIN_USERNAME;
    $_SESSION['login_time']      = time();
}

// ── Détruit la session ───────────────────────────────────────────────────────
function auth_logout(): void
{
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $p = session_get_cookie_params();
        setcookie(session_name(), '', time() - 3600,
            $p['path'], $p['domain'], $p['secure'], $p['httponly']);
    }
    session_destroy();
}

// ── CSRF : génère ou récupère le token de la session ────────────────────────
function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrf_verify(string $token): bool
{
    return isset($_SESSION['csrf_token'])
        && hash_equals($_SESSION['csrf_token'], $token);
}
