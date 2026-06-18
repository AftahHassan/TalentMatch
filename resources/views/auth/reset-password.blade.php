<x-guest-layout>
    <div class="text-center mb-6">
        <div class="w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-sm" style="background-color:#eff6ff;">
            <svg class="w-7 h-7" style="color:#2563eb;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
        </div>
        <h3 class="font-semibold text-lg" style="color:#0f172a;">{{ __('Réinitialiser le mot de passe') }}</h3>
        <p class="text-sm mt-1.5" style="color:#64748b;">{{ __('Choisissez un nouveau mot de passe sécurisé.') }}</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
            <label for="email" class="block text-sm font-medium mb-1.5" style="color:#0f172a;">{{ __('Email') }}</label>
            <input id="email" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username"
                class="input-field">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-5">
            <label for="password" class="block text-sm font-medium mb-1.5" style="color:#0f172a;">{{ __('Nouveau mot de passe') }}</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                class="input-field"
                placeholder="Minimum 8 caractères">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-5">
            <label for="password_confirmation" class="block text-sm font-medium mb-1.5" style="color:#0f172a;">{{ __('Confirmer le mot de passe') }}</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                class="input-field"
                placeholder="Confirmez votre mot de passe">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <button type="submit"
                class="btn-primary">
                {{ __('Réinitialiser') }}
            </button>
        </div>
    </form>
</x-guest-layout>
