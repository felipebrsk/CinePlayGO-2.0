<div class="flex justify-between flex-col bg-gray-700 p-4 rounded-lg shadow-lg">
    <div>
        <div class="flex items-center justify-between mb-2">
            <div class="flex items-center gap-2">
                <i class="fas fa-medal text-yellow-500 text-2xl"></i>
                <p class="text-xl font-bold text-yellow-500">{{ $title['title'] }}</p>
            </div>
            @if ($title['acquired'])
                <div>
                    <i class="fas fa-check-circle text-green-600"></i>
                </div>
            @endif
        </div>
        @foreach ($title['requirements'] as $requirement)
            <ul>
                <li class="flex items-center justify-between">
                    <p>
                        {{ $requirement['task'] }}
                    </p>
                    <span>
                        {{ $user->titleProgresses()->where('title_requirement_id', $requirement['id'])->value('progress') ?? 0 }}
                        / {{ $requirement['goal'] }}
                    </span>
                </li>
            </ul>
        @endforeach
    </div>

    @if ($user->titles->doesntContain('id', $title['id']))
        @if ($title['price'])
            @livewire('buy-title', ['user' => $user, 'title' => $title], key($user->id))
        @else
            <div class="text-yellow-500">
                This title is not available to be purchased.
            </div>
        @endif
    @endif
</div>
