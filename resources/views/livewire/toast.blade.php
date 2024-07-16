<div class="fixed bottom-0 left-4">
    @foreach ($notices as $notice)
        <div wire:key="{{ $notice['id'] }}" x-data="{ visible: true }" x-show="visible" x-init="setTimeout(() => visible = false, 3000)"
            x-transition:enter="transition ease-in duration-200"
            x-transition:enter-start="transform opacity-0 translate-y-2" x-transition:enter-end="transform opacity-100"
            x-transition:leave="transition ease-out duration-500"
            x-transition:leave-start="transform translate-x-0 opacity-100"
            x-transition:leave-end="transform -translate-x-full opacity-0"
            class="rounded-xl mb-4 px-6 py-4 flex items-center justify-center text-white shadow-lg font-bold text-md cursor-pointer border gap-2"
            :class="{
                'border-green-500': '{{ $notice['type'] }}'
                === 'success',
                'border-blue-500': '{{ $notice['type'] }}'
                === 'info',
                'border-yellow-500': '{{ $notice['type'] }}'
                === 'warning',
                'border-red-500': '{{ $notice['type'] }}'
                === 'error',
            }"
            wire:click="remove('{{ $notice['id'] }}')">
            <i class="fas"
                :class="{
                    'fa-check-circle': '{{ $notice['type'] }}'
                    === 'success',
                    'fa-question-circle': '{{ $notice['type'] }}'
                    === 'info',
                    'fa-exclamation-circle': '{{ $notice['type'] }}'
                    === 'warning',
                    'fa-times-circle': '{{ $notice['type'] }}'
                    === 'error',
                }"></i>
            {{ $notice['message'] }}
        </div>
    @endforeach
</div>
