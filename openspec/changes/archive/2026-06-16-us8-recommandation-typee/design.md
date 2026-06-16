## Decisions

1. **Aucun développement** — US8 est couvert par US4 (liste des candidatures) et US7 (détail analyse).

## Verification

- `offres/show.blade.php:66-73` : badge recommendation coloré avec mapping `convoquer → vert`, `attente → orange`, `rejeter → rouge`
- `analyses/show.blade.php` : badge recommendation coloré en utilisant le même mapping
- Tests : OffreTest vérifie l'affichage du détail offre; AnalyseTest vérifie l'affichage du détail analyse
