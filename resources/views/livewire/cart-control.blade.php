<div>
    <div class="flex items-center justify-between sm:flex-row flex-col gap-4">
        <div class="flex items-center gap-2">
            <button
                class="bg-yellow-500 text-white p-2 w-5 h-5 flex justify-center items-center rounded-full shadow-md transition duration-300 ease-in-out hover:bg-yellow-600 focus:outline-none"
                wire:click="dec" dusk="decrease">
                <i class="fas fa-minus text-xs"></i>
            </button>
            <input type="text"
                class="w-6 text-center text-gray-800 bg-gray-200 rounded-lg font-bold pointer-events-none"
                value="{{ $item->qty }}" readonly />
            <button
                class="bg-yellow-500 text-white p-2 w-5 h-5 flex justify-center items-center rounded-full shadow-md transition duration-300 ease-in-out hover:bg-yellow-600 focus:outline-none"
                wire:click="add" dusk="increase">
                <i class="fas fa-plus text-xs"></i>
            </button>
        </div>
    </div>
</div>
