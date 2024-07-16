<header>
    <nav class="border-b border-gray-800">
        <div class="container mx-auto flex flex-col md:flex-row items-center justify-between px-4 py-6">
            <ul class="flex items-center flex-col md:flex-row gap-6">
                <li>
                    @include('components.logo')
                </li>
                <li>
                    <a href="{{ route('home') }}"
                        class="{{ Route::currentRouteName() == 'home' ? 'text-orange-600' : '' }} hover:text-gray-300 transition duration-200">
                        Home
                    </a>
                </li>
                <li>
                    <a href="{{ route('movies.index') }}"
                        class="{{ Str::startsWith(Route::currentRouteName(), 'movies') ? 'text-orange-600' : '' }} hover:text-gray-300 transition duration-200">
                        Movies
                    </a>
                </li>
                <li>
                    <a href="{{ route('tv-shows.index') }}"
                        class="{{ Str::startsWith(Route::currentRouteName(), 'tv-shows') ? 'text-orange-600' : '' }} hover:text-gray-300 transition duration-200">
                        TV Shows
                    </a>
                </li>
                <li>
                    <a href="{{ route('actors.index') }}"
                        class="{{ Str::startsWith(Route::currentRouteName(), 'actors') ? 'text-orange-600' : '' }} hover:text-gray-300 transition duration-200">
                        Actors
                    </a>
                </li>
            </ul>
            <div class="items-center flex-col md:flex-row gap-4 flex">
                <livewire:search-dropdown />
                <div x-data="{ profileOpen: false }" @click.away="profileOpen = false" class="relative md:block hidden">
                    <button @click="profileOpen = !profileOpen"
                        class="flex items-center gap-2 outline-none focus:outline-none">
                        <svg x-show="!profileOpen"
                            class="w-8 h-8 text-gray-500 cursor-pointer transition-transform duration-200 transform hover:scale-110"
                            fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg x-show="profileOpen"
                            class="w-8 h-8 text-gray-500 cursor-pointer transition-transform duration-200 transform hover:scale-110"
                            fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                    <div class="z-50 absolute bg-gray-800 text-sm rounded-lg shadow-lg right-0 w-48 mt-2"
                        x-show.transition.opacity="profileOpen"
                        x-transition:enter="transition-opacity ease-out duration-300"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        x-transition:leave="transition-opacity ease-in duration-300"
                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                        @auth
                            <div class="flex items-center justify-center p-4 gap-2 border-b border-gray-700">
                                <img src="{{ s3Service()->getPath(auth()->user()->picture) ?? 'https://static.vecteezy.com/system/resources/thumbnails/005/129/844/small_2x/profile-user-icon-isolated-on-white-background-eps10-free-vector.jpg' }}"
                                    alt="Profile picture"
                                    class="rounded-full w-10 h-10 object-cover border-2 border-yellow-500" />
                                <span class="text-gray-300">Welcome, <strong>{{ auth()->user()->name }}</strong>!</span>
                            </div>
                            <ul>
                                <li>
                                    <a href="{{ route('profiles.show') }}"
                                        class="hover:bg-gray-700 px-4 py-3 flex items-center transition ease-in-out duration-150 w-full text-left text-gray-300">
                                        Profile
                                    </a>
                                </li>
                                <li class="border-t border-gray-700 hover:bg-gray-700">
                                    <a href="{{ route('watchlists.index') }}"
                                        class="transition ease-in-out duration-150 w-full text-left px-4 py-3 flex items-center justify-between text-gray-300">
                                        My list
                                        <span
                                            class="bg-yellow-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">
                                            {{ auth()->user()->watchlists()->count() }}
                                        </span>
                                    </a>
                                </li>
                                <li class="border-t border-gray-700 hover:bg-gray-700">
                                    <a href="{{ route('carts.index') }}"
                                        class="transition ease-in-out duration-150 w-full text-left px-4 py-3 flex items-center justify-between text-gray-300">
                                        My cart
                                        <span
                                            class="bg-yellow-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs"
                                            id="cart-count">
                                            {{ cartService()->count() }}
                                        </span>
                                    </a>
                                </li>
                                <li class="border-t border-gray-700">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="hover:bg-gray-700 px-4 py-3 flex items-center transition ease-in-out duration-150 w-full text-left text-gray-300">
                                            Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        @else
                            <ul>
                                <li>
                                    <a href="{{ route('login') }}"
                                        class="hover:bg-gray-700 px-4 py-3 flex items-center transition ease-in-out duration-150 text-gray-300">
                                        Login
                                    </a>
                                </li>
                                <li class="border-t border-gray-700">
                                    <a href="{{ route('register') }}"
                                        class="hover:bg-gray-700 px-4 py-3 flex items-center transition ease-in-out duration-150 text-gray-300">
                                        Register
                                    </a>
                                </li>
                            </ul>
                        @endauth
                    </div>
                </div>
            </div>

            <div x-data="{ profileOpen: false, lastScrollPos: 0, scrollThreshold: 100 }" @keydown.escape.window="profileOpen = false"
                @scroll.window="lastScrollPos = window.scrollY"
                class="fixed top-0 right-0 md:hidden flex items-center mr-4 mt-4"
                :class="{ 'hidden': lastScrollPos > scrollThreshold }">
                <div x-data="{ profileOpen: false }" @click.away="profileOpen = false" class="relative">
                    <button @click="profileOpen = !profileOpen"
                        class="flex items-center gap-2 outline-none focus:outline-none">
                        <svg x-show="!profileOpen"
                            class="w-8 h-8 text-gray-500 cursor-pointer transition-transform duration-200 transform hover:scale-110"
                            fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg x-show="profileOpen"
                            class="w-8 h-8 text-gray-500 cursor-pointer transition-transform duration-200 transform hover:scale-110"
                            fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                    <div class="z-50 absolute bg-gray-800 text-sm rounded-lg shadow-lg right-0 w-48 mt-2"
                        x-show.transition.opacity="profileOpen"
                        x-transition:enter="transition-opacity ease-out duration-300"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        x-transition:leave="transition-opacity ease-in duration-300"
                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                        @auth
                            <div class="flex items-center justify-center p-4 gap-2 border-b border-gray-700">
                                <img src="{{ s3Service()->getPath(auth()->user()->picture) ?? 'https://static.vecteezy.com/system/resources/thumbnails/005/129/844/small_2x/profile-user-icon-isolated-on-white-background-eps10-free-vector.jpg' }}"
                                    alt="Profile picture"
                                    class="rounded-full w-10 h-10 object-cover border-2 border-yellow-500" />
                                <span class="text-gray-300">Welcome, <strong>{{ auth()->user()->name }}</strong>!</span>
                            </div>
                            <ul>
                                <li>
                                    <a href="{{ route('profiles.show') }}"
                                        class="hover:bg-gray-700 px-4 py-3 flex items-center transition ease-in-out duration-150 w-full text-left text-gray-300">
                                        Profile
                                    </a>
                                </li>
                                <li class="border-t border-gray-700 hover:bg-gray-700">
                                    <a href="{{ route('watchlists.index') }}"
                                        class="transition ease-in-out duration-150 w-full text-left px-4 py-3 flex items-center justify-between text-gray-300">
                                        My list
                                        <span
                                            class="bg-yellow-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">
                                            {{ auth()->user()->watchlists()->count() }}
                                        </span>
                                    </a>
                                </li>
                                <li class="border-t border-gray-700 hover:bg-gray-700">
                                    <a href="{{ route('carts.index') }}"
                                        class="transition ease-in-out duration-150 w-full text-left px-4 py-3 flex items-center justify-between text-gray-300">
                                        My cart
                                        <span
                                            class="bg-yellow-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs"
                                            id="cart-count">
                                            {{ cartService()->count() }}
                                        </span>
                                    </a>
                                </li>
                                <li class="border-t border-gray-700">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="hover:bg-gray-700 px-4 py-3 flex items-center transition ease-in-out duration-150 w-full text-left text-gray-300">
                                            Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        @else
                            <ul>
                                <li>
                                    <a href="{{ route('login') }}"
                                        class="hover:bg-gray-700 px-4 py-3 flex items-center transition ease-in-out duration-150 text-gray-300">
                                        Login
                                    </a>
                                </li>
                                <li class="border-t border-gray-700">
                                    <a href="{{ route('register') }}"
                                        class="hover:bg-gray-700 px-4 py-3 flex items-center transition ease-in-out duration-150 text-gray-300">
                                        Register
                                    </a>
                                </li>
                            </ul>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

@push('scripts')
    <script>
        Livewire.on('cartCount', count => {
            document.getElementById('cart-count').innerText = count[0].count;
        });
    </script>
@endpush
