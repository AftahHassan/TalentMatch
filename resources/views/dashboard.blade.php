<x-app-layout>
    @php
        $totalOffres = auth()->user()->offres()->count();
        $totalCandidatures = \App\Models\Candidature::count();
        $totalAnalyses = \App\Models\Analyse::count();
        $toConvoke = \App\Models\Analyse::where('recommandation', 'convoquer')->count();
        $avgScore = \App\Models\Analyse::where('statut','termine')->avg('score') ?? 0;
        $recentOffres = auth()->user()->offres()->withCount('analyses')->latest()->take(5)->get();
        $recentAnalyses = \App\Models\Analyse::with(['candidature','offre'])->where('statut','termine')->latest()->take(5)->get();
        $dateFr = now()->locale('fr')->isoFormat('dddd D MMMM YYYY');
    @endphp

    @section('title', 'Tableau de bord')

    {{-- Page header --}}
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;">
        <div>
            <h1 style="font-family:var(--font-serif);font-size:22px;font-weight:600;color:var(--color-text-primary);">Tableau de bord</h1>
            <p style="font-family:var(--font-serif);font-style:italic;font-size:13px;color:var(--color-text-muted);margin-top:4px;">{{ ucfirst($dateFr) }}</p>
        </div>
        <a href="{{ route('offres.create') }}" class="btn-primary">
            <span>+</span>
            Nouvelle offre
        </a>
    </div>

    {{-- Stats grid --}}
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:28px;">
        <x-stat-card number="{{ $totalCandidatures }}" label="Candidats total" trend="+12%" :trendUp="true" />
        <x-stat-card number="{{ $toConvoke }}" label="Présélectionnés" trend="+8%" :trendUp="true" />
        <x-stat-card number="{{ $totalAnalyses }}" label="En entretien" trend="+15%" :trendUp="true" />
        <x-stat-card number="{{ round($avgScore) }}" label="Score moyen" trend="{{ $avgScore >= 50 ? '+5%' : '-2%' }}" :trendUp="$avgScore >= 50" />
    </div>

    {{-- Two-column row --}}
    <div style="display:grid;grid-template-columns:3fr 2fr;gap:20px;margin-bottom:28px;">
        {{-- Recent candidates --}}
        <div class="card" style="overflow:hidden;">
            <div style="display:flex;align-items:center;justify-content:space-between;padding:16px 20px 0;">
                <h3 style="font-family:var(--font-serif);font-size:15px;font-weight:600;color:var(--color-text-primary);">Candidats récents</h3>
                <a href="{{ route('candidatures.index') }}" style="font-family:var(--font-sans);font-size:12.5px;color:var(--color-primary);text-decoration:none;font-weight:500;">Voir tout</a>
            </div>
            <div style="padding:12px 0 0;">
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
                                    <td class="table-cell" style="font-weight:500;color:var(--color-text-primary);">
                                        <div style="display:flex;align-items:center;gap:10px;">
                                            <div style="width:28px;height:28px;border-radius:999px;background:var(--color-primary);display:flex;align-items:center;justify-content:center;font-size:10px;font-weight:700;color:#fff;flex-shrink:0;">
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
                                            {{ $analyse->statut }}
                                        </x-badge>
                                    </td>
                                    <td class="table-cell" style="text-align:right;">
                                        <a href="{{ route('analyses.show', $analyse) }}" class="btn-icon" style="width:32px;height:32px;">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" style="color:var(--color-text-muted);"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

        {{-- AI Activity timeline --}}
        <div class="card" style="overflow:hidden;">
            <div style="padding:16px 20px 0;">
                <h3 style="font-family:var(--font-serif);font-size:15px;font-weight:600;color:var(--color-text-primary);">Activité IA</h3>
                <p style="font-family:var(--font-sans);font-size:12.5px;font-style:italic;color:var(--color-text-muted);margin-top:2px;">Analyses récentes</p>
            </div>
            <div style="padding:12px 20px 16px;">
                @if ($recentAnalyses->isEmpty())
                    <x-empty-state title="Aucune activité récente" subtitle="Les analyses IA apparaîtront ici." />
                @else
                    <div style="display:flex;flex-direction:column;gap:0;">
                        @foreach ($recentAnalyses as $analyse)
                            <div style="display:flex;align-items:flex-start;gap:12px;padding:10px 0;border-bottom:1px solid var(--color-border-soft);">
                                <div style="width:28px;height:28px;border-radius:999px;background:var(--color-primary);display:flex;align-items:center;justify-content:center;font-size:10px;font-weight:700;color:#fff;flex-shrink:0;margin-top:2px;">
                                    {{ strtoupper(substr($analyse->candidature?->nom ?? '?', 0, 2)) }}
                                </div>
                                <div style="flex:1;min-width:0;">
                                    <div style="display:flex;align-items:center;justify-content:space-between;gap:8px;">
                                        <span style="font-family:var(--font-sans);font-size:13px;font-weight:500;color:var(--color-text-primary);overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $analyse->candidature?->nom ?? 'Inconnu' }}</span>
                                        <x-badge variant="{{ $analyse->score >= 70 ? 'success' : ($analyse->score >= 40 ? 'warning' : 'danger') }}" style="flex-shrink:0;">
                                            {{ $analyse->score ?? '–' }}
                                        </x-badge>
                                    </div>
                                    <div style="font-family:var(--font-sans);font-size:12px;color:var(--color-text-muted);margin-top:2px;">
                                        {{ $analyse->offre?->titre ?? 'N/A' }} · {{ $analyse->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Active offers --}}
    <div class="card" style="overflow:hidden;">
        <div style="display:flex;align-items:center;justify-content:space-between;padding:16px 20px 0;">
            <h3 style="font-family:var(--font-serif);font-size:15px;font-weight:600;color:var(--color-text-primary);">Offres actives</h3>
            <a href="{{ route('offres.index') }}" style="font-family:var(--font-sans);font-size:12.5px;color:var(--color-primary);text-decoration:none;font-weight:500;">Voir toutes</a>
        </div>
        <div style="padding:16px 20px 20px;">
            @if ($recentOffres->isEmpty())
                <x-empty-state title="Aucune offre d'emploi" subtitle="Créez votre première offre pour commencer.">
                    <a href="{{ route('offres.create') }}" class="btn-primary">Créer une offre</a>
                </x-empty-state>
            @else
                <div style="display:flex;gap:16px;overflow-x:auto;padding-bottom:4px;">
                    @foreach ($recentOffres as $offre)
                        <div class="card" style="min-width:260px;flex-shrink:0;padding:16px;display:flex;flex-direction:column;gap:12px;">
                            <div>
                                <h4 style="font-family:var(--font-serif);font-size:14px;font-weight:600;color:var(--color-text-primary);margin:0 0 4px;">{{ $offre->titre }}</h4>
                                <x-badge variant="blue" style="font-size:10.5px;">{{ $offre->niveau_experience ?? 'N/A' }} ans exp.</x-badge>
                            </div>
                            <div style="display:flex;align-items:center;gap:16px;font-family:var(--font-sans);font-size:12px;color:var(--color-text-secondary);">
                                <span>{{ $offre->analyses_count ?? 0 }} candidats</span>
                            </div>
                            <div>
                                <div style="display:flex;align-items:center;justify-content:space-between;font-family:var(--font-sans);font-size:11px;color:var(--color-text-muted);margin-bottom:4px;">
                                    <span>Score moyen</span>
                                    <span>{{ rand(40, 85) }}%</span>
                                </div>
                                <div style="height:6px;background:#E5E7EB;border-radius:999px;overflow:hidden;">
                                    @php $pct = rand(40, 85); @endphp
                                    <div style="height:100%;width:{{ $pct }}%;background:{{ $pct >= 70 ? 'var(--color-success)' : ($pct >= 40 ? 'var(--color-warning)' : 'var(--color-danger)') }};border-radius:999px;"></div>
                                </div>
                            </div>
                            <a href="{{ route('offres.show', $offre) }}" style="font-family:var(--font-sans);font-size:12.5px;color:var(--color-primary);text-decoration:none;font-weight:500;display:flex;align-items:center;gap:4px;">
                                Voir
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
