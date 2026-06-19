<x-app-layout>
    @section('title', 'Candidats')

    <x-slot name="header">Candidats</x-slot>
    <x-slot name="subtitle">Gérez et analysez les candidatures reçues</x-slot>

    {{-- Filters row --}}
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:20px;flex-wrap:wrap;">
        <form action="{{ route('candidatures.index') }}" method="GET" style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;flex:1;">
            <div style="position:relative;flex:1;min-width:200px;max-width:320px;">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4" style="color:var(--color-text-muted);" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Rechercher un candidat..." class="input-field" style="padding-left:34px;">
            </div>
            <select name="poste" class="input-field" style="width:auto;min-width:150px;">
                <option value="">Tous les postes</option>
            </select>
            <select name="score" class="input-field" style="width:auto;min-width:130px;">
                <option value="">Tous scores</option>
                <option value="70">≥ 70</option>
                <option value="40">40–69</option>
                <option value="0">&lt; 40</option>
            </select>
            <select name="statut" class="input-field" style="width:auto;min-width:140px;">
                <option value="">Tous statuts</option>
                <option value="termine">Analysé</option>
                <option value="en_attente">En attente</option>
                <option value="echec">Échec</option>
            </select>
            <button type="submit" class="btn-primary">Filtrer</button>
        </form>
    </div>

    @if ($candidatures->isEmpty())
        <div class="card">
            <x-empty-state title="Aucun candidat pour le moment" subtitle="Les candidatures soumises apparaîtront ici." />
        </div>
    @else
        <div class="card" style="overflow:hidden;">
            <div style="overflow-x:auto;">
                <table style="width:100%;border-collapse:collapse;">
                    <thead>
                        <tr>
                            <th class="table-header">Candidat</th>
                            <th class="table-header">Poste</th>
                            <th class="table-header">Score</th>
                            <th class="table-header">Statut</th>
                            <th class="table-header">Date</th>
                            <th class="table-header" style="width:120px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($candidatures as $candidature)
                            @php $analyse = $candidature->analyse; @endphp
                            <tr>
                                <td class="table-cell" style="font-weight:500;color:var(--color-text-primary);">
                                    <div style="display:flex;align-items:center;gap:10px;">
                                        <div style="width:28px;height:28px;border-radius:999px;background:var(--color-primary);display:flex;align-items:center;justify-content:center;font-size:10px;font-weight:700;color:#fff;flex-shrink:0;">
                                            {{ strtoupper(substr($candidature->nom, 0, 2)) }}
                                        </div>
                                        <div>
                                            <div style="font-size:13.5px;">{{ $candidature->nom }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="table-cell" style="color:var(--color-text-secondary);">{{ $analyse?->offre?->titre ?? 'N/A' }}</td>
                                <td class="table-cell">
                                    @if ($analyse && $analyse->statut === 'termine' && $analyse->score !== null)
                                        <x-badge variant="{{ $analyse->score >= 70 ? 'success' : ($analyse->score >= 40 ? 'warning' : 'danger') }}">
                                            {{ $analyse->score }}/100
                                        </x-badge>
                                    @else
                                        <span style="color:var(--color-text-muted);font-size:12px;">—</span>
                                    @endif
                                </td>
                                <td class="table-cell">
                                    @if ($analyse && $analyse->statut)
                                        <x-badge variant="{{ $analyse->statut === 'termine' ? 'success' : ($analyse->statut === 'en_attente' ? 'warning' : 'danger') }}">
                                            {{ $analyse->statut === 'termine' ? 'Analysé' : ($analyse->statut === 'en_attente' ? 'En attente' : 'Échec') }}
                                        </x-badge>
                                    @else
                                        <span style="color:var(--color-text-muted);">—</span>
                                    @endif
                                </td>
                                <td class="table-cell" style="color:var(--color-text-muted);font-size:12.5px;">{{ $candidature->created_at->format('d/m/Y') }}</td>
                                <td class="table-cell" style="text-align:right;">
                                    <div style="display:flex;align-items:center;justify-content:flex-end;gap:6px;">
                                        @if ($analyse)
                                            <a href="{{ route('analyses.show', $analyse) }}" class="btn-icon" style="width:32px;height:32px;" title="Voir l'analyse">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" style="color:var(--color-text-muted);"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            </a>
                                            @if ($analyse->statut === 'termine')
                                                <form action="{{ route('conversations.store', $analyse) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn-icon" style="width:32px;height:32px;" title="Chat IA">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" style="color:var(--color-text-muted);"><path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                                    </button>
                                                </form>
                                            @endif
                                        @endif
                                        <form action="{{ route('offres.destroy', $candidature->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Supprimer ce candidat ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-icon" style="width:32px;height:32px;border-color:transparent;" title="Supprimer">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" style="color:var(--color-text-muted);"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if ($candidatures->hasPages())
                <div style="padding:16px 20px;border-top:1px solid var(--color-border-soft);display:flex;justify-content:center;">
                    {{ $candidatures->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    @endif
</x-app-layout>
