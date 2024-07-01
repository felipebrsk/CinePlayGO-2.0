@extends('layouts.main')

@section('content')
    <div class="flex flex-col container mx-auto py-8">
        @if ($watchlists->count() > 0)
            @foreach ($watchlists as $watchlist)
                <div wire:key="watchlist-item-{{ $watchlist->id }}">
                    @livewire('watchlist-card', ['watchlist' => $watchlist, 'watched' => $watchlist->watched], key($watchlist->id))
                </div>
            @endforeach

            {{ $watchlists->links('components.pagination') }}
        @else
            <div>
                No movies in your watchlist.
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script>
        Livewire.on('watchlistDeleted', (watchlist) => {
            const element = document.querySelector(`[wire\\:key="watchlist-item-${watchlist[0].id}"]`);

            if (element) {
                element.remove();
            }
        });
    </script>
@endpush
