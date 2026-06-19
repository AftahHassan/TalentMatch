@props(['title' => ''])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'TalentMatch') }}@isset($title) — {{ $title }}@endisset</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
</head>
<body>
    <div x-data="{ sidebarOpen: false, sidebarCollapsed: false }" class="flex min-h-screen">
        {{-- Mobile overlay --}}
        <div x-show="sidebarOpen" @@click="sidebarOpen = false" class="fixed inset-0 z-40 bg-black/30 lg:hidden" style="display:none;"></div>

        {{-- Sidebar --}}
        <aside
            :class="sidebarCollapsed ? 'w-16' : 'w-60'"
            class="fixed inset-y-0 left-0 z-50 flex flex-col transition-all duration-200 ease-in-out"
            style="background: var(--color-sidebar-bg);"
        >
            {{-- Logo --}}
            <div class="flex items-center gap-3 px-5 py-5" :class="sidebarCollapsed ? 'justify-center px-0' : ''">
                <div style="width:36px;height:36px;border-radius:10px;background:var(--color-primary);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="white">
                        <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
                    </svg>
                </div>
                <div x-show="!sidebarCollapsed" class="min-w-0">
                    <div style="font-family:var(--font-serif);font-size:17px;font-weight:600;color:#fff;line-height:1.2;">TalentMatch</div>
                    <div style="color:#475569;font-size:9px;font-weight:600;letter-spacing:0.08em;text-transform:uppercase;">AI Recruitment</div>
                </div>
            </div>

            {{-- New offer button --}}
            <div x-show="!sidebarCollapsed" class="px-4 pb-5">
                <a href="{{ route('offres.create') }}" class="flex items-center justify-center gap-2 w-full py-2.5 rounded-lg text-white text-sm font-semibold hover:opacity-90 transition" style="background:var(--color-primary);">
                    <span class="text-lg leading-none">+</span>
                    Nouvelle offre
                </a>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 px-2 space-y-0.5 overflow-y-auto">
                @php
                    $navItems = [
                        ['route' => 'dashboard',            'label' => 'Dashboard',        'match' => 'dashboard',           'icon' => '<path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>'],
                        ['route' => 'candidatures.index',   'label' => 'Candidats',       'match' => 'candidatures.*',      'icon' => '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/>'],
                        ['route' => 'offres.index',         'label' => 'Offres d\'emploi','match' => 'offres.*',             'icon' => '<rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"/>'],
                        ['route' => 'analyses.index',       'label' => 'Entretiens',      'match' => 'analyses.*',          'icon' => '<path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>'],
                        ['route' => 'conversations.index',  'label' => 'Chat IA',         'match' => 'conversations.*',     'icon' => '<path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/>'],
                    ];
                @endphp

                @foreach($navItems as $item)
                    @php $isActive = request()->routeIs($item['match']); @endphp
                    <a href="{{ route($item['route']) }}"
                        class="flex items-center gap-3 px-5 py-2.5 rounded-lg text-[13.5px] transition-colors"
                        :class="sidebarCollapsed ? 'justify-center px-0 mx-1' : ''"
                        style="color:{{ $isActive ? '#fff' : 'var(--color-sidebar-text)' }};background:{{ $isActive ? 'var(--color-sidebar-active)' : 'transparent' }};font-weight:{{ $isActive ? '500' : '400' }};"
                        onmouseover="if(!this.classList.contains('active'))this.style.background='var(--color-sidebar-hover)'"
                        onmouseout="if(!this.classList.contains('active'))this.style.background='transparent'"
                    >
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            {!! $item['icon'] !!}
                        </svg>
                        <span x-show="!sidebarCollapsed">{{ $item['label'] }}</span>
                    </a>
                @endforeach

                <div x-show="!sidebarCollapsed" style="border-top:1px solid #1E2D3F;margin:12px 16px 8px;"></div>

                @php
                    $systemItems = [
                        ['route' => 'settings', 'label' => 'Paramètres', 'icon' => '<circle cx="12" cy="12" r="3"/><path d="M19.07 4.93l-1.41 1.41M4.93 4.93l1.41 1.41M4.93 19.07l1.41-1.41M19.07 19.07l-1.41-1.41M12 2v2M12 20v2M2 12h2M20 12h2"/>'],
                        ['route' => 'support',  'label' => 'Aide',       'icon' => '<circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/>'],
                    ];
                @endphp
                <span x-show="!sidebarCollapsed" style="color:#475569;font-size:10px;font-weight:600;letter-spacing:0.08em;text-transform:uppercase;display:block;padding:4px 20px 6px;">Système</span>

                @foreach($systemItems as $item)
                    @php $isActive = request()->routeIs($item['route']); @endphp
                    <a href="{{ route($item['route']) }}"
                        class="flex items-center gap-3 px-5 py-2.5 rounded-lg text-[13.5px] transition-colors"
                        :class="sidebarCollapsed ? 'justify-center px-0 mx-1' : ''"
                        style="color:{{ $isActive ? '#fff' : 'var(--color-sidebar-text)' }};background:{{ $isActive ? 'var(--color-sidebar-active)' : 'transparent' }};"
                        onmouseover="if(!this.classList.contains('active'))this.style.background='var(--color-sidebar-hover)'"
                        onmouseout="if(!this.classList.contains('active'))this.style.background='transparent'"
                    >
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            {!! $item['icon'] !!}
                        </svg>
                        <span x-show="!sidebarCollapsed">{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </nav>

            {{-- User footer --}}
            <div x-show="!sidebarCollapsed" style="border-top:1px solid #1E2D3F;padding:14px 16px;">
                <div class="flex items-center gap-3">
                    <div style="width:32px;height:32px;border-radius:999px;background:var(--color-primary);display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:700;color:#fff;flex-shrink:0;">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <div style="color:#fff;font-size:12px;font-weight:500;line-height:1.2;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ auth()->user()->name }}</div>
                        <div style="color:#475569;font-size:11px;">Recruteur</div>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="mt-2">
                    @csrf
                    <button type="submit" style="background:none;border:none;cursor:pointer;color:var(--color-text-muted);font-family:var(--font-sans);font-size:12px;padding:4px 0;display:flex;align-items:center;gap:6px;transition:color 0.15s;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='var(--color-text-muted)'">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                        Se déconnecter
                    </button>
                </form>
            </div>

            {{-- Collapse toggle --}}
            <button @@click="sidebarCollapsed = !sidebarCollapsed" style="border-top:1px solid #1E2D3F;padding:8px;display:flex;align-items:center;justify-content:center;color:var(--color-text-muted);background:none;border-left:none;border-right:none;border-bottom:none;cursor:pointer;" class="hover:text-white transition-colors">
                <svg class="w-4 h-4" :class="sidebarCollapsed ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M11 19l-7-7 7-7"/><path d="M18 19l-7-7 7-7"/></svg>
            </button>
        </aside>

        {{-- Main content area --}}
        <div :class="sidebarCollapsed ? 'ml-16' : 'ml-60'" class="flex-1 flex flex-col min-h-screen transition-all duration-200 ease-in-out">
            {{-- Navbar --}}
            <nav style="background:var(--color-surface);border-bottom:1px solid var(--color-border);height:60px;padding:0 32px;" class="flex items-center gap-4 sticky top-0 z-30">
                {{-- Mobile hamburger --}}
                <button @@click="sidebarOpen = true" class="lg:hidden btn-icon flex-shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>

                {{-- Breadcrumb --}}
                <div style="font-family:var(--font-sans);font-size:13.5px;color:var(--color-text-secondary);" class="flex-1">
                    @isset($breadcrumb)
                        {{ $breadcrumb }}
                    @else
                        {{ config('app.name', 'TalentMatch') }}
                    @endisset
                </div>

                {{-- Search --}}
                <form action="{{ route('search') }}" method="GET" class="relative hidden sm:block">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4" style="color:var(--color-text-muted);" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Rechercher..." style="border:1px solid var(--color-border);border-radius:999px;background:var(--color-bg);padding:7px 14px 7px 34px;font-family:var(--font-sans);font-size:12.5px;color:var(--color-text-primary);width:200px;outline:none;" onfocus="this.style.borderColor='var(--color-primary)'" onblur="this.style.borderColor='var(--color-border)'">
                </form>

                {{-- Dark mode toggle --}}
                <button onclick="
                    if (document.documentElement.classList.contains('dark')) {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('theme', 'light');
                    } else {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('theme', 'dark');
                    }
                " class="btn-icon flex-shrink-0">
                    <svg class="w-4 h-4 dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" style="color:var(--color-text-muted);"><path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/></svg>
                    <svg class="w-4 h-4 hidden dark:block" fill="none" stroke="#eab308" viewBox="0 0 24 24" stroke-width="2"><circle cx="12" cy="12" r="5"/><path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/></svg>
                </button>

                {{-- Notifications --}}
                <button class="btn-icon flex-shrink-0 relative">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" style="color:var(--color-text-muted);"><path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 01-3.46 0"/></svg>
                    <span style="width:7px;height:7px;border-radius:999px;background:var(--color-danger);position:absolute;top:8px;right:8px;"></span>
                </button>

                {{-- User avatar --}}
                <div style="width:32px;height:32px;border-radius:999px;background:var(--color-primary);display:flex;align-items:center;justify-content:center;font-size:10px;font-weight:700;color:#fff;flex-shrink:0;">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>
            </nav>

            {{-- Main content --}}
            <main style="padding:28px 32px;flex:1;">
                @isset($header)
                    <div style="margin-bottom:24px;">
                        <h1 style="font-family:var(--font-serif);font-size:22px;font-weight:600;color:var(--color-text-primary);">{{ $header }}</h1>
                        @isset($subtitle)
                            <p style="font-family:var(--font-serif);font-style:italic;font-size:13.5px;color:var(--color-text-muted);margin-top:4px;">{{ $subtitle }}</p>
                        @endisset
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
