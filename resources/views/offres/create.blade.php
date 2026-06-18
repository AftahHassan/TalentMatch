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
        <div class="card p-8">
            <div class="flex items-center gap-3 mb-8">
                <div class="w-10 h-10 rounded-lg bg-brand-600/10 flex items-center justify-center">
                    <svg class="w-5 h-5 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.193 23.193 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">{{ __('New Job Offer') }}</h2>
                    <p class="text-sm text-gray-500">{{ __('Fill in the details below to create a new job offer.') }}</p>
                </div>
            </div>

            <form method="POST" action="{{ route('offres.store') }}">
                @csrf

                <div>
                    <label for="titre" class="block text-sm font-medium text-gray-700 mb-1.5">{{ __('Job Title') }}</label>
                    <input id="titre" type="text" name="titre" :value="old('titre')" required
                        class="input-field"
                        placeholder="e.g. Senior Laravel Developer">
                    <x-input-error :messages="$errors->get('titre')" class="mt-2" />
                </div>

                <div class="mt-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1.5">{{ __('Description') }}</label>
                    <textarea id="description" name="description" rows="6" required
                        class="input-field"
                        placeholder="Describe the role, responsibilities, and work environment...">{{ old('description') }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">{{ __('Required Skills') }}</label>
                    <div class="flex gap-2 mb-2">
                        <input type="text" x-model="newSkill" @keydown.enter.prevent="addSkill"
                            class="input-field"
                            placeholder="e.g. PHP">
                        <button type="button" @click="addSkill" class="btn-secondary whitespace-nowrap">
                            {{ __('Add') }}
                        </button>
                    </div>
                    <div class="flex flex-wrap gap-2 mb-2" x-show="skills.length > 0">
                        <template x-for="(skill, index) in skills" :key="index">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-brand-600/10 text-brand-700 text-sm font-medium">
                                <span x-text="skill"></span>
                                <button type="button" @click="removeSkill(index)" class="text-brand-400 hover:text-brand-600 transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </span>
                        </template>
                    </div>
                    <input type="hidden" name="competences_requises" x-bind:value="skillsString">
                    <x-input-error :messages="$errors->get('competences_requises')" class="mt-2" />
                    <p class="text-xs text-gray-400 mt-1.5">{{ __('Type a skill and press Enter to add it.') }}</p>
                </div>

                <div class="mt-6">
                    <label for="niveau_experience" class="block text-sm font-medium text-gray-700 mb-1.5">{{ __('Experience Required') }}</label>
                    <input id="niveau_experience" type="number" name="niveau_experience" :value="old('niveau_experience')" min="0" required
                        class="input-field w-40"
                        placeholder="{{ __('Years') }}">
                    <x-input-error :messages="$errors->get('niveau_experience')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between mt-8 pt-6 border-t border-gray-100">
                    <a href="{{ route('offres.index') }}" class="btn-ghost gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        {{ __('Cancel') }}
                    </a>
                    <button type="submit" class="btn-primary">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                        {{ __('Create Job Offer') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
