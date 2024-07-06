<div>
    <form enctype="multipart/form-data" class="flex flex-col gap-4" wire:submit.prevent="submit">
        @csrf
        <div>
            @if ($photo)
                <img src="{{ $photo->temporaryUrl() }}" alt="Preview"
                    class="w-32 h-32 rounded-full border-4 border-yellow-500 object-cover" dusk="preview" />
            @else
                <img src="https://static.vecteezy.com/system/resources/thumbnails/005/129/844/small_2x/profile-user-icon-isolated-on-white-background-eps10-free-vector.jpg"
                    alt="Preview" class="w-32 h-32 rounded-full border-4 border-yellow-500 object-cover" />
            @endif
        </div>
        <div>
            <label for="photo" class="block text-sm">New Picture</label>
            <input type="file" name="photo" id="photo"
                class="block w-full mt-1 bg-gray-700 border border-gray-600 text-gray-300" wire:model.change="photo"
                accept="image/*" />

            @error('photo')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <x-button label="Update Picture" type="submit" loading="submit" />
    </form>
</div>
