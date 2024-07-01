@extends('layouts.main', ['title' => 'Actors'])

@section('content')
    <section class="container mx-auto py-8">
        @livewire('actor-selection')
    </section>
@endsection
