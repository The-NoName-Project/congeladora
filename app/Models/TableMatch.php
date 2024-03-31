<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TableMatch extends Model
{
    use HasFactory;

    protected $table = 'table_matches';

    protected $fillable = [
        'team_id',
        'matches',
        'wins',
        'losses',
        'draws',
        'points',
        'goals_for',
        'goal_difference',
        'goals_against',
        'category_id'
    ];
}
