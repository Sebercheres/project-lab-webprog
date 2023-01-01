@extends('layouts.main')

@section('content')
    <form action="/register" method="post">
        @csrf
        <input type="text" name="username" placeholder="username">
        <input type="email" name="email" placeholder="email">
        <input type="password" name="password" placeholder="password">
        <input type="password" name="password_confirmation" placeholder="password confirmation">
        <input type="submit" value="register">
    </form>
@endsection
