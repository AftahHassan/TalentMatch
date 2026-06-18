<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class OffreController extends Controller
{
    public function index()
    {
        $offres = request()->user()->offres()->latest()->get();

        return view('offres.index', compact('offres'));
    }

    public function create()
    {
        return view('offres.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'competences_requises' => ['required', 'string'],
            'niveau_experience' => ['required', 'integer', 'min:0'],
        ]);

        $competences = array_map('trim', explode(',', $validated['competences_requises']));

        $offre = $request->user()->offres()->create([
            'titre' => $validated['titre'],
            'description' => $validated['description'],
            'competences_requises' => $competences,
            'niveau_experience' => $validated['niveau_experience'],
        ]);

        return redirect()->route('offres.show', $offre);
    }

    public function show(Offre $offre)
    {
        Gate::authorize('view', $offre);

        $offre->load(['analyses' => fn ($q) => $q->with('candidature')->orderBy('score', 'desc')]);

        return view('offres.show', compact('offre'));
    }

    public function edit(Offre $offre)
    {
        //
    }

    public function update(Request $request, Offre $offre)
    {
        //
    }

    public function destroy(Offre $offre)
    {
        //
    }
}
