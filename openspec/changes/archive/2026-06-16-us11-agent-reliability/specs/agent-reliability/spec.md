## ADDED Requirements

### Requirement: Agent must always call a tool before answering
The agent SHALL call at least one tool to fetch real data before generating any response about candidate scores, skills, recommendations, or comparisons.

#### Scenario: Agent called for score explanation
- **WHEN** the user asks "pourquoi ce score ?"
- **THEN** the agent calls `getCandidateAnalysis` with the analysis ID
- **THEN** the response is based on actual score data from the database

#### Scenario: Agent called for missing competencies
- **WHEN** the user asks "quelles compétences manquent ?"
- **THEN** the agent calls `getCandidateAnalysis` with the analysis ID
- **THEN** the response lists real competencies_manquantes from the database

#### Scenario: Agent called for candidate comparison
- **WHEN** the user asks "lequel des deux est meilleur ?"
- **THEN** the agent calls `compareCandidates` with both analysis IDs
- **THEN** the response compares actual data from both analyses

### Requirement: System prompt enforces tool usage
The system prompt SHALL explicitly instruct the agent to always use a tool before answering and to never invent data.

#### Scenario: Prompt contains tool-first rule
- **WHEN** the agent is invoked
- **THEN** the system prompt includes: "Tu dois toujours utiliser un tool pour récupérer les données réelles avant de répondre. Ne jamais inventer un score, une compétence ou une recommandation. Si tu n'as pas l'ID, demande-le à l'utilisateur."

### Requirement: Analysis context injected in prompt
The MessageController SHALL inject `analyse_id` and `offre_id` into the system prompt so the agent knows which records to query.

#### Scenario: IDs available to agent
- **WHEN** the user sends a message
- **THEN** the system prompt includes the analyse_id and offre_id from the conversation's analysis
- **THEN** the agent can use these IDs in tool calls without asking the user
