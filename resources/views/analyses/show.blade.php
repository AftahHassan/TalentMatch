<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Analyse') }} — {{ $analyse->candidature?->nom ?? 'N/A' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if ($analyse->statut === 'en_attente')
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                            <div class="flex">
                                <div class="ml-3">
                                    <p class="text-sm text-yellow-700">
                                        {{ __('Analyse en cours... Le résultat sera bientôt disponible.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                            <div class="lg:col-span-2 space-y-6">

                                <div>
                                    <h3 class="text-lg font-medium mb-2">{{ __('Candidat') }}</h3>
                                    <p class="text-gray-700">{{ $analyse->candidature?->nom }}</p>
                                </div>

                                <div>
                                    <h3 class="text-lg font-medium mb-2">{{ __('Offre') }}</h3>
                                    <p class="text-gray-700">{{ $analyse->offre?->titre }}</p>
                                </div>

                                @if ($analyse->justification)
                                    <div>
                                        <h3 class="text-lg font-medium mb-2">{{ __('Justification') }}</h3>
                                        <p class="text-gray-700 whitespace-pre-line">{{ $analyse->justification }}</p>
                                    </div>
                                @endif

                                @if (!empty($analyse->points_forts))
                                    <div>
                                        <h3 class="text-lg font-medium mb-2">{{ __('Points forts') }}</h3>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach ($analyse->points_forts as $point)
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">{{ $point }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                @if (!empty($analyse->lacunes))
                                    <div>
                                        <h3 class="text-lg font-medium mb-2">{{ __('Lacunes') }}</h3>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach ($analyse->lacunes as $lacune)
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">{{ $lacune }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                @if (!empty($analyse->competences_manquantes))
                                    <div>
                                        <h3 class="text-lg font-medium mb-2">{{ __('Compétences manquantes') }}</h3>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach ($analyse->competences_manquantes as $manquante)
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">{{ $manquante }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                @if (!empty($analyse->competences))
                                    <div>
                                        <h3 class="text-lg font-medium mb-2">{{ __('Compétences') }}</h3>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach ($analyse->competences as $competence)
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">{{ $competence }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                @if (!empty($analyse->langues))
                                    <div>
                                        <h3 class="text-lg font-medium mb-2">{{ __('Langues') }}</h3>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach ($analyse->langues as $langue)
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">{{ $langue }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                            </div>

                            <div class="space-y-6">

                                @if ($analyse->score !== null)
                                    <div class="text-center">
                                        <h3 class="text-lg font-medium mb-2">{{ __('Score') }}</h3>
                                        <div class="inline-flex items-center justify-center w-32 h-32 rounded-full text-4xl font-bold
                                            {{ $analyse->score >= 70 ? 'bg-green-100 text-green-800' : ($analyse->score >= 40 ? 'bg-orange-100 text-orange-800' : 'bg-red-100 text-red-800') }}">
                                            {{ $analyse->score }}
                                        </div>
                                    </div>
                                @endif

                                @if ($analyse->recommandation)
                                    <div class="text-center">
                                        <h3 class="text-lg font-medium mb-2">{{ __('Recommandation') }}</h3>
                                        @php
                                            $badgeColors = [
                                                'convoquer' => 'bg-green-100 text-green-800',
                                                'attente' => 'bg-orange-100 text-orange-800',
                                                'rejeter' => 'bg-red-100 text-red-800',
                                            ];
                                        @endphp
                                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium {{ $badgeColors[$analyse->recommandation->value] ?? 'bg-gray-100 text-gray-800' }}">
                                            {{ __($analyse->recommandation->value) }}
                                        </span>
                                    </div>
                                @endif

                                @if ($analyse->annees_experience !== null)
                                    <div class="text-center">
                                        <h3 class="text-lg font-medium mb-2">{{ __('Expérience') }}</h3>
                                        <p class="text-2xl font-semibold text-gray-700">{{ $analyse->annees_experience }} ans</p>
                                    </div>
                                @endif

                                @if ($analyse->niveau_etude)
                                    <div class="text-center">
                                        <h3 class="text-lg font-medium mb-2">{{ __('Niveau d\'études') }}</h3>
                                        <p class="text-xl text-gray-700">{{ $analyse->niveau_etude }}</p>
                                    </div>
                                @endif

                            </div>

                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <a href="{{ route('offres.show', $analyse->offre) }}" class="text-indigo-600 hover:text-indigo-900 text-sm">
                        {{ __('Retour à l\'offre') }}
                    </a>

                    <a href="#" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500">
                        {{ __('Discuter avec l\'assistant') }}
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
