<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title', 'Auth Page')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="/assets/vendor/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="/assets/vendor/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="/assets/css/style.css">

    @stack('styles')
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

                                @yield('content')

                            </div>
                        </div>
                    </div>

                </div> <!-- row -->
            </div>
        </section>
    </main>

    <script src="/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>

</html>
