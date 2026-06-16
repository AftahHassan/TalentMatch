<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Soumettre un CV') }} — {{ $offre->titre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('candidatures.store', $offre) }}">
                        @csrf

                        <div>
                            <x-input-label for="nom" :value="__('Nom du candidat')" />
                            <x-text-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="old('nom')" required />
                            <x-input-error :messages="$errors->get('nom')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="texte_cv" :value="__('Texte du CV')" />
                            <textarea id="texte_cv" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" name="texte_cv" rows="10" required>{{ old('texte_cv') }}</textarea>
                            <p class="text-sm text-gray-500 mt-1">{{ __('Minimum 100 caractères.') }}</p>
                            <x-input-error :messages="$errors->get('texte_cv')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('offres.show', $offre) }}">
                                {{ __('Annuler') }}
                            </a>

                            <x-primary-button class="ms-4">
                                {{ __('Soumettre le CV') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
