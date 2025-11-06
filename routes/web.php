<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\ArtworkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('artists')->name('artists.')->controller(ArtistController::class)->group(function () {

    // Only Admin can create / edit / delete
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{artist}/edit', 'edit')->name('edit');
        Route::patch('/{artist}', 'update')->name('update');
        Route::delete('/{artist}', 'destroy')->name('destroy');
    });

     // Everyone must be logged in to view artists
    Route::middleware('auth')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{artist}', 'show')->name('show');
    });


});


Route::controller(CategoryController::class)->name('categories.')->prefix('categories')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/', 'store')->name('store');
    Route::get('/{category}', 'show')->name('show');
    Route::get('/{category}/edit', 'edit')->name('edit');
    Route::patch('/{category}', 'update')->name('update');
    Route::delete('/{category}', 'destroy')->name('destroy');

});

Route::controller(ArtworkController::class)->group(function () {
    Route::get('/artworks', 'index')->name('artworks.index');
    Route::get('/artworks/create', 'create')->name('artworks.create');
    Route::post('/artworks', 'store')->name('artworks.store');
    Route::get('/artworks/{artwork}', 'show')->name('artworks.show');
    Route::get('/artworks/{artwork}/edit', 'edit')->name('artworks.edit');
    Route::patch('/artworks/{artwork}', 'update')->name('artworks.update');
    Route::delete('/artworks/{artwork}', 'destroy')->name('artworks.destroy');

});

require __DIR__ . '/auth.php';
