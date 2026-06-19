<x-app-layout>
    @section('title', 'Aide')

    <x-slot name="header">Aide et documentation</x-slot>
    <x-slot name="subtitle">Apprenez à utiliser TalentMatch efficacement</x-slot>

    <div style="display:grid;grid-template-columns:3fr 2fr;gap:24px;">
        <div class="card" style="padding:28px;">
            <h2 style="font-family:var(--font-serif);font-size:16px;font-weight:600;color:var(--color-text-primary);margin-bottom:24px;">Pour commencer</h2>
            <div style="display:flex;flex-direction:column;gap:20px;">
                <div style="display:flex;gap:16px;">
                    <div style="width:40px;height:40px;border-radius:10px;background:var(--color-primary-light);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg class="w-5 h-5" style="color:var(--color-primary);" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M21 13.255A23.193 23.193 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <h3 style="font-family:var(--font-sans);font-size:13px;font-weight:600;color:var(--color-text-primary);margin:0 0 4px;">Étape 1 : Créer une offre d'emploi</h3>
                        <p style="font-family:var(--font-sans);font-size:12.5px;color:var(--color-text-secondary);margin:0;line-height:1.6;">Créez une offre depuis le tableau de bord. Remplissez le titre, la description, les compétences requises et les préférences.</p>
                    </div>
                </div>
                <div style="display:flex;gap:16px;">
                    <div style="width:40px;height:40px;border-radius:10px;background:var(--color-success-bg);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg class="w-5 h-5" style="color:var(--color-success-text);" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <div>
                        <h3 style="font-family:var(--font-sans);font-size:13px;font-weight:600;color:var(--color-text-primary);margin:0 0 4px;">Étape 2 : Soumettre un CV</h3>
                        <p style="font-family:var(--font-sans);font-size:12.5px;color:var(--color-text-secondary);margin:0;line-height:1.6;">Soumettez le CV d'un candidat et liez-le à l'offre correspondante. Le système extrait automatiquement les informations.</p>
                    </div>
                </div>
                <div style="display:flex;gap:16px;">
                    <div style="width:40px;height:40px;border-radius:10px;background:var(--color-accent-light);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg class="w-5 h-5" style="color:var(--color-accent);" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <div>
                        <h3 style="font-family:var(--font-sans);font-size:13px;font-weight:600;color:var(--color-text-primary);margin:0 0 4px;">Étape 3 : Consulter l'analyse</h3>
                        <p style="font-family:var(--font-sans);font-size:12.5px;color:var(--color-text-secondary);margin:0;line-height:1.6;">Une fois le CV traité, consultez le score, l'évaluation des compétences et les recommandations générées par l'IA.</p>
                    </div>
                </div>
                <div style="display:flex;gap:16px;">
                    <div style="width:40px;height:40px;border-radius:10px;background:var(--color-primary-light);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg class="w-5 h-5" style="color:var(--color-primary);" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    </div>
                    <div>
                        <h3 style="font-family:var(--font-sans);font-size:13px;font-weight:600;color:var(--color-text-primary);margin:0 0 4px;">Étape 4 : Discuter avec l'assistant IA</h3>
                        <p style="font-family:var(--font-sans);font-size:12.5px;color:var(--color-text-secondary);margin:0;line-height:1.6;">Utilisez le Chat IA pour poser des questions sur les candidats, comparer les profils ou obtenir des recommandations.</p>
                    </div>
                </div>
                <div style="display:flex;gap:16px;">
                    <div style="width:40px;height:40px;border-radius:10px;background:var(--color-warning-bg);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg class="w-5 h-5" style="color:var(--color-warning-text);" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    </div>
                    <div>
                        <h3 style="font-family:var(--font-sans);font-size:13px;font-weight:600;color:var(--color-text-primary);margin:0 0 4px;">Étape 5 : Comparer les candidats</h3>
                        <p style="font-family:var(--font-sans);font-size:12.5px;color:var(--color-text-secondary);margin:0;line-height:1.6;">Visualisez tous les candidats analysés avec leurs scores et métriques clés pour prendre des décisions éclairées.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card" style="padding:28px;">
            <h2 style="font-family:var(--font-serif);font-size:16px;font-weight:600;color:var(--color-text-primary);margin-bottom:20px;">FAQ</h2>
            <div x-data="{ open: null }" style="display:flex;flex-direction:column;gap:8px;">
                <div class="card" style="border:1px solid var(--color-border);border-radius:10px;overflow:hidden;padding:0;">
                    <button @@click="open = open === 0 ? null : 0" style="width:100%;display:flex;align-items:center;justify-content:space-between;padding:12px 16px;background:none;border:none;cursor:pointer;font-family:var(--font-sans);font-size:13px;font-weight:500;color:var(--color-text-primary);text-align:left;">
                        <span>Combien de temps prend l'analyse IA ?</span>
                        <svg class="w-4 h-4" style="color:var(--color-text-muted);transition:transform 0.15s;" :class="open === 0 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open === 0" style="padding:0 16px 12px;">
                        <p style="font-family:var(--font-sans);font-size:12.5px;color:var(--color-text-secondary);margin:0;">La plupart des analyses se terminent en 30–60 secondes. Les CV complexes peuvent prendre un peu plus de temps.</p>
                    </div>
                </div>
                <div class="card" style="border:1px solid var(--color-border);border-radius:10px;overflow:hidden;padding:0;">
                    <button @@click="open = open === 1 ? null : 1" style="width:100%;display:flex;align-items:center;justify-content:space-between;padding:12px 16px;background:none;border:none;cursor:pointer;font-family:var(--font-sans);font-size:13px;font-weight:500;color:var(--color-text-primary);text-align:left;">
                        <span>Quel modèle IA est utilisé ?</span>
                        <svg class="w-4 h-4" style="color:var(--color-text-muted);transition:transform 0.15s;" :class="open === 1 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open === 1" style="padding:0 16px 12px;">
                        <p style="font-family:var(--font-sans);font-size:12.5px;color:var(--color-text-secondary);margin:0;">TalentMatch utilise GPT-4 d'OpenAI pour l'analyse des CV et l'assistant de chat IA.</p>
                    </div>
                </div>
                <div class="card" style="border:1px solid var(--color-border);border-radius:10px;overflow:hidden;padding:0;">
                    <button @@click="open = open === 2 ? null : 2" style="width:100%;display:flex;align-items:center;justify-content:space-between;padding:12px 16px;background:none;border:none;cursor:pointer;font-family:var(--font-sans);font-size:13px;font-weight:500;color:var(--color-text-primary);text-align:left;">
                        <span>Puis-je ré-analyser un CV ?</span>
                        <svg class="w-4 h-4" style="color:var(--color-text-muted);transition:transform 0.15s;" :class="open === 2 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open === 2" style="padding:0 16px 12px;">
                        <p style="font-family:var(--font-sans);font-size:12.5px;color:var(--color-text-secondary);margin:0;">Oui, vous pouvez ré-analyser un CV à tout moment. Utile si les exigences du poste ont changé.</p>
                    </div>
                </div>
                <div class="card" style="border:1px solid var(--color-border);border-radius:10px;overflow:hidden;padding:0;">
                    <button @@click="open = open === 3 ? null : 3" style="width:100%;display:flex;align-items:center;justify-content:space-between;padding:12px 16px;background:none;border:none;cursor:pointer;font-family:var(--font-sans);font-size:13px;font-weight:500;color:var(--color-text-primary);text-align:left;">
                        <span>Que signifie le score ?</span>
                        <svg class="w-4 h-4" style="color:var(--color-text-muted);transition:transform 0.15s;" :class="open === 3 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open === 3" style="padding:0 16px 12px;">
                        <p style="font-family:var(--font-sans);font-size:12.5px;color:var(--color-text-secondary);margin:0 0 8px;">Les scores vont de 0 à 100 :</p>
                        <div style="display:flex;flex-direction:column;gap:6px;">
                            <div style="display:flex;align-items:center;gap:8px;font-family:var(--font-sans);font-size:12px;color:var(--color-text-secondary);"><x-badge variant="danger" style="min-width:50px;">0–39</x-badge> À rejeter — Faible correspondance</div>
                            <div style="display:flex;align-items:center;gap:8px;font-family:var(--font-sans);font-size:12px;color:var(--color-text-secondary);"><x-badge variant="warning" style="min-width:50px;">40–69</x-badge> En attente — Correspondance partielle</div>
                            <div style="display:flex;align-items:center;gap:8px;font-family:var(--font-sans);font-size:12px;color:var(--color-text-secondary);"><x-badge variant="success" style="min-width:50px;">70–100</x-badge> À convoquer — Bonne correspondance</div>
                        </div>
                    </div>
                </div>
                <div class="card" style="border:1px solid var(--color-border);border-radius:10px;overflow:hidden;padding:0;">
                    <button @@click="open = open === 4 ? null : 4" style="width:100%;display:flex;align-items:center;justify-content:space-between;padding:12px 16px;background:none;border:none;cursor:pointer;font-family:var(--font-sans);font-size:13px;font-weight:500;color:var(--color-text-primary);text-align:left;">
                        <span>Comment le Chat IA garde-t-il le contexte ?</span>
                        <svg class="w-4 h-4" style="color:var(--color-text-muted);transition:transform 0.15s;" :class="open === 4 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open === 4" style="padding:0 16px 12px;">
                        <p style="font-family:var(--font-sans);font-size:12.5px;color:var(--color-text-secondary);margin:0;">Le Chat IA conserve l'historique des conversations dans chaque session pour des questions de suivi naturelles.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
