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
                        <h3>{{ $post->reviews_count }} comments</h3>

                        @include('public.layouts.partials.comment', [
                        'reviews' => $post->reviews->whereNull('parent_id'),
                        'level' => 0
                        ])
                    </div>


                    <!-- Comment END -->

                    <!-- Form START -->
                    <div class="col-md-5">
                        <!-- Title -->
                        <h3 class="mt-3 mt-sm-0">Your Views Please!</h3>
                        <small>Your email address will not be published. Required fields are marked *</small>

                        <form method="POST" action="{{ route('post.reviews.store') }}" class="row g-3" id="review-form">
                            @csrf
                            <!-- <input type="hidden" name="captcha_answer" value="{{ session('captcha') }}">
                            <label>{{ session('captcha_q') }}</label>
                            <input type="text" name="captcha_input"> -->

                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <input type="hidden" name="parent_id" id="parent_id">
                            <input type="text" name="website" style="display:none">

                            @if(!auth()->check())
                            <div class="col-md-6">
                                <label>Name *</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label>Email *</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            @endif

                            <div class="col-12">
                                <label>Your Comment</label>
                                <textarea name="comment" class="form-control" rows="3"></textarea>
                            </div>
                            {{-- Google Recaptcha --}}
                            <div class="col-12">
                                <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                                @error('g-recaptcha-response')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
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
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

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
<script>
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.reply-btn');
        if (!btn) return;

        e.preventDefault();

        const parentInput = document.getElementById('parent_id');
        const textarea = document.querySelector('textarea[name="comment"]');

        if (!parentInput || !textarea) {
            console.error('Reply form not found');
            return;
        }

        parentInput.value = btn.dataset.id;

        document.getElementById('review-form')?.scrollIntoView({
            behavior: 'smooth'
        });

        textarea.focus();
    });
</script>





@endsection
