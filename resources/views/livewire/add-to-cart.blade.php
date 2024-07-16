<div class="w-full">
    <form wire:submit.prevent="submit">
        @csrf
        <x-button label="Add to cart" type="submit" loading="submit" />
    </form>
</div>
