<section>
    <header>
        <h2 style="font-size:16px;font-weight:600;color:var(--color-text-primary);margin:0 0 4px;">Supprimer le compte</h2>
        <p style="font-size:13px;color:var(--color-text-secondary);margin:0;">Une fois votre compte supprimé, toutes ses données seront définitivement effacées. Avant de supprimer votre compte, veuillez télécharger les informations que vous souhaitez conserver.</p>
    </header>

    <div style="margin-top:16px;">
        <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" class="btn-danger">Supprimer le compte</button>
    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" style="padding:24px;">
            @csrf
            @method('delete')

            <h2 style="font-size:16px;font-weight:600;color:var(--color-text-primary);margin:0 0 8px;">Êtes-vous sûr de vouloir supprimer votre compte ?</h2>
            <p style="font-size:13px;color:var(--color-text-secondary);margin:0 0 20px;">Une fois votre compte supprimé, toutes ses ressources et données seront définitivement effacées. Veuillez entrer votre mot de passe pour confirmer la suppression définitive de votre compte.</p>

            <div style="margin-bottom:16px;">
                <label for="password" style="font-size:13px;font-weight:600;color:var(--color-text-primary);display:block;margin-bottom:5px;">Mot de passe</label>
                <input id="password" name="password" type="password" class="input-field" style="width:75%;" placeholder="Mot de passe">
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div style="display:flex;justify-content:flex-end;gap:8px;">
                <button type="button" x-on:click="$dispatch('close')" class="btn-ghost">Annuler</button>
                <button type="submit" class="btn-danger">Supprimer le compte</button>
            </div>
        </form>
    </x-modal>
</section>
