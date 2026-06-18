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
                    ? 'background:#eff6ff;color:#1e40af;font-weight:600;padding:6px 10px;border:1px solid #e2e8f0;text-align:left;font-size:11px'
                    : 'padding:6px 10px;border:1px solid #e2e8f0;color:#374151;vertical-align:top';
                $html .= '<tr>' . implode('', array_map(
                    fn($c) => "<{$tag} style=\"{$style}\">" . e(trim($c)) . "</{$tag}>",
                    $cells
                )) . '</tr>';
            }
            return $html . '</table></div>';
        }, $text);

        $text = preg_replace('/\*\*(.*?)\*\*/', '<strong style="font-weight:600;color:#111827">$1</strong>', $text);
        $text = preg_replace('/^### (.*)$/m', '<div style="font-weight:600;color:#111827;font-size:14px;margin:10px 0 4px">$1</div>', $text);
        $text = preg_replace('/^## (.*)$/m', '<div style="font-weight:600;font-size:15px;margin:10px 0 6px">$1</div>', $text);
        $text = preg_replace('/^- (.*)$/m', '<div style="display:flex;gap:8px;margin:3px 0"><span style="color:#2563eb;font-weight:700">•</span><span>$1</span></div>', $text);
        $text = nl2br($text);

        return $text;
    }
    @endphp

    <div class="max-w-7xl mx-auto flex flex-col lg:flex-row gap-6 h-[calc(100vh-10rem)]">
        <div class="lg:w-72 card p-6 flex-shrink-0 overflow-y-auto">
            @php $analyse = $conversation->analyse; @endphp
            <a href="{{ route('analyses.show', $analyse) }}" class="btn-ghost w-full justify-start mb-4">
                &larr; {{ __('Back to Analysis') }}
            </a>

            <div class="mb-4 pb-4 border-b border-gray-100">
                <p class="text-xs text-gray-400 uppercase tracking-wider">{{ __('Candidate') }}</p>
                <p class="font-semibold text-gray-900 mt-1">{{ $analyse->candidature?->nom ?? 'N/A' }}</p>
            </div>

            <div class="mb-4 pb-4 border-b border-gray-100">
                <p class="text-xs text-gray-400 uppercase tracking-wider">{{ __('Job Offer') }}</p>
                <p class="font-semibold text-gray-900 mt-1">{{ $analyse->offre?->titre }}</p>
            </div>

            @if ($analyse->score !== null)
                <div class="mb-4 pb-4 border-b border-gray-100">
                    <p class="text-xs text-gray-400 uppercase tracking-wider">{{ __('Score') }}</p>
                    <p class="text-2xl font-bold mt-1 {{ $analyse->score >= 70 ? 'text-green-600' : ($analyse->score >= 40 ? 'text-amber-600' : 'text-red-600') }}">
                        {{ $analyse->score }}
                        <span class="text-sm text-gray-400 font-normal">/ 100</span>
                    </p>
                </div>
            @endif

            @if ($analyse->recommandation)
                <div>
                    <p class="text-xs text-gray-400 uppercase tracking-wider mb-2">{{ __('Recommendation') }}</p>
                    @php
                        $recoColors = [
                            'convoquer' => 'bg-green-50 text-green-700',
                            'attente' => 'bg-amber-50 text-amber-700',
                            'rejeter' => 'bg-red-50 text-red-700',
                        ];
                    @endphp
                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium {{ $recoColors[$analyse->recommandation->value] ?? 'bg-gray-50 text-gray-600' }}">
                        {{ match($analyse->recommandation->value) { 'convoquer' => __('To Contact'), 'attente' => __('On Hold'), 'rejeter' => __('Reject'), default => '—' } }}
                    </span>
                </div>
            @endif
        </div>

        <div class="flex-1 card flex flex-col overflow-hidden">
            <div class="flex-1 overflow-y-auto p-6 space-y-4" id="messages-container">
                @forelse ($conversation->messages as $message)
                    <div class="flex {{ $message->role->value === 'user' ? 'justify-end' : 'justify-start' }}">
                        <div class="max-w-[75%] rounded-xl px-5 py-3 {{ $message->role->value === 'user' ? 'bg-brand-600 text-white' : 'bg-white border border-gray-200 text-gray-800' }}">
                            @if ($message->role->value === 'user')
                                <p class="whitespace-pre-line text-sm">{{ $message->contenu }}</p>
                            @else
                                <div class="text-sm leading-relaxed">{!! renderMarkdown($message->contenu) !!}</div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12" id="empty-chat-msg">
                        <div class="w-16 h-16 rounded-2xl bg-brand-50 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        </div>
                        <p class="text-gray-900 font-semibold text-lg">{{ __('AI Assistant') }}</p>
                        <p class="text-gray-400 text-sm mt-1">{{ __('Ask questions about this analysis.') }}</p>
                    </div>
                @endforelse
            </div>

            <div x-data="chatComponent({{ $conversation->id }})" class="flex flex-col">
                <div id="suggested-questions" style="padding:12px 20px;border-top:1px solid #f1f5f9;display:flex;gap:8px;flex-wrap:wrap;background:#fafafa;">
                    @foreach(['Pourquoi ce score ?', 'Quelles questions poser en entretien ?', 'Quels sont les points faibles du candidat ?', 'Compare avec un autre candidat'] as $question)
                    <button
                        type="button"
                        onclick="document.getElementById('chat-textarea').value = '{{ $question }}'; document.getElementById('chat-form').dispatchEvent(new Event('submit', {bubbles: true, cancelable: true}));"
                        style="padding:6px 14px;border:1px solid #e2e8f0;border-radius:9999px;background:#fff;color:#374151;font-size:12px;cursor:pointer;transition:all 0.15s;white-space:nowrap;"
                        onmouseover="this.style.background='#eff6ff';this.style.borderColor='#bfdbfe';this.style.color='#2563eb'"
                        onmouseout="this.style.background='#fff';this.style.borderColor='#e2e8f0';this.style.color='#374151'"
                    >{{ $question }}</button>
                    @endforeach
                </div>

                <form id="chat-form" method="POST" action="{{ route('messages.store', $conversation) }}"
                      @submit.prevent="sendMessage($event)" class="flex items-start gap-3 p-4 border-t border-gray-100">
                    @csrf
                    <div class="flex-1 relative">
                        <textarea
                            id="chat-textarea"
                            name="contenu"
                            rows="1"
                            class="input-field resize-none pr-4"
                            placeholder="{{ __('Write your message...') }}"
                            required
                        ></textarea>
                    </div>
                    <button
                        type="submit"
                        :disabled="loading"
                        class="flex-shrink-0 w-10 h-10 bg-brand-600 hover:bg-brand-700 disabled:opacity-50 text-white rounded-full flex items-center justify-center transition">
                        <svg x-show="!loading" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="22" y1="2" x2="11" y2="13"></line>
                            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                        </svg>
                        <svg x-show="loading" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 animate-spin" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
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
                        <div style="background:#2563eb;color:#fff;border-radius:16px;border-top-right-radius:4px;padding:12px 16px;max-width:75%;font-size:13px;line-height:1.6">${this.escapeHtml(message)}</div>
                    `;
                    container.appendChild(userDiv);

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
                        msgDiv.style.cssText = 'display:flex;justify-content:flex-start;margin-bottom:16px;gap:10px;align-items:flex-start';
                        msgDiv.innerHTML = `
                            <div style="width:32px;height:32px;border-radius:50%;background:#eff6ff;border:1px solid #bfdbfe;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            </div>
                            <div style="background:#ffffff;border:1px solid #e2e8f0;border-radius:16px;border-top-left-radius:4px;padding:12px 16px;max-width:75%;font-size:13px;color:#374151;line-height:1.6">${formatted}</div>
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
                                ? 'background:#eff6ff;color:#1e40af;font-weight:600;padding:6px 10px;border:1px solid #e2e8f0;text-align:left;font-size:11px'
                                : 'padding:6px 10px;border:1px solid #e2e8f0;color:#374151;vertical-align:top;font-size:12px';
                            html += '<tr>' + cells.map(c => `<${tag} style="${style}">${c.trim()}</${tag}>`).join('') + '</tr>';
                        });
                        html += '</table></div>';
                        return html;
                    });
                    text = text.replace(/\*\*(.*?)\*\*/g, '<strong style="font-weight:600;color:#111827">$1</strong>');
                    text = text.replace(/^### (.*$)/gim, '<div style="font-weight:600;color:#111827;font-size:14px;margin:12px 0 4px">$1</div>');
                    text = text.replace(/^## (.*$)/gim, '<div style="font-weight:600;color:#111827;font-size:15px;margin:12px 0 6px">$1</div>');
                    text = text.replace(/^- (.*$)/gim, '<div style="display:flex;gap:8px;margin:3px 0"><span style="color:#2563eb;font-weight:700;flex-shrink:0">•</span><span>$1</span></div>');
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
