<?php
// Copie ce fichier en supabase.php et remplis les valeurs
// Ne commite JAMAIS supabase.php (il est dans .gitignore)
// La service_role key se trouve dans Supabase → Settings → API → service_role (secret)

require_once __DIR__ . '/config.php';

if (!defined('SUPABASE_SERVICE_KEY')) {
    define('SUPABASE_SERVICE_KEY', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.XXXXXXXX.XXXXXXXX');
}

// ... (garde le reste de supabase.php identique)
