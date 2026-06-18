<x-app-layout>
    <x-slot name="header">{{ $conversation->titre }}</x-slot>

    @php
    function renderMarkdown(string $text): string {
        $text = preg_replace_callback('/(\|.+\|\n?)+/', function($matches) {
            $rows = array_filter(explode("\n", trim($matches[0])), fn($r) => trim($r));
            $rows = array_values(array_filter($rows, fn($r) => !preg_match('/^\|[-|\s]+\|$/', trim($r))));
            if (empty($rows)) return $matches[0];
            $html = '<div class="overflow-x-auto my-3"><table class="w-full text-sm border-collapse">';
            foreach ($rows as $i => $row) {
                $cells = array_slice(explode('|', $row), 1, -1);
                $tag = $i === 0 ? 'th' : 'td';
                $class = $i === 0
                    ? 'bg-indigo-50 text-indigo-900 font-semibold px-3 py-2 border border-gray-200 text-left text-xs'
                    : 'px-3 py-2 border border-gray-200 text-gray-700 align-top';
                $html .= '<tr>' . implode('', array_map(fn($c) => "<{$tag} class=\"{$class}\">" . trim($c) . "</{$tag}>", $cells)) . '</tr>';
            }
            $html .= '</table></div>';
            return $html;
        }, $text);

        $text = preg_replace('/\*\*(.*?)\*\*/', '<strong class="font-semibold text-gray-900">$1</strong>', $text);

        $text = preg_replace('/^### (.*)$/m', '<h4 class="font-semibold text-gray-900 mt-4 mb-2">$1</h4>', $text);
        $text = preg_replace('/^## (.*)$/m', '<h3 class="font-semibold text-gray-900 mt-4 mb-2 text-lg">$1</h3>', $text);

        $text = preg_replace('/^- (.*)$/m', '<div class="flex gap-2 my-1"><span class="text-indigo-500 font-bold">•</span><span>$1</span></div>', $text);

        $text = nl2br(e($text));

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
                                <div class="text-sm prose prose-sm max-w-none">{!! renderMarkdown($message->contenu) !!}</div>
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

            @if ($conversation->messages->isEmpty())
                <div class="flex flex-wrap gap-2 px-6 pb-4 justify-center" id="suggested-questions">
                    <button type="button" @click="document.querySelector('textarea[name=contenu]').value = 'Pourquoi ce score ?'; document.querySelector('form#chat-form').requestSubmit();" class="px-4 py-2 bg-white border border-gray-200 rounded-full text-sm text-gray-600 hover:bg-indigo-50 hover:border-indigo-300 hover:text-indigo-600 transition cursor-pointer">
                        {{ __('Pourquoi ce score ?') }}
                    </button>
                    <button type="button" @click="document.querySelector('textarea[name=contenu]').value = 'Quelles questions poser en entretien ?'; document.querySelector('form#chat-form').requestSubmit();" class="px-4 py-2 bg-white border border-gray-200 rounded-full text-sm text-gray-600 hover:bg-indigo-50 hover:border-indigo-300 hover:text-indigo-600 transition cursor-pointer">
                        {{ __('Quelles questions poser en entretien ?') }}
                    </button>
                    <button type="button" @click="document.querySelector('textarea[name=contenu]').value = 'Quels sont les points faibles du candidat ?'; document.querySelector('form#chat-form').requestSubmit();" class="px-4 py-2 bg-white border border-gray-200 rounded-full text-sm text-gray-600 hover:bg-indigo-50 hover:border-indigo-300 hover:text-indigo-600 transition cursor-pointer">
                        {{ __('Quels sont les points faibles du candidat ?') }}
                    </button>
                </div>
            @endif

            <div class="border-t border-gray-100 p-4" x-data="chatComponent({{ $conversation->id }})">
                <form id="chat-form" method="POST" action="{{ route('messages.store', $conversation) }}"
                      @submit.prevent="sendMessage($el)" class="flex items-start gap-3">
                    @csrf
                    <div class="flex-1 relative">
                        <textarea
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
                sendMessage(form) {
                    const textarea = form.querySelector('textarea');
                    const message = textarea.value.trim();
                    if (!message || this.loading) return;

                    const container = document.getElementById('messages-container');
                    const formData = new FormData(form);

                    const emptyMsg = document.getElementById('empty-chat-msg');
                    if (emptyMsg) emptyMsg.remove();
                    const suggestions = document.getElementById('suggested-questions');
                    if (suggestions) suggestions.remove();

                    container.insertAdjacentHTML('beforeend', `
                        <div class="flex justify-end mb-4">
                            <div class="bg-brand-600 text-white rounded-2xl rounded-tr-sm px-4 py-3 max-w-xs lg:max-w-md text-sm">
                                ${this.escapeHtml(message)}
                            </div>
                        </div>
                    `);

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
                        container.insertAdjacentHTML('beforeend', `
                            <div class="flex justify-start mb-4">
                                <div class="bg-white border border-gray-200 rounded-2xl rounded-tl-sm px-4 py-3 max-w-xs lg:max-w-md text-sm text-gray-800 prose prose-sm max-w-none">
                                    ${formatted}
                                </div>
                            </div>
                        `);
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
                    let output = text;

                    output = output.replace(/(\|.+\|\n?)+/g, (match) => {
                        const rows = match.trim().split('\n').filter(row => row.trim());
                        const filteredRows = rows.filter(row => !/^\|[-|\s]+\|$/.test(row.trim()));
                        if (filteredRows.length === 0) return match;

                        let html = '<div class="overflow-x-auto my-3"><table class="w-full text-sm border-collapse">';
                        filteredRows.forEach((row, index) => {
                            const cells = row.split('|').filter((cell, i, arr) => i > 0 && i < arr.length - 1);
                            const tag = index === 0 ? 'th' : 'td';
                            const cellClass = index === 0
                                ? 'bg-indigo-50 text-indigo-900 font-semibold px-3 py-2 border border-gray-200 text-left text-xs'
                                : 'px-3 py-2 border border-gray-200 text-gray-700 align-top';
                            html += '<tr>' + cells.map(cell =>
                                `<${tag} class="${cellClass}">${cell.trim()}</${tag}>`
                            ).join('') + '</tr>';
                        });
                        html += '</table></div>';
                        return html;
                    });

                    output = output.replace(/\*\*(.*?)\*\*/g, '<strong class="font-semibold text-gray-900">$1</strong>');

                    output = output.replace(/^### (.*$)/gim, '<h4 class="font-semibold text-gray-900 mt-4 mb-2 text-base">$1</h4>');
                    output = output.replace(/^## (.*$)/gim, '<h3 class="font-semibold text-gray-900 mt-4 mb-2 text-lg">$1</h3>');

                    output = output.replace(/^- (.*$)/gim, '<div class="flex gap-2 my-1"><span class="text-indigo-500 font-bold flex-shrink-0">•</span><span>$1</span></div>');

                    output = output.replace(/\n\n/g, '<div class="my-2"></div>');

                    output = output.replace(/\n/g, '<br>');

                    return output;
                },
                escapeHtml(str) {
                    const div = document.createElement('div');
                    div.textContent = str;
                    return div.innerHTML;
                }
            };
        }

        document.querySelectorAll('.suggested-q').forEach(btn => {
            btn.addEventListener('click', function() {
                const textarea = document.querySelector('textarea[name="contenu"]');
                textarea.value = this.textContent.trim();
                document.getElementById('chat-form').requestSubmit();
            });
        });
    </script>
    @endpush
</x-app-layout>
