<?php

use App\Http\Controllers\CafeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

//Homepage
Route::view('/', 'home')->name('home');

Route::get('about', [AboutController::class, 'index'])->name('about');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Get request, URL, welke controller en welke methode, een naam voor de route
Route::get('/cafes', [CafeController::class, 'index'])->name('cafes.index');

require __DIR__.'/auth.php';
