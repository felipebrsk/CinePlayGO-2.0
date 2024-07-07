<div>
    @if ($title['price'])
        <div class="mt-4 flex flex-col gap-2 w-auto">
            <p class="text-yellow-500">
                or buy it for <span
                    class="{{ $user->wallet->amount >= $title['price'] ? 'text-green-500' : 'text-red-500' }}">{{ $title['price'] }}</span>
                coins

                @if ($user->wallet->amount < $title['price'])
                    <i class="fa-regular fa-circle-question" title="You have {{ $user->wallet->amount }} coins."></i>
                @endif
            </p>

            <x-button
                class="border border-yellow-500 px-6 py-2 rounded-full hover:bg-yellow-500 transition duration-200 w-full"
                label="Buy title" wire:click="submit" loading="submit" />

            @if ($errors->has('error_message'))
                <div class="text-red-500" role="alert" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 6000)"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform translate-y-2"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform translate-y-2">
                    {{ $errors->first('error_message') }}
                </div>
            @endif
        </div>
    @else
        <div class="text-yellow-500">
            This title is not available for purchase.
        </div>
    @endif
</div>
