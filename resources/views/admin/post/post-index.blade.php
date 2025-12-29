@extends( 'admin.layouts.master')
@section('main-content')
<div class="page-content-wrapper border">

    <!-- Title -->
    <div class="row mb-3">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        <div class="col-12 d-sm-flex justify-content-between align-items-center">
            <h1 class="h3 mb-2 mb-sm-0">Posts</h1>
            <a href="{{ route('admin.posts.create') }}" class="btn btn-sm btn-primary mb-0">Create a post</a>
        </div>
    </div>

    <!-- Course boxes START -->
    <div class="row g-4 mb-4">
        <!-- Course item -->
        <div class="col-sm-6 col-lg-4">
            <div class="text-center p-4 bg-primary bg-opacity-10 border border-primary rounded-3">
                <h6>Total Courses</h6>
                <h2 class="mb-0 fs-1 text-primary">1200</h2>
            </div>
        </div>

        <!-- Course item -->
        <div class="col-sm-6 col-lg-4">
            <div class="text-center p-4 bg-success bg-opacity-10 border border-success rounded-3">
                <h6>Activated Courses</h6>
                <h2 class="mb-0 fs-1 text-success">996</h2>
            </div>
        </div>

        <!-- Course item -->
        <div class="col-sm-6 col-lg-4">
            <div class="text-center p-4  bg-warning bg-opacity-15 border border-warning rounded-3">
                <h6>Pending Courses</h6>
                <h2 class="mb-0 fs-1 text-warning">200</h2>
            </div>
        </div>
    </div>
    <!-- Course boxes END -->

    <!-- Card START -->
    <div class="card bg-transparent border">

        <!-- Card header START -->
        <div class="card-header bg-light border-bottom">
            <!-- Search and select START -->
            <div class="row g-3 align-items-center justify-content-between">
                <!-- Search bar -->
                <div class="col-md-8">
                    <form class="rounded position-relative">
                        <input class="form-control bg-body" type="search" placeholder="Search" aria-label="Search">
                        <button class="bg-transparent p-2 position-absolute top-50 end-0 translate-middle-y border-0 text-primary-hover text-reset" type="submit">
                            <i class="fas fa-search fs-6 "></i>
                        </button>
                    </form>
                </div>

                <!-- Select option -->
                <div class="col-md-3">
                    <!-- Short by filter -->
                    <form>
                        <select class="form-select js-choice border-0 z-index-9" aria-label=".form-select-sm">
                            <option value="">Sort by</option>
                            <option>Newest</option>
                            <option>Oldest</option>
                            <option>Accepted</option>
                            <option>Rejected</option>
                        </select>
                    </form>
                </div>
            </div>
            <!-- Search and select END -->
        </div>
        <!-- Card header END -->

        <!-- Card body START -->
        <div class="card-body">
            <!-- Course table START -->
            <div class="table-responsive border-0 rounded-3">
                <!-- Table START -->
                <table class="table table-dark-gray align-middle p-4 mb-0 table-hover">
                    <!-- Table head -->
                    <thead>
                        <tr>
                            <th scope="col" class="border-0 rounded-start">Course Name</th>
                            <th scope="col" class="border-0">author</th>
                            <th scope="col" class="border-0">Added Date</th>
                            <th scope="col" class="border-0">categories</th>
                            <th scope="col" class="border-0">Status</th>
                            <th scope="col" class="border-0 rounded-end">Action</th>
                        </tr>
                    </thead>

                    <!-- Table body START -->
                    <tbody>

                        @foreach ($posts as $post)
                        <!-- Table row -->
                        <tr>
                            <!-- Table data -->
                            <td>
                                <div class="d-flex align-items-center position-relative">
                                    <!-- Image -->
                                    <div class="w-60px">
                                        <img src="{{ asset($post->image) }}" class="rounded" alt="">
                                    </div>
                                    <!-- Title -->
                                    <h6 class="table-responsive-title mb-0 ms-2">
                                        <a href="{{ url('/blog/').'/'.$post->slug }}" class="stretched-link">{{ $post->id.'-' .$post->title }}</a>
                                    </h6>
                                </div>
                            </td>

                            <!-- Table data -->
                            <td>
                                <div class="d-flex align-items-center mb-3">
                                    <!-- Avatar -->
                                    <div class="avatar avatar-xs flex-shrink-0">
                                        <img class="avatar-img rounded-circle" src="assets/images/avatar/09.jpg" alt="avatar">
                                    </div>
                                    <!-- Info -->
                                    <div class="ms-2">
                                        <h6 class="mb-0 fw-light">{{ $post->author->name ?? '—' }}</h6>
                                    </div>
                                </div>
                            </td>

                            <!-- Table data -->
                            <td>{{ $post->created_at }}</td>

                            <!-- Table data -->
                            <td> <span class="badge text-bg-primary">Beginner</span> </td>


                            <!-- Table data -->
                            <td>
                                @if ($post->published)
                                <span class="badge bg-success bg-opacity-15 text-success">published</span>
                                @else
                                <span class="badge bg-warning bg-opacity-15 text-warning">pending</span>
                                @endif
                            </td>

                            <!-- Table data -->
                            <td>
                                <a href="{{ route('admin.posts.edit',[$post->id]) }}" class="btn btn-sm btn-dark me-1 mb-1 mb-md-0">Edit</a>
                                <form action="{{ route('admin.posts.delete', $post->id) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('آیا مطمئن هستید؟')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-danger-soft mb-0">
                                        delete
                                    </button>
                                </form>

                            </td>
                        </tr>
                        @endforeach


                    </tbody>
                    <!-- Table body END -->
                </table>
                <!-- Table END -->
            </div>
            <!-- Course table END -->
        </div>
        <!-- Card body END -->

        <!-- Card footer START -->
        <div class="card-footer bg-transparent pt-0">
            <!-- Pagination START -->
            <div class="d-sm-flex justify-content-sm-between align-items-sm-center">
                <!-- Content -->
                <b></b>
                <!-- Pagination -->
                {{ $posts->links('vendor.pagination.bootstrap-5') }}
            </div>
            <!-- Pagination END -->
        </div>
        <!-- Card footer END -->
    </div>
    <!-- Card END -->
</div>
@endsection
