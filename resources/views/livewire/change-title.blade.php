<div>
    <form class="flex flex-col gap-4 w-full" wire:submit.prevent="submit">
        @csrf
        <div>
            <div class="flex flex-col gap-1">
                <x-select id="selected" name="selected" required label="Select your new title" :options="$titles"
                    value="{{ $user->titles()->where('in_use', true)->first()?->id }}" />
            </div>
        </div>
        <x-button label="Update Title" type="submit" loading="submit" />
    </form>
</div>
