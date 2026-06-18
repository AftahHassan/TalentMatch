@props(['subtitle' => ''])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'TalentMatch') }}</title>

    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            font-family: 'Anthropic Serif', Georgia, serif !important;
        }

        .auth-input:focus {
            border-color: #2563EB !important;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.10) !important;
            outline: none;
        }
    </style>
</head>
<body style="background-color:#EEF0F6;" class="antialiased">
    <div class="min-h-screen flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-[420px]">
            <div style="background:#fff;border-radius:20px;border:0.5px solid #e2e6ef;padding:44px 40px 36px;">

                <div class="flex items-center gap-3 mb-1">
                    <div style="width:36px;height:36px;border-radius:10px;background:#2563EB;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="white">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                    </div>
                    <span style="font-size:21px;font-weight:600;color:#0f172a;">TalentMatch</span>
                </div>

                <p style="font-size:13.5px;color:#64748b;font-style:italic;margin-bottom:24px;">{{ $subtitle }}</p>

                <div style="background:#f1f5f9;border-radius:10px;padding:3px;display:flex;margin-bottom:28px;">
                    <a href="{{ route('login') }}"
                       style="flex:1;text-align:center;padding:7px 12px;border-radius:8px;font-size:13px;cursor:pointer;text-decoration:none;{{ request()->routeIs('login') ? 'background:#fff;border:0.5px solid #e2e6ef;color:#0f172a;font-weight:500;' : 'color:#64748b;' }}"
                       {{ request()->routeIs('login') ? '' : 'onmouseover=this.style.background="#f8fafc";this.style.color="#0f172a"' }}
                       {{ request()->routeIs('login') ? '' : 'onmouseout=this.style.background="transparent";this.style.color="#64748b"' }}>Log in</a>
                    <a href="{{ route('register') }}"
                       style="flex:1;text-align:center;padding:7px 12px;border-radius:8px;font-size:13px;cursor:pointer;text-decoration:none;{{ request()->routeIs('register') ? 'background:#fff;border:0.5px solid #e2e6ef;color:#0f172a;font-weight:500;' : 'color:#64748b;' }}"
                       {{ request()->routeIs('register') ? '' : 'onmouseover=this.style.background="#f8fafc";this.style.color="#0f172a"' }}
                       {{ request()->routeIs('register') ? '' : 'onmouseout=this.style.background="transparent";this.style.color="#64748b"' }}>Sign up</a>
                </div>

                {{ $slot }}

            </div>
        </div>
    </div>
</body>
</html>
