<x-app-layout>
    <x-slot name="header">{{ __('Soumettre un CV') }}</x-slot>

    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-xl border border-gray-200 p-8">
            <div class="mb-6 pb-6 border-b border-gray-100">
                <p class="text-sm text-gray-500">{{ __('Offre') }}</p>
                <p class="text-lg font-semibold text-gray-900">{{ $offre->titre }}</p>
            </div>

            <form method="POST" action="{{ route('candidatures.store', $offre) }}">
                @csrf

                <div>
                    <label for="nom" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Nom du candidat') }}</label>
                    <input id="nom" type="text" name="nom" :value="old('nom')" required
                        class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="e.g. Jean Dupont">
                    <x-input-error :messages="$errors->get('nom')" class="mt-2" />
                </div>

                <div class="mt-6">
                    <label for="texte_cv" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Texte du CV') }}</label>
                    <textarea id="texte_cv" name="texte_cv" rows="12" required
                        class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 font-mono text-sm"
                        placeholder="Collez le contenu du CV ici...">{{ old('texte_cv') }}</textarea>
                    <p class="text-xs text-gray-400 mt-1">{{ __('Minimum 100 caractères requis.') }}</p>
                    <x-input-error :messages="$errors->get('texte_cv')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between mt-8 pt-6 border-t border-gray-100">
                    <a href="{{ route('offres.show', $offre) }}" class="text-sm text-gray-600 hover:text-gray-900 font-medium">
                        &larr; {{ __('Annuler') }}
                    </a>
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-6 py-2.5 rounded-lg bg-indigo-600 text-white font-medium text-sm hover:bg-indigo-500 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ __('Soumettre le CV') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
