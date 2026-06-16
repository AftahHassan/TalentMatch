<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $offre->titre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Critères de l'offre --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <dl class="grid grid-cols-1 gap-4">
                        <div>
                            <dt class="font-medium text-gray-500">{{ __('Description') }}</dt>
                            <dd class="mt-1">{{ $offre->description }}</dd>
                        </div>

                        <div>
                            <dt class="font-medium text-gray-500">{{ __('Compétences requises') }}</dt>
                            <dd class="mt-1">
                                @foreach ($offre->competences_requises as $competence)
                                    <span class="inline-block bg-indigo-100 text-indigo-800 text-sm px-2 py-1 rounded mr-1">{{ $competence }}</span>
                                @endforeach
                            </dd>
                        </div>

                        <div>
                            <dt class="font-medium text-gray-500">{{ __('Niveau d\'expérience') }}</dt>
                            <dd class="mt-1">{{ $offre->niveau_experience }} ans</dd>
                        </div>
                    </dl>
                </div>
            </div>

            {{-- Candidatures --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">{{ __('Candidatures') }}</h3>

                    @if ($offre->analyses->isEmpty())
                        <p class="text-gray-500">{{ __('Aucune candidature pour le moment.') }}</p>
                    @else
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Candidat') }}</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Score') }}</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Recommandation') }}</th>
                                    <th class="px-6 py-3"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($offre->analyses->sortByDesc('score') as $analyse)
                                    <tr>
                                        <td class="px-6 py-4">{{ $analyse->candidature?->nom ?? 'N/A' }}</td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium
                                                {{ $analyse->score >= 70 ? 'bg-green-100 text-green-800' : ($analyse->score >= 40 ? 'bg-orange-100 text-orange-800' : 'bg-red-100 text-red-800') }}">
                                                {{ $analyse->score }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            @php
                                                $badgeColors = [
                                                    'convoquer' => 'bg-green-100 text-green-800',
                                                    'attente' => 'bg-orange-100 text-orange-800',
                                                    'rejeter' => 'bg-red-100 text-red-800',
                                                ];
                                            @endphp
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium {{ $badgeColors[$analyse->recommandation->value] ?? 'bg-gray-100 text-gray-800' }}">
                                                {{ __($analyse->recommandation->value) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <a href="{{ route('analyses.show', $analyse) }}" class="text-indigo-600 hover:text-indigo-900 text-sm">{{ __('Voir l\'analyse') }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                    <div class="mt-4">
                        <a href="{{ route('candidatures.create', $offre) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500">
                            {{ __('Soumettre un CV') }}
                        </a>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <a href="{{ route('offres.index') }}" class="text-indigo-600 hover:text-indigo-900">{{ __('Retour aux offres') }}</a>
            </div>
        </div>
    </div>
</x-app-layout>
