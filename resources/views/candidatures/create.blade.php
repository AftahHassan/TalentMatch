<x-app-layout>
    @section('title', 'Nouvelle analyse')

    <x-slot name="header">Nouvelle analyse</x-slot>
    <x-slot name="subtitle">Soumettez un CV pour évaluation par l'IA</x-slot>

    {{-- Centered, fits viewport --}}
    <div style="display:flex;justify-content:center;">
        <div style="width:100%;max-width:660px;">
            <div class="card" style="padding:32px;">

                {{-- Offer header --}}
                <div style="display:flex;align-items:center;gap:12px;padding-bottom:20px;
                            margin-bottom:22px;border-bottom:1px solid var(--color-border-soft);">
                    <div style="width:38px;height:38px;border-radius:var(--radius-md);
                                background:var(--color-primary-light);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg class="w-5 h-5" style="color:var(--color-primary);" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <rect x="2" y="7" width="20" height="14" rx="2"/>
                            <path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"/>
                        </svg>
                    </div>
                    <div>
                        <div style="font-family:var(--font-sans);font-size:10.5px;font-weight:700;
                                    text-transform:uppercase;letter-spacing:.07em;color:var(--color-text-muted);margin-bottom:2px;">
                            Offre d'emploi
                        </div>
                        <div style="font-family:var(--font-serif);font-size:15px;font-weight:600;color:var(--color-text-primary);">
                            {{ $offre->titre }}
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('candidatures.store', $offre) }}"
                      style="display:flex;flex-direction:column;gap:16px;">
                    @csrf

                    <div>
                        <label class="input-label">Nom du candidat</label>
                        <input type="text" name="nom" value="{{ old('nom') }}" required
                               class="input-field" placeholder="ex. Jordan Smith" autofocus>
                        @error('nom')<p class="input-error">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="input-label">Contenu du CV</label>
                        <textarea name="texte_cv" rows="9" required
                                  class="input-field content-box"
                                  placeholder="Collez ici le texte du CV du candidat...">{{ old('texte_cv') }}</textarea>
                        <p style="font-family:var(--font-sans);font-size:11.5px;color:var(--color-text-muted);margin-top:5px;">
                            Minimum 100 caractères requis.
                        </p>
                        @error('texte_cv')<p class="input-error">{{ $message }}</p>@enderror
                    </div>

                    <div style="display:flex;align-items:center;justify-content:space-between;
                                padding-top:16px;border-top:1px solid var(--color-border-soft);">
                        <a href="{{ route('offres.show', $offre) }}" class="btn-ghost">
                            ← Annuler
                        </a>
                        <button type="submit" class="btn-primary">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z"/>
                            </svg>
                            Analyser avec l'IA
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>