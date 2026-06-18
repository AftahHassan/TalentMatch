<x-guest-layout>
    <div class="text-center mb-6">
        <div class="w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-sm" style="background-color:#fef3c7;">
            <svg class="w-7 h-7" style="color:#d97706;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m0 0v2m0-2h2m-2 0H10m9.364-7.364A9 9 0 1112 3a9 9 0 017.364 4.636z"/></svg>
        </div>
        <h3 class="font-semibold text-lg" style="color:#0f172a;">{{ __('Zone sécurisée') }}</h3>
        <p class="text-sm mt-1.5" style="color:#64748b;">{{ __('Veuillez confirmer votre mot de passe pour continuer.') }}</p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div>
            <label for="password" class="block text-sm font-medium mb-1.5" style="color:#0f172a;">{{ __('Mot de passe') }}</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="input-field"
                placeholder="••••••••">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-6">
            <button type="submit"
                class="btn-primary">
                {{ __('Confirmer') }}
            </button>
        </div>
    </form>
</x-guest-layout>
