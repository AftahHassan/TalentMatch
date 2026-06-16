<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $conversation->titre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="mb-4">
                        <a href="{{ route('analyses.show', $conversation->analyse) }}" class="text-indigo-600 hover:text-indigo-900 text-sm">
                            &larr; {{ __('Retour à l\'analyse') }}
                        </a>
                    </div>

                    <div class="space-y-4 mb-6 max-h-96 overflow-y-auto" id="messages-container">
                        @forelse ($conversation->messages as $message)
                            <div class="flex {{ $message->role->value === 'user' ? 'justify-end' : 'justify-start' }}">
                                <div class="max-w-[75%] rounded-lg px-4 py-2 {{ $message->role->value === 'user' ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-900' }}">
                                    <p class="whitespace-pre-line">{{ $message->contenu }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-gray-500 py-8">
                                <p>{{ __('Démarrez la conversation avec l\'assistant TalentMatch.') }}</p>
                            </div>
                        @endforelse
                    </div>

                    @if ($conversation->messages->isEmpty())
                        <div class="flex flex-wrap gap-2 mb-6 justify-center">
                            <button type="button" class="suggested-q inline-flex items-center px-3 py-1.5 bg-gray-100 hover:bg-gray-200 rounded-full text-sm text-gray-700 transition-colors">
                                Pourquoi ce score ?
                            </button>
                            <button type="button" class="suggested-q inline-flex items-center px-3 py-1.5 bg-gray-100 hover:bg-gray-200 rounded-full text-sm text-gray-700 transition-colors">
                                Quelles questions poser en entretien ?
                            </button>
                            <button type="button" class="suggested-q inline-flex items-center px-3 py-1.5 bg-gray-100 hover:bg-gray-200 rounded-full text-sm text-gray-700 transition-colors">
                                Quels sont les points faibles du candidat ?
                            </button>
                        </div>
                    @endif

                    <div x-data="{
                        loading: false,
                        sendMessage() {
                            const form = this.$refs.form;
                            const formData = new FormData(form);
                            const textarea = form.querySelector('textarea[name=\"contenu\"]');
                            const message = textarea.value.trim();

                            if (!message) return;

                            const container = document.getElementById('messages-container');
                            const emptyMsg = container.querySelector('.text-center.text-gray-500');
                            if (emptyMsg) emptyMsg.remove();
                            const suggestions = container.nextElementSibling;
                            if (suggestions && suggestions.classList.contains('flex-wrap')) suggestions.remove();

                            container.insertAdjacentHTML('beforeend',
                                `<div class=\"flex justify-end\"><div class=\"max-w-[75%] rounded-lg px-4 py-2 bg-indigo-600 text-white whitespace-pre-line\">${this.escapeHtml(message)}</div></div>`
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
                                    `<div class=\"flex justify-start\"><div class=\"max-w-[75%] rounded-lg px-4 py-2 bg-gray-100 text-gray-900 whitespace-pre-line\">${this.escapeHtml(data.message.contenu)}</div></div>`
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
                              @submit.prevent="sendMessage()" class="flex gap-2">
                            @csrf
                            <textarea
                                name="contenu"
                                rows="2"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 resize-none"
                                placeholder="{{ __('Écrivez votre message...') }}"
                                required
                            ></textarea>
                            <x-primary-button class="self-end" ::disabled="loading">
                                <template x-if="!loading">{{ __('Envoyer') }}</template>
                                <template x-if="loading">{{ __('Envoi...') }}</template>
                            </x-primary-button>
                        </form>
                    </div>

                </div>
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
