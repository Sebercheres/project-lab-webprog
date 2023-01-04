@extends('layouts.main')

@section('content')
    <h1>add movie</h1>
    <form action='/movies/create' method="post" enctype="multipart/form-data">
        @csrf
        <label for="title">title</label>
        <input type="text" name="title" id="title">


        <label for="description">description</label>
        <input type="text" name="description" id="description">
        <br>

        <div class="genres">
            <label for="genres">genre</label>
            <select name="genres[]" id="genres" multiple>
                @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                @endforeach
            </select>
        </div>


        <h2>Actors</h2>
        <button type="button" id="add-input">add actor</button>
        <div id="input-container"></div>

        <template id="input-template">
            <div class="actor">
                <label for="actor">actor</label>
                <select name="actors[]" id="actor">
                    @foreach ($actors as $actor)
                        <option value="{{ $actor->id }}">{{ $actor->name }}</option>
                    @endforeach
                </select>

                <label for="character">character</label>
                <input type="text" name="characters[]" id="character">
            </div>
        </template>

        <br>
        <label for="director">director</label>
        <input type="text" name="director">

        <label for="release_date">Release Date</label>
        <input type="date" name="release_date" id="release_date">

        <label for="image">image URL</label>
        <input type="file" name="image" id="image">

        <label for="background">Background URL</label>
        <input type="file" name="background" id="background">
        <br/>
        <button type="submit">save</button>

        <script src={{ url('js/addMore.js') }}></script>
    </form>
@endsection
