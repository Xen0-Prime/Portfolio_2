<?php
// ── Connexion PDO — voiti_nef ─────────────────────────────────────────────
$host   = 'localhost';
$dbname = 'voiti_nef';
$user   = 'root';
$pass   = '';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
} catch (PDOException $e) {
    die('<p style="color:red;font-family:Arial;padding:20px;">
        Erreur de connexion à la base de données : ' . htmlspecialchars($e->getMessage()) . '
    </p>');
}
