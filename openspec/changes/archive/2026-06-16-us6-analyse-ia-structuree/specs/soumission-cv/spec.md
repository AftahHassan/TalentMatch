## MODIFIED Requirements

### Requirement: Soumission d'un CV
#### Scenario: Analyse IA exécutée par le job
- **WHEN** le job `AnalyzeCandidateJob` est dispatché après soumission d'un CV
- **THEN** il appelle le SDK `laravel/ai` avec le CV et les critères de l'offre, et hydrate les colonnes de l'Analyse (score, competences, annees_experience, niveau_etude, langues, points_forts, lacunes, competences_manquantes, recommandation, justification)
- **THEN** le payload brut du SDK est stocké dans `analyse.payload`
- **THEN** `analyse.statut` passe à `'termine'` en cas de succès

#### Scenario: Échec de l'analyse après 3 tentatives
- **WHEN** le SDK lance une exception après 3 tentatives consécutives
- **THEN** `analyse.statut` passe à `'echec'`
