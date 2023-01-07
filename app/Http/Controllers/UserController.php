<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\User;
use App\Models\UserMovie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = auth()->user()->id;
        return view('profile', [
            'user' => User::find($id),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email',
            'dob' => 'required|date',
            'phone' => 'required|min:5|max:13',
        ]);

        $user = User::find($id);
        $user->username = $request->username;
        $user->email = $request->email;

        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('storage/avatar'), $imageName);
            $user->avatar = $imageName;
        }

        $user->dob = $request->dob ? $request->dob : $user->dob;
        $user->phone = $request->phone;

        $user->save();
        return redirect()->route('profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function watchlist()
    {
        $userMovies = UserMovie::where('user_id', auth()->user()->id)->get();
        $movies = [];
        foreach ($userMovies as $item) {
            array_push($movies, Movie::find($item->movie_id));
        }
        for ($i = 0; $i < count($movies); $i++) {
            $movies[$i]->status = $userMovies[$i]->status;
            $movies[$i]->umId = $userMovies[$i]->id;
        }
        return view('watchlist', [
            'movies' => $movies,
        ]);
    }

    public function bookmark(string $id)
    {
        $userId = auth()->user()->id;
        $movieId = $id;
        if (UserMovie::where('user_id', $userId)->where('movie_id', $movieId)->exists()) {
            return redirect()->back();
        }
        $userMovie = new UserMovie();
        $userMovie->user_id = $userId;
        $userMovie->movie_id = $movieId;
        $userMovie->status = 'Planning';
        $userMovie->save();
        return redirect()->route('movies.index');
    }

    public function bookmarkController(Request $request, string $id)
    {
        $userMovie = UserMovie::find($id);
        $userMovie->status = $request->status;
        if ($request->status == 'delete') {
            $userMovie->delete();
            return redirect()->route('watchlist');
        }
        $userMovie->save();
        return redirect()->route('watchlist');
    }
}
