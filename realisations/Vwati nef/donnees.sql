-- ============================================
--  VOITI NEF -- Données de référence + véhicules
-- ============================================

USE voiti_nef;

-- --------------------------------------------
-- MARQUES
-- --------------------------------------------
INSERT INTO MARQUE (nom_marque, pays_origine) VALUES
('Audi',       'Allemagne'),
('Volkswagen', 'Allemagne'),
('Citroën',    'France'),
('Fiat',       'Italie'),
('Renault',    'France'),
('Peugeot',    'France'),
('Toyota',     'Japon');

-- --------------------------------------------
-- CARBURANTS
-- --------------------------------------------
INSERT INTO CARBURANT (type_carburant) VALUES
('Diesel'),
('Essence'),
('Hybride'),
('Électrique');

-- --------------------------------------------
-- STATUTS DE RÉSERVATION
-- --------------------------------------------
INSERT INTO STATUT_RESERVATION (libelle) VALUES
('en attente'),
('confirmée'),
('annulée'),
('terminée');

-- --------------------------------------------
-- VÉHICULES (10 au total, 4 déjà sur le site)
-- --------------------------------------------

-- 1. Audi A3 (sur le site)
INSERT INTO VOITURE (id_marque, id_carburant, modele, annee, cylindree, puissance_ch, prix_journalier, image, disponible)
VALUES (1, 1, 'A3', 2023, '2.0L', 150, 95.00, 'ressources voiti nef/voitures/audi_a3.png', TRUE);

-- 2. Volkswagen Polo (sur le site)
INSERT INTO VOITURE (id_marque, id_carburant, modele, annee, cylindree, puissance_ch, prix_journalier, image, disponible)
VALUES (2, 2, 'Polo', 2023, '1.0L', 95, 60.00, 'ressources voiti nef/voitures/vw_polo-.png', TRUE);

-- 3. Citroën C3 (sur le site)
INSERT INTO VOITURE (id_marque, id_carburant, modele, annee, cylindree, puissance_ch, prix_journalier, image, disponible)
VALUES (3, 2, 'C3', 2023, '1.2L', 110, 55.00, 'ressources voiti nef/voitures/citroen_c3.png', TRUE);

-- 4. Fiat 500 (sur le site)
INSERT INTO VOITURE (id_marque, id_carburant, modele, annee, cylindree, puissance_ch, prix_journalier, image, disponible)
VALUES (4, 3, '500', 2023, '1.0L Hybride', 70, 50.00, 'ressources voiti nef/voitures/fiat_500.png', TRUE);

-- 5. Renault Clio
INSERT INTO VOITURE (id_marque, id_carburant, modele, annee, cylindree, puissance_ch, prix_journalier, image, disponible)
VALUES (5, 2, 'Clio', 2023, '1.0L', 90, 52.00, 'ressources voiti nef/voitures/renault_clio.png', TRUE);

-- 6. Renault Zoé (électrique)
INSERT INTO VOITURE (id_marque, id_carburant, modele, annee, cylindree, puissance_ch, prix_journalier, image, disponible)
VALUES (5, 4, 'Zoé', 2023, 'Électrique', 109, 70.00, 'ressources voiti nef/voitures/renault_zoe.png', TRUE);

-- 7. Peugeot 208
INSERT INTO VOITURE (id_marque, id_carburant, modele, annee, cylindree, puissance_ch, prix_journalier, image, disponible)
VALUES (6, 2, '208', 2023, '1.2L', 100, 58.00, 'ressources voiti nef/voitures/peugeot_208.png', TRUE);

-- 8. Peugeot 3008
INSERT INTO VOITURE (id_marque, id_carburant, modele, annee, cylindree, puissance_ch, prix_journalier, image, disponible)
VALUES (6, 3, '3008', 2023, '1.6L Hybride', 225, 110.00, 'ressources voiti nef/voitures/peugeot_3008.png', TRUE);

