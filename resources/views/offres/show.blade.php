<x-app-layout>
    <x-slot name="header">{{ $offre->titre }}</x-slot>

    <div class="max-w-7xl mx-auto space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">{{ $offre->titre }}</h1>
                <p class="text-sm text-gray-500 mt-1">{{ __('Job Offer Details') }}</p>
            </div>
            <a href="{{ route('offres.edit', $offre) }}" class="btn-secondary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                {{ __('Edit') }}
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 card p-8">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4">{{ __('Description') }}</h3>
                <p class="text-gray-700 leading-relaxed">{{ $offre->description }}</p>
            </div>

            <div class="card p-8">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4">{{ __('Details') }}</h3>
                <div class="space-y-5">
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wider">{{ __('Experience Required') }}</p>
                        <p class="text-lg font-semibold text-gray-900 mt-1">{{ $offre->niveau_experience }} {{ __('years') }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wider">{{ __('Required Skills') }}</p>
                        <div class="flex flex-wrap gap-2 mt-2">
                            @foreach ($offre->competences_requises as $competence)
                                <span class="badge-blue">{{ $competence }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wider">{{ __('Created Date') }}</p>
                        <p class="text-sm text-gray-700 mt-1">{{ $offre->created_at->format('d F Y') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="px-8 py-5 border-b border-gray-100 flex items-center justify-between">
                <div>
                    <h3 class="font-semibold text-gray-900">{{ __('Candidatures') }}</h3>
                    <p class="text-sm text-gray-500">{{ $offre->analyses->count() }} {{ __('candidature(s) received') }}</p>
                </div>
                <a href="{{ route('candidatures.create', $offre) }}" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                    {{ __('Submit New CV') }}
                </a>
            </div>

            @if ($offre->analyses->isEmpty())
                <div class="p-12 text-center">
                    <svg class="w-14 h-14 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <p class="text-gray-500 font-medium">{{ __('No candidatures yet.') }}</p>
                    <p class="text-sm text-gray-400 mt-1">{{ __('Submit a CV to get started with AI-powered analysis.') }}</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-8 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ __('Candidate') }}</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ __('Score') }}</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ __('Status') }}</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ __('Recommendation') }}</th>
                                <th class="px-6 py-4"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($offre->analyses->sortByDesc('score') as $analyse)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-8 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-full bg-brand-600/10 flex items-center justify-center text-sm font-semibold text-brand-600">
                                                {{ substr($analyse->candidature?->nom ?? 'NA', 0, 2) }}
                                            </div>
                                            <span class="font-medium text-gray-900">{{ $analyse->candidature?->nom ?? 'N/A' }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($analyse->score !== null)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $analyse->score >= 70 ? 'badge-green' : ($analyse->score >= 40 ? 'badge-amber' : 'badge-red') }}">
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
                                                {{ __('Pending') }}
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 text-sm text-green-700 font-medium">
                                                <span class="w-2 h-2 rounded-full bg-green-500"></span>
                                                {{ __('Done') }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @php
                                            $badgeColors = [
                                                'convoquer' => 'badge-green',
                                                'attente' => 'badge-amber',
                                                'rejeter' => 'badge-red',
                                            ];
                                        @endphp
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $badgeColors[$analyse->recommandation?->value] ?? 'bg-gray-50 text-gray-600' }}">
                                            {{ match($analyse->recommandation?->value) { 'convoquer' => __('To interview'), 'attente' => __('On hold'), 'rejeter' => __('Reject'), default => '—' } }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="{{ route('analyses.show', $analyse) }}" class="text-brand-600 hover:text-brand-700 font-medium text-sm">
                                            {{ __('View Analysis') }} &rarr;
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <a href="{{ route('offres.index') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900 font-medium gap-1.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            {{ __('Back to Job Offers') }}
        </a>
    </div>
</x-app-layout>
