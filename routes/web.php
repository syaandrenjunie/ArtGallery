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

Route::prefix('categories')->name('categories.')->middleware(['auth', 'role:admin'])->controller(CategoryController::class)->group(function () {

    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/', 'store')->name('store');
    Route::get('/{category}', 'show')->name('show');
    Route::get('/{category}/edit', 'edit')->name('edit');
    Route::patch('/{category}', 'update')->name('update');
    Route::delete('/{category}', 'destroy')->name('destroy');

});



Route::prefix('artworks')->name('artworks.')->controller(ArtworkController::class)->group(function () {

    // Only Admin can create / edit / delete
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{artwork}/edit', 'edit')->name('edit');
        Route::patch('/{artwork}', 'update')->name('update');
        Route::delete('/{artwork}', 'destroy')->name('destroy');
    });

     // Everyone must be logged in to view artworks
    Route::middleware('auth')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{artwork}', 'show')->name('show');
    });


});

Route::get('/carts', function () {
    return view('carts.index');
});

require __DIR__ . '/auth.php';
