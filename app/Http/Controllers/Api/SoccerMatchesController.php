<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SoccerMatches;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SoccerMatchesController extends ApiController
{

    public function index(): JsonResponse
    {
        $soccer = Cache::remember('upcoming_soccer_matches', 60, function () {
            return SoccerMatches::with('home_team', 'away_team', 'referee')->where('played', 0)->get();
        });

        $matches = Cache::remember('soccer_matches_played', 60, function () {
            return SoccerMatches::with('home_team', 'away_team', 'referee')->where('played', 1)->get();
        });

        return $this->handleResponse(['upcoming' => $soccer, 'played' => $matches], 'Soccer matches retrieved successfully');
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
    public function show(int $id): JsonResponse
    {
        try {
            $match = SoccerMatches::with('home_team', 'away_team', 'referee')->find($id);

            if (!$match) {
                return $this->handleError('Match not found', 404);
            }

            return $this->handleResponse($match, 'Match retrieved successfully');
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return $this->handleError($e->getMessage(), 500);
        }
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
