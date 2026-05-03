-- ══════════════════════════════════════════════════════════════════════════
--  ÉTAPE 1 — Créer la table + désactiver RLS
--  À coller dans : Supabase → SQL Editor → New query → Run
-- ══════════════════════════════════════════════════════════════════════════

CREATE TABLE IF NOT EXISTS certifications (
    id         SERIAL PRIMARY KEY,
    nom        TEXT    NOT NULL,
    emetteur   TEXT    NOT NULL DEFAULT 'OpenClassrooms',
    track      TEXT    NOT NULL CHECK (track IN ('dev', 'secu', 'culture')),
    statut     TEXT    NOT NULL CHECK (statut IN ('obtenue', 'en_cours', 'prevu')),
    progression INT    NOT NULL DEFAULT 0 CHECK (progression BETWEEN 0 AND 100),
    heures     INT     NOT NULL DEFAULT 0,
    ordre      INT     NOT NULL DEFAULT 0
);

ALTER TABLE certifications DISABLE ROW LEVEL SECURITY;


-- ══════════════════════════════════════════════════════════════════════════
--  ÉTAPE 2 — Pré-remplir avec les données actuelles
--  (9 certifications issues de pages/certifications.php)
-- ══════════════════════════════════════════════════════════════════════════

INSERT INTO certifications (nom, emetteur, track, statut, progression, heures, ordre) VALUES

-- ── Dev track ──────────────────────────────────────────────────────────────
(
    'Développez avec les agents IA à l''ère du vibe coding',
    'OpenClassrooms',
    'dev', 'obtenue', 100, 0, 1
),
(
    'Gérez du code avec Git et GitHub',
    'OpenClassrooms',
    'dev', 'en_cours', 27, 8, 2
),
(
    'Débutez avec Angular',
    'OpenClassrooms',
    'dev', 'en_cours', 0, 12, 3
),
(
    'Créez une maquette web avec Figma',
    'OpenClassrooms',
    'dev', 'prevu', 0, 10, 4
),
(
    'Débutez avec les API REST',
    'OpenClassrooms',
    'dev', 'prevu', 0, 8, 5
),

-- ── Sécu & Infra track ────────────────────────────────────────────────────
(
    'Initiez-vous à Linux',
    'OpenClassrooms',
    'secu', 'prevu', 0, 8, 6
),

-- ── Culture & Méthodes track ──────────────────────────────────────────────
(
    'Apprenez à apprendre',
    'OpenClassrooms',
    'culture', 'prevu', 0, 6, 7
),
(
    'Optimisez votre apprentissage avec l''Intelligence Artificielle',
    'OpenClassrooms',
    'culture', 'prevu', 0, 6, 8
),
(
    'Mettez en place un système de veille informationnelle',
    'OpenClassrooms',
    'culture', 'prevu', 0, 8, 9
);
