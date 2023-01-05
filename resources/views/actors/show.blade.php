@extends('layouts.main')

@section('content')
    <h1>{{ $actor->name }}</h1>
    <p>{{ $actor->gender }}</p>
    <p>{{ $actor->biography }}</p>
    <p>{{ $actor->date_of_birth }}</p>
    <p>{{ $actor->place_of_birth }}</p>
    <img src="{{ url('storage/actorImages/' . $actor->image_url) }}" alt="">
    <p>{{ $actor->popularity }}</p>
    <br>
    @foreach ($movies as $movie)
        <a href="{{ route('movies.show', $movie->id) }}">
            <h1>
                {{ $movie->title }}
            </h1>
            <img src="{{ url('storage/movieImages/' . $movie->image_url) }}" alt="">
        </a>
    @endforeach

    <a href="{{ route('actors.edit', $actor->id) }}">Edit</a>
    <a href="/actors/{{ $actor->id }}/delete">delete</a>
@endsection
