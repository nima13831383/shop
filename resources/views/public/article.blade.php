@extends('public.layouts.master')
@use('Vedmant\LaravelShortcodes\Facades\Shortcodes')
@section('css')
@parent

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_style.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css" />
<style>
    .bg-overlay {
        pointer-events: none;
    }
</style>
@endsection
@section('main-content')
<!-- =======================
Main Content START -->
<section class="pb-0 pt-4 pb-md-5">
    <div class="container">
        <div class="row">
            <div class="col-12">

                <!-- Title and Info START -->
                <div class="row">
                    <!-- Avatar and Share -->
                    <div class="col-lg-3 align-items-center mt-4 mt-lg-5 order-2 order-lg-1">
                        <div class="text-lg-center">
                            <!-- Author info -->
                            <div class="position-relative">
                                <!-- Avatar -->
                                <div class="avatar avatar-xxl">
                                    <img class="avatar-img rounded-circle" src="{{ asset('assets/images/avatar/09.jpg') }}" alt="avatar">
                                </div>
                                <a href="#" class="h5 stretched-link mt-2 mb-0 d-block">{{ $post->author->name }}</a>
                                <p class="mb-2">Editor at Eduport</p>
                            </div>
                            <!-- Info -->
                            <ul class="list-inline list-unstyled">
                                <li class="list-inline-item d-lg-block my-lg-2">{{ $post->smart_date }}</li>
                                <li class="list-inline-item d-lg-block my-lg-2">{{ $post->ttr }} min read</li>
                                <li class="list-inline-item badge text-bg-orange"><i class="far text-white fa-heart me-1"></i>{{ $post->likes }}</li>
                                <li class="list-inline-item badge text-bg-info"><i class="far fa-eye me-1"></i>{{ $post->views }}</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="col-lg-9 order-1">
                        <!-- Pre title -->
                        <span>{{ $post->SmartDate }}</span><span class="mx-2">|</span>
                        <div class="badge text-bg-success">Research</div>
                        <!-- Title -->
                        <h1 class="mt-2 mb-0 display-5">{{ $post->title }}</h1>
                        <!-- Info -->
                        <p class="mt-2">{{ $post->description }}</p>
                    </div>
                </div>
                <!-- Title and Info END -->



                <!-- Content START -->
                <div class="row fr-view">
                    {!! Shortcodes::render($post->body) !!}

                </div>
                <!-- Content END -->

                <!-- Tags and share START -->
                <div class="d-lg-flex justify-content-lg-between mb-4">
                    <!-- Social media button -->
                    <div class="align-items-center mb-3 mb-lg-0">
                        <h6 class="mb-2 me-4 d-inline-block">Share on:</h6>
                        <ul class="list-inline mb-0 mb-2 mb-sm-0">
                            <li class="list-inline-item"> <a class="btn px-2 btn-sm bg-facebook" href="#"><i class="fab fa-fw fa-facebook-f"></i></a> </li>
                            <li class="list-inline-item"> <a class="btn px-2 btn-sm bg-instagram-gradient" href="#"><i class="fab fa-fw fa-instagram"></i></a> </li>
                            <li class="list-inline-item"> <a class="btn px-2 btn-sm bg-twitter" href="#"><i class="fab fa-fw fa-twitter"></i></a> </li>
                            <li class="list-inline-item"> <a class="btn px-2 btn-sm bg-linkedin" href="#"><i class="fab fa-fw fa-linkedin-in"></i></a> </li>
                        </ul>
                    </div>
                    <!-- Popular tags -->
                    <div class="align-items-center">
                        <h6 class="mb-2 me-4 d-inline-block">Popular Tags:</h6>
                        <ul class="list-inline mb-0 social-media-btn">
                            <li class="list-inline-item"> <a class="btn btn-outline-light btn-sm mb-lg-0" href="#">blog</a> </li>
                            <li class="list-inline-item"> <a class="btn btn-outline-light btn-sm mb-lg-0" href="#">business</a> </li>
                            <li class="list-inline-item"> <a class="btn btn-outline-light btn-sm mb-lg-0" href="#">bootstrap</a> </li>
                            <li class="list-inline-item"> <a class="btn btn-outline-light btn-sm mb-lg-0" href="#">data science</a> </li>
                            <li class="list-inline-item"> <a class="btn btn-outline-light btn-sm mb-lg-0" href="#">deep learning</a> </li>
                        </ul>
                    </div>
                </div>
                <!-- Tags and share END -->

                <hr> <!-- Divider -->

                <!-- Comment review and form START -->
                <div class="row mt-4">
                    <!-- Comment START -->
                    <div class="col-md-7">
                        <h3>3 comments</h3>
                        <!-- Comment level 1-->
                        <div class="my-4 d-flex">
                            <img class="avatar avatar-md rounded-circle me-3" src="assets/images/avatar/01.jpg" alt="avatar">
                            <div>
                                <div class="mb-2">
                                    <h5 class="m-0">Frances Guerrero</h5>
                                    <span class="me-3 small">June 11, 2021 at 6:01 am</span>
                                </div>
                                <p>Satisfied conveying a dependent contented he gentleman agreeable do be. Warrant private blushes removed an in equally totally if. Delivered dejection necessary objection do Mr prevailed. Mr feeling does chiefly cordial in do.</p>
                                <a href="#" class="btn btn-sm btn-light mb-0">Reply</a>
                            </div>
                        </div>
                        <!-- Comment children level 2 -->
                        <div class="my-4 d-flex ps-2 ps-md-4">
                            <img class="avatar avatar-md rounded-circle me-3" src="assets/images/avatar/02.jpg" alt="avatar">
                            <div>
                                <div class="mb-2">
                                    <h5 class="m-0">Louis Ferguson</h5>
                                    <span class="me-3 small">June 11, 2021 at 6:55 am</span>
                                </div>
                                <p>Water timed folly right aware if oh truth. Imprudence attachment him for sympathize. Large above be to means. Dashwood does provide stronger is. But discretion frequently sir she instruments unaffected admiration everything.</p>
                                <a href="#" class="btn btn-sm btn-light mb-0">Reply</a>
                            </div>
                        </div>
                        <!-- Comment children level 3 -->
                        <div class="my-4 d-flex ps-3 ps-md-5">
                            <img class="avatar avatar-md rounded-circle me-3" src="assets/images/avatar/01.jpg" alt="avatar">
                            <div>
                                <div class="mb-2">
                                    <h5 class="m-0">Frances Guerrero</h5>
                                    <span class="me-3 small">June 12, 2021 at 7:30 am</span>
                                </div>
                                <p>Water timed folly right aware if oh truth.</p>
                                <a href="#" class="btn btn-sm btn-light mb-0">Reply</a>
                            </div>
                        </div>
                        <!-- Comment level 1 -->
                        <div class="my-4 d-flex">
                            <img class="avatar avatar-md rounded-circle me-3" src="assets/images/avatar/04.jpg" alt="avatar">
                            <div>
                                <div class="mb-2">
                                    <h5 class="m-0">Judy Nguyen</h5>
                                    <span class="me-3 small">June 18, 2021 at 11:55 am</span>
                                </div>
                                <p>Fulfilled direction use continual set him propriety continued. Saw met applauded favorite deficient engrossed concealed and her. Concluded boy perpetual old supposing. Farther-related bed and passage comfort civilly.</p>
                                <a href="#" class="btn btn-sm btn-light mb-0">Reply</a>
                            </div>
                        </div>
                    </div>
                    <!-- Comment END -->

                    <!-- Form START -->
                    <div class="col-md-5">
                        <!-- Title -->
                        <h3 class="mt-3 mt-sm-0">Your Views Please!</h3>
                        <small>Your email address will not be published. Required fields are marked *</small>

                        <form class="row g-3 mt-2 mb-5">
                            <!-- Name -->
                            <div class="col-lg-6">
                                <label class="form-label">Name *</label>
                                <input type="text" class="form-control" aria-label="First name">
                            </div>
                            <!-- Email -->
                            <div class="col-lg-6">
                                <label class="form-label">Email *</label>
                                <input type="email" class="form-control">
                            </div>
                            <!-- Comment -->
                            <div class="col-12">
                                <label class="form-label">Your Comment *</label>
                                <textarea class="form-control" rows="3"></textarea>
                            </div>
                            <!-- Button -->
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary mb-0">Post comment</button>
                            </div>
                        </form>
                    </div>
                    <!-- Form END -->
                </div>
                <!-- Comment review and form END -->
            </div>
        </div> <!-- Row END -->
    </div>
</section>
<!-- =======================
Main Content END -->
@endsection


@section('js')
@parent
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="{{ asset('assets/js/articles/styler.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>

<!-- Plyr JS -->
<script src="https://cdn.plyr.io/3.6.8/plyr.polyfilled.js"></script>

<script>
    const lightbox = GLightbox({
        selector: '.glightbox',
        autoplayVideos: true,
        autofocusVideos: false,
        plyr: {
            css: 'https://cdn.plyr.io/3.6.8/plyr.css',
            js: 'https://cdn.plyr.io/3.6.8/plyr.polyfilled.js',
            config: {
                ratio: '16:9',
                muted: false,
                hideControls: false,
                youtube: {
                    noCookie: true,
                    rel: 0,
                    showinfo: 0
                },
                vimeo: {
                    byline: false,
                    portrait: false,
                    title: false
                }
            }
        }
    });
</script>


@endsection
