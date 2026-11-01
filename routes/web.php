<?php

use App\Http\Controllers\CafeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

//Homepage
Route::view('/', 'home')->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Get request, URL, welke controller en welke methode, een naam voor de route
//Iedereen mag de lijst van cafes zien
Route::get('/cafes', [CafeController::class, 'index'])->name('cafes.index');

//Alleen ingelogde admins mogen cafes toevoegen en verwijderen

Route::middleware(['auth', 'can:admin'])->group(function() {
    Route::get('/cafes/create', [CafeController::class, 'create'])->name('cafes.create');
    Route::post('/cafes', [CafeController::class, 'store'])->name('cafes.store');
    Route::delete('/cafes/{cafe}', [CafeController::class, 'destroy'])->name('cafes.destroy');

    //admin gebruikers
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::post('/admin/users/{user}/toggle', [AdminController::class, 'toggle'])->name('admin.users.toggle');
});

//Alleen ingelogde gebruikers mogen reviews schrijven
Route::middleware('auth')->group(function (){
    //reviews plaatsen
    Route::post('/cafes/{cafe}/reviews', [ReviewController::class, 'store'])->name('reviews.store');

    //reviews verwijderen
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])
        ->middleware('can:delete-review,review')
        ->name('reviews.destroy');

    //reviews updaten
    Route::get('/reviews/{review}/edit', [ReviewController::class, 'edit'])
        ->middleware('can:update-review,review')
        ->name('reviews.edit');

    Route::put('/reviews/{review}', [ReviewController::class, 'update'])
        ->middleware('can:update-review,review')
        ->name('reviews.update');
});

// Gebruikers mogen een cafe bekijken
Route::get('/cafes/{cafe}', [CafeController::class, 'show'])->name('cafes.show');

require __DIR__.'/auth.php';
