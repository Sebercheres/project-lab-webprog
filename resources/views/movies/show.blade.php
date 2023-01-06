@extends('layouts.main')

@section('content')
    <div>

        <h1>{{ $movie->title }}</h1>
        <img src="{{ url('storage/movieImages/' . $movie->image_url) }}" alt="">
        <p>{{ $movie->description }}</p>
        <p>{{ $movie->director }}</p>
        <p>{{ $movie->release_date }}</p>

        @foreach (array_map(null, $actors, $characters) as [$actor, $character])
            <p>{{ $actor->name }}, {{ $character }}</p>
        @endforeach

        @foreach ($genres as $genre)
            <p>{{ $genre->name }}</p>
        @endforeach

        @if (Auth::User() && Auth::User()->hasRole('admin'))
            <a href="/movies/{{ $movie->id }}/edit">edit</a>
            <a href="/movies/{{ $movie->id }}/delete">delete</a>
        @endif

        @foreach ($otherMovies as $otherMovie)
            <a href="/movies/{{ $otherMovie->id }}">
                <p>{{ $otherMovie->title }}</p>
            </a>
            @if(Auth::User() && Auth::User()->hasRole('user'))
                <a href="/bookmark/{{ $otherMovie->id }}">bookmark</a>
            @endif
        @endforeach
    </div>
@endsection
