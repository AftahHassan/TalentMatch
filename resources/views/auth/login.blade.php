<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'TalentMatch') }} — Connexion</title>

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
                Recrutez plus<br>
                <span style="color: #14b8a6;">intelligemment.</span>
            </h1>
            <p class="text-blue-200/80 text-lg mb-10 leading-relaxed">
                Analysez vos candidats par IA, comparez les profils,<br>
                et prenez les meilleures décisions.
            </p>

            <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl p-5 mb-8">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background: rgba(20, 184, 166, 0.2);">
                            <svg class="w-5 h-5" style="color:#14b8a6;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        </div>
                        <div>
                            <p class="text-white text-sm font-medium">Analyse du candidat</p>
                            <p class="text-blue-200/60 text-xs">via IA TalentMatch</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold" style="background: rgba(20, 184, 166, 0.15); color:#14b8a6;">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        95% MATCH
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="flex items-center gap-2 text-blue-200/70 text-xs">
                        <span class="w-2 h-2 rounded-full" style="background-color:#14b8a6;"></span>
                        Compétences techniques parfaitement alignées
                    </div>
                    <div class="flex items-center gap-2 text-blue-200/70 text-xs">
                        <span class="w-2 h-2 rounded-full" style="background-color:#2563eb;"></span>
                        Expérience pertinente dans le domaine
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-8">
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
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-5 shadow-sm" style="background-color:#eff6ff;">
                    <svg class="w-7 h-7" style="color:#2563eb;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
                <h2 class="text-2xl font-bold tracking-tight" style="color:#0f172a;">Welcome back</h2>
                <p class="mt-2" style="color:#64748b;">Connectez-vous à votre compte</p>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 p-8 shadow-elevated">
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-medium mb-1.5" style="color:#0f172a;">{{ __('Email') }}</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="w-4.5 h-4.5" style="color:#94a3b8;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
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
                            <input id="password" type="password" name="password" required autocomplete="current-password"
                                class="input-field pl-10"
                                placeholder="••••••••">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-between mt-5">
                        <label for="remember_me" class="flex items-center gap-2 cursor-pointer">
                            <input id="remember_me" type="checkbox" name="remember"
                                class="rounded border-gray-300 text-brand-600 shadow-sm focus:ring-brand-500">
                            <span class="text-sm" style="color:#475569;">{{ __('Se souvenir de moi') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm font-medium hover:underline" style="color:#2563eb;">
                                {{ __('Mot de passe oublié ?') }}
                            </a>
                        @endif
                    </div>

                    <button type="submit"
                        class="mt-6 w-full btn-primary justify-center">
                        {{ __('Sign In') }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>

                    <p class="mt-6 text-center text-sm" style="color:#64748b;">
                        {{ __('Pas encore de compte ?') }}
                        <a href="{{ route('register') }}" class="font-semibold hover:underline" style="color:#2563eb;">
                            {{ __('Créer un compte') }}
                        </a>
                    </p>
                </form>
            </div>

            <div class="mt-8 flex items-center justify-center gap-6 text-xs" style="color:#94a3b8;">
                <a href="#" class="hover:underline" style="color:#64748b;">CGU</a>
                <a href="#" class="hover:underline" style="color:#64748b;">Confidentialité</a>
                <a href="#" class="hover:underline" style="color:#64748b;">Cookies</a>
            </div>
        </div>
    </div>
</body>
</html>
