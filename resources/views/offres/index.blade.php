<x-app-layout>
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;">
        <div>
            <h1 style="font-size:20px;font-weight:600;color:var(--color-text-primary);margin:0 0 4px;">Mes offres d'emploi</h1>
            <p style="font-size:13px;color:var(--color-text-secondary);margin:0;">Gérez vos offres et suivez les candidatures</p>
        </div>
        <a href="{{ route('offres.create') }}" class="btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            Nouvelle offre
        </a>
    </div>

    @if ($offres->isEmpty())
        <div class="card" style="padding:48px 24px;text-align:center;">
            <svg class="w-16 h-16" style="color:var(--color-text-muted);margin:0 auto 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.193 23.193 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            <h3 style="font-size:16px;font-weight:600;color:var(--color-text-primary);margin:0 0 8px;">Aucune offre pour le moment</h3>
            <p style="font-size:13px;color:var(--color-text-secondary);margin:0 0 20px;">Créez votre première offre d'emploi pour commencer à recevoir des candidatures.</p>
            <a href="{{ route('offres.create') }}" class="btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                Créer ma première offre
            </a>
        </div>
    @else
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:16px;">
            @foreach ($offres as $offre)
                <a href="{{ route('offres.show', $offre) }}" class="card" style="padding:20px;display:flex;flex-direction:column;text-decoration:none;transition:box-shadow .2s;"
                   onmouseover="this.style.boxShadow='0 4px 16px rgba(0,0,0,0.08)'" onmouseout="this.style.boxShadow='none'">
                    <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:12px;">
                        <div style="width:38px;height:38px;border-radius:10px;background:var(--color-accent-light);display:flex;align-items:center;justify-content:center;">
                            <svg class="w-5 h-5" style="color:var(--color-accent);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.193 23.193 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <span style="font-size:12px;color:var(--color-text-muted);">{{ $offre->created_at->format('d/m/Y') }}</span>
                    </div>
                    <h3 style="font-size:16px;font-weight:600;color:var(--color-text-primary);margin:0 0 6px;">{{ $offre->titre }}</h3>
                    <p style="font-size:13px;color:var(--color-text-secondary);margin:0 0 16px;line-height:1.5;flex:1;overflow:hidden;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;">{{ $offre->description }}</p>
                    <div style="display:flex;align-items:center;justify-content:space-between;padding-top:14px;border-top:1px solid var(--color-border);font-size:13px;">
                        <span style="color:var(--color-text-secondary);"><strong>{{ $offre->niveau_experience }}</strong> ans exp.</span>
                        <span style="color:var(--color-text-muted);">{{ $offre->analyses_count ?? $offre->analyses?->count() ?? 0 }} candidature(s)</span>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</x-app-layout>
