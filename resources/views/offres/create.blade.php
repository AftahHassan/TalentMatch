<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nouvelle offre') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('offres.store') }}">
                        @csrf

                        <div>
                            <x-input-label for="titre" :value="__('Titre')" />
                            <x-text-input id="titre" class="block mt-1 w-full" type="text" name="titre" :value="old('titre')" required />
                            <x-input-error :messages="$errors->get('titre')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" name="description" rows="5" required>{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="competences_requises" :value="__('Compétences requises')" />
                            <x-text-input id="competences_requises" class="block mt-1 w-full" type="text" name="competences_requises" :value="old('competences_requises')" placeholder="PHP, Laravel, MySQL" />
                            <x-input-error :messages="$errors->get('competences_requises')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="niveau_experience" :value="__('Niveau d\'expérience (années)')" />
                            <x-text-input id="niveau_experience" class="block mt-1 w-full" type="number" name="niveau_experience" :value="old('niveau_experience')" min="0" required />
                            <x-input-error :messages="$errors->get('niveau_experience')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('offres.index') }}">
                                {{ __('Annuler') }}
                            </a>

                            <x-primary-button class="ms-4">
                                {{ __('Créer l\'offre') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
