@if ($paginator->hasPages())
<nav class="d-flex justify-content-center" aria-label="navigation">
    <ul class="pagination pagination-sm pagination-primary-soft">

        {{-- Previous --}}
        <li class="page-item {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
            <a class="page-link"
                href="{{ $paginator->onFirstPage() ? '#' : url('admin/post-reviews/page/' . ($paginator->currentPage() - 1)) }}">
                <i class="fas fa-angle-left"></i>
            </a>
        </li>

        {{-- Pages --}}
        @foreach ($elements as $element)
        @if (is_array($element))
        @foreach ($element as $page => $url)
        <li class="page-item {{ $page == $paginator->currentPage() ? 'active' : '' }}">
            <a class="page-link" href="{{ url('admin/post-reviews/page/' . $page) }}">
                {{ $page }}
            </a>
        </li>
        @endforeach
        @endif
        @endforeach

        {{-- Next --}}
        <li class="page-item {{ $paginator->hasMorePages() ? '' : 'disabled' }}">
            <a class="page-link"
                href="{{ $paginator->hasMorePages() ? url('admin/post-reviews/page/' . ($paginator->currentPage() + 1)) : '#' }}">
                <i class="fas fa-angle-right"></i>
            </a>
        </li>

    </ul>
</nav>
@endif
