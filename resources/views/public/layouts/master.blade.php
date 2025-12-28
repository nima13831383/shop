<!DOCTYPE html>
<html lang="en">

<head>
    <title>Eduport - LMS, Education and Course Theme</title>

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
    <style>
        li.breadcrumb-item::before {
            display: none !important;
        }

        main {
            padding-top: 96px;
        }

        @media screen and (max-width: 980px) {
            main {
                padding-top: 60px;
            }
        }
    </style>
</head>

<body>

    <!-- Header START -->
    <header class="navbar-light navbar-sticky navbar-transparent">
        <!-- Logo Nav START -->
        <nav class="navbar navbar-expand-xl">
            <div class="container">
                <!-- Logo START -->
                <a class="navbar-brand" href="index-2.html">
                    <img class="light-mode-item navbar-brand-item" src="{{ asset('assets/images/logo.svg') }}" alt="logo">
                    <img class="dark-mode-item navbar-brand-item" src="{{ asset('assets/images/logo-light.svg') }}" alt="logo">
                </a>
                <!-- Logo END -->

                <!-- Responsive navbar toggler -->
                <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="true" aria-label="Toggle navigation">
                    <span class="me-2"><i class="fas fa-search fs-5"></i></span>
                </button>

                <!-- Category menu START -->
                <ul class="navbar-nav navbar-nav-scroll dropdown-clickable">
                    <li class="nav-item dropdown dropdown-menu-shadow-stacked">
                        <a class="nav-link" href="#" id="categoryMenu" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-grid-3x3-gap-fill me-3 fs-5 me-xl-1 d-xl-none"></i>
                            <i class="bi bi-grid-3x3-gap-fill me-1 d-none d-xl-inline-block"></i>
                            <span class="d-none d-xl-inline-block">Menu</span>
                        </a>

                        <ul class="dropdown-menu z-index-unset" aria-labelledby="categoryMenu">

                            <!-- Dropdown submenu -->
                            <li> <a class="dropdown-item" href="{{ url('/') }}">Home</a></li>
                            <li> <a class="dropdown-item" href="{{ route('public.blog') }}">blog</a></li>
                            <!-- Dropdown submenu -->


                        </ul>
                    </li>
                </ul>
                <!-- Category menu END -->

                <!-- Main navbar START -->
                <div class="navbar-collapse collapse" id="navbarCollapse">
                    <!-- Nav Search START -->
                    <div class="col-xl-8">
                        <div class="nav my-3 my-xl-0 px-4 flex-nowrap align-items-center">
                            <div class="nav-item w-100">
                                <form class="rounded position-relative">
                                    <input class="form-control pe-5 bg-secondary bg-opacity-10 border-0" type="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-link bg-transparent px-2 py-0 position-absolute top-50 end-0 translate-middle-y"
                                        type="submit"><i class="fas fa-search fs-6 text-primary"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Nav Search END -->
                </div>
                <!-- Main navbar END -->

                <!-- Right header content START -->
                <!-- Add to cart -->
                <div class="navbar-nav position-relative overflow-visible me-3">
                    <a href="#" class="nav-link"> <i class="fas fa-shopping-cart fs-5"></i></a>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-circle bg-success mt-xl-2 ms-n1">5
                        <span class="visually-hidden">unread messages</span>
                    </span>
                </div>

                <!-- Language -->
                <ul class="navbar-nav navbar-nav-scroll me-3 d-none d-xl-block">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="language" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-globe me-2"></i>
                            <span class="d-none d-lg-inline-block">Language</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end min-w-auto" aria-labelledby="language">
                            <li> <a class="dropdown-item" href="#"><img class="fa-fw me-2" src="assets/images/flags/uk.svg" alt="">English</a></li>
                            <li> <a class="dropdown-item" href="#"><img class="fa-fw me-2" src="assets/images/flags/gr.svg" alt="">German</a></li>
                            <li> <a class="dropdown-item" href="#"><img class="fa-fw me-2" src="assets/images/flags/sp.svg" alt="">French</a></li>
                        </ul>
                    </li>
                </ul>

                <!-- Signout button  -->
                <div class="navbar-nav d-none d-lg-inline-block">
                    <button class="btn btn-danger-soft mb-0"><i class="fas fa-sign-in-alt me-2"></i>Sign Up</button>
                </div>
                <!-- Right header content END -->

            </div>
        </nav>
        <!-- Logo Nav END -->
    </header>
    <!-- Header END -->

    <!-- **************** MAIN CONTENT START **************** -->
    <main>

        <!-- Page content START -->
        @yield('main-content')

        <!-- Page content END -->
    </main>
    <!-- **************** MAIN CONTENT END **************** -->
    <!-- =======================
