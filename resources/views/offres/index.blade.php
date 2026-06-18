<x-app-layout>
    <x-slot name="header">{{ __('Mes offres') }}</x-slot>

    <div class="max-w-7xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-2xl font-bold text-gray-900">{{ __('Job Offers') }}</h1>
            <a href="{{ route('offres.create') }}" class="btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                {{ __('New Job Offer') }}
            </a>
        </div>

        <div class="relative flex-1 max-w-md mb-8">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="text" placeholder="{{ __('Rechercher une offre...') }}" class="input-field pl-10">
        </div>

        @if ($offres->isEmpty())
            <div class="card p-12 text-center">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.193 23.193 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ __('No job offers yet') }}</h3>
                <p class="text-gray-500 mb-6">{{ __('Create your first job offer to start receiving candidatures.') }}</p>
                <a href="{{ route('offres.create') }}" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                    {{ __('Create your first offer') }}
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($offres as $offre)
                    <a href="{{ route('offres.show', $offre) }}" class="card p-6 hover:shadow-lg hover:border-brand-200 transition-all duration-200 group">
                        <div class="flex items-start justify-between mb-4">
                            <div class="w-10 h-10 rounded-lg bg-brand-600/10 flex items-center justify-center group-hover:bg-brand-600/20 transition-colors">
                                <svg class="w-5 h-5 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.193 23.193 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <span class="text-xs text-gray-400">{{ $offre->created_at->format('d/m/Y') }}</span>
                        </div>
                        <h3 class="font-semibold text-gray-900 group-hover:text-brand-600 transition-colors mb-2">{{ $offre->titre }}</h3>
                        <p class="text-sm text-gray-500 line-clamp-2 mb-4">{{ $offre->description }}</p>
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <span class="text-sm text-gray-600">
                                <span class="font-medium">{{ $offre->niveau_experience }}</span> {{ __('yrs exp.') }}
                            </span>
                            <span class="text-sm text-gray-500">
                                {{ $offre->analyses_count ?? $offre->analyses?->count() ?? 0 }} {{ __('candidature(s)') }}
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
