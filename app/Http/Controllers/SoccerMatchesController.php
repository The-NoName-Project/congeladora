<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SoccerMatches;
use App\Models\Teams;
use App\Models\User;
use App\Models\UserDevice;
use App\Notifications\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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
            return SoccerMatches::with('home_team', 'away_team', 'referee')->where('played', 0)->get();
        });

        $matches = Cache::remember('soccer_matches_played', 60, function () {
            return SoccerMatches::with('home_team', 'away_team', 'referee')->where('played', 1)->get();
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
        $request->validate([
            'match_date' => ['required', 'date'],
            'home_team_id' => ['required', 'exists:' . Teams::class . ',id'],
            'away_team_id' => ['required', 'exists:' . Teams::class . ',id', 'distinct:team_local_id'],
            'referee_id' => ['required', 'exists:' . User::class . ',id'],
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
//
        $team_local = Teams::find($request->home_team_id);
//        $user=$team_local->capitan;
//        Mail::to($user->email)->send(new SoccerMatchMail($match, $user));
//
        $team_visit = Teams::find($request->away_team_id);
//        $capitan=$team_visit->capitan;
//        Mail::to($capitan->email)->send(new SoccerMatchMail($match, $capitan));

        $notification = new Notification();
        $devices = UserDevice::all()->pluck('expo_token')->toArray();

        $title = __('New match ').$team_local->name.' vs '.$team_visit->name;
        $body = __('A new match has been scheduled for the day: ').' '.Carbon::parse($match->match_date)->format('d-m-Y').' '.__('at').' '.Carbon::parse($match->match_date)->format('H:i').' '.__('hours');

        $notification->notification(
            devices: $devices,
            title: $title,
            body: $body
        );

        return redirect()->route('matches.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $id = Hashids::decode($id)[0];
        $match = SoccerMatches::with('home_team', 'away_team', 'referee')
        ->find($id);

        return view('matches.show', compact('match'));
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
}
