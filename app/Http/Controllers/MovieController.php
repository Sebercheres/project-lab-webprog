<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\ActorMovie;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
    public function popularMovies()
    {
        $results = DB::table('user_movies')
            ->select('movie_id', DB::raw('count(*) as count'))
            ->groupBy('movie_id')
            ->orderByDesc('count')
            ->get();
        foreach ($results as $result) {
            $popularMovies[] = Movie::find($result->movie_id);
        }
        return $popularMovies;
    }

    public function randomMovies(){
        $randomMovies = Movie::inRandomOrder()->limit(3)->get();
        for($i = 0; $i < count($randomMovies); $i++) {
            $randomMovies[$i]->genre_names = Genre::find($randomMovies[$i]->genres)->pluck('name');
        }
        return $randomMovies;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('movies.index', [
            'movies' => Movie::all(),
            'genres' => Genre::all(),
            'popularMovies' => $this->popularMovies(),
            'randomMovies' => $this->randomMovies(),
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
        $request->validate([
            'title' => 'required|min:2|max:50',
            'description' => 'required|min:8',
            'genres' => 'required',
            'actors' => 'required',
            'characters' => 'required',
            'director' => 'required|min:3',
            'release_date' => 'required',
            'image' => 'required|image',
            'background' => 'required|image',
        ]);

        $movie = new Movie();
        $movie->title = $request->get('title');
        $movie->description = $request->get('description');
        $movie->genres = $request->get('genres');
        $movie->actors = $request->get('actors');

        $movie->character_names = $request->get('characters');
        $movie->director = $request->get('director');
        $movie->release_date = $request->get('release_date');

        $image = $request->file('image');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('storage/movieImages'), $imageName);
        $movie->image_url = $imageName;

        $background = $request->file('background');
        $backgroundName = $background->getClientOriginalName();
        $background->move(public_path('storage/backgrounds'), $backgroundName);
        $movie->background_url = $backgroundName;

        $movie->save(['returning' => true]);
        $movieId = $movie->id;

        foreach ($request->get('actors') as $actor) {
            $actorMovie = new ActorMovie();
            $actorMovie->actor_id = $actor;
            $actorMovie->movie_id = $movieId;
            if ($actorMovie->actor_id == ActorMovie::where('actor_id', $actorMovie->actor_id)->where('movie_id', $actorMovie->movie_id)->first()) {
                continue;
            } else {
                $actorMovie->save();
            }
        }

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
        foreach ($movie->genres as $genre) {
            $genres[] = Genre::find($genre);
        }
        foreach ($movie->actors as $actor) {
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
        foreach ($movie->actors as $actor) {
            $actors[] = Actor::find($actor);
        }
        return view('movies.edit', [
            'movie' => $movie,
            'genres' => Genre::all(),
            'actors' => $actors,
            'actorAll' => Actor::all(),
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
        $request->validate([
            'title' => 'required|min:2|max:50',
            'description' => 'required|min:8',
            'genres' => 'required',
            'actors' => 'required',
            'characters' => 'required',
            'director' => 'required|min:3',
            'release_date' => 'required',
            'image' => 'required|image',
            'background' => 'required|image',
        ]);

        $movie = Movie::find($id);
        $movie->title = $request->get('title');
        $movie->description = $request->get('description');
        $movie->genres = $request->get('genres') ? $request->get('genres') : $movie->genres;

        $movie->actors = $request->get('actors');

        $actorMovie = ActorMovie::where('movie_id', $movie->id);
        $actorMovie->delete();
        foreach ($request->get('actors') as $actor) {
            $actorMovie = new ActorMovie();
            $actorMovie->actor_id = $actor;
            $actorMovie->movie_id = $movie->id;
            if (ActorMovie::where('actor_id', $actorMovie->actor_id)->where('movie_id', $actorMovie->movie_id)->first()) {
                continue;
            } else {
                $actorMovie->save();
            }
        }


        $movie->character_names = $request->get('characters');
        $movie->director = $request->get('director');
        $movie->release_date = $request->get('release_date') ? $request->get('release_date') : $movie->release_date;

        if ($request->file('image')) {
            unlink(public_path('storage/movieImages/' . $movie->image_url));
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('storage/movieImages'), $imageName);
            $movie->image_url = $imageName;
        }
        if ($request->file('background')) {
            unlink(public_path('storage/backgrounds/' . $movie->background_url));
            $background = $request->file('background');
            $backgroundName = $background->getClientOriginalName();
            $background->move(public_path('storage/backgrounds'), $backgroundName);
            $movie->background_url = $backgroundName;
        }
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
        $actorMovies = ActorMovie::where('movie_id', $id);
        $actorMovies->delete();
        $movie->delete();
        return redirect()->route('movies.index');
    }

    public function genre(string $id)
    {
        $genre = Genre::find($id);
        $movies = Movie::where('genres', 'like', '%' . $genre->id . '%')->get();
        return view('movies.index', [
            'genres' => Genre::all(),
            'movies' => $movies,
            'popularMovies' => $this->popularMovies(),
            'randomMovies' => $this->randomMovies(),
        ]);
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $movies = Movie::where('title', 'like', '%' . $search . '%')->get();
        return view('movies.index', [
            'genres' => Genre::all(),
            'movies' => $movies,
            'popularMovies' => $this->popularMovies(),
            'randomMovies' => $this->randomMovies(),
        ]);
    }

    public function sortAsc()
    {
        $movies = Movie::orderBy('title', 'asc')->get();
        return view('movies.index', [
            'genres' => Genre::all(),
            'movies' => $movies,
            'popularMovies' => $this->popularMovies(),
            'randomMovies' => $this->randomMovies(),
        ]);
    }

    public function sortDesc()
    {
        $movies = Movie::orderBy('title', 'desc')->get();
        return view('movies.index', [
            'genres' => Genre::all(),
            'movies' => $movies,
            'popularMovies' => $this->popularMovies(),
            'randomMovies' => $this->randomMovies(),
        ]);
    }
}
