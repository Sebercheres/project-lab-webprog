@extends('layouts.main')

@section('content')
    <form action="/actors/{{ $actor->id }}/edit" method="post" enctype="multipart/form-data">
        @csrf
        <div class="name">
            <label for="name">name</label>
            <input type="text" name="name" id="name" value="{{ $actor->name }}">
        </div>
        <div class="gender">
            <label for="gender">Gender</label>
            <select name="gender" id="">
                <option value="Female">Female</option>
                <option value="Male">Male</option>
            </select>
        </div>

        <div class="bio">
            <label for="bio">Biography</label>
            <textarea name="bio" id="bio" cols="30" rows="10">{{ $actor->biography }}</textarea>
        </div>

        <div class="dob">
            <label for="dob">Date of Birth</label>
            <input type="date" name="dob" id="dob" value="{{ $actor->date_of_birth }}">
        </div>

        <div class="pob">
            <label for="pob">Place of Birtgh</label>
            <input type="text" name="pob" id="pob" value="{{ $actor->place_of_birth }}">
        </div>

        <div class="image">
            <label for="image">Image</label>
            <input type="file" name="image" id="image">
        </div>

        <div class="popularity">
            <label for="popularity">Popularity</label>
            <input type="number" step='0.1' min="0" max="10" name="popularity" id="popularity" value="{{ $actor->popularity }}">
        </div>

        <button type="submit">save</button>
    </form>
@endsection
