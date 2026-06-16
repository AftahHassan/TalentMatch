## Context

US2 a créé le modèle `Offre`, le controller et les vues. La méthode `index` du controller et la vue `index.blade.php` sont des placeholders vides.

## Goals / Non-Goals

**Goals:**
- Implémenter `OffreController@index` pour lister les offres de l'utilisateur connecté
- Afficher le nombre d'analyses (candidatures) par offre via `withCount`
- Afficher un message si aucune offre
- Ajouter un bouton "Nouvelle offre" depuis la liste

**Non-Goals:**
- Pagination (pas nécessaire pour MVP)
- Filtres ou tri avancé

## Decisions

1. **`withCount('analyses')`** — Utilisation de la relation `analyses` (définie dans config.yaml : Offre hasMany Analyse). Comme la table `analyses` n'existe pas encore, la colonne sera 0 pour chaque offre.

2. **Requête filtrée** — `$request->user()->offres()->withCount('analyses')->latest()->get()` pour n'afficher que les offres du user connecté.

3. **Vue liste** — Table simple avec colonnes : titre, nombre d'analyses, niveau d'expérience, date de création.

## Risks / Trade-offs

- [Relation analyses manquante] → La relation `analyses` sur le modèle Offre n'existe pas encore (sera créée dans US5). `withCount` échouera si la méthode `analyses()` n'est pas définie. Ajouter la relation dès maintenant pour que US3 fonctionne.
