## Why

La vue `/analyses/{analyse}` affiche actuellement un statut "en_attente" ou un simple résumé (nom, offre, score, recommandation). US7 enrichit cette page pour afficher l'intégralité du résultat de l'analyse IA : score coloré, badges de compétences, points forts, lacunes, justification, et un bouton pour lancer une conversation.

## What Changes

- Mise à jour de `resources/views/analyses/show.blade.php` avec l'affichage complet
- Score en grand avec couleur conditionnelle (vert >70, orange 40-70, rouge <40)
- Badges pour points_forts, lacunes, competences_manquantes
- Badge recommandation coloré
- Justification en texte intégral
- Bouton "Discuter avec l'assistant" → lien vers création de conversation (US9)

## Capabilities

### Modified Capabilities
- `soumission-cv` — Vue analyse enrichie avec tous les détails structurés

## Impact

- `resources/views/analyses/show.blade.php` : refonte complète de la vue
- `app/Http/Controllers/AnalyseController.php` : peut nécessiter un chargement de relation supplémentaire si absent
- Aucun changement backend (modèle, migration, BDD)
