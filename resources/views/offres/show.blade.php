<x-app-layout>
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;">
        <div>
            <h1 style="font-size:20px;font-weight:600;color:var(--color-text-primary);margin:0 0 4px;">{{ $offre->titre }}</h1>
            <p style="font-size:13px;color:var(--color-text-secondary);margin:0;">Détails de l'offre d'emploi</p>
        </div>
        <div style="display:flex;gap:8px;">
            <a href="{{ route('offres.edit', $offre) }}" class="btn-secondary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                Modifier
            </a>
        </div>
    </div>

    <div style="display:grid;grid-template-columns:2fr 1fr;gap:20px;margin-bottom:24px;">
        <div class="card" style="padding:24px 28px;">
            <div class="section-label" style="margin-bottom:12px;">Description</div>
            <p style="font-size:14px;color:var(--color-text-secondary);line-height:1.7;margin:0;">{{ $offre->description }}</p>
        </div>

        <div class="card" style="padding:24px 28px;">
            <div class="section-label" style="margin-bottom:16px;">Détails</div>
            <div style="display:flex;flex-direction:column;gap:16px;">
                <div>
                    <p style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:var(--color-text-muted);margin:0 0 4px;">Expérience requise</p>
                    <p style="font-size:16px;font-weight:600;color:var(--color-text-primary);margin:0;">{{ $offre->niveau_experience }} ans</p>
                </div>
                <div>
                    <p style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:var(--color-text-muted);margin:0 0 8px;">Compétences requises</p>
                    <div style="display:flex;flex-wrap:wrap;gap:6px;">
                        @foreach ($offre->competences_requises as $competence)
                            <span class="badge badge-blue">{{ $competence }}</span>
                        @endforeach
                    </div>
                </div>
                <div>
                    <p style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:var(--color-text-muted);margin:0 0 4px;">Date de création</p>
                    <p style="font-size:14px;color:var(--color-text-secondary);margin:0;">{{ $offre->created_at->format('d F Y') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card" style="overflow:hidden;">
        <div style="display:flex;align-items:center;justify-content:space-between;padding:18px 24px 16px;border-bottom:1px solid var(--color-border);">
            <div>
                <h3 style="font-size:15px;font-weight:600;color:var(--color-text-primary);margin:0 0 2px;">Candidatures</h3>
                <p style="font-size:12px;color:var(--color-text-secondary);margin:0;">{{ $offre->analyses->count() }} candidature(s) reçue(s)</p>
            </div>
            <a href="{{ route('candidatures.create', $offre) }}" class="btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                Soumettre un CV
            </a>
        </div>

        @if ($offre->analyses->isEmpty())
            <div style="padding:40px 24px;text-align:center;">
                <svg class="w-14 h-14" style="color:var(--color-text-muted);margin:0 auto 12px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <p style="font-size:14px;font-weight:500;color:var(--color-text-secondary);margin:0 0 4px;">Aucune candidature pour le moment.</p>
                <p style="font-size:12px;color:var(--color-text-muted);margin:0;">Soumettez un CV pour démarrer l'analyse par IA.</p>
            </div>
        @else
            <div style="overflow-x:auto;">
                <table style="width:100%;border-collapse:collapse;">
                    <thead>
                        <tr>
                            <th class="table-header">Candidat</th>
                            <th class="table-header">Score</th>
                            <th class="table-header">Statut</th>
                            <th class="table-header">Recommandation</th>
                            <th class="table-header" style="width:40px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($offre->analyses->sortByDesc('score') as $analyse)
                            <tr>
                                <td class="table-cell">
                                    <div style="display:flex;align-items:center;gap:9px;">
                                        <div style="width:28px;height:28px;border-radius:999px;background:var(--color-accent-light);display:flex;align-items:center;justify-content:center;font-size:10px;font-weight:600;color:var(--color-accent);flex-shrink:0;">{{ substr($analyse->candidature?->nom ?? 'NA', 0, 2) }}</div>
                                        <span style="font-size:13px;font-weight:500;color:var(--color-text-primary);">{{ $analyse->candidature?->nom ?? 'N/A' }}</span>
                                    </div>
                                </td>
                                <td class="table-cell">
                                    @if ($analyse->score !== null)
                                        <x-badge variant="{{ $analyse->score >= 70 ? 'success' : ($analyse->score >= 40 ? 'warning' : 'danger') }}">{{ $analyse->score }}</x-badge>
                                    @else
                                        <span style="color:var(--color-text-muted);">—</span>
                                    @endif
                                </td>
                                <td class="table-cell">
                                    @if ($analyse->statut === 'en_attente')
                                        <span style="display:inline-flex;align-items:center;gap:5px;font-size:12px;color:#a16207;"><span style="width:6px;height:6px;border-radius:999px;background:#eab308;"></span>En attente</span>
                                    @else
                                        <span style="display:inline-flex;align-items:center;gap:5px;font-size:12px;color:var(--color-success-text);"><span style="width:6px;height:6px;border-radius:999px;background:var(--color-success);"></span>Terminé</span>
                                    @endif
                                </td>
                                <td class="table-cell">
                                    @php
                                        $badgeVariant = match($analyse->recommandation?->value) {
                                            'convoquer' => 'success',
                                            'attente' => 'warning',
                                            'rejeter' => 'danger',
                                            default => 'neutral'
                                        };
                                        $recoLabel = match($analyse->recommandation?->value) {
                                            'convoquer' => 'À convoquer',
                                            'attente' => 'En attente',
                                            'rejeter' => 'Rejeter',
                                            default => '—'
                                        };
                                    @endphp
                                    <x-badge variant="{{ $badgeVariant }}">{{ $recoLabel }}</x-badge>
                                </td>
                                <td class="table-cell" style="text-align:right;">
                                    <a href="{{ route('analyses.show', $analyse) }}" style="font-size:12px;color:var(--color-accent);text-decoration:none;font-weight:600;">Voir →</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <div style="margin-top:24px;">
        <a href="{{ route('offres.index') }}" style="font-size:13px;color:var(--color-accent);text-decoration:none;font-weight:500;display:flex;align-items:center;gap:6px;">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Retour aux offres
        </a>
    </div>
</x-app-layout>