Footer START -->
    <footer class="bg-light pt-5">
        <div class="container">
            <!-- Row START -->
            <div class="row g-4">

                <!-- Widget 1 START -->
                <div class="col-lg-3">
                    <!-- logo -->
                    <a class="me-0" href="index-2.html">
                        <img class="light-mode-item h-40px" src="assets/images/logo.svg" alt="logo">
                        <img class="dark-mode-item h-40px" src="assets/images/logo-light.svg" alt="logo">
                    </a>
                    <p class="my-3">Eduport education theme, built specifically for the education centers which is dedicated to teaching and involve learners. </p>
                    <!-- Social media icon -->
                    <ul class="list-inline mb-0 mt-3">
                        <li class="list-inline-item"> <a class="btn btn-white btn-sm shadow px-2 text-facebook" href="#"><i class="fab fa-fw fa-facebook-f"></i></a> </li>
                        <li class="list-inline-item"> <a class="btn btn-white btn-sm shadow px-2 text-instagram" href="#"><i class="fab fa-fw fa-instagram"></i></a> </li>
                        <li class="list-inline-item"> <a class="btn btn-white btn-sm shadow px-2 text-twitter" href="#"><i class="fab fa-fw fa-twitter"></i></a> </li>
                        <li class="list-inline-item"> <a class="btn btn-white btn-sm shadow px-2 text-linkedin" href="#"><i class="fab fa-fw fa-linkedin-in"></i></a> </li>
                    </ul>
                </div>
                <!-- Widget 1 END -->

                <!-- Widget 2 START -->
                <div class="col-lg-6">
                    <div class="row g-4">
                        <!-- Link block -->
                        <div class="col-6 col-md-4">
                            <h5 class="mb-2 mb-md-4">Company</h5>
                            <ul class="nav flex-column">
                                <li class="nav-item"><a class="nav-link" href="#">About us</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Contact us</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">News and Blogs</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Library</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Career</a></li>
                            </ul>
                        </div>

                        <!-- Link block -->
                        <div class="col-6 col-md-4">
                            <h5 class="mb-2 mb-md-4">Community</h5>
                            <ul class="nav flex-column">
                                <li class="nav-item"><a class="nav-link" href="#">Documentation</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Faq</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Forum</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Sitemap</a></li>
                            </ul>
                        </div>

                        <!-- Link block -->
                        <div class="col-6 col-md-4">
                            <h5 class="mb-2 mb-md-4">Teaching</h5>
                            <ul class="nav flex-column">
                                <li class="nav-item"><a class="nav-link" href="#">Become a teacher</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">How to guide</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Terms &amp; Conditions</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Widget 2 END -->

                <!-- Widget 3 START -->
                <div class="col-lg-3">
                    <h5 class="mb-2 mb-md-4">Contact</h5>
                    <!-- Time -->
                    <p class="mb-2">
                        Toll free:<span class="h6 fw-light ms-2">+1234 568 963</span>
                        <span class="d-block small">(9:AM to 8:PM IST)</span>
                    </p>

                    <p class="mb-0">Email:<span class="h6 fw-light ms-2">example@gmail.com</span></p>

                    <div class="row g-2 mt-2">
                        <!-- Google play store button -->
                        <div class="col-6 col-sm-4 col-md-3 col-lg-6">
                            <a href="#"> <img src="assets/images/client/google-play.svg" alt=""> </a>
                        </div>
                        <!-- App store button -->
                        <div class="col-6 col-sm-4 col-md-3 col-lg-6">
                            <a href="#"> <img src="assets/images/client/app-store.svg" alt="app-store"> </a>
                        </div>
                    </div> <!-- Row END -->
                </div>
                <!-- Widget 3 END -->
            </div><!-- Row END -->

            <!-- Divider -->
            <hr class="mt-4 mb-0">

            <!-- Bottom footer -->
            <div class="py-3">
                <div class="container px-0">
                    <div class="d-lg-flex justify-content-between align-items-center py-3 text-center text-md-left">
                        <!-- copyright text -->
                        <div class="text-body text-primary-hover"> Copyrights ©2023 Eduport. Build by <a href="https://www.webestica.com/" target="_blank" class="text-body">Webestica</a></div>
                        <!-- copyright links-->
                        <div class="justify-content-center mt-3 mt-lg-0">
                            <ul class="nav list-inline justify-content-center mb-0">
                                <li class="list-inline-item">
                                    <!-- Language selector -->
                                    <div class="dropup mt-0 text-center text-sm-end">
                                        <a class="dropdown-toggle nav-link" href="#" role="button" id="languageSwitcher" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-globe me-2"></i>Language
                                        </a>
                                        <ul class="dropdown-menu min-w-auto" aria-labelledby="languageSwitcher">
                                            <li><a class="dropdown-item me-4" href="#"><img class="fa-fw me-2" src="assets/images/flags/uk.svg" alt="">English</a></li>
                                            <li><a class="dropdown-item me-4" href="#"><img class="fa-fw me-2" src="assets/images/flags/gr.svg" alt="">German </a></li>
                                            <li><a class="dropdown-item me-4" href="#"><img class="fa-fw me-2" src="assets/images/flags/sp.svg" alt="">French</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="list-inline-item"><a class="nav-link" href="#">Terms of use</a></li>
                                <li class="list-inline-item"><a class="nav-link pe-0" href="#">Privacy policy</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- =======================
Footer END -->


    <!-- Back to top -->
    <div class="back-top"><i class="bi bi-arrow-up-short position-absolute top-50 start-50 translate-middle"></i></div>


    @section('js')
    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Vendors -->
    <script src="{{ asset('assets/vendor/tiny-slider/tiny-slider.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.js') }}"></script>

    <!-- Template Functions -->
    <script src="{{ asset('assets/js/functions.js') }}"></script>
    @show
</body>


</html>
