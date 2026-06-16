# Conversational Analysis

## Purpose

Allow recruiters to have AI-powered conversations with candidate analyses, asking follow-up questions and getting contextual responses.

## Requirements

### Requirement: Start a conversation
The system SHALL allow authenticated users to start a new conversation on a candidate analysis.

#### Scenario: Create conversation from analysis page
- **WHEN** the user clicks "Démarrer une conversation" on the analysis show page
- **THEN** a new conversation is created linked to that analysis
- **THEN** the user is redirected to the conversation show page

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

### Requirement: View conversation history
The system SHALL display all messages in a conversation chronologically.

#### Scenario: View conversation page
- **WHEN** the user navigates to the conversation show page
- **THEN** all previous messages are displayed
- **THEN** messages from the user appear on the right
- **THEN** messages from the assistant appear on the left

### Requirement: Suggested questions
The conversation page SHALL display suggested questions to help users start the conversation.

#### Scenario: Suggested questions shown on empty conversation
- **WHEN** the conversation page loads
- **THEN** suggested questions are displayed (e.g., "Pourquoi ce score ?", "Quelles questions poser en entretien ?")
