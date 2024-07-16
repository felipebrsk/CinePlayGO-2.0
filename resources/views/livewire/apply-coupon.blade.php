<div>
    @php
        $coupon = session('coupon');
    @endphp

    @if ($coupon)
        <div class="bg-gray-800 rounded-lg shadow-lg p-8 mb-8">
            <h2 class="text-yellow-500 text-2xl mb-4">🎟️ Coupon Applied: {{ $coupon['code'] }}</h2>
            <div class="flex sm:items-center items-start justify-between sm:flex-row flex-col sm:gap-0 gap-2">
                @if ($coupon['type'] == \App\Models\Coupon::FIXED_TYPE_ID)
                    <span class="text-gray-300 font-bold text-lg">
                        {{ \Illuminate\Support\Number::currency($coupon['value'] / 100) }} off
                    </span>
                @else
                    <span class="text-gray-300 font-bold text-lg">
                        {{ $coupon['discount'] }}% off
                    </span>
                @endif
                <form method="POST" class="sm:w-auto w-full" wire:submit.prevent="remove">
                    @csrf
                    <x-button label="Remove" type="submit" loading="remove"
                        class="text-red-500 border border-red-500 rounded-full px-4 py-2 hover:bg-red-500 hover:text-white transition duration-300 sm:w-auto w-full" />
                </form>
            </div>
        </div>
    @else
        <div class="bg-gray-800 rounded-lg shadow-lg p-8 mb-8">
            <h2 class="text-yellow-500 text-2xl mb-4">🎟️ Apply Coupon</h2>
            <form method="POST" class="flex items-center gap-4 sm:flex-row flex-col" wire:submit.prevent="apply">
                @csrf
                <input type="text" name="code" wire:model.live="code"
                    class="w-full p-3 rounded-lg text-white bg-gray-600 outline-none" placeholder="Enter coupon code" />
                <x-button label="Apply" type="submit" loading="apply"
                    class="bg-yellow-500 text-white px-4 py-3 rounded-lg transition duration-300 ease-in-out hover:bg-yellow-600 transform hover:scale-110 sm:w-auto w-full font-bold" />
            </form>

            @error('code')
                <div class="text-red-500 mt-2">
                    {{ $message }}
                </div>
            @enderror
        </div>
    @endif
</div>
