<x-app-layout>
    @section('title', 'Comparer les candidats')

    @php
        $candidates = [
            [
                'initiales' => 'JD', 'nom' => 'Jean Dupont', 'poste' => 'Développeur Full-Stack',
                'score' => 85, 'experience' => 6, 'education' => 'Master en Informatique',
                'competences' => 12, 'match' => 'Excellent match',
                'skills' => ['Laravel','React','PostgreSQL','Docker','AWS','Redis'],
                'proficiency' => ['Laravel'=>90, 'React'=>85, 'PostgreSQL'=>75, 'Docker'=>70, 'AWS'=>65, 'Redis'=>60],
                'langues' => 'Français (nat.), Anglais (C1)',
                'certifications' => 'AWS Certified',
                'disponibilite' => '1 mois',
            ],
            [
                'initiales' => 'SM', 'nom' => 'Sarah Martin', 'poste' => 'Développeuse Full-Stack',
                'score' => 72, 'experience' => 4, 'education' => 'Master en Génie Logiciel',
                'competences' => 10, 'match' => 'Bon match',
                'skills' => ['Vue.js','Node.js','MongoDB','TypeScript','GraphQL','GCP'],
                'proficiency' => ['Vue.js'=>88, 'Node.js'=>82, 'MongoDB'=>70, 'TypeScript'=>75, 'GraphQL'=>65, 'GCP'=>55],
                'langues' => 'Français (nat.), Anglais (B2)',
                'certifications' => 'Google Cloud Associate',
                'disponibilite' => '2 semaines',
            ],
        ];
    @endphp

    {{-- Breadcrumb --}}
    <x-slot name="breadcrumb">
        <a href="{{ route('dashboard') }}" style="color:var(--color-text-muted);text-decoration:none;">Dashboard</a>
        <span style="color:var(--color-text-muted);margin:0 6px;">/</span>
        <a href="{{ route('analyses.index') }}" style="color:var(--color-text-muted);text-decoration:none;">Analyses</a>
        <span style="color:var(--color-text-muted);margin:0 6px;">/</span>
        <span style="color:var(--color-text-primary);font-weight:500;">Comparaison</span>
    </x-slot>

    {{-- Page header --}}
    <div class="page-header">
        <div>
            <h1>Comparaison</h1>
            <p>Comparez les profils des candidats côte à côte</p>
        </div>
    </div>

    {{-- Two-column 50/50 grid --}}
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:24px;">

        @foreach($candidates as $i => $c)
            <div class="card" style="padding:24px;">
                <div style="display:flex;align-items:center;gap:14px;margin-bottom:16px;">
                    <div style="width:44px;height:44px;border-radius:999px;background:var(--color-primary-light);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <span style="font-size:14px;font-weight:700;color:var(--color-primary);">{{ $c['initiales'] }}</span>
                    </div>
                    <div>
                        <div style="font-size:15px;font-weight:600;color:var(--color-text-primary);">{{ $c['nom'] }}</div>
                        <div style="font-size:12px;color:var(--color-text-muted);">{{ $c['poste'] }}</div>
                    </div>
                    <div style="margin-left:auto;text-align:center;">
                        <div style="position:relative;width:52px;height:52px;flex-shrink:0;">
                            <svg width="52" height="52" viewBox="0 0 36 36">
                                <circle cx="18" cy="18" r="15.5" fill="none" stroke="var(--color-border)" stroke-width="3"/>
                                <circle cx="18" cy="18" r="15.5" fill="none" stroke="{{ $c['score'] >= 70 ? 'var(--color-success)' : ($c['score'] >= 40 ? 'var(--color-warning)' : 'var(--color-danger)') }}"
                                        stroke-width="3" stroke-dasharray="{{ $c['score'] }}, 100" stroke-linecap="round" transform="rotate(-90 18 18)"/>
                            </svg>
                            <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;color:var(--color-text-primary);">{{ $c['score'] }}</div>
                        </div>
                    </div>
                </div>

                {{-- Match label --}}
                <span class="badge {{ $c['score'] >= 70 ? 'badge-success' : 'badge-warning' }}" style="margin-bottom:14px;">{{ $c['match'] }}</span>

                {{-- Stats row --}}
                <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:10px;margin-bottom:16px;padding:14px 0;border-top:1px solid var(--color-border-soft);border-bottom:1px solid var(--color-border-soft);">
                    <div style="text-align:center;">
                        <div style="font-size:16px;font-weight:700;color:var(--color-text-primary);">{{ $c['experience'] }} ans</div>
                        <div style="font-size:10px;color:var(--color-text-muted);text-transform:uppercase;letter-spacing:.06em;">Expérience</div>
                    </div>
                    <div style="text-align:center;border-left:1px solid var(--color-border-soft);border-right:1px solid var(--color-border-soft);">
                        <div style="font-size:16px;font-weight:700;color:var(--color-text-primary);">{{ $c['education'] ? 'MSc' : '—' }}</div>
                        <div style="font-size:10px;color:var(--color-text-muted);text-transform:uppercase;letter-spacing:.06em;">Formation</div>
                    </div>
                    <div style="text-align:center;">
                        <div style="font-size:16px;font-weight:700;color:var(--color-text-primary);">{{ $c['competences'] }}</div>
                        <div style="font-size:10px;color:var(--color-text-muted);text-transform:uppercase;letter-spacing:.06em;">Compétences</div>
                    </div>
                </div>

                {{-- Technical proficiency bars --}}
                <div class="section-label" style="margin-bottom:8px;">Compétences techniques</div>
                <div style="display:flex;flex-direction:column;gap:6px;">
                    @foreach($c['proficiency'] as $skill => $pct)
                        <div>
                            <div style="display:flex;justify-content:space-between;font-size:11.5px;color:var(--color-text-secondary);margin-bottom:2px;">
                                <span>{{ $skill }}</span><span>{{ $pct }}%</span>
                            </div>
                            <div class="progress-track">
                                <div class="progress-fill" style="width:{{ $pct }}%;background:{{ $pct >= 70 ? 'var(--color-success)' : ($pct >= 50 ? 'var(--color-warning)' : 'var(--color-danger)') }};"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    {{-- Winner AI Insights panel --}}
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:24px;">
        <div style="padding:24px;background:var(--color-primary);border-radius:var(--radius-lg);">
            <div style="display:flex;align-items:center;gap:10px;margin-bottom:12px;">
                <svg width="20" height="20" fill="none" stroke="white" viewBox="0 0 24 24" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                </svg>
                <span style="font-size:13px;font-weight:600;color:white;">AI Insights — {{ $candidates[0]['nom'] }}</span>
                <span style="display:inline-flex;align-items:center;gap:4px;margin-left:auto;padding:3px 10px;background:rgba(255,255,255,0.15);border-radius:999px;font-size:11px;font-weight:600;color:white;">
                    <svg width="12" height="12" fill="currentColor" viewBox="0 0 24 24"><path d="M6 3h12v2H6zm2-2h8v2H8zM12 8l3 5-6 2z"/><path d="M5 13c0-2.76 2.24-5 5-5s5 2.24 5 5-2.24 5-5 5-5-2.24-5-5z"/></svg>
                    GAGNANT
                </span>
            </div>
            <p style="font-size:14px;color:rgba(255,255,255,0.92);line-height:1.7;margin:0;">
                {{ $candidates[0]['nom'] }} est le candidat recommandé pour ce poste. Son expérience de {{ $candidates[0]['experience'] }} ans combinée à sa maîtrise de Laravel et React correspond parfaitement aux exigences du poste. Son score de {{ $candidates[0]['score'] }}/100 est le plus élevé parmi les candidats.
            </p>
        </div>
        <div style="padding:24px;background:var(--color-border-soft);border-radius:var(--radius-lg);">
            <div style="display:flex;align-items:center;gap:10px;margin-bottom:12px;">
                <svg width="20" height="20" fill="none" stroke="var(--color-text-secondary)" viewBox="0 0 24 24" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                </svg>
                <span style="font-size:13px;font-weight:600;color:var(--color-text-primary);">AI Insights — {{ $candidates[1]['nom'] }}</span>
            </div>
            <p style="font-size:14px;color:var(--color-text-secondary);line-height:1.7;margin:0;">
                {{ $candidates[1]['nom'] }} est un bon candidat avec un score de {{ $candidates[1]['score'] }}/100. Ses compétences en Vue.js et Node.js sont solides, mais son expérience de {{ $candidates[1]['experience'] }} ans est inférieure au candidat principal. Recommandée comme alternative.
            </p>
        </div>
    </div>

    {{-- Deep comparison table --}}
    <div class="card" style="overflow:hidden;">
        <div style="padding:18px 24px 14px;border-bottom:1px solid var(--color-border-soft);">
            <h3 style="font-size:15px;font-weight:600;color:var(--color-text-primary);margin:0;">Comparaison détaillée</h3>
        </div>
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr>
                    <th class="table-header" style="width:30%;">Critère</th>
                    <th class="table-header" style="width:35%;">{{ $candidates[0]['nom'] }}</th>
                    <th class="table-header" style="width:35%;">{{ $candidates[1]['nom'] }}</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $rows = [
                        ['label'=>'Score global',       'a'=>$candidates[0]['score'].'/100',      'b'=>$candidates[1]['score'].'/100',      'star'=>$candidates[0]['score'] > $candidates[1]['score']],
                        ['label'=>'Années d\'expérience','a'=>$candidates[0]['experience'].' ans', 'b'=>$candidates[1]['experience'].' ans',  'star'=>$candidates[0]['experience'] > $candidates[1]['experience']],
                        ['label'=>'Compétences clés',   'a'=>implode(', ', array_slice($candidates[0]['skills'],0,3)), 'b'=>implode(', ', array_slice($candidates[1]['skills'],0,3)), 'star'=>null],
                        ['label'=>'Formation',           'a'=>$candidates[0]['education'],         'b'=>$candidates[1]['education'],           'star'=>null],
                        ['label'=>'Langues',             'a'=>$candidates[0]['langues'],           'b'=>$candidates[1]['langues'],            'star'=>null],
                        ['label'=>'Certifications',      'a'=>$candidates[0]['certifications'],    'b'=>$candidates[1]['certifications'],     'star'=>null],
                        ['label'=>'Disponibilité',       'a'=>$candidates[0]['disponibilite'],     'b'=>$candidates[1]['disponibilite'],      'star'=>null],
                        ['label'=>'Recommandation',      'a'=>'À convoquer',                       'b'=>'À convoquer',                         'star'=>null],
                    ];
                @endphp
                @foreach($rows as $row)
                    <tr>
                        <td class="table-cell" style="font-weight:600;color:var(--color-text-primary);">{{ $row['label'] }}</td>
                        <td class="table-cell">
                            <div style="display:flex;align-items:center;gap:8px;">
                                @if($row['star'] === true)
                                    <svg width="14" height="14" fill="#F59E0B" stroke="#F59E0B" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                @elseif($row['star'] === false)
                                    <svg width="14" height="14" fill="none" stroke="var(--color-text-muted)" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                @endif
                                {{ $row['a'] }}
                            </div>
                        </td>
                        <td class="table-cell">{{ $row['b'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-app-layout>
