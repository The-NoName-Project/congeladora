<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TableMatch;
use Illuminate\Http\Request;

class TableMatchesController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $scores = TableMatch::with('team')
            ->orderBy('points', 'DESC')
            ->orderBy('matches', 'DESC')
            ->where('category_id', 1)
            ->get();

        $scoresFeminine = TableMatch::with('team')
            ->orderBy('points', 'DESC')
            ->orderBy('matches', 'DESC')
            ->where('category_id', 2)
            ->get();

        return $this->handleResponse([
            'scores' => $scores,
            'scoresFeminine' => $scoresFeminine
        ], 'Scores retrieved successfully');
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
