<section>
    <header>
        <h2 style="font-size:16px;font-weight:600;color:var(--color-text-primary);margin:0 0 4px;">Mettre à jour le mot de passe</h2>
        <p style="font-size:13px;color:var(--color-text-secondary);margin:0;">Utilisez un mot de passe long et aléatoire pour rester sécurisé.</p>
    </header>

    <form method="post" action="{{ route('password.update') }}" style="margin-top:20px;display:flex;flex-direction:column;gap:16px;">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" style="font-size:13px;font-weight:600;color:var(--color-text-primary);display:block;margin-bottom:5px;">Mot de passe actuel</label>
            <input id="update_password_current_password" name="current_password" type="password" class="input-field" style="width:100%;" autocomplete="current-password">
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password" style="font-size:13px;font-weight:600;color:var(--color-text-primary);display:block;margin-bottom:5px;">Nouveau mot de passe</label>
            <input id="update_password_password" name="password" type="password" class="input-field" style="width:100%;" autocomplete="new-password">
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password_confirmation" style="font-size:13px;font-weight:600;color:var(--color-text-primary);display:block;margin-bottom:5px;">Confirmer le mot de passe</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="input-field" style="width:100%;" autocomplete="new-password">
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div style="display:flex;align-items:center;gap:12px;padding-top:8px;">
            <button type="submit" class="btn-primary">Enregistrer</button>
            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" style="font-size:13px;color:var(--color-success-text);margin:0;">Enregistré.</p>
            @endif
        </div>
    </form>
</section>
