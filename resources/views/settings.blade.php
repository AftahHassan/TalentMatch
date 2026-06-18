@extends('layouts.app')

@php $title = 'Settings' @endphp

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Settings</h1>
        <p class="mt-1.5 text-sm text-gray-500">Manage your account settings and preferences.</p>
    </div>

    <div class="card p-8">
        <h2 class="text-lg font-semibold text-gray-900 mb-6">Profile</h2>
        <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
            @method('patch')
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" class="input-field" required>
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="input-field" readonly disabled>
            </div>
            <div class="flex justify-end pt-2">
                <button type="submit" class="btn-primary">Save Changes</button>
            </div>
        </form>
    </div>

    <div class="card p-8">
        <h2 class="text-lg font-semibold text-gray-900 mb-6">Change Password</h2>
        <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
            @method('put')
            @csrf
            <div>
                <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                <input type="password" id="current_password" name="current_password" class="input-field" required>
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                <input type="password" id="password" name="password" class="input-field" required>
            </div>
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="input-field" required>
            </div>
            <div class="flex justify-end pt-2">
                <button type="submit" class="btn-primary">Update Password</button>
            </div>
        </form>
    </div>

    <div class="border border-red-200 rounded-xl p-8" style="background-color:#fef2f2;">
        <h2 class="text-lg font-semibold text-red-800 mb-2">Danger Zone</h2>
        <p class="text-sm text-red-600 mb-6">Delete your account. This action cannot be undone.</p>
        <form action="{{ route('profile.destroy') }}" method="POST">
            @method('delete')
            @csrf
            <div class="flex justify-end">
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">Delete Account</button>
            </div>
        </form>
    </div>
</div>
@endsection
