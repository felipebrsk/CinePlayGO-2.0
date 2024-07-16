@props([
    'type' => 'button',
    'label' => null,
    'loading' => false,
    'class' => null,
    'disabled' => false,
    'icon' => null,
    'dusk' => null,
])

<button type="{{ $type }}" dusk="{{ $dusk }}"
    {{ $attributes->merge(['class' => $class ? $class : 'bg-yellow-500 py-2 px-4 rounded-lg shadow hover:bg-yellow-600 transition duration-200 w-full mt-1 flex items-center justify-center', 'disabled' => $disabled]) }}>
    <span wire:loading.remove wire:target="{{ $loading }}">
        @if ($icon)
            <i class="{{ $icon }}"></i>
        @endif
        {{ $label }}
    </span>
    <svg wire:loading wire:target="{{ $loading }}" class="h-6 w-6" viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg" fill="currentColor">
        <circle class="spinner_DupU" cx="12" cy="3" r="0" />
        <circle class="spinner_DupU spinner_GWtZ" cx="16.50" cy="4.21" r="0" />
        <circle class="spinner_DupU spinner_n0Yb" cx="7.50" cy="4.21" r="0" />
        <circle class="spinner_DupU spinner_dwN6" cx="19.79" cy="7.50" r="0" />
        <circle class="spinner_DupU spinner_GIL4" cx="4.21" cy="7.50" r="0" />
        <circle class="spinner_DupU spinner_46QP" cx="21.00" cy="12.00" r="0" />
        <circle class="spinner_DupU spinner_DQhX" cx="3.00" cy="12.00" r="0" />
        <circle class="spinner_DupU spinner_PD82" cx="19.79" cy="16.50" r="0" />
        <circle class="spinner_DupU spinner_tVmX" cx="4.21" cy="16.50" r="0" />
        <circle class="spinner_DupU spinner_eUgh" cx="16.50" cy="19.79" r="0" />
        <circle class="spinner_DupU spinner_j38H" cx="7.50" cy="19.79" r="0" />
        <circle class="spinner_DupU spinner_eUaP" cx="12" cy="21" r="0" />
    </svg>
</button>
