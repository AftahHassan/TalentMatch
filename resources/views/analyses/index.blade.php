@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Analyses</h1>
        <p class="mt-1.5 text-sm text-gray-500">AI-powered CV evaluations</p>
    </div>

    <div class="flex items-center gap-2 mb-6">
        @php $activeReco = request('recommandation'); @endphp
        <a href="{{ route('analyses.index') }}" class="px-4 py-1.5 rounded-full text-sm font-medium transition {{ !$activeReco ? 'bg-brand-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
            All
        </a>
        <a href="{{ route('analyses.index', ['recommandation' => 'convoquer']) }}" class="px-4 py-1.5 rounded-full text-sm font-medium transition {{ $activeReco === 'convoquer' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
            À convoquer
        </a>
        <a href="{{ route('analyses.index', ['recommandation' => 'attente']) }}" class="px-4 py-1.5 rounded-full text-sm font-medium transition {{ $activeReco === 'attente' ? 'bg-amber-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
            En attente
        </a>
        <a href="{{ route('analyses.index', ['recommandation' => 'rejeter']) }}" class="px-4 py-1.5 rounded-full text-sm font-medium transition {{ $activeReco === 'rejeter' ? 'bg-red-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
            À rejeter
        </a>
    </div>

    @if ($analyses->isEmpty())
        <div class="card p-12 text-center">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                <path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
            </svg>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">No analyses yet</h3>
            <p class="text-gray-500">Analyses will appear once candidates submit their CVs and evaluations are completed.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach ($analyses as $analyse)
                @php
                    $borderColors = ['convoquer' => 'border-l-green-500', 'attente' => 'border-l-amber-500', 'rejeter' => 'border-l-red-500'];
                    $scoreColors = $analyse->score >= 70 ? 'text-green-600' : ($analyse->score >= 40 ? 'text-amber-600' : 'text-red-600');
                    $recoColors = ['convoquer' => 'badge-green', 'attente' => 'badge-amber', 'rejeter' => 'badge-red'];
                    $recoLabels = ['convoquer' => 'À convoquer', 'attente' => 'En attente', 'rejeter' => 'À rejeter'];
                @endphp
                <div class="card p-6 border-l-4 {{ $borderColors[$analyse->recommandation?->value] ?? 'border-l-gray-300' }}">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-full bg-brand-600 flex items-center justify-center text-white text-sm font-bold flex-shrink-0">
                            {{ strtoupper(substr($analyse->candidature?->nom ?? '?', 0, 2)) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-gray-900 truncate">{{ $analyse->candidature?->nom ?? 'Unknown' }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ $analyse->offre?->titre }}</p>
                        </div>
                    </div>

                    <div class="flex items-end justify-between mb-4">
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Score</p>
                            <p class="text-3xl font-bold {{ $scoreColors }}">{{ $analyse->score ?? '—' }}</p>
                        </div>
                        @if ($analyse->recommandation)
                            <span class="{{ $recoColors[$analyse->recommandation->value] ?? 'badge' }}">
                                {{ $recoLabels[$analyse->recommandation->value] ?? '—' }}
                            </span>
                        @endif
                    </div>

                    <div class="flex items-center gap-2 pt-4 border-t border-gray-100">
                        <a href="{{ route('analyses.show', $analyse) }}" class="btn-primary flex-1 justify-center text-xs px-3 py-2">
                            View Details
                        </a>
                        <form action="{{ route('conversations.store', $analyse) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="btn-secondary px-3 py-2 text-xs" title="Chat">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                                Chat
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $analyses->links() }}
        </div>
    @endif
</div>
@endsection
