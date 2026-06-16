## ADDED Requirements

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
