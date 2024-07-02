<div>
    <form class="flex flex-col gap-4 w-full" wire:submit.prevent="submit">
        @csrf
        <div>
            <x-input required id="old_password" name="old_password" type="password" label="Old Password" />
        </div>
        <div>
            <x-input required id="password" name="password" type="password" label="New Password" />
        </div>
        <div>
            <x-input required id="password_confirmation" name="password_confirmation" type="password"
                label="New Password Confirmation" />
        </div>
        <x-button label="Update Password" type="submit" loading="submit" />
    </form>
</div>
