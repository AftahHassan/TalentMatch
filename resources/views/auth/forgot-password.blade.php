<x-guest-layout>
    <h3 class="font-semibold text-gray-900 mb-2">{{ __('Mot de passe oublié ?') }}</h3>
    <p class="text-sm text-gray-600 mb-6">{{ __('Pas de problème. Indiquez-nous votre adresse email et nous vous enverrons un lien de réinitialisation.') }}</p>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Email') }}</label>
            <input id="email" type="email" name="email" :value="old('email')" required autofocus
                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                placeholder="vous@exemple.fr">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <button type="submit"
                class="px-5 py-2.5 rounded-lg bg-indigo-600 text-white font-medium text-sm hover:bg-indigo-500 transition">
                {{ __('Envoyer le lien') }}
            </button>
        </div>
    </form>

    <p class="mt-6 text-center text-sm text-gray-500">
        <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-500 font-medium">
            &larr; {{ __('Retour à la connexion') }}
        </a>
    </p>
</x-guest-layout>
