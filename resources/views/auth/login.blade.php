@extends('layouts.main')

@section('content')
    <h1>Login</h1>
    {{ Session::get('message') }}

    @if (session('error'))
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @endif

    <form action="/login" method="post">
        @csrf
        <input type="email" name="email" placeholder="email">
        <input type="password" name="password" placeholder="password">
        <input type="submit" value="login">
    </form>
@endsection
