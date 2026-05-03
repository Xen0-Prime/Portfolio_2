<?php
require_once __DIR__ . '/../config/auth.php';
auth_session_start();

// Déjà connecté → dashboard
if (!empty($_SESSION['admin_logged_in'])) {
    header('Location: dashboard.php');
    exit;
}

$error     = '';
$username  = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérification CSRF
    if (!csrf_verify($_POST['csrf_token'] ?? '')) {
        $error = 'Requête invalide. Rechargez la page et réessayez.';
    } else {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if (auth_attempt($username, $password)) {
            auth_login();
            header('Location: dashboard.php');
            exit;
        } else {
            // Message volontairement vague (pas de hint username/password)
            $error = 'Identifiants incorrects.';
            // Légère pause pour ralentir le brute-force
            sleep(1);
        }
    }
}

$csrf = csrf_token();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion — Portfolio Killian Narasson</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .login-wrap {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }
        .login-card {
            width: 100%;
            max-width: 380px;
            background: var(--bg-light);
            border: 1px solid var(--border-color);
            border-radius: 14px;
            padding: 2.5rem 2rem;
            box-shadow: var(--shadow);
        }
        .login-brand {
            text-align: center;
            margin-bottom: 2rem;
        }
        .login-brand-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: rgba(14,165,233,.15);
            border: 1px solid rgba(14,165,233,.3);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto .75rem;
        }
        .login-brand-icon i {
            font-size: 1.3rem;
            color: var(--secondary-color);
        }
        .login-brand h1 {
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--primary-color);
            margin: 0 0 .2rem;
        }
        .login-brand p {
            font-family: var(--font-mono);
            font-size: 10px;
            color: var(--text-light);
            margin: 0;
            text-transform: uppercase;
            letter-spacing: .1em;
        }
        .login-error {
            background: rgba(239,68,68,.1);
            border: 1px solid rgba(239,68,68,.3);
            border-radius: 8px;
            color: #f87171;
            font-size: 13px;
            padding: .65rem .9rem;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: .5rem;
        }
        .field {
            margin-bottom: 1.1rem;
        }
        .field label {
            display: block;
            font-family: var(--font-mono);
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .1em;
            color: var(--text-light);
            margin-bottom: .4rem;
        }
        .field input {
            width: 100%;
            background: var(--bg-surface);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            color: var(--primary-color);
            font-family: var(--font-body);
            font-size: 14px;
            padding: .65rem .9rem;
            transition: border-color .2s;
            outline: none;
        }
        .field input:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 3px rgba(14,165,233,.1);
        }
        .btn-login {
            width: 100%;
            padding: .75rem;
            border-radius: 8px;
            border: none;
            background: var(--secondary-color);
            color: #fff;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            transition: opacity .2s, transform .1s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            margin-top: 1.5rem;
        }
        .btn-login:hover  { opacity: .88; }
        .btn-login:active { transform: scale(.98); }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 1.25rem;
            font-family: var(--font-mono);
            font-size: 11px;
            color: var(--text-light);
        }
        .back-link a { color: var(--text-light); }
        .back-link a:hover { color: var(--secondary-color); }
    </style>
</head>
<body>

    <!-- ─── Login card ─── -->
    <div class="login-wrap">
        <div class="login-card">

            <div class="login-brand">
                <div class="login-brand-icon">
                    <i class="fas fa-lock"></i>
                </div>
                <h1>Espace admin</h1>
                <p>Portfolio · BTS SIO SLAM</p>
            </div>

<?php if ($error): ?>
            <div class="login-error">
                <i class="fas fa-circle-exclamation"></i>
                <?= htmlspecialchars($error) ?>
            </div>
<?php endif; ?>

            <form method="POST" action="login.php" autocomplete="off">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">

                <div class="field">
                    <label for="username">Identifiant</label>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        value="<?= htmlspecialchars($username) ?>"
                        required
                        autofocus
                        autocomplete="username"
                    >
                </div>

                <div class="field">
                    <label for="password">Mot de passe</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        autocomplete="current-password"
                    >
                </div>

                <button type="submit" class="btn-login">
                    <i class="fas fa-arrow-right-to-bracket"></i>
                    Se connecter
                </button>
            </form>

            <span class="back-link">
                <a href="index.php"><i class="fas fa-arrow-left" style="font-size:.8em;"></i> Retour au portfolio</a>
            </span>

        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 Portfolio BTS SIO SLAM · Killian Narasson Mohamedaly</p>
        </div>
    </footer>

</body>
</html>
