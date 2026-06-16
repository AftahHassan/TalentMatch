## Context

Recruiters currently view static candidate analysis pages (`analyses/show`). They cannot ask follow-up questions or explore analysis details conversationally. The application already has `laravel/ai` installed and an AI analysis pipeline (AnalyzeCandidateJob). No conversational interface exists yet.

## Goals / Non-Goals

**Goals:**
- Persistent conversation history stored in `conversations` and `messages` tables
- AI-powered chat where the TalentMatch agent answers questions about a specific candidate analysis
- Agent has access to real candidate data via tools (not hallucinated)
- Messages displayed in a chat UI with user on right, assistant on left
- Suggested questions to help recruiters get started

**Non-Goals:**
- Real-time / WebSocket streaming (messages are sent and received synchronously)
- Multi-model or streaming agent responses
- File attachments in chat
- Conversation editing or deletion

## Decisions

1. **Synchronous request-response** — Keep the chat simple: POST message → agent processes → response returned. No SSE/streaming for this iteration. The agent call may be queued in the future but for now it runs synchronously so the UI gets the response in the same request.

2. **Agent tools over raw DB access** — The TalentMatchAgent exposes `getCandidateAnalysis`, `getJobRequirements`, and `compareCandidates` as callable tools rather than injecting models directly. This keeps the agent abstraction clean and testable, and prevents the LLM from fabricating data.

3. **Separate Conversation and Message controllers** — Following the existing controller convention (no single-action controllers), `ConversationController` handles conversation lifecycle and `MessageController` handles messaging. The existing analyses route pattern is used for nesting.

4. **French system prompt** — The agent responds in French since the target users are French-speaking recruiters, and the existing UI is in French.

5. **Blade + Alpine.js for chat UI** — The existing stack uses Blade with Alpine.js (Breeze ships with Alpine). The chat UI will use Alpine for reactive message rendering without a full SPA framework.

## Risks / Trade-offs

- Synchronous AI calls may be slow (5-15s) → User sees a loading state, button disabled during request
- LLM may hallucinate data without tools → Mitigated: agent is required to use tools for data, system prompt enforces this
- Long conversation history may exceed context window → Mitigated: sliding window truncation can be added later; initial implementation uses full history
