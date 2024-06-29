<div x-data="{ trailerOpen: false }">
    @if (count($videos) > 0)
        <button @click="trailerOpen = true"
            class="mt-2 flex items-center gap-1 bg-orange-500 text-white rounded font-semibold p-4 hover:bg-orange-600 transition ease-in-out duration-150 w-full">
            <svg class="w-6 fill-current" viewBox="0 0 24 24">
                <path d="M0 0h24v24H0z" fill="none" />
                <path
                    d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" />
            </svg>
            <span>Watch trailer</span>
        </button>

        <template x-if="trailerOpen">
            <div style="background-color: rgba(0, 0, 0, .5);"
                class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto">
                <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                    <div class="bg-gray-900 rounded">
                        <div class="flex justify-end pr-4 pt-2">
                            <button @click="trailerOpen = false" @keydown.escape.window="trailerOpen = false"
                                class="text-3xl leading-none hover:text-gray-300">&times;
                            </button>
                        </div>
                        <div class="p-8">
                            <div class="overflow-hidden relative" style="padding-top: 56.25%">
                                <iframe class="absolute top-0 left-0 w-full h-full"
                                    src="https://www.youtube.com/embed/{{ $videos[0]['key'] }}" style="border:0;"
                                    allow="autoplay; encrypted-media" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    @endif
</div>
