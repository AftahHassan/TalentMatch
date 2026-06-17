<x-app-layout>
    <x-slot name="header">{{ $conversation->titre }}</x-slot>

    <div class="max-w-7xl mx-auto flex flex-col lg:flex-row gap-6 h-[calc(100vh-10rem)]">
        <div class="lg:w-72 bg-white rounded-xl border border-gray-200 p-6 flex-shrink-0">
            @php $analyse = $conversation->analyse; @endphp
            <a href="{{ route('analyses.show', $analyse) }}" class="inline-flex items-center text-sm text-indigo-600 hover:text-indigo-500 font-medium mb-4">
                &larr; {{ __('Retour à l\'analyse') }}
            </a>

            <div class="mb-4 pb-4 border-b border-gray-100">
                <p class="text-xs text-gray-400 uppercase tracking-wider">{{ __('Candidat') }}</p>
                <p class="font-semibold text-gray-900 mt-1">{{ $analyse->candidature?->nom ?? 'N/A' }}</p>
            </div>

            <div class="mb-4 pb-4 border-b border-gray-100">
                <p class="text-xs text-gray-400 uppercase tracking-wider">{{ __('Offre') }}</p>
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
                    <p class="text-xs text-gray-400 uppercase tracking-wider mb-2">{{ __('Recommandation') }}</p>
                    @php
                        $recoColors = [
                            'convoquer' => 'bg-green-50 text-green-700',
                            'attente' => 'bg-amber-50 text-amber-700',
                            'rejeter' => 'bg-red-50 text-red-700',
                        ];
                    @endphp
                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium {{ $recoColors[$analyse->recommandation->value] ?? 'bg-gray-50 text-gray-600' }}">
                        {{ match($analyse->recommandation->value) { 'convoquer' => __('À convoquer'), 'attente' => __('En attente'), 'rejeter' => __('Rejeter'), default => '—' } }}
                    </span>
                </div>
            @endif
        </div>

        <div class="flex-1 bg-white rounded-xl border border-gray-200 flex flex-col">
            <div class="flex-1 overflow-y-auto p-6 space-y-4" id="messages-container">
                @forelse ($conversation->messages as $message)
                    <div class="flex {{ $message->role->value === 'user' ? 'justify-end' : 'justify-start' }}">
                        <div class="max-w-[75%] rounded-xl px-5 py-3 {{ $message->role->value === 'user' ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-900' }}">
                            <p class="whitespace-pre-line text-sm">{{ $message->contenu }}</p>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12" id="empty-chat-msg">
                        <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        <p class="text-gray-500 font-medium">{{ __('Assistant TalentMatch') }}</p>
                        <p class="text-gray-400 text-sm mt-1">{{ __('Posez vos questions sur cette analyse.') }}</p>
                    </div>
                @endforelse
            </div>

            @if ($conversation->messages->isEmpty())
                <div class="flex flex-wrap gap-2 px-6 pb-4 justify-center" id="suggested-questions">
                    <button type="button" class="suggested-q inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-full text-sm text-gray-700 transition-colors">
                        Pourquoi ce score ?
                    </button>
                    <button type="button" class="suggested-q inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-full text-sm text-gray-700 transition-colors">
                        Quelles questions poser en entretien ?
                    </button>
                    <button type="button" class="suggested-q inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-full text-sm text-gray-700 transition-colors">
                        Quels sont les points faibles du candidat ?
                    </button>
                </div>
            @endif

            <div class="border-t border-gray-100 p-4" x-data="{
                loading: false,
                sendMessage() {
                    const form = this.$refs.form;
                    const formData = new FormData(form);
                    const textarea = form.querySelector('textarea[name=\'contenu\']');
                    const message = textarea.value.trim();

                    if (!message) return;

                    const container = document.getElementById('messages-container');
                    const emptyMsg = document.getElementById('empty-chat-msg');
                    if (emptyMsg) emptyMsg.remove();
                    const suggestions = document.getElementById('suggested-questions');
                    if (suggestions) suggestions.remove();

                    container.insertAdjacentHTML('beforeend',
                        `<div class=\"flex justify-end\"><div class=\"max-w-[75%] rounded-xl px-5 py-3 bg-indigo-600 text-white whitespace-pre-line text-sm\">${this.escapeHtml(message)}</div></div>`
                    );

                    textarea.value = '';
                    this.loading = true;

                    fetch(form.action, {
                        method: 'POST',
                        headers: { 'X-Requested-With': 'XMLHttpRequest' },
                        body: formData,
                    })
                    .then(r => r.json())
                    .then(data => {
                        container.insertAdjacentHTML('beforeend',
                            `<div class=\"flex justify-start\"><div class=\"max-w-[75%] rounded-xl px-5 py-3 bg-gray-100 text-gray-900 whitespace-pre-line text-sm\">${this.escapeHtml(data.message.contenu)}</div></div>`
                        );
                        container.scrollTop = container.scrollHeight;
                    })
                    .catch(() => {
                        textarea.value = message;
                    })
                    .finally(() => {
                        this.loading = false;
                    });
                },
                escapeHtml(str) {
                    const div = document.createElement('div');
                    div.textContent = str;
                    return div.innerHTML;
                }
            }">
                <form x-ref="form" method="POST" action="{{ route('messages.store', $conversation) }}"
                      @submit.prevent="sendMessage()" class="flex gap-3">
                    @csrf
                    <textarea
                        name="contenu"
                        rows="1"
                        class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 resize-none text-sm"
                        placeholder="{{ __('Écrivez votre message...') }}"
                        required
                    ></textarea>
                    <button type="submit"
                        class="self-end px-5 py-2.5 rounded-lg bg-indigo-600 text-white font-medium text-sm hover:bg-indigo-500 transition disabled:opacity-50"
                        ::disabled="loading">
                        <template x-if="!loading">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                        </template>
                        <template x-if="loading">
                            <svg class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        </template>
                    </button>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.querySelectorAll('.suggested-q').forEach(btn => {
            btn.addEventListener('click', function() {
                const textarea = document.querySelector('textarea[name="contenu"]');
                textarea.value = this.textContent.trim();
                textarea.form.requestSubmit();
            });
        });
    </script>
    @endpush
</x-app-layout>
