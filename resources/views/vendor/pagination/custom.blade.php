@if ($paginator->hasPages())
    <div class="pagination">
        {{-- Previous Page --}}
        @if ($paginator->onFirstPage())
            <span class="page-link disabled"><i class="fas fa-chevron-left"></i></span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="page-link">
                <i class="fas fa-chevron-left"></i>
            </a>
        @endif

        {{-- Page Numbers --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="page-link disabled">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    <a href="{{ $url }}" class="page-link {{ $page == $paginator->currentPage() ? 'active' : '' }}">
                        {{ $page }}
                    </a>
                @endforeach
            @endif
        @endforeach

        {{-- Next Page --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="page-link">
                <i class="fas fa-chevron-right"></i>
            </a>
        @else
            <span class="page-link disabled"><i class="fas fa-chevron-right"></i></span>
        @endif
    </div>
@endif