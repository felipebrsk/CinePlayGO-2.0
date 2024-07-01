@extends('layouts.main', ['title' => 'Movies'])

@section('content')
    <section class="container mx-auto py-8">
        @livewire('movie-selection')
    </section>
@endsection
