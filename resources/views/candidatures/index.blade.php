@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Candidates</h1>
        <p class="mt-1.5 text-sm text-gray-500">All submitted CVs</p>
    </div>

    @if ($candidatures->isEmpty())
        <div class="card p-12 text-center">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/>
            </svg>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">No candidates yet</h3>
            <p class="text-gray-500">Candidates will appear here once they submit their CVs.</p>
        </div>
    @else
        <div class="card overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="text-left px-5 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Candidate</th>
                            <th class="text-left px-5 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Job Offer</th>
                            <th class="text-left px-5 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="text-left px-5 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Score</th>
                            <th class="text-left px-5 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Recommendation</th>
                            <th class="text-right px-5 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($candidatures as $candidature)
                            @php $analyse = $candidature->analyse; @endphp
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-full bg-brand-600 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                                            {{ strtoupper(substr($candidature->nom, 0, 2)) }}
                                        </div>
                                        <span class="font-medium text-gray-900">{{ $candidature->nom }}</span>
                                    </div>
                                </td>
                                <td class="px-5 py-4 text-gray-600">{{ $analyse?->offre?->titre ?? 'N/A' }}</td>
                                <td class="px-5 py-4">
                                    @php
                                        $statusColors = ['en_attente' => 'bg-gray-100 text-gray-700', 'termine' => 'badge-green', 'echec' => 'badge-red'];
                                        $statusLabels = ['en_attente' => 'Pending', 'termine' => 'Analyzed', 'echec' => 'Failed'];
                                    @endphp
                                    @if ($analyse && $analyse->statut)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $statusColors[$analyse->statut] ?? 'bg-gray-100 text-gray-700' }}">
                                            {{ $statusLabels[$analyse->statut] ?? $analyse->statut }}
                                        </span>
                                    @else
                                        <span class="text-gray-400">&mdash;</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4">
                                    @if ($analyse && $analyse->statut === 'termine' && $analyse->score !== null)
                                        <span class="font-semibold {{ $analyse->score >= 70 ? 'text-green-600' : ($analyse->score >= 40 ? 'text-amber-600' : 'text-red-600') }}">
                                            {{ $analyse->score }}/100
                                        </span>
                                    @else
                                        <span class="text-gray-400">&mdash;</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4">
                                    @if ($analyse && $analyse->recommandation)
                                        @php
                                            $recoColors = ['convoquer' => 'badge-green', 'attente' => 'badge-amber', 'rejeter' => 'badge-red'];
                                            $recoLabels = ['convoquer' => 'To Contact', 'attente' => 'On Hold', 'rejeter' => 'Reject'];
                                        @endphp
                                        <span class="{{ $recoColors[$analyse->recommandation->value] ?? 'badge' }}">
                                            {{ $recoLabels[$analyse->recommandation->value] ?? '—' }}
                                        </span>
                                    @else
                                        <span class="text-gray-400">&mdash;</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        @if ($analyse)
                                            <a href="{{ route('analyses.show', $analyse) }}" class="btn-primary text-xs px-3 py-1.5">
                                                View Analysis
                                            </a>
                                            @if ($analyse->statut === 'termine')
                                                <form action="{{ route('conversations.store', $analyse) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center text-gray-600 transition" title="Chat">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6">
            {{ $candidatures->links() }}
        </div>
    @endif
</div>
@endsection
