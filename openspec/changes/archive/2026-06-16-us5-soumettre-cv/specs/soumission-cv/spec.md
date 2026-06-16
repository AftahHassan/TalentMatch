## ADDED Requirements

### Requirement: Soumission d'un CV

Le système SHALL permettre à un agent RH connecté de soumettre un CV (nom + texte) pour une offre d'emploi, créant automatiquement une candidature et une analyse en attente.

#### Scenario: Soumission réussie
- **WHEN** un utilisateur connecté soumet le formulaire avec nom et texte_cv (min 100 caractères) pour une offre dont il est propriétaire
- **THEN** une Candidature et une Analyse (statut = en_attente) sont créées, le job AnalyzeCandidateJob est dispatché, l'utilisateur voit un message "Analyse en cours..." et est redirigé vers `/analyses/{analyse}`

#### Scenario: Texte du CV trop court
- **WHEN** un utilisateur soumet un texte_cv de moins de 100 caractères
- **THEN** le système affiche une erreur de validation

#### Scenario: Accès au formulaire
- **WHEN** un utilisateur connecté accède à `/offres/{offre}/candidatures/create`
- **THEN** le système affiche le formulaire de soumission avec les champs nom et texte_cv
