## Why

L'agent RH doit pouvoir consulter le détail complet d'une offre, voir les candidatures soumises avec leur score et recommandation, et être protégé par la policy (seul le propriétaire y accède).

## What Changes

- Application de la `OffrePolicy@view` sur la route show
- Mise à jour de la vue `offres/show.blade.php` avec la liste des candidatures (analyses) 
- Affichage du score et du badge de recommandation pour chaque candidature
- Ajout du lien "Soumettre un CV" depuis le détail

## Capabilities

### New Capabilities
<!-- Aucune nouvelle capacité -->

### Modified Capabilities
- `gestion-offres`: Ajout de l'affichage des candidatures avec scores et recommandations sur la page détail

## Impact

- `app/Http/Controllers/OffreController.php` : application de `Gate::authorize('view', $offre)` dans `show()`
- `resources/views/offres/show.blade.php` : ajout de la liste des candidatures avec score et badge
- `tests/Feature/OffreTest.php` : test de la policy (accès refusé si pas propriétaire)
