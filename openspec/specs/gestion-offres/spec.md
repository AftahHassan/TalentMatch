## Purpose

Création et gestion des offres d'emploi par les agents RH.

## Requirements

### Requirement: Création d'une offre d'emploi

Le système SHALL permettre à un agent RH connecté de créer une offre d'emploi avec titre, description, compétences requises et niveau d'expérience.

#### Scenario: Création réussie
- **WHEN** un utilisateur connecté soumet le formulaire de création avec titre, description, compétences et niveau d'expérience valides
- **THEN** l'offre est créée en base, rattachée à l'utilisateur, et l'utilisateur est redirigé vers la page de détail de l'offre

#### Scenario: Titre manquant
- **WHEN** un utilisateur soumet le formulaire sans titre
- **THEN** le système affiche une erreur de validation "Le titre est requis"

#### Scenario: Niveau d'expérience négatif
- **WHEN** un utilisateur soumet un niveau d'expérience inférieur à 0
- **THEN** le système affiche une erreur de validation

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

### Requirement: Consultation du détail d'une offre

Le système SHALL permettre au propriétaire d'une offre de consulter le détail avec les critères, les candidatures soumises, leur score et leur recommandation.

#### Scenario: Accès autorisé
- **WHEN** le propriétaire de l'offre accède à `/offres/{offre}`
- **THEN** le système affiche les critères (compétences requises, niveau d'expérience), la liste des candidatures avec score et badge de recommandation

#### Scenario: Accès refusé (non propriétaire)
- **WHEN** un utilisateur qui n'est pas le propriétaire tente d'accéder à `/offres/{offre}`
- **THEN** le système retourne une erreur 403

#### Scenario: Candidatures triées par score
- **WHEN** le propriétaire consulte le détail d'une offre avec plusieurs candidatures
- **THEN** les candidatures sont affichées triées par score décroissant
