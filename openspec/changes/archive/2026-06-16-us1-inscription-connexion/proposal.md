## Why

Le projet TalentMatch nécessite un système d'authentification pour que les agents RH puissent s'inscrire, se connecter et gérer leurs offres et analyses de manière sécurisée. Sans cela, aucune fonctionnalité métier (offres, candidatures, analyses) n'est accessible. Laravel Breeze fournit une solution légère et maintenable pour Blade.

## What Changes

- Installation de Laravel Breeze (Blade stack)
- Génération des vues d'authentification (login, register, forgot-password, reset-password, confirm-password)
- Configuration des routes d'auth protégées par le middleware `auth`
- Migration `users` déjà présente par défaut dans Laravel
- Ajout du middleware `auth` sur le groupe de routes protégées
- Redirection après connexion vers `/offres` (dashboard RH)
- Tests Pest de base pour l'authentification (inscription, connexion, déconnexion)

## Capabilities

### New Capabilities
- `user-auth`: Inscription, connexion, déconnexion, et protection des routes par middleware `auth`

### Modified Capabilities
<!-- Aucun spec existant modifié -->

## Impact

- `composer.json` : ajout de `laravel/breeze`
- `routes/auth.php` : créé par Breeze
- `app/Http/Controllers/Auth/` : créé par Breeze
- `resources/views/auth/` : vues Blade créées par Breeze
- `routes/web.php` : groupes de routes protégées par `auth`
- `Tests/Feature/Auth/` : tests d'authentification
- Aucun impact sur les modèles métier existants
