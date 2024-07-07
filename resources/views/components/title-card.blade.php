<div
    class="flex flex-col justify-between bg-gray-900 p-6 rounded-lg shadow-lg transition duration-300 transform hover:scale-105">
    <div>
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-3">
                <i class="fas fa-medal text-yellow-500 text-3xl"></i>
                <p class="text-2xl font-bold text-yellow-500">{{ $title['title'] }}</p>
            </div>

            @if ($title['acquired'])
                <div>
                    <i class="fas fa-check-circle text-green-500 text-2xl"></i>
                </div>
            @endif
        </div>

        <div class="mb-4">
            @foreach ($title['requirements'] as $requirement)
                <div class="mb-2">
                    <p class="text-gray-300">{{ $requirement['task'] }}</p>
                    <div class="relative w-full h-4 bg-gray-600 rounded-full overflow-hidden">
                        <div class="absolute top-0 left-0 h-full bg-yellow-500 transition-all duration-500"
                            style="width: {{ (($user->titleProgresses()->where('title_requirement_id', $requirement['id'])->value('progress') ??0) /$requirement['goal']) *100 }}%">
                        </div>
                        <div class="absolute top-0 left-0 h-full bg-gradient-to-r from-yellow-400 via-yellow-500 to-yellow-600 transition-all duration-500"
                            style="width: {{ (($user->titleProgresses()->where('title_requirement_id', $requirement['id'])->value('progress') ??0) /$requirement['goal']) *100 }}%">
                        </div>
                        <span
                            class="absolute top-0 left-0 right-0 bottom-0 flex items-center justify-center text-xs text-gray-100 font-semibold">{{ $user->titleProgresses()->where('title_requirement_id', $requirement['id'])->value('progress') ?? 0 }}
                            / {{ $requirement['goal'] }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    @if ($user->titles->doesntContain('id', $title['id']))
        @livewire('buy-title', ['user' => $user, 'title' => $title], key($user->id))
    @else
        <div class="text-green-500">Title acquired</div>
    @endif
</div>
