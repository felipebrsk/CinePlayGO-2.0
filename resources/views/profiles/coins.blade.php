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

        <div class="flex sm:flex-row flex-col gap-6 mt-6">
            <div class="w-full bg-gray-800 p-6 rounded-lg shadow-lg">
                <div class="text-center mb-6">
                    <h2 class="text-3xl font-bold text-yellow-500">Buy Coins</h2>
                    <p class="text-xl">Select a coin package to enjoy premium features!</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @if ($packages->count() > 0)
                        @foreach ($packages as $package)
                            <div
                                class="bg-gray-900 p-6 rounded-lg shadow-lg flex flex-col items-center transition duration-300 transform hover:scale-105">
                                <img src="https://t3.ftcdn.net/jpg/01/94/67/20/360_F_194672016_pf5HYgLlm6XlSwuL7JE4Pqvdq0RFqK7V.jpg"
                                    alt="Coins"
                                    class="w-24 h-24 mb-4 rounded-full border-4 border-yellow-500 object-cover" />
                                <h3 class="text-2xl font-bold text-yellow-400 mb-2">
                                    {{ number_format($package['amount']) }} Coins
                                </h3>
                                <p class="text-lg text-gray-300 mb-4">
                                    {{ \Illuminate\Support\Number::currency($package['price'] / 100) }}
                                </p>
                                <x-button label="Buy Now" />
                            </div>
                        @endforeach
                    @else
                        <div class="text-center text-gray-300">
                            No coin packages found.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
