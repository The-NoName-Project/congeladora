<?php

namespace App\Http\Controllers;

use App\Models\TableMatch;

class TableMatchesController extends Controller
{
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

        return view('table-match.index', compact('scores', 'scoresFeminine'));
    }
}
