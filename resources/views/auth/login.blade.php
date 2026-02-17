{{-- <x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ $value }}
</div>
@endsession

<form method="POST" action="{{ route('login') }}">
    @csrf

    <div>
        <x-label for="email" value="{{ __('Email') }}" />
        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
    </div>

    <div class="mt-4">
        <x-label for="password" value="{{ __('Password') }}" />
        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
    </div>

    <div class="block mt-4">
        <label for="remember_me" class="flex items-center">
            <x-checkbox id="remember_me" name="remember" />
            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
        </label>
    </div>

    <div class="flex items-center justify-end mt-4">
        @if (Route::has('password.request'))
        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
            {{ __('Forgot your password?') }}
        </a>
        @endif

        <x-button class="ms-4">
            {{ __('Log in') }}
        </x-button>
    </div>
</form>
</x-authentication-card>
</x-guest-layout>--}}
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="/assets/vendor/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="/assets/vendor/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>
    <main>
        <section class="p-0 d-flex align-items-center position-relative overflow-hidden">
            <div class="container-fluid">
                <div class="row">

                    <!-- Left -->
                    <div class="col-12 col-lg-6 d-md-flex align-items-center justify-content-center bg-primary bg-opacity-10 vh-lg-100">
                        <div class="p-3 p-lg-5 text-center">
                            <h2 class="fw-bold">Welcome to our largest community</h2>
                            <p class="mb-0 h6 fw-light">Let's learn something new today!</p>
                            <img src="/assets/images/element/02.svg" class="mt-5" alt="">
                        </div>
                    </div>

                    <!-- Right -->
                    <div class="col-12 col-lg-6 m-auto">
                        <div class="row my-5">
                            <div class="col-sm-10 col-xl-8 m-auto">

                                <h1 class="fs-2">Login into Eduport!</h1>
                                <p class="lead mb-4">Nice to see you! Please log in with your account.</p>

                                <!-- Laravel Validation Errors -->
                                <x-validation-errors class="mb-3" />

                                @if (session('status'))
                                <div class="mb-4 font-medium text-sm text-success">
                                    {{ session('status') }}
                                </div>
                                @endif

                                <!-- Login Form -->
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <!-- Email -->
                                    <div class="mb-4">
                                        <label class="form-label">Email address *</label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text bg-light border-0">
                                                <i class="bi bi-envelope-fill"></i>
                                            </span>
                                            <input type="email" name="email" class="form-control border-0 bg-light"
                                                placeholder="Email" value="{{ old('email') }}" required autofocus>
                                        </div>
                                    </div>

                                    <!-- Password -->
                                    <div class="mb-4">
                                        <label class="form-label">Password *</label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text bg-light border-0">
                                                <i class="fas fa-lock"></i>
                                            </span>
                                            <input type="password" name="password" class="form-control border-0 bg-light"
                                                placeholder="Password" required>
                                        </div>
                                    </div>

                                    <!-- Remember + Forgot -->
                                    <div class="mb-4 d-flex justify-content-between">
                                        <div class="form-check">
                                            <input type="checkbox" name="remember" class="form-check-input" id="remember_me">
                                            <label class="form-check-label" for="remember_me">Remember me</label>
                                        </div>

                                        @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="text-secondary">
                                            <u>Forgot password?</u>
                                        </a>
                                        @endif
                                    </div>

                                    <!-- Login Button -->
                                    <div class="d-grid">
                                        <button class="btn btn-primary" type="submit">Login</button>
                                    </div>
                                </form>

                                <!-- Divider -->
                                <div class="position-relative my-4">
                                    <hr>
                                    <p class="small position-absolute top-50 start-50 translate-middle bg-body px-5">Or</p>
                                </div>

                                <!-- Social Login -->
                                <div class="row">
                                    <div class="col-xxl-6 d-grid">
                                        <a href="{{ route('google.redirect') }}" class="btn bg-google mb-2">
                                            <i class="fab fa-google text-white me-2"></i>Login with Google
                                        </a>

                                    </div>
                                    <div class="col-xxl-6 d-grid">
                                        <a href="#" class="btn bg-facebook">
                                            <i class="fab fa-facebook-f me-2"></i>Login with Facebook
                                        </a>
                                    </div>
                                </div>

                                <!-- Register Link -->
                                <div class="mt-4 text-center">
                                    <span>Don't have an account?
                                        <a href="{{ route('register') }}">Signup here</a>
                                    </span>
                                </div>

                            </div>
                        </div>
                    </div>

                </div> <!-- row -->
            </div>
        </section>
    </main>

    <script src="/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
