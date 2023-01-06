<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\ActorMovie;
use App\Models\Movie;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('actors.index', [
            'actors' => Actor::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('actors.create');
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
        $image->move(public_path('storage/actorImages'), $imageName);

        Actor::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'biography' => $request->bio,
            'date_of_birth' => $request->dob,
            'place_of_birth' => $request->pob,
            'image_url' => $imageName,
            'popularity' => $request->popularity
        ]);

        return redirect()->route('actors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $actorMovies = Actor::find($id)->movies;
        $moviesId = [];
        foreach($actorMovies as $actorMovie){
            array_push($moviesId, $actorMovie->movie_id);
        }

        $movies = [];
        foreach($moviesId as $movieId){
            array_push($movies, Movie::find($movieId));
        }

        return view('actors.show', [
            'actor' => Actor::find($id),
            'movies' => $movies
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function edit(string $id)
    {
        return view('actors.edit', [
            'actor' => Actor::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        $actor = Actor::find($id);
        $actor->name = $request->name;
        $actor->gender = $request->gender;
        $actor->biography = $request->bio;
        $actor->date_of_birth = $request->dob ? $request->dob : $actor->date_of_birth;
        $actor->place_of_birth = $request->pob;
        $actor->popularity = $request->popularity;

        $image = $request->file('image');
        if($image){
            unlink(public_path('storage/actorImages/'.$actor->image_url));
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('storage/actorImages'), $imageName);
            $actor->image_url = $imageName;
        }
        $actor->save();
        return redirect()->route('actors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $actor = Actor::find($id);
        if($actor->movies){
            return redirect()->route('actors.show', $id)->withErrors(['deleteFirst' => 'You must delete all movies of this actor first or you can changed the actors.']);
        }
        unlink(public_path('storage/actorImages/'. $actor->image_url));
        $actorMovies = ActorMovie::where('actor_id', $id)->get();
        $actorMovies->destroy();
        $actor->destroy();
        return redirect()->route('actors.index');
    }
}
