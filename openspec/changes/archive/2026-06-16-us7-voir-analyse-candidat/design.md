## Context

La vue `analyses/show.blade.php` existe déjà avec une structure conditionnelle `@if ($analyse->statut === 'en_attente') ... @else ...`. Il faut enrichir le bloc `@else` pour afficher tous les champs de l'analyse complète.

Le modèle `Analyse` a déjà les relations `offre`, `candidature` chargées via le controller (`AnalyseController@show`). Les champs `competences`, `langues`, `points_forts`, `lacunes`, `competences_manquantes` sont des arrays JSON castés.

## Goals / Non-Goals

**Goals:**
- Score affiché en grand (taille texte 4x ou 5x), avec couleur de fond conditionnelle
- `points_forts` affichés en badges verts
- `lacunes` affichés en badges rouges/oranges
- `competences_manquantes` affichés en badges gris
- `langues` affichés en badges bleus
- Recommandation en badge coloré (vert=convoquer, orange=attente, rouge=rejeter)
- Justification en paragraphe complet
- Bouton "Discuter avec l'assistant" orienté vers `route('conversations.create', $analyse)` (à créer dans US9)
- Vue responsive, respect de la charte Breeze

**Non-Goals:**
- Implémentation du chat (US9)
- Création du controller de conversation (US9)

## Decisions

1. **Score badge** — Utiliser `bg-green-100 text-green-800` pour >70, `bg-orange-100 text-orange-800` pour 40-70, `bg-red-100 text-red-800` pour <40. Même pattern que la liste des offres (US4).

2. **Recommandation badge** — Réutiliser le mapping de couleurs existant dans `offres/show.blade.php` : `convoquer` → vert, `attente` → orange, `rejeter` → rouge.

3. **Bouton assistant** — Lié vers une route qui n'existe pas encore (`conversations.create`). Le lien sera désactivé ou masqué si la route n'existe pas, ou simplement présenté comme un placeholder.

## Risks / Trade-offs

- [Route conversation inexistante] → Le bouton pointera vers une route à créer en US9. À ce stade, le lien peut être commenté ou pointer vers `#`.
