## Context

Le projet TalentMatch est fraîchement installé avec Laravel 13. Aucun système d'authentification n'est encore en place. La config OpenSpec spécifie Laravel Breeze (Blade) comme stack d'authentification. Les fonctionnalités métier (offres, candidatures, analyses) nécessitent un utilisateur connecté.

## Goals / Non-Goals

**Goals:**
- Installer Laravel Breeze (Blade stack avec Alpine.js)
- Configurer l'authentification complète (register, login, logout, password reset)
- Protéger les routes métier par le middleware `auth`
- Rediriger vers `/offres` après connexion

**Non-Goals:**
- Personnalisation des vues Breeze (design par défaut)
- Rôles utilisateurs (admin vs RH)
- Authentification via API (Sanctum/Passport)

## Decisions

1. **Stack Breeze : Blade + Alpine.js** — Stack la plus légère, pas de dépendance Livewire ou Inertia. Correspond au config.yaml.

2. **Redirection post-login vers `/offres`** — Le dashboard RH par défaut est la liste des offres. Modifier `redirectTo` dans les contrôleurs `AuthenticatedSessionController` et `RegisteredUserController`, ou utiliser `HomeController` avec `RouteServiceProvider::HOME`.

3. **Migration `users` par défaut** — Utilisée telle quelle par Breeze. Aucune modification nécessaire.

4. **Protection des routes** — Middleware `auth` appliqué via `Route::middleware('auth')` dans `web.php` pour les groupes offres, candidatures, analyses.

## Risks / Trade-offs

- [Breeze version] → Laravel 13 peut nécessiter une version spécifique de Breeze. Utiliser `composer require laravel/breeze` sans version pour obtenir la plus récente compatible.
- [Vues écrasées] → Si Breeze est réinstallé, les vues personnalisées pourraient être écrasées. Aucune personnalisation prévue pour US1, ce n'est pas un problème.
- [Routes non protégées] → Risque qu'une nouvelle route soit ajoutée sans le middleware `auth`. Mitigation : ajouter une règle dans le groupe `Route::middleware('auth')` par défaut.
