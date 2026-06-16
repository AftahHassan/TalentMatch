## Why

Après avoir créé des offres (US2), l'agent RH a besoin de voir la liste de ses offres sur le tableau de bord pour naviguer et gérer ses recrutements.

## What Changes

- Implémentation de la méthode `index` dans `OffreController`
- Liste des offres filtrée par utilisateur connecté
- Affichage du nombre d'analyses (candidatures) par offre via `withCount`
- Message "Aucune offre" si la liste est vide
- Lien vers la création d'offre depuis la liste

## Capabilities

### New Capabilities
<!-- Aucune nouvelle capacité — modification de gestion-offres -->

### Modified Capabilities
- `gestion-offres`: Ajout du listing des offres avec compteur d'analyses et message si aucune offre

## Impact

- `app/Http/Controllers/OffreController.php` : implémentation de `index()`
- `resources/views/offres/index.blade.php` : remplacement du placeholder par la liste dynamique
- `tests/Feature/OffreTest.php` : ajout de tests pour le listing
