@props(['subtitle' => ''])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'TalentMatch') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .auth-input:focus {
            border-color: var(--color-primary) !important;
            box-shadow: 0 0 0 3.5px var(--color-primary-ring) !important;
            outline: none;
        }
    </style>
</head>
<body style="background:var(--color-bg);min-height:100vh;display:flex;align-items:center;justify-content:center;padding:24px 16px;">

    <div style="width:100%;max-width:420px;">
        <div style="background:var(--color-surface);
                    border-radius:var(--radius-2xl);
                    border:1px solid var(--color-border);
                    box-shadow:var(--shadow-lg);
                    padding:40px 36px 32px;">

            <div style="display:flex;align-items:center;gap:10px;margin-bottom:4px;">
                <div style="width:34px;height:34px;border-radius:10px;background:var(--color-primary);
                            display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="white">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                    </svg>
                </div>
                <span style="font-family:var(--font-serif);font-size:20px;font-weight:600;color:var(--color-text-primary);">
                    TalentMatch
                </span>
            </div>

            <p style="font-family:var(--font-serif);font-style:italic;font-size:13px;
                      color:var(--color-text-muted);margin-bottom:22px;margin-top:2px;">
                {{ $subtitle }}
            </p>

            <div class="auth-tabs">
                <a href="{{ route('login') }}"
                   class="auth-tab {{ request()->routeIs('login') ? 'active' : '' }}">
                    Connexion
                </a>
                <a href="{{ route('register') }}"
                   class="auth-tab {{ request()->routeIs('register') ? 'active' : '' }}">
                    Inscription
                </a>
            </div>

            {{ $slot }}
        </div>
    </div>
</body>
</html>
