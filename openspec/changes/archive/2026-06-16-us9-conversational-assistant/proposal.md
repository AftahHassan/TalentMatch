## Why

Recruiters need to interact conversationally with candidate analyses — asking follow-up questions, getting interview suggestions, and exploring scoring details — rather than relying solely on static analysis pages.

## What Changes

- Add `conversations` and `messages` database tables via migrations
- Create `Conversation` and `Message` Eloquent models with relationships
- Create `MessageRole` backed string enum (`user`, `assistant`)
- Create `ConversationController@store` to start a conversation on an analysis
- Create `MessageController@store` to send messages and get AI responses with full conversation history
- Create `TalentMatchAgent` using the `laravel/ai` SDK with tools for candidate analysis data
- Create chat UI Blade view at `conversations/show.blade.php`
- Add authenticated routes for conversations and messages
- Wire the analyses show page to start a conversation

## Capabilities

### New Capabilities
- `conversational-analysis`: AI-powered chat interface allowing recruiters to converse with candidate analyses, ask questions, and get contextual responses using the TalentMatch agent

### Modified Capabilities
<!-- None — no existing specs are changing -->

## Impact

- `database/migrations/`: 2 new migration files
- `app/Models/Conversation.php`: new model
- `app/Models/Message.php`: new model
- `app/Enums/MessageRole.php`: new enum
- `app/Http/Controllers/ConversationController.php`: new controller
- `app/Http/Controllers/MessageController.php`: new controller
- `app/Agents/TalentMatchAgent.php`: new agent class
- `resources/views/conversations/show.blade.php`: new Blade view
- `routes/web.php`: 3 new routes added
- `composer.json`: requires `laravel/ai` (already present)
