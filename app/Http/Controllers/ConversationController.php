<?php

namespace App\Http\Controllers;

use App\Models\Analyse;
use App\Models\Conversation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class ConversationController extends Controller
{
    public function index(): View
    {
        $conversations = Conversation::with(['analyse.candidature', 'analyse.offre'])
            ->whereHas('analyse.offre', function ($q) {
                $q->where('user_id', auth()->id());
            })
            ->latest()
            ->get();

        return view('conversations.index', compact('conversations'));
    }

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
