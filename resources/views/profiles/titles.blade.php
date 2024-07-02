@extends('layouts.main', ['title' => 'Titles'])

@section('content')
    <section class="container mx-auto p-4 text-white">
        <x-alert />
        <div class="flex sm:flex-row flex-col gap-6">
            <x-profile-sidebar />
            <div class="sm:w-3/4 w-full bg-gray-800 p-6 rounded-lg shadow-lg flex flex-col gap-4">
                <h2 class="text-3xl font-bold text-yellow-500">Your Title</h2>
                @if ($user->titles()->where('in_use', true)->exists())
                    <div class="flex items-center gap-2">
                        <i class="fas fa-medal text-yellow-500 text-2xl"></i>
                        <p class="text-2xl">{{ $user->titles()->where('in_use', true)->value('title') }}</p>
                    </div>
                @else
                    <div>
                        No title defined.
                    </div>
                @endif
                <h3 class="text-2xl font-bold text-yellow-500">Change Title</h3>
                @livewire(
                    'change-title',
                    [
                        'user' => $user,
                        'titles' => $titles,
                    ],
                    key($user->id)
                )
            </div>
        </div>

        <div class="flex sm:flex-row flex-col gap-6 mt-6">
            <div class="w-full bg-gray-800 p-6 rounded-lg shadow-lg">
                <h2 class="text-3xl mb-4 font-bold text-yellow-500">Available Titles</h2>
                <div class="grid md:grid-cols-2 gap-6">
                    @foreach ($allTitles as $title)
                        <div class="bg-gray-700 p-4 rounded-lg shadow-lg">
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
                                            {{ auth()->user()->titleProgresses()->where('title_requirement_id', $requirement['id'])->value('progress') ?? 0 }}
                                            / {{ $requirement['goal'] }}
                                        </span>
                                    </li>
                                </ul>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
