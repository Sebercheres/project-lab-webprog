@extends('layouts.main')

@section('content')
    <form action="/movies/{{ $movie->id }}/edit" enctype="multipart/form-data" method="post">
        @csrf
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger" role="alert">
                    {{ $error }}
                </div>
            @endforeach
        @endif
        <div>
            <label for="title">title</label>
            <input type="text" name="title" id="title" value="{{ $movie->title }}">
        </div>

        <div>
            <label for="description">description</label>
            <input type="text" name="description" id="description" value="{{ $movie->description }}">
        </div>

        <div class="genres">
            <label for="genres">genre</label>
            <select name="genres[]" id="genres" multiple>
                @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                @endforeach
            </select>
        </div>


        <div>
            @foreach (array_map(null, $actors, $characters) as [$actorN, $character])
                <label for="actors">actor</label>
                <select name="actors[]" id="actors">
                    @foreach ($actorAll as $actor)
                        <option value="{{ $actor->id }}" {{ $actorN->id == $actor->id ? 'selected' : '' }}>
                            {{ $actor->name }}</option>
                    @endforeach
                </select>
                <label for="characters">character</label>
                <input type="text" name="characters[]" id="characters" value="{{ $character }}">
            @endforeach

            <button type="button" id="add-input">add actor</button>
            <div id="input-container"></div>

            <template id="input-template">
                <div class="actor">
                    <label for="actor">actor</label>
                    <select name="actors[]" id="actor">
                        @foreach ($actorAll as $actor)
                            <option value="{{ $actor->id }}">{{ $actor->name }}</option>
                        @endforeach
                    </select>

                    <label for="character">character</label>
                    <input type="text" name="characters[]" id="character">
                </div>
            </template>
        </div>

        <div>
            <label for="director">director</label>
            <input type="text" name="director" id="director" value="{{ $movie->director }}">
        </div>

        <div>
            <label for="release_date">Release Date</label>
            <input type="date" name="release_date" id="release_date" value="{{ $movie->release_date }}">
        </div>

        <div>
            <label for="image">image URL</label>
            <input type="file" name="image" id="image">
        </div>

        <div>
            <label for="background">Background URL</label>
            <input type="file" name="background" id="background">
        </div>

        <button type="submit">save</button>
    </form>

@endsection
