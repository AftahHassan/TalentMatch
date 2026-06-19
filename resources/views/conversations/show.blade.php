<x-app-layout>
    <x-slot name="header">{{ $conversation->titre }}</x-slot>

    @php
    function renderMarkdown(string $text): string {
        $text = preg_replace_callback('/(\|.+\|\n?)+/', function($m) {
            $rows = array_values(array_filter(
                explode("\n", trim($m[0])),
                fn($r) => trim($r) && !preg_match('/^\|[\s\-|]+\|$/', trim($r))
            ));
            if (empty($rows)) return $m[0];
            $html = '<div style="overflow-x:auto;margin:8px 0"><table style="width:100%;border-collapse:collapse;font-size:12px">';
            foreach ($rows as $i => $row) {
                $cells = array_slice(explode('|', $row), 1, -1);
                $tag = $i === 0 ? 'th' : 'td';
                $style = $i === 0
                    ? 'background:var(--color-primary-light);color:var(--color-primary);font-weight:600;padding:6px 10px;border:1px solid var(--color-border);text-align:left;font-size:11px'
                    : 'padding:6px 10px;border:1px solid var(--color-border);color:var(--color-text-secondary);vertical-align:top';
                $html .= '<tr>' . implode('', array_map(
                    fn($c) => "<{$tag} style=\"{$style}\">" . e(trim($c)) . "</{$tag}>",
                    $cells
                )) . '</tr>';
            }
            return $html . '</table></div>';
        }, $text);

        $text = preg_replace('/\*\*(.*?)\*\*/', '<strong style="font-weight:600;color:var(--color-text-primary)">$1</strong>', $text);
        $text = preg_replace('/^### (.*)$/m', '<div style="font-weight:600;color:var(--color-text-primary);font-size:14px;margin:10px 0 4px">$1</div>', $text);
        $text = preg_replace('/^## (.*)$/m', '<div style="font-weight:600;font-size:15px;margin:10px 0 6px">$1</div>', $text);
        $text = preg_replace('/^- (.*)$/m', '<div style="display:flex;gap:8px;margin:3px 0"><span style="color:var(--color-primary);font-weight:700">•</span><span>$1</span></div>', $text);
        $text = nl2br($text);

        return $text;
    }
    @endphp

    <div style="display:flex;gap:20px;height:calc(100vh - 140px);">
        {{-- Side panel with analysis info --}}
        <div class="card" style="width:260px;flex-shrink:0;overflow-y:auto;padding:20px;">
            @php $analyse = $conversation->analyse; @endphp
            <a href="{{ route('analyses.show', $analyse) }}" style="font-family:var(--font-sans);font-size:12.5px;color:var(--color-primary);text-decoration:none;display:flex;align-items:center;gap:6px;margin-bottom:16px;font-weight:500;">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                Retour à l'analyse
            </a>

            <div style="margin-bottom:16px;padding-bottom:16px;border-bottom:1px solid var(--color-border-soft);">
                <p style="font-family:var(--font-sans);font-size:11px;color:var(--color-text-muted);text-transform:uppercase;letter-spacing:0.04em;font-weight:500;margin-bottom:6px;">Candidat</p>
                <p style="font-family:var(--font-sans);font-size:13px;font-weight:500;color:var(--color-text-primary);margin:0;">{{ $analyse->candidature?->nom ?? 'N/A' }}</p>
            </div>

            <div style="margin-bottom:16px;padding-bottom:16px;border-bottom:1px solid var(--color-border-soft);">
                <p style="font-family:var(--font-sans);font-size:11px;color:var(--color-text-muted);text-transform:uppercase;letter-spacing:0.04em;font-weight:500;margin-bottom:6px;">Poste</p>
                <p style="font-family:var(--font-sans);font-size:13px;color:var(--color-text-secondary);margin:0;">{{ $analyse->offre?->titre }}</p>
            </div>

            @if ($analyse->score !== null)
                <div style="margin-bottom:16px;padding-bottom:16px;border-bottom:1px solid var(--color-border-soft);">
                    <p style="font-family:var(--font-sans);font-size:11px;color:var(--color-text-muted);text-transform:uppercase;letter-spacing:0.04em;font-weight:500;margin-bottom:8px;">Score</p>
                    <div style="display:flex;align-items:center;gap:12px;">
                        <x-score-circle :score="$analyse->score" />
                        <span style="font-family:var(--font-sans);font-size:12px;color:var(--color-text-muted);">
                            {{ $analyse->score >= 70 ? 'Excellent' : ($analyse->score >= 40 ? 'Moyen' : 'Faible') }}
                        </span>
                    </div>
                </div>
            @endif

            @if ($analyse->recommandation)
                <div>
                    <p style="font-family:var(--font-sans);font-size:11px;color:var(--color-text-muted);text-transform:uppercase;letter-spacing:0.04em;font-weight:500;margin-bottom:8px;">Recommandation</p>
                    <x-badge variant="{{ $analyse->recommandation->value === 'convoquer' ? 'success' : ($analyse->recommandation->value === 'attente' ? 'warning' : 'danger') }}">
                        {{ match($analyse->recommandation->value) { 'convoquer' => 'À convoquer', 'attente' => 'En attente', 'rejeter' => 'Rejeter', default => '—' } }}
                    </x-badge>
                </div>
            @endif
        </div>

        {{-- Chat panel --}}
        <div class="card" style="flex:1;display:flex;flex-direction:column;overflow:hidden;">
            {{-- Messages --}}
            <div style="flex:1;overflow-y:auto;padding:24px;display:flex;flex-direction:column;gap:16px;" id="messages-container">
                @forelse ($conversation->messages as $message)
                    <div style="display:flex;{{ $message->role->value === 'user' ? 'justify-content:flex-end' : 'justify-content:flex-start' }};">
                        @if ($message->role->value === 'user')
                            <div style="background:var(--color-primary);color:#fff;border-radius:18px 18px 4px 18px;padding:12px 16px;max-width:60%;font-family:var(--font-sans);font-size:14px;line-height:1.6;">
                                {{ $message->contenu }}
                            </div>
                        @else
                            <div style="display:flex;gap:10px;align-items:flex-start;max-width:75%;">
                                <div style="width:28px;height:28px;border-radius:999px;background:var(--color-primary-light);display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:4px;">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--color-primary)" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                </div>
                                <div style="background:var(--color-surface);border:0.5px solid var(--color-border);border-radius:18px 18px 18px 4px;padding:14px 16px;">
                                    <div style="display:flex;align-items:center;gap:8px;margin-bottom:8px;">
                                        <span style="font-family:var(--font-sans);font-size:12px;font-weight:500;color:var(--color-text-primary);">TalentMatch AI</span>
                                        <span style="font-family:var(--font-sans);font-size:11px;color:var(--color-text-muted);">{{ $message->created_at->format('H:i') }}</span>
                                    </div>
                                    <div style="font-family:var(--font-sans);font-size:14px;line-height:1.7;color:var(--color-text-secondary);">{!! renderMarkdown($message->contenu) !!}</div>
                                </div>
                            </div>
                        @endif
                    </div>
                @empty
                    <div style="text-align:center;padding:40px 20px;flex:1;display:flex;flex-direction:column;align-items:center;justify-content:center;" id="empty-chat-msg">
                        <div style="width:56px;height:56px;border-radius:14px;background:var(--color-primary-light);display:flex;align-items:center;justify-content:center;margin-bottom:16px;">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--color-primary)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        </div>
                        <p style="font-family:var(--font-serif);font-size:16px;font-weight:600;color:var(--color-text-primary);margin-bottom:4px;">Assistant IA</p>
                        <p style="font-family:var(--font-sans);font-size:13px;color:var(--color-text-muted);">Posez des questions sur cette analyse.</p>
                    </div>
                @endforelse
            </div>

            {{-- Suggested questions --}}
            <div style="padding:12px 20px;border-top:1px solid var(--color-border-soft);display:flex;gap:8px;flex-wrap:wrap;background:var(--color-bg);">
                @foreach(['Pourquoi ce score ?', 'Quelles questions poser en entretien ?', 'Points faibles du candidat', 'Comparer avec un autre'] as $question)
                <button
                    type="button"
                    onclick="document.getElementById('chat-textarea').value = '{{ $question }}'; document.getElementById('chat-form').dispatchEvent(new Event('submit', {bubbles: true, cancelable: true}));"
                    style="padding:6px 14px;border:1px solid var(--color-primary);border-radius:999px;background:transparent;color:var(--color-primary);font-family:var(--font-sans);font-size:12px;cursor:pointer;transition:all 0.15s;white-space:nowrap;"
                    onmouseover="this.style.background='var(--color-primary-light)'"
                    onmouseout="this.style.background='transparent'"
                >{{ $question }}</button>
                @endforeach
            </div>

            {{-- Input row --}}
            <div x-data="chatComponent({{ $conversation->id }})" style="border-top:1px solid var(--color-border);padding:16px 24px;background:var(--color-surface);">
                <form id="chat-form" method="POST" action="{{ route('messages.store', $conversation) }}"
                      @submit.prevent="sendMessage($event)" style="display:flex;align-items:flex-end;gap:12px;">
                    @csrf
                    <div style="flex:1;position:relative;">
                        <textarea
                            id="chat-textarea"
                            name="contenu"
                            rows="1"
                            class="input-field"
                            style="resize:none;padding:12px 16px;border-radius:12px;"
                            placeholder="Écrivez votre message..."
                            required
                            x-ref="textarea"
                        ></textarea>
                    </div>
                    <button
                        type="submit"
                        :disabled="loading"
                        style="width:40px;height:40px;border-radius:999px;background:var(--color-primary);color:#fff;border:none;display:flex;align-items:center;justify-content:center;cursor:pointer;flex-shrink:0;transition:background 0.15s;"
                        :style="loading ? 'opacity:0.5' : ''"
                        onmouseover="this.style.background='var(--color-primary-dark)'"
                        onmouseout="this.style.background='var(--color-primary)'"
                    >
                        <svg x-show="!loading" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="22" y1="2" x2="11" y2="13"></line>
                            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                        </svg>
                        <svg x-show="loading" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 animate-spin" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:none;">
                            <path d="M21 12a9 9 0 11-6.219-8.56"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function chatComponent(conversationId) {
            return {
                loading: false,
                sendMessage(event) {
                    const form = event.target;
                    const textarea = document.getElementById('chat-textarea');
                    const message = textarea.value.trim();
                    if (!message || this.loading) return;

                    const container = document.getElementById('messages-container');
                    const formData = new FormData(form);

                    const emptyMsg = document.getElementById('empty-chat-msg');
                    if (emptyMsg) emptyMsg.remove();

                    const userDiv = document.createElement('div');
                    userDiv.style.cssText = 'display:flex;justify-content:flex-end;margin-bottom:16px';
                    userDiv.innerHTML = `
                        <div style="background:var(--color-primary);color:#fff;border-radius:18px 18px 4px 18px;padding:12px 16px;max-width:60%;font-family:var(--font-sans);font-size:14px;line-height:1.6">${this.escapeHtml(message)}</div>
                    `;
                    container.appendChild(userDiv);
                    container.scrollTop = container.scrollHeight;

                    textarea.value = '';
                    this.loading = true;

                    fetch(form.action, {
                        method: 'POST',
                        headers: { 'X-Requested-With': 'XMLHttpRequest' },
                        body: formData,
                    })
                    .then(r => r.json())
                    .then(data => {
                        const formatted = this.formatResponse(data.message.contenu);
                        const msgDiv = document.createElement('div');
                        msgDiv.style.cssText = 'display:flex;justify-content:flex-start;margin-bottom:16px';
                        msgDiv.innerHTML = `
                            <div style="display:flex;gap:10px;align-items:flex-start;max-width:75%;">
                                <div style="width:28px;height:28px;border-radius:999px;background:var(--color-primary-light);display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:4px;">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--color-primary)" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                </div>
                                <div style="background:var(--color-surface);border:0.5px solid var(--color-border);border-radius:18px 18px 18px 4px;padding:14px 16px;">
                                    <div style="display:flex;align-items:center;gap:8px;margin-bottom:8px;">
                                        <span style="font-family:var(--font-sans);font-size:12px;font-weight:500;color:var(--color-text-primary);">TalentMatch AI</span>
                                        <span style="font-family:var(--font-sans);font-size:11px;color:var(--color-text-muted);">${new Date().toLocaleTimeString('fr-FR', {hour:'2-digit',minute:'2-digit'})}</span>
                                    </div>
                                    <div style="font-family:var(--font-sans);font-size:14px;line-height:1.7;color:var(--color-text-secondary);">${formatted}</div>
                                </div>
                            </div>
                        `;
                        container.appendChild(msgDiv);
                        container.scrollTop = container.scrollHeight;
                    })
                    .catch(() => {
                        textarea.value = message;
                    })
                    .finally(() => {
                        this.loading = false;
                    });
                },
                formatResponse(text) {
                    if (/<[a-z][\s\S]*>/i.test(text)) return text;
                    text = text.replace(/(\|.+\|\n?)+/g, (match) => {
                        const rows = match.trim().split('\n').filter(r => r.trim());
                        const filtered = rows.filter(r => !/^\|[\s\-|]+\|$/.test(r.trim()));
                        if (!filtered.length) return match;
                        let html = '<div style="overflow-x:auto;margin:8px 0"><table style="width:100%;border-collapse:collapse;font-size:12px">';
                        filtered.forEach((row, i) => {
                            const cells = row.split('|').filter((_, idx, arr) => idx > 0 && idx < arr.length - 1);
                            const tag = i === 0 ? 'th' : 'td';
                            const style = i === 0
                                ? 'background:var(--color-primary-light);color:var(--color-primary);font-weight:600;padding:6px 10px;border:1px solid var(--color-border);text-align:left;font-size:11px'
                                : 'padding:6px 10px;border:1px solid var(--color-border);color:var(--color-text-secondary);vertical-align:top;font-size:12px';
                            html += '<tr>' + cells.map(c => `<${tag} style="${style}">${c.trim()}</${tag}>`).join('') + '</tr>';
                        });
                        html += '</table></div>';
                        return html;
                    });
                    text = text.replace(/\*\*(.*?)\*\*/g, '<strong style="font-weight:600;color:var(--color-text-primary)">$1</strong>');
                    text = text.replace(/^### (.*$)/gim, '<div style="font-weight:600;color:var(--color-text-primary);font-size:14px;margin:12px 0 4px">$1</div>');
                    text = text.replace(/^## (.*$)/gim, '<div style="font-weight:600;color:var(--color-text-primary);font-size:15px;margin:12px 0 6px">$1</div>');
                    text = text.replace(/^- (.*$)/gim, '<div style="display:flex;gap:8px;margin:3px 0"><span style="color:var(--color-primary);font-weight:700;flex-shrink:0">•</span><span>$1</span></div>');
                    text = text.replace(/\n\n/g, '<div style="margin:6px 0"></div>');
                    text = text.replace(/\n/g, '<br>');
                    return text;
                },
                escapeHtml(str) {
                    const div = document.createElement('div');
                    div.textContent = str;
                    return div.innerHTML;
                }
            };
        }
    </script>
    @endpush
</x-app-layout>
