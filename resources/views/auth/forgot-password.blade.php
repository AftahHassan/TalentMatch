<x-guest-layout>
    <div class="text-center mb-6">
        <div class="w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-sm" style="background-color:#eff6ff;">
            <svg class="w-7 h-7" style="color:#2563eb;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
        </div>
        <h3 class="font-semibold text-lg" style="color:#0f172a;">{{ __('Mot de passe oublié ?') }}</h3>
        <p class="text-sm mt-1.5" style="color:#64748b;">{{ __('Pas de problème. Indiquez-nous votre adresse email et nous vous enverrons un lien de réinitialisation.') }}</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium mb-1.5" style="color:#0f172a;">{{ __('Email') }}</label>
            <input id="email" type="email" name="email" :value="old('email')" required autofocus
                class="input-field"
                placeholder="vous@exemple.fr">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <button type="submit"
                class="btn-primary">
                {{ __('Envoyer le lien') }}
            </button>
        </div>
    </form>

    <p class="mt-6 text-center text-sm" style="color:#64748b;">
        <a href="{{ route('login') }}" class="font-medium hover:underline inline-flex items-center gap-1.5" style="color:#2563eb;">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            {{ __('Retour à la connexion') }}
        </a>
    </p>
</x-guest-layout>
