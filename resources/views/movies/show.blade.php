@extends('layouts.main')

@section('content')
    <div>
        <h1>{{ $movie->title }}</h1>
        <img src="{{ url('storage/images/' . $movie->image_url) }}" alt="">
        <p>{{ $movie->description }}</p>
        <p>{{ $movie->director }}</p>
        <p>{{ $movie->release_date }}</p>

        @foreach (array_map(null, $actors, $characters) as [$actor, $character])
            <p>{{ $actor->name }}, {{ $character }}</p>
        @endforeach

        @foreach ($genres as $genre)
            <p>{{ $genre->name }}</p>
        @endforeach
    </div>
@endsection
