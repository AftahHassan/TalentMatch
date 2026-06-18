@extends('layouts.app')

@section('content')
    <div>
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">
                @if ($query)
                    Search results for '{{ $query }}'
                @else
                    Search
                @endif
            </h1>
        </div>

        @if (!$query)
            <div class="card p-8 text-center">
                <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <p class="text-gray-500">Enter a search term to find candidates, jobs, or analyses.</p>
            </div>
        @elseif ($results->isEmpty())
            <div class="card p-8 text-center">
                <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                    <circle cx="12" cy="12" r="10"/><path d="M16 16s-1.5-2-4-2-4 2-4 2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/>
                </svg>
                <p class="text-gray-500">No results found for '{{ $query }}'</p>
            </div>
        @else
            <div class="space-y-3">
                @foreach ($results as $result)
                    <div class="card p-4 flex items-center gap-4">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0 {{ $result['type'] === 'Job Offer' ? 'bg-blue-50' : 'bg-green-50' }}">
                            @if ($result['type'] === 'Job Offer')
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path d="M21 13.255A23.193 23.193 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            @else
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/>
                                </svg>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <a href="{{ $result['url'] }}" class="text-sm font-medium text-gray-900 hover:text-blue-600 transition truncate block">
                                {{ $result['title'] }}
                            </a>
                        </div>
                        <span class="badge-gray text-xs whitespace-nowrap">{{ $result['type'] }}</span>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="mt-8">
            <a href="{{ route('dashboard') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                &larr; Back to Dashboard
            </a>
        </div>
    </div>
@endsection
