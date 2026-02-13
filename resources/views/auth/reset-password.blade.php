{{--<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.update') }}">
@csrf

<input type="hidden" name="token" value="{{ $request->route('token') }}">

<div class="block">
    <x-label for="email" value="{{ __('Email') }}" />
    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
</div>

<div class="mt-4">
    <x-label for="password" value="{{ __('Password') }}" />
    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
</div>

<div class="mt-4">
    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
    <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
</div>

<div class="flex items-center justify-end mt-4">
    <x-button>
        {{ __('Reset Password') }}
    </x-button>
</div>
</form>
</x-authentication-card>
</x-guest-layout>
--}}



@extends('layouts.auth')

@section('title', 'Reset Password')

@section('content')

<h1 class="fs-2 mb-2">Reset Password</h1>
<p class="lead mb-4">Enter your new password below.</p>

{{-- Validation Errors --}}
<x-validation-errors class="mb-3" />

<form method="POST" action="{{ route('password.update') }}">
    @csrf

    <input type="hidden" name="token" value="{{ $request->route('token') }}">

    <!-- Email -->
    <div class="mb-4">
        <label class="form-label">Email address *</label>
        <div class="input-group input-group-lg">
            <span class="input-group-text bg-light border-0">
                <i class="bi bi-envelope-fill"></i>
            </span>
            <input id="email" type="email"
                name="email"
                class="form-control border-0 bg-light"
                placeholder="Email"
                value="{{ old('email', $request->email) }}"
                required autofocus autocomplete="username">
        </div>
    </div>

    <!-- New Password -->
    <div class="mb-4">
        <label class="form-label">New Password *</label>
        <div class="input-group input-group-lg">
            <span class="input-group-text bg-light border-0">
                <i class="fas fa-lock"></i>
            </span>
            <input id="password" type="password"
                name="password"
                class="form-control border-0 bg-light"
                placeholder="New Password"
                required autocomplete="new-password">
        </div>
    </div>

    <!-- Confirm Password -->
    <div class="mb-4">
        <label class="form-label">Confirm Password *</label>
        <div class="input-group input-group-lg">
            <span class="input-group-text bg-light border-0">
                <i class="fas fa-lock"></i>
            </span>
            <input id="password_confirmation" type="password"
                name="password_confirmation"
                class="form-control border-0 bg-light"
                placeholder="Confirm Password"
                required autocomplete="new-password">
        </div>
    </div>

    <!-- Submit -->
    <div class="d-grid mt-4">
        <button class="btn btn-primary" type="submit">
            Reset Password
        </button>
    </div>
</form>

@endsection
