@props(['type' => 'text', 'label' => 'Input'])

<div class="flex flex-col gap-1">
    <label for={{ $id }} class="block text-sm">{{ $label }}</label>
    <input type={{ $type }} name={{ $name }} id={{ $id }}
        class="block w-full bg-gray-700 border border-gray-600 text-gray-300 px-1 rounded h-8"
        required={{ $required }} wire:model.live="{{ $name }}" />

    @error($name)
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
