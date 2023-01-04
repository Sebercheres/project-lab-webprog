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
        $image->move(public_path('storage/images'), $imageName);

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
        $characters = $movie->character_names;
        foreach($movie->genres as $genre){
            $genres[] = Genre::find($genre);
        }
        foreach($movie->actors as $actor){
            $actors[] = Actor::find($actor);
        }
        return view('movies.show', [
            'movie' => $movie,
            'characters' => $characters,
            'genres' => $genres,
            'actors' => $actors,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        //
    }
}
