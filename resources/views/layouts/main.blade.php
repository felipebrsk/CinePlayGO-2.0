<!doctype html>
<html lang="en_US">

<head>
    <meta charset="UTF-8">
    <title>CinePlay GO</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
</head>

<body class="font-sans bg-gray-900 text-white wrapper">
    @include('components.header')
    <main>
        @yield('content')
    </main>
    @livewireScripts
    @include('components.footer')
</body>

</html>
