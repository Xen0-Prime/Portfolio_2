<?php
// ── Supabase configuration ──────────────────────────────────────────────────
require_once __DIR__ . '/config.php';   // fournit SUPABASE_URL + SUPABASE_ANON_KEY

if (!defined('SUPABASE_SERVICE_KEY')) {
    define('SUPABASE_SERVICE_KEY',
        'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.' .
        'eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InZneWFkaW54YXpwa2Njamhkd3dkIiwicm9sZSI6' .
        'InNlcnZpY2Vfcm9sZSIsImlhdCI6MTc3NzM4MDQyNCwiZXhwIjoyMDkyOTU2NDI0fQ.' .
        'RMtqWZGFiudzGImlRkCfWMrYfF9hDpoNS2R1nwf8YbI'
    );
}

/**
 * Effectue un appel à l'API PostgREST de Supabase.
 *
 * @param  string      $method  GET | POST | PATCH | DELETE
 * @param  string      $path    ex: /rest/v1/certifications?order=ordre
 * @param  array|null  $body    Corps JSON (pour POST/PATCH)
 * @return array|null  Tableau PHP décodé ou null en cas d'erreur
 */
function supabase_request(string $method, string $path, ?array $body = null): ?array
{
    $url = SUPABASE_URL . $path;

    $headers = [
        'apikey: '        . SUPABASE_ANON_KEY,
        'Authorization: Bearer ' . SUPABASE_SERVICE_KEY,
        'Content-Type: application/json',
        'Accept: application/json',
    ];

    if (in_array($method, ['POST', 'PATCH'], true)) {
        $headers[] = 'Prefer: return=representation';
    }

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST  => $method,
        CURLOPT_HTTPHEADER     => $headers,
        CURLOPT_TIMEOUT        => 10,
        CURLOPT_SSL_VERIFYPEER => true,
    ]);

    if ($body !== null) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
    }

    $response = curl_exec($ch);
    $err      = curl_error($ch);
    curl_close($ch);

    if ($err || $response === false) {
        error_log('[Supabase] curl error: ' . $err);
        return null;
    }

    $decoded = json_decode($response, true);
    return is_array($decoded) ? $decoded : null;
}
