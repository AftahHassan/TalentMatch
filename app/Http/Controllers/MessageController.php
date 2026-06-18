<?php

namespace App\Http\Controllers;

use App\Ai\Agents\TalentMatchAgent;
use App\Enums\MessageRole;
use App\Models\Conversation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Laravel\Ai\Messages\AssistantMessage;
use Laravel\Ai\Messages\UserMessage;

use function Laravel\Ai\agent;

class MessageController extends Controller
{
    public function store(Request $request, Conversation $conversation): JsonResponse
    {
        Gate::authorize('view', $conversation->analyse);

        $validated = $request->validate([
            'contenu' => 'required|string',
        ]);

        $conversation->load('analyse.offre');

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

        $analyse = $conversation->analyse;

        $instructions = "Tu es TalentMatch, assistant RH expert.\n\n"
            ."Contexte :\n"
            ."- analyse_id : {$analyse->id}\n"
            ."- offre_id : {$analyse->offre_id}\n\n"
            .'Tu dois toujours utiliser un tool pour récupérer les données réelles avant de répondre. '
            .'Ne jamais inventer un score, une compétence ou une recommandation. '
            ."Si tu n'as pas l'ID, utilise les IDs fournis dans le contexte ci-dessus. "
            .'Réponds en français. '
            .'Utilise UNIQUEMENT du texte brut avec formatage Markdown simple (**gras**, ### titres, - listes, tableaux Markdown). '
            .'N\'utilise JAMAIS de HTML ou de balises inline. '
            .'Pour les tableaux, utilise le format Markdown | colonne | colonne | avec une ligne de séparation |---|. '
            .'Laisse une ligne vide entre les sections.';

        $response = agent(
            instructions: $instructions,
            messages: $history,
            tools: [...(new TalentMatchAgent)->tools()],
        )->prompt($userMessage);

        $message = $conversation->messages()->create([
            'role' => MessageRole::Assistant,
            'contenu' => $response->text,
        ]);

        return response()->json([
            'message' => [
                'id' => $message->id,
                'role' => $message->role->value,
                'contenu' => $message->contenu,
                'created_at' => $message->created_at->toISOString(),
            ],
        ]);
    }
}
