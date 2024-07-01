<div>
    <div class="bg-gray-800 border border-gray-900 shadow-lg  rounded-3xl p-4 m-4">
        <div class="flex-none sm:flex">
            <div class="sm:w-32 sm:h-32 w-full h-full relative sm:mb-0 mb-3">
                <a href="{{ $watchlist->link }}">
                    <img src="{{ $watchlist->image }}" alt="aji" class="w-full h-full object-cover rounded-2xl">
                </a>
            </div>
            <div class="flex-auto sm:ml-5 justify-evenly">
                <div class="flex items-center sm:justify-between justify-center sm:mt-2">
                    <div class="flex items-center">
                        <div class="flex flex-col">
                            <div class="w-full flex-none text-lg text-gray-200 font-bold leading-none">
                                <a href={{ $watchlist->link }}
                                    class="underline hover:text-blue-400 transition duration-200">
                                    {{ $watchlist->name }}
                                </a>
                            </div>
                            <div class="flex-auto text-gray-400 my-1">
                                <span class="mr-3 ">{{ ucfirst($watchlist->mediaType->type) }}</span><span
                                    class="mr-3 border-r border-gray-600  max-h-0"></span><span>{{ $watchlist->tmdb_id }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-row items-center sm:justify-start justify-center mt-1">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                            class="h-5 w-5 text-yellow-400">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                            </path>
                        </svg>
                        {{ number_format($watchlist->rate, 1) }}
                    </div>
                </div>
                <div class="flex sm:flex-row flex-col items-center gap-4 pt-2 text-sm text-gray-400">
                    <div
                        class="flex-1 inline-flex items-center gap-0.5 {{ $watchlist->watched ? 'text-green-400' : 'text-red-400' }}">
                        <button title="Mark as {{ $watchlist->watched ? 'not watched' : 'watched' }}"
                            wire:click="changeWatch">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <p>
                            {{ $watchlist->watched ? 'Watched' : 'Not watched' }}
                        </p>
                    </div>
                    <div class="flex sm:flex-row flex-col gap-2 sm:w-auto w-full">
                        <button
                            class="border border-gray-700 rounded-full p-2 tracking-wider hover:border-red-400 hover:text-red-400 transition ease-in duration-300 sm:w-auto w-full"
                            wire:click="remove">
                            Remove
                        </button>
                        <button title="Mark as {{ $watchlist->watched ? 'not watched' : 'watched' }}"
                            wire:click="changeWatch"
                            class="border border-gray-700 rounded-full p-2 tracking-wider transition ease-in duration-300 {{ $watchlist->watched ? 'hover:border-blue-400 hover:text-blue-400' : 'hover:border-green-400 hover:text-green-400' }} sm:w-auto w-full">
                            Mark as {{ $watchlist->watched ? 'not watched' : 'watched' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
