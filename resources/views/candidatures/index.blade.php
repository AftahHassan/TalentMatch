<x-app-layout>
    @section('title', 'Candidats')

    <div class="page-header">
        <div>
            <h1>Candidats</h1>
            <p>Liste des candidats soumis</p>
        </div>
    </div>

    @if ($candidatures->isEmpty())
        <div class="card">
            <x-empty-state title="Aucun candidat" subtitle="Soumettez un CV depuis une offre d'emploi." />
        </div>
    @else
        <div class="card" style="overflow:hidden;">
            <table style="width:100%;border-collapse:collapse;">
                <thead>
                    <tr>
                        <th class="table-header">Nom</th>
                        <th class="table-header">Offre</th>
                        <th class="table-header">Date</th>
                        <th class="table-header">Score</th>
                        <th class="table-header" style="width:40px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($candidatures as $candidature)
                        <tr>
                            <td class="table-cell" style="font-weight:500;color:var(--color-text-primary);">{{ $candidature->nom }}</td>
                            <td class="table-cell">{{ $candidature->analyse?->offre?->titre ?? '—' }}</td>
                            <td class="table-cell">{{ $candidature->created_at->format('d/m/Y') }}</td>
                            <td class="table-cell">
                                @if ($candidature->analyse && $candidature->analyse->score !== null)
                                    <span class="badge {{ $candidature->analyse->score >= 70 ? 'badge-success' : ($candidature->analyse->score >= 40 ? 'badge-warning' : 'badge-danger') }}">{{ $candidature->analyse->score }}/100</span>
                                @else
                                    <span class="badge badge-neutral">En attente</span>
                                @endif
                            </td>
                            <td class="table-cell" style="text-align:right;">
                                @if ($candidature->analyse)
                                    <a href="{{ route('analyses.show', $candidature->analyse) }}" style="color:var(--color-text-muted);text-decoration:none;">
                                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($candidatures->hasPages())
            <div style="margin-top:16px;">{{ $candidatures->links() }}</div>
        @endif
    @endif
</x-app-layout>
