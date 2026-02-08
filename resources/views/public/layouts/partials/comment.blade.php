@foreach($reviews as $review)
<div class="my-4 d-flex " style="padding-left: {{ ($level  ?? 0)*25 }}px">

    <img
        class="avatar avatar-md rounded-circle me-3"
        src="{{ $review->user->avatar ?? asset('assets/images/user.jpg') }}"
        alt="avatar">

    <div>
        <div class="mb-2">
            <h5 class="m-0">{{ $review->name }}</h5>
            <span class="me-3 small">
                {{ $review->created_at->diffForHumans() }}
            </span>
        </div>

        <p>{{ $review->comment }}</p>


        <a
            href="#review-form"
            class="btn btn-sm btn-light mb-0 reply-btn"
            data-id="{{ $review->id }}">
            Reply
        </a>
    </div>

</div>
{{-- Replies --}}
@if($review->children->count())
@include('public.layouts.partials.comment', [
'reviews' => $review->children,
'level' => ($level ?? 0) + 1
])
@endif
@endforeach
