<?php

namespace App\Http\Controllers;

use App\Models\Analyse;
use Illuminate\Support\Facades\Gate;

class AnalyseController extends Controller
{
    public function show(Analyse $analyse)
    {
        Gate::authorize('view', $analyse);

        $analyse->load(['offre', 'candidature']);

        return view('analyses.show', compact('analyse'));
    }
}
