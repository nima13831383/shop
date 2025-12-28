@if ($paginator->hasPages())
<nav class="d-flex justify-content-center mt-5" aria-label="navigation">
    <ul class="pagination pagination-primary-soft rounded mb-0">



        {{-- Previous --}}
        <li class="page-item {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
            <a class="page-link"
                href="{{ $paginator->onFirstPage() ? '#' : url('blog/page/' . ($paginator->currentPage() - 1)) }}">
                <i class="fas fa-angle-double-left"></i>
            </a>
        </li>

        {{-- Pages --}}
        @foreach ($elements as $element)
        @if (is_array($element))
        @foreach ($element as $page => $url)
        <li class="page-item {{ $page == $paginator->currentPage() ? 'active' : '' }}">
            <a class="page-link" href="{{ url('blog/page/' . $page) }}">
                {{ $page }}
            </a>
        </li>
        @endforeach
        @endif
        @endforeach

        {{-- Next --}}
        <li class="page-item {{ $paginator->hasMorePages() ? '' : 'disabled' }}">
            <a class="page-link"
                href="{{ $paginator->hasMorePages() ? url('blog/page/' . ($paginator->currentPage() + 1)) : '#' }}">
                <i class="fas fa-angle-double-right"></i>
            </a>
        </li>




    </ul>
</nav>
@endif
