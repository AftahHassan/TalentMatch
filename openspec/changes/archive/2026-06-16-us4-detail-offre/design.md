## Context

US2 a créé le détail d'offre (placeholder) et US3 la liste. La `OffrePolicy` a déjà une méthode `view`. Il reste à l'appliquer dans le controller et enrichir la vue.

## Goals / Non-Goals

**Goals:**
- Protéger la route show par la policy (propriétaire uniquement)
- Afficher la liste des candidatures triées par score descendant
- Ajouter un badge coloré pour la recommandation (vert = convoquer, orange = attente, rouge = rejeter)
- Ajouter un bouton "Soumettre un CV"

**Non-Goals:**
- Pagination des candidatures
- Formulaire de soumission (US5)

## Decisions

1. **Policy dans le controller** — `$this->authorize('view', $offre)` dans `show()`.

2. **Candidatures avec eager loading** — `$offre->load('analyses.candidature')` pour éviter N+1. Tri par score DESC.

3. **Badge recommandation** — Classes CSS conditionnelles : `bg-green-100 text-green-800` pour convoquer, `bg-orange-100 text-orange-800` pour attente, `bg-red-100 text-red-800` pour rejeter.

## Risks / Trade-offs

- [Analyses vides] → La table analyses n'existe pas encore (US5). La liste sera vide jusqu'à US5+.
