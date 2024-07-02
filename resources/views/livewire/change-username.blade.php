<div>
    <form class="flex flex-col gap-4 w-full" wire:submit.prevent="submit">
        @csrf
        <div>
            <x-input required id="password" name="password" type="password" label="Password" />
        </div>
        <div>
            <x-input required id="username" name="username" type="text" label="New Username" />
        </div>
        <x-button label="Update Username" type="submit" loading="submit" />
    </form>
</div>
