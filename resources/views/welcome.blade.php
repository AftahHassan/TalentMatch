<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'TalentMatch') }}</title>

        @fonts
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body style="background:var(--color-bg-page);min-height:100vh;display:flex;align-items:center;justify-content:center;padding:24px;font-family:var(--font-sans);">

        <div style="text-align:center;max-width:480px;">
            <div style="width:56px;height:56px;border-radius:14px;background:var(--color-accent);display:flex;align-items:center;justify-content:center;margin:0 auto 20px;">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="white">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                </svg>
            </div>

            <h1 style="font-size:28px;font-weight:700;color:var(--color-text-primary);margin:0 0 8px;">Bienvenue sur TalentMatch</h1>
            <p style="font-size:15px;color:var(--color-text-secondary);margin:0 0 32px;line-height:1.6;">
                La plateforme de recrutement assistée par IA.<br>
                Analysez les CV, matchz les profils et recrutez plus intelligemment.
            </p>

            <div style="display:flex;gap:12px;justify-content:center;">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-primary" style="padding:12px 28px;">Tableau de bord</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-secondary" style="padding:12px 28px;">Connexion</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-primary" style="padding:12px 28px;">Créer un compte</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>

    </body>
</html>
