<?php

namespace App\Http\Controllers;

use App\Models\SoccerMatches;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    $soccer = SoccerMatches::with('home_team', 'away_team', 'referee')->thisWeek()->where('played', false)->get();
    return view('welcome', compact('soccer'));
})->name('home');

Route::get('/dashboard', function () {
    $soccer = SoccerMatches::with('home_team', 'away_team', 'referee')->thisWeek()->where('played', false)->get();
    return view('dashboard', compact('soccer'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/teams', [TeamsController::class, 'index'])->name('teams.index');
    Route::get('/teams/create', [TeamsController::class, 'create'])->name('teams.create');
    Route::post('/teams/store', [TeamsController::class, 'store'])->name('teams.store');
    Route::get('/teams/{id}', [TeamsController::class, 'show'])->name('teams.show');
    Route::get('/teams/{id}/json', [TeamsController::class, 'showJson'])->name('teams.json');
    Route::get('/teams/{id}/edit', [TeamsController::class, 'edit'])->name('teams.edit');
    Route::patch('/teams/{id}/update', [TeamsController::class, 'update'])->name('teams.update');
    Route::delete('/teams/{id}/delete', [TeamsController::class, 'destroy'])->name('teams.delete');

    Route::get('/soccer-matches', [SoccerMatchesController::class, 'index'])->name('matches.index');
    Route::get('/soccer-matches/create', [SoccerMatchesController::class, 'create'])->name('matches.create');
    Route::post('/soccer-matches/store', [SoccerMatchesController::class, 'store'])->name('matches.store');
    Route::get('/soccer-matches/{id}/json', [SoccerMatchesController::class, 'showJson'])->name('matches.json');
    Route::get('/soccer-matches/{id}/edit', [SoccerMatchesController::class, 'edit'])->name('matches.edit');
    Route::delete('/soccer-matches/{id}/delete', [SoccerMatchesController::class, 'destroy'])->name('matches.delete');

    Route::get('/storage/{image}', function ($image) {
        $url = env('APP_URL');
        return $url . '/storage/' . $image;
    })->name('images.show');
});


Route::get('/soccer-matches/{id}', [SoccerMatchesController::class, 'show'])->name('matches.show');
Route::get('/table-matches', [TableMatchesController::class, 'index'])->name('table-matches.index');
//Route::get('/scores', [TableMatchController::class, 'index'])->name('scores.index');

require __DIR__.'/auth.php';
