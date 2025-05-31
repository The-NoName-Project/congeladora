<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserTeam;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $players = UserTeam::with('user', 'team')->paginate(20);

        $referees = User::where('rol_id', 2)->paginate(20);

        $administrators = User::where('rol_id', 1)->paginate(20);

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
    public function show(string $id)
    {
        //
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
}
