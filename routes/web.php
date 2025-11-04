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

Route::controller(CategoryController::class)->name('categories.')->prefix('categories')->group(function() {
    Route::get('/','index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/', 'store')->name('store');
    Route::get('/{category}', 'show')->name('show');
    Route::get('/{category}/edit', 'edit')->name('edit');
    Route::patch('/{category}', 'update')->name('update');
    Route::delete('/{category}', 'destroy')->name('destroy');
    
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
