<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Analyse') }} — {{ $analyse->candidature?->nom ?? 'N/A' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($analyse->statut === 'en_attente')
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                            <div class="flex">
                                <div class="ml-3">
                                    <p class="text-sm text-yellow-700">
                                        {{ __('Analyse en cours... Le résultat sera bientôt disponible.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @else
                        <dl class="grid grid-cols-1 gap-4">
                            <div>
                                <dt class="font-medium text-gray-500">{{ __('Candidat') }}</dt>
                                <dd class="mt-1">{{ $analyse->candidature?->nom }}</dd>
                            </div>

                            <div>
                                <dt class="font-medium text-gray-500">{{ __('Offre') }}</dt>
                                <dd class="mt-1">{{ $analyse->offre?->titre }}</dd>
                            </div>

                            @if ($analyse->score !== null)
                                <div>
                                    <dt class="font-medium text-gray-500">{{ __('Score') }}</dt>
                                    <dd class="mt-1">{{ $analyse->score }}/100</dd>
                                </div>
                            @endif

                            @if ($analyse->recommandation)
                                <div>
                                    <dt class="font-medium text-gray-500">{{ __('Recommandation') }}</dt>
                                    <dd class="mt-1">{{ __($analyse->recommandation->value) }}</dd>
                                </div>
                            @endif
                        </dl>
                    @endif
                </div>
            </div>

            <div>
                <a href="{{ route('offres.show', $analyse->offre) }}" class="text-indigo-600 hover:text-indigo-900 text-sm">
                    {{ __('Retour à l\'offre') }}
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
