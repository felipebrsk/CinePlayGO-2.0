<div x-data="{ watchOpen: false }">
    @if (count($providers) > 0 && isset($providers['US']))
        <button @click="watchOpen = true"
            class="mt-2 flex items-center gap-1 bg-orange-500 text-white rounded font-semibold p-4 hover:bg-orange-600 transition ease-in-out duration-150 w-full">
            <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                <path d="M0 0h24v24H0z" fill="none" />
                <path
                    d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" />
            </svg>
            <span>Watch Providers</span>
        </button>

        <template x-if="watchOpen">
            <div style="background-color: rgba(0, 0, 0, .5);"
                class="fixed inset-0 flex items-center justify-center z-50 overflow-y-auto">
                <div class="bg-gray-900 rounded-lg overflow-hidden shadow-lg w-full max-w-3xl mx-auto">
                    <div class="flex justify-end p-4">
                        <button @click="watchOpen = false" @keydown.escape.window="watchOpen = false"
                            class="text-3xl leading-none hover:text-gray-300">&times;
                        </button>
                    </div>
                    <div class="px-8 pb-8">
                        @if (isset($providers['US']['rent']))
                            <h3 class="text-lg font-semibold text-white my-4 pl-14">
                                Available for Rent
                            </h3>
                            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                                @foreach ($providers['US']['rent'] as $rent)
                                    <div class="flex flex-col items-center">
                                        <a href="{{ $providers['US']['link'] }}" target="_blank">
                                            <img src="{{ 'https://image.tmdb.org/t/p/original/' . $rent['logo_path'] }}"
                                                alt="{{ $rent['provider_name'] . ' logo' }}"
                                                class="w-12 h-12 mb-2 object-cover rounded-full">
                                        </a>
                                        <a href="{{ $providers['US']['link'] }}" target="_blank"
                                            class="text-white text-sm">
                                            {{ $rent['provider_name'] }}
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        @if (isset($providers['US']['buy']))
                            <h3 class="text-lg font-semibold text-white my-4 pl-14">
                                Available to Buy
                            </h3>
                            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                                @foreach ($providers['US']['buy'] as $buy)
                                    <div class="flex flex-col items-center">
                                        <a href="{{ $providers['US']['link'] }}" target="_blank">
                                            <img src="{{ 'https://image.tmdb.org/t/p/original/' . $buy['logo_path'] }}"
                                                alt="{{ $buy['provider_name'] . ' logo' }}"
                                                class="w-12 h-12 mb-2 object-cover rounded-full">
                                        </a>
                                        <a href="{{ $providers['US']['link'] }}" target="_blank">
                                            <span class="text-white text-sm">
                                                {{ $buy['provider_name'] }}
                                            </span>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        @if (isset($providers['US']['flatrate']))
                            <h3 class="text-lg font-semibold text-white my-4 pl-14">
                                Available on Streaming
                            </h3>
                            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                                @foreach ($providers['US']['flatrate'] as $flatrate)
                                    <div class="flex flex-col items-center">
                                        <a href="{{ $providers['US']['link'] }}" target="_blank">
                                            <img src="{{ 'https://image.tmdb.org/t/p/original/' . $flatrate['logo_path'] }}"
                                                alt="{{ $flatrate['provider_name'] . ' logo' }}"
                                                class="w-12 h-12 mb-2 object-cover rounded-full">
                                        </a>
                                        <a href="{{ $providers['US']['link'] }}" target="_blank">
                                            <span class="text-white text-sm">
                                                {{ $flatrate['provider_name'] }}
                                            </span>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </template>
    @endif
</div>
