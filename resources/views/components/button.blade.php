@props(['type' => 'button', 'label' => 'Button', 'loading' => false])

<button type="{{ $type }}"
    {{ $attributes->merge(['class' => 'bg-yellow-500 py-2 px-4 rounded-lg shadow hover:bg-yellow-600 transition duration-200 w-full mt-1 flex items-center justify-center']) }}>
    <span wire:loading.remove wire:target="{{ $loading }}">
        {{ $label }}
    </span>
    <svg wire:loading wire:target="{{ $loading }}" class="animate-spin h-6 w-6 text-white"
        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor"
            d="M4 12a8 8 0 018-8V0C6.477 0 2 4.477 2 10h2zm2 5.291A7.966 7.966 0 014 12H2c0 4.411 2.805 8.139 6.7 9.508l.3-2.217z">
        </path>
    </svg>
</button>
