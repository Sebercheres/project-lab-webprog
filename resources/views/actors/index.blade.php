@extends('layouts.main')

@section('content')
    <h1>Actors</h1>
    <a href="{{ route('actors.create') }}">Create</a>
    <br>
    @foreach ($actors as $actor)
        <a href="{{ route('actors.show', $actor->id) }}">{{ $actor->name }}</a>
    @endforeach
@endsection
