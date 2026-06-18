<?php

use App\Http\Controllers\AnalyseController;
use App\Http\Controllers\CandidatureController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
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
    Route::resource('offres', OffreController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/offres/{offre}/candidatures/create', [CandidatureController::class, 'create'])->name('candidatures.create');
    Route::post('/offres/{offre}/candidatures', [CandidatureController::class, 'store'])->name('candidatures.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/candidatures', [CandidatureController::class, 'index'])->name('candidatures.index');
    Route::get('/analyses', [AnalyseController::class, 'index'])->name('analyses.index');
    Route::get('/analyses/{analyse}', [AnalyseController::class, 'show'])->name('analyses.show');
    Route::post('/analyses/{analyse}/conversations', [ConversationController::class, 'store'])->name('conversations.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/conversations', [ConversationController::class, 'index'])->name('conversations.index');
    Route::get('/conversations/{conversation}', [ConversationController::class, 'show'])->name('conversations.show');
    Route::post('/conversations/{conversation}/messages', [MessageController::class, 'store'])->name('messages.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/search', [SearchController::class, 'index'])->name('search');
    Route::get('/settings', function () {
        return view('settings');
    })->name('settings');
    Route::get('/support', function () {
        return view('support');
    })->name('support');
});

require __DIR__.'/auth.php';
