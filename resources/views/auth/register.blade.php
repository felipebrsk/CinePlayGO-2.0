@extends('layouts.auth', ['title' => 'Register'])

@section('content')
    <div class="auth-container">
        <div class="bg-gray-800 text-white shadow-lg rounded-lg overflow-hidden sm:flex w-3/4 max-w-4xl">
            <div class="sm:w-1/2 bg-gray-900 p-8 text-center">
                <div class="flex flex-col items-center justify-center h-full gap-2">
                    @include('components.logo')
                    <h2 class="text-2xl font-semibold">Welcome to CinePlayGO</h2>
                    <p class="text-center">Experience the best movies with us.</p>
                    <div class="flex sm:flex-row flex-col gap-4">
                        <a href="#" class="text-blue-500 hover:text-blue-700">Facebook</a>
                        <a href="#" class="text-blue-300 hover:text-blue-500">Twitter</a>
                        <a href="#" class="text-red-500 hover:text-red-700">Google</a>
                    </div>
                </div>
            </div>
            <div class="sm:w-1/2 p-8">
                <h2 class="text-2xl font-semibold mb-4">Register</h2>
                <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-4">
                    @csrf
                    <div>
                        <label for="name" class="block text-gray-400">Name</label>
                        <input type="text" id="name" name="name"
                            class="w-full px-4 py-2 border bg-transparent rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                    </div>
                    <div>
                        <label for="email" class="block text-gray-400">Email</label>
                        <input type="email" id="email" name="email"
                            class="w-full px-4 py-2 border bg-transparent rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                    </div>
                    <div>
                        <label for="username" class="block text-gray-400">Username</label>
                        <input type="text" id="username" name="username"
                            class="w-full px-4 py-2 border bg-transparent rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                    </div>
                    <div class="relative">
                        <label for="password" class="block text-gray-400">Password</label>
                        <input type="password" id="password" name="password"
                            class="w-full px-4 py-2 border bg-transparent rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                        <span id="toggle-password"
                            class="absolute inset-y-0 right-2 flex items-center text-gray-600 cursor-pointer justify-center mt-6">👁️</span>
                    </div>
                    <div class="relative">
                        <label for="password_confirmation" class="block text-gray-400">Password confirmation</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="w-full px-4 py-2 border bg-transparent rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                        <span id="toggle-password"
                            class="absolute inset-y-0 right-2 flex items-center text-gray-600 cursor-pointer justify-center mt-6">👁️</span>
                    </div>
                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-200">Register</button>
                </form>
                <div class="mt-4 text-center">
                    <a href="{{ route('login') }}" class="text-sm text-blue-600 hover:underline">
                        Already have an account? Login
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
