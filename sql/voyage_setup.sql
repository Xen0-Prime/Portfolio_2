-- ══════════════════════════════════════════════════════════════════════════
--  Base : killiannarasson_voyage  (MySQL / AlwaysData)
--  Schéma reconstruit depuis l'analyse du code source de Projet_Voyage
-- ══════════════════════════════════════════════════════════════════════════

SET NAMES utf8mb4;
SET foreign_key_checks = 0;

-- ── destination ────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS destination (
    id_destination INT          NOT NULL AUTO_INCREMENT,
    nom            VARCHAR(100) NOT NULL,
    description    TEXT,
    PRIMARY KEY (id_destination)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ── voyage ─────────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS voyage (
    id_voyage      INT            NOT NULL AUTO_INCREMENT,
    id_destination INT            NOT NULL,
    date_depart    DATE           NOT NULL,
    date_retour    DATE           NOT NULL,
    prix           DECIMAL(8,2)   NOT NULL,
    PRIMARY KEY (id_voyage),
    FOREIGN KEY (id_destination) REFERENCES destination(id_destination)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ── utilisateur ────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS utilisateur (
    id_utilisateur  INT          NOT NULL AUTO_INCREMENT,
    nom             VARCHAR(100) NOT NULL,
    email           VARCHAR(150),
    date_inscription DATE        NOT NULL DEFAULT (CURRENT_DATE),
    PRIMARY KEY (id_utilisateur)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ── avis ───────────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS avis (
    id_avis        INT  NOT NULL AUTO_INCREMENT,
    id_utilisateur INT  NOT NULL,
    commentaire    TEXT NOT NULL,
    note           TINYINT NOT NULL CHECK (note BETWEEN 1 AND 5),
    date_avis      DATE    NOT NULL DEFAULT (CURRENT_DATE),
    PRIMARY KEY (id_avis),
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id_utilisateur)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ── reservations ───────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS reservations (
    id               INT          NOT NULL AUTO_INCREMENT,
    nom              VARCHAR(100) NOT NULL,
    email            VARCHAR(150) NOT NULL,
    voyage_id        INT          NOT NULL,
    date_reservation DATE         NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (voyage_id) REFERENCES voyage(id_voyage)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ── messages ───────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS messages (
    id         INT          NOT NULL AUTO_INCREMENT,
    nom        VARCHAR(100) NOT NULL,
    email      VARCHAR(150) NOT NULL,
    message    TEXT         NOT NULL,
    date_envoi DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

SET foreign_key_checks = 1;

-- ══════════════════════════════════════════════════════════════════════════
--  Données de démonstration
-- ══════════════════════════════════════════════════════════════════════════

-- destinations (correspond aux images présentes dans img_destination/)
INSERT INTO destination (nom, description) VALUES
('Paris',    'La Ville Lumière vous accueille avec ses musées, sa gastronomie et la célèbre Tour Eiffel. Un incontournable du voyage en Europe.'),
('Londres',  'Capitale cosmopolite mêlant tradition royale et modernité. Big Ben, Buckingham Palace et une scène culturelle unique.'),
('New York', 'La ville qui ne dort jamais : Times Square, Central Park, la Statue de la Liberté et une énergie incomparable.'),
('Tokyo',    'Métropole fascinante entre ultra-modernité et traditions ancestrales. Temples, quartiers tendance et gastronomie d\'exception.'),
('Sydney',   'Soleil, plages dorées, l\'Opéra iconique et une nature sauvage à portée de main. Le joyau de l\'Australie.');

-- voyages (prix en euros, séjours 7-14 jours)
INSERT INTO voyage (id_destination, date_depart, date_retour, prix) VALUES
(1, '2026-07-01', '2026-07-08', 649.00),
(1, '2026-08-15', '2026-08-22', 699.00),
(2, '2026-06-20', '2026-06-27', 749.00),
(3, '2026-09-05', '2026-09-19', 1190.00),
(4, '2026-10-10', '2026-10-24', 1350.00),
(5, '2026-12-01', '2026-12-15', 1580.00),
(2, '2026-11-03', '2026-11-10', 720.00),
(3, '2026-07-20', '2026-08-03', 1250.00);

-- utilisateurs
INSERT INTO utilisateur (nom, email, date_inscription) VALUES
('Sophie Martin',   'sophie.martin@example.com',  '2024-11-15'),
('Lucas Dupont',    'lucas.dupont@example.com',   '2025-01-08'),
('Amélie Rousseau', 'amelie.rousseau@example.com', '2025-03-22');

-- avis
INSERT INTO avis (id_utilisateur, commentaire, note, date_avis) VALUES
(1, 'Séjour à Paris absolument magique ! L\'organisation était parfaite, les hôtels bien situés. Je recommande vivement TravelNow pour un weekend en amoureux.', 5, '2025-04-10'),
(2, 'New York était sur ma liste depuis longtemps. TravelNow a rendu ça accessible avec un prix très compétitif. Visite de Central Park et de Brooklyn mémorables.', 4, '2025-05-03'),
(3, 'Tokyo m\'a complètement dépaysée. Les conseils inclus dans le pack ont été précieux pour naviguer dans la ville. Expérience 5 étoiles !', 5, '2025-05-20');
