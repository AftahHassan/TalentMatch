<x-app-layout>
    @section('title', 'Recherche')

    <x-slot name="header">
        @if ($query)
            Résultats pour « {{ $query }} »
        @else
            Recherche
        @endif
    </x-slot>
    <x-slot name="subtitle">Recherchez des candidats, offres ou analyses</x-slot>

    @if (!$query)
        <div class="card">
            <x-empty-state title="Entrez un terme de recherche" subtitle="Trouvez des candidats, des offres d'emploi ou des analyses." />
        </div>
    @elseif ($results->isEmpty())
        <div class="card">
            <x-empty-state title="Aucun résultat trouvé" subtitle="Aucun résultat pour « {{ $query }}\&quot;. Essayez un autre terme." />
        </div>
    @else
        <div style="display:flex;flex-direction:column;gap:8px;">
            @foreach ($results as $result)
                <div class="card" style="padding:16px;display:flex;align-items:center;gap:16px;">
                    <div style="width:40px;height:40px;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;background:{{ $result['type'] === 'Job Offer' ? 'var(--color-primary-light)' : 'var(--color-success-bg)' }};">
                        @if ($result['type'] === 'Job Offer')
                            <svg class="w-5 h-5" style="color:var(--color-primary);" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M21 13.255A23.193 23.193 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        @else
                            <svg class="w-5 h-5" style="color:var(--color-success-text);" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
                        @endif
                    </div>
                    <div style="flex:1;min-width:0;">
                        <a href="{{ $result['url'] }}" style="font-family:var(--font-sans);font-size:13.5px;font-weight:500;color:var(--color-text-primary);text-decoration:none;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;display:block;">{{ $result['title'] }}</a>
                    </div>
                    <x-badge variant="neutral" style="font-size:11px;flex-shrink:0;">{{ $result['type'] }}</x-badge>
                </div>
            @endforeach
        </div>
    @endif

    <div style="margin-top:24px;">
        <a href="{{ route('dashboard') }}" style="font-family:var(--font-sans);font-size:12.5px;color:var(--color-primary);text-decoration:none;font-weight:500;display:flex;align-items:center;gap:6px;">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            Retour au tableau de bord
        </a>
    </div>
</x-app-layout>
