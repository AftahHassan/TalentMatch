<x-app-layout>
    @section('title', 'Nouvelle offre')

    <x-slot name="header">Nouvelle offre d'emploi</x-slot>
    <x-slot name="subtitle">Définissez les critères pour votre prochaine recrue</x-slot>

    <div style="display:flex;justify-content:center;">
        <div style="width:100%;max-width:680px;">
            <div class="card" style="padding:32px;"
                 x-data="{
                     skills: [],
                     newSkill: '',
                     addSkill() {
                         const s = this.newSkill.trim();
                         if (s && !this.skills.includes(s)) { this.skills.push(s); this.newSkill = ''; }
                     },
                     removeSkill(i) { this.skills.splice(i, 1); },
                     get skillsString() { return this.skills.join(','); }
                 }">

                <form method="POST" action="{{ route('offres.store') }}"
                      style="display:flex;flex-direction:column;gap:18px;">
                    @csrf

                    <div>
                        <label for="titre" class="input-label">Titre du poste</label>
                        <input id="titre" type="text" name="titre" value="{{ old('titre') }}" required
                               class="input-field" placeholder="ex. Développeur Laravel Senior" autofocus>
                        @error('titre')<p class="input-error">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="description" class="input-label">Description du poste</label>
                        <textarea id="description" name="description" rows="5" required
                                  class="input-field"
                                  placeholder="Décrivez le rôle, les responsabilités, l'environnement de travail...">{{ old('description') }}</textarea>
                        @error('description')<p class="input-error">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="input-label">Compétences requises</label>
                        <div style="display:flex;gap:8px;margin-bottom:8px;">
                            <input type="text" x-model="newSkill" @keydown.enter.prevent="addSkill"
                                   class="input-field" placeholder="ex. PHP, Laravel, MySQL..." style="flex:1;">
                            <button type="button" @click="addSkill" class="btn-secondary" style="white-space:nowrap;">
                                Ajouter
                            </button>
                        </div>
                        <div style="display:flex;flex-wrap:wrap;gap:6px;" x-show="skills.length > 0">
                            <template x-for="(skill, i) in skills" :key="i">
                                <span class="badge badge-blue" style="font-size:12px;padding:4px 12px;">
                                    <span x-text="skill"></span>
                                    <button type="button" @click="removeSkill(i)"
                                            style="background:none;border:none;cursor:pointer;
                                                   color:var(--color-primary);margin-left:4px;line-height:1;padding:0;">
                                        ×
                                    </button>
                                </span>
                            </template>
                        </div>
                        <input type="hidden" name="competences_requises" x-bind:value="skillsString">
                        @error('competences_requises')<p class="input-error">{{ $message }}</p>@enderror
                        <p style="font-family:var(--font-sans);font-size:11.5px;color:var(--color-text-muted);margin-top:5px;">
                            Tapez une compétence et appuyez sur Entrée.
                        </p>
                    </div>

                    <div style="max-width:200px;">
                        <label for="niveau_experience" class="input-label">Expérience requise (années)</label>
                        <input id="niveau_experience" type="number" name="niveau_experience"
                               value="{{ old('niveau_experience') }}" min="0" required
                               class="input-field" placeholder="ex. 3">
                        @error('niveau_experience')<p class="input-error">{{ $message }}</p>@enderror
                    </div>

                    <div style="display:flex;align-items:center;justify-content:space-between;
                                padding-top:16px;border-top:1px solid var(--color-border-soft);">
                        <a href="{{ route('offres.index') }}" class="btn-ghost">← Annuler</a>
                        <button type="submit" class="btn-primary">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path d="M12 5v14M5 12h14"/>
                            </svg>
                            Créer l'offre
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>