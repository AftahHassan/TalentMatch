<x-app-layout>
    <x-slot name="header">{{ __('Dashboard') }}</x-slot>

    @php
        $userOffres = auth()->user()->offres()->with('analyses')->latest()->get();
        $totalOffres = $userOffres->count();
        $totalAnalyses = $userOffres->sum(fn($o) => $o->analyses->count());
        $avgScore = $totalAnalyses > 0
            ? round($userOffres->flatMap(fn($o) => $o->analyses)->avg('score'))
            : null;
        $pendingAnalyses = $userOffres->flatMap(fn($o) => $o->analyses)->where('statut', 'en_attente')->count();
        $recentOffres = $userOffres->take(5);
        $recentAnalyses = $userOffres->flatMap(fn($o) => $o->analyses)->sortByDesc('created_at')->take(5);
    @endphp

    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">{{ __('Offres') }}</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">{{ $totalOffres }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-indigo-50 flex items-center justify-center">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.193 23.193 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">{{ __('Analyses') }}</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">{{ $totalAnalyses }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-emerald-50 flex items-center justify-center">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">{{ __('Score moyen') }}</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">{{ $avgScore ?? '—' }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-amber-50 flex items-center justify-center">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">{{ __('En attente') }}</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">{{ $pendingAnalyses }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-rose-50 flex items-center justify-center">
                        <svg class="w-6 h-6 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white rounded-xl border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="font-semibold text-gray-900">{{ __('Dernières offres') }}</h3>
                    <a href="{{ route('offres.index') }}" class="text-sm text-indigo-600 hover:text-indigo-500 font-medium">{{ __('Voir tout') }}</a>
                </div>
                <div class="p-6">
                    @if ($recentOffres->isEmpty())
                        <p class="text-gray-500 text-sm">{{ __('Aucune offre pour le moment.') }}</p>
                        <a href="{{ route('offres.create') }}" class="mt-3 inline-flex items-center text-sm text-indigo-600 hover:text-indigo-500 font-medium">
                            {{ __('Créer votre première offre') }} &rarr;
                        </a>
                    @else
                        <div class="space-y-3">
                            @foreach ($recentOffres as $offre)
                                <a href="{{ route('offres.show', $offre) }}" class="block p-3 rounded-lg hover:bg-gray-50 transition border border-transparent hover:border-gray-200">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="font-medium text-gray-900">{{ $offre->titre }}</p>
                                            <p class="text-sm text-gray-500">{{ $offre->niveau_experience }} ans d'expérience</p>
                                        </div>
                                        <span class="text-xs text-gray-400">{{ $offre->created_at->format('d/m/Y') }}</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <div class="bg-white rounded-xl border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="font-semibold text-gray-900">{{ __('Analyses récentes') }}</h3>
                </div>
                <div class="p-6">
                    @if ($recentAnalyses->isEmpty())
                        <p class="text-gray-500 text-sm">{{ __('Aucune analyse pour le moment.') }}</p>
                    @else
                        <div class="space-y-3">
                            @foreach ($recentAnalyses as $analyse)
                                <a href="{{ route('analyses.show', $analyse) }}" class="block p-3 rounded-lg hover:bg-gray-50 transition border border-transparent hover:border-gray-200">
                                    <div class="flex items-center justify-between">
                                        <div class="flex-1 min-w-0">
                                            <p class="font-medium text-gray-900 truncate">{{ $analyse->candidature?->nom ?? 'N/A' }}</p>
                                            <p class="text-sm text-gray-500 truncate">{{ $analyse->offre?->titre }}</p>
                                        </div>
                                        @if ($analyse->statut === 'en_attente')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                {{ __('En attente') }}
                                            </span>
                                        @elseif ($analyse->score !== null)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $analyse->score >= 70 ? 'bg-green-100 text-green-800' : ($analyse->score >= 40 ? 'bg-amber-100 text-amber-800' : 'bg-red-100 text-red-800') }}">
                                                {{ $analyse->score }}/100
                                            </span>
                                        @endif
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
