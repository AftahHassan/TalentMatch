<x-app-layout>
    @section('title', 'Analyses')

    <x-slot name="header">Analyses</x-slot>
    <x-slot name="subtitle">Évaluations de CV par IA</x-slot>

    <div style="display:flex;align-items:center;gap:8px;margin-bottom:24px;flex-wrap:wrap;">
        @php $activeReco = request('recommandation'); @endphp
        <a href="{{ route('analyses.index') }}" class="px-4 py-1.5 rounded-full text-sm font-medium transition"
            style="background:{{ !$activeReco ? 'var(--color-primary)' : 'var(--color-border-soft)' }};color:{{ !$activeReco ? '#fff' : 'var(--color-text-secondary)' }};font-family:var(--font-sans);text-decoration:none;">
            Toutes
        </a>
        <a href="{{ route('analyses.index', ['recommandation' => 'convoquer']) }}" class="px-4 py-1.5 rounded-full text-sm font-medium transition"
            style="background:{{ $activeReco === 'convoquer' ? 'var(--color-success)' : 'var(--color-border-soft)' }};color:{{ $activeReco === 'convoquer' ? '#fff' : 'var(--color-text-secondary)' }};font-family:var(--font-sans);text-decoration:none;">
            À convoquer
        </a>
        <a href="{{ route('analyses.index', ['recommandation' => 'attente']) }}" class="px-4 py-1.5 rounded-full text-sm font-medium transition"
            style="background:{{ $activeReco === 'attente' ? 'var(--color-warning)' : 'var(--color-border-soft)' }};color:{{ $activeReco === 'attente' ? '#fff' : 'var(--color-text-secondary)' }};font-family:var(--font-sans);text-decoration:none;">
            En attente
        </a>
        <a href="{{ route('analyses.index', ['recommandation' => 'rejeter']) }}" class="px-4 py-1.5 rounded-full text-sm font-medium transition"
            style="background:{{ $activeReco === 'rejeter' ? 'var(--color-danger)' : 'var(--color-border-soft)' }};color:{{ $activeReco === 'rejeter' ? '#fff' : 'var(--color-text-secondary)' }};font-family:var(--font-sans);text-decoration:none;">
            À rejeter
        </a>
    </div>

    @if ($analyses->isEmpty())
        <div class="card">
            <x-empty-state title="Aucune analyse pour le moment" subtitle="Les analyses apparaîtront une fois les CV soumis et évalués." />
        </div>
    @else
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:16px;">
            @foreach ($analyses as $analyse)
                @php
                    $borderColor = $analyse->recommandation?->value === 'convoquer' ? 'var(--color-success)' : ($analyse->recommandation?->value === 'attente' ? 'var(--color-warning)' : ($analyse->recommandation?->value === 'rejeter' ? 'var(--color-danger)' : 'var(--color-border)'));
                @endphp
                <div class="card" style="padding:20px;border-left:4px solid {{ $borderColor }};display:flex;flex-direction:column;gap:16px;">
                    <div style="display:flex;align-items:center;gap:12px;">
                        <div style="width:36px;height:36px;border-radius:999px;background:var(--color-primary);display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;color:#fff;flex-shrink:0;">
                            {{ strtoupper(substr($analyse->candidature?->nom ?? '?', 0, 2)) }}
                        </div>
                        <div style="flex:1;min-width:0;">
                            <p style="font-family:var(--font-serif);font-size:14px;font-weight:600;color:var(--color-text-primary);margin:0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $analyse->candidature?->nom ?? 'Inconnu' }}</p>
                            <p style="font-family:var(--font-sans);font-size:12px;color:var(--color-text-muted);margin:0;">{{ $analyse->offre?->titre }}</p>
                        </div>
                    </div>

                    <div style="display:flex;align-items:flex-end;justify-content:space-between;">
                        <div>
                            <p style="font-family:var(--font-sans);font-size:11px;color:var(--color-text-muted);text-transform:uppercase;letter-spacing:0.04em;font-weight:500;margin:0 0 4px;">Score</p>
                            <p style="font-family:var(--font-serif);font-size:24px;font-weight:600;color:{{ $analyse->score >= 70 ? 'var(--color-success)' : ($analyse->score >= 40 ? 'var(--color-warning)' : 'var(--color-danger)') }};margin:0;">{{ $analyse->score ?? '—' }}</p>
                        </div>
                        @if ($analyse->recommandation)
                            <x-badge variant="{{ $analyse->recommandation->value === 'convoquer' ? 'success' : ($analyse->recommandation->value === 'attente' ? 'warning' : 'danger') }}">
                                {{ match($analyse->recommandation->value) { 'convoquer' => 'À convoquer', 'attente' => 'En attente', 'rejeter' => 'À rejeter', default => '—' } }}
                            </x-badge>
                        @endif
                    </div>

                    <div style="display:flex;align-items:center;gap:8px;padding-top:12px;border-top:1px solid var(--color-border-soft);">
                        <a href="{{ route('analyses.show', $analyse) }}" class="btn-primary" style="flex:1;font-size:12px;padding:8px 16px;">
                            Voir les détails
                        </a>
                        <form action="{{ route('conversations.store', $analyse) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn-secondary" style="font-size:12px;padding:8px 14px;">
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

        @if ($analyses->hasPages())
            <div style="margin-top:24px;display:flex;justify-content:center;">
                {{ $analyses->links('pagination::bootstrap-5') }}
            </div>
        @endif
    @endif
</x-app-layout>
