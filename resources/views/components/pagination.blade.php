@if ($paginator->hasPages())
    <nav>
        <ul class="flex justify-end">
            @if (!$paginator->onFirstPage())
                <li>
                    <a class="mx-1 flex h-9 w-9 items-center justify-center rounded-full border border-orange-100 hover:border-orange-400 hover:text-orange-400 bg-transparent p-0 text-sm transition duration-150 ease-in-out"
                        href="{{ $paginator->previousPageUrl() }}" aria-label="Previous">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                </li>
            @endif

            @foreach ($elements as $element)
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <span
                                    class="mx-1 flex h-9 w-9 items-center justify-center rounded-full bg-gradient-to-tr from-orange-600 to-orange-400 p-0 text-sm text-white shadow-md shadow-orange-500/20 pointer-events-none">{{ $page }}</span>
                            </li>
                        @elseif (
                            $page == 1 ||
                                $page == $paginator->lastPage() ||
                                ($page >= $paginator->currentPage() - 1 && $page <= $paginator->currentPage() + 1))
                            <li>
                                <a class="mx-1 flex h-9 w-9 items-center justify-center rounded-full border border-orange-100 hover:border-orange-400 hover:text-orange-400 bg-transparent p-0 text-sm transition duration-150 ease-in-out"
                                    href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @elseif ($page == $paginator->currentPage() - 2 || $page == $paginator->currentPage() + 2)
                            <li>
                                <span
                                    class="mx-1 flex h-9 w-9 items-center justify-center rounded-full border bg-transparent p-0 text-sm pointer-events-none">...</span>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li>
                    <a class="mx-1 flex h-9 w-9 items-center justify-center rounded-full border border-orange-100 hover:border-orange-400 hover:text-orange-400 bg-transparent p-0 text-sm transition duration-150 ease-in-out"
                        href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
@endif
