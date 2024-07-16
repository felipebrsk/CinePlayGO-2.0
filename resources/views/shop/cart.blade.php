@extends('layouts.main', ['title' => 'My Cart'])

@section('content')
    <section class="container mx-auto py-8 px-4">
        <x-alert />
        @if ($cart)
            <div class="bg-gray-800 rounded-lg shadow-lg p-8 mb-8 flex flex-col gap-4">
                <h1 class="text-yellow-500 text-4xl mb-6">🛒Cart</h1>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    @foreach ($cart->items as $item)
                        <div class="bg-gray-900 rounded-lg overflow-hidden shadow-md hover:shadow-lg transition duration-300 mb-6 hover:scale-[1.03]"
                            id="item-{{ $item->id }}" dusk="item-{{ $item->id }}">
                            <div class="relative">
                                @switch($item->itemable_type)
                                    @case(\App\Models\Package::class)
                                        <img src="https://t3.ftcdn.net/jpg/01/94/67/20/360_F_194672016_pf5HYgLlm6XlSwuL7JE4Pqvdq0RFqK7V.jpg"
                                            alt="Coins" class="w-full h-64 object-cover border-2 border-yellow-500" />
                                    @break

                                    @default
                                        <img src="https://via.placeholder.com/250x150" alt="{{ $item->itemable->name }}"
                                            class="w-full h-64 object-cover border-2 border-yellow-500">
                                @endswitch
                                <div
                                    class="absolute top-0 right-0 bg-yellow-500 text-white py-1 px-2 rounded-bl-lg text-xs">
                                    New!
                                </div>
                            </div>
                            <div class="p-4">
                                <div class="flex justify-between">
                                    <h2 class="text-yellow-500 text-lg font-bold mb-2">
                                        {{ $item->itemable->amount }} coins
                                    </h2>
                                    @livewire('remove-from-cart', ['item' => $item, 'cart' => $cart], key($cart->id))
                                </div>
                                <p class="text-gray-300 text-sm mb-4">
                                    {{ \Illuminate\Support\Number::currency($item->itemable->price / 100) }}
                                </p>
                                @livewire('cart-control', ['item' => $item], key($item->id))
                            </div>
                        </div>
                    @endforeach
                </div>

                @livewire('clear-cart', [], key($cart->id))
            </div>


            @livewire('apply-coupon', [], key($cart->id))

            @livewire('use-coins', ['cart' => $cart, 'user' => $user], key($cart->id))

            @livewire('cart-prices', ['cart' => $cart, 'user' => $user], key($cart->id))

            <div class="flex justify-end">
                <button
                    class="bg-green-500 text-white px-6 py-3 rounded-lg transition duration-300 ease-in-out hover:bg-green-600 transform hover:scale-[1.03] sm:w-auto w-full">
                    Proceed to Checkout
                </button>
            </div>
        @else
            <div class="bg-gray-800 rounded-lg shadow-lg p-8 mb-8">
                There are no items in your cart!
            </div>
        @endif
    </section>
@endsection

@push('scripts')
    <script>
        Livewire.on('removeFromCart', items => {
            const item = items[0]

            document.getElementById(`item-${item.id}`).remove();
        });
    </script>
@endpush
