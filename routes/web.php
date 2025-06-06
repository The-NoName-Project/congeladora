<?php

namespace App\Http\Controllers;

use App\Models\SoccerMatches;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    $soccer = SoccerMatches::with('home_team', 'away_team', 'referee')->thisWeek()->where('played', false)->get();
    $played_games = SoccerMatches::with('home_team', 'away_team', 'referee')->thisWeek()->where('played', true)->get();

    return view('welcome', compact('soccer', 'played_games'));
})->name('home')->middleware('set_language');

Route::get('/dashboard', function () {
    $soccer = SoccerMatches::with('home_team', 'away_team', 'referee')->thisWeek()->where('played', false)->get();
    $played_games = SoccerMatches::with('home_team', 'away_team', 'referee')->thisWeek()->where('played', true)->get();
    return view('dashboard', compact('soccer', 'played_games'));

})->middleware(['auth', 'verified', 'set_language'])->name('dashboard');

Route::middleware(['auth', 'set_language'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/teams', [TeamsController::class, 'index'])->name('teams.index');
    Route::get('/teams/create', [TeamsController::class, 'create'])->name('teams.create')->middleware('block_user');
    Route::post('/teams/store', [TeamsController::class, 'store'])->name('teams.store')->middleware('block_user');
    Route::get('/teams/{id}', [TeamsController::class, 'show'])->name('teams.show');
    Route::get('/teams/{id}/json', [TeamsController::class, 'showJson'])->name('teams.json');
    Route::get('/teams/{id}/edit', [TeamsController::class, 'edit'])->name('teams.edit')->middleware('block_user');
    Route::patch('/teams/{id}/update', [TeamsController::class, 'update'])->name('teams.update')->middleware('block_user');
    Route::delete('/teams/{id}/delete', [TeamsController::class, 'destroy'])->name('teams.delete');
    Route::get('/teams/{id}/pdf', [TeamsController::class, 'pdf'])->name('teams.pdf');

    Route::resource('schedules', SchedulesController::class)->except(['edit', 'update', 'delete'])->middleware('block_user');
    Route::get('/schedules/{id}/json', [SchedulesController::class, 'showJson'])->name('schedules.json');
    Route::delete('/schedules/{id}/delete', [SchedulesController::class, 'destroy'])->name('schedules.delete');

    Route::get('/soccer-matches', [SoccerMatchesController::class, 'index'])->name('matches.index');
    Route::get('/soccer-matches/create', [SoccerMatchesController::class, 'create'])->name('matches.create')->middleware('block_user');
    Route::post('/soccer-matches/store', [SoccerMatchesController::class, 'store'])->name('matches.store')->middleware('block_user');
    Route::get('/soccer-matches/{id}/json', [SoccerMatchesController::class, 'showJson'])->name('matches.json');
    Route::get('/soccer-matches/{id}/edit', [SoccerMatchesController::class, 'edit'])->name('matches.edit')->middleware('block_user');
    Route::delete('/soccer-matches/{id}/delete', [SoccerMatchesController::class, 'destroy'])->name('matches.delete')->middleware('block_user');


    Route::patch('/soccer-matches/{id}/addFouls', [SoccerMatchesController::class, 'addGoalsFouls'])->name('matches.add_goals');
    Route::post('/soccer-matches/{id}/create-goals', [SoccerMatchesController::class, 'addGoalsTeam'])->name('matches.team_goals');
    Route::get('/soccer-matches/{id}/goals', [SoccerMatchesController::class, 'goals'])->name('matches.goals');

    Route::get('/storage/{image}', function ($image) {
        $url = env('APP_URL');
        return $url . '/storage/' . $image;
    })->name('images.show');

    Route::resource('users', UserController::class)->except(['edit', 'update'])->middleware('block_user');
    Route::get('/export/credentials', [UserController::class, 'export_credentials'])->name('export.credentials')->middleware('block_user');
});


Route::get('/soccer-matches/{id}', [SoccerMatchesController::class, 'show'])->name('matches.show');
Route::get('/table-matches', [TableMatchesController::class, 'index'])->name('table-matches.index');
Route::get('/matches', [SoccerMatchesController::class, 'index'])->name('matches-without.index');
Route::get('/teams/{code}/code', [TeamsController::class, 'findUserCodeValid'])->name('teams.code');
Route::get('/calendar', [SoccerMatchesController::class, 'calendarSoccer'])->name('matches.calendar');

Route::get('/language/{locale}', function (string $locale) {
    $availableLocales = ['en', 'es']; // Agrega los que necesites

    if (in_array($locale, $availableLocales)) {
        Session::put('locale', $locale);
    }

    $locale = Session::get('locale', config('app.locale'));
    App::setLocale($locale);

    return redirect()->back();
})->name('change-language');

//Route::get('/scores', [TableMatchController::class, 'index'])->name('scores.index');

require __DIR__.'/auth.php';
