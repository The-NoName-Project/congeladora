<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserTeam;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\View\View;
use Vinkla\Hashids\Facades\Hashids;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $players = UserTeam::with('user', 'team')
            ->whereHas('user', function ($query) {
                $query->whereIn('rol_id', [3, 4]);
            })
            ->paginate(10);

        $referees = User::where('rol_id', 2)->paginate(10);

        $administrators = User::where('rol_id', 1)->paginate(10);

        return view('users.index', compact('players', 'referees', 'administrators'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $id = Hashids::decode($id)[0];

        $user = User::findOrFail($id);
        $team = UserTeam::where('user_id', $id)->first();
        $team = $team?->team;


        return view('profile.show', compact('user', 'team'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function export_credentials(): \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
    {
        $players = UserTeam::with('user', 'team')
            ->whereHas('user', function ($query) {
                $query->whereIn('rol_id', [3, 4])
                    ->whereNot('picture', null);
            })
            ->get();

        if ($players->isEmpty()) {
            return redirect()->back()->with('warning', 'No users with new pictures found');
        }

        return Pdf::loadView('users.export_credentials', compact('players'))->stream();
    }
}
