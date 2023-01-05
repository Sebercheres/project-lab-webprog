@extends('layouts.main')

@section('content')
    <h1>Actors</h1>
    <h2>Search</h2>
    <form action="{{ route('actors.index') }}" method="get">
        <input type="text" name="search" id="search" value="{{ request()->search }}">
        <button type="submit">Search</button>
    </form>
    <a href="{{ route('actors.create') }}">Create</a>
    <br>
    @foreach ($actors as $actor)
        <a href="{{ route('actors.show', $actor->id) }}">{{ $actor->name }}</a>
    @endforeach
@endsection
