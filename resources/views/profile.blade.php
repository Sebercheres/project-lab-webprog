@extends('layouts.main')

@section('content')
    <h1>Profile</h1>
    <img src="" alt="">
    <p>{{ $user->username }}</p>
    <p>{{ $user->email }}</p>

    <form action="/profile/{{ $user->id }}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="username">Username</label>
        <input type="text" name="username" value="{{ $user->username }}">

        <label for="email">Email</label>
        <input type="email" name="email" value="{{ $user->email }}">

        <label for="avatar">Avatar</label>
        <input type="file" name="avatar">

        <label for="dob">DOB</label>
        <input type="date" name="dob" value="{{ $user->dob }}">

        <label for="phone">Phone</label>
        <input type="text" name="phone" value="{{ $user->phone }}">

        <button type="submit">Update</button>
    </form>
    <a href="/logout">Logout</a>
@endsection
