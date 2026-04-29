<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact — Portfolio BTS SIO</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/contact.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <div class="nav-brand">Portfolio</div>
            <ul class="nav-menu" id="navMenu">
                <li><a href="index.php">Accueil</a></li>
                <li><a href="projets.php">Projets</a></li>
                <li><a href="../stages/stages.php">Stages</a></li>
                <li><a href="veille.php">Veille</a></li>
                <li><a href="certifications.php">Certifications</a></li>
                <li><a href="contact.php" class="active">Contact</a></li>
            </ul>
            <div class="hamburger" id="hamburger">
                <span></span><span></span><span></span>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="page-title">Contact</h1>
            <p class="page-subtitle">Une question, une opportunité ? Écrivez-moi.</p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="section">
        <div class="container">
            <div class="contact-wrapper">

                <!-- ====== FORMULAIRE ====== -->
                <div>
                    <!-- Alerte succès / erreur -->
                    <div id="alert-success" class="form-alert success" role="alert">
                        <span class="alert-icon">✓</span>
                        <span id="alert-success-msg">Message envoyé avec succès ! Je vous répondrai dès que possible.</span>
                    </div>
                    <div id="alert-error" class="form-alert error" role="alert">
                        <span class="alert-icon">✕</span>
                        <span id="alert-error-msg">Une erreur est survenue. Veuillez réessayer.</span>
                    </div>

                    <form id="contactForm" class="contact-form" novalidate>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">Nom complet <span class="required">*</span></label>
                                <input type="text" id="name" name="name" placeholder="Votre nom" autocomplete="name" required>
                                <span class="field-error" id="err-name">Veuillez entrer votre nom.</span>
                            </div>
                            <div class="form-group">
                                <label for="email">Email <span class="required">*</span></label>
                                <input type="email" id="email" name="email" placeholder="example@email.com" autocomplete="email" required>
                                <span class="field-error" id="err-email">Adresse email invalide.</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="subject">Sujet</label>
                            <input type="text" id="subject" name="subject" placeholder="Proposition de stage, question…">
                        </div>

                        <div class="form-group">
                            <label for="message">Message <span class="required">*</span></label>
                            <textarea id="message" name="message" placeholder="Votre message…" required></textarea>
                            <span class="field-error" id="err-message">Le message doit contenir au moins 10 caractères.</span>
                        </div>

                        <button type="submit" class="btn-submit" id="submitBtn">
                            <span class="spinner"></span>
                            <span class="btn-text">Envoyer le message →</span>
                        </button>

                    </form>
                </div>

                <!-- ====== INFOS CONTACT ====== -->
                <div class="contact-info-card">
                    <h3><i class="fas fa-address-card" style="color:var(--secondary-color);margin-right:.5rem"></i>Coordonnées</h3>
                    <div class="contact-info-items">

                        <div class="contact-info-item">
                            <div class="ci-icon"><i class="fas fa-envelope"></i></div>
                            <div>
                                <span class="ci-label">Email</span>
                                <a href="mailto:knarassonmohamedaly@gmail.com">
                                    knarassonmohamedaly@gmail.com
                                </a>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <div class="ci-icon"><i class="fab fa-github"></i></div>
                            <div>
                                <span class="ci-label">GitHub</span>
                                <a href="https://github.com/Xen0-Prime" target="_blank" rel="noopener noreferrer">
                                    github.com/Xen0-Prime
                                </a>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <div class="ci-icon"><i class="fas fa-map-marker-alt"></i></div>
                            <div>
                                <span class="ci-label">Localisation</span>
                                Guadeloupe, France
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <div class="ci-icon"><i class="fab fa-linkedin"></i></div>
                            <div>
                                <span class="ci-label">LinkedIn</span>
                                <a href="https://www.linkedin.com/in/killian-narasson-mohamedaly-6b3b9134b" target="_blank" rel="noopener">
                                    Linkedin
                                </a>
                            </div>

                    </div>

                    <div class="contact-dispo">
                        <strong>Disponibilité</strong><br>
                        Actuellement en BTS SIO SLAM (2024–2026).<br>
                        Ouvert aux opportunités de stage et aux collaborations.
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 Portfolio BTS SIO SLAM · Killian Narasson Mohamedaly</p>
        </div>
    </footer>

    <script src="../js/script.js"></script>
    <script>
    // ===== Validation & soumission AJAX =====
    const form       = document.getElementById('contactForm');
    const submitBtn  = document.getElementById('submitBtn');
    const alertOk    = document.getElementById('alert-success');
    const alertErr   = document.getElementById('alert-error');
    const alertOkMsg = document.getElementById('alert-success-msg');
    const alertErrMsg= document.getElementById('alert-error-msg');

    function showAlert(type, msg) {
        alertOk.classList.remove('visible');
        alertErr.classList.remove('visible');
        if (type === 'success') { alertOkMsg.textContent = msg; alertOk.classList.add('visible'); }
        else                    { alertErrMsg.textContent = msg; alertErr.classList.add('visible'); }
        alertOk.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    function clearErrors() {
        document.querySelectorAll('.field-error').forEach(e => e.classList.remove('visible'));
        document.querySelectorAll('.error').forEach(e => e.classList.remove('error'));
    }

    function validateField(id, errId, condition) {
        const input = document.getElementById(id);
        const err   = document.getElementById(errId);
        if (!condition(input.value)) {
            input.classList.add('error');
            err.classList.add('visible');
            return false;
        }
        return true;
    }

    function validate() {
        let ok = true;
        ok = validateField('name',    'err-name',    v => v.trim().length >= 2)    && ok;
        ok = validateField('email',   'err-email',   v => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v.trim())) && ok;
        ok = validateField('message', 'err-message', v => v.trim().length >= 10)   && ok;
        return ok;
    }

    // Effacer l'erreur au blur
    ['name','email','message'].forEach(id => {
        document.getElementById(id).addEventListener('input', () => {
            document.getElementById(id).classList.remove('error');
            document.getElementById('err-' + id).classList.remove('visible');
        });
    });

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        clearErrors();
        alertOk.classList.remove('visible');
        alertErr.classList.remove('visible');

        if (!validate()) return;

        // UI loading
        submitBtn.disabled = true;
        submitBtn.classList.add('loading');

        try {
            const resp = await fetch('contact_handler.php', {
                method: 'POST',
                body:   new FormData(form),
            });

            const data = await resp.json();

            if (data.success) {
                showAlert('success', data.message || 'Message envoyé avec succès !');
                form.reset();
            } else {
                showAlert('error', data.message || 'Une erreur est survenue.');
            }
        } catch (err) {
            showAlert('error', 'Impossible de contacter le serveur. Vérifiez votre connexion.');
        } finally {
            submitBtn.disabled = false;
            submitBtn.classList.remove('loading');
        }
    });
    </script>
</body>
</html>
