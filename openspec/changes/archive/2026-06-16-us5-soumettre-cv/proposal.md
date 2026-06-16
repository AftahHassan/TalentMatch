## Why

L'agent RH doit pouvoir soumettre un CV (texte) pour une offre d'emploi afin de déclencher l'analyse IA. C'est le point d'entrée du cœur métier de TalentMatch.

## What Changes

- Création des migrations pour `candidatures` et `analyses`
- Mise à jour du modèle `Analyse` et `Candidature` (déjà squelettés)
- Formulaire de soumission de CV (nom + texte_cv) lié à une offre
- Création de la `Candidature` et de l'`Analyse` (statut = en_attente)
- Dispatch du `AnalyzeCandidateJob` après création
- Redirection vers `/analyses/{analyse}` avec message flash
- Route POST `/offres/{offre}/candidatures`

## Capabilities

### New Capabilities
- `soumission-cv`: Soumission d'un CV avec création de candidature et analyse, dispatch du job IA

### Modified Capabilities
<!-- Aucune modification -->

## Impact

- `database/migrations/xxxx_create_candidatures_table.php` : nouvelle migration
- `database/migrations/xxxx_create_analyses_table.php` : nouvelle migration
- `app/Http/Controllers/CandidatureController.php` : nouveau controller
- `app/Jobs/AnalyzeCandidateJob.php` : nouveau job (placeholder, sera implémenté dans US6)
- `resources/views/candidatures/create.blade.php` : formulaire de soumission
- `resources/views/analyses/show.blade.php` : vue détail analyse (statut en_attente)
- `routes/web.php` : routes candidatures
- `tests/Feature/CandidatureTest.php` : tests de soumission
