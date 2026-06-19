<x-app-layout>
    @section('title', 'Analyse — ' . ($analyse->candidature?->nom ?? 'N/A'))

    <x-slot name="header">Analyse — {{ $analyse->candidature?->nom ?? 'N/A' }}</x-slot>
    <x-slot name="subtitle">{{ $analyse->offre?->titre ?? '' }}</x-slot>

    @if ($analyse->statut === 'en_attente')
        <div class="notice notice-warning" style="margin-bottom:24px;">
            <div style="width:36px;height:36px;border-radius:var(--radius-md);background:var(--color-warning-bg);
                        display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <svg class="w-5 h-5" style="color:var(--color-warning);" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <div>
                <h3 style="font-family:var(--font-serif);font-size:14px;font-weight:600;margin:0 0 4px;">Analyse en cours</h3>
                <p style="font-family:var(--font-sans);font-size:13px;margin:0;">
                    Le résultat sera disponible dans quelques instants. Rafraîchissez la page.
                </p>
            </div>
        </div>
    @else
        <div style="display:grid;grid-template-columns:1fr 280px;gap:20px;">

            {{-- Left column --}}
            <div style="display:flex;flex-direction:column;gap:16px;">

                {{-- Info --}}
                <div class="card" style="padding:24px 28px;">
                    <div class="section-label" style="margin-bottom:16px;">Informations</div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                        <div>
                            <p style="font-family:var(--font-sans);font-size:11px;font-weight:700;text-transform:uppercase;
                                      letter-spacing:.07em;color:var(--color-text-muted);margin:0 0 4px;">Candidat</p>
                            <p style="font-family:var(--font-serif);font-size:16px;font-weight:600;
                                      color:var(--color-text-primary);margin:0;">
                                {{ $analyse->candidature?->nom }}
                            </p>
                        </div>
                        <div>
                            <p style="font-family:var(--font-sans);font-size:11px;font-weight:700;text-transform:uppercase;
                                      letter-spacing:.07em;color:var(--color-text-muted);margin:0 0 4px;">Poste</p>
                            <p style="font-family:var(--font-serif);font-size:16px;font-weight:600;
                                      color:var(--color-text-primary);margin:0;">
                                {{ $analyse->offre?->titre }}
                            </p>
                        </div>
                        @if ($analyse->annees_experience !== null)
                            <div>
                                <p style="font-family:var(--font-sans);font-size:11px;font-weight:700;text-transform:uppercase;
                                          letter-spacing:.07em;color:var(--color-text-muted);margin:0 0 4px;">Expérience</p>
                                <p style="font-family:var(--font-serif);font-size:16px;font-weight:600;
                                          color:var(--color-text-primary);margin:0;">
                                    {{ $analyse->annees_experience }} ans
                                </p>
                            </div>
                        @endif
                        @if ($analyse->niveau_etude)
                            <div>
                                <p style="font-family:var(--font-sans);font-size:11px;font-weight:700;text-transform:uppercase;
                                          letter-spacing:.07em;color:var(--color-text-muted);margin:0 0 4px;">Niveau d'étude</p>
                                <p style="font-family:var(--font-serif);font-size:16px;font-weight:600;
                                          color:var(--color-text-primary);margin:0;">
                                    {{ $analyse->niveau_etude }}
                                </p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Justification --}}
                @if ($analyse->justification)
                    <div class="card" style="padding:24px 28px;">
                        <div class="section-label" style="margin-bottom:12px;">Justification IA</div>
                        <p style="font-family:var(--font-serif);font-style:italic;font-size:14px;
                                  color:var(--color-text-secondary);line-height:1.75;
                                  white-space:pre-line;margin:0;">
                            {{ $analyse->justification }}
                        </p>
                    </div>
                @endif

                {{-- Tags grid --}}
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                    @if (!empty($analyse->points_forts))
                        <div class="card" style="padding:20px 22px;border-left:4px solid var(--color-success);">
                            <div class="section-label" style="color:var(--color-success-text);margin-bottom:10px;">Points forts</div>
                            <div style="display:flex;flex-wrap:wrap;gap:6px;">
                                @foreach ($analyse->points_forts as $p)
                                    <span class="badge badge-success">{{ $p }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @if (!empty($analyse->lacunes))
                        <div class="card" style="padding:20px 22px;border-left:4px solid var(--color-danger);">
                            <div class="section-label" style="color:var(--color-danger-text);margin-bottom:10px;">Lacunes</div>
                            <div style="display:flex;flex-wrap:wrap;gap:6px;">
                                @foreach ($analyse->lacunes as $l)
                                    <span class="badge badge-danger">{{ $l }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @if (!empty($analyse->competences))
                        <div class="card" style="padding:20px 22px;border-left:4px solid var(--color-primary);">
                            <div class="section-label" style="margin-bottom:10px;">Compétences</div>
                            <div style="display:flex;flex-wrap:wrap;gap:6px;">
                                @foreach ($analyse->competences as $c)
                                    <span class="badge badge-blue">{{ $c }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @if (!empty($analyse->competences_manquantes))
                        <div class="card" style="padding:20px 22px;border-left:4px solid var(--color-warning);">
                            <div class="section-label" style="color:var(--color-warning-text);margin-bottom:10px;">Compétences manquantes</div>
                            <div style="display:flex;flex-wrap:wrap;gap:6px;">
                                @foreach ($analyse->competences_manquantes as $m)
                                    <span class="badge badge-warning">{{ $m }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @if (!empty($analyse->langues))
                        <div class="card" style="padding:20px 22px;border-left:4px solid #7c3aed;">
                            <div class="section-label" style="margin-bottom:10px;">Langues</div>
                            <div style="display:flex;flex-wrap:wrap;gap:6px;">
                                @foreach ($analyse->langues as $l)
                                    <span class="badge" style="background:#ede9fe;color:#5b21b6;border-color:#ddd6fe;">{{ $l }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Right column --}}
            <div style="display:flex;flex-direction:column;gap:14px;">

                {{-- Score --}}
                @if ($analyse->score !== null)
                    <div class="card" style="padding:24px;text-align:center;">
                        <div class="section-label" style="margin-bottom:14px;">Score</div>
                        <div style="display:inline-flex;align-items:center;justify-content:center;
                                    width:100px;height:100px;border-radius:50%;
                                    font-family:var(--font-serif);font-size:36px;font-weight:700;
                                    border:5px solid {{ $analyse->score >= 70 ? 'var(--color-success)' : ($analyse->score >= 40 ? 'var(--color-warning)' : 'var(--color-danger)') }};
                                    background:{{ $analyse->score >= 70 ? 'var(--color-success-bg)' : ($analyse->score >= 40 ? 'var(--color-warning-bg)' : 'var(--color-danger-bg)') }};
                                    color:{{ $analyse->score >= 70 ? 'var(--color-success-text)' : ($analyse->score >= 40 ? 'var(--color-warning-text)' : 'var(--color-danger-text)') }};">
                            {{ $analyse->score }}
                        </div>
                        <p style="font-family:var(--font-sans);font-size:12px;color:var(--color-text-muted);margin-top:8px;">/ 100</p>
                    </div>
                @endif

                {{-- Recommendation --}}
                @if ($analyse->recommandation)
                    <div class="card" style="padding:20px;text-align:center;">
                        <div class="section-label" style="margin-bottom:12px;">Recommandation</div>
                        @php
                            $reco = $analyse->recommandation->value;
                            $recoMap = ['convoquer'=>'success','attente'=>'warning','rejeter'=>'danger'];
                            $recoLabel = ['convoquer'=>'À convoquer','attente'=>'En attente','rejeter'=>'À rejeter'];
                        @endphp
                        <x-badge variant="{{ $recoMap[$reco] ?? 'neutral' }}" style="font-size:12.5px;padding:6px 16px;">
                            {{ $recoLabel[$reco] ?? '—' }}
                        </x-badge>
                    </div>
                @endif

                {{-- Chat CTA --}}
                <div class="card" style="padding:20px;text-align:center;">
                    <div style="width:44px;height:44px;border-radius:var(--radius-md);
                                background:var(--color-primary-light);display:flex;align-items:center;
                                justify-content:center;margin:0 auto 12px;">
                        <svg class="w-5 h-5" style="color:var(--color-primary);" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                    </div>
                    <p style="font-family:var(--font-serif);font-style:italic;font-size:13px;
                              color:var(--color-text-secondary);margin-bottom:14px;">
                        Discutez de cette analyse avec l'assistant IA
                    </p>
                    <form action="{{ route('conversations.store', $analyse) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-primary" style="width:100%;">
                            Démarrer le chat
                        </button>
                    </form>
                </div>

                <a href="{{ route('offres.show', $analyse->offre) }}" class="btn-ghost" style="justify-content:center;">
                    ← Retour à l'offre
                </a>
            </div>
        </div>
    @endif

</x-app-layout>