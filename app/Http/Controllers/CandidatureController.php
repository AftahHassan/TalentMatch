<?php

namespace App\Http\Controllers;

use App\Jobs\AnalyzeCandidateJob;
use App\Models\Analyse;
use App\Models\Candidature;
use App\Models\Offre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class CandidatureController extends Controller
{
    public function create(Offre $offre)
    {
        Gate::authorize('view', $offre);

        return view('candidatures.create', compact('offre'));
    }

    public function store(Request $request, Offre $offre)
    {
        Gate::authorize('view', $offre);

        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'texte_cv' => ['required', 'string', 'min:100'],
        ]);

        $analyse = DB::transaction(function () use ($offre, $validated) {
            $candidature = Candidature::create([
                'nom' => $validated['nom'],
                'texte_cv' => $validated['texte_cv'],
            ]);

            $analyse = Analyse::create([
                'offre_id' => $offre->id,
                'candidature_id' => $candidature->id,
                'statut' => 'en_attente',
            ]);

            AnalyzeCandidateJob::dispatch($analyse);

            return $analyse;
        });

        return redirect()->route('analyses.show', $analyse)
            ->with('success', __('Analyse en cours...'));
    }
}
