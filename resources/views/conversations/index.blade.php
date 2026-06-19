<x-app-layout>
    @section('title', 'Chat IA')

    <div class="page-header">
        <div>
            <h1>Chat IA</h1>
            <p>Historique de vos conversations</p>
        </div>
    </div>

    @if ($conversations->isEmpty())
        <div class="card">
            <x-empty-state title="Aucune conversation" subtitle="Lancez une discussion depuis l'analyse d'un candidat." />
        </div>
    @else
        <div style="display:flex;flex-direction:column;gap:8px;">
            @foreach ($conversations as $conv)
                <a href="{{ route('conversations.show', $conv) }}" style="text-decoration:none;">
                    <div class="card" style="padding:14px 18px;display:flex;align-items:center;gap:12px;">
                        <div style="width:36px;height:36px;border-radius:999px;background:#EFF6FF;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <svg width="16" height="16" fill="none" stroke="#2563EB" viewBox="0 0 24 24" stroke-width="2"><path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        </div>
                        <div style="flex:1;min-width:0;">
                            <div style="font-size:13px;font-weight:600;color:#0F172A;">{{ $conv->titre }}</div>
                            <div style="font-size:11px;color:#94A3B8;">{{ $conv->analyse->candidature?->nom ?? '—' }} · {{ $conv->created_at->diffForHumans() }}</div>
                        </div>
                        <svg width="14" height="14" fill="none" stroke="var(--color-text-muted)" viewBox="0 0 24 24" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
                    </div>
                </a>
            @endforeach
        </div>
        @if ($conversations->hasPages())
            <div style="margin-top:16px;">{{ $conversations->links() }}</div>
        @endif
    @endif
</x-app-layout>
