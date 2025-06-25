@if ($paginator->hasPages())
    <nav>
        <ul class="pagination justify-content-center gap-2">

            {{-- Previous Page Link --}}
            @if (!$paginator->onFirstPage())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                        style="width: 40px; height: 40px; font-size: 1.25rem; border-radius: 50%; border: 2px solid #ffc107;
                              display: flex; align-items: center; justify-content: center; color: black;">
                        <i class="bi bi-chevron-left"></i>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item disabled">
                        <span class="page-link"
                            style="width: 40px; height: 40px; font-size: 1rem; border-radius: 50%; border: 2px solid #ffc107;
                                     display: flex; align-items: center; justify-content: center;">
                            {{ $element }}
                        </span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page">
                                <span class="page-link fw-bold"
                                    style="width: 40px; height: 40px; font-size: 1rem; border-radius: 50%; border: 2px solid #ffc107;
                                             background-color: white; color: black;
                                             display: flex; align-items: center; justify-content: center;">
                                    {{ $page }}
                                </span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}"
                                    style="width: 40px; height: 40px; font-size: 1rem; border-radius: 50%; border: 2px solid #ffc107;
                                          color: black; display: flex; align-items: center; justify-content: center;">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"
                        style="width: 40px; height: 40px; font-size: 1.25rem; border-radius: 50%; border: 2px solid #ffc107;
                              display: flex; align-items: center; justify-content: center; color: black;">
                        <i class="bi bi-chevron-right"></i>
                    </a>
                </li>
            @endif

        </ul>
    </nav>
@endif
