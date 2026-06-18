<x-app-layout>
    <x-slot name="header">{{ __('New Analysis') }}</x-slot>

    <div class="max-w-3xl mx-auto">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-900">{{ __('New Analysis') }}</h1>
            <p class="text-gray-500 mt-1">{{ __('Submit candidate details for AI-powered evaluation.') }}</p>
        </div>

        <div class="card p-8">
            <div class="mb-6 pb-6 border-b border-gray-100">
                <p class="text-xs text-gray-400 uppercase tracking-wider font-medium">{{ __('Job Offer') }}</p>
                <p class="text-lg font-semibold text-gray-900 mt-1">{{ $offre->titre }}</p>
            </div>

            <form method="POST" action="{{ route('candidatures.store', $offre) }}">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('CANDIDATE NAME') }}</label>
                    <input type="text" name="nom" :value="old('nom')" required
                        class="input-field"
                        placeholder="e.g. Jordan Smith">
                    <x-input-error :messages="$errors->get('nom')" class="mt-2" />
                </div>

                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('CV CONTENT (ALTERNATIVE)') }}</label>
                    <textarea name="texte_cv" rows="10" required
                        class="input-field font-mono"
                        placeholder="Paste the text from the candidate's CV here if you don't have a file...">{{ old('texte_cv') }}</textarea>
                    <p class="text-xs text-gray-400 mt-1">{{ __('Minimum 100 characters required.') }}</p>
                    <x-input-error :messages="$errors->get('texte_cv')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between mt-8 pt-6 border-t border-gray-100">
                    <a href="{{ route('offres.show', $offre) }}" class="btn-ghost">
                        &larr; {{ __('Cancel') }}
                    </a>
                    <button type="submit" class="btn-primary">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                        {{ __('Analyze with AI') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
