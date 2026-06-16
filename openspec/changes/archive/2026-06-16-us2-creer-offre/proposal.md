## Why

Les agents RH ont besoin de créer des offres d'emploi pour ensuite soumettre des CVs et obtenir des analyses IA. Sans cette fonctionnalité, le cœur métier de TalentMatch (matching CV/offre) est inutilisable.

## What Changes

- Création du modèle `Offre` avec les champs : titre, description, competences_requises (JSON), niveau_experience
- Formulaire de création d'offre avec validation
- Route POST `/offres` protégée par auth + OffrePolicy
- Redirection vers le détail de l'offre après création
- Rattachement automatique à l'utilisateur connecté via `user_id`

## Capabilities

### New Capabilities
- `gestion-offres`: Création d'une offre d'emploi avec validation et persistance

### Modified Capabilities
- `user-auth`: Le requirement "Rattachement des offres à l'utilisateur" est désormais implémenté par ce change

## Impact

- `app/Models/Offre.php` : nouveau modèle Eloquent
- `app/Http/Controllers/OffreController.php` : nouveau controller
- `app/Policies/OffrePolicy.php` : nouvelle policy
- `database/migrations/xxxx_create_offres_table.php` : nouvelle migration
- `resources/views/offres/create.blade.php` : formulaire de création
- `resources/views/offres/show.blade.php` : vue détail (placeholder pour US4)
- `routes/web.php` : routes POST/GET pour offres
- `tests/Feature/OffreTest.php` : tests de création
