@extends('layouts.main', ['title' => 'TV Shows'])

@section('content')
    <section class="container mx-auto py-8">
        @livewire('tv-show-selection')
    </section>
@endsection
