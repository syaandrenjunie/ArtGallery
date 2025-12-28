<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ArtistController;
use App\Http\Controllers\Api\ArtworkController;
use App\Http\Controllers\API\FavoriteController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/artists', [ArtistController::class, 'index']);
Route::middleware('auth:sanctum')->get('/artists/search', [ArtistController::class, 'search']); // New search route
Route::middleware('auth:sanctum')->post('/artists', [ArtistController::class, 'store']);
Route::middleware('auth:sanctum')->get('/artists/{id}', [ArtistController::class, 'show']);
Route::middleware('auth:sanctum')->put('/artists/{artist}', [ArtistController::class, 'update']);

Route::middleware('auth:sanctum')->group(function () {
   
    Route::get('/artworks', [ArtworkController::class, 'index']);
    Route::get('/artworks/{id}', [ArtworkController::class, 'show']);
});