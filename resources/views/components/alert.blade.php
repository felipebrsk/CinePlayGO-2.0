@if (session()->has('success_message'))
    <div class="text-green-500 mb-6 border border-green-500 p-4 rounded-lg flex items-center gap-2 w-full" role="alert"
        x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 6000)" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform translate-y-2"
        x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform translate-y-2">
        <i class="fa fa-check-circle"></i>
        {{ session('success_message') }}
    </div>
@endif

@if (session()->has('error_message'))
    <div class="text-red-500 mb-6 border border-red-500 p-4 rounded-lg flex items-center gap-2 w-full" role="alert"
        x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 6000)"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform translate-y-2"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform translate-y-2">
        <i class="fa fa-times-circle"></i>
        {{ session('error_message') }}
    </div>
@endif

@if (session()->has('warning_message'))
    <div class="text-yellow-500 mb-6 border border-yellow-500 p-4 rounded-lg flex items-center gap-2 w-full"
        role="alert" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 6000)"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform translate-y-2"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform translate-y-2">
        <i class="fa fa-exclamation-circle"></i>
        {{ session('warning_message') }}
    </div>
@endif

@if (session()->has('info_message'))
    <div class="text-blue-500 mb-6 border border-blue-500 p-4 rounded-lg flex items-center gap-2 w-full" role="alert"
        x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 6000)"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform translate-y-2"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform translate-y-2">
        <i class="fa fa-question-circle"></i>
        {{ session('info_message') }}
    </div>
@endif
