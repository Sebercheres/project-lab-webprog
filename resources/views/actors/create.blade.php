@extends('layouts.main')

@section('content')
    <form action="/actors/create" enctype="multipart/form-data" method="post">
        @csrf
        <div class="">
            <label for="name">name</label>
            <input type="text" name="name" id="name">
        </div>

        <div class="">
            <label for="gender">Gender</label>
            <select name="gender" id="">
                <option value="Female">Female</option>
                <option value="Male">Male</option>
            </select>
        </div>

        <div class="">
            <label for="bio">Biography</label>
            <textarea name="bio" id="bio" cols="30" rows="10"></textarea>
        </div>

        <div class="">
            <label for="dob">Date of Birth</label>
            <input type="date" name="dob" id="dob">
        </div>

        <div class="">
            <label for="pob">Place of Birtgh</label>
            <input type="text" name="pob" id="pob">
        </div>

        <div class="">
            <label for="image">Image</label>
            <input type="file" name="image" id="image">
        </div>

        <div class="">
            <label for="popularity">Popularity</label>
            <input type="number" step='0.1' min="0" max="10" name="popularity" id="popularity">
        </div>

        <button type="submit">save</button>
    </form>
@endsection
