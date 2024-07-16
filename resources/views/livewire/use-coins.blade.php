<div>
    <div class="bg-gray-800 p-6 rounded-lg my-8 shadow-md">
        <h2 class="text-yellow-500 text-2xl mb-4">🪙 Use Coins</h2>
        <div class="text-gray-300 mb-4">
            You have <span class="text-yellow-500">{{ $user->wallet->amount }}</span> coins. You can save
            {{ \Illuminate\Support\Number::currency(
                $user->wallet->amount > $cart->total
                    ? $cart->total / 100
                    : $user->wallet->amount * \App\Models\Package::EXCHANGE_MULTIPLIER,
            ) }}
            for this transaction.
        </div>
        <div class="flex items-center space-x-4">
            <input type="checkbox" class="form-checkbox h-6 w-6 text-yellow-500" wire:model="use" wire:change="submit"
                id="use" />
            <label for="use" class="text-gray-300">Use coins for this purchase</label>
        </div>
    </div>
</div>
