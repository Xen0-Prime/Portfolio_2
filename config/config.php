<?php
// ============================================================
//  Configuration du Portfolio — À remplir avant déploiement
// ============================================================

// --- Email de destination (où tu veux recevoir les messages) ---
define('CONTACT_EMAIL',    'narassonmohamedalykillian@gmail.com');
define('CONTACT_EMAIL_FROM', 'noreply@portfolio-killian.fr'); // expéditeur (domaine du serveur)

// --- Supabase ---
// Récupère ces valeurs sur : https://app.supabase.com → ton projet → Settings → API
define('SUPABASE_URL',     'https://vgyadinxazpkccjhdwwd.supabase.co');   // ex: https://abcdefgh.supabase.co
define('SUPABASE_ANON_KEY','sb_publishable_CEOq7NxU0FzRZ8TnnCdsxw_JI71DEiy');                          // clé "anon public"

// --- Table Supabase pour les messages de contact ---
define('SUPABASE_TABLE',   'contact_messages');

// --- Mode debug (true = affiche les erreurs, false = production) ---
define('DEBUG_MODE', false);
