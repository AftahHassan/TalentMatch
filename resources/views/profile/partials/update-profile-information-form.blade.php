<section>
    <header>
        <h2 style="font-size:16px;font-weight:600;color:var(--color-text-primary);margin:0 0 4px;">Informations du profil</h2>
        <p style="font-size:13px;color:var(--color-text-secondary);margin:0;">Mettez à jour vos informations personnelles et votre adresse email.</p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" style="margin-top:20px;display:flex;flex-direction:column;gap:16px;">
        @csrf
        @method('patch')

        <div>
            <label for="name" style="font-size:13px;font-weight:600;color:var(--color-text-primary);display:block;margin-bottom:5px;">Nom</label>
            <input id="name" name="name" type="text" class="input-field" style="width:100%;" :value="old('name', $user->name)" required autofocus autocomplete="name">
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <label for="email" style="font-size:13px;font-weight:600;color:var(--color-text-primary);display:block;margin-bottom:5px;">Email</label>
            <input id="email" name="email" type="email" class="input-field" style="width:100%;" :value="old('email', $user->email)" required autocomplete="username">
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div style="margin-top:8px;">
                    <p style="font-size:12px;color:var(--color-text-secondary);">
                        Votre adresse email n'est pas vérifiée.
                        <button form="send-verification" style="background:none;border:none;padding:0;font-size:12px;color:var(--color-accent);text-decoration:underline;cursor:pointer;">Cliquez ici pour renvoyer l'email de vérification.</button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p style="margin-top:6px;font-size:12px;color:var(--color-success-text);">Un nouveau lien de vérification a été envoyé à votre adresse email.</p>
                    @endif
                </div>
            @endif
        </div>

        <div style="display:flex;align-items:center;gap:12px;padding-top:8px;">
            <button type="submit" class="btn-primary">Enregistrer</button>
            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" style="font-size:13px;color:var(--color-success-text);margin:0;">Enregistré.</p>
            @endif
        </div>
    </form>
</section>
