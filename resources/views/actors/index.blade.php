@extends('layouts.main')

@section('content')
    <h1>Actors</h1>
    <h2>Search</h2>
    <form action="{{ route('actors.search') }}" method="get">
        <input type="text" name="search" id="search">
        <button type="submit">Search</button>
    </form>

    @if (Auth::user() && Auth::user()->role == 'admin')
        <a href="{{ route('actors.create') }}">Create</a>
    @endif

    <br>
    @foreach ($actors as $actor)
        <a href="{{ route('actors.show', $actor->id) }}">{{ $actor->name }}</a>
    @endforeach
@endsection
