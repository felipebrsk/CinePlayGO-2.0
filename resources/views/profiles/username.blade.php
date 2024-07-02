@extends('layouts.main', ['title' => 'Change username'])

@section('content')
    <section class="container mx-auto p-4 text-white">
        <div class="flex sm:flex-row flex-col gap-6">
            <x-profile-sidebar />
            <div class="sm:w-3/4 w-full bg-gray-800 p-6 rounded-lg shadow-lg">
                <h2 class="text-3xl mb-4 font-bold text-yellow-500">Change Username</h2>
                @livewire('change-username', ['user' => $user], key($user->id))
            </div>
        </div>
    </section>
@endsection
