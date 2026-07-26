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

    {{-- Anti-FOUC dark mode --}}
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div x-data="{ sidebarCollapsed: false, sidebarOpen: false }" class="flex min-h-screen">

    {{-- Mobile overlay --}}
    <div x-show="sidebarOpen" @click="sidebarOpen = false"
         class="fixed inset-0 z-40 bg-black/40 lg:hidden" style="display:none;"></div>

    {{-- ── SIDEBAR ─────────────────────────────────────────────── --}}
    <aside :class="sidebarCollapsed ? 'w-[62px]' : 'w-[230px]'"
           class="fixed inset-y-0 left-0 z-50 flex flex-col transition-all duration-200"
           style="background:var(--color-sidebar-bg);">

        {{-- Logo --}}
        <div class="flex items-center gap-3 px-4 py-5"
             :class="sidebarCollapsed && 'justify-center'">
            <div style="width:34px;height:34px;border-radius:10px;background:var(--color-primary);
                        display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <svg width="17" height="17" viewBox="0 0 24 24" fill="white">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                </svg>
            </div>
            <div x-show="!sidebarCollapsed">
                <div style="font-family:var(--font-serif);font-size:16px;font-weight:600;color:#fff;">TalentMatch</div>
                <div style="font-family:var(--font-sans);font-size:9px;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#475569;">AI Recruitment</div>
            </div>
        </div>

        {{-- New offer CTA --}}
        <div x-show="!sidebarCollapsed" class="px-3 pb-4">
            <a href="{{ route('offres.create') }}"
               class="flex items-center justify-center gap-2 w-full py-2 rounded-lg text-white text-xs font-semibold transition"
               style="background:var(--color-primary);border-radius:var(--radius-md);">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path d="M12 5v14M5 12h14"/>
                </svg>
                Nouvelle offre
            </a>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 px-2 space-y-0.5 overflow-y-auto pb-4">
            @php
                $navItems = [
                    ['route'=>'dashboard',           'label'=>'Dashboard',        'match'=>'dashboard',      'icon'=>'<path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>'],
                    ['route'=>'candidatures.index',  'label'=>'Candidats',        'match'=>'candidatures.*', 'icon'=>'<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/>'],
                    ['route'=>'offres.index',        'label'=>"Offres d'emploi",  'match'=>'offres.*',       'icon'=>'<rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"/>'],
                    ['route'=>'analyses.index',      'label'=>'Analyses',         'match'=>'analyses.*',     'icon'=>'<path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>'],
                    ['route'=>'conversations.index', 'label'=>'Chat IA',          'match'=>'conversations.*','icon'=>'<path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/>'],
                ];
            @endphp

            @foreach($navItems as $item)
                @php $active = request()->routeIs($item['match']); @endphp
                <a href="{{ route($item['route']) }}"
                   class="flex items-center gap-3 py-2.5 rounded-lg transition-all duration-150 text-[13px]"
                   :class="sidebarCollapsed ? 'justify-center px-0 mx-1' : 'px-4'"
                   style="
                     color:{{ $active ? '#fff' : 'var(--color-sidebar-text)' }};
                     background:{{ $active ? 'var(--color-sidebar-active)' : 'transparent' }};
                     font-weight:{{ $active ? '600' : '400' }};
                     border-left:{{ $active ? '3px solid #818cf8' : '3px solid transparent' }};
                   "
                   onmouseover="if(!{{ $active ? 'true' : 'false' }})this.style.background='var(--color-sidebar-hover)'"
                   onmouseout="if(!{{ $active ? 'true' : 'false' }})this.style.background='transparent'">
                    <svg class="w-[18px] h-[18px] flex-shrink-0" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        {!! $item['icon'] !!}
                    </svg>
                    <span x-show="!sidebarCollapsed" style="font-family:var(--font-sans);">{{ $item['label'] }}</span>
                </a>
            @endforeach

            {{-- Separator --}}
            <div x-show="!sidebarCollapsed"
                 style="border-top:1px solid #1e2d3f;margin:10px 12px 8px;">
            </div>
            <div x-show="!sidebarCollapsed"
                 class="px-4 pb-1"
                 style="font-family:var(--font-sans);font-size:10px;font-weight:700;letter-spacing:.09em;text-transform:uppercase;color:#475569;">
                Système
            </div>

            @php
                $systemItems = [
                    ['route'=>'settings','label'=>'Paramètres','icon'=>'<circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z"/>'],
                    ['route'=>'support', 'label'=>'Aide',       'icon'=>'<circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/>'],
                ];
            @endphp

            @foreach($systemItems as $item)
                @php $active = request()->routeIs($item['route']); @endphp
                <a href="{{ route($item['route']) }}"
                   class="flex items-center gap-3 py-2.5 rounded-lg transition-all duration-150 text-[13px]"
                   :class="sidebarCollapsed ? 'justify-center px-0 mx-1' : 'px-4'"
                   style="
                     color:{{ $active ? '#fff' : 'var(--color-sidebar-text)' }};
                     background:{{ $active ? 'var(--color-sidebar-active)' : 'transparent' }};
                   "
                   onmouseover="if(!{{ $active ? 'true' : 'false' }})this.style.background='var(--color-sidebar-hover)'"
                   onmouseout="if(!{{ $active ? 'true' : 'false' }})this.style.background='transparent'">
                    <svg class="w-[18px] h-[18px] flex-shrink-0" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        {!! $item['icon'] !!}
                    </svg>
                    <span x-show="!sidebarCollapsed" style="font-family:var(--font-sans);">{{ $item['label'] }}</span>
                </a>
            @endforeach
        </nav>

        {{-- User footer --}}
        <div x-show="!sidebarCollapsed" style="border-top:1px solid #1e2d3f;padding:12px 14px;">
            <div class="flex items-center gap-3 mb-2">
                <div style="width:30px;height:30px;border-radius:999px;background:var(--color-primary);
                            display:flex;align-items:center;justify-content:center;
                            font-family:var(--font-sans);font-size:10px;font-weight:700;color:#fff;flex-shrink:0;">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <div style="font-family:var(--font-sans);font-size:12px;font-weight:500;color:#fff;
                                overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                        {{ auth()->user()->name }}
                    </div>
                    <div style="font-family:var(--font-sans);font-size:11px;color:#475569;">Recruteur</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        style="width:100%;background:none;border:none;cursor:pointer;
                               font-family:var(--font-sans);font-size:12px;color:#475569;
                               display:flex;align-items:center;gap:6px;padding:4px 0;
                               transition:color .15s;"
                        onmouseover="this.style.color='#fff'"
                        onmouseout="this.style.color='#475569'">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/>
                        <polyline points="16 17 21 12 16 7"/>
                        <line x1="21" y1="12" x2="9" y2="12"/>
                    </svg>
                    Se déconnecter
                </button>
            </form>
        </div>

        {{-- Collapse toggle --}}
        <button @click="sidebarCollapsed = !sidebarCollapsed"
                style="border-top:1px solid #1e2d3f;padding:8px;width:100%;
                       background:none;cursor:pointer;
                       display:flex;align-items:center;justify-content:center;
                       color:#475569;transition:color .15s;"
                onmouseover="this.style.color='#fff'"
                onmouseout="this.style.color='#475569'">
            <svg class="w-4 h-4" :class="sidebarCollapsed ? 'rotate-180' : ''"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path d="M11 19l-7-7 7-7M18 19l-7-7 7-7"/>
            </svg>
        </button>
    </aside>

    {{-- ── MAIN AREA ──────────────────────────────────────────── --}}
    <div :class="sidebarCollapsed ? 'ml-[62px]' : 'ml-[230px]'"
         class="flex-1 flex flex-col min-h-screen transition-all duration-200">

        {{-- Navbar --}}
        <nav style="background:var(--color-surface);border-bottom:1px solid var(--color-border);
                    height:58px;padding:0 28px;position:sticky;top:0;z-index:30;"
             class="flex items-center gap-4">

            {{-- Mobile toggle --}}
            <button @click="sidebarOpen = true" class="lg:hidden btn-icon flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            {{-- Breadcrumb --}}
            <div class="flex-1"
                 style="font-family:var(--font-sans);font-size:13px;color:var(--color-text-secondary);">
                @isset($breadcrumb){{ $breadcrumb }}@else{{ config('app.name', 'TalentMatch') }}@endisset
            </div>

            {{-- Search --}}
            <form action="{{ route('search') }}" method="GET" class="relative hidden sm:block">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5"
                     style="color:var(--color-text-muted);"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <circle cx="11" cy="11" r="8"/>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Rechercher..."
                       style="border:1px solid var(--color-border);
                              border-radius:999px;
                              background:var(--color-surface-2);
                              padding:7px 14px 7px 32px;
                              font-family:var(--font-sans);font-size:12.5px;
                              color:var(--color-text-primary);width:190px;outline:none;"
                       onfocus="this.style.borderColor='var(--color-primary)';this.style.boxShadow='0 0 0 3px var(--color-primary-ring)'"
                       onblur="this.style.borderColor='var(--color-border)';this.style.boxShadow='none'">
            </form>

            {{-- Dark mode --}}
            <button onclick="
                if(document.documentElement.classList.contains('dark')){
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('theme','light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('theme','dark');
                }" class="btn-icon flex-shrink-0" title="Basculer le mode sombre">
                <svg class="w-4 h-4 dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"
                     style="color:var(--color-text-muted);">
                    <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/>
                </svg>
                <svg class="w-4 h-4 hidden dark:block" fill="none" stroke="#f59e0b" viewBox="0 0 24 24" stroke-width="2">
                    <circle cx="12" cy="12" r="5"/>
                    <path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/>
                </svg>
            </button>

            {{-- Notifications --}}
            <button class="btn-icon flex-shrink-0 relative">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"
                     style="color:var(--color-text-muted);">
                    <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                    <path d="M13.73 21a2 2 0 01-3.46 0"/>
                </svg>
                <span style="width:7px;height:7px;border-radius:999px;background:var(--color-danger);
                             position:absolute;top:7px;right:7px;"></span>
            </button>

            {{-- Avatar --}}
            <div style="width:30px;height:30px;border-radius:999px;background:var(--color-primary);
                        display:flex;align-items:center;justify-content:center;
                        font-family:var(--font-sans);font-size:10px;font-weight:700;color:#fff;flex-shrink:0;">
                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
            </div>
        </nav>

        {{-- Page content --}}
        <main style="padding:28px 32px;flex:1;">
            @isset($header)
                <div class="page-header">
                    <div>
                        <h1 class="page-title">{{ $header }}</h1>
                        @isset($subtitle)
                            <p class="page-subtitle">{{ $subtitle }}</p>
                        @endisset
                    </div>
                    @isset($headerActions)
                        <div>{{ $headerActions }}</div>
                    @endisset
                </div>
            @endisset

            @isset($slot){{ $slot }}@endisset
            @yield('content')
        </main>
    </div>
</div>

@stack('scripts')
</body>
</html>