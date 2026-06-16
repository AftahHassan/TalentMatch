## Context

US1 a installé l'authentification et créé la vue placeholder `/offres`. Le modèle `Offre` est défini dans le config.yaml mais n'existe pas encore en base. Une migration et un modèle Eloquent sont nécessaires.

## Goals / Non-Goals

**Goals:**
- Créer la migration et le modèle `Offre` avec les champs spécifiés
- Implémenter le formulaire de création d'offre (titre, description, competences_requises, niveau_experience)
- Valider les champs (titre requis, niveau_experience >= 0)
- Rattacher l'offre à l'utilisateur connecté
- Rediriger vers le détail après création

**Non-Goals:**
- Liste des offres (US3)
- Modification / suppression d'offre
- Détail complet avec candidatures (US4)

## Decisions

1. **Controller unique `OffreController`** — Actions create + store pour US2. Les actions index/show/edit/update/destroy seront ajoutées dans US3/US4.

2. **Validation dans le controller** — Règles simples : titre requis (string, max:255), niveau_experience requis (integer, min:0), competences_requises validé comme tableau via `required|array`.

3. **Competences_requises en JSON** — Le champ est casté `array` dans le modèle Offre (défini dans config.yaml). Le formulaire utilise un textarea où l'utilisateur saisit des compétences séparées par des virgules, converties en tableau côté controller.

4. **Policy `OffrePolicy`** — Créée mais simple pour US2 (create toujours vrai si authentifié). Les méthodes view/update/delete seront implémentées dans US4.

5. **Vues Blade** — `offres/create.blade.php` pour le formulaire, `offres/show.blade.php` pour le détail (placeholder pour US4).

## Risks / Trade-offs

- [Competences en textarea] → Format CSV simple mais pas d'autocomplétion. Acceptable pour MVP.
- [Pas de service layer] → La logique reste dans le controller pour US2. À extraire dans `App\Services\OffreService` si le CRUD se complexifie.
