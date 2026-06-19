<x-app-layout>
    @section('title', 'Chat IA')

    <div style="display:flex;margin:-28px -32px;height:calc(100vh - 60px);">

        {{-- Left panel: conversations list --}}
        <div style="width:280px;flex-shrink:0;border-right:1px solid var(--color-border);background:var(--color-surface);display:flex;flex-direction:column;overflow:hidden;">
            <div style="padding:20px 16px 12px;border-bottom:1px solid var(--color-border-soft);">
                <h2 style="font-family:var(--font-serif);font-size:15px;font-weight:600;color:var(--color-text-primary);margin-bottom:12px;">Conversations</h2>
                <form action="{{ route('analyses.index') }}" method="GET">
                    <button type="submit" class="btn-secondary" style="width:100%;font-size:12.5px;">+ Nouvelle conversation</button>
                </form>
            </div>
            <div style="flex:1;overflow-y:auto;">
                @if ($conversations->isEmpty())
                    <div style="padding:32px 16px;text-align:center;">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="var(--color-text-muted)" stroke-width="1.5" style="margin:0 auto 12px;display:block;opacity:0.4;">
                            <path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        <p style="font-family:var(--font-serif);font-style:italic;font-size:13px;color:var(--color-text-secondary);">Aucune conversation</p>
                        <p style="font-family:var(--font-sans);font-size:12px;color:var(--color-text-muted);margin-top:4px;">Démarrez un chat depuis une analyse.</p>
                    </div>
                @else
                    @foreach ($conversations as $conversation)
                        @php $analyse = $conversation->analyse; @endphp
                        <a href="{{ route('conversations.show', $conversation) }}"
                            style="display:flex;align-items:flex-start;gap:10px;padding:12px 16px;text-decoration:none;border-left:3px solid transparent;transition:all 0.15s;{{ request()->route('conversation')?->id === $conversation->id ? 'background:var(--color-primary-light);border-left-color:var(--color-primary);' : '' }}"
                            onmouseover="this.style.background='var(--color-primary-light)'"
                            onmouseout="this.style.background='{{ request()->route('conversation')?->id === $conversation->id ? 'var(--color-primary-light)' : 'transparent' }}'"
                        >
                            <div style="width:28px;height:28px;border-radius:999px;background:var(--color-primary);display:flex;align-items:center;justify-content:center;font-size:10px;font-weight:700;color:#fff;flex-shrink:0;margin-top:2px;">
                                {{ strtoupper(substr($analyse?->candidature?->nom ?? '?', 0, 2)) }}
                            </div>
                            <div style="flex:1;min-width:0;">
                                <div style="display:flex;align-items:center;justify-content:space-between;gap:8px;">
                                    <span style="font-family:var(--font-sans);font-size:13px;font-weight:500;color:var(--color-text-primary);overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $analyse?->candidature?->nom ?? 'Inconnu' }}</span>
                                    <span style="font-family:var(--font-sans);font-size:11px;color:var(--color-text-muted);flex-shrink:0;">{{ $conversation->created_at->diffForHumans() }}</span>
                                </div>
                                <div style="font-family:var(--font-sans);font-size:11.5px;color:var(--color-text-muted);margin-top:2px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                                    {{ $analyse?->offre?->titre ?? 'N/A' }}
                                </div>
                                @php $lastMessage = $conversation->messages->last(); @endphp
                                @if ($lastMessage)
                                    <div style="font-family:var(--font-sans);font-size:11.5px;color:var(--color-text-muted);margin-top:4px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                                        {{ Str::limit($lastMessage->contenu, 50) }}
                                    </div>
                                @endif
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>
        </div>

        {{-- Right panel: empty state --}}
        <div style="flex:1;display:flex;align-items:center;justify-content:center;background:var(--color-bg);">
            <div style="text-align:center;max-width:360px;padding:40px;">
                <div style="width:64px;height:64px;border-radius:16px;background:var(--color-primary-light);display:flex;align-items:center;justify-content:center;margin:0 auto 20px;">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--color-primary)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z"/>
                    </svg>
                </div>
                <h2 style="font-family:var(--font-serif);font-size:17px;font-weight:600;color:var(--color-text-primary);margin-bottom:6px;">TalentMatch AI</h2>
                <p style="font-family:var(--font-serif);font-style:italic;font-size:13px;color:var(--color-text-secondary);">Sélectionnez une conversation</p>
                <p style="font-family:var(--font-sans);font-size:12.5px;color:var(--color-text-muted);margin-top:8px;line-height:1.6;">
                    Choisissez une conversation dans la liste de gauche ou démarrez-en une nouvelle depuis une analyse.
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
