<div class="w-full bg-gray-800 rounded-lg shadow-md p-6">
    <div class="flex items-center space-x-4">
        <img class="w-12 h-12 rounded-full"
            src="https://www.themoviedb.org/t/p/w64_and_h64_face/{{ $review['author_details']['avatar_path'] }}"
            alt="{{ $review['author_details']['username'] }} Avatar" />
        <div>
            <h3 class="text-lg font-semibold text-white">{{ $review['author'] }}</h3>
            <div class="flex items-center">
                <svg class="fill-current text-orange-500 w-4" viewBox="0 0 24 24">
                    <path
                        d="M17.56 21a1 1 0 01-.46-.11L12 18.22l-5.1 2.67a1 1 0 01-1.45-1.06l1-5.63-4.12-4a1 1 0 01-.25-1 1 1 0 01.81-.68l5.7-.83 2.51-5.13a1 1 0 011.8 0l2.54 5.12 5.7.83a1 1 0 01.81.68 1 1 0 01-.25 1l-4.12 4 1 5.63a1 1 0 01-.4 1 1 0 01-.62.18z"
                        data-name="star" />
                </svg>
                <span class="text-white ml-2">{{ $review['author_details']['rating'] ?? '-' }}</span>
            </div>
        </div>
    </div>
    <div class="mt-4 text-gray-400">
        <p class="break-words">{!! \Illuminate\Support\Str::limit($review['content'], 150, ' (...)') !!}</p>
    </div>
    <div class="mt-4">
        <a href="{{ $review['url'] }}" target="_blank" class="text-blue-400 hover:underline">
            Read more
        </a>
    </div>
    <div class="mt-2 text-gray-500 text-sm">
        <p>
            Reviewed on
            {{ \Illuminate\Support\Carbon::parse($review['created_at'])->toDateString() }}
        </p>
    </div>
</div>
