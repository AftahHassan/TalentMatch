<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Models\Offre;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function index(Request $request): View
    {
        $query = $request->get('q', '');
        $results = [];

        if (strlen($query) >= 2) {
            $offres = Offre::where('user_id', auth()->id())
                ->where('titre', 'like', "%{$query}%")
                ->take(5)->get()
                ->map(fn ($o) => [
                    'type' => 'Job Offer',
                    'title' => $o->titre,
                    'url' => route('offres.show', $o),
                    'icon' => 'briefcase',
                ]);

            $candidatures = Candidature::where('nom', 'like', "%{$query}%")
                ->take(5)->get()
                ->map(fn ($c) => [
                    'type' => 'Candidate',
                    'title' => $c->nom,
                    'url' => $c->analyse ? route('analyses.show', $c->analyse) : '#',
                    'icon' => 'user',
                ]);

            $results = $offres->merge($candidatures)->values();
        }

        return view('search', compact('query', 'results'));
    }
}
