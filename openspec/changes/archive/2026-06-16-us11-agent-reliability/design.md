## Context

The conversational assistant (US9) was implemented with 3 tools and a TalentMatchAgent. However, the system prompt allows the LLM to skip tool calls and fabricate answers. Recruiters need guaranteed real-data responses. The MessageController currently redirects to the Blade view (losing state) instead of returning JSON for dynamic UI updates.

## Goals / Non-Goals

**Goals:**
- Agent MUST call a tool before every answer — system prompt strictly enforces this
- Analyse ID and offre ID are injected into the system prompt so the agent knows what to query
- All 3 tools return complete fields as specified (score, competences, points_forts, etc.)
- MessageController returns JSON with the assistant response so the frontend can update dynamically
- Blade chat view stays functional with the JSON-based flow

**Non-Goals:**
- Changing the agent architecture (still uses ad-hoc `agent()` helper)
- Adding new tools beyond the 3 existing ones
- Modifying database schema
- Adding streaming responses

## Decisions

1. **System prompt injection of context** — Rather than passing IDs as separate parameters, inject `analyse_id` and `offre_id` into the system prompt so the agent always has them available for tool calls. This is simpler than modifying the agent contract.

2. **JSON return from MessageController** — Instead of redirecting, return `response()->json(['message' => ..., 'html' => ...])`. The Blade view's form submit is intercepted by a small Alpine.js handler that appends the response to the chat and clears the input.

3. **Tool descriptions already adequate** — The 3 tools already return complete data via `->toArray()`. Verification confirms all required fields are included. No changes needed to tool implementations.

## Risks / Trade-offs

- Strict tool-first prompt may cause the agent to call a tool unnecessarily on simple queries → Acceptable trade-off for data integrity
- JSON response changes the form behavior → Alpine.js intercept prevents full page reload, still falls back to normal form submit if JS is disabled
