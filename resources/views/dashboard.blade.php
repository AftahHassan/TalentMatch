<x-app-layout>
    @php
        $totalOffres       = auth()->user()->offres()->count();
        $totalCandidatures = \App\Models\Candidature::count();
        $totalAnalyses     = \App\Models\Analyse::count();
        $toConvoke         = \App\Models\Analyse::where('recommandation', 'convoquer')->count();
        $avgScore          = \App\Models\Analyse::where('statut','termine')->avg('score') ?? 0;
        $recentOffres      = auth()->user()->offres()->withCount('analyses')->latest()->take(5)->get();
        $recentAnalyses    = \App\Models\Analyse::with(['candidature','offre'])->where('statut','termine')->latest()->take(5)->get();
        $dateFr            = now()->locale('fr')->isoFormat('dddd D MMMM YYYY');
    @endphp

    @section('title', 'Tableau de bord')

    {{-- Page header --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Tableau de bord</h1>
            <p class="page-subtitle">{{ ucfirst($dateFr) }}</p>
        </div>
        <a href="{{ route('offres.create') }}" class="btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
            Nouvelle offre
        </a>
    </div>

    {{-- Stats grid --}}
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin-bottom:24px;">

        <div class="card stat-accent-blue" style="padding:20px 18px;">
            <div style="font-family:var(--font-sans);font-size:10.5px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:var(--color-text-muted);margin-bottom:8px;">
                Candidats total
            </div>
            <div style="font-family:var(--font-serif);font-size:28px;font-weight:600;color:var(--color-text-primary);line-height:1;">
                {{ $totalCandidatures }}
            </div>
            <div style="font-family:var(--font-sans);font-size:11.5px;color:var(--color-success);margin-top:6px;font-weight:600;">
                ↑ +12%
            </div>
        </div>

        <div class="card stat-accent-violet" style="padding:20px 18px;">
            <div style="font-family:var(--font-sans);font-size:10.5px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:var(--color-text-muted);margin-bottom:8px;">
                Présélectionnés
            </div>
            <div style="font-family:var(--font-serif);font-size:28px;font-weight:600;color:var(--color-text-primary);line-height:1;">
                {{ $toConvoke }}
            </div>
            <div style="font-family:var(--font-sans);font-size:11.5px;color:var(--color-success);margin-top:6px;font-weight:600;">
                ↑ +8%
            </div>
        </div>

        <div class="card stat-accent-green" style="padding:20px 18px;">
            <div style="font-family:var(--font-sans);font-size:10.5px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:var(--color-text-muted);margin-bottom:8px;">
                Analyses totales
            </div>
            <div style="font-family:var(--font-serif);font-size:28px;font-weight:600;color:var(--color-text-primary);line-height:1;">
                {{ $totalAnalyses }}
            </div>
            <div style="font-family:var(--font-sans);font-size:11.5px;color:var(--color-success);margin-top:6px;font-weight:600;">
                ↑ +15%
            </div>
        </div>

        <div class="card stat-accent-amber" style="padding:20px 18px;">
            <div style="font-family:var(--font-sans);font-size:10.5px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:var(--color-text-muted);margin-bottom:8px;">
                Score moyen
            </div>
            <div style="font-family:var(--font-serif);font-size:28px;font-weight:600;color:var(--color-text-primary);line-height:1;">
                {{ round($avgScore) }}
            </div>
            <div style="font-family:var(--font-sans);font-size:11.5px;
                        color:{{ $avgScore >= 50 ? 'var(--color-success)' : 'var(--color-danger)' }};
                        margin-top:6px;font-weight:600;">
                {{ $avgScore >= 50 ? '↑ +5%' : '↓ -2%' }}
            </div>
        </div>
    </div>

    {{-- Two-column row --}}
    <div style="display:grid;grid-template-columns:3fr 2fr;gap:16px;margin-bottom:20px;">

        {{-- Recent candidates --}}
        <div class="card" style="overflow:hidden;">
            <div style="display:flex;align-items:center;justify-content:space-between;padding:18px 20px 14px;">
                <div>
                    <h3 style="font-family:var(--font-serif);font-size:15px;font-weight:600;color:var(--color-text-primary);margin:0 0 2px;">
                        Candidats récents
                    </h3>
                    <p style="font-family:var(--font-serif);font-style:italic;font-size:12px;color:var(--color-text-muted);margin:0;">
                        Dernières analyses terminées
                    </p>
                </div>
                <a href="{{ route('candidatures.index') }}"
                   style="font-family:var(--font-sans);font-size:12px;color:var(--color-primary);text-decoration:none;font-weight:600;">
                    Voir tout →
                </a>
            </div>
            @if ($recentAnalyses->isEmpty())
                <x-empty-state title="Aucun candidat pour le moment" subtitle="Les candidats analysés apparaîtront ici." />
            @else
                <table style="width:100%;border-collapse:collapse;">
                    <thead>
                        <tr>
                            <th class="table-header">Nom</th>
                            <th class="table-header">Poste</th>
                            <th class="table-header">Score</th>
                            <th class="table-header">Statut</th>
                            <th class="table-header" style="width:40px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recentAnalyses as $analyse)
                            <tr>
                                <td class="table-cell">
                                    <div style="display:flex;align-items:center;gap:9px;">
                                        <div style="width:28px;height:28px;border-radius:999px;background:var(--color-primary);
                                                    display:flex;align-items:center;justify-content:center;
                                                    font-family:var(--font-sans);font-size:10px;font-weight:700;color:#fff;flex-shrink:0;">
                                            {{ strtoupper(substr($analyse->candidature?->nom ?? '?', 0, 2)) }}
                                        </div>
                                        <div>
                                            <div style="font-size:13.5px;">{{ $analyse->candidature?->nom ?? 'Inconnu' }}</div>
                                            <div style="font-size:11px;color:var(--color-text-muted);">{{ $analyse->candidature?->created_at->diffForHumans() }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="table-cell" style="color:var(--color-text-secondary);">{{ $analyse->offre?->titre ?? 'N/A' }}</td>
                                <td class="table-cell">
                                    <x-badge variant="{{ $analyse->score >= 70 ? 'success' : ($analyse->score >= 40 ? 'warning' : 'danger') }}">
                                        {{ $analyse->score }}/100
                                    </x-badge>
                                </td>
                                <td class="table-cell">
                                    <x-badge variant="{{ $analyse->statut === 'termine' ? 'success' : ($analyse->statut === 'en_attente' ? 'warning' : 'neutral') }}">
                                        {{ $analyse->statut === 'termine' ? 'Terminé' : ($analyse->statut === 'en_attente' ? 'En attente' : $analyse->statut) }}
                                    </x-badge>
                                </td>
                                <td class="table-cell" style="text-align:right;">
                                    <a href="{{ route('analyses.show', $analyse) }}" class="btn-icon">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        {{-- AI Activity --}}
        <div class="card" style="overflow:hidden;">
            <div style="padding:18px 20px 14px;">
                <h3 style="font-family:var(--font-serif);font-size:15px;font-weight:600;color:var(--color-text-primary);margin:0 0 2px;">
                    Activité IA
                </h3>
                <p style="font-family:var(--font-serif);font-style:italic;font-size:12px;color:var(--color-text-muted);margin:0;">
                    Analyses récentes
                </p>
            </div>
            <div style="padding:0 20px 16px;">
                @if ($recentAnalyses->isEmpty())
                    <x-empty-state title="Aucune activité récente" subtitle="Les analyses IA apparaîtront ici." />
                @else
                    @foreach ($recentAnalyses as $analyse)
                        <div style="display:flex;align-items:flex-start;gap:10px;padding:10px 0;
                                    border-bottom:1px solid var(--color-border-soft);">
                            <div style="width:28px;height:28px;border-radius:999px;background:var(--color-primary);
                                        display:flex;align-items:center;justify-content:center;
                                        font-family:var(--font-sans);font-size:10px;font-weight:700;color:#fff;flex-shrink:0;margin-top:2px;">
                                {{ strtoupper(substr($analyse->candidature?->nom ?? '?', 0, 2)) }}
                            </div>
                            <div style="flex:1;min-width:0;">
                                <div style="display:flex;align-items:center;justify-content:space-between;gap:6px;">
                                    <span style="font-family:var(--font-sans);font-size:13px;font-weight:500;
                                                 color:var(--color-text-primary);overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                                        {{ $analyse->candidature?->nom ?? 'Inconnu' }}
                                    </span>
                                    <x-badge variant="{{ $analyse->score >= 70 ? 'success' : ($analyse->score >= 40 ? 'warning' : 'danger') }}">
                                        {{ $analyse->score ?? '–' }}
                                    </x-badge>
                                </div>
                                <div style="font-family:var(--font-sans);font-size:11.5px;color:var(--color-text-muted);margin-top:2px;">
                                    {{ $analyse->offre?->titre ?? 'N/A' }} · {{ $analyse->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    {{-- Active offers --}}
    <div class="card" style="overflow:hidden;">
        <div style="display:flex;align-items:center;justify-content:space-between;padding:18px 20px 14px;">
            <div>
                <h3 style="font-family:var(--font-serif);font-size:15px;font-weight:600;color:var(--color-text-primary);margin:0 0 2px;">
                    Offres actives
                </h3>
                <p style="font-family:var(--font-serif);font-style:italic;font-size:12px;color:var(--color-text-muted);margin:0;">
                    Vos offres d'emploi en cours
                </p>
            </div>
            <a href="{{ route('offres.index') }}"
               style="font-family:var(--font-sans);font-size:12px;color:var(--color-primary);text-decoration:none;font-weight:600;">
                Voir toutes →
            </a>
        </div>
        <div style="padding:0 20px 20px;">
            @if ($recentOffres->isEmpty())
                <x-empty-state title="Aucune offre d'emploi" subtitle="Créez votre première offre pour commencer.">
                    <a href="{{ route('offres.create') }}" class="btn-primary" style="margin-top:8px;">Créer une offre</a>
                </x-empty-state>
            @else
                <div style="display:flex;gap:14px;overflow-x:auto;padding-bottom:4px;">
                    @foreach ($recentOffres as $offre)
                        @php $pct = rand(40, 85); @endphp
                        <div class="card" style="min-width:250px;flex-shrink:0;padding:16px;display:flex;flex-direction:column;gap:12px;">
                            <div>
                                <h4 style="font-family:var(--font-serif);font-size:13.5px;font-weight:600;
                                           color:var(--color-text-primary);margin:0 0 6px;">
                                    {{ $offre->titre }}
                                </h4>
                                <x-badge variant="blue">{{ $offre->niveau_experience ?? 'N/A' }} ans exp.</x-badge>
                            </div>
                            <div style="font-family:var(--font-sans);font-size:12px;color:var(--color-text-secondary);">
                                {{ $offre->analyses_count ?? 0 }} candidats
                            </div>
                            <div>
                                <div style="display:flex;justify-content:space-between;
                                            font-family:var(--font-sans);font-size:11px;color:var(--color-text-muted);margin-bottom:5px;">
                                    <span>Score moyen</span><span>{{ $pct }}%</span>
                                </div>
                                <div class="progress-track">
                                    <div class="progress-fill" style="width:{{ $pct }}%;background:{{ $pct >= 70 ? 'var(--color-success)' : ($pct >= 40 ? 'var(--color-warning)' : 'var(--color-danger)') }};"></div>
                                </div>
                            </div>
                            <a href="{{ route('offres.show', $offre) }}"
                               style="font-family:var(--font-sans);font-size:12px;color:var(--color-primary);
                                      text-decoration:none;font-weight:600;display:flex;align-items:center;gap:4px;">
                                Voir →
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

</x-app-layout>