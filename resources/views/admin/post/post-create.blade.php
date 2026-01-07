@extends('admin.layouts.master')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/font-awesome/css/all.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/choices/css/choices.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/aos/aos.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/glightbox/css/glightbox.css') }}">
<!-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/quill/css/quill.snow.css') }}"> -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/stepper/css/bs-stepper.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
<link href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css" rel="stylesheet"
    type="text/css" />
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

@endsection
@section('main-content')
<!-- =======================
Page Banner START -->
<section class="py-0 bg-blue h-100px align-items-center d-flex h-200px rounded-0" style="background:url(assets/images/pattern/04.png) no-repeat center center; background-size:cover;">
    <!-- Main banner background image -->
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <!-- Title -->
                <h1 class="text-white">Submit a new Course</h1>
                <p class="text-white mb-0">Read our <a href="#" class="text-white"><u>"Before you create a course"</u></a> article before submitting!</p>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

            </div>
        </div>
    </div>
</section>
<!-- =======================
Page Banner END -->

<!-- =======================
Steps START -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto text-center">
                <!-- Content -->
                <p class="text-center">Use this interface to add a new Course to the portal. Once you are done adding the item it will be reviewed for quality. If approved, your course will appear for sale and you will be informed by email that your course has been accepted.</p>
            </div>
        </div>

        <div class="card bg-transparent border rounded-3 mb-5">
            <div id="stepper" class="bs-stepper stepper-outline">
                <!-- Card header -->
                <div class="card-header bg-light border-bottom px-lg-5">
                    <!-- Step Buttons START -->
                    <div class="bs-stepper-header" role="tablist">
                        <!-- Step 1 -->
                        <div class="step" data-target="#step-1">
                            <div class="d-grid text-center align-items-center">
                                <button type="button" class="btn btn-link step-trigger mb-0" role="tab" id="steppertrigger1" aria-controls="step-1">
                                    <span class="bs-stepper-circle">1</span>
                                </button>
                                <h6 class="bs-stepper-label d-none d-md-block">Course details</h6>
                            </div>
                        </div>
                        <div class="line"></div>

                        <!-- Step 2 -->
                        <div class="step" data-target="#step-2">
                            <div class="d-grid text-center align-items-center">
                                <button type="button" class="btn btn-link step-trigger mb-0" role="tab" id="steppertrigger2" aria-controls="step-2">
                                    <span class="bs-stepper-circle">2</span>
                                </button>
                                <h6 class="bs-stepper-label d-none d-md-block">Course media</h6>
                            </div>
                        </div>


                        <!-- Step 3 -->


                        <!-- Step 4 -->

                    </div>
                    <!-- Step Buttons END -->
                </div>

                <!-- Card body START -->
                <div class="card-body">
                    <!-- Step content START -->
                    <div class="bs-stepper-content">
                        <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" id="postform">
                            @csrf
                            <!-- Step 1 content START -->
                            <div id="step-1" role="tabpanel" class="content fade" aria-labelledby="steppertrigger1">
                                <!-- Title -->
                                <h4>Post details</h4>

                                <hr> <!-- Divider -->

                                <!-- Basic information START -->
                                <div class="row g-4">
                                    <!-- Course title -->
                                    <div class="col-12">
                                        <label class="form-label">Post title</label>
                                        <input class="form-control" name="title" type="text" placeholder="Enter Post title" value="{{ old('title') }}">
                                    </div>

                                    <!-- Short description -->
                                    <div class="col-12">
                                        <label class="form-label">Short description</label>
                                        <textarea class="form-control" rows="2" placeholder="Enter keywords" name="description" id="description">{!! old('description', $post->description ?? '') !!}
										</textarea>
                                    </div>


                                    <!-- Course category -->
                                    <div class="col-md-6">
                                        <label class="form-label">Post category</label>
                                        <select class="form-select js-choice border-0 z-index-9 bg-transparent" aria-label=".form-select-sm" data-search-enabled="true">
                                            <option value="">Select category</option>
                                            <option>Engineer</option>
                                            <option>Medical</option>
                                            <option>Information technology</option>
                                            <option>Finance</option>
                                            <option>Marketing</option>
                                        </select>
                                    </div>





                                    <!-- Switch -->
                                    <div class="col-md-6 d-flex align-items-center justify-content-start mt-5">
                                        <div class="form-check form-switch form-check-md">
                                            <input type="hidden" name="published" value="0">

                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                name="published"
                                                id="checkPrivacy1"
                                                value="1"
                                                {{ old('published', $post->published ?? false) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="checkPrivacy1">publish</label>
                                        </div>
                                    </div>

                                    <!-- Post time to read -->
                                    <div class="col-md-6">
                                        <label class="form-label">time to read</label>
                                        <input class="form-control" type="text" placeholder="Enter course time" name="ttr" id="ttr" value=" {!! old('ttr', $post->ttr ?? '') !!}">
                                    </div>







                                    <!-- Blade -->
                                    <div id="froala-editor" data-upload-video-url="{{ url('admin/upload/video') }}" data-upload-url="{{ url('admin/upload/photo') }}" data-csrf="{{ csrf_token() }}">{!! old('body', $post->body ?? '') !!}</div>
                                    <textarea name="body" id="body" hidden></textarea>



                                    <!-- Step 1 button -->
                                    <div class="d-flex justify-content-end mt-3">
                                        <button class="btn btn-primary next-btn mb-0" type="button">Next</button>
                                    </div>
                                </div>
                                <!-- Basic information START -->
                            </div>
                            <!-- Step 1 content END -->

                            <!-- Step 2 content START -->
                            <div id="step-2" role="tabpanel" class="content fade" aria-labelledby="steppertrigger2">
                                <!-- Title -->
                                <h4>Post media</h4>

                                <hr> <!-- Divider -->

                                <div class="row">
                                    <!-- Upload image START -->
                                    <div class="col-12">
                                        <div class="text-center justify-content-center align-items-center p-4 p-sm-5 border border-2 border-dashed position-relative rounded-3">
                                            <!-- Image -->
                                            <img src="assets/images/element/gallery.svg" class="h-50px" alt="">
                                            <div>
                                                <h6 class="my-2">Upload Post thumbnail here, or<a href="#!" class="text-primary"> Browse</a></h6>
                                                <label style="cursor:pointer;">
                                                    <span>
                                                        <input class="form-control stretched-link" type="file" name="image" id="image" accept="image/gif, image/jpeg, image/png" />
                                                    </span>
                                                </label>
                                                <p class="small mb-0 mt-2"><b>Note:</b> Only JPG, JPEG and PNG. Our suggested dimensions are 600px * 450px. Larger image will be cropped to 4:3 to fit our thumbnails/previews.</p>
                                            </div>
                                        </div>

                                        <!-- Button -->
                                        <div class="d-sm-flex justify-content-end mt-2">
                                            <button type="button" class="btn btn-sm btn-danger-soft mb-3">Remove image</button>
                                        </div>
                                    </div>
                                    <!-- Upload image END -->



                                    <!-- Step 2 button -->
                                    <div class="d-md-flex justify-content-between align-items-start mt-4">
                                        <button class="btn btn-secondary prev-btn mb-2 mb-md-0">Previous</button>
                                        <div class="text-md-end">
                                            <!-- <a href="course-added.html" class="btn btn-success mb-2 mb-sm-0">Submit a Post</a> -->
                                            <button type="submit" class="btn btn-success mb-2 mb-sm-0">Submit a Post</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Step 2 content END -->



                        </form>
                    </div>
                </div>
                <!-- Card body END -->
            </div>
        </div>
    </div>
</section>
<!-- =======================
Steps END -->

@endsection

@section('js')
<script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/choices/js/choices.min.js') }}"></script>
<script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('assets/vendor/glightbox/js/glightbox.js') }}"></script>
<!-- <script src="{{ asset('assets/vendor/quill/js/quill.min.js') }}"></script> -->
<script src="{{ asset('assets/vendor/stepper/js/bs-stepper.min.js') }}"></script>
<script src="{{ asset('assets/js/functions.js') }}"></script>




<script src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js"></script>
<!-- <script>
    new FroalaEditor("div#froala-editor");
</script> -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="{{ asset('assets/js/articles/flora-editor-buttons.js') }}"></script>

@endsection
