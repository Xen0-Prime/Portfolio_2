<?php
// Copie ce fichier en db_config.php et remplis les valeurs
// Ne commite JAMAIS db_config.php (il est dans .gitignore)

define('DB_HOST', 'mysql-XXXXXX.alwaysdata.net');
define('DB_USER', 'XXXXXX');
define('DB_PASS', 'XXXXXX');
define('DB_NAME', 'XXXXXX_voyage');

function get_db(): mysqli {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        die("Erreur de connexion : " . $conn->connect_error);
    }
    $conn->set_charset('utf8mb4');
    return $conn;
}
