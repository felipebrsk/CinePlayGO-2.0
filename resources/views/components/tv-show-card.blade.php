<div class="w-full sm:px-0 px-2">
    <a href="{{ route('tv-shows.show', $tvShow['id']) }}">
        <img alt="movie poster" src="{{ $tvShow['poster_path'] }}"
            class="object-cover hover:opacity-75 transition-all ease-in-out duration-150 rounded-md w-full h-[25rem]">
    </a>
    <div class="mt-2 text-gray-400 text-sm">
        <a href="{{ route('tv-shows.show', $tvShow['id']) }}"
            class="text-lg mt-2 text-gray-200 hover:text-gray-300 transition duration-200 break-words max-w-[0.1rem]">{{ $tvShow['title'] }}</a>
        <div class="flex items-center mt-1 gap-1">
            <svg class="fill-current text-orange-500 w-4" viewBox="0 0 24 24">
                <g data-name="Layer 2">
                    <path
                        d="M17.56 21a1 1 0 01-.46-.11L12 18.22l-5.1 2.67a1 1 0 01-1.45-1.06l1-5.63-4.12-4a1 1 0 01-.25-1 1 1 0 01.81-.68l5.7-.83 2.51-5.13a1 1 0 011.8 0l2.54 5.12 5.7.83a1 1 0 01.81.68 1 1 0 01-.25 1l-4.12 4 1 5.63a1 1 0 01-.4 1 1 1 0 01-.62.18z"
                        data-name="star" />
                </g>
            </svg>
            <span>{{ $tvShow['vote_average'] }} </span>
            <span> |</span>
            <span>{{ $tvShow['release_date'] }}</span>
        </div>
        <p>
            {{ $tvShow['genres'] }}
        </p>
    </div>
</div>
