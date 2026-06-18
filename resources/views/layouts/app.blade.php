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

    <script>
        if (localStorage.getItem('theme') === 'dark' ||
            (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>

    <style>
        .dark body { background: #020617; color: #f1f5f9; }
        .dark aside { background: #0a0f1e !important; }
        .dark header { background: #0f172a !important; border-color: #1e293b !important; }
        .dark main { background: #020617; }
        .dark .card { background: #0f172a !important; border-color: #1e293b !important; color: #f1f5f9 !important; }
        .dark input, .dark textarea, .dark select {
            background: #1e293b !important;
            border-color: #334155 !important;
            color: #f1f5f9 !important;
        }
        .dark [style*="color:#0f172a"] { color: #f1f5f9 !important; }
        .dark [style*="color:#64748b"] { color: #94a3b8 !important; }
        .dark [style*="border-color:#e2e8f0"] { border-color: #1e293b !important; }
        .dark .bg-white { background: #0f172a !important; }
        .dark .border-gray-200 { border-color: #1e293b !important; }
        .dark .text-gray-900 { color: #f1f5f9 !important; }
        .dark .text-gray-500 { color: #94a3b8 !important; }
        .dark .text-gray-400 { color: #64748b !important; }
        .dark .hover\:bg-gray-50:hover { background: #1e293b !important; }
    </style>
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
                        [
                            'route' => 'dashboard',
                            'label' => 'Dashboard',
                            'match' => 'dashboard',
                            'icon'  => '<path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>',
                        ],
                        [
                            'route' => 'offres.index',
                            'label' => 'Job Offers',
                            'match' => 'offres.*',
                            'icon'  => '<rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"/>',
                        ],
                        [
                            'route' => 'candidatures.index',
                            'label' => 'Candidates',
                            'match' => 'candidatures.*',
                            'icon'  => '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/>',
                        ],
                        [
                            'route' => 'analyses.index',
                            'label' => 'Analyses',
                            'match' => 'analyses.*',
                            'icon'  => '<path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>',
                        ],
                        [
                            'route' => 'conversations.index',
                            'label' => 'AI Chat',
                            'match' => 'conversations.*',
                            'icon'  => '<path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/>',
                        ],
                    ];
                @endphp

                @foreach($navItems as $item)
                    @php $isActive = request()->routeIs($item['match']); @endphp
                    <a href="{{ route($item['route']) }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-[13px] transition" style="color:{{ $isActive ? '#ffffff' : '#94a3b8' }};background:{{ $isActive ? 'rgba(255,255,255,0.1)' : 'transparent' }};" onmouseover="if(!this.classList.contains('active'))this.style.background='rgba(255,255,255,0.05)'" onmouseout="if(!this.classList.contains('active'))this.style.background='transparent'">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            {!! $item['icon'] !!}
                        </svg>
                        {{ $item['label'] }}
                    </a>
                @endforeach

                <div class="pt-4 pb-2 px-3">
                    <span style="color:#475569;font-size:10px;font-weight:600;letter-spacing:0.08em;text-transform:uppercase;">System</span>
                </div>
                <a href="{{ route('settings') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-[13px]" style="color:#94a3b8;">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93l-1.41 1.41M4.93 4.93l1.41 1.41M4.93 19.07l1.41-1.41M19.07 19.07l-1.41-1.41M12 2v2M12 20v2M2 12h2M20 12h2"/></svg>
                    Settings
                </a>
                <a href="{{ route('support') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-[13px]" style="color:#94a3b8;">
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
                    <form action="{{ route('search') }}" method="GET" class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Search candidates, chats, or jobs..." class="w-full pl-9 pr-4 py-2 rounded-full border border-gray-200 text-[13px] outline-none" style="color:#64748b;background:#f8fafc;">
                    </form>
                </div>

                <div class="flex items-center gap-2 ml-auto">
                    <button onclick="
                        if (document.documentElement.classList.contains('dark')) {
                            document.documentElement.classList.remove('dark');
                            localStorage.setItem('theme', 'light');
                        } else {
                            document.documentElement.classList.add('dark');
                            localStorage.setItem('theme', 'dark');
                        }
                    " class="w-9 h-9 rounded-full border border-gray-200 bg-white flex items-center justify-center hover:bg-gray-50 transition" title="Toggle dark mode">
                        <svg class="w-4 h-4 dark:hidden" fill="none" stroke="#64748b" viewBox="0 0 24 24" stroke-width="2"><path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/></svg>
                        <svg class="w-4 h-4 hidden dark:block" fill="none" stroke="#eab308" viewBox="0 0 24 24" stroke-width="2"><circle cx="12" cy="12" r="5"/><path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/></svg>
                    </button>
                    <button class="w-9 h-9 rounded-full border border-gray-200 bg-white flex items-center justify-center hover:bg-gray-50 transition">
                        <svg class="w-4 h-4" fill="none" stroke="#64748b" viewBox="0 0 24 24" stroke-width="2"><path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 01-3.46 0"/></svg>
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
                @isset($slot)
                    {{ $slot }}
                @endisset
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