-- 9. Toyota Yaris
INSERT INTO VOITURE (id_marque, id_carburant, modele, annee, cylindree, puissance_ch, prix_journalier, image, disponible)
VALUES (7, 3, 'Yaris', 2023, '1.5L', 116, 65.00, 'ressources voiti nef/voitures/toyota_yaris.png', TRUE);

-- 10. Volkswagen Golf
INSERT INTO VOITURE (id_marque, id_carburant, modele, annee, cylindree, puissance_ch, prix_journalier, image, disponible)
VALUES (2, 1, 'Golf', 2023, '2.0L TDI', 150, 80.00, 'ressources voiti nef/voitures/vw_golf.png', TRUE);

-- --------------------------------------------
-- CLIENTS (exemples)
-- --------------------------------------------
INSERT INTO CLIENT (nom, prenom, email, telephone, date_inscription) VALUES
('Martin',   'Sophie',  'sophie.martin@email.com',   '0690123456', '2024-01-10'),
('Dubois',   'Luca',    'luca.dubois@email.com',     '0690234567', '2024-02-15'),
('Bernard',  'Emma',    'emma.bernard@email.com',    '0690345678', '2024-03-05'),
('Leroy',    'Nathan',  'nathan.leroy@email.com',    '0690456789', '2024-04-20'),
('Moreau',   'Chloé',   'chloe.moreau@email.com',    '0690567890', '2024-05-08');

-- --------------------------------------------
-- RÉSERVATIONS (exemples)
-- --------------------------------------------
INSERT INTO RESERVATION (id_client, id_voiture, id_statut, date_debut, date_fin, montant_total, date_creation) VALUES
(1, 1, 2, '2024-06-01', '2024-06-05', 380.00,  '2024-05-20 10:00:00'),
(2, 3, 2, '2024-06-10', '2024-06-12', 110.00,  '2024-06-01 14:30:00'),
(3, 5, 2, '2024-07-01', '2024-07-07', 364.00,  '2024-06-15 09:00:00'),
(4, 2, 3, '2024-07-05', '2024-07-08', 180.00,  '2024-06-20 11:00:00'),
(5, 8, 2, '2024-08-01', '2024-08-04', 330.00,  '2024-07-10 16:00:00'),
(1, 6, 2, '2024-08-10', '2024-08-15', 350.00,  '2024-07-25 08:30:00');

-- --------------------------------------------
-- AVIS (exemples)
-- --------------------------------------------
INSERT INTO AVIS (id_client, id_voiture, note, commentaire, date_avis, valide) VALUES
(1, 1, 5, 'Excellente voiture, très confortable pour un road trip !', '2024-06-06 10:00:00', TRUE),
(2, 3, 4, 'Bonne petite citadine, économique. Manque un peu de puissance.', '2024-06-13 15:00:00', TRUE),
(3, 5, 5, 'La Clio est parfaite pour la Guadeloupe, maniable et fiable.', '2024-07-08 09:00:00', TRUE),
(4, 2, 3, 'Correct mais sans plus. Finition un peu décevante.', '2024-07-09 11:00:00', FALSE),
(5, 8, 5, 'Le 3008 hybride est impressionnant. Très satisfaite !', '2024-08-05 14:00:00', TRUE),
(1, 6, 4, 'Zoé électrique : parfaite en ville, autonomie suffisante.', '2024-08-16 10:30:00', TRUE);

-- --------------------------------------------
-- LOGS (exemples)
-- --------------------------------------------
INSERT INTO LOGS_RESERVATION (id_reservation, action, champ_modifie, ancienne_valeur, nouvelle_valeur, date_action, utilisateur) VALUES
(4, 'MODIFICATION', 'id_statut',    '2', '3',            '2024-06-21 09:15:00', 'admin@voitinef.fr'),
(4, 'MODIFICATION', 'montant_total','180.00', '0.00',     '2024-06-21 09:15:00', 'admin@voitinef.fr'),
(1, 'MODIFICATION', 'date_fin',     '2024-06-04', '2024-06-05', '2024-05-21 11:00:00', 'admin@voitinef.fr');
