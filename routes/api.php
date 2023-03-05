<?php

use App\Http\Controllers\Api\SeriesController;
use App\Models\Episode;
use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function() {
    Route::apiResource('/series', SeriesController::class);
    Route::get('/series/{serie}/seasons', function(Serie $serie){
        return $serie->seasons;    
    });
    Route::get('/series/{serie}/episodes', function(Serie $serie){
        return $serie->episodes;
    });
    Route::patch('/episodes/{episode}', function(Episode $episode, Request $request){
        $episode->watched = $request->watched;
        $episode->save();
        return $episode;
    });
});



Route::post('/login', function(Request $request){
    $credenciais = $request->only(['email', 'password']); 
    if (Auth::attempt($credenciais) === false)
    {
        return response()->json('Usuário ou senha incorreto', 401);
    }
    $user = Auth::user();
    $token = $user->createToken('token');
    return response()->json($token->plainTextToken);

});