## Why

The conversational assistant (US9) was built with tools and agent scaffolding, but the agent may still fabricate data if tools are not enforced. Recruiters need guaranteed real-data responses — the agent must always call a tool before answering, never invent scores, skills, or recommendations.

## What Changes

- Update system prompt to strictly enforce tool usage before answering
- Inject `analyse_id` and `offre_id` as contextual data into the system prompt so the agent knows which IDs to use
- Verify all 3 tools return complete fields (score, competences, recommandation, etc.)
- Change MessageController@store to load conversation with analyse relation and return JSON responses
- Update the Blade view to handle JSON responses correctly

## Capabilities

### New Capabilities
- `agent-reliability`: Enforce tool-first agent responses with injected analysis context, ensuring the agent never hallucinates data

### Modified Capabilities
- `conversational-analysis`: Stricter system prompt requiring tool calls before every answer; MessageController passes analysis context and returns JSON

## Impact

- `app/Ai/Agents/TalentMatchAgent.php`: Updated system prompt with strict tool-enforcement rules
- `app/Ai/Tools/GetCandidateAnalysis.php`: Verify returns all required fields (score, competences, points_forts, lacunes, etc.)
- `app/Ai/Tools/GetJobRequirements.php`: Verify returns titre, description, competences_requises, niveau_experience
- `app/Ai/Tools/CompareCandidates.php`: Verify returns side-by-side analyses
- `app/Http/Controllers/MessageController.php`: Rewrite to load analyse context, inject IDs in prompt, return JSON
- `resources/views/conversations/show.blade.php`: Update to handle JSON-based response flow
