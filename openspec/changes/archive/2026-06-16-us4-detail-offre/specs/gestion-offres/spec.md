## ADDED Requirements

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
