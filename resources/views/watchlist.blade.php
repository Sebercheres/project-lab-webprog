@extends('layouts.main')

@section('content')
    <h1>My Watchlist</h1>

    @foreach ($movies as $movie)
        {{-- <a href="/movies/{{ $movie->id }}"> --}}
            <div>
                <h2>{{ $movie->title }}</h2>
                <p>{{ $movie->description }}</p>
                <p>{{ $movie->status }}</p>
            </div>
        {{-- </a> --}}
        <form action="/bookmark/{{ $movie->umId }}" method="post">
            @csrf
            <select name="status" id="">
                <option value="planning">planned</option>
                <option value="watching">watching</option>
                <option value="finished">finished</option>
                <option value="delete">delete</option>
            </select>
            <button type="submit">save</button>
        </form>
        </div>
    @endforeach
@endsection
