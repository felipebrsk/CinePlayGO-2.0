@extends('layouts.main', ['title' => 'Change picture'])

@section('content')
    <section class="container mx-auto p-4 text-white">
        <div class="flex sm:flex-row flex-col gap-6">
            <x-profile-sidebar />
            <div class="sm:w-3/4 w-full bg-gray-800 p-6 rounded-lg shadow-lg">
                <h2 class="text-3xl mb-4 font-bold text-yellow-500">Change Profile Picture</h2>
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="picture" class="block text-sm">New Picture</label>
                        <input type="file" name="picture" id="picture"
                            class="block w-full mt-1 bg-gray-700 border border-gray-600 text-gray-300" />

                        @error('picture')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit"
                        class="bg-yellow-500 py-2 px-4 rounded-lg shadow hover:bg-yellow-600 transition duration-200 w-full">
                        Update Picture
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection
