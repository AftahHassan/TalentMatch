## 1. Installation de Laravel Breeze

- [x] 1.1 Installer le package Breeze via Composer : `composer require laravel/breeze`
- [x] 1.2 Installer la stack Blade avec Alpine.js : `php artisan breeze:install blade`
- [x] 1.3 Compiler les assets frontend : `npm install && npm run build`
- [x] 1.4 Exécuter les migrations : `php artisan migrate`
- [x] 1.5 Vérifier que les routes `/login`, `/register` et `/logout` fonctionnent

## 2. Configuration des routes protégées

- [x] 2.1 Définir `HOME` dans `RouteServiceProvider` à `/offres` (modifié dans AuthenticatedSessionController et RegisteredUserController)
- [x] 2.2 Ajouter le middleware `auth` au groupe de routes des offres dans `routes/web.php`
- [x] 2.3 Ajouter le middleware `auth` au groupe de routes des candidatures dans `routes/web.php`
- [x] 2.4 Ajouter le middleware `auth` au groupe de routes des analyses dans `routes/web.php`
- [x] 2.5 Vérifier qu'un utilisateur non connecté est redirigé vers `/login`

## 3. Tests d'authentification

- [x] 3.1 Vérifier que le test d'inscription passe (généré par Breeze)
- [x] 3.2 Vérifier que le test de connexion passe (généré par Breeze)
- [x] 3.3 Vérifier que le test de déconnexion passe (généré par Breeze)
- [x] 3.4 Vérifier que le test d'accès aux routes protégées passe
- [x] 3.5 Lancer la suite de tests complète : `php artisan test`
