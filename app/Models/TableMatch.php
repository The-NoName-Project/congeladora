<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TableMatch extends Model
{
    use HasFactory, SoftDeletes;

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

    public function team(): BelongsTo
    {
        return $this->belongsTo(Teams::class);
    }
}
