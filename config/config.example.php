<?php
// Copie ce fichier en config.php et remplis les valeurs
// Ne commite JAMAIS config.php (il est dans .gitignore)

define('CONTACT_EMAIL',      'ton.email@example.com');
define('CONTACT_EMAIL_FROM', 'noreply@tondomaine.com');

// Supabase → Settings → API
define('SUPABASE_URL',      'https://xxxxxxxxxxxx.supabase.co');
define('SUPABASE_ANON_KEY', 'sb_publishable_XXXXXXXXXXXXXXXXXXXX');
define('SUPABASE_TABLE',    'contact_messages');

define('DEBUG_MODE', false);
