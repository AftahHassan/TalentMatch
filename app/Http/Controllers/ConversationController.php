<?php

namespace App\Http\Controllers;

use App\Models\Analyse;
use App\Models\Conversation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ConversationController extends Controller
{
    public function store(Request $request, Analyse $analyse): RedirectResponse
    {
        Gate::authorize('view', $analyse);

        $validated = $request->validate([
            'titre' => 'nullable|string|max:255',
        ]);

        $conversation = Conversation::create([
            'analyse_id' => $analyse->id,
            'titre' => $validated['titre'] ?? 'Discussion sur '.($analyse->candidature?->nom ?? "l'analyse"),
        ]);

        return redirect()->route('conversations.show', $conversation);
    }

    public function show(Conversation $conversation)
    {
        Gate::authorize('view', $conversation->analyse);

        $conversation->load(['messages', 'analyse.candidature']);

        return view('conversations.show', compact('conversation'));
    }
}
