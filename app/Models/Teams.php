<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category|null $category
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Teams newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Teams newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Teams onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Teams query()
 * @method static \Illuminate\Database\Eloquent\Builder|Teams whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Teams whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Teams whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Teams withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Teams withoutTrashed()
 * @property string $name
 * @property string $slug
 * @property string $logo
 * @property int $user_id
 * @property int $category_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Teams whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Teams whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Teams whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Teams whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Teams whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Teams whereUserId($value)
 * @mixin \Eloquent
 */
class Teams extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'logo',
        'user_id',
        'category_id',
    ];

    public function capitan(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function players(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'team_user_codes', 'team_id', 'user_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
