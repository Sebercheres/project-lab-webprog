<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('movies.index', [
            'movies' => Movie::all(),
            'genres'=> Genre::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('movies.create', [
            'genres' => Genre::all(),
            'actors' => Actor::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = $request->file('image');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('storage/movieImages'), $imageName);

        $background = $request->file('background');
        $backgroundName = $background->getClientOriginalName();
        $background->move(public_path('storage/backgrounds'), $backgroundName);
        Movie::create([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'genres' => $request->get('genres'),
            'actors' => $request->get('actors'),
            'character_names' => $request->get('characters'),
            'director' => $request->get('director'),
            'release_date' => $request->get('release_date'),
            'image_url' => $imageName,
            'background_url' => $backgroundName,
        ]);

        return redirect()->route('movies.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $movie = Movie::find($id);
        foreach($movie->genres as $genre){
            $genres[] = Genre::find($genre);
        }
        foreach($movie->actors as $actor){
            $actors[] = Actor::find($actor);
        }
        $otherMovies = Movie::where('id', '!=', $id)->get();
        return view('movies.show', [
            'movie' => $movie,
            'characters' => $movie->character_names,
            'genres' => $genres,
            'actors' => $actors,
            'otherMovies' => $otherMovies,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(string $id)
    {
        $movie = Movie::find($id);
        foreach($movie->actors as $actor){
            $actors[] = Actor::find($actor);
        }
        return view('movies.edit', [
            'movie' => $movie,
            'genres' => Genre::all(),
            'actors' => $actors,
            'characters' => $movie->character_names,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        $movie = Movie::find($id);
        $movie->title = $request->get('title') ? $request->get('title') : $movie->title;
        $movie->description = $request->get('description') ? $request->get('description') : $movie->description;
        $movie->genres = $request->get('genres') ? $request->get('genres') : $movie->genres;
        $movie->actors = $request->get('actors') ? $request->get('actors') : $movie->actors;
        $movie->character_names = $request->get('characters') ? $request->get('characters') : $movie->character_names;
        $movie->director = $request->get('director') ? $request->get('director') : $movie->director;
        $movie->release_date = $request->get('release_date') ? $request->get('release_date') : $movie->release_date;
        $movie->save();
        return redirect()->route('movies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $movie = Movie::find($id);
        unlink(public_path('storage/movieImages/' . $movie->image_url));
        unlink(public_path('storage/backgrounds/' . $movie->background_url));
        $movie->delete();
        return redirect()->route('movies.index');
    }
}
