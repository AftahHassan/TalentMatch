<x-app-layout>
    <x-slot name="header">{{ __('Analysis') }} — {{ $analyse->candidature?->nom ?? 'N/A' }}</x-slot>

    <div class="max-w-7xl mx-auto">
        @if ($analyse->statut === 'en_attente')
            <div class="bg-amber-50 border border-amber-200 rounded-xl p-6 flex items-start gap-4">
                <div class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <div>
                    <h3 class="font-semibold text-amber-800">{{ __('Analyse en cours') }}</h3>
                    <p class="text-sm text-amber-700 mt-1">{{ __('The result will be available shortly. Please refresh the page.') }}</p>
                </div>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 space-y-6">
                    <div class="card p-8">
                        <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-4">{{ __('Information') }}</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <p class="text-xs text-gray-400 uppercase">{{ __('Candidate') }}</p>
                                <p class="text-lg font-semibold text-gray-900 mt-1">{{ $analyse->candidature?->nom }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 uppercase">{{ __('Job Offer') }}</p>
                                <p class="text-lg font-semibold text-gray-900 mt-1">{{ $analyse->offre?->titre }}</p>
                            </div>
                            @if ($analyse->annees_experience !== null)
                                <div>
                                    <p class="text-xs text-gray-400 uppercase">{{ __('Experience') }}</p>
                                    <p class="text-lg font-semibold text-gray-900 mt-1">{{ $analyse->annees_experience }} years</p>
                                </div>
                            @endif
                            @if ($analyse->niveau_etude)
                                <div>
                                    <p class="text-xs text-gray-400 uppercase">{{ __('Education Level') }}</p>
                                    <p class="text-lg font-semibold text-gray-900 mt-1">{{ $analyse->niveau_etude }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if ($analyse->justification)
                        <div class="card p-8">
                            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-4">{{ __('Justification') }}</h3>
                            <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $analyse->justification }}</p>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @if (!empty($analyse->points_forts))
                            <div class="card p-6 border-l-4 border-l-green-400">
                                <h3 class="text-sm font-medium text-green-700 uppercase tracking-wider mb-3 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ __('Points forts') }}
                                </h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($analyse->points_forts as $point)
                                        <span class="badge-green">{{ $point }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if (!empty($analyse->lacunes))
                            <div class="card p-6 border-l-4 border-l-red-400">
                                <h3 class="text-sm font-medium text-red-700 uppercase tracking-wider mb-3 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                    {{ __('Lacunes') }}
                                </h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($analyse->lacunes as $lacune)
                                        <span class="badge-red">{{ $lacune }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if (!empty($analyse->competences_manquantes))
                            <div class="card p-6 border-l-4 border-l-amber-400">
                                <h3 class="text-sm font-medium text-amber-700 uppercase tracking-wider mb-3 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01"/></svg>
                                    {{ __('Compétences manquantes') }}
                                </h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($analyse->competences_manquantes as $manquante)
                                        <span class="badge-amber">{{ $manquante }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if (!empty($analyse->competences))
                            <div class="card p-6 border-l-4 border-l-blue-400">
                                <h3 class="text-sm font-medium text-blue-700 uppercase tracking-wider mb-3 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                    {{ __('Compétences') }}
                                </h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($analyse->competences as $competence)
                                        <span class="badge-blue">{{ $competence }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if (!empty($analyse->langues))
                            <div class="card p-6 border-l-4 border-l-purple-400">
                                <h3 class="text-sm font-medium text-purple-700 uppercase tracking-wider mb-3 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ __('Langues') }}
                                </h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($analyse->langues as $langue)
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-purple-50 text-purple-700">{{ $langue }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="space-y-6">
                    @if ($analyse->score !== null)
                        <div class="card p-8 text-center">
                            <p class="text-sm text-gray-500 uppercase tracking-wider font-medium mb-4">{{ __('Score') }}</p>
                            <div class="inline-flex items-center justify-center w-36 h-36 rounded-full text-5xl font-bold mx-auto mb-2
                                {{ $analyse->score >= 70 ? 'bg-green-50 text-green-700 border-4 border-green-200' : ($analyse->score >= 40 ? 'bg-amber-50 text-amber-700 border-4 border-amber-200' : 'bg-red-50 text-red-700 border-4 border-red-200') }}">
                                {{ $analyse->score }}
                            </div>
                            <p class="text-sm text-gray-500 mt-1">/ 100</p>
                        </div>
                    @endif

                    @if ($analyse->recommandation)
                        <div class="card p-8 text-center">
                            <p class="text-sm text-gray-500 uppercase tracking-wider font-medium mb-4">{{ __('Recommendation') }}</p>
                            @php
                                $recoColors = [
                                    'convoquer' => 'bg-green-50 text-green-700 border-green-200',
                                    'attente' => 'bg-amber-50 text-amber-700 border-amber-200',
                                    'rejeter' => 'bg-red-50 text-red-700 border-red-200',
                                ];
                            @endphp
                            <span class="inline-flex items-center px-5 py-2.5 rounded-full text-sm font-semibold border-2 {{ $recoColors[$analyse->recommandation->value] ?? 'bg-gray-50 text-gray-600 border-gray-200' }}">
                                {{ match($analyse->recommandation->value) { 'convoquer' => __('To Contact'), 'attente' => __('On Hold'), 'rejeter' => __('Reject'), default => '—' } }}
                            </span>
                        </div>
                    @endif

                    <div class="card p-8 text-center">
                        <p class="text-sm text-gray-500 uppercase tracking-wider font-medium mb-4">{{ __('AI Assistant') }}</p>
                        <p class="text-sm text-gray-600 mb-4">{{ __('Chat with the assistant to explore this analysis.') }}</p>
                        <form action="{{ route('conversations.store', $analyse) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-primary w-full justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                {{ __("Discuter avec l'assistant") }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <a href="{{ route('offres.show', $analyse->offre) }}" class="btn-ghost">
                    &larr; {{ __('Back to Offer') }}
                </a>
            </div>
        @endif
    </div>
</x-app-layout>
