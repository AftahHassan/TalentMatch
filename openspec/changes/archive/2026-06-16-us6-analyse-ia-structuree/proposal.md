## Why

Le job `AnalyzeCandidateJob` est actuellement un placeholder. US6 l'implémente pour appeler le SDK `laravel/ai` en **Structured Output**, hydrater les colonnes de l'`Analyse` avec le contrat JSON défini, et gérer les statuts (terimine/échec).

## What Changes

- Implémentation de `AnalyzeCandidateJob::handle()` avec appel SDK
- Création d'un service `AnalyseService` (logique métier) pour découpler le job
- Création/configuration de `config/ai.php` pour le provider IA
- Gestion des tentatives échouées (max 3) : statut = 'echec'
- Payload JSON sauvegardé pour debug
- Test du job avec mock du SDK

## Capabilities

### Modified Capabilities
- `soumission-cv` — Le job placeholder devient fonctionnel

## Impact

- `app/Jobs/AnalyzeCandidateJob.php` : implémentation du handle()
- `app/Services/AnalyseService.php` : nouveau service
- `config/ai.php` : configuration du provider (si non existant)
- `tests/Feature/AnalyzeCandidateJobTest.php` : tests unitaires du job
