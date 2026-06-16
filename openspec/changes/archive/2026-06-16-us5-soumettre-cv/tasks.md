## 1. Migrations

- [ ] 1.1 Créer la migration `create_candidatures_table` (nom, texte_cv)
- [ ] 1.2 Créer la migration `create_analyses_table` (offre_id, candidature_id, statut, autres champs optionnels)
- [ ] 1.3 Exécuter les migrations

## 2. Controller et Job

- [ ] 2.1 Créer `CandidatureController` avec `create` et `store`
- [ ] 2.2 Ajouter la validation (nom requis, texte_cv requis min 100)
- [ ] 2.3 Créer `AnalyzeCandidateJob` (placeholder, handle vide)
- [ ] 2.4 Créer Candidature + Analyse en transaction, dispatcher le job

## 3. Routes et vues

- [ ] 3.1 Ajouter les routes GET/POST pour candidatures dans `routes/web.php`
- [ ] 3.2 Créer la vue `candidatures/create.blade.php` (formulaire)
- [ ] 3.3 Créer la vue `analyses/show.blade.php` (statut en_attente)
- [ ] 3.4 Lancer la suite de tests : `php artisan test`
