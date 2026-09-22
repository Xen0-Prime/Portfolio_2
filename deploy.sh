#!/bin/bash
# Commit + push + déploiement rapide sur alwaysdata.
#
# Usage : ./deploy.sh "message de commit"
#
# Ce que ça fait :
#   1. git add -A + commit + push sur origin/main_2
#   2. Copie (scp) chaque fichier modifié par ce commit vers ~/www/ sur le serveur
#
# Le dépôt git sur le serveur (~/www/.git) est très en retard par rapport à
# GitHub (divergence historique) — `git pull` n'y fonctionne pas de façon
# fiable. Ce script copie donc directement les fichiers changés plutôt que
# de s'appuyer sur git côté serveur.
#
# Le mot de passe SSH sera demandé normalement par ssh/scp (pas besoin de
# variable d'environnement pour un usage interactif dans un vrai terminal).

set -e

REMOTE="killiannarasson@ssh-killiannarasson.alwaysdata.net"

if [ -z "$1" ]; then
    echo "Usage: ./deploy.sh \"message de commit\""
    exit 1
fi

git add -A
git commit -m "$1" || { echo "Rien à committer."; exit 1; }
git push origin main_2

echo ""
echo "── Déploiement des fichiers modifiés par ce commit ──"

FILES=$(git diff-tree --no-commit-id --name-only -r HEAD)

for f in $FILES; do
    if [ -f "$f" ]; then
        echo "→ $f"
        scp "$f" "$REMOTE:www/$f"
    else
        echo "⚠ $f a été supprimé localement — supprime-le aussi manuellement sur le serveur si besoin (pas automatique)."
    fi
done

echo ""
echo "── Terminé. Vérification syntaxe PHP côté serveur (optionnel) ──"
PHP_FILES=$(echo "$FILES" | grep '\.php$' || true)
if [ -n "$PHP_FILES" ]; then
    REMOTE_PATHS=$(echo "$PHP_FILES" | sed 's#^#www/#' | tr '\n' ' ')
    ssh "$REMOTE" "for f in $REMOTE_PATHS; do php -l \"\$f\"; done"
fi
