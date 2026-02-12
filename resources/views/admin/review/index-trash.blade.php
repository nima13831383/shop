@extends( 'admin.layouts.master')
@section('main-content')
<!-- Page main content START -->
<div class="page-content-wrapper border">

    <!-- Title -->
    <div class="row mb-3">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        <div class="col-12">
            <h1 class="h3 mb-0">trashed Reviews</h1>
        </div>
    </div>

    <!-- All review table START -->
    <div class="card card-body bg-transparent pb-0 border mb-4">

        <!-- Table START -->
        <div class="table-responsive border-0">
            <table class="table table-dark-gray align-middle p-4 mb-0 table-hover">
                <!-- Table head -->
                <thead>
                    <tr>
                        <th scope="col" class="border-0 rounded-start">#</th>
                        <th scope="col" class="border-0">Name</th>
                        <th scope="col" class="border-0">post Name</th>
                        <th scope="col" class="border-0">Hide/Show</th>
                        <th scope="col" class="border-0 rounded-end">Action</th>
                    </tr>
                </thead>

                <!-- Table body START -->
                <tbody>



                    @foreach ($reviews as $review)
                    <tr>
                        <!-- ID -->
                        <td>{{ $review->id }}</td>

                        <!-- User -->
                        <td>
                            <div class="d-flex align-items-center position-relative">
                                <div class="avatar avatar-xs mb-2 mb-md-0">
                                    <img src="{{ $review->user->avatar ?? asset('assets/images/avatar/default.jpg') }}"
                                        class="rounded-circle" alt="">
                                </div>
                                <div class="mb-0 ms-2">
                                    <h6 class="mt-2">
                                        <a href="#" class="stretched-link">
                                            {{ $review->user?->name ?? 'guest' }}

                                        </a>
                                    </h6>
                                </div>
                            </div>
                        </td>

                        <!-- Post Title -->
                        <td>
                            <h6 class="table-responsive-title mb-0">
                                <a href="{{ url('/blog/').'/'.$review->post->slug }}">
                                    {{ $review->post->title }}
                                </a>
                            </h6>
                        </td>

                        <!-- Active Switch -->
                        <td>
                            <div class="form-check form-switch form-check-md">
                                <input
                                    class="form-check-input review-status-toggle"
                                    type="checkbox"
                                    data-id="{{ $review->id }}"
                                    id="checkReview{{ $review->id }}"
                                    {{ $review->status === 'approved' ? 'checked' : '' }}>
                            </div>
                        </td>



                        <!-- Actions -->
                        <td>
                            <!-- restore -->
                            <a href="{{ route('admin.reviews.restore', $review->id) }}"
                                class="btn btn-success-soft btn-round me-1 mb-1 mb-md-0"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="restore">
                                <i class="bi bi-check"></i>
                            </a>

                            <!-- Delete -->
                            <form action="{{ route('admin.reviews.forcedelete', $review->id) }}"
                                method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger-soft btn-round me-1 mb-1 mb-md-0"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>

                            <!-- View -->
                            <button class="btn btn-sm btn-info-soft mb-0 btn-view-review"
                                data-bs-toggle="modal"
                                data-bs-target="#viewReview"
                                data-review-id="{{ $review->id }}">
                                View
                            </button>

                        </td>
                    </tr>
                    @endforeach




                </tbody>
                <!-- Table body END -->
            </table>
        </div>
        <!-- Table END -->

        <!-- Card footer START -->
        <div class="card-footer bg-transparent px-0">
            <!-- Pagination START -->
            <div class="d-sm-flex justify-content-sm-between align-items-sm-center">
                <!-- Pagination -->
                {{ $reviews->links('vendor.pagination.admin-review-pag-trash') }}
            </div>
            <!-- Pagination END -->
        </div>
        <!-- Card footer END -->
    </div>
    <!-- All review table END -->

    <!-- Row END -->
</div>
<!-- Page main content END -->

<!-- Popup modal for reviwe START -->
<div class="modal fade" id="viewReview" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white">Review</h5>
                <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>

            <div class="modal-body">
                <div class="d-md-flex">
                    <div class="avatar avatar-md me-4 flex-shrink-0">
                        <img id="reviewUserAvatar" class="avatar-img rounded-circle" src="" alt="">
                    </div>

                    <div>
                        <div class="d-sm-flex align-items-center">
                            <h5 id="reviewUserName" class="me-3 mb-0"></h5>
                            <ul id="reviewStars" class="list-inline mb-0"></ul>
                        </div>

                        <p id="reviewTime" class="small mb-2"></p>
                        <p id="reviewText" class="mb-2"></p>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-danger-soft my-0" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>


<!-- Popup modal for reviwe END -->
@endsection
@section('js')
@parent
<script>
    document.addEventListener('DOMContentLoaded', function() {

        document.querySelectorAll('.btn-view-review').forEach(btn => {
            btn.addEventListener('click', function() {

                const reviewId = this.getAttribute('data-review-id');

                fetch(`/admin/post-reviews/show/${reviewId}`)
                    .then(response => response.json())
                    .then(data => {

                        document.getElementById('reviewUserName').innerText = data.user.name;
                        document.getElementById('reviewUserAvatar').src = data.user.avatar;
                        document.getElementById('reviewTime').innerText = data.time;
                        document.getElementById('reviewText').innerText = data.text;

                        // ستاره‌ها
                        let starsHtml = '';
                        for (let i = 1; i <= 5; i++) {
                            starsHtml += `<li class="list-inline-item me-0">
                            <i class="${i <= data.stars ? 'fas' : 'far'} fa-star text-warning"></i>
                        </li>`;
                        }
                        document.getElementById('reviewStars').innerHTML = starsHtml;

                    });
            });
        });

    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".review-status-toggle").forEach(function(el) {

            el.addEventListener("change", function() {
                let id = this.getAttribute("data-id");
                let status = this.checked ? "approved" : "unapproved";

                fetch("{{ route('admin.reviews.toggleStatus') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            id: id,
                            status: status
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        console.log(data.message);
                    })
                    .catch(err => console.error(err));
            });

        });
    });
</script>


@endsection
