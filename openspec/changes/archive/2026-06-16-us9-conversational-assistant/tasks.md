## 1. Database Migrations

- [x] 1.1 Create `create_conversations_table` migration (id, analyse_id FK->analyses cascade delete, titre string, timestamps)
- [x] 1.2 Create `create_messages_table` migration (id, conversation_id FK->conversations cascade delete, role enum user/assistant, contenu text, timestamps)
- [x] 1.3 Run migrations

## 2. Enum & Models

- [x] 2.1 Create `App\Enums\MessageRole` backed string enum with cases `User` and `Assistant`
- [x] 2.2 Create `App\Models\Conversation` model (belongsTo Analyse, hasMany Message)
- [x] 2.3 Create `App\Models\Message` model (belongsTo Conversation, cast role to MessageRole)
- [x] 2.4 Add `conversations()` hasMany relation to Analyse model

## 3. Agent

- [x] 3.1 Create `App\Ai\Agents\TalentMatchAgent` using laravel/ai SDK with French system prompt
- [x] 3.2 Add `getCandidateAnalysis(int $analyseId)` tool returning Analyse with offre and candidature
- [x] 3.3 Add `getJobRequirements(int $offreId)` tool returning Offre
- [x] 3.4 Add `compareCandidates(int $id1, int $id2)` tool returning both Analyse models

## 4. Controllers

- [x] 4.1 Create `ConversationController` with `store()` method linked to Analyse
- [x] 4.2 Create `MessageController` with `store()` method that loads history, calls agent, saves both messages

## 5. Routes

- [x] 5.1 Add POST `/analyses/{analyse}/conversations` → ConversationController@store (auth)
- [x] 5.2 Add GET `/conversations/{conversation}` → conversation show page (auth)
- [x] 5.3 Add POST `/conversations/{conversation}/messages` → MessageController@store (auth)

## 6. Frontend

- [x] 6.1 Create `resources/views/conversations/show.blade.php` with chat UI (history, form, user right/assistant left)
- [x] 6.2 Add suggested questions ("Pourquoi ce score ?", "Quelles questions poser en entretien ?")
- [x] 6.3 Add "Démarrer une conversation" button/link to the analyses show page

## 7. Tests

- [x] 7.1 Write feature test for starting a conversation
- [x] 7.2 Write feature test for sending a message and receiving agent response
- [x] 7.3 Write feature test for validation errors (empty message)
