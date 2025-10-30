<?php

use App\Http\Controllers\ArtistController;
use Illuminate\Support\Facades\Route;


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

