@extends('layouts.main', ['title' => 'My profile'])

@section('content')
    <section class="container mx-auto p-4 text-white">
        <x-alert />
        <div class="flex sm:flex-row flex-col gap-6">
            <x-profile-sidebar />
            <div class="sm:w-3/4 w-full bg-gray-800 p-6 rounded-lg shadow-lg">
                <div class="flex items-center sm:flex-row flex-col gap-4">
                    <img src="{{ s3Service()->getPath($user->picture) ?? 'https://static.vecteezy.com/system/resources/thumbnails/005/129/844/small_2x/profile-user-icon-isolated-on-white-background-eps10-free-vector.jpg' }}"
                        alt="Profile Picture" class="w-32 h-32 rounded-full border-4 border-yellow-500 object-cover" />
                    <div>
                        <h2 class="text-3xl font-bold text-yellow-500">{{ $user->name }}</h2>
                        <p class="text-gray-400">{{ $user->email }}</p>
                        <p class="text-gray-400">{{ $user->username }}</p>
                    </div>
                </div>
                <div class="flex items-center mt-6">
                    <i class="fas fa-medal text-yellow-500 text-2xl mr-2"></i>
                    <p class="text-gray-400">Enthusiastic</p>
                </div>
                <div class="mt-6 grid md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-4">
                    <a href="{{ route('profiles.picture') }}"
                        class="bg-yellow-500 text-center py-2 rounded-lg shadow hover:bg-yellow-600 transition duration-200">
                        Change Picture
                    </a>
                    <a href="{{ route('profiles.password') }}"
                        class="bg-yellow-500 text-center py-2 rounded-lg shadow hover:bg-yellow-600 transition duration-200">
                        Change Password
                    </a>
                    <a href="{{ route('profiles.username') }}"
                        class="bg-yellow-500 text-center py-2 rounded-lg shadow hover:bg-yellow-600 transition duration-200">
                        Change Username
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
