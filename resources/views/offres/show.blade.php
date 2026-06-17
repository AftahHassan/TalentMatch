<x-app-layout>
    <x-slot name="header">{{ $offre->titre }}</x-slot>

    <div class="max-w-7xl mx-auto space-y-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 bg-white rounded-xl border border-gray-200 p-8">
                <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-4">{{ __('Description') }}</h3>
                <p class="text-gray-700 leading-relaxed">{{ $offre->description }}</p>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 p-8">
                <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-4">{{ __('Détails') }}</h3>
                <div class="space-y-4">
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wider">{{ __('Expérience requise') }}</p>
                        <p class="text-lg font-semibold text-gray-900 mt-1">{{ $offre->niveau_experience }} ans</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wider">{{ __('Compétences requises') }}</p>
                        <div class="flex flex-wrap gap-2 mt-2">
                            @foreach ($offre->competences_requises as $competence)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-indigo-50 text-indigo-700 text-xs font-medium">{{ $competence }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wider">{{ __('Date de création') }}</p>
                        <p class="text-sm text-gray-700 mt-1">{{ $offre->created_at->format('d F Y') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-200">
            <div class="px-8 py-5 border-b border-gray-100 flex items-center justify-between">
                <div>
                    <h3 class="font-semibold text-gray-900">{{ __('Candidatures') }}</h3>
                    <p class="text-sm text-gray-500">{{ $offre->analyses->count() }} candidature(s) reçue(s)</p>
                </div>
                <a href="{{ route('candidatures.create', $offre) }}"
                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-indigo-600 text-white font-medium text-sm hover:bg-indigo-500 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                    {{ __('Soumettre un CV') }}
                </a>
            </div>

            @if ($offre->analyses->isEmpty())
                <div class="p-8 text-center">
                    <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <p class="text-gray-500">{{ __('Aucune candidature pour le moment.') }}</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-8 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Candidat') }}</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Score') }}</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Statut') }}</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Recommandation') }}</th>
                                <th class="px-6 py-4"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($offre->analyses->sortByDesc('score') as $analyse)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-8 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-full bg-gray-100 flex items-center justify-center text-sm font-semibold text-gray-600">
                                                {{ substr($analyse->candidature?->nom ?? 'NA', 0, 2) }}
                                            </div>
                                            <span class="font-medium text-gray-900">{{ $analyse->candidature?->nom ?? 'N/A' }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($analyse->score !== null)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $analyse->score >= 70 ? 'bg-green-50 text-green-700' : ($analyse->score >= 40 ? 'bg-amber-50 text-amber-700' : 'bg-red-50 text-red-700') }}">
                                                {{ $analyse->score }}
                                            </span>
                                        @else
                                            <span class="text-gray-400">—</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($analyse->statut === 'en_attente')
                                            <span class="inline-flex items-center gap-1.5 text-sm text-yellow-700">
                                                <span class="w-2 h-2 rounded-full bg-yellow-400 animate-pulse"></span>
                                                {{ __('En attente') }}
                                            </span>
                                        @else
                                            <span class="text-sm text-green-700 font-medium">{{ __('Terminé') }}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @php
                                            $badgeColors = [
                                                'convoquer' => 'bg-green-50 text-green-700',
                                                'attente' => 'bg-amber-50 text-amber-700',
                                                'rejeter' => 'bg-red-50 text-red-700',
                                            ];
                                        @endphp
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $badgeColors[$analyse->recommandation?->value] ?? 'bg-gray-50 text-gray-600' }}">
                                            {{ match($analyse->recommandation?->value) { 'convoquer' => __('À convoquer'), 'attente' => __('En attente'), 'rejeter' => __('Rejeter'), default => '—' } }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="{{ route('analyses.show', $analyse) }}" class="text-indigo-600 hover:text-indigo-500 font-medium text-sm">
                                            {{ __('Voir l\'analyse') }} &rarr;
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <a href="{{ route('offres.index') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900 font-medium">
            &larr; {{ __('Retour aux offres') }}
        </a>
    </div>
</x-app-layout>
