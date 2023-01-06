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

Route::get('/', [UserController::class, 'index']);
Route::get('/home', [UserController::class, 'index']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'movies'], function (){
    Route::get('/', [MovieController::class, 'index'])->name('movies.index');
    Route::get('/create', [MovieController::class, 'create']);
    Route::post('/create', [MovieController::class, 'store']);
    Route::get('/{id}', [MovieController::class, 'show'])->name('movies.show');
    Route::get('/{id}/edit', [MovieController::class, 'edit']);
    Route::post('/{id}/edit', [MovieController::class, 'update']);
    Route::get('/{id}/delete', [MovieController::class, 'destroy']);
});

Route::group(['prefix' => 'actors'], function (){
    Route::get('/', [ActorController::class, 'index'])->name('actors.index');
    Route::get('/create', [ActorController::class, 'create'])->name('actors.create');
    Route::post('/create', [ActorController::class, 'store']);
    Route::get('/{id}', [ActorController::class, 'show'])->name('actors.show');
    Route::get('/{id}/edit', [ActorController::class, 'edit'])->name('actors.edit');
    Route::post('/{id}/edit', [ActorController::class, 'update']);
    Route::get('/{id}/delete', [ActorController::class, 'destroy'])->name('actors.destroy');
});
