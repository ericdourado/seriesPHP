<?php

use App\Http\Controllers\EpisodesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\UsersController;
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

Route::get('/', function () {
    return redirect('/series');
})->middleware(App\Http\Middleware\Autenticador::class);

Route::resource('/series', SeriesController::class);
Route::get('/series/{series}/seasons', [SeasonController::class, 'index'])->name('seasons.index');
Route::get('/season/{season}/episodes', [EpisodesController::class, 'index'])->name('episodes.index');
Route::post('/season/{season}/episodes', [EpisodesController::class, 'update']);
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('sign');
Route::get('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::get('/registrar', [UsersController::class, 'create'])->name('users.create');
Route::post('/registrar', [UsersController::class, 'store'])->name('users.store');
