<?php

namespace App\Http\Controllers;

use App\Models\Analyse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class AnalyseController extends Controller
{
    public function index(): View
    {
        $analyses = Analyse::with(['candidature', 'offre'])
            ->where('statut', 'termine')
            ->latest()
            ->paginate(15);

        return view('analyses.index', compact('analyses'));
    }

    public function show(Analyse $analyse)
    {
        Gate::authorize('view', $analyse);

        $analyse->load(['offre', 'candidature']);

        return view('analyses.show', compact('analyse'));
    }
}
