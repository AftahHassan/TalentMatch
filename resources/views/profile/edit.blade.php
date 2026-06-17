<x-app-layout>
    <x-slot name="header">{{ __('Profile') }}</x-slot>

    <div class="max-w-3xl mx-auto space-y-6">
        <div class="bg-white rounded-xl border border-gray-200 p-8">
            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-8">
            @include('profile.partials.update-password-form')
        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-8">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</x-app-layout>
