-- ============================================
--  VOITI NEF -- Script de création de la base
-- ============================================

CREATE DATABASE IF NOT EXISTS voiti_nef
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE voiti_nef;

-- --------------------------------------------
-- 1. MARQUE
-- --------------------------------------------
CREATE TABLE MARQUE (
    id_marque    INT          NOT NULL AUTO_INCREMENT,
    nom_marque   VARCHAR(50)  NOT NULL,
    pays_origine VARCHAR(50),
    CONSTRAINT PK_MARQUE PRIMARY KEY (id_marque)
);

-- --------------------------------------------
-- 2. CARBURANT
-- --------------------------------------------
CREATE TABLE CARBURANT (
    id_carburant   INT         NOT NULL AUTO_INCREMENT,
    type_carburant VARCHAR(30) NOT NULL,
    CONSTRAINT PK_CARBURANT PRIMARY KEY (id_carburant)
);

-- --------------------------------------------
-- 3. VOITURE
-- --------------------------------------------
CREATE TABLE VOITURE (
    id_voiture     INT            NOT NULL AUTO_INCREMENT,
    id_marque      INT            NOT NULL,
    id_carburant   INT            NOT NULL,
    modele         VARCHAR(100)   NOT NULL,
    annee          YEAR           NOT NULL,
    cylindree      VARCHAR(20),
    puissance_ch   INT,
    prix_journalier DECIMAL(8,2)  NOT NULL,
    image          VARCHAR(255),
    disponible     BOOLEAN        NOT NULL DEFAULT TRUE,
    CONSTRAINT PK_VOITURE   PRIMARY KEY (id_voiture),
    CONSTRAINT FK_VOI_MAR   FOREIGN KEY (id_marque)    REFERENCES MARQUE(id_marque),
    CONSTRAINT FK_VOI_CAR   FOREIGN KEY (id_carburant) REFERENCES CARBURANT(id_carburant)
);

-- --------------------------------------------
-- 4. CLIENT
-- --------------------------------------------
CREATE TABLE CLIENT (
    id_client        INT          NOT NULL AUTO_INCREMENT,
    nom              VARCHAR(50)  NOT NULL,
    prenom           VARCHAR(50)  NOT NULL,
    email            VARCHAR(100) NOT NULL UNIQUE,
    telephone        VARCHAR(20),
    date_inscription DATE         NOT NULL DEFAULT (CURRENT_DATE),
    CONSTRAINT PK_CLIENT PRIMARY KEY (id_client)
);

-- --------------------------------------------
-- 5. STATUT_RESERVATION
-- --------------------------------------------
CREATE TABLE STATUT_RESERVATION (
    id_statut INT         NOT NULL AUTO_INCREMENT,
    libelle   VARCHAR(30) NOT NULL,
    CONSTRAINT PK_STATUT PRIMARY KEY (id_statut)
);

-- --------------------------------------------
-- 6. RESERVATION
-- --------------------------------------------
CREATE TABLE RESERVATION (
    id_reservation INT            NOT NULL AUTO_INCREMENT,
    id_client      INT            NOT NULL,
    id_voiture     INT            NOT NULL,
    id_statut      INT            NOT NULL,
    date_debut     DATE           NOT NULL,
    date_fin       DATE           NOT NULL,
    montant_total  DECIMAL(10,2)  NOT NULL,
    date_creation  DATETIME       NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT PK_RESERVATION  PRIMARY KEY (id_reservation),
    CONSTRAINT FK_RES_CLI      FOREIGN KEY (id_client)  REFERENCES CLIENT(id_client),
    CONSTRAINT FK_RES_VOI      FOREIGN KEY (id_voiture) REFERENCES VOITURE(id_voiture),
    CONSTRAINT FK_RES_STA      FOREIGN KEY (id_statut)  REFERENCES STATUT_RESERVATION(id_statut)
);

-- --------------------------------------------
-- 7. AVIS
-- --------------------------------------------
CREATE TABLE AVIS (
    id_avis      INT      NOT NULL AUTO_INCREMENT,
    id_client    INT      NOT NULL,
    id_voiture   INT      NOT NULL,
    note         TINYINT  NOT NULL CHECK (note BETWEEN 1 AND 5),
    commentaire  TEXT,
    date_avis    DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    valide       BOOLEAN  NOT NULL DEFAULT FALSE,
    CONSTRAINT PK_AVIS    PRIMARY KEY (id_avis),
    CONSTRAINT FK_AVI_CLI FOREIGN KEY (id_client)  REFERENCES CLIENT(id_client),
    CONSTRAINT FK_AVI_VOI FOREIGN KEY (id_voiture) REFERENCES VOITURE(id_voiture)
);

-- --------------------------------------------
-- 8. LOGS_RESERVATION
-- --------------------------------------------
CREATE TABLE LOGS_RESERVATION (
    id_log          INT          NOT NULL AUTO_INCREMENT,
    id_reservation  INT          NOT NULL,
    action          VARCHAR(50)  NOT NULL,
    champ_modifie   VARCHAR(50),
    ancienne_valeur TEXT,
    nouvelle_valeur TEXT,
    date_action     DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    utilisateur     VARCHAR(100) NOT NULL,
    CONSTRAINT PK_LOG    PRIMARY KEY (id_log),
    CONSTRAINT FK_LOG_RES FOREIGN KEY (id_reservation) REFERENCES RESERVATION(id_reservation)
);

-- ============================================
--  REQUETES METIER
-- ============================================

-- Chiffre d'affaires des réservations confirmées
SELECT SUM(R.montant_total) AS chiffre_affaires
FROM RESERVATION R
JOIN STATUT_RESERVATION S ON R.id_statut = S.id_statut
WHERE S.libelle = 'confirmée';

-- Note moyenne des avis validés
SELECT AVG(note) AS note_moyenne
FROM AVIS
WHERE valide = TRUE;

-- Historique des modifications d'une réservation (ex : id = 1)
SELECT date_action, utilisateur, action, champ_modifie,
       ancienne_valeur, nouvelle_valeur
FROM LOGS_RESERVATION
WHERE id_reservation = 1
ORDER BY date_action DESC;
