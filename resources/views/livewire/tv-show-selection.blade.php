<div class="p-4">
    <div class="mb-4">
        <div class="flex items-center sm:flex-row flex-col w-full gap-4">
            <select wire:model.live="selectedGenre"
                class="w-auto p-2 border bg-gray-700 border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                <option value="">All Genres</option>
                @foreach ($genres as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>

            <select wire:model.live="selectedRank"
                class="w-auto p-2 border bg-gray-700 border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                @foreach ($ranks as $value => $label)
                    <option value="{{ $value }}">{{ $label }}</option>
                @endforeach
            </select>

            <select wire:model.live="loadType"
                class="w-auto p-2 border bg-gray-700 border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                @foreach ($loadTypes as $value => $label)
                    <option value="{{ $value }}">{{ $label }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <section class="border-t border-gray-700">
        <h2
            class="uppercase tracking-wider text-orange-500 xl:text-4xl lg:text-2xl md:text-xl sm:text-lg text-base font-semibold text-center mt-4">
            {{ $ranks[$this->selectedRank] }} tv shows
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 mt-4"
            id="tv-shows-grid">
            @foreach ($tvShows as $tvShow)
                <div class="flex justify-center">
                    <x-tv-show-card :tvShow="$tvShow" />
                </div>
            @endforeach

            @if ($loadType === 'scroll')
                <div id="load-more-trigger" wire:loading.class="opacity-0"></div>
            @endif

            <div wire:loading
                class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
                <div class="flex items-center justify-center h-full">
                    <div class="flex justify-center items-center flex-col gap-2">
                        <svg class="animate-spin h-16 w-16 text-gray-200 dark:text-gray-600 fill-blue-600"
                            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                fill="currentColor" />
                            <path
                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                fill="currentFill" />
                        </svg>
                        <span class="text-gray-200">Loading...</span>
                    </div>
                </div>
            </div>
        </div>

        @if ($loadType === 'click')
            <button wire:click="loadMore" wire:loading.attr="disabled"
                class="flex mx-auto justify-center bg-transparent border border-gray-700 text-white rounded
                font-semibold p-4 hover:bg-orange-400 transition ease-in-out duration-150 md:w-auto w-full mt-8">
                <span>Load more...</span>
            </button>
        @endif
    </section>
</div>

@push('scripts')
    <script>
        let debounceTimer;

        window.addEventListener('scroll', function() {
            if (debounceTimer) {
                clearTimeout(debounceTimer);
            }

            debounceTimer = setTimeout(function() {
                const loadMoreTrigger = document.getElementById('load-more-trigger');
                const moviesGrid = document.getElementById('tv-shows-grid');

                if (loadMoreTrigger && moviesGrid && (loadMoreTrigger.getBoundingClientRect().top <= window
                        .innerHeight)) {
                    @this.call('loadMore');
                }
            }, 500);
        });
    </script>
@endpush
