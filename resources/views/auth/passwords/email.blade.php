@extends('layouts.auth', ['title' => 'Forgot Password'])

@section('content')
    <div class="auth-container">
        <div class="bg-gray-800 text-white shadow-lg rounded-lg overflow-hidden sm:flex w-3/4 max-w-4xl">
            <div class="sm:w-1/2 bg-gray-900 p-8">
                <div class="flex flex-col items-center justify-center h-full gap-2">
                    @include('components.logo')
                    <h2 class="text-2xl font-semibold">Welcome to CinePlayGO</h2>
                    <p class="text-center">Experience the best movies with us.</p>
                    <div>
                        <ul class="flex gap-4">
                            <li
                                class="p-1 rounded-full border border-gray-700 hover:bg-blue-500 hover:text-white transition-colors duration-300 hover:border-none group">
                                <a href="#" title="Login with Facebook"
                                    class="flex items-center justify-center w-8 h-8 text-blue-600 group-hover:text-white">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </li>
                            <li
                                class="p-1 rounded-full border border-gray-700 hover:bg-red-500 hover:text-white transition-colors duration-300 hover:border-none group">
                                <a href="#" title="Login with Google"
                                    class="flex items-center justify-center w-8 h-8 text-red-600 group-hover:text-white">
                                    <i class="fab fa-google"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="sm:w-1/2 p-8">
                <h2 class="text-2xl font-semibold mb-4">Password Forget</h2>
                <form method="POST" action="{{ route('password.email') }}" class="flex flex-col gap-4">
                    @csrf
                    <div>
                        <label for="email" class="block text-gray-400">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            class="w-full px-4 py-2 border bg-transparent rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                        @error('email')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                        Send reset link
                    </button>
                </form>
                <div class="mt-4 text-center">
                    <a href="{{ route('login') }}" class="text-sm text-blue-600 hover:underline">
                        Back to Login
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
