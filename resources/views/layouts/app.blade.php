<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'TalentMatch') }} @isset($title) — {{ $title }} @endisset</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased" style="background-color:#f8fafc;color:#0f172a;">
    <div class="flex min-h-screen">

        <aside class="fixed inset-y-0 left-0 z-50 w-60 flex flex-col" style="background-color:#0f172a;">
            <div class="px-5 py-5 pb-6">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0" style="background-color:#2563eb;">
                        <svg class="w-[18px] h-[18px] text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-white font-bold text-[15px] leading-tight">TalentMatch</div>
                        <div style="color:#94a3b8;font-size:10px;font-weight:500;letter-spacing:0.05em;text-transform:uppercase;">AI Recruitment</div>
                    </div>
                </a>
            </div>

            <div class="px-4 pb-6">
                <a href="{{ route('offres.create') }}" class="flex items-center justify-center gap-2 w-full px-4 py-2.5 rounded-lg text-white text-sm font-semibold hover:opacity-90 transition" style="background-color:#2563eb;">
                    <span class="text-lg leading-none">+</span>
                    New Job Offer
                </a>
            </div>

            <nav class="flex-1 px-2 space-y-0.5">
                @php
                    $navItems = [
                        ['route' => 'dashboard', 'href' => 'dashboard', 'label' => 'Dashboard', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                        ['route' => 'offres.*', 'href' => 'offres.index', 'label' => 'Job Offers', 'icon' => 'M21 13.255A23.193 23.193 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
                        ['route' => 'offres.*', 'href' => 'offres.index', 'label' => 'Candidates', 'icon' => 'M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2m6-10a4 4 0 100-8 4 4 0 000 8zm8 2v3m0 0v3m0-3h3m-3 0h-3'],
                        ['route' => 'analyses.*', 'href' => 'offres.index', 'label' => 'Analyses', 'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'],
                        ['route' => 'conversations.*', 'href' => 'offres.index', 'label' => 'AI Chat', 'icon' => 'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z'],
                    ];
                @endphp

                @foreach($navItems as $item)
                    @php $isActive = request()->routeIs($item['route']); @endphp
                    <a href="{{ route($item['href']) }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-[13px] transition" style="color:{{ $isActive ? '#ffffff' : '#94a3b8' }};background:{{ $isActive ? 'rgba(255,255,255,0.1)' : 'transparent' }};" onmouseover="if(!this.classList.contains('active'))this.style.background='rgba(255,255,255,0.05)'" onmouseout="if(!this.classList.contains('active'))this.style.background='transparent'">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="{{ $item['icon'] }}"/>
                        </svg>
                        {{ $item['label'] }}
                    </a>
                @endforeach

                <div class="pt-4 pb-2 px-3">
                    <span style="color:#475569;font-size:10px;font-weight:600;letter-spacing:0.08em;text-transform:uppercase;">System</span>
                </div>
                <a href="#" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-[13px]" style="color:#94a3b8;">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93l-1.41 1.41M4.93 4.93l1.41 1.41M4.93 19.07l1.41-1.41M19.07 19.07l-1.41-1.41M12 2v2M12 20v2M2 12h2M20 12h2"/></svg>
                    Settings
                </a>
                <a href="#" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-[13px]" style="color:#94a3b8;">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                    Support
                </a>
            </nav>

            <div style="border-top:1px solid rgba(255,255,255,0.08);padding:16px;">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-[12px] font-bold text-white flex-shrink-0" style="background-color:#2563eb;">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="text-white text-[12px] font-medium truncate">{{ auth()->user()->name }}</div>
                        <div style="color:#94a3b8;font-size:11px;truncate">{{ auth()->user()->email }}</div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" title="Déconnexion" style="background:none;border:none;cursor:pointer;color:#94a3b8;padding:4px;">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <div class="flex-1 ml-60 flex flex-col min-h-screen">

            <header class="sticky top-0 z-40 bg-white border-b border-gray-200 px-8 h-16 flex items-center gap-4">
                <div class="flex-1 max-w-md relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    <input type="text" placeholder="Search candidates, chats, or jobs..." class="w-full pl-9 pr-4 py-2 rounded-full border border-gray-200 text-[13px] outline-none" style="color:#64748b;background:#f8fafc;">
                </div>

                <div class="flex items-center gap-2 ml-auto">
                    <button class="w-9 h-9 rounded-full border border-gray-200 bg-white flex items-center justify-center hover:bg-gray-50 transition">
                        <svg class="w-4 h-4" fill="none" stroke="#64748b" viewBox="0 0 24 24" stroke-width="2"><path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 01-3.46 0"/></svg>
                    </button>
                    <button class="w-9 h-9 rounded-full border border-gray-200 bg-white flex items-center justify-center hover:bg-gray-50 transition">
                        <svg class="w-4 h-4" fill="none" stroke="#64748b" viewBox="0 0 24 24" stroke-width="2"><path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/></svg>
                    </button>
                    <div class="w-px h-7 bg-gray-200 mx-1"></div>
                    <div class="flex items-center gap-2.5">
                        <div class="text-right">
                            <div class="text-[13px] font-semibold" style="color:#0f172a;">{{ auth()->user()->name }}</div>
                            <div class="text-[11px]" style="color:#94a3b8;">Lead Recruiter</div>
                        </div>
                        <div class="w-9 h-9 rounded-full flex items-center justify-center text-[12px] font-bold text-white" style="background-color:#2563eb;">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 p-8">
                @isset($header)
                    <div class="mb-6">
                        <h2 class="text-xl font-bold text-gray-900">{{ $header }}</h2>
                    </div>
                @endisset
                {{ $slot }}
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
