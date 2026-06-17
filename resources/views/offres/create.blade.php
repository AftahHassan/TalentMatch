<x-app-layout>
    <x-slot name="header">{{ __('Nouvelle offre') }}</x-slot>

    <div class="max-w-3xl mx-auto" x-data="{
        skills: [],
        newSkill: '',
        addSkill() {
            const s = this.newSkill.trim();
            if (s && !this.skills.includes(s)) { this.skills.push(s); this.newSkill = ''; }
        },
        removeSkill(index) { this.skills.splice(index, 1); },
        get skillsString() { return this.skills.join(','); }
    }">
        <div class="bg-white rounded-xl border border-gray-200 p-8">
            <form method="POST" action="{{ route('offres.store') }}">
                @csrf

                <div>
                    <label for="titre" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Titre du poste') }}</label>
                    <input id="titre" type="text" name="titre" :value="old('titre')" required
                        class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="e.g. Développeur Laravel">
                    <x-input-error :messages="$errors->get('titre')" class="mt-2" />
                </div>

                <div class="mt-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Description') }}</label>
                    <textarea id="description" name="description" rows="6" required
                        class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="Décrivez le poste, les responsabilités, et l'environnement de travail...">{{ old('description') }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('Compétences requises') }}</label>
                    <div class="flex gap-2 mb-2">
                        <input type="text" x-model="newSkill" @keydown.enter.prevent="addSkill"
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="e.g. PHP">
                        <button type="button" @click="addSkill"
                            class="px-4 py-2.5 rounded-lg bg-gray-100 text-gray-700 font-medium text-sm hover:bg-gray-200 transition whitespace-nowrap">
                            {{ __('Ajouter') }}
                        </button>
                    </div>
                    <div class="flex flex-wrap gap-2 mb-2" x-show="skills.length > 0">
                        <template x-for="(skill, index) in skills" :key="index">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-indigo-50 text-indigo-700 text-sm font-medium">
                                <span x-text="skill"></span>
                                <button type="button" @click="removeSkill(index)" class="text-indigo-400 hover:text-indigo-600">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </span>
                        </template>
                    </div>
                    <input type="hidden" name="competences_requises" x-bind:value="skillsString">
                    <x-input-error :messages="$errors->get('competences_requises')" class="mt-2" />
                    <p class="text-xs text-gray-400 mt-1">{{ __('Tapez une compétence et appuyez sur Entrée pour l\'ajouter.') }}</p>
                </div>

                <div class="mt-6">
                    <label for="niveau_experience" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Niveau d\'expérience requis') }}</label>
                    <input id="niveau_experience" type="number" name="niveau_experience" :value="old('niveau_experience')" min="0" required
                        class="block w-40 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="Années">
                    <x-input-error :messages="$errors->get('niveau_experience')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between mt-8 pt-6 border-t border-gray-100">
                    <a href="{{ route('offres.index') }}" class="text-sm text-gray-600 hover:text-gray-900 font-medium">
                        &larr; {{ __('Annuler') }}
                    </a>
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-6 py-2.5 rounded-lg bg-indigo-600 text-white font-medium text-sm hover:bg-indigo-500 transition">
                        {{ __('Créer l\'offre') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
