<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Models\Offre;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');
        $results = collect();

        if ($query) {
            $candidatures = Candidature::where('nom', 'like', "%{$query}%")->get()
                ->map(fn ($c) => [
                    'title' => $c->nom,
                    'url' => $c->analyse ? route('analyses.show', $c->analyse) : '#',
                    'type' => 'Candidat',
                ]);

            $offres = Offre::where('titre', 'like', "%{$query}%")->get()
                ->map(fn ($o) => [
                    'title' => $o->titre,
                    'url' => route('offres.show', $o),
                    'type' => 'Offre',
                ]);

            $results = $candidatures->concat($offres);
        }

        return view('search', [
            'query' => $query,
            'results' => $results,
        ]);
    }
}
