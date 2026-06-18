@extends('layouts.app')

@section('content')
<div class="flex gap-0 -m-8 h-[calc(100vh-4rem)]">
    <div class="w-80 flex-shrink-0 border-r border-gray-200 bg-white flex flex-col overflow-hidden">
        <div class="p-5 border-b border-gray-100">
            <h1 class="text-lg font-bold text-gray-900">AI Chat</h1>
            <p class="text-sm text-gray-500 mt-0.5">Your conversations</p>
        </div>

        <div class="flex-1 overflow-y-auto">
            @if ($conversations->isEmpty())
                <div class="p-5 text-center mt-12">
                    <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                    <p class="text-sm font-medium text-gray-900">No conversations yet</p>
                    <p class="text-xs text-gray-500 mt-1">Start a chat from an analysis to begin.</p>
                </div>
            @else
                <div class="divide-y divide-gray-100">
                    @foreach ($conversations as $conversation)
                        @php $analyse = $conversation->analyse; @endphp
                        <a href="{{ route('conversations.show', $conversation) }}" class="flex items-start gap-3 px-5 py-4 hover:bg-gray-50 transition">
                            <div class="w-9 h-9 rounded-full bg-brand-600 flex items-center justify-center text-white text-xs font-bold flex-shrink-0 mt-0.5">
                                {{ strtoupper(substr($analyse?->candidature?->nom ?? '?', 0, 2)) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between gap-2">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ $analyse?->candidature?->nom ?? 'Unknown' }}</p>
                                    <span class="text-xs text-gray-400 flex-shrink-0">{{ $conversation->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-xs text-gray-500 truncate mt-0.5">{{ $analyse?->offre?->titre }}</p>
                                @php $lastMessage = $conversation->messages->last(); @endphp
                                @if ($lastMessage)
                                    <p class="text-xs text-gray-400 truncate mt-1">{{ Str::limit($lastMessage->contenu, 60) }}</p>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <div class="flex-1 flex items-center justify-center bg-gray-50/50">
        <div class="text-center max-w-sm">
            <div class="w-16 h-16 rounded-2xl bg-brand-50 flex items-center justify-center mx-auto mb-5">
                <svg class="w-8 h-8 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                    <path d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.455 2.456L21.75 6l-1.036.259a3.375 3.375 0 00-2.455 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z"/>
                </svg>
            </div>
            <h2 class="text-xl font-bold text-gray-900 mb-2">Select a conversation</h2>
            <p class="text-sm text-gray-500">Choose a conversation from the list to continue chatting.</p>
        </div>
    </div>
</div>
@endsection
