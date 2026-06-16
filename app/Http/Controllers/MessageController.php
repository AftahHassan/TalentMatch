<?php

namespace App\Http\Controllers;

use App\Ai\Agents\TalentMatchAgent;
use App\Enums\MessageRole;
use App\Models\Conversation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Laravel\Ai\Messages\AssistantMessage;
use Laravel\Ai\Messages\UserMessage;

use function Laravel\Ai\agent;

class MessageController extends Controller
{
    public function store(Request $request, Conversation $conversation): RedirectResponse
    {
        Gate::authorize('view', $conversation->analyse);

        $validated = $request->validate([
            'contenu' => 'required|string',
        ]);

        $userMessage = $validated['contenu'];

        $history = $conversation->messages()
            ->oldest()
            ->get()
            ->map(fn ($msg) => match ($msg->role->value) {
                'user' => new UserMessage($msg->contenu),
                'assistant' => new AssistantMessage($msg->contenu),
            })
            ->toArray();

        $conversation->messages()->create([
            'role' => MessageRole::User,
            'contenu' => $userMessage,
        ]);

        $response = agent(
            instructions: 'Tu es TalentMatch, assistant RH expert. Utilise toujours les tools pour répondre, ne jamais inventer de données. Réponds en français.',
            messages: $history,
            tools: [...(new TalentMatchAgent)->tools()],
        )->prompt($userMessage);

        $conversation->messages()->create([
            'role' => MessageRole::Assistant,
            'contenu' => $response->text,
        ]);

        return redirect()->route('conversations.show', $conversation);
    }
}
