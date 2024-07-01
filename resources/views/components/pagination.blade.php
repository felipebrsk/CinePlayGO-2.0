@if ($paginator->hasPages())
    <nav>
        <ul class="flex justify-end">
            @if (!$paginator->onFirstPage())
                <li>
                    <a class="mx-1 flex h-9 w-9 items-center justify-center rounded-full border border-blue-gray-100 bg-transparent p-0 text-sm text-blue-gray-500 transition duration-150 ease-in-out hover:bg-light-300"
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
                                    class="mx-1 flex h-9 w-9 items-center justify-center rounded-full bg-gradient-to-tr from-pink-600 to-pink-400 p-0 text-sm text-white shadow-md shadow-pink-500/20">{{ $page }}</span>
                            </li>
                        @elseif (
                            $page == 1 ||
                                $page == $paginator->lastPage() ||
                                ($page >= $paginator->currentPage() - 1 && $page <= $paginator->currentPage() + 1))
                            <li>
                                <a class="mx-1 flex h-9 w-9 items-center justify-center rounded-full border border-blue-gray-100 bg-transparent p-0 text-sm text-blue-gray-500 transition duration-150 ease-in-out hover:bg-light-300"
                                    href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @elseif ($page == $paginator->currentPage() - 2 || $page == $paginator->currentPage() + 2)
                            <li>
                                <span
                                    class="mx-1 flex h-9 w-9 items-center justify-center rounded-full border border-blue-gray-100 bg-transparent p-0 text-sm text-blue-gray-500 pointer-events-none">...</span>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li>
                    <a class="mx-1 flex h-9 w-9 items-center justify-center rounded-full border border-blue-gray-100 bg-transparent p-0 text-sm text-blue-gray-500 transition duration-150 ease-in-out hover:bg-light-300"
                        href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
@endif
