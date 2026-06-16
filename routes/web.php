<?php

use App\Http\Controllers\AnalyseController;
use App\Http\Controllers\CandidatureController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth')->group(function () {
    Route::get('/offres', [OffreController::class, 'index'])->name('offres.index');
    Route::get('/offres/create', [OffreController::class, 'create'])->name('offres.create');
    Route::post('/offres', [OffreController::class, 'store'])->name('offres.store');
    Route::get('/offres/{offre}', [OffreController::class, 'show'])->name('offres.show');
});

Route::middleware('auth')->group(function () {
    Route::get('/offres/{offre}/candidatures/create', [CandidatureController::class, 'create'])->name('candidatures.create');
    Route::post('/offres/{offre}/candidatures', [CandidatureController::class, 'store'])->name('candidatures.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/analyses/{analyse}', [AnalyseController::class, 'show'])->name('analyses.show');
});

require __DIR__.'/auth.php';
