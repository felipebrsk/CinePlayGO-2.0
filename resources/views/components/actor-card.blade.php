<div class="flex flex-col gap-2">
    <a href="{{ route('actors.show', $cast['id']) }}">
        <img src="{{ 'https://image.tmdb.org/t/p/original/' . $cast['profile_path'] }}" alt="Atores"
            class="hover:opacity-75 transition ease-in-out duration-150 rounded-lg w-full">
    </a>
    <div>
        <a href="{{ route('actors.show', $cast['id']) }}" class="text-lg mt-2 hover:text-gray:300">{{ $cast['name'] }}</a>
        <div class="text-sm text-gray-400">{{ $cast['character'] }}</div>
    </div>
</div>
