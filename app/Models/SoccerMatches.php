<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SoccerMatches newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SoccerMatches newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SoccerMatches query()
 * @method static \Illuminate\Database\Eloquent\Builder|SoccerMatches whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SoccerMatches whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SoccerMatches whereUpdatedAt($value)
 * @property string $match_date
 * @property int $home_team_goals
 * @property int $away_team_goals
 * @property int $played
 * @property int $finished
 * @property int $home_team_id
 * @property int $away_team_id
 * @property int $referee_id
 * @method static \Illuminate\Database\Eloquent\Builder|SoccerMatches whereAwayTeamGoals($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SoccerMatches whereAwayTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SoccerMatches whereFinished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SoccerMatches whereHomeTeamGoals($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SoccerMatches whereHomeTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SoccerMatches whereMatchDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SoccerMatches wherePlayed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SoccerMatches whereRefereeId($value)
 * @mixin \Eloquent
 */
class SoccerMatches extends Model
{
    use HasFactory;

    protected $fillable = [
        'match_date',
        'home_team_goals',
        'away_team_goals',
        'played',
        'finished',
        'home_team_id',
        'away_team_id',
        'referee_id',
    ];



    public function home_team(): BelongsTo
    {
        return $this->belongsTo(Teams::class);
    }

    public function away_team(): BelongsTo
    {
        return $this->belongsTo(Teams::class);
    }

    public function referee(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeThisWeek($query) {
        $today = Carbon::now()->format('Y-m-d');
        $endOfThisWeek = Carbon::now()->addDays(8)->format('Y-m-d');

        return $query->whereBetween('match_date', [$today, $endOfThisWeek]);
    }

    public function ganador(): ?int
    {
        if ($this->home_team_goals > $this->away_team_goals) {
            return $this->home_team_id;
        }

        // Si el equipo visitante ganó, devolver su ID
        if ($this->home_team_goals < $this->away_team_goals) {
            return $this->away_team_id;
        }

        // Si hubo empate, devolver null
        return null;
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Teams::class, 'team_id');
    }

    public function scopeCategory($query, $category)
    {
        return $query->whereHas('home_team_id', function ($query) use ($category) {
            $query->where('category_id', $category);
        });
    }
}
