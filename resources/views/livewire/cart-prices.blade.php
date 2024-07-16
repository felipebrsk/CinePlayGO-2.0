<div>
    <div class="bg-gray-800 rounded-lg shadow-lg p-8 mb-8">
        <div class="flex justify-between sm:items-center items-start sm:flex-row flex-col">
            <div class="text-left">
                <p class="text-gray-300 text-sm">Subtotal:</p>
                <p class="text-yellow-500 text-lg">
                    {{ \Illuminate\Support\Number::currency($this->subtotal / 100) }}
                </p>
            </div>
            <div class="text-left">
                <p class="text-gray-300 text-sm">Discount:</p>
                <p class="text-yellow-500 text-lg">
                    {{ \Illuminate\Support\Number::currency($this->discount ? $this->discount / 100 : $this->discount) }}
                </p>
            </div>
            <div class="text-left">
                <p class="text-gray-300 text-sm">Total:</p>
                <p class="text-yellow-500 text-lg">
                    {{ \Illuminate\Support\Number::currency($this->total / 100) }}
                </p>
            </div>
        </div>
    </div>
</div>
