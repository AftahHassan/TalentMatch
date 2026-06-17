<x-guest-layout>
    <div class="flex items-start gap-3 mb-6">
        <div class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center flex-shrink-0">
            <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m0 0v2m0-2h2m-2 0H10m9.364-7.364A9 9 0 1112 3a9 9 0 017.364 4.636z"/></svg>
        </div>
        <div>
            <h3 class="font-semibold text-gray-900">{{ __('Zone sécurisée') }}</h3>
            <p class="text-sm text-gray-600 mt-1">{{ __('Veuillez confirmer votre mot de passe pour continuer.') }}</p>
        </div>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Mot de passe') }}</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-6">
            <button type="submit"
                class="px-5 py-2.5 rounded-lg bg-indigo-600 text-white font-medium text-sm hover:bg-indigo-500 transition">
                {{ __('Confirmer') }}
            </button>
        </div>
    </form>
</x-guest-layout>
