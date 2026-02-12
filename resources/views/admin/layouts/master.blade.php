<!DOCTYPE html>
<html lang="en">

<head>
    <title>Eduport- LMS, Education and Course Theme</title>

    <!-- Meta Tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="author" content="Webestica.com" />
    <meta
        name="description"
        content="Eduport- LMS, Education and Course Theme" />



    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com/" />
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
    <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;700&amp;family=Roboto:wght@400;500;700&amp;display=swap" />

    @section('css')
    <!-- Plugins CSS -->
    <link
        rel="stylesheet"
        type="text/css"
        href="{{ asset('assets/vendor/font-awesome/css/all.min.css') }}" />
    <link
        rel="stylesheet"
        type="text/css"
        href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" />
    <link
        rel="stylesheet"
        type="text/css"
        href="{{ asset('assets/vendor/apexcharts/css/apexcharts.css') }}" />
    <link
        rel="stylesheet"
        type="text/css"
        href="{{ asset('assets/vendor/overlay-scrollbar/css/overlayscrollbars.min.css') }}" />

    <!-- Theme CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}" />
    @show
</head>

<body>

    <!-- **************** MAIN CONTENT START **************** -->
    <main>
        <!-- Sidebar START -->
        @include('admin.layouts.partials.sidebar')
        <!-- Sidebar END -->

        <!-- Page content START -->
        <div class="page-content">
            <!-- Top bar START -->
            @include('admin.layouts.partials.topbar')
            <!-- Top bar END -->

            <!-- Page main content START -->
            @yield('main-content')
            <!-- Page main content END -->
        </div>
        <!-- Page content END -->
    </main>
    <!-- **************** MAIN CONTENT END **************** -->

    <!-- Back to top -->
    <div class="back-top">
        <i
            class="bi bi-arrow-up-short position-absolute top-50 start-50 translate-middle"></i>
    </div>

    @section('js')
    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Vendors -->
    <script src="{{ asset('assets/vendor/purecounterjs/dist/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets/vendor/apexcharts/js/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/overlay-scrollbar/js/overlayscrollbars.min.js') }}"></script>

    <!-- Template Functions -->
    <script src="{{ asset('assets/js/functions.js') }}"></script>
    @show
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'success',
            text: '{{ session("success") }}',
        });
    </script>
    @endif
</body>


</html>
