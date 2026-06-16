## Context

Le SDK `laravel/ai` est déclaré dans `composer.json` (`laravel/ai: *`). Un config `config/ai.php` peut être nécessaire (via `php artisan vendor:publish --tag=laravel-ai-config`). Le provider utilisé sera **OpenAI** (`gpt-4o` ou équivalent) avec **Structured Outputs** (response_format: json_schema).

Le contrat JSON est défini dans `openspec.yaml > ai_output_schema`. Il correspond aux colonnes de la table `analyses`.

## Goals / Non-Goals

**Goals:**
- `AnalyzeCandidateJob::handle()` appelle le SDK avec le CV (texte_cv) + l'offre (titre, description, competences_requises, niveau_experience)
- Le SDK retourne un objet structuré respectant le `ai_output_schema`
- Hydratation de toutes les colonnes de l'Analyse
- Payload brut stocké dans `analyse.payload`
- `analyse.statut` passe à `'termine'` en cas de succès
- Si exception (toutes tentatives épuisées), `analyse.statut = 'echec'`
- Log métier intégré

**Non-Goals:**
- Implémentation de l'agent conversationnel (US9+)
- Interface utilisateur d'analyse (US7)

## Decisions

1. **Service layer** — Créer `AnalyseService` avec une méthode `analyze(Analyse $analyse)` qui contient la logique d'appel SDK et d'hydratation. Le job appelle le service.

2. **Prompt engineering** — Le prompt système explique le contexte (offre + CV) et demande une analyse structurée. Le prompt est stocké dans le service.

3. **Structured Output** — Utiliser `->withStructuredOutput(AnalyseResult::class)` ou l'équivalent SDK : un DTO/ValueObject `AnalyseResult` annoté (Spatie Data ou tableau associatif validé).

4. **Payload** — Le payload est le tableau brut retourné par le SDK (avant mapping), stocké en JSON.

5. **Tentatives** — Laravel queue retry (max 3). Le job ne catch pas l'exception : Laravel gère les retries. Après épuisement, le `failed()` method sera implémentée pour passer statut = 'echec'.

## Risks / Trade-offs

- [SDK non installé] → Prévoir `composer install` dans les tâches ou une config minimale
- [Provider non configuré] → Clé API OpenAI nécessaire dans `.env`
