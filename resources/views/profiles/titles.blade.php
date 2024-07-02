@extends('layouts.main', ['title' => 'Titles'])

@section('content')
    <section class="container mx-auto p-4 text-white">
        <div class="flex sm:flex-row flex-col gap-6">
            <x-profile-sidebar />
            <div class="sm:w-3/4 w-full bg-gray-800 p-6 rounded-lg shadow-lg flex flex-col gap-4">
                <h2 class="text-3xl font-bold text-yellow-500">Your Title</h2>
                <div class="flex items-center gap-2">
                    <i class="fas fa-medal text-yellow-500 text-2xl"></i>
                    <p class="text-2xl">Instructor</p>
                </div>
                <h3 class="text-2xl font-bold text-yellow-500">Change Title</h3>
                <form>
                    @csrf
                    <div>
                        <x-select id="title" name="title" required label="Select your new title" :options="$titles"
                            value="{{ 10 }}" />
                    </div>
                    <button type="submit"
                        class="bg-yellow-500 py-2 px-4 rounded-lg shadow hover:bg-yellow-600 transition duration-200 w-full mt-3">
                        Change Title
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection
