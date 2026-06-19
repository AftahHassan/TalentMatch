<x-app-layout>
    @section('title', 'Analyses')

    <div class="page-header">
        <div>
            <h1>Analyses</h1>
            <p>Évaluations de CV par IA</p>
        </div>
    </div>

    @if ($analyses->isEmpty())
        <div class="card">
            <x-empty-state title="Aucune analyse" subtitle="Soumettez un CV pour obtenir une analyse IA." />
        </div>
    @else
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:12px;">
            @foreach ($analyses as $analyse)
                <a href="{{ route('analyses.show', $analyse) }}" style="text-decoration:none;">
                    <div class="card" style="padding:16px;">
                        <div style="display:flex;align-items:center;gap:10px;margin-bottom:10px;">
                            <div style="width:32px;height:32px;border-radius:999px;background:#EFF6FF;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:700;color:#2563EB;">{{ strtoupper(substr($analyse->candidature?->nom ?? '?', 0, 2)) }}</div>
                            <div style="flex:1;min-width:0;">
                                <div style="font-size:13px;font-weight:600;color:#0F172A;">{{ $analyse->candidature?->nom ?? 'Inconnu' }}</div>
                                <div style="font-size:11px;color:#94A3B8;">{{ $analyse->offre?->titre }}</div>
                            </div>
                        </div>
                        <div style="display:flex;align-items:center;justify-content:space-between;">
                            <div style="font-size:20px;font-weight:700;color:{{ $analyse->score >= 70 ? '#22C55E' : ($analyse->score >= 40 ? '#F59E0B' : '#EF4444') }};">{{ $analyse->score ?? '—' }}</div>
                            @if ($analyse->recommandation)
                                <span class="badge {{ $analyse->recommandation->value === 'convoquer' ? 'badge-success' : ($analyse->recommandation->value === 'attente' ? 'badge-warning' : 'badge-danger') }}">
                                    {{ match($analyse->recommandation->value) { 'convoquer' => 'Convoquer', 'attente' => 'Attente', 'rejeter' => 'Rejeter', default => '—' } }}
                                </span>
                            @endif
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        @if ($analyses->hasPages())
            <div style="margin-top:16px;">{{ $analyses->links() }}</div>
        @endif
    @endif
</x-app-layout>
