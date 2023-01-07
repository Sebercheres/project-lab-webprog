<?php

use App\Http\Controllers\ActorController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [MovieController::class, 'index']);
Route::get('/home', [MovieController::class, 'index']);

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserController::class, 'index'])->name('profile');
    Route::post('/profile/{id}', [UserController::class, 'update']);
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/watchlist', [UserController::class, 'watchlist'])->name('watchlist');
    Route::get('/bookmark/{id}', [UserController::class, 'bookmark'])->name('bookmark');
    Route::post('/bookmark/{id}', [UserController::class, 'bookmarkController']);
    Route::get('/bookmark/{id}/delete', [UserController::class, 'deleteBookmark'])->name('deleteBookmark');
});

Route::group(['prefix' => 'movies'], function () {
    Route::get('/', [MovieController::class, 'index'])->name('movies.index');
    Route::get('/search', [MovieController::class, 'search'])->name('movies.search');
    Route::get('/sort/asc', [MovieController::class, 'sortAsc'])->name('movies.sortAsc');
    Route::get('/sort/desc', [MovieController::class, 'sortDesc'])->name('movies.sortDesc');

    Route::middleware(['auth', 'can:admin'])->group(function () {
        Route::get('/create', [MovieController::class, 'create']);
        Route::post('/create', [MovieController::class, 'store']);
        Route::get('/{id}/edit', [MovieController::class, 'edit']);
        Route::post('/{id}/edit', [MovieController::class, 'update']);
        Route::get('/{id}/delete', [MovieController::class, 'destroy']);
    });

    Route::get('/{id}', [MovieController::class, 'show'])->name('movies.show');
    Route::get('genre/{id}', [MovieController::class, 'genre'])->name('movies.genre');
});

Route::group(['prefix' => 'actors'], function () {
    Route::get('/', [ActorController::class, 'index'])->name('actors.index');
    Route::get('/search', [ActorController::class, 'search'])->name('actors.search');

    Route::middleware(['auth', 'can:admin'])->group(function () {
        Route::get('/create', [ActorController::class, 'create'])->name('actors.create');
        Route::post('/create', [ActorController::class, 'store']);
        Route::get('/{id}/edit', [ActorController::class, 'edit'])->name('actors.edit');
        Route::post('/{id}/edit', [ActorController::class, 'update']);
        Route::get('/{id}/delete', [ActorController::class, 'destroy'])->name('actors.destroy');
    });

    Route::get('/{id}', [ActorController::class, 'show'])->name('actors.show');
});

Route::fallback(function () {
    return redirect()->route('movies.index');
});
