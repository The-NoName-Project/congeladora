<?php

namespace App\Models;

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
 * @property-read \App\Models\Teams|null $team
 * @method static \Illuminate\Database\Eloquent\Builder|TeamUserCodes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TeamUserCodes newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TeamUserCodes query()
 * @method static \Illuminate\Database\Eloquent\Builder|TeamUserCodes whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamUserCodes whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamUserCodes whereUpdatedAt($value)
 * @property string $code
 * @property int $team_id
 * @property int $used
 * @method static \Illuminate\Database\Eloquent\Builder|TeamUserCodes whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamUserCodes whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamUserCodes whereUsed($value)
 * @mixin \Eloquent
 */
class TeamUserCodes extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'team_id',
        'user_id',
        'used',
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Teams::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
