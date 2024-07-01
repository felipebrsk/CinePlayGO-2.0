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
                <div x-data="{ profileOpen: false }" @keydown.escape.window="profileOpen = false"
                    class="relative w-full md:block hidden">
                    <button @click="profileOpen = !profileOpen" class="flex items-center gap-2 outline-none">
                        <svg x-show="!profileOpen" class="w-8 h-8 text-gray-500 cursor-pointer" fill="none"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg x-show="profileOpen" class="w-8 h-8 text-gray-500 cursor-pointer" fill="none"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                    <div class="z-50 absolute bg-gray-800 text-sm rounded shadow-lg right-0 w-48"
                        x-show.transition.opacity="profileOpen"
                        x-transition:enter="transition-opacity ease-out duration-300"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        x-transition:leave="transition-opacity ease-in duration-300"
                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                        @click.away="profileOpen = false">
                        @auth
                            <div class="flex items-center justify-center p-2 gap-2 border-b border-gray-700">
                                <img src="https://placehold.co/600x400/EEE/31343C" alt="Foto de perfil"
                                    class="rounded-full w-8 h-8 object-cover" />
                                <span>
                                    Welcome, {{ auth()->user()->name }}!
                                </span>
                            </div>
                        @endauth
                        <ul>
                            @auth
                                <li>
                                    <a href="#"
                                        class="hover:bg-gray-700 px-4 py-3 flex items-center transition ease-in-out duration-150 w-full text-left">
                                        Profile
                                    </a>
                                </li>
                                <li class="border-t border-gray-700">
                                    <a href="{{ route('watchlists.index') }}"
                                        class="hover:bg-gray-700 px-4 py-3 flex items-center transition ease-in-out duration-150 w-full text-left">
                                        My list
                                    </a>
                                </li>
                                <li class="border-t border-gray-700">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="hover:bg-gray-700 px-4 py-3 flex items-center transition ease-in-out duration-150 w-full text-left">
                                            Logout
                                        </button>
                                    </form>
                                </li>
                            @else
                                <li>
                                    <a href={{ route('login') }}
                                        class="hover:bg-gray-700 px-4 py-3 flex items-center transition ease-in-out duration-150">
                                        Login
                                    </a>
                                </li>
                                <li class="border-t border-gray-700">
                                    <a href="{{ route('register') }}"
                                        class="hover:bg-gray-700 px-4 py-3 flex items-center transition ease-in-out duration-150">
                                        Register
                                    </a>
                                </li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </div>

            <div x-data="{ profileOpen: false, lastScrollPos: 0, scrollThreshold: 100 }" @keydown.escape.window="profileOpen = false"
                @scroll.window="lastScrollPos = window.scrollY"
                class="fixed top-0 right-0 md:hidden flex items-center mr-4 mt-4"
                :class="{ 'hidden': lastScrollPos > scrollThreshold }">
                <button @click="profileOpen = !profileOpen" class="flex items-center gap-2 outline-none">
                    <svg x-show="!profileOpen" class="w-8 h-8 text-gray-500 cursor-pointer" fill="none"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg x-show="profileOpen" class="w-8 h-8 text-gray-500 cursor-pointer" fill="none"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
                <div class="z-50 absolute bg-gray-800 text-sm rounded shadow-lg right-0 sm:w-48 w-32 mt-44 md:bg-transparent md:shadow-none"
                    x-show.transition.opacity="profileOpen"
                    x-transition:enter="transition-opacity ease-out duration-300" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-in duration-300"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    @click.away="profileOpen = false">
                    @auth
                        <div class="flex items-center justify-center p-2 gap-2 border-b border-gray-700">
                            <img src="https://placehold.co/600x400/EEE/31343C" alt="Foto de perfil"
                                class="rounded-full w-8 h-8 object-cover" />
                            <span>
                                Welcome, {{ auth()->user()->name }}!
                            </span>
                        </div>
                    @endauth
                    <ul>
                        @auth
                            <li>
                                <a href="#"
                                    class="hover:bg-gray-700 px-4 py-3 flex items-center transition ease-in-out duration-150 w-full text-left">
                                    Profile
                                </a>
                            </li>
                            <li class="border-t border-gray-700">
                                <a href="{{ route('watchlists.index') }}"
                                    class="hover:bg-gray-700 px-4 py-3 flex items-center transition ease-in-out duration-150 w-full text-left">
                                    My list
                                </a>
                            </li>
                            <li class="border-t border-gray-700">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="hover:bg-gray-700 px-4 py-3 flex items-center transition ease-in-out duration-150 w-full text-left">
                                        Logout
                                    </button>
                                </form>
                            </li>
                        @else
                            <li>
                                <a href={{ route('login') }}
                                    class="hover:bg-gray-700 px-4 py-3 flex items-center transition ease-in-out duration-150">
                                    Login
                                </a>
                            </li>
                            <li class="border-t border-gray-700">
                                <a href="{{ route('register') }}"
                                    class="hover:bg-gray-700 px-4 py-3 flex items-center transition ease-in-out duration-150">
                                    Register
                                </a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
