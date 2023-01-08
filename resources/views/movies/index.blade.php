@extends('layouts.main')

@section('content')
    <div>
        @foreach ($randomMovies as $movie)
            <h1>{{ $movie->title }}</h1>
        @endforeach
    </div>
    <div>
        <h1>popular</h1>
        @foreach ($popularMovies as $movie)
            <div>
                <a href="/movies/{{ $movie->id }}">
                    {{-- <img src="{{ url('storage/movieImages/' . $movie->image_url) }}" alt=""> --}}
                    <h2>{{ $movie->title }}</h2>
                    {{-- <p>{{ $movie->description }}</p> --}}
                    {{-- @if (Auth::User() && Auth::User()->hasRole('user'))
                        <a href="/bookmark/{{ $movie->id }}">bookmark</a>
                    @endif --}}
                </a>
            </div>
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

        @if (Auth::User() && Auth::User()->hasRole('admin'))
            <a href="/movies/create">add movie</a>
        @endif

        @foreach ($movies as $movie)
            <a href="/movies/{{ $movie->id }}">
                <div>
                    {{-- <img src="{{ url('storage/movieImages/' . $movie->image_url) }}" alt=""> --}}
                    <h2>{{ $movie->title }}</h2>
                    {{-- <p>{{ $movie->description }}</p> --}}
                    @if (Auth::User() && Auth::User()->hasRole('user'))
                        @if(DB::table('user_movies')->where('user_id', Auth::User()->id)->where('movie_id', $movie->id)->exists())
                            <a href="/bookmark/{{ $movie->id }}">unbookmark</a>
                        @else
                            <a href="/bookmark/{{ $movie->id }}">bookmark</a>
                        @endif
                    @endif
                </div>
            </a>
        @endforeach
    </div>
@endsection
