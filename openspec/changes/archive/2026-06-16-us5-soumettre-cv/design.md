## Context

Les modèles `Analyse` et `Candidature` existent en squelettes (créés dans US4). Les migrations et le controller doivent être créés. Le job `AnalyzeCandidateJob` sera un placeholder jusqu'à US6.

## Goals / Non-Goals

**Goals:**
- Migration `candidatures` : id, nom, texte_cv, timestamps
- Migration `analyses` : id, offre_id, candidature_id, statut (=en_attente par défaut), + champs JSON optionnels, timestamps
- Formulaire de soumission avec validation (nom requis, texte_cv requis min 100 chars)
- Création Candidature + Analyse en une transaction
- Dispatch du job `AnalyzeCandidateJob`
- Message flash et redirection vers `/analyses/{analyse}`
- Route `GET /offres/{offre}/candidatures/create` pour le formulaire

**Non-Goals:**
- Implémentation réelle du job IA (US6)
- Affichage complet de l'analyse avec score (US7)

## Decisions

1. **Transaction** — Utiliser `DB::transaction` pour garantir que Candidature ET Analyse sont créées ensemble.

2. **Statut par défaut** — `'en_attente'` stocké en string.

3. **Route naming** — Respecter la convention REST : `offres.{offre}.candidatures.create` et `offres.{offre}.candidatures.store`.

4. **Job placeholder** — Le job sera créé mais `handle()` sera vide (ou log seulement) jusqu'à US6.

5. **Analyse.show view** — Affiche le statut "en_attente" avec un message "Analyse en cours...".

## Risks / Trade-offs

- [Job non implémenté] → Le dispatch ne fait rien pour l'instant. Pas de blocage.
- [Texte CV min 100] → Validation stricte. Utiliser `strlen` standard.
