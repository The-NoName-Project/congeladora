<?php

namespace App\Http\Controllers;

use App\Models\TableMatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TableMatchesController extends Controller
{
    public function index()
    {
        $scores = TableMatch::with('team')
            ->orderBy('points', 'DESC')
            ->orderBy('matches', 'DESC')
            ->where('category_id', 1)
            ->get()
            ->filter(fn($match) => $match->team !== null);

        $scoresFeminine = TableMatch::with('team')
            ->orderBy('points', 'DESC')
            ->orderBy('matches', 'DESC')
            ->where('category_id', 2)
            ->get()
            ->filter(fn($match) => $match->team !== null);

        return view('table-match.index', compact('scores', 'scoresFeminine'));
    }

    public function restart_league($id)
    {
        try {
            DB::beginTransaction();
            $leagues = TableMatch::where('category_id', $id)
                ->get();
            // Coloca todos los datos en cero
            foreach($leagues as $league ) {
                $league->matches = 0;
                $league->wins = 0;
                $league->losses = 0;
                $league->draws = 0;
                $league->points = 0;
                $league->goals_for = 0;
                $league->goal_difference = 0;
                $league->goals_against = 0;

                $league->save();
            }

            DB::commit();

            return redirect()->back()->with(['success' => __('Season restarted')]);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error(__('Error:' . $exception->getMessage()), compact('exception'));
            return redirect()->back()->with(['error' => $exception->getMessage()]);
        }
    }
}
