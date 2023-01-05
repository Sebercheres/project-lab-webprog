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
    <a href="{{ route('actors.edit', $actor->id) }}">Edit</a>
    <form action="{{ route('actors.destroy', $actor->id) }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
@endsection
