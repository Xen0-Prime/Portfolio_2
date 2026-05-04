<?php
// ── Connexion MySQL AlwaysData ────────────────────────────────────────────────
define('DB_HOST', 'mysql-killiannarasson.alwaysdata.net');
define('DB_USER', 'killiannarasson');
define('DB_PASS', 'Ki3r9kZZ5dW7nWc');
define('DB_NAME', 'killiannarasson_voyage');

function get_db(): mysqli {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        die("Erreur de connexion : " . $conn->connect_error);
    }
    $conn->set_charset('utf8mb4');
    return $conn;
}
