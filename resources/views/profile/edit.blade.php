<x-app-layout>
    <div style="max-width:640px;">
        <div style="margin-bottom:24px;">
            <h1 style="font-size:20px;font-weight:600;color:var(--color-text-primary);margin:0 0 4px;">Profil</h1>
            <p style="font-size:13px;color:var(--color-text-secondary);margin:0;">Gérez vos informations personnelles et votre mot de passe</p>
        </div>

        <div style="display:flex;flex-direction:column;gap:20px;">
            <div class="card" style="padding:28px;">
                @include('profile.partials.update-profile-information-form')
            </div>

            <div class="card" style="padding:28px;">
                @include('profile.partials.update-password-form')
            </div>

            <div class="card" style="padding:28px;">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
