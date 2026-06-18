<x-app-layout>
    @php
        $totalOffres = auth()->user()->offres()->count();
        $totalCandidatures = \App\Models\Candidature::count();
        $totalAnalyses = \App\Models\Analyse::count();
        $toConvoke = \App\Models\Analyse::where('recommandation', 'convoquer')->count();
        $avgScore = \App\Models\Analyse::where('statut','termine')->avg('score') ?? 0;
        $recentOffres = auth()->user()->offres()->withCount('analyses')->latest()->take(5)->get();
        $recentAnalyses = \App\Models\Analyse::with(['candidature','offre'])->where('statut','termine')->latest()->take(5)->get();
    @endphp

    <div>
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
            <p class="mt-1.5 text-sm text-gray-500">Welcome back, {{ auth()->user()->name }}. Here's what's happening.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="card p-5">
                <div class="flex items-start justify-between">
                    <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M21 13.255A23.193 23.193 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <span class="badge-green">+12%</span>
                </div>
                <div class="mt-4">
                    <p class="text-2xl font-bold text-gray-900">{{ $totalOffres }}</p>
                    <p class="text-sm text-gray-500 mt-1">Total Job Offers</p>
                </div>
            </div>

            <div class="card p-5">
                <div class="flex items-start justify-between">
                    <div class="w-10 h-10 rounded-lg bg-green-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
                    </div>
                    <span class="badge-green">+8%</span>
                </div>
                <div class="mt-4">
                    <p class="text-2xl font-bold text-gray-900">{{ $totalCandidatures }}</p>
                    <p class="text-sm text-gray-500 mt-1">Total Candidates</p>
                </div>
            </div>

            <div class="card p-5">
                <div class="flex items-start justify-between">
                    <div class="w-10 h-10 rounded-lg bg-cyan-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <span class="badge-green">+15%</span>
                </div>
                <div class="mt-4">
                    <p class="text-2xl font-bold text-gray-900">{{ $totalAnalyses }}</p>
                    <p class="text-sm text-gray-500 mt-1">Analyzed Candidates</p>
                </div>
            </div>

            <div class="card p-5">
                <div class="flex items-start justify-between">
                    <div class="w-10 h-10 rounded-lg bg-purple-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <span class="badge-green">+22%</span>
                </div>
                <div class="mt-4">
                    <p class="text-2xl font-bold text-gray-900">{{ $toConvoke }}</p>
                    <p class="text-sm text-gray-500 mt-1">Interview Recommended</p>
                </div>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-6">
            <div class="flex-1 card">
                <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="font-semibold text-gray-900">Top AI Matches</h3>
                    <a href="{{ route('offres.index') }}" class="text-sm text-brand-600 hover:text-brand-700 font-medium">View All</a>
                </div>
                <div class="p-5">
                    @if ($recentAnalyses->isEmpty())
                        <p class="text-gray-500 text-sm">No analyses completed yet.</p>
                    @else
                        <div class="space-y-1">
                            @foreach ($recentAnalyses as $analyse)
                                <a href="{{ route('analyses.show', $analyse) }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition">
                                    <div class="w-9 h-9 rounded-full bg-brand-600 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                                        {{ strtoupper(substr($analyse->candidature?->nom ?? '?', 0, 2)) }}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate">{{ $analyse->candidature?->nom ?? 'Unknown' }}</p>
                                        <p class="text-xs text-gray-500 truncate">Applied for {{ $analyse->offre?->titre ?? 'N/A' }}</p>
                                    </div>
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5 {{ $analyse->score >= 70 ? 'text-yellow-400' : ($analyse->score >= 40 ? 'text-yellow-400' : 'text-gray-300') }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                        <span class="{{ $analyse->score >= 70 ? 'badge-green' : ($analyse->score >= 40 ? 'badge-amber' : 'badge-red') }}">
                                            {{ $analyse->score }}/100
                                        </span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <div class="w-full lg:w-[320px] flex-shrink-0 space-y-6">
                <div class="card p-6 text-center">
                    <p class="text-xs font-semibold text-gray-400 tracking-wider uppercase mb-5">Avg Matching Score</p>
                    <div class="relative inline-flex items-center justify-center">
                        @php $circumference = 2 * pi() * 54; @endphp
                        <svg class="transform -rotate-90" width="140" height="140" viewBox="0 0 120 120">
                            <circle cx="60" cy="60" r="54" fill="none" stroke="#e5e7eb" stroke-width="8"/>
                            <circle cx="60" cy="60" r="54" fill="none" stroke="#2563eb" stroke-width="8" stroke-linecap="round"
                                stroke-dasharray="{{ $circumference }}"
                                stroke-dashoffset="{{ $circumference * (1 - $avgScore / 100) }}"/>
                        </svg>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-3xl font-bold text-gray-900">{{ round($avgScore) }}</span>
                        </div>
                    </div>
                    <p class="mt-4 text-xs text-gray-500">Average matching score across all analyses</p>
                </div>

                <div class="card">
                    <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                        <h3 class="font-semibold text-gray-900">Recent Job Offers</h3>
                        <a href="{{ route('offres.index') }}" class="text-sm text-brand-600 hover:text-brand-700 font-medium">View All</a>
                    </div>
                    <div class="p-5">
                        @if ($recentOffres->isEmpty())
                            <p class="text-gray-500 text-sm">No offers yet.</p>
                            <a href="{{ route('offres.create') }}" class="mt-3 inline-flex items-center text-sm text-brand-600 hover:text-brand-700 font-medium">
                                Create your first offer &rarr;
                            </a>
                        @else
                            <div class="space-y-1">
                                @foreach ($recentOffres as $offre)
                                    <a href="{{ route('offres.show', $offre) }}" class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 transition">
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 truncate">{{ $offre->titre }}</p>
                                            <p class="text-xs text-gray-500">{{ $offre->analyses_count }} analyses</p>
                                        </div>
                                        <svg class="w-4 h-4 text-gray-400 flex-shrink-0 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M9 5l7 7-7 7"/></svg>
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
