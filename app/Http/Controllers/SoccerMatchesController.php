<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SoccerMatches;
use App\Models\TableMatch;
use App\Models\Teams;
use App\Models\User;
use App\Models\UserDevice;
use App\Models\UserTeam;
use App\Notifications\Notification;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Vinkla\Hashids\Facades\Hashids;

class SoccerMatchesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
//        $soccer = SoccerMatches::with('team_local', 'team_visit', 'referee', 'goals')->where('started', 0)->get();
        $soccer = Cache::remember('upcoming_soccer_matches', 60, function () {
            $matches_upcoming = SoccerMatches::with('home_team', 'away_team', 'referee')->where('played', 0)->get();

            if ($matches_upcoming->count() < 1) {
                return null;
            }
            return $matches_upcoming;
        });

        $matches = Cache::remember('soccer_matches_played', 60, function () {
            $matches_played = SoccerMatches::with('home_team', 'away_team', 'referee')->where('played', 1)->get();

            if ($matches_played->count() < 1) {
                return null;
            }

            return $matches_played;
        });

        return view('matches.index', compact('soccer', 'matches', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $referees = User::where('rol_id', 2)->get();
        $teams = Teams::all();

        return view('matches.create', compact('teams', 'referees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'match_date' => ['required', 'date'],
                'home_team_id' => ['required', 'exists:' . Teams::class . ',id'],
                'away_team_id' => ['required', 'exists:' . Teams::class . ',id', 'distinct:team_local_id'],
                'referee_id' => ['required', 'exists:' . User::class . ',id'],
            ]);

            $date = $request->match_date . ' ' . $request->match_time;

            $request->merge([
                'match_date' => Carbon::parse($date)->format('Y-m-d H:i:s'),
            ]);

//        $dayOfMatchExists = SoccerMatches::where('dayOfMatch', $request->dayOfMatch)->exists();
            $dayOfMatchExists = SoccerMatches::where('match_date', $request->match_date)
                ->where(function ($query) use ($request) {
                    $query->where('home_team_id', $request->home_team_id)
                        ->orWhere('away_team_id', $request->home_team_id);
                })
                ->where('played', false)
                ->exists();

            if ($dayOfMatchExists) {
                return redirect()->back()->withErrors(['error' => __('The game schedule already has a match scheduled for that day.')]);
            }

            $teamLocalMatchesExist = SoccerMatches::where('match_date', $request->match_date)
                ->orWhere('away_team_id', $request->home_team_id)
                ->where('home_team_id', $request->home_team_id)
                ->exists();

            if ($teamLocalMatchesExist) {
                return redirect()->back()->withErrors(['error' => __('The local team already has a match scheduled for that day.')]);
            }

            $teamVisitMatchesExist = SoccerMatches::where('match_date', $request->match_date)
                ->orWhere('home_team_id', $request->away_team_id)
                ->where('away_team_id', $request->away_team_id)
                ->exists();

            if ($teamVisitMatchesExist) {
                return redirect()->back()->withErrors(['error' => __('The visiting team already has a match scheduled for that day')]);
            }

            if ($request->home_team_id === $request->away_team_id) {
                return redirect()->back()->withErrors(['error' => __('The visiting team cannot be the same as the local team')]);
            }


            $match = SoccerMatches::create([
                'match_date' => $request->match_date,
                'home_team_id' => $request->home_team_id,
                'away_team_id' => $request->away_team_id,
                'referee_id' => $request->referee_id,
                'played' => false,
            ]);

            $team_local = Teams::find($request->home_team_id);
//        $user=$team_local->capitan;
//        Mail::to($user->email)->send(new SoccerMatchMail($match, $user));

            $team_visit = Teams::find($request->away_team_id);
//        $capitan=$team_visit->capitan;
//        Mail::to($capitan->email)->send(new SoccerMatchMail($match, $capitan));

//            $notification = new Notification();
//            $devices = UserDevice::all()->pluck('expo_token')->toArray();
//
//            $title = __('New match ') . $team_local->name . ' vs ' . $team_visit->name;
//            $body = __('A new match has been scheduled for the day: ') . ' ' . Carbon::parse($match->match_date)->format('d-m-Y') . ' ' . __('at') . ' ' . Carbon::parse($match->match_date)->format('H:i') . ' ' . __('hours');
//
//            $notification->notification(
//                devices: $devices,
//                title: $title,
//                body: $body
//            );

            DB::commit();

            return redirect()->route('matches.index');
        } catch (Exception $e) {
            Log::error('An error occurred while creating the schedule', ['error' => $e->getMessage()]);

            return redirect()->route('matches.index')->with('error', 'An error occurred while creating the schedule')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $id = Hashids::decode($id)[0];
        $match = SoccerMatches::with('home_team', 'away_team', 'referee')
        ->find($id);

        $team_local_users = UserTeam::with('user')
            ->whereTeamId($match->home_team_id)->get();

        $team_visit_users = UserTeam::with('user')
            ->whereTeamId($match->away_team_id)->get();

        return view('matches.show', compact('match', 'team_local_users', 'team_visit_users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SoccerMatches $soccerMatches)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SoccerMatches $soccerMatches)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SoccerMatches $soccerMatches)
    {
        //
    }

    public function addGoalsTeam(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'player_id_local' => ['exists:' . User::class . ',id'],
            'player_id_visit' => ['exists:' . User::class . ',id'],
            'home_team_goals' => ['integer', 'nullable'],
            'away_team_goals' => ['integer', 'nullable'],
        ]);

        $id = SoccerMatches::find($id);
        $id->update([
            'home_team_goals' => $request->home_team_goals,
            'away_team_goals' => $request->away_team_goals
        ]);

        $winnerId = $id->ganador();

        if ($winnerId === null) {
                // Si hay un empate, sumarle 1 punto a cada equipo
                $local = TableMatch::where('team_id', $id->home_team_id)->first();
                $local->points += 1;
                $local->draw += 1;
                $local->goals_for = $local->goals_for += $request->home_team_goals;
                $local->goals_against = $local->goals_against += $request->away_team_goals;
                $local->goal_difference = $local->goals_for - $local->goals_against;
                $local->save();

                $visitante = TableMatch::where('team_id', $id->away_team_id)->first();
                $visitante->points += 1;
                $visitante->draw += 1;
                $visitante->goals_for = $visitante->goals_for += $request->away_team_goals;
                $visitante->goals_against = $visitante->goals_against += $request->home_team_goals;
                $visitante->goals_difference = $visitante->goals_for - $visitante->goals_against;
                $visitante->save();
        }
            // Si hay un ganador, sumarle 3 puntos
        else {
            if ($winnerId === $id->home_team_id) {
                $equipoGanador = TableMatch::where('team_id', $winnerId)->first();
                $equipoGanador->matches += 1;
                $equipoGanador->points += 3;
                $equipoGanador->wins += 1;
                $equipoGanador->goals_for = $equipoGanador->goals_for += ($winnerId === $id->home_team_id) ? $request->home_team_goals : $request->away_team_goals;
                $equipoGanador->goals_against = $equipoGanador->goals_against += ($winnerId === $id->home_team_id) ? $request->away_team_goals : $request->home_team_goals;
                $equipoGanador->goal_difference = $equipoGanador->goals_for - $equipoGanador->goals_against;
                $equipoGanador->save();

                $equipoPerdedor = TableMatch::where('team_id', ($winnerId === $id->away_team_id) ? $id->home_team_id : $id->away_team_id)->first();
                $equipoPerdedor->losses += 1;
                $equipoPerdedor->matches += 1;
                $equipoPerdedor->points += 0;
                $equipoPerdedor->goals_against = $equipoPerdedor->goals_against += ($winnerId === $id->home_team_id) ? $request->home_team_goals : $request->away_team_goals;
                $equipoPerdedor->goals_for = $equipoPerdedor->goals_for += ($winnerId === $id->away_team_id) ? $request->home_team_goals : $request->away_team_goals;
                $equipoPerdedor->goal_difference = $equipoPerdedor->goals_for - $equipoPerdedor->goals_against;
                $equipoPerdedor->save();
            }
            elseif ($winnerId === $id->away_team_id) {
                $equipoGanador = TableMatch::where('team_id', $winnerId)->first();
                $equipoGanador->goals_for = $equipoGanador->goals_for += ($winnerId === $id->away_team_id) ? $request->away_team_goals : $request->home_team_goals;
                $equipoGanador->matches += 1;
                $equipoGanador->points += 3;
                $equipoGanador->wins += 1;
                $equipoGanador->goals_against = $equipoGanador->goals_against += ($winnerId === $id->home_team_id) ? $request->away_team_goals : $request->home_team_goals;
                $equipoGanador->goal_difference = $equipoGanador->goals_for - $equipoGanador->goals_against;
                $equipoGanador->save();

                $equipoPerdedor = TableMatch::where('team_id', ($winnerId === $id->home_team_id) ? $id->away_team_id : $id->home_team_id)->first();
                $equipoPerdedor->goals_for = $equipoPerdedor->goals_for += ($winnerId === $id->home_team_id) ? $request->away_team_goals : $request->home_team_goals;
                $equipoPerdedor->losses += 1;
                $equipoPerdedor->matches += 1;
                $equipoPerdedor->points += 0;
                $equipoPerdedor->goals_against = $equipoPerdedor->goals_against += ($winnerId === $id->away_team_id) ? $request->away_team_goals : $request->home_team_goals;
                $equipoPerdedor->goal_difference = $equipoPerdedor->goals_for - $equipoPerdedor->goals_against;
                $equipoPerdedor->save();
            }
        }

//        if ($request->player_id_local || $request->home_team_goals) {
//            $id->addGoals()->attach($request->player_id_local);
//            $id->team_local_goals = $request->home_team_goals;
//            $id->save();
//        }
//
//        if ($request->player_id_local || $request->away_team_goals) {
//            $id->addGoals()->attach($request->player_id_visit);
//            $id->team_visit_goals = $request->away_team_goals;
//        }
        $id->played = true;
        $id->finished = true;
        $id->save();

        $id=Hashids::encode($id->id);

        return redirect()->route('matches.show', $id);
    }

    public function goals($id): RedirectResponse
    {
        $id = SoccerMatches::find($id);

        return redirect()->route('matches.show', $id->id);
    }

    public function calendarSoccer():JsonResponse
    {
        $matches = SoccerMatches::with('home_team', 'away_team', 'referee')
            ->get();

        return response()->json($matches);
    }
}
