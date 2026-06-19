<x-app-layout>
    @section('title', 'Paramètres')

    <x-slot name="header">Paramètres</x-slot>
    <x-slot name="subtitle">Gérez votre compte et vos préférences</x-slot>

    {{-- Centered, no-scroll layout --}}
    <div style="display:flex;justify-content:center;">
        <div style="width:100%;max-width:640px;display:flex;flex-direction:column;gap:16px;">

            {{-- Profile --}}
            <div class="card" style="padding:28px 32px;">
                <div style="display:flex;align-items:center;gap:12px;margin-bottom:22px;">
                    <div style="width:38px;height:38px;border-radius:var(--radius-md);
                                background:var(--color-primary-light);display:flex;align-items:center;justify-content:center;">
                        <svg class="w-5 h-5" style="color:var(--color-primary);" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                    </div>
                    <div>
                        <h2 style="font-family:var(--font-serif);font-size:15px;font-weight:600;color:var(--color-text-primary);margin:0 0 2px;">
                            Profil
                        </h2>
                        <p style="font-family:var(--font-sans);font-size:12px;color:var(--color-text-muted);margin:0;">
                            Vos informations personnelles
                        </p>
                    </div>
                </div>
                <form action="{{ route('profile.update') }}" method="POST"
                      style="display:flex;flex-direction:column;gap:14px;">
                    @method('patch')
                    @csrf
                    <div>
                        <label for="name" class="input-label">Nom</label>
                        <input type="text" id="name" name="name"
                               value="{{ old('name', auth()->user()->name) }}"
                               class="input-field" required>
                        @error('name')<p class="input-error">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="email" class="input-label">Email</label>
                        <input type="email" id="email" name="email"
                               value="{{ old('email', auth()->user()->email) }}"
                               class="input-field" readonly disabled
                               style="opacity:.55;cursor:not-allowed;">
                    </div>
                    <div style="display:flex;justify-content:flex-end;padding-top:6px;">
                        <button type="submit" class="btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>

            {{-- Password --}}
            <div class="card" style="padding:28px 32px;">
                <div style="display:flex;align-items:center;gap:12px;margin-bottom:22px;">
                    <div style="width:38px;height:38px;border-radius:var(--radius-md);
                                background:#ede9fe;display:flex;align-items:center;justify-content:center;">
                        <svg class="w-5 h-5" style="color:#7c3aed;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/>
                        </svg>
                    </div>
                    <div>
                        <h2 style="font-family:var(--font-serif);font-size:15px;font-weight:600;color:var(--color-text-primary);margin:0 0 2px;">
                            Changer le mot de passe
                        </h2>
                        <p style="font-family:var(--font-sans);font-size:12px;color:var(--color-text-muted);margin:0;">
                            Utilisez un mot de passe fort
                        </p>
                    </div>
                </div>
                <form action="{{ route('password.update') }}" method="POST"
                      style="display:flex;flex-direction:column;gap:14px;">
                    @method('put')
                    @csrf
                    <div>
                        <label for="current_password" class="input-label">Mot de passe actuel</label>
                        <input type="password" id="current_password" name="current_password" class="input-field" required>
                        @error('current_password')<p class="input-error">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="password" class="input-label">Nouveau mot de passe</label>
                        <input type="password" id="password" name="password" class="input-field" required>
                        @error('password')<p class="input-error">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="password_confirmation" class="input-label">Confirmer le mot de passe</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="input-field" required>
                    </div>
                    <div style="display:flex;justify-content:flex-end;padding-top:6px;">
                        <button type="submit" class="btn-primary">Mettre à jour</button>
                    </div>
                </form>
            </div>

            {{-- Danger zone --}}
            <div class="card notice notice-danger" style="padding:24px 32px;">
                <div style="flex:1;">
                    <h2 style="font-family:var(--font-serif);font-size:15px;font-weight:600;
                               color:var(--color-danger-text);margin:0 0 4px;">
                        Zone dangereuse
                    </h2>
                    <p style="font-family:var(--font-sans);font-size:13px;
                              color:var(--color-danger-text);margin:0 0 16px;">
                        Supprimer votre compte. Cette action est irréversible.
                    </p>
                    <form action="{{ route('profile.destroy') }}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn-danger"
                                onclick="return confirm('Êtes-vous sûr ? Cette action est irréversible.')">
                            Supprimer le compte
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>

</x-app-layout>