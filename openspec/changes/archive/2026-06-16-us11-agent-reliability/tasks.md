## 1. Update System Prompt

- [x] 1.1 Update TalentMatchAgent instructions with strict tool-first enforcement prompt
- [x] 1.2 Update ad-hoc agent() call in MessageController to use the same strict prompt with context injection

## 2. Inject Analysis Context

- [x] 2.1 Load conversation with analyse relation in MessageController@store
- [x] 2.2 Inject analyse_id and offre_id into the system prompt sent to the agent

## 3. Return JSON from MessageController

- [x] 3.1 Change MessageController@store to return JSON response with assistant message text
- [x] 3.2 Update Blade conversation view to submit form via Alpine.js fetch and append response dynamically

## 4. Verify Tool Completeness

- [x] 4.1 Verify GetCandidateAnalysis returns all required fields (score, competences, points_forts, lacunes, competences_manquantes, recommandation, justification, annees_experience, niveau_etude, langues)
- [x] 4.2 Verify GetJobRequirements returns titre, description, competences_requises, niveau_experience
- [x] 4.3 Verify CompareCandidates returns side-by-side analyses with all fields

## 5. Tests

- [x] 5.1 Verify MessageTest passes with JSON response assertion
- [x] 5.2 Run full test suite to verify nothing is broken
