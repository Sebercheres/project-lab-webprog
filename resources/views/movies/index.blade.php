@extends('layouts.main')

@section('content')
    <div>
        disini gambar gede
    </div>
    <div>
        <h1>popular</h1>
        @foreach ($movies as $movie)
            <a href="/movies/{{ $movie->id }}">
                <img src="{{ url('storage/images/' . $movie->image_url) }}" alt="">
                <h2>{{ $movie->title }}</h2>
                <p>{{ $movie->description }}</p>
            </a>
        @endforeach
    </div>
    <div>
        <h1>Show</h1>
        @foreach ($genres as $genre)
            <a href="/movies/genre/{{ $genre->id }}">{{ $genre->name }}</a>
        @endforeach

        <h2>search</h2>
        <form action="/movies/search" method="get">
            <input type="text" name="search" id="">
            <button type="submit">search</button>
        </form>
        <hr />

        <h2>sort by</h2>
        <a href="/movies/sort/asc">asc</a>
        <a href="/movies/sort/desc">desc</a>

        <a href="/movies/create">add movie</a>

        @foreach ($movies as $movie)
            <div>
                <img src="{{ url('storage/images/' . $movie->image_url) }}" alt="">
                <h2>{{ $movie->title }}</h2>
                <p>{{ $movie->description }}</p>
                <a href="/movies/{{ $movie->id }}">detail</a>
            </div>
        @endforeach
    </div>
@endsection
