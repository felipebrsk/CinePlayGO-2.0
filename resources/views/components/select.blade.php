<div class="flex flex-col gap-1">
    <label for="{{ $id }}" class="block text-sm">{{ $label }}</label>
    <select name="{{ $name }}" id="{{ $id }}" wire:model="{{ $name }}"
        class="block w-full bg-gray-700 border border-gray-600 text-gray-300 px-1 rounded h-8">
        <option value="">Select an option</option>
        @foreach ($options as $key => $option)
            <option value="{{ $key }}" {{ $key == $value ? 'selected' : '' }}>
                {{ $option }}
            </option>
        @endforeach
    </select>
    @error($name)
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
