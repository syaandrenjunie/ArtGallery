<?php

use App\Http\Controllers\ArtworkController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\CategoryController;


Route::get('/', function () {
    return view('home');
});

Route::controller(ArtistController::class)->group(function () {
    Route::get('/artists', 'index')->name('artists.index');
    Route::get('/artists/create', 'create')->name('artists.create');
    Route::post('/artists', 'store')->name('artists.store');
    Route::get('/artists/{artist}', 'show')->name('artists.show');
    Route::get('/artists/{artist}/edit', 'edit')->name('artists.edit');
    Route::patch('/artists/{artist}', 'update')->name('artists.update');
    Route::delete('/artist/{artist}', 'destroy')->name('artists.destroy');
});


Route::controller(CategoryController::class)->group(function() {
    Route::get('/categories','index')->name('categories.index');
    Route::get('/categories/create', 'create')->name('categories.create');
    Route::post('/categories', 'store')->name('categories.store');
    Route::get('/categories/{category}', 'show')->name('categories.show');
    Route::get('/categories/{category}/edit', 'edit')->name('categories.edit');
    Route::patch('/categories/{category}', 'update')->name('categories.update');
    Route::delete('/categories/{category}', 'destroy')->name('categories.destroy');
});

Route::controller(ArtworkController::class)->group(function() {
    Route::get('/artworks','index')->name('artworks.index');
    Route::get('/artworks/create', 'create')->name('artworks.create');
    Route::post('/artworks', 'store')->name('artworks.store');
    Route::get('/artworks/{artwork}', 'show')->name('artworks.show');
Route::get('/artworks/{artwork}/edit', 'edit')->name('artworks.edit');
    Route::patch('/artworks/{artwork}', 'update')->name('artworks.update');
    Route::delete('/artworks/{artwork}', 'destroy')->name('artworks.destroy');
   
});
