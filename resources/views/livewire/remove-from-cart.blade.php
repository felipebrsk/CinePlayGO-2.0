<div>
    <form wire:submit.prevent="submit">
        @csrf
        <x-button icon="fas fa-trash-alt" class="text-red-500 hover:text-red-700 transition duration-200" type="submit"
            loading="submit" dusk="removeCart" />
    </form>
</div>
