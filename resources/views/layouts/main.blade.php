<!doctype html>
<html lang="en_US">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>CinePlay GO | {{ $title }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @livewireStyles
</head>

<body class="font-sans bg-gray-900 text-white wrapper" x-data="{ lastScrollPos: 0, scrollThreshold: 50, showScrollToTop: false }"
    @scroll.window="lastScrollPos = window.scrollY; showScrollToTop = (lastScrollPos > scrollThreshold)">
    @include('components.header')
    <main>
        <section class="hero w-full bg-cover bg-center h-96"
            style="background-image: url('{{ asset('assets/imgs/hero.png') }}');">
            <div class="h-full flex items-center justify-center text-center">
                <div class="text-white">
                    <h1 class="text-4xl md:text-6xl font-bold mb-4">Welcome to CinePlayGO 2.0</h1>
                    <p class="text-lg md:text-xl mb-8">Discover your next favorite movie or TV show</p>
                </div>
            </div>
        </section>
        @yield('content')
        <button @click="window.scrollTo({top: 0, behavior: 'smooth'})"
            class="flex justify-center items-center fixed w-12 h-12 bottom-4 right-4 bg-transparent border border-gray-700 text-white p-3 rounded-full shadow-lg hover:bg-orange-400 transition duration-200"
            x-show="showScrollToTop" x-transition:enter="transition-opacity ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-in duration-300" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">
            &#8679;
        </button>
    </main>
    @include('components.footer')
    @livewireScripts
    @stack('scripts')
    @livewire('toast')
</body>

</html>
