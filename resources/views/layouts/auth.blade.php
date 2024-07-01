<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CinePlayGO 2.0 | {{ $title }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            background-color: black;
        }

        .auth-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .star-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }

        .star {
            position: absolute;
            width: 0.2rem;
            height: 0.2rem;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 50%;
            animation: falling-stars linear infinite, shimmer 1s infinite alternate;
        }

        @keyframes falling-stars {
            0% {
                transform: translateY(-100vh) rotateZ(0deg);
            }

            100% {
                transform: translateY(100vh) rotateZ(360deg);
            }
        }
    </style>
</head>

<body>
    <div class="star-container"></div>

    <main>
        @yield('content')
    </main>

    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src={{ asset('assets/js/main.js') }}></script>
</body>

</html>
