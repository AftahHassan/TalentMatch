## 1. Modèle et migration

- [x] 1.1 Créer la migration `create_offres_table` avec les champs : titre, description, competences_requises (json), niveau_experience (integer), user_id (foreignId)
- [x] 1.2 Créer le modèle `Offre` avec fillable, casts (competences_requises => array), et relation `belongsTo User`
- [x] 1.3 Exécuter les migrations : `php artisan migrate`

## 2. Controller et validation

- [x] 2.1 Créer `OffreController` avec méthodes `create` et `store`
- [x] 2.2 Ajouter les règles de validation : titre requis, description requise, competences_requises requis (array), niveau_experience requis (integer, min:0)
- [x] 2.3 Rattacher l'offre à l'utilisateur connecté via `auth()->id()`
- [x] 2.4 Rediriger vers `route('offres.show', $offre)` après création

## 3. Routes et vues

- [x] 3.1 Ajouter les routes GET `/offres/create` et POST `/offres` dans le groupe `auth` de `routes/web.php`
- [x] 3.2 Créer la vue `offres/create.blade.php` avec le formulaire (titre, description, competences_requises textarea, niveau_experience)
- [x] 3.3 Créer la vue `offres/show.blade.php` pour le détail de l'offre (placeholder pour US4)

## 4. Policy et tests

- [x] 4.1 Créer `OffrePolicy` avec méthode `create` toujours vraie pour les utilisateurs authentifiés
- [x] 4.2 Enregistrer la policy dans `AppServiceProvider`
- [x] 4.3 Créer `OffreTest` avec test de création réussie et test de validation
- [x] 4.4 Lancer la suite de tests : `php artisan test`
