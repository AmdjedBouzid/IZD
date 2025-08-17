@extends('layouts.admin')

@section('title', 'Réinitialiser le mot de passe')

@section('content')
<div class="p-8 space-y-12 bg-white rounded-xl shadow-md w-full">
    <h2 class="text-3xl font-bold text-primary">
        Réinitialiser votre mot de passe
    </h2>

    {{-- Status message --}}
    @if (session('status') === 'password-updated')
        <div class="mb-4 text-green-600 font-semibold">
            Votre mot de passe a été mis à jour avec succès.
        </div>
    @elseif (session('status'))
        <div class="mb-4 text-green-600 font-semibold">
            {{ session('status') }}
        </div>
    @endif

    {{-- Update password form --}}
    <form action="{{ route('password.update') }}" method="POST" class="space-y-6 w-full">
        @csrf
        @method('PUT')

        {{-- Current password --}}
        <div>
            <label for="current_password" class="block text-sm font-semibold text-gray-700 mb-1">
                Mot de passe actuel
            </label>
            <input
                id="current_password"
                name="current_password"
                type="password"
                placeholder="Entrez le mot de passe actuel..."
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)]"
                required
            />
            @error('current_password', 'updatePassword')
               <x-toast-error message="{{ $message }}" />
            @enderror
        </div>

        {{-- New password --}}
        <div>
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">
                Nouveau mot de passe
            </label>
            <input
                id="password"
                name="password"
                type="password"
                placeholder="Entrez un nouveau mot de passe..."
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)]"
                required
            />
            @error('password', 'updatePassword')
                <x-toast-error message="{{ $message }}" />
            @enderror
        </div>

        {{-- Confirm new password --}}
        <div>
            @if(session()->has('success'))
    <x-toast-success message="{{ session('success') }}" />
@endif
            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1">
                Confirmer le mot de passe
            </label>
            <input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                placeholder="Confirmez votre nouveau mot de passe..."
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)]"
                required
            />
        </div>

        {{-- Submit button --}}
        <div class="text-right">
            <button
                type="submit"
                class="bg-[var(--color-primary)] text-white px-5 py-2 rounded-md font-semibold hover:bg-opacity-90 transition w-full sm:w-auto">
                Réinitialiser le mot de passe
            </button>
        </div>
    </form>

    {{-- Logout button --}}
    <form action="{{ route('logout') }}" method="POST" class="mt-6">
        @csrf
        <button
            type="submit"
            class="bg-red-500 text-white px-5 py-2 rounded-md font-semibold hover:bg-opacity-90 transition w-full sm:w-auto">
            Se déconnecter
        </button>
    </form>
</div>
@endsection
