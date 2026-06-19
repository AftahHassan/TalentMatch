<x-app-layout>
    @section('title', 'Aide')

    <x-slot name="header">Aide et documentation</x-slot>
    <x-slot name="subtitle">Apprenez à utiliser TalentMatch efficacement</x-slot>

    <div style="display:grid;grid-template-columns:3fr 2fr;gap:20px;">

        {{-- Steps --}}
        <div class="card" style="padding:28px 32px;">
            <h2 style="font-family:var(--font-serif);font-size:16px;font-weight:600;
                       color:var(--color-text-primary);margin:0 0 22px;">
                Pour commencer
            </h2>
            <div style="display:flex;flex-direction:column;gap:18px;">
                @php
                    $steps = [
                        ['bg'=>'var(--color-primary-light)','icon_color'=>'var(--color-primary)',
                         'title'=>'Créer une offre d\'emploi',
                         'desc'=>'Créez une offre depuis le tableau de bord. Remplissez le titre, la description, les compétences requises et le niveau d\'expérience.',
                         'icon'=>'<rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"/>'],
                        ['bg'=>'var(--color-success-bg)','icon_color'=>'var(--color-success-text)',
                         'title'=>'Soumettre un CV',
                         'desc'=>'Soumettez le CV d\'un candidat et liez-le à l\'offre correspondante. Le système extrait automatiquement les informations.',
                         'icon'=>'<path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>'],
                        ['bg'=>'#ecfdf5','icon_color'=>'#065f46',
                         'title'=>'Consulter l\'analyse',
                         'desc'=>'Une fois le CV traité, consultez le score, l\'évaluation des compétences et les recommandations générées par l\'IA.',
                         'icon'=>'<path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>'],
                        ['bg'=>'var(--color-primary-light)','icon_color'=>'var(--color-primary)',
                         'title'=>'Discuter avec l\'assistant IA',
                         'desc'=>'Utilisez le Chat IA pour poser des questions sur les candidats, comparer les profils ou obtenir des recommandations.',
                         'icon'=>'<path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>'],
                        ['bg'=>'var(--color-warning-bg)','icon_color'=>'var(--color-warning-text)',
                         'title'=>'Comparer les candidats',
                         'desc'=>'Visualisez tous les candidats analysés avec leurs scores et métriques clés pour prendre des décisions éclairées.',
                         'icon'=>'<path d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>'],
                    ];
                @endphp
                @foreach ($steps as $i => $step)
                    <div style="display:flex;gap:14px;">
                        <div style="width:38px;height:38px;border-radius:var(--radius-md);
                                    background:{{ $step['bg'] }};display:flex;align-items:center;
                                    justify-content:center;flex-shrink:0;">
                            <svg class="w-5 h-5" style="color:{{ $step['icon_color'] }};"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                {!! $step['icon'] !!}
                            </svg>
                        </div>
                        <div>
                            <h3 style="font-family:var(--font-sans);font-size:13px;font-weight:600;
                                       color:var(--color-text-primary);margin:0 0 4px;">
                                Étape {{ $i + 1 }} — {{ $step['title'] }}
                            </h3>
                            <p style="font-family:var(--font-sans);font-size:12.5px;color:var(--color-text-secondary);
                                      margin:0;line-height:1.6;">
                                {{ $step['desc'] }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- FAQ --}}
        <div class="card" style="padding:28px;">
            <h2 style="font-family:var(--font-serif);font-size:16px;font-weight:600;
                       color:var(--color-text-primary);margin:0 0 18px;">
                FAQ
            </h2>
            <div x-data="{ open: null }" style="display:flex;flex-direction:column;gap:8px;">
                @php
                    $faqs = [
                        ['q'=>"Combien de temps prend l'analyse IA ?",      'a'=>"La plupart des analyses se terminent en 30–60 secondes. Les CV complexes peuvent prendre un peu plus de temps."],
                        ['q'=>"Quel modèle IA est utilisé ?",               'a'=>"TalentMatch utilise Claude d'Anthropic pour l'analyse des CV et l'assistant de chat IA."],
                        ['q'=>"Puis-je ré-analyser un CV ?",                'a'=>"Oui, à tout moment. Utile si les exigences du poste ont changé."],
                        ['q'=>"Que signifie le score ?",                    'a'=>"0–39 : À rejeter. 40–69 : En attente. 70–100 : À convoquer."],
                        ['q'=>"Comment le Chat IA garde-t-il le contexte ?",'a'=>"Il conserve l'historique complet de la conversation pour des échanges naturels et continus."],
                    ];
                @endphp
                @foreach ($faqs as $i => $faq)
                    <div style="border:1px solid var(--color-border);border-radius:var(--radius-md);overflow:hidden;">
                        <button @click="open = open === {{ $i }} ? null : {{ $i }}"
                                style="width:100%;display:flex;align-items:center;justify-content:space-between;
                                       padding:12px 14px;background:none;border:none;cursor:pointer;
                                       font-family:var(--font-sans);font-size:13px;font-weight:500;
                                       color:var(--color-text-primary);text-align:left;gap:8px;">
                            <span>{{ $faq['q'] }}</span>
                            <svg class="w-4 h-4 flex-shrink-0" style="color:var(--color-text-muted);transition:transform .15s;"
                                 :style="open === {{ $i }} ? 'transform:rotate(180deg)' : ''"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="open === {{ $i }}" style="padding:0 14px 12px;">
                            <p style="font-family:var(--font-sans);font-size:12.5px;color:var(--color-text-secondary);margin:0;">
                                {{ $faq['a'] }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</x-app-layout>