## ADDED Requirements

### Requirement: Liste des offres de l'utilisateur

Le système SHALL afficher la liste des offres d'emploi de l'utilisateur connecté, avec le nombre d'analyses (candidatures) pour chaque offre.

#### Scenario: Liste avec offres
- **WHEN** un utilisateur connecté avec des offres accède à `/offres`
- **THEN** le système affiche la liste de ses offres avec le titre, le nombre d'analyses et le niveau d'expérience

#### Scenario: Liste sans offre
- **WHEN** un utilisateur connecté sans offre accède à `/offres`
- **THEN** le système affiche un message "Aucune offre pour le moment" et un bouton pour créer une nouvelle offre

#### Scenario: Filtrage par utilisateur
- **WHEN** un utilisateur connecté accède à `/offres`
- **THEN** seules ses propres offres sont affichées (pas celles des autres utilisateurs)
