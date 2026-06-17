<x-guest-layout>
    <h3 class="font-semibold text-gray-900 mb-6">{{ __('Réinitialiser le mot de passe') }}</h3>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Email') }}</label>
            <input id="email" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username"
                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-5">
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Nouveau mot de passe') }}</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-5">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Confirmer le mot de passe') }}</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <button type="submit"
                class="px-5 py-2.5 rounded-lg bg-indigo-600 text-white font-medium text-sm hover:bg-indigo-500 transition">
                {{ __('Réinitialiser') }}
            </button>
        </div>
    </form>
</x-guest-layout>
