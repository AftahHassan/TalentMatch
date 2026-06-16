## 1. Configuration SDK

- [ ] 1.1 Publier et configurer `config/ai.php` (si absent)
- [ ] 1.2 Vérifier la présence du provider OpenAI (.env : API key, model)
- [ ] 1.3 Créer un DTO/VO `AnalyseResult` pour le Structured Output

## 2. Service et Job

- [ ] 2.1 Créer `app/Services/AnalyseService.php` avec méthode `analyze(Analyse $analyse)`
- [ ] 2.2 Implémenter l'appel SDK avec Structured Output
- [ ] 2.3 Hydrater les champs de l'Analyse et sauvegarder payload
- [ ] 2.4 Implémenter `AnalyzeCandidateJob::handle()` en déléguant au service
- [ ] 2.5 Implémenter `AnalyzeCandidateJob::failed()` pour passer statut = 'echec'

## 3. Tests

- [ ] 3.1 Tester le job avec un mock du SDK (succès)
- [ ] 3.2 Tester le job avec exception (statut = echec)
- [ ] 3.3 Vérifier le contenu du payload stocké
