<x-app-layout>
    @section('title', 'Paramètres')

    <x-slot name="header">Paramètres</x-slot>
    <x-slot name="subtitle">Gérez votre compte et vos préférences</x-slot>

    <div style="max-width:720px;display:flex;flex-direction:column;gap:20px;">
        <div class="card" style="padding:28px;">
            <h2 style="font-family:var(--font-serif);font-size:16px;font-weight:600;color:var(--color-text-primary);margin-bottom:20px;">Profil</h2>
            <form action="{{ route('profile.update') }}" method="POST" style="display:flex;flex-direction:column;gap:16px;">
                @method('patch')
                @csrf
                <div>
                    <label for="name" class="input-label">Nom</label>
                    <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" class="input-field" required>
                </div>
                <div>
                    <label for="email" class="input-label">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="input-field" readonly disabled style="opacity:0.6;">
                </div>
                <div style="display:flex;justify-content:flex-end;padding-top:4px;">
                    <button type="submit" class="btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>

        <div class="card" style="padding:28px;">
            <h2 style="font-family:var(--font-serif);font-size:16px;font-weight:600;color:var(--color-text-primary);margin-bottom:20px;">Changer le mot de passe</h2>
            <form action="{{ route('password.update') }}" method="POST" style="display:flex;flex-direction:column;gap:16px;">
                @method('put')
                @csrf
                <div>
                    <label for="current_password" class="input-label">Mot de passe actuel</label>
                    <input type="password" id="current_password" name="current_password" class="input-field" required>
                </div>
                <div>
                    <label for="password" class="input-label">Nouveau mot de passe</label>
                    <input type="password" id="password" name="password" class="input-field" required>
                </div>
                <div>
                    <label for="password_confirmation" class="input-label">Confirmer le mot de passe</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="input-field" required>
                </div>
                <div style="display:flex;justify-content:flex-end;padding-top:4px;">
                    <button type="submit" class="btn-primary">Mettre à jour</button>
                </div>
            </form>
        </div>

        <div class="card" style="padding:28px;background:var(--color-danger-bg);border-color:var(--color-danger);">
            <h2 style="font-family:var(--font-serif);font-size:16px;font-weight:600;color:var(--color-danger-text);margin-bottom:4px;">Zone dangereuse</h2>
            <p style="font-family:var(--font-sans);font-size:13px;color:var(--color-danger-text);margin-bottom:20px;">Supprimer votre compte. Cette action est irréversible.</p>
            <form action="{{ route('profile.destroy') }}" method="POST">
                @csrf
                @method('delete')
                <div style="display:flex;justify-content:flex-end;">
                    <button type="submit" class="btn-danger">Supprimer le compte</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
