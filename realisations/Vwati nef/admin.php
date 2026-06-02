<?php
require_once 'db_config.php';

/* ══════════════════════════════════════════════
   HANDLER POST — add/edit véhicule & réservation
══════════════════════════════════════════════ */
$flash = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $tab    = $_POST['tab']    ?? 'vehicules';

    try {
        switch ($action) {

            /* ── Ajouter un véhicule ── */
            case 'add_vehicule':
                $st = $pdo->prepare("
                    INSERT INTO VOITURE
                        (id_marque, id_carburant, modele, annee, cylindree, puissance_ch, prix_journalier, disponible)
                    VALUES (?,?,?,?,?,?,?,?)
                ");
                $st->execute([
                    (int)$_POST['id_marque'],
                    (int)$_POST['id_carburant'],
                    trim($_POST['modele']),
                    (int)$_POST['annee'],
                    trim($_POST['cylindree']),
                    (int)$_POST['puissance_ch'],
                    (float)$_POST['prix_journalier'],
                    (int)$_POST['disponible'],
                ]);
                break;

            /* ── Modifier un véhicule ── */
            case 'edit_vehicule':
                $st = $pdo->prepare("
                    UPDATE VOITURE
                    SET id_marque=?, id_carburant=?, modele=?, annee=?, cylindree=?,
                        puissance_ch=?, prix_journalier=?, disponible=?
                    WHERE id_voiture=?
                ");
                $st->execute([
                    (int)$_POST['id_marque'],
                    (int)$_POST['id_carburant'],
                    trim($_POST['modele']),
                    (int)$_POST['annee'],
                    trim($_POST['cylindree']),
                    (int)$_POST['puissance_ch'],
                    (float)$_POST['prix_journalier'],
                    (int)$_POST['disponible'],
                    (int)$_POST['id_voiture'],
                ]);
                break;

            /* ── Ajouter une réservation (montant calculé) ── */
            case 'add_reservation':
                $stPrix = $pdo->prepare("SELECT prix_journalier FROM VOITURE WHERE id_voiture = ?");
                $stPrix->execute([(int)$_POST['id_voiture']]);
                $prix  = (float)$stPrix->fetchColumn();
                $jours   = max(1, (int)((strtotime($_POST['date_fin']) - strtotime($_POST['date_debut'])) / 86400));
                $montant = round($prix * $jours, 2);
                $st = $pdo->prepare("
                    INSERT INTO RESERVATION
                        (id_client, id_voiture, id_statut, date_debut, date_fin, montant_total)
                    VALUES (?,?,?,?,?,?)
                ");
                $st->execute([
                    (int)$_POST['id_client'],
                    (int)$_POST['id_voiture'],
                    (int)$_POST['id_statut'],
                    $_POST['date_debut'],
                    $_POST['date_fin'],
                    $montant,
                ]);
                break;

            /* ── Modifier une réservation (montant recalculé + log statut) ── */
            case 'edit_reservation':
                $id_res = (int)$_POST['id_reservation'];
                $stPrix = $pdo->prepare("SELECT prix_journalier FROM VOITURE WHERE id_voiture = ?");
                $stPrix->execute([(int)$_POST['id_voiture']]);
                $prix   = (float)$stPrix->fetchColumn();
                $jours   = max(1, (int)((strtotime($_POST['date_fin']) - strtotime($_POST['date_debut'])) / 86400));
                $montant = round($prix * $jours, 2);

                /* Log si statut change */
                $stOld = $pdo->prepare("SELECT id_statut FROM RESERVATION WHERE id_reservation = ?");
                $stOld->execute([$id_res]);
                $old = $stOld->fetch();
                if ($old && $old['id_statut'] != (int)$_POST['id_statut']) {
                    $lg = $pdo->prepare("
                        INSERT INTO LOGS_RESERVATION
                            (id_reservation, action, champ_modifie, ancienne_valeur, nouvelle_valeur, utilisateur)
                        VALUES (?,?,?,?,?,?)
                    ");
                    $lg->execute([$id_res, 'MODIFICATION', 'id_statut',
                                  (string)$old['id_statut'], $_POST['id_statut'], 'admin@voitinef.fr']);
                }

                $st = $pdo->prepare("
                    UPDATE RESERVATION
                    SET id_client=?, id_voiture=?, id_statut=?, date_debut=?, date_fin=?, montant_total=?
                    WHERE id_reservation=?
                ");
                $st->execute([
                    (int)$_POST['id_client'],
                    (int)$_POST['id_voiture'],
                    (int)$_POST['id_statut'],
                    $_POST['date_debut'],
                    $_POST['date_fin'],
                    $montant,
                    $id_res,
                ]);
                break;
        }
    } catch (PDOException $e) {
        $flash = 'Erreur : ' . htmlspecialchars($e->getMessage());
        $tab   = $_POST['tab'] ?? 'vehicules';
    }

    if (!$flash) {
        header("Location: admin.php?tab=$tab");
        exit;
    }
}

$active_tab = $_GET['tab'] ?? 'ca';

/* ══════════════════════════════════════════════
   KPIs — Chiffre d'affaires
══════════════════════════════════════════════ */
$stmt = $pdo->query("
    SELECT
        COALESCE(SUM(r.montant_total), 0)  AS ca_total,
        COUNT(*)                            AS nb_confirmees,
        COALESCE(AVG(r.montant_total), 0)  AS panier_moyen
    FROM RESERVATION r
    JOIN STATUT_RESERVATION s ON r.id_statut = s.id_statut
    WHERE s.libelle = 'confirmée'
");
$kpi_conf = $stmt->fetch();

$stmt = $pdo->query("
    SELECT
        COUNT(*)                            AS nb_annulees,
        COALESCE(SUM(r.montant_total), 0)  AS montant_annule
    FROM RESERVATION r
    JOIN STATUT_RESERVATION s ON r.id_statut = s.id_statut
    WHERE s.libelle = 'annulée'
");
$kpi_ann = $stmt->fetch();

$total_res = $pdo->query("SELECT COUNT(*) FROM RESERVATION")->fetchColumn();

/* ── Détail réservations (onglet CA) ── */
$reservations_ca = $pdo->query("
    SELECT r.id_reservation,
           CONCAT(cl.prenom,' ',cl.nom)          AS client,
           CONCAT(m.nom_marque,' ',v.modele)     AS vehicule,
           r.date_debut, r.date_fin,
           DATEDIFF(r.date_fin, r.date_debut)    AS nb_jours,
           r.montant_total, s.libelle AS statut
    FROM RESERVATION r
    JOIN CLIENT cl            ON r.id_client  = cl.id_client
    JOIN VOITURE v            ON r.id_voiture = v.id_voiture
    JOIN MARQUE m             ON v.id_marque  = m.id_marque
    JOIN STATUT_RESERVATION s ON r.id_statut  = s.id_statut
    ORDER BY r.id_reservation
")->fetchAll();

/* ── Véhicules ── */
$vehicules = $pdo->query("
    SELECT v.*, m.nom_marque, c.type_carburant
    FROM VOITURE v
    JOIN MARQUE m    ON v.id_marque    = m.id_marque
    JOIN CARBURANT c ON v.id_carburant = c.id_carburant
    ORDER BY v.id_voiture
")->fetchAll();

/* ── Réservations ── */
$reservations = $pdo->query("
    SELECT r.id_reservation,
           cl.id_client,
           CONCAT(cl.prenom,' ',cl.nom)          AS client,
           v.id_voiture,
           CONCAT(m.nom_marque,' ',v.modele)     AS vehicule,
           r.date_debut, r.date_fin,
           r.montant_total, s.libelle AS statut,
           r.id_statut
    FROM RESERVATION r
    JOIN CLIENT cl            ON r.id_client  = cl.id_client
    JOIN VOITURE v            ON r.id_voiture = v.id_voiture
    JOIN MARQUE m             ON v.id_marque  = m.id_marque
    JOIN STATUT_RESERVATION s ON r.id_statut  = s.id_statut
    ORDER BY r.id_reservation
")->fetchAll();

/* ── Listes pour les selects ── */
$marques  = $pdo->query("SELECT id_marque, nom_marque FROM MARQUE ORDER BY nom_marque")->fetchAll();
$carbs    = $pdo->query("SELECT id_carburant, type_carburant FROM CARBURANT")->fetchAll();
$clients  = $pdo->query("SELECT id_client, CONCAT(prenom,' ',nom) AS nom_complet FROM CLIENT ORDER BY nom")->fetchAll();
$statuts  = $pdo->query("SELECT id_statut, libelle FROM STATUT_RESERVATION")->fetchAll();
$veh_list = $pdo->query("
    SELECT v.id_voiture, CONCAT(m.nom_marque,' ',v.modele) AS label, v.prix_journalier
    FROM VOITURE v JOIN MARQUE m ON v.id_marque=m.id_marque
    ORDER BY m.nom_marque, v.modele
")->fetchAll();

/* ── Logs ── */
$logs = $pdo->query("
    SELECT l.id_log, l.id_reservation,
           CONCAT(cl.prenom,' ',cl.nom) AS client,
           l.action, l.champ_modifie,
           l.ancienne_valeur, l.nouvelle_valeur,
           l.date_action, l.utilisateur
    FROM LOGS_RESERVATION l
    JOIN RESERVATION r ON l.id_reservation = r.id_reservation
    JOIN CLIENT cl     ON r.id_client      = cl.id_client
    ORDER BY l.id_log
")->fetchAll();

/* ── Helpers ── */
function fmt_money(float $v): string { return number_format($v, 2, ',', ' ') . ' €'; }
function fmt_date(string $d): string { return date('d/m/Y', strtotime($d)); }
function fmt_dt(string $d): string   { return date('d/m/Y H:i', strtotime($d)); }
function badge(string $s): string {
    $cls = match($s) { 'confirmée'=>'confirmée','annulée'=>'annulée','en attente'=>'attente','terminée'=>'terminée',default=>'attente' };
    return '<span class="badge '.$cls.'">'.htmlspecialchars(ucfirst($s)).'</span>';
}
function sel(array $items, string $valKey, string $lblKey, mixed $current, string $name, string $id=''): string {
    $idAttr = $id ? " id=\"$id\"" : '';
    $out = "<select name=\"$name\"$idAttr>";
    foreach ($items as $row) {
        $sel = ($row[$valKey] == $current) ? ' selected' : '';
        $out .= "<option value=\"".htmlspecialchars((string)$row[$valKey])."\"$sel>".htmlspecialchars((string)$row[$lblKey])."</option>";
    }
    return $out . '</select>';
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voiti Nèf — Administration</title>
    <link rel="stylesheet" href="voiti-shared.css">
    <link rel="stylesheet" href="admin.css">
</head>
<body>

<?php $current_page = 'admin'; $nav_title = 'Administration — Voiti Nèf'; include 'navbar.php'; ?>

<div class="wrapper">

    <?php if ($flash): ?>
    <div class="flash">⚠️ <?= $flash ?></div>
    <?php endif; ?>

    <div class="tabs">
        <button class="tab-btn <?= $active_tab==='ca'           ? 'active' : '' ?>" onclick="showTab('ca',this)">📊 Chiffre d'affaires</button>
        <button class="tab-btn <?= $active_tab==='vehicules'    ? 'active' : '' ?>" onclick="showTab('vehicules',this)">🚗 Véhicules</button>
        <button class="tab-btn <?= $active_tab==='reservations' ? 'active' : '' ?>" onclick="showTab('reservations',this)">📋 Réservations</button>
        <button class="tab-btn <?= $active_tab==='logs'         ? 'active' : '' ?>" onclick="showTab('logs',this)">🗂️ Logs</button>
    </div>

    <!-- ══ CA ══ -->
    <div id="tab-ca" class="section <?= $active_tab==='ca' ? 'active' : '' ?>">
        <div class="kpi-row">
            <div class="kpi-card">
                <div class="label">CA Total confirmé</div>
                <div class="value"><?= fmt_money((float)$kpi_conf['ca_total']) ?></div>
                <div class="sub">Réservations confirmées</div>
            </div>
            <div class="kpi-card">
                <div class="label">Réservations confirmées</div>
                <div class="value"><?= (int)$kpi_conf['nb_confirmees'] ?></div>
                <div class="sub">sur <?= $total_res ?> réservation<?= $total_res>1?'s':'' ?></div>
            </div>
            <div class="kpi-card">
                <div class="label">Panier moyen</div>
                <div class="value"><?= fmt_money((float)$kpi_conf['panier_moyen']) ?></div>
                <div class="sub">par réservation confirmée</div>
            </div>
            <div class="kpi-card">
                <div class="label">Réservations annulées</div>
                <div class="value" style="color:#991b1b"><?= (int)$kpi_ann['nb_annulees'] ?></div>
                <div class="sub">Montant perdu : <?= fmt_money((float)$kpi_ann['montant_annule']) ?></div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">Détail de toutes les réservations</div>
            <div class="card-body">
                <table>
                    <thead><tr><th>#</th><th>Client</th><th>Véhicule</th><th>Du</th><th>Au</th><th>Jours</th><th>Montant</th><th>Statut</th></tr></thead>
                    <tbody>
                    <?php foreach ($reservations_ca as $r): ?>
                        <tr>
                            <td><?= $r['id_reservation'] ?></td>
                            <td><?= htmlspecialchars($r['client']) ?></td>
                            <td><?= htmlspecialchars($r['vehicule']) ?></td>
                            <td><?= fmt_date($r['date_debut']) ?></td>
                            <td><?= fmt_date($r['date_fin']) ?></td>
                            <td><?= max(0,(int)$r['nb_jours']) ?></td>
                            <td><strong><?= fmt_money((float)$r['montant_total']) ?></strong></td>
                            <td><?= badge($r['statut']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr style="background:#fef2f2;">
                            <td colspan="6" style="padding:10px 14px;font-weight:700;color:#800020;">TOTAL CA CONFIRMÉ</td>
                            <td style="padding:10px 14px;font-weight:700;font-size:16px;color:#800020;"><?= fmt_money((float)$kpi_conf['ca_total']) ?></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!-- ══ VÉHICULES ══ -->
    <div id="tab-vehicules" class="section <?= $active_tab==='vehicules' ? 'active' : '' ?>">
        <div class="card">
            <div class="card-header">
                Gestion des véhicules (<?= count($vehicules) ?>)
                <button class="btn" onclick="openAddVehicule()">+ Ajouter un véhicule</button>
            </div>
            <div class="card-body">
                <table>
                    <thead><tr><th>#</th><th>Marque</th><th>Modèle</th><th>Année</th><th>Cylindrée</th><th>Puissance</th><th>Carburant</th><th>Prix/jour</th><th>Disponible</th><th>Actions</th></tr></thead>
                    <tbody>
                    <?php foreach ($vehicules as $v): ?>
                        <tr>
                            <td><?= $v['id_voiture'] ?></td>
                            <td><?= htmlspecialchars($v['nom_marque']) ?></td>
                            <td><?= htmlspecialchars($v['modele']) ?></td>
                            <td><?= $v['annee'] ?></td>
                            <td><?= htmlspecialchars($v['cylindree'] ?? '—') ?></td>
                            <td><?= $v['puissance_ch'] ? $v['puissance_ch'].' ch' : '—' ?></td>
                            <td><?= htmlspecialchars($v['type_carburant']) ?></td>
                            <td><?= fmt_money((float)$v['prix_journalier']) ?></td>
                            <td class="<?= $v['disponible'] ? 'dispo' : 'indispo' ?>"><?= $v['disponible'] ? '✔ Oui' : '✘ Non' ?></td>
                            <td>
                                <button class="btn-edit" onclick="openEditVehicule(
                                    <?= $v['id_voiture'] ?>,
                                    <?= $v['id_marque'] ?>,
                                    <?= $v['id_carburant'] ?>,
                                    '<?= addslashes(htmlspecialchars($v['modele'])) ?>',
                                    <?= $v['annee'] ?>,
                                    '<?= addslashes(htmlspecialchars($v['cylindree'] ?? '')) ?>',
                                    <?= (int)$v['puissance_ch'] ?>,
                                    <?= $v['prix_journalier'] ?>,
                                    <?= (int)$v['disponible'] ?>
                                )">✏️ Modifier</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ══ RÉSERVATIONS ══ -->
    <div id="tab-reservations" class="section <?= $active_tab==='reservations' ? 'active' : '' ?>">
        <div class="card">
            <div class="card-header">
                Gestion des réservations (<?= count($reservations) ?>)
                <button class="btn" onclick="openAddReservation()">+ Nouvelle réservation</button>
            </div>
            <div class="card-body">
                <table>
                    <thead><tr><th>#</th><th>Client</th><th>Véhicule</th><th>Date début</th><th>Date fin</th><th>Montant</th><th>Statut</th><th>Actions</th></tr></thead>
                    <tbody>
                    <?php foreach ($reservations as $r): ?>
                        <tr>
                            <td><?= $r['id_reservation'] ?></td>
                            <td><?= htmlspecialchars($r['client']) ?></td>
                            <td><?= htmlspecialchars($r['vehicule']) ?></td>
                            <td><?= fmt_date($r['date_debut']) ?></td>
                            <td><?= fmt_date($r['date_fin']) ?></td>
                            <td><?= fmt_money((float)$r['montant_total']) ?></td>
                            <td><?= badge($r['statut']) ?></td>
                            <td>
                                <button class="btn-edit" onclick="openEditReservation(
                                    <?= $r['id_reservation'] ?>,
                                    <?= $r['id_client'] ?>,
                                    <?= $r['id_voiture'] ?>,
                                    '<?= $r['date_debut'] ?>',
                                    '<?= $r['date_fin'] ?>',
                                    <?= $r['id_statut'] ?>
                                )">✏️ Modifier</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ══ LOGS ══ -->
    <div id="tab-logs" class="section <?= $active_tab==='logs' ? 'active' : '' ?>">
        <div class="card">
            <div class="card-header">Historique des modifications — Réservations (<?= count($logs) ?> entrée<?= count($logs)>1?'s':'' ?>)</div>
            <div class="card-body">
                <?php if (empty($logs)): ?>
                <p style="padding:20px;color:#64748b;">Aucun log enregistré.</p>
                <?php else: ?>
                <table>
                    <thead><tr><th>#</th><th>Réservation</th><th>Action</th><th>Champ</th><th>Ancienne valeur</th><th>Nouvelle valeur</th><th>Date</th><th>Utilisateur</th></tr></thead>
                    <tbody>
                    <?php foreach ($logs as $l): ?>
                        <tr>
                            <td><?= $l['id_log'] ?></td>
                            <td>#<?= $l['id_reservation'] ?> — <?= htmlspecialchars($l['client']) ?></td>
                            <td><span class="log-action"><?= htmlspecialchars($l['action']) ?></span></td>
                            <td><?= htmlspecialchars($l['champ_modifie'] ?? '—') ?></td>
                            <td><?= htmlspecialchars($l['ancienne_valeur'] ?? '—') ?></td>
                            <td><?= htmlspecialchars($l['nouvelle_valeur'] ?? '—') ?></td>
                            <td><?= fmt_dt($l['date_action']) ?></td>
                            <td><?= htmlspecialchars($l['utilisateur']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div><!-- /wrapper -->

<!-- ══════════════════════════════════
     MODAL VÉHICULE
═══════════════════════════════════ -->
<div class="modal-overlay" id="modal-vehicule">
    <div class="modal">
        <h2 id="veh-modal-title">🚗 Ajouter un véhicule</h2>
        <form method="post" action="admin.php">
            <input type="hidden" name="action"     id="veh-action"  value="add_vehicule">
            <input type="hidden" name="id_voiture" id="veh-id"      value="">
            <input type="hidden" name="tab"        value="vehicules">

            <div class="form-row">
                <div class="form-group">
                    <label>Marque</label>
                    <select name="id_marque" id="veh-id_marque">
                        <?php foreach ($marques as $m): ?>
                        <option value="<?= $m['id_marque'] ?>"><?= htmlspecialchars($m['nom_marque']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Modèle</label>
                    <input type="text" name="modele" id="veh-modele" placeholder="ex : A3" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Année</label>
                    <input type="number" name="annee" id="veh-annee" value="2024" min="2000" max="2030" required>
                </div>
                <div class="form-group">
                    <label>Cylindrée</label>
                    <input type="text" name="cylindree" id="veh-cylindree" placeholder="ex : 1.5L">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Puissance (ch)</label>
                    <input type="number" name="puissance_ch" id="veh-puissance_ch" placeholder="ex : 110" min="0">
                </div>
                <div class="form-group">
                    <label>Carburant</label>
                    <select name="id_carburant" id="veh-id_carburant">
                        <?php foreach ($carbs as $c): ?>
                        <option value="<?= $c['id_carburant'] ?>"><?= htmlspecialchars($c['type_carburant']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Prix / jour (€)</label>
                    <input type="number" name="prix_journalier" id="veh-prix" placeholder="ex : 75" step="0.01" min="0" required>
                </div>
                <div class="form-group">
                    <label>Disponible</label>
                    <select name="disponible" id="veh-disponible">
                        <option value="1">✔ Oui</option>
                        <option value="0">✘ Non</option>
                    </select>
                </div>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn-cancel" onclick="closeModal('modal-vehicule')">Annuler</button>
                <button type="submit" class="btn-save">💾 Enregistrer</button>
            </div>
        </form>
    </div>
</div>

<!-- ══════════════════════════════════
     MODAL RÉSERVATION
═══════════════════════════════════ -->
<div class="modal-overlay" id="modal-reservation">
    <div class="modal">
        <h2 id="res-modal-title">📋 Nouvelle réservation</h2>
        <form method="post" action="admin.php">
            <input type="hidden" name="action"         id="res-action" value="add_reservation">
            <input type="hidden" name="id_reservation" id="res-id"     value="">
            <input type="hidden" name="tab"            value="reservations">

            <div class="form-row">
                <div class="form-group">
                    <label>Client</label>
                    <select name="id_client" id="res-id_client">
                        <?php foreach ($clients as $cl): ?>
                        <option value="<?= $cl['id_client'] ?>"><?= htmlspecialchars($cl['nom_complet']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Véhicule</label>
                    <select name="id_voiture" id="res-id_voiture" onchange="calcMontant()">
                        <?php foreach ($veh_list as $vl): ?>
                        <option value="<?= $vl['id_voiture'] ?>" data-prix="<?= $vl['prix_journalier'] ?>">
                            <?= htmlspecialchars($vl['label']) ?> — <?= fmt_money((float)$vl['prix_journalier']) ?>/j
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Date début</label>
                    <input type="date" name="date_debut" id="res-date_debut" onchange="calcMontant()" required>
                </div>
                <div class="form-group">
                    <label>Date fin</label>
                    <input type="date" name="date_fin" id="res-date_fin" onchange="calcMontant()" required>
                </div>
            </div>
            <div class="montant-preview" id="montant-preview">Sélectionnez un véhicule et des dates</div>
            <div class="form-group">
                <label>Statut</label>
                <select name="id_statut" id="res-id_statut">
                    <?php foreach ($statuts as $s): ?>
                    <option value="<?= $s['id_statut'] ?>"><?= htmlspecialchars(ucfirst($s['libelle'])) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn-cancel" onclick="closeModal('modal-reservation')">Annuler</button>
                <button type="submit" class="btn-save">💾 Enregistrer</button>
            </div>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>

<script>
/* ── Navigation onglets ── */
function showTab(name, btn) {
    document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.getElementById('tab-' + name).classList.add('active');
    btn.classList.add('active');
    history.replaceState(null, '', '?tab=' + name);
}

function openModal(id)  { document.getElementById(id).classList.add('open'); }
function closeModal(id) { document.getElementById(id).classList.remove('open'); }

document.querySelectorAll('.modal-overlay').forEach(overlay => {
    overlay.addEventListener('click', e => { if (e.target === overlay) overlay.classList.remove('open'); });
});

/* ════════════════════════
   MODAL VÉHICULE
════════════════════════ */
function openAddVehicule() {
    document.getElementById('veh-modal-title').textContent = '🚗 Ajouter un véhicule';
    document.getElementById('veh-action').value = 'add_vehicule';
    document.getElementById('veh-id').value = '';
    // Reset form fields
    document.getElementById('veh-modele').value    = '';
    document.getElementById('veh-annee').value     = '2024';
    document.getElementById('veh-cylindree').value = '';
    document.getElementById('veh-puissance_ch').value = '';
    document.getElementById('veh-prix').value      = '';
    document.getElementById('veh-id_marque').selectedIndex   = 0;
    document.getElementById('veh-id_carburant').selectedIndex = 0;
    document.getElementById('veh-disponible').value = '1';
    openModal('modal-vehicule');
}

function openEditVehicule(id, id_marque, id_carburant, modele, annee, cylindree, puissance, prix, disponible) {
    document.getElementById('veh-modal-title').textContent = '✏️ Modifier le véhicule';
    document.getElementById('veh-action').value     = 'edit_vehicule';
    document.getElementById('veh-id').value         = id;
    document.getElementById('veh-id_marque').value  = id_marque;
    document.getElementById('veh-id_carburant').value = id_carburant;
    document.getElementById('veh-modele').value     = modele;
    document.getElementById('veh-annee').value      = annee;
    document.getElementById('veh-cylindree').value  = cylindree;
    document.getElementById('veh-puissance_ch').value = puissance;
    document.getElementById('veh-prix').value       = prix;
    document.getElementById('veh-disponible').value = disponible;
    openModal('modal-vehicule');
}

/* ════════════════════════
   MODAL RÉSERVATION
════════════════════════ */
function openAddReservation() {
    document.getElementById('res-modal-title').textContent = '📋 Nouvelle réservation';
    document.getElementById('res-action').value = 'add_reservation';
    document.getElementById('res-id').value     = '';
    document.getElementById('res-id_client').selectedIndex   = 0;
    document.getElementById('res-id_voiture').selectedIndex  = 0;
    document.getElementById('res-id_statut').selectedIndex   = 0;
    document.getElementById('res-date_debut').value = '';
    document.getElementById('res-date_fin').value   = '';
    document.getElementById('montant-preview').textContent = 'Sélectionnez un véhicule et des dates';
    openModal('modal-reservation');
}

function openEditReservation(id, id_client, id_voiture, date_debut, date_fin, id_statut) {
    document.getElementById('res-modal-title').textContent = '✏️ Modifier la réservation #' + id;
    document.getElementById('res-action').value      = 'edit_reservation';
    document.getElementById('res-id').value          = id;
    document.getElementById('res-id_client').value   = id_client;
    document.getElementById('res-id_voiture').value  = id_voiture;
    document.getElementById('res-date_debut').value  = date_debut;
    document.getElementById('res-date_fin').value    = date_fin;
    document.getElementById('res-id_statut').value   = id_statut;
    calcMontant();
    openModal('modal-reservation');
}

/* ════════════════════════
   Calcul montant auto
════════════════════════ */
function calcMontant() {
    const sel   = document.getElementById('res-id_voiture');
    const deb   = document.getElementById('res-date_debut').value;
    const fin   = document.getElementById('res-date_fin').value;
    const prev  = document.getElementById('montant-preview');

    if (!sel.value || !deb || !fin) {
        prev.textContent = 'Sélectionnez un véhicule et des dates';
        return;
    }

    const prix  = parseFloat(sel.options[sel.selectedIndex].dataset.prix);
    const ms    = new Date(fin) - new Date(deb);
    const jours = Math.max(1, Math.round(ms / 86400000));

    if (isNaN(prix) || ms <= 0) {
        prev.textContent = 'Dates invalides';
        return;
    }

    const total = (prix * jours).toFixed(2).replace('.', ',');
    prev.textContent = `${jours} jour${jours>1?'s':''} × ${prix.toFixed(2).replace('.',',')} €/j = ${total} €`;
}
</script>

</body>
</html>
