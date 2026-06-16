## MODIFIED Requirements

### Requirement: Send and receive messages
The system SHALL allow users to send messages in a conversation and receive AI-generated responses.

#### Scenario: User sends a message
- **WHEN** the user submits a message in the conversation
- **THEN** the message is saved with role `user`
- **THEN** the TalentMatch agent processes the message with full conversation history and the analysis context (analyse_id, offre_id) injected in the system prompt
- **THEN** the agent response is saved with role `assistant`
- **THEN** the assistant response is returned as JSON

#### Scenario: Empty message rejected
- **WHEN** the user submits an empty message
- **THEN** the system returns a validation error

### Requirement: Agent uses tools for data access
The TalentMatchAgent MUST use provided tools to access candidate data and MUST NOT fabricate information. The system prompt explicitly requires a tool call before every answer.

#### Scenario: Agent answers using candidate analysis
- **WHEN** the user asks a question about the candidate analysis
- **THEN** the agent first calls a tool (e.g., `getCandidateAnalysis`) to retrieve real data
- **THEN** the response is based on actual data from the database

#### Scenario: Agent compares two candidates
- **WHEN** the user asks to compare two candidates
- **THEN** the agent calls `compareCandidates` with the two analysis IDs
- **THEN** the response includes data from both analyses
