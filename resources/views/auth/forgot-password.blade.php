{{--<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
</div>

@session('status')
<div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
    {{ $value }}
</div>
@endsession

<x-validation-errors class="mb-4" />

<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <div class="block">
        <x-label for="email" value="{{ __('Email') }}" />
        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
    </div>

    <div class="flex items-center justify-end mt-4">
        <x-button>
            {{ __('Email Password Reset Link') }}
        </x-button>
    </div>
</form>
</x-authentication-card>
</x-guest-layout>
--}}
@extends('layouts.auth')

@section('title', 'Forgot Password')

@section('content')

<h1 class="fs-2">Forgot Password</h1>
<p class="lead mb-4">Enter your email to receive a password reset link.</p>

{{-- Status Message --}}
@session('status')
<div class="mb-4 font-medium text-sm text-success">
    {{ $value }}
</div>
@endsession

{{-- Validation Errors --}}
<x-validation-errors class="mb-3" />

<form method="POST" action="{{ route('password.email') }}">
    @csrf

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
                value="{{ old('email') }}"
                required autofocus autocomplete="username">
        </div>
    </div>

    <div class="d-grid">
        <button class="btn btn-primary" type="submit">
            Email Password Reset Link
        </button>
    </div>
</form>

@endsection
