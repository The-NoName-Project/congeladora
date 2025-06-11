<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 *
 * @method static \Illuminate\Database\Eloquent\Builder|UserTeam newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserTeam newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserTeam query()
 * @property int $id
 * @property int $user_id
 * @property int $team_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserTeam whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTeam whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTeam whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTeam whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTeam whereUserId($value)
 * @mixin \Eloquent
 */
class UserTeam extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'team_id',
        'user_id',
    ];

    public function team()
    {
        return $this->belongsTo(Teams::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
