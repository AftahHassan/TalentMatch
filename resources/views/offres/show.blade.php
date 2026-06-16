<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $offre->titre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <dl class="grid grid-cols-1 gap-4">
                        <div>
                            <dt class="font-medium text-gray-500">{{ __('Description') }}</dt>
                            <dd class="mt-1">{{ $offre->description }}</dd>
                        </div>

                        <div>
                            <dt class="font-medium text-gray-500">{{ __('Compétences requises') }}</dt>
                            <dd class="mt-1">
                                @foreach ($offre->competences_requises as $competence)
                                    <span class="inline-block bg-indigo-100 text-indigo-800 text-sm px-2 py-1 rounded mr-1">{{ $competence }}</span>
                                @endforeach
                            </dd>
                        </div>

                        <div>
                            <dt class="font-medium text-gray-500">{{ __('Niveau d\'expérience') }}</dt>
                            <dd class="mt-1">{{ $offre->niveau_experience }} ans</dd>
                        </div>
                    </dl>

                    <div class="mt-6">
                        <a href="{{ route('offres.index') }}" class="text-indigo-600 hover:text-indigo-900">{{ __('Retour aux offres') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
