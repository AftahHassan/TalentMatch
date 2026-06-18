<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'TalentMatch') }} — Inscription</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900 min-h-screen flex">
    <div class="hidden lg:flex lg:w-1/2 relative flex-col justify-center px-16 py-12 overflow-hidden" style="background: linear-gradient(135deg, #0f172a 0%, #0f1a3a 60%, #0d1630 100%);">
        <div class="absolute inset-0 overflow-hidden">
            <svg class="absolute w-full h-full opacity-[0.15]" viewBox="0 0 800 800" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="dots" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                        <circle cx="2" cy="2" r="1.5" fill="#60a5fa"/>
                    </pattern>
                </defs>
                <rect width="800" height="800" fill="url(#dots)"/>
                <g class="animate-pulse" style="animation-duration: 4s;">
                    <circle cx="200" cy="150" r="3" fill="#60a5fa" opacity="0.6"/>
                    <circle cx="600" cy="300" r="4" fill="#60a5fa" opacity="0.4"/>
                    <circle cx="350" cy="500" r="2" fill="#60a5fa" opacity="0.5"/>
                    <circle cx="650" cy="550" r="3" fill="#60a5fa" opacity="0.3"/>
                    <circle cx="150" cy="400" r="2" fill="#60a5fa" opacity="0.5"/>
                    <circle cx="500" cy="650" r="3" fill="#60a5fa" opacity="0.4"/>
                </g>
            </svg>
        </div>

        <div class="relative z-10 max-w-md mx-auto w-full">
            <div class="flex items-center gap-3 mb-12">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center shadow-lg" style="background-color:#2563eb;">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
                    </svg>
                </div>
                <span class="text-2xl font-bold text-white tracking-tight">TalentMatch</span>
            </div>

            <h1 class="text-4xl font-extrabold text-white leading-[1.15] tracking-tight mb-4">
                Rejoignez<br>
                <span style="color: #14b8a6;">TalentMatch.</span>
            </h1>
            <p class="text-blue-200/80 text-lg mb-10 leading-relaxed">
                Créez votre compte et commencez à recruter<br>
                avec l'intelligence artificielle.
            </p>

            <div class="space-y-5">
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0 w-9 h-9 rounded-lg flex items-center justify-center" style="background: rgba(37, 99, 235, 0.15);">
                        <svg class="w-4.5 h-4.5" style="color:#2563eb;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <div>
                        <p class="text-white font-medium text-sm">Gratuit et rapide</p>
                        <p class="text-blue-200/60 text-sm">Créez votre compte en quelques secondes</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0 w-9 h-9 rounded-lg flex items-center justify-center" style="background: rgba(20, 184, 166, 0.15);">
                        <svg class="w-4.5 h-4.5" style="color:#14b8a6;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                    </div>
                    <div>
                        <p class="text-white font-medium text-sm">IA intégrée</p>
                        <p class="text-blue-200/60 text-sm">Analyse automatique des CV et matching intelligent</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0 w-9 h-9 rounded-lg flex items-center justify-center" style="background: rgba(37, 99, 235, 0.15);">
                        <svg class="w-4.5 h-4.5" style="color:#2563eb;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                    </div>
                    <div>
                        <p class="text-white font-medium text-sm">Assistant dédié</p>
                        <p class="text-blue-200/60 text-sm">Discutez avec l'IA pour affiner vos analyses</p>
                    </div>
                </div>
            </div>

            <div class="mt-10 flex items-center gap-8 pt-8 border-t border-white/10">
                <div>
                    <p class="text-2xl font-bold text-white">10k+</p>
                    <p class="text-blue-200/60 text-sm">Candidatures<br>analysées</p>
                </div>
                <div class="w-px h-10" style="background: rgba(255,255,255,0.1);"></div>
                <div>
                    <p class="text-2xl font-bold text-white">98%</p>
                    <p class="text-blue-200/60 text-sm">Satisfaction<br>clients</p>
                </div>
                <div class="w-px h-10" style="background: rgba(255,255,255,0.1);"></div>
                <div>
                    <p class="text-2xl font-bold text-white">3x</p>
                    <p class="text-blue-200/60 text-sm">Plus de<br>candidats retenus</p>
                </div>
            </div>
        </div>
    </div>

    <div class="flex-1 flex items-center justify-center px-6 py-12" style="background-color:#f8fafc;">
        <div class="w-full max-w-[440px]">
            <div class="lg:hidden flex items-center justify-center gap-2.5 mb-10">
                <div class="w-9 h-9 rounded-lg flex items-center justify-center" style="background-color:#2563eb;">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
                    </svg>
                </div>
                <span class="text-xl font-bold" style="color:#0f172a;">TalentMatch</span>
            </div>

            <div class="text-center mb-8">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-5 shadow-sm" style="background-color:#f0fdfa;">
                    <svg class="w-7 h-7" style="color:#14b8a6;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                </div>
                <h2 class="text-2xl font-bold tracking-tight" style="color:#0f172a;">Create your account</h2>
                <p class="mt-2" style="color:#64748b;">Start hiring smarter today.</p>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 p-8 shadow-elevated">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-medium mb-1.5" style="color:#0f172a;">{{ __('Nom') }}</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="w-4.5 h-4.5" style="color:#94a3b8;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </div>
                            <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                                class="input-field pl-10"
                                placeholder="Votre nom">
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-5">
                        <label for="email" class="block text-sm font-medium mb-1.5" style="color:#0f172a;">{{ __('Email') }}</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="w-4.5 h-4.5" style="color:#94a3b8;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username"
                                class="input-field pl-10"
                                placeholder="vous@exemple.fr">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mt-5">
                        <label for="password" class="block text-sm font-medium mb-1.5" style="color:#0f172a;">{{ __('Mot de passe') }}</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="w-4.5 h-4.5" style="color:#94a3b8;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m0 0v2m0-2h2m-2 0H10m9.364-7.364A9 9 0 1112 3a9 9 0 017.364 4.636z"/></svg>
                            </div>
                            <input id="password" type="password" name="password" required autocomplete="new-password"
                                class="input-field pl-10"
                                placeholder="Minimum 8 caractères">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="mt-5">
                        <label for="password_confirmation" class="block text-sm font-medium mb-1.5" style="color:#0f172a;">{{ __('Confirmer le mot de passe') }}</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="w-4.5 h-4.5" style="color:#94a3b8;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m0 0v2m0-2h2m-2 0H10m9.364-7.364A9 9 0 1112 3a9 9 0 017.364 4.636z"/></svg>
                            </div>
                            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                                class="input-field pl-10"
                                placeholder="Confirmez votre mot de passe">
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <button type="submit"
                        class="mt-6 w-full btn-primary justify-center">
                        {{ __('Create Account') }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>

                    <p class="mt-6 text-center text-sm" style="color:#64748b;">
                        {{ __('Already have an account?') }}
                        <a href="{{ route('login') }}" class="font-semibold hover:underline" style="color:#2563eb;">
                            {{ __('Sign in') }}
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
