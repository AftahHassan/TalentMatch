<x-guest-layout>
    <div class="flex items-start gap-3 mb-6">
        <div class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center flex-shrink-0">
            <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
        </div>
        <div>
            <h3 class="font-semibold text-gray-900">{{ __('Vérifiez votre email') }}</h3>
            <p class="text-sm text-gray-600 mt-1">{{ __('Merci de vous être inscrit ! Avant de commencer, veuillez vérifier votre adresse email en cliquant sur le lien que nous venons de vous envoyer.') }}</p>
        </div>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
            <p class="text-sm text-green-700">{{ __('Un nouveau lien de vérification a été envoyé à l\'adresse email fournie lors de l\'inscription.') }}</p>
        </div>
    @endif

    <div class="flex items-center justify-between gap-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit"
                class="px-5 py-2.5 rounded-lg bg-indigo-600 text-white font-medium text-sm hover:bg-indigo-500 transition">
                {{ __('Renvoyer l\'email') }}
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="text-sm text-gray-600 hover:text-gray-900 font-medium">
                {{ __('Déconnexion') }}
            </button>
        </form>
    </div>
</x-guest-layout>
