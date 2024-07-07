@extends('layouts.main', ['title' => 'Coins'])

@section('content')
    <section class="container mx-auto p-4 text-white">
        <div class="flex sm:flex-row flex-col gap-6">
            <x-profile-sidebar />
            <div class="sm:w-3/4 w-full bg-gray-800 p-6 rounded-lg shadow-lg">
                <h2 class="text-3xl mb-4 font-bold text-yellow-500">Your Coins</h2>
                <p class="text-2xl">{{ $user->wallet->amount }} coins</p>
                <form class="mt-6">
                    @csrf
                    @if ($user->wallet->amount > 0)
                        <button type="submit" onclick="event.preventDefault()"
                            class="bg-yellow-500 py-2 px-4 rounded-lg shadow hover:bg-yellow-600 transition duration-200 sm:w-auto w-full">
                            Redeem Coins
                        </button>
                    @endif
                </form>
            </div>
        </div>
    </section>
@endsection
