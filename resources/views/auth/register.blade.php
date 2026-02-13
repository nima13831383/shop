{{-- <x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
@csrf

<div>
    <x-label for="name" value="{{ __('Name') }}" />
    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
</div>

<div class="mt-4">
    <x-label for="email" value="{{ __('Email') }}" />
    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
</div>

<div class="mt-4">
    <x-label for="password" value="{{ __('Password') }}" />
    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
</div>

<div class="mt-4">
    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
    <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
</div>

@if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
<div class="mt-4">
    <x-label for="terms">
        <div class="flex items-center">
            <x-checkbox name="terms" id="terms" required />

            <div class="ms-2">
                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">'.__('Terms of Service').'</a>',
                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">'.__('Privacy Policy').'</a>',
                ]) !!}
            </div>
        </div>
    </x-label>
</div>
@endif

<div class="flex items-center justify-end mt-4">
    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
        {{ __('Already registered?') }}
    </a>

    <x-button class="ms-4">
        {{ __('Register') }}
    </x-button>
</div>
</form>
</x-authentication-card>
</x-guest-layout>
--}}
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="/assets/images/favicon.ico">

    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;700&family=Roboto:wght@400;500;700&display=swap">

    <link rel="stylesheet" type="text/css" href="/assets/vendor/font-awesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/vendor/bootstrap-icons/bootstrap-icons.css">

    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
</head>

<body>

    <main>
        <section class="p-0 d-flex align-items-center position-relative overflow-hidden">
            <div class="container-fluid">
                <div class="row">

                    {{-- Left --}}
                    <div class="col-12 col-lg-6 d-md-flex align-items-center justify-content-center bg-primary bg-opacity-10 vh-lg-100">
                        <div class="p-3 p-lg-5 text-center">
                            <h2 class="fw-bold">Welcome to our largest community</h2>
                            <p class="mb-0 h6 fw-light">Let's learn something new today!</p>
                            <img src="/assets/images/element/02.svg" class="mt-5" alt="">
                            <div class="d-sm-flex mt-5 align-items-center justify-content-center">
                                <ul class="avatar-group mb-2 mb-sm-0">
                                    <li class="avatar avatar-sm"><img class="avatar-img rounded-circle" src="/assets/images/avatar/01.jpg" alt=""></li>
                                    <li class="avatar avatar-sm"><img class="avatar-img rounded-circle" src="/assets/images/avatar/02.jpg" alt=""></li>
                                    <li class="avatar avatar-sm"><img class="avatar-img rounded-circle" src="/assets/images/avatar/03.jpg" alt=""></li>
                                    <li class="avatar avatar-sm"><img class="avatar-img rounded-circle" src="/assets/images/avatar/04.jpg" alt=""></li>
                                </ul>
                                <p class="mb-0 h6 fw-light ms-sm-3">4k+ Students joined us, now it's your turn.</p>
                            </div>
                        </div>
                    </div>

                    {{-- Right --}}
                    <div class="col-12 col-lg-6 m-auto">
                        <div class="row my-5">
                            <div class="col-sm-10 col-xl-8 m-auto">

                                <img src="/assets/images/element/03.svg" class="h-40px mb-2" alt="">
                                <h2>Sign up for your account!</h2>
                                <p class="lead mb-4">Please create your account.</p>

                                {{-- Jetstream Errors --}}
                                <x-validation-errors class="mb-4" />

                                <form method="POST" action="{{ route('register') }}">
                                    @csrf

                                    <div class="mb-4">
                                        <label class="form-label">Name *</label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text bg-light border-0 text-secondary px-3"><i class="fas fa-user"></i></span>
                                            <input type="text" class="form-control border-0 bg-light rounded-end ps-1"
                                                name="name" required autofocus value="{{ old('name') }}">
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Email *</label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text bg-light border-0 text-secondary px-3"><i class="bi bi-envelope-fill"></i></span>
                                            <input type="email" class="form-control border-0 bg-light rounded-end ps-1"
                                                name="email" required value="{{ old('email') }}">
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Password *</label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text bg-light border-0 text-secondary px-3"><i class="fas fa-lock"></i></span>
                                            <input type="password" class="form-control border-0 bg-light rounded-end ps-1"
                                                name="password" required autocomplete="new-password">
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Confirm Password *</label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text bg-light border-0 text-secondary px-3"><i class="fas fa-lock"></i></span>
                                            <input type="password" class="form-control border-0 bg-light rounded-end ps-1"
                                                name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                    </div>

                                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                    <div class="mb-4">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="terms" required>
                                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'">Terms</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'">Privacy Policy</a>',
                                            ]) !!}
                                        </label>
                                    </div>
                                    @endif

                                    <div class="d-grid">
                                        <button class="btn btn-primary" type="submit">Register</button>
                                    </div>
                                </form>

                                <div class="mt-4 text-center">
                                    <span>Already have an account?
                                        <a href="{{ route('login') }}">Sign in here</a>
                                    </span>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>

    <script src="/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/functions.js"></script>

</body>

</html>
